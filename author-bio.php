<?php if (have_posts()): the_post(); ?>
  <h1><?php echo get_the_author(); ?><small>, <?php _e( 'Author', 'cougar' ); ?></small></h1>
  <?php if ( get_the_author_meta('description')) : ?>
    <section class="author-bio group">
      <?php echo get_avatar(get_the_author_meta('user_email')); ?>
      <p>
        <?php the_author_meta('description'); ?>
      </p>
    </section>
<?php endif; endif; ?>

<?php rewind_posts(); ?>
