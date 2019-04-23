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

<?php
                    wp_nav_menu(array('theme_location' => 'sub-header-menu'));
                    ?>
                    
                   
<!-- end of #widgets -->