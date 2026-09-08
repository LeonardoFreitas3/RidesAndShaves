<?php
/**
 * Renderiza a homepage fora do WordPress, para conferir o design.
 *   php tools/preview.php  ->  _preview.html
 *
 * ponytail: emula so o que o tema usa — presets do theme.json, colunas, botoes
 * e alinhamentos. Nao e o WordPress e nao tenta ser: e um espelho suficiente
 * para apanhar layout partido antes de fazer upload.
 */

$theme = __DIR__ . '/../theme/rides-and-shaves';

function get_stylesheet_directory_uri() {
	return 'theme/rides-and-shaves';
}
function esc_url( $u ) {
	return $u;
}
function esc_html( $s ) {
	return htmlspecialchars( $s, ENT_QUOTES );
}
function esc_attr( $s ) {
	return htmlspecialchars( $s, ENT_QUOTES );
}
// Stubs do WordPress/WooCommerce. O preview nao tem base de dados, por isso o
// catalogo mostra os quatro produtos da montra estatica.
function have_posts() {
	return false;
}
function the_post() {}
function wp_reset_postdata() {}
function the_posts_pagination( $a = array() ) {}
function wc_get_product( $id = 0 ) {
	return null;
}
function ras_cartao_produto( $p ) {}
function get_posts( $a = array() ) {
	return array();
}
function has_post_thumbnail( $p = null ) {
	return false;
}
function get_the_post_thumbnail( $p = null, $s = '' ) {
	return '';
}
function get_permalink( $p = null ) {
	return '#';
}
function get_the_title( $p = null ) {
	return '';
}

// O preview renderiza a homepage: nenhuma pagina interna esta ativa.
function is_page( $slug ) {
	return isset( $GLOBALS['ras_pagina_atual'] ) && $GLOBALS['ras_pagina_atual'] === $slug;
}

/* --- presets do theme.json como CSS vars --------------------------------- */
$json = json_decode( file_get_contents( "$theme/theme.json" ), true );
$vars = array();
foreach ( $json['settings']['color']['palette'] as $c ) {
	$vars[] = "--wp--preset--color--{$c['slug']}: {$c['color']};";
}
foreach ( $json['settings']['typography']['fontSizes'] as $f ) {
	$vars[] = "--wp--preset--font-size--{$f['slug']}: {$f['size']};";
}
foreach ( $json['settings']['spacing']['spacingSizes'] as $s ) {
	$vars[] = "--wp--preset--spacing--{$s['slug']}: {$s['size']};";
}

// @font-face declarados no theme.json, com os caminhos file:./ resolvidos.
$font_faces = '';
foreach ( $json['settings']['typography']['fontFamilies'] as $f ) {
	foreach ( $f['fontFace'] ?? array() as $face ) {
		$src = str_replace( 'file:./', 'theme/rides-and-shaves/', $face['src'][0] );
		$font_faces .= sprintf(
			"@font-face{font-family:%s;font-style:%s;font-weight:%s;font-display:swap;src:url('%s') format('woff2')}",
			$face['fontFamily'], $face['fontStyle'] ?? 'normal', $face['fontWeight'] ?? '400', $src
		);
	}
}

$color_rules = '';
foreach ( $json['settings']['color']['palette'] as $c ) {
	$color_rules .= ".has-{$c['slug']}-color{color:{$c['color']}}";
	$color_rules .= ".has-{$c['slug']}-background-color{background-color:{$c['color']}}";
}
$size_rules = '';
foreach ( $json['settings']['typography']['fontSizes'] as $f ) {
	$size_rules .= ".has-{$f['slug']}-font-size{font-size:{$f['size']}}";
}

/* --- corre os patterns e a template ------------------------------------- */
function render_pattern( $slug, $theme ) {
	foreach ( glob( "$theme/patterns/*.php" ) as $file ) {
		if ( preg_match( '/^\s*\*\s*Slug:\s*(\S+)/mi', file_get_contents( $file ), $m ) && $m[1] === $slug ) {
			ob_start();
			include $file;
			return ob_get_clean();
		}
	}
	return "<p style='color:red'>pattern em falta: $slug</p>";
}

$parts = array();
foreach ( glob( "$theme/parts/*.html" ) as $file ) {
	$parts[ basename( $file, '.html' ) ] = file_get_contents( $file );
}

