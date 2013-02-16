<section class="comments">
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'cougar' ); ?></p>
</div>
	<?php return; endif; ?>

<?php if (have_comments()) : ?>

	<h2 class="comments__title"><?php comments_number(); ?></h2>
	<ul>
		<?php wp_list_comments('type=comment&callback=cougar_comments'); // Custom callback in functions.php ?>
	</ul>

  <?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p><?php _e( 'Comments are closed here.', 'cougar' ); ?></p>
  <?php endif; ?>

  <?php comment_form(); ?>

</section>
