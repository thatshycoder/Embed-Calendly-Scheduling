<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Customizer
{

    protected static $events = '';

    public static function init()
    {
        add_submenu_page(
            'emcs-events',
            __('Customize Embed - Embed Calendly', 'emcs'),
            __('Customizer', 'emcs'),
            'manage_options',
            'emcs-customizer',
            'EMCS_Customizer::get_layout'
        );
    }

    public static function get_layout()
    {
        include_once(EMCS_EVENTS . 'event-list.php');
        self::$events = EMCS_Events::get_events();
?>
        <div class="emcs-container emcs-customizer">
            <?php

            if (empty(self::$events)) {
                echo '<div class="emcs-text-center">Create an event in your Calendly account to begin customization.</div>';
                return;
            }

            ?>
            <div class="emcs-embed-title">Customize Embed</div>
            <?php
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'choose-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'inline-form-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'popup-text-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'popup-button-customizer.php');
            ?>
        </div>
<?php
    }
}
