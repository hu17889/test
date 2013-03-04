#!/usr/bin/php
<?php

$value=1;
while($row=fgets(STDIN)) {
    $arr=explode(" ",trim($row));
    foreach($arr as $key){
        echo $key."\t".$value."\n";
    }
}
