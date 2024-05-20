
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php if (isset($title)) echo $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if($ISHTTPS==true) {?>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" /> 
<?php }?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="<?php if (isset($description)) echo $description ?>" />
<meta name="keywords" content="<?php if (isset($keywords)) echo $keywords ?>" />
<!--<link href="/public/web/css/common.css" rel="stylesheet" type="text/css" media="screen,projection" />
<link href="/public/web/css/main.css" rel="stylesheet" type="text/css">
-->
<script src="/public/web/js/jquery.js" type="text/javascript"></script>
<script src="/public/web/layer/3.0.3/layer.js" type="text/javascript"></script>
<script src="/public/web/js/common_home.js?v=3" type="text/javascript"></script>
<script src="/public/web/js/main.js" type="text/javascript"></script>

<script type="text/javascript" src="/public/web/js/add/com.js"></script>
<link href="/public/web/css/add/common.css?v=3" rel="stylesheet" type="text/css" />
<link href="/public/web/css/main.css" rel="stylesheet" type="text/css" />

        <style>
            .contain{background: url('/public/web/images/task/bg.png') repeat}
            .banner{height: 409px;background: url('/public/web/images/task/banner.png') no-repeat center}
            .task{width:1080px;margin: 0 auto;border: 8px solid #ee878f;border-radius: 10px;background: #ffffff80;padding:60px 60px}
            .task ul{}
            .task li{display: block;width:28%;float: left;text-align: center}
            .task li .title{color:#ff8b19;font-size:24px}
            .task li .desc{color:#bcbcbc;font-size:14px;margin: 10px 0px}
            .task li .money{color:#ff8b19;font-size:18px;margin-bottom: 20px}
            .task li .button a{display: block;background: #ff5064;border-radius: 4px;color:#fff;font-size:18px;text-align: center;line-height: 40px;width: 70%;margin: 0px auto}
            .task li.done .button a{display: block;background: #ccc;border-radius: 4px;color:#fff;font-size:18px;text-align: center;line-height: 40px;width: 70%;margin: 0px auto}
            .task .item{background: #fff;border-radius: 5px;padding: 40px 0;position: relative}
            .task .item .wc{position: absolute;right:0;top:0;width:141px;height:111px;background: url('/public/web/images/task/over.png') no-repeat;background-size: contain}
            .task .right{width:60px;height: 60px;background: url('/public/web/images/task/jt_right.png') no-repeat center;background-size: contain;margin: 86px auto}
            .task .left{width:60px;height: 60px;background: url('/public/web/images/task/jt_left.png') no-repeat center;background-size: contain;margin: 86px auto}
            .task .down{width:60px;height: 60px;background: url('/public/web/images/task/jt_down.png') no-repeat center;background-size: contain;margin: 10px 0px 10px 920px}
            .task .down2{width:60px;height: 60px;background: url('/public/web/images/task/jt_down.png') no-repeat center;background-size: contain;margin: 10px 0px 10px 118px}
            .guize{width:1200px;margin:0 auto;height:250px;background: url('/public/web/images/task/guize.png') no-repeat center 40px;padding-top: 120px }
            .guize li{line-height: 40px;color:#fff;font-size: 16px}
            .guize li i{display: inline-block;width: 26px;height:26px;line-height: 26px;text-align: center;border-radius: 26px;background: #ff5f4b;color: #fff}
        </style>
    </head>

    <body>
        <!-- Header Start -->
        <div id="top">
            <?php 
if(!isset($_SESSION)){
    session_start();
}
$uid = isset($_SESSION['uid'])?$_SESSION['uid']:0;
if($uid >0){
    $user = \Model\User\UserInfo::getinfo($uid);
    $user['user_name'] = substr_replace($user['mobile'], '****',3,4);
}
?>
<div id="base-info-bar">
    <div class="w1200">
        <div class="fl">
            <span>欢迎访问华亿策略</span>
            <span style="font-weight: bold;color:#ff3344">&nbsp;</span>
            <span>&nbsp;|&nbsp;</span>
            <span>财富热线：<span style="font-weight: bold;color:#ff3344">4000-039-678</span></span>
        </div>
        <div class="right">
            <?php if ($uid > 0) { ?>
                <a href="<?php echo \App::URL("web/user/account"); ?>">您好，<?php echo $user['user_name']; ?></a>
                <a href="<?php echo \App::URL('web/member/logout'); ?>">退出登录</a>
            <?php } else { ?>
                <a href="<?php echo \App::URL("web/member/register"); ?>" class="register-btn">免费注册</a>
                <a href="<?php echo \App::URL("web/member/login"); ?>">立即登录</a>
            <?php } ?>
            <a href="<?php echo \App::URL("web/help/software"); ?>" class="mobile-phone"><span class="web-icon mobile-phone-icon"></span>APP下载</a>
            <a href="<?php echo \App::URL("web/help/member"); ?>" class="hover_text">帮助中心</a>
            <a href="<?php echo \App::URL("web/about/us"); ?>" class="hover_text">关于我们</a>
            <a href="<?php echo \App::URL("web/help/guide"); ?>" class="hover_text">新手指引</a>
        </div>
    </div>
</div>
            <div class="logo-module">
    <div class="w1200">
        <a href="/"><span class="yhqz-logo"></span></a>
        <div class="main-nav-bar" id="logo-nav">
            <span <?php if((isset($_GET['mod']) && $_GET['mod']=='index' && $_GET['ac']=='view') || !isset($_GET['mod'])){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/index/view");?>" target="">首页</a></span>
            <span <?php if(isset($_GET['mod']) && $_GET['mod']=='peizi' && $_GET['ac']=='month'){echo ' class="active-bar"';}?> ><a href="<?php echo \App::URL("web/peizi/month");?>" target="">按月策略</a>
                <div class="hit"><img src="/public/web/images/hot.gif" width="30"/></div>
            </span>
            <span <?php if(isset($_GET['mod']) && $_GET['mod']=='peizi' && $_GET['ac']=='day'){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/peizi/day");?>"  target="">按天策略</a></span>
            <span <?php if(isset($_GET['mod']) && $_GET['mod']=='peizi' && $_GET['ac']=='free'){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/peizi/free");?>" target="">免费体验</a></span>
            <span <?php if(isset($_GET['mod']) && $_GET['mod']=='index' && $_GET['ac']=='activity'){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/index/activity");?>"  target="">新手任务</a>
                <div class="hit" style="top:10px"><img src="/public/web/images/new.gif" width="25"/></div>
            </span>
            <span <?php if(isset($_GET['mod']) && $_GET['mod']=='index' && $_GET['ac']=='extend'){echo ' class="active-bar"';}?>><a rel="nofollow" href="<?php echo \App::URL("web/index/extend");?>"  target="">我要推广</a></span>
            <!-- <span <?php if(isset($_GET['mod']) && $_GET['mod']=='index' && $_GET['ac']=='safe'){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/index/safe");?>"  target="">安全保障</a></span> -->
             <span <?php if(isset($_GET['mod']) && $_GET['mod']=='help' && $_GET['ac']=='tradeapp'){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/help/tradeapp");?>"  target="">交易软件</a></span>
            <span <?php if(isset($_GET['mod']) && $_GET['mod']=='user'){echo ' class="active-bar"';}?>><a href="<?php echo \App::URL("web/user/account");?>"  target="">我的账户</a></span>
        </div>
    </div>
</div>
        </div>
        <div class="contain">
            <div class="banner"></div>
            <div class="task">
                <ul class="clearfix">
                    <li class="item" style="background:url('/public/web/images/task/caishen.png') no-repeat center;background-size: contain;height: 152px">
                        
                    </li>
                    <li style="width:8%;">
                        <div class="right"></div>
                    </li>
                    <li class="item <?php if(isset($fund_rows['103'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['103'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">完成注册</div>
                        <div class="desc">打开策略新体验</div>
                        <div class="money">+<?php echo $params_send['regist'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL('web/member/register');?>">前往注册</a></div>
                    </li>
                    <li style="width:8%">
                        <div class="right"></div>
                    </li>
                    <li class="item <?php if(isset($fund_rows['105'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['105'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">实名认证</div>
                        <div class="desc">真实身份信息认证</div>
                        <div class="money">+<?php echo $params_send['sfz'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL('web/user/sfz');?>">前往实名</a></div>
                    </li>
                </ul>
                <div class="down"></div>
                <ul class="clearfix">
                    <li class="item <?php if(isset($fund_rows['107'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['107'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">首次策略</div>
                        <div class="desc">免费体验合约除外</div>
                        <div class="money">+<?php echo $params_send['peizi'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL("web/peizi/month");?>">申请合约</a></div>
                    </li>
                    <li style="width:8%">
                        <div class="left"></div>
                    </li>
                    <li class="item <?php if(isset($fund_rows['111'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['111'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">首次充值</div>
                        <div class="desc">首次体验充值功能</div>
                        <div class="money">+<?php echo $params_send['recharge'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL("web/user/recharge");?>">申请合约</a></div>
                    </li>
                    <li style="width:8%">
                        <div class="left"></div>
                    </li>
                    <li class="item <?php if(isset($fund_rows['106'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['106'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">绑定银行卡</div>
                        <div class="desc">开户名与实名认证同名</div>
                        <div class="money">+<?php echo $params_send['bank'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL("web/user/bank");?>">前往绑定</a></div>
                    </li>
                </ul>
                <div class="down2"></div>
                <ul class="clearfix">
                    <li class="item <?php if(isset($fund_rows['108'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['108'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">首次追加策略</div>
                        <div class="desc">首次体验追加策略功能</div>
                        <div class="money">+<?php echo $params_send['add'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL("web/user/account");?>">前往操作</a></div>
                    </li>
                    <li style="width:8%;">
                        <div class="right"></div>
                    </li>
                    <li class="item <?php if(isset($fund_rows['109'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['109'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">首次补亏</div>
                        <div class="desc">首次体验补亏功能</div>
                        <div class="money">+<?php echo $params_send['fill'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL("web/user/account");?>">前往操作</a></div>
                    </li>
                    <li style="width:8%;">
                        <div class="right"></div>
                    </li>
                    <li class="item <?php if(isset($fund_rows['110'])){echo 'done';}?>">
                        <?php if(isset($fund_rows['110'])){?>
                        <div class="wc"></div>
                        <?php }?>
                        <div class="title">首次提盈</div>
                        <div class="desc">首次体验提盈功能</div>
                        <div class="money">+<?php echo $params_send['profit'];?>元管理费</div>
                        <div class="button"><a href="<?php echo \App::URL("web/user/account");?>">前往操作</a></div>
                    </li>
                    
                </ul>
            </div>
            <div style="height:40px"></div>
        </div>
        <!-- 网站底部 -->
        <div class="footer-module">
            <div class="footer-nav w1200">
                
                <div class="service-num-module">
                    <p style="font-size: 22px;color: #fff;text-align: right;padding-right: 60px;">客服热线</p>
                    <span class="service-tel-icon" style="font-size:28px;color:#fff;    font-weight: 700;">4000-039-678</span>
                    <div  style="color: #999999;text-align: right;padding-right: 50px;">服务时间：08:00-20:00（工作日）<br>12:00-17:00（节假日）                </div>
                </div>
                <div class="qr-code-module">
                    
                   <!-- <div class="qr-code-item">
                        <span class="yhqb-app-icon"><img style="width:120px;" src="/public/web/images/add/ewm_weixin.png?v=2"/></span>
                        <p >客服微信二维码</p>
                    </div>-->
                    
                </div>
                <div class="related-link">
                    <div>
                        <p class="first-row">关于我们</p>
                        <p><a href="/index.php?app=web&mod=about&ac=us" target="_blank">平台简介</a></p>
                        <p><a href="/index.php?app=web&mod=about&ac=qualification" target="_blank">公司证件</a></p>
                        <p><a href="/index.php?app=web&mod=article&ac=view&pid=5" target="_blank">平台公告</a></p>
                        <p><a href="/index.php?app=web&mod=about&ac=contact" target="_blank">联系我们</a></p>
                    </div>
                    <div>
                        <p class="first-row">股票策略</p>
                        <p><a href="/index.php?app=web&mod=peizi&ac=month" target="_blank">按月策略</a></p>
                        <p><a href="/index.php?app=web&mod=peizi&ac=day" target="_blank">按天策略</a></p>
                        <p><a href="/index.php?app=web&mod=peizi&ac=free" target="_blank">免费体验</a></p>
                        <p><a href="/index.php?app=web&mod=help&ac=software" target="_blank">APP下载</a></p>
                    </div>
                    <div>
                        <p class="first-row">贴心指引</p>
                        <p><a href="/index.php?app=web&mod=help&ac=guide" target="_blank">新手指南</a></p>
                        <p><a href="/index.php?app=web&mod=index&ac=activity" target="_blank">福利专区</a></p>
                        <p><a href="/index.php?app=web&mod=help&ac=agreement" target="_blank">注册协议</a></p>
                        <p><a href="/index.php?app=web&mod=index&ac=safe" target="_blank">安全保障</a></p>
                    </div>
                    <div>
                        <p class="first-row">帮助中心</p>
                        <p><a href="/index.php?app=web&mod=help&ac=member" target="_blank">注册问题</a></p>
                        <p><a href="/index.php?app=web&mod=help&ac=member" target="_blank">充值问题</a></p>
                        <p><a href="/index.php?app=web&mod=help&ac=member" target="_blank">认证问题</a></p>
                        <p><a href="/index.php?app=web&mod=help&ac=storck" target="_blank">策略问题</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="company-copyright">
            <div class="w1200">
                
                <div class="copyright">
                    <p style="text-align: center"><?php echo SITE_COPYRIGHT;?>  股市有风险,投资需谨慎</p>
                    
                    <DIV style="text-align: center;height: 48px;line-height: 48px;">
                               

                

    <!--360代码开始-->
    <!--<a target='_blank' href="http://webscan.360.cn/index/checkwebsite/url/www.hypz.cn"><img  height="48px" border="0" src="/public/web/images/360aq.png"/></a>
    <!--360代码结束-->


    <!--创宇信用开始-->
    <!--<a target='_blank' href="https://v.yunaq.com/certificate?domain=www.hypz.cn&from=label&code=90030"><img  height="48px" src="/public/web/images/label_sm_90030.png"></a>
    <!--创宇信用结束-->

    <!--315开始-->
   <!-- <a id='___szfw_logo___' href='https://credit.szfw.org/CX29080008865820181219.html' target='_blank'><img  height="48px" src='/public/web/images/green.jpg' border='0' /></a>
    <script type='text/javascript'>(function(){document.getElementById('___szfw_logo___').oncontextmenu = function(){return false;}})();</script>
    <!--315结束-->

    <!--诚信网站开始-->
   <!-- <a id='___szfw_logo___' href='https://credit.szfw.org/CX75010008863520181219.html' target='_blank'><img  height="48px" src='/public/web/images/cert.png' border='0' /></a>
    <script type='text/javascript'>(function(){document.getElementById('___szfw_logo___').oncontextmenu = function(){return false;}})();</script>
    <!--诚信网站结束-->

    <!--可信网站图片LOGO安装开始-->   
   <!-- <script src="http://kxlogo.knet.cn/seallogo.dll?sn=e18121844010076377rm6r000000&size=0"></script>
    <!--可信网站图片LOGO安装结束-->

    <!--水滴开始-->

   <!-- <a target="_blank" href="http://shuidi.cn/seller/home-498ee6ca9b39906f40b72c3bf1d7a801.html"><img  height="48px"  src="/public/web/images/lixin.png"></a>

    <!--水滴结束-->

    <!--知道创宇开始-->
    <!--<a id="jsl_speed_stat0" href="http://www.hypz.cn/" target="_blank">知道创宇云安全</a><script src="//static.yunaq.com/static/js/stat/picture_stat.js" charset="utf-8" type="text/javascript"></script>
    <!--知道创宇结束-->
<a target="cyxyv" href="https://v.yunaq.com/certificate?domain=www.hypz.cn&from=label&code=90030"><img src="https://aqyzmedia.yunaq.com/labels/label_sm_90030.png"></a>

    <!--安全可信代码开始-->
    <a target="_blank" href="http://www.cn-ecusc.org.cn/cert/aqkx/site/?site=www.hypz.cn"><img  height="48px" src="/public/web/images/aqkx_124x47.png"></a>
    <!--安全可信代码结束-->
    
	<a id='___szfw_logo___' href='https://credit.szfw.org/CX201902151226123658830328.html' target='_blank'><img  height="48px" src='/public/web/images/cert.png' border='0' /></a>
	
	<a id="_pingansec_bottomimagelarge_p2p" href="http://si.trustutn.org/info?sn=315190409000668672441&certType=4" target='_blank'><img  height="48px" src='/public/web/images/jr.png' border='0' /></a>	
	
<script type='text/javascript'>(function(){document.getElementById('___szfw_logo___').oncontextmenu = function(){return false;}})();</script>


                    </DIV>            
                </div>
            </div>
        </div>

        <div class="right-fixed-side-bar">
            <ul>
                <li id="f1_img" class="f1-img" title="点击咨询在线客服"><a href="<?php echo SITE_SERVICE_URL;?>" target="_blank"><img src="/public/web/images/zxkf.png" /><p>在线客服</p></a></li>
                <li id="f2_img" class="f2-img" title="客服热线"><a href="javascript:void(0)" ><img src="/public/web/images/kfdh3-icons.png" /><p class="p2">客服热线</p></a>
                    <div class="dropdown">
                        <ul> 
                            <li>
                                <span title="" style="color: #fff;font-size: 23px;line-height: 60px;">4000-039-678</span>
                            </li>
                        </ul>
                    </div>
                </li>
                <li id="f3_img" class="f3-img" title="点击咨询QQ客服"><a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=75698888&website=www.oicqzone.com"  target="_blank"><img src="/public/web/images/kefu-icon.png" /><p class="p3">QQ客服</p></a></li>
               <!-- <li id="f4_img" class="f4-img" title="扫一扫咨询微信客服"><a href="javascript:void(0)" ><img src="/public/web/images/weixin2.png" /><p class="p4">微信客服</p></a></li>-->

                
                <li id="f6_img" class="f6-img"  title="点击下载APP"><a href="<?php echo \App::URL('web/help/software');?>"   target="_blank"><img src="/public/web/images/down2.png" /><p class="p2">APP下载</p></a></li>
                <li id="f7_img" class="f7-img"  title="点击下载交易端"><a href="<?php echo \App::URL('web/help/tradeapp');?>"   target="_blank"><img src="/public/web/images/61816.jpg" /></a></li>
                <li id="f8_img" class="f8-img"  title="点击签到"><img src="/public/web/images/qiandao.png" />
                            <div style="position:absolute;left:-100px;top:0;display: none;color:red;font-size:16px;font-weight: bold;height: 50px;line-height: 50px;width:100%;text-align: center" id="sign_money"></div>
                </li>

                <li id="f5_img" class="f5-img"><a href="javascript:void(0)"><img src="/public/web/images/float_8.png" /><p class="p2">返回</p></a></li>
            </ul>
        </div>

<script type="text/javascript">
$(function(){
        $("#f8_img").click(function(){
            var uid = <?php echo $uid;?>;
            if(uid<=0){
                top.dialog2('您还未登录！','error');
                return;
            }
            $(this).attr("disabled",true);
            $.post("<?php echo \App::URL('web/user/sign')?>",{},function(res){
                 $(this).attr("disabled",false);
                if(res.ret == 0){
                    $("#sign_times").html(res.times);
                    $("#sign_money").html("+"+res.money);
                    $("#sign_money").show();
                    setTimeout(function(){
                        $("#sign_money").animate({fontSize:'90px'},2000);
                    },200)
                    setTimeout(function(){
                        $("#sign_money").animate({fontSize:'16px'},2000);
                    },1200)
                    setTimeout(function(){
                        $("#sign_money").hide();
                    },4000)
                }
                else{
                    top.dialog2(res.msg,'error');
                }
            },'json')
        })
    })
            
    $(function () {
        $(window).scroll(function () {
            var scrollValue = $(window).scrollTop();
            if (scrollValue > 100) {
                $('#f5_img').height() == 0 && $('#f5_img').stop().animate({'height': '60px', 'margin-top': '5px'}, 200);
                $('#f5_img').show();
            } else {
                $('#f5_img').height() > 0 && $('#f5_img').stop().animate({'height': 0, 'margin-top': '0'}, 200);
                $('#f5_img').hide();
            }
        });
        $('#f5_img').click(function () {
            $("html,body").animate({scrollTop: 0}, 200);
        });
    })
</script>
        <script type="text/javascript" src="https://s96.cnzz.com/z_stat.php?id=1276284630&web_id=1276284630"></script>
        <!--脚本开始-->
        <?php echo str_replace("&#039;", "'", html_entity_decode(SITE_SERVICE_SCRIPT))  ; ?>
        <!--脚本结束-->
        <!-- 网站底部 -->
    </body>
</html>