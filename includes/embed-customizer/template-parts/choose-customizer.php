<?php
// Exit if accessed directly
defined('ABSPATH') || exit;
?>

<div class="emcs-choose-customizer-form">
    <form action="admin.php?page=emcs-customizer" method="post">
        <div class="emcs-label">
            <label for="choose-customizer">Choose Event Type</label>
        </div>
        <div class="emcs-label">
            <select id="emcs-choose-customizer-select">
                <option value="Discovery Session">Discovery Session</option>
            </select>
            <button type="submit" id="emcs-choose-customizer" class="button button-primary">Start customizing</button>
        </div>
    </form>
</div>