<?php
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_editor_style( 'style.css' );
	register_nav_menus( array( 'primary' => 'Primary navigation', 'footer' => 'Footer navigation' ) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$version = wp_get_theme()->get( 'Version' );

	if ( 'local' !== wp_get_environment_type() ) {
		wp_enqueue_style(
			'mazimpex-fonts',
			'https://fonts.googleapis.com/css2?family=Archivo:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
			array(),
			null
		);
	}

	wp_enqueue_style( 'mazimpex', get_stylesheet_uri(), array(), $version );
	wp_enqueue_script( 'mazimpex-navigation', get_theme_file_uri( 'navigation.js' ), array(), $version, true );
	wp_enqueue_script( 'mazimpex-particles', get_theme_file_uri( 'particles.js' ), array(), $version, true );

	$icons = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css';
	if ( 'local' === wp_get_environment_type() ) {
		$icons = get_theme_file_uri( 'assets/vendor/fontawesome/css/all.min.css' );
	}
	wp_enqueue_style( 'mazimpex-font-awesome', $icons, array(), '6.7.2' );
} );

add_action( 'after_setup_theme', function () {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	add_action( 'woocommerce_before_main_content', function () {
		$classes = array( 'wrap', 'entry', 'maz-catalogue-main' );
		if ( function_exists( 'is_product' ) && is_product() ) {
			$classes[] = 'maz-catalogue-product';
		} elseif ( function_exists( 'is_product_taxonomy' ) && ( is_product_taxonomy() || is_shop() ) ) {
			$classes[] = 'maz-catalogue-archive-main';
		}
		printf( '<main id="main" class="%s">', esc_attr( implode( ' ', $classes ) ) );
	}, 10 );
	add_action( 'woocommerce_after_main_content', function () {
		if ( function_exists( 'maz_category_details' ) ) {
			maz_category_details();
		}
		echo '</main>';
	}, 10 );
} );

add_filter( 'loop_shop_columns', function (): int {
	return 4;
}, 20 );

add_filter( 'woocommerce_output_related_products_args', function ( array $args ): array {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}, 20 );

add_filter( 'body_class', function ( array $classes ): array {
	$classes[] = 'maz-theme-v3';

	if ( maz_theme_page_has_hero() ) {
		$classes[] = 'maz-has-hero';
	}

	if ( function_exists( 'is_product_taxonomy' ) && ( is_product_taxonomy() || is_shop() ) ) {
		$classes[] = 'maz-catalogue-archive';
	}

	if ( function_exists( 'is_product' ) && is_product() ) {
		$classes[] = 'maz-single-product';
	}

	return $classes;
} );

add_action( 'wp_print_styles', function () {
	// Elementor Free can enqueue its FA5 family handles at render time.
	foreach ( array( 'solid', 'regular', 'brands' ) as $family ) {
		$handle = 'elementor-icons-fa-' . $family;
		if ( wp_style_is( $handle, 'registered' ) ) {
			wp_deregister_style( $handle );
			wp_register_style( $handle, false, array( 'mazimpex-font-awesome' ), '6.7.2' );
		}
	}
} );

add_action( 'wp_body_open', function () {
	echo '<canvas class="maz-particles" aria-hidden="true"></canvas>';
} );

add_action( 'wp_head', function () {
	if ( ! has_site_icon() ) {
		printf( '<link rel="icon" href="%s" sizes="64x64" type="image/png">', esc_url( get_theme_file_uri( 'assets/brand/favicon.png' ) ) );
	}
} );

function maz_theme_page_has_hero(): bool {
	if ( is_front_page() ) {
		return true;
	}

	if ( is_singular( 'page' ) ) {
		$page_id = get_queried_object_id();
		if ( $page_id && function_exists( 'maz_has_marketing_layout' ) && maz_has_marketing_layout( $page_id ) ) {
			$raw = (string) get_post_meta( $page_id, '_elementor_data', true );
			if ( false !== strpos( $raw, 'maz-hero' ) ) {
				return true;
			}
		}
	}

	return false;
}

function maz_theme_divisions(): array {
	$divisions = array(
		array(
			'slug'        => 'combat-sports-equipment',
			'name'        => 'Combat Sports Equipment',
			'summary'     => 'Boxing gloves, MMA and Muay Thai protective gear, focus mitts, Thai pads and martial arts training equipment.',
			'short_label' => 'Equipment',
		),
		array(
			'slug'        => 'combat-sportswear',
			'name'        => 'Combat Sportswear',
			'summary'     => 'BJJ gis, martial arts uniforms, rash guards, fight shorts, grappling spats and boxing apparel.',
			'short_label' => 'Combat wear',
		),
		array(
			'slug'        => 'team-sportswear',
			'name'        => 'Team Sportswear',
			'summary'     => 'Sublimated and cut-and-sew football, rugby, cricket, basketball, hockey and club team uniforms.',
			'short_label' => 'Teamwear',
		),
		array(
			'slug'        => 'custom-clothing-activewear',
			'name'        => 'Custom Clothing & Activewear',
			'summary'     => 'Private-label hoodies, tracksuits, gym wear, compression garments, streetwear and corporate apparel.',
			'short_label' => 'Custom clothing',
		),
	);

	foreach ( $divisions as &$division ) {
		$url = home_url( '/product-category/' . $division['slug'] . '/' );
		if ( taxonomy_exists( 'product_cat' ) ) {
			$term_link = get_term_link( $division['slug'], 'product_cat' );
			if ( ! is_wp_error( $term_link ) && is_string( $term_link ) ) {
				$url = $term_link;
			}
		}
		$division['url'] = $url;
	}
	unset( $division );

	return $divisions;
}

function maz_theme_wordmark(): void {
	printf(
		'<a class="wordmark" href="%s"><img src="%s" width="560" height="100" alt="MAZ IMPEX"></a>',
		esc_url( home_url( '/' ) ),
		esc_url( get_theme_file_uri( 'assets/brand/maz-logo-header.webp' ) )
	);
}
