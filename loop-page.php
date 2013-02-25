<?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
    <?php if (function_exists('simple_section_nav')) {
      simple_section_nav('before_widget=<nav class="group section-nav">&after_widget=</nav>&before_title=<h2 class="section-nav__title">&after_title=</h2>'); 
    } ?>

    <?php the_content(); ?>
    
    <?php comments_template( '', true ); // Remove if you don't want comments ?>

    <?php edit_post_link(); ?>
  </article>
  
<?php endwhile; ?>

<?php else: ?>
  <article>
    <h2><?php _e( 'Sorry, nothing to display.', 'cougar' ); ?></h2>
  </article>
<?php endif; ?>
