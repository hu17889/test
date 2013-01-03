<?php

class QuestionController extends Controller
{
    public function actionIndex()
    {
        $naireid = Yii::app()->request->getParam('naireid',null);
        $nextpage = Yii::app()->request->getParam('nextpage',0);
        // echo "<pre>";
        // var_dump(Yii::app()->request);
        if(!isset($naireid)) {
            $naireid = rand(1000000,9999999);
        }
        switch($nextpage) {
        case 0:
            $this->render('index',array('naireid'=>$naireid));
            break;
        case 1:
            $this->render('1');
            break;
        case 2:
            $this->render('2');
            break;
        default:
            $this->render('index');
        }
    }

}
