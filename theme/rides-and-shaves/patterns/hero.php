<?php
/**
 * Title: Hero
 * Slug: rides-and-shaves/hero
 * Categories: rides-and-shaves
 * Description: Texto à esquerda, fotografia a sangrar à direita.
 */

$ras_uri = get_stylesheet_directory_uri();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"}},"backgroundColor":"green-950","textColor":"cream","layout":{"type":"constrained","wideSize":"1600px"}} -->
<div class="wp-block-group alignfull has-cream-color has-green-950-background-color has-text-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:columns {"verticalAlignment":"center","align":"full","isStackedOnMobile":true,"style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignfull are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"46%","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50);flex-basis:46%"><!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-xx-large-font-size">Barbearia,<br><mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">Grooming &amp;</mark><br>Lifestyle.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Corte. Barba. Estilo. Experiência.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-icon-cal"} -->
<div class="wp-block-button is-icon-cal"><a class="wp-block-button__link wp-element-button" href="/marcar">Marcar</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline is-icon-cart"} -->
<div class="wp-block-button is-style-outline is-icon-cart"><a class="wp-block-button__link wp-element-button" href="/loja">Shop</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"textColor":"gold","className":"ras-ornament","style":{"typography":{"letterSpacing":"0.3em","textTransform":"uppercase"}},"fontSize":"small"} -->
<p class="ras-ornament has-gold-color has-text-color has-small-font-size" style="letter-spacing:0.3em;text-transform:uppercase">Since 1995</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"54%","className":"ras-hero"} -->
<div class="wp-block-column is-vertically-aligned-center ras-hero" style="flex-basis:54%"><!-- wp:image -->
<figure class="wp-block-image"><img src="<?php echo esc_url( "$ras_uri/assets/img/hero.jpg" ); ?>" alt="Barbeiro a fazer a barba a um cliente na Rides and Shaves"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
