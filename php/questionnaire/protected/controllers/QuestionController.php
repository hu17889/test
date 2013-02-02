<?php

class QuestionController extends Controller
{

    /**
     * actionIndex 
     *
     * 实验选择页
     * 
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }


    /**
     * actionWelcome 
     *
     * 欢迎页
     * 
     * @return void
     */
    public function actionWelcome()
    {
        $model = new Question();
        $model->initQuestionDB($this->naireid);
        $renderParams['naireid'] = $this->naireid;
        $this->render('welcome',$renderParams);
    }


    /**
     * actionTry 
     *
     * 试玩页
     * 
     * @return void
     */
    public function actionTry()
    {
        setcookie("pointid","0");
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
