<?php
/**
 * Single Gallery
 * @package Starhotel
 */
get_header(); ?>

<!-- Parallax Effect -->
<?php
if (true == $sh_redux['switch-header-parallax']) {
    $parallax_header = isset($GLOBALS['sh_redux']['header-parallax-img']['url']) ? $GLOBALS['sh_redux']['header-parallax-img']['url'] : '';
?>
    <script type="text/javascript">jQuery(document).ready(function () {
            jQuery('#parallax-pagetitle').parallax("50%", -0.55);
        });</script>
    <div class="parallax-effect">
        <div id="parallax-pagetitle" style="background-image: url(<?php echo esc_url($parallax_header); ?>);">
            <div class="color-overlay">
                <!-- Page title -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if (true == $sh_redux['switch-header-breadcrumbs']) { ?>                                                    
                                <ol class="breadcrumb">
                                    <?php $post_type = get_post_type_object(get_post_type()); ?>
                                    <?php $slug = $post_type->rewrite['slug']; ?>
                                    <li><a href="<?php echo esc_url(home_url()); ?>">Home</a></li>
                                    <li><a href="<?php echo esc_url(get_post_type_archive_link( 'imagegallery' )); ?>"><?php esc_html_e('Gallery', 'starhotel');}?></a>
    								</li><?php the_title('<li class="active">', '</li>'); ?>                          
    							</ol>
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

// Find ID of Attachment
function get_attachment_id_by_src($image_src)
{
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}
?>

    <!-- Filter -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                // filter through filters
                $termsfilter = get_terms("tags");
                $tags = the_tags();
                if (!empty($termsfilter) && !is_wp_error($termsfilter)) {
                    echo "<ul class='nav nav-pills' id='filters'>";
                    echo "<li class='active'><a href='#' data-filter='*'>" . esc_html__('All', 'starhotel') . "</a></li>";
                    foreach ($termsfilter as $termfilter) {
                        $termstriped = str_replace(" ","-",$termfilter ->name );
                        echo "<li><a href='#' data-filter='." . esc_html($termstriped) . "'>" . esc_html($termfilter->name) . "</a></li>";
                    }
                };
                echo "</ul>";
                ?>
            </div>
        </div>
    </div>

    <!-- Gallery -->
    <div id="gallery" class="mt50">
        <div class="container">
            <div class="row gallery">
                <?php
                // Load all images
                $args = array(
                    'post_type' => 'imagegallery',
                );
                $gallery = new WP_Query($args);
                if ($gallery->have_posts()) {
                while ($gallery->have_posts()) {
                    $gallery->the_post();
                    ?>
                    <?php
                    $images = rwmb_meta('rmwb_thickbox', 'type=image');
                    // Loop through all images
                    foreach ($images as $image) {
                        // Get img url
                        $image_url = ($image['full_url']);
                        // Convert img url into ID
                        $image_id = get_attachment_id_by_src($image_url);
                        $title = get_the_title();
                        // Get terms from ID
                        $terms = wp_get_object_terms($image_id, 'tags');
                        $res = true;
                        // Loop through all terms and implode anchers
                        foreach ($terms as $term) {
                            $termstriped = str_replace(" ","-",$term ->name );
                            $term_names[] = $termstriped;
                            $res = implode(' ', $term_names);
                        }
                        // Get img details
                        echo "<div class='col-md-3 col-sm-3 col-xs-12 fadeIn appear mfp_open " . esc_html($res) . "' data-start='200'><a href='" . esc_url($image['full_url']) . "'><img src='" . esc_url($image['url']) . "' width='" . esc_attr($image['width']) . "' height='" . esc_attr($image['height']) . "' class='img-responsive zoom-img' alt='" . esc_attr($image['alt']) . "' /><i class='fa fa-search'></i></a></div>";
                        // Reset term array
                        unset($term_names);
                    }
                }
                ?>
            </div>
            <?php
            }
            else {
                echo esc_html('Please create your gallery in the WP-admin section');
            }
            ?>
        </div>
    </div>
<?php get_footer(); ?>