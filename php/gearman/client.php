<?php
 
//客户端连接
$gmclient= new GearmanClient();
$gmworker->addServer("10.16.15.62", 4700);

//处理请求
$result = $gmclient->do("reverse", "Hello!");
 
 var_dump($result);
