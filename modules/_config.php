<?php
define('MODULE_PATH', get_template_directory_uri() . '/modules/');

require_once ('products-post-type.php');
require_once ('archive-menu-support.php');
require_once ('top-products-page/index.php');
require_once ('ratings/index.php');
require_once ('references/index.php');
require_once ('add-css/add-css-js.php');
require_once ('custom_fields.php');
require_once ('contact/index.php');
require_once ('buy-table/index.php');
require_once ('hero.php');

//require_once( 'custom_fields.php' );



/** Shortcodes */
require_once ('shortcodes.php');
require_once ('hooks.php');
require_once ('upsells.php');

// Theme options
require_once ('theme_options.php');

$themeOptions = get_option('theme_options');
if (!empty($themeOptions['gaID'])) {
    require_once ('google_analytics.php');
}
if (!empty($themeOptions['optimizelyID'])) {
    require_once ('optimizely.php');
}
require_once ('fonts.php');

// Auto create cats
require_once (ABSPATH . '/wp-config.php');
require_once (ABSPATH . '/wp-includes/wp-db.php');
require_once (ABSPATH . '/wp-admin/includes/taxonomy.php');
wp_create_category('recommended');

// force no date folders
add_filter('option_uploads_use_yearmonth_folders', '__return_false', 100);

//set permalinks
add_action('init', function () {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
});

// flushes permalinks after theme switch/activation
add_action('after_switch_theme', 'flush_rewrite_rules');

// Miscellaneous
function theme_scripts_admin() {
    wp_enqueue_style('theme-styles', MODULE_PATH . 'assets/' . 'styles.css');
    wp_register_script('meta-box-image', MODULE_PATH . 'assets/' . 'scripts.js', array('jquery'));
    wp_enqueue_script('meta-box-image');
}
add_action('admin_enqueue_scripts', 'theme_scripts_admin');
add_image_size('upsell-image', 90, 160);
add_image_size('review-product-image', 90, 500);

function add_mcafee() {
    wp_enqueue_script( 'script-name', 'https://cdn.ywxi.net/js/1.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'add_mcafee' );

//create contact page
function create_front_page() {
    if (!get_page_by_title('Front Page')) {
        $postID = wp_insert_post(array('post_type' => 'page', 'post_title' => 'Front Page', 'post_content' => '', 'post_name' => 'front-page', 'post_status' => 'publish'));
        if ($postID !== 0) {
            add_post_meta($postID, 'custom_hero_html_custom_hero_html', '<div class="row"><div class="medium-14 small-24 columns"><h1>HEADLINE GOES <span class="color-head">HERE</span></h1><h2>Sub headline goes here</h2><a href="" class="tiny button radius">Go to #1 Product</a><h2>Sub-sub headline goes here.</h2><p>There are hundreds of different products on the market today, and finding one that\'s worth your time and money can seem impossible. Going in without help just leads to losing money, without any results to show for it.</p></div><div class="medium-9 columns seal-img hide-for-small">image goes here</div></div><div class="row"><div class="small-24 columns"><ul><li>Overall Value</li><li>Patented Ingredients</li><li>Ingredient Quality</li><li>Formulation Power</li><li>Manufacturing Practices</li><li>Customer Reviews</li><li>Safety & Side Effects</li><li>Money Back Guarantee</li><li>Price</li></ul><h2>Best [niche]s At The Best Prices Or Your Money Back!</h2><p>But we didn\'t stop with simple ratings. We scoured hundreds of stores to find the best prices and special offers to make sure you can pick the absolute best deal.</p><p>Keep reading to discover the [niche]s of [year]!</p></div></div>');
        }
    }
}
add_action('after_switch_theme', 'create_front_page');

function create_contact() {
    if (!get_page_by_title('Contact')) {
        wp_insert_post(array('post_type' => 'page', 'post_title' => 'Contact', 'post_content' => "<h1>Contact Us</h1> [contact_form]", 'post_name' => 'contact', 'post_status' => 'publish'));
    }
}
add_action('after_switch_theme', 'create_contact');

//set front page to front page
function set_front_page() {
    $homepage = get_page_by_title('Front Page');
    if ($homepage) {
        update_option('page_on_front', $homepage->ID);
        update_option('show_on_front', 'page');
    }
}
add_action('after_switch_theme', 'set_front_page');

// function set_order() {
//     $fpid = get_option('page_on_front');

//     if ( get_post_meta($fpid, 'top-products-list', true) != '' ) {
//         if (!add_post_meta($fpid, 'top-products-list', '1,2,3,4,5', true)) {
//             update_post_meta($fpid, 'top-products-list', '1,2,3,4,5');
//         }
//     }
// }
// add_action('after_switch_theme', 'set_order');

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
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('body_class','out_of_stock_class');
function out_of_stock_class( $classes ) {
    global $post;
    if ( is_singular('products') && ( get_post_meta( $post->ID, 'out-of-stock', true ) == 'yes' ) ) {
        $classes[] = 'out-of-stock';
    }
    return $classes;
}

function preloadCart () {
    if ( is_singular('products') ) {
        echo '<link rel="prefetch" href="' . do_shortcode('[cart_url]') . '">';
        echo '<link rel="prerender" href="'. do_shortcode('[cart_url]') .'">';
    }
}
add_filter('wp_footer', 'preloadCart');


// Custom Page Titles
add_action('admin_menu', 'custom_title');
add_action('save_post', 'save_custom_title');
add_action('wp_head','insert_custom_title');
function custom_title() {
    add_meta_box('custom_title', 'SEO PAGE TITLE', 'custom_title_input_function', 'products', 'normal', 'high');
    add_meta_box('custom_title', 'SEO PAGE TITLE', 'custom_title_input_function', 'page', 'normal', 'high');
}
function custom_title_input_function() {
    global $post;
    echo '<input type="hidden" name="custom_title_input_hidden" id="custom_title_input_hidden" value="'.wp_create_nonce('custom-title-nonce').'" />';
    echo '<input type="text" name="custom_title_input" id="custom_title_input" style="width:100%;" value="'.get_post_meta($post->ID,'_custom_title',true).'" />';
}
function save_custom_title($post_id) {
    if (!wp_verify_nonce($_POST['custom_title_input_hidden'], 'custom-title-nonce')) return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    $customTitle = $_POST['custom_title_input'];
    update_post_meta($post_id, '_custom_title', $customTitle);
}
function insert_custom_title() {
    if (have_posts()) : the_post();
      $customTitle = get_post_meta(get_the_ID(), '_custom_title', true);
      if ($customTitle) {
        echo "<title>$customTitle</title>";
      } else {
        echo "<title>";
          if (is_tag()) {
             single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
          elseif (is_archive()) {
             wp_title(''); echo ' Archive - '; }
          elseif ((is_single()) || (is_page()) && (!(is_front_page())) ) {
             wp_title(''); echo ' - '; }
          if (is_home()) {
             bloginfo('name'); echo ' - '; bloginfo('description'); }
          else {
              bloginfo('name'); }
          if ($paged>1) {
             echo ' - page '. $paged; }
        echo "</title>";
    }
    else :
      echo "<title>Page Not Found | Envision</title>";
    endif;
    rewind_posts();
}
