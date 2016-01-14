<?php

/*=============================================
=            Product Pages                   =
=============================================*/

add_shortcode( 'ingredient', 'ingredient' );
add_shortcode( 'testimonial', 'testimonial');
add_shortcode( 'guarantee', 'guarantee');
add_shortcode( 'supplement_facts', 'supplement_facts' );
add_shortcode( 'bonus', 'bonus');
add_shortcode( 'q', 'q' );
add_shortcode( 'ans', 'ans' );
add_shortcode( 'buy_dropdown', 'buy_dropdown' );

function ingredient( $atts , $content = null ) {
    extract(shortcode_atts(array(
        "class" => null,
        "image" => null,
        "name" => null,
        "graph" => null,
        "last" => null,
        "style" => "1"
    ), $atts));
    $html = "<div class=\"row ingredient";
    if ($last == "true") {
        $html .= " last";
    }
    $html .= "\">";
    if ($style == 1) {
        $html .= "<div class=\"small-6 medium-4 columns ingredient-image\">";
    }
    elseif ($style == 2) {
        $html .= "<div class=\"small-6 columns ingredient-image\">";
    }
    if (isset($image)) {
        $html .= '<img src="' . do_shortcode('[upload_dir]') . $image  . '">';
    }
    $html .= "</div>";
    if ($style == 1) {
        $html .= "<div class=\"small-18 medium-20 columns\">";
    }
    elseif ($style == 2) {
        $html .= "<div class=\"small-18 columns\">";
    }
    $html .= "<div class=\"ingredient-name\">";
    $html .= $name;
    $html .= "</div>";
    $html .= do_shortcode($content);
    if (isset($graph)) {
        $html .= '<img src="' . do_shortcode('[upload_dir]') . $graph  . '" class="'.$class.'">';
    }
    $html .= "</div><!--/.small-18.medium-20.columns-->";
    $html .= "</div><!--/.row.ingredient-->";
    return $html;
}

function testimonial ($atts, $content = null) {
     extract(shortcode_atts(array(
                "headline" => null,
                "image" => null,
                "name" => null,
                "date" => null,
                "location" => null,
                "last" => null,
                "position" => null,
                "style" => 1
            ), $atts));

    $testimonial = '<div class="row testimonial ';
    if ($last == "true") {
        $testimonial .= "last ";
    }
    if ($style == 1) {
        $testimonial .= "style1";
    } elseif ($style == 2) {
        $testimonial .= "style2";
    } elseif ($style == 3) {
        $testimonial .= "style3";
    }
    $testimonial .= '">';
    if (isset($image) && strlen($image) > 0) {
        if ($style == 1) {
            $testimonial .= '<div class="small-24 columns">';
            $testimonial .= '<img src="' . do_shortcode('[upload_dir]') . $image  . '">';
            $testimonial .= '</div> <!-- / .small-24 columns -->';
        } elseif ($style == 2) {
            $testimonial .= '<div class="medium-5 small-24 columns">';
            $testimonial .= '<img src="' . do_shortcode('[upload_dir]') . $image . '">';
            $testimonial .= '</div><!--/.medium-5 .small-24 .columns-->';
        } elseif ($style == 3) {
            $testimonial .= '<div class="medium-11 small-24 columns">';
            $testimonial .= '<img src="' . do_shortcode('[upload_dir]') . $image . '">';
            $testimonial .= '</div><!--/.medium-11 .small-24 .columns-->';
        }

    }
    if ($style == 1) {
        $testimonial .= '<div class="small-24 columns">';
    } elseif ($style == 2) {
        $testimonial .= '<div class="medium-17 small-24 columns">';
    } elseif ($style == 3) {
        $testimonial .= '<div class="medium-13 small-24 columns">';
    }
    if (isset($headline) && strlen($headline) > 0) {
        $testimonial .= '<h4>'.$headline.'</h4>';
    }
    $testimonial .=  do_shortcode($content);
    if (isset($name) && strlen($name) > 0) {
        $testimonial .= '<div class="name">- '.$name.'</div>';
    }
    if (isset($date) && strlen($date) > 0) {
        $testimonial .= '<div class="date">- â€œ '.$date.'</div>';
    }
    if ($style == 1) {
        $testimonial .= '</div> <!-- / .small-24 columns -->';
    } elseif ($style == 2) {
        $testimonial .= '</div> <!-- / .medium-17 small-24 columns -->';
    } elseif ($style == 3) {
        $testimonial .= '</div> <!-- / .medium-13 small-24 columns -->';
    }
    $testimonial .= '</div> <!-- / .row.testimonial -->';
    return $testimonial;
}

