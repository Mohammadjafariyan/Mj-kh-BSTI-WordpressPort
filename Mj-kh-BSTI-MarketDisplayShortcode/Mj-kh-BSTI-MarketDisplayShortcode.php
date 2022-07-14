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
 * @package           Mj-kh-BSTI-Market Display Shortcode
 *
 * @wordpress-plugin
 * Plugin Name:       Mj-kh-BSTI-Market Display Shortcode 
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
define( 'mj_kh_bsti_admin_product_short_code', '1.0.0' );

/* ------------------------------------------------------------------------------------ */
/* add_action('admin_menu','mj_kh_bsti_admin_menu_adder');


function mj_kh_bsti_admin_menu_adder(){
	add_menu_page( 'مدیریت اطلاعات'
	,'مدیریت اطلاعات' ,
	 'manage_options',
	  plugin_dir_path(__FILE__) . 'view.php',
	   null, 
	   null, 
	   20 );
} */

/* ------------------------------------------------------------------------------------ */

class MjKhBSTIShopDisplayShortCode
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
        add_shortcode( 'mjproduct', array( $this, 'html' ) );
        
    }
    public function init() {

    }
    /**
     * Add options page
     */
    public function html( $atts = array(), $content = null, $tag = '') {
            // normalize attribute keys, lowercase
            $post = get_post();


    $o = '<div class="wporg-box">';
 
    // title
  //  $o .= '<h2>' . esc_html__( $id, 'mjproduct' ) . '</h2>';
    $o .= '<h2>' . get_post_meta($post->ID, 'mj_kh_bsti_product_dropdown', true) . ' </h2>';


    /* $request = new WP_REST_Request('GET', sprintf('/wp/v2/posts/%d/terms/tag', $this->post_id));
    $request->set_param('orderby', 'term_order');
    $response = $this->server->dispatch($request);
    $data = $response->get_data(); */


 
    // enclosing tags
    if ( ! is_null( $content ) ) {
        // $content here holds everything in between the opening and the closing tags of your shortcode. eg.g [my-shortcode]content[/my-shortcode].
        // Depending on what your shortcode supports, you will parse and append the content to your output in different ways.
        // In this example, we just secure output by executing the_content filter hook on $content.
        $o .= apply_filters( 'the_content', $content );
    }
 
    // end box
    $o .= '</div>';
 
     return $o;
    }

}

//if( is_admin() )
    $mjKhBSTIShopDisplayShortCode = new MjKhBSTIShopDisplayShortCode();

/* ------------------------------------------------------------------------------------ */




/* 
https://codex.wordpress.org/Creating_Options_Pages#settings_fields_Function
https://codex.wordpress.org/Adding_Administration_Menus
 */