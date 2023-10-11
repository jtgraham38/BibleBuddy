<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="hover_card verse_theme-<?php echo esc_attr(get_option('theme', 'traditional')) ?>">
    <div class="verse_content">

        <div class="verse_header">
            <p class="verse_header_text"></p>
            <select class="verse_version_select">
                <option value="kjv">King James Version</option>
                <option value="web">World English Bible</option>
                <option value="bbe">Bible in Basic English</option>
                <option value="clementine">Clementine Latin Vulgate</option>
                <option value="almeida">João Ferreira de Almeida</option>
                <option value="rccv">Protestant Romanian Corrected Cornilescu Version</option>
            </select>
        </div>

        <div class="verse_body">
            <p class="verse_text"></p>
        </div>

        <div class="verse_footer">
            <p class="verse_footer_text"></p>
            <?php if (esc_attr(get_option('display_credit_link'))) { ?>
                <a class="bb_link" href="https://jacob-t-graham.com" target="_blank">JG</a>
            <?php } ?>
        </div>
    </div>
    <div class="hover_card_arrow" data-popper-arrow></div>
</div>

