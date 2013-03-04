<?php
 
//Worker 实例
 
$gmworker=new GearmanWorker();
$gmworker->addServer("10.16.15.62", 4700);
//$gmworker->addServer("192.168.35.198", 1234);
 
//注册
$gmworker->addFunction("reverse", "reverse_fn");
 
//等待执行
while ($gmworker->work());
 
//处理逻辑；反转字符串
function reverse_fn($job)
{
    return strrev($job->workload());
}
