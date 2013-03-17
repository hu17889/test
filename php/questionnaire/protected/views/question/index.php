<div id="index">
<button value="experiment_1">1对照组</button>
<button value="experiment_2">2时间压力</button>
<button value="experiment_3">3模糊信息</button>
<button value="experiment_4">4积极情绪</button>
<button value="experiment_5">5消极情绪</button>
<button value="experiment_6">6压力模糊</button>

</div>

<script type="text/javascript">
$(function(){
    $("#index button").on("click",function(){
        $exp = new String($(this).val());
        $id = $exp.replace(/experiment_/,"");
        location.href="/question/try?expid="+$id;
    });
});
</script>
