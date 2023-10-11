<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<input type="checkbox" name="display_credit_link" <?php checked(get_option('display_credit_link')) ?> value="1"/>
