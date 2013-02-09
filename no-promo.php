<?php 
/* Template Name: No Featured Image */
get_header(); ?>

  <section class="main row">
    <section class="ten columns content page--content post--type-<?php echo get_post_type(); ?>">
    
      <header class="post__title">
        <?php cougar_get_page_title(); ?>
      </header> <!-- /.post__title -->
    
      <?php get_template_part('loop', get_post_type()); ?>
      
      <div id="pagination">
        <?php cougar_pagination(); ?>
      </div><!--/pagination-->
	
    </section><!--/.content-->

    <?php get_sidebar(); ?>
  </section?><!-- /.main -->

<?php get_footer(); ?>