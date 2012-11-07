<?php

$dsn = 'mysql:dbname=open_api_payment_sandbox;host=192.168.100.17';
$user = 'open';
$password = '8J6cn4A7f4SC2a7W';
$dbh = new PDO($dsn, $user, $password);
$pre = $dbh->prepare("UPDATE payment SET delivery_address='11' WHERE id=1207170729495912849;");
$ret = $pre->execute();
$num = $pre->rowCount();
var_dump($ret,$num);



