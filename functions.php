<?php
/*
 *  Source Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *
 *  Author: Casey Chow
 *  URL: projectpancakes.org
 */

/*
 * ========================================================================
 * External Modules/Files
 * ========================================================================
 */

require_once(dirname(__FILE__) . '/inc/class-tgm-plugin-activation.php');
require_once(dirname(__FILE__) . '/inc/simple_section_nav.php');
require_once(dirname(__FILE__) . '/inc/truncate_html.php');
define('URL_REGEX', '/\b(?:(?:https?):\/\/|www\.|ftp\.)[-A-Z0-9+&@#\/%=~_|$?!:,.]*[A-Z0-9+&@#\/%=~_|$]/i');

/*
 * ========================================================================
 * Theme Support
 * ========================================================================
 */

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_editor_style')) {
  add_editor_style('editor-style.css');
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('header', 1000, 151, true);
    add_image_size('tall-header', 1000, 203, true);

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    add_theme_support('custom-background', array( 'default-color' => 'FFF' ));

    // Add Support for Custom Header - Uncomment below if you're going to use
    add_theme_support('custom-header', array(
      'default-image'          => get_template_directory_uri() . '/img/default_header.jpg',
      'header-text'            => true,
      'default-text-color'     => '000',
      'width'                  => 900,
      'flex-height'            => true,
      'height'                 => 150,
      'random-default'         => false,
      //'wp-head-callback'       => $wphead_cb,
      //'admin-head-callback'    => $adminhead_cb,
      //'admin-preview-callback' => $adminpreview_cb
    ));

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Enables Post Formats
    add_theme_support( 'post-formats', array( 'gallery', 'status', 'quote' ) );
    add_post_type_support( 'page', 'post-formats' );

    // Localisation Support
    load_theme_textdomain('cougar', get_template_directory() . '/languages');
}

/*
 * ========================================================================
 * Required Plugins
 * ========================================================================
 */

function cougar_register_required_plugins() {

	$plugins = array(

    array(
      'name'             => 'BJ Lazy Load',
      'slug'             => 'bj-lazy-load',
      'required'         => true,
      'force_activation' => true
    ),

    array(
      'name'             => 'Google Analyticator',
      'slug'             => 'google-analyticator',
      'required'         => false
    ),

    array(
      'name'             => 'Google Calendar Events',
      'slug'             => 'google-calendar-events',
      'required'         => true,
      'force_activation' => true
    ),

    array(
      'name'             => 'Insert PHP',
      'slug'             => 'insert-php',
      'required'         => false
    ),

    array(
      'name'             => 'Slim Jetpack',
      'slug'             => 'slimjetpack',
      'required'         => true
    ),
    
    array(
      'name'             => 'Wordpress SEO',
      'slug'             => 'wordpress-seo',
      'required'         => true
    )

  );

	$theme_text_domain = 'cougar';

	$config = array(
		'domain'           => 'cougar',                   // Text domain - likely want to be the same as your theme.
		'default_path'     => '',                         // Default absolute path to pre-packaged plugins
		'parent_menu_slug' => 'themes.php',               // Default parent menu slug
		'parent_url_slug'  => 'themes.php',               // Default parent URL slug
		'menu'             => 'install-required-plugins', // Menu slug
		'has_notices'      => false,                      // Show admin notices or not
		'is_automatic'     => false,                      // Automatically activate plugins after installation or not
		'message'          => ''                          // Message to output right before the plugins table
	);

	tgmpa( $plugins, $config );

}

/*
 * ========================================================================
 * Functions
 * ========================================================================
 */

// Cougar navigation
function cougar_nav()
{
  wp_nav_menu(
  array(
    'theme_location'  => 'header-menu',
    'menu'            => '', 
    'container'       => false, 
    'container_class' => 'menu-{menu slug}-container', 
    //'container_id'    => '',
    //'menu_class'      => 'fifteen columns fallback', 
    //'menu_id'         => '',
    'echo'            => true,
    //'fallback_cb'     => 'wp_page_menu', //if no menu selected
    'fallback_cb'     => false, 
    //'before'          => '',
    //'after'           => '',
    //'link_before'     => '',
    //'link_after'      => '',
    'items_wrap'      => '<ul class="nav__list fifteen columns">%3$s</ul>',
    'depth'           => 2,
    'walker'          => ''
    )
  );
}

