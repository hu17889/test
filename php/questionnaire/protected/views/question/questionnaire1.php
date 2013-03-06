
<div id="direction">
<h3>请观看视频短片并回答以下问题。</h3>

<hr>
<p>强台风过后，现有某一区域有<strong>四个单位</strong>的室外配电设备损坏造成停电，目前<strong>只有一条通路</strong>到这四个单位。假设你是应急抢险队队长，<strong>你的任务</strong>是在台风后的大暴雨来临之前（根据预报大暴雨将在24至48小时内到来）<strong>用尽可能少的时间抢修尽可能多的受损单位</strong>。目前您只有一支抢险队和配套设备，无法两个单位同时抢修，<strong>只能抢修完一个单位再去另一个单位</strong>。由于下大暴雨会导致抢修队无法作业，并且该区域有山体滑坡的隐患，所以当抢修完毕，或暴雨过大时，抢修队需马上撤离，并且<strong>越临近出入口，越安全</strong>。已知四个单位之间是<strong>等距路程</strong>，基本位置如下图表所示。</p>
</div>


<hr>
<button type="button" class="start_answer">开始答题</button>
<div id="question_start">

<div id="info">
<div class="timer">
<p><span class="time_title">计时器<span> <span class="time_show"></span></p>
</div>
<div class="info_pannel">
    <table>
    <tr> <th></th> <th>等距地点</th> <th>设备受损单位</th> <th>备用电源情况</th> <th>预计抢修时间</th> </tr>
    <tr> <th>A</th> <td data-x="1" data-y="1"><p>距出入口3小时</p></td> <td data-x="2" data-y="1"><p>电视台</p></td> <td data-x="3" data-y="1"><p>有，能支持8小时</p></td> <td data-x="4" data-y="1"><p>3小时</p></td> </tr>
    <tr> <th>B</th> <td data-x="1" data-y="2"><p>距出入口2小时</p></td> <td data-x="2" data-y="2"><p>小学</p></td> <td data-x="3" data-y="2"><p>无</p></td> <td data-x="4" data-y="2"><p>5小时</p></td> </tr>
    <tr> <th>C</th> <td data-x="1" data-y="3"><p>距出入口1小时</p></td> <td data-x="2" data-y="3"><p>医院</p></td> <td data-x="3" data-y="3"><p>有，能支持16小时</p></td> <td data-x="4" data-y="3"><p>5小时</p></td> </tr>
    <tr> <th>D</th> <td data-x="1" data-y="4"><p>在出入口处</p></td> <td data-x="2" data-y="4"><p>高层住宅</p></td> <td data-x="3" data-y="4"><p>无</p></td> <td data-x="4" data-y="4"><p>10小时</p></td> </tr>
    </table>
</div>
</div><!--info-->

<hr>
<div id="question_pannel">
<h2>问题</h2>
<form action="/question/naire2" method="post">
    <?php include "questions_1.php";?>
    <input type="hidden" name="naireid" value="<?php echo htmlspecialchars($naireid);?>"/>
    <input type="hidden" name="expid" value="<?php echo htmlspecialchars($expid);?>"/>
    <input type="button" value="下一步" class="nextpage"/>
</form>
</div><!--question_pannel-->

<button id="test">随机填写</button>
</div><!--question_start-->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/question/sort_question.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/question/info_panel.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#question_start").hide();
    // 信息版初始化
    INFO_PANEL.init("<?php echo htmlspecialchars($naireid);?>");


    // 测试数据填写
    $("#test").on('click',function() {
        lastnum = String($("#question_pannel input:radio:last").attr("name"));
        num = lastnum.replace("q","");
        for(i=1;i<=num;i++) {
            val = $("#question_pannel input:radio[name=q"+i+"]:checked");
            if(val.length==0) {
                $("#question_pannel input:radio[name=q"+i+"]")[1].checked=true;
            }
        }
    });

    // 开始答题
    $(".start_answer").on("click",function() {
        $("#question_start").show(1000);
        $(this).hide();
        // 开始计时
        timer();
    });

    // 倒计时
    $("#info .timer .time_show").text(5);
    function timer() {
        var nowTime = 5;
        var timer = setInterval(showTime,1000);
        function showTime() {
            if(nowTime<=0) {
                clearInterval(timer);
                INFO_PANEL.disableEvent();
                return
            }
            nowTime--;
            $("#info .timer .time_show").text(nowTime);
        }
    }

    // 提交答案
    $("#question_pannel input[type=button]").on("click",function(){
        // 核实没填写的题目
        lastnum = String($("#question_pannel input:radio:last").attr("name"));
        num = lastnum.replace("q","");
        for(i=1;i<=num;i++) {
            val = $("#question_pannel input:radio[name=q"+i+"]:checked");
            if(val.length==0) {
                location.hash="q"+i;
                return;
            }
        }
        $("#question_pannel form").submit();
    });
});
</script>
