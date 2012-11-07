<?php

/**
 * Mcrypt_BaseNew 
 *
 * 只使用cbc模式加密
 * 
 * @package open 360
 * @version $Id$
 * @copyright 2005-2011 360.CN All Rights Reserved.
 * @author root@360.cn
 */
class Mcrypt_BaseNew
{
    // 加密资源句柄
    protected $_td;
    protected $_key = '360_jh08er31?>22';
    protected $_iv  = '';

    /**
     * __construct 
     * 
     * @param mixed $key 
     * @param mixed $iv 
     * @param mixed $algo 默认为3des算法
     * @return void
     */
    public function __construct($key='', $iv='', $algo=MCRYPT_3DES)
    {
        $this->_td = mcrypt_module_open($algo, '', 'cbc', '');
        $key  = empty($key) ? $this->_key : $key;
        $this->_iv   = $this->generateIv($iv);
        $this->_key  = $this->generateKey($key);
    }

    /**
     * generateIv 
     *
     * 生成初始向量
     * 
     * @param string $arrParam 
     * @return void
     */
    protected function generateIv($arrParam = '')
    {
        // return $this->_iv;

        if(empty($arrParam)) {
            return mcrypt_create_iv(mcrypt_enc_get_iv_size($this->_td), MCRYPT_DEV_RANDOM);
        } else {
            return $arrParam;
        }
    }

    /**
     * generateKey 
     *
     * 分段生成密钥
     * 
     * @param mixed $arrParam 
     * @return void
     */
    protected function generateKey($arrParam = '')
    {
        // return $this->_key;

        // from php手册
        $ks = mcrypt_enc_get_key_size($this->_td);

        $keylen = floor(strlen($this->_key)/2);
        if($keylen<4) {
            throw new Exception('Crypt key length is low!');
        }

        $keySplit  = str_split($this->_key, $keylen);
        $key1 = md5($keySplit[0]);
        $key2 = md5($keySplit[1]);

        $key = substr($key1, 0, $ks/2) . substr(strtoupper($key2), (round(strlen($key2) / 2)), $ks/2);

        $key = substr($key.$key1.$key2.strtoupper($key1),0,$ks);

        return $key;
    }

    /**
     * encrypt 
     *
     * 加密函数
     * 
     * @param mixed $string 
     * @return void
     */
    public function encrypt($string)
    {
        $enc = "";
        mcrypt_generic_init($this->_td, $this->_key, $this->_iv);
        $enc = mcrypt_generic($this->_td, $string);
        mcrypt_generic_deinit($this->_td);

        return base64_encode($enc);
    }

    /**
     * decrypt 
     *
     * 解密函数
     * 
     * @param mixed $string 
     * @return void
     */
    public function decrypt($string)
    {
        $dec = "";
        $string = base64_decode($string);
        mcrypt_generic_init($this->_td, $this->_key, $this->_iv);
        $dec = mdecrypt_generic($this->_td, $string);
        mcrypt_generic_deinit($this->_td);

        $dec = rtrim($dec);
        return $dec;
    }

    /**
     * getIv 
     * 
     * @return void
     */
    public function getIv()
    {
        return $this->_iv;
    }

    /**
     * getKey 
     * 
     * @return void
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * end 
     *
     * 资源释放
     * 
     * @return void
     */
    public function end()
    {
        mcrypt_module_close($this->_td);
    }
}


