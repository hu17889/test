<?php get_header(); ?>
<div id="box">
<?php include(TEMPLATEPATH."/categories.php");?>

	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!-- begin post -->
	<div class="single">
	<h2><?php the_title(); ?></h2>
	<div class="inf"><?php the_time('j M Y') ?>  by <?php the_author() ?>, <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> </div>
	<?php the_content(); ?>
    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    <p><?php the_tags(); ?></p>
	</div>
	<!-- end post -->
	
	<div class="comentary">
	<?php comments_template(); ?>
	</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>

<?php include (TEMPLATEPATH . "/sidebar.php"); ?>

<?php get_footer(); ?>