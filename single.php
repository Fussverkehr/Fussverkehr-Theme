<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Single Posts Template
 *
 * @link           http://codex.wordpress.org/Theme_Development#Single_Post_.28single.php.29
 */
?>
<?php get_header(); ?>
<div id="sub-nav" <?php if (post_is_in_descendant_category(18) or post_is_in_descendant_category(26) or post_is_in_descendant_category(32)):?>
class="regional"
<?php endif; ?> >
    <?php get_sidebar('left'); ?>
</div>
<?php
$categories = get_the_category();
$currCat = $categories ? $categories[0] : '';
?>
<div id="content">
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>
        
            <div class="csc-default" id="c224">
                <div class="csc-header csc-header-n2">
                <img src="<?php echo z_taxonomy_image_url($currCat->term_id, site-image); ?>" width="500" height="196"/>

                    <h1><?php echo $currCat->cat_name; ?></h1>
                </div>
                <div class="news-single-item">
                    <h2><?php the_title(); ?></h2>
                    <div class="news-image">
                        <?php 
                                             
                        $thumb_id = get_post_thumbnail_id ( $post->ID );
                        $pdf_id = get_post( $thumb_id )->post_parent;
                        if ( $pdf_id && get_post_mime_type ( $pdf_id ) === 'application/pdf' ){
                          $pdf = get_post($pdf_id);
                          echo '<a class=" link-to-pdf alignleft cat-post-img" href="'.wp_get_attachment_url($pdf_id).'" title="'.esc_html($pdf->post_title).'" target="_blank">'.get_the_post_thumbnail($_post->ID, 'thumbnail').'</a>'."\n";
                        } else {
                        	the_post_thumbnail('thumbnail', array('class' => 'alignleft cat-post-img'));
                        }?>
                    </div> 
                    <p class="bodytext">
                        <?php the_content(); ?>
                    </p>						
                    <div class="news-single-timedata"><?php the_time('d.m.Y'); ?></div>
                    <div class="news-single-backlink">	
                        <a href="<?php print $_SERVER['HTTP_REFERER'];?>">
                        <?php if(ICL_LANGUAGE_CODE=='it'): ?>
                        « ritorno
                        <?php elseif(ICL_LANGUAGE_CODE=='fr'): ?>
                        « retour
                        <?php elseif(ICL_LANGUAGE_CODE=='de'): ?>
                        « zur&uumlck
                        <?php else: ?>
                        « back
                        <?php endif ?>
                        </a>
                    </div>
                </div>		
            </div>
            <?php // comments_template('', true); ?>

        <?php endwhile; ?> 

        <?php if ($wp_query->max_num_pages > 1) : ?>
            <div class="navigation">
                <div class="previous"><?php next_posts_link(__('&#8249; Older posts', 'gconverter')); ?></div>
                <div class="next"><?php previous_posts_link(__('Newer posts &#8250;', 'gconverter')); ?></div>
            </div><!-- navigation -->
        <?php endif; ?>

    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'gconverter'); ?></h1>
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'gconverter'); ?></p>
        <h6><?php _e('You can return', 'gconverter'); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e('Home', 'gconverter'); ?>"><?php _e('&larr; Home', 'gconverter'); ?></a> <?php _e('or search for the page you were looking for', 'gconverter'); ?></h6>
        <?php get_search_form(); ?>

    <?php endif; ?>  
</div><!-- end of #content -->
<div id="border">
        <?php echo get_encryptx_meta($post->ID, 'right_sidebar', true); ?>
    <?php get_sidebar('right'); ?>
</div>
<div class="clear"></div>
<script type="text/javascript">jQuery( 'li.current-post-ancestor' ).parents( 'li.menu-item' ).addClass( 'current-menu-ancestor' );
</script> 
<?php get_footer(); ?>