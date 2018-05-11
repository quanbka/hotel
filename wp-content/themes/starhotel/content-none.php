<?php
/**
 * The template part for displaying a message that posts cannot be found.
 * @package Starhotel
 */
?>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
    <p class="mt50"><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'starhotel' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
<?php elseif ( is_search() ) : ?>
    <p class="mt50"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'starhotel' ); ?></p>
    <div class="row">
        <div class="col-md-9 mt20">
            <?php get_search_form(); ?>
        </div>
    </div>
<?php else : ?>
    <p class="mt50"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'starhotel' ); ?></p>
    <?php get_search_form(); ?>
<?php endif; ?>