<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Version Control
 *
 *
 * @file           version.php
 * @package        WordPress 
 * @subpackage     gConverter 
 * @version        Release: 1.1
 * @filesource     wp-content/themes/gconverter/includes/version.php
 * @link           N/A
 */
?>
<?php
if ( function_exists('wp_get_theme')) {
	
function gconverter_template_data() {
    echo '<!-- We need this for debugging -->' . "\n";
    echo '<meta name="template" content="' . get_gconverter_template_name() . ' ' . get_gconverter_template_version() . '" />' . "\n";
}
 
add_action('wp_head', 'gconverter_template_data');

function gconverter_theme_data() {
    if ( is_child_theme() ) {
        echo '<meta name="theme" content="' . get_gconverter_theme_name() . ' ' . get_gconverter_theme_version() . '" />' . "\n";
    }
}

add_action('wp_head', 'gconverter_theme_data');

function get_gconverter_theme_name() {
	$theme = wp_get_theme();
	return $theme->Name;
}

function get_gconverter_theme_version() {
	$theme = wp_get_theme();
	return $theme->Version;	
}

function get_gconverter_template_name() {
	$theme = wp_get_theme();
	$parent = $theme->parent();
	if ( $parent )
		$theme = $parent;
	
	return $theme->Name;
}

function get_gconverter_template_version() {
	$theme = wp_get_theme();
	$parent = $theme->parent();
	if ( $parent )
		$theme = $parent;

	return $theme->Version;	
}

} else {
	
/**
 * < 3.4 Backward Compatibility
 */
	
$theme_data = get_theme_data(STYLESHEETPATH . '/style.css');
define('gconverter_current_theme', $theme_name = $theme_data['Name']);

function gconverter_template_data() {

    $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
    $gconverter_template_name = $theme_data['Name'];
    $gconverter_template_version = $theme_data['Version'];

    echo '<!-- We need this for debugging -->' . "\n";
    echo '<meta name="template" content="' . $gconverter_template_name . ' ' . $gconverter_template_version . '" />' . "\n";
}

add_action('wp_head', 'gconverter_template_data');

function gconverter_theme_data() {
    if (is_child_theme()) {
        $theme_data = get_theme_data(STYLESHEETPATH . '/style.css');
        $gconverter_theme_name = $theme_data['Name'];
        $gconverter_theme_version = $theme_data['Version'];

        echo '<meta name="theme" content="' . $gconverter_theme_name . ' ' . $gconverter_theme_version . '" />' . "\n";
    }
}

add_action('wp_head', 'gconverter_theme_data');
}