<?php get_header(); ?>

<!-- Section -->
<section>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<h1><?php _e( 'Page not found', 'cougar' ); ?></h1>
		<h2><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'cougar' ); ?></a></h2>
		
	</article>
	<!-- /Article -->
	
</section>
<!-- /Section -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
