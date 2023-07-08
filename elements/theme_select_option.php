<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<select name="theme">
    <option <?= esc_attr(get_option('theme')) == "traditional" ? "selected" : "" ?> value="traditional">Traditional</option>
    <option <?= esc_attr(get_option('theme')) == "cool" ? "selected" : "" ?> value="cool">Cool</option>
    <option <?= esc_attr(get_option('theme')) == "light" ? "selected" : "" ?> value="light">Light</option>
    <option <?= esc_attr(get_option('theme')) == "dark" ? "selected" : "" ?> value="dark">Dark</option>
</select>