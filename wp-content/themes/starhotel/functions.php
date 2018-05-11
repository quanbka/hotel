<?php
/**
 * Starhotel functions and definitions
 * @package Starhotel
 */
?>
<?php
/**
 * Load Javascripts and Styles
 */
function sh_scripts_styles() {
    // Javascripts
    wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),'3.0.0', true );
    wp_enqueue_script('dropdownhover_js', get_template_directory_uri() . '/js/bootstrap-hover-dropdown.min.js', array('jquery'), '', true);
    wp_enqueue_script('owlcarousel_js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('parallax_js', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', array('jquery'), '', true);
    wp_enqueue_script('niceScroll', get_template_directory_uri() . '/js/jquery.nicescroll.js', array('jquery'), '', true);
    wp_enqueue_script('magnific_popup_js', get_template_directory_uri() . '/js/jquery.magnific_popup.js', array('jquery'), '', true);
    wp_enqueue_script('jqueryui_js', get_template_directory_uri() . '/js/jquery-ui-1.10.4.custom.min.js', array('jquery'), '', true);
    wp_enqueue_script('sticky_js', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '', true);
    wp_enqueue_script('forms_js', get_template_directory_uri() . '/js/jquery.forms.js', array('jquery'), '', true);
    wp_enqueue_script('waypoints_js', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '', true);
    wp_enqueue_script('isotope_js', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '', true);
    wp_register_script('custom_js',get_template_directory_uri() . '/js/custom.js', '', '', true);
    wp_enqueue_script( 'starhotel-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    // Localize scripts for Javascripts

    $sh_gmaps = array(
        'mapaddress'         => ($GLOBALS['sh_redux']['gmaps-address']),
        'maplatitude'        => ($GLOBALS['sh_redux']['gmaps-latitude']),
        'maplongitude'       => ($GLOBALS['sh_redux']['gmaps-longitude']),
        'mapicon'            => ($GLOBALS['sh_redux']['gmaps-icon']['url']),
        'mappopover'         => ($GLOBALS['sh_redux']['gmaps-popover']),
        'mapiconwidth'       => ($GLOBALS['sh_redux']['gmaps-icon']['width']),
        'mapiconheight'      => ($GLOBALS['sh_redux']['gmaps-icon']['height']),
        'mapzoom'            => ($GLOBALS['sh_redux']['gmaps-mapzoom'])
    );
    $sh_reservationform = array(
        'datepickerformat' => ($GLOBALS['sh_redux']['opt-select-datepicker-format']),
    );
    $sh_reservationform_translations = array(
        'translations_months' => array(__('January' , 'starhotel' ), __("February", 'starhotel'), __("March", 'starhotel'), __("April", 'starhotel'), __("May", 'starhotel'), __("June", 'starhotel'), __("July", 'starhotel'), __("August", 'starhotel'), __("September", 'starhotel'), __("October", 'starhotel'), __("November", 'starhotel'), __("December", 'starhotel')),
        'translations_days' => array(__("Su", 'starhotel'), __("Mo", 'starhotel'), __("Tu", 'starhotel'), __("We", 'starhotel'), __("Th", 'starhotel'), __("Fr", 'starhotel'), __("Sa", 'starhotel'))
    );

    wp_localize_script( 'custom_js', 'object_sh_gmaps', $sh_gmaps );
    wp_localize_script( 'custom_js', 'object_sh_date', $sh_reservationform );
    wp_localize_script( 'custom_js', 'object_sh_translations', $sh_reservationform_translations );
    wp_enqueue_script('custom_js');

    // Stylesheets
    wp_enqueue_style('animate_css', get_template_directory_uri() . '/css/animate.css' );
    wp_enqueue_style('bootstrapwp_css', get_template_directory_uri() . '/css/bootstrap.css', false ,'3.0.0');
    wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('owlcarousel_css', get_template_directory_uri() . '/css/owl.carousel.css');
    wp_enqueue_style('owl-theme_css', get_template_directory_uri() . '/css/owl.theme.css');
    wp_enqueue_style('magnific_popup_css', get_template_directory_uri() . '/css/magnific_popup.css');
    wp_enqueue_style('jqueryui_css', get_template_directory_uri() . '/css/smoothness/jquery-ui-1.10.4.custom.min.css');
    wp_enqueue_style('theme_css', get_template_directory_uri() . '/css/theme.css');
    wp_enqueue_style('responsive_css', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('style_css', get_stylesheet_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'sh_scripts_styles');

/**
 * Includes
 */
// Bootstrap NavWalker
require_once('wp_bootstrap_navwalker.php');

//Register menu
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'starhotel' ),
) );

