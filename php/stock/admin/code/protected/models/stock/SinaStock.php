<?php

class SinaStock
{
	public function getIncome($id)
	{
		$param =  array(
			's'=>$id
		);
		$ret = Http::request('http://vip.stock.finance.sina.com.cn/usstock/income.php','GET',$param, $needHeader = false, $timeout = 60);
		var_dump($ret);exit;

	}

/*

var hq_str_gb_qihu="
奇虎360(1名称),
121.53（2价格）,
4.16（3跌涨百分比）,
2014-03-07 09:38:56（4收盘时间）,
4.85（5跌涨金额）,
119.00（6开盘）,
123.43（7当日最高）,
118.37（8当日最低）,
123.43（9 52周最高）,
27.76（10 52周最低）,
6109337（11当日成交量）,
2493136（12 10日平均成交量）,
14923884000（13市值）,
0.73（14每股收益）,
166.48（15市盈率）,
0.00（16）,0.00（17）,
0.00（18）,0.00（19）,
122800000（20股本）,
74.00（21）,
119.30（22盘后价格）,
-1.83（23盘后涨跌百分比）,
-2.23（24盘后涨跌额）,
Mar 06 07:59PM EST（25收盘时间）,
Mar 06 04:03PM EST（26盘后最终交易时间）,
116.68（27前一日收盘价格）,
670164.00（28盘后成交量）";
*/
	public function getRealPriceDetail(array $ids)
	{
		$liststr = '';
		foreach($ids as $id) {
			$liststr .= "gb_".strtolower($id).",";
		}
		$ret = Http::request('http://hq.sinajs.cn?','GET',"list=".$liststr);
		$ret = mb_convert_encoding($ret, "UTF-8", "GB2312");
		$seg1 = explode(";",$ret);
		$priceDetails = array();
		foreach($seg1 as $s) {
			if(strlen($s)<10) continue;
			$ret = preg_match("/var hq_str_gb_(.*)=\"(.*)\"/", $s, $mathchs);
			if(!$ret) continue;
			$id = strtolower($mathchs[1]);
			$seg2 = explode(",",$mathchs[2]);
			if(count($seg2)<20) continue;
			//echo "<pre>";var_dump($seg2);continue;
			$priceDetails[$id] = array(
				'lower_id' => $id,
				'upper_id' => strtoupper($id),
				'name' => $seg2[0],
				'real_price' => $seg2[1],
				'real_price_change_rate' => $seg2[2],
				'real_time' => $seg2[3],
				'real_price_change_amount' => $seg2[4],
				'start_price' => $seg2[5],
				'highprice_today' => $seg2[6],
				'lowerprice_today' => $seg2[7],
				'highprice_52week' => $seg2[8],
				'lowerprice_52week' => $seg2[9],
				'real_share_amount' => $seg2[10],
				'stock_amount_10day' => $seg2[11],
				'market_cap' => $seg2[12],
				'earning_per_share' => $seg2[13],
				'PE' => $seg2[14],
				't1' => $seg2[15],
				't2' => $seg2[16],
				't3' => $seg2[17],
				't4' => $seg2[18],
				'capitalization' => $seg2[19],
				't5' => $seg2[20],
				'after_hour_price' => $seg2[21],
				'after_hour_price_change_rate' => $seg2[22],
				'after_hour_price_change_amount' => $seg2[23],
				'close_time' => $seg2[24],
				'after_hour_time' => $seg2[25],
				'yesterday_close_price' => $seg2[26],
				'after_hour_share_amount' => $seg2[27],
			);
		}
		return $priceDetails;
	}
}


