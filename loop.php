<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
    <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
      
      <!-- Post Title -->
      <?php if (!is_single()): ?>
      <h2 class="post__title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php echo trim(get_the_title()) == '' ? "(no title)" : get_the_title(); ?>
        </a>
      </h2>
      <?php endif; ?>
      <!-- /Post Title -->
      
      <!-- Post Details -->
      <div class="post__meta">
        <?php _e('posted', 'cougar'); ?>
        <time class="post__meta__date" datetime="<?php the_time('c'); ?>"><?php the_time('F j, Y'); ?></time>
        <?php _e('by', 'cougar'); ?>
        <span class="post__meta__author"> <?php the_author_posts_link(); ?></span>
        <?php if (has_category()): ?>
          <span class="post__meta__categories">
            <?php _e('filed under ', 'cougar'); the_category(', ', 'single'); ?>
          </span>
        <?php endif; ?>
        <?php if(comments_open()): ?>
          <span class="post__meta__comments">
            <?php comments_popup_link( __( 'Leave your thoughts', 'cougar' ), __( '1 Comment', 'cougar' ), __( '% Comments', 'cougar' )); ?>
          </span>
        <?php endif; ?>
      </div>
      <!-- /Post Details -->
    
      <!-- Post Thumbnail -->
      <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
        <a class="post__thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php the_post_thumbnail('medium'); // Declare pixel size you need inside the array ?>
        </a>
      <?php endif; ?>
      <!-- /Post Thumbnail -->
      
      <?php if (is_single()): ?>
        <?php the_content('<span>Read more</span>'); ?>
      <?php else: ?>
        <?php cougar_excerpt('cougar_index'); ?>
      <?php endif; ?>
      
      <?php edit_post_link(); ?>
      
    </article>
    
    <?php if (is_single()) comments_template(); ?>
	
<?php endwhile; ?>
<?php else: ?>
    <article class="post post-state-empty">
      <h2><?php _e( 'Sorry, nothing to display.', 'cougar' ); ?></h2>
    </article>
<?php endif; ?>
