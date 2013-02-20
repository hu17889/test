<h1 id="page_title">正式问卷2</h1>
<hr>
<div id="question_pannel">
    <form action="/question/naire3" method="post">

    <?php include "questions_2.php";?>

    <input type="hidden" name="naireid" value="<?php echo htmlspecialchars($naireid);?>"/>
    <input type="hidden" name="expid" value="<?php echo htmlspecialchars($expid);?>"/>
    <input type="submit" value="下一步" class="nextpage"/>
	</form>
<div>

<br>
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
				$("#question_pannel input:radio[name=q"+i+"]:nth(0)").attr("checked",true);
            }
        }
	});
});
</script>
