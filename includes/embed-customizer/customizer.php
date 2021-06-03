<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Customizer
{

    public static function init()
    {
        add_submenu_page(
            'emcs-events',
            __('Customize Embed - Embed Calendly', 'emcs'),
            __('Customizer', 'emcs'),
            'manage_options',
            'emcs-customizer',
            'EMCS_Customizer::get_layout'
        );
    }

    public static function get_layout()
    {
?>
        <div class="emcs-container emcs-customizer emcs-text-center">
            <h1>Customize Embed</h1>
            <?php
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'choose-customizer.php');
            include_once(EMCS_CUSTOMIZER_TEMPLATES . 'inline-text-customizer.php');
            ?>
        </div>
<?php
    }
}
