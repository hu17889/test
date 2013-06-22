<?php


class Util
{
        public static function cutTail($str, $cut)
        {
            $len = strlen($str);
            $cutLen = strlen($cut);
            if($len<$cutLen) return false;

            $ret = substr_replace($str ,"",$len-$cutLen,$cutLen);
            if($ret.$cut==$str) return $ret;
            else return $str;
        }
}
