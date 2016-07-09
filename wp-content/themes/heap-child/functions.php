<?php
/**
 * If you would like to overwrite the css of the theme you will need to uncomment this action
 */

add_action('wp_enqueue_scripts', 'load_child_theme_styles', 999);

function load_child_theme_styles(){

    // If your css changes are minimal we recommend you to put them in the main style.css.
    // In this case uncomment bellow

    wp_enqueue_style( 'child-theme-style', get_stylesheet_directory_uri() . '/style.css' );

    // If you want to create your own file.css you will need to load it like this (Don't forget to uncomment bellow) :
    //** wp_enqueue_style( 'custom-child-theme-style', get_stylesheet_directory_uri() . '/file.css' );
}