<?php

$sections = array();
$debug    = '';

if ( isset( $_GET['debug_mod'] ) && $_GET['debug_mod'] === 'true' ) {
	$debug = 'debug_on';
}

// General Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'       => 'icon-database-1',
	'icon_class' => '',
	'title'      => __( 'General', 'heap_txtd' ),
	'desc'       => sprintf( '<p class="description">' . __( 'General settings contains options that have a site-wide reach like defining your site dynamics or branding (including logo and other icons).', 'heap_txtd' ) . '</p>', wpgrade::themename() ),
	'fields'     => array(
		array(
			'id'       => 'use_smooth_scroll',
			'type'     => 'switch',
			'title'    => __( 'Smooth Scrolling', 'heap_txtd' ),
			'subtitle' => __( 'Enable / Disable smooth scrolling.', 'heap_txtd' ),
			'default'  => '1'
		),
		array(
			'id'   => 'branding-header-90821',
			'desc' => '<h3>' . __( 'Branding', 'heap_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'       => 'main_logo',
			'type'     => 'media',
			'title'    => __( 'Main Logo', 'heap_txtd' ),
			'hint'     => array( 'content' => __( 'If there is no image uploaded, plain text will be used instead (generated from the site\'s name).', 'heap_txtd' ) ),
			'subtitle' => __( 'Choose an image for the header logo.', 'heap_txtd' ),
		),
		array(
			'id'       => 'use_retina_logo',
			'type'     => 'switch',
			'title'    => __( '2x Retina Logo', 'heap_txtd' ),
			'subtitle' => __( 'To be Retina-ready you need to add a 2x size logo image.', 'heap_txtd' ),
		),
		array(
			'id'       => 'retina_main_logo',
			'type'     => 'media',
			'title'    => '', //__( '', 'heap_txtd' ),
			'subtitle' => __( 'Choose a @2x logo image to be used for High-Density Retina Displays', 'heap_txtd' ),
			'required' => array( 'use_retina_logo', 'equals', 1 ),
			'class'    => ' js-class-hook mt-2'
		),
		array(
			'id'    => 'favicon',
			'type'  => 'media',
			'title' => __( 'Favicon', 'heap_txtd' ),
			'class' => 'image--small js-class-hook',
			'hint'  => array( 'content' => __( 'Upload a 16 x 16px image that will be used as a favicon.', 'heap_txtd' ) ),
		),
		array(
			'id'    => 'apple_touch_icon',
			'type'  => 'media',
			'title' => __( 'Apple Touch Icon', 'heap_txtd' ),
			'class' => 'image--small js-class-hook',
			'hint'  => array( 'content' => __( 'You can customize the icon for the Apple touch shortcut to your website. The size of this icon must be 77x77px.', 'heap_txtd' ) ),
		),
		array(
			'id'    => 'metro_icon',
			'type'  => 'media',
			'title' => __( 'Metro Icon', 'heap_txtd' ),
			'class' => 'image--small js-class-hook',
			'hint'  => array( 'content' => __( 'The size of this icon must be 144x144px.', 'heap_txtd' ) ),
		)
	)
);



// ------------------------------------------------------------------------
// CUSTOMIZER
// ------------------------------------------------------------------------

// Colors
// ------------------------------------------------------------------------
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer',
	'title'           => __( 'Colors', 'heap_txtd' ),
	'id'              => 'colors',
	'desc'            => '<p class="description">' . __( 'Using the color pickers you can change the colors of the most important elements. If you want to override the color of some elements you can always use Custom CSS code in Theme Options - Custom Code.', 'heap_txtd' ) . '</p>',
	'customizer_only' => true,
	'type'            => 'customizer_panel',
	'fields'          => array( array('id' => 'legacy', 'title' => '', 'type' => 'info' ) )
);
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer customizer-only',
	'title'           => __( 'Colors', 'heap_txtd' ),
	'desc'            => '<p class="description">' . __( 'The style options control the general styling of the site, like accent color and Google Web Fonts. You can choose custom fonts for various typography elements with font weight, character set, size and/or line height. You also have a live preview for your chosen fonts.', 'heap_txtd' ) . '</p>',
	'type' => 'customizer_section',
	'in_panel'        => 'colors',
	'fields'          => array(
		array(
			'id'         => 'main_color',
			'type'       => 'color',
			'title'      => __( 'Main Color', 'heap_txtd' ),
			'subtitle'   => __( 'Use the color picker to change the main color of the site to match your brand color.', 'heap_txtd' ),
			'default'    => '#0093bf',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'color'            => array(
						'selector' => "a, a:hover, .link--light:hover,
							.text-link:hover,
							.wpgrade_popular_posts .article__category:hover,
							.meta-list a.btn:hover,
							.meta-list a.comments_add-comment:hover,
							.meta-list .form-submit a#comment-submit:hover,
							.form-submit .meta-list a#comment-submit:hover,
							.meta-list .widget_tag_cloud a:hover,
							.widget_tag_cloud .meta-list a:hover,
							.meta-list a.load-more__button:hover,
							.article__comments-number:hover,
							.author__social-link:hover,
							.article-archive .article__categories a:hover,

							.link--dark:hover,
							.nav--main a:hover,
							.comment__author-name a:hover,
							.author__title a:hover,
							.site-title--small a:hover,
							.site-header__menu a:hover,
							.widget a:hover,

							.article-archive--quote blockquote:before,
							.menu-item-has-children:hover > a,
							ol.breadcrumb a:hover,
							a:hover > .pixcode--icon,
							.tabs__nav a.current, .tabs__nav a:hover,
							.quote--single-featured:before,

							.price ins, .price > span,
							.shop-categories a.active",
					),
					'background-color' => array(
						'selector' => ".pagination .pagination-item--current span,
							.pagination li a:hover,
							.pagination li span:hover,
							.rsNavSelected,
							.progressbar__progress,
							.comments_add-comment:hover,
							.form-submit #comment-submit:hover,
							.widget_tag_cloud a:hover,
							.btn--primary,
							.comments_add-comment,
							.form-submit #comment-submit,
							a:hover > .pixcode--icon.circle,
							a:hover > .pixcode--icon.square,
							.btn--add-to-cart,
							.wpcf7-form-control.wpcf7-submit,
							.pagination--archive ol li a:hover,
							.btn:hover,
							.comments_add-comment:hover,
							.form-submit #comment-submit:hover,
							.widget_tag_cloud a:hover,
							.load-more__button:hover,

							#review-submit:hover, body.woocommerce div.woocommerce-message .button:hover,
							td.actions input.button:hover, form.shipping_calculator button.button:hover,
							body.woocommerce-page input.button:hover,
							body.woocommerce #content input.button.alt:hover,
							body.woocommerce #respond input#submit.alt:hover,
							body.woocommerce a.button.alt:hover,
							body.woocommerce button.button.alt:hover,
							body.woocommerce input.button.alt:hover,
							body.woocommerce-page #content input.button.alt:hover,
							body.woocommerce-page #respond input#submit.alt:hover,
							body.woocommerce-page a.button.alt:hover,
							body.woocommerce-page button.button.alt:hover,
							body.woocommerce-page input.button.alt:hover ",
					),
					'outline-color'    => array(
						'selector' => 'select:focus, textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .form-control:focus',
					),
				)
			)
		),
		array(
			'id'         => 'text_color',
			'type'       => 'color',
			'title'      => __( 'Text', 'heap_txtd' ),
			'default'    => '#424242',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'color' => array(
						'selector' => "body"
					),
				)
			)
		),
		array(
			'id'         => 'headings_color',
			'type'       => 'color',
			'title'      => __( 'Headings color', 'heap_txtd' ),
			'default'    => '#1a1919',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'color' => array(
						'selector' => "h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .article-archive .article__title a, .article-archive .article__title a:hover"
					),
				)
			)
		)
	)
);