function guarantee($atts, $content = null) {
    extract(shortcode_atts(array("image" => null, "style" => "1", "subhead" => null), $atts));
    global $post;
    $guarantee = "<div class=\"row guarantee";
    $default = "We are so confident about our products, we back each and every product with a 100% Money Back Guarantee! <strong>If you for ANY reason are unsatisfied, return your order for a 100% money back (less shipping).</strong> It is that simple! The guarantee is good for one used and all remaining unopened bottles.";
    $options = get_option('theme_options');
    $guarantee_override = !empty($options['guarantee']) ? $options['guarantee'] : "";
    if ($style == 1) {
        $guarantee .= " style1";
    } elseif ($style == 2) {
        $guarantee .= " style2";
    }
    $guarantee .= "\">";
    if ($style == 1) {
        $guarantee .= "<div class=\"small-0 medium-6 columns hide-for-small-only\">";
    } elseif ($style == 2) {
        $guarantee .= "<div class=\"small-0 medium-7 columns hide-for-small-only\">";
    }
    if ($image !== null) {
        $guarantee .= "<img src=\"".do_shortcode('[upload_dir]'). $image."\" />";
    } else {
       $guarantee .= "<img src=\"".do_shortcode('[upload_dir]'). "guarantee.png\" />";
    }
    $guarantee .= "</div><!-- .medium-6/7 columns -->";
    if ($style == 1) {
        $guarantee .= "<div class=\"small-24 medium-18 columns\">";
    }elseif ($style == 2) {
        $guarantee .= "<div class=\"small-24 medium-17 columns\">";
    }
    $guarantee .= "<h2>100% Money Back Guarantee</h2>";
    if ($style == 2 && isset($subhead) && $subhead !== "") {
        $guarantee .= "<h4>{$subhead}</h4>";
    }
    $guarantee .= "<img src=\"".do_shortcode('[upload_dir]'). "guarantee.png\"" . " class=\"show-for-small-only guarantee-img\" />";
    $guarantee .= "<p>";
    if ( $guarantee_override !== '' && $guarantee_override !== false) {
        $guarantee .= do_shortcode($guarantee_override);
    } else {
        $guarantee .= $default;
    }
    $guarantee .= "</p>";
    $guarantee .= "</div><!-- end .medium-18.columns -->";
    $guarantee .= "</div><!-- end .row.guarantee -->";
    return $guarantee;
}

function supplement_facts ($atts) {
    extract(shortcode_atts(array(
        "bottle" => null,
        "facts" => null
    ), $atts));
    $html = "<div class=\"row supplement-facts\">";
    $html .= "<div class=\"small-0 hide-for-small-only medium-10 text-right columns\">";
    if ($bottle !== "") {
        $html .= "<img src=\"" . do_shortcode('[upload_dir]') . $bottle . "\">";
    } else {
        $html .= do_shortcode('[get_featured_image]');
    }
    $html .= "</div>";
    $html .= "<div class=\"small-24 medium-14 columns text-left\">";
    $html .= "<img src=\"" . do_shortcode('[upload_dir]') . $facts . "\" class=\"supp_facts\">";
    $html .= "</div>";
    $html .= "<div class=\"small-24 columns suppfacts-button\">";
    $html .= "<a href=\"#buytable\" class=\"button radius success see-pricing\">See Pricing</a>";
    $html .= "</div>";
    $html .= "</div><!--/.supplement-facts-->";
    return $html;
}

function bonus($atts, $content = null) {
    extract(shortcode_atts(array(
        "headline" => null,
        "image" => null,
        "style" => null
    ), $atts));
    $bonus = "<div class=\"row bonus\">";
    $bonus .= '<div class="small-24 medium-6 columns center text-right">';
    $bonus .= '<img src="' . do_shortcode('[upload_dir]') . $image . '" alt="" class="bonus-img-medium hide-for-small-only">';
    $bonus .= '</div> <!-- / .small-12 medium-6 columns -->';
    $bonus .= '<div class="small-24 medium-18 columns">';
    $bonus .= '<h4 class="headline">- Special Limited-Time Only Offer -</h4> <!-- / .headline -->';
    $bonus .= '<h3>'.$headline.'</h3>';
    $bonus .= '<img src="' . do_shortcode('[upload_dir]') . $image . '" alt="" class="bonus-img-small show-for-small-only">';
    $bonus .= '<p>'.do_shortcode($content).'</p>';
    $bonus .= '</div> <!-- / .small-24 medium-16 columns -->';
    $bonus .= '</div><!-- end .row.bonus -->';
    return $bonus;
}

function q ($atts, $content = null) {
    $q = "<p class=\"q\">";
    $q .=  do_shortcode($content);
    $q .=  "</p>";
    return $q;
}
function ans ($atts, $content = null) {
    $a = "<p class=\"a\">";
    $a .=  do_shortcode($content);
    $a .=  "</p>";
    return $a;
}

