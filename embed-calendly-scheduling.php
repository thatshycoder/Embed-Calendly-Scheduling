<?php

/**
 * Plugin Name: Embed Calendly Scheduling
 * Description: A simple and cleaner way to embed Calendly scheduling on WordPress.
 * Author: Shycoder
 * Author URI: https://shycoder.com/
 * Version: 1.1
 * License: GPLv2 or later
 */

defined('ABSPATH') or die('No script kiddies please.');
define('EMCS_DIR', plugin_dir_path(__FILE__));
define('EMCS_URL', plugin_dir_url(__FILE__));

include_once(EMCS_DIR . '/includes/shortcode.php');

// embed calendly scripts
add_action('wp_enqueue_scripts', 'emcs_calendly_scripts');

function emcs_calendly_scripts()
{
    wp_enqueue_style('emcs_calendly_css', 'https://assets.calendly.com/assets/external/widget.css');
    wp_enqueue_script('emcs_calendly_js', 'https://assets.calendly.com/assets/external/widget.js');
}

add_shortcode('calendly', array('EMCS_Shortcode', 'register_shortcode'));
