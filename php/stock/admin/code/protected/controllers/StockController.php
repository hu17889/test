<?php

class StockController extends BackController
{
	public function actionWhole()
	{
		$i=0;
		$params = array();
		$params['ids'] = '';
		$params['ex_ids'] = array(); 
		$params['price_details'] = array(); 
		if(!empty($_REQUEST['ids'])) {
			$ids = explode(",",$_REQUEST['ids']);
			foreach($ids as $v) {
				if(!empty($v)) {
					$idret[] = trim($v);
				}
			}
 			$params['ex_ids'] = $idret;
			$stock = new SinaStock;
			$params['price_details'] = $stock->getRealPriceDetail($idret);
			$idkeys = array_keys($params['price_details']);
			$params['ids'] = implode(",", $idkeys);
		}
		$this->render('whole',$params);
	}
}


