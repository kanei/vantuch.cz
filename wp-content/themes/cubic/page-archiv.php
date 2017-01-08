<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 1/8/2017
 * Time: 11:11 AM
 */
get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main vantuch archive" role="main">

      <?php $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1)) ?>

      <?php if ( $wpb_all_query->have_posts() ) : ?>

      <!-- the loop -->
      <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
        <article>
          <div class="thumbnail">
            <?php the_post_thumbnail('boardwalk-archive-image') ?>
          </div>
          <header>
            <div class="posted-on"><?php the_date() ?></div>
            <h1>
              <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a>
            </h1></header>
        </article>
      <?php endwhile; ?>
      <!-- end of the loop -->

      <?php wp_reset_postdata(); ?>

    <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>