<?php

class Question
{
    public function initQuestionDB($qid)
    {
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        if($conn->insert('questionnaire',array('qid'=>$qid))) {
            return true;
        }
        return false;
    }

    public function saveAnswerInfo(array $params)
    {
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        for($i=1;;$i++) {
            $key1 = 'q'.$i;
            $key2 = 'q1'.$i;
            if(empty($params[$key1])) break;
            $updateData[$key2] = $params[$key1];
        }
        // $where = array(
            // 'and',
            // 'qid' => $params['naireid'],
        // );
        $conn->update('questionnaire',$updateData,"qid = {$params['naireid']}");
    }

    public function savePointStartInfo(array $params)
    {
        $pointid = isset($_COOKIE["pointid"]) ? $_COOKIE["pointid"]+1 : "0";
        setcookie("pointid",$pointid);
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        $data = array(
            'qid' => $params['qid'],
            'pid' => $pointid,
            'x' => $params['x'],
            'y' => $params['y'],
            'start_time' => time(),
        );
        return $conn->insert('points',$data);
    }

    public function savePointEndInfo(array $params)
    {
        $pointid = isset($_COOKIE["pointid"]) ? $_COOKIE["pointid"] : "0";
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        $pointInfo = $this->getPointsById($params['qid'],$pointid);
        $intenaltime = time()-$pointInfo[0]['start_time'];
        $data = array(
            'end_time' => time(),
            'time' => $intenaltime,
        );
        $where = array(
            "and",
            "qid={$params['qid']}",
            "pid={$pointid}",
        );
        return $conn->update('points',$data,$where);
    }

    public function getPointsById($qid,$pid)
    {
        $db = Yii::app()->db;
        $sql = "select * from points where qid=:qid and pid=:pid";
        $conn = $db->createCommand($sql);
        $conn->bindParam(":qid",$qid);
        $conn->bindParam(":pid",$pid);
        $conn->execute();
        return $conn->queryAll();
    }
}


