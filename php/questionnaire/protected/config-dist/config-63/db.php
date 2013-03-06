<?php

if(php_uname("n")=="li390-89")
	return array(
		'connectionString' => 'mysql:host=127.0.0.1;dbname=questionnaire',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => 'hu868811',
		'charset' => 'utf8',
	);

else
	return array(
		'connectionString' => 'mysql:host=10.16.15.79:3306;dbname=questionnaire',
		'emulatePrepare' => true,
		'username' => 'open',
		'password' => '8J6cn4A7f4SC2a7W',
		'charset' => 'utf8',
	);

