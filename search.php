<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Search Template
 *
 * @link           http://codex.wordpress.org/Theme_Development#Search_Results_.28search.php.29
 */
?>
<?php get_header(); ?>
<div id="sub-nav" role="tooltip">
    <?php get_sidebar('left'); ?>
</div>
<div id="content">
    <?php if (have_posts()) : ?>
        <div class="csc-default" id="c1253">
            <div class="csc-header csc-header-n3">

                    <h1><?php printf(__('Search Results for: %s', 'gconverter'), '<span>' . get_search_query() . '</span>'); ?></h1>

            </div>
        </div>
        <div id="c229" class="csc-default">
            <div class="news-list-container">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="news-list-item">				
                        <h2>
                            <span class="news-list-date"><?php the_time('d.m.Y'); ?></span>
                            <a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail', array('class' => 'alignleft cat-post-img')); ?></a>
                        <?php else: ?>
                            <?php echo gconverter_first_image(get_the_content(), 'html-link', array('alignleft', 'gc_first_image', 'cat-post-img')); ?>
                        <?php endif; ?>
                        <p class="bodytext">
                            <?php the_excerpt(); ?>
                        </p>
                        <hr class="clearer">
                        <div class="post-edit"><?php edit_post_link(__('Edit', 'gconverter')); ?></div>
                    </div>
                <?php endwhile; ?> 
                <script type="text/javascript">
                    jQuery('.cat-post-img').removeClass('alignleft');
                    jQuery('.cat-post-img').removeClass('wp-post-image');
                </script>
                <div class="clear"></div>
                <?php
                if ($wp_query->max_num_pages > 1) :
                    if (function_exists('getpagenavi')) : getpagenavi();
                    endif;
                endif;
                ?> 
                <div class="clear"></div>
            </div>
        </div>
    <?php else : ?>
        <h3 class="title-404"><?php _e('Your search for', 'gconverter'); ?> <?php the_search_query(); ?> <?php _e('did not match any entries', 'gconverter'); ?></h3>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
        <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
        <?php get_search_form(); ?>

    <?php endif; ?>  

</div><!-- #content -->
<div id="border" class="level-3"><!--TYPO3SEARCH_begin-->
    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>