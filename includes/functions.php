<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        gConverter 
 * @filesource     wp-content/themes/gconverter/includes/functions.php
 */
?>
<?php
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
    function post_is_in_descendant_category( $cats, $_post = null ) {
        foreach ( (array) $cats as $cat ) {
            // get_term_children() accepts integer ID only
            $descendants = get_term_children( (int) $cat, 'category' );
            if ( $descendants && in_category( $descendants, $_post ) )
                return true;
        }
        return false;
    }
}
update_option( 'link_manager_enabled', 1 );
ini_set("allow_url_fopen", 1);



add_action('after_setup_theme', 'gconverter_setup');

if (!function_exists('gconverter_setup')):

    function gconverter_setup() {

        global $content_width;

        /**
         * Global content width.
         */
        if (!isset($content_width))
            $content_width = 496;

        /**
         * gConverter is now available for translations.
         * Add your files into /languages/ directory.
         * @see http://codex.wordpress.org/Function_Reference/load_theme_textdomain
         */
        load_theme_textdomain('gconverter', get_template_directory() . '/languages');

        $locale = get_locale();
        $locale_file = get_template_directory() . '/languages/$locale.php';
        if (is_readable($locale_file))
            require_once( $locale_file);

        /**
         * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
         * @see http://codex.wordpress.org/Function_Reference/add_editor_style
         */
        add_editor_style('includes/custom-editor-style.css');

        /**
         * This feature enables post and comment RSS feed links to head.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
         */
        add_theme_support('automatic-feed-links');

        /**
         * This feature enables post-thumbnail support for a theme.
         * @see http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        add_theme_support('post-thumbnails');
        add_image_size( 'home-banner', 960, 260, true ); //500 pixels wide 260 height, croped
        add_image_size( 'site-image', 496, 196, true ); //496 pixels wide 196 height, croped
        add_image_size( 'leve-3', 496, 100, true ); //496 pixels wide 100 height, croped
        add_image_size( 'doc-thumb', 80 ); //80 pixels wide 
        add_image_size( 'portrait-team', 145, 90, true ); //145 pixels wide 90 height, croped
        add_image_size( 'sidebar', 150 ); //150 pixels wide 
        add_image_size( 'home-news', 150, 212, true ); //150 pixels wide 212 height, croped
          


 
function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'doc-thumb' => __( 'Dokument Vorschau' ),
         'portrait-team' => __( 'Teamportraits Querformat' ),
         'sidebar' => __( 'Seitenleiste' ),


    ) );
}

add_filter( 'image_size_names_choose', 'my_custom_sizes' );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 100;' ), 20 );




        /**
         * This feature enables custom-s support for a theme.
         * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
         */
        register_nav_menus(array(
            'top-menu' => __('Top Menu', 'gconverter'),
            'header-menu' => __('Header Menu', 'gconverter'),
                        'sitemap' => __('Sitemap Darstellung', 'gconverter'),
            'sub-header-menu' => __('Sub-Header Menu', 'gconverter'),
            'footer-menu' => __('Footer Menu', 'gconverter')
                )
        );




        // WordPress 3.4 >
        if (function_exists('get_custom_header')) {

            add_theme_support('custom-header', array(
                // Header image default
                // Header text display default
                'header-text' => false,
                // Header image flex width
                'flex-width' => true,
                // Header image width (in pixels)
                'width' => 960,
                // Header image flex height
                'flex-height' => true,
                // Header image height (in pixels)
                'height' => 261,
                // Admin header style callback
                'admin-head-callback' => 'gconverter_admin_header_style'));

            // gets included in the admin header
            function gconverter_admin_header_style() {
                ?><style type="text/css">
                    .appearance_page_custom-header #top-container {
                        background-repeat:no-repeat;
                        border:none;
                    }
                </style><?php
            }

        } else {

            // Backward Compatibility

            /**
             * This feature adds a callbacks for image header display.
             * In our case we are using this to display logo.
             * @see http://codex.wordpress.org/Function_Reference/add_custom_image_header
             */
            define('HEADER_TEXTCOLOR', '');
            define('HEADER_IMAGE', '%s/images/default-logo.png'); // %s is the template dir uri
            define('HEADER_IMAGE_WIDTH', 960); // use width and height appropriate for your theme
            define('HEADER_IMAGE_HEIGHT', 261);
            define('NO_HEADER_TEXT', true);
            ?>
            <style type="text/css">
                #top-container {
                    background-repeat:no-repeat;
                    border:none !important;
                    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
                    height:<?php echo HEADER_IMAGE_HEIGHT; ?>px;
                }
            </style>
            <?php
            add_custom_image_header('', 'gconverter_admin_header_style');
        }
    }

endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function gconverter_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
    
}

add_filter('wp_page_menu_args', 'gconverter_page_menu_args');



/**
 * Remove div from wp_page_menu() and replace with ul.
 */
function gconverter_wp_page_menu($page_markup) {
    preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
    $divclass = $matches[1];
    $replace = array('<div class="' . $divclass . '">', '</div>');
    $new_markup = str_replace($replace, '', $page_markup);
    $new_markup = preg_replace('/^<ul>/i', '<ul class="' . $divclass . '">', $new_markup);
    return $new_markup;
}

add_filter('wp_page_menu', 'gconverter_wp_page_menu');

/**
 * Filter 'get_comments_number'
 * 
 * Filter 'get_comments_number' to display correct 
 * number of comments (count only comments, not 
 * trackbacks/pingbacks)
 *
 * Courtesy of Chip Bennett
 */
function gconverter_comment_count($count) {
    if (!is_admin()) {
        global $id;
        $comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

add_filter('get_comments_number', 'gconverter_comment_count', 0);

/**
 * wp_list_comments() Pings Callback
 * 
 * wp_list_comments() Callback function for 
 * Pings (Trackbacks/Pingbacks)
 */
function gconverter_comment_list_pings($comment) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

/**
 * Override Jetpack's default OpenGraph image.
 * Standard is blank WordPress image (https://s0.wp.com/i/blank.jpg).
 * Christoph Nahr 2015-07-07
 */
add_filter( 'jetpack_open_graph_image_default', function() {
    return 'https://fussverkehr.ch/wordpress/wp-content/uploads/2016/08/cropped-Marke_300dpi-1-270x270.png';
});

/**
 * Sets the post excerpt length to 40 characters.
 * Next few lines are adopted from Coraline
 */
function gconverter_excerpt_length($length) {
    return 55;
}

add_filter('excerpt_length', 'gconverter_excerpt_length');


/**
 * Returns a "Read more" link for excerpts
 */
function gconverter_read_more() {
	if (ICL_LANGUAGE_CODE == 'fr'): {
		return '<div class="read-more"><a href="' . get_permalink() . '">' . __('plus »', 'gconverter') . '</a></div><!-- end of .read-more -->';
	} elseif (ICL_LANGUAGE_CODE == 'it'): {
		return '<div class="read-more"><a href="' . get_permalink() . '">' . __('leggi »', 'gconverter') . '</a></div><!-- end of .read-more -->';
		
	} elseif (ICL_LANGUAGE_CODE == 'de'): {
		return '<div class="read-more"><a href="' . get_permalink() . '">' . __('mehr »', 'gconverter') . '</a></div><!-- end of .read-more -->';
	} else: {
    return '<div class="read-more"><a href="' . get_permalink() . '">' . __('read more »', 'gconverter') . '</a></div><!-- end of .read-more -->';} endif;
//    return '<div class="read-more"><a href="' . get_permalink() . '">' . __('Read more &#8250;', 'gconverter') . '</a></div><!-- end of .read-more -->';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and gconverter_read_more_link().
 */
function gconverter_auto_excerpt_more($more) {
    return '<span class="ellipsis">&hellip;</span>' . gconverter_read_more();
}

add_filter('excerpt_more', 'gconverter_auto_excerpt_more');

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 */
function gconverter_custom_excerpt_more($output) {
    if (has_excerpt() && !is_attachment()) {
        $output .= gconverter_read_more();
    }
    return $output;
}

add_filter('get_the_excerpt', 'gconverter_custom_excerpt_more');

/**
 * This function removes inline styles set by WordPress gallery.
 */
function gconverter_remove_gallery_css($css) {
    return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
}

add_filter('gallery_style', 'gconverter_remove_gallery_css');

/**
 * This function removes default styles set by WordPress recent comments widget.
 */
function gconverter_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('widgets_init', 'gconverter_remove_recent_comments_style');
function language_selector_flags() {
    $languages = icl_get_languages('skip_missing=0&orderby=code&order=DESC');
    if (!empty($languages)) {
        foreach ($languages as $l) {
            if (!$l['active'])
                echo '<a href="' . $l['url'] . '" class="lang-selector">';
            echo '&nbsp;&nbsp;'.strtoupper($l['language_code']) .'&nbsp;&nbsp;|';//'<img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" />';
            if (!$l['active'])
                echo '</a>';
        }
    }
}



/**
 * Breadcrumb Lists
 * Allows visitors to quickly navigate back to a previous section or the root page.
 *
 * Courtesy of Dimox
 *
 * bbPress compatibility patch by Dan Smith
 */
function gconverter_breadcrumb_lists() {

    $chevron = '<span class="chevron">&#8250;</span>';
    $home = __('Home', 'gconverter'); // text for the 'Home' link
    $before = '<span class="breadcrumb-current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    if (true) {

        echo '<div class="breadcrumb-list">';

        global $post;
        $homeLink = home_url();
        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $chevron . ' ';

        if (is_category()) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0)
                echo(get_category_parents($parentCat, TRUE, ' ' . $chevron . ' '));
            echo $before . __('Archive for ', 'gconverter') . single_cat_title('', false) . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $chevron . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $chevron . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $chevron . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
                echo $before . get_the_title() . $after;
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $chevron . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb)
                echo $crumb . ' ' . $chevron . ' ';
            echo $before . get_the_title() . $after;
        } elseif (is_search()) {
            echo $before . __('Search results for ', 'gconverter') . get_search_query() . $after;
        } elseif (is_tag()) {
            echo $before . __('Posts tagged ', 'gconverter') . single_tag_title('', false) . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . __('All posts by ', 'gconverter') . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . __('Error 404 ', 'gconverter') . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __('Page', 'gconverter') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}

/**
 * A safe way of adding JavaScripts to a WordPress generated page.
 */
if (!is_admin())
    add_action('wp_enqueue_scripts', 'gconverter_js');

if (!function_exists('gconverter_js')) {

    function gconverter_js() {
        // JS at the bottom for fast page loading. 
        // except for Modernizr which enables HTML5 elements & feature detects.
    }

}



/**
 * A comment reply.
 */
/**function gconverter_enqueue_comment_reply() {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'gconverter_enqueue_comment_reply');*/

/**
 * Where the post has no post title, but must still display a link to the single-page post view.
 */
add_filter('the_title', 'gconverter_title');

function gconverter_title($title) {
    if ($title == '') {
        return __('Untitled', 'gconverter');
    } else {
        return $title;
    }
}

/**
 * Theme Options Support and Information
 */
function gconverter_theme_support() {
    ?>

    <div id="info-box-wrapper" class="grid col-940">
        <div class="info-box notice">
            <a class="blue button" href="<?php echo esc_url(__('https://gconverter.com/rfq-theme/', 'gconverter')); ?>" title="<?php esc_attr_e('Request for Theme Conversion Quote', 'gconverter'); ?>" target="_blank">
                <?php printf(__('Request for Theme Conversion Quote', 'gconverter')); ?></a>

            <a class="blue button" href="<?php echo esc_url(__('http://gconverter.com/theme-conversion-estimator/', 'gconverter')); ?>" title="<?php esc_attr_e('Theme Conversion Estimator', 'gconverter'); ?>" target="_blank">
                <?php printf(__('Theme Conversion Estimator', 'gconverter')); ?></a>

            <a class="gray button" href="<?php echo esc_url(__('https://gconverter.com/rfq/', 'gconverter')); ?>" title="<?php esc_attr_e('Request for CMS and Forum Database Conversion Quote', 'gconverter'); ?>" target="_blank">
                <?php printf(__('Request for CMS and Forum Database Conversion Quote', 'gconverter')); ?></a>

            <a class="gray button" href="<?php echo esc_url(__('http://gconverter.com/portfolio/', 'gconverter')); ?>" title="<?php esc_attr_e('Portfolio', 'gconverter'); ?>" target="_blank">
                <?php printf(__('Portfolio', 'gconverter')); ?></a>

        </div>
    </div>

    <?php
}

add_action('gconverter_theme_options', 'gconverter_theme_support');

/**
 * WordPress Widgets start right here.
 */
function gconverter_widgets_init() {

    register_sidebar(array(
        'name' => __('Main Sidebar', 'gconverter'),
        'description' => __('Area 1 - sidebar.php', 'gconverter'),
        'id' => 'main-sidebar',
        'before_title' => '<!--',
        'after_title' => '-->',
        'before_widget' => '',
        'after_widget' => ''
    ));

    register_sidebar(array(
        'name' => __('Right Sidebar', 'gconverter'),
        'description' => __('Area 2 - sidebar-right.php', 'gconverter'),
        'id' => 'right-sidebar',
        'before_title' => '<!--',
        'after_title' => '-->',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Left Sidebar', 'gconverter'),
        'description' => __('Area 3 - sidebar-left.php', 'gconverter'),
        'id' => 'left-sidebar',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));


    register_sidebar(array(
        'name' => __('Home Widget 1', 'gconverter'),
        'description' => __('Area 6 - sidebar-home.php', 'gconverter'),
        'id' => 'home-widget-1',
        'before_title' => '<!--',
        'after_title' => '-->',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Home Widget 2', 'gconverter'),
        'description' => __('Area 7 - sidebar-home.php', 'gconverter'),
        'id' => 'home-widget-2',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));

    register_sidebar(array(
        'name' => __('Home Widget 3', 'gconverter'),
        'description' => __('Area 8 - sidebar-home.php', 'gconverter'),
        'id' => 'home-widget-3',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));

    register_sidebar(array(
        'name' => __('Footer Widget 1', 'gconverter'),
        'description' => __('Area 10 - sidebar-footerx.php', 'gconverter'),
        'id' => 'footerx-widget-1',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));

    register_sidebar(array(
        'name' => __('Footer Widget 2', 'gconverter'),
        'description' => __('Area 11 - sidebar-footerx.php', 'gconverter'),
        'id' => 'footerx-widget-2',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));

    register_sidebar(array(
        'name' => __('Footer Widget 3', 'gconverter'),
        'description' => __('Area 12 - sidebar-footerx.php', 'gconverter'),
        'id' => 'footerx-widget-3',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));

    register_sidebar(array(
        'name' => __('Footer Widget 4', 'gconverter'),
        'description' => __('Area 13 - sidebar-footerx.php', 'gconverter'),
        'id' => 'footerx-widget-4',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget' => ''
    ));
}

add_action('widgets_init', 'gconverter_widgets_init');

add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'event' ), // Don't display products in the knives category on the shop page
			'operator' => 'NOT IN'
		)));
	
	}

	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}