// Backgrounds
// ------------------------------------------------------------------------
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer',
	'title'           => __( 'Backgrounds', 'heap_txtd' ),
	'id'              => 'backgrounds',
	'customizer_only' => true,
	'type' => 'customizer_panel',
	'fields'          => array( array('id' => 'legacy', 'title' => '', 'type' => 'info' ) )
);
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer customizer-only',
	'title'           => __( 'Backgrounds', 'heap_txtd' ),
	'type'            => 'customizer_section',
	'in_panel'        => 'backgrounds',
	'fields'          => array(
		array(
			'id'         => 'site_background_color',
			'type'       => 'color',
			'title'      => __( 'Site', 'heap_txtd' ),
			'default'    => '#eeeeee',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'background-color' => array(
						'selector' => "body"
					),
				)
			)
		),
		array(
			'id'               => 'body_image_pattern',
			'type'             => 'customizer_background',
			'output'           => array( 'body' ),
			'icon'             => 'test',
			'title'            => __( '<button></button>', 'heap_txtd' ),
			'subtitle'         => __( 'Container background with image.', 'heap_txtd' ),
			//			'customizer_only'  => true,
			'customizer'       => array(
				'transport' => 'refresh',
			),
			'background-color' => false,
			'default'          => array(
				'background-repeat'     => '',
				'background-size'       => '',
				'background-attachment' => '',
				'background-position'   => '',
				'background-image'      => '',
				'media'                 => array(
					'id'        => '',
					'height'    => '',
					'width'     => '',
					'thumbnail' => '',
				)
			),
		),
		array(
			'id'         => 'content_background_color',
			'type'       => 'color',
			'title'      => __( 'Content', 'heap_txtd' ),
			'default'    => '#ffffff',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'background-color' => array(
						'selector' => ".container"
					),
				)
			)
		),
		array(
			'id'               => 'container_image_pattern',
			'type'             => 'customizer_background',
			'output'           => array( '.container' ),
			'title'            => __( '<button></button>', 'heap_txtd' ),
			'subtitle'         => __( 'Container background with image.', 'heap_txtd' ),
			//			'customizer_only'  => true,
			'customizer'       => array(
				'transport' => 'refresh',
			),
			'background-color' => false,
			'default'          => array(
				'background-repeat'     => '',
				'background-size'       => '',
				'background-attachment' => '',
				'background-position'   => '',
				'background-image'      => '',
				'media'                 => array(
					'id'        => '',
					'height'    => '',
					'width'     => '',
					'thumbnail' => '',
				)
			),
		),
		array(
			'id'         => 'header_background_color',
			'type'       => 'color',
			'title'      => __( 'Header', 'heap_txtd' ),
			'default'    => '#ffffff',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'background-color' => array(
						'selector' => ".header"
					),
				)
			)
		),
		array(
			'id'               => 'header_image_pattern',
			'type'             => 'customizer_background',
			'output'           => array( '.header' ),
			'title'            => __( '<button></button>', 'heap_txtd' ),
			'subtitle'         => __( 'Header background with image.', 'heap_txtd' ),
			//			'customizer_only'  => true,
			'customizer'       => array(
				'transport' => 'refresh',
			),
			'background-color' => false,
			'default'          => array(
				'background-repeat'     => '',
				'background-size'       => '',
				'background-attachment' => '',
				'background-position'   => '',
				'background-image'      => '',
				'media'                 => array(
					'id'        => '',
					'height'    => '',
					'width'     => '',
					'thumbnail' => '',
				)
			),
		),
		array(
			'id'         => 'navigation_background_color',
			'type'       => 'color',
			'title'      => __( 'Navigation', 'heap_txtd' ),
			'default'    => '#ffffff',
			'validate'   => 'color',
			'compiler'   => true,
			//			'customizer_only' => true,
			'customizer' => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'background-color' => array(
						'selector' => ".navigation--main",
						'media'    => 'screen and (min-width: 900px)'
					),
				)
			)
		),
		array(
			'id'               => 'nav_image_pattern',
			'type'             => 'customizer_background',
			'output'           => array( '.navigation' ),
			'title'            => __( '<button></button>', 'heap_txtd' ),
			'subtitle'         => __( 'Navigation background with image.', 'heap_txtd' ),
			//			'customizer_only'  => true,
			'customizer'       => array(
				'transport' => 'refresh',
			),
			'background-color' => false,
			'default'          => array(
				'background-repeat'     => '',
				'background-size'       => '',
				'background-attachment' => '',
				'background-position'   => '',
				'background-image'      => '',
				'media'                 => array(
					'id'        => '',
					'height'    => '',
					'width'     => '',
					'thumbnail' => '',
				)
			),
		),
	)
);


