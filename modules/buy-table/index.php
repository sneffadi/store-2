<?php
define("module_path", get_template_directory_uri() . "/modules/buy-table/");

/*=============================================
=           Create Custom Fields              =
=============================================*/

if (!function_exists('underscore')) {
    function underscore($string) {
        $content = preg_replace('/\s+/', '_', $string);
        return strtolower($content);
    }
}

function product_custom_meta() {
    add_meta_box('product_meta', __('Product Options'), 'product_meta_callback', 'products', 'normal', 'high');
}
add_action('add_meta_boxes', 'product_custom_meta');

function product_meta_callback($post) {
    wp_nonce_field(basename(__FILE__), 'product_nonce');
    $cf_value = get_post_meta($post->ID);
    echo '<section id="product_meta">';
    $i = 1;
    $html = '';
    while (!empty($cf_value["title_c{$i}"][0]) && $cf_value["title_c{$i}"][0] != '' || $i == 1) {
        $html.= "<div data-column={$i}>";
        $html.= "<div><h4>Column " . $i . "</h4></div>";
        
        $html.= "<label>Column Title:</label><input type=\"text\" name=\"title_c{$i}\" value=\"" . (isset($cf_value["title_c{$i}"]) ? $cf_value["title_c{$i}"][0] : '') . "\" />";
        $html.= "<label>Price:</label><input type=\"text\" name=\"price_c{$i}\" value=\"" . (isset($cf_value["price_c{$i}"]) ? $cf_value["price_c{$i}"][0] : '') . "\" />";
        $html.= "<label>Total Bottles:</label><input type=\"number\" name=\"bottles_c{$i}\" value=\"" . (isset($cf_value["bottles_c{$i}"]) ? $cf_value["bottles_c{$i}"][0] : '') . "\" />";
        $html.= "<label>Bonus:</label><input type=\"text\" name=\"bonus_c{$i}\" value=\"" . (isset($cf_value["bonus_c{$i}"]) ? $cf_value["bonus_c{$i}"][0] : '') . "\" />";
        $html.= "<label>Shipping:</label><input type=\"text\" name=\"shipping_c{$i}\" value=\"" . (isset($cf_value["shipping_c{$i}"]) ? $cf_value["shipping_c{$i}"][0] : '') . "\" />";
        
        $j = 1;
        while (!empty($cf_value["name_c{$i}_r{$j}"][0]) && $cf_value["name_c{$i}_r{$j}"][0] != '' || $j == 1) {
            $html.= "<div data-row={$j}>";
            $html.= "<p><strong>Variation {$j}</strong></p>";
            $html.= "<label>Name:</label><input type=\"text\" name=\"name_c{$i}_r{$j}\" value=\"" . (isset($cf_value["name_c{$i}_r{$j}"]) ? $cf_value["name_c{$i}_r{$j}"][0] : '') . "\" />";
            $html.= "<label>Item ID:</label><input type=\"text\" name=\"itemId_c{$i}_r{$j}\" value=\"" . (isset($cf_value["itemId_c{$i}_r{$j}"]) ? $cf_value["itemId_c{$i}_r{$j}"][0] : '') . "\" />";
            $html.= "<label>Quantity:</label><input type=\"text\" name=\"quantity_c{$i}_r{$j}\" value=\"" . (isset($cf_value["quantity_c{$i}_r{$j}"]) ? $cf_value["quantity_c{$i}_r{$j}"][0] : '') . "\" />";
            $html.= "<label>Retail:</label><input type=\"text\" name=\"retail_c{$i}_r{$j}\" value=\"" . (isset($cf_value["retail_c{$i}_r{$j}"]) ? $cf_value["retail_c{$i}_r{$j}"][0] : '') . "\" />";
            $html.= "<label>Product Image:</label><input type=\"text\" name=\"image_c{$i}_r{$j}\" value=\"" . (isset($cf_value["image_c{$i}_r{$j}"]) ? $cf_value["image_c{$i}_r{$j}"][0] : '') . "\" />";
            $html.= "</div>";
            $j++;
        }
        $html.= '<div><a href="#" class="addRow">Add Row [+]</a></div>';
        $html.= '<input type="hidden" name="rowCount' . $i . '" value="' . ($j - 1) . '" />';
        $html.= "</div><!--/data-column-->";
        $i++;
    }
    $html.= '<div class="add clear"><a href="#" class="addColumn">Add Column [+]</a></div>';
    $html.= '<input type="hidden" name="' . 'columnCount' . '" value="' . ($i - 1) . '" />';
    echo $html;
    echo '</section><!--/product_meta -->';
}

