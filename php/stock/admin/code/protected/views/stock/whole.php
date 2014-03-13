<div class='row'>
<div class="col-md-12">
<form class="form-inline" role="form" action="/stock/whole" method="post">
	<div class="form-group">
		<label class="sr-only" for="">股票代码</label>
		<input type="text" class="form-control" id="" name="ids" placeholder="输入股票代码">
        <span class="help-block">例如：PLUG,qihu,tsla,yy,bldp,fcel,scty,ccih,zbb,wbai</span>
	</div>
	<button type="submit" class="btn btn-default blue ">批量查询</button>
</form>						
</div>
</div>
<hr>

<!--BEGIN CONTROL PANEL-->
<?php if(!empty($price_details)) {?>
<div class="row">
    <div class="col-md-12">
        <button id="open_all_stock_panel" class="btn btn-default blue ">全部展开</button>
        <button id="close_all_stock_panel" class="btn btn-default blue ">全部关闭</button>
    </div>
</div>
<?php }?>
<!--END CONTROL PANEL-->

<!--BEGIN MAIN CONENT-->
<div class='row' style="position:relative;">
<div class="col-md-12">
<div class='row'>
<!--BEGIN LEFT CONENT-->
<div class="stock_pan">
<?php foreach($price_details as $id=>$v) {?>
<!--BEGIN ONE STOCK-->
<div class='row' id='stock_content_<?php echo htmlspecialchars($id);?>'> <div class="col-md-12">
<div class="portlet box stockportlet <?php if($v['real_price_change_amount']<0) echo Yii::app()->params['colors'][1]; elseif($v['real_price_change_amount']==0) echo Yii::app()->params['colors'][2]; else echo Yii::app()->params['colors'][0];?>">
	<div class="portlet-title">
		<div class="caption">
            <i class="fa fa-reorder"></i><span class="stock_title_name"><?php echo htmlspecialchars($v['name']);?></span>&nbsp&nbsp
            <small class='desc'><?php echo htmlspecialchars($v['real_price'])."&nbsp&nbsp".htmlspecialchars($v['real_price_change_amount'])."&nbsp&nbsp(".htmlspecialchars($v['real_price_change_rate'])."%)";?> </small>
        </div>
		<div class="tools">
			<a href="javascript:;" class="collapse portletarrow"></a>
			<a href="" class="remove"></a>
		</div>
	</div>
	<div class="portlet-body">
        <div class="portlet">
        <div class='row'> 
            <div class="stock_flash_div">
            <object type="application/x-shockwave-flash" data="http://i1.sinaimg.cn/cj/yw/flash/us0106wsa.swf" class="stock_flash"  >
                <param name="allowFullScreen" value="true">
                <param name="allowScriptAccess" value="always"><param name="wmode" value="transparent">
                <param name="freq" value="30">
                <param name="flashvars" value="symbol=usr_<?php echo htmlspecialchars($id);?>&amp;lastfive=50000">
            </object>
            </div> 
            <div class="stock_detail_div">
                <div class="tabbable-custom ">
                    <ul class="nav nav-tabs ">
                        <li class="active"><a href="#tab_5_1" data-toggle="tab">实时行情</a></li>
                        <li><a href="#tab_5_2" data-toggle="tab">利润和营收</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_5_1">
                        <div class="hq_details" id="hqDetails">
                            <table  border="0" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="b_right">详细行情</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>开盘：</th>
                                        <td class="detail_start_price" ><?php echo htmlspecialchars($v['start_price'])?></td>
                                        <th>前收盘：</th>
                                        <td class="b_right detail_yesterday_close_price"><?php echo htmlspecialchars($v['yesterday_close_price'])?></td>
                                    </tr>
                                    <tr>
                                        <th>成交量：</th>
                                        <td class="detail_real_share_amout"><?php echo htmlspecialchars(number_format($v['real_share_amount']/10000,2,'.',''))?>万</td>
                                        <th>区间：</th>
                                        <td class="b_right detail_price_interval"><?php echo htmlspecialchars($v['lowerprice_today'])?>-<?php echo htmlspecialchars($v['highprice_today'])?></td>
                                    </tr>
                                    <tr>
                                        <th>10日均量：</th>
                                        <td><?php echo htmlspecialchars(number_format($v['stock_amount_10day']/10000,2,'.',''))?>万</td>
                                        <th>52周区间：</th>
                                        <td class="b_right"><?php echo htmlspecialchars($v['lowerprice_52week'])?>-<?php echo htmlspecialchars($v['highprice_52week'])?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <table border="0" cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="4" class="space_left">基本面摘要</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="space_left" title="股价/每股收益TTM">市盈率：</th>
                                        <td class="detail_pe"><?php echo htmlspecialchars($v['PE'])?></td>
                                        <th>市值：</th>
                                        <td class="detail_market_cap"><?php if($v['market_cap']>100000000) echo number_format($v['market_cap']/100000000,2,'.','')."亿"; else echo number_format($v['market_cap']/10000,2,'.','')."万";?></td>
                                    </tr>
                                    <tr>
                                        <th class="space_left" title="每股收益：最近12个月的每股收益">每股收益：</th>
                                        <td><?php echo htmlspecialchars($v['earning_per_share'])?></td>
                                        <th>股本：</th>
                                        <td><?php if($v['capitalization']>100000000) echo number_format($v['capitalization']/100000000,2,'.','')."亿"; else echo number_format($v['capitalization']/10000,2,'.','')."万";?></td>
                                    </tr>
                                    <tr>
                                        <th class="space_left">贝塔系数：</th>
                                        <td>--</td>
                                        <th>股息/收益率：</th>
                                        <td>--/--</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="tab-pane" id="tab_5_2">
                            <p>Howdy, I'm in Section 2.</p>
                            <p>
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
                            </p>
                            <p>
                                <a class="btn green" href="ui_tabs_accordions_navs.html#tab_5_2" target="_blank">Activate this tab via URL</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>
</div> </div>
<!--END ONE STOCK-->
<?php } ?>
</div>
<!--END LEFT CONENT-->

