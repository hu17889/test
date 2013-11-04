

<div id="left">






			
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Left Sidebar") ) : ?>
	
<ul>

<li><h2>Archives</h2>
<ul>
<?php wp_get_archives('type=monthly'); ?>
</ul>
</li>
</ul>
<?php endif; ?>



</div>
