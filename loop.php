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
      
      <?php if(has_post_format('gallery') && !is_single()): ?>
          <?php $images = get_children(array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ));
            if ( $images ) :
              $total_images = count( $images );
              $image = array_shift($images);
              $image_img_tag = wp_get_attachment_image( $image->ID, 'medium' );
          ?>

          <div class="post__gallery-thumb">
            <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
          </div>

          <p class="post__gallery-text">
            <?php printf( _n( 'This gallery has <a %1$s>%2$s photo</a>.', 'This gallery has <a %1$s>%2$s photos</a>.', $total_images, 'twentyeleven' ),
            'href="'.get_permalink().'"', number_format_i18n( $total_images )); ?>
          </p>
        <?php endif; ?>
        <?php the_excerpt(); ?>
      <?php elseif (is_single()): ?>
        <?php the_content(); ?>
      <?php else: ?>
        <?php echo cougar_limit_text(apply_filters('the_content', get_the_content()), 100) . cougar_view_article(); ?>
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
