<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1>Bible Buddy Settings</h1>
    <form method="post" action="options.php">
        <?php
        // Output the settings fields.
        settings_fields('bible_buddy_settings');
        do_settings_sections('bible-buddy-settings');
        submit_button();
        ?>
    </form>
</div>