<?php 
$con = mysql_connect("192.168.100.17","open","8J6cn4A7f4SC2a7W");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db("test", $con);
if (!$db_selected)
{
    die ("Can\'t use test_db : " . mysql_error());
}
$sql = "select SQL_NO_CACHE * from payment where app_key<100000";
var_dump($sql);
$startTime = microtime(true);
$query = mysql_query($sql, $con);
var_dump(microtime(true)-$startTime);
mysql_free_result($query);

$sql = "select SQL_NO_CACHE user_id from payment where app_key<100000";
var_dump($sql);
$startTime = microtime(true);
$query = mysql_query($sql, $con);
var_dump(microtime(true)-$startTime);
mysql_free_result($query);

/*
$sql = "select * from payment where app_key=3846339";
var_dump($sql);
$startTime = microtime(true);
$query = mysql_query($sql, $con);
var_dump(microtime(true)-$startTime);
mysql_free_result($query);


$sql = "Select * from payment where user_id=8215 ";
var_dump($sql);
$startTime = microtime(true);
$query = mysql_query($sql, $con);
var_dump(microtime(true)-$startTime);
var_dump(mysql_num_rows($query));
mysql_free_result($query);
 */
mysql_close($con);
