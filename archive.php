<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Archive Template
 */
?>
<?php get_header(); ?>

<div id="sub-nav">
    <?php get_sidebar('left'); ?>
</div>
<?php
$catName = $subCat['name'];
$imgUrl = z_taxonomy_image_url($subCat['term_id'], 'full');
flush_rewrite_rules( $hard );
?>



<div id="content">


    <div class="csc-default" id="c227">
        <div class="csc-textpic csc-textpic-center csc-textpic-above">
            <div style="width:496px;" class="csc-textpic-imagewrap csc-textpic-single-image">
                <img width="496" height="195" alt="<?php echo $catName; ?>" src="<?php echo $imgUrl; ?>">
            </div>
        </div>
        <div class="csc-textpic-clear"></div>            
    </div>

    <div class="csc-default">
        <div class="csc-header csc-header-n3">
            <h1>
                <?php if (is_day()) : printf(__('Daily Archives: %s', 'gconverter'), '' . get_the_date() . ''); ?>
                <?php elseif (is_month()) : printf(__('Monthly Archives: %s', 'gconverter'), '' . get_the_date('F Y') . ''); ?>
                <?php elseif (is_year()) : printf(__('Yearly Archives: %s', 'gconverter'), '' . get_the_date('Y') . ''); ?>
                 <?php elseif (is_tag()) : printf(__('%s', 'gconverter'), '' . single_tag_title('', false) . ''); ?>
                <?php else : printf(__('%s', 'gconverter'), '' . single_cat_title('', false) . ''); ?>
                <?php endif; ?>
            </h1>
        </div>
    </div>
    <div id="c229" class="csc-default">
        <div class="news-list-container">
            <?php if (have_posts()) : ?>


                <?php
                $cdesc = category_description();
                if (!empty($cdesc))
                    echo '<div class="archive-meta">' . $cdesc . '</div>';
                ?>  
                
              <?php if (cat_is_ancestor_of(46,$cat)): 
               $wp_query->set('posts_per_page', 100);
 $wp_query->query($wp_query->query_vars); 
                  elseif (cat_is_ancestor_of(48,$cat)): 
                  $wp_query->set('posts_per_page', 100);
 $wp_query->query($wp_query->query_vars); 
                  elseif (cat_is_ancestor_of(55,$cat)): 
                  $wp_query->set('posts_per_page', 100);
 $wp_query->query($wp_query->query_vars); 
                  elseif (cat_is_ancestor_of(56,$cat)): 
 $wp_query->set('posts_per_page', 100);
 $wp_query->query($wp_query->query_vars); 
 
 endif;
 
 ?> 
 
                <?php while (have_posts()) : the_post(); ?>
              
                <?php if (cat_is_ancestor_of(46,$cat,48,$cat,55,$cat,56,$cat)): ?>
                
               <div class="publi-list-item">
               

               <?php $thumb_id = get_post_thumbnail_id ( $post->ID );
               $pdf_id = get_post( $thumb_id )->post_parent;
               if ( $pdf_id && get_post_mime_type ( $pdf_id ) === 'application/pdf' ){
                 $pdf = get_post($pdf_id);
                 echo '<a class="link-to-pdf" href="'.wp_get_attachment_url($pdf_id).'" title="'.esc_html($pdf->post_title).'" target="_blank">'.get_the_post_thumbnail($_post->ID, 'sidebar').'</a>'."\n";
               } ?>
                <h2>
                    <span class="news-list-date"><?php the_time('m.Y'); ?></span>
                    <?php $thumb_id = get_post_thumbnail_id ( $post->ID );
                    $pdf_id = get_post( $thumb_id )->post_parent;
                    if ( $pdf_id && get_post_mime_type ( $pdf_id ) === 'application/pdf' ){
                      $pdf = get_post($pdf_id);
                      echo '<a class="link-to-pdf" href="'.wp_get_attachment_url($pdf_id).'" title="'.esc_html($pdf->post_title).'" target="_blank">';} ?><?php the_title(); ?></a>
                    
                </h2>
                <article><?php the_content(); ?></article>
                
                <?php else: ?>

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
                    </p>
                <?php endif; ?>    	
                    
                    			
                        
                        
                        
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

            <?php else : ?>
                          </h1>
                
                <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
                <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
                <?php get_search_form(); ?>

            <?php endif; ?>  
        </div>
    </div>
</div><!-- end of #content -->
<div id="border"><!--TYPO3SEARCH_begin-->
        <?php echo get_post_custom_values("right_sidebar", get_the_id())[0]; ?>

    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>