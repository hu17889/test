<?php

class Mcrypt_Base
{
    protected $_key = '360_jh08er31?>22';
    protected $_iv  = '360_asdf';

    /**
     * __construct 
     * 
     * @param mixed $isKey true $key传入的是key属性 false $key是{@function 
     * generateKey}的输入参数
     * @param mixed $key 
     * @param mixed $isIv 说明同$isKey
     * @param mixed $iv 
     * @return void
     */
    public function __construct($isKey, $key, $isIv, $iv, $algo=MCRYPT_TripleDES)
    {
        $this->_iv   = $isIv  ? $iv  : $this->generateIv($iv);
        $this->_key  = $isKey ? $key : $this->generateKey($key);
        $this->_algo = $algo;
    }

    protected function generateIv($arrParam)
    {
        return $this->_iv;
    }

    protected function generateKey($arrParam)
    {
        return $this->_key;
    }

    public function encrypt($string)
    {
        $enc = "";
        $enc = mcrypt_cbc($this->_algo, $this->_key, $string, MCRYPT_ENCRYPT, $this->_iv);
        return base64_encode($enc);
    }

    public function decrypt($string)
    {
        $dec = "";

        $string = base64_decode($string);
        $dec = mcrypt_cbc(MCRYPT_TripleDES, $this->_key, $string, MCRYPT_DECRYPT, $this->_iv);
        $dec = rtrim($dec);
        return $dec;
    }
}


