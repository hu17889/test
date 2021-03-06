<?php

class QuestionController extends Controller
{

    public function actionDrawPointResult()
    {
        $this->layout = "main_chi";
        $qid = empty($_REQUEST['qid']) ? "" : $_REQUEST['qid'];
        $_REQUEST['lang'] = empty($_REQUEST['lang']) ? "chi" : $_REQUEST['lang'];
        $qmodel = new Question;
        $points = array();
        if(!empty($qid)) {
            $points = $qmodel->getPointsByNaireId($qid);
        }
        // echo "<pre>";
        // var_dump($qid, $points);
        // exit;
        $this->qrender("draw1", array('points'=>$points,'lang'=>$_REQUEST['lang'],'qid'=>$qid));
    }

    public function qrender($file,$params=array())
    {
        $params["debug"]=isset($_REQUEST["debug"])&&$_REQUEST["debug"]==1 ? 1 : 0;
        if(isset($_REQUEST["lang"])&&$_REQUEST["lang"]=="eng") {
            $this->layout = "main_eng";
            $file = "eng/{$file}";
        // var_dump($_REQUEST,$file);
        // exit;
        } else {
            $this->layout = "main_chi";
            $file = "chi/{$file}";
        }
        $this->render($file,$params);
    }

	public function actionRand()
	{
		$cache = Yii::app()->cache;
		$expid = $cache->get("last_expid");
		if(empty($expid)) {
			$expid = 1;
		}
		switch($expid) {
		case "1":
			$expid = "2";
			break;
		case "2":
			$expid = "3";
			break;
		case "3":
			$expid = "4";
			break;
		case "4":
			$expid = "5";
			break;
		case "5":
			$expid = "6";
			break;
		case "6":
			$expid = "1";
			break;
		}
		$cache->set("last_expid",$expid);
		$this->redirect("/question/try?lang=chi&expid={$expid}&debug=0");
	}

    /**
     * actionIndex 
     *
     * 实验选择页
     * 
     * @return void
     */
    public function actionIndex()
    {
        $this->layout = "main_eng_chi";
        $params["debug"]=isset($_REQUEST["debug"])&&$_REQUEST["debug"]==1 ? 1 : 0;
        $this->render('index',$params);
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
        $this->qrender('welcome',$renderParams);
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
        $cache->set("question_pointid".$this->naireid,1);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'try';
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('try',$renderParams);
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
        // var_dump($_REQUEST);
        // exit;
        // echo "<pre>";
        // var_dump($_REQUEST,$_COOKIE);
        // exit;
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        switch($this->expid) {
        case 2:
        case 6:
            $renderParams["next"] = "naire2";
            break;
        case 3:
            $renderParams["next"] = "naire4";
            break;
        case 1:
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
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('questionnaire1',$renderParams);
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
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('questionnaire2',$renderParams);
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
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('questionnaire3',$renderParams);
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
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('questionnaire4',$renderParams);
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
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('questionnaire5',$renderParams);
    }

    public function actionEnd()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);

        $renderParams['naireid'] = $this->naireid;
        $renderParams['expid'] = $this->expid;
        $renderParams['savetype'] = 'end';
        $renderParams['lang'] = isset($_REQUEST["lang"])?$_REQUEST["lang"]:"chi";
        $this->qrender('end',$renderParams);
    }

    public function actionFinish()
    {
        $model = new Question();
        $model->saveAnswer($_REQUEST,$_REQUEST['savetype']);
        return;
    }
}
