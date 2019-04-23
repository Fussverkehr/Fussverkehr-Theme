<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 *
 * load the theme function files
 */
require ( get_template_directory() . '/includes/functions.php' );
require ( get_template_directory() . '/includes/theme-options.php' );
require ( get_template_directory() . '/includes/hooks.php' );
require ( get_template_directory() . '/includes/version.php' );

//require ( get_template_directory() . '/includes/plugin-metabox-upload-a.php' );
//require ( get_template_directory() . '/includes/plugin-metabox-input-a.php' );
/* * ****************************************************************|
 *
 *
 *
 */


####################################################################
//Custom Functions//////////////////////////////////////////////////
/* * ****************************************************************|
 *
 * Indicate current page/post true/false by slug
 *
 */
function gconverter_current_post($slug, $boolean = true) {
    global $post;
    if ($parent->post_name == $slug) {
        if ($boolean) {
            return true;
        } else {
            echo 'gcurrent';
        }
    } else {
        if ($boolean) {
            return false;
        } else {
            echo '';
        }
    }
}

/* * ****************************************************************|
 *
 * Returns post/page permalink by slug
 *
 */

function gconverter_pagelinkbyslug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) :
        return get_permalink($page->ID);
    else :
        return "#";
    endif;
}

/* * ****************************************************************|
 *
 * Loads CSS Post ID specidfic CSS files from /css/ directory
 *
 */

function gconverter_local_css() {
    global $post;
    if (file_exists(TEMPLATEPATH . '/css/' . $post->ID . '.css')) {
        echo '<link rel="stylesheet" type="text/css" media="screen" href="' . get_bloginfo('template_url') . '/css/' . $post->ID . '.css">';
    }
}

/* * ****************************************************************|
 *
 * Returns post's first image URL or HTML
 *
 */

function gconverter_first_image($content, $mode = 'html-link', $class = array('alignleft')) {
    global $post;

    preg_match('|<img[^\><]+?src[\r\n\t\s]*\=[\r\n\t\s]*[\'\"]+([^\\\'\"]+)[\'\"]+[^\><]+?>|is', $content, $image_array);
    $url = $image_array[1];

    if ($url) {
        if ($mode == 'html-link') {
            $html = '<a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '" ><img src="' . $url . '" class="' . implode(' ', $class) . '"/></a>';
            return $html;
        } elseif ($mode == 'html-img') {
            $html = '<img src="' . $url . '" class="' . implode(' ', $class) . '"/>';
            return $html;
        } elseif ($mode == 'url') {
            return $url;
        }
    } else {
        return false;
    }
}

/* * ****************************************************************|
 *
 * Different manipulations with current category. 
 * This function can only be used in archive.php. Example gc_category( array(20, 25, 36) )
 * 
 * @param	mixed   different data for diferent modes | for is_catid - array of category IDs to match
 *
 */

function gc_check_current_category($category_id_array) {

    $cur_cat_id = get_cat_id(single_cat_title("", false));
    if (in_array($cur_cat_id, $data)) {
        return true;
    } else {
        return false;
    }
}

/* * ****************************************************************|
 *
 * Returns current logged in user data | use with is_user_logged_in()
 * 
 *  Modes:
 * 'username'
 * 'email'
 * 'fname'
 * 'lname'
 * 'dname'
 * 'id'
 *
 */

function gc_current_user($mode = 'id') {
    global $current_user;
    get_currentuserinfo();
    if ($mode == 'username') {
        return $current_user->user_login;
    } elseif ($mode == 'fname') {
        return $current_user->user_firstname;
    } elseif ($mode == 'lname') {
        return $current_user->user_lastname;
    } elseif ($mode == 'dname') {
        return $current_user->display_name;
    } elseif ($mode == 'id') {
        return $current_user->ID;
    }
}

/* * ****************************************************************|
 *
 * Returns the page list with current page subpages
 * $page_options['sort_column'] = 'menu_order,post_title';
 * $page_options['show_siblings'] = 'yes';
 * $page_options['show_root'] = 'yes';
 * echo parent_child_page_list($page_options);
 *
 */

