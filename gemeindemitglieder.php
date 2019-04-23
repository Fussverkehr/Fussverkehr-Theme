<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name:  Gemeinde Mitglieder
 */
?>
<?php get_header(); ?>
<div id="main-container">
    <div id="sub-nav" role="tooltip">
       <?php get_sidebar('left'); ?>


    </div>
    <div id="content">

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" class="csc-default">
                <?php if (has_post_thumbnail()) : ?>
                    <div style='clear: both;'></div>

                    <?php the_post_thumbnail('leve-3', array('class' => 'post_header_image')); ?>              
                <?php endif; ?>
                            <div id="c5322" class="csc-default">
                    <?php //$options = get_option('gconverter_theme_options');  if($options['breadcrumb'] == 0):  echo gconverter_breadcrumb_lists();  endif;  ?>
                        
                  
                    <?php the_content(__('Read more &#8250;', 'gconverter'));  ?>
					<p>
					<?php 
					if (ICL_LANGUAGE_CODE == 'fr') {
					    $list1 = 'Les ';
					    $list2 = ' communes suivantes sont membres de Mobilité piétonne Suisse:';
					} elseif (ICL_LANGUAGE_CODE == 'it') {
					    $list1 = 'I seguenti ';
					    $list2 = ' comuni sono affiliati a Mobilità pedonale Svizzera.';
					} elseif (ICL_LANGUAGE_CODE == 'en') {
					    $list1 = 'The following ';
					    $list2 = ' Cities are member of Pedestrian Mobility Switzerland.';
					} else {
					    $list1 = 'Die folgenden ';
					    $list2 = ' Gemeinden sind Mitglied von Fussverkehr Schweiz.';
					}
					
					$numlinks = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'");
					if (0 < $numlinks) $numlinks = number_format($numlinks); 
					echo $list1;
					echo $numlinks;
					echo $list2;
					?></p>
                                     
                   <div id="gmd">
                   <?php  wp_list_bookmarks('categorize=1&category_before=<div id="%id" class="%class">&category_after=</div>'); ?>
				   
				   
				   
				   
					
                    </div>
					
					
                 
                     
                    
                   
                  </div>

                    <div class="post-edit"><?php edit_post_link(__('Edit', 'gconverter')); ?></div> 
                </div><!-- end of #post-ID -->

            <?php endwhile; ?> 

        <?php else : ?>

            <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
            <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
            <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
            <?php // get_search_form();  ?>

        <?php endif; ?>  

    </div><!-- end of #content -->
    <div id='border' class='level-3'>
        <?php $shortcode = get_encryptx_meta($post->ID, 'right_sidebar', true);
        echo do_shortcode($shortcode);
         ?>
    <?php get_sidebar('right'); ?>
    </div>
    <div style='clear: both;'></div>
</div>    
<?php get_footer(); ?>