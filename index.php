<?php get_header(); ?>

  <?php get_template_part('promo'); ?>
	
	<section class="content blog--content">
	
		<h1><?php _e( 'Latest Posts', 'cougar' ); ?></h1>
	
		<?php get_template_part('loop'); ?>
		
		<div id="pagination">
			<?php cougar_pagination(); ?>
		</div><!--/pagination-->
	
	</section><!--/.content-->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>
