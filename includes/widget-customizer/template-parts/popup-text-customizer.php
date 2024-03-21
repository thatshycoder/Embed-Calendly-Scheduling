<?php
// Exit if accessed directly
defined('ABSPATH') || exit;
?>

<div class="emcs-popup-text-customizer-form">
    <div class="sc-wrapper">
        <div class="sc-container">
            <div class="row">
                <div class="col-md-8">
                    <form>
                        <div class="form-row emcs-form-row">
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-type"><?php esc_html_e( 'Embed Type', 'embed-calendly-scheduling' ); ?></label>
                                <select name="emcs-customizer-embed-type" class="form-control">
                                    <option value="emcs-inline-text"><?php esc_html_e( 'Inline', 'embed-calendly-scheduling' ); ?>Inline</option>
                                    <option value="emcs-popup-text"><?php esc_html_e( 'Popup Text', 'embed-calendly-scheduling' ); ?></option>
                                    <option value="emcs-popup-button"><?php esc_html_e( 'Popup Button', 'embed-calendly-scheduling' ); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-text"><?php esc_html_e( 'Text', 'embed-calendly-scheduling' ); ?></label>
                                <input type="text" class="form-control" name="emcs-embed-text" value="<?php esc_attr_e( 'Book Now', 'embed-calendly-scheduling' ); ?>">
                            </div>
                        </div>
                        <div class="form-row emcs-form-row">
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-text-color"><?php esc_html_e( 'Text Color', 'embed-calendly-scheduling' ); ?></label>
                                <input type="color" class="form-control" name="emcs-embed-text-color" value="#2694ea">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-text-size"><?php esc_html_e( 'Text Size(px)', 'embed-calendly-scheduling' ); ?></label>
                                <input type="number" class="form-control" name="emcs-embed-text-size" min="10" max="30" value="12">
                            </div>
                        </div>
                        <div class="form-row emcs-form-row">
                            <div class="form-group col-md-6">
                                <label for="emcs-cookie-banner"><?php esc_html_e( 'Hide Cookie Banner', 'embed-calendly-scheduling' ); ?></label>
                                <select name="emcs-cookie-banner" class="form-control">
                                    <option value="no"><?php esc_html_e( 'No', 'embed-calendly-scheduling' ); ?></option>
                                    <option value="yes"><?php esc_html_e( 'Yes', 'embed-calendly-scheduling' ); ?></option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <?php esc_html_e( 'Preview', 'embed-calendly-scheduling' ); ?>
                    <div class="emcs-customizer-preview">
                        <div class="emcs-preview-content">
                            <div class="emcs-preview"></div>
                        </div>
                    </div>
                    <input type="text" name="emcs-embed-customizer-shortcode" class="form-control" onclick="this.select();" value="">
                    <small><?php esc_html_e( 'Click to copy shortcode', 'embed-calendly-scheduling' ); ?></small>
                </div>
            </div>
            <button type="button" name="emcs-customizer-home" class="button button-default emcs-customizer-home">
                <?php esc_html_e( '<< Go Back', 'embed-calendly-scheduling' ); ?> </button>
        </div>
    </div>
</div>