// Get Shortcodes
get_template_part('shortcodes');

// Get custom post types
get_template_part('custom-post-types');

// Include the TGM_Plugin_Activation class.
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // Plugins pre-packaged with Starhotel.
        array(
            'name'               => 'Starhotel', // The plugin name.
            'slug'               => 'starhotel-must-install', // The plugin slug (typically the folder name).
            'source'            =>  get_template_directory_uri() . '/plugins/starhotel-must-install.zip', // The plugin source
            'version'            => '2.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),

        array(
            'name'               => __('Meta Box', 'starhotel'), // The plugin name.
            'slug'               => 'meta-box', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'          => 'WPBakery Visual Composer', // The plugin name
            'slug'          => 'starhotel', // The plugin slug (typically the folder name)
            'source'            => get_template_directory_uri() . '/plugins/js_composer.zip', // The plugin source
            'version'		=> '5.4.5',
            'required'          => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'          => 'Revolution Slider', // The plugin name
            'slug'          => 'revslider', // The plugin slug (typically the folder name)
            'source'            => get_template_directory_uri() . '/plugins/revslider.zip', // The plugin source
            'version'           => '5.4.7.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'required'          => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'          => 'Contact Form 7', // The plugin name
            'slug'          => 'contact-form-7', // The plugin slug (typically the folder name)
            'required'          => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'starhotel' ),
            'menu_title'                      => __( 'Install Plugins', 'starhotel' ),
            'installing'                      => __( 'Installing Plugin: %s', 'starhotel' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'starhotel' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'starhotel' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'starhotel' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'starhotel' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'starhotel' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'starhotel' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'starhotel' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'starhotel' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}
/**
 * Visual Composer: Mapped Shortcodes
 */
// Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
add_action( 'vc_before_init', 'sh_vcSetAsTheme' );
function sh_vcSetAsTheme() {
    vc_set_as_theme();
}
add_action( 'vc_before_init', 'sh_integrateWithVC' );
function sh_integrateWithVC()
{
    // VC: Reservation Form
    vc_map(array(
            "name" => __("Starhotel Reservation Form", "starhotel"),
            "base" => "reservationform",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_form.png",
            "class" => "",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Orientation", "starhotel"),
                    "param_name" => "orientation",
                    'value' => array("horizontal", "vertical"),
                    "description" => __("Orientation of reservationform on higher resolution. Resevationform settings can be found in Theme Options.", "starhotel"),
                )
            )
        )
    );

    // VC: Button
    vc_map(array(
            "name" => __("Starhotel Button", "starhotel"),
            "base" => "button",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_button.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'vc_link',
                    'heading' => __('URL (Link)', 'starhotel'),
                    'param_name' => 'link',
                    'description' => __('Button link.', 'starhotel')
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Text on the button', 'starhotel'),
                    'holder' => 'button',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => __('Text on the button', 'starhotel'),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __("Button Style", "starhotel"),
                    "param_name" => "style",
                    'value' => array("btn-default", "btn-primary", "btn-purple", "btn-black", "btn-success", "btn-info", "btn-warning", "btn-danger", "btn-ghost", "btn-ghost-color"),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __("Button Size", "starhotel"),
                    "param_name" => "size",
                    'value' => array("btn-lg", "btn", "btn-sm", "btn-xs"),
                )
            )
        )
    );

    // VC: Alert
    vc_map(array(
            "name" => __("Starhotel Alert", "starhotel"),
            "base" => "alert",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_alert.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __('Your alert message', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => __('Your alert message', 'starhotel'),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __("Alert Style", "starhotel"),
                    "param_name" => "style",
                    'value' => array("alert-success", "alert-info", "alert-warning", "alert-danger"),
                ),
            )
        )
    );

    // VC: Call-to-action
