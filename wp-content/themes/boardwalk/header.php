<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Boardwalk
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- facebook start -->
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'cs', includedLanguages: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<!-- facebook end -->
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'boardwalk' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php boardwalk_the_site_logo(); ?>
			<div class="clear">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div><!-- .site-branding -->
		<?php if ( is_active_sidebar( 'sidebar-1' ) || has_nav_menu( 'primary' ) ) : ?>
			<button class="sidebar-toggle" aria-expanded="false" ><span class="screen-reader-text"><?php _e( 'Toggle Sidebar', 'boardwalk' ); ?></span></button>
		<?php endif; ?>
	  	<?php /** facebook start **/ ?>
		<div class="fb-follow" data-href="https://www.facebook.com/cesta.do.australie" data-width="300px" data-height="70px" data-layout="standard" data-show-faces="false"></div>
		<!-- facebook end -->
		<!-- Instagram start -->
		<a href="http://instagram.com/doaustralie?ref=badge" class="ig-b- ig-b-24"><img src="//badges.instagram.com/static/images/ig-badge-24.png" alt="Instagram" /></a>
		<!-- Instagram end -->
		<!-- Translate start -->
		<div id="google_translate_element"></div>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<!-- Translate end -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">