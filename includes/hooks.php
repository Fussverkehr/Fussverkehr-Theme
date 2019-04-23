<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme's Action Hooks
 *
 *
 * @file           hooks.php
 * @package        WordPress 
 * @subpackage     gconverter 
 * @filesource     wp-content/themes/gconverter/includes/hooks.php
 * @link           http://codex.wordpress.org/Plugin_API/Hooks
 * @since          available since Release 1.1
 */
?>
<?php

/**
 * Just after opening <body> tag
 *
 * @see header.php
 */
function gconverter_container() {
    do_action('gconverter_container');
}

/**
 * Just after closing </div><!-- end of #container -->
 *
 * @see footer.php
 */
function gconverter_container_end() {
    do_action('gconverter_container_end');
}

/**
 * Just after opening <div id="container">
 *
 * @see header.php
 */
function gconverter_header() {
    do_action('gconverter_header');
}

/**
 * Just after opening <div id="header">
 *
 * @see header.php
 */
function gconverter_in_header() {
    do_action('gconverter_in_header');
}

/**
 * Just after closing </div><!-- end of #header -->
 *
 * @see header.php
 */
function gconverter_header_end() {
    do_action('gconverter_header_end');
}

/**
 * Just before opening <div id="wrapper">
 *
 * @see header.php
 */
function gconverter_wrapper() {
    do_action('gconverter_wrapper');
}

/**
 * Just after opening <div id="wrapper">
 *
 * @see header.php
 */
function gconverter_in_wrapper() {
    do_action('gconverter_in_wrapper');
}

/**
 * Just after closing </div><!-- end of #wrapper -->
 *
 * @see header.php
 */
function gconverter_wrapper_end() {
    do_action('gconverter_wrapper_end');
}

/**
 * Just before opening <div id="widgets">
 *
 * @see sidebar.php
 */
function gconverter_widgets() {
    do_action('gconverter_widgets');
}

/**
 * Just after closing </div><!-- end of #widgets -->
 *
 * @see sidebar.php
 */
function gconverter_widgets_end() {
    do_action('gconverter_widgets_end');
}

/**
 * Theme Options
 *
 * @see theme-options.php
 */
function gconverter_theme_options() {
    do_action('gconverter_theme_options');
}

/**
 * WooCommerce
 *
 * Unhook/Hook the WooCommerce Wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'gconverter_woocommerce_wrapper', 10);
add_action('woocommerce_after_main_content', 'gconverter_woocommerce_wrapper_end', 10);
 
function gconverter_woocommerce_wrapper() {
  echo '<div id="content-woocommerce" class="grid col-620">';
}
 
function gconverter_woocommerce_wrapper_end() {
  echo '</div><!-- end of #content-woocommerce -->';
}

?>