/*add_action('wp_enqueue_scripts', 'load_addons');*/

add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 5);




add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
	if ( $product && $product->is_type( 'simple' ) && ! $product->is_sold_individually() ) {
		$html .= woocommerce_quantity_input( array(), $product, true );

	}
	return $html;
}

function custom_variation_price( $price, $product ) {

	$price = '';

	if ( $product->min_variation_price == 0 and !$product->min_variation_price || $product->min_variation_price !== $product->max_variation_price ) {
	if (ICL_LANGUAGE_CODE=='it')	{ $price .= '<span class="from">Download: gratuito</span><br/ ><span class="to">' . _x('Stampato:', 'max_price', 'woocommerce') . ' </span>'; }
	elseif (ICL_LANGUAGE_CODE=='fr')	{ $price .= '<span class="from">Télécharger: gratuit!</span><br/ ><span class="to">' . _x('Imprimé:', 'max_price', 'woocommerce') . ' </span>'; }
	elseif (ICL_LANGUAGE_CODE=='de')	{ $price .= '<span class="from">Download: Kostenlos!</span><br/ ><span class="to">' . _x('Gedruckt:', 'max_price', 'woocommerce') . ' </span>'; }
		$price .= woocommerce_price($product->max_variation_price);
	}

	return $price;
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


add_action( 'template_redirect', 'my_theme_thankyou_removal' );
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

function sv_conditional_email_recipient( $recipient, $order ) {
	// Bail on WC settings pages since the order object isn't yet set yet
	// Not sure why this is even a thing, but shikata ga nai
	$page = $_GET['page'] = isset( $_GET['page'] ) ? $_GET['page'] : '';
	if ( 'wc-settings' === $page ) {
		return $recipient; 
	}
	
	// just in case
	if ( ! $order instanceof WC_Order ) {
		return $recipient; 
	}
	$items = $order->get_items();
	
	// check if a shipped product is in the order	
	foreach ( $items as $item ) {
		$product = $order->get_product_from_item( $item );
		
		// add our extra recipient if there's a shipped product - commas needed!
		// we can bail if we've found one, no need to add the recipient more than once
		if ( $product && $product->needs_shipping() ) {
			$recipient .= ', newsletter@fussverkehr.ch';
			return $recipient;
		}
	}
	
	return $recipient;
}
add_filter( 'woocommerce_email_recipient_new_order', 'sv_conditional_email_recipient', 10, 2 );
function page_category_settings() {  
// Add category metabox to page
register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'init', 'page_category_settings' );

add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'get_encryptx_meta', 'shortcode_unautop' );
add_filter( 'get_encryptx_meta', 'do_shortcode' );
add_filter( 'the_meta', 'shortcode_unautop' );
add_filter( 'the_meta', 'do_shortcode' );

function modify_post_mime_types($post_mime_types) {
    $post_mime_types['application/pdf'] = array(__('PDF'), __('Manage PDF'), _n_noop('PDF <span class="count">(%s)</span>', 'PDF <span class="count">(%s)</span>'));
    return $post_mime_types;
}
add_filter('post_mime_types', 'modify_post_mime_types');


?>