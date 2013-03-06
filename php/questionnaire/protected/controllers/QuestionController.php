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

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
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
        // 初始化
        $model = new Question();
        $model->initQuestionDB($this->naireid);
        // 点击id初始化
        setcookie("pointid","0");

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $this->render('try',$renderParams);
    }

    /**
     * actionNaire1
     *
     * 问卷1，含信息版
     * 
     * @return void
     */
    public function actionNaire1()
    {
        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $this->render('questionnaire1',$renderParams);
    }

    public function actionNaire2()
    {
        // $model = new Question();
        // $model->saveAnswerNaire1($_REQUEST);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $this->render('questionnaire2',$renderParams);
    }

    public function actionNaire3()
    {
        // $model = new Question();
        // $model->saveAnswerNaire2($_REQUEST);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $this->render('questionnaire3',$renderParams);
    }

    public function actionEnd()
    {
        $renderParams['naireid'] = $this->naireid;
        $this->render('end',$renderParams);
    }
}
