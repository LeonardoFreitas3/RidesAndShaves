<?php
/**
 * Title: Journal
 * Slug: rides-and-shaves/journal
 * Categories: rides-and-shaves
 * Description: Faixa de artigos, quatro cartões com miniatura.
 */

$ras_uri = get_stylesheet_directory_uri();

$ras_artigos = array(
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

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/journal">Ver todos os artigos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"76%"} -->
<div class="wp-block-column" style="flex-basis:76%"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
<div class="wp-block-columns">
<?php foreach ( $ras_artigos as list( $img, $titulo ) ) : ?>
<!-- wp:column {"className":"ras-artigo"} -->
<div class="wp-block-column ras-artigo"><!-- wp:image -->
<figure class="wp-block-image"><img src="<?php echo esc_url( "$ras_uri/assets/img/$img.jpg" ); ?>" alt="<?php echo esc_attr( $titulo ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"ras-artigo-body","layout":{"type":"constrained"}} -->
<div class="wp-block-group ras-artigo-body"><!-- wp:heading {"level":3,"fontSize":"small"} -->
<h3 class="wp-block-heading has-small-font-size"><?php echo esc_html( $titulo ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"gold","fontSize":"small"} -->
<p class="has-gold-color has-text-color has-small-font-size"><a href="/journal">Ler artigo →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
