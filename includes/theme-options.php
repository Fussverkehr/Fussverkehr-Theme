<?php
error_reporting(0);
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme Options
 *
 *
 * @file           theme-options.php
 * @package        gConverter 
 * @filesource     wp-content/themes/gconverter/includes/theme-options.php
 */

/**
 * Create the options page
 */
function gconverter_theme_options_do_page() {

	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?><div class="wrap">
        <?php  /** * < 3.4 Backward Compatibility */ ?>
        <?php $theme_name = function_exists('wp_get_theme') ? wp_get_theme() : get_current_theme(); ?>
        <?php screen_icon(); echo "<h2>" . $theme_name ." ". __('Theme Options', 'gconverter') . "</h2>"; ?>
        <?php if (false !== $_REQUEST['settings-updated']) : ?>
		<div class="updated fade"><p><strong><?php _e('Options Saved', 'gconverter'); ?></strong></p></div>
		<?php endif; ?>
        <?php gconverter_theme_options(); // Theme Options Hook ?>
        
        <form method="post" action="options.php">
            <?php settings_fields('gconverter_options'); ?>
            <?php $options = get_option('gconverter_theme_options'); ?>
            <div id="rwd" class="grid col-940">
                
                
                <h3 class="rwd-toggle"><a href="#"><?php _e('Theme Elements', 'gconverter'); ?></a></h3>
                <div class="rwd-container">
                    <div class="rwd-block"> 
                    <?php /*** Breadcrumb Lists  */ ?>
                    <div class="grid col-300"><?php _e('Disable Breadcrumb Lists?', 'gconverter'); ?></div><!-- end of .grid col-300 -->
                        <div class="grid col-620 fit">
                            <input id="gconverter_theme_options[breadcrumb]" name="gconverter_theme_options[breadcrumb]" type="checkbox" value="1" <?php isset($options['breadcrumb']) ? checked( '1', $options['breadcrumb'] ) : checked('0', '1'); ?> />
                            <label class="description" for="gconverter_theme_options[breadcrumb]"><?php _e('Check to disable', 'gconverter'); ?></label>
                        </div><!-- end of .grid col-620 -->
                        <div class="grid col-620 fit">
                            <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Options', 'gconverter'); ?>" /></p>
                        </div><!-- end of .grid col-620 -->
                    </div><!-- end of .rwd-block -->
                </div><!-- end of .rwd-container -->


                <h3 class="rwd-toggle"><a href="#"><?php _e('Webmaster Tools', 'gconverter'); ?></a></h3>
                <div class="rwd-container">
                    <div class="rwd-block"> 
                     <?php /*** Google Site Verification*/ ?>
                    <div class="grid col-300"><?php _e('Google Site Verification', 'gconverter'); ?></div><!-- end of .grid col-300 -->
                        <div class="grid col-620 fit">
                            <input id="gconverter_theme_options[google_site_verification]" class="regular-text" type="text" name="gconverter_theme_options[google_site_verification]" value="<?php if (!empty($options['google_site_verification'])) echo esc_attr($options['google_site_verification']); ?>" />
                            <label class="description" for="gconverter_theme_options[google_site_verification]"><?php _e('Enter your Google ID number only', 'gconverter'); ?></label>
                        </div><!-- end of .grid col-620 -->
                    <?php  /*** Bing Site Verification */ ?>
                    <div class="grid col-300"><?php _e('Bing Site Verification', 'gconverter'); ?></div><!-- end of .grid col-300 -->
                        <div class="grid col-620 fit">
                            <input id="gconverter_theme_options[bing_site_verification]" class="regular-text" type="text" name="gconverter_theme_options[bing_site_verification]" value="<?php if (!empty($options['bing_site_verification'])) echo esc_attr($options['bing_site_verification']); ?>" />
                            <label class="description" for="gconverter_theme_options[bing_site_verification]"><?php _e('Enter your Bing ID number only', 'gconverter'); ?></label>
                        </div><!-- end of .grid col-620 -->
                    <?php /** * Yahoo Site Verification */ ?>
                    <div class="grid col-300"><?php _e('Yahoo Site Verification', 'gconverter'); ?></div><!-- end of .grid col-300 -->
                        <div class="grid col-620 fit">
                            <input id="gconverter_theme_options[yahoo_site_verification]" class="regular-text" type="text" name="gconverter_theme_options[yahoo_site_verification]" value="<?php if (!empty($options['yahoo_site_verification'])) echo esc_attr($options['yahoo_site_verification']); ?>" />
                            <label class="description" for="gconverter_theme_options[yahoo_site_verification]"><?php _e('Enter your Yahoo ID number only', 'gconverter'); ?></label>
                        </div><!-- end of .grid col-620 -->
                    <?php /** * Site Statistics Tracker */ ?>
                    <div class="grid col-300">
                        <?php _e('Site Statistics Tracker', 'gconverter'); ?>
                        <span class="help-links"><?php _e('Leave blank if plugin handles your webmaster tools', 'gconverter'); ?></span>
                    </div><!-- end of .grid col-300 -->
                        <div class="grid col-620 fit">
                            <textarea id="gconverter_theme_options[site_statistics_tracker]" class="large-text" cols="50" rows="10" name="gconverter_theme_options[site_statistics_tracker]"><?php if (!empty($options['site_statistics_tracker'])) echo esc_textarea($options['site_statistics_tracker']); ?></textarea>
                            <label class="description" for="gconverter_theme_options[site_statistics_tracker]"><?php _e('Google Analytics, StatCounter, any other or all of them.', 'gconverter'); ?></label>
                            <p class="submit">
                            <input type="submit" class="button-primary" value="<?php _e('Save Options', 'gconverter'); ?>" />
                            </p>
                        </div><!-- end of .grid col-620 -->
                    </div><!-- end of .rwd-block -->
                </div><!-- end of .rwd-container -->

            
            </div><!-- end of .grid col-940 -->
        </form>
    </div>
    <?php
}

