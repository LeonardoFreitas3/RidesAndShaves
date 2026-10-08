/* Movimento do site: entrada por scroll.
 *
 * ponytail: IntersectionObserver e pouco mais. Sem biblioteca de animacao —
 * o que mexe esta no CSS (seccao "Movimento" do style.css), isto so poe a
 * classe is-in quando o elemento entra no ecra. Carrega no <head>, sem defer,
 * para a classe ras-js existir antes do primeiro paint: sem ela o CSS nao
 * esconde nada, por isso sem JavaScript o site aparece inteiro.
 */
document.documentElement.classList.add( 'ras-js' );

document.addEventListener( 'DOMContentLoaded', function () {
	// A mesma lista da seccao "Movimento" do style.css: mudar num e mudar no outro.
	var alvos = document.querySelectorAll(
		'main h2, .ras-servico, .ras-place, .ras-produto, .ras-card, .ras-filme, .ras-menu + .wp-block-buttons'
	);

	var olho = new IntersectionObserver( function ( entradas ) {
		entradas.forEach( function ( e ) {
			if ( ! e.isIntersecting ) {
				return;
			}
			e.target.classList.add( 'is-in' );
			olho.unobserve( e.target );
		} );
	}, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 } );

	alvos.forEach( function ( el ) {
		// Irmaos entram em cascata: o atraso e a posicao entre os irmaos.
		var i = Array.prototype.indexOf.call( el.parentNode.children, el );
		el.style.setProperty( '--ras-i', Math.min( i, 7 ) );
		olho.observe( el );
	} );
} );
