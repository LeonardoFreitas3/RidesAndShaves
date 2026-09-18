<?php
/**
 * Rides and Shaves — child theme de Twenty Twenty-Five.
 *
 * ponytail: sem classes, sem autoloader, sem framework. Sao 4 hooks.
 */

defined( 'ABSPATH' ) || exit;

/**
 * URL de marcacao. As marcacoes vivem na AppBarber, nao neste site.
 * ponytail: constante e nao uma option porque so muda se trocarem de plataforma.
 * Se trocarem, e uma linha aqui em vez de um settings page que ninguem abre.
 */
define( 'RAS_BOOKING_URL', 'https://appbarber.com.br/download/prime?cod=7703178' );

add_action(
	'wp_enqueue_scripts',
	static function () {
		// ponytail: sem dependencia do handle do tema pai. Temas de blocos nao
		// registam um handle estavel, e uma dependencia inexistente faz o
		// wp_enqueue_style falhar em silencio — o CSS nunca carregava.
		wp_enqueue_style(
			'rides-and-shaves',
			get_stylesheet_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
);

add_action(
	'init',
	static function () {
		register_block_pattern_category(
			'rides-and-shaves',
			array( 'label' => 'Rides and Shaves' )
		);
	}
);

add_action(
	'after_setup_theme',
	static function () {
		add_theme_support( 'custom-logo' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
);

/**
 * Cria as paginas internas na ativacao do tema.
 *
 * O conteudo fica vazio de proposito: cada pagina e desenhada pelo template
 * page-{slug}.html, que puxa o pattern respetivo. A pagina so precisa de
 * existir para o WordPress ter onde aplicar o template.
 *
 * ponytail: idempotente pelo slug. Reativar o tema nao duplica nem apaga nada,
 * por isso nao precisa de flag de "ja corri isto".
 */
add_action(
	'after_switch_theme',
	static function () {
		$paginas = array(
			'servicos'  => 'Serviços',
			'lojas'     => 'Lojas',
			'sobre'     => 'Sobre',
			'contactos' => 'Contactos',
		);

		foreach ( $paginas as $slug => $titulo ) {
			if ( get_page_by_path( $slug ) ) {
				continue;
			}
			wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_name'    => $slug,
					'post_title'   => $titulo,
					'post_status'  => 'publish',
					'post_content' => '',
				)
			);
		}
	}
);

/**
 * Cartao de produto na marca. Usado na faixa da homepage e na pagina da loja.
 *
 * ponytail: existe porque os dois sitios mostram o mesmo cartao. Escrever o
 * markup uma vez e melhor do que lutar com o CSS do loop do WooCommerce em
 * cada um deles — que foi o que correu mal antes.
 *
 * @param WC_Product $produto Produto a mostrar.
 */
function ras_cartao_produto( $produto ) {
	if ( ! $produto instanceof WC_Product ) {
		return;
	}
	?>
	<li class="ras-produto">
		<a class="ras-produto-foto" href="<?php echo esc_url( $produto->get_permalink() ); ?>">
			<?php echo $produto->get_image( 'woocommerce_thumbnail' ); ?>
		</a>
		<a class="ras-produto-nome" href="<?php echo esc_url( $produto->get_permalink() ); ?>"><?php echo esc_html( $produto->get_name() ); ?></a>
		<span class="ras-price"><?php echo wp_kses_post( $produto->get_price_html() ); ?></span>
		<?php if ( $produto->is_purchasable() && $produto->is_in_stock() ) : ?>
			<a href="<?php echo esc_url( $produto->add_to_cart_url() ); ?>"
			   class="wp-element-button add_to_cart_button ajax_add_to_cart"
			   data-product_id="<?php echo esc_attr( $produto->get_id() ); ?>"
			   data-quantity="1"
			   rel="nofollow"><?php echo esc_html( $produto->add_to_cart_text() ); ?></a>
		<?php endif; ?>
	</li>
	<?php
}

/**
 * Poe o emblema como logotipo do site na ativacao.
 *
 * ponytail: sem isto o cabecalho fica sem logotipo ate alguem se lembrar de o
 * carregar a mao em Aparencia -> Editor. Corre uma vez e nao mexe se ja houver um.
 */
add_action(
	'after_switch_theme',
	static function () {
		if ( get_theme_mod( 'custom_logo' ) ) {
			return;
		}

		$ficheiro = get_stylesheet_directory() . '/assets/logo.png';
		if ( ! file_exists( $ficheiro ) ) {
			return;
		}

		require_once ABSPATH . 'wp-admin/includes/image.php';

		$carregado = wp_upload_bits( 'rides-and-shaves-logo.png', null, file_get_contents( $ficheiro ) );
		if ( ! empty( $carregado['error'] ) ) {
			return;
		}

		$id = wp_insert_attachment(
			array(
				'post_mime_type' => 'image/png',
				'post_title'     => 'Rides and Shaves',
				'post_status'    => 'inherit',
			),
			$carregado['file']
		);

		if ( ! is_wp_error( $id ) ) {
			wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $carregado['file'] ) );
			set_theme_mod( 'custom_logo', $id );
		}
	}
);

/**
 * Substitui [ras_booking] pelo URL de marcacao, para os botoes do editor
 * nao terem o link hardcoded em sete sitios.
 */
add_shortcode(
	'ras_booking',
	static function () {
		return esc_url( RAS_BOOKING_URL );
	}
);

/**
 * Os botoes "MARCAR" nos templates apontam para /marcar. Redireciona para a app.
 * ponytail: um redirect em vez de uma landing page que nao acrescenta nada.
 * Se um dia quiserem marcacao no proprio site, esta funcao morre e nasce uma pagina.
 */