function parent_child_page_list($args = '') {
    global $post;
    global $wp_query;
    $output = '';
    $pages = & get_pages($args);
    $page_info = array();
    if ($pages) {
        $current_post = $wp_query->get_queried_object_id();
        foreach ($pages as $page) {
            $page_info[$page->ID]['parent'] = $page->post_parent;
            $page_info[$page->post_parent]['children'][] = $page->ID;
        }
        $front_page = -1;
        if ('page' == get_option('show_on_front')) {
            $front_page = get_option('page_on_front');
            if (($args['show_home'] == 'yes') || (sizeof($page_info[$front_page]['children']))) {
                $page_info[$front_page]['show'] = 1;
            }
        }
        if ($args['show_root'] == 'yes') {
            foreach ($page_info[0]['children'] as $child) {
                if ($child != $front_page) {
                    $page_info[$child]['show'] = 1;
                }
            }
        }
        if (is_page()) {
            if ($post->ID != $front_page) {
                $page_info[$post->ID]['show'] = 1;
            }
            if (is_array($page_info[$current_post]['children'])) {
                foreach ($page_info[$current_post]['children'] as $child) {
                    $page_info[$child]['show'] = 1;
                }
            }
            $post_parent = $page_info[$current_post]['parent'];
            if ($post_parent && ($args['show_siblings'] == 'yes')) {
                foreach ($page_info[$post_parent]['children'] as $child) {
                    if ($child != $front_page) {
                        $page_info[$child]['show'] = 1;
                    }
                }
                $post_grandparent = $page_info[$post_parent]['parent'];
                if ($post_grandparent) {
                    foreach ($page_info[$post_grandparent]['children'] as $child) {
                        if ($child != $front_page) {
                            $page_info[$child]['show'] = 1;
                        }
                    }
                }
            }
            while ($post_parent) {
                $page_info[$post_parent]['show'] = 1;
                $post_parent = $page_info[$post_parent]['parent'];
            }
        }
        $my_includes = array();
        foreach ($pages as $page) {
            if ($page_info[$page->ID]['show']) {
                $my_includes[] = $page->ID;
            }
        }
        if ($args['child_of']) {
            $my_includes[] = $args['child_of'];
        }
        if (!empty($my_includes)) {
            // List pages, if any. Blank title_li suppresses unwanted elements.
            $output .= wp_list_pages(array('title_li' => '',
                'sort_column' => $args['sort_column'],
                'sort_order' => $args['sort_order'],
                'include' => $my_includes,
                'echo' => 0)
            );
        }
    }

    $output = apply_filters('wp_list_pages', $output);
    return $output;
}

// DRUPAL FUNCTIONS
/////////////////////////////////////////////
// Returns Youtube Video Keys from Post Meta data (Custom Fields)
function gconverter_post_videos($postid) {

    global $wpdb;
    $ykes = array();

    $yvs = $wpdb->get_results("SELECT `meta_value` FROM `" . $wpdb->prefix . "postmeta` WHERE `post_id` = $postid AND (`meta_key` = 'Video' OR `meta_key` = 'Youtube Videos')");
    foreach ($yvs as $yv) {
        $vos = explode(',', $yv->meta_value);
        foreach ($vos as $vo) {
            $videos[] = trim($vo);
        }
    }
    foreach ($videos as $video) {
        if (preg_match('#(?<=(?:v|i)=)[a-zA-Z0-9-]+(?=&)|(?<=(?:v|i)\/)[^&\n]+|(?<=embed\/)[^"&\n]+|(?<=(?:v|i)=)[^&\n]+|(?<=youtu.be\/)[^&\n]+#i', $video, $vurl)) {
            $ykes[] = $vurl[0];
        }
    }
    $ykes = array_unique($ykes);
    return $ykes;
}

