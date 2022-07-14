<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://Amniat-Gostar.com/
 * @since             1.0.0
 * @package           Mj-kh-BSTI-Market Data Entry
 *
 * @wordpress-plugin
 * Plugin Name:       Mj-kh-BSTI-Market Data Entry 
 * Plugin URI:        http://Amniat-Gostar.com//plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Amniat Gostar 
 * Author URI:        http://Amniat-Gostar.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'mj_kh_bsti_admin_dashboard', '1.0.0' );

/* ------------------------------------------------------------------------------------ */
 add_action('admin_menu','mj_kh_bsti_admin_menu_adder');


function mj_kh_bsti_admin_menu_adder(){
	add_menu_page( __('مدیریت اطلاعات','mj_kh_bsti-domain')
	,__('مدیریت اطلاعات' ,'mj_kh_bsti-domain'),
	 'manage_options',
	  plugin_dir_path(__FILE__) . 'view.php',
	   null, 
	   null, 
	   120 );
} 

/* ------------------------------------------------------------------------------------ */

class MjKhBSTISettingsPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            __('Settings Admin','mj_kh_bsti-domain'), 
            __('IS Settings','mj_kh_bsti-domain'), 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'mj_kh_bsti_dashboard_setttings' );
        ?>
        <div class="wrap">
            <h1><?php echo __('Information System Settings','mj_kh_bsti-domain') ?></h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );
                do_settings_sections( 'my-setting-admin' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'mj_kh_bsti_dashboard_setttings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            __('Configuration','mj_kh_bsti-domain'), // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'mj_kh_bsti_dashboard_token', // ID
            __('Api token','mj_kh_bsti-domain'), // Title 
            array( $this, 'token_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'mj_kh_bsti_dashboard_apiBaseUrl', 
            __('Api Origin','mj_kh_bsti-domain'), 
            array( $this, 'api_origin_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['mj_kh_bsti_dashboard_token'] ) )
            $new_input['mj_kh_bsti_dashboard_token'] = absint( $input['mj_kh_bsti_dashboard_token'] );

        if( isset( $input['mj_kh_bsti_dashboard_apiBaseUrl'] ) )
            $new_input['mj_kh_bsti_dashboard_apiBaseUrl'] = sanitize_text_field( $input['mj_kh_bsti_dashboard_apiBaseUrl'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print __('Enter your settings below:','mj_kh_bsti-domain');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function token_callback()
    {
        printf(
            '<input type="text" id="mj_kh_bsti_dashboard_token" name="mj_kh_bsti_dashboard_setttings[mj_kh_bsti_dashboard_token]" value="%s" />',
            isset( $this->options['mj_kh_bsti_dashboard_token'] ) ? esc_attr( $this->options['mj_kh_bsti_dashboard_token']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function api_origin_callback()
    {
        printf(
            '<input type="text" id="mj_kh_bsti_dashboard_apiBaseUrl" name="mj_kh_bsti_dashboard_setttings[mj_kh_bsti_dashboard_apiBaseUrl]" value="%s" />',
            isset( $this->options['mj_kh_bsti_dashboard_apiBaseUrl'] ) ? esc_attr( $this->options['mj_kh_bsti_dashboard_apiBaseUrl']) : ''
        );
    }
}

if( is_admin() )
    $mjKhBSTI_settings_page = new MjKhBSTISettingsPage();

/* ------------------------------------------------------------------------------------ */




/* 
https://codex.wordpress.org/Creating_Options_Pages#settings_fields_Function
https://codex.wordpress.org/Adding_Administration_Menus
 */