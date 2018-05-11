<?php
/**
 * Template Name: Custom page - Right sidebar
 * @package Starhotel
 */

get_header(); ?>

<!-- Parallax Effect -->
<?php
if (true == $sh_redux['switch-header-parallax']) {
    $parallax_header = isset($GLOBALS['sh_redux']['header-parallax-img']['url']) ? $GLOBALS['sh_redux']['header-parallax-img']['url'] : '';
?>
    <script type="text/javascript">jQuery(document).ready(function(){jQuery('#parallax-pagetitle').parallax("50%", -0.55);});</script>
    <div class="parallax-effect">
        <div id="parallax-pagetitle" style="background-image: url(<?php echo esc_url($parallax_header); ?>);">
            <div class="color-overlay">
                <!-- Page title -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if (true == $sh_redux['switch-header-breadcrumbs']) { ?>                                                    
                                <?php the_breadcrumb(); ?>
                            <?php }; ?>    
                            <?php the_title( '<h1>', '</h1>' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
};
?>

<div class="container">
    <div class="row">
        <!-- Page -->
        <div class="page mt50">
            <div class="col-md-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'page' ); ?>
                <?php endwhile; // end of the loop. ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
