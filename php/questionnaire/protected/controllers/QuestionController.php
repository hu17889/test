<?php

class QuestionController extends Controller
{

    public function actionIndex()
    {
		var_dump('adsf');
		exit;
		$renderParams['naireid'] = $this->naireid;
		$this->render('index',$renderParams);
    }


    public function actionTry()
    {
    }
}
