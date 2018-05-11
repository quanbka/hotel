<?php
/**
 * The template for displaying the footer.
 * @package Starhotel
 */
?>

</div>
<?php ; ?>
<!-- Footer -->
<footer>
    <?php global $sh_redux; ?>
    <?php if ($sh_redux['opt-select-footer-columns'] != 'none') { ?> 
    <div class="container">
        <div class="row">
            <div class="<?php global $sh_redux; ?><?php if ($sh_redux['opt-select-footer-columns'] == 4 ) { ?>col-md-3 col-sm-3<?php } ?><?php global $sh_redux; ?><?php if ($sh_redux['opt-select-footer-columns'] == 3 ) { ?>col-md-4 col-sm-4<?php } ?>">
                <?php
                if(is_active_sidebar('footer-area-1')){
                    dynamic_sidebar('footer-area-1');
                }
                ?>
            </div>
            <div class="<?php if ($sh_redux['opt-select-footer-columns'] == 4 ) { ?>col-md-3 col-sm-3<?php } ?><?php if ($sh_redux['opt-select-footer-columns'] == 3 ) { ?>col-md-4 col-sm-4<?php } ?>">
                <?php
                if(is_active_sidebar('footer-area-2')){
                    dynamic_sidebar('footer-area-2');
                }
                ?>
            </div>
            <div class="<?php if ($sh_redux['opt-select-footer-columns'] == 4 ) { ?>col-md-3 col-sm-3<?php } ?><?php if ($sh_redux['opt-select-footer-columns'] == 3 ) { ?>col-md-4 col-sm-4<?php } ?>">
                <?php
                if(is_active_sidebar('footer-area-3')){
                    dynamic_sidebar('footer-area-3');
                }
                ?>
            </div>
            <?php if ($sh_redux['opt-select-footer-columns'] == 4 ) { ?> 
            <div class="col-md-3 col-sm-3">
                <?php
                if(is_active_sidebar('footer-area-4')){
                    dynamic_sidebar('footer-area-4');
                }
                ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-6"> &copy;<?php echo date("Y"); ?> <?php esc_html_e( 'All Rights Reserved', 'starhotel' ); ?> <?php echo get_bloginfo('name'); ?> </div>
                <div class="col-xs-6 text-right">
                    <?php global $sh_redux; ?>
                    <?php
                    if (true == $sh_redux['switch-bottom-footer-right']) {
                    ?>
                        <?php echo wp_kses(  __('<ul><li><a href="#">Rooms</a></li></ul>', 'starhotel' ), array(    
                                'strong' => array(),
                                'em' => array(),
                                'ul' => array('li'),
                                'li' => array('a'),
                                'a' => array(
                                    'href' => array(),
                                    'title' => array(),
                                    'target' => array()
                                ),
                            )); ?>
                    <?php } else {
                    ?>
                            <?php global $sh_redux; echo wp_kses($sh_redux['bottom-footer-right'], array(    
                                'strong' => array(),
                                'em' => array(),
                                'ul' => array('li'),
                                'li' => array('a'),
                                'a' => array(
                                    'href' => array(),
                                    'title' => array(),
                                    'target' => array()
                                ),
                            ) ) ; ?>
                                                <?php } ?> 

                </div>
            </div>
        </div>
    </div>
</footer>

<?php
if (true == $sh_redux['switch-scroll-to-top']) {
    ?>
    <!-- Go-top Button -->
    <div id="go-top"><i class="fa fa-angle-up fa-2x"></i></div>
<?php }; ?>
<?php
if (true == $sh_redux['switch-custom-boxed-bg']) {
    ?>
    <!-- Background image -->
    </div>
<?php };?>

</div>
<?php wp_footer(); ?>
</body>
</html>
