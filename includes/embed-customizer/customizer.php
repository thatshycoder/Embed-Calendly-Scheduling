<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Customizer
{
    public static function init()
    {
        add_submenu_page(
            'emcs-event-types',
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

        // hook sync button listener
        EMCS_Event_Types::sync_button_listener();
        $events = EMCS_Event_Types::get_event_types();
?>
        <div class="emcs-title">
            <img src="<?php echo EMCS_URL . 'assets/img/emc-logo.svg' ?>" width="200px" />
        </div>
        <div class="emcs-subtitle">
            Event Types
            <div class="emcs-sync-event-types">
                <form action="" method="POST">
                    <button type="submit" name="emcs_sync_events" class="button-primary">Sync <span class="dashicons dashicons-update-alt emcs-dashicon"></span></button>
                </form>
            </div>
        </div>
        <div class="emcs-container emcs-customizer">
            <?php

            if (empty($events)) {
                echo '<div class="emcs-text-center">Create an event in your Calendly account to begin customization.</div>';
                return;
            }

            ?>
            <div class="emcs-embed-title">Customize Embed</div>
            <?php
            include_once(EMCS_INCLUDES . 'embed-customizer/choose-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'inline-form-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'popup-text-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'popup-button-customizer.php');
            ?>
        </div>
<?php
    }
}
