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
        $model->initQuestionDB($this->naireid,$this->expid);
        // 点击id初始化
        $cache = Yii::app()->cache;
        $cache->set("question_pointid",1);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'try';
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
        // echo "<pre>";
        // var_dump($_REQUEST,$_COOKIE);
        // exit;
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        switch($this->expid) {
        case 1:
        case 2:
        case 6:
            $renderParams["next"] = "naire2";
            break;
        case 3:
            $renderParams["next"] = "naire4";
            break;
        case 4:
        case 5:
            $renderParams["next"] = "naire3";
            break;
        default:
            $renderParams["next"] = "naire1";
        }
        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'info_pannel';
        $this->render('questionnaire1',$renderParams);
    }

    /**
     * actionNaire2 
     *
     * 问卷2，压力
     * 
     * @return void
     */
    public function actionNaire2()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        switch($this->expid) {
        case 1:
            $renderParams["next"] = "naire3";
            break;
        case 6:
            $renderParams["next"] = "naire4";
            break;
        case 2:
            $renderParams["next"] = "naire5";
            break;
        default:
            $renderParams["next"] = "naire2";
        }
        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'press';
        $this->render('questionnaire2',$renderParams);
    }

    /**
     * actionNaire3 
     *
     * 情绪页
     * 
     * @return void
     */
    public function actionNaire3()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        switch($this->expid) {
        case 1:
            $renderParams["next"] = "naire4";
            break;
        case 4:
        case 5:
            $renderParams["next"] = "naire5";
            break;
        default:
            $renderParams["next"] = "naire3";
        }
        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'mood';
        $this->render('questionnaire3',$renderParams);
    }

    /**
     * actionNaire4 
     *
     * 模糊信息页
     * 
     * @return void
     */
    public function actionNaire4()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        switch($this->expid) {
        case 1:
        case 3:
        case 6:
            $renderParams["next"] = "naire5";
            break;
        default:
            $renderParams["next"] = "naire5";
        }
        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'fuzy';
        $this->render('questionnaire4',$renderParams);
    }

    /**
     * actionNaire5 
     *
     * 个人信息页
     * 
     * @return void
     */
    public function actionNaire5()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'personel';
        $this->render('questionnaire5',$renderParams);
    }

    public function actionEnd()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'end';
        $this->render('end',$renderParams);
    }

    public function actionFinish()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);
        return;
    }
}
