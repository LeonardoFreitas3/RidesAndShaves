<?php
/**
 * Title: Loja — catálogo
 * Slug: rides-and-shaves/loja
 * Categories: rides-and-shaves
 * Description: Catálogo de produtos com o cartão da marca.
 *
 * ponytail: percorre a query principal em vez de fazer uma nova, para as páginas
 * de categoria e a paginação funcionarem sem código extra.
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-800","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-800-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"align":"wide","className":"ras-rule","fontSize":"x-large"} -->
<h1 class="wp-block-heading alignwide ras-rule has-x-large-font-size">Rides and Shaves <mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">Shop</mark></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"wide","fontSize":"small"} -->
<p class="has-text-align-wide has-small-font-size">Os produtos que usamos e recomendamos na barbearia. Cabelo, barba e grooming masculino.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<?php if ( have_posts() ) : ?>
<ul class="ras-montra ras-montra-catalogo">
	<?php
	while ( have_posts() ) :
		the_post();
		ras_cartao_produto( wc_get_product( get_the_ID() ) );
	endwhile;
	?>
</ul>
	<?php
	the_posts_pagination(
		array(
			'class'              => 'ras-paginacao',
			'prev_text'          => '&larr;',
			'next_text'          => '&rarr;',
			'screen_reader_text' => 'Páginas do catálogo',
		)
	);
	wp_reset_postdata();
	?>
<?php else : ?>
<p>Ainda não há produtos na loja. Volta em breve.</p>
<?php endif; ?>
<!-- /wp:html --></div>
<!-- /wp:group -->
