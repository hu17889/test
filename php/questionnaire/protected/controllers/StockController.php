<?php

class StockController extends Controller
{

	public function actionIndex()
	{
		/*
		switch($_REQUEST['group']) {
		case 'low':
			$stocks = array(
				
			);
		}
		 */
		$this->render("index");
	}

}
