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

<div class="row">
<!-- Row for main content area -->
	<div class="small-24 medium-16 columns" role="main">

	<?php if ( have_posts() ) : ?>
		<?php 
		echo "<h4>All Reviews</h4>";	
		echo "<ul id=\"product_list\">"; ?>
		<?php query_posts($query_string . '&orderby=title&order=ASC'); ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$alphas = range('a', 'z');
			foreach ($alphas as $alpha) {
				if (stripos($post->post_title, $alpha) === 0) {
        			echo "<div>" . $alpha . "</div>";
    			}
			}
				echo "<li>";
				echo "<a href=\"" . get_permalink($post->ID) . "\">";
				echo $post->post_title;
				echo "</a>";
				echo "</li>";
			?>

		<?php endwhile; ?>
		<?php echo "</ul>"; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; // End have_posts() check. ?>

	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ( function_exists( 'foundationpress_pagination' ) ) { foundationpress_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'foundationpress' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'foundationpress' ) ); ?></div>
		</nav>
	<?php } ?>

	</div>
	    <?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>
