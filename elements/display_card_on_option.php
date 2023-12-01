<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div style="display: inline">
    <div style="display: inline">Posts</div>
    <input type="checkbox" name="display_card_on_posts" <?php checked(get_option('display_card_on_posts')) ?> value="1"/>
</div>
<div style="display: inline">
    <div style="display: inline">Pages</div>
    <input type="checkbox" name="display_card_on_pages" <?php checked(get_option('display_card_on_pages')) ?> value="1"/>
</div>