add_action(
	'template_redirect',
	static function () {
		$ras_caminho = untrailingslashit( strtok( $_SERVER['REQUEST_URI'] ?? '', '?' ) );

		if ( '/marcar' === $ras_caminho || is_page( 'marcar' ) ) {
			wp_redirect( RAS_BOOKING_URL, 302, 'Rides and Shaves' );
			exit;
		}

		// A pagina da loja do WooCommerce pode ter qualquer slug (shop, loja,
		// produtos...). O menu aponta sempre para /loja e este redirect leva-o
		// ao sitio certo. Sem isto o WordPress "adivinhava" e mandava /loja
		// para /lojas, que e a pagina das localizacoes.
		if ( '/loja' === $ras_caminho && function_exists( 'wc_get_page_permalink' ) ) {
			$ras_loja = wc_get_page_permalink( 'shop' );
			if ( $ras_loja ) {
				wp_safe_redirect( $ras_loja, 302 );
				exit;
			}
		}
	},
	// Prioridade 5: o redirect canonico do WordPress corre a 10 e apanhava o
	// /loja primeiro.
	5
);

/**
 * Poe as fotografias reais nos quatro produtos da loja.
 *
 * Trocar os ficheiros em assets/img nao chega: na importacao do CSV o
 * WooCommerce copiou as imagens para a Biblioteca de Media e e a essa copia que
 * cada produto aponta. Quem tem de mudar e o anexo do produto, nao o tema.
 *
 * Corre uma vez, no primeiro admin_init depois de instalar esta versao, e fica
 * marcado numa option. Nao mexe em produtos onde ja tenhas posto uma imagem
 * tua: so substitui se a atual ainda for uma das minhas (nome produto-N).
 *
 * Os titulos vao junto porque as fotos sao dos produtos reais e os nomes que eu
 * tinha inventado a partir do mockup contradiziam os rotulos — um frasco de
 * STYLING POWDER debaixo de "Champo para Barba" e um erro a vista do cliente.
 * Os precos ficam como estao: esses so tu os sabes.
 *
 * ponytail: uma option com a versao em vez de uma tabela de migracoes. Quando
 * esta rotina deixar de ser precisa, apaga-se a funcao e a option.
 */
add_action(
	'admin_init',
	static function () {
		$ras_marca = 'fotos-3.4';

		if ( get_option( 'ras_produtos' ) === $ras_marca || ! function_exists( 'wc_get_product_id_by_sku' ) ) {
			return;
		}

		// Marcar antes de trabalhar: se alguma coisa rebentar a meio, nao fica a
		// tentar outra vez em cada pedido do backoffice.
		update_option( 'ras_produtos', $ras_marca );

		require_once ABSPATH . 'wp-admin/includes/image.php';

		$ras_mapa = array(
			'RS-POM-100' => array( 'produto-1', 'Pomada Matte' ),
			'RS-OLE-30'  => array( 'produto-2', 'Bálsamo para Barba' ),
			'RS-CHA-200' => array( 'produto-3', 'Pó Texturizador' ),
			'RS-KIT-01'  => array( 'produto-4', 'Pomada' ),
		);

		foreach ( $ras_mapa as $ras_sku => list( $ras_ficheiro, $ras_titulo ) ) {
			$ras_id = wc_get_product_id_by_sku( $ras_sku );
			if ( ! $ras_id ) {
				continue;
			}

			$ras_atual = get_post_thumbnail_id( $ras_id );
			if ( $ras_atual ) {
				$ras_nome = basename( get_attached_file( $ras_atual ) );
				// Imagem posta por ti: fica como esta.
				if ( 0 !== strpos( $ras_nome, 'produto-' ) ) {
					continue;
				}
			}

			$ras_origem = get_stylesheet_directory() . "/assets/img/$ras_ficheiro.jpg";
			if ( ! file_exists( $ras_origem ) ) {
				continue;
			}

			$ras_carregado = wp_upload_bits(
				"$ras_ficheiro-" . wp_get_theme()->get( 'Version' ) . '.jpg',
				null,
				file_get_contents( $ras_origem ) // phpcs:ignore WordPress.WP.AlternativeFunctions
			);
			if ( ! empty( $ras_carregado['error'] ) ) {
				continue;
			}

			$ras_anexo = wp_insert_attachment(
				array(
					'post_mime_type' => 'image/jpeg',
					'post_title'     => $ras_titulo,
					'post_status'    => 'inherit',
				),
				$ras_carregado['file'],
				$ras_id
			);

			if ( is_wp_error( $ras_anexo ) ) {
				continue;
			}

			wp_update_attachment_metadata( $ras_anexo, wp_generate_attachment_metadata( $ras_anexo, $ras_carregado['file'] ) );
			set_post_thumbnail( $ras_id, $ras_anexo );

			wp_update_post(
				array(
					'ID'         => $ras_id,
					'post_title' => $ras_titulo,
				)
			);
		}
	}
);

/**
 * O WooCommerce deixa de aparar as fotos de produto.
 *
 * Por omissao o tamanho "thumbnail" do catalogo e cortado a 1:1: uma foto
 * vertical perdia o topo e o fundo. Com crop a 0, cada tamanho e gerado na
 * proporcao original e nada se perde.
 *
 * ponytail: um filtro em vez de pedir para mexer em Personalizar -> WooCommerce
 * -> Imagens de produto. Assim vale para quem instalar o tema, sem instrucoes.
 */
add_filter(
	'woocommerce_get_image_size_thumbnail',
	static function ( $tamanho ) {
		$tamanho['height'] = '';
		$tamanho['crop']   = 0;
		return $tamanho;
	}
);
