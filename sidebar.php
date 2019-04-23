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
<?php if (!dynamic_sidebar('main-sidebar')) : ?><?php endif; ?>
<!-- end of #widgets -->