<?php
/**
 * Cubic functions and definitions
 *
 * @package Cubic
 */

/**
 * WooComerce integration
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'cubic_before_main_content', 10);
add_action('woocommerce_after_main_content', 'cubic_after_main_content', 10);

add_action('woocommerce_before_single_product', 'cubic_before_single_product', 10);
add_action('woocommerce_after_single_product', 'cubic_after_single_product', 10);

add_action('after_setup_theme', 'cubic_woocommerce_support' );

add_action('init', 'cubic_remove_wc_breadcrumbs' );

add_filter('woocommerce_show_page_title', 'cubic_hide_page_title' );

function cubic_before_main_content() {
	echo '<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">';
}

function cubic_after_main_content() {
	echo '	</main><!-- #main -->
	</div><!-- #primary -->';
}

function cubic_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

function cubic_before_single_product() {
  echo '<div class="entry-content">';
}

function cubic_after_single_product() {
  echo '</div>';
}

function cubic_remove_wc_breadcrumbs() {
  remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

function cubic_hide_page_title() {
  return false;
}

/* Product loop */

add_action('woocommerce_before_shop_loop_item', 'cubic_before_shop_loop_item', 10);
add_action('woocommerce_after_shop_loop_item', 'cubic_after_shop_loop_item', 10);

function cubic_before_shop_loop_item() {
//  echo '<div class="entry-thumbnail">';
}

function cubic_after_shop_loop_item() {
//  echo '</div>';
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cubic_setup() {

	/*
	 * Declare textdomain for this child theme.
	 */
	load_child_theme_textdomain( 'cubic', get_stylesheet_directory() . '/languages' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_image_size( 'boardwalk-featured-image', 980, 980, true );

}
add_action( 'after_setup_theme', 'cubic_setup', 11 );

/**
 * Register Montserrat font.
 *
 * @return string
 */
function cubic_montserrat_font_url() {
	$montserrat_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Montserrat, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'cubic' ) ) {
		$query_args = array(
			'family' => urlencode( 'Montserrat:400,700' ),
		);

		$montserrat_font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $montserrat_font_url;
}

/**
 * Register Playfair Display font.
 *
 * @return string
 */
function cubic_playfair_display_font_url() {
	$playfair_display_font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Playfair Display, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'cubic' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Playfair Display character subset specific to your language, translate this to 'cyrillic'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Playfair Display font: add new subset (cyrillic)', 'cubic' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic-ext,cyrillic';
		}

		$query_args = array(
			'family' => urlencode( 'Playfair Display:400,700,400italic,700italic' ),
			'subset' => urlencode( $subsets ),
		);

		$playfair_display_font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $playfair_display_font_url;
}

/**
 * Enqueue scripts and styles.
 */
function cubic_scripts() {
	/* Dequeue*/
	wp_dequeue_style( 'boardwalk-lato-merriweather' );

	wp_dequeue_style( 'boardwalk-style' );

	if ( ( is_search() && have_posts() ) || is_archive() || is_home() ) {
		wp_dequeue_script( 'boardwalk-mousewheel' );
	}

	wp_dequeue_script( 'boardwalk-script' );

	/* Enqueue */
	wp_enqueue_style( 'cubic-montserrat', cubic_montserrat_font_url(), array(), null );

	wp_enqueue_style( 'cubic-playfair-display', cubic_playfair_display_font_url(), array(), null );

	wp_enqueue_style( 'cubic-parent-style', get_template_directory_uri() . '/style.css' );

	if ( is_rtl() ) {
		wp_enqueue_style( 'cubic-parent-style-rtl', get_template_directory_uri() . '/rtl.css', array( 'cubic-parent-style' ) );
	}

    wp_enqueue_style( 'cubic-style', get_stylesheet_uri(), array( 'cubic-parent-style' ) );

    if ( ( is_search() && have_posts() ) || is_archive() || is_home() ) {
		wp_enqueue_script( 'cubic-hentry', get_stylesheet_directory_uri() . '/js/hentry.js', array( 'jquery' ), '20150113', true );
	}

	wp_enqueue_script( 'cubic-script', get_stylesheet_directory_uri() . '/js/cubic.js', array( 'jquery' ), '20150113', true );
}
add_action( 'wp_enqueue_scripts', 'cubic_scripts', 11 );

/**
 * Load Jetpack compatibility file.
 */
require get_stylesheet_directory() . '/inc/jetpack.php';
