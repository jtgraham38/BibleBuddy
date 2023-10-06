<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<select name="theme">
    <option <?php echo esc_attr(get_option('theme')) == "traditional" ? "selected" : "" ?> value="traditional">Traditional</option>
    <option <?php echo esc_attr(get_option('theme')) == "cool" ? "selected" : "" ?> value="cool">Cool</option>
    <option <?php echo esc_attr(get_option('theme')) == "light" ? "selected" : "" ?> value="light">Light</option>
    <option <?php echo esc_attr(get_option('theme')) == "dark" ? "selected" : "" ?> value="dark">Dark</option>
</select>