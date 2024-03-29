<?php /* Template Name: Gallery Header Image */
get_header(); ?>

  <section class="header-image row">
    <?php cougar_header_gallery($post); ?>
  </section>
	
  <section class="main row">
    <section class="ten columns content page--content post--type-<?php echo get_post_type(); ?>">
    
      <header class="post__title">
        <?php cougar_get_page_title(); ?>
      </header> <!-- /.post__title -->
    
      <?php get_template_part('loop', is_page() ? 'page' : ''); ?>
      
      <div class="pagination">
        <?php cougar_pagination(); ?>
      </div><!--/pagination-->
	
    </section><!--/.content-->

    <?php get_sidebar(); ?>
  </section><!-- /.main -->

<?php get_footer(); ?>
