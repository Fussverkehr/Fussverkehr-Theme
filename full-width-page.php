<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Template Name:  Full Width Page (no sidebar)
 */
?>
<?php get_header(); ?>
<div id="sub-nav">
    <?php get_sidebar('left'); ?>
</div>
<div id="content">
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>" class="csc-default">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array('class' => 'alignleft post_header_image')); ?>               
                <?php endif; ?>
                <script type="text/javascript">
                    jQuery('.post_header_image').removeAttr('class');
                </script>
                <div class="post-entry">
                    <?php the_content(__('Read more &#8250;', 'gconverter')); ?>
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'gconverter'), 'after' => '</div>')); ?>
                </div>
                <div class="post-edit"><?php edit_post_link(__('Edit', 'gconverter')); ?></div> 
            </div><!-- end of #post-ID -->
        <?php endwhile; ?> 

    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
        <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
        <?php get_search_form(); ?>

    <?php endif; ?>  

</div><!-- end of #content -->
<div id="border">
        <?php echo get_post_custom_values("right_sidebar", get_the_id())[0]; ?>

    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>