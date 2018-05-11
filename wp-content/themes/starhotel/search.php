<?php
/**
 * The template for displaying Search Results pages.
 * @package Starhotel
 */

get_header(); ?>

<div class="no-results not-found">
    <?php if ( have_posts() ) : ?>
    <!-- Parallax Effect -->
    <?php
    if (true == $sh_redux['switch-header-parallax']) {
        $parallax_header = isset($GLOBALS['sh_redux']['header-parallax-img']['url']) ? $GLOBALS['sh_redux']['header-parallax-img']['url'] : '';
    ?>
        <script type="text/javascript">jQuery(document).ready(function(){jQuery('#parallax-pagetitle').parallax("50%", -0.55);});</script>
        <div class="parallax-effect">
            <div id="parallax-pagetitle" style="background-image: url(<?php echo esc_url($parallax_header); ?>);">
                <div class="color-overlay">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php if (true == $sh_redux['switch-header-breadcrumbs']) { ?>
                                    <?php the_breadcrumb(); ?>
                                <?php } ?>
                                <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                                    <div class="mt50">
                                <?php } ?>
                                    <h1><?php printf( esc_html__( 'Search Results for: %s', 'starhotel' ), '<span>' . esc_html(get_search_query()) . '</span>' ); ?></h1>
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
            <div class="blog mt50">
                <div class="col-md-9">
                    <h3 class="nm"><?php esc_html_e( 'Do you want to search again?', 'starhotel' ); ?></h3>
                    <p class="mt20"><?php esc_html_e( "Didn't find what you were looking for? Try a new search! ", 'starhotel' ); ?></p>
                    <?php get_search_form(); ?>
                    <div class="mt30"></div>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php if (is_search() && ($post->post_type=='room' || $post->post_type=='gallery' || $post->post_type=='page')) continue; ?>
                         <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'content', 'search' );
                        ?>
                    <?php endwhile; ?>
                    <?php esc_html(starhotel_pagination()); ?>
                    <?php else : ?>
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
                                            <?php esc_html(the_breadcrumb()); ?>
                                            <h1><?php esc_html_e('Nothing found' , 'starhotel' );?></h1>
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
                            <div class="col-md-9">
                                <?php get_template_part( 'content', 'none' ); ?>

                                <?php endif; ?>
                            </div>
                            <?php get_sidebar(); ?>

                        </div>
                    </div>
                    <?php get_footer(); ?>

