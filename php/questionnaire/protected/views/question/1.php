<script type="text/javascript">
    $(document).ready(function(){ 
        var leftSeconds = 60;
        var timeIntervalId;
        $("#btnReg").attr("disabled", true);
        timeIntervalId=setInterval("CountDown()", 1000);
    });
        function CountDown() {
            if(leftSeconds<=0){
                $("#timer").val("同意");
                $("#timer").attr("disabled", false);
                clearInterval(timeIntervalId);
                return;
            }
            leftSeconds--;
            $("#btnReg").val("请仔细阅读，还剩下"+leftSeconds+"秒");
        }
</script>

<div>
<div>
<div id="feature"> o1</div>
<div id=""> o2</div>
</div><br>
<div class="question_panel">o3</div>
</div>
<div id="timer"></div>