function cougar_footer_links() { 
  $menu = wp_nav_menu(array(
    'menu'           => 'footer-links', /* menu name */
    'theme_location'  => 'footer-links',
    'menu'            => '', 
    'container'       => false, 
    'container_class' => 'menu-{menu slug}-container', 
    //'container_id'    => '',
    //'menu_class'      => 'fifteen columns fallback', 
    //'menu_id'         => '',
    'echo'            => true,
    //'fallback_cb'     => 'wp_page_menu', //if no menu selected
    'fallback_cb'     => false, 
    //'before'          => '',
    //'after'           => '',
    //'link_before'     => '',
    //'link_after'      => '',
    'items_wrap'      => '<ul class="footer__links">%3$s</ul>',
    'depth'           => 2,
    'walker'          => ''
  ));
}

// Load Custom Theme Scripts using Enqueue
function cougar_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array(), '1.8.3');
        wp_enqueue_script('jquery');

        wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.6.2');
        wp_enqueue_script('modernizr');

        wp_register_script('respond', get_template_directory_uri() . '/js/respond.js', array(), '1.0.0');
        wp_enqueue_script('respond');

        wp_register_script('foundation_forms', get_template_directory_uri() . '/js/jquery.foundation.forms.js', array('jquery'), '1.0', 'all');
        wp_enqueue_script('foundation_forms');

        wp_register_script('jquery_baseline', get_template_directory_uri() . '/js/jquery.baseline.js', array('jquery'), '1.0', 'all');
        wp_enqueue_script('jquery_baseline');

        wp_register_script('jquery_equalize', get_template_directory_uri() . '/js/jquery.equalize.js', array('jquery'), '1.0', 'all');
        wp_enqueue_script('jquery_equalize');

        wp_register_script('nivo_slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'), '3.2', 'all');
        wp_enqueue_script('nivo_slider');

        wp_register_script('touch_touch', get_template_directory_uri() . '/js/jquery.touchtouch.js', array('jquery'), '1.0', 'all');
        wp_enqueue_script('touch_touch');

        wp_register_script('cougarscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0');
        wp_enqueue_script('cougarscripts');
    }
}

// Loading Conditional Scripts
function conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional (pages/posts) script
        wp_enqueue_script('scriptname');
    }
}

// Theme Stylesheets using Enqueue
function cougar_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');

    wp_register_style('titillium', get_template_directory_uri() . '/fonts/titillium/stylesheet.css', array(), '1.0', 'all');
    wp_enqueue_style('titillium');

    wp_register_style('opensans', get_template_directory_uri() . '/fonts/opensans/stylesheet.css', array(), '1.0', 'all');
    wp_enqueue_style('opensans');

    wp_register_style('foundation', get_template_directory_uri() . '/css/foundation.css', array(), '3.2.5', 'all');
    wp_enqueue_style('foundation');
    
    wp_register_style('nivo_slider_css', get_template_directory_uri() . '/css/nivo-slider/nivo-slider.css', array(), '1.0', 'all');
    wp_enqueue_style('nivo_slider_css');

    wp_register_style('touch-touch', get_template_directory_uri() . '/css/touch-touch.css', array(), '1.0', 'all');
    wp_enqueue_style('touch-touch');

    wp_register_style('cougar', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('cougar');

    if (WP_DEBUG) {
        //wp_register_style('basehold', 'http://basehold.it/26', array(), '1.0', 'all');
        wp_enqueue_style('basehold');
    }
}

// jQuery Fallbacks load in the footer
function add_jquery_fallback()
{
    $jqueryfallback = "<!-- Protocol Relative jQuery fall back if Google CDN offline -->";
    $jqueryfallback .= "<script>";
    $jqueryfallback .= "window.jQuery || document.write('<script src=\"" . get_template_directory_uri() . "/js/jquery-1.8.3.min.js\"><\/script>')";
    $jqueryfallback .= "</script>";
    echo $jqueryfallback;
}

