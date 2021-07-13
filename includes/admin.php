<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Admin
{
    public static function clear_unwanted_notices()
    {
        if (isset($_REQUEST['page'])) {

            if ($_REQUEST['page'] == 'emcs-customizer' || $_REQUEST['page'] == 'emcs-event-types' || $_REQUEST['page'] == 'emcs-settings') {
                remove_all_actions('admin_notices');
                remove_all_actions('all_admin_notices');
            }
        }
    }

    public static  function rating_admin_notice()
    {
?>
        <div class="notice notice-info is-dismissible">
            <p>
                Enjoying <strong>Embed Calendly?</strong> Kindly rate it
                <span class="dashicons dashicons-star-filled emcs-dashicon emcs-dashicon-rating"></span>
                <span class="dashicons dashicons-star-filled emcs-dashicon emcs-dashicon-rating"></span>
                <span class="dashicons dashicons-star-filled emcs-dashicon emcs-dashicon-rating"></span>
                <span class="dashicons dashicons-star-filled emcs-dashicon emcs-dashicon-rating"></span>
                <span class="dashicons dashicons-star-filled emcs-dashicon emcs-dashicon-rating"></span>
                on WordPress.org. Thank you!
                <a href="https://wordpress.org/support/plugin/embed-calendly-scheduling/reviews/#new-post">Submit review.</a>
                Already done?
                <a href="#">Don't remind me again.</a>
            </p>
        </div>
<?
    }
}
