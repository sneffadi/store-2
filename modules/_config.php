<?php
define('MODULE_PATH', get_template_directory_uri() . '/modules/');

require_once ('products-post-type.php');
require_once ('archive-menu-support.php');
require_once ('top-products-page/index.php');
require_once ('ratings/index.php');
require_once ('references/index.php');
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

//create contact page
function create_front_page() {
    if (!get_page_by_title('Front Page')) {
        $postID = wp_insert_post(array('post_type' => 'page', 'post_title' => 'Front Page', 'post_content' => '', 'post_name' => 'front-page', 'post_status' => 'publish'));
        if ($postID !== 0) {
            add_post_meta($postID, 'custom_hero_html_custom_hero_html', '<div id="banner"><h1>Headline Goes Here</h1><h2>Sub headline goes here</h2><a class="button radius tiny success" href="#top-rated-list">See [year]\'s Best [niche]</a></div><h2>Sub-sub headline goes here.</h2><p>There are hundreds of different products on the market today, and finding one that\'s worth your time and money can seem impossible. Going in without help just leads to losing money, without any results to show for it.</p><p>That\'s where we come in to help.</p><p>We\'ve taken the guesswork out of finding a [niche] by providing you with the most <strong>comprehensive database of unbiased product reviews</strong> available. We\'ve tested, examined, and researched more than 100 [niche]s and rated the best with <b>9 criteria:</b></p><ul><li>Overall Value</li><li>Effectiveness</li><li>Speed of Results</li><li>Product Safety</li><li>Ingredient Quality</li><li>Long-Term Results</li><li>Customer Reviews</li><li>Guarantee</li><li>Company Reputation</li></ul><p>But we didn\'t stop with simple ratings. We scoured hundreds of stores to find the best prices and special offers to make sure you can pick the absolute best deal.</p><p>Keep reading to discover the [niche]s of [year]!</p>');
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