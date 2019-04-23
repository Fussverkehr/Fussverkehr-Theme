<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Home Widgets Template
 *
 *
 * @file           sidebar-home.php
 * @package        gConverter 
 * @filesource     wp-content/themes/gconverter/sidebar-home.php
 */
?>  
<?php if (!dynamic_sidebar('home-widget-1')) : ?><?php endif; ?>

<?php if (!dynamic_sidebar('home-widget-2')) : ?><?php endif; ?>

<?php if (!dynamic_sidebar('home-widget-3')) : ?><?php endif; ?>
