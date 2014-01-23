    <div class="top">
        <span class="user_search">
            <form method="post" action="/main/user/list">
                <input name='name' type="text" onfocus="if (value =='用户名'){value =''}" onblur="if (value ==''){value='用户名'}" value="用户名" />
                <input type="submit" style="font-size:14px;" value="&nbsp;查&nbsp;询&nbsp;"/>
            </form>
        </span>
        <span>用户管理</span>
    </div>
    <div class="cont">
        <div class="user_tittle">
            <span>
                <a href="/main/user/edit">
                </a>
            </span>
            用户列表
        </div>
        <div class="info_list">
            <div class="user_list_top">
                <ul>
                    <li class="user_li_1">帐号id</li>
                    <li class="user_li_2">用户名</li>
                    <li class="user_li_3">邮箱</li>
                    <li class="user_li_4">身份</li>
                    <li class="user_li_5">操作</li>
                </ul>
            </div>
            <ul class="myinfo_list_cont">
            </ul>

        </div>
    </div>


<script>

(function($){
    $countElems = <?php echo count($entitys);?>;
    $countPerPage = 20;
    tbody = new Array();
        <?php  foreach($entitys as $e) { ?>
            <?php if(!empty($e)) {?>
            content = " <li id='<?php echo htmlspecialchars($e['uid']);?>'><div>"
                + "<span class='user_li_1'><?php echo htmlspecialchars($e['uid']);?></span>"
                + "<span class='user_li_2'><?php echo htmlspecialchars($e['uname']);?></span>"
                + "<span class='user_li_3'><?php echo htmlspecialchars($e['email']);?></span>"
                + "<span class='user_li_4'><?php echo htmlspecialchars($e['rname']);?></span>"
                + "<span class='user_li_5'>"
                + "<a href='/main/user/edit?id=<?php echo htmlspecialchars($e['uid']);?>'></a> &nbsp;&nbsp;&nbsp;&nbsp;"
                + "<a href='/main/user/del?id=<?php echo htmlspecialchars($e['uid']);?>'></a></span>"
                + "</div></li>";
            tbody.push(content);
            <?php } ?>
        <?php } ?>

    // 分页
    loadContents = function(page) {
        max = (page+1)*$countPerPage;
        $content = '';
        for(i=page*$countPerPage;i<max;i++) {
            if(tbody[i]==undefined) continue;
            $content += tbody[i];
        }
        $(".myinfo_list_cont").html($content);
        /*
        $(".modify").on('click',function(){
            $id = $(this).parents("tr").children(".td_id").text();
            window.location.href="/main/user/edit?id="+$id;
        });
        */
    }
    loadContents(0);
})(jQuery);
</script>
