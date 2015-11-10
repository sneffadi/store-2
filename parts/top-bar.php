<?php
/**
* Template part for top bar menu
*
* @package WordPress
* @subpackage FoundationPress
* @since FoundationPress 1.0
*/
?>
<div class="top-bar-container contain-to-grid show-for-small-up">
    <nav class="top-bar logo-section">
    <div class="row collapse">
        <div class="small-9 columns">
                    <?php
                    $url = home_url();
                    $options = get_option('theme_options');
                    if (!empty($options['logo'])) {
                        $content = "<div class=\"logo\">";
                            $content.= "<a href=\"" . $url . "\">";
                            $content.= "<img src=\"" . do_shortcode('[upload_dir]') . $options['logo'] . "\" />";
                            $content.= "</a>";
                        $content.= "</div>";
                    }
                    else {
                        $url = home_url();
                        $content = "<h1><a href=\"" . $url . "\">" . get_bloginfo('name') . "</a></h1>";
                    }
                    echo $content;
                    ?>
        </div> <!-- / .small-12 -->
        <div class="small-3 columns">
        </div> <!-- / .small-12 -->
    </div> <!-- / .row -->
    </nav>
    <nav class="top-bar nav" data-topbar role="navigation">
        <section class="top-bar-section">
            <?php foundationpress_top_bar_l(); ?>
        </section>
    </nav>
</div>