function product_meta_save($post_id) {
    
    // Run of the mill checks
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['product_nonce']) && wp_verify_nonce($_POST['product_nonce'], basename(__FILE__))) ? 'true' : 'false';
    
    // Exits script depending on save status
    if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
    }
    
    // Checks for input and sanitizes/saves if needed
    $cf_value = get_post_meta($post_id);
    $i = 1;
    while (isset($_POST['title_c' . $i])) {
        if (isset($_POST['title_c' . $i])) {
            update_post_meta($post_id, 'title_c' . $i, sanitize_text_field($_POST['title_c' . $i]));
        } 
        else {
            delete_post_meta($post_id, "title_c{$i}");
        }
        if (isset($_POST['price_c' . $i])) {
            update_post_meta($post_id, 'price_c' . $i, sanitize_text_field($_POST['price_c' . $i]));
        } 
        else {
            delete_post_meta($post_id, "bottles_c{$i}");
        }
        if (isset($_POST['bottles_c' . $i])) {
            update_post_meta($post_id, 'bottles_c' . $i, sanitize_text_field($_POST['bottles_c' . $i]));
        } 
        else {
            delete_post_meta($post_id, "bottles_c{$i}");
        }
        if (isset($_POST['bonus_c' . $i])) {
            update_post_meta($post_id, 'bonus_c' . $i, sanitize_text_field($_POST['bonus_c' . $i]));
        } 
        else {
            delete_post_meta($post_id, "bonus_c{$i}");
        }
        if (isset($_POST['shipping_c' . $i])) {
            update_post_meta($post_id, 'shipping_c' . $i, sanitize_text_field($_POST['shipping_c' . $i]));
        } 
        else {
            delete_post_meta($post_id, "shipping_c{$i}");
        }
        if (isset($_POST['columnCount'])) {
            update_post_meta($post_id, 'columnCount', sanitize_text_field($_POST['columnCount']));
        } 
        else {
            update_post_meta($post_id, 'columnCount', 1);
        }
        $j = 1;
        while (isset($_POST["name_c{$i}_r{$j}"])) {
            
            if (isset($_POST["name_c{$i}_r{$j}"])) {
                update_post_meta($post_id, "name_c{$i}_r{$j}", sanitize_text_field($_POST["name_c{$i}_r{$j}"]));
            } 
            else {
                delete_post_meta($post_id, "name_c{$i}_r{$j}");
            }
            
            if (isset($_POST["itemId_c{$i}_r{$j}"])) {
                update_post_meta($post_id, "itemId_c{$i}_r{$j}", sanitize_text_field($_POST["itemId_c{$i}_r{$j}"]));
            } 
            else {
                delete_post_meta($post_id, "itemId_c{$i}_r{$j}");
            }
            if (isset($_POST["quantity_c{$i}_r{$j}"])) {
                update_post_meta($post_id, "quantity_c{$i}_r{$j}", sanitize_text_field($_POST["quantity_c{$i}_r{$j}"]));
            } 
            else {
                delete_post_meta($post_id, "quantity_c{$i}_r{$j}");
            }
            if (isset($_POST["retail_c{$i}_r{$j}"])) {
                update_post_meta($post_id, "retail_c{$i}_r{$j}", sanitize_text_field($_POST["retail_c{$i}_r{$j}"]));
            } 
            else {
                delete_post_meta($post_id, "retail_c{$i}_r{$j}");
            }
            if (isset($_POST["image_c{$i}_r{$j}"])) {
                update_post_meta($post_id, "image_c{$i}_r{$j}", sanitize_text_field($_POST["image_c{$i}_r{$j}"]));
            } 
            else {
                delete_post_meta($post_id, "image_c{$i}_r{$j}");
            }
            if (isset($_POST["rowCount{$i}"])) {
                update_post_meta($post_id, "rowCount{$i}", sanitize_text_field($_POST["rowCount{$i}"]));
            } 
            else {
                delete_post_meta($post_id, "rowCount{$i}");
            }
            $j++;
        }
        $i++;
    }
}
add_action('save_post', 'product_meta_save');

/*-----  End Custom Fields  ------*/

/*====================================
=            Load Scripts            =
====================================*/

function product_custom_fields_styles() {
    wp_register_style('product-integration', module_path . 'style.css', array(), '', 'all');
    wp_enqueue_style('product-integration');
}
add_action('admin_enqueue_scripts', 'product_custom_fields_styles');

//enqueue script for module and image loader
function product_image_enqueue() {
    global $typenow;
    if ($typenow == 'products') {
        wp_enqueue_media();
        
        wp_register_script('meta-box-image', module_path . 'script.js', array('jquery'));
        wp_localize_script('meta-box-image', 'meta_image', array('title' => __('Choose or Upload an Image', 'product-textdomain'), 'button' => __('Use this image', 'product-textdomain'),));
        wp_enqueue_script('meta-box-image');
    }
}
add_action('admin_enqueue_scripts', 'product_image_enqueue');

