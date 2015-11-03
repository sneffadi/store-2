<style>
#sitemap-content {padding: 30px 20px;}
#sitemap-content ul#sitemap li {list-style: none; margin-bottom: 3px;}
#sitemap-content ul#sitemap li a {text-decoration:none; color: #3a3a3a; font-weight:bold;  font-size: 16px}
#sitemap-content ul#sitemap .product-list li {background: url("<?php bloginfo( 'template_directory' );?>/images/arrow-main.png") no-repeat scroll 0 -3px transparent; text-decoration:none; color: #3a3a3a; font-weight:normal; font-size: 14px; padding: 0 0 5px 15px;}
#sitemap-content ul#sitemap .product-list li a {text-decoration:none; color: #3a3a3a; font-weight:normal; font-size: 14px;}
#sitemap-content ul#sitemap .product-list li a:hover {color: blue;}
</style>
<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */

get_header(); ?>

<div class="row">
	<div id="content" class="small-24 columns" role="main">
		<div id="sitemap-content">
			<h1>Site Map</h1>
		  	<ul style="margin-left: 0px; width: 355px; display: inline-block;" id="sitemap">
		    	<li>
	    			<a href="<?php echo site_url(); ?>">Male-Enhancements.com Home</a>
	    		</li>
	    		
	    		<li style="margin: 15px 0 10px 0;">
		    		<a >Category Pages</a>
		    	</li>
				<div style="margin-left: 15px;font-size: 12px;" class="product-list">
					<li>
						<a href="<?php echo site_url(); ?>/top-male-enhancements/">Top Male Enhancements</a>
					</li>	
					<li>
						<a href="<?php echo site_url(); ?>/sex-pills/">Sex Pills</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/erection-pills/">Erection Pills</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/natural-penis-enlargements/">Natural Penis Enlargements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/penis-enlargements/">Penis Enlargements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/male-enlargements/">Male Enlargements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/natural-male-enhancements/">Natural Male Enhancements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/best-male-enhancements/">Best Male Enhancements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/erectile-dysfunction-treatments/">Erectile Dysfunction Treatments</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/the-10-top-rated-male-enhancements/">The 10 Top Rated Male Enhancements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/all-male-enhancements/">All Male Enhancements</a>
					</li>			
					<li>
						<a href="<?php echo site_url(); ?>/special-limited-time-offer/">Special Limited Time Offer</a>
					</li>			

				</div>
				
				<li style="margin: 30px 0 10px 0;">
		    		<a>Products</a>
		    	</li>
		        <div style="margin-left: 15px;font-size: 12px;" class="product-list">
					<?php 
					query_posts('posts_per_page=-1&post_type=products&orderby=title&order=ASC');
						if(have_posts()):
								while(have_posts()):
			        			the_post();
								echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			        		endwhile;
						endif;
					?>
				</div>
				<li style="margin: 30px 0 10px 0;">
		    		<a>Miscellaneous</a>
		    	</li>
		    	<div style="margin-left: 10px;font-size: 12px;" class="product-list">
					<li>
						<a href="<?php echo site_url(); ?>/contact-us/">Contact Us</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/faq/">FAQ</a>
					</li>
					<li>
						<a href="<?php echo site_url(); ?>/site-map/">SiteMap</a>
					</li>
					<li>
	        			<a href="<?php echo site_url(); ?>/privacy/">Privacy Policy</a>
					</li>
					<li>
	     			    <a href="<?php echo site_url(); ?>/terms-of-use/">Terms of Use</a>
					</li>
					<li>
	     			    <a href="<?php echo site_url(); ?>/our-philosophy/">Our Philosophy</a>
					</li>
				</div>
				
			</ul>
			
			<!--ul style="margin-left: 0px; width: 350px; display: inline-block; vertical-align: top; margin-top: 25px;" id="sitemap">
				<li style="margin: 10px 0 5px 0;">
			    		<a>Diet Articles</a>
			   	</li>
				<div style="margin-left: 15px;font-size: 12px;" class="product-list">
				<?php 
				query_posts('posts_per_page=-1&cat=29&orderby=title&order=ASC');
					if(have_posts()):
							while(have_posts()):
			       			the_post();
							echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			       		endwhile;
					endif;
				?>
				</div>
			</ul-->
		</div>
	</div><!--/.columns-->
</div><!--/.row-->
<?php get_footer(); ?>