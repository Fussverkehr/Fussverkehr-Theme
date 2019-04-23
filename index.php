<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Index Template
 *
 * @link   http://codex.wordpress.org/Theme_Development#Index_.28index.php.29
 */
?>
<?php get_header(); ?>

        <div id="content">
        
		<?php if (have_posts()) : ?>
        
                <?php while (have_posts()) : the_post(); ?>
                
                    <?php $options = get_option('gconverter_theme_options');  if($options['breadcrumb'] == 0):  echo gconverter_breadcrumb_lists();  endif; ?>
                    <div id="post-<?php the_ID(); ?>">
                        <h1 class="post-title"><?php the_title(); ?></h1>
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
                <h6><?php _e( 'You can return', 'gconverter' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'gconverter' ); ?>"><?php _e( '&larr; Home', 'gconverter' ); ?></a> <?php _e( 'or search for the page you were looking for', 'gconverter' ); ?></h6>
                <?php get_search_form(); ?>

		<?php endif; ?>  
      
        </div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>