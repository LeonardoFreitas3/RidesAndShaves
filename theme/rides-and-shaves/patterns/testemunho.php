<?php
/**
 * Title: Testemunho em vídeo
 * Slug: rides-and-shaves/testemunho
 * Categories: rides-and-shaves
 * Description: O filme da casa, com play manual.
 *
 * O ficheiro nao viaja no tema: sao 16 MB e ficariam em cada zip que se envia,
 * para o servidor guardar a mesma coisa vezes sem conta. Vive na Biblioteca de
 * Media e esta seccao vai la buscá-lo pelo slug.
 *
 * Carregar em Media -> Adicionar novo o ficheiro com o nome testemunho.mp4. O
 * WordPress da-lhe o slug "testemunho" e a seccao aparece sozinha. Enquanto nao
 * existir, nao se imprime nada — a pagina nao fica com um buraco nem um erro.
 *
 * ponytail: procurar pelo slug em vez de guardar um ID numa option. Sem ecra de
 * definicoes, sem constante para editar a mao, sem nada para configurar.
 */

$ras_uri   = get_stylesheet_directory_uri();
$ras_v     = wp_get_theme()->get( 'Version' );
$ras_video = get_page_by_path( 'testemunho', OBJECT, 'attachment' );

if ( ! $ras_video ) {
	return;
}

$ras_src = wp_get_attachment_url( $ras_video->ID );
if ( ! $ras_src ) {
	return;
}
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"green-950","textColor":"cream","layout":{"type":"constrained","wideSize":"1280px"}} -->
<div class="wp-block-group alignfull has-cream-color has-green-950-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"align":"wide","className":"ras-rule","fontSize":"x-large"} -->
<h2 class="wp-block-heading alignwide ras-rule has-x-large-font-size">A nossa <mark style="background-color:rgba(0,0,0,0)" class="has-inline-color has-gold-color">história</mark></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"wide","fontSize":"small"} -->
<p class="has-text-align-wide has-small-font-size">Como começou a Rides and Shaves, contado por quem a construiu.</p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<video class="ras-filme"
       controls
       preload="none"
       playsinline
       poster="<?php echo esc_url( "$ras_uri/assets/img/testemunho.jpg?v=$ras_v" ); ?>"
       src="<?php echo esc_url( $ras_src ); ?>"></video>
<!-- /wp:html --></div>
<!-- /wp:group -->
