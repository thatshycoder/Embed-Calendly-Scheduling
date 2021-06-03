<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

include_once(EMCS_DIR . '/includes/embed.php');

class EMCS_Shortcode
{
    public static function register_shortcode($atts) {
        return self::load_view($atts);
    }

    public static function load_view($atts)
    {
        $atts = array_change_key_case((array) $atts, CASE_LOWER);
        $error_message = 'Error embedding calendar. Invalid URL';

        // no url, nothing to display
        if (empty($atts) || empty($atts['url'])) {
            return $error_message;
        }

        if (isset($atts['hide_details'])) {

            if (!empty($atts['hide_details']) && $atts['hide_details'] == 'true' || $atts['hide_details'] == 1) {
                $atts['url'] = $atts['url'] . '?hide_event_type_details=1';
            }
        }

        $atts = self::prepare_attributes($atts);
        $emcs_embed = new EMCS_Embed($atts);

        return $emcs_embed->embed_calender();
    }

    /**
     * Sanitize shortcode inputs
     */
    protected static function prepare_attributes($atts)
    {
        $url = esc_url_raw($atts['url']);
        $embed_type = (!empty($atts['type'])) ? sanitize_text_field($atts['type']) : '1';
        $text = (!empty($atts['text'])) ? sanitize_text_field($atts['text']) : 'Schedule a call with me';
        $class = (!empty($atts['style_class'])) ? sanitize_text_field($atts['style_class']) : '';
        $text_color = (!empty($atts['text_color'])) ? sanitize_text_field($atts['text_color']) : '#ffffff';
        $button_color = (!empty($atts['button_color'])) ? sanitize_text_field($atts['button_color']) : '#00a2ff';
        $branding = (!empty($atts['branding'])) ? sanitize_text_field($atts['branding']) : 'true';

        $extracted_atts = ['embed_type' => $embed_type, 'url' => $url, 'text' => $text, 'style_class' => $class, 'button_color' => $button_color, 'text_color' => $text_color, 'branding' => $branding];

        return $extracted_atts;
    }
}
