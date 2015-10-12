<?php
add_shortcode("bonus", "bonus");
add_shortcode('upload_dir', 'upload_dir');
add_shortcode('year', 'year');
add_shortcode('a', 'product_link');
add_shortcode('url', 'url');
add_shortcode('ref', 'ref');
add_shortcode( 'ingredients', 'ingredients' );
add_shortcode('cart_url', 'cart_url');
add_shortcode('shipping_cost', 'shipping_cost');
add_shortcode('guarantee', 'guarantee');

function niche() {
    $options = get_option('theme_options');
    $niche = $options['nichename'];
    return $niche;
}
add_shortcode( 'niche', 'niche' );

function ingredients( $atts , $content = null ) {
    $html = "<div class=\"ingredients\">";
    $html .= $content;
    $html .= "</div><!--/ingredients-->";
    return $html;
}
function bonus($atts, $content = null) {
    extract(shortcode_atts(array("headline" => "", "image" => "", "bg" => ""), $atts));
    $bonus = "<div class=\"bonus\" style=\"background: " . $bg . "\">";
    $bonus.= "<div class=\"bonus-img\">";
    $bonus.= "<img src=\" " . $image . "\" />";
    $bonus.= "</div><!--end bonus image -->";
    $bonus = "<div class=\"headline\">";
    $bonus.= $headline;
    $bonus.= "</div><!--end headline -->";
    $bonus.= "<p>";
    $bonus.= $content;
    $bonus.= "</p>";
    $bonus.= "</div><!--end bonus -->";
    return $bonus;
}

function upload_dir() {
    $upload_dir = wp_upload_dir();
    return $upload_dir['baseurl'] . '/';
}
function url() {
    $url = home_url('/');
    return $url;
}
function year() {
    $year = date("Y");
    return $year;
}
function product_link($atts, $content = null) {
    global $sc_id, $post;
    if (is_singular('reviews') && in_category('recommended' )) {
        $href = get_post_meta($post->ID, 'ratings-affiliate-link' , true);
        $link = "<a href=\"{$href}\" data-name=\"review | in-content | stuff \">{$content}</a>";
    } elseif (is_page() ) {        
        $href = get_the_permalink($sc_id);
        $link = "<a href=\"{$href}\" data-name=\"top10-upsell-blurb\">{$content}</a>";
    } else {
        return;
    }
    return $link;
}
function cart_url() {
    $options = get_option('theme_options');
    $carturl = $options['cart-url'];
    return $carturl;
}
function shipping_cost() {
    return '4.95';
}
function guarantee () {
    $guarantee = "<div class=\"row guarantee\">";
    $guarantee .= "<div class=\"small-24 medium-8 columns\">";
    $guarantee .= "<img src=\"/wp-content/uploads/prod-guarantee-seal.png\" />";
    //$guarantee .= "<img src=\"http://localhost/esleepingpills.com/wp-content/uploads/prod-guarantee-seal.png\" />";
    $guarantee .= "</div><!-- end .small-24.medium-8 -->";
    $guarantee .= "<div class=\"small-24 medium-16 columns\">";
    $guarantee .= "<p>You can feel confident in your purchase because this product is backed by our <b>100% Money Back Guarantee!</b> If you are not fully satisfied with your results, contact our customer service team and they'll get you started!</p>";
    $guarantee .= "</div><!-- end .medium-16.columns -->";
    $guarantee .= "</div><!-- end .row.guarantee -->";
    return $guarantee;
}