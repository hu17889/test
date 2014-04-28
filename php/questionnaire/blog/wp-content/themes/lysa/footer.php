<?php
global $options;
foreach ($options as $value) {
if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<div id="footer">
<div id="totop">
<a href="<?php echo get_settings('home'); ?>/#">Jump To Top</a>
</div>
<?php if ($pov_disfoo == "true") { } else { ?>
<div id="foot">

<div id="footee1">

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar("Footer Left") ) : ?>
<ul>		
<li><h2>Widget Ready Block</h2></li>
<li>Aenean lacinia varius vulputate. Cras in tellus eros, vitae volutpat lectus. Suspendisse nec elit nec mi pretium ullamcorper. Donec nec felis ac diam tristique vestibulum non et augue. Sed a varius massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>      

</ul>
<?php endif; ?>

</div>



<div id="footee2">

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar("Footer Center") ) : ?>
<ul>
<li><h2>Widget Ready Block</h2></li>
<li>Morbi ac risus sapien. Nullam non magna est. Donec placerat pretium molestie. Sed sed risus quis arcu aliquet aliquet sed eget massa. Quisque accumsan, ante in gravida tristique, risus ipsum venenatis nulla, ac viverra ipsum odio in arcu. Quisque a dictum orci. </li>
</ul>

<?php endif; ?>

</div>



<div id="footee3">


<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar("Footer Right") ) : ?>
<ul>
 <li><h2>Widget Ready Block</h2></li>
<li>Hellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque at lacus turpis, ac rutrum risus. Sed ultrices lectus a neque malesuada condimentum. Maecenas magna lorem, porttitor vitae aliquet eget, egestas malesuada mauris. </li>      

</ul>
<?php endif; ?>

</div>
  
<div id="footee4">

<!-- begin about -->
     <h2>About</h2>
		<div id="about">
		
		<?php 
		$about = get_option('pov_about'); 
		?>			
		<p class="text">
		
		<?php echo ($about); ?> 
		</p>
		</div>
       
    
    	
<!-- end about -->

</div>

</div>
<?php } ?>

<div id="foodown">
	<h2><?php bloginfo('description'); ?></h2>
		<p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?> is proudly using the <a href="http://beatheme.com/" title="Professional WordPress Themes">Lysa theme.</a></p>
</div>
</div>
</div>
</div>

<?php 
$pov_google_analytics = get_option('pov_google_analytics');
if ($pov_google_analytics != '') { echo stripslashes($pov_google_analytics); }
?>
<?php wp_footer(); ?>
</body>
</html>
