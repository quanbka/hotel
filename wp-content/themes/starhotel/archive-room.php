<?php
/**
 * Template Name: Rooms
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
                                    <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home', 'starhotel');?></a></li>
                                    <li class="active"><?php if (!empty($sh_redux['top-header-breadcrumb-rooms-text-fix'])) { ?><?php echo esc_html($sh_redux['top-header-breadcrumb-rooms-text-fix']);?><?php }
                                        else { esc_html_e('Rooms', 'starhotel'); }?></li>
                                </ol>
                            <?php } ?>
                            <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                                <div class="mt50">
                            <?php } ?>                                   
                                <h1><?php esc_html_e('Rooms' , 'starhotel' );?></h1>
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

    <!-- Filter -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php
                // filter through filters
                $termsfilter = get_terms("roomtype");
                if (!empty($termsfilter) && !is_wp_error($termsfilter)) {
                    echo "<ul class='nav nav-pills' id='filters'>";
                    echo "<li class='active'><a href='#' data-filter='*'>" . esc_html__('All', 'starhotel') . "</a></li>";
                    foreach ($termsfilter as $termfilter) {
                        $termstriped = str_replace(" ","-",$termfilter ->name );
                        echo "<li><a href='#' data-filter='." . esc_attr($termstriped) . "'>" . esc_html($termfilter->name) . "</a></li>";
                    }
                };
                echo "</ul>";
                ?>
            </div>
        </div>
    </div>

    <!-- Rooms -->
    <div class="rooms mt100">
        <div class="container">
            <div class="row room-list">
                <?php
                // Load all rooms
                $room_order = $sh_redux['opt-select-room-order'];
                $args = array(
                    'post_type' => 'room',
                    'posts_per_page' => -1,
                    'orderby' => $room_order,
                    'order' => 'asc'
                );
                $rooms = new WP_Query($args);
                if ($rooms->have_posts()) {
                    while ($rooms->have_posts()) {
                        $rooms->the_post();
                        ?>
                        <!-- Room -->
                        <?php
                        $terms = wp_get_object_terms($post->ID, 'roomtype');
                        if ( $terms && !is_wp_error( $terms ) ) :
                            ?>
                            <?php foreach ( $terms as $term ) {
                            $termstriped = str_replace(" ","-",$term ->name );
                            $term_names[] = $termstriped;
                            $res = implode(' ', $term_names);
                        } ?>
                        <?php endif; ?>
                        <div class="col-sm-4 <?php echo esc_attr($res)?>">
                            <?php  // Reset term array
                            unset($term_names);?>
                            <div class="room-thumb">
                                <?php
                                if ( has_post_thumbnail() )
                                    the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
                                else
                                    echo '<img src="' . esc_url(get_stylesheet_directory_uri()) . '/images/rooms/356x228.gif." alt="title" title="title" />';
                                ?>
                                <div class="mask">
                                    <div class="main">
                                        <h5><?php the_title(); ?></h5>
                                        <?php
                                        $price1 = rwmb_meta( 'mbr_price1', 'type=text' );
                                        if (!empty($price1)) {
                                            echo "<div class='price'> " . esc_html($price1) . "<span>" .  esc_html__('a night', 'starhotel') . "</span></div>";
                                        }
                                        ?>
                                    </div>
                                    <div class="content">
                                        <?php
                                        $room_title = rwmb_meta( 'mbr_title1', 'type=text' );
                                        $excerpt = rwmb_meta( 'mbr_excerpt', 'type=textarea' );
                                        ?>
                                        <p><?php
                                            if (!empty($room_title)) {
                                                echo "<span>" . esc_html($room_title) . "</span>";
                                            }
                                            ?><?php echo esc_html($excerpt) ?></p>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <ul class="list-unstyled">
                                                    <?php
                                                    $usp1 = rwmb_meta( 'mbr_text1', 'type=text' );
                                                    $usp2 = rwmb_meta( 'mbr_text2', 'type=text' );
                                                    $usp3 = rwmb_meta( 'mbr_text3', 'type=text' );
                                                    if (!empty($usp1)) {
                                                        echo "<li><i class='fa fa-check-circle'></i> " . esc_html($usp1) . "</li>";
                                                    }
                                                    if (!empty($usp2)) {
                                                        echo "<li><i class='fa fa-check-circle'></i> " . esc_html($usp2) . "</li>";
                                                    }
                                                    if (!empty($usp3)) {
                                                        echo "<li><i class='fa fa-check-circle'></i> " . esc_html($usp3) . "</li>";
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="col-xs-6">
                                                <ul class="list-unstyled">
                                                    <?php
                                                    $usp4 = rwmb_meta( 'mbr_text4', 'type=text' );
                                                    $usp5 = rwmb_meta( 'mbr_text5', 'type=text' );
                                                    $usp6 = rwmb_meta( 'mbr_text6', 'type=text' );
                                                    if (!empty($usp4)) {
                                                        echo "<li><i class='fa fa-check-circle'></i> " . esc_html($usp4) . "</li>";
                                                    }
                                                    if (!empty($usp5)) {
                                                        echo "<li><i class='fa fa-check-circle'></i> " . esc_html($usp5) . "</li>";
                                                    }
                                                    if (!empty($usp6)) {
                                                        echo "<li><i class='fa fa-check-circle'></i> " . esc_html($usp6) . "</li>";
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block"> <?php echo esc_html__('Book now', 'starhotel') ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php
                } else {
                    echo esc_html('<div class="pull-left">Please create your rooms in the WP-admin section</div>');
                }
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>