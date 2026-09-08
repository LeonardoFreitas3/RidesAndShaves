<?php
/**
 * Title: Mais do que uma barbearia
 * Slug: rides-and-shaves/sobre
 * Categories: rides-and-shaves
 * Description: Foto à esquerda, texto ao centro, emblema à direita.
 */

$ras_uri = get_stylesheet_directory_uri();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"}},"backgroundColor":"green-900","layout":{"type":"constrained","wideSize":"1600px"}} -->
<div class="wp-block-group alignfull has-green-900-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:columns {"verticalAlignment":"center","align":"full","style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignfull are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"30%","className":"ras-hero"} -->
<div class="wp-block-column is-vertically-aligned-center ras-hero" style="flex-basis:30%"><!-- wp:image -->
<figure class="wp-block-image"><img src="<?php echo esc_url( "$ras_uri/assets/img/sobre.jpg" ); ?>" alt="Depósito de mota com o emblema Rides and Shaves"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40);flex-basis:40%"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Mais do que <mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">uma barbearia.</mark></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A Rides and Shaves nasceu da paixão pela barbearia, pelo estilo e por uma cultura que não passa despercebida.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Um espaço onde o grooming masculino encontra uma identidade própria, inspirada pela atitude, pela liberdade e pela cultura motard.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Aqui, cada visita é mais do que sentar na cadeira. É a experiência Rides and Shaves.</p>
<!-- /wp:paragraph -->

<?php // Na propria pagina /sobre o botao apontaria para si mesmo. ?>
<?php if ( ! is_page( 'sobre' ) ) : ?>
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/sobre">Conhecer a nossa história</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<?php endif; ?>
</div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"30%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30);flex-basis:30%"><!-- wp:image {"align":"center","width":"360px"} -->
<figure class="wp-block-image aligncenter is-resized"><img src="<?php echo esc_url( "$ras_uri/assets/logo.png" ); ?>" alt="Emblema Rides and Shaves BarberShop" style="width:360px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
