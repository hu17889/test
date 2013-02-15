<h1 id="page_title">正式问卷2</h1>
<hr>
<div id="question_pannel">
    <form action="/question/naire3" method="post">

    <?php include "questions_2.php";?>

    <input type="hidden" name="naireid" value="<?php echo htmlspecialchars($naireid);?>"/>
    <input type="hidden" name="expid" value="<?php echo htmlspecialchars($expid);?>"/>
    <input type="submit" value="下一步" class="nextpage"/>
<div>
