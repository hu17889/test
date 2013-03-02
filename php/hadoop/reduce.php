#!/usr/bin/php
<?php


$sum=0;
$first=0;
while(($row=fgets(STDIN))){
    $arr=explode("\t",trim($row));
    $key=$arr[0];
    if($first==0){
        $first=1;
        $lastkey=$key;
    }   
    if($key!=$lastkey){
        echo $lastkey."\t".$sum."\n";
        $sum=1;
        $lastkey=$key;
    }   
    else{
        $sum +=intval($arr[1]);
    }   
}   
echo $key."\t".$sum."\n";