/////////////////////////////////////////////
// Returns First Image URL from Post Meta data (Custom Fields) or Post Content
function gconverter_post_image($postid, $content = '') {
    $image = '';
    $keys = array('field_body_image_fid', 'field_body_image_fid_0', 'field_event_image_fid', 'field_feature_image_fid', 'field_prominent_sponsor_image_fid', 'field_gallery_image_fid_0');
    foreach ($keys as $key) {
        $url = get_post_meta($postid, $key, true);
        if ($url)
            break;
    }
    if ($url == '') {
        $url = gconverter_first_image($content, 'url', array('alignleft', 'gc_first_image', 'imagecache', 'imagecache-square_large', 'imagecache-default', 'imagecache-square_large_default'));
    }
    $url = trim($url, '/');
    return str_replace(trim(get_bloginfo('siteurl'), '/'), '', $url);
}

/////////////////////////////////////////////
// Returns All Images URLs from Post Meta data (Custom Fields) or Post Content
function gconverter_post_images($postid, $content = '') {
    $image = '';
    $keys = array(
        'field_gallery_image_fid_0',
        'field_gallery_image_fid_1',
        'field_gallery_image_fid_2',
        'field_gallery_image_fid_3',
        'field_gallery_image_fid_4',
        'field_gallery_image_fid_5',
        'field_gallery_image_fid_6',
        'field_gallery_image_fid_7',
        'field_gallery_image_fid_8',
        'field_gallery_image_fid_9',
        'field_gallery_image_fid_10');
    foreach ($keys as $key) {
        $url = get_post_meta($postid, $key, true);
        if ($url)
            $urls[] = $url;
    }
    if (empty($urls)) {
        $urls[] = gconverter_first_image($content, 'url', array('alignleft', 'gc_first_image', 'imagecache', 'imagecache-square_large', 'imagecache-default', 'imagecache-square_large_default'));
    }
    foreach ($urls as $item) {
        $item = trim($item, '/');
        $item = str_replace(trim(get_bloginfo('siteurl'), '/'), '', $item);
        $item = trim(get_bloginfo('siteurl'), '/') . '/' . $item;
        $items[] = $item;
    }

    return $items;
}

function getpagenavi() {
    ?>
    <?php if (function_exists('wp_pagenavi')) : ?>
        <?php wp_pagenavi() ?>
    <?php else : ?>
        <div class="alignleft">
            <?php next_posts_link(__('&laquo; Older Entries', 'web2feeel')) ?>
        </div>
        <div class="alignright">
            <?php previous_posts_link(__('Newer Entries &raquo;', 'web2feel')) ?>
        </div>
        <div class="clear"></div>
    <?php endif; ?>
    <?php
}



function get_post_root_parent_id($post_id) {
    $parent_id = get_post($post_id)->post_parent;
    if ($parent_id == 0) {
        return $post_id;
    } else {
        return get_post_root_parent_id($parent_id);
    }
}

function initChildren($args = array()) {
    global $post;
    $root_id = get_post_root_parent_id($post->ID);
    $defaultArgs = array('depth' => 1);
    $parsedArgs = wp_parse_args($args, $defaultArgs);
    if (is_page()) {
        $parents = get_post_ancestors($post->ID);
        $parent = ($parents) ? $parents[count($parents) - 1] : $post->ID;
        $pages = get_pages('parent=0');
        if ($pages) {
            $pageids = array();
            foreach ($pages as $page) {
                if ($page->ID == $root_id) :
                    $pageids[] = $page->ID;
                endif;
                if ($page->ID == $parent) {

                    $children = get_pages('child_of=' . $parent);
                    if ($children) {
                        foreach ($children as $child) {
                            if ($child->post_parent == $parent) {
                                $pageids[] = $child->ID;
                            }
                            if (in_array($child->post_parent, $parents)) {
                                $pageids[] = $child->ID;
                            }
                            if ($child->post_parent == $post->ID) {
                                $pageids[] = $child->ID;
                            }
                        }
                    }
                }
            }

            $pageids = array_unique($pageids);
            $parsedArgs = array('include' => $parent . ',' . implode(",", $pageids));
        }
    }
    $parsedArgs['title_li'] = '';
    $parsedArgs['sort_column'] = 'post_title';
    $parsedArgs['sort_order'] = 'ASC';
    ?>
    <ul class="dynamic-pages">
        <?php wp_list_pages($parsedArgs); ?>
    </ul>
    <?php
}

remove_action('wp_head', 'wp_generator');?>
