<?php
add_action('page_after_entry_content', 'top_products_cb');

/*=============================================
this function builds the top x list on pages and
and the review overviews on recommended products
=============================================*/

function top_products_cb() {
    global $post, $sc_id;
    $options = get_option('theme_options');
    $num = !empty($options['ratings']) ? $options['ratings'] : "100";
    $niche = !empty($options['nichename']) ? $options['nichename'] : "";
    $ids = explode(",", get_post_meta($post->ID, "top-products-list", true));
    $idsCount = count($ids);
    $year = date("Y");
    $is_single = is_single();
    $is_page = is_page();
    $is_product = is_singular('products');
    $readMore = 'Read More';
    $seePricing = 'See Pricing';
    $i = 1;
    if ($is_page && $idsCount > 1) { ?>
        <div class="row upsell collapse" id="top-rated-list">
            <div class="row collapse">
                <div class="small-24 columns">    
                    <h2 class="top-list">Top <?php echo $idsCount;?> <?php echo $niche; ?>s of <?php echo $year; ?></h2>
                </div><!--/small-12 columns-->
            </div><!--/row collapse-->
            <div class="row collapse">
            <?php foreach ($ids as $id) { ?>
                <div class="small-24 columns top-product">
                    <div class="row">
                        <h3 class="upsell-title"><a href="<?php echo get_the_permalink($id); ?>" ><?php echo "#{$i} " . get_the_title($id); ?></a></h3>
                        <div class="small-8 medium-5 small-columns product-image">
                            <?php if (has_post_thumbnail($id)) {
                                echo "<figure>";
                                echo "<a href=\"" . get_the_permalink($id) . "\">";
                                echo get_the_post_thumbnail($id);
                                echo "</a>";
                                echo "</figure>";
                            }?>
                        </div><!--/small-4 medium-2 columns-->
                        <div class="small-16 medium-9 small-columns">
                            <div class="row collapse">
                                <div class="small-24 columns table">
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            Overall Value:
                                        </div>
                                        <div class="medium-10 small-10 columns star-col">
                                            <div class="star-positioner">
                                                <div class="stars">
                                                    <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-overall-value', true) * 20; ?>%">                                                    
                                                    </div> <!-- / .colorbar -->
                                                    <div class="star_holder">
                                                        <div class="star star-1"></div> <!-- / .star -->
                                                        <div class="star star-2"></div> <!-- / .star -->
                                                        <div class="star star-3"></div> <!-- / .star -->
                                                        <div class="star star-4"></div> <!-- / .star -->
                                                        <div class="star star-5"></div> <!-- / .star -->
                                                   </div> <!-- / .star_holder -->
                                                </div> <!-- / .stars -->
                                            </div> <!-- / .star-positioner -->
                                        </div><!--/medium-5 columns hide-for-small-->
                                        <div class="small-6 medium-4 columns out-of hide-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-overall-value", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-3 medium-2 columns out-of -->
                                    </div><!--/ criterion-row row -->
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            Effectiveness:
                                        </div>
                                        <div class="medium-10 small-10 columns star-col">
                                            <div class="star-positioner">
                                                <div class="stars">
                                                    <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-effectiveness', true) * 20; ?>%">                                                    
                                                    </div> <!-- / .colorbar -->
                                                    <div class="star_holder">
                                                        <div class="star star-1"></div> <!-- / .star -->
                                                        <div class="star star-2"></div> <!-- / .star -->
                                                        <div class="star star-3"></div> <!-- / .star -->
                                                        <div class="star star-4"></div> <!-- / .star -->
                                                        <div class="star star-5"></div> <!-- / .star -->
                                                   </div> <!-- / .star_holder -->
                                                </div> <!-- / .stars -->
                                            </div> <!-- / .star-positioner -->

                                            <div class="ratings" style="width:<?php echo get_post_meta($id, 'ratings-effectiveness', true); ?>%">
                                            </div>
                                        </div>
                                        <div class="small-6 medium-4 columns out-of hide-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-effectiveness", true), 1 ) . "/" . $num; ?>
                                        </div>
                                    </div><!--/ criterion-row row -->
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            Speed of Results:
                                        </div>
                                        <div class="medium-10 small-10 columns star-col">
                                            <div class="star-positioner">
                                                <div class="stars">
                                                    <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-speed-of-results', true) * 20; ?>%">                                                    
                                                    </div> <!-- / .colorbar -->
                                                    <div class="star_holder">
                                                        <div class="star star-1"></div> <!-- / .star -->
                                                        <div class="star star-2"></div> <!-- / .star -->
                                                        <div class="star star-3"></div> <!-- / .star -->
                                                        <div class="star star-4"></div> <!-- / .star -->
                                                        <div class="star star-5"></div> <!-- / .star -->
                                                   </div> <!-- / .star_holder -->
                                                </div> <!-- / .stars -->
                                            </div> <!-- / .star-positioner -->
                                        </div>
                                        <div class="small-6 medium-4 columns out-of hide-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-speed-of-results", true) , 1 ). "/" . $num; ?>
                                        </div>
                                    </div><!--/ criterion-row row -->
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            Product Safety:
                                        </div>
                                        <div class="medium-10 small-10 columns star-col">
                                            <div class="star-positioner">
                                                <div class="stars">
                                                    <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-product-safety', true) * 20; ?>%">                                                    
                                                    </div> <!-- / .colorbar -->
                                                    <div class="star_holder">
                                                        <div class="star star-1"></div> <!-- / .star -->
                                                        <div class="star star-2"></div> <!-- / .star -->
                                                        <div class="star star-3"></div> <!-- / .star -->
                                                        <div class="star star-4"></div> <!-- / .star -->
                                                        <div class="star star-5"></div> <!-- / .star -->
                                                   </div> <!-- / .star_holder -->
                                                </div> <!-- / .stars -->
                                            </div> <!-- / .star-positioner -->
                                        </div>
                                        <div class="small-6 medium-4 columns out-of hide-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-product-safety", true) , 1 ) . "/" . $num; ?>
                                        </div>
                                    </div><!--/ criterion-row row -->
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            Ingredients:
                                        </div>
                                        <div class="medium-10 small-10 columns star-col">
                                            <div class="star-positioner">
                                                <div class="stars">
                                                    <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-ingredient-quality', true) * 20; ?>%">                                                    
                                                    </div> <!-- / .colorbar -->
                                                    <div class="star_holder">
                                                        <div class="star star-1"></div> <!-- / .star -->
                                                        <div class="star star-2"></div> <!-- / .star -->
                                                        <div class="star star-3"></div> <!-- / .star -->
                                                        <div class="star star-4"></div> <!-- / .star -->
                                                        <div class="star star-5"></div> <!-- / .star -->
                                                   </div> <!-- / .star_holder -->
                                                </div> <!-- / .stars -->
                                            </div> <!-- / .star-positioner -->
                                        </div>
                                        <div class="small-6 medium-4 columns out-of hide-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-ingredient-quality", true), 1 ) . "/" . $num; ?>
                                        </div>
                                    </div><!--/ criterion-row row -->
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            Long-Term Results:
                                        </div>
                                        <div class="medium-10 small-10 columns star-col">
                                            <div class="star-positioner">
                                                <div class="stars">
                                                    <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-long-term-results', true) * 20; ?>%">                                                    
                                                    </div> <!-- / .colorbar -->
                                                    <div class="star_holder">
                                                        <div class="star star-1"></div> <!-- / .star -->
                                                        <div class="star star-2"></div> <!-- / .star -->
                                                        <div class="star star-3"></div> <!-- / .star -->
                                                        <div class="star star-4"></div> <!-- / .star -->
                                                        <div class="star star-5"></div> <!-- / .star -->
                                                   </div> <!-- / .star_holder -->
                                                </div> <!-- / .stars -->
                                            </div> <!-- / .star-positioner -->
                                        </div>
                                        <div class="small-6 medium-4 columns out-of hide-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-long-term-results", true), 1 ) . "/" . $num; ?>
                                        </div>
                                    </div><!--/ criterion-row row -->
                                    <div class="criterion-row row">
                                        <div class="small-14 medium-10 columns criterion">
                                            MSRP:
                                        </div>
                                        <div class="small-10 medium-14 columns">
                                            <?php echo "$" . number_format( get_post_meta($id, "retail_c3", true), 2 ); ?>
                                        </div>
                                        <div class="small-14 medium-10 columns criterion">
                                            Our Price:
                                        </div>
                                        <div class="small-10 medium-14 columns">
                                            <?php
                                                $pricing = array();                                        
                                                $p1 = ( get_post_meta($id, "price_c1", true) / get_post_meta($id, "qty_c1", true)  );
                                                $p2 = ( get_post_meta($id, "price_c2", true) / get_post_meta($id, "qty_c2", true)  );
                                                $p3 = ( get_post_meta($id, "price_c3", true) / get_post_meta($id, "qty_c3", true)  );
                                                array_push($pricing, $p1, $p2, $p3 );
                                                $low = min($pricing);
                                                $high = max($pricing);
                                                $epsilon = 0.00001;
                                                if(abs($low-$high) < $epsilon) {
                                                    echo "<a href=\"" . get_the_permalink($id) . "\">" . "$" . number_format( $low, 2) . "</a>"; 
                                                } else {
                                                    echo "<a href=\"" . get_the_permalink($id) . "\">" . "$" . number_format( $low, 2) . "-" . number_format( $high, 2) .  "</a>"; 
                                                }
                                                
                                            ?>
                                        </div>
                                        <div class="small-14 medium-10 columns criterion">
                                            Guarantee:
                                        </div>
                                        <div class="small-10 medium-14 columns">
                                            <?php echo get_post_meta($id, "ratings-guarantee", true); ?>
                                        </div>
                                    </div><!-- / .criterion-row -->
                                </div> <!--/small-12 columns table -->
                            </div><!-- / .row -->
                        </div><!--/small-8 medium-7 columns table-->
                        <div class="small-24 medium-10 small-columns upsell-content">
                        <?php if (strlen(get_post_meta($post->ID, $id . "_custom_content", true)) > 0) {
                            $sc_id = $id;
                            echo do_shortcode("<p>" . get_post_meta($post->ID, $id . "_custom_content", true) . ' [a]Read more...[/a]' . "</p>");
                        } else {
                            $sc_id = $id;
                            echo do_shortcode("<p>" . get_post_meta($id, 'review-blurb', true) . " [a]Read more...[/a]" . "</p>");
                        }
                        ?>
                            <div class="row collapse">
                                <div class="small-12 columns">
                                    <a href="<?php echo get_permalink($id) ?>" class="tiny button secondary radius"><?php echo $readMore ?></a>
                                </div><!--/.small-6 columns-->
                                <div class="small-12 columns">
                                    <a href="<?php echo get_permalink($id) ?>/#buySection" class="tiny button success radius"><?php echo $seePricing; ?></a>                        
                                </div><!--/.columns-->
                            </div><!--/.row collapse-->
                        </div><!--/small-12 medium-5 columns-->                        
                    </div><!--/.row collapse -->
                </div><!--/small-12 columns top-product-->
                <?php $i++; ?>
            <?php } // end for each loop ?>
        <?php } //end if is page and ids count ?>        
        </div><!--/.row collapse-->
    </div><!--/.row upsell collapse top-rated-list -->
    <?php } // end top_products_cb