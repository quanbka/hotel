<?php
/**
 * The Sidebar containing the main widget areas.
 * @package Starhotel
 */
?>
<!-- Aside -->

<aside class="mt50" role="complementary">
    <div class="col-md-3">
        <?php if ( ! dynamic_sidebar( 'blog-widgets' ) ) : ?>
            <div id="meta" class="widget">
                <h3><?php esc_html_e( 'Meta', 'starhotel' ); ?>vla</h3>
                <ul>
                    <?php wp_register(); ?>
                    <li><?php wp_loginout(); ?></li>
                    <?php wp_meta(); ?>
                </ul>
            </div>
            <div id="search" class="widget widget_search">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</aside>
