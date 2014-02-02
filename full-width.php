<?php 
/* Template Name: Full Width */
get_header(); ?>

  <?php get_template_part('promo'); ?>
  <?php cougar_breadcrumbs(); ?>
	
  <section class="main row">
    <section class="fifteen columns content page--content post--type-<?php echo get_post_type(); ?>">
    
      <header class="post__title">
        <?php cougar_get_page_title(); ?>
      </header> <!-- /.post__title -->

      <?php if (have_posts()): while (have_posts()) : the_post(); ?>

        <?php get_template_part('loop', is_page() ? 'page' : get_post_format()); ?>
             
      <?php endwhile; else: ?>
        <article class="post post-state-empty">
          <h2><?php _e( 'Sorry, nothing to display.', 'cougar' ); ?></h2>
        </article>
      <?php endif; ?>

      <div id="pagination">
        <?php cougar_pagination(); ?>
      </div><!--/pagination-->
	
    </section><!--/.content-->

  </section?><!-- /.main -->

<?php get_footer(); ?>
