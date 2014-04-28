<?php



$themename = "Lysa";
$shortname = "pov";
$mx_categories_obj = get_categories('hide_empty=0');
$mx_categories = array();
foreach ($mx_categories_obj as $mx_cat) {
	$mx_categories[$mx_cat->cat_ID] = $mx_cat->cat_name;
}
$categories_tmp = array_unshift($mx_categories, "Select a category:");	
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10" );
$colorscheme = array("Default", "Brown", "Grey", "Sky-Blue", "Green", "Turquoise", "Red", "Black", "Blank");

$options = array (





/* main */	

array(  "name" => "Main Set Up",
        "type" => "heading",
		"desc" => "Set your logo and color scheme.",
       ),

array( 	"name" => "Logo Display",
		"desc" => "The URL address of your logo (max 940px width). (Leaving it empty will display your blog title)",
		"id" => $shortname."_lysalogo",
		"type" => "text",
		"std" => ""),		

array(  "name" => "Blog Color Scheme",
        "id" => $shortname."_color",
        "type" => "select",
        "std" => "Default",
        "options" => $colorscheme),

array( "name" => "Disable Thumbnails?",
	"desc" => "Tick to disable Thumbnails.",
	"id" => $shortname."_disthumb",
	"type" => "checkbox",
	"std" => "false"),
	
array( "name" => "Disable Footer Widgets?",
	"desc" => "Tick to disable Footer Widgets.",
	"id" => $shortname."_disfoo",
	"type" => "checkbox",
	"std" => "false"),

	
array(	"name" => "Navigation Settings",
		"type" => "heading"),	


array(	"name" => "Exclude Categories",
		"desc" => "Enter a comma-separated list of the <a href='http://support.wordpress.com/pages/8/'>Category ID's</a> that you'd like to exclude from the main category navigation. (e.g. 1,2,3,4)",
		"id" => $shortname."_cat_ex",
		"std" => "",
		"type" => "text"),	


			
/* featured */						
			
array(  "name" => "Featured section",
            "type" => "heading",
			"desc" => "This section customizes the featured area on the top of the content and the number of stories displayed there.",
       ),	

array( "name" => "Disable Featured section?",
			"desc" => "Tick to disable Featured section.",
			"id" => $shortname."_disfeat",
			"type" => "checkbox",
			"std" => "false"),
	
array( 	"name" => "Featured section category",
			"desc" => "Select the category that you would like to have displayed in Featured list on your homepage.",
			"id" => $shortname."_story_category",
			"std" => "Uncategorized",
			"type" => "select",
			"options" => $mx_categories),
			
array(	"name" => "Number of highlight reel posts",
			"desc" => "Select the number of posts to display ( Upto 4 is good).",
			"id" => $shortname."_story_count",
			"std" => "4",
			"type" => "select",
			"options" => $number_entries),
			
	

/* sidebar */				

			
		
array(  "name" => "Follow Me box - Twitter, Facebook, Flickr account",
            "type" => "heading",
			"desc" => "",
			),	


array( "name" => "Disable Follow Me box?",
			"desc" => "Tick to disable Follow Me box.",
			"id" => $shortname."_disfollow",
			"type" => "checkbox",
			"std" => "false"),


array(  "name" => "Your Twitter account",
        	"desc" => "Enter your Twitter account name",
        	"id" => $shortname."_twitter_user_name",
        	"type" => "text",
        	"std" => ""),
array(  "name" => "Your Facebook account",
        	"desc" => "Enter your Facebook account name",
        	"id" => $shortname."_facebook_user_name",
        	"type" => "text",
        	"std" => ""),	
array(  "name" => "Your Flickr account",
        	"desc" => "Enter your Flickr account name",
        	"id" => $shortname."_flickr_user_name",
        	"type" => "text",
        	"std" => ""),	
	

  
	   
array(  "name" => "About Me Settings",
            "type" => "heading",
			"desc" => "Set your About me image and text from here .",
       ),			

  
	   
array("name" => "About me text",
			"desc" => "Enter some descriptive text about you, or your site.",
            "id" => $shortname."_about",
            "std" => "Integer eget dui ante, a vestibulum augue. Suspendisse lorem diam, viverra a interdum in, facilisis eget mauris. Etiam cursus ligula at dolor ultrices adipiscing sodales metus lacinia. Etiam id justo consectetur lorem auctor scelerisque nec varius ante. Ut condimentum nisl nec enim porttitor ut auctor neque adipiscing. Praesent ac eleifend nunc.",
            "type" => "textarea"),   
	 
	   
array(  "name" => "Google Analytics",
            "type" => "heading",
			"desc" => "Please paste your Google Analytics (or other) tracking code here.",
       ),
	
	

array(	"name" => "Google Analytics",
			"desc" => "",
			"id" => $shortname."_google_analytics",
			"std" => "",
			"type" => "textarea"),		
array( "type" => "close"),	 
   
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=dashboard.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); 
                update_option( $value['id'], $value['std'] );}

            header("Location: themes.php?page=dashboard.php&reset=true");
            die;

        }
    }

      add_theme_page($themename." Options", "$themename Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
    
?>



<div class="wrap">
<h2><b><?php echo $themename; ?> theme options</b></h2>

<form method="post">

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>


<table class="optiontable" >

<?php foreach ($options as $value) { 
    
	
if ($value['type'] == "text") { ?>
        
<tr align="left"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" size="40" />
				
    </td>
	
</tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>

<?php } elseif ($value['type'] == "textarea") { ?>
<tr align="left"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
                   <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="40" rows="5"/><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_option($value['id'] )); } else { echo $value['std']; } ?>
</textarea>

				
    </td>
	
</tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>

<?php } elseif ($value['type'] == "select") { ?>

    <tr align="left"> 
        <th scope="top"><?php echo $value['name']; ?>:</th>
	        <td>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; }?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
			
        </td>
	
</tr>
<tr><td colspan=2> <small><?php echo $value['desc']; ?> </small> <hr /></td></tr>






<?php } elseif ($value['type'] == "checkbox") { ?>
		
            <tr>
            <td style="width: 40%"><strong><?php echo $value['name']; ?></strong><br /><small><?php echo $value['desc']; ?></small></td>
                <td><?php if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        

       










<?php } elseif ($value['type'] == "heading") { ?>

   <tr valign="top"> 
		    <td colspan="2" style="text-align: left;"><h2 style="color:grey;"><?php echo $value['name']; ?></h2></td>
		</tr>
<tr><td colspan=2> <small> <p style="color:green; margin:0 0;" > <?php echo $value['desc']; ?> </P> </small> <hr /></td></tr>

<?php } ?>
<?php 
}
?>
</table>






<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<p>For support visit us: <a href="http://dannci.com/" >Dannci.com</a>.</p>
<?php
}
add_action('admin_menu', 'mytheme_add_admin'); ?>
