<?php 

//http://codex.wordpress.org/Template_Tags/get_posts

wp_reset_query();
query_posts(array("orderby" => "date", "order" => "DESC", "posts_per_page" => 2));

if(have_posts()):
  while(have_posts()):
		the_post(); 
		?>
		  <div class="">
			  <h2><a href="<?php echo get_permalink() ?>">* <?php the_title() ?></a></h2>
              
              <?php if ( has_post_thumbnail()) : ?>
				 <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
              <?php else: ?>
                 <?php //$img_url =  gconverter_post_image( get_the_ID(),  get_the_content() ); From Drupal Conversion ?>
                 <?php $img_url =  gconverter_first_image( $content, 'url', array('alignleft') );?>
                 <?php if( $img_url ): ?><img src="<?php echo trim(get_bloginfo('siteurl'),'/') . '/'. $img_url ?>" class="" style="max-width:300px;"><?php endif; ?>
              <?php endif; ?>
              
              
		  </div>
		<?php
  endwhile;
endif;
?>



<?php 
	$my_postid = 49;
	$content_post = get_post($my_postid);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
?>


 <?php 
$_postid = 6433;
$_content_post = get_post($_postid);
$si_content = $_content_post->post_content;
if( preg_match_all( '|<a href=\"([^\'\"]+)\"[^><]+>[\s\t\r\n]*<img[^><]+src=\"([^\'\"]+)\"[^><]+><\/a>|is', $si_content, $si_array, PREG_SET_ORDER )):
	for( $d=0; $d < count($si_array); $d+=2 ){
		$sis[$d]['even']['href'] = $si_array[$d][1];
		$sis[$d]['even']['src'] = $si_array[$d][2];
		$sis[$d]['odd']['href'] = $si_array[($d+1)][1];
		$sis[$d]['odd']['src'] = $si_array[($d+1)][2];
	}
	foreach( $sis as $si ): ?>
		<!-- gc -->
		<div style="position: absolute; top: 0px; left: 0px; display: none; z-index: 11; opacity: 0;" class="views-rotator-items">
		  <div class="views-rotator-item">
			<div class="image"> <a href="<?php echo $si['even']['href'] ?>"><img src="<?php echo $si['even']['src'] ?>" alt="" title="" class="imagecache imagecache-carousel imagecache-default imagecache-carousel_default" height="235" width="460"></a> </div>
		  </div>
		  <div class="views-rotator-item">
			<div class="image"> <a href="<?php echo $si['odd']['href'] ?>"><img src="<?php echo $si['odd']['src'] ?>" alt="" title="" class="imagecache imagecache-carousel imagecache-default imagecache-carousel_default" height="235" width="460"></a> </div>
		  </div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
                
<?php endif; ?>