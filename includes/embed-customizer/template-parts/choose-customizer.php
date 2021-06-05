<?php
// Exit if accessed directly
defined('ABSPATH') || exit;
?>

<div class="emcs-choose-customizer-form emcs emcs-text-center">
    <div class="sc-wrapper">
        <div class="sc-container">
            <form action="admin.php?page=emcs-customizer" method="post">
                <div class="form-group">
                    <label for="choose-customizer">Choose Event Type</label>
                </div>
                <div class="form-group">
                    <select name="emcs-choose-customizer-select">
                        <?php

                        foreach (self::$events as $event) {
                        ?>
                            <option value="<?php echo $event->get_event_url(); ?>"><?php echo $event->get_event_name(); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button type="submit" name="emcs-choose-customizer" class="button button-primary">Start customizing</button>
                </div>
            </form>
        </div>
    </div>
</div>