<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

include_once(EMCS_INCLUDES . 'events/event.php');

/**
 * Setup Calendly API connection 
 */
class EMCS_API
{
    // TODO: refactor
    public static function connect($endpoint, $api_key)
    {

        // TODO: Check if API doesn't return error
        $url = 'https://calendly.com/api/v1' . $endpoint;
        // $args = array(
        //     'timeout' => 10,
        //     'headers' => [
        //         'X-Token: ' . $api_key
        //     ],

        // );

        // return wp_remote_get($url, $args);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'X-Token: ' . $api_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($result);
    }
    /**
     * Get all events in a user's calendly account
     */
    public static function emcs_get_events($api_key)
    {
        $calendly_events  = EMCS_API::connect('/users/me/event_types', $api_key);
        $events_data = array();

        if (empty($calendly_events->data)) {
            return false;
        }

        foreach ($calendly_events->data as $events) {

            $event = new EMCS_Event(
                $events->attributes->name,
                $events->attributes->description,
                $events->attributes->active,
                $events->attributes->url,
                '/' . $events->attributes->slug,
            );

            $events_data[] = $event;
        }

        return $events_data;
    }
}
