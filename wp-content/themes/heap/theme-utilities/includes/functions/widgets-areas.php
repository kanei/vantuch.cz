<?php
/*
 * Register Widgets areas.
 */

function wpgrade_register_sidebars() {

	register_sidebar( array(
			'id'            => 'sidebar-main',
			'name'          => __( 'Main Sidebar', 'heap_txtd' ),
			'description'   => __( 'Main Sidebar', 'heap_txtd' ),
			'before_title'  => '<h3 class="widget__title widget--sidebar-blog__title">',
			'after_title'   => '</h3>',
			'before_widget' => '<div id="%1$s" class="widget widget--sidebar-blog %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar( array(
			'id'            => 'sidebar-footer',
			'name'          => __( 'Footer Area', 'heap_txtd' ),
			'description'   => __( 'Footer Area', 'heap_txtd' ),
			'before_title'  => '<h4 class="widget__title widget--menu__title">',
			'after_title'   => '</h4>',
			'before_widget' => '<div id="%1$s" class="widget widget--menu %2$s">',
			'after_widget'  => '</div>',
		)
	);

	//allow the Text Widgets to handle shortcodes
	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter('widget_text', 'do_shortcode');

}
add_action('widgets_init', 'wpgrade_register_sidebars');

/*
 * Display the tag cloud
 */
function custom_tag_cloud_widget($args)
{
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 19; //largest tag
	$args['smallest'] = 19; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
//add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );