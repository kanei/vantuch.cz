<?php
/**
 * @package Boardwalk
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && ! has_post_format( 'video' ) ) : ?>
		<div class="entry-thumbnail">
			<?php echo get_the_post_thumbnail( get_the_ID(), 'boardwalk-hero-image' ); ?>
		</div><!-- .entry-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<div class="entry-meta">
			<?php boardwalk_entry_meta(); ?>
		</div><!-- .entry-meta -->
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'boardwalk' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'boardwalk' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( 1 == get_theme_mod( 'boardwalk_author_bio' ) && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php boardwalk_entry_footer(); ?>
		<div id="jp-relatedposts" class="jp-relatedposts" style="display: block;">
			<h3 class="jp-relatedposts-headline"><em>Sledujte naši cestu na Facebooku:</em></h3>
			<div class="fb-page" data-href="https://www.facebook.com/cesta.do.australie/" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
				<div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/cesta.do.australie/">
						<a href="https://www.facebook.com/cesta.do.australie/">Do Austrálie</a>
					</blockquote>
				</div>
			</div>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
