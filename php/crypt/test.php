<?php
// include_once('base_new.php');
// 
    // $mcrypt = new Mcrypt_BaseNew();
    // $iv     = $mcrypt->getIv();
    // $orderIdEnc = $mcrypt->encrypt('hucong');
    // $mcrypt->end();
    // error_log(getmypid()."\n",3,'temp');
// $td = mcrypt_module_open(MCRYPT_3DES, '', 'cbc', '');
// $len = mcrypt_enc_get_iv_size($td);
// $iv = mcrypt_create_iv($len,MCRYPT_DEV_RANDOM);
// var_dump($td,$len);
// printf('%x',$iv);
// var_dump(MCRYPT_DEV_RANDOM);
// mcrypt_module_close($td);
 $iv = mcrypt_create_iv(8,MCRYPT_DEV_URANDOM);




