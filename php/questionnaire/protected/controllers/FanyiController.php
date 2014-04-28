<?php

class FanyiController extends Controller
{
    public function beforeAction()
    {
        
        $this->layout = "fanyi";
        $ret = preg_match("/^\/fanyi\/login/",$_SERVER['REQUEST_URI']);
        if($ret) return true;
        $login = new Login;
        $ret = $login->isLogin();
        // var_dump($ret);
        // exit;
        if(!$ret) $this->redirect('/fanyi/login?url='.urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
        return true;
    }

    public function actionIndex()
    {
        $this->layout = "fanyi";
        $wordmap = new WordMap;
        $allwords = array();
        if((!isset($_REQUEST['eng_word']) && !isset($_REQUEST['chi_word'])) || !empty($_REQUEST['all'])) {
            $allwords = $wordmap->findAll('1=1 order by eng ');
        } elseif(!empty($_REQUEST['query'])&&(!empty($_REQUEST['eng_word'])||!empty($_REQUEST['chi_word']))) {
            $sql = "select * from proword_map where";
            if(!empty($_REQUEST['chi_word'])) {
                $sql .= "  chi1 like '%{$_REQUEST['chi_word']}%' 
                    or chi2 like '%{$_REQUEST['chi_word']}%' 
                    or chi3 like '%{$_REQUEST['chi_word']}%' and";
            }
            if(!empty($_REQUEST['eng_word'])) {
                $sql .= " eng like '%{$_REQUEST['eng_word']}%'"; 
            }
            $sql = Util::cutTail($sql,'and');
            $sql = Util::cutTail($sql,'where');
            $allwords = $wordmap->findAllBySql($sql);
        }
        // var_dump(count($allwords));
        // exit;

        $this->render('index',array('entitys'=>$allwords));
    }

    public function actionLogin()
    {
        $login = new Login;
        if(!empty($_REQUEST['usr'])&&!empty($_REQUEST['pwd'])) {
            $ret = $login->tologin($_REQUEST['usr'],$_REQUEST['pwd']);
            if($ret) $this->redirect(urldecode($_REQUEST['url']));
            else $loginlable = 'no';
        }
        $this->render('login', array(
            'url'=>$_REQUEST['url'],
            'lable'=> isset($loginlable) ? $loginlable : ""
        ));
    }

    public function actionAdd()
    {
        $this->layout = "fanyi";
        $this->render('add');
    }

    public function actionEdit()
    {
        $this->layout = "fanyi";
        $wordmap = new WordMap;
        $words = array();
        foreach($_REQUEST as $k=>$v) {
            $_REQUEST[$k] = trim($v);
        }
        if(!empty($_REQUEST['eng'])&&!empty($_REQUEST['subeng'])) {
            $sql = "select * from proword_map where";
            $sql .= " eng='{$_REQUEST['eng']}'"; 
            $words = $wordmap->findBySql($sql);
            if(empty($words)) $words['eng'] = $_REQUEST['eng'];
        } elseif(empty($_REQUEST['submodify'])&&!empty($_REQUEST['id'])) {
            $words = $wordmap->findByPk($_REQUEST['id']);
        }

        if(!empty($_REQUEST['submodify'])) {
            if(!empty($_REQUEST['id'])) {
                $wordmap->updateByPk($_REQUEST['id'],array(
                    'eng'=>$_REQUEST['eng'],
                    'chi1'=>$_REQUEST['chi1'],
                    'chi2'=>$_REQUEST['chi2'],
                    'chi3'=>$_REQUEST['chi3'],
                    'chapter'=>$_REQUEST['chapter'],
                    'other'=>$_REQUEST['other'],
                ));
            } else {
                $wordmap->eng = $_REQUEST['eng'];
                $wordmap->chi1 = $_REQUEST['chi1'];
                $wordmap->chi2 = $_REQUEST['chi2'];
                $wordmap->chi3 = $_REQUEST['chi3'];
                $wordmap->chapter = $_REQUEST['chapter'];
                $wordmap->other = $_REQUEST['other'];
                $wordmap->save();
            }
            $this->redirect('/fanyi/index?all=11');
        }
        $this->render('edit',array('entity'=>$words));
    }

}