// Register HTML5 Blank's Navigation
function register_cougar_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'cougar'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'cougar'), // Sidebar Navigation
        'footer-links' => __('Footer Links') // secondary nav in footer
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'cougar'),
        'description'   => __('The main sidebar on the right of the content.', 'cougar'),
        'class'         => 'main-sidebar',
        'id'            => 'main-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));

    register_sidebar(array(
        'name'          => __('Front Events Section', 'cougar'),
        'description'   => __('Houses the events calendar on the front page', 'cougar'),
        'id'            => 'front-events-sidebar',
        'class'         => 'front-events',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function cougar_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base'    => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'  => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'type'    => 'list',
        'total'   => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function cougar_index($length) // Create 20 Word Callback for Index page Excerpts, call using cougar_excerpt('cougar_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using cougar_excerpt('cougar_custom_post');
function cougar_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function cougar_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    return $output;
}

// http://stackoverflow.com/a/1193598
function cougar_limit_text($html, $limit) {
  return truncateHtml($html, $limit);
}

// Custom View Article link to Post
function cougar_view_article()
{
    global $post;
    return '<p><a class="post__view-link" href="' . get_permalink($post->ID) . '">' . __('Read More', 'cougar') . '&hellip;</a></p>';
}

// Remove 'text/css' from our enqueued stylesheet
function cougar_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// https://gist.github.com/chrisguitarguy/2712643
function cougar_add_header_xua($headers)
{
  header( 'X-UA-Compatible: IE=edge,chrome=1' );
}

function cougar_breadcrumbs() {
  if (function_exists('yoast_breadcrumb')): ?>
    <section class="breadcrumbs__wrapper row">
      <nav class="column breadcrumbs">
        <?php yoast_breadcrumb("", "", true); ?>
      </nav>
      <span class="search-bar column">
        <a href="<?php echo get_bloginfo('wpurl'); ?>/search" class="search-bar__text">Search</a>
        <?php get_search_form(true); ?>
      </span>
    </section>
<?php endif;
}

// Custom Gravatar in Settings > Discussion
function cougar_gravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function cougar_comments($comment, $args, $depth)
{
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);
  
  if ( 'div' == $args['style'] ) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
  <<?php echo $tag ?> <?php comment_class('group' . (empty($args['has_children']) ? '' : 'comment--has-children')); ?> id="comment-<?php comment_ID() ?>">
  <?php if ( 'div' != $args['style'] ) : ?>
  <div id="div-comment-<?php comment_ID() ?>" class="comment__body">
  <?php endif; ?>
  <div class="comment__profile vcard">
    <cite class="fn"><?php comment_author(); ?></cite>
  </div>
<?php if ($comment->comment_approved == '0') : ?>
  <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
  <br />
<?php endif; ?>

  <div class="comment__meta">
    <a class="comment__date" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
      <?php /* translators: 1: date, 2: time */
      printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
    </a>
    <?php edit_comment_link(__('Edit'),'  ','' ); ?>
  </div>

  <?php comment_text() ?>

  <div class="comment__reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
  </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  <?php endif; ?>
<?php }


// http://wordpress.stackexchange.com/a/15994/13068
function cougar_is_plugin_active( $plugin ) {
  return in_array( $plugin, (array) get_option( 'active_plugins', array() ) );
}
function get_responsive_image($url) {
  if (function_exists('get_tinysrc_image')) {
    return get_tinysrc_image($url, false);
  } else { return $url; }
}

// Get Responsive and Lazy Image if Avilable
function cougar_get_image($url, $opts) {
  extract(wp_parse_args($opts, array(
    'class' => '',
    'alt' => '',
    'title' => '',
    'include_noscript' => true
  )));

  $is_lazy_load_active = cougar_is_plugin_active('bj-lazy-load/bj-lazy-load.php');

  if ($is_lazy_load_active) :
    echo '<img data-lazy-src="'.$url.'" class="'.$class.' lazy lazy-hidden" ' .
         'alt="'.$alt.'" title="'.$title.'" data-lazy-type="image" />';
    if ($include_noscript): 
      echo '<noscript><img src="'.$url.'" class="no-js '.$class.'" '.
           'alt="'.$alt.'" title="'.$title.'"/></noscript>';
    endif;
  else: 
    echo '<img src="'.$url.'" class="no-js '.$class.'" '.
         'alt="'.$alt.'" title="'.$title.'"/>';
  endif;
}

function get_sponsor_link($shortcode, $sponsor, $svg = false){
  $extension = $svg ? '.svg' : '.png';
  $url = get_template_directory_uri() . '/img/sponsors/' .$shortcode . $extension;
?>
  <li class="sponsors__sponsor <?php echo $shortcode; ?>">
    <a class="group sponsors__link sponsors__link--<?php echo $shortcode; ?>" href="<?php echo site_url(); ?>/about/sponsors/#<?php echo $shortcode ?>">
      <?php cougar_get_image($url, array(
        'alt' => $sponsor
      )); ?>
    </a>
  </li>
<?php
}



