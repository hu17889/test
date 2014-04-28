<?php if($lable=='no') { ?>
<p style="color:red">用户名密码错误</p>
<?php }?>
<form method='post' action='/fanyi/login'>
用户名: <input type='text' name='usr' /><br>
密码: <input type='password' name='pwd'><br>
<input type='hidden' name='url' value="<?php echo $url;?>"><br>
<input type='submit' name='usrsub' value='登录'>
</form>
