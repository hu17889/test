<h1 id="page_title">正式问卷1</h1>
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
