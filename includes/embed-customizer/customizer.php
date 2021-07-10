<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Customizer
{
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
        include_once(EMCS_EVENT_TYPES . 'event-types.php');
        $events = EMCS_Event_Types::get_event_types();
?>
        <div class="emcs-container emcs-customizer">
            <?php

            if (empty($events)) {
                echo '<div class="emcs-text-center">Create an event in your Calendly account to begin customization.</div>';
                return;
            }

            ?>
            <div class="emcs-embed-title">Customize Embed</div>
            <?php

            // show choose event type only if it doesn't exist in url
            if(!isset($_REQUEST['event_type'])) {
                include_once(EMCS_INCLUDES . 'embed-customizer/choose-customizer.php');
            }

            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'inline-form-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'popup-text-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'popup-button-customizer.php');
            ?>
        </div>
<?php
    }
}
