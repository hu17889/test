<h1 id="page_title">使用说明及试用</h1>
<div id="direction">
<h2>说明:</h2>
<p>1. 信息版中列表示属性，行表示不同地点</p>
<p>2. 信息版中的内容是隐藏的，鼠标点击后出出现隐藏内容，不点击保持隐藏</p>
</div>
<hr>
<div id="info">
<div class="info_pannel">
<h2>信息版</h2>
    <table>
    <tr> <th></th> <th>R1</th> <th>R2</th> </tr>
    <tr> <th>C1</th> <td><p>My first HTML</p></td> <td><p>$53</p></td> </tr>
    <tr> <th>C2</th> <td><p>My first HTML</p></td> <td><p>$53</p></td> </tr>
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
<form action="/question/naire1" method="post">
    <input type="hidden" name="naireid" value="<?php echo htmlspecialchars($naireid);?>"/>
    <input type="hidden" name="expid" value="<?php echo htmlspecialchars($expid);?>"/>
    <input type="submit" value="下一步" class="nextpage"/>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	la_info_end = false;
	$("#info td p").hide();
	$("#info td").css('background-color','#808080');
	$("#info").on("mousedown","td",function(){
		if(!la_info_end) {
			$(this).css('background-color','white');
			$(this).children("p").show();
		}
	});
	$("#info").on("mouseup","td",function(){
		$("#info td").css('background-color','#808080');
		$("#info td").children("p").hide();
	});

	$("#info .timer").children("p").text(5);
	$("#info .start").on("click",function(){
		var nowTime = 5;
		var timer = setInterval(showTime,1000);
		function showTime() {
			if(nowTime<=0) {
				clearInterval(timer);
				//关闭信息版点击
				la_info_end=true;
				return
			}
			nowTime--;
			$("#info .timer").children("p").text(nowTime);
		}
	});
});
</script>
