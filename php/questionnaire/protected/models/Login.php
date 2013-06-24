<?php

class Login
{
    public function isLogin()
    {
        $cache = Yii::app()->cache;
        //return isset($_COOKIE['fanyiuser']);
        $ret = $cache->get('loginuser');
        if(isset($_COOKIE['fanyiuser'])) return $ret == $_COOKIE['fanyiuser'];
        else return false;
    }

    public function tologin($usr, $pwd)
    {
        $cache = Yii::app()->cache;
        if($usr=='rec'&&$pwd=='recommend') {
            //$_COOKIE['fanyiuser'] = md5($usr.$pwd.'hucong');
            setcookie('fanyiuser',md5($usr.$pwd.'hucong'),0);
            $cache->set('loginuser',md5($usr.$pwd.'hucong'));
            return true;
        } else {
            return false;
        }
    }
}



