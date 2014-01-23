<?php

class ActionController extends Controller
{
    public $layout = '/layouts/metronic';

    public function actionIndex()
    {
        $this->redirect('/main/action/list');
    }

    public function actionList()
    {
        $this->render('list');
    }

    public function actionListajax()
    {
        //echo "<pre>";var_dump($_REQUEST);exit;
        $pageStart = isset($_REQUEST["iDisplayStart"]) ? intval($_REQUEST["iDisplayStart"]) : 0;
        $pageLen = isset($_REQUEST["iDisplayLength"]) ? intval($_REQUEST["iDisplayLength"]) : 10;
        $orderCol = isset($_REQUEST["iSortCol_0"]) ? intval($_REQUEST["iSortCol_0"]) : 0;
        $orderDir = isset($_REQUEST["sSortDir_0"])&&in_array($_REQUEST["sSortDir_0"], array("asc","desc")) ? $_REQUEST["sSortDir_0"] : "asc";
        $searchContent = isset($_REQUEST["sSearch"]) ? $_REQUEST["sSearch"] : "";

        // action column name
        $colNames = Action::model()->attributeNames();
        $totalNum = Action::model()->count();
        $numAfterFilter = Action::model()->count();
        $criteria=new CDbCriteria;
        $criteria->select = '*';  // 只选择 'title' 列
        if(!empty($searchContent)) {
            $criteria->condition = "aname like '%{$searchContent}%' or route like '%{$searchContent}%'";
        }
        $criteria->limit = $pageLen;
        $criteria->offset = $pageStart;
        $criteria->order = $colNames[$orderCol]." ".$orderDir;
        $actionInfos = Action::model()->findAll($criteria);
        //var_dump($actionInfos);exit;

        $entitys = array();
        foreach ($actionInfos as $v) {
            $t = Action::model()->find("aid={$v['first_menu']}");
            $data = array(
                0=>$v['aid'],
                1=>$v['aname'],
                2=>$v['route'],
                3=>$v['is_menu'],
                4=>$t['aname'],
                5=>'<a class="edit" href="/main/action/edit?id={$v["aid"]}">Edit</a>',
            );
            $entitys[] = $data;
        }

        $retData = array(
            "sEcho" => intval($_REQUEST['sEcho']),
            "iTotalRecords" => $totalNum,
            "iTotalDisplayRecords" => $numAfterFilter,
            "aaData" => $entitys,
        );
        echo json_encode($retData);

    }


    public function actionEdit()
    {
        $action = new Action;
        $actionInfo = array();
        $label = '';
        foreach($_REQUEST as $k=>$v) {
            $_REQUEST[$k] = trim($v);
        }

        $menutype = isset($_REQUEST['menu_type']) ? $_REQUEST['menu_type'] : '0';
        $whichFirstMenu = isset($_REQUEST['firstmenu']) ? $_REQUEST['firstmenu'] : '-1';
        $firstmenus = Action::model()->findAll('is_menu=1');
        if(isset($_REQUEST['id'])&&$_REQUEST['id']!='') {
            // 修改
            $actionInfo = $action->find('aid=:id',array(':id'=>$_REQUEST['id']));
            if(!empty($_REQUEST['modify'])) {
                $action->updateByPk($_REQUEST['id'],array(
                    'aname'=>$_REQUEST['name'],
                    'route'=>$_REQUEST['route'],
                    'is_menu'=>$menutype,
                    'first_menu'=>$whichFirstMenu,
                ));
                $this->redirect('/main/action/list');
            }
        } elseif(!empty($_REQUEST['name'])) {
            // 新增
            $actionInfo = $action->find('aname=:name',array(':name'=>$_REQUEST['name']));
            if(!empty($actionInfo)) {
                $this->render('edit',array(
                    'firstmenus'=>$firstmenus,
                    'entity'=>$actionInfo[0],
                    'label'=>'has_action',
                ));
                exit;
            }
            if(!empty($_REQUEST['modify'])) {
                $action->aname = $_REQUEST['name'];
                $action->route = $_REQUEST['route'];
                $action->is_menu = $menutype;
                $action->first_menu = $whichFirstMenu;
                $action->save();
                $this->redirect('/main/action/list');
            }
        }

        $this->render('edit',array(
            'firstmenus'=>$firstmenus,
            'entity'=>$actionInfo,
            'label'=>$label,
        ));
    }
}