/*     vc_map(array(
            "name" => __("Starhotel Call-To-Action", "starhotel"),
            "base" => "calltoaction",
            "icon" => get_template_directory_uri() . "/plugins/images/vc-sh.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'textarea_html',
                    'heading' => __('Your call to action', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => __('Your call to action', 'starhotel'),
                ),
            )
        )
    ); */

    // VC: Lightbox image
    vc_map(array(
            "name" => __("Starhotel Lightbox Image", "starhotel"),
            "base" => "lightbox",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_lightbox.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'attach_image',
                    'heading' => __('Your image', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'image',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Title (optional)', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'title',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Description (optional)', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'description',
                ),
              ),
        )
    );

    // VC: Carousel
    vc_map(array(
            "name" => __("Starhotel Carousel", "starhotel"),
            "base" => "carousel",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_carousel.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'attach_images',
                    'heading' => __('Your image', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'image',
                ),
              ),
        )
    );

    // VC: Parallax
    function vc_remove_shortcodes_from_vc_grid_element( $shortcodes ) {
        unset( $shortcodes['sh_parallax'] );
        return $shortcodes;
    }
    vc_map(array(
            "name" => __("Starhotel Parallax", "starhotel"),
            "base" => "parallax",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_parallax.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'attach_image',
                    'heading' => __('Your image(1900px x 911px', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'image',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'title',
                    'value' => __('Your title', 'starhotel'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Subtitle', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'subtitle',
                    'value' => __('Your subtitle', 'starhotel'),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __('Button text', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'btntext',
                    'value' => __('Your buttontext', 'starhotel'),
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => __('URL (Link)', 'starhotel'),
                    'param_name' => 'link',
                    'description' => __('Button link.', 'starhotel')
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __("Button Style", "starhotel"),
                    "param_name" => "style",
                    'value' => array("btn-default", "btn-primary", "btn-purple", "btn-black", "btn-success", "btn-info", "btn-warning", "btn-danger", "btn-ghost", "btn-ghost-color"),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __("Button Size", "starhotel"),
                    "param_name" => "size",
                    'value' => array("btn-lg", "btn", "btn-sm", "btn-xs"),
                )
            ),
        )
    );

    // VC: Heading
    vc_map( array(
            "name" => __( "Starhotel Heading", "starhotel" ),
            "base" => "heading",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_heading.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Title', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => __( 'Your title', 'starhotel' ),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __( "Heading", "starhotel" ),
                    "param_name" => "size",
                    'value' => array( "h1", "h2", "h3", "h4", "h5", "h6" ),
                )
            ),
        )
    );

    // VC: Lined Heading
    vc_map( array(
            "name" => __( "Starhotel Lined Heading", "starhotel" ),
            "base" => "lined_heading",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_lined-heading.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Title', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => __( 'Your title', 'starhotel' ),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __( "Heading", "starhotel" ),
                    "param_name" => "size",
                    'value' => array( "h1", "h2", "h3", "h4", "h5", "h6" ),
                )
            ),
        )
    );

    // VC: Owl Slider
    vc_map( array(
            "name" => __( "Starhotel Testimonials", "starhotel" ),
            "base" => "testimonials",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_lined-testimonials.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'attach_image',
                    'heading' => __('Testimonial 1: Image(102px x 102px', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_1_image',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 1: Testimonial', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_1_testimonial',
                    'value' => __( 'Testimonial', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 1: Source', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_1_source',
                    'value' => __( 'Source', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 1: Source URL', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_1_source_url',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => __('Testimonial 2: Image(102px x 102px', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_2_image',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 2: Testimonial', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_2_testimonial',
                    'value' => __( 'Testimonial', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 2: Source', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_2_source',
                    'value' => __( 'Source', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 2: Source URL', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_2_source_url',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => __('Testimonial 3: Image(102px x 102px', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_3_image',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 3: Testimonial', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_3_testimonial',
                    'value' => __( 'Testimonial', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 3: Source', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_3_source',
                    'value' => __( 'Source', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 3: Source URL', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_3_source_url',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => __('Testimonial 4: Image(102px x 102px', 'starhotel'),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_4_image',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 4: Testimonial', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_4_testimonial',
                    'value' => __( 'Testimonial', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 4: Source', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_4_source',
                    'value' => __( 'Source', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Testimonial 4: Source URL', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'testimonial_4_source_url',
                ),
            ),
        )
    );

    // VC: Blockquote
    vc_map( array(
            "name" => __( "Starhotel Blockquote", "starhotel" ),
            "base" => "quote",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_blockquote.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Quote', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => __( 'The quote', 'starhotel' ),
                ),
                array(
                    'type' => 'textfield',
                    "heading" => __( "Source", "starhotel" ),
                    "param_name" => "source",
                    'value' => __( "The source" , "starhotel"  ),
                ),
            ),
        )
    );

    // VC: Google Maps
    vc_map( array(
            "name" => __( "Starhotel Google Maps", "starhotel" ),
            "base" => "map",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_maps.png",
            "category" => __("Starhotel", "starhotel"),
        )
    );

    // VC: Rooms
    vc_map( array(
            "name" => __( "Starhotel Rooms", "starhotel" ),
            "base" => "rooms",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_rooms.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'How many rooms would you like to display?', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'room_amount',
                    'value' => array(
                    __('1', 'starhotel') => '1',
                    __('2', 'starhotel') => '2',
                    __('3', 'starhotel') => '3',
                    __('4', 'starhotel') => '4',
                    __('5', 'starhotel') => '5',
                    __('6', 'starhotel') => '6',
                    __('7', 'starhotel') => '7',
                    __('8', 'starhotel') => '8',
                    __('9', 'starhotel') => '9',
                    __('10', 'starhotel') => '10',
                    ),
                ),
                array(
                    'type' => 'dropdown',
                    "heading" => __( "In what order would you like to display the rooms?", "starhotel" ),
                    "param_name" => "room_order",
                    'value' => array(
                    __('Random order', 'starhotel') => 'rand',
                    __('Alphabetic order', 'starhotel') => 'title',
                    __('Date added', 'starhotel') => 'date',
                    __('Date modified', 'starhotel') => 'modified',
                    ),
                ),
            ),
        )
    );

    // VC: Box Icons
    vc_map(array(
        'name' => __('Starhotel Box Icon', 'starhotel'),
        'base' => 'boxicon',
        "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_box-icon.png",
        "category" => __("Starhotel", "starhotel"),
        'description' => __('Icon from icon library', 'starhotel'),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => __('Icon library', 'starhotel'),
                'value' => array(
                    __('Font Awesome', 'starhotel') => 'fontawesome',
                    __('Open Iconic', 'starhotel') => 'openiconic',
                    __('Typicons', 'starhotel') => 'typicons',
                    __('Entypo', 'starhotel') => 'entypo',
                    __('Linecons', 'starhotel') => 'linecons',
                ),
                'admin_label' => true,
                'param_name' => 'type',
                'description' => __('Select icon library.', 'starhotel'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_fontawesome',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'fontawesome',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'openiconic',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'typicons',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'linecons',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
        ),
        'js_view' => 'VcIconElementView_Backend',
    ));

    // VC: USP
    vc_map(array(
        'name' => __('Starhotel USP', 'starhotel'),
        'base' => 'usp',
        "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_usp.png",
        "category" => __("Starhotel", "starhotel"),
        'description' => __('Icon from icon library', 'starhotel'),
            'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => __( 'Icon library', 'starhotel' ),
            'value' => array(
                __( 'Font Awesome', 'starhotel' ) => 'fontawesome',
                __( 'Open Iconic', 'starhotel' ) => 'openiconic',
                __( 'Typicons', 'starhotel' ) => 'typicons',
                __( 'Entypo', 'starhotel' ) => 'entypo',
                __( 'Linecons', 'starhotel' ) => 'linecons',
            ),
            'admin_label' => true,
            'param_name' => 'type',
            'description' => __( 'Select icon library.', 'starhotel' ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => __( 'Icon', 'starhotel' ),
            'param_name' => 'icon_fontawesome',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'iconsPerPage' => 4000,
                // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                'element' => 'type',
                'value' => 'fontawesome',
            ),
            'description' => __( 'Select icon from library.', 'starhotel' ),
        ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_openiconic',
                'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'openiconic',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_typicons',
                'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'typicons',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_entypo',
                'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'starhotel'),
                'param_name' => 'icon_linecons',
                'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'linecons',
                ),
                'description' => __('Select icon from library.', 'starhotel'),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Heading', 'starhotel' ),
                'holder' => 'div',
                'class' => '',
                'param_name' => 'heading',
                'value' => "Heading",
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __( 'Text', 'starhotel' ),
                'holder' => 'div',
                'class' => '',
                'param_name' => 'content',
                'value' => __( 'Text', 'starhotel' ),
            ),
        ),
        'js_view' => 'VcIconElementView_Backend',
    ));

    // VC: Address Card
    vc_map( array(
            "name" => __( "Starhotel Address Card", "starhotel" ),
            "base" => "address",
            "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_address.png",
            "category" => __("Starhotel", "starhotel"),
            "params" => array(
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Title', 'starhotel' ),
                    'holder' => 'div',
                    'class' => '',
                    'param_name' => 'panel_title',
                    'value' => 'Starhotel',
                ),
                array(
                    'type' => 'textarea_html',
                    'heading' => __( 'Address', 'starhotel' ),
                    'holder' => 'content',
                    'class' => '',
                    'param_name' => 'content',
                    'value' => "795 Las Palmas<br>Spain, CA 94107<br><abbr title='Phone'>P:</abbr> <a href='#'>(123) 456-7890</a><br><abbr title='Email'>E:</abbr> <a href='#'>mail@example.com</a><br><abbr title='Website'>W:</abbr> <a href='#'>www.slashdown.nl</a><br>"
                ),
            ),
        )
    );

    // VC: Table
    vc_map( array(
        "name" => __("Starhotel Table", "starhotel"),
        "base" => "table",
        "content_element" => true,
        "show_settings_on_create" => false,
        "icon" => get_template_directory_uri() . "/plugins/images/sh_vc_table.png",
        "category" => __("Starhotel", "starhotel"),
        "params" => array(
            array(
                "type" => "textarea_html",
                "heading" => __("Table", "starhotel"),
                'holder' => 'content',
                "class" => "",
                "param_name" => "content",
                'value' => ("[tr][td]Table cell[/td][/tr]"),
                "description" => __("Use shortcode [tr] for a table row and shortcode [td] for table cell.", "starhotel"),

            )
        ),
    ) );
}

