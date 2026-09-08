<?php
/**
 * Title: Journal
 * Slug: rides-and-shaves/journal
 * Categories: rides-and-shaves
 * Description: Faixa de artigos, quatro cartões com miniatura.
 *
 * ponytail: mostra artigos a sério quando existirem. Enquanto não houver, os
 * quatro cartões do mockup ficam como montra — mas sem "Ler artigo", que não
 * levava a lado nenhum. Assim que publicarem o primeiro post, a secção troca
 * sozinha, tal como a da loja.
 */

$ras_uri = get_stylesheet_directory_uri();

$ras_posts = get_posts(
	array(
		'numberposts' => 4,
		'post_status' => 'publish',
	)
);

// Miniaturas de reserva, para um post sem imagem destacada não ficar vazio.
$ras_fallback = array( 'journal-1', 'journal-2', 'journal-3', 'journal-4' );

$ras_montra = array(
	array( 'journal-1', 'Como escolher o corte certo para o teu rosto?' ),
	array( 'journal-2', 'Como cuidar da barba em casa?' ),
	array( 'journal-3', 'O que é um Hot Towel Shave?' ),
	array( 'journal-4', 'Que produto usar no teu tipo de cabelo?' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-950","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-950-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"24%"} -->
<div class="wp-block-column" style="flex-basis:24%"><!-- wp:paragraph {"textColor":"gold","style":{"typography":{"letterSpacing":"0.25em","textTransform":"uppercase"}},"fontSize":"small"} -->
<p class="has-gold-color has-text-color has-small-font-size" style="letter-spacing:0.25em;text-transform:uppercase">Journal</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Dicas, inspiração e conhecimento.</h2>
<!-- /wp:heading -->

<?php // Na propria pagina /journal o botao apontaria para si mesmo. ?>
<?php if ( $ras_posts && ! is_page( 'journal' ) ) : ?>
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/journal">Ver todos os artigos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<?php endif; ?>
</div>
<!-- /wp:column -->

<!-- wp:column {"width":"76%"} -->
<div class="wp-block-column" style="flex-basis:76%"><!-- wp:html -->
<ul class="ras-artigos">
<?php if ( $ras_posts ) : ?>
	<?php foreach ( $ras_posts as $ras_i => $ras_post ) : ?>
	<li class="ras-artigo">
		<a class="ras-artigo-foto" href="<?php echo esc_url( get_permalink( $ras_post ) ); ?>">
			<?php if ( has_post_thumbnail( $ras_post ) ) : ?>
				<?php echo get_the_post_thumbnail( $ras_post, 'medium_large' ); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( "$ras_uri/assets/img/{$ras_fallback[ $ras_i % 4 ]}.jpg" ); ?>" alt="">
			<?php endif; ?>
		</a>
		<div class="ras-artigo-body">
			<h3><a href="<?php echo esc_url( get_permalink( $ras_post ) ); ?>"><?php echo esc_html( get_the_title( $ras_post ) ); ?></a></h3>
			<p><a href="<?php echo esc_url( get_permalink( $ras_post ) ); ?>">Ler artigo &rarr;</a></p>
		</div>
	</li>
	<?php endforeach; ?>
<?php else : ?>
	<?php foreach ( $ras_montra as list( $ras_img, $ras_titulo ) ) : ?>
	<li class="ras-artigo">
		<span class="ras-artigo-foto"><img src="<?php echo esc_url( "$ras_uri/assets/img/$ras_img.jpg" ); ?>" alt=""></span>
		<div class="ras-artigo-body">
			<h3><?php echo esc_html( $ras_titulo ); ?></h3>
			<p class="ras-embreve">Em breve</p>
		</div>
	</li>
	<?php endforeach; ?>
<?php endif; ?>
</ul>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
