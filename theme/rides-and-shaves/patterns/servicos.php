<?php
/**
 * Title: Serviços
 * Slug: rides-and-shaves/servicos
 * Categories: rides-and-shaves
 * Description: Carta de serviços numerada, preço à direita, um só botão de marcar.
 *
 * ponytail: os seis serviços são um array, não seis blocos de markup copiados.
 * Mudar um preço é mudar um número aqui — e mais lado nenhum no site.
 *
 * Era uma grelha de seis caixas iguais, cada uma com o seu ícone e o seu botão
 * "Marcar" — lia-se como tabela de preços de template. Passou a carta de
 * barbearia: número, nome, descrição e preço numa linha, e um único botão para
 * a secção, porque a marcação é a mesma app seja qual for o serviço.
 */

$ras_servicos = array(
	array( 'Cabelo',                     '17', 'Corte masculino com atenção ao detalhe.' ),
	array( 'Cabelo + Barba',             '25', 'Corte de cabelo + serviço de barba com toalha quente incluída.' ),
	array( 'Barba',                      '11', 'Definição, contorno e cuidado para uma barba impecável.' ),
	array( 'Barbaterapia',               '21', 'Um serviço completo para o cuidado da barba. Conforto e experiência.' ),
	array( 'Sobrancelha à linha',        '9',  'Precisão e definição para completar o teu look.' ),
	array( 'Depilação nasal ou ouvidos', '5',  'Um acabamento rápido para completar o teu serviço.' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-900","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-900-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"align":"wide","className":"ras-rule","fontSize":"x-large"} -->
<h2 class="wp-block-heading alignwide ras-rule has-x-large-font-size">Os nossos <mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">serviços</mark></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:html -->
<ol class="ras-menu">
<?php foreach ( $ras_servicos as $ras_i => list( $ras_nome, $ras_preco, $ras_descricao ) ) : ?>
	<li class="ras-servico">
		<span class="ras-servico-n"><?php echo esc_html( sprintf( '%02d', $ras_i + 1 ) ); ?></span>
		<div class="ras-servico-txt">
			<h3><?php echo esc_html( $ras_nome ); ?></h3>
			<p><?php echo esc_html( $ras_descricao ); ?></p>
		</div>
		<span class="ras-price ras-servico-preco"><?php echo esc_html( $ras_preco ); ?>&euro;</span>
	</li>
<?php endforeach; ?>
</ol>
<!-- /wp:html --></div>
<!-- /wp:group -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons is-content-justification-center is-layout-flex"><!-- wp:button {"className":"is-icon-cal"} -->
<div class="wp-block-button is-icon-cal"><a class="wp-block-button__link wp-element-button" href="/marcar">Marcar</a></div>
<!-- /wp:button -->
<?php // Na propria pagina /servicos o botao apontaria para si mesmo. ?>
<?php if ( ! is_page( 'servicos' ) ) : ?>
<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/servicos">Ver todos os serviços</a></div>
<!-- /wp:button -->
<?php endif; ?></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
