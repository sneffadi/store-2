<?php
add_action('page_after_entry_content', 'top_products_cb');

/*=============================================
this function builds the top x list on pages and
and the review overviews on recommended products
=============================================*/

function top_products_cb() {
    global $post, $sc_id, $topTwo;
    $options = get_option('theme_options');
    $num = !empty($options['ratings']) ? $options['ratings'] : "5";
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
    $topTwo = array_slice($ids,0,2);
    if ($is_page && $idsCount > 1) { ?>
        <div class="row upsell collapse" id="top-rated-list">
            <div class="row collapse">
                <div class="small-24 columns">
                    <h2 class="top-list">Top <?php echo $idsCount;?> <span><?php echo $niche; ?>s</span> of <?php echo $year; ?></h2>
                </div><!--/small-12 columns-->
            </div><!--/row collapse-->
            <div class="row collapse">
            <?php foreach ($ids as $id) { ?>
                <div class="small-24 columns top-product">
                    <div class="row">

                        <div class="small-0 medium-8 small-columns product-image hide-for-small">
                            <?php if (has_post_thumbnail($id)) {
                                echo "<figure>";
                                echo "<a href=\"" . get_the_permalink($id) . "\">";
                                echo get_the_post_thumbnail($id);
                                echo "</a>";
                                echo "</figure>";
                            }?>
                        </div><!--/small-4 medium-2 columns-->
                        <div class="small-24 medium-16 small-columns">
                            <div class="row collapse">
                            <div class="upsell-title clearfix">
                                <a href="<?php echo get_the_permalink($id); ?>" >
                                    <?php echo "<div class=\"circle\">#{$i}</div>"; ?>
                                    <h3>
                                        <?php echo get_the_title($id); ?>
                                    </h3>
                                    <?php
                                    $isTSK = get_post_meta($id, "top-seller-kit", true);
                                    if ($isTSK == "")  {    ?>
                                    <div class="overall-rating">
                                        <?php echo number_format ( get_post_meta($id, "ratings-overall-value", true), 1 ). "/" . $num; ?>
                                    </div>
                                    <div class="star-positioner">
                                        <div class="stars">
                                            <div class="colorbar" style="width:<?php echo get_post_meta($id, 'ratings-overall-value', true) * 20; ?>%">
                                            </div> <!-- / .colorbar -->
                                            <div class="star_holder">
                                                <div class="star white-bg star-1"></div> <!-- / .star -->
                                                <div class="star white-bg star-2"></div> <!-- / .star -->
                                                <div class="star white-bg star-3"></div> <!-- / .star -->
                                                <div class="star white-bg star-4"></div> <!-- / .star -->
                                                <div class="star white-bg star-5"></div> <!-- / .star -->
                                           </div> <!-- / .star_holder -->
                                        </div> <!-- / .stars -->
                                    </div> <!-- / .star-positioner -->
                                   <?php } ?>
                               </a>
                            </div>
                            <?php
                            $tagline = get_post_meta($id, 'ratings-tagline', true);
                            if ($tagline != ""): ?>
                                <h5><a href="<?php echo get_the_permalink($id); ?>" ><?php echo $tagline;?></a></h5>
                            <?php endif; ?>
                                <?php echo "<figure class=\"show-for-small alignleft small-image\"><a href=\"" . get_the_permalink($id) . "\">" .get_the_post_thumbnail($id) . "</a></figure>";?>
                                <?php if (strlen(get_post_meta($post->ID, $id . "_custom_content", true)) > 0) {
                                $sc_id = $id;
                                echo do_shortcode("<p>" . get_post_meta($post->ID, $id . "_custom_content", true) . ' [a]Read more...[/a]' . "</p> <p class=\"results\">*Individual results may vary</p>");
                                } else {
                                    $sc_id = $id;
                                    echo do_shortcode("<p>" . get_post_meta($id, 'review-blurb', true) . " [a]Read more...[/a]" . "</p> <p class=\"results\">*Individual results may vary</p>");
                                }
                                ?>
                                <div class="small-24 columns table ratings-box">
                                <?php  if ($isTSK == "")  {  ?>
                                    <div class="row collapse">
                                        <div class="small-11 medium-5 columns criterion">
                                            Overall:
                                        </div>
                                        <div class="small-8 medium-7 columns">
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
                                        <div class="small-5 columns show-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-overall-value", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-3 medium-2 columns out-of -->
                                        <div class="small-11 medium-5 columns criterion">
                                            Value:
                                        </div>
                                        <div class="small-8 medium-7 columns">
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
                                        <div class="small-5 medium-12 columns show-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-long-term-results", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-5 columns show-for-small -->
                                    </div><!--/  row -->
                                    <div class="row collapse">
                                        <div class="small-11 medium-5 columns criterion">
                                            Potency:
                                        </div>
                                        <div class="small-8 medium-7 columns">
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
                                        <div class="small-5 columns show-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-effectiveness", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-5 columns show-for-small -->
                                        <div class="small-11 medium-5 columns criterion">
                                            Ingredients:
                                        </div>
                                        <div class="small-8 medium-7 columns">
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
                                        <div class="small-5 columns show-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-ingredient-quality", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-5 columns show-for-small -->
                                    </div><!--/  row -->
                                    <div class="row collapse">
                                        <div class="small-11 medium-5 columns criterion">
                                            Safety:
                                        </div>
                                        <div class="small-8 medium-7 columns">
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
                                        <div class="small-5 columns show-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-product-safety", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-5 columns show-for-small -->
                                        <div class="small-11 medium-5 columns criterion">
                                            User Rating:
                                        </div>
                                        <div class="small-8 medium-7 columns">
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
                                        <div class="small-5 columns show-for-small">
                                            <?php echo number_format ( get_post_meta($id, "ratings-speed-of-results", true), 1 ). "/" . $num; ?>
                                        </div><!--/ small-5 columns show-for-small -->
                                    </div><!--/  row -->
                                   <?php } ?> <!-- if is not tsk -->

                                    <div class="row collapse  <?php   if ($isTSK == "") { echo "ratings-break"; } ?> ">
                                        <div class="small-24 medium-12 columns">
                                            <div class="row collapse">
                                                <div class="small-10 columns criterion">
                                                    MSRP:
                                                </div>
                                                <div class="small-14 columns">
                                                    <?php echo "$" . number_format( get_post_meta($id, "retail_c1", true), 2 ); ?>
                                                </div>
                                                <div class="small-10 columns criterion">
                                                    Our Price:
                                                </div>
                                                <div class="small-14 columns">
                                                    <?php
                                                        $pricing = array();
                                                        $p1 = get_post_meta($id, "price_c1", true) / 1;
                                                        $p2 = get_post_meta($id, "price_c2", true) / 2;
                                                        if (get_post_meta($id, "qty_c3", true) > 2) {
                                                        $p3 = get_post_meta($id, "price_c3", true) / 3;
                                                        array_push($pricing, $p1, $p2, $p3 );
                                                        }
                                                        else {
                                                           array_push($pricing, $p1, $p2);
                                                        }
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
                                            </div> <!-- / .row collapse -->
                                        </div> <!-- / .small-24 medium-12 columns -->
                                        <div class="small-24 medium-12 columns">
                                            <div class="row collapse">
                                                <div class="small-10 columns criterion">
                                                    Guarantee:
                                                </div>
                                                <div class="small-14 columns">
                                                    <?php echo get_post_meta($id, "ratings-guarantee", true); ?>
                                                </div>
                                                <div class="small-10 columns criterion">
                                                    Reorder Rate:
                                                </div>
                                                <div class="small-14 columns">
                                                    <?php echo get_post_meta($id, "ratings-reorder", true); ?> *Results vary
                                                </div>
                                            </div> <!-- / .row collapse -->
                                        </div> <!-- / .small-24 medium-12 columns -->
                                    </div><!-- / .row -->
                                </div> <!--/small-12 columns table -->
                                <div class="row collapse">
                                <div class="small-24 medium-12 columns">
                                    <a href="<?php echo get_permalink($id) ?>" class="tiny button secondary radius"><?php echo $readMore ?></a>
                                </div><!--/.small-6 columns-->
                                <div class="small-24 medium-12 columns">
                                    <a href="<?php echo get_permalink($id) ?>/#buytable" class="tiny button success radius"><?php echo $seePricing; ?></a>
                                </div><!--/.columns-->
                            </div><!--/.row collapse-->
                            </div><!-- / .row -->
                        </div><!--/small-8 medium-7 columns table-->

                    </div><!--/.row collapse -->
                </div><!--/small-12 columns top-product-->
                <?php $i++; ?>
            <?php } // end for each loop ?>
        <?php } //end if is page and ids count ?>
        </div><!--/.row collapse-->
    </div><!--/.row upsell collapse top-rated-list -->
    <?php } // end top_products_cb
