<?php


$ret = getimagesize('1.jpg');
$wrongret = getimagesize('wrong.jpg');

var_dump($ret, $wrongret);