// Typography
// ------------------------------------------------------------------------
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer',
	'title'           => __( 'Typography', 'heap_txtd' ),
	'id'              => 'typography',
	'customizer_only' => true,
	'type' => 'customizer_panel',
	'fields'          => array( array('id' => 'legacy', 'title' => '', 'type' => 'info' ) )
);
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer customizer-only',
	'title'           => __( 'Typography', 'heap_txtd' ),
	'type'            => 'customizer_section',
	'in_panel'        => 'typography',
	'fields'          => array(
		array(
			'id'       => 'use_google_fonts',
			'type'     => 'switch',
			'title'    => __( 'Do you need custom web fonts?', 'heap_txtd' ),
			'subtitle' => __( 'Tap into the massive <a href="http://www.google.com/fonts/">Google Fonts</a> collection (with Live preview).', 'heap_txtd' ),
			'default'  => '1',
			//			'customizer_only' => true,
			'compiler' => true,
			//		    'customizer' => array(
			//			    'transport' => 'refresh'
			//		    )
		),
		// Headings Font
		array(
			'id'             => 'google_titles_font',
			'type'           => 'customizer_typography',
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'text-transform' => false,
			'letter-spacing' => false,
			'text-align'     => false,
			'all_styles'     => true,
			'required'       => array( 'use_google_fonts', '=', 1 ),
			'title'          => __( '<button></button> Headings', 'heap_txtd' ),
			'subtitle'       => __( 'Font for titles and headings.', 'heap_txtd' ),
			'compiler'       => true,
			//			'customizer_only' => true,
			'customizer'     => array(
				'transport' => 'refresh',
			),
			'default'        => array(
				'font-family' => 'Open Sans',
				'google'      => true,
			),
		),
		// Navigation Font
		array(
			'id'             => 'google_nav_font',
			'type'           => 'customizer_typography',
			'color'          => false,
			'font-size'      => false,
			'line-height'    => false,
			'text-transform' => false,
			'letter-spacing' => false,
			'text-align'     => false,
			'all_styles'     => true,
			'required'       => array( 'use_google_fonts', '=', 1 ),
			'title'          => __( '<button></button> Navigation', 'heap_txtd' ),
			'subtitle'       => __( 'Font for the navigation menu.', 'heap_txtd' ),
			'compiler'       => true,
			//			'customizer_only' => true,
			'customizer'     => array(
				'transport' => 'refresh',
			),
			'default'        => array(
				'font-family' => 'Open Sans',
				'google'      => true,
			),
		),
		array(
			'id'            => 'nav_font-size',
			'type'          => 'customizer_slider',
			'title'         => __( 'Font Size', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '14',
			'min'           => 8,
			'step'          => 1,
			'max'           => 30,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'font-size' => array(
						'selector' => '.navigation a',
						'unit'     => 'px',
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'nav_letter-spacing',
			'type'          => 'customizer_slider',
			'title'         => __( 'Letter Spacing', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '0',
			'min'           => - 5,
			'step'          => 1,
			'max'           => 20,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'letter-spacing' => array(
						'selector' => '.navigation a',
						'unit'     => 'px',
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'nav_text-transform',
			'type'          => 'select',
			'title'         => __( 'Text Transform', 'heap_txtd' ),
			'options'       => array(
				'none'       => 'None',
				'capitalize' => 'Capitalize',
				'uppercase'  => 'Uppercase',
				'lowercase'  => 'Lowercase',
			),
			'default'       => 'uppercase',
			'select2'       => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'text-transform' => array(
						'selector' => '.navigation a',
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'nav_text-decoration',
			'type'          => 'select',
			'title'         => __( 'Text Decoration', 'heap_txtd' ),
			'options'       => array(
				'none'      => 'None',
				'underline' => 'Underline',
				'overline'  => 'Overline',
			),
			'default'       => 'none',
			'select2'       => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'text-decoration' => array(
						'selector' => '.nav--main > .menu-item > a',
					)
				)
			),
			'compiler'      => true
		),
		// Body Font
		array(
			'id'             => 'google_body_font',
			'type'           => 'customizer_typography',
			'color'          => false,
			'font-size'      => false,
			'font-style'     => false,
			'font-weight'    => false,
			'line-height'    => false,
			'text-transform' => false,
			'letter-spacing' => false,
			'text-align'     => false,
			'all-styles'     => true,
			'required'       => array( 'use_google_fonts', '=', 1 ),
			'title'          => __( '<button></button> Body', 'heap_txtd' ),
			'subtitle'       => __( 'Font for content and widget text.', 'heap_txtd' ),
			'compiler'       => true,
			//			'customizer_only' => true,
			'customizer'     => array(
				'transport' => 'refresh',
			),
			'default'        => array(
				'font-family' => 'Open Sans',
				'google'      => true,
			),
		),
		array(
			'id'            => 'body-font-size',
			'type'          => 'customizer_slider',
			'title'         => __( 'Font Size', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '16',
			'min'           => 8,
			'step'          => 1,
			'max'           => 72,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'font-size' => array(
						'selector' => 'body',
						'unit'     => 'px',
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'body-line-height',
			'type'          => 'customizer_slider',
			'title'         => __( 'Line Height', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '1.6',
			'min'           => 0,
			'max'           => 3,
			'step'          => .1,
			'resolution'    => 0.1,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'line-height' => array(
						'selector' => 'body',
						'unit'     => '',
					)
				)
			),
			'compiler'      => true
		),
	)
);

// Sizes and Spacing
// ------------------------------------------------------------------------
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer',
	'title'           => __( 'Sizes and Spacing', 'heap_txtd' ),
	'id'              => 'size-and-pacing',
	'customizer_only' => true,
	'type'            => 'customizer_panel',
	'fields'          => array( array('id' => 'legacy', 'title' => '', 'type' => 'info' ) )
);
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer customizer-only',
	'title'           => __( 'Sizes and Spacing', 'heap_txtd' ),
	'type'            => 'customizer_section',
	'in_panel'        => 'size-and-pacing',
	'fields'          => array(
		array(
			'id'         => 'sizes_content',
			'title'      => '<label><span class="customize-control-title sizes_section"><button></button>' . __( 'Content', 'heap_txtd' ) . '</span></label>',
			'type'       => 'customizer_info',
			//			'customizer_only' => true,
			'customizer' => array()
		),
		array(
			'id'            => 'content_width',
			'type'          => 'customizer_slider',
			'title'         => __( 'Site Container Width', 'heap_txtd' ),
			'subtitle'      => __( 'Set the width of the container.', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '1368',
			'min'           => 600,
			'step'          => 1,
			'max'           => 2700,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'max-width' => array(
						'selector' => '.container, .search__container, .site-header__container, .header--sticky .site-header__container',
						'unit'     => 'px',
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'content_horizontal_margins',
			'type'          => 'customizer_slider',
			'title'         => __( 'Container Horizontal Margins', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '96',
			'min'           => 24,
			'step'          => 6,
			'max'           => 120,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'padding-left'  => array(
						'selector' => '.container',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'padding-right' => array(
						'selector' => '.container',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'sidebar_width',
			'type'          => 'customizer_slider',
			'title'         => __( 'Sidebar Width', 'heap_txtd' ),
			'subtitle'      => __( 'Set the width of the sidebar.', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '300',
			'min'           => 140,
			'step'          => 10,
			'max'           => 500,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'width'        => array(
						'selector' => '.sidebar--main',
						'unit'     => 'px',
						'media'    => 'only screen and (min-width: 900px)'
					),
					'right'        => array(
						'selector' => '.page-content.has-sidebar:after',
						'unit'     => 'px',
						'media'    => 'only screen and (min-width: 900px)'
					),
					'margin-right' => array(
						'selector'          => '.page-content.has-sidebar .page-content__wrapper',
						'negative_selector' => '.page-content.has-sidebar',
						'unit'              => 'px',
						'media'             => 'only screen and (min-width: 900px)'
					),

				)
			),
			'compiler'      => true
		),
		array(
			'id'         => 'sizes_header',
			'title'      => '<label><span class="customize-control-title sizes_section"><button></button>' . __( 'Header', 'heap_txtd' ) . '</span></label>',
			'type'       => 'customizer_info',
			//			'customizer_only' => true,
			'customizer' => array()
		),
		array(
			'id'            => 'header_logo_height',
			'type'          => 'customizer_slider',
			'title'         => __( 'Logo Height', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '90',
			'min'           => 25,
			'step'          => 1,
			'max'           => 125,
			'display_value' => 'text',
			'class'         => 'small-text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'max-height' => array(
						'selector' => '.site-title--image img',
						'unit'     => 'px',
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'header_vertical_margins',
			'type'          => 'customizer_slider',
			'title'         => __( 'Header Vertical Margins', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => '36',
			'min'           => 0,
			'step'          => 1,
			'max'           => 100,
			'display_value' => 'text',
			'class'         => 'small-text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'padding-top'    => array(
						'selector' => '.header',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'padding-bottom' => array(
						'selector' => '.header',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'         => 'sizes_nav',
			'title'      => '<label><span class="customize-control-title sizes_section"><button></button>' . __( 'Navigation', 'heap_txtd' ) . '</span></label>',
			'type'       => 'customizer_info',
			//			'customizer_only' => true,
			'customizer' => array()
		),
		array(
			'id'            => 'navigation_menu_items_spacing',
			'type'          => 'customizer_slider',
			'title'         => __( 'Menu Items Spacing', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => 14,
			'min'           => 6,
			'step'          => 1,
			'max'           => 75,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'padding-left'  => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'padding-right' => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'margin-left'   => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'margin-right'  => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					)
				)
			),
			'compiler'      => true
		),
		array(
			'id'            => 'navigation_vertical_margins',
			'type'          => 'customizer_slider',
			'title'         => __( 'Navigation Vertical Margins', 'heap_txtd' ),
			'validate'      => 'numeric',
			'default'       => 10,
			'min'           => 1,
			'step'          => 1,
			'max'           => 40,
			'display_value' => 'text',
			//			'customizer_only' => true,
			'customizer'    => array(
				'transport' => 'postMessage',
				'css_rules' => array(
					'padding-top'    => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'padding-bottom' => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'margin-top'     => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					),
					'margin-bottom'  => array(
						'selector' => '.nav--main > .menu-item > a',
						'unit'     => 'px',
						'media'    => 'screen and (min-width: 900px)'
					)
				)
			),
			'compiler'      => true
		),
		// array(
		//     'id'=>'sidebar_title',
		//     'title'=> '<h4>'.__('Sidebar', 'heap_txtd').'</h4>',
		//  'type' => 'customizer_info',
		//  'customizer' => array()
		// ),

	)
);


// Other Options
// ------------------------------------------------------------------------
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer',
	'title'           => __( 'Other Options', 'heap_txtd' ),
	'id'              => 'general-options',
	'customizer_only' => true,
	'type' => 'customizer_panel',
	'fields'          => array( array('id' => 'legacy', 'title' => '', 'type' => 'info' ) )
);
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer customizer-only',
	'title'           => __( 'General Options', 'heap_txtd' ),
	'type'            => 'customizer_section',
	'in_panel'        => 'general-options',
	'fields'          => array(
		array(
			'id'         => 'nav_bar',
			'title'      => '<label><span class="customize-control-title sizes_section"><button></button>' . __( 'Navigation Bar', 'heap_txtd' ) . '</span></label>',
			'type'       => 'customizer_info',
			//			'customizer_only' => true,
			'customizer' => array()
		),
		array(
			'id'         => 'nav_always_show',
			'type'       => 'checkbox',
			'title'      => __( 'Always Show Nav on Scroll', 'heap_txtd' ),
			'default'    => '0',
			'customizer' => array()
		),
		array(
			'id'         => 'nav_borders',
			'type'       => 'checkbox',
			'title'      => __( 'Show Borders (top/bottom)', 'heap_txtd' ),
			'default'    => '1',
			'customizer' => array()
		),
		array(
			'id'         => 'nav_placement',
			'type'       => 'select',
			'title'      => __( 'Navigation placement', 'heap_txtd' ),
			'options'    => array(
				'top'    => 'Top',
				'bottom' => 'Bottom',
			),
			'default'    => 'bottom',
			'select2'    => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'customizer' => array(),
			'required'   => array( 'nav_always_show', '=', '1' ),
		),
		array(
			'id'         => 'nav_separators',
			'type'       => 'select',
			'title'      => __( 'Items Separator', 'heap_txtd' ),
			// 'subtitle' => __('How should the header menu behave?', 'heap_txtd'),
			'options'    => array(
				'default' => 'None',
				'dots'    => 'Dots',
				'bars'    => 'Bars',
			),
			'default'    => 'default',
			'select2'    => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'customizer' => array()
		),
		array(
			'id'         => 'nav_dropdown',
			'type'       => 'select',
			'title'      => __( 'Dropdown Symbol', 'heap_txtd' ),
			'options'    => array(
				'caret' => 'Caret',
				'plus'  => 'Plus',
			),
			'default'    => 'plus',
			'select2'    => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'customizer' => array()
		)
	)
);

// Reset Button
// ------------------------------------------------------------------------
$sections[] = array(
	'icon'            => "icon-params",
	'icon_class'      => '',
	'class'           => 'has-customizer',
	'title'           => __( 'Reset Options', 'heap_txtd' ),
	'customizer_only' => true,
	'priority'		  => 9999,
	'fields'          => array(
		array(
			'id'         => 'customizer_reset_button_section',
			'title'      => '<a class="btn" id="reset-style-defaults" href="#" data-ajax_nonce="' . wp_create_nonce( "reset-style-section" ) . '">' . __( 'Reset to Defaults', 'heap_txtd' ) . '</a>',
			'type'       => 'customizer_info',
			'customizer' => array()
		)
	)
);

// Header/Footer Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'   => 'icon-note-1',
	'title'  => __( 'Header', 'heap_txtd' ),
	'desc'   => '<p class="description">' . __( 'Header options allow you to control both the visual and functional aspects of the page header area.', 'heap_txtd' ) . '</p>',
	'fields' => array(
		array(
			'id'   => 'left-area-218293203',
			'desc' => '<h4>' . __( 'Left Area', 'heap_txtd' ) . '</h4>',
			'type' => 'info'
		),
		array(
			'id'       => 'header_social_links',
			'type'     => 'checkbox',
			'title'    => __( 'Social Links', 'heap_txtd' ),
			'subtitle' => __( 'Display the social links you have configured in Social and SEO section.', 'heap_txtd' ),
			'default'  => '1',
		),
		array(
			'id'   => 'right-area-218293204',
			'desc' => '<h4>' . __( 'Right Area', 'heap_txtd' ) . '</h4>',
			'type' => 'info'
		),
		array(
			'id'       => 'header_rss',
			'type'     => 'checkbox',
			'title'    => __( 'RSS Feed', 'heap_txtd' ),
			'subtitle' => __( 'Display a RSS feed link.', 'heap_txtd' ),
			'default'  => '0',
		),
		array(
			'id'       => 'header_rss_link',
			'type'     => 'text',
			'title'    => __( 'RSS Feed URL', 'heap_txtd' ),
			'subtitle' => __( 'Enter here the URL you would like the RSS feed icon to link to.', 'heap_txtd' ),
			'default'  => '#',
			'required' => array( 'header_rss', '=', '1' ),
		),
		array(
			'id'       => 'header_contact',
			'type'     => 'checkbox',
			'title'    => __( 'Contact Link', 'heap_txtd' ),
			'subtitle' => __( 'Display an envelope icon that link to your profile email address.', 'heap_txtd' ),
			'default'  => '0',
		),
		// array(
		// 	'id' => 'header_contact_link',
		// 	'type' => 'text',
		// 	'title' => __('Contact URL', 'heap_txtd'),
		// 	'desc' => __('Enter here the URL you would like the contact icon to link to.', 'heap_txtd'),
		// 	'default' => '#',
		// 	'required' => array('header_contact', '=', '1'),
		// ),
		array(
			'id'       => 'header_search',
			'type'     => 'checkbox',
			'title'    => __( 'Search Form', 'heap_txtd' ),
			'subtitle' => __( 'Adds a fancy search button and form in your site header.', 'heap_txtd' ),
			'default'  => '1',
		),

	)
);

$sections[] = array(
	'icon'   => 'icon-note-1',
	'title'  => __( 'Footer', 'heap_txtd' ),
	'desc'   => '<p class="description">' . __( 'Footer options allow you to control both the visual and functional aspects of the page footer area.', 'heap_txtd' ) . '</p>',
	'fields' => array(
		array(
			'id'      => 'copyright_text',
			'type'    => 'editor',
			'title'   => __( 'Copyright Text', 'heap_txtd' ),
			'hint'    => array( 'content' => sprintf( __( 'Text that will appear in bottom left area (eg. Copyright 2014 %s | All Rights Reserved).', 'heap_txtd' ), wpgrade::themename() ) ),
			'default' => '2014 &copy; Handcrafted with love by <a href="#">PixelGrade</a> Team',
			'rows'    => 3,
		)

	)
);


// $sections[] = array(
//     'type' => 'divide',
// );

// Archives Options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'   => 'icon-pencil-1',
	'title'  => __( 'Archives', 'heap_txtd' ),
	'desc'   => sprintf( '<p class="description">' . __( 'Archive options control the various aspects related to displaying posts in archives and front page. You can control things like excerpt length and various layout aspects.', 'heap_txtd' ) . '</p>', wpgrade::themename() ),
	'fields' => array(
		array(
			'id'       => 'blog_layout',
			'type'     => 'image_select',
			'title'    => __( 'Archive Posts Layout', 'heap_txtd' ),
			'subtitle' => __( 'Choose the layout for the <strong>front page</strong> and <strong>archive pages</strong> (eg. blog, categories, search results).', 'heap_txtd' ),
			'default'  => 'masonry',
			'options'  => array(
				'masonry' => array( 'masonry', 'img' => wpgrade::resourceuri( 'images/blog-masonry.png' ) ),
				'classic' => array( 'classic', 'img' => wpgrade::resourceuri( 'images/blog-classic.png' ) ),
			)
		),
		array(
			'id'       => 'masonry_columns-218293204',
			'desc'     => __( '<b>Number of Columns</b> of masonry archives based on various <b>screen sizes</b>:', 'heap_txtd' ),
			'type'     => 'info',
			'required' => array( 'blog_layout', 'equals', 'masonry' ),
			'class'    => 'js-class-hook mt-3'
		),
		array(
			'id'       => 'blog_layout_masonry_big_columns',
			'type'     => 'select',
			'desc'     => __( '<strong>LARGE</strong> screen size', 'heap_txtd' ),
			'options'  => array(
				1 => '1 column',
				2 => '2 columns',
				3 => '3 columns',
				4 => '4 columns',
				5 => '5 columns',
				6 => '6 columns',
			),
			'default'  => 3,
			'select2'  => array(
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'required' => array( 'blog_layout', '=', 'masonry' ),
			'class'    => 'js-class-hook display-inline-block mr',
		),
		array(
			'id'       => 'blog_layout_masonry_medium_columns',
			'type'     => 'select',
			'desc'     => __( '<strong>MEDIUM</strong> screen size', 'heap_txtd' ),
			'options'  => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
			),
			'default'  => 2,
			'select2'  => array(
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'required' => array( 'blog_layout', '=', 'masonry' ),
			'class'    => 'js-class-hook display-inline-block mr',
		),
		array(
			'id'       => 'blog_layout_masonry_small_columns',
			'type'     => 'select',
			'title'    => '', //__( '', 'heap_txtd' ),
			'desc'     => __( '<strong>SMALL</strong> screen size', 'heap_txtd' ),
			'options'  => array(
				1 => '1',
				2 => '2',
				3 => '3',
				4 => '4',
				5 => '5',
			),
			'default'  => 1,
			'select2'  => array(
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'required' => array( 'blog_layout', '=', 'masonry' ),
			'class'    => 'js-class-hook display-inline-block mr',
		),
		array(
			'id'      => 'blog_excerpt_more_text',
			'type'    => 'text',
			'title'   => __( 'Excerpt "More" Text', 'heap_txtd' ),
			'hint'    => array( 'content' => __( 'Change the default [...] with something else (leave empty if you want to remove it).', 'heap_txtd' ) ),
			'desc'    => __( '(leave empty if you want to remove it)', 'heap_txtd' ),
			'default' => '..',
			'class'   => 'js-class-hook one-half layout-item',
		),
		array(
			'id'      => 'blog_excerpt_length',
			'type'    => 'text',
			'title'   => __( 'Excerpt Length', 'heap_txtd' ),
			'hint'    => array( 'content' => __( 'Set the number of characters for posts excerpt.', 'heap_txtd' ) ),
			'default' => '140',
			'class'   => 'js-class-hook one-half layout-item',
		),
		array(
			'id'       => 'blog_show_breadcrumb',
			'type'     => 'switch',
			'title'    => __( 'Show Breadcrumbs', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show the archive breadcrumbs?', 'heap_txtd' ),
			'default'  => false,
			'class'    => ' js-class-hook clear-before'
		),
		array(
			'id'    => 'posts_meta_data-218293204',
			'desc'  => '<h4>' . __( 'Posts Meta Data', 'heap_txtd' ) . '</h4>',
			'type'  => 'info',
			'class' => 'clear-before'
		),
		array(
			'id'       => 'blog_show_categories',
			'type'     => 'checkbox',
			'title'    => __( 'Categories', 'heap_txtd' ),
			'subtitle' => __( 'Display the post categories.', 'heap_txtd' ),
			'default'  => '1',
			'class'    => 'js-class-hook one-half layout-item'
		),
		array(
			'id'       => 'blog_show_date',
			'type'     => 'checkbox',
			'title'    => __( 'Date', 'heap_txtd' ),
			'subtitle' => __( 'Display the post publish date.', 'heap_txtd' ),
			'default'  => '1',
			'class'    => 'js-class-hook one-half layout-item'
		),
		array(
			'id'       => 'blog_show_comments',
			'type'     => 'checkbox',
			'title'    => __( 'Comments Number', 'heap_txtd' ),
			'subtitle' => __( 'Display the number of comments.', 'heap_txtd' ),
			'default'  => '1',
			'class'    => 'js-class-hook one-half layout-item'
		),
		array(
			'id'       => 'blog_show_likes',
			'type'     => 'checkbox',
			'title'    => __( 'Likes Number', 'heap_txtd' ),
			'subtitle' => __( '(only if the PixLikes plugin is active)', 'heap_txtd' ),
			'default'  => '1',
			'class'    => 'js-class-hook one-half layout-item'
		),
		array(
			'id'    => 'navigation_style-21829384',
			'desc'  => '<h4>' . __( 'Navigation Style', 'heap_txtd' ) . '</h4>',
			'type'  => 'info',
			'class' => 'js-class-hook clear-before'
		),
		array(
			'id'       => 'blog_infinitescroll',
			'type'     => 'switch',
			'title'    => __( 'Infinite Scroll', 'heap_txtd' ),
			'subtitle' => __( 'Replace the regular pagination with AJAX loading new items on scroll or button click (will load at once the number posts specified in Settings > Reading).', 'heap_txtd' ),
			'default'  => '1',
		),
		array(
			'id'       => 'blog_infinitescroll_show_button',
			'type'     => 'checkbox',
			'title'    => __( 'Show [Load More] Button', 'heap_txtd' ),
			'subtitle' => __( 'The next posts will be loaded only on button click.', 'heap_txtd' ),
			'default'  => '1',
			'required' => array( 'blog_infinitescroll', '=', '1' ),
		),
		array(
			'id'       => 'blog_infinitescroll_button_text',
			'type'     => 'text',
			'title'    => __( '[Load More] Button Text', 'heap_txtd' ),
			'default'  => '+ LOAD MORE',
			'required' => array( 'blog_infinitescroll_show_button', '=', '1' ),
		),
		array(
			'id'   => 'archive_sidebar-86329384',
			'desc' => '<h4>' . __( 'Sidebar', 'heap_txtd' ) . '</h4>',
			'type' => 'info'
		),
		array(
			'id'       => 'blog_show_sidebar',
			'type'     => 'switch',
			'title'    => __( 'Show Sidebar', 'heap_txtd' ),
			'subtitle' => __( 'Show the main sidebar in the archive pages.', 'heap_txtd' ),
			'default'  => '1',
		),
	)
);

$sections[] = array(
	'icon'   => 'icon-pencil-1',
	'title'  => __( 'Posts', 'heap_txtd' ),
	'desc'   => sprintf( '<p class="description">' . __( 'Post options control the various aspects related to the <b>single post page</b>.', 'heap_txtd' ) . '</p>', wpgrade::themename() ),
	'fields' => array(
		array(
			'id'       => 'blog_single_show_breadcrumb',
			'type'     => 'switch',
			'title'    => __( 'Show Post Breadcrumbs', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show the post breadcrumb?', 'heap_txtd' ),
			'default'  => true,
		),
		array(
			'id'       => 'blog_single_show_title_meta_info',
			'type'     => 'switch',
			'title'    => __( 'Show Post Title Extra Info', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show the date and the author under the title?', 'heap_txtd' ),
			'default'  => true,
		),
		array(
			'id'       => 'blog_single_show_author_box',
			'type'     => 'switch',
			'title'    => __( 'Show Author Info Box', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show author info box with avatar and description bellow the post?', 'heap_txtd' ),
			'default'  => true,
		),
		array(
			'id'   => 'posts_share-links-812329384',
			'desc' => '<h4>' . __( 'Share Links', 'heap_txtd' ) . '</h4>',
			'type' => 'info'
		),
		array(
			'id'       => 'blog_single_show_share_links',
			'type'     => 'switch',
			'title'    => __( 'Show Share Links', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show share icon links in your articles?', 'heap_txtd' ),
			'default'  => true,
		),
		array(
			'id'       => 'blog_single_share_links_position',
			'type'     => 'select',
			'title'    => __( 'Share Links Position', 'heap_txtd' ),
			'subtitle' => __( 'Choose where to display the share links.', 'heap_txtd' ),
			'options'  => array(
				'top'    => 'Top',
				'bottom' => 'Bottom',
				'both'   => 'Both Top & Bottom',
			),
			'default'  => 'both',
			'select2'  => array(
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'required' => array( 'blog_single_show_share_links', '=', true )
		),
		array(
			'id'   => 'posts_comments-812329384',
			'desc' => '<h4>' . __( 'Comments', 'heap_txtd' ) . '</h4>',
			'type' => 'info'
		),
		array(
			'id'       => 'comments_show_avatar',
			'type'     => 'switch',
			'title'    => __( 'Show Comments Avatars', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show avatars in comments?', 'heap_txtd' ),
			'default'  => false,
		),
		array(
			'id'       => 'comments_show_numbering',
			'type'     => 'switch',
			'title'    => __( 'Show Comments Numbers', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to show numbers beside each comment?', 'heap_txtd' ),
			'default'  => true,
		),
		array(
			'id'   => 'posts_sidebar-812329384',
			'desc' => '<h4>' . __( 'Sidebar', 'heap_txtd' ) . '</h4>',
			'type' => 'info'
		),
		array(
			'id'       => 'blog_single_show_sidebar',
			'type'     => 'switch',
			'title'    => __( 'Show Sidebar', 'heap_txtd' ),
			'subtitle' => __( 'Show the main sidebar in the single post pages.', 'heap_txtd' ),
			'default'  => '1',
			'switch'   => true,
		),
	)
);

$sections[] = array(
	'type' => 'divide',
);

// Social and SEO options
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'       => "icon-thumbs-up-1",
	'icon_class' => '',
	'title'      => __( 'Social and SEO', 'heap_txtd' ),
	'desc'       => '<p class="description">' . __( 'Social and SEO options allow you to display your social links and choose where to display them. Then you can set the social SEO related info added in the meta tags or used in various widgets.', 'heap_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Sharing', 'heap_txtd' ) . '</h3>',
			'type' => 'info'
		),
		//		array(
		//			'id' => 'share_buttons_settings',
		//			'type' => 'select',
		//			'title' => __('Share Services', 'heap_txtd'),
		//			'subtitle' => __('Add here the share services you want to use, single comma delimited (no spaces). You can find the full list of services here: <a href="http://www.addthis.com/services/list">http://www.addthis.com/services/list</a>. Also you can use the <strong>more</strong> tag to show the plus sign and the <strong>counter</strong> tag to show a global share counter.<br/><br/>Important: If you want to allow AddThis to show your visitors personalized lists of share buttons you can use the <strong>preferred</strong> tag. More about this here: <a href="http://bit.ly/1fLP69i">http://bit.ly/1fLP69i</a>.', 'heap_txtd'),
		//			'default' => 'more,preferred,preferred,preferred,preferred',
		//			'options'  => array(
		//				'more' => 'More Button',
		//				'preferred' => 'Preferred',
		//				'facebook' => 'Facebook',
		//				'twitter' => 'Twitter',
		//				'google_plusone_share' => 'Google+',
		//				'google' => 'Google Bookmarks',
		//				'pinterest_share' => 'Pinterest',
		//				'linkedin' => 'LinkedIn',
		//				'sinaweibo' => 'Sina Weibo',
		//				'baidu' => 'Baidu',
		//				'chimein' => 'Chime.In',
		//				'classicalplace' => 'ClassicalPlace',
		//				'cndig' => 'Cndig',
		//				'technerd' => 'TechNerd',
		//				'delicious' => 'Delicious',
		//				'digg' => 'Digg',
		//				'diigo' => 'Diigo',
		//				'dosti' => 'Dosti',
		//				'douban' => 'Douban',
		//				'draugiem' => 'Draugiem.lv',
		//				'dudu' => 'dudu',
		//				'dzone' => 'dzone',
		//				'efactor' => 'EFactor',
		//				'ekudos' => 'eKudos',
		//				'elefantapl' => 'elefanta.pl',
		//				'email' => 'Email',
		//				'mailto' => 'Email App',
		//				'embarkons' => 'Embarkons',
		//				'evernote' => 'Evernote',
		//				'extraplay' => 'extraplay',
		//				'fabulously40' => 'Fabulously40',
		//				'farkinda' => 'Farkinda',
		//				'favable' => 'FAVable',
		//				'faves' => 'Fave',
		//				'favlogde' => 'favlog',
		//				'favoritende' => 'Favoriten.de',
		//				'favorites' => 'Favorites',
		//				'favoritus' => 'Favoritus',
		//				'financialjuice' => 'financialjuice',
		//				'flaker' => 'Flaker',
		//				'folkd' => 'Folkd',
		//				'formspring' => 'Formspring',
		//				'fresqui' => 'Fresqui',
		//				'friendfeed' => 'FriendFeed',
		//				'funp' => 'funP',
		//				'fwisp' => 'fwisp',
		//				'gabbr' => 'Gabbr',
		//				'gamekicker' => 'Gamekicker',
		//				'gg' => 'GG',
		//				'givealink' => 'GiveALink',
		//				'gmail' => 'Gmail',
		//				'govn' => 'Go.vn',
		//				'goodnoows' => 'Good Noows',
		//				'greaterdebater' => 'GreaterDebater',
		//				'hackernews' => 'Hacker News',
		//				'gluvsnap' => 'Healthimize',
		//				'hedgehogs' => 'Hedgehogs.net',
		//				'historious' => 'Historious',
		//				'hotklix' => 'Hotklix',
		//				'hotmail' => 'Hotmail',
		//				'identica' => 'Identica',
		//				'ihavegot' => 'ihavegot',
		//				'index4' => 'Index4',
		//				'instapaper' => 'Instapaper',
		//				'iorbix' => 'iOrbix',
		//				'irepeater' => 'IRepeater.Share',
		//				'isociety' => 'iSociety',
		//				'iwiw' => 'iWiW',
		//				'jamespot' => 'Jamespot',
		//				'jappy' => 'Jappy Ticker',
		//				'jolly' => 'Jolly',
		//				'jumptags' => 'Jumptags',
		//				'kaevur' => 'Kaevur',
		//				'kaixin' => 'Kaixin Repaste',
		//				'ketnooi' => 'Ketnooi',
		//				'kledy' => 'Kledy',
		//				'kommenting' => 'Kommenting',
		//				'latafaneracat' => 'La tafanera',
		//				'librerio' => 'Librerio',
		//				'lidar' => 'LiDAR Online',
		//				'linksgutter' => 'Links Gutter',
		//				'linkshares' => 'LinkShares',
		//				'linkuj' => 'Linkuj.cz',
		//				'lockerblogger' => 'LockerBlogger',
		//				'logger24' => 'Logger24.com',
		//				'mymailru' => 'Mail.ru',
		//				'margarin' => 'mar.gar.in',
		//				'markme' => 'Markme',
		//				'mashant' => 'Mashant',
		//				'mashbord' => 'Mashbord',
		//				'me2day' => 'me2day',
		//				'meinvz' => 'meinVZ',
		//				'mekusharim' => 'Mekusharim',
		//				'memori' => 'Memori.ru',
		//				'meneame' => 'Menéame',
		//				'live' => 'Messenger',
		//				'misterwong' => 'Mister Wong',
		//				'misterwong_de' => 'Mister Wong DE',
		//				'mixi' => 'Mixi',
		//				'moemesto' => 'Moemesto.ru',
		//				'moikrug' => 'Moikrug',
		//				'mrcnetworkit' => 'mRcNEtwORK',
		//				'myspace' => 'Myspace',
		//				'myvidster' => 'myVidster',
		//				'n4g' => 'N4G',
		//				'naszaklasa' => 'Nasza-klasa',
		//				'netlog' => 'NetLog',
		//				'netvibes' => 'Netvibes',
		//				'netvouz' => 'Netvouz',
		//				'newsmeback' => 'NewsMeBack',
		//				'newstrust' => 'NewsTrust',
		//				'newsvine' => 'Newsvine',
		//				'nujij' => 'Nujij',
		//				'odnoklassniki_ru' => 'Odnoklassniki',
		//				'oknotizie' => 'OKNOtizie',
		//				'openthedoor' => 'OpenTheDoor',
		//				'orkut' => 'orkut',
		//				'oyyla' => 'Oyyla',
		//				'packg' => 'Packg',
		//				'pafnetde' => 'pafnet.de',
		//				'phonefavs' => 'PhoneFavs',
		//				'plaxo' => 'Plaxo',
		//				'plurk' => 'Plurk',
		//				'pocket' => 'Pocket',
		//				'posteezy' => 'Posteezy',
		//				'posterous' => 'Posterous',
		//				'print' => 'Print',
		//				'printfriendly' => 'PrintFriendly',
		//				'pusha' => 'Pusha',
		//				'qrfin' => 'QRF.in',
		//				'qrsrc' => 'QRSrc.com',
		//				'qzone' => 'Qzone',
		//				'reddit' => 'Reddit',
		//				'rediff' => 'Rediff MyPage',
		//				'redkum' => 'RedKum',
		//				'researchgate' => 'ResearchGate',
		//				'scoopat' => 'Scoop.at',
		//				'scoopit' => 'Scoop.it',
		//				'sekoman' => 'Sekoman',
		//				'select2gether' => 'Select2Gether',
		//				'shaveh' => 'Shaveh',
		//				'shetoldme' => 'SheToldMe',
		//				'smiru' => 'SMI',
		//				'sonico' => 'Sonico',
		//				'spinsnap' => 'SpinSnap',
		//				'yiid' => 'Spread.ly',
		//				'springpad' => 'springpad',
		//				'startaid' => 'Startaid',
		//				'startlap' => 'Startlap',
		//				'storyfollower' => 'Story Follower',
		//				'studivz' => 'studiVZ',
		//				'stumbleupon' => 'StumbleUpon',
		//				'sulia' => 'Sulia',
		//				'sunlize' => 'Sunlize',
		//				'surfingbird' => 'Surfingbird',
		//				'svejo' => 'Svejo',
		//				'taaza' => 'Taaza',
		//				'tagza' => 'Tagza',
		//				'taringa' => 'Taringa!',
		//				'textme' => 'Textme SMS',
		//				'thewebblend' => 'The Web Blend',
		//				'thinkfinity' => 'Thinkfinity',
		//				'topsitelernet' => 'TopSiteler',
		//				'tuenti' => 'Tuenti',
		//				'tulinq' => 'Tulinq',
		//				'tumblr' => 'Tumblr',
		//				'tvinx' => 'Tvinx',
		//				'typepad' => 'Typepad',
		//				'upnews' => 'Upnews.it',
		//				'urlaubswerkde' => 'Urlaubswerk',
		//				'visitezmonsite' => 'Visitez Mon Site',
		//				'vk' => 'Vkontakte',
		//				'vkrugudruzei' => 'vKruguDruzei',
		//				'vybralisme' => 'vybrali SME',
		//				'wanelo' => 'Wanelo',
		//				'sharer' => 'WebMoney.Events',
		//				'webnews' => 'Webnews',
		//				'webshare' => 'WebShare',
		//				'werkenntwen' => 'Wer Kennt Wen',
		//				'wirefan' => 'WireFan',
		//				'wowbored' => 'WowBored',
		//				'wykop' => 'Wykop',
		//				'xanga' => 'Xanga',
		//				'xing' => 'Xing',
		//				'yahoobkm' => 'Y! Bookmarks',
		//				'yahoomail' => 'Y! Mail',
		//				'yammer' => 'Yammer',
		//				'yardbarker' => 'Yardbarker',
		//				'yigg' => 'Yigg',
		//				'yookos' => 'Yookos',
		//				'yoolink' => 'Yoolink',
		//				'yorumcuyum' => 'Yorumcuyum',
		//				'youmob' => 'YouMob',
		//				'yuuby' => 'Yuuby',
		//				'zakladoknet' => 'Zakladok.net',
		//				'ziczac' => 'ZicZac',
		//				'zingme' => 'ZingMe',
		//
		//
		//			),
		////			'sortable' => true,
		//			'multi' => true,
		//			'select2' => array( // here you can provide params for the select2 jquery call
		//				'minimumResultsForSearch' => 1,
		//				'allowClear' => true, // don't allow a empty select
		//				//'separator' => ','
		//			)
		//		),
		array(
			'id'       => 'share_buttons_settings',
			'type'     => 'text',
			'title'    => __( 'Share Services', 'heap_txtd' ),
			'subtitle' => __( 'Add here the share services you want to use, single comma delimited (no spaces). You can find the full list of services here: <a href="http://www.addthis.com/services/list">http://www.addthis.com/services/list</a>. Also you can use the <strong>more</strong> tag to show the plus sign and the <strong>counter</strong> tag to show a global share counter.<br/><br/>Important: If you want to allow AddThis to show your visitors personalized lists of share buttons you can use the <strong>preferred</strong> tag. More about this here: <a href="http://bit.ly/1fLP69i">http://bit.ly/1fLP69i</a>.', 'heap_txtd' ),
			'default'  => 'more,preferred,preferred,preferred,preferred',
		),
		array(
			'id'       => 'share_buttons_enable_tracking',
			'type'     => 'switch',
			'title'    => __( 'Sharing Analytics', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to get analytics for your social shares?', 'heap_txtd' ),
			'default'  => '0',
		),
		array(
			'id'       => 'share_buttons_enable_addthis_tracking',
			'type'     => 'switch',
			'title'    => __( 'AddThis Tracking', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to enable AddThis tracking? This will all you to see sharing analytics in your AddThis account (see more here: <a href="http://bit.ly/1APYcuZ">bit.ly/1APYcuZ</a>)', 'heap_txtd' ),
			'default'  => '0',
			'required' => array( 'share_buttons_enable_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_addthis_username',
			'type'     => 'text',
			'title'    => __( 'AddThis Username', 'heap_txtd' ),
			'subtitle' => __( 'Enter here your AddThis username so you will receive analytics data.', 'heap_txtd' ),
			'default'  => '',
			'required' => array( 'share_buttons_enable_addthis_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_enable_ga_tracking',
			'type'     => 'switch',
			'title'    => __( 'Google Analytics Tracking', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to enable the AddThis - Google Analytics tracking integration? See more about this here: <a href="http://bit.ly/1kxPg7K">bit.ly/1kxPg7K</a>', 'heap_txtd' ),
			'default'  => '0',
			'required' => array( 'share_buttons_enable_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_ga_id',
			'type'     => 'text',
			'title'    => __( 'GA Property ID', 'heap_txtd' ),
			'subtitle' => __( 'Enter here your GA property ID (generally a serial number of the form UA-xxxxxx-x).', 'heap_txtd' ),
			'default'  => '',
			'required' => array( 'share_buttons_enable_ga_tracking', '=', 1 ),
		),
		array(
			'id'       => 'share_buttons_enable_ga_social_tracking',
			'type'     => 'switch',
			'title'    => __( 'GA Social Tracking', 'heap_txtd' ),
			'subtitle' => __( 'If you are using the latest version of GA code, you can take advantage of Google\'s new <a href="http://bit.ly/1iVvkbk">social interaction analytics</a>.', 'heap_txtd' ),
			'default'  => '0',
			'required' => array( 'share_buttons_enable_ga_tracking', '=', 1 ),
		),
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Social Links', 'heap_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'         => 'social_icons',
			'type'       => 'text_sortable',
			'title'      => __( 'Social Links', 'heap_txtd' ),
			'hint'       => array( 'content' => __( 'You need to input the <strong>absolute URL path</strong> URL (ie. http://twitter.com/username)', 'heap_txtd' ) ),
			'subtitle'   => sprintf( __( 'Define and reorder your social pages links.<br /><b>Note:</b> These will be displayed in the "%s Social Links" widget so you can put them anywhere on your site. Only those filled will appear.', 'heap_txtd' ), wpgrade::themename() ),
			'desc'       => __( 'Icons provided by <strong>FontAwesome</strong> and <strong>Entypo</strong>.', 'heap_txtd' ),
			'checkboxes' => array(
				'widget' => __( 'Widget', 'heap_txtd' ),
				'header' => __( 'Header', 'heap_txtd' )
			),
			'options'    => array(
				'flickr'        => __( 'Flickr', 'heap_txtd' ),
				'tumblr'        => __( 'Tumblr', 'heap_txtd' ),
				'pinterest'     => __( 'Pinterest', 'heap_txtd' ),
				'instagram'     => __( 'Instagram', 'heap_txtd' ),
				'behance'       => __( 'Behance', 'heap_txtd' ),
				'fivehundredpx' => __( '500px', 'heap_txtd' ),
				'deviantart'    => __( 'DeviantART', 'heap_txtd' ),
				'dribbble'      => __( 'Dribbble', 'heap_txtd' ),
				'twitter'       => __( 'Twitter', 'heap_txtd' ),
				'facebook'      => __( 'Facebook', 'heap_txtd' ),
				'gplus'         => __( 'Google+', 'heap_txtd' ),
				'youtube'       => __( 'Youtube', 'heap_txtd' ),
				'vimeo'         => __( 'Vimeo', 'heap_txtd' ),
				'linkedin'      => __( 'LinkedIn', 'heap_txtd' ),
				'tumblr'        => __( 'Tumblr', 'heap_txtd' ),
				'skype'         => __( 'Skype', 'heap_txtd' ),
				'soundcloud'    => __( 'SoundCloud', 'heap_txtd' ),
				'digg'          => __( 'Digg', 'heap_txtd' ),
				'lastfm'        => __( 'Last.FM', 'heap_txtd' ),
				'rdio'          => __( 'Rdio', 'heap_txtd' ),
				'sina-weibo'    => __( 'Sina Weibo', 'heap_txtd' ),
				'vkontakte'     => __( 'VKontakte', 'heap_txtd' ),
				'appnet'        => __( 'App.net', 'heap_txtd' ),
				'rss'           => __( 'RSS Feed', 'heap_txtd' ),
			)
		),
		array(
			'id'       => 'social_icons_target_blank',
			'type'     => 'switch',
			'title'    => __( 'Open Social Links In a New Tab?', 'heap_txtd' ),
			'subtitle' => __( 'Do you want to open social links in a new tab?', 'heap_txtd' ),
			'default'  => '1',
		),
		array(
			'id'   => 'header_layout-218293203',
			'desc' => '<h3>' . __( 'Social Metas', 'heap_txtd' ) . '</h3>',
			'type' => 'info'
		),
		array(
			'id'      => 'prepare_for_social_share',
			'type'    => 'switch',
			'title'   => __( 'Add Social Meta Tags', 'heap_txtd' ),
			'hint'    => array( 'content' => __( 'Let us properly prepare your theme for the social sharing and discovery by adding the needed metatags in the <head> section. These include Open Graph (Facebook), Google+ and Twitter metas.', 'heap_txtd' ) ),
			'default' => '1',
		),
		array(
			'id'       => 'facebook_id_app',
			'type'     => 'text',
			'title'    => __( 'Facebook Application ID', 'heap_txtd' ),
			'subtitle' => __( 'Enter the Facebook Application ID of the Fan Page which is associated with this website. You can create one <a href="https://developers.facebook.com/apps">here</a>.', 'heap_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'       => 'facebook_admin_id',
			'type'     => 'text',
			'title'    => __( 'Facebook Admin ID', 'heap_txtd' ),
			'subtitle' => __( 'The id of the user that has administrative privileges to your Facebook App so you can access the <a href="https://www.facebook.com/insights/">Facebook Insights</a>.', 'heap_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'       => 'google_page_url',
			'type'     => 'text',
			'title'    => __( 'Google+ Publisher', 'heap_txtd' ),
			'subtitle' => __( 'Enter your Google Plus page ID (example: https://plus.google.com/<b>105345678532237339285</b>) here if you have set up a "Google+ Page".', 'heap_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'       => 'twitter_card_site',
			'type'     => 'text',
			'title'    => __( 'Twitter Site Username', 'heap_txtd' ),
			'subtitle' => __( 'The Twitter username of the entire site. The username for the author will be taken from the author\'s profile (skip the @)', 'heap_txtd' ),
			'required' => array( 'prepare_for_social_share', '=', 1 )
		),
		array(
			'id'    => 'social_share_default_image',
			'type'  => 'media',
			'title' => __( 'Default Social Share Image', 'heap_txtd' ),
			'desc'  => __( 'If an image is uploaded, this will be used for content sharing if you don\'t upload a custom image with your content (at least 200px wide recommended).', 'heap_txtd' ),
		),
		array(
			'id'       => 'remove_parameters_from_static_res',
			'type'     => 'switch',
			'title'    => __( 'Clean Static Files URL', 'heap_txtd' ),
			'subtitle' => __( 'Do you want us to remove the version parameters from static resources so they can be cached better?', 'heap_txtd' ),
			'default'  => '0',
		),
		//		array(
		//			'id' => 'move_jquery_to_footer',
		//			'type' => 'switch',
		//			'title' => __('Move JS Files To Footer', 'heap_txtd'),
		//			'subtitle' => __('This will force jQuery and all other files to be included just before the body closing tag. Please note that this can break some plugins so use it wisely.', 'heap_txtd'),
		//			'default' => '0',
		//		),
	)
);

// Custom Code
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'       => "icon-database-1",
	'icon_class' => '',
	'title'      => __( 'Custom Code', 'heap_txtd' ),
	'desc'       => '<p class="description">' . __( 'You can change the site style and behaviour by adding custom scripts to all pages within your site using the custom code areas below.', 'heap_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'       => 'custom_css',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom CSS', 'heap_txtd' ),
			'subtitle' => __( 'Enter your custom CSS code. It will be included in the head section of the page and will overwrite the main CSS styling.', 'heap_txtd' ),
			'desc'     => '', //__( '', 'heap_txtd' ),
			'mode'     => 'css',
			'theme'    => 'chrome',
			//'validate' => 'html',
			'compiler' => true
		),
		array(
			'id'       => 'inject_custom_css',
			'type'     => 'select',
			'title'    => __( 'Apply Custom CSS', 'heap_txtd' ),
			'subtitle' => sprintf( __( 'Select how to insert the custom CSS into your pages.', 'heap_txtd' ), wpgrade::themename() ),
			'default'  => 'inline',
			'options'  => array(
				'inline' => __( 'Inline <em>(recommended)</em>', 'heap_txtd' ),
				'file'   => __( 'Write To File (might require file permissions)', 'heap_txtd' )
			),
			'select2'  => array( // here you can provide params for the select2 jquery call
				'minimumResultsForSearch' => - 1, // this way the search box will be disabled
				'allowClear'              => false // don't allow a empty select
			),
			'compiler' => true
		),
		array(
			'id'       => 'custom_js',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JavaScript (header)', 'heap_txtd' ),
			'subtitle' => __( 'Enter your custom Javascript code. This code will be loaded in the head section of your pages.', 'heap_txtd' ),
			'mode'     => 'text',
			'theme'    => 'chrome'
		),
		array(
			'id'       => 'custom_js_footer',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom JavaScript (footer)', 'heap_txtd' ),
			'subtitle' => __( 'This javascript code will be loaded in the footer. You can paste here your <strong>Google Analytics tracking code</strong> (or for what matters any tracking code) and we will put it on every page.', 'heap_txtd' ),
			'mode'     => 'text',
			'theme'    => 'chrome'
		),
	)
);


/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// WooCommerce
	// ------------------------------------------------------------------------
	$sections[] = array(
		'icon'       => "icon-shop",
		'icon_class' => '',
		'title'      => __( 'WooCommerce', 'heap_txtd' ),
		'desc'       => '<p class="description">' . __( 'WooCommerce options!', 'heap_txtd' ) . '</p>',
		'fields'     => array(
			array(
				'id'       => 'enable_woocommerce_support',
				'type'     => 'switch',
				'title'    => __( 'Enable WooCommerce Support', 'heap_txtd' ),
				'subtitle' => __( 'Turn this off to avoid loading the WooCommerce assets (CSS and JS).', 'heap_txtd' ),
				'default'  => '1'
			),
			array(
				'id'       => 'display_product_filters',
				'type'     => 'switch',
				'title'    => __( 'Show Category Filter in Shop Page', 'heap_txtd' ),
				'subtitle' => __( 'Turn this On to have a product filter on the shop page.', 'heap_txtd' ),
				'default'  => '1'
			),
		)
	);
}

// Utilities - Theme Auto Update + Import Demo Data
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'       => "icon-truck",
	'icon_class' => '',
	'title'      => __( 'Utilities', 'heap_txtd' ),
	'desc'       => '<p class="description">' . __( 'Utilities help you keep up-to-date with new versions of the theme. Also you can import the demo data from here.', 'heap_txtd' ) . '</p>',
	'fields'     => array(
		array(
			'id'   => 'head-import-demo-21',
			'desc' => '<h3>' . __( 'Demo Data', 'heap_txtd' ) . '</h3>
				<p class="description">' . __( 'Here you can import the demo data and get on your way of setting up the site like the theme demo (images not included due to copyright).', 'heap_txtd' ) . '</p>',
			'type' => 'info'

		),
		array(
			'id'   => 'wpGrade_import_demodata_button',
			'type' => 'info',
			'desc' => '
                    <input type="hidden" name="wpGrade-nonce-import-posts-pages" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_posts_pages' ) . '" />
						<input type="hidden" name="wpGrade-nonce-import-theme-options" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_theme_options' ) . '" />
						<input type="hidden" name="wpGrade-nonce-import-widgets" value="' . wp_create_nonce( 'wpGrade_nonce_import_demo_widgets' ) . '" />
						<input type="hidden" name="wpGrade_import_ajax_url" value="' . admin_url( "admin-ajax.php" ) . '" />

						<a href="#" class="button button-primary button-demo" id="wpGrade_import_demodata_button">
							' . __( 'Import demo data', 'heap_txtd' ) . '
						</a>

						<div class="wpGrade-loading-wrap hidden">
							<span class="wpGrade-loading wpGrade-import-loading"></span>
							<div class="wpGrade-import-wait">
								' . __( 'Please wait a few minutes (between 1 and 3 minutes usually, but depending on your hosting it can take longer) and <strong>don\'t reload the page</strong>. You will be notified as soon as the import has finished!', 'heap_txtd' ) . '
							</div>
						</div>

						<div class="wpGrade-import-results hidden"></div>
						<div class="hr"><div class="inner"><span>&nbsp;</span></div></div>
					',
		),
		array(
			'id'   => 'head-theme-one-click',
			'desc' => __( '<h3>Theme One-Click Update</h3>
				<p class="description">' . __( 'Let us notify you when new versions of this theme are live on ThemeForest! Update with just one button click. Forget about manual updates!', 'heap_txtd' ) . '</p>', 'heap_txtd' ),
			'type' => 'info'
		),
		array(
			'id'       => 'themeforest_upgrade',
			'type'     => 'switch',
			'title'    => __( 'One-Click Update', 'heap_txtd' ),
			'subtitle' => __( 'Activate this to enter the info needed for the theme\'s one-click update to work.', 'heap_txtd' ),
			'default'  => true,
		),
		array(
			'id'       => 'marketplace_username',
			'type'     => 'text',
			'title'    => __( 'ThemeForest Username', 'heap_txtd' ),
			'hint'     => array( 'content' => __( 'Enter here your ThemeForest (or Envato) username account (i.e. pixelgrade).', 'heap_txtd' ) ),
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'       => 'marketplace_api_key',
			'type'     => 'text',
			'title'    => __( 'ThemeForest Secret API Key', 'heap_txtd' ),
			'hint'     => array( 'content' => __( 'Enter here the secret api key you\'ve created on ThemeForest. You can create a new one in the Settings > API Keys section of your profile.', 'heap_txtd' ) ),
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'       => 'themeforest_upgrade_backup',
			'type'     => 'switch',
			'title'    => __( 'Backup Theme Before Upgrade?', 'heap_txtd' ),
			'hint'     => array( 'content' => __( 'Check this if you want us to automatically save your theme as a ZIP archive before an upgrade. The directory those backups get saved to is <code>wp-content/envato-backups</code>. However, if you\'re experiencing problems while attempting to upgrade, it\'s likely to be a permissions issue and you may want to manually backup your theme before upgrading. Alternatively, if you don\'t want to backup your theme you can disable this.', 'heap_txtd' ) ),
			'default'  => '0',
			'required' => array( 'themeforest_upgrade', '=', 1 )
		),
		array(
			'id'   => 'admin-panel-options-title',
			'desc' => __( '<h3>Theme Options</h3>', 'heap_txtd' ),
			'type' => 'info'
		),
		array(
			'id'      => 'admin_panel_options',
			'type'    => 'switch',
			'default' => '0',
			'title'   => __( 'Theme Options Settings Import/Export', 'heap_txtd' ),
			'hint'    => array( 'content' => __( 'Here you can copy/download your current admin option settings. Keep this safe as you can use it as a backup should anything go wrong, or you can use it to restore your settings on this site (or any other site).', 'heap_txtd' ) ),
		),
		array(
			'id'       => 'theme_options_import',
			'type'     => 'import_export',
			'required' => array( 'admin_panel_options', '=', 1 )
		)
	)
);

// Help and Support
// ------------------------------------------------------------------------

$sections[] = array(
	'icon'       => "icon-cd-1",
	'icon_class' => '',
	'title'      => __( 'Help and Support', 'heap_txtd' ),
	'desc'       => '<p class="description">' . __( 'If you had anything less than a great experience with this theme please contact us now. You can also find answers in our community site, or official articles and tutorials in our knowledge base.', 'heap_txtd' ) . '</p>
		<ul class="help-and-support">
			<li>
				<a href="http://bit.ly/19G56H1">
					<span class="community-img"></span>
					<h4>Community Answers</h4>
					<span class="description">Get Help from other people that are using this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/19G5cyl">
					<span class="knowledge-img"></span>
					<h4>Knowledge Base</h4>
					<span class="description">Getting started guides and useful articles to better help you with this theme.</span>
				</a>
			</li>
			<li>
				<a href="http://bit.ly/new-ticket">
					<span class="community-img"></span>
					<h4>Submit a Ticket</h4>
					<span class="description">File a ticket for a personal response from our support team.</span>
				</a>
			</li>
		</ul>
	',
	'fields'     => array()
);


return $sections;
