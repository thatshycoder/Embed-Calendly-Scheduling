<?php
// Exit if accessed directly
defined('ABSPATH') || exit;
?>

<div class="emcs-inline-text-customizer-form">
    <form action="" method="get">
        <div class="emcs-form-group">
            <label for="type">Type</label>
            <select id="choose-customizer-type">
                <option value="inline">Inline Form</option>
                <option value="popup-text">Popup Text</option>
                <option value="inline-button">Inline Button</option>
                <option value="float-button">Float Button</option>
            </select>
        </div>
        <br>
        <div class="emcs-form-group">
            <button type="button" class="button button-default" id="emcs-customizer-home">Go Back</button>
        </div>
    </form>
</div>