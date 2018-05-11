<?php
/*
Template Name: Google Maps Header
* @package Starhotel 
*/
global $sh_redux; 
$google_maps_key = esc_attr($sh_redux['gmaps-api-key']);
$google_maps_url = 'https://maps.google.com/maps/api/js?key='.$google_maps_key;

sh_scripts_styles(
    wp_enqueue_script('gmap_js', get_template_directory_uri() . '/js/jquery.gmap.min.js', array('jquery')),
    wp_register_script('gmapsens_js', $google_maps_url, array('jquery')),
    wp_enqueue_script('gmapsens_js')
	);
	
get_header(); ?>

<!-- GMap -->
<div id="map">
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', 'page'); ?>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
