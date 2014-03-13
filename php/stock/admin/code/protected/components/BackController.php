<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BackController extends Controller
{

				
    public $layout = 'application.modules.main.views.layouts.metronic';//"application.modules.main.views.layouts.frame_without_leftnav";

    public $userid=0;
	public $userInfo = array();
	
    // 页面title
    public $actionName=0;


    protected function beforeAction($action)
    {
    	header("Cache-Control: no-cache, must-revalidate");
    	date_default_timezone_set('PRC');	
    	//return true;
        // 登陆
        preg_match("/(^.*?)\?|(^.*)/",$_SERVER['REQUEST_URI'],$matchs);
        //var_dump($matchs);exit;
        $requestUrl = empty($matchs[1]) ? $matchs[2] : $matchs[1];
        
        //echo $requestUrl;exit;
        // 页面title
        $actionInfo = Action::model()->find("route=:route",array(':route'=>$requestUrl));
        //var_dump($actionInfo);exit;
        if (!empty($actionInfo))
        {
        	$this->actionName = $actionInfo['aname'];
        }
        
        //var_dump($this->actionName);exit;

        $closeUser = Yii::app()->params['close_user'];

        // 登陆限制
        if( $closeUser || (
            $_SERVER['REQUEST_URI']=='/main/user/logout' 
            || preg_match('|^/main/user/login|',$_SERVER['REQUEST_URI']) 
            || preg_match('|^/main/user/register|',$_SERVER['REQUEST_URI'])
            || $requestUrl=='/site/error'
            //|| $requestUrl=='/main/user/initsystem'
        )) 
        {
            return true;
        }

         // get user info
        $userInfo = Login::getLoginInfo();
        //var_dump($userInfo);exit;
        $url = urlencode($_SERVER['REQUEST_URI']);
        //var_dump($url);exit;
        if(empty($userInfo)) $this->redirect('/main/user/login?url='.$url);
        $this->userid = $userInfo['uid'];
        $this->userInfo = $userInfo;      

        // 权限限制
        if($userInfo['uname']=='superman'&&!Privilege::hasPrivilege($userInfo['uid'],$requestUrl)
            && $requestUrl!='/site/index'
            && $requestUrl!='/main/user/lock'
            )
        {
            return false;
        }

        return true;
    }

}
