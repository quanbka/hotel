<?php
/*
Template Name: Revolution Slider with Reservation Form
* @package Starhotel
*/

get_header(); ?>

<!-- Revolution Slider -->
<div class="revolution-slider">
    <?php
    if ( putRevSlider("homepage") ) {
        putRevSlider("homepage"); }
    ?>
</div>

<!-- Reservation form -->
<?php if (true == $sh_redux['switch-reservation-form']) { ?>
    <div id="reservation-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12 res-z-index">
                    <form class="form-inline reservation-horizontal clearfix" role="form" method="post"
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
                        <!-- Error message -->
                        <div id="message"></div>
                        <div class="row">
                            <div class="<?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>col-sm-2"<?php } else { ?>col-sm-3"<?php } ?>>
                                <div class="form-group">
                                    <label for="email" accesskey="E"><?php esc_html_e('E-mail', 'starhotel'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-mail'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please fill in your email' , 'starhotel' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <input name="email" type="text" id="email" value="" class="form-control" placeholder="<?php _e('Please enter your E-mail', 'starhotel'); ?>"/>
                                </div>
                            </div>
                            <?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="phone" accesskey="P"><?php esc_html_e('Phone', 'starhotel'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-phone'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please add your country code' , 'starhotel' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <input name="phone" type="text" id="phone" value="" class="form-control" placeholder="<?php _e('Your phone number', 'starhotel'); ?>"/>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="<?php if (true == ($GLOBALS['sh_redux']['switch-phone-form'])) { ?>col-sm-1"<?php } else { ?>col-sm-2"<?php } ?>>
                                <div class="form-group">
                                    <label for="room"><?php esc_html_e('Type', 'starhotel'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-room'])) { ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Please select a room' , 'starhotel' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <select class="form-control" name="room" id="room">
                                        <option selected="selected" disabled="disabled"><?php esc_html_e('Select a room', 'starhotel'); ?></option>
                                        <?php if (true == $sh_redux['switch-no-preference-form']) { ?>
                                            <option value="<?php esc_html_e('No preference', 'starhotel'); ?>"><?php esc_html_e('No preference', 'starhotel'); ?></option>
                                        <?php } ?>
                                        <?php if ($sh_redux['opt-select-room-format'] == rooms) {
                                                // Room names in selectbox
                                                $args = array(
                                                    'post_type' => 'room',
                                                );
                                                $rooms = new WP_Query($args);
                                                if ($rooms->have_posts()) {
                                                    while ($rooms->have_posts()) {
                                                        $rooms->the_post();
                                                        ?>
                                                        <option value="<?php echo the_title(); ?>"><?php echo the_title(); ?></option>
                                                    <?php }
                                                }; } ?>
                                        <?php if ($sh_redux['opt-select-room-format'] == roomtypes) {
                                                // Roomtypes in selectbox
                                                $termsfilter = get_terms("roomtype");
                                                if (!empty($termsfilter) && !is_wp_error($termsfilter)) {
                                                    foreach ($termsfilter as $termfilter) {
                                                        echo "<option value='" . esc_attr($termfilter->name) . "'>" . esc_html($termfilter->name) . "</option>";
                                                    }
                                                };
                                                } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="checkin"><?php esc_html_e('Check-in', 'starhotel'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-checkin'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Check-In is from 11:00' , 'starhotel' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <i class="fa fa-calendar infield"></i>
                                    <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="<?php esc_html_e('Check-in', 'starhotel'); ?>"/>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="checkout"><?php esc_html_e('Check-out', 'starhotel'); ?></label>
                                    <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-checkout'])) {
                                        ?>
                                        <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('Check-out is from 12:00' , 'starhotel' );?>"><i class="fa fa-info-circle fa-lg"> </i></div>
                                    <?php } ?>
                                    <i class="fa fa-calendar infield"></i>
                                    <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="<?php esc_html_e('Check-out', 'starhotel'); ?>"/>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <div class="guests-select">
                                        <label><?php esc_html_e('Guests', 'starhotel'); ?></label>
                                        <i class="fa fa-user infield"></i>
                                        <div class="total form-control" id="test">1</div>
                                        <div class="guests">
                                            <div class="form-group adults">
                                                <label for="adults"><?php esc_html_e('Adults', 'starhotel'); ?></label>
                                                <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-guests-adults'])) {
                                                    ?>
                                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('+18 years' , 'starhotel' );?>">
                                                        <i class="fa fa-info-circle fa-lg"> </i>
                                                    </div>
                                                <?php } ?>
                                                <select name="adults" id="adults" class="form-control">
                                                    <?php
                                                    $xa = 1;
                                                    $xamax = ($GLOBALS['sh_redux']['opt-select-max-adults']);
                                                    while ($xa <= $xamax) {
                                                        echo "<option value='$xa'>" . $xa . esc_html__(' Adult(s)', 'starhotel') . "</option>";
                                                        $xa++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group children">
                                                <label for="children"><?php esc_html_e('Children', 'starhotel'); ?></label>
                                                <?php if (true == ($GLOBALS['sh_redux']['reservation-hint-guests-children'])) {
                                                    ?>
                                                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?php esc_html_e('0 till 18 years' , 'starhotel' );?>">
                                                        <i class="fa fa-info-circle fa-lg"> </i></div>
                                                <?php } ?>
                                                <select name="children" id="children" class="form-control">
                                                    <?php
                                                    $xc = 0;
                                                    $xcmax = ($GLOBALS['sh_redux']['opt-select-max-children']);
                                                    while ($xc <= $xcmax) {
                                                        echo "<option value='$xc'>" . $xc . esc_html__(' Child(ren)', 'starhotel') . "</option>";
                                                        $xc++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="button" class="btn btn-ghost-color button-save btn-block"><?php esc_html_e('Save', 'starhotel'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary btn-block"><?php esc_html_e('Book Now', 'starhotel'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

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
