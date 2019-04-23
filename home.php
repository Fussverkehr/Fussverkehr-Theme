<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Home Page
 */
?>
<?php get_header(); ?>
<!-- home header image -->
<div id="top-container" style="background: url('<?php header_image(); ?>') no-repeat top center;     background-size: 960px 261px;">
	<div id="sub-nav" role="tooltip">
	    <?php get_sidebar('left'); ?>
	</div>
</div>

<div id="bottom-container">
    <div id="news"><!--TYPO3SEARCH_begin-->
        
            <div class="news-latest-container">
                <?php
                  wp_reset_query();
                  if (ICL_LANGUAGE_CODE == 'fr') {
                      $catId = 2;
                      $moreNews = '">Plus d’actualités</a>';
                  } elseif (ICL_LANGUAGE_CODE == 'it') {
                      $catId = 3;
                      $moreNews = '">Altre novità</a>';
                  } elseif (ICL_LANGUAGE_CODE == 'en') {
                      $catId = 1;
                      $moreNews = '">more news</a>';
                  } else {
                      $catId = 4;
                      $moreNews = '">Weitere News</a>';
                  }
                  $category = get_category($catId);
                  query_posts(array(
                      'posts_per_page' => 4,
                      'cat' => $catId,
                  ));
                print '<h1>' ; 
                print $category->cat_name; 
                print ':</h1>';
                 
                  if (have_posts()) {
                      while (have_posts()) {
                          the_post();
                          ?>
                          <div class="news-latest-item news-item">
<?php if (has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('home-news', array('class' => 'alignleft cat-post-img')); ?></a>
<?php else: ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/news-ohne-bild.png" height="212px" width="150px"></a>
<?php endif; ?>							  
                              <h2><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
                          </div>
                          <?php
                      }
                  }
                  
                  print '<a class="more_news" href="';
                  print get_category_link( $catId );
                  print $moreNews;
                  
                  wp_reset_query();
                  ?>                  
            
        </div><!--TYPO3SEARCH_end-->
</div>
    <div id="border">
    <?php if (!dynamic_sidebar('home-widget-1')) : ?><?php endif; ?>
</div>
</div>
<div id="home-footer">
<?php get_footer(); ?></div>
