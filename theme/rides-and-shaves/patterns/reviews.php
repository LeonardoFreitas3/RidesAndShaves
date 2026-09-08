<?php
/**
 * Title: Reviews
 * Slug: rides-and-shaves/reviews
 * Categories: rides-and-shaves
 * Description: Nota do Google e quatro críticas reais.
 *
 * ponytail: sem fotografias de rosto. Estas são pessoas reais que escreveram as
 * críticas no Google — um retrato inventado ao lado do nome de alguém real é
 * passar por verdadeiro o que não é. Círculo dourado com a inicial resolve.
 */

$ras_criticas = array(
	array( 'João Oliveira',  'Sou cliente da Rides and Shaves e estou muito contente com o serviço. O nível de exigência e detalhe mantém-se sempre.' ),
	array( 'André Silva',    'Já sou cliente há pelo menos 3 anos. Barbeiros impecáveis, atenciosos, e acima de tudo bom ambiente!' ),
	array( 'Bruno Gomes',    'Pessoal top, corte top e ambiente descontraído. Super recomendo até pela facilidade em marcar.' ),
	array( 'Ruben Pinheiro', 'Profissionais acima de tudo, com cuidado ao atendimento. Para mim, a melhor barbearia de Braga.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-800","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-800-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"align":"wide","className":"ras-rule","fontSize":"x-large"} -->
<h2 class="wp-block-heading alignwide ras-rule has-x-large-font-size">Quem experimenta, <mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">volta.</mark></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"18%"} -->
<div class="wp-block-column" style="flex-basis:18%"><!-- wp:paragraph {"className":"ras-price","fontSize":"xx-large"} -->
<p class="ras-price has-xx-large-font-size">5,0</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"gold","fontSize":"large"} -->
<p class="has-gold-color has-text-color has-large-font-size">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">443 avaliações Google nas duas lojas</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<?php foreach ( $ras_criticas as list( $nome, $texto ) ) : ?>
<!-- wp:column {"className":"ras-card"} -->
<div class="wp-block-column ras-card"><!-- wp:group {"className":"ras-autor","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group ras-autor"><!-- wp:html -->
<span class="ras-monogram" aria-hidden="true"><?php echo esc_html( function_exists( 'mb_substr' ) ? mb_substr( $nome, 0, 1 ) : substr( $nome, 0, 1 ) ); ?></span>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><strong><?php echo esc_html( $nome ); ?></strong></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"textColor":"gold","fontSize":"small"} -->
<p class="has-gold-color has-text-color has-small-font-size">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( $texto ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="https://www.google.com/maps/search/?api=1&amp;query=41.5514457,-8.3959997" target="_blank" rel="noreferrer noopener">Ver mais avaliações</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
