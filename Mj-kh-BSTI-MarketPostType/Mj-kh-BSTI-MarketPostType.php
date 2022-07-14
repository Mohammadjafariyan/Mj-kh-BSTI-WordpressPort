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
 * @package           Mj-kh-BSTI-Market Product Post Type
 *
 * @wordpress-plugin
 * Plugin Name:       Mj-kh-BSTI-Market Product Post Type 
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
define( 'mj_kh_bsti_product', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_mj_kh_bsti_product() {
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_mj_kh_bsti_product() {

}


register_activation_hook( __FILE__, 'activate_mj_kh_bsti_product' );
register_deactivation_hook( __FILE__, 'deactivate_mj_kh_bsti_product' );




add_action('init', 'mj_kh_bsti_product');
function mj_kh_bsti_product() {
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Products', 'mj_kh_bsti-domain'),
            'singular_name' => __('Product', 'mj_kh_bsti-domain'),
            'add_new' => __('Add New', 'mj_kh_bsti-domain'),
            'add_new_item' => __('Add New Product', 'mj_kh_bsti-domain'),
            'edit_item' => __('Edit Product', 'mj_kh_bsti-domain'),
            'new_item' => __('New Product', 'mj_kh_bsti-domain'),
            'view_item' => __('View Product', 'mj_kh_bsti-domain'),
            'view_items' => __('View Products', 'mj_kh_bsti-domain'),
            'search_items' => __('Search Products', 'mj_kh_bsti-domain'),
            'not_found' => __('No Products found.', 'mj_kh_bsti-domain'),
            'not_found_in_trash' => __('No Products found in trash.', 'mj_kh_bsti-domain'),
            'all_items' => __('All Products', 'mj_kh_bsti-domain'),
            'archives' => __('Product Archives', 'mj_kh_bsti-domain'),
            'insert_into_item' => __('Insert into Product', 'mj_kh_bsti-domain'),
            'uploaded_to_this_item' => __('Uploaded to this Product', 'mj_kh_bsti-domain'),
            'filter_items_list' => __('Filter Products list', 'mj_kh_bsti-domain'),
            'items_list_navigation' => __('Products list navigation', 'mj_kh_bsti-domain'),
            'items_list' => __('Products list', 'mj_kh_bsti-domain'),
            'item_published' => __('Product published.', 'mj_kh_bsti-domain'),
            'item_published_privately' => __('Product published privately.', 'mj_kh_bsti-domain'),
            'item_reverted_to_draft' => __('Product reverted to draft.', 'mj_kh_bsti-domain'),
            'item_scheduled' => __('Product scheduled.', 'mj_kh_bsti-domain'),
            'item_updated' => __('Product updated.', 'mj_kh_bsti-domain')
        ),
        'has_archive'   => true,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
		// This is where we add taxonomies to our CPT
        'taxonomies'          => array( 'category','post_tag' ),
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'custom-fields',
         'comments',  'trackbacks', 'author', 'excerpt', 'page-attributes', 'custom-fields','post-formats'),
        'can_export' => true
    ));
}

// action to add meta boxes
add_action( 'add_meta_boxes', 'mj_kh_bsti_product_dropdown_metabox' );
// action on saving post
add_action( 'save_post', 'mj_kh_bsti_product_dropdown_save' );

// function that creates the new metabox that will show on post
function mj_kh_bsti_product_dropdown_metabox() {
   /*  add_meta_box( 
        'mj_kh_bsti_product_dropdown',  // unique id
        __( 'Voodoo Dropdown', 'mj_kh_bsti_product_dropdown' ),  // metabox title
        'mj_kh_bsti_product_dropdown_display',  // callback to show the dropdown
        'post'   // post type
    ); */

    
	add_meta_box(
        "mj_kh_bsti_product_dropdown", // div id containing rendered fields
        "Bind Product", // section heading displayed as text
        "mj_kh_bsti_product_dropdown_display", // callback function to render fields
        "product",
        'side','high'
    );



    


}


// voodoo dropdown display
function mj_kh_bsti_product_dropdown_display( $post ) {

  // Use nonce for verification
  //wp_nonce_field( basename( __FILE__ ), 'mj_kh_bsti_product_dropdown_nonce' );

  // get current value
  $dropdown_value = get_post_meta( get_the_ID(), 'mj_kh_bsti_product_dropdown', true );


  require_once( plugin_dir_path( __FILE__ ) . 'drop-down.php');
  /*  ?>
    <select name="mj_kh_bsti_product_dropdown" id="mj_kh_bsti_product_dropdown">
        <option value="USA" <?php if($dropdown_value == 'USA') echo 'selected'; ?>>USA</option>
        <option value="Canada" <?php if($dropdown_value == 'Canada') echo 'selected'; ?>>Canada</option>
        <option value="Mexico" <?php if($dropdown_value == 'Mexico') echo 'selected'; ?>>MEXICO</option>
    </select>




  <?php  */
}

// dropdown saving
function mj_kh_bsti_product_dropdown_save( $post_id ) {

    // if doing autosave don't do nothing
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify nonce
/*   if ( !wp_verify_nonce( $_POST['mj_kh_bsti_product_dropdown_nonce'], basename( __FILE__ ) ) )
      return; */


  // Check permissions

  if(!isset($_POST['mj_kh_bsti_product_dropdown'])){
	return;

  }

  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // save the new value of the dropdown
  if(isset($_POST['mj_kh_bsti_product_dropdown'])){
	$new_value = $_POST['mj_kh_bsti_product_dropdown'];
	update_post_meta( $post_id, 'mj_kh_bsti_product_dropdown', $new_value );
  }
 
}



//---------------------------------------------------------
function enqueue_select2_jquery() {
	
    wp_register_style( 'select2css', plugins_url( '/assets/css/select2.css',__FILE__ ), false, '1.0', 'all' );
    wp_register_script( 'select2', plugins_url( '/assets/js/select2.js',__FILE__ ), array( 'jquery' ), '1.0', true );
    wp_register_script( 'jquery', plugins_url('/assets/js/jquery.js',__FILE__ ), false, '1.0', true );
    wp_enqueue_style( 'select2css' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'select2' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_select2_jquery' );


//---------------------------------------------------------
