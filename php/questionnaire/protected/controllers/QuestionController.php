<?php

class QuestionController extends Controller
{

    public function actionIndex()
    {
        $model = new Question();
        $model->initQuestionDB($this->naireid);
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
        $model = new Question();
        $model->saveAnswerInfo($_REQUEST);
        $renderParams['naireid'] = $this->naireid;
        $this->render('info1',$renderParams);
    }

    public function actionEnd()
    {
        $renderParams['naireid'] = $this->naireid;
        $this->render('end',$renderParams);
    }
}
