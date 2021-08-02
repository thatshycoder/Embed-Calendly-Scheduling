<?php

/**
 * Plugin Name: Embed Calendly
 * Description: Easy and simple way to embed Calendly scheduling pages on WordPress.
 * Author: Embed Calendly, Shycoder
 * Author URI: https://embedcalendly.com/
 * Version: 2.0
 * License: GPLv2 or later
 */

defined('ABSPATH') or die('No script kiddies please.');
define('EMCS_DIR', plugin_dir_path(__FILE__));
define('EMCS_URL', plugin_dir_url(__FILE__));
define('EMCS_INCLUDES', EMCS_DIR . 'includes/');
define('EMCS_EVENT_TYPES', EMCS_INCLUDES . 'event-types/');
define('EMCS_CUSTOMIZER_TEMPLATES', EMCS_INCLUDES . 'widget-customizer/template-parts/');

include_once(EMCS_INCLUDES . 'admin.php');
include_once(EMCS_INCLUDES . 'shortcode.php');
include_once(EMCS_EVENT_TYPES . 'event-types-dashboard.php');
include_once(EMCS_INCLUDES . 'widget-customizer/customizer.php');

register_activation_hook( __FILE__, 'EMCS_Admin::on_activation' );

function emcs_admin_scripts()
{
    wp_enqueue_style('emcs_admin_css', EMCS_URL . 'assets/css/admin.css');
    wp_enqueue_style('emcs_util_css', EMCS_URL . 'assets/css/util.css');

    if (isset($_REQUEST['page'])) {
        if ($_REQUEST['page'] == 'emcs-customizer') {
            wp_enqueue_script('emcs_customizer_js',  EMCS_URL . 'assets/js/widget-customizer.js', array(), false, true);
        }
    }
}

function emcs_calendly_scripts()
{
    wp_enqueue_style('emcs_calendly_css', EMCS_URL . 'assets/css/widget.css');
    wp_enqueue_script('emcs_calendly_js',  EMCS_URL . 'assets/js/widget.js');
}

add_action('admin_enqueue_scripts', 'emcs_admin_scripts');
add_action('wp_enqueue_scripts', 'emcs_calendly_scripts');

add_shortcode('calendly', array('EMCS_Shortcode', 'register_shortcode'));

add_action('admin_menu', 'EMCS_Event_Types_Dashboard::init');
add_action('admin_menu', 'EMCS_Customizer::init');
include_once(EMCS_INCLUDES . 'settings.php');

add_action('in_admin_header', 'EMCS_Admin::clear_unwanted_notices', 1000);
add_action( 'admin_init', 'EMCS_Admin::display_notices' );
add_action( 'admin_init', 'EMCS_Admin::dismiss_notice_listener', 5 );
