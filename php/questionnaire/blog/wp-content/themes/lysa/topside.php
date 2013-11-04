<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>


<!-- featured news -->
<div id="topside">		
			
			
			
			<?php 
	$highcat = get_option('pov_story_category'); 
	$highcount = get_option('pov_story_count');
	
	$my_query = new WP_Query('category_name= '. $highcat .'&showposts='.$highcount.'');
while ($my_query->have_posts()) : $my_query->the_post();$do_not_duplicate = $post->ID;
?>

<div class="fblock">
<?php if ($pov_disthumb == "true") { } else { ?>
<a href="<?php the_permalink(); ?>"><?php dp_attachment_image($post->ID, 'thumbnail', 'alt="' . $post->post_title . '"'); ?></a>
<?php } ?>


<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>



<?php the_excerpt(); ?>

	<div class="commentos"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></div>
</div>
<?php endwhile; ?>
		
<!-- end featured news -->
		
		
		



	
	
	



</div> 


<!-- begin follow -->  
	
    <?php if ($pov_disfollow == "true") { } else { ?>
	
<div id="social">
<h2>Follow Me!</h2>

<a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icon-rss.gif" alt="Follow Me!" /></a>
         
      
<?php $twit_user_name="#" ?>
<?php if (get_settings('pov_twitter_user_name')) { $twit_user_name = get_settings('pov_twitter_user_name') ; } ?>
<a href="http://twitter.com/<?php echo $twit_user_name; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icon-twitter.gif" alt="Follow Me!" /></a>

<?php $fac_user_name="#" ?>
<?php if (get_settings('pov_facebook_user_name')) { $fac_user_name = get_settings('pov_facebook_user_name') ; } ?>
<a href="http://facebook.com/<?php echo $fac_user_name; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icon-facebook.gif" alt="Follow Me!"/></a>

<?php $fli_user_name="#" ?>
<?php if (get_settings('pov_flickr_user_name')) { $fli_user_name = get_settings('pov_flickr_user_name') ; } ?>
<a href="http://flickr.com/<?php echo $fli_user_name; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icon-flickr.gif" alt="Follow Me!" /></a>

      
</div>
	<?php } ?>
	<!-- end follow -->
	
<div id="topsidebar">






			
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Top Sidebar") ) : ?>
	
<ul>
<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>



</ul>
<?php endif; ?>



</div>