/**
 * Breadcrumbs
 */
function the_breadcrumb()
{
    echo '<ol class="breadcrumb">';
    if (is_home()) {
        echo '<li>';
        echo esc_html__('Home' , 'starhotel' );
        echo "</li>";
    }
    if (!is_home()) {
        echo '<li><a href="';
        echo esc_url(home_url());
        echo '">';
        echo esc_html__('Home' , 'starhotel' );
        echo "</a></li>";
        if (is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo "</li><li class='current'>";
                the_title();
                echo '</li>';
            }
        } elseif (is_category()) {
            echo '<li>';
            echo single_cat_title('', true);
            echo '</li>';
        } elseif (is_page()) {
            echo '<li>';
            echo the_title();
            echo '</li>';
        } elseif (is_tag()) {
            echo '<li>';
            single_tag_title();
            echo '</li>';
        } elseif (is_day()) {
            echo "<li>" . esc_html__('Archive for', 'starhotel' );
            the_time('F jS, Y');
            echo '</li>';
        } elseif (is_month()) {
            echo "<li>" . esc_html__('Archive for', 'starhotel' );
            the_time('F, Y');
            echo '</li>';
        } elseif (is_year()) {
            echo "<li>" . esc_html__('Archive for', 'starhotel' );
            the_time('Y');
            echo '</li>';
        } elseif (is_author()) {
            echo "<li>" . esc_html__('Author archive for', 'starhotel' );
            echo '</li>';
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
            echo "<li>" . esc_html__('Blog archive', 'starhotel' );
            echo '</li>';
        } elseif (is_search()) {
            echo "<li>" . esc_html__('Search results', 'starhotel' );
            echo '</li>';
        }
        echo '</ol>';
    }
}

