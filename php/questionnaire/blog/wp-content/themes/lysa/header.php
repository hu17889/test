<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<?php global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }
?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-<?php echo $pov_color; ?>.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>


<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>


<script type="text/javascript">
	jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
</script>

<style type="text/css" media="screen">

</style>

<?php wp_head(); ?>
</head>
<body>

<div id="head">
<!-- begin pages -->
		<div id="menu">
		<ul id="nav">
		<?php if (is_home()) { ?>
            <li class="current_page_item"><a href="<?php echo get_option('home'); ?>">Home</a></li>
        <?php } else { ?>
            <li><a href="<?php echo get_option('home'); ?>">Home</a></li>
        <?php } ?>    
        <?php wp_list_pages('title_li=&depth=2&sort_column=menu_order'); ?>
		</ul>
		</div>
		<!-- end pages -->
</div>		
<div id="container">
<div id="header">
		<?php global $options;
		foreach ($options as $value) {
    	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
		}?>
		<h1><a href="<?php echo get_settings('home'); ?>/"><?php if($pov_lysalogo) { ?><img src="<?php echo $pov_lysalogo;?>" alt="Go Home"/><?php } else { bloginfo('name'); } ?>	</a></h1>
		
        <?php if ($pov_desc == "true") { } else { ?><?php } ?>
		
</div>


