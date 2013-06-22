<h1>术语列表</h1>
<hr>
<form method="post" action="/fanyi/index">
英文:<input type="text" name="eng_word"/>
中文:<input type="text" name="chi_word"/>
<input type="submit" name="query" value="查询"/>
<input type="submit" name="all" value="查询所有"/>
</form>
<button id="addnew">新增</button>
<hr>
<table id="elem_table" cellpadding="0" cellspacing="0" border="0" class="stdtable">
    <thead class="center">
    <tr>
        <th width="3%" style='text-align:left'>id</th>
        <th width="10%" style='text-align:left'>英文</th>
        <th width="10%" style='text-align:left'>中文1</th>
        <th width="10%" style='text-align:left'>中文2</th>
        <th width="10%" style='text-align:left'>中文3</th>
        <th width="20%" style='text-align:left'>章节</th>
        <th width="20%" style='text-align:left'>备注</th>
        <th width="5%" style='text-align:left'>操作</th>
    </tr>
    </thead>
    <tbody id="wordlist" class="center">
    </tbody>
</table>
<div id="pagination" class="pagination"></div>

<script src="/js/jquery.pagination.js"></script>
<link rel="stylesheet" type="text/css" href="/css/pagination.css"/>
<script>

(function($){
    $("#addnew").on('click',function(){
        window.location.href="/fanyi/add";
    });
    $(".modify").on('click',function(){
        $id = $(this).parents("tr").children(".td_id").text();
        window.location.href="/fanyi/edit?id="+$id;
    });
    $countElems = <?php echo count($entitys);?>;
    $countPerPage = 50;
    tbody = new Array();
        <?php  foreach($entitys as $e) { ?>
            content = " <tr id='tr_<?php echo htmlspecialchars($e['id']);?>'>"
                + "<td class='td_id'><?php echo htmlspecialchars($e['id']);?></td>"
                + "<td class='td'><?php echo htmlspecialchars($e['eng']);?></td>"
                + "<td class='td'><?php echo htmlspecialchars($e['chi1']);?></td>"
                + "<td class='td'><?php echo htmlspecialchars($e['chi2']);?></td>"
                + "<td class='td'><?php echo htmlspecialchars($e['chi3']);?></td>"
                + "<td class='td'><?php echo htmlspecialchars($e['chapter']);?></td>"
                + "<td class='td'><?php echo htmlspecialchars($e['other']);?></td>"
                + "<td class='td'><button class='modify'>修改</button></td>"
                + "</tr>";
            tbody.push(content);
        <?php } ?>

    // 分页
    loadContents = function(page) {
        max = (page+1)*$countPerPage;
        $content = '';
        for(i=page*$countPerPage;i<max;i++) {
            $content += tbody[i];
        }
        $("#wordlist").html($content);
    }
    $("#pagination").pagination($countElems, {
        items_per_page:$countPerPage,
        callback:loadContents
    });
})(jQuery);
</script>
