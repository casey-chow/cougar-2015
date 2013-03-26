
  <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
    <?php $hide_section = get_post_meta($post->ID, 'hide_section_nav', true);
    if (function_exists('simple_section_nav') && !$hide_section) {
      simple_section_nav('before_widget=<nav class="group section-nav">&after_widget=</nav>&before_title=<h2 class="section-nav__title">&after_title=</h2>'); 
    } ?>

    <?php the_content(); ?>
    
    <?php comments_template( '', true ); // Remove if you don't want comments ?>

    <?php edit_post_link(); ?>
  </article>
