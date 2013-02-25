<?php get_header(); ?>

  <section class="header-image row">
      <img class="header-image__image fifteen columns" src="<?php echo get_template_directory_uri(); ?>/img/404_header.jpg" alt="A lego robot" />

      <div class="header-image__overlay group">
        <div class="header-image__inner">
          <h1 class="header-image__overlay__title">Couldn't find the page, sorry.</h1>
          <p class="header-image__overlay__caption">However, we did find this beautiful Lego robot.</p>
        </div>
      </div>
  </section>
  <?php cougar_breadcrumbs(); ?>
<!-- Section -->
<section>
  <section class="main row">
    <section class="fifteen columns content page--content post--type-<?php echo get_post_type(); ?>">
    
      <header class="post__title">
        <h1><?php _e( '404 Error', 'cougar' ); ?></h1>
      </header> <!-- /.post__title -->
      
      <p>We have searched the deepest depths of our databases, the far reaches of our server room, but we could not find the page you searched for.</p>
      <p>However, from here, there are several ways to continue your journey for knowledge. Please try either searching with the search bar below or browsing through our website for the page you're looking for.</p>
      <p>Good luck.</p>
    
      <?php get_search_form(true); ?>

    </section><!--/.content-->

  </section><!-- /.main -->

<?php get_footer(); ?>
