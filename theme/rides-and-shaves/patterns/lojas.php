<?php
/**
 * Title: Lojas
 * Slug: rides-and-shaves/lojas
 * Categories: rides-and-shaves
 * Description: As duas localizações em Braga, com foto, morada, mapa e marcação.
 */

$ras_uri = get_stylesheet_directory_uri();

$ras_lojas = array(
	array(
		'nome'   => 'Nogueiró',
		'foto'   => 'loja-nogueiro',
		'morada' => 'Rua Amândio César, N.º 7',
		'cp'     => '4715-404 Braga',
		'geo'    => '41.5514457,-8.3959997',
	),
	array(
		'nome'   => 'Lamaçães',
		'foto'   => 'loja-lamacaes',
		'morada' => 'Rua Ambrósio dos Santos, N.º 57',
		'cp'     => '4715-213 Braga',
		'geo'    => '41.5451116,-8.4015592',
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-950","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-green-950-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">Duas localizações.<br><mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">A mesma experiência.</mark></h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph -->
<p>Encontra a Rides and Shaves em Braga. Duas localizações, a mesma identidade, o mesmo cuidado e a mesma paixão pela barbearia.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
<?php foreach ( $ras_lojas as $loja ) : ?>
<!-- wp:column {"className":"ras-place"} -->
<div class="wp-block-column ras-place"><!-- wp:image -->
<figure class="wp-block-image"><img src="<?php echo esc_url( "$ras_uri/assets/img/{$loja['foto']}.jpg" ); ?>" alt="<?php echo esc_attr( "Rides and Shaves {$loja['nome']}" ); ?>"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"ras-place-body","layout":{"type":"constrained"}} -->
<div class="wp-block-group ras-place-body"><!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size"><?php echo esc_html( $loja['nome'] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:html -->
<p class="ras-morada"><span class="ras-ico ras-ico-pin" aria-hidden="true"></span><span><?php echo esc_html( $loja['morada'] ); ?><br><?php echo esc_html( $loja['cp'] ); ?></span></p>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Seg–Sex 10:00–20:00 · Sáb 09:00–19:00 · Dom fechado</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline is-icon-pin"} -->
<div class="wp-block-button is-style-outline is-icon-pin"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( 'https://www.google.com/maps/search/?api=1&query=' . $loja['geo'] ); ?>" target="_blank" rel="noreferrer noopener">Ver no mapa</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-icon-cal"} -->
<div class="wp-block-button is-icon-cal"><a class="wp-block-button__link wp-element-button" href="/marcar">Marcar</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
<?php endforeach; ?>
</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
