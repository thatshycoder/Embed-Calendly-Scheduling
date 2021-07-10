<?php

/**
 * Plugin Name: Embed Calendly Scheduling
 * Description: A simple and cleaner way to embed Calendly scheduling on WordPress.
 * Author: Shycoder
 * Author URI: https://shycoder.com/
 * Version: 1.3
 * License: GPLv2 or later
 */

defined('ABSPATH') or die('No script kiddies please.');
define('EMCS_DIR', plugin_dir_path(__FILE__));
define('EMCS_URL', plugin_dir_url(__FILE__));
define('EMCS_INCLUDES', EMCS_DIR . 'includes/');
define('EMCS_EVENT_TYPES', EMCS_INCLUDES . 'event-types/');
define('EMCS_CUSTOMIZER_TEMPLATES', EMCS_INCLUDES . 'embed-customizer/template-parts/');

include_once(EMCS_INCLUDES . 'shortcode.php');
include_once(EMCS_EVENT_TYPES . 'event-types-dashboard.php');
include_once(EMCS_INCLUDES . 'embed-customizer/customizer.php');

function emcs_admin_scripts()
{
    wp_enqueue_style('emcs_admin_css', EMCS_URL . 'assets/css/admin.css');
    wp_enqueue_style('emcs_util_css', EMCS_URL . 'assets/css/util.css');
    wp_enqueue_script('emcs_customizer_js',  EMCS_URL . 'assets/js/embed-customizer.js', array(), false, true);
}

function emcs_calendly_scripts()
{
    wp_enqueue_style('emcs_calendly_css', EMCS_URL . 'assets/css/widget.css');
    wp_enqueue_script('emcs_calendly_js',  EMCS_URL . 'assets/js/widget.js');
}

// embed calendly scripts
add_action('admin_enqueue_scripts', 'emcs_admin_scripts');
add_action('wp_enqueue_scripts', 'emcs_calendly_scripts');

// register calendly shortcode
add_shortcode('calendly', array('EMCS_Shortcode', 'register_shortcode'));

// register plugin menus
add_action('admin_menu', 'EMCS_Event_Types_Dashboard::init');
add_action('admin_menu', 'EMCS_Customizer::init');
include_once(EMCS_INCLUDES . 'settings.php');

// TODO: Add admin notices