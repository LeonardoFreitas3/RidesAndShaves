<?php
/**
 * Title: Testemunho em vídeo
 * Slug: rides-and-shaves/testemunho
 * Categories: rides-and-shaves
 * Description: O filme da casa, com play manual.
 *
 * O ficheiro vem no tema, em assets/video, para a seccao funcionar mal se
 * instale, sem mais nenhum passo.
 *
 * Se um dia o quiseres fora do tema — para o zip voltar a ser leve, ou para
 * trocar o filme sem me pedires nada —, carrega-o em Media -> Adicionar novo
 * com o nome testemunho.mp4. O WordPress da-lhe o slug "testemunho", esta
 * seccao passa a preferir esse e o ficheiro do tema deixa de ser usado.
 *
 * ponytail: a Biblioteca de Media primeiro, o tema como recurso. Duas linhas,
 * e nao ha nada para configurar em nenhum dos casos.
 */

$ras_uri   = get_stylesheet_directory_uri();
$ras_v     = wp_get_theme()->get( 'Version' );
$ras_video = get_page_by_path( 'testemunho', OBJECT, 'attachment' );
$ras_src   = $ras_video ? wp_get_attachment_url( $ras_video->ID ) : '';

if ( ! $ras_src ) {
	$ras_src = file_exists( get_stylesheet_directory() . '/assets/video/testemunho.mp4' )
		? "$ras_uri/assets/video/testemunho.mp4?v=$ras_v"
		: '';
}

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
