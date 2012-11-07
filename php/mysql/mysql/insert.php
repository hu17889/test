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

for($j=1;$j<10000;$j++) {
    $sql = "insert into payment values ";
    for($i=1;$i<1000;$i++) {
        $sql .= "( ";
        $sql .= ($j-1)*1000+$i.","; // id
        $sql .= rand(1,10000000).","; // app_key
        $sql .= rand(1,10000).","; // user_id 
        $sql .= "0,"; // amount 
        $sql .= "notify_uri".","; // notify_uri 
        $sql .= rand(0,1).","; // is_success 
        $sql .= rand(0,1).","; // is_notified
        $sql .= "0,"; // created_time 
        $sql .= "0,"; // notified_time
        $sql .= "0,"; // success_time 
        $sql .= rand(1,1000).","; // product_id
        $sql .= "product_name".","; // product_id
        $sql .= "0,"; // pid
        $sql .= "0,"; // pay_type
        $sql = cutTail($sql, ",");
        $sql .= "), ";
    
    }
    $sql = cutTail($sql, ", ");
    // var_dump($sql);
    // exit;
    $query = mysql_query($sql, $con);
    if (!$query)
    {
        die ("Can\'t insert : " . mysql_error());
    }

}

mysql_close($con);
function cutTail($str, $match)
{
    if(preg_match("/".$match."$/i",$str)) {
        $pos = strrpos($str, $match);
        return substr($str,0,$pos);
    }
    return false;
}
function waitForEnterDown()
{
    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);
}
?>
