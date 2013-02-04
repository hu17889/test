<?php



echo "<pre>";
$paramsCommand = json_decode(exec("php echoServerParam.php"), true);
var_dump($_SERVER,$paramsCommand);

foreach($_SERVER as $key=>$value) {
    if(!array_key_exists($key, $paramsCommand)) {
        echo "WEB:{$key} is not in COMMAND; VALUE={$value}\n";
    } elseif($value!==$paramsCommand[$key]) {
        echo "WEB:{$key} is different from COMMAND; VALUE_WEB={$value}; VALUE_COMMAND={$paramsCommand[$key]}\n";
    }
}

