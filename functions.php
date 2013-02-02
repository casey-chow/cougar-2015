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

	// Load any external files you have here

/*
 * ========================================================================
 * Theme Support
 * ========================================================================
 */

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('header', 900, 150, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    add_theme_support('custom-background', array( 'default-color' => 'FFF' ));

    // Add Support for Custom Header - Uncomment below if you're going to use
    add_theme_support('custom-header', array(
      'default-image'          => get_template_directory_uri() . '/img/headers/default.jpg',
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

    // Localisation Support
    load_theme_textdomain('cougar', get_template_directory() . '/languages');
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
		'menu_class'      => 'fifteen columns fallback', 
		//'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu', //if no menu selected
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

// Load Custom Theme Scripts using Enqueue
function cougar_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array(), '1.8.3');
        wp_enqueue_script('jquery');

        wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.6.2');
        wp_enqueue_script('modernizr');

        wp_register_script('prefixfree', get_template_directory_uri() . '/js/prefixfree.min.js', array(), '1.0.0');
        wp_enqueue_script('prefixfree');

        wp_register_script('foundation_forms', get_template_directory_uri() . '/js/jquery.foundation.forms.js', array(), '1.0', 'all');
        wp_enqueue_script('foundation_forms');

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
    
    wp_register_style('cougar', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('cougar');

    if (WP_DEBUG) {
        wp_register_style('basehold', 'http://basehold.it/24', array(), '1.0', 'all');
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
        'extra-menu' => __('Extra Menu', 'cougar') // Extra Navigation if needed (duplicate as many as you need!)
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
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'cougar'),
        'description' => __('Description for this widget-area...', 'cougar'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'cougar'),
        'description' => __('Description for this widget-area...', 'cougar'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
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
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
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
    echo $output;
}

// Custom View Article link to Post
function cougar_view_article($more)
{
    global $post;
    return '... <a class="post__view-link" href="' . get_permalink($post->ID) . '">' . __('Read More', 'cougar') . '</a>';
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
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			/* translators: 1: date, 2: time */
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


// Get Responsive Image if Avilable
function cougar_get_responsive_image($url) {
  if (function_exists('get_tinysrc_image')) {
    return get_tinysrc_image($url, false);
  } else { 
    return $url; 
  }
}

/*
 * ========================================================================
 * Actions + Filters + ShortCodes
 * ========================================================================
 */

// Add Actions
add_action('init', 'cougar_scripts'); // Add Custom Scripts
add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_footer', 'add_jquery_fallback'); // jQuery fallbacks loaded through footer
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'cougar_styles'); // Add Theme Stylesheet
add_action('init', 'register_cougar_menu'); // Add cougar Blank Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'cougar_pagination'); // Add our HTML5 Pagination

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
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'cougar_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('style_loader_tag', 'cougar_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
//add_shortcode('cougar_shortcode_demo', 'cougar_shortcode_demo'); // You can place [cougar_shortcode_demo] in Pages, Posts now.
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

function cougar_header_image_data($post) {
  if ( is_singular() 
    && has_post_thumbnail($post->ID)
    // has a large-feature size image
    && ($image = wp_get_attachment_image_src(get_post_thumbnail_id($post-> ID), 'large-feature'))
    // has an alt text
    && ($image_post = get_post(get_post_thumbnail_id($post -> ID)))
  ):
    return array(
      'url' => cougar_get_responsive_image($image[0]),
      'alt' => $image_post->post_content
    );
  else:
    // Doesn't have it. we'll revert back to the generic header image
    // ASSUME: The site has a default header image.
    return array(
      'url' => cougar_get_responsive_image(get_header_image()),
      'alt' => "Team 1403: Cougar Robotics"
    );
  endif; 
}

function cougar_header_banner_text($post) {
  $banner_text = '';
  if ( is_singular()
    && has_post_thumbnail($post->ID)
    && ($image_post = get_post(get_post_thumbnail_id($post -> ID)))
  ): 
    return array(
      'title' => $image_post->post_title,
      'caption' => $image_post->post_excerpt
    );
  endif;
}

?>
