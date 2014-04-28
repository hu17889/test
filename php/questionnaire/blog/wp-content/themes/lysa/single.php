<?php get_header(); ?>
<div id="box">
<?php include(TEMPLATEPATH."/categories.php");?>

	<!-- BEGIN content -->
<div id="content">

	<?php if (have_posts()) : the_post(); ?>
	<!-- begin post -->
	<div class="single">
	<h2><?php the_title(); ?></h2>
	<div class="inf"><?php the_time('j M Y') ?>  by <?php the_author() ?>, <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> </div>
	<div class="texty">
	<?php the_content(); ?>
	</div>
    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    <p><?php the_tags(); ?></p>
	</div>
	<!-- end post -->
	
	<div class="comentary">
	<?php comments_template(); ?>
	</div>
	
	<?php else : ?>
	<div class="notfound">
	<h2>Not Found</h2>
	<p>Sorry, but you are looking for something that is not here.</p>
	</div>
	<?php endif; ?>

</div>
<!-- END content -->
<?php include(TEMPLATEPATH."/sidebar.php");?>


<?php get_footer(); ?>
