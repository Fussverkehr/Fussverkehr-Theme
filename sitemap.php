<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Sitemap Template
 *
  Template Name: Sitemap
 *
 * @file           sitemap.php
 * @package        gConverter 
 * @filesource     wp-content/themes/gconverter/sitemap.php
 */
?>
<?php get_header(); ?>
<div id="sub-nav" role="tooltip">
    <?php get_sidebar('left'); ?>
</div>
<div id="content">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

             <div id="post-<?php the_ID(); ?>" class="csc-default">
                 <?php if (has_post_thumbnail()) : ?>
                     <?php the_post_thumbnail('site-image', array('class' => 'post_header_image')); ?>               
                 <?php endif; ?>
                                <div class="post-entry">

                <h1 class="post-title"><?php the_title(); ?></h1> 

                    <?php
                    wp_nav_menu(array('theme_location' => 'sitemap'));
                    ?>
                    
								</div></div>

        <?php endwhile; ?> 

        

    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
        <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
        <?php get_search_form(); ?>

    <?php endif; ?>  

</div><!-- end of #content-sitemap -->
<div id="border">
        <?php echo get_post_custom_values("right_sidebar", get_the_id())[0]; ?>
    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>