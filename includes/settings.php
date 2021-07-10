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
        __('Setup Calendly connection', 'emcs'),
        '',
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

function emcs_api_field_cb($args)
{
    // Get the value of the setting we've registered previously
    $options = get_option('emcs_settings');

    // TODO: Strip spaces
?>
    <div class="form-row">
        <div class="form-group col-md-8">
            <input id="<?php echo esc_attr($args['label_for']); ?>" name="emcs_settings[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo !empty($options['emcs_api_key']) ? esc_html($options['emcs_api_key']) : ''; ?>" class="form-control" />
            <p id="<?php echo esc_attr($args['label_for']); ?>_description">
                <?php esc_html_e('Your API Key can be found in your Calendly "integeration" page', 'emcs'); ?>
            </p>
        </div>
    </div>
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
    <div class="sc-wrapper">
        <div class="sc-container">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <div class="row">
                <div class="col-md-9">
                    <form action="options.php" method="post">
                        <?php
                        settings_fields('emcs');
                        do_settings_sections('emcs');
                        submit_button('Save Settings');
                        ?>
                    </form>
                </div>
                <div class="col-md-3 emcs-promotion-container">
                    <h3>Like this plugin?</h3>
                    <p>
                    If you find this plugin useful, please show your love and support by
                    rating it ***** on<a href="https://wordpress.org/support/plugin/embed-calendly-scheduling/" target="_blank"> WordPress.org </a>
                    - much appreciated! :-D
                    </p><br>
                    <div class="emcs-promotion">
                        <h2>Need Support?</h2>
                        <p>
                            Please use the <a href="https://wordpress.org/support/plugin/embed-calendly-scheduling/" target="_blank"> support forums on WordPress.org </a> to
                            submit a support ticket or report a bug.
                        </p>
                    </div>
                    <div class="emcs-promotion">
                        <h2>Donate</h2>
                        <p>
                            Your generous donation will help me keep supporting and improving the plugin. Thank you :)
                        <ul>
                            <li>BTC:</li>
                            <li>Ethereum:</li>
                        </ul>
                        </p>
                        <div class="emcs-text-center">
                            <a href="https://flutterwave.com/pay/spantuskqg2" target="_blank">
                                <img src="<?php echo esc_attr(EMCS_URL . 'assets/img/donate.PNG'); ?>" width="100" alt="Donate" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

add_action('admin_menu', 'emcs_settings_page');
