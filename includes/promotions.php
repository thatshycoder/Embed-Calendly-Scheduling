<?php

defined('ABSPATH') || exit;

class EMCS_Promotions
{
    private const PROMOTION_OPTION = 'emcs_promotions';
    private const STOP_PROMOTION_ONE_OPTION = 'emcs_stop_promotion_one';
    private const STOP_PROMOTION_TWO_OPTION = 'emcs_stop_promotion_two';
    private const PROMOTION_TWO_DELAY = 'emcs_promotion_two_delay';

    public static function init()
    {
        if (!get_option(self::PROMOTION_OPTION)) {

            add_option(self::PROMOTION_OPTION, strtotime('now'));
            add_option(self::STOP_PROMOTION_ONE_OPTION, 0);
            add_option(self::STOP_PROMOTION_TWO_OPTION, 0);
            add_option(self::PROMOTION_TWO_DELAY, 0);
        }

        wp_enqueue_style('emcs_calendly_css');
        wp_enqueue_script('emcs_calendly_js');

        self::display_promotions();
        self::promotion_actions_listener();
    }

    private static function promotion_actions_listener()
    {
        if (isset($_REQUEST[self::STOP_PROMOTION_ONE_OPTION])) {

            if ($_REQUEST[self::STOP_PROMOTION_ONE_OPTION]) {
                self::dismiss_promotion_one();
            }
        }

        if (isset($_REQUEST[self::STOP_PROMOTION_TWO_OPTION])) {

            if ($_REQUEST[self::STOP_PROMOTION_TWO_OPTION]) {
                self::dismiss_promotion_two();
            }
        }
    }

    private static function dismiss_promotion_two()
    {
        update_option(self::STOP_PROMOTION_TWO_OPTION, 1);
    }

    private static function dismiss_promotion_one()
    {

        $promotion_two_delay = get_option(self::PROMOTION_TWO_DELAY);

        if (!$promotion_two_delay) {
            update_option(self::PROMOTION_TWO_DELAY, strtotime('now'));
        }

        update_option(self::STOP_PROMOTION_ONE_OPTION, 1);
    }

    private static function display_promotions()
    {
        $after_activation_waittime = strtotime('-3 days');
        $promotion_two_waittime = strtotime('-7 days');

        if ($after_activation_waittime > get_option(self::PROMOTION_OPTION)) {

            if (!get_option(self::STOP_PROMOTION_ONE_OPTION)) {
                add_action('admin_notices', 'EMCS_Promotions::promotion_one');
            }

            if ($promotion_two_waittime > get_option(self::PROMOTION_TWO_DELAY)) {

                if (get_option(self::STOP_PROMOTION_ONE_OPTION) && !get_option(self::STOP_PROMOTION_TWO_OPTION)) {
                    add_action('admin_notices', 'EMCS_Promotions::promotion_two');
                }
            }
        }
    }

    public static function promotion_two()
    {
?>
        <div class="notice notice-info is-dismissible emcs-promotion-notice-secondary">
            <div class="emcs-row">
                <div class="emcs-col">
                    <h2>Learn How To <u>Get More Leads</u> With Your Website</h2>
                    <br>
                    <div>
                        <?php echo do_shortcode('[calendly url="https://calendly.com/spantus/call" type="2" text="Speak to an expert" style_class="button-primary" hide_cookie_banner="1"] '); ?>
                        <a href="?emcs_stop_promotion_two=1" class="">Don't show again.</a>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

    public static function promotion_one()
    {
    ?>
        <div class="notice notice-info is-dismissible emcs-promotion-notice">
            <div class="emcs-row">
                <div class="emcs-col">
                    <h2>Keep your calendar booked this <?php echo date('F', strtotime('+1 month')) ?>!</h2>
                    <h3>Optimize your website to <strong><u>book more calls</u></strong> and <strong><u>land more clients</u></strong></h3>
                    <div>
                        <a href="https://embedcalendly.com/promotion" class="button-primary" target="_blank">Learn how</a>
                        <a href="?emcs_stop_promotion_one=1" class="">Don't show again.</a>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
