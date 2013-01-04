<?php

class QuestionController extends Controller
{

    public function actionIndex()
    {
        $renderParams['naireid'] = $this->naireid;
        $this->render('index',$renderParams);
    }


    public function actionTry()
    {
        $this->render('try');
    }
}
