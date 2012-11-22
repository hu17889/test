<?php

$input = array(
    'a' => 'a',
    'b' => 1,
    'c' => '1',
    'd' => '1a',
);

$filters = array(
    'a' => array('flag'=>FILTER_VALIDATE_INT),
    'b' => array('flag'=>FILTER_VALIDATE_INT),
    'c' => array('flag'=>FILTER_VALIDATE_INT),
    'd' => array('flag'=>FILTER_VALIDATE_INT),
);

$ret = filter_var_array($input,$filters);
var_dump($ret);


