<!-- begin categories -->
		<!-- Category Nav Starts -->
			<div id="cat_navi" class="wrap">
				<ul id="secnav">
					
					<?php if (get_option('pov_home_link')) : ?>
					
					<?php endif; ?>

					<?php foreach ( (get_categories('exclude='.get_option('pov_cat_ex') ) ) as $category ) { if ( $category->category_parent == '0' ) { ?>
  
                    <li>
                        <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                        
                        <?php if (get_category_children($category->cat_ID) ) { ?>
                        <ul><?php wp_list_categories('title_li&child_of=' . $category->cat_ID ); ?></ul>
                        <?php } ?>
                    </li>
	
					<?php } } ?>
                    
				</ul>
			</div>
			<!-- Category Nav Ends -->
		<!-- end categories -->
	<div style="clear: both;"></div>