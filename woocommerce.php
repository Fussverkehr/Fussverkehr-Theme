<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Template Name:  Woocommerce *
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 */

flush_rewrite_rules( $hard );
wp_cache_flush();

 
?>
<?php get_header(); 

?>

<div id="sub-nav" class="shop" role="tooltip">
    <?php get_sidebar('left'); ?>
</div>

<div id="content">
  

<?php if ( have_posts() ) : ?>
<img src="/wordpress/wp-content/uploads/2018/07/Publikation-Header.jpg" alt="" width="496" height="195" />

          <?php woocommerce_content(); ?>
		  
		 

    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
        <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
        <?php get_search_form(); ?>

    <?php endif; ?>  

</div>
<script>
	   
 jQuery(document).ready(function(){
	   
if (jQuery('#content').height() < 300 && window.location.href.toLowerCase().indexOf("loaded") < 0) {
	          window.location = window.location.href + '?loaded=1'
	      }
	  })
	  </script><!-- end of #content -->
<div id="border">
        <?php echo get_post_custom_values("right_sidebar", get_the_id())[0]; ?>
    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>