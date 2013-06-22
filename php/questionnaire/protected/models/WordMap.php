<?php

class WordMap extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return Yii::app()->getComponent("db_fanyi");
    }

    public function tableName()
    {
        return 'proword_map';
    }

}
