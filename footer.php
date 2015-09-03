<?php
/**
* The template for displaying the footer
*
* Contains the closing of the "off-canvas-wrap" div and all content after.
*
* @package WordPress
* @subpackage FoundationPress
* @since FoundationPress 1.0.0
*/
?>
</section>
<footer>
	<?php do_action( 'foundationpress_before_footer' ); ?>
	<div class="row medium-collapse">
		<div class="small-16 medium-8 columns">			
				
				<?php
					$options = get_option('theme_options');
					if (!empty($options['logo'])) {
						echo "<div class=\"logo\">";
						echo "<a href=\"" . get_home_url() . "\">";
						echo "<img src=\"" . do_shortcode("[upload_dir]") . $options['logo'] . "\" />";
						echo "</a>";
						echo "</div>";
					}
				?>									
			
		</div> <!-- / .small-16 -->
		<div class="small-8 medium-16 columns">
		</div><!--/.small-8-->
	</div> <!-- / .row -->
	<div class="row medium-collapse">
		<div class="small-24 medium-14 columns">			
			<div class="small-12 medium-8 columns">
				<h5>Products</h5>
				<?php wp_nav_menu( array(
				'theme_location' => 'Footer Column 1',
				'menu' => 'Products'
				)); ?>
			</div> <!-- / .small-6 medium 4 -->
			<div class="small-12 medium-8 columns">
				<h5>Customer Service</h5>
				<?php wp_nav_menu(
				array(
				'theme_location' => 'Footer Column 2',
				'menu' => 'Customer Service',
				)
				); ?>
			</div> <!-- / .small-6 medium 4 -->
			<div class="small-12 medium-8 end columns">
				<h5>Company</h5>
				<?php 
				wp_nav_menu( 
				array(
				'theme_location' => 'Footer Column 3',
				'menu' => 'Company',
				)
				); 
				?>
			</div> <!-- / .small-12 -->
		</div> <!-- / .small-24 medium 8 -->

		<div class="small-24 medium-10 columns">
			<form>
				<div class="offers">
					Get exclusive offers&nbsp;<span data-tooltip aria-haspopup="true" class="radius" title="We'll send you product updates and discounts. We won't spam you. Scouts honor."><i class="fa fa-info-circle"></i></span>
				</div>
				<input type="text" placeholder="Enter email address" class="email radius" />
				<a class="button tiny radius secondary">Subscribe</a>
			</form>
		</div> <!-- / .small-4 -->
	</div> <!-- / .row -->
	<div class="row">
		<div class="small-24 medium-24 columns end">
			<p>The statements made on this website have not been evaluated by the FDA. The products sold on this website are not intended to diagnose, treat, cure, or prevent any disease.</p>
			<p>&copy; 2013-<?php echo date('Y');?>, <?php echo get_bloginfo('name'); ?></p>
		</div> <!-- / .small-12 -->
	</div> <!-- / .row -->
	<?php do_action( 'foundationpress_after_footer' ); ?>
</footer>
<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
<a class="exit-off-canvas"></a>
<?php endif; ?>
<?php do_action( 'foundationpress_layout_end' ); ?>
<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
</div>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>