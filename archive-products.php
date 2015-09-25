<?php

/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

get_header(); ?>

<div class="row collapse">
<!-- Row for main content area -->
	<div class="small-24 medium-24 columns" role="main">

	<?php
if (have_posts()): ?>
		<?php
    $options = get_option('theme_options');
    $num = !empty($options['ratings']) ? $options['ratings'] : "100";
    echo "<h1>All Products</h1>";
    echo "<div id=\"product_list\">"; ?>
    	<div class="row collapse">
		<?php query_posts($query_string . '&orderby=title&order=ASC'); ?>
		<?php
			$i = 1;
	    	while (have_posts()):
		        the_post();
		      	global $post;
		      	$id = $post->ID;
		      	$image = get_the_post_thumbnail($id, 'medium');
				$link = get_permalink($id);
				$end = '';
				if ($i == sizeof($posts)) { $end = " end"; }

    	?>
				<div class="small-24 medium-8 columns<?php echo $end; ?>">
					<?php
						if ( $i % 3  == 0) {
							$colCount = 'three';
						} elseif ( $i % 3  == 1)  {
							$colCount = 'one';
						} elseif ( $i % 3 == 2 ) {
							$colCount = 'two';
						}
					?>
					<div class="product-item <?php echo $colCount; ?>">
					<?php
				        echo "<div class=\"product-name\">";
				        echo "<a href=\"" . get_permalink($post->ID) . "\">";
				        echo $post->post_title;
				        echo "</a>";
				        echo "</div>";
				        echo "<figure>";
				        echo "<a href=\"" . $link . "\">";
				        echo $image;
				        echo "</a>";
				        echo "</figure>";
					?>
					<div class="ratings-container">
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
				        <?php echo "<div class=\"rating\">" . number_format(get_post_meta($id, "ratings-overall-value", true), 1) . "/" . $num . "</div>"; ?>
			        </div> <!-- / .ratings-container -->
				    <div class="msrp">
				        	Retail: $<?php echo (get_post_meta($id, "retail_c1_r1", true)); ?>
				    </div>
				    <div class="our-price">
				        	Our Price: <a href="<?php echo $link; ?>">$<?php echo get_post_meta($id, "price_c1", true); ?></a>
				    </div>
				    <div class="row">
					    <div class="small-24 columns">
					    	<a href="<?php echo $link; ?>" class="button success tiny radius">Read More</a>
					    </div> <!-- / .small-12 -->
				    </div> <!-- / .row -->
				</div> <!-- / .product-item -->
			</div><!-- /. small-24 medium-6 columns -->
		<?php
		$i++;
    endwhile; ?>
    </div> <!-- / .row -->

		<?php
    echo "</div>"; ?>

		<?php
else: ?>
			<?php
    get_template_part('content', 'none'); ?>
	<?php
endif;
 // End have_posts() check.
 ?>
	</div>
</div>
<?php
get_footer(); ?>
