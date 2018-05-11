<?php
/**
 * Single Room
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
                                    <li><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Home', 'starhotel');?></a></li>
                                    <li><a href="<?php echo esc_url(get_post_type_archive_link( 'room' )); ?>"><?php esc_html_e('Rooms', 'starhotel');?></a>
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
};
?>

    <div class="container">
        <div class="row">
            <?php
            if (true == $sh_redux['switch-room-slider']) {
            ?>
            <!-- Slider -->
            <div class="room-slider standard-slider mt50">
                <div class="col-sm-12 <?php if (true == $sh_redux['switch-reservation-form']) { ?>col-md-8<?php } else { echo'col-md-12'; } ?>">
                    <div id="owl-standard" class="owl-carousel">
                        <?php
                        if(have_posts()): while(have_posts()): the_post();
                            $images = rwmb_meta( 'mbr_thickbox', 'type=image' );
                            foreach ( $images as $image )
                            {
                                $title = get_the_title();
                                echo "<div class='item mfp_open'> <a href='". esc_url($image['full_url']) ."'><img src='" . esc_url($image['full_url']) . "' alt='" . esc_attr($image['alt']) . "' class='img-responsive'></a> </div>";
                            }
                        endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
            <?php }; ?>


            <!-- Reservation form -->
            <?php if (true == $sh_redux['switch-reservation-form']) { ?>
            <div id="reservation-form" class="mt50 clearfix">
                <div class="col-sm-12 col-md-4">
                    <form class="reservation-vertical clearfix" role="form" method="post"
                    <?php if ($GLOBALS['sh_redux']['opt-switch-method'] == phpmail) { ?>
                        action="<?php echo esc_url(get_template_directory_uri())?>/inc/sendmail/reservation.php"
                    <?php } ?>
                    <?php if ($GLOBALS['sh_redux']['opt-switch-method'] == smtpmail) { ?>
                        action="<?php echo esc_url(get_template_directory_uri())?>/inc/smtp/reservation.php"
                    <?php } ?>
                    <?php if ($GLOBALS['sh_redux']['opt-switch-method'] == wpmail OR $GLOBALS['sh_redux']['opt-switch-method'] == 0) { ?>
                        action="<?php echo esc_url(get_template_directory_uri())?>/inc/wpmail/reservation.php"
                    <?php }
                    ?> name="reservationform" id="reservationform">                
                        <h2 class="lined-heading"><span><?php esc_html_e('Reservation' , 'starhotel' );?></span></h2>
                        <?php
                        $price1 = rwmb_meta( 'mbr_price1', 'type=text' );
                        if (!empty($price1)) {
                        ?>
                        <div class="price">
                            <?php
                            // Room Options
                            $args = array(
                                'post_type' => 'room',
                            );
                            $rooms = new WP_Query($args);
                            if ($rooms->have_posts()) {
                                ?>
                                <h4><?php echo the_title(); ?></h4>
                            <?php };?>
                            <?php echo esc_html($price1) . "<span>" .  esc_html__('a night', 'starhotel') . "</span></div>";
                            }
                            ?>
                            <!-- Error message -->
                            <div id="message"></div>
                            <div class="form-group">
                                <label for="email" accesskey="E"><?php esc_html_e('E-mail' , 'starhotel' );?></label>
                                <?php if (true == $sh_redux['reservation-hint-mail']) {
                                    ?>
                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please fill in your email' , 'starhotel' );?>"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                                <?php } ?>
                                <input name="email" type="text" id="email" value="" class="form-control" placeholder="<?php esc_html_e('Please enter your E-mail' , 'starhotel' );?>"/>
                            </div>
                            <?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>
                                <div class="form-group">
                                    <label for="phone" accesskey="P"><?php esc_html_e('Phone', 'starhotel'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-phone'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please add your country code' , 'starhotel' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <input name="phone" type="text" id="phone" value="" class="form-control" placeholder="<?php _e('Your phone number', 'starhotel'); ?>"/>
                                </div>
                            <?php } ?>
							<div class="form-group">
								<select class="hidden" name="room" id="room">
									<option selected="selected"><?php echo the_title(); ?></option>
								</select>
							</div>
                            <div class="form-group">
                                <label for="checkin"><?php esc_html_e('Check-in' , 'starhotel' );?></label>
                                <?php if (true == $sh_redux['reservation-hint-checkin']) {
                                    ?>
                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Check-In is from 11:00' , 'starhotel' );?>"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                                <?php } ?>
                                <i class="fa fa-calendar infield"></i>
                                <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="<?php esc_html_e('Check-in' , 'starhotel' );?>"/>
                            </div>
                            <div class="form-group">
                                <label for="checkout"><?php esc_html_e('Check-out' , 'starhotel' );?></label>
                                <?php if (true == $sh_redux['reservation-hint-checkout']) {
                                    ?>
                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Check-out is from 12:00' , 'starhotel' );?>"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                                <?php } ?>
                                <i class="fa fa-calendar infield"></i>
                                <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="<?php esc_html_e('Check-out' , 'starhotel' );?>"/>
                            </div>
                            <div class="form-group">
                                <div class="guests-select">
                                    <label><?php esc_html_e('Guests' , 'starhotel' );?></label>
                                    <i class="fa fa-user infield"></i>
                                    <div class="total form-control" id="test">1</div>
                                    <div class="guests">
                                        <div class="form-group adults">
                                            <label for="adults"><?php esc_html_e('Adults' , 'starhotel' );?></label>
                                            <?php if (true == $sh_redux['reservation-hint-guests-adults']) {
                                                ?>
                                                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('+18 years' , 'starhotel' );?>"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                                            <?php } ?>
                                            <select name="adults" id="adults" class="form-control">
                                                <?php
                                                $xa = 1;
                                                $xamax = $sh_redux['opt-select-max-adults'];
                                                while($xa <= $xamax) {
                                                    echo "<option value='$xa'>" . $xa . esc_html__(' Adult(s)' , 'starhotel' ) . "</option>";
                                                    $xa++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group children">
                                            <label for="children"><?php esc_html_e('Children' , 'starhotel' );?></label>
                                            <?php if (true == $sh_redux['reservation-hint-guests-children']) {
                                                ?>
                                                <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('0 till 18 years' , 'starhotel' );?>"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                                            <?php } ?>
                                            <select name="children" id="children" class="form-control">
                                                <?php
                                                $xc = 0;
                                                $xcmax = $sh_redux['opt-select-max-children'];
                                                while($xc <= $xcmax) {
                                                    echo "<option value='$xc'>" . $xc . esc_html__(' Child(ren)' , 'starhotel' ) . "</option>";
                                                    $xc++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-ghost-color button-save btn-block"><?php esc_html_e('Save' , 'starhotel' );?></button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"><?php esc_html_e('Book Now' , 'starhotel' );?></button>
                        </form>
					</div>
                </div>
                <?php } ?>
            </div>
        </div>


        <!-- Room Content -->
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php
                        if(have_posts()): while(have_posts()): the_post();
                            echo the_content();
                        endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
<?php get_footer(); ?>