add_action('admin_init', 'gconverter_theme_options_init');
add_action('admin_menu', 'gconverter_theme_options_add_page');

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
function gconverter_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style('gconverter-theme-options', get_template_directory_uri() . '/includes/theme-options.css', false, '1.0');
	wp_enqueue_script('gconverter-theme-options', get_template_directory_uri() . '/includes/theme-options.js', array('jquery'), '1.0');
}
add_action('admin_print_styles-appearance_page_theme_options', 'gconverter_admin_enqueue_scripts');

/**
 * Init plugin options to white list our options
 */
function gconverter_theme_options_init() {
    register_setting('gconverter_options', 'gconverter_theme_options', 'gconverter_theme_options_validate');
}

/**
 * Load up the menu page
 */
function gconverter_theme_options_add_page() {
    add_theme_page(__('Theme Options', 'gconverter'), __('Theme Options', 'gconverter'), 'edit_theme_options', 'theme_options', 'gconverter_theme_options_do_page');
}

/**
 * Site Verification and Webmaster Tools
 * If user sets the code we're going to display meta verification
 * And if left blank let's not display anything at all in case there is a plugin that does this
 */
 
function gconverter_google_verification() {
    $options = get_option('gconverter_theme_options');
    if (!empty($options['google_site_verification'])) {
		echo '<meta name="google-site-verification" content="' . $options['google_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'gconverter_google_verification');

function gconverter_bing_verification() {
    $options = get_option('gconverter_theme_options');
    if (!empty($options['bing_site_verification'])) {
        echo '<meta name="msvalidate.01" content="' . $options['bing_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'gconverter_bing_verification');

function gconverter_yahoo_verification() {
    $options = get_option('gconverter_theme_options');
    if (!empty($options['yahoo_site_verification'])) {
        echo '<meta name="y_key" content="' . $options['yahoo_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'gconverter_yahoo_verification');

function gconverter_site_statistics_tracker() {
    $options = get_option('gconverter_theme_options');
    if (!empty($options['site_statistics_tracker'])) {
        echo $options['site_statistics_tracker'];
	}
}

add_action('wp_footer', 'gconverter_site_statistics_tracker', 1);

function gconverter_inline_css() {
    $options = get_option('gconverter_theme_options');
    if (!empty($options['gconverter_inline_css'])) {
		echo '<!-- Custom CSS Styles -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
		echo $options['gconverter_inline_css'] . "\n";
		echo '</style>' . "\n";
	}
}

add_action('wp_head', 'gconverter_inline_css');
	

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function gconverter_theme_options_validate($input) {

	// checkbox value is either 0 or 1
	foreach (array(
		'breadcrumb',
		'cta_button'
		) as $checkbox) {
		if (!isset($input[$checkbox]))
			$input[$checkbox] = null;
		    $input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	}
	
    $input['home_headline'] = wp_kses_stripslashes($input['home_headline']);
	$input['home_subheadline'] = wp_kses_stripslashes($input['home_subheadline']);
    $input['home_content_area'] = wp_kses_stripslashes($input['home_content_area']);
    $input['cta_text'] = wp_kses_stripslashes($input['cta_text']);
    $input['cta_url'] = esc_url_raw($input['cta_url']);
    $input['featured_content'] = wp_kses_stripslashes($input['featured_content']);
    $input['google_site_verification'] = wp_filter_post_kses($input['google_site_verification']);
    $input['bing_site_verification'] = wp_filter_post_kses($input['bing_site_verification']);
    $input['yahoo_site_verification'] = wp_filter_post_kses($input['yahoo_site_verification']);
    $input['site_statistics_tracker'] = wp_kses_stripslashes($input['site_statistics_tracker']);
	$input['twitter_uid'] = esc_url_raw($input['twitter_uid']);
	$input['facebook_uid'] = esc_url_raw($input['facebook_uid']);
    $input['linkedin_uid'] = esc_url_raw($input['linkedin_uid']);
	$input['youtube_uid'] = esc_url_raw($input['youtube_uid']);
	$input['stumble_uid'] = esc_url_raw($input['stumble_uid']);
	$input['rss_uid'] = esc_url_raw($input['rss_uid']);
	$input['google_plus_uid'] = esc_url_raw($input['google_plus_uid']);
	$input['instagram_uid'] = esc_url_raw($input['instagram_uid']);
	$input['pinterest_uid'] = esc_url_raw($input['pinterest_uid']);
	$input['yelp_uid'] = esc_url_raw($input['yelp_uid']);
	$input['vimeo_uid'] = esc_url_raw($input['vimeo_uid']);
	$input['foursquare_uid'] = esc_url_raw($input['foursquare_uid']);
	$input['gconverter_inline_css'] = wp_kses_stripslashes($input['gconverter_inline_css']);
	
    return $input;
}

?>