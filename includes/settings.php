<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Embed Calendly settings page setup
 */
function emcs_settings_init()
{
    register_setting('emcs', 'emcs_settings');

    add_settings_section(
        'emcs_api_section',
        __('Embed Calendly Settings', 'emcs'),
        'emcs_api_section_cb',
        'emcs'
    );

    add_settings_field(
        'emcs_api_field',
        __('API Key', 'emcs'),
        'emcs_api_field_cb',
        'emcs',
        'emcs_api_section',
        array(
            'label_for'         => 'emcs_api_key'
        )
    );
}

function emcs_api_section_cb($args)
{
?>
    <p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Setup Calendly connection', 'emcs'); ?></p>
<?php
}

function emcs_api_field_cb($args)
{
    // Get the value of the setting we've registered previously
    $options = get_option('emcs_settings');
    // TODO: Strip spaces
?>
    <input id="<?php echo esc_attr($args['label_for']); ?>" name="emcs_settings[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo !empty($options['emcs_api_key']) ? esc_html($options['emcs_api_key']) : ''; ?> " />
    <p class="description">
        <?php esc_html_e('Your API Key can be found in your Calendly "integeration" page', 'emcs'); ?>
    </p>
<?php
}

add_action('admin_init', 'emcs_settings_init');

function emcs_settings_page()
{
    add_submenu_page(
        'emcs-events',
        __('Embed Calendly Settings', 'emcs'),
        __('Settings', 'emcs'),
        'manage_options',
        'emcs-settings',
        'emcs_settings_page_html',
    );
}

function emcs_settings_page_html()
{
    // Show the settings page to only admins
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['settings-updated'])) {
        add_settings_error('emcs_messages', 'emcs_message', __('Settings Saved', 'emcs'), 'updated');
    }

    settings_errors('emcs_messages');
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('emcs');
            do_settings_sections('emcs');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
<?php
}

add_action('admin_menu', 'emcs_settings_page');