function build( $html, $theme, $parts ) {

	$html = preg_replace_callback(
		'/<!--\s*wp:template-part\s*\{[^}]*"slug":"([a-z-]+)"[^}]*\}\s*\/-->/',
		fn( $m ) => $parts[ $m[1] ] ?? '',
		$html
	);

	// patterns (duas passagens: um pattern pode incluir outro)
	for ( $i = 0; $i < 2; $i++ ) {
		$html = preg_replace_callback(
			'/<!--\s*wp:pattern\s*\{[^}]*"slug":"([a-z0-9\/-]+)"[^}]*\}\s*\/-->/',
			fn( $m ) => render_pattern( $m[1], $theme ),
			$html
		);
	}

	// blocos dinamicos que so o WordPress sabe render
	$html = str_replace(
		'[products limit="4" columns="4" visibility="visible"]',
		'<div class="stub-products">' . str_repeat( '<div class="stub-product"><img src="theme/rides-and-shaves/assets/img/produto-1.jpg" alt=""><p>Produto</p><p class="ras-price">16,90&euro;</p></div>', 4 ) . '</div>',
		$html
	);
	$html = preg_replace( '/<!--\s*wp:(site-logo|woocommerce\/mini-cart|social-links?|social-link|home-link|navigation-link)[^>]*?\/-->/', '', $html );
	$html = preg_replace( '/<!--\s*\/?wp:[^>]*?-->/s', '', $html );
	return $html;
}

define( 'STYLE_OPEN', '<style>' );
define( 'STYLE_CLOSE', '</style>' );
define( 'PREVIEW_CSS', <<<'CSS'
*{box-sizing:border-box}
body{margin:0;background:var(--wp--preset--color--green-800);color:var(--wp--preset--color--cream);
  font:16px/1.6 system-ui,-apple-system,"Segoe UI",Roboto,sans-serif}
h1,h2,h3{font-family:"Barlow Condensed","Arial Narrow",system-ui,sans-serif;font-weight:800;text-transform:uppercase;
  letter-spacing:.01em;line-height:1.05;margin:0 0 .4em;color:var(--wp--preset--color--cream)}
p{margin:0 0 1rem}
a{color:var(--wp--preset--color--gold)}
img{max-width:100%;height:auto;display:block}


.wp-block-group{width:100%}
.alignfull{width:100%}
.alignwide{max-width:1280px;margin-inline:auto}
.wp-block-columns{display:flex;gap:1.5rem;align-items:stretch}
.wp-block-columns.are-vertically-aligned-center{align-items:center}
.wp-block-column{flex:1 1 0;min-width:0}
.wp-block-buttons{display:flex;gap:.75rem;flex-wrap:wrap;margin:1rem 0}
.wp-block-buttons.is-content-justification-center,
.wp-block-buttons[class*=justify]{justify-content:center}
.wp-block-button__link{display:inline-block;background:var(--wp--preset--color--gold);
  color:var(--wp--preset--color--green-900);text-decoration:none;font-weight:700;
  text-transform:uppercase;letter-spacing:.08em;font-size:.8rem;padding:.9em 1.8em;border-radius:2px}
.is-style-outline .wp-block-button__link{background:transparent;color:var(--wp--preset--color--gold);
  border:1px solid var(--wp--preset--color--gold)}
.has-text-align-center{text-align:center}
.aligncenter{margin-inline:auto}
figure{margin:0}
.stub-products{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem}
.stub-product{border:1px solid rgba(232,169,78,.18);padding:.75rem;text-align:center;font-size:.85rem}


CSS
);

$css         = str_replace( 'url("assets/', 'url("theme/rides-and-shaves/assets/', file_get_contents( "$theme/style.css" ) );
$vars_joined = implode( '', $vars );

$templates = glob( "$theme/templates/*.html" );
$nav       = '';
foreach ( $templates as $t ) {
	$slug = basename( $t, '.html' );
	$nav .= "<a href='_preview-$slug.html'>$slug</a> ";
}

foreach ( $templates as $t ) {
	$slug = basename( $t, '.html' );
	$GLOBALS['ras_pagina_atual'] = preg_replace( '/^page-/', '', $slug );
	$body = build( file_get_contents( $t ), $theme, $parts );

	$out = "<!doctype html><meta charset='utf-8'><title>Preview $slug — Rides and Shaves</title>
"
		. STYLE_OPEN . $font_faces . ":root{ $vars_joined }" . PREVIEW_CSS . $color_rules . $size_rules . $css
		. "
.ras-nav{position:sticky;top:0;z-index:99;background:#000;padding:.5rem 1rem;font:12px system-ui}"
		. "
.ras-nav a{margin-right:1rem;text-transform:uppercase;letter-spacing:.08em}"
		. STYLE_CLOSE
		. "<div class='ras-nav'>$nav</div>" . $body;

	file_put_contents( __DIR__ . "/../_preview-$slug.html", $out );
	echo "escrito _preview-$slug.html
";
}
