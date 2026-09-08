<?php
/**
 * Verifica o tema sem precisar de WordPress: `php tools/check-blocks.php`
 *
 * Apanha as tres falhas que o WordPress nao reporta — o bloco simplesmente
 * desaparece e ninguem percebe porque:
 *   1. blocos por fechar / mal fechados
 *   2. classes de cor que nao existem na paleta do theme.json
 *   3. PHP dentro de templates .html (nao sao parseados como PHP)
 *   4. wp:pattern a apontar para um slug que nao existe
 *
 * ponytail: um ficheiro, sem PHPUnit, sem composer.
 */

$root   = dirname( __DIR__ );
$errors = array();

/* --- theme.json tem de ser JSON valido, senao a paleta inteira e ignorada --- */
$theme_json = file_get_contents( $root . '/theme.json' );
json_decode( $theme_json );
if ( JSON_ERROR_NONE !== json_last_error() ) {
	$errors[] = 'theme.json: ' . json_last_error_msg();
}

preg_match_all( '/"slug":\s*"([a-z0-9-]+)",\s*"color"/', $theme_json, $m );
$palette = $m[1];

/* --- slugs dos patterns disponiveis, lidos do cabecalho de cada ficheiro --- */
$pattern_files = glob( $root . '/patterns/*.php' ) ?: array();
$pattern_slugs = array();
foreach ( $pattern_files as $file ) {
	if ( preg_match( '/^\s*\*\s*Slug:\s*(\S+)/mi', file_get_contents( $file ), $s ) ) {
		$pattern_slugs[] = $s[1];
	} else {
		$errors[] = basename( $file ) . ': falta o cabecalho "Slug:" — o WordPress ignora o pattern';
	}
}

/* --- templates, parts e patterns: markup de blocos --- */
$files = array_merge(
	glob( $root . '/templates/*.html' ) ?: array(),
	glob( $root . '/parts/*.html' ) ?: array(),
	$pattern_files
);

foreach ( $files as $file ) {
	$html  = file_get_contents( $file );
	$name  = basename( $file );
	$stack = array();

	// PHP so e valido em patterns. Em .html o WordPress imprime o codigo cru.
	if ( '.html' === substr( $name, -5 ) && false !== strpos( $html, '<?php' ) ) {
		$errors[] = "$name: tem <?php — templates .html nao sao parseados como PHP. Passa a seccao para um pattern.";
	}

	preg_match_all( '/<!--\s*(\/?)wp:([a-z0-9\/-]+)(.*?)(\/)?-->/s', $html, $tags, PREG_SET_ORDER );

	foreach ( $tags as $tag ) {
		$closing      = '/' === $tag[1];
		$block        = $tag[2];
		$attrs        = $tag[3];
		$self_closing = isset( $tag[4] ) && '/' === $tag[4];

		if ( 'pattern' === $block && preg_match( '/"slug"\s*:\s*"([^"]+)"/', $attrs, $p ) ) {
			if ( ! in_array( $p[1], $pattern_slugs, true ) ) {
				$errors[] = "$name: wp:pattern aponta para \"{$p[1]}\" que nao existe";
			}
		}

		if ( $self_closing ) {
			continue;
		}
		if ( $closing ) {
			$open = array_pop( $stack );
			if ( $open !== $block ) {
				$errors[] = "$name: fecha wp:$block mas o bloco aberto era wp:" . ( $open ?? 'nenhum' );
			}
		} else {
			$stack[] = $block;
		}
	}

	if ( $stack ) {
		$errors[] = "$name: blocos por fechar — wp:" . implode( ', wp:', $stack );
	}

	// Assets referenciados que nao existem — um nome de icone errado da 404 silencioso.
	preg_match_all( '#assets/[A-Za-z0-9_/.-]+\.(?:svg|png|jpg)#', $html, $assets );
	foreach ( array_unique( $assets[0] ) as $asset ) {
		if ( ! file_exists( "$root/$asset" ) ) {
			$errors[] = "$name: referencia $asset que nao existe";
		}
	}

	preg_match_all( '/has-([a-z0-9-]+?)-(?:background-)?color\b/', $html, $used );
	foreach ( array_unique( $used[1] ) as $slug ) {
		// Classes do core que nao referem a paleta.
		if ( in_array( $slug, array( 'text', 'link', 'inline', 'icon' ), true ) ) {
			continue;
		}
		if ( ! in_array( $slug, $palette, true ) ) {
			$errors[] = "$name: cor \"$slug\" usada mas nao existe na paleta do theme.json";
		}
	}
}

/* --- ficheiros que o WordPress espera encontrar --- */
foreach ( array( 'style.css', 'theme.json', 'templates/front-page.html', 'assets/logo.png' ) as $required ) {
	if ( ! file_exists( "$root/$required" ) ) {
		$errors[] = "falta $required";
	}
}

if ( $errors ) {
	echo "FALHOU\n" . implode( "\n", array_map( fn( $e ) => "  - $e", $errors ) ) . "\n";
	exit( 1 );
}

printf(
	"OK — %d ficheiros verificados, %d patterns, %d cores na paleta\n",
	count( $files ),
	count( $pattern_slugs ),
	count( $palette )
);
