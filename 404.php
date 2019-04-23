<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Error 404 Template
 */
?>
<?php get_header(); ?>

        <div id="content-full" class="col-940" height="200px">
       <?php flush_rewrite_rules( $hard ); 
       wp_cache_flush();
       ?>
        <script>
 jQuery(document).ready(function(){
 setInterval(function(){cache_clear()},4000);
 });
 function cache_clear()
{
    if (window.location.href.toLowerCase().indexOf("loaded") < 0) {
        window.location = window.location.href + '?loaded=1';
		
        }
}
</script>
            <div id="content" class="error404" float="none">
                <div class="post-entry">
                    <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
                    <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
                    <h6><?php _e( 'You can return', 'gconverter' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'gconverter' ); ?>"><?php _e( '&larr; Home', 'gconverter' ); ?></a> <?php _e( 'or search for the page you were looking for', 'gconverter' ); ?></h6>
                    <?php get_search_form(); ?>
                </div><!-- end of .post-entry -->
            </div><!-- end of #post-0 -->
        </div><!-- end of #content-full -->

<?php get_footer(); ?>