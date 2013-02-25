<?php get_header(); ?>

  <?php get_template_part('promo', 'image'); ?>
  <?php cougar_breadcrumbs(); ?>
	
  <section class="main row">
    <section class="page__image seven columns">
          <?php echo wp_get_attachment_image($post->ID, 'large-feature'); ?>
    </section>
    <section class="eight columns content page--content post--type-<?php echo get_post_type(); ?>">
    
      <header class="post__title">
        <?php cougar_get_page_title(); ?>
      </header> <!-- /.post__title -->
    
      <?php get_template_part('loop', 'image'); ?>
	
    </section><!--/.content-->

  </section><!-- /.main -->

<?php get_footer(); ?>
