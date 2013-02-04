<?php get_header(); ?>
	
  <?php get_template_part('promo'); ?>
  <?php cougar_breadcrumbs(); ?>

  <section class="main row">
    <section class="ten columns content page--content">
    
      <h1><?php the_title(); ?></h1>
    
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    
      <!-- Article -->
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
        <?php the_content(); ?>
        
        <?php comments_template( '', true ); // Remove if you don't want comments ?>
        
        <br class="clear">
        
        <?php edit_post_link(); ?>
        
      </article>
      <!-- /Article -->
      
    <?php endwhile; ?>
    
    <?php else: ?>
      <article>
        <h2><?php _e( 'Sorry, nothing to display.', 'cougar' ); ?></h2>
      </article>
    <?php endif; ?>
    
    </section><!-- /.content -->

    <?php get_sidebar(); ?>
  </section?><!-- /.main -->
	

<?php get_footer(); ?>