// Get the Post Title
function cougar_get_page_title() {
  global $wp_query;
  //ASSUME: We're in the loop.
  echo '<h1>';
  if (is_home()): 
    _e( 'Latest Posts', 'cougar' ); 
  elseif (is_tag()): 
    _e( 'Tag Archive: ', 'cougar' ); echo single_tag_title('', false); 
  elseif (is_category()): 
    single_cat_title();
  elseif (is_author()):
    get_template_part('author-bio'); 
  elseif (is_search()): 
    echo sprintf( __( '%s Search Results for ', 'cougar' ), $wp_query->found_posts ); echo get_search_query(); 
  elseif (is_date()):
    _e('Posts from ', 'cougar');
    if (is_day()) { the_date('F j, Y'); }
    elseif (is_month()) { the_date('F Y'); }
    elseif (is_year()) { the_date('Y'); }
    else { the_date('F j, Y g:i a'); }
  elseif (is_page()): 
    echo get_the_title() ? get_the_title() : '(no title)';
  elseif (is_single()): 
    echo get_the_title() ? get_the_title() : '(no title)';
  elseif (is_archive()): 
    _e( 'Archives', 'cougar' ); 
  endif; 
  echo '</h1>';
}

// http://wordpress.org/support/topic/get_-link-to-blog-page
function cougar_blog_posts_page() {
  if ( get_option('show_on_front') == 'page') {
    $posts_page_id = get_option('page_for_posts');
    echo get_page_uri($posts_page_id);
  } else {
    $posts_page_id = get_option('page_on_front');
    echo get_page_uri($posts_page_id);
  }
}

// http://wordpress.org/support/topic/limit-excerpt-length-by-characters
function cougar_front_page_excerpt() {
  $excerpt = get_the_content();
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $the_str = substr($excerpt, 0, 65);
  echo $the_str;
}

function cougar_events_sidebar($sidebar_id) {
  // http://stackoverflow.com/questions/1385954/do-wordpress-widget-or-sidebar-hooks-exist
  ob_start();

  $bool = dynamic_sidebar($sidebar_id);
  $link = '<a class="events__followup" href="'.site_url().'/events/calendar">Calendar</a>';

  if ( $bool ) {
    $str = ob_get_contents();
    $str = preg_replace('/(\<div .*?class=".*?widget_gce_widget.*?"\>.*?)(\<h3\>.*?\<\/h3\>)/', 
        '$1 <header class="events__header group">$2'.$link.'</header>', $str);
  } else {
    $str = '';
  }
  ob_end_clean();
  echo $str;
}
/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions
add_action('init', 'cougar_scripts'); // Add Custom Scripts
add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_footer', 'add_jquery_fallback', 5); // jQuery fallbacks loaded through footer
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'cougar_styles'); // Add Theme Stylesheet
add_action('init', 'register_cougar_menu'); // Add cougar Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'cougar_pagination'); // Add our HTML5 Pagination
add_action('tgmpa_register', 'cougar_register_required_plugins');

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'cougar_gravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
//add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'cougar_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'cougar_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
add_filter('send_headers', 'cougar_add_header_xua');
add_filter('the_content', 'cougar_gallery_remove_lazy', 100);
add_filter('simple_section_nav_title', 'cougar_in_this_section'); // replace the section title with "in this section"
add_filter('cougar_excerpt', 'force_balance_tags');
add_filter('cougar_excerpt', 'cougar_limit_text', 10, 2);

// 2 Filters
//remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('cougar-gallery', 'cougar_gallery'); // You can place [cougar_shortcode_demo] in Pages, Posts now.
//add_shortcode('cougar_shortcode_demo_2', 'cougar_shortcode_demo_2'); // Place [cougar_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [cougar_shortcode_demo] [cougar_shortcode_demo_2] Here's the page title! [/cougar_shortcode_demo_2] [/cougar_shortcode_demo]

/*
 * ========================================================================
 *  Shortcodes
 * ========================================================================
 */

// Shortcode Demo with Nested Capability
function cougar_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function cougar_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

/*
 * ========================================================================
 *  Header Image
 * ========================================================================
 */

