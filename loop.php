<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
      <!-- Post Thumbnail -->
      <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
        <a class="post__thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
        </a>
      <?php endif; ?>
      <!-- /Post Thumbnail -->
      
      <!-- Post Title -->
      <?php if (!is_single()): ?>
      <h2 class="post__title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h2>
      <?php endif; ?>
      <!-- /Post Title -->
      
      <!-- Post Details -->
      <div class="post__meta">
        <span class="post__meta__date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
        <span class="post__meta__author"><?php _e( 'Published by', 'cougar' ); ?> <?php the_author_posts_link(); ?></span>
        <span class="post__meta__comments"><?php comments_popup_link( __( 'Leave your thoughts', 'cougar' ), __( '1 Comment', 'cougar' ), __( '% Comments', 'cougar' )); ?></span>
      </div>
      <!-- /Post Details -->
      
      <?php if (is_single()): ?>
        <?php the_content('<span>Read more</span>'); ?>
      <?php else: ?>
        <?php cougar_excerpt('cougar_index'); ?>
      <?php endif; ?>
      
      <?php edit_post_link(); ?>
    </article>
	
<?php endwhile; ?>
<?php else: ?>
    <article class="post post-state-empty">
      <h2><?php _e( 'Sorry, nothing to display.', 'cougar' ); ?></h2>
    </article>
<?php endif; ?>
