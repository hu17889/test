<?php

class Question
{
    /**
     * initQuestionDB 
     *
     * 初始化问卷db
     * 
     * @param mixed $qid 
     * @return void
     */
    public function initQuestionDB($qid)
    {
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        if($conn->insert('questionnaire',array('qid'=>$qid))) {
            return true;
        }
        return false;
    }

    /**
     * saveAnswerMultiChoise 
     * 
     * 保存问卷答案--选择题
     *
     * @param array $params 
     * @param mixed $keyFrom  输入的题目name前缀
     * @param mixed $keyTo db中的题目name前缀
     * @return void
     */
    public function saveAnswerMultiChoise(array $params,$keyFrom,$keyTo)
    {
        $db = Yii::app()->db;
        $conn = $db->createCommand();
        for($i=1;;$i++) {
            $key1 = $keyFrom.$i;
            $key2 = $keyTo.$i;
            if(empty($params[$key1])) break;
            $updateData[$key2] = $params[$key1];
        }
        $conn->update('questionnaire',$updateData,"qid = {$params['naireid']}");
    }

    public function saveAnswerNaire1(array $params)
    {
        $this->saveAnswerMultiChoise($params,'q','q1');
    }

    public function saveAnswerNaire2(array $params)
    {
        $this->saveAnswerMultiChoise($params,'q','q2');
    }

    public function saveAnswerNaire3(array $params)
    {
        $this->saveAnswerMultiChoise($params,'q','q3');
    }

    /**
     * savePointStartInfo 
     *
     * 保存信息版按钮按下后的信息
     * 
     * @param array $params 
     * @return void
     */
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

    /**
     * savePointEndInfo 
     *
     * 保存信息版按钮弹起的信息
     * 
     * @param array $params 
     * @return void
     */
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

    /**
     * getPointsById 
     *
     * 查询点击信息
     * 
     * @param mixed $qid 
     * @param mixed $pid 
     * @return void
     */
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


