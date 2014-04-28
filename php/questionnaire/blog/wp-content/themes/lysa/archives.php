<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
<div id="box">
<?php include(TEMPLATEPATH."/categories.php");?>

<div id="archives">

      
			
			<div class="col1">
				
			<h2><?php the_title(); ?></h2>        
			
			<div class="arclist fl">
			
				<h2>Categories</h2>
	
				<ul>
					<?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
				</ul>				
			
			</div><!--/arclist-->
			
			<div class="arclist fr">
			
				<h2>Archives</h2>
	
				<ul>
					<?php wp_get_archives('type=monthly&show_post_count=1') ?>	
				</ul>				
			
			</div><!--/arclist-->
			
			<div class="fix"></div>
			<div style="clear: both;"></div>
			<?php if (function_exists('wp_tag_cloud')) { ?>
			
				<div id="archivebox">
					
						<h2 style="margin-bottom:10px;">Popular Tags</h2>

						
							<?php wp_tag_cloud('smallest=10&largest=18'); ?>
												        
				
				</div><!--/archivebox-->
			
			<?php } ?>															

		</div><!--/col1-->
</div>

<?php include(TEMPLATEPATH."/sidebar.php");?>

<?php get_footer(); ?>
