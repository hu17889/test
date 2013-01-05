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
        $renderParams['naireid'] = $this->naireid;
        $this->render('try',$renderParams);
    }

    public function actionInfo()
    {
        $renderParams['naireid'] = $this->naireid;
        $this->render('info',$renderParams);
    }

    public function actionInfo1()
    {
        $renderParams['naireid'] = $this->naireid;
        $this->render('info1',$renderParams);
    }
}
