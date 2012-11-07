<?php
$arr = array(
    'a' => 'a',
    'b' => '+',
    'c' => ' ',
    );
var_dump(http_build_query($arr));



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>等待页</title>
<style>
*{background-color:#f4f8ff;}
.gobackA{color:#336699;}
.gobackA:hover{text-decoration:underline;color:#336699}
</style>
</head>
<body>
<form action="index.php" method="post">
<input type="hidden" name="input" value="<?php echo http_build_query($arr);?>">
    <input type="submit" name="submit" value="post" />
</form>
</body>
</html>

<?php
echo '<pre>';
var_dump($_REQUEST['input']);
var_dump(urldecode($_REQUEST['input']));



?>
