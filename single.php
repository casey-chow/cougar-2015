<?php get_header(); ?>
	
	<!-- Section -->
	<section>
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<!-- Post Title -->
			<h1 class="post__title post__title-type-single">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>
			<!-- /Post Title -->
			
			<!-- Post Details -->
      <div class="post__meta">
        <span class="post__meta__date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
        <span class="post__meta__author"><?php _e( 'Published by', 'cougar' ); ?> <?php the_author_posts_link(); ?></span>
        <span class="post__meta__comments"><?php comments_popup_link( __( 'Leave your thoughts', 'cougar' ), __( '1 Comment', 'cougar' ), __( '% Comments', 'cougar' )); ?></span>
      </div>
			<!-- /Post Details -->
			
			<?php the_content(); // Dynamic Content ?>
			
			<br class="clear">
			
			<?php the_tags( __( 'Tags: ', 'cougar' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
			
			<p><?php _e( 'Categorised in: ', 'cougar' ); the_category(', '); // Separated by commas ?></p>
			
      <?php edit_post_link(_e('Edit'), '<p class="post__edit">', '</p>'); ?>
			
			<?php comments_template(); ?>
			
		</article>
		
	<?php endwhile; ?>
	
	<?php else: ?>
	
    <article class="post post-state-empty">
			<h1><?php _e( 'Sorry, nothing to display.', 'cougar' ); ?></h1>
		</article>
	
	<?php endif; ?>
	
	</section>
	<!-- /Section -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
