<?php
/**
 * Title: Shop
 * Slug: rides-and-shaves/shop
 * Categories: rides-and-shaves
 * Description: Faixa da loja com quatro produtos e adicionar ao carrinho.
 *
 * ponytail: os produtos sao percorridos aqui em vez de se chamar o shortcode
 * [products]. O shortcode dependia de o WooCommerce o ter registado no momento
 * certo — em modo "Em breve" nao registava e o [products] saia como texto cru na
 * pagina. Um foreach nao tem esse problema, e o cartao fica igual ao mockup sem
 * lutar com o CSS do loop do Woo.
 *
 * O botao leva as classes do editor (wp-element-button), por isso herda o estilo
 * do theme.json de graca, e as do Woo (ajax_add_to_cart) para o carrinho
 * funcionar sem recarregar. Sem JS, o href continua a funcionar.
 */

$ras_uri = get_stylesheet_directory_uri();

// Link direto para a loja, sem passar pelo redirect.
$ras_url_loja = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '/loja';

$ras_produtos = function_exists( 'wc_get_products' )
	? wc_get_products(
		array(
			'limit'   => 4,
			'status'  => 'publish',
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	)
	: array();

// Enquanto nao houver produtos, uma montra estatica para a faixa nao ficar vazia.
$ras_montra = array(
	array( 'produto-1', 'Pomada Matte',      '16,90' ),
	array( 'produto-2', 'Óleo para Barba',   '16,90' ),
	array( 'produto-3', 'Champô para Barba', '14,90' ),
	array( 'produto-4', 'Kit Viagem',        '29,90' ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-900","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-900-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"24%"} -->
<div class="wp-block-column" style="flex-basis:24%"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Rides and Shaves<br><mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">Shop</mark></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Os produtos que usamos e recomendamos na barbearia, disponíveis para ti. Cabelo, barba e grooming masculino.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-icon-cart"} -->
<div class="wp-block-button is-icon-cart"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $ras_url_loja ); ?>">Explorar shop</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"76%"} -->
<div class="wp-block-column" style="flex-basis:76%"><!-- wp:html -->
<ul class="ras-montra">
<?php if ( $ras_produtos ) : ?>
	<?php foreach ( $ras_produtos as $ras_p ) : ?>
		<?php ras_cartao_produto( $ras_p ); ?>
	<?php endforeach; ?>
<?php else : ?>
	<?php foreach ( $ras_montra as list( $ras_img, $ras_nome, $ras_preco ) ) : ?>
	<li class="ras-produto">
		<a class="ras-produto-foto" href="<?php echo esc_url( $ras_url_loja ); ?>"><img src="<?php echo esc_url( "$ras_uri/assets/img/$ras_img.jpg" ); ?>" alt="<?php echo esc_attr( $ras_nome ); ?>"></a>
		<a class="ras-produto-nome" href="<?php echo esc_url( $ras_url_loja ); ?>"><?php echo esc_html( $ras_nome ); ?></a>
		<span class="ras-price"><?php echo esc_html( $ras_preco ); ?>&euro;</span>
	</li>
	<?php endforeach; ?>
<?php endif; ?>
</ul>
<!-- /wp:html --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
