<?php
// Exit if accessed directly
defined('ABSPATH') || exit;
?>

<div class="emcs-inline-form-customizer-form">
    <div class="sc-wrapper">
        <div class="sc-container">
            <div class="row">
                <div class="col-md-8">
                    <form>
                        <div class="form-row emcs-form-row">
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-type">Type</label>
                                <select name="emcs-embed-type" class="form-control">
                                    <option value="emcs-inline-text selected">Inline Form</option>
                                    <option value="emcs-popup-text">Popup Text</option>
                                    <option value="emcs-popup-button">Popup Button</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-text">Text</label>
                                <input type="text" class="form-control" name="emcs-embed-text" placeholder="Book Now">
                            </div>
                        </div>
                        <div class="form-row emcs-form-row">
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-form-height">Form Height(px)</label>
                                <input type="text" class="form-control" name="emcs-embed-form-height" placeholder="600">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="emcs-embed-form-widtht">Form Width(px)</label>
                                <input type="text" class="form-control" name="emcs-embed-form-width" placeholder="400">
                            </div>
                        </div>
                    </form>
                    <button type="button" name="emcs-customizer-home" class="button button-default">
                        << Go Back </button>
                </div>
                <div class="col-md-4">
                    Preview
                    <div class="emcs-customizer-preview">
                        <div class="preview-content">jgj</div>
                    </div>
                    <div class="emcs-embed-customizer-shortcode"></div>
                </div>
            </div>
        </div>
    </div>
</div>