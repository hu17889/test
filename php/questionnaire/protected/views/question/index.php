<div id="index">
<button value="experiment_1">实验一</button>
<button value="experiment_2">实验二</button>
<button value="experiment_3">实验三</button>
<button value="experiment_4">实验四</button>
<button value="experiment_5">实验五</button>

</div>

<script type="text/javascript">
$(function(){
    $("#index button").on("click",function(){
        $exp = new String($(this).val());
        $id = $exp.replace(/experiment_/,"");
        location.href="/question/welcome?expid="+$id;
    });
});
</script>
