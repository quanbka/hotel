<?php
/**
 * The template used for displaying page content in content-page.php
 * @package Starhotel
 */
?>
<?php edit_post_link( esc_html__( 'Edit this page', 'starhotel' ), '<span class="edit-link">', '</span>' ); ?>
<?php the_content(); ?>
