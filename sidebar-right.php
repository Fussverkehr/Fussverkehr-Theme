<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Main Widget Template
 *
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 */
?>
<?php if (!dynamic_sidebar('right-sidebar')) : ?> <?php endif; ?>
