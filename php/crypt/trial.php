<?php

/*
    试玩model模块
*/

include_once APP_MODULE_PATH."/trial/config/config.php";

class Trial_Trial
{
    
    private  static $expQid = 8000000000;   //先设定其基数号段为 80亿外的数 用于 试玩失败生成失败
    public   $trialDao = NULL;

    public function __construct()
    {
        $this->trialDao = new Trial_Dao_Trial();
    }
    
    public function getQid() 
    {
    
        $create_date         = date('Y-m-d');        
        $arr = array(
            'create_date'  => $create_date,
            'is_register'  => 'no',
        );
       
        $qidArr = json_decode($this->getQidFromCookie(),true);
        
        if (empty($qidArr)) {
            $id = $this->trialDao->insert($arr);
            if ($id == 0) {
                $errorLog = 'create_trial_code_error';
                Logger_Logger::instance()->logError(__METHOD__ ,'create_trial_code',$errorLog);
                $qidArr['qid'] = self::$expQid + rand(1,10000000);
                $qidArr = array_merge($qidArr,$arr);
                return $qidArr;
            }        
            $qid = $id + QIDBASE;
            
            $qidArr['qid'] = $qid;
            
            $qidArr = array_merge($qidArr,$arr);
            
            $this->setCookieQid(json_encode($qidArr));    //种cookie
        }
        
/*      else {
            unset($arr['create_date']);
            $arr['id'] = $qidArr['qid'] - QIDBASE;            
            $this->trialDao->updateQidList($arr);
        } 
*/

        return $qidArr;
    }
    
    
    public function searchQid($qid)
    {
        $id = $qid - QIDBASE;
        return $this->trialDao->getId($id);
    }

    
    /**
     * setCookieQid 
     *
     * 将qid存入cookie
     * 
     * @param mixed $qId 
     * @return void
     */
     
    public function setCookieQid($qidArr) 
    {
        header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');  //可以在iframe中种cookie
        $mcrypt = new Mcrypt_BaseNew();
        $iv     = $mcrypt->getIv();
        $orderIdEnc = $mcrypt->encrypt($qidArr);
        setcookie('abc9',$iv,time()+5184000,'/');         //先设置为  60天
        setcookie('tryid',$orderIdEnc,time()+5184000,'/');
        $mcrypt->end();
    }
    
    public function delCookieQid($qidArr) 
    {
        $mcrypt = new Mcrypt_BaseNew();
        $iv     = $mcrypt->getIv();
        $orderIdEnc = $mcrypt->encrypt($qidArr);
    //    var_dump($orderIdEnc); exit;
        setcookie('abc9',$iv,time()-3600,'/');         //删除  cookie
        setcookie('tryid',$orderIdEnc,time()-3600,'/');
        $mcrypt->end();
    }
    
    
    /**
     * getOrderIdFromCookie 
     *
     * 从cookie中获取qid
     * 
     * @return void
     */
    public function getQidFromCookie()
    {
        if(!isset($_COOKIE['abc9'])||!isset($_COOKIE['tryid'])) {
            return '';
        }
        $iv = $_COOKIE['abc9'];
        $orderIdEnc = $_COOKIE['tryid'];
        $mcrypt = new Mcrypt_BaseNew('',$iv);
        $orderIdDec = $mcrypt->decrypt($orderIdEnc);
        $mcrypt->end();
        return $orderIdDec;
    }
    
    public function updateRegisterQid($qid) {
        $id = $qid - QIDBASE;
        
        $arr = array (
            'id'           => $id,
            'is_register'  => 'yes',
        );
        
        $this->trialDao->updateQidList($arr);
    }
    
    public function getAppSecret($appkey) 
    {
        $appSecret = '';
        if (!empty($appkey)) {
            $storeApp = new Qodev_App();
            $app = $storeApp->find($appkey); 
            if (!empty($app['appsecret'])) {
                $appSecret = $app['appsecret'];
            }
        }
        return $appSecret;
    }
    
    public function getTrialUserSignature($appkey,$appSecret,$qid,$username) 
    {
        $ret = array();    
        $user['name'] = $username;
        $user['id']   = $qid;                
        $user['avatar'] = 'http://u.qhimg.com/qhimg/quc/48_48/19/01/44/190144aq118a4e.451ab3.jpg'."?f={$appkey}";
        $timestamp = time();
        $ret['timestamp'] = $timestamp;
        $ret['signature'] = md5($user['name'].$user['id'].$user['avatar'].$timestamp.$appkey.$appSecret);                   
        $ret = array_merge($user,$ret);           
        return $ret;        
    }
    
    
    
}

