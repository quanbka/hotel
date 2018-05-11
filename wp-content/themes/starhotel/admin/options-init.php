<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: https://docs.reduxframework.com
 * */
//Disable DEMO Mode
function removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'removeDemoModeLink');


if (!class_exists('starhotel_Redux_Framework_config')) {

    class starhotel_Redux_Framework_config
    {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
        {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings()
        {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action('redux/loaded', array($this, 'remove_demo'));

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
         *
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field    set with compiler=>true is changed.
         * */
        function compiler_action($options, $css)
        {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**
         *
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         *
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections)
        {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-starhotel'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-starhotel'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         *
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args)
        {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         *
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults)
        {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo()
        {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections()
        {

            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-starhotel'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
                <?php if ($screenshot) : ?>
                    <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                           title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>"
                                 alt="<?php esc_attr_e('Current theme preview', 'starhotel'); ?>"/>
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>"
                         alt="<?php esc_attr_e('Current theme preview', 'starhotel'); ?>"/>
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-starhotel'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-starhotel'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-starhotel') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                    <?php
                    if ($this->theme->parent()) {
                        printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'starhotel') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-starhotel'), $this->theme->parent()->display('Name'));
                    }
                    ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
            /**
             *
             * Section: General
             * */
            $this->sections[] = array(
                'title' => __('General', 'redux-framework-starhotel'),
                'desc' => __('General settings for Starhotel', 'redux-framework-starhotel'),
                'icon' => 'el-icon-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    array(
                        'id' => 'favicon',
                        'type' => 'media',
                        'title' => __('Favicon', 'redux-framework-starhotel'),
                        'compiler' => 'true',
                        'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle' => __('Represents favicon of the website. Size should be 16x16.', 'redux-framework-starhotel'),
                        'default'  => array(
                            'url' => get_template_directory_uri() .'/images/favicon.ico'
                        ),
                    ),
                    array(
                        'id' => 'opt-select-logo-size',
                        'type' => 'select',
                        'title' => __('Logo size', 'redux-framework-starhotel'),
                        'options' => array('logo-sm' => 'Default logo size',
                            'logo-md' => 'Large logo'),
                        'default' => 'logo-sm',
                    ),
                    array(
                        'id' => 'default-logo',
                        'type' => 'media',
                        'title' => __('Default Logo', 'redux-framework-starhotel'),
                        'compiler' => 'true',
                        'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle' => __('Standard logo of the website (recommended height: 44px).', 'redux-framework-starhotel'),
                        'default'  => array(
                            'url' => get_template_directory_uri() .'/images/logo.png'
                        ),
                    ),
                    array(
                        'id' => 'retina-logo',
                        'type' => 'media',
                        'title' => __('Retina Logo(optional)', 'redux-framework-starhotel'),
                        'compiler' => 'true',
                        'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle' => __('The retina version of the logo to support high-resolution displays. It&#39;s usually twice the same size of your default logo.', 'redux-framework-starhotel'),
                        'default'  => array(
                            'url' => get_template_directory_uri() .'/images/logo-retina.png'
                        ),
                    ),
                )
            );
            /**
             *
             * Section: Typography
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-fontsize',
                'title' => __('Typography', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'opt-typography-body',
                        'type' => 'typography',
                        'title' => __('Body font', 'redux-framework-starhotel'),
                        'subtitle' => __('Font for all body text.', 'redux-framework-starhotel'),
                        'output' => array('body', '.ui-widget', '.revolution-starhotel'),
                        'google' => true,
                        'text-align' => false,
                        'color' => false,
                        'default' => array(
                            'font-size' => '13px',
                            'font-family' => 'Open Sans, Arial,Helvetica,sans-serif',
                            'font-weight' => 'Normal',
                            'line-height' => '18px',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-btn',
                        'type' => 'typography',
                        'title' => __('Button font', 'redux-framework-starhotel'),
                        'subtitle' => __('Font for buttons.', 'redux-framework-starhotel'),
                        'output' => array('.btn', '.revolution-starhotel'),
                        'google' => true,
                        'text-align' => false,
                        'color' => false,
                        'line-height' => false,
                        'default' => array(
                            'font-size' => '13px',
                            'font-family' => 'Open Sans',
                            'font-weight' => 'bold',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-nav',
                        'type' => 'typography',
                        'title' => __('Navigation font', 'redux-framework-starhotel'),
                        'subtitle' => __('Font for navigation.', 'redux-framework-starhotel'),
                        'output' => array('.navbar-nav'),
                        'google' => true,
                        'text-align' => false,
                        'color' => false,
                        'line-height' => false,
                        'default' => array(
                            'font-size' => '13px',
                            'font-family' => 'Open Sans',
                            'font-weight' => '600',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers',
                        'type' => 'typography',
                        'title' => __('Title fonts', 'redux-framework-starhotel'),
                        'subtitle' => __('Font for all the headings/titles on the website.', 'redux-framework-starhotel'),
                        'output' => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
                        'google' => true,
                        'text-align' => false,
                        'font-size' => false,
                        'line-height' => false,
                        'color' => false,
                        'default' => array(
                            'font-family' => 'Open Sans, Arial,Helvetica,sans-serif',
                            'font-weight' => 'Normal',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers-h1',
                        'type' => 'typography',
                        'title' => __('H1 font size', 'redux-framework-starhotel'),
                        'output' => array('h1', '.parallax-effect .content h3'),
                        'google' => true,
                        'text-align' => false,
                        'line-height' => false,
                        'color' => false,
                        'font-family' => false,
                        'font-style' => false,
                        'default' => array(
                            'font-size' => '36',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers-h2',
                        'type' => 'typography',
                        'title' => __('H2 font size', 'redux-framework-starhotel'),
                        'output' => array('h2'),
                        'google' => true,
                        'text-align' => false,
                        'line-height' => false,
                        'color' => false,
                        'font-family' => false,
                        'font-style' => false,
                        'default' => array(
                            'font-size' => '24',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers-h3',
                        'type' => 'typography',
                        'title' => __('H3 font size', 'redux-framework-starhotel'),
                        'output' => array('h3'),
                        'google' => true,
                        'text-align' => false,
                        'line-height' => false,
                        'color' => false,
                        'font-family' => false,
                        'font-style' => false,
                        'default' => array(
                            'font-size' => '18',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers-h4',
                        'type' => 'typography',
                        'title' => __('H4 font size', 'redux-framework-starhotel'),
                        'output' => array('h4', '.room-thumb .main h5'),
                        'google' => true,
                        'text-align' => false,
                        'line-height' => false,
                        'color' => false,
                        'font-family' => false,
                        'font-style' => false,
                        'default' => array(
                            'font-size' => '14',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers-h5',
                        'type' => 'typography',
                        'title' => __('H5 font size', 'redux-framework-starhotel'),
                        'output' => array('h5'),
                        'google' => true,
                        'text-align' => false,
                        'line-height' => false,
                        'color' => false,
                        'font-family' => false,
                        'font-style' => false,
                        'default' => array(
                            'font-size' => '12',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-headers-h6',
                        'type' => 'typography',
                        'title' => __('H6 font size', 'redux-framework-starhotel'),
                        'output' => array('h6'),
                        'google' => true,
                        'text-align' => false,
                        'line-height' => false,
                        'color' => false,
                        'font-family' => false,
                        'font-style' => false,
                        'default' => array(
                            'font-size' => '10',
                        ),
                    ),

                )

            );
            /**
             * Section: Color settings
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('Color Settings', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'opt-select-stylesheet',
                        'type' => 'select',
                        'title' => __('Theme Stylesheet', 'redux-framework-starhotel'),
                        'subtitle' => __('Select your themes alternative color scheme.', 'redux-framework-starhotel'),
                        'options' => array('/css/colors/turquoise.css' => 'Turquoise',
                            '/css/colors/black.css' => 'Black',
                            '/css/colors/blue.css' => 'Blue',
                            '/css/colors/brown.css' => 'Brown',
                            '/css/colors/green.css' => 'Green',
                            '/css/colors/orange.css' => 'Orange',
                            '/css/colors/purple.css' => 'Purple',
                            '/css/colors/red.css' => 'Red'),
                        'default' => '/css/colors/turquoise.css',
                    ),
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Custom style', 'redux-framework-starhotel'),
                        'desc' => __('Please take note that you have to set to set the switch in order to get the custom style to work.', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'switch-custom-style',
                        'type' => 'switch',
                        'title' => __('Use own custom colors', 'redux-framework-starhotel'),
                        'subtitle' => __('Theme stylesheets will be disabled!', 'redux-framework-starhotel'),
                        'default' => 0,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'opt-header-color',
                        'type' => 'color',
                        'title' => __('Titles Text Color', 'redux-framework-starhotel'),
                        'default' => '#5e5e5e',
                        'output' => array('h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-typography-body-colors',
                        'type' => 'color',
                        'title' => __('Body Text Color', 'redux-framework-starhotel'),
                        'default' => '#333333',
                        'output' => array('body, aside .widget ul a, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .nav-pills > li > a, .wpb_wrapper .wpb_tabs .ui-state-active a, .wpb_wrapper .wpb_tabs .ui-state-active a:link, .ui-widget-content, .wpb_wrapper .wpb_tour .wpb_tabs_nav li a:hover, .wpb_wrapper .wpb_tour .wpb_tabs_nav li a:active, .wpb_wrapper .wpb_tour .ui-state-active a, .wpb_wrapper .wpb_tour .ui-state-active a:link, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a '),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-typography-subtitles-colors',
                        'type' => 'color',
                        'title' => __('Subtitle Text Color', 'redux-framework-starhotel'),
                        'default' => '#cccccc',
                        'output' => array('color' => 'blockquote span, aside .widget .news-content span a, .room-thumb .main .price span',
                            			  'background' => '.badge'
                        ),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-typography-link',
                        'type' => 'typography',
                        'title' => __('Link Color', 'redux-framework-starhotel'),
                        'output' => array('a, .navbar-default .navbar-brand, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, .navbar-default .navbar-nav .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .dropdown-menu > li > a:focus, .navbar-default .navbar-nav > li.current-menu-ancestor  > a, .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus, .btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default, .wpb_wrapper .ui-state-default a, .ui-widget-content a, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a '),
                        'google' => false,
                        'font-family' => false,
                        'font-weight' => false,
                        'text-align' => false,
                        'font-size' => false,
                        'line-height' => false,
                        'font-style' => false,
                        'all_styles' => false,
                        'default' => array(
                            'color' => '#75c5cf',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-hover',
                        'type' => 'color',
                        'title' => __('Link Hover Color', 'redux-framework-starhotel'),
                        'output' => array('color' => 'a:hover, a:focus, .box-icon a:hover, .usp a:hover i',
                            'background-color' => 'aside .widget .tagcloud a:hover'
                        ),
                        'default' => '#5e5e5e',
                        'transparent' => false
                    ),
                    array(
                        'id' => 'opt-typography-icon-sec',
                        'type' => 'typography',
                        'title' => __('Icon Secondary Color', 'redux-framework-starhotel'),
                        'output' => array('article .meta-author, .meta-category, .meta-comments'),
                        'google' => false,
                        'font-family' => false,
                        'font-weight' => false,
                        'text-align' => false,
                        'font-size' => false,
                        'line-height' => false,
                        'font-style' => false,
                        'all_styles' => false,
                        'default' => array(
                            'color' => '#979797',
                        ),
                    ),
                    array(
                        'id' => 'opt-color-ui-bg1',
                        'type' => 'color',
                        'output' => array('border-color' => 'header, .navbar-nav .dropdown-menu, .blog-author img, .comment .avatar img, aside h3, blockquote, .ui-widget-header, .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight, .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, #owl-gallery, .vc_images_carousel, #owl-reviews img, .parallax-effect, .revolution-slider, .testimonials .owl-theme .owl-controls .owl-buttons div, .standard-slider .owl-theme .owl-controls .owl-buttons div, #go-top, .box-icon .circle, .testimonials .owl-theme .owl-controls .owl-buttons div, .standard-slider .owl-theme .owl-controls .owl-buttons div, #map, .ubermenu-skin-none .ubermenu-submenu, .ubermenu-skin-none .ubermenu-submenu-drop',
                            'background-color' => '#top-header .th-text .th-item .btn-group ul.dropdown-menu > li > a:hover, article .meta-date, .comment .comment-reply-link, aside .widget .tagcloud a, aside .widget ul a:hover .badge, #call-to-action, .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus, .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus, .pagination > li > span.current, #go-top:hover, .testimonials .owl-theme .owl-controls .owl-buttons div:hover, .standard-slider .owl-theme .owl-controls .owl-buttons div:hover, .box-icon .circle:hover, .gallery a i, .gallery-slider a i, .vc_images_carousel a i, .carousel a i, .sticky .meta:first-of-type::after',
                            'color' => '#reservation-form .fa.infield, #reservation-form .form-inline .fa.infield, .room-thumb .content i, .box-icon i, table i, #go-top i, .testimonials .owl-theme .owl-controls .owl-buttons div i, .standard-slider .owl-theme .owl-controls .owl-buttons div i, .testimonials .owl-theme .owl-controls .owl-buttons div, .standard-slider .owl-theme .owl-controls .owl-buttons div, #go-top, #reservation-form .price, label span, .room-thumb .main .price, .room-thumb .content p span, .blog-author span, #owl-reviews .text-balloon span, .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight, .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus, .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, aside .widget ul a:hover, .yamm a:hover'
                        ),
                        'title' => __('Interface Background Color Primary', 'redux-framework-starhotel'),
                        'default' => '#75c5cf',
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-ui-color-rgba',
                        'type' => 'color_rgba',
                        'title' => __('Interface Background Color Secondary', 'redux-framework-starhotel'),
                        'subtitle' => __('The brighter background-color is visible in the table for instance', 'redux-framework-starhotel'),
                        'default' => array('color' => '#5abac6', 'alpha' => '0.03'),
                        'output' => array('.room-thumb .main .price, .comment, .table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th, .panel-default > .panel-heading'),
                        'mode' => 'background',
                        'validate' => 'colorrgba',
                    ),
                    array(
                        'id' => 'opt-separator-color',
                        'type' => 'color',
                        'title' => __('Separator/Border Color', 'redux-framework-starhotel'),
                        'default' => '#efefef',
                        'output' => array('border-color' => '.blog article, aside .widget ul li, .form-control, aside .widget .news-thumb img, .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td, h1.lined-heading:before, h2.lined-heading:before, h3.lined-heading:before, h4.lined-heading:before, h5.lined-heading:before, h6.lined-heading:before, .nav-tabs, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .nav > li > a:hover, .nav > li > a:focus, .room-thumb .main, .room-thumb, .room-thumb .main .price, .room-thumb img, .wpb_wrapper .ui-widget-header, .wpb_wrapper .wpb_tabs .ui-state-active a, .wpb_wrapper .wpb_tabs .ui-state-active a:link, .wpb_tour .ui-state-default a, .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section .wpb_accordion_header a, .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section:first-child .wpb_accordion_header a, .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_section:last-child .wpb_accordion_header a, .wpb_wrapper .wpb_tabs .wpb_tabs_nav li a:hover, .wpb_wrapper .ui-widget-header, .wpcf7 input[type="text"], .wpcf7 input[type="email"], .wpcf7 input[type="number"], .wpcf7 input[type="date"], .wpcf7 select, .wpcf7 textarea, .vc_tta-tabs:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-left .vc_tta-tab.vc_active > a, .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:hover, .vc_tta-tabs:not([class*="vc_tta-gap"]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active > a',
                                          'color' => '.ui-widget-header'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-button-bg-color',
                        'type' => 'color',
                        'title' => __('Button Background Color', 'redux-framework-starhotel'),
                        'default' => '#75c5cf',
                        'output' => array('background-color' => '.btn-primary, .btn-primary.disabled, .btn-primary[disabled]'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-button-border-color',
                        'type' => 'color',
                        'title' => __('Button Border Color', 'redux-framework-starhotel'),
                        'default' => '#35929e',
                        'output' => array('border-color' => '.btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary, .btn-primary.disabled, .btn-primary[disabled]'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-button-hover-color',
                        'type' => 'color',
                        'title' => __('Button Background Hover Color', 'redux-framework-starhotel'),
                        'default' => '#64cedb',
                        'output' => array('background-color' => '.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-ghost-button-bg-color',
                        'type'      => 'color_rgba',
                        'title' => __('Ghost Button Background Color', 'redux-framework-starhotel'),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 1
                        ),
                        'output' => array('background-color' => '.btn-ghost-color'),
                        'validate' => 'colorrgba',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-ghost-button-border-color',
                        'type' => 'color',
                        'title' => __('Ghost Button Border&Text Color', 'redux-framework-starhotel'),
                        'default' => '#75c5cf',
                        'output' => array('border-color' => '.btn-ghost-color',
                                          'color' => '.btn-ghost-color, .btn-ghost-color:hover, .btn-ghost-color:focus, .tp-caption a.btn-ghost-color'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-ghost-button-hover-color',
                        'type'      => 'color_rgba',
                        'title' => __('Ghost Button Background Hover Color', 'redux-framework-starhotel'),
                        'default'   => array(
                            'color'     => '#75c5cf',
                            'alpha'     => 0.03
                        ),
                        'output' => array('background-color' => '.btn-ghost-color:hover'),
                        'validate' => 'colorrgba',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-nav-text-color',
                        'type' => 'color',
                        'title' => __('Navigation Text Color', 'redux-framework-starhotel'),
                        'default' => '#5e5e5e',
                        'output' => array('color' => '.navbar-default .navbar-nav > li > a, .navbar-default .navbar-nav .dropdown-menu > li > a'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-nav-bg-color',
                        'type' => 'color',
                        'title' => __('Navigation Background Color', 'redux-framework-starhotel'),
                        'default' => '#ffffff',
                        'output' => array('background-color' => '.navbar-default, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, .navbar-nav .dropdown-menu > li > a:hover, .navbar-nav .dropdown-menu > li > a:focus, .navbar-nav .dropdown-menu, .ubermenu-skin-none .ubermenu-item .ubermenu-submenu-drop'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-nav-border-color',
                        'type' => 'color',
                        'title' => __('Navigation Border Color', 'redux-framework-starhotel'),
                        'default' => ' #e1e1e1',
                        'output' => array('border-color' => '.navbar-nav .dropdown-menu > li > a, header #logo'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-footer-bg-color',
                        'type' => 'color',
                        'title' => __('Footer Background Color', 'redux-framework-starhotel'),
                        'default' => '#3c3c3c',
                        'output' => array('background-color' => 'footer'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-footer-title-color',
                        'type' => 'color',
                        'title' => __('Footer Title Color', 'redux-framework-starhotel'),
                        'default' => '#898989',
                        'output' => array('color' => 'footer h1, footer h2, footer h3, footer h4, footer h5, footer h6'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-footer-text-color',
                        'type' => 'color',
                        'title' => __('Footer Text/Link Color', 'redux-framework-starhotel'),
                        'default' => '#c1c1c1',
                        'output' => array('color' => 'footer, footer a, footer .form-control'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-footer-border-color',
                        'type' => 'color',
                        'title' => __('Footer Border Color', 'redux-framework-starhotel'),
                        'default' => '#898989',
                        'output' => array('border-color' => 'footer ul li, footer .form-control, footer .widget .news-thumb img'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-footer-bottom-bg-color',
                        'type' => 'color',
                        'title' => __('Footer Bottom Background Color', 'redux-framework-starhotel'),
                        'default' => '#272727',
                        'output' => array('background-color' => 'footer .footer-bottom'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Topheader and Parallax', 'redux-framework-starhotel'),
                        'desc' => __('Custom colors below only work when enabled in header settings', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'opt-top-header-background-color',
                        'type' => 'color',
                        'title' => __('Top Header Background Color', 'redux-framework-starhotel'),
                        'default' => '#272727',
                        'output' => array('background-color' => '#top-header, #top-header a, #lang_sel a.lang_sel_sel, #lang_sel ul ul a, #lang_sel ul ul a:visited'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-top-header-text-color',
                        'type' => 'color',
                        'title' => __('Top Header Text Color', 'redux-framework-starhotel'),
                        'default' => '#939393',
                        'output' => array('color' => '#top-header .th-text .th-item .btn-group ul.dropdown-menu > li > a, #lang_sel a.lang_sel_sel, #lang_sel ul ul a, #lang_sel ul ul a:visited'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-top-header-link-color',
                        'type' => 'color',
                        'title' => __('Top Header Link Color', 'redux-framework-starhotel'),
                        'default' => '#ffffff',
                        'output' => array('color' => '#top-header a:hover, #top-header .th-text .th-item .btn-group .btn-default:hover, #top-header a, #top-header .th-text .th-item .btn-group ul.dropdown-menu > li > a, #top-header .th-text .th-item .btn-group .btn-default'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-top-header-border-color',
                        'type' => 'color',
                        'title' => __('Top Header Seperator Color', 'redux-framework-starhotel'),
                        'default' => '#3c3c3c',
                        'output' => array('border-color' => '#top-header .th-text .th-item'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'opt-parallax-bg-color-rgba',
                        'type' => 'color_rgba',
                        'title' => __('Parallax Background-color', 'redux-framework-starhotel'),
                        'default' => array('color' => '#75c5cf', 'alpha' => '0.8'),
                        'output' => array('.parallax-effect .color-overlay'),
                        'mode' => 'background',
                        'validate' => 'colorrgba',
                    ),
                    array(
                        'id' => 'opt-parallax-text-color',
                        'type' => 'color',
                        'title' => __('Parallax Text Color', 'redux-framework-starhotel'),
                        'default' => '#FFFFFF',
                        'output' => array('.parallax-effect h1, .parallax-effect h2, .parallax-effect h3, .parallax-effect h4, .parallax-effect h5, .parallax-effect h6, .breadcrumb > li a, .parallax-effect #parallax-pagetitle'),
                        'validate' => 'color',
                        'transparent' => false,
                    ),
                ));

            /**
             * Section: Background settings
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'title' => __('Background', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'switch-custom-boxed-bg',
                        'type' => 'switch',
                        'title' => __('Website Layout: Boxed', 'redux-framework-starhotel'),
                        'subtitle' => __('Layout will be full-width when this switch is disabled', 'redux-framework-starhotel'),
                        'default' => 0,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'opt-background-color',
                        'type' => 'color',
                        'output' => array('background-color' => 'body'),
                        'title' => __('Body Background Color', 'redux-framework-starhotel'),
                        'default' => '#FFFFFF',
                    ),
                    array(
                        'id' => 'opt-background-image',
                        'type' => 'media',
                        'title' => __('Background Image', 'redux-framework-starhotel'),
                        'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                    ),
                )
            );
            /**
             * Section: Header settings
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-lines',
                'title' => __('Header Settings', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'switch-sticky-nav',
                        'type' => 'switch',
                        'title' => __('Sticky header', 'redux-framework-starhotel'),
                        'subtitle' => __('The navigation that floats along when scrolling down the page', 'redux-framework-starhotel'),
                        'default' => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'switch-top-header',
                        'type' => 'switch',
                        'title' => __('Display Top Header', 'redux-framework-starhotel'),
                        'default' => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'switch-top-header-contact',
                        'type' => 'switch',
                        'title' => __('Top Header: Contact Details', 'redux-framework-starhotel'),
                        'subtitle' => __('Important: In order to see the top email/phone number in the top header you must enable the contact details first', 'redux-framework-starhotel'),
                        'default' => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'top-header-contact-phone',
                        'type' => 'text',
                        'title' => __('Top Header: Phone', 'redux-framework-starhotel'),
                        'default' => '0123456789',
                    ),
                    array(
                        'id' => 'top-header-contact-mail',
                        'type' => 'text',
                        'title' => __('Top Header: E-mail', 'redux-framework-starhotel'),
                        'default' => 'YOUR@EMAIL.COM',
                    ),
                   array(
                        'id' => 'switch-top-header-wpml',
                        'type' => 'switch',
                        'title' => __('Top Header: WPML Language switch', 'redux-framework-starhotel'),
                        'subtitle' => __('You need a license of the WPML plug-in to get this feature to work', 'redux-framework-starhotel'),
                        'default' => 0,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'switch-top-header-social',
                        'type' => 'switch',
                        'title' => __('Top Header: Social Media', 'redux-framework-starhotel'),
                        'subtitle' => __('Show Social media icons, you can edit these links in the tab: Social share links', 'redux-framework-starhotel'),
                        'default' => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                        'id' => 'switch-header-parallax',
                        'type' => 'switch',
                        'title' => __('Header: Parallax', 'redux-framework-starhotel'),
                        'subtitle' => __('Important : In order to see the parallax image, breadcrumb or page title you need to enable the sub header first', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'header-parallax-img',
                        'type' => 'media',
                        'title' => __('Header: Parallax image', 'redux-framework-starhotel'),
                        'compiler' => 'true',
                        'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('Recommended size: w:1900px x h:911px', 'redux-framework-starhotel'),
                    ),
                   array(
                        'id' => 'switch-header-breadcrumbs',
                        'type' => 'switch',
                        'title' => __('Breadcrumbs', 'redux-framework-starhotel'),
                        'default' => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),
                    array(
                    'id' => 'switch-uber-menu',
                    'type' => 'switch',
                    'title' => __('Uber Mega Menu', 'redux-framework-starhotel'),
                    'subtitle' => __('Please take note that this is a popular plug-in you can purchase at codecanyon.', 'redux-framework-starhotel'),
                    'default' => 0,
                    'on' => 'Enabled',
                    'off' => 'Disabled',
                ),
                )
            );

            /**
             * Section: Footer Settings
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-th',
                'title' => __('Footer Settings', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Footer widgets', 'redux-framework-starhotel'),
                        'desc' => __('You can manage footer widgets in Appearance > Widgets ', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'opt-select-footer-columns',
                        'type' => 'select',
                        'title' => __('Amount of footer columns', 'redux-framework-starhotel'),
                        'options' => array(
                            'none' => 'None',
                            '3' => '3',
                            '4' => '4'),
                        'default' => '4',
                    ),

                    array(
                        'id' => 'bottom-footer-right',
                        'type' => 'textarea',
                        'title' => __('Footer bottom right HTML code', 'redux-framework-starhotel'),
                        'subtitle' => __('Optional', 'redux-framework-starhotel'),
					    'validate' => 'html_custom',
                        'default' => '<ul><li><a href="#">Rooms</a></li></ul>',
						'allowed_html' => array(
							'a' => array(
								'href' => array(),
								'title' => array(),
                                'target' => array(),
							),
							'ul' => array(
								'li' => array()
							),
							'li' => array(
								'li' => array()
							),
						),
					),
                    array(
                        'id' => 'switch-bottom-footer-right',
                        'type' => 'switch',
                        'title' => __('Pick up footer bottom right from PO file', 'redux-framework-starhotel'),
                        'subtitle' => __('This way you can make the bottom footer right multilingual', 'redux-framework-starhotel'),
                        'default' => false,
                    ),
                    array(
                        'id' => 'switch-scroll-to-top',
                        'type' => 'switch',
                        'title' => __('Scroll to top button', 'redux-framework-starhotel'),
                        'subtitle' => __('The button that appears in the right bottom corner when the user has reached at the bottom of the page.', 'redux-framework-starhotel'),
                        'default' => 1,
                        'on' => 'Enabled',
                        'off' => 'Disabled',
                    ),

                )
            );
            /**
             * Section: Reservation Form
             **/
            $this->sections[] = array(
                'icon' => 'el-icon-briefcase',
                'title' => __('Reservation Form', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'switch-reservation-form',
                        'type' => 'switch',
                        'title' => __('Show Reservation Form', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Reservation Form', 'redux-framework-starhotel'),
                        'desc' => __('Important : In order to see the reservation form you need to enable the it first', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'reservation-recipient-mail',
                        'type' => 'text',
                        'default' => 'Your-email@address.com',
                        'title' => __('E-mail address', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'switch-phone-form',
                        'type' => 'switch',
                        'title' => __('Add Phone number to reservation form', 'redux-framework-starhotel'),
                        'default' => false,
                    ),
                    array(
                        'id' => 'switch-no-preference-form',
                        'type' => 'switch',
                        'title' => __('Add Room Type: No preference', 'redux-framework-starhotel'),
                        'subtitle' => __('When your customer has an open intend', 'redux-framework-starhotel'),
                        'default' => false,
                    ),
                    array(
                        'id'       => 'opt-select-room-format',
                        'type'     => 'select',
                        'title'    => __('What would you like to display in the rooms dropdown?', 'redux-framework-starhotel'),
                        'options'  => array(
                            'rooms' => 'Rooms',
                            'roomtypes' => 'Roomtypes',
                        ),
                        'default'  => 'rooms',
                    ),
                    array(
                        'id' => 'opt-select-datepicker-format',
                        'type' => 'select',
                        'title' => __('Datepicker format', 'redux-framework-starhotel'),
                        'subtitle' => __('Display date feedback in a variety of ways.', 'redux-framework-starhotel'),
                        'options' => array('mm/dd/yy' => 'Default - mm/dd/yy',
                            'yy-mm-dd' => 'ISO 8601 - yy-mm-dd',
                            'd M, y' => 'Short - d M, y',
                            'd MM, y' => 'Medium - d MM, y',
                            'DD, d MM, yy' => 'Full - DD, d MM, yy'),
                        'default' => 'mm/dd/yy',

                    ),
                    array(
                        'id' => 'opt-select-max-adults',
                        'type' => 'select',
                        'title' => __('Maximum adults allowed', 'redux-framework-starhotel'),
                        'options' => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10'),
                        'default' => '3',
                    ),
                    array(
                        'id' => 'opt-select-max-children',
                        'type' => 'select',
                        'title' => __('Maximum children allowed', 'redux-framework-starhotel'),
                        'options' => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                            '7' => '7',
                            '8' => '8',
                            '9' => '9',
                            '10' => '10'),
                        'default' => '3',
                    ),
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Popover hints', 'redux-framework-starhotel'),
                        'desc' => __('Hints will only show up and can be edited with the .PO file', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'reservation-hint-mail',
                        'type' => 'switch',
                        'title' => __('Email hint', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'reservation-hint-phone',
                        'type' => 'switch',
                        'title' => __('Phone number hint (optional)', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'reservation-hint-room',
                        'type' => 'switch',
                        'title' => __('Roomtype hint', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'reservation-hint-checkin',
                        'type' => 'switch',
                        'title' => __('Check-in hint', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'reservation-hint-checkout',
                        'type' => 'switch',
                        'title' => __('Check-out hint', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'reservation-hint-guests-adults',
                        'type' => 'switch',
                        'title' => __('Guests: Adults hint', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'reservation-hint-guests-children',
                        'type' => 'switch',
                        'title' => __('Guests: Children hint', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Mail sending  methods', 'redux-framework-starhotel'),
                        'desc' => __('Most servers support PHP Mail as a sending method for the reservation form.<br> Some dont have the right module installed for it, but do support SMTP instead.<br> Please use SMTP when the PHP sendmail function isnt working on your server and ask your server host for the right data if you dont know it.', 'redux-framework-starhotel')
                    ),
                    array(
                        'id'       => 'opt-switch-method',
                        'type'     => 'select',
                        'title'    => __('Mail sending method', 'redux-framework-starhotel'),
                        'default'  => true,
                        'options' => array('wpmail' => 'WP Mail',
                                    'phpmail' => 'PHP Mail',
                                    'smtpmail' => 'SMTP Mail'),
                        'default' => 'wpmail',
                    ),
                    array(
                        'id' => 'reservation-smtp-address',
                        'type' => 'text',
                        'default' => '',
                        'title' => __('SMTP server address', 'redux-framework-starhotel'),
                        'subtitle' =>  __('Only required for SMTP sending method', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'reservation-smtp-username',
                        'type' => 'text',
                        'default' => '',
                        'title' => __('SMTP username', 'redux-framework-starhotel'),
                        'subtitle' =>  __('Only required for SMTP sending method', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'reservation-smtp-password',
                        'type' => 'password',
                        'default' => '',
                        'title' => __('SMTP password', 'redux-framework-starhotel'),
                        'subtitle' =>  __('Only required for SMTP sending method', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'reservation-smtp-port',
                        'type' => 'text',
                        'default' => '',
                        'title' => __('SMTP port', 'redux-framework-starhotel'),
                        'subtitle' =>  __('Only required for SMTP sending method', 'redux-framework-starhotel'),
                    ),
                )
            );

            /**
             * Section: Rooms
             **/
            $this->sections[] = array(
                'icon' => 'el-icon-star',
                'title' => __('Rooms', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'switch-room-slider',
                        'type' => 'switch',
                        'title' => __('Show room image slider', 'redux-framework-starhotel'),
                        'default' => true,
                    ),
                    array(
                        'id' => 'opt-select-room-order',
                        'type' => 'select',
                        'title' => __('Room order', 'redux-framework-starhotel'),
                        'options' => array('rand' => 'Random order',
                                    'title' => 'Alphabetic order',
                                    'date' => 'Date added',
                                    'modified' => 'Date modified'),
                        'default' => 'modified',
                    ),

                )
            );

            /**
             * Section: Blog
             **/
            $this->sections[] = array(
                'icon' => 'el-icon-file-edit',
                'title' => __('Blog', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id'       => 'blog-archive-layout',
                        'type'     => 'select',
                        'title'    => __('Blog archive layout', 'redux-framework-starhotel'),
                        'options'  => array(
                            'right' => 'Right sidebar',
                            'left' => 'Left sidebar',
                            'none' => 'No sidebar'
                        ),
                        'default'  => 'right',
                    ),
                    array(
                        'id'       => 'blog-single-layout',
                        'type'     => 'select',
                        'title'    => __('Blog single post layout', 'redux-framework-starhotel'),
                        'options'  => array(
                            'right' => 'Right sidebar',
                            'left' => 'Left sidebar',
                            'none' => 'No sidebar'
                        ),
                        'default'  => 'right',
                    ),
                    array(
                        'id' => 'switch-blog-about-author',
                        'type' => 'switch',
                        'title' => __('Show: About the author', 'redux-framework-starhotel'),
                        'default' => false,
                    ),
                )
            );
            /**
             * Section: Google Maps
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-map-marker',
                'title' => __('Google Maps Settings', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Google Maps', 'redux-framework-starhotel'),
                        'desc' => __('Please take note that you need a Google Api key to get Google Maps to work from now on. Please go to https://developers.google.com/maps/documentation/javascript/get-api-key and get a API key', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'gmaps-api-key',
                        'type' => 'text',
                        'title' => __('Google Maps Api key', 'redux-framework-starhotel'),
                        'desc' => __('Enter your API key here ', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'gmaps-address',
                        'type' => 'text',
                        'default' => 'Calle Hamburgo, Las Palmas, Spanje',
                        'title' => __('Hotel address', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'gmaps-icon',
                        'type' => 'media',
                        'title' => __('Location Pointer/Icon', 'redux-framework-starhotel'),
                        'compiler' => 'true',
                        'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'subtitle' => __('Represents the pointer of the location.', 'redux-framework-starhotel'),
						'default'  => array(
                            'url' => get_template_directory_uri() .'/images/ui/gmap-icon.png',
							'width' => 42,
							'height' => 53
                        ),
                    ),
                    array(
                        'id' => 'gmaps-popover',
                        'type' => 'ace_editor',
                        'title' => __('Popover message', 'redux-framework-starhotel'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'default' => "<h4>Our hotel</h4><p>This is our hotel</p>\n"
                    ),
                    array(
                        'id' => 'gmaps-mapzoom',
                        'type' => 'text',
                        'default' => '12',
                        'title' => __('Map zoom', 'redux-framework-starhotel'),
                    ),
					array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Latitude and longitude', 'redux-framework-starhotel'),
                        'desc' => __('Please use the Google Maps latitude and longitude if filling in the address only is not working correctly', 'redux-framework-starhotel')
                    ),
					array(
                        'id' => 'gmaps-latitude',
                        'type' => 'text',
                        'title' => __('Latitude', 'redux-framework-starhotel'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'gmaps-longitude',
                        'type' => 'text',
                        'title' => __('Longitude', 'redux-framework-starhotel'),
                        'default' => ''
                     ),
                    array(
                        'id' => 'gmaps-height',
                        'type' => 'dimensions',
                        'units' => 'px',
                        'width' => false,
                        'title' => __('Google Maps height', 'redux-framework-starhotel'),
                        'output' => array('height' => '#map'),
                        'default'  => array(
                            'Height'  => '300'
                        ),
                    ),

                )
            );

            /**
             * Section: Social Link
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-share-alt',
                'title' => __('Social Links', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'opt-notice-critical',
                        'type' => 'info',
                        'notice' => true,
                        'style' => 'info',
                        'title' => __('Social Media', 'redux-framework-starhotel'),
                        'desc' => __('Please take note that you top header Social Media icons must be enabled in the Header Settings', 'redux-framework-starhotel')
                    ),
                    array(
                        'id' => 'top-header-social-facebook',
                        'type' => 'text',
                        'title' => __('Facebook', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-twitter',
                        'type' => 'text',
                        'title' => __('Twitter', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-gplus',
                        'type' => 'text',
                        'title' => __('Google+', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-youtube',
                        'type' => 'text',
                        'title' => __('YouTube', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-vimeo',
                        'type' => 'text',
                        'title' => __('Vimeo', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-flickr',
                        'type' => 'text',
                        'title' => __('Flickr', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-skype',
                        'type' => 'text',
                        'title' => __('Skype', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-linkedin',
                        'type' => 'text',
                        'title' => __('Linkedin', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-tumblr',
                        'type' => 'text',
                        'title' => __('Tumblr', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-instagram',
                        'type' => 'text',
                        'title' => __('Instagram', 'redux-framework-starhotel'),
                    ),
                    array(
                        'id' => 'top-header-social-rss',
                        'type' => 'text',
                        'title' => __('RSS', 'redux-framework-starhotel'),
                    ),
                )
            );

            /**
             * Section: Custom Code
             * */
            $this->sections[] = array(
                'icon' => 'el-icon-laptop',
                'title' => __('Custom Code', 'redux-framework-starhotel'),
                'fields' => array(
                    array(
                        'id' => 'opt-ace-editor-css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS Code', 'redux-framework-starhotel'),
                        'subtitle' => __('Paste your CSS code here.', 'redux-framework-starhotel'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                    ),
                    array(
                        'id' => 'opt-ace-editor-js',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS Code', 'redux-framework-starhotel'),
                        'subtitle' => __('Paste your JS code here.', 'redux-framework-starhotel'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                    ),
                )
            );

            /**
             * Section: Import/Export
             * */
            $this->sections[] = array(
                'title' => __('Import / Export', 'redux-framework-starhotel'),
                'desc' => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-starhotel'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );
            $this->sections[] = array(
                'type' => 'divide',
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon' => 'el-icon-book',
                    'title' => __('Documentation', 'redux-framework-starhotel'),
                    'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }
        public function setHelpTabs()
        {
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-1',
                'title' => __('Theme Information 1', 'redux-framework-starhotel'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-starhotel')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-2',
                'title' => __('Theme Information 2', 'redux-framework-starhotel'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-starhotel')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-starhotel');
        }
        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'sh_redux',
                'page_slug' => 'sh_options',
                'page_title' => 'Starhotel Theme Options',
                'dev_mode' => '0',
                'update_notice' => '1',
                'admin_bar' => '1',
                'menu_type' => 'menu',
                'menu_title' => 'Theme Options',
                'allow_sub_menu' => '1',
                'page_parent_post_type' => 'your_post_type',
                'customizer' => '1',
                'hints' =>
                    array(
                        'icon' => 'el-icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color' => '#75c5cf',
                        'icon_size' => 'normal',
                        'tip_style' =>
                            array(
                                'color' => 'light',
                            ),
                        'tip_position' =>
                            array(
                                'my' => 'top left',
                                'at' => 'bottom right',
                            ),
                        'tip_effect' =>
                            array(
                                'show' =>
                                    array(
                                        'duration' => '500',
                                        'event' => 'mouseover',
                                    ),
                                'hide' =>
                                    array(
                                        'duration' => '500',
                                        'event' => 'mouseleave unfocus',
                                    ),
                            ),
                    ),
                'output' => '1',
                'output_tag' => '1',
                'compiler' => '1',
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => '1',
                'show_import_export' => '1',
                'transient_time' => '3600',
                'network_sites' => '1',
            );
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");
        }
    }

    global $reduxConfig;
    $reduxConfig = new starhotel_Redux_Framework_config();
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('starhotel_my_custom_field')):
    function starhotel_my_custom_field($field, $value)
    {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('starhotel_validate_callback_function')):
    function starhotel_validate_callback_function($field, $value, $existing_value)
    {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
