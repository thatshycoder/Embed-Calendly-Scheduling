<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

include_once(EMCS_EVENT_TYPES . 'event-types.php');

class EMCS_Event_Types_Dashboard
{

    public static function init()
    {
        add_menu_page(
            __('Embed Calendly', 'emcs'),
            __('Embed Calendly', 'emcs'),
            'manage_options',
            'emcs-events',
            'EMCS_Event_Types_Dashboard::emcs_event_list_html',
            '',
            30
        );

        add_submenu_page(
            'emcs-events',
            __('Event Types', 'emcs'),
            __('Event Types', 'emcs'),
            'manage_options',
            'emcs-events',
            'EMCS_Event_Types_Dashboard::emcs_event_list_html'
        );
    }

    public static function emcs_event_list_html()
    {
        $events = EMCS_Event_Types::get_event_types();
?>
        <div class="emcs">Embed Calendly</div>
        <div class="emcs-wrapper">
            <h1 class="emcs-events">Event Types</h1>

            <?php
            if (empty($events)) {
                echo 'No events in your account';
            } else {
            ?>
                <!-- Event List Table -->
                <table class="wp-list-table widefat fixed striped table-view-list posts">
                    <thead>
                        <tr>
                            <th scope="col" class="manage-column column-primary">Name</th>
                            <th scope="col" class="manage-column">Shortcode</th>
                            <th scope="col" class="manage-column">Status</th>
                        </tr>
                    </thead>

                    <tbody id="the-list">
                        <?php
                        foreach ($events as $event) {

                            $status = ($event->status) ? '<span style="color: green; font-weight: bold"> Active</span>' :
                                '<span style="color: red; font-weight: bold"> Inactive</span>';
                        ?>
                            <tr>
                                <td class="title column-primary page-title emcs_event_type_column" data-colname="Name">
                                    <strong><span class="row-title"><?php echo esc_attr($event->name); ?></span></strong>
                                    <div class="row-actions"><a href="?page=emcs-customizer&event_type=<?php echo esc_attr($event->slug) ?>" id="emcs-admin-customize-event">Customize</a>
                                </td>
                                <td class="shortcode emcs_event_type_column" data-colname="Shortcode"> <input style="background:#bfefff" type="text" onclick="this.select();" value="[calendly url=&quot;<?php echo esc_attr($event->url)  ?>&quot; type=&quot;1&quot;]"><br>
                                </td>
                                <td class="date emcs_event_type_column" data-colname="Status"><?php echo $status; ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col" class="manage-column column-primary">Name</th>
                            <th scope="col" class="manage-column">Shortcode</th>
                            <th scope="col" class="manage-column">Status</th>
                        </tr>
                    </tfoot>

                </table>
        </div>
<?php
            }
        }
    }