/*-----  End of Load Scripts  ------*/

/*=============================================
=            Insert into post           =
=============================================*/
add_action('after_product_content', 'buy_table_cb');
function buy_table_cb() {
    if (is_singular('products')) {
        global $post;
        $cf_value = get_post_meta($post->ID);
        echo "<div class=\"row collapse\">";
        echo "<div id=\"buytable\" data-magellan-destination=\"buytable\"> <a name=\"buytable\"></a>";
        echo "<div class=\"row\">";
        $i = 1;
        while (get_post_meta($post->ID, "title_c{$i}", true) != '') {            
            $quantity = get_post_meta($post->ID, "quantity_c{$i}_r1", true);
            $price = get_post_meta($post->ID, "price_c{$i}", true);
            $retail = get_post_meta($post->ID, "retail_c{$i}_r1", true);
            $quantity = array_map('floatval', explode(',', $quantity));
            $retail = array_map('floatval', explode(',', $retail));
            $total_retail = 0;            
            $percent_off = 0;
            for ($k=0; $k < count($quantity); $k++) { 
                $total_retail += $quantity[$k] * $retail[$k];
            }
            $savings = $total_retail - $price;
            $percent_off = $savings / $total_retail;
                        
            echo "<div class='small-24 medium-8 large-8 columns'>";
            echo "<form action=\"". do_shortcode('[cart_url]') . "\" " . "method=\"get\" id=\"buy{$i}\" class=\"buy-form\">";
            
            if ($i % 2 == 0) {
                $class = "even";
            } 
            else {
                $class = "";
            }
            echo "<div class=\"title {$class}\">" . get_post_meta($post->ID, "title_c{$i}", true) . "</div>";
            echo "<div class=\"small-24 columns buy-wrap\">";
            echo "<div class='quantity'>" . get_post_meta($post->ID, "bottles_c{$i}", true);

            echo (get_post_meta($post->ID, "bottles_c{$i}", true) == 1 ? ' Bottle' : ' Bottles');
            
            echo "</div>";
            echo "<div class='description'>" . get_post_meta($post->ID, "description" . "_" . $i, true) . "</div>";
            
            echo "<div class=\"buy-image\">" . "<img src=\"" . do_shortcode('[upload_dir]') . get_post_meta($post->ID, "image_c{$i}_r1", true) . "\"  />" . "</div>";            

            $shipping = strtolower(get_post_meta($post->ID, "shipping_c{$i}", true));

            if ($shipping==0 || $shipping=='free' || $shipping=='free shipping') {
                echo "<div class=\"shipping\">" . "Free Shipping!" . "</div>";
            } 
            else {
                echo "<div class=\"shipping\" >Flat-Rate Shipping: $" . do_shortcode("[shipping_cost]") . "</div>";
            } 

            echo "<div class='retail'>Retail $" . "<span>" .number_format($total_retail, 2, '.', '') . "</span>" . "</div>";
            
            echo "<div class=\"price\">Price $" . "<span>" . $price . "</span>" . "</div>";
            if ($savings > 0) {
                echo "<div class=\"savings\">" . "<span>Save $</span><span>" . number_format($savings, 2, '.', '') . "</span>" . "<span>" . number_format($percent_off, 3, '.', '') * 100 . "</span><span>% Off</span></div>";
            } 
            else {
                echo "<div class=\"savings no-savings\"></div>";
            }            
            echo "<a href=\"" . do_shortcode('[cart_url]') . "?add=" . $cf_value["itemId_c{$i}_r1"][0] . "\" class=\"button add-to-cart\" >" . "Add to Cart" . "</a>";

            
            echo "<div class=\"hiddenInputs\">";
            echo "</div><!--/hiddenInputs-->";

            echo "</form>";
            echo "</div><!--end column -->";
            echo "</div><!--end row -->";
            $i++;
        }
        echo "<div class=\"payment\">";
        echo "<i class=\"fa fa-cc-visa\"></i>";
        echo "<i class=\"fa fa-cc-amex\"></i>";
        echo "<i class=\"fa fa-cc-mastercard\"></i>";
        echo "<i class=\"fa fa-cc-discover\"></i>";
        echo "<i class=\"fa fa-cc-paypal\"></i>";
        echo "<i class=\"fa fa-amazon amazon-payments\"></i>";
        echo "</div><!--/.payment-->";
        echo "</div><!--/#buytable-->";
        echo "</div><!--/.row-->";
    }
}

/*-----  End of Section comment block  ------*/
