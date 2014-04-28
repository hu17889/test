<?php get_header(); ?>
<?php include(TEMPLATEPATH."/categories.php");?>
<div id="box">


	<div id="content">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results</h2>

		


		<?php while (have_posts()) : the_post(); ?>

			<!-- begin post -->
	<div class="single">
			

<div class="p-time">
<strong class="day"><?php the_time('j') ?></strong>
<strong class="month-year"><?php the_time('M') ?> <br /><?php the_time('Y') ?></strong>
</div>
				
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				

				
				<div class="entry">
				<div class="texty">
				<?php the_excerpt(); ?>	
				</div>
				</div>

				<p class="postmetadata"><small><?php the_category(', ') ?> | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> | <?php the_tags('Tags: ', ', ', ''); ?></small></p>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<?php
include('wp-pagenavi.php');
if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
			?>
		</div>

	<?php else : ?>

		<h2 class="center">No posts found. Try a different </h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		<hr/>
		<h2>Or use these Tags to move on:</h2>
		<?php wp_tag_cloud('smallest=8&largest=36&'); ?>

	<?php endif; ?>

	</div>

<?php include(TEMPLATEPATH."/sidebar.php");?>

<?php get_footer(); ?>