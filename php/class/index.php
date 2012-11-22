<?php


class foo
{
    public $a='1';
    public $b='2';
}

$f = new foo();
$a = $f;
var_dump($a,$f);
$a['a'] = 2;
var_dump($a,$f);

