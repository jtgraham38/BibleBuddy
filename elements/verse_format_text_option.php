<?php 
// exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="tooltip">
    <input type="text" name="format" value="<?= esc_attr(get_option('format')) ?>" />
    <span class="tooltiptext">
        <ul>
            <li>\B = Book of the Bible</li>
            <li>\C = Chapter of the book</li>
            <li>\V = Verse in that book</li>
        </ul>
    </span>
</div>

<style>
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 400px;
  background-color: #1d2327;
  color: #f0f0f1;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;

  /* Position the tooltip text */
  position: absolute;
  z-index: 1;
  top: 20%;
  left: 105%;
  margin-top: -40px;

  /* Fade in tooltip */
  opacity: 0;
  transition: opacity 0.3s;
}

/* Tooltip arrow */
.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 50%;
  left: -10px;
  margin-top: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: transparent #1d2327 transparent transparent;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

</style>