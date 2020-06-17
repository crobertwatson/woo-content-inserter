<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webidextrous.com/
 * @since             1.0.0
 * @package           Woo_Content_Inserter
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Content Inserter
 * Plugin URI:        https://webidextrous.com/woo-content-inserter
 * Description:       Inserts formatted content at various hook points in WooCommerce cart and checkout. 
 * Version:           1.0.0
 * Author:            Rob Watson
 * Author URI:        https://webidextrous.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-content-inserter
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
define( 'WOO_CONTENT_INSERTER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-content-inserter-activator.php
 */
function activate_woo_content_inserter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-content-inserter-activator.php';
	Woo_Content_Inserter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-content-inserter-deactivator.php
 */
function deactivate_woo_content_inserter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-content-inserter-deactivator.php';
	Woo_Content_Inserter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_content_inserter' );
register_deactivation_hook( __FILE__, 'deactivate_woo_content_inserter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-content-inserter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woo_content_inserter() {

	$plugin = new Woo_Content_Inserter();
	$plugin->run();

}
run_woo_content_inserter();

/**
*	Store WooCommerce Insert content as custom post types for flexibility in editing
    Source: https://wordpress.stackexchange.com/questions/74468/how-to-set-a-custom-post-type-to-not-show-up-on-the-front-end
**/
function wci_cpt_init() {
    $labels = array(
        'name'          => _x( 'WooCommerce Inserts', 'Post type general name', 'woocommerceinsert' ),
        'singular_name' => _x( 'WooCommerce Insert', 'Post type singluar name', 'woocommerceinsert' ),
        'menu_name'     => _x( 'WooCommerce Inserts', 'Admin Menu text', 'woocommerceinsert' ),
        'name_admin_bar' => _x( 'WooCommerce Insert', 'Add New on Toolbar', 'woocommerceinsert' ),
        'add_new'       => __( 'Add New', 'woocommerceinsert' ),
        'add_new_item'  => __( 'Add New WooCommerce Insert', 'woocommerceinsert' ),
        'new_item'      => __( 'New WooCommerce Insert', 'woocommerceinsert' ),
        'edit_item'     => __( 'Edit WooCommerce Insert', 'woocommerceinsert' ),
        'view_item'     => __( 'View WooCommerce Insert', 'woocommerceinsert' ),
        'all_items'     => __( 'All WooCommerce Inserts', 'woocommerceinsert' ),
        'search_items'  => __( 'Search WooCommerce Inserts', 'woocommerceinsert' ),
        'parent_item_colon' => __( 'Parent WooCommerce Inserts:', 'woocommerceinsert' ),
        'not_found'     => __( 'No WooCommerce Inserts found.', 'woocommerceinsert' ),
        'not_found_in_trash' => __( 'No WooCommerce Inserts found in Trash.', 'woocommerceinsert' ),
        'insert_into_item' => _x( 'Insert into WooCommerce Insert', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'woocommerceinsert' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this WooCommerce Insert', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'woocommerceinsert' ),
        'filter_items_list'     => _x( 'Filter WooCommerce Insert list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'woocommerceinsert' ),
        'items_list_navigation' => _x( 'WooCommerce Inserts list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'woocommerceinsert' ),
        'items_list'            => _x( 'WooCommerce Inserts list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'woocommerceinsert' 
        ),        
    );
    $args = array(
        'labels'                => $labels,
        'description'           => 'WooCommerce Inserts custom post type.',
        'public'                => false,
        'publicly_queryable'    => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => false,
        'rewrite'               => false,
        'capability_type'       => 'post',
        'has_archive'           => false,
        'hierarchical'          => false,
        'menu_position'         => 20,
        'supports'              => array( 'title', 'editor', 'revisions', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats' ),
        'exclude_from_search'   => true,
        'show_in_rest'          => true
    );

    register_post_type( 'WooCommerce Insert', $args );
}
add_action( 'init', 'wci_cpt_init' );

/**
*	Don't allow Google to index WooCommerce Insert custom post types. Redirect to default home.
    Source: https://wordpress.stackexchange.com/questions/74468/how-to-set-a-custom-post-type-to-not-show-up-on-the-front-end
**/
function wci_cpt_redirect() {
    global $wp_query;

    // redirect from 'slideshow' CPT to home page
    if ( is_archive('WooCommerce Inserts') || is_singular('WooCommerce Insert') ) :
        $url   = get_bloginfo('url');

        wp_redirect( esc_url_raw( $url ), 301 );
        exit();
    endif;
}
add_action ( 'template_redirect', 'wci_cpt_redirect', 1);

/**
*   TODO: Make this dynamic by inserting content based on arguments passed, such as the hook the user desires the content to be inserted at and which custom post type post they'd like to insert.
**/
add_action( 'woocommerce_before_checkout_form', 'wci_add_checkout_notice_before_checkout', 12 ); 
function wci_add_checkout_notice_before_checkout() {
	echo 'This is the content to insert.';
}