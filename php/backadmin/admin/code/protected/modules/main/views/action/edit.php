<?php if($label=='has_action') { ?>
<div class='tip'>已经有此路由信息</div>
<?php } ?>
<div class='form'>
	<form method='post' action='/main/action/edit'>
		路由id:
		<?php echo !empty($entity['aid']) ? $entity['aid']:''; ?>
		<br>
		是否侧栏菜单:
		<select id='menu_type' name="menu_type">
			<option value="0">不是菜单</option>
			<option value="1">一级菜单</option>
			<option value="2">二级菜单</option>
		</select>
		<br>
		<div id='firstmenu' style="display:none;" >
			选择一级菜单
			<div id='firstmenue_content'>
				<select id='firstmenu' name="firstmenu">
				<option value="-1">请选择</option>
				<?php foreach ($firstmenus as $v) {?>
				<option value="<?php echo htmlspecialchars($v['aid'])?>"><?php echo htmlspecialchars($v['aname'])?></option>
				<?php }?>
				</select>
			</div>
		</div>	
		<input type='hidden' name='id' value='<?php echo !empty($entity['aid']) ? $entity['aid']:''; ?> ' />
		<br>
		路由名:
		<input type='text' name='name' value='<?php echo !empty($entity['aname']) ? htmlspecialchars($entity['aname']):''; ?> '/>
		<br>
		路由信息:
		<input type='text' name='route' value='<?php echo !empty($entity['route']) ? htmlspecialchars($entity['route']):''; ?> '/>
		<br>
		<br> <br>

	<input type='submit' name='modify' value="提交">
	</form>
</div>
<script>
(function($){
	$('#menu_type').val('<?php echo isset($entity["is_menu"]) ? htmlspecialchars($entity["is_menu"]) : "";?>');
	$("#menu_type").on('change', function(){
		elem = $(this).children('option:selected').val();
		if(elem=="2") $('#firstmenu').show();
		else $('#firstmenu').hide();

		$('#firstmenu').val('<?php echo isset($entity["first_menu"]) ?  htmlspecialchars($entity["first_menu"]) : "";?>');
	});

})(jQuery);
</script>
