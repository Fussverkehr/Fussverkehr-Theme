<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Pages Template
   Template Name: Projekte
 
 *
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
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
                    <?php the_content(__('Read more &#8250;', 'gconverter'));?>
				<div class="projekte-nav"><?php  wp_nav_menu(array('theme_location' => 'sitemap'));?></div>
                    <?php get_encryptx_meta($post->ID, 'right_sidebar', true);
                    echo apply_filters('the_content', get_encryptx_meta($post->ID,'right_sidebar', true));
                     
                    $kat_anzeigen = get_post_meta($post->ID, 'Kategorie', true);
                    	$kat_ID = $kat_anzeigen[0]->cat_ID;
                    	
                    	                    
                       $args = array(
                           'post_type' => 'post',
                           'category_name' => $kat_anzeigen,
                           'posts_per_page' => 5
                       );
                       
                       if ($kat_anzeigen != '') : 
                    
                       $news_query = new WP_Query( $args );
                       
                       
                       
                       if($news_query->have_posts()): while($news_query->have_posts()) : $news_query->the_post();?>
                       
                       <div class="news-list-item">
                                           <h2>
                                               <span class="news-list-date"><?php  $display_date = date('d.m.Y', strtotime(get_post_meta($post->ID, 'event_begin', true)));
                       
                                                if ( $display_date == '01.01.1970'): { the_time('d.m.Y'); } else: { echo $display_date;  } endif; ?>
                       
                       </span>
                                               <a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                           </h2>
                                           <?php if (has_post_thumbnail()) : ?>
                                               <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail', array('class' => 'alignleft cat-post-img')); ?></a>
                                           <?php else: ?>
                                               <?php echo gconverter_first_image(get_the_content(), 'html-link', array('alignleft', 'gc_first_image', 'cat-post-img')); ?>
                                           <?php endif; ?>
                                           <p class="bodytext">
                                    
                                               <?php the_excerpt(); ?>
                    						</p> </div>
                      <?php  
                       endwhile;
                        if ($news_query->max_num_pages > 1) :
                        ?>
                      
                       <div class="alignleft">
                           <?php next_posts_link(__('&laquo; Older Entries', 'web2feeel'),$news_query->max_num_pages) ?>
                       </div>
                       <div class="alignright">
                           <?php previous_posts_link(__('Newer Entries &raquo;', 'web2feel')) ?>
                       </div>
                       <div class="clear"></div>
                          <?php                         endif; endif;
                       wp_reset_query();  endif;
                       
                       ?>
                     </div>
                    
                    
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'gconverter'), 'after' => '</div>')); ?>
                </div>
                <div class="post-edit"><?php edit_post_link(__('Edit', 'gconverter')); ?></div> 
            <!-- end of #post-ID -->
            
            <div class="csc-textpic-clear"></div>
        <?php endwhile; ?> 

    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
        <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
        <?php get_search_form(); ?>

    <?php endif; ?>  

</div><!-- end of #content -->
<div id="border">
		
    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>