/**
 * Featured Images
 */

// Post Size
add_theme_support( 'post-thumbnails' );
the_post_thumbnail( array(940,344));  // Other resolutions
add_theme_support('post-thumbnails');

// Gallery Size
update_option('thumbnail_size_w', 263);
update_option('thumbnail_size_h', 165);

// Content_width
if ( ! isset( $content_width ) ) {
    $content_width = 940;
}

/**
 * WP Edits
 * */

// Category: Count badge display
function cat_count_span($links) {
    $links = str_replace('</a> (', '<span class="badge pull-right">', $links);
    $links = str_replace(')', '</span></a> ', $links);
    return $links;
}
add_filter('wp_list_categories', 'cat_count_span');

// Archive: Count badge display
function archive_count_inline($links) {
    $links = str_replace('</a>&nbsp;(', '<span class="badge pull-right">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}
add_filter('get_archives_link', 'archive_count_inline');

// Sidebar Display: Remove inline style tagcloud
function xf_tag_cloud($tag_string){
    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'xf_tag_cloud',10,3);

// Search: Change
function my_search_form($form) {
    $form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
                 <div>
                    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Search..." />
                 </div>
             </form>';
    return $form;
}
add_filter( 'get_search_form', 'my_search_form' );

// Avatar: Add class
function change_avatar_css($class) {
    $class = str_replace("class='avatar", "class='img-circle", $class) ;
    return $class;
}
add_filter('get_avatar','change_avatar_css');

// Content: Password protected fields

function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:", "starhotel" ) . '
    <label for="' . $label . '">' . __( "Password:", "starhotel" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="5" maxlength="20" class="form-control half" /><input type="submit" class="btn btn-default" name="Submit" value="' . esc_attr__( "Submit", "starhotel" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );


// Change Select in widget
function cat_output($class) {
    $class = str_replace('<select', '<select class="form-control"', $class);
    $class = str_replace('</select>', '</select>', $class);
    return $class;
}

add_filter('wp_dropdown_pages', 'cat_output');
add_filter('wp_dropdown_cats', 'cat_output');
add_filter('wp_dropdown_users', 'cat_output');
add_filter('wp_get_archives', 'cat_output');
add_filter('get_archives_link', 'cat_output');

/**
 * Comments
 */
class WPSE_127257_Walker_Comment extends Walker_Comment
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // do nothing.
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        // do nothing.
    }
    function end_el( &$output, $comment, $depth = 0, $args = array() ) {
        // do nothing, and no </li> will be created
    }
    protected function comment( $comment, $depth, $args ) {
        // create the comment output
        // use the code from your old callback here
    }
}
// Custom HTML comments structure
function sh_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'div';
        $add_below = 'div-comment';
    }
    ?>
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment">
    <?php endif; ?>
    <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    <div class="avatar">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 50 ); ?>
    </div>
    <div class="comment-text">
        <div class="author">
            <?php printf( __( '<div class="name">%s</div>', 'starhotel' ), get_comment_author_link() ); ?>
        </div>
        <div class="date">
            <?php
            /* translators: 1: date, 2: time */
            printf( __('%1$s at %2$s' , 'starhotel' ), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( __( '(Edit)' , 'starhotel'  ), '  ', '' );
            ?>
        </div>
        <div class="text">
            <?php comment_text(); ?>
        </div>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' , 'starhotel'  ); ?></em>
        <br />
    <?php endif; ?>
    <?php if ( 'div' != $args['style'] ) : ?>
        </div>
    <?php endif; ?>
<?php
}

