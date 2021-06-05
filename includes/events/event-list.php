<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

include_once(EMCS_INCLUDES . 'api.php');

class EMCS_Events
{

    public static function init()
    {
        add_menu_page(
            __('Embed Calendly', 'emcs'),
            __('Embed Calendly', 'emcs'),
            'manage_options',
            'emcs-events',
            'EMCS_Events::emcs_event_list_html',
            '',
            30
        );

        add_submenu_page(
            'emcs-events',
            __('Event Types', 'emcs'),
            __('Event Types', 'emcs'),
            'manage_options',
            'emcs-events',
            'EMCS_Events::emcs_event_list_html'
        );
    }

    public static function emcs_event_list_html()
    {
        $events = self::get_events();
?>
        <div class="emcs">Embed Calendly</div>
        <div class="emcs-wrapper">
            <h1 class="emcs-events">Event Types</h1>

            <?php
            if (empty($events)) {
                echo 'No events in your account';
            } else {

                // TODO: Refactor
            ?>
                <!-- Event List Table -->
                <table class="wp-list-table widefat fixed striped table-view-list posts">
                    <thead>
                        <tr>
                            <th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=post_grid&amp;orderby=title&amp;order=asc"><span>Name</span><span class="sorting-indicator"></span></a></th>
                            <th scope="col" id="shortcode" class="manage-column column-shortcode">Shortcode</th>
                            <th scope="col" id="date" class="manage-column column-date sortable asc"><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=post_grid&amp;orderby=date&amp;order=desc"><span>Status</span><span class="sorting-indicator"></span></a></th>
                        </tr>
                    </thead>

                    <tbody id="the-list">
                        <?php
                        foreach ($events as $event) {
                            $status = ($event->get_event_status()) ? '<span style="color: green; font-weight: bold"> Active</span>' :
                                '<span style="color: red; font-weight: bold"> Inactive</span>';
                        ?>
                            <tr id="post-11029" class="iedit author-self level-0 post-11029 type-post_grid status-publish hentry">
                                <td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
                                    <div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
                                    <strong><a class="row-title" href="#"><?php echo $event->get_event_name(); ?></a></strong>
                                    <div class="row-actions"><span class="edit"><a href="http://localhost/wordpress/wp-admin/post.php?post=11029&amp;action=edit" aria-label="Edit “(no title)”">Customize</a>
                                </td>
                                <td class="shortcode column-shortcode" data-colname="Shortcode"> <input style="background:#bfefff" type="text" onclick="this.select();" value="[calendly id=&quot;11029&quot;]"><br>
                                </td>
                                <td class="date column-date" data-colname="Date"><?php echo $status; ?></td>
                            </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col" class="manage-column column-title column-primary sortable desc"><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=post_grid&amp;orderby=title&amp;order=asc"><span>Name</span><span class="sorting-indicator"></span></a></th>
                            <th scope="col" class="manage-column column-shortcode">Shortcode</th>
                            <th scope="col" class="manage-column column-date sortable asc"><a href="http://localhost/wordpress/wp-admin/edit.php?post_type=post_grid&amp;orderby=date&amp;order=desc"><span>Status</span><span class="sorting-indicator"></span></a></th>
                        </tr>
                    </tfoot>

                </table>
        </div>
<?php
                        }
                    }
                }

                public static function get_events() {
                    $options = get_option('emcs_settings');
                    $api_key = !empty($options['emcs_api_key']) ? $options['emcs_api_key'] : '';
                    return EMCS_API::emcs_get_events($api_key);
                }
            }
