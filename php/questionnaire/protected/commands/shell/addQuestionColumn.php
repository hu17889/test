<?php

// input
$qnum = 47;

// db info
$dsn = 'mysql:dbname=questionnaire;host=10.16.15.79:3306';
$user = 'open';
$password = '8J6cn4A7f4SC2a7W';
$dbh = new PDO($dsn, $user, $password);

for($i=1;$i<=$qnum;$i++) {
    $name = 'q2'.$i;
    $sql = "alter table questionnaire add column {$name} int(10) unsigned not null default '0'";
    $pre = $dbh->prepare($sql);
    $ret = $pre->execute();
}




