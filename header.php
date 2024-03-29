<!DOCTYPE html>
<!--[if lt IE 7]>  <html <?php language_attributes(); ?> class="ie ie6 lt-ie9 lt-ie8 lt-ie7 no-js"> <![endif]-->
<!--[if IE 7]>     <html <?php language_attributes(); ?> class="ie ie7 lte-ie9 lt-ie8 lte-ie7 no-js"> <![endif]-->
<!--[if IE 8]>     <html <?php language_attributes(); ?> class="ie ie8 lt-ie9 lte-ie8 no-js"> <![endif]-->
<!--[if IE 9]>     <html <?php language_attributes(); ?> class="ie ie9 lte-ie9 no-js"> <![endif]-->
<!--[if gt IE 9]>  <html <?php language_attributes(); ?> class="no-js">  <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <!--
    1111111       444444444       000000000      333333333333333   
   1::::::1      4::::::::4     00:::::::::00   3:::::::::::::::33 
  1:::::::1     4:::::::::4   00:::::::::::::00 3::::::33333::::::3
  111:::::1    4::::44::::4  0:::::::000:::::::03333333     3:::::3
     1::::1   4::::4 4::::4  0::::::0   0::::::0            3:::::3
     1::::1  4::::4  4::::4  0:::::0     0:::::0            3:::::3
     1::::1 4::::4   4::::4  0:::::0     0:::::0    33333333:::::3 
     1::::l4::::444444::::4440:::::0     0:::::0    3:::::::::::3  
     1::::l4::::::::::::::::40:::::0     0:::::0    33333333:::::3 
     1::::l4444444444:::::4440:::::0     0:::::0            3:::::3
     1::::l          4::::4  0:::::0     0:::::0            3:::::3
     1::::l          4::::4  0::::::0   0::::::0            3:::::3
  111::::::111       4::::4  0:::::::000:::::::03333333     3:::::3
  1::::::::::1     44::::::44 00:::::::::::::00 3::::::33333::::::3
  1::::::::::1     4::::::::4   00:::::::::00   3:::::::::::::::33 
  111111111111     4444444444     000000000      333333333333333   
  -->  
  <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

  <!-- Meta -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

  <!-- CSS + jQuery + JavaScript -->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php if(get_option("cougar_bar_enabled")): ?>
<div class="notification-bar group">
  <a href="<?php echo get_option("cougar_bar_url"); ?>" class="notification-bar__message">
    <?php echo get_option("cougar_bar_message"); ?>
  </a>
</div>
<?php endif; ?>

<div class="wrapper group">

  <header class="header">

    <div class="banner__wrapper">

      <div class="banner row">

        <a class="banner__link twelve columns centered" href="<?php echo home_url(); ?>">
          <!-- http://toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
          <img class="banner__logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo">

          <!-- TODO: make it a media query download -->
          <img class="banner__header" src="<?php echo get_template_directory_uri(); ?>/img/header.svg" alt="Team 1403 Cougar Robotics: A FIRST® Robotics Team">
        </a>

        <div class="login-link__wrapper">
          <a href="<?php echo home_url(); ?>/wp-login.php" class="login-link">Login</a>
        </div>

      </div><!--/banner-->

    </div>

    <div class="nav__wrapper">
      <nav class="nav row">
        <?php cougar_nav(); ?>
  
        <select class="nav__mobile-list"></select>

        <a class="nav__twitter" href="http://twitter.com/team1403" title="Team 1403 on Twitter">
          <?php cougar_get_image(get_template_directory_uri().'/img/twitter.gif', array( 'alt' => 'Team 1403 on Twitter' )); ?>
        </a>
        <a class="nav__facebook" href="https://www.facebook.com/CougarRobotics1403" title="Team 1403 on Facebook">
          <?php cougar_get_image(get_template_directory_uri().'/img/facebook.gif', array( 'alt' => 'Team 1403 on Facebook' )); ?>
        </a>
      </nav>
    </div>

  </header><!-- /header -->
