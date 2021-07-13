<?php

// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Embed
{
    protected $atts;

    public function __construct($atts)
    {
        $this->atts = $atts;

        if (!defined('EMCS_BUTTON_EMBED_TYPE')) {
            define('EMCS_BUTTON_EMBED_TYPE', 2);
        }

        if (!defined('EMCS_POPUP_TEXT_EMBED_TYPE')) {
            define('EMCS_POPUP_TEXT_EMBED_TYPE', 3);
        }
    }

    public function embed_calender()
    {
        switch ($this->atts['embed_type']) {
            case EMCS_BUTTON_EMBED_TYPE:

                if ($this->atts['button_style'] == 1) {
                    return $this->embed_inline_button_widget($this->atts);
                } else {
                    return $this->embed_popup_button_widget($this->atts);
                }

            case EMCS_POPUP_TEXT_EMBED_TYPE:
                return $this->embed_popup_text_widget($this->atts);

            default:
                return $this->embed_inline_widget($this->atts);
        }
    }

    /**
     * Embeds calendly inline widget
     */
    protected function embed_inline_widget($atts = array())
    {
        if (!empty($atts)) {
            return '<div class="calendly-inline-widget ' . esc_attr($atts['style_class']) . '" data-url="' . esc_attr($atts['url']) . '"
                         style="height:' . esc_attr($atts['form_height']) . '; width:' . esc_attr($atts['form_width']) . '"></div>';
        }
    }

    /**
     * Embeds calendly popup text widget
     */
    protected function embed_popup_text_widget($atts = array())
    {
        if (!empty($atts)) {
            return '<a class="' . esc_attr($atts['style_class']) . '" href="" onclick="Calendly.initPopupWidget({url: \'' . esc_attr($atts['url']) . '\'});return false;"
                       style="font-size:' . esc_attr($atts['text_size']) . '; color:' . esc_attr($atts['text_color']) . '">' . $atts['text'] . '</a>';
        }
    }

    /**
     * Embeds calendly inline button widget
     */
    protected function embed_inline_button_widget($atts = array())
    {
        $button_padding = '';

        switch ($atts['button_size']) {
            case 1:
                // small button size
                $button_padding = '10px';
                break;
            case 2:
                // medium button size
                $button_padding = '15px';
                break;
            default:
                // large button size
                $button_padding = '20px';
        }

        if (!empty($atts)) {
            return '<a class="' . esc_attr($atts['style_class']) . '" href="" onclick="Calendly.initPopupWidget({url: \'' . esc_attr($atts['url']) . '\'});return false;"
                       style="background-color: ' . $atts['button_color'] . '; padding: ' . $button_padding . '; font-size:' . esc_attr($atts['text_size']) . '; 
                       color:' . esc_attr($atts['text_color']) . ';">' . $atts['text'] . '</a>';
        }
    }

    /**
     * Embeds calendly popup button widget
     */
    protected function embed_popup_button_widget($atts = array())
    {
        if (!empty($atts)) {
            return $this->popup_script($atts);
        }
    }

    protected function popup_script($atts)
    {
        if (empty($atts)) {
            return;
        }

        // TODO: Check more customization options on calendly
        return '<script>Calendly.initBadgeWidget({ url: \'' . $atts['url'] . '\', text: \'' . $atts['text'] . '\', 
                color: \'' . $atts['button_color'] . '\', textColor: \'' . $atts['text_color'] . '\', 
                textSize: \'' . $atts['text_size'] . '\', branding: ' . $atts['branding'] . ' });</script>';
    }
}
