<?php

/*====================================
=            Content Hooks            =
====================================*/
if (!function_exists('underscore')) {
    function underscore($string) {
        $content = preg_replace('/\s+/', '_', $string);
        return strtolower($content);
    }
}

/*=============================================
=           Create Custom Fields              =
=============================================*/

function select_top_products() {
    add_meta_box('select_top_products', 'Create Top 10 List', 'select_top_products_cb', 'page', 'normal', 'high');
}
add_action('add_meta_boxes', 'select_top_products');
function select_top_products_cb($post) {
    $args = array('post_type' => array('products'), 'post_status' => array('published'), 'order' => 'ASC', 'orderby' => 'title');
    $myPosts = new WP_Query($args);
    $content = "<div id=\"products\">";
    $content.= "<h3>Drag and drop product.</h3>";
    $content.= "<div id=\"all-products\">";
    $content.= "<ul id=\"sortable\">";
    $i = 1;
    foreach ($myPosts->posts as $myPost) {
        $content.= "<li class=\"ui-state-default\" data-post-id=\"$myPost->ID\">";
        $content.= $myPost->post_title;
        $content.= "</li>";
        $i++;
    }
    wp_reset_postdata();
    $content.= "</ul>";
    $content.= "</div><!--/all-products-->";
    $content.= "</div><!--/products-->";
    
    $content.= "<div id=\"top-x-list\">";
    $content.= "<h3 class=\"ui-widget-header\">Top <span>X</span> List</h3>";
    $content.= "<div class=\"ui-widget-content\">";
    $content.= "<ol>";
    
    if (get_post_meta($post->ID, 'top-products-list', true) != '') {
        $ids = explode(",", get_post_meta($post->ID, 'top-products-list', true));
        foreach ($ids as $id) {
            $name = get_the_title($id);
            $edit = get_edit_post_link($id);
            $content.= "<li data-post-id=\"$id\">$name <span class=\"edit_review\"><a href=\"{$edit}\">Edit Product</a></span></li>";
        }
    } 
    else {
        $content.= "<li class=\"placeholder\">Add your items here</li>";
    }
    
    $content.= "</ol>";
    $content.= "</div><!--ui-widget-content-->";
    $content.= "</div><!--top-x-list-->";
    $content.= "<div class=\"cf\"></div>";
    $content.= "<input type=\"text\" name=\"top-products-list\" value=\"";
    $content.= get_post_meta($post->ID, 'top-products-list', true);
    $content.= "\" />";
    echo $content;
}
function custom_review_blurbs() {
    add_meta_box('custom_review_blurbs', 'Override Default Review Snippets', 'custom_descriptions_cb', 'page', 'normal', 'high');
}
add_action('add_meta_boxes', 'custom_review_blurbs');
function custom_descriptions_cb($post) {
    $content = "<div>";
    $topIds = explode(",", get_post_meta($post->ID, 'top-products-list', true));
    $i = 1;
    foreach ($topIds as $topId) {
        $cf = get_post_meta($post->ID, "{$topId}_custom_content", true);
        if (empty($cf)) {
        }
        $cf = '';
        $content.= "<p>" . $i . ". " . get_the_title($topId) . "</p>";
        $content.= "<textarea name=\"{$topId}_custom_content\">";
        $content.= $cf;
        $content.= "</textarea>";
        $i++;
    }
    $content.= "</div>";
    echo $content;
}

function page_meta_save($post_id) {
    
    // Run of the mill checks
    global $typenow;
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['page_nonce']) && wp_verify_nonce($_POST['page_nonce'], basename(__FILE__))) ? 'true' : 'false';
    
    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }
    
    if ($typenow == 'page') {
        
        // Checks for input and sanitizes/saves if needed
        $cf_value = get_post_meta($post_id);
        
        if (isset($_POST['top-products-list'])) {
            update_post_meta($post_id, 'top-products-list', $_POST['top-products-list']);
        } 
        else {
            delete_post_meta($post_id, 'top-products-list', $_POST['top-products-list']);
        }
        $topIds = explode(",", get_post_meta($post_id, 'top-products-list', true));
        if (!empty($_POST["top-products-list"])) {
            foreach ($topIds as $topId) {
                if (isset($_POST[$topId . '_custom_content'])) {
                    update_post_meta($post_id, $topId . '_custom_content', $_POST[$topId . '_custom_content']);
                } 
                else {
                    delete_post_meta($post_id, $topId . '_custom_content', $_POST[$topId . '_custom_content']);
                }
            }
        }
    }
}
add_action('save_post', 'page_meta_save');

/*-----  End Custom Fields  ------*/

/*====================================
=            Load Scripts            =
====================================*/

//enqueue script for module and image loader
function page_enqueue() {
    global $typenow;
    if ($typenow == 'page') {
        wp_enqueue_media();
        wp_register_script('page-meta-box-image', get_template_directory_uri() . '/modules/top-products-page/' . 'script.js', array('jquery'));
        wp_localize_script('page-meta-box-image', 'meta_image', array('title' => __('Choose or Upload an Image', 'page-textdomain'), 'button' => __('Use this image', 'page-textdomain'),));
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_script('page-meta-box-image');
        wp_enqueue_style('page-integration', get_template_directory_uri() . '/modules/top-products-page/' . 'style.css', array(), '', 'all');
    }
}
add_action('admin_enqueue_scripts', 'page_enqueue');

/*-----  End Load Scrtipts  ------*/
