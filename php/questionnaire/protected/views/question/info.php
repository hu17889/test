<h1 id="page_title">正式问卷1</h1>

<hr> <h2>事件背景:</h2>
<div>本地刚刚发生了13级台风，现有某一区域有四个单位的配电设备损坏造成停电，目前只有一条通路到这四个单位，假设你是抢险队队长，您只要一支抢险队和配套设备，只能一个单位抢修完再去另一个   单位。具体情况如下图表所示。</div>

<hr> <h2>抢修程序:</h2>
<div><p>1.进入该区域，到达设备受损单位，各单位分别位于A、B、C、D四个位置。</p>
     <p>2.抢修设备，抢修时间根据设备受损情况而定。</p>
     <p>3.同一时间只能在一个单位进行作业，没有办法进行两个单位同时作业。</p>
     <p>4.四个单位抢修完毕，或暴雨过大，马上撤离。</p> 
</div>

<hr> <h2>注意事项：</h2>
<div>
<p>1.   每一相邻地点之间的路程是1小时。</p>
<p>2.   台风后会出现大暴雨天气，下大暴雨时，抢修队不能作业，该区域还有山体滑坡的隐患，所以越临近出入口，越安全。但大暴雨发生时间暂时不详。</p>
<p>3.   从主路到受影响单位的时间忽略不计。</p>
</div>

<hr><div id="info">
<div class="info_pannel">
<h2>信息版</h2>
    <table>
    <tr> <th>等距地点</th> <th>设备受损单位</th> <th>备用电源情况</th> <th>预计抢修时间</th> </tr>
    <tr> <th>A</th> <td><p>电视台</p></td> <td><p>有，能支持较短时间</p></td> <td><p>3小时</p></td> </tr>
    <tr> <th>B</th> <td><p>小学</p></td> <td><p>无</p></td> <td><p>5小时</p></td> </tr>
    <tr> <th>C</th> <td><p>医院</p></td> <td><p>有，能支持一段时间</p></td> <td><p>5小时</p></td> </tr>
    <tr> <th>D</th> <td><p>高层住宅</p></td> <td><p>无</p></td> <td><p>10小时</p></td> </tr>;
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
<form action="/question/info1">

    <?php include "info_question.php";?>

    <input type="hidden" name="naireid" value="<?php echo htmlspecialchars($naireid);?>"/>
    <input type="submit" value="下一步" class="nextpage"/>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("#info td p").hide();
    $("#info").on("mousedown","td",function(){
        $(this).children("p").show();
    });
    $("#info").on("mouseup","td",function(){
        $(this).children("p").hide();
    });

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
});
</script>
