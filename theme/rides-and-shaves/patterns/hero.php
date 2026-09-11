<?php
/**
 * Title: Hero
 * Slug: rides-and-shaves/hero
 * Categories: rides-and-shaves
 * Description: Texto à esquerda, fotografia a sangrar à direita.
 */

$ras_uri = get_stylesheet_directory_uri();

// A versao do tema no URL da foto. Sem isto o browser continua a servir a
// imagem antiga em cache quando o recorte muda — o nome do ficheiro e o mesmo
// e o WordPress nao versiona src de imagens em templates.
$ras_v = wp_get_theme()->get( 'Version' );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"}},"className":"ras-banner","backgroundColor":"green-950","textColor":"cream","layout":{"type":"constrained","wideSize":"1600px"}} -->
<div class="wp-block-group alignfull ras-banner has-cream-color has-green-950-background-color has-text-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:columns {"verticalAlignment":"center","align":"full","isStackedOnMobile":true,"style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignfull are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"56%","className":"ras-hero-texto"} -->
<div class="wp-block-column is-vertically-aligned-center ras-hero-texto" style="flex-basis:56%"><!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-xx-large-font-size">Enjoy<br><mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">the ride.</mark></h1>
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

<!-- wp:column {"verticalAlignment":"center","width":"44%","className":"ras-hero"} -->
<div class="wp-block-column is-vertically-aligned-center ras-hero" style="flex-basis:44%"><!-- wp:image -->
<figure class="wp-block-image"><img src="<?php echo esc_url( "$ras_uri/assets/img/hero.jpg?v=$ras_v" ); ?>" alt="Barbeiro a fazer a barba a um cliente na Rides and Shaves"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:html -->
<div class="ras-marca" aria-hidden="true"></div>
<!-- /wp:html --></div>
<!-- /wp:group -->