function buy_dropdown(){
    global $post;
    $cf_value = get_post_meta($post->ID);
        $html = '';
        $html .= '<div class="row show-for-small-only dropdown-buy">';
        $html .= '<div class="small-24 columns">';
        $html .= '<form action="' . do_shortcode('[cart_url]') . '" method="get" id="banner-form">';
        $html .= '<div class="dropdown">';
        $html .= '<span></span>';
        $html .= '<select class="select">';
        $i = 1;

        while ( get_post_meta($post->ID, "itemId_c{$i}", true) != '' ) {
            $html .= '<option value="'.$cf_value["itemId_c{$i}"][0].'"';
            if ($i == 1) {
                $html .= " selected ";
            }
            $html .= '>';
            $html .= $cf_value["qty_c{$i}"][0] . ' ' . get_the_title();
            $html .= ' â€“ $';
            $html .= $cf_value["price_c{$i}"][0];
            $html .= '</option>';
            $i++;
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<button class="button add-to-cart">Buy Now</button>';
        $i = 1;
        while ( get_post_meta($post->ID, "itemId_c{$i}", true) != '' ) {
            $html .= '<div class="dd-buy';
            if ($i > 1) {
                $html .= ' hide';
            }
            $html .= '">';
            if ( $cf_value["retail_c{$i}"][0] != '') {
                $html .= '<span class="dd-retail">';
                $html .= '<span>$';
                $html .= number_format( $cf_value["retail_c{$i}"][0], 2, '.', '' );
                $html .= '</span>';
                $html .= '</span>';
            }
            if ( $cf_value["price_c{$i}"][0] != '') {
                $html .= '<span class="dd-our-price">';
                $html .= '<span> $';
                $html .= number_format( $cf_value["price_c{$i}"][0], 2, '.', '' );
                $html .= '</span>';
                $html .= '</span>';
            }
            if ( $cf_value["retail_c{$i}"][0] != '' && $cf_value["price_c{$i}"][0] != '') {
                $html .= '<span class="dd-savings">';
                $html .= '&nbsp;(You save ';
                $html .= '<span>$';

                $html .= number_format( ( $cf_value["retail_c{$i}"][0] - $cf_value["price_c{$i}"][0] ), 2, '.', '') ;
                $html .= '</span>';
                $html .= ')';
                $html .= '</span>';
            }
            if ( $cf_value["bonus_c{$i}"][0] != '') {
                $html .= '<div class="dd-bonus">';
                $html .= '<strong>';
                $html .= '+ ';
                $html .= $cf_value["bonus_c{$i}"][0];
                $html .= '</strong>';
                $html .= '<br>';
                $html .= '+ ';
                if (is_numeric( $cf_value["shipping_c{$i}"][0] ) && $cf_value["shipping_c{$i}"][0] > 0) {
                    $html .= '$';
                }
                $html .= $cf_value["shipping_c{$i}"][0];
                $html .= ' Shipping';
                $html .= '</div>';
            } else {
                $html .= '<div class="dd-bonus">';
                if (is_numeric( $cf_value["shipping_c{$i}"][0] ) && $cf_value["shipping_c{$i}"][0] > 0) {
                    $html .= '+ $';
                }
                $html .= $cf_value["shipping_c{$i}"][0];
                $html .= ' Shipping';
                $html .= '</div>';
            }
            $html .= '</div><!--/.dd-buy-->';
            $i++;
        }
        $html .= '<input type="hidden" name="add" value="';
        $html .= $cf_value["itemId_c1"][0];
        $html .= '">';
        $html .= '</form>';
        $html .= '</div><!--/.small-24.column-->';
        $html .= '</div><!--/row-->';
        return $html;
}


/*=============================================
=            Helps Functions                   =
=============================================*/

add_shortcode('year', 'year');
add_shortcode('a', 'product_link'); // for top x list product name link
add_shortcode('upload_dir', 'upload_dir');
add_shortcode('url', 'url');
add_shortcode('cart_url', 'cart_url');
add_shortcode('shipping_cost', 'shipping_cost'); // need to change or delete later
add_shortcode( 'disclaimer', 'disclaimer' ); // will delete later
add_shortcode( 'niche', 'niche' );
add_shortcode( 'get_featured_image', 'get_featured_image' );
add_shortcode('featured_img','featured_img');
add_shortcode('criteria','criteria');
add_shortcode( 'count', 'get_product_count' );
add_shortcode( 'product_name', 'get_product_name' );

function featured_img( $atts ) {
global $post;
return get_the_post_thumbnail( $post->ID );
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

function disclaimer () {
    $disclaimer = "&nbsp;<span class=\"test-disclaimer\"><a href=\"#testimonial-disclaimer\">*Testimonial disclaimer</a></span>";
    return $disclaimer;
}
function niche() {
    global $post;
    $options = get_option('theme_options');
    $niche = !empty($options['nichename']) ? $options['nichename'] : "";
    $niche_override = get_post_meta($post->ID, "override_niche_name_override-niche-name", true);
    if ( $niche_override !== '' && $niche_override !== false ){
            $niche = $niche_override;
    }
    return $niche;
}

function get_product_count () {
    global $post;
    $ids = explode(",", get_post_meta($post->ID, "top-products-list", true));
    $idsCount = count($ids);
    return $idsCount;
}

function get_featured_image( $atts ) {
    extract(shortcode_atts(array("class" => ""), $atts));
    global $post;
    return get_the_post_thumbnail( $post->ID, 'large', array( 'class' => $class ) );
}

function criteria (){
    $options = get_option('theme_options');
    $criteria = do_shortcode( $options['criteria'] );
    return $criteria;
}
function get_product_name () {
    global $post;
    $pname = get_the_title();
    return $pname;
}