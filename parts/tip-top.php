<?php
/**
* Template part for tip top bar
*
* @package WordPress
* @subpackage FoundationPress
* @since FoundationPress 1.0
*/
?>
<div class="tip-top">
    <div class="row medium-collapse">
        <div class="small-12 columns tip-top-l">                        
            <?php
            $options = get_option('theme_options');
            if (!empty($options['phone'])): ?>
            <i class="fa fa-mobile"></i>
            <span class="phone">
            <?php echo $options['phone']; ?>
            </span>
            <?php endif; ?>               
            <a href="http://www.buyhairlosstreatments.com/contact/">         
            <i class="fa fa-envelope"></i>
            <span class="email">
                Email us
            </span><!--/.email-->
            </a>
            
            <a href="javascript:void(0);" onclick="olark('api.box.expand')">
                <i class="fa fa-comment"></i>
                <span class="chat">
                    Chat
                </span><!--/.chat-->
            </a>
           
        </div> <!-- / .small-12 -->
        <div class="small-12 columns tip-top-r">
            <span class="cart">
                <a href="<?php echo do_shortcode('[cart_url]');?>">
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </span><!--/.cart-->
        </div> <!-- / .small-12 -->
    </div> <!-- / .row -->
</div> <!-- / .tip-top -->