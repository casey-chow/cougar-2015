<?php get_header(); ?>

  <section class="header-image row">
    <?php cougar_header_gallery($post); ?>
  </section>
  <?php cougar_breadcrumbs(); ?>
	
  <section class="latest-posts front-page-block">
    <div class="latest-posts__header__wrapper row">
    </div>
  </section><!--/.latest-posts-->

  <div class="events-info__wrapper row">
    <section class="events five columns front-page-block">
      <div class="latest-posts front-page-block">
        <header class="latest-posts__header">
          <h3>Posts</h3>
          <a class="latest-posts__followup" href="<?php cougar_blog_posts_page(); ?>">Blog</a>
        </header>
        <section class="latest-posts__list">
          <?php $posts = get_posts(array(
            'posts_per_page'  => 3,
            'offset'          => 0,
            'orderby'         => 'post_date',
            'order'           => 'DESC',
            'suppress_filters' => true 
          )); ?>
          <?php foreach($posts as $post) : setup_postdata($post); ?>
          <article class="latest-posts__post">
            <a class="post__link group" href="<?php the_permalink(); ?>">
              <h4 class="post__title"><?php the_title(); ?></h4>
              <p class="post__excerpt"><?php cougar_front_page_excerpt(); ?></p>
              <span class="post__followthrough">Read More</span>
            </a>
          </article>
          <?php endforeach; wp_reset_postdata(); ?>
        </section>
      </div>
      <?php if(function_exists('dynamic_sidebar')): ?>
        <?php dynamic_sidebar('front-events-sidebar'); ?>
      <?php endif; ?>
    </section>
    <section class="info nine columns offset-by-one front-page-block">
      <h3><?php _e('Information', 'cougar'); ?></h3>
      <?php the_content(); ?>
    </section>
  </div><!--/.events-info__wrapper">

<?php get_footer(); ?>
