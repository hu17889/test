<h1 id="page_title">正式问卷1</h1>

<hr> <h2>事件背景:</h2>
<div>本地刚刚发生了13级台风，现有某一区域有四个单位的配电设备损坏造成停电，目前只有一条通路到这四个单位，假设你是抢险队队长，您只要一支抢险队和配套设备，只能一个单位抢修完再去另一个   单位。具体情况如下图表所示。</div>

<br> <hr> <h2>抢修程序:</h2> <div><p>1.进入该区域，到达设备受损单位，各单位分别位于A、B、C、D四个位置。</p>
     <p>2.抢修设备，抢修时间根据设备受损情况而定。</p>
     <p>3.同一时间只能在一个单位进行作业，没有办法进行两个单位同时作业。</p>
     <p>4.四个单位抢修完毕，或暴雨过大，马上撤离。</p> 
</div>

<hr> <h2>注意事项:</h2>
<div>
<p>1.   每一相邻地点之间的路程是1小时。</p>
<p>2.   台风后会出现大暴雨天气，下大暴雨时，抢修队不能作业，该区域还有山体滑坡的隐患，所以越临近出入口，越安全。但大暴雨发生时间暂时不详。</p>
<p>3.   从主路到受影响单位的时间忽略不计。</p>
</div>

<hr><div id="info">
<div class="info_pannel">
<h2>信息板:</h2>
    <table>
    <tr> <th></th> <th>等距地点</th> <th>设备受损单位</th> <th>备用电源情况</th> <th>预计抢修时间</th> </tr>
    <tr> <th>A</th> <td data-x="1" data-y="1"><p>距出入口3小时</p></td> <td data-x="2" data-y="1"><p>电视台</p></td> <td data-x="3" data-y="1"><p>有，能支持8小时</p></td> <td data-x="4" data-y="1"><p>3小时</p></td> </tr>
    <tr> <th>B</th> <td data-x="1" data-y="2"><p>距出入口2小时</p></td> <td data-x="2" data-y="2"><p>小学</p></td> <td data-x="3" data-y="2"><p>无</p></td> <td data-x="4" data-y="2"><p>5小时</p></td> </tr>
    <tr> <th>C</th> <td data-x="1" data-y="3"><p>距出入口1小时</p></td> <td data-x="2" data-y="3"><p>医院</p></td> <td data-x="3" data-y="3"><p>有，能支持16小时</p></td> <td data-x="4" data-y="3"><p>5小时</p></td> </tr>
    <tr> <th>D</th> <td data-x="1" data-y="4"><p>在出入口处</p></td> <td data-x="2" data-y="4"><p>高层住宅</p></td> <td data-x="3" data-y="4"><p>无</p></td> <td data-x="4" data-y="4"><p>10小时</p></td> </tr>
    </table>
</div>
<div class="timer">
<h2>计时器</h2>
<p></p>
<button type="button" class="start">开始计时</button>
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
</div>
<button id="test">随机填写</button>

<script type="text/javascript">
$(document).ready(function(){
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

    // 信息版
    INFO_PANEL = {
        id : '#info',

        /**
         *  初始化 信息版展现，事件绑定
         */
        init : function() {
            // init html css
            INFO_PANEL_CONTENT.bindevent('mousedown',function() {
                $.post(
                    '/Stat/PointStat',
                    {
                        type : "down",
                        qid : "<?php echo htmlspecialchars($naireid);?>",
                        x : $(this).data("x"),
                        y : $(this).data("y")
                    },
                    function(data) {
                        console.log(data);
                    }
                );
                INFO_PANEL_CONTENT.show($(this));
            });

            INFO_PANEL_CONTENT.bindevent('mouseup',function() {
                $.post(
                    '/Stat/PointStat',
                    {
                        type : "up",
                        qid : "<?php echo htmlspecialchars($naireid);?>",
                    },
                    function(data) {
                        console.log(data);
                    }
                );
                INFO_PANEL_CONTENT.hideAll();
            });

            INFO_PANEL_CONTENT.hideAll();
        },
    };

    // 信息版内容块
    INFO_PANEL_CONTENT = {
        id : '#info td',
        
        /**
         *  给每个内容块绑定事件
         */
        bindevent : function(eventname, func) {
            $(this.id).on(eventname,func);
        },

        /**
         *  隐藏所有内容块的文本
         */
        hideAll : function() {
            $("#info td p").hide();
            $(this.id).css('background-color','#808080');
        },

        /**
         *  展现一个内容块的文本
         */
        show : function(item) {
            item.css('background-color','white');
            item.children("p").show();
        }
    };

    INFO_PANEL.init();

    // 倒计时
    $("#info .timer").children("p").text(60);
    $("#info .start").on("click",function(){
        var nowTime = 60;
        var timer = setInterval(showTime,1000);
        function showTime() {
            if(nowTime<=0) {
                clearInterval(timer);
                return
            }
            nowTime--;
            $("#info .timer").children("p").text(nowTime);
        }
    });

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
