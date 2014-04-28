<?php

require_once(TEMPLATEPATH . '/dashboard.php'); 


if ( function_exists('register_sidebar') ) 
{ 
register_sidebar(array('name' => 'Top Sidebar','before_widget' => '','after_widget' => '','before_title' => '<h2>','after_title' => '</h2>')); 
register_sidebar(array('name' => 'Left Sidebar','before_widget' => '','after_widget' => '','before_title' => '<h2>','after_title' => '</h2>'));    
register_sidebar(array('name' => 'Right Sidebar','before_widget' => '','after_widget' => '','before_title' => '<h2>','after_title' => '</h2>'));   
register_sidebar(array('name' => 'Footer Left','before_widget' => '','after_widget' => '','before_title' => '<h2>','after_title' => '</h2>'));     
register_sidebar(array('name' => 'Footer Center','before_widget' => '','after_widget' => '','before_title' => '<h2>','after_title' => '</h2>'));     
register_sidebar(array('name' => 'Footer Right','before_widget' => '','after_widget' => '','before_title' => '<h2>','after_title' => '</h2>')); 
}

# Displays post image attachment (sizes: thumbnail, medium, full)
function dp_attachment_image($postid=0, $size='thumbnail', $attributes='') {
	if ($postid<1) $postid = get_the_ID();
	if ($images = get_children(array(
		'post_parent' => $postid,
		'post_type' => 'attachment',
		'numberposts' => 1,
		'post_mime_type' => 'image',)))
		foreach($images as $image) {
			$attachment=wp_get_attachment_image_src($image->ID, $size);
			?><img src="<?php echo $attachment[0]; ?>" <?php echo $attributes; ?> /><?php
		}
}

function trim_excerpt($text) {
  return rtrim($text,'[...]');
}
add_filter('get_the_excerpt', 'trim_excerpt');

function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

     
	


?>
<?php
function widget_mytheme_search() {
?>
<h2>Search</h2>
<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/"> <input type="text" value="Search..." onfocus="if (this.value == 'Search...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search...';}" size="18" maxlength="50" name="s" id="s" /> </form> 
<?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_mytheme_search');






?>