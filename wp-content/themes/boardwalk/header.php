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
<meta name="description" content="Cestovatelský a motorkářský blog soustředící se na vyprávění a fotografii."
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'boardwalk' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="clear">
				<?php boardwalk_the_site_logo(); ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div><!-- .site-branding -->
		<?php if ( is_active_sidebar( 'sidebar-1' ) || has_nav_menu( 'primary' ) ) : ?>
			<button class="sidebar-toggle" aria-expanded="false" ><span class="screen-reader-text"><?php _e( 'Toggle Sidebar', 'boardwalk' ); ?></span></button>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" role="navigation">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'primary',
					) );
				?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>

		<?php /** Translate start */ ?>
		<div class="translate">
			<form action="http://www.google.com/translate" >
				<input name="u" value="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" type="hidden" />
				<input name="hl" value="en" type="hidden" />
				<input name="ie" value="UTF8" type="hidden" />
				<input name="sandbox" value="0" type="hidden" />
				<input name="langpair" value="" type="hidden" />
				<input name="langpair" value="cs|en" title="English" src= "/wp-content/themes/boardwalk/image/uk.png" onclick="this.form.langpair.value=this.value" height="30" type="image" width="30" />
			</form>
		</div>
		<?php /** Translate end */ ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">