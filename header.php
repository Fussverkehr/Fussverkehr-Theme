<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Header Template
 */
?>
<!DOCTYPE html>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>

        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="google-site-verification" content="falBJDR8wiyqPApztkZZvc3yL77BjX0zjaJRTzwZ35I" />
        <title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-files/fileadmin/templates/styles/styles.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-files/home/print.css" media="print"/>
        <?php wp_enqueue_style('gconverter-style', get_stylesheet_uri(), false, '1.7.5'); 
        wp_enqueue_script(‘jquery’);?>
		<?php wp_head(); ?>
        <?php gconverter_local_css(); ?>

        
       <!-- <script src="<?php echo get_template_directory_uri(); ?>/theme-files/home/ga.js" async="" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/theme-files/home/prototype.js" type="text/javascript"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/theme-files/home/javascript_0b12553063.txt" type="text/javascript"></script>-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0"/>
        
        
       

    </head>
    <body>



        <div id="service-nav">
        
                               <?php get_search_form(); 

                
                $top_menu_args = array(
                    'theme_location' => 'top-menu',
                );
                wp_nav_menu($top_menu_args);
                ?>
                                <div id="flags_language_selector"><?php echo language_selector_flags(); ?></div >

        </div>
        <div id="wrapper">
            <div id="header" class="gfx">
                    <div id="logo"><a href="<?php echo home_url(); ?>"><div class="logo-<?php echo ICL_LANGUAGE_CODE ?>"></div></a></div>
                    <div id="print-logo">
                        <a href="https://fussverkehr.ch/"><img src="<?php echo get_template_directory_uri(); ?>/theme-files/home/logo-bw.jpg" alt=""/></a>
                    </div>
                </div>
                <div id="main-nav">
                
            <?php
                $main_menu_args = array(
                    'theme_location' => 'header-menu',
                    'container' => 'div',
                    'container_class' => 'main-nav',
                    'menu_class' => 'menu ts_nav',
                    'menu_id' => 'ts_nav',
'depth' => 1,
                );
                wp_nav_menu($main_menu_args);
                ?>  </div>    <input type="checkbox" id="nav-trigger" class="nav-trigger" role="tooltip">    
                               
                <label class="nav-trigger" for="nav-trigger">Menu</label>                    
            <?php if (!is_home()) { ?>
                <div id="main-container">
                <?php } ?>