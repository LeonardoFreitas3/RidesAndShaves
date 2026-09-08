<?php
/**
 * Title: Serviços
 * Slug: rides-and-shaves/servicos
 * Categories: rides-and-shaves
 * Description: Caixa com moldura dourada, seis serviços separados por divisórias.
 *
 * ponytail: os seis serviços são um array, não seis blocos de markup copiados.
 * Mudar um preço é mudar um número aqui — e mais lado nenhum no site.
 */

$ras_uri = get_stylesheet_directory_uri();

$ras_servicos = array(
	array( 'cabelo',       'Cabelo',                     '17', 'Corte masculino com atenção ao detalhe.' ),
	array( 'cabelo-barba', 'Cabelo + Barba',             '25', 'Corte de cabelo + serviço de barba com toalha quente incluída.' ),
	array( 'barba',        'Barba',                      '11', 'Definição, contorno e cuidado para uma barba impecável.' ),
	array( 'barbaterapia', 'Barbaterapia',               '21', 'Um serviço completo para o cuidado da barba. Conforto e experiência.' ),
	array( 'sobrancelha',  'Sobrancelha à linha',        '9',  'Precisão e definição para completar o teu look.' ),
	array( 'depilacao',    'Depilação nasal ou ouvidos', '5',  'Um acabamento rápido para completar o teu serviço.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-900","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-900-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"align":"wide","className":"ras-rule","fontSize":"x-large"} -->
<h2 class="wp-block-heading alignwide ras-rule has-x-large-font-size">Os nossos <mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">serviços</mark></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","className":"ras-services","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide ras-services"><!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"0"}}}} -->
<div class="wp-block-columns">
<?php foreach ( $ras_servicos as list( $icone, $nome, $preco, $descricao ) ) : ?>
<!-- wp:column {"className":"ras-service"} -->
<div class="wp-block-column ras-service"><!-- wp:image {"align":"center"} -->
<figure class="wp-block-image aligncenter"><img src="<?php echo esc_url( "$ras_uri/assets/icons/$icone.svg" ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"medium"} -->
<h3 class="wp-block-heading has-text-align-center has-medium-font-size"><?php echo esc_html( $nome ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"ras-price","fontSize":"large"} -->
<p class="has-text-align-center ras-price has-large-font-size"><?php echo esc_html( $preco ); ?>&euro;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size"><?php echo esc_html( $descricao ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex"><!-- wp:button {"className":"is-icon-cal"} -->
<div class="wp-block-button is-icon-cal"><a class="wp-block-button__link wp-element-button" href="/marcar">Marcar</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php // Na propria pagina /servicos o botao apontaria para si mesmo. ?>
<?php if ( ! is_page( 'servicos' ) ) : ?>
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/servicos">Ver todos os serviços</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<?php endif; ?>
</div>
<!-- /wp:group -->
