
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--include file "common.php"-->
    </head>
    <body class="index">
        <!-- Header Start -->
        <div id="top">
            <!--include file "header.php"-->
            <!--include file "nav.php"-->
        </div>
        <div style="margin:0 auto;text-align: center;height: 350px;background-image: url('/public/web/images/ad_day.png');background-repeat: no-repeat;background-position: center">
        </div>
        <link rel="stylesheet" type="text/css" href="/public/web/css/stock.css"/>
        <link rel="stylesheet" type="text/css" href="/public/web/css/add/pro.css"/>
        <script type="text/javascript" src="/public/web/js/stock.js"></script>
        <style>
            
            table { margin-top: 2px }
            td option { padding: 3px 15px 3px 3px }
            .pz_sel { padding: 5px 0px 5px 0px; background: #f5f5f5; height: 388px; }
            .ddw_l .pz_sel li { width: 134px; height: 118px; margin: 5px 5px; border: 1px solid #D7D7D7; background: #fff; float: left; text-align: center; cursor: pointer }
            .ddw_l .pz_sel li p.m { padding-top: 40px }
            .sure td { padding-left: 15px; border-bottom: 1px solid #E4E4E4; height: 44px; line-height: 44px }
            .sure .title { font-size: 14px }
            .ddw_r { width: 435px; float: left; margin-bottom: 20px; margin-left: 10px; }
            .ddw_l { width: 440px; float: left; margin-right: 10px; }
            .ddw_l .pz_sel li.curr { background: url("/public/web/images/icon-curr.png") no-repeat scroll right bottom #FFC; }
            .pz_inp { width: 438px; height: 372px; border: 1px solid #D7D7D7 }
            .pt10 { padding-top: 20px; }
            body{line-height:17px}
            h3 {display: block;font-size: 1.17em;-webkit-margin-before: 1em;-webkit-margin-after: 1em;-webkit-margin-start: 0px;-webkit-margin-end: 0px;font-weight: bold;}
            ul.chooseUlLi li a.active {top: -15px;height: 100px;border: 2px solid #ff6f06;background: #ff6f06;color: #fff;}
            .isstartBtn.active{background: #ff6f06; color: #fff; border: 1px solid #ff6f06; }
            .isstartBtn.active:hover{ color: #fff;}
            .isstartBtn{background: #FFF; color: #999; border: 1px solid #ccc; margin-right: 15px; padding: 5px 25px; display: inline-block }
            .isstartBtn:hover{color: #ff6f06; border: 1px solid #ff6f06; }
        </style>
        <!--中部开始-->
        <div class="partOne page-component" style="clear: both;width:1090px; margin: 0 auto">
            <div class="bgwhite" style="width:1090px; margin: 15px auto 0px auto; border:0; padding-top: 0;">
                <h3 style="color:#282828; font-size: 16px; padding-bottom: 4px; border-bottom: 1px solid #ddd;">股票策略优势 
                    <img src="/public/web/images/add/peiziimgxjt.jpg"/>
                </h3>
                <img src="/public/web/images/add/peiziimg1.jpg"/>
                <h3 style="color:#282828; font-size: 16px; padding-bottom: 4px; border-bottom: 1px solid #ddd;">
                    股票策略流程
                    <img src="/public/web/images/add/peiziimgxjt.jpg"/>
                </h3>
                <img src="/public/web/images/add/peiziimg2.jpg"/>
                <h3 style="color:#282828; font-size: 16px; padding-bottom: 4px; border-bottom: 1px solid #ddd;">
                    选择策略方案 
                    <img src="/public/web/images/add/peiziimgxjt.jpg"/>
                </h3>

                <div style="width:100%; margin:0; padding:0; clear:both;">
                    <div style="width:495px; height:496px; padding-left:32px; float:left; border:1px solid #c2c2c2; display:block;">
                        <h3 style="color:#ff6f06;font-size: 16px; font-weight: bold;">第一步：<span style="font-weight: 400">输入投资本金（<?php echo $params['minLimitMoney']/100?>-<?php echo $params['maxLimitMoney']/1000000?>万）</span></h3>
                        <p>
                            <input style="height: 50px; line-height: 50px; width: 400px; text-align: center; font-size: 18px;" class="ipt" id="money" min="3000.00" max="3000000.00" onkeyup="value = value.replace(/[^\d]/g, '')" placeholder="最少<?php echo $params['minLimitMoney']/100?>元，最多<?php echo $params['maxLimitMoney']/1000000?>万元" type="text" size="30" maxlength="8"/>
                            <em style="font-size: 24px; font-style: normal; color: #666; margin-left: 10px;">元</em>
                        </p>
                        <p style="color:#8e8e8e; margin: 10px 0; font-size: 13px;">
                            备注：不小于<?php echo $params['minLimitMoney']/100?>元，不大于<?php echo $params['maxLimitMoney']/1000000?>万元，且为100的整数倍
                        </p>
                        <h3 style="color:#ff6f06;font-size: 16px; margin-top: 35px; font-weight: bold;">第二步：<span style="font-weight: 400">选择获得资金（选择杠杆，资金放大1-6倍）</span></h3>
                        <ul class="chooseUlLi" style="margin: 48px 0 0 0!important">
                            <li>
                                <a class="active" href="javascript:">
                                    <i></i><strong>1</strong>倍
                                    <p style="font-size: 0.75em;">日利率<?php echo $params['manage_cost_money1']; ?>% </p>
                                    <p><span class="times" data-times="1">1000</span>元</p>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:">
                                    <i></i><strong>2</strong>倍
                                    <p style="font-size: 0.75em;">日利率<?php echo $params['manage_cost_money2']; ?>%</p>
                                    <p><span class="times" data-times="2">2000</span>元</p>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:">
                                    <i></i><strong>3</strong>倍
                                    <p style="font-size: 0.75em;">日利率<?php echo $params['manage_cost_money3']; ?>%</p>
                                    <p><span class="times" data-times="3">3000</span>元</p>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:">
                                    <i></i><strong>4</strong>倍
                                    <p style="font-size: 0.75em;">日利率<?php echo $params['manage_cost_money4']; ?>%</p>
                                    <p><span class="times" data-times="4">4000</span>元</p>
                                </a>
                            </li> 
                            <li>
                                <a href="javascript:">
                                    <i></i><strong>5</strong>倍
                                    <p style="font-size: 0.75em;">日利率<?php echo $params['manage_cost_money5']; ?>%</p>
                                    <p><span class="times" data-times="5">5000</span>元</p>
                                </a>
                            </li> 
                            <li>
                                <a href="javascript:">
                                    <i></i><strong>6</strong>倍
                                    <p style="font-size: 0.75em;">日利率<?php echo $params['manage_cost_money6']; ?>%</p>
                                    <p><span class="times" data-times="6">6000</span>元</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div style="width:520px; height:496px; padding-left:32px; float:right; border:1px solid #c2c2c2; display:block;">
                        <h3 style="color:#ff6f06;font-size: 16px; font-weight: bold;">第三步：<span style="font-weight: 400">选择你的操盘周期</span></h3>
                        <p style="font-size: 16px;">
                            期限：
                            <select id="tradecycle">
                                <option value="2">2个交易日</option>
                                <option value="3">3个交易日</option>
                                <option value="4">4个交易日</option>
                                <option value="5">5个交易日</option>
                                <option value="6">6个交易日</option>
                                <option value="7">7个交易日</option>
                                <option value="8">8个交易日</option>
                                <option value="9">9个交易日</option>
                                <option value="10">10个交易日</option>
                                <option value="11">11个交易日</option>
                                <option value="12">12个交易日</option>
                                <option value="13">13个交易日</option>
                                <option value="14">14个交易日</option>
                                <option value="15">15个交易日</option>
                                <option value="16">16个交易日</option>
                                <option value="17">17个交易日</option>
                                <option value="18">18个交易日</option>
                                <option value="19">19个交易日</option>
                                <option value="20">20个交易日</option>
                            </select>
                            <span style="margin-left:25px;">&nbsp;</span>
                            账户管理费：
                            <em id="accountManageFees">0</em>元 / 交易日
                        </p>
                        <p style="color:#8e8e8e; margin: 10px 0; font-size: 13px;">
                            备注：
                            按天收取管理费
                        </p>
                        <h3 style="color:#ff6f06;font-size: 16px; font-weight: bold;">第四步：<span style="font-weight: 400">选择开始交易时间</span></h3>
                        <p>
                            <a class="isstartBtn active" data="0" href="javascript:void(0);">立即生效</a>
                            <a class="isstartBtn" data="1" href="javascript:void(0);">下个交易日</a>
                        </p>
                        <h3 style="color:#ff6f06;font-size: 16px; font-weight: bold;">第五步：<span style="font-weight: 400">确认操盘信息</span></h3>
                        <table class="table tableborder tabletree tablemony" style="width:95%;">
                            <tbody>
                                <tr>
                                    <th width="100">操盘须知</th>
                                    <td>
                                        盈利全归您                                    </td>
                                </tr>
                                <tr>
                                    <th>总操盘资金</th>
                                    <td class="colorfe5911"><em id="totalAmount">0</em>元 <small id="tAtips" style="color:#555">0(本金)+0(操盘资金)</small></td>
                                </tr>
                                <tr>
                                    <th>亏损警戒线</th>
                                    <td class="colorfe5911">
                                        <em id="warnLine">0</em>元
                                        <small id="warnLineTips" style="color:#555">(预警线=操盘资金+保证金×40%)</small>
                                        <span class="small-area simpletooltip" data-simpletooltip-position="bottom-right" title="当总操盘资金低于警戒线以下时，只能平仓不能建仓，需要尽快补充风险保证金，以免低于亏损平仓线被平仓">
                                            <i style="width:18px; height:18px; vertical-align:middle; margin-left:6px; cursor: pointer;" class="ico ico-help"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>亏损平仓线</th>
                                    <td class="colorfe5911">
                                        <em id="outLine">0</em>元
                                        <small id="outLineTips" style="color:#555">(平仓线=操盘资金+保证金×20%)</small>
                                        <span class="small-area simpletooltip" data-simpletooltip-position="bottom-right" title="当总操盘资金低于平仓线以下时，我们将有权把您的股票进行平仓，为避免平仓发生，请时刻关注风险保证金是否充足"><i style="width:18px; height:18px; vertical-align:middle; margin-left:6px; cursor: pointer;" class="ico ico-help"></i></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p>&nbsp;</p>
                    </div>

                    <div class="listgz margin-bottom15" style="padding-top: 30px;border-bottom:1px solid #ddd; clear:both; margin-top:40px">
                        <p style="color:#ff6f06; text-align: center; margin: 10px 0; font-size: 16px;">
                            备注： 您需支付的金额为：保证金 <span id="bzjOK">0</span> + <span id="glfOK">0.00</span>元（管理费） = <span id="zjeOK">0</span> 元
                        </p>
                        <p style="padding: 10px;">如您不清楚规则，或有其他疑问，请联系客服</p>
                        <!--<p style="padding: 10px;"><label><input id="agreement" type="checkbox" checked="checked"/>我已阅读并同意<a id="showsp" title="操盘合作协议" href="">《操盘合作协议》</a></label></p>-->
                        <p style="padding: 10px;"><input id="initBtn" class="btn btnorg btnorg-sizebig radius5px" type="button" value="我要操盘" onclick="return false;" style="height: 40px; line-height: 40px;"/></p>
                    </div>
                </div>
            </div>


        </div>
        <div class="items">
            <div class="ddwdetail" style="clear:both">
                <h3>操盘须知</h3>
                <p>1、风险提示：股市有风险，投资需谨慎！配多多股票操盘操作中只收取利息，无其他任何费用。</p>
                <p>2、您的投资本金：您自己投资股票的资金，必须是100的整数倍。</p>
                <p>3、资金使用期限：资金使用期限按交易日计算，如6月25日到6月26日（不包含节假日）。</p>
                <p>4、按天利息支付：按天计算，如6月25日操盘，6月25日支付第一天管理费，6月26日（09:00）支付第二天管理费，以此类推。</p>
                <p>5、亏损警戒线：当操盘保证金低于警戒线以下时，只能平仓不能建仓，需要尽快补充风险保证金，以免低于亏损平仓线被平仓。</p>
                <p>6、亏损平仓线：当操盘保证金低于平仓线以下时，我们将有权把您的股票进行平仓，为避免平仓发生，请时刻关注保证金是否充足。</p>
                <p>7、开始交易时间：交易日当天15:00之前的申请于当日生效（当天开始收取账户管理费），交易日当天15:00后的申请于下个交易日生效。</p>
                <p>8、操盘到期：操盘到期时，需在到期当日把所有证券账户变现为现金，且不能再做挂单和买入操作，否则自动延期扣除管理费。</p>
                <p style="display:none;"><a target="_blank" href="/help/funding.html#pz-step1">更多规则说明</a></p>
            </div>
            <br/>
        </div>
        <script>
            $(function(){
                $(".chooseUlLi li").click(function(){
                    $(".chooseUlLi li a").removeClass("active");
                    $(this).find("a").addClass("active");
                    moneyChange();
                })
            })
            function get_risk(){
                return parseInt($(".chooseUlLi li .active").find(".times").data('times'));
            }
        </script>
        <script type="text/jscript">    
                var warnScale = {alarm_rate1:<?php echo $params['alarm_rate1']?>,alarm_rate2:<?php echo $params['alarm_rate2']?>,alarm_rate3:<?php echo $params['alarm_rate3']?>,alarm_rate4:<?php echo $params['alarm_rate4']?>,alarm_rate5:<?php echo $params['alarm_rate5']?>,alarm_rate6:<?php echo $params['alarm_rate6']?>,alarm_rate7:<?php echo $params['alarm_rate7']?>,alarm_rate8:<?php echo $params['alarm_rate8']?>,alarm_rate9:<?php echo $params['alarm_rate9']?>,alarm_rate10:<?php echo $params['alarm_rate10']?>};
                var stopScale = {stop_rate1:<?php echo $params['stop_rate1']?>,stop_rate2:<?php echo $params['stop_rate2']?>,stop_rate3:<?php echo $params['stop_rate3']?>,stop_rate4:<?php echo $params['stop_rate4']?>,stop_rate5:<?php echo $params['stop_rate5']?>,stop_rate6:<?php echo $params['stop_rate6']?>,stop_rate7:<?php echo $params['stop_rate7']?>,stop_rate8:<?php echo $params['stop_rate8']?>,stop_rate9:<?php echo $params['stop_rate9']?>,stop_rate10:<?php echo $params['stop_rate10']?>};
                var dayFee = {manage_cost_money1:<?php echo $params['manage_cost_money1']/100?>,manage_cost_money2:<?php echo $params['manage_cost_money2']/100?>,manage_cost_money3:<?php echo $params['manage_cost_money3']/100?>,manage_cost_money4:<?php echo $params['manage_cost_money4']/100?>,manage_cost_money5:<?php echo $params['manage_cost_money5']/100?>,manage_cost_money6:<?php echo $params['manage_cost_money6']/100?>,manage_cost_money7:<?php echo $params['manage_cost_money7']/100?>,manage_cost_money8:<?php echo $params['manage_cost_money8']/100?>,manage_cost_money9:<?php echo $params['manage_cost_money9']/100?>,manage_cost_money10:<?php echo $params['manage_cost_money10']/100?>};
                var minLimitMoney = <?php echo $params['minLimitMoney']/100?>; //最低额度
                var maxLimitMoney = <?php echo $params['maxLimitMoney']/100?>; //最大额度
                $(function() {
                    $(".isstartBtn").click(function(){
                        $(".isstartBtn").removeClass("active");
                        $(this).addClass("active");
                        var trade_time = $(this).attr("data");
                        $("#hid_trade_time").val(trade_time);
                    })
                    $('#money').keyup(function() {
                        if (isNaN($(this).val())) {
                            $(this).val('');
                            return;
                        }
                        moneyChange();
                    });
                    $("#tradecycle").change(function(){
                        moneyChange();
                    })
                    $('#money').change(function() {
                        if ($(this).val()=="" || isNaN($(this).val())){
                            $(this).val('');
                            return;
                        }
                        if ($(this).val() < minLimitMoney || $(this).val() > maxLimitMoney || $(this).val() % 100 != 0) {
                            dialog('请输入最少 '+minLimitMoney+' 元最多 '+maxLimitMoney+'元，并且为 100 的倍数。');
                        } else {
                            moneyChange();
                        }
                    });

                    $('#initBtn').click(function() {
                        var money = $('#money').val() != '' ? parseFloat($('#money').val()) : parseFloat($('#pz_sel>.curr').attr('data'));
                        if (money < minLimitMoney || money > maxLimitMoney || money % 100 != 0) {
                            dialog('请输入最少 '+minLimitMoney+' 元最多 '+maxLimitMoney+'元，并且为 100 的倍数。');
                            return false;
                        } 
                        var cpj = $('#hid_total_money').val();//操盘金
                        var deposit = $('#hid_deposit').val();//保证金
                        var jgx = $('#hid_alarm_money').val();//警告线
                        var pcx = $('#hid_stop_money').val();//平仓线
                        var glf = $('#hid_manager_cost_total').val();//管理费
                        var risk = $('#hid_risk').val();//策略比例
                        var duration = $('#hid_cycle').val();//时间周期 
                        var trade_time = $('#hid_trade_time').val();//交易时间 
                        var params = "&cpj="+cpj+"&deposit="+deposit+"&jgx="+jgx+"&pcx="+pcx+"&glf="+glf+"&risk="+risk+"&duration="+duration+"&trade_time="+trade_time;
                        window.location.href="<?php echo \App::URL('web/peiziu/peizi');?>&pz_type=1&money="+cpj+"&pz_ratio="+risk+"&times="+duration+params;
                        //$('#money').val($('#pz_sel>.curr').attr('data'));
                        //$('#stock').submit();
                    });
                });
                function xround(x, num){
                    return Math.round(x * Math.pow(10, num)) / Math.pow(10, num) ;
                }

                function moneyChange() {
                    var deposit = $('#money').val() ;
                    if(deposit==""){
                        return;
                    }
                    deposit = parseFloat(deposit);
                    $("#quota").val(money);
                    //改变不同倍数的金额
                    $(".chooseUlLi li").each(function(){
                        var beishu = $(this).find(".times").data('times');
                        var beishu_money = parseInt(beishu)*parseFloat(deposit);
                        $(this).find(".times").html(beishu_money);
                    })
                    var cycle = $('#tradecycle').val();//时间周期
                    var risk = get_risk();
                    var peizi_money = deposit * risk;
                    var total_money = deposit+peizi_money;
                    var alarm_money = peizi_money+deposit*warnScale['alarm_rate'+risk]/100;//警戒线
                    var stop_money = peizi_money+deposit*stopScale['stop_rate'+risk]/100;//止损线
                    var managet_cost = xround(peizi_money*dayFee['manage_cost_money'+risk],2);//单月管理费
                    var manager_cost_total = xround(managet_cost*cycle,2);//总管理费
                    
                    
                    $("#accountManageFees").html(managet_cost);//管理费每月
                    $("#totalAmount").html($.formatMoney(total_money));//总操盘金
                    $("#tAtips").html(deposit+"(本金)+"+peizi_money+"(操盘资金)");//总操盘金组成
                    $("#warnLine").html($.formatMoney(alarm_money));//警戒线
                    $("#warnLineTips").html("(预警线=操盘资金+保证金×"+warnScale['alarm_rate'+risk]+"%)");//警戒线组成
                    $("#outLine").html($.formatMoney(stop_money));//止损线
                    $("#outLineTips").html("(平仓线=操盘资金+保证金×"+stopScale['stop_rate'+risk]+"%)");//止损线组成
                    $("#bzjOK").html($.formatMoney(deposit));//保证金
                    $("#glfOK").html($.formatMoney(manager_cost_total));//总管理费
                    $("#zjeOK").html($.formatMoney(xround(deposit+manager_cost_total,2)));//总费用
                    
                    $("#hid_cycle").val(cycle);
                    $("#hid_risk").val(risk);
                    $("#hid_deposit").val(deposit);
                    $("#hid_peizi_money").val(peizi_money);
                    $("#hid_total_money").val(total_money);
                    $("#hid_alarm_money").val(alarm_money);
                    $("#hid_stop_money").val(stop_money);
                    $("#hid_managet_cost").val(managet_cost);
                    $("#hid_manager_cost_total").val(manager_cost_total);
                }

            </script>
        <input type="hidden" id="hid_cycle" value=""/>
        <input type="hidden" id="hid_risk" value=""/>
        <input type="hidden" id="hid_deposit"/>
        <input type="hidden" id="hid_peizi_money"/>
        <input type="hidden" id="hid_total_money"/>
        <input type="hidden" id="hid_alarm_money"/>
        <input type="hidden" id="hid_stop_money"/>
        <input type="hidden" id="hid_managet_cost"/>
        <input type="hidden" id="hid_manager_cost_total"/>
        <input type="hidden" id="hid_trade_time" value="0"/>
        <!--中部结束-->
        <!--include file "footer.php"-->
    </body>
</html>