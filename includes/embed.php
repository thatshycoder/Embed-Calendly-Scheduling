<?php

class EMCS_Embed
{
    protected $atts;

    public function __construct($atts)
    {
        $this->atts = $atts;

        define('EMCS_INLINE_EMBED_TYPE', 1);
        define('EMCS_POPUP_BUTTON_EMBED_TYPE', 2);
        define('EMCS_POPUP_TEXT_EMBED_TYPE', 3);
    }

    public function embed_calender()
    {
        switch ($this->atts['embed_type']) {
            case EMCS_INLINE_EMBED_TYPE:
                return $this->embed_inline_widget($this->atts);
            case EMCS_POPUP_BUTTON_EMBED_TYPE:
                return $this->embed_popup_widget($this->atts);
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
            echo '<div class="calendly-inline-widget ' . esc_attr($atts['style_class']) . '" data-url="' . esc_attr($atts['url']) . '"></div>';
        }
    }

    /**
     * Embeds calendly popup text widget
     */
    protected function embed_popup_text_widget($atts = array())
    {
        if (!empty($atts)) {
            echo '<a class="' . esc_attr($atts['style_class']) . '" href="" onclick="Calendly.initPopupWidget({url: \'' . esc_attr($atts['url']) . '\'});return false;">' . $atts['text'] . '</a>';
        }
    }

    /**
     * Embeds calendly popup widget
     */
    protected function embed_popup_widget($atts = array())
    {
        if (!empty($atts)) {
            echo $this->popup_script($atts);
        }
    }

    protected function popup_script($atts)
    {
        if (empty($atts)) {
            return;
        }

        $popup_script = '<script>Calendly.initBadgeWidget({ url: \'' . $atts['url'] . '\', text: \'' . $atts['text'] . '\', color: \'' . $atts['button_color'] . '\', textColor: \'' . $atts['text_color'] . '\', branding: ' . $atts['branding'] . ' });</script>';
        
        return $popup_script;
    }
}
