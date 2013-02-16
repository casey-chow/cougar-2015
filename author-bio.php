<?php if (have_posts()): the_post(); ?>
  <h1><?php _e( 'Author Archives for ', 'cougar' ); echo get_the_author(); ?></h1>
  <?php if ( get_the_author_meta('description')) : ?>
    <?php echo get_avatar(get_the_author_meta('user_email')); ?>
    <h2><?php _e( 'About', 'cougar' ); echo get_the_author() ; ?></h2>
  <?php the_author_meta('description'); ?>
<?php endif; endif; ?>

<?php rewind_posts(); ?>
