<?php
/**
 * The template for displaying the header.
 * @package Starhotel
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php global $sh_redux; echo esc_url($sh_redux['favicon']['url']);?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
    <?php
    // Custom JS
    if (!empty($sh_redux['opt-ace-editor-js'])) {
        echo '<script>'.esc_js($sh_redux['opt-ace-editor-js']).'</script>';
    };
    ?>
    <?php
    // Custom CSS
    if (!empty($sh_redux['opt-ace-editor-css'])) {
        echo '<style>'.$sh_redux['opt-ace-editor-css'].'</style>';
    };
    ?>    
<?php wp_head(); ?>
</head>

<body <?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { global $logosize; $logosize = 'logo-lg'; } ?> <?php global $logosize; body_class($logosize); ?>>
    <?php
    // Prewritten CSS
    if (false == $sh_redux['switch-custom-style']) {
        ?>
        <link rel="stylesheet" property="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?><?php echo esc_url($sh_redux['opt-select-stylesheet'])?>">
    <?php };?>
<?php
if (true == $sh_redux['switch-custom-boxed-bg']) {
?>
<?php if (!empty($sh_redux['opt-background-image']['url'])) {
    ?>
    <img id="background-image" alt="background image" src="<?php global $sh_redux; echo esc_url($sh_redux['opt-background-image']['url']);?>">
<?php } ?>
<div class="boxed">
    <?php };?>
    <div id="page" class="hfeed site">
        <?php if (true == $sh_redux['switch-top-header']) {
            ?>
            <!-- Top header -->
            <div id="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="th-text th-left-center">
                                <?php if (true == $sh_redux['switch-top-header-contact']) { ?>
                                    <div class="th-item"> <a href="tel://<?php echo esc_html($sh_redux['top-header-contact-phone']); ?>"><i class="fa fa-phone"></i> <?php echo esc_html($sh_redux['top-header-contact-phone']);?></a> </div>
                                    <div class="th-item"> <a href="mailto:<?php echo esc_html($sh_redux['top-header-contact-mail']);?>"><i class="fa fa-envelope"></i> <?php echo esc_html($sh_redux['top-header-contact-mail']);?> </a></div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="th-text th-right-center <?php if (false == $sh_redux['switch-top-header-wpml']) { ?>hidden-xs<?php } ?>">
                                <?php if (true == $sh_redux['switch-top-header-wpml']) { ?>
                                    <?php
                                    if(is_active_sidebar('wpml-top-header')){
                                        dynamic_sidebar('wpml-top-header');
                                    } session_start(); $_SESSION["current_lang"] = ICL_LANGUAGE_CODE; if (ICL_LANGUAGE_CODE==$_SESSION["current_lang"]): $_SESSION["new_current_lang"] = $_SESSION["current_lang"]; endif;
                                    ?>
                                <?php } ?>
                                <?php if (true == $sh_redux['switch-top-header-social']) { ?>
                                    <div class="th-item hidden-xs">
                                        <div class="social-icons">
                                            <?php if (!empty($sh_redux['top-header-social-facebook'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-facebook']);?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-twitter'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-twitter']);?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-gplus'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-gplus']);?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-youtube'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-youtube']);?>" target="_blank"><i class="fa fa-youtube"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-vimeo'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-vimeo']);?>" target="_blank"><i class="fa fa-vimeo-square"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-flickr'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-flickr']);?>" target="_blank"><i class="fa fa-flickr"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-skype'])) {
                                                ?>
                                                <a href="<?php echo esc_html($sh_redux['top-header-social-skype']);?>" target="_blank"><i class="fa fa-skype"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-linkedin'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-linkedin']);?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-tumblr'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-tumblr']);?>" target="_blank"><i class="fa fa-tumblr"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-instagram'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-instagram']);?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                            <?php } ?>
                                            <?php if (!empty($sh_redux['top-header-social-rss'])) {
                                                ?>
                                                <a href="<?php echo esc_url($sh_redux['top-header-social-rss']);?>" target="_blank"><i class="fa fa-rss"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- Header -->
        <header>
            <?php if( function_exists( 'ubermenu' )  && (true == $sh_redux['switch-uber-menu']) ): ?>
                <div class="navbar yamm navbar-default" <?php if (true == $sh_redux['switch-sticky-nav']) {
                    ?> id="sticky" <?php } ?>>
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">


                                <!-- Logo -->
                                <div id="logo">
                                    <img id="default-logo" src="<?php global $sh_redux; echo esc_url($sh_redux['default-logo']['url']);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="height:<?php if ($sh_redux['opt-select-logo-size'] == 'logo-sm') { ?>44px<?php }; ?><?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { ?>88px<?php }; ?>;">
                                    <?php
                                    if (!empty($sh_redux['retina-logo']['url'])) {
                                        ?>
                                        <img id="retina-logo" src="<?php global $sh_redux; echo esc_url($sh_redux['retina-logo']['url']);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="height:<?php if ($sh_redux['opt-select-logo-size'] == 'logo-sm') { ?>44px<?php }; ?><?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { ?>88px<?php }; ?>;">
                                    <?php }
                                    else {
                                        ?><img id="retina-logo" src="<?php global $sh_redux; echo esc_url($sh_redux['default-logo']['url']);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="height:<?php if ($sh_redux['opt-select-logo-size'] == 'logo-sm') { ?>44px<?php }; ?><?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { ?>88px<?php }; ?>;">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                        </div>
                        <?php ubermenu( 'main' , array( 'theme_location' => 'primary' ) ); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="navbar yamm navbar-default" <?php if (true == $sh_redux['switch-sticky-nav']) {
                    ?> id="sticky" <?php } ?>>
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                                <!-- Logo -->
                                <div id="logo">
                                    <img id="default-logo" src="<?php global $sh_redux; echo esc_url($sh_redux['default-logo']['url']);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="height:<?php if ($sh_redux['opt-select-logo-size'] == 'logo-sm') { ?>44px<?php }; ?><?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { ?>88px<?php }; ?>;">
                                    <?php
                                    if (!empty($sh_redux['retina-logo']['url'])) {
                                        ?>
                                        <img id="retina-logo" src="<?php global $sh_redux; echo esc_url($sh_redux['retina-logo']['url']);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="height:<?php if ($sh_redux['opt-select-logo-size'] == 'logo-sm') { ?>44px<?php }; ?><?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { ?>88px<?php }; ?>;">
                                    <?php }
                                    else {
                                        ?><img id="retina-logo" src="<?php global $sh_redux; echo esc_url($sh_redux['default-logo']['url']);?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" style="height:<?php if ($sh_redux['opt-select-logo-size'] == 'logo-sm') { ?>44px<?php }; ?><?php if ($sh_redux['opt-select-logo-size'] == 'logo-md') { ?>88px<?php }; ?>;">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                        </div>
                        <?php
                        wp_nav_menu( array(
                                'menu'              => 'primary',
                                'theme_location'    => 'primary',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'collapse navbar-collapse',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker())
                        );
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </header>

        <div id="content" class="site-content">