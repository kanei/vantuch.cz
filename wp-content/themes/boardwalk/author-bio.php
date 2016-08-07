<?php
/**
 * The template for displaying Author bio
 *
 * @package Boardwalk
 */
?>

<div class="entry-author">
	<h2 class="author-heading"><?php printf( __( 'Nabloggoval(a) %s', 'boardwalk' ), get_the_author() ); ?></h2>

	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'boardwalk_author_bio_avatar_size', 48 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<span class="author-link"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'Zobrazit další články od %s', 'boardwalk' ), get_the_author() ); ?></a></span>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .entry-author -->

<div class="entry-adsense">
	<!-- Responsive -->
	<ins class="adsbygoogle"
		 style="display:block"
		 data-ad-client="ca-pub-8650917758207848"
		 data-ad-slot="2916869352"
		 data-ad-format="auto"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</div>