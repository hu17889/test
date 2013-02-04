<?php


echo "<pre>";
var_dump($_SERVER);


var_dump(unpack("C*",$_SERVER['nginx_params']["binary_remote_addr"]));


