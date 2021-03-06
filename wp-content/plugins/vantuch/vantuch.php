<?php
/*
 Plugin Name: Vantuch
 Description: Plugin for the vantuch.cz blog page.
 Author: mvantuch
 Version: 0.0.3
 Author URI: http://vantuch.cz/
*/

if ( ! defined( 'VANTUCH_VER' ) ) {
	define( 'VANTUCH_VER', '0.1.0' );
}

class Vantuch {

	/**
	 * Static property to hold our singleton instance
	 *
	 */
	static $instance = FALSE;

	/**
	 * Vantuch constructor.
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );

        add_filter( 'wc_product_sku_enabled', '__return_false' );

        add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ) );
	}

	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * retuns it.
	 *
	 * @return Vantuch
	 */
	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}


	public function front_scripts() {
		wp_enqueue_script( 'vantuch', plugins_url( 'js/vantuch.js', __FILE__ ), array(), VANTUCH_VER );
//		wp_enqueue_script( 'vantuch', plugins_url( 'js/jquery.swipebox.min.js', __FILE__ ), array(), VANTUCH_VER );
		wp_enqueue_style( 'vantuch', plugins_url( 'css/vantuch.css', __FILE__ ), array(), VANTUCH_VER );
//		wp_enqueue_style( 'vantuch', plugins_url( 'css/swipebox.min.css', __FILE__ ), array(), VANTUCH_VER );
	}
}

// Instantiate our class
$vantuch = Vantuch::getInstance();