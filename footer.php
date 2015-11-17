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
	<?php
		global $topTwo;
		if (isset($topTwo)) {
			foreach ($topTwo as $key => $value) {
				$url = get_the_permalink($value);
				echo '<link rel="prefetch" href="' . $url . '">';
				echo '<link rel="prerender" href="'. $url .'">';
			}
		}
	?>
	<?php do_action( 'foundationpress_before_footer' ); ?>
	<div class="row collapse border">
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
	<div class="row collapse border">
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

		<div class="small-24 medium-8 columns right">
				<form>
				<div class="small-18 columns">
					<form action="http://www.elabs10.com/functions/mailing_list.html" method="post" name="subscriptionForm" id="subscriptionForm">
    <script type="text/javascript" src="http://email.unkubed.com/foot-subs/subscribe.js"></script>
    <div class="hidden" style="display: none; position: absolute; top: -29px; left: 0px; z-index: 5; font-size: 17px; color: rgb(97, 187, 37); font-weight: 700;"><img style="width: 16px; height: 15px;" src="http://email.unkubed.com/foot-subs/green_checkmark.png" alt=""> You've successfully subscribed!</div>
    <div class="hidden" style="display: none; position: absolute; top: -29px; left: 0px; z-index: 5;"><img style="width: 25px; height: 25px;" alt="Processing..." src="http://email.unkubed.com/foot-subs/working.gif"></div>

                <div class="offers">
                    Get exclusive offers&nbsp;<span title="" aria-describedby="tooltip-ih3t8jno0" data-selector="tooltip-ih3t8jno0" data-tooltip="" aria-haspopup="true" class="radius"><i class="fa fa-info-circle"></i></span>
                </div>
                <input name="mlid" value="269544" type="hidden">
                  <input name="siteid" value="2010001189" type="hidden">
                  <input name="tagtype" value="q2" type="hidden">
                  <input name="demographics" value="-1,49975,58189" type="hidden">
                  <input name="redirection" value="http://www.male-enhancements.com" type="hidden">
                  <input name="activity" value="submit" type="hidden">
                  <input name="val_49975" value="footer" type="hidden">
                  <!-- SBT Goes here --> <input name="val_58189" value="MALE" type="hidden"> <!-- SBT Goes here -->
                <input placeholder="Enter email address" name="email" class="email radius" required="required" type="email">
                <input class="button tiny radius secondary" value="Subscribe" type="submit">
            </form>

		</div> <!-- / .small-4 -->
	</div> <!-- / .row -->
	<div class="row">
		<div class="small-24 medium-24 columns end">
			<p>The information on this site has not been evaluated by the FDA. This product is not intended to diagnose, treat, cure or prevent any disease. Results in description and Testimonials may not be typical results and individual results may vary. All orders placed through this website are subject to acceptance, in its sole discretion.</p>
			<ul class="footer-bar">
			<li>&copy; 2013-<?php echo date('Y');?>, <?php echo get_bloginfo('name'); ?></li>
			<li>|</li>
			 <li><a href="javascript:safePop('http://www.male-enhancements.com/privacy.php')">Privacy Policy</a></li>
			 <li>|</li>
			 <li><a href="javascript:safePop('http://www.male-enhancements.com/terms.php')">Terms and Conditions</a></li>
			 <li>|</li>
			 <li><a href="javascript:safePop('http://www.male-enhancements.com/testimonial-disclaimer.html')">Testimonial Disclaimer</a></li>
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