/**
 * Custom WP Widgets
 */

// Creating the widget
class sh_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'sh_widget',
            __('Starhotel Widget: Latest News', 'starhotel'),
            array( 'description' => __( 'Latest News', 'starhotel' ), )
        );
    }
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        $recentPosts = new WP_Query();
        $recentPosts->query('showposts=3');
        echo '<ul class="list-unstyled">'
        ?>
        <?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
            <li>
                <article>
                    <div class="news-thumb"> <a href="<?php esc_url(the_permalink()) ?>"><?php the_post_thumbnail( array(75, 75) ); ?></a> </div>
                    <div class="news-content clearfix">
                        <h4><a href="<?php esc_url(the_permalink())  ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                        <span><a href="<?php esc_url(the_permalink()) ?>"><?php the_date(); ?></a></span>
                    </div>
                </article>
            </li>
        <?php endwhile; ?>
        <?php echo '</ul>'?>
        <?php echo $args['after_widget'];
    }
// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'starhotel' );
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'starhotel' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
// Register and load the widget
function sh_load_widget() {
    register_widget( 'sh_widget' );
}
add_action( 'widgets_init', 'sh_load_widget' );

/**
 * Title tag support
 */
add_action( 'after_setup_theme', 'theme_functions' );
function theme_functions() {

    add_theme_support( 'title-tag' );

}
add_filter( 'wp_title', 'custom_titles', 10, 2 );
function custom_titles( $title, $sep ) {
    //Check if custom titles are enabled from your option framework
    return $title;
}