function cougar_header_image_data($post, $size="header") {
  $postId = !is_home() ? $post->ID : get_option('page_for_posts');
  if ((is_single($postId) || is_page($postId) || is_home()) 
      && get_post_thumbnail_id($postId)
      && has_post_thumbnail($postId)):
    $image = wp_get_attachment_image_src(
        get_post_thumbnail_id($postId), $size);
    $image_post = get_post(get_post_thumbnail_id($postId));
    return array(
      'url' => $image[0],
      'title' => $image_post->post_title,
      'alt' => get_post_meta($image_post->ID, '_wp_attachment_image_alt', true),
      'description' => $image_post->post_content,
      'caption' => $image_post->post_excerpt
    );
  elseif (wp_attachment_is_image($postId)):
    $image = wp_get_attachment_image_src($postId, $size);
    $image_post = get_post($post -> ID);
    return array(
      'url' =>$image[0],
      'title' => $image_post->post_title,
      'alt' => get_post_meta($image_post->ID, '_wp_attachment_image_alt', true),
      'description' => $image_post->post_content,
      'caption' => $image_post->post_excerpt
    );
  else:
    // Doesn't have it. we'll revert back to the generic header image
    // ASSUME: The site has a default header image.
    return array(
      'url' => get_header_image(),
      'alt' => 'Team 1403: Cougar Robotics',
      'title' => '',
      'caption' => ''
    );
  endif; 
}

function cougar_header_gallery($post) {
  $attachments = get_children(array(
                'post_parent' => $post->ID, 'post_status' => 'inherit', 
                'post_type' => 'attachment', 'post_mime_type' => 'image', 
                'order' => 'ASC', 'orderby' => 'menu_order ID'
              ));
  ?>
  <div class="fifteen columns header-image__image slider-wrapper theme-default">
  <div class="gallery--type-header nivoSlider">
  <?php foreach ( $attachments as $id => $attachment ): 
    $img_data = cougar_header_image_data($attachment, 'tall-header');
    $is_link = preg_match(URL_REGEX, $img_data['description']) === 1;
    if ($is_link) { 
      $open_anchor = '<a href="'.$img_data['description'].'">';
      $img_data['caption'] = esc_attr($open_anchor . $img_data['caption'] . '</a>'); //for the caption
      echo $open_anchor; //for the actual image
    }
    cougar_get_image($img_data['url'], array(
      'alt' => $img_data['alt'],
      'title' => $img_data['caption'],
      'include_noscript' => false
    ));
    if ($is_link) { echo '</a>'; }
  endforeach; ?>
  </div></div>
  <?php
}

function cougar_page_has_banner_text($post) {
  return ((is_single($post->ID) || is_page($post->ID)) 
    && has_post_thumbnail($post->ID)
    && ($image_post = get_post(get_post_thumbnail_id($post -> ID)))
    && $image_post->post_title !== '')
  || (is_attachment() 
    && ($image = wp_get_attachment_image_src($post->ID, 'header'))
    && get_post($post -> ID));
}

function cougar_gallery($atts) {
  global $post;
  // defaults
  extract(shortcode_atts( array(
    'script' => 'nivo',
    'ids' => implode(',', array_keys(get_children(array(
              'post_parent' => $post->ID, 'post_status' => 'inherit', 
              'post_type' => 'attachment', 'post_mime_type' => 'image', 
              'order' => 'ASC', 'orderby' => 'menu_order ID'
            )))),
    'theme' => 'default'
  ), $atts ));

  $ids = explode(',', $ids);
?>
  <div class="theme-<?php echo $theme; ?> group gallery__wrapper">
    <div class="gallery--type-slider nivoSlider">
    <?php foreach ( $ids as $id ): 
      $img_data = cougar_header_image_data(get_post($id), 'large'); ?>
      <img src="<?php echo $img_data['url']; ?>" 
          title="<?php echo $img_data['title']; ?>" alt="<?php echo $img_data['alt']; ?>">
    <?php endforeach; ?>
    </div>
  </div>
<?php
}

function cougar_gallery_remove_lazy($content) {
  $matches = array();
  preg_match_all( '/<div class="tiled-gallery-item\s+.*?<\/div>/', $content, $matches );

  $search = array();
  $replace = array();

  foreach ( $matches[0] as $imgHTML ) {

    //if ( preg_match( '/<img.*? class="/i', $imgHTML ) ) {
      //$replaceHTML = preg_replace( '/<img(.*?)class="(.*?)"/i', '<img $1 class="lazy-skip $2"', $imgHTML );
    //} else {
      $replaceHTML = preg_replace( '/<img/i', '<img class="lazy-skip"', $imgHTML );
    //}

    array_push( $search, $imgHTML );
    array_push( $replace, $replaceHTML );
  }

  $content = str_replace( $search, $replace, $content );

  //$content = preg_replace( '#<div class="tiled-gallery-item\s+.*?<\/div>#', '', $content);
  return $content;
}

function cougar_in_this_section($content) {
  return 'In This Section';
}
?>
