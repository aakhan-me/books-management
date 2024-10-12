<?php
/*
Plugin Name: Books Management
Plugin URI: https://awaisworks.com
Description: A plugin to manage books with custom fields, searchable table, and CSV export.
Version: 1.0
Author: Awais Ahmed Khan
Author URI: https://awaisworks.com
License: GPLv2 or later
Text Domain: books-management
*/


/* 
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* 
 * Define constants.
 */
define( 'BMP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BMP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* 
 * Include necessary files
 */
require_once BMP_PLUGIN_DIR . 'inc/class-book-cpt.php';
require_once BMP_PLUGIN_DIR . 'inc/class-book-admin-pages.php';
require_once BMP_PLUGIN_DIR . 'inc/class-book-export.php';
require_once BMP_PLUGIN_DIR . 'inc/shortcode.php';
require_once BMP_PLUGIN_DIR . 'inc/book-ajax.php';

/* 
 * Activation hook: Register CPT
 */
register_activation_hook( __FILE__, 'bmp_activate_plugin' );
function bmp_activate_plugin() {
    BMP_Book_CPT::bmp_book_cpt_function();
    flush_rewrite_rules();
}

/* 
 * Deactivation hook: Cleanup if necessary
 */
register_deactivation_hook( __FILE__, 'bmp_deactivate_plugin' );
function bmp_deactivate_plugin() {
    flush_rewrite_rules();
}

/* 
 * Initialize the CPT for Books
 */
add_action( 'init', 'bmp_register_book_post_type' );
function bmp_register_book_post_type() {
    BMP_Book_CPT::bmp_book_cpt_function();
}

/* 
 * Enqueue admin assets
 */
add_action( 'admin_enqueue_scripts', 'bmp_enqueue_admin_assets' );
function bmp_enqueue_admin_assets() {

    // Enqueue jQuery UI Datepicker.
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // Enqueue jQuery UI CSS for the datepicker.
    wp_enqueue_style( 'jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
    wp_enqueue_script( 'bmp-admin-script', BMP_PLUGIN_URL . 'assets/js/script.js', array( 'jquery' ), false, true );
}

/* 
 * Enqueue frontend assets
 */
add_action( 'wp_enqueue_scripts', 'bmp_enqueue_frontend_assets' );
function bmp_enqueue_frontend_assets() {
    // Enqueue the frontend style for your plugin.
    wp_enqueue_style( 'bmp-frontend-style', BMP_PLUGIN_URL . 'assets/css/styles.css' );

    // Enqueue jQuery for AJAX.
    wp_enqueue_script( 'jquery' );

    // Enqueue the AJAX script for search functionality.
    wp_enqueue_script( 'bmp-frontend-script', BMP_PLUGIN_URL . 'assets/js/script.js', array( 'jquery' ), false, true );

    // Pass AJAX URL to JavaScript.
    wp_localize_script( 'bmp-frontend-script', 'bmp_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );
}
/* 
 * Register admin menu
 */
add_action( 'admin_menu', 'bmp_add_book_menu' );
function bmp_add_book_menu() {
    add_menu_page(
        __( 'Book Management', 'book-management' ),
        __( 'Book Management', 'book-management' ),
        'manage_options',
        'book-management',
        array( 'BMP_Book_Admin_Pages', 'display_books_page' ),
        'dashicons-book',
        6
    );
    add_submenu_page(
        'book-management',
        __( 'Add New Book', 'book-management' ),
        __( 'Add New Book', 'book-management' ),
        'manage_options',
        'add-new-book',
        array( 'BMP_Book_Admin_Pages', 'display_add_book_page' )
    );
}