    <article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
      
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
      </div>
      <!-- /Post Details -->
    

      <table border="0" class="properties-table">
        <thead>
          <tr>
            <td>Property</td>
            <td>Value</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Title</td>
            <td><?php the_title(); ?></td>
          </tr>
          <tr>
            <td>Uploaded By</td>
            <td><?php the_author_posts_link(); ?></td>
          </tr>
          <tr>
            <td>Caption</td>
            <td><?php echo balanceTags(the_excerpt()); ?></td>
          </tr>
          <tr>
            <td>Description</td>
            <td><?php echo balanceTags(get_the_content()); ?></td>
          </tr>
          <tr>
            <td>Direct Link</td>
            <td>
              <?php $image_src = wp_get_attachment_image_src( $post->ID, 'fullsize'); ?>
              <a href="<?php echo esc_url($image_src[0]); ?>">
                <?php echo esc_url($image_src[0]); ?>
              </a>
            </td>
          </tr>
        <?php 
          $meta = wp_get_attachment_metadata($post->ID);
          if($meta): foreach($meta['image_meta'] as $key => $value): 
            if($value != 0):
        ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
        <?php endif; endforeach; endif; ?>
        </tbody>
      </table>
      
      <?php edit_post_link(); ?>
      
    </article>
    
    <?php if (is_single()) comments_template(); ?>