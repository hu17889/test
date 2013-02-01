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
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        $data = array(
            'qid' => $params['qid'],
            'x' => $params['x'],
            'y' => $params['y'],
            'start_time' => time(),
        );
        return $conn->insert('points',$data);
    }

    public function savePointEndInfo(array $params)
    {
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        $pointInfo = $this->getPointsById($params['qid']);
        var_dump($pointInfo);
        exit;
        $data = array(
            'end_time' => time(),
            'time' => time()
        );
        return $conn->insert('points',$data);
    }

    public function getPointsById($qid)
    {
        $db = Yii::app()->db;
        $sql = "select * from points where qid=:qid";
        $conn = $db->createCommand($sql);
        $conn->bindParam(":qid",$qid);
        $conn->execute();
        return $conn->queryAll();
    }
}


