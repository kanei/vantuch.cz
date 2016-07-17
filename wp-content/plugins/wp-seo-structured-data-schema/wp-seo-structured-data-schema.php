<?php
/**
 *Plugin Name: WP SEO Structured Data Schema
 * Plugin URI: http://kcseopro.com/
 * Description: Comprehensive JSON-LD based Structured Data solution for WordPress for adding schema for organizations, businesses, blog posts, ratings & more.
 * Version: 1.2
 * Author: kcseopro
 * Author URI: http://kcseopro.com/
 * License: A "Slug" license name e.g. GPL2
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define('KCSEO_WP_SCHEMA_SLUG', 'wp-seo-structured-data-schema');
define('KCSEO_WP_SCHEMA_PATH', dirname(__FILE__));
define('KCSEO_WP_SCHEMA_URL', plugins_url('', __FILE__));
define('KCSEO_WP_SCHEMA_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages');

require ('lib/init.php');
