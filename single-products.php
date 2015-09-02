<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 */
get_header(); ?>

<div class="row collapse">

    <div id="content" class="small-24 columns" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <?php do_action( 'before_review_content' ); ?>
        
            <div class="row collapse">
                <div class="small-24 columns">

                <?php 
                if (has_post_thumbnail($post->ID) && !in_category('recommended')) {
                    the_post_thumbnail( 'review-product-image' );
                }            
                ?>


                    <?php the_content(); ?>
                </div> <!-- / .small-12 -->
            </div> <!-- / .row -->
            <?php do_action( 'after_product_content' ); ?>

        </article>
    <?php endwhile;?>

    <?php while ( have_posts() ) : the_post(); ?>
    
    <?php do_action( 'foundationpress_post_before_comments' ); ?>
    <?php comments_template(); ?>
    <?php do_action( 'foundationpress_post_after_comments' ); ?>
    
    <?php endwhile;?>

    </div>
</div><!--/.row-->
<?php get_footer(); ?>