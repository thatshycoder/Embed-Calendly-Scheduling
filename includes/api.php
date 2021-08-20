<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

include_once(EMCS_INCLUDES . 'event-types/event-type.php');

class EMCS_API
{

    public static function emcs_get_events($api_key)
    {
        $calendly_events  = EMCS_API::connect('/users/me/event_types', $api_key);
        $events_data = array();

        if (empty($calendly_events->data)) {
            return false;
        }

        foreach ($calendly_events->data as $events) {
        
            $event = new EMCS_Event_Type(
                $events->attributes->name,
                $events->attributes->description,
                !empty($events->attributes->active) ? $events->attributes->active : '0',
                $events->attributes->url,
                $events->attributes->slug
            );

            $events_data[] = $event;
        }

        return $events_data;
    }

    public static function connect($endpoint, $api_key)
    {
        $url = 'https://calendly.com/api/v1' . $endpoint;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'X-Token: ' . $api_key;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}