<!--BEGIN RIGHT CONENT-->
<div class="stock_right_sidebar">

</div> 
<!--END RIGHT CONENT-->
</div>
</div> 

<div id="sidebar">
<div class="portlet box grey">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>选股组合</div>
        <div class="actions">
            <div class="btn-group">
                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                Small button <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body" >
        <!--add elem to stock group-->
        <div id="sidebar_addstock_button" class="btn btn-block blue">
            <span class=""><i class="fa fa-plus"></i></span>
        </div>
        <div class="scroller sidebar_scoller"  data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
            <ul id="sortable" style="padding:2px">
                <?php foreach($price_details as $id=>$v) {?>
                <li data-id="<?php echo htmlspecialchars($id)?>" class="sidebar_stock_block btn btn-block <?php if($v['real_price_change_amount']<0) echo Yii::app()->params['colors'][1]; elseif($v['real_price_change_amount']==0) echo Yii::app()->params['colors'][2]; else echo Yii::app()->params['colors'][0];?>">
                    <span class=""><?php echo htmlspecialchars($v['name']);?></span>
                    <small class="desc"><?php echo htmlspecialchars($v['real_price'])."&nbsp&nbsp".htmlspecialchars($v['real_price_change_amount'])."&nbsp&nbsp(".htmlspecialchars($v['real_price_change_rate'])."%)";?></small>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
</div> 
</div>
<!--END MAIN CONENT-->

<script src="http://vip.stock.finance.sina.com.cn/usstock/fusioncharts/Code/FusionCharts/FusionCharts.js" type="text/javascript"></script>   
<script type="text/javascript"> 
    jQuery(document).ready(function() {    
        // common
        // 访问sina接口
        function jsonp(src, cb) {
            var script = document.createElement('script'),
                s = document.getElementsByTagName("head")[0];

            script.onreadystatechange = script.onload = function () {
                if (!script.readyState || /loaded|complete/i.test(script.readyState)) {
                    script.onreadystatechange = script.onload = null;
                    script.parentNode.removeChild(script);

                    cb();
                }
            };

            script.type = 'text/javascript';
            s.appendChild(script);
            script.src = src;
        }

        function formateAmount(str) {
            if(isNaN(str)) return str;
            if(str>100000000) return (parseFloat(str)/100000000).toFixed(2)+"亿";
            else if(str>10000)  return (parseFloat(str)/10000).toFixed(2)+"万";
            else return str;
        }

        // id stockid 如qihu, in 结果
        function splitSinaStockInfo(id) {
            seg1 = eval("hq_str_gb_"+id);
            if(seg1.length==0) return {};
            seg2 = seg1.split(",");
            if(seg2.length<5) {
                // error
                return;
            }
            return {
                'lower_id' : id.toLowerCase(),
                'upper_id' : id.toUpperCase(),
                'name' : seg2[0],
                'real_price' : seg2[1],
                'real_price_change_rate' : seg2[2],
                'real_time' : seg2[3],
                'real_price_change_amount' : seg2[4],
                'start_price' : seg2[5],
                'highprice_today' : seg2[6],
                'lowerprice_today' : seg2[7],
                'highprice_52week' : seg2[8],
                'lowerprice_52week' : seg2[9],
                'real_share_amount' : seg2[10],
                'stock_amount_10day' : seg2[11],
                'market_cap' : seg2[12],
                'earning_per_share' : seg2[13],
                'PE' : seg2[14],
                't1' : seg2[15],
                't2' : seg2[16],
                't3' : seg2[17],
                't4' : seg2[18],
                'capitalization' : seg2[19],
                't5' : seg2[20],
                'after_hour_price' : seg2[21],
                'after_hour_price_change_rate' : seg2[22],
                'after_hour_price_change_amount' : seg2[23],
                'close_time' : seg2[24],
                'after_hour_time' : seg2[25],
                'yesterday_close_price' : seg2[26],
                'after_hour_share_amount' : seg2[27]
            };
        }

        // common data
        // 颜色变量
        COLORS = ['<?php echo Yii::app()->params["colors"][0]?>','<?php echo Yii::app()->params["colors"][1]?>','<?php echo Yii::app()->params["colors"][2]?>']; // up down nochange
            
        // form
        ids = "<?php echo htmlspecialchars($ids);?>";
        $("input[name='ids']").val(ids);

        // 股票板块控制
        function closeAllStockPortlet() {
            $(".stockportlet").children(".portlet-body").slideUp(0);
            $(".stockportlet .portletarrow").removeClass("collapse").addClass("expand");
        }
        function openAllStockPortlet() {
            $(".stockportlet").children(".portlet-body").slideDown(0);
            $(".stockportlet .portletarrow").removeClass("expand").addClass("collapse");
        }
        function openOneStockPortlet(id) {
            $(id).children(".portlet-body").slideDown(0);
            $(id + ".portletarrow").removeClass("expand").addClass("collapse");
        }
        closeAllStockPortlet();
        $("#open_all_stock_panel").on("click",function() {
            openAllStockPortlet();
        });
        $("#close_all_stock_panel").on("click",function() {
            closeAllStockPortlet();
        });

        // 右侧边栏top
        var sideTop = $('#sidebar').offset().top-42;
        window.footTop = $('.footer').offset().top - parseFloat($('.footer').css('marginTop').replace(/auto/, 0));

        $(window).scroll(function(evt) {
            var y = $(this).scrollTop();
            // 右侧栏悬浮
            if(y > $("body").height() - $("#sidebar").height()-42){
                return;
            }
            if (y > sideTop) {
                $('#sidebar').css({
                    top: (y - sideTop) + 'px'
                });
            } else {
                $('#sidebar').css({
                    top: 0
                });
            }
        });

        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();


        // stock group
        // add  event
        $("#sidebar_addstock_button").on("click",function() {
            content = "<div  class='sidebar_addstock_input input-group add_group_elem_div'> " +
                " <input value='' type='text' class='form-control' placeholder='输入股票代码'> " +
                " <span class='input-group-btn'> " +
                    "<button class='btn blue groupadd_confirm' type='button'>确定</button> " +
                "</span> " +
                "</div> ";
            $(this).after(content);
        });

        // add confirm
        $("#sidebar").delegate(".groupadd_confirm","click",function() {
            fa = $(this).closest(".add_group_elem_div");
            stock = fa.find("input").val();
            stockcode = "gb_"+stock;
            // 获取股票信息
            name = '';
            real_price = '';
            real_price_change_amount = '';
            real_price_change_rate = '';
            jsonp("http://hq.sinajs.cn/?list="+stockcode, function(){
                // 获取信息
                ret = eval("hq_str_"+stockcode);
                retarray = ret.split(",");
                if(retarray.length<5) {
                    // error
                    fa.remove();
                    return;
                }
                name = retarray[0];
                real_price = retarray[1];
                real_price_change_amount = retarray[4];
                real_price_change_rate = retarray[2];
                if(real_price_change_amount>0) color=COLORS[0];
                else if(real_price_change_amount<0) color=COLORS[1];
                else color=COLORS[2];

                // 过滤重复
                has = false;
                $("#sidebar #sortable li").each(function(index) {
                    if($(this).data("id")==stock) has=true;
                });
                // 插入
                if(has) {
                    fa.remove();
                } else {
                    newblock = '<li data-id="'+stock+'"class="sidebar_stock_block btn btn-block '+color+'">' +
                            '<span class="">' + name + '</span> ' +
                            '<small class="desc">'+real_price+'&nbsp&nbsp'+real_price_change_amount+'&nbsp&nbsp('+real_price_change_rate+'%)</small>' +
                        '</li>';
                    $("#sidebar #sortable").prepend(newblock);
                    fa.remove();
                }
            });
        });
        // delete


        // 定时获取股票信息并更新页面
        stockinfo_lock = false;
        function getStockInfo() {
            if(stockinfo_lock) return;
            stockinfo_lock=true;
            getparams = '';
            $("#sidebar #sortable li").each(function(index) {
                getparams += "gb_"+$(this).data("id")+",";
            });
            // 获取sina股票信息
            jsonp("http://hq.sinajs.cn/?list="+getparams, function(){
                $("#sidebar #sortable li").each(function() {
                    id = $(this).data("id")
                    stockInfo = splitSinaStockInfo(id);
                    // 股票实时价格更新
                    content = stockInfo.real_price+'&nbsp&nbsp'+stockInfo.real_price_change_amount+'&nbsp&nbsp('+stockInfo.real_price_change_rate+'%)';
                    $(this).find("small.desc").html(content);
                    $("#stock_content_"+id+" small.desc").html(content);
                    // 股票详情更新
                    //console.log(formateAmount(stockInfo.start_price));
                    $("#stock_content_"+id+" .detail_market_cap").html(formateAmount(stockInfo.market_cap));
                    $("#stock_content_"+id+" .detail_price_interval").html(formateAmount(stockInfo.lowerprice_today)+"-"+formateAmount(stockInfo.highprice_today));
                    $("#stock_content_"+id+" .detail_start_price").html(formateAmount(stockInfo.start_price));
                    $("#stock_content_"+id+" .detail_real_share_amout").html(formateAmount(stockInfo.real_share_amount));
                    $("#stock_content_"+id+" .detail_yesterday_close_price").html(formateAmount(stockInfo.yesterday_close_price));
                    $("#stock_content_"+id+" .detail_pe").html(formateAmount(stockInfo.PE));
                    //console.log(stockInfo);
                });
            })
            stockinfo_lock=false;
        }
        setInterval(getStockInfo,2000)
    });
/*
    //Instantiate the Chart 
    var chart_profit = new FusionCharts("http://vip.stock.finance.sina.com.cn/usstock/fusioncharts/Code/FusionCharts/ScrollCombiDY2D.swf", "profit", "460", "250", "0", "0");
    chart_profit.setTransparent("false");
    //Provide entire XML data using dataXML method
    chart_profit.setDataXML("
        <chart bgColor='#ffffff' alternateHGridColor='#d8d8d8' showBorder='0' palette='4' logoURL='http://www.sinaimg.cn/cj/sinaflashsource/sinalogo.png' logoAlpha='15'  logoPosition='CC' formatNumberScale='0' showValues='0' decimals='0'>
        <categories>
        <category name='2012年3季' /><category name='2012年4季' /><category name='2013年1季' /><category name='2013年2季' /><category name='2013年3季' />
        </categories>
        <dataset seriesName='总收入(百万美元)'><set value='50.37' /><set value='48.82' /><set value='46.59' /><set value='49.62' /><set value='47.56' /></dataset>
        <dataset seriesName='净利润(百万美元)'><set value='-15.40' /><set value='-21.08' /><set value='-3.14' /><set value='-9.33' /><set value='-24.63' /></dataset>
        <dataset seriesName='净利润率(%)' parentYAxis='S'><set value='-22' /><set value='-27' /><set value='-4' /><set value='-11' /><set value='-30' /></dataset>
        </chart>
    ");
    //Finally, render the chart.
    chart_profit.render("profitDiv");
    */
</script>