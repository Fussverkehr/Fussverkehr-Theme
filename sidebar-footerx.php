<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
exit;

/**
* Footer Widget Template
*
*
* @file           sidebar-footerx.php
* @package        gConverter
* @filesource     wp-content/themes/gconverter/sidebar-footerx.php
* @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
*/
?>

<?php if (is_active_sidebar('footerx-widget-1')): ?>
<?php if (is_active_sidebar('footerx-widget-1')) : ?>
<?php dynamic_sidebar('footerx-widget-1'); ?>
<?php endif; ?>
<!-- end of #widgets -->
<?php endif; ?>

<?php if (is_active_sidebar('footerx-widget-2')): ?>
<?php if (is_active_sidebar('footerx-widget-2')) : ?>
<?php dynamic_sidebar('footerx-widget-2'); ?>
<?php endif; ?>
<!-- end of #widgets -->
<?php endif; ?>

<?php if (is_active_sidebar('footerx-widget-3')): ?>
<?php if (is_active_sidebar('footerx-widget-3')) : ?>
<?php dynamic_sidebar('footerx-widget-3'); ?>
<?php endif; ?>
<!-- end of #widgets -->
<?php endif; ?>

<?php if (is_active_sidebar('footerx-widget-4')): ?>
<?php if (is_active_sidebar('footerx-widget-4')) : ?>
<?php dynamic_sidebar('footerx-widget-4'); ?>
<?php endif; ?>
<!-- end of #widgets -->
<?php endif; ?>