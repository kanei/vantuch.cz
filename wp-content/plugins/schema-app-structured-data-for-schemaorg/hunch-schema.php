<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/*
 * Plugin Name: Schema App Structured Data
 * Plugin URI: http://www.schemaapp.com
 * Description: This plugin adds http://schema.org structured data to your website
 * Version: 1.5.1
 * Author: Hunch Manifest
 * Author URI: https://www.hunchmanifest.com
 */

require_once plugin_dir_path(__FILE__) . '/lib/classmap.php';

if (is_admin()) {
    // Settings -> Schema App
    $HunchSchemaSettings = new SchemaSettings();
    // Page & Post Editor
    $HunchSchemaEditor = new SchemaEditor();
    add_action('load-post.php', array($HunchSchemaEditor, 'hunch_schema_edit'));
    add_action('load-post-new.php', array($HunchSchemaEditor, 'hunch_schema_edit'));

} else {

	add_action( 'init', 'HunchSchemaInit' );

	function HunchSchemaInit()
	{
		if ( isset( $_GET['Action'], $_GET['URL'] ) && $_GET['Action'] == 'HSDeleteMarkupCache' )
		{
			delete_transient( 'HunchSchema-Markup-' . md5( $_GET['URL'] ) );

			header( 'HTTP/1.0 202 Accepted', true, 202 );

			exit;
		}
	}


    $HunchSchemaFront = new SchemaFront();

    add_action('wp_head', array($HunchSchemaFront, 'hunch_schema_add'));

	if ( ! empty( $HunchSchemaFront->Settings['ToolbarShowTestSchema'] ) )
	{
		add_action( 'admin_bar_menu', array( $HunchSchemaFront, 'AdminBarMenu' ), 999 );
	}


	if ( function_exists( 'genesis' ) )
	{
		add_action('genesis_setup', 'schema_app_genesis_override', 15); // Priority 15 ensures it runs after Genesis itself has setup.
		
		function schema_app_genesis_override() {
			
			$overrides = get_option( 'schema_option_name_genesis' );
			
			if ( $overrides ) {
				// Loop through activated overrides 
				foreach( $overrides AS $key => $value ) {
					$genesisFilter = 'genesis_attr_' . $key;
					add_filter($genesisFilter, 'schema_app_genesis_remove', 20);
				}
			}
			
		}
		
		// Sets schema.org microdata to empty
		function schema_app_genesis_remove($attributes) {
			$attributes['itemtype'] = "";
			$attributes['itemprop'] = "";
			$attributes['itemscope'] = "";
			return $attributes;
		}
	}

}