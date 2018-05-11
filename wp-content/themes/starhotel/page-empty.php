<?php
/**
 * Template Name: Custom page - Empty
 * @package Starhotel
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <!-- Page -->
        <div class="page mt50">
            <div class="col-md-12">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'page' ); ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
