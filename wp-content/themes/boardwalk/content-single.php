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

<!--	<div class="entry-ads-column">-->
<!--		<!-- Column -->-->
<!--		<ins class="adsbygoogle"-->
<!--			 style="display:inline-block;width:300px;height:600px"-->
<!--			 data-ad-client="ca-pub-8650917758207848"-->
<!--			 data-ad-slot="4254001755"></ins>-->
<!--		<script>-->
<!--			(adsbygoogle = window.adsbygoogle || []).push({});-->
<!--		</script>-->
<!--	</div>-->
	
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
		<!-- Responsive -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-8650917758207848"
			 data-ad-slot="2916869352"
			 data-ad-format="auto"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
