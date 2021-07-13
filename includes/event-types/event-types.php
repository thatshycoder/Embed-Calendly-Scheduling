<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

include_once(EMCS_INCLUDES . 'api.php');

class EMCS_Event_Types
{

    public static function get_event_types()
    {

        if (!self::get_event_types_from_db()) {
            $event_types = self::fetch_event_types_from_calendly();

            if(!empty($event_types)) {
                self::cache_calendly_event_types($event_types);
            }  else {
                return [];
            }
        }

        return self::get_event_types_from_db();
    }

    private static function cache_calendly_event_types($event_types)
    {
        global $wpdb;
        $table_name = self::get_emcs_table();

        // create event types table if it doesn't exist
        self::create_emcs_event_types_table($table_name);

        if (!empty($event_types)) {

            foreach ($event_types as $event_type) {
                $data = self::prepare_event_type($event_type);
                $wpdb->insert($table_name, $data);
            }

            return true;
        }

        return false;
    }

    private static function prepare_event_type($event_type)
    {

        if (!empty($event_type)) {

            return array(
                'name'      => $event_type->get_event_name(),
                'url'       => $event_type->get_event_url(),
                'slug'      => $event_type->get_event_slug(),
                'status'    => $event_type->get_event_status()
            );
        }

        return false;
    }

    private static function fetch_event_types_from_calendly()
    {
        $options = get_option('emcs_settings');

        if (!empty($options['emcs_api_key'])) {
            return EMCS_API::emcs_get_events($options['emcs_api_key']);
        }

        return false;
    }

    private static function create_emcs_event_types_table($table_name)
    {
        $charset_collate = self::get_emcs_table_charset_collate();

        $sql = "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                url varchar(255) NOT NULL,
                slug tinytext NOT NULL,
                status tinytext NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        maybe_create_table($table_name, $sql);
    }

    private static function get_emcs_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'emcs_event_types';
    }

    private static function get_emcs_table_charset_collate()
    {
        global $wpdb;
        return $wpdb->get_charset_collate();
    }

    private static function get_event_types_from_db()
    {
        global $wpdb;

        $table_name = self::get_emcs_table();
        $query = "SELECT * FROM $table_name";
        $event_types = $wpdb->get_results($query);
        
        if (!empty($event_types)) {
            return $event_types;
        }

        return false;
    }

    public static function sync_button_listener()
    {
        if (isset($_REQUEST['emcs_sync_events'])) {
            self::sync_event_types();
        }
    }

    public static function sync_event_types()
    {
        self::flush_event_types();
        $event_types = self::fetch_event_types_from_calendly();
        self::cache_calendly_event_types($event_types);
    }

    private static function flush_event_types()
    {
        global $wpdb;
        $table_name = self::get_emcs_table();
        $query = "TRUNCATE table $table_name";

        return $wpdb->query($query);
    }
}
