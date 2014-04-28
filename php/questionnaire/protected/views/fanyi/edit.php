<h1>修改</h1>
<hr>
<form method="post" action='/fanyi/edit'>
id:<?php if(!empty($entity['id'])) echo $entity['id']; ?><br>
<input type="hidden" name="id" value="<?php if(!empty($entity['id'])) echo $entity['id']; ?>"/><br>
英文:<input type="text" name="eng" value="<?php if(!empty($entity['eng'])) echo $entity['eng']; ?>"/><br>
中文1:<input type="text" name="chi1" value="<?php if(!empty($entity['chi1'])) echo $entity['chi1']; ?>"/><br>
中文2:<input type="text" name="chi2" value="<?php if(!empty($entity['chi2'])) echo $entity['chi2']; ?>"/><br>
中文3:<input type="text" name="chi3" value="<?php if(!empty($entity['chi3'])) echo $entity['chi3']; ?>"/><br>
章节:<textarea rows="10" cols="30" name="chapter" value="<?php if(!empty($entity['chapter'])) echo $entity['chapter']; ?>"><?php if(!empty($entity['chapter'])) echo $entity['chapter']; ?></textarea><br>
备注:<textarea rows="10" cols="30" name="other" value="<?php if(!empty($entity['other'])) echo $entity['other']; ?>"><?php if(!empty($entity['other'])) echo $entity['other']; ?></textarea><br>
<input type="submit" name="submodify" value="提交"/>
</form>
<script>
(function($){
})(jQuery);
</script>