/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

if ( ! function_exists( 'starhotel_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function starhotel_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Starhotel, use a find and replace
         * to change 'starhotel' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'starhotel', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        //add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'starhotel' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
/*        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link'
        ) );*/

        // Setup the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'starhotel_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );
    }
endif; // starhotel_setup
add_action( 'after_setup_theme', 'starhotel_setup' );

/**
 * Register widget area.
 */
function starhotel_widgets_init() {
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'blog-widgets',
        'description'   => 'Sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ) );
    register_sidebar( array(
        'name'          => 'First Footer Widget Area',
        'id'            => 'footer-area-1',
        'description'   => 'Footer area 1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
        'name'          => 'Second Footer Widget Area',
        'id'            => 'footer-area-2',
        'description'   => 'Footer area 2',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
        'name'          => 'Third Footer Widget Area',
        'id'            => 'footer-area-3',
        'description'   => 'Footer area 3',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
        'name'          => 'Fourth Footer Widget Area',
        'id'            => 'footer-area-4',
        'description'   => 'Footer area 4',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ) );
    register_sidebar( array(
        'name'          => 'WPML(top header)',
        'id'            => 'wpml-top-header',
        'description'   => 'WPML position',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
    ) );
}
add_action( 'widgets_init', 'starhotel_widgets_init' );

/** remove redux menu under the tools **/
add_action( 'admin_menu', 'remove_redux_menu',12 );
function remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}



//require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';
session_start();
