<?php
/**
 * The Template for displaying all single posts.
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
                            <?php } ?>
                            <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                                <div class="mt50">
                            <?php } ?>
                            <?php the_title( '<h1>', '</h1>' ); ?>
                            <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                                </div>
                            <?php } ?>
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
            <!-- Blog -->
            <div class="single">
                <div class="blog mt50">
                <?php if ($sh_redux['blog-single-layout'] == 'left') {
                    get_sidebar(); 
                } ?>     
                    <div class="<?php if ($sh_redux['blog-single-layout'] == 'none') {?>col-md-8 col-sm-offset-2 <?php } else{ ?> col-md-9 <?php } ?>">
                        <div id="primary" class="content-area">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php esc_html(starhotel_post_nav()); ?>
								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() ) :
									comments_template();
								endif;
								?>
							<?php endwhile; // end of the loop. ?>
                        </div>
                    </div>
                </div>
                <?php if ($sh_redux['blog-single-layout'] == 'right') {
                        get_sidebar(); 
                    } ?>  
            </div>
        </div>
    </div>

<?php get_footer(); ?>