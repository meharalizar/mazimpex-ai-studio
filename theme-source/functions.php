<?php
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_editor_style( 'style.css' );
	register_nav_menus( array( 'primary' => 'Primary navigation', 'footer' => 'Footer navigation' ) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$version = wp_get_theme()->get( 'Version' );
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
		echo '<main id="main" class="wrap entry">';
	}, 10 );
	add_action( 'woocommerce_after_main_content', function () {
		if ( function_exists( 'maz_category_details' ) ) {
			maz_category_details();
		}
		echo '</main>';
	}, 10 );
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

function maz_theme_wordmark(): void {
	printf( '<a class="wordmark" href="%s"><img src="%s" width="560" height="100" alt="MAZ IMPEX"></a>',
		esc_url( home_url( '/' ) ), esc_url( get_theme_file_uri( 'assets/brand/maz-logo-header.webp' ) ) );
}
