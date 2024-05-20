
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

    </head>

    <body class="index">
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
        <!--<link href="/public/web/css/event.css" rel="stylesheet" type="text/css" media="screen,projection" />-->
        <link rel="stylesheet" type="text/css" href="/public/web/css/util.css"/>
        <link rel="stylesheet" type="text/css" href="/public/web/css/main_aqbz.css"/>
        <script type="text/javascript" src="/public/web/js/jquery-1.8.3.min.js"></script>
        <!-- Content Start -->
        <div class="safe_con">
            <ul>
                <li class="safe_creat">
                    <div class="wrap clear safe_creat_wrap">
                        <img class="safe_creat_safe" src="/public/web/images/aqbz/safe.png"/>
                        <img class="safe_creat_safe1" src="/public/web/images/aqbz/safe-1.png"/>
                        <img class="safe_creat_safe2" src="/public/web/images/aqbz/safe-2.png"/>
                        <img class="safe_creat_safe3" src="/public/web/images/aqbz/safe-3.png"/>
                        <img class="safe_creat_safe4" src="/public/web/images/aqbz/safe-4.png"/>
                        <img class="safe_creat_safe5" src="/public/web/images/aqbz/safe-5.png"/>
                    </div>
                </li>
                <li class="safe_guo">
                    <!-- <a name="1"></a> -->
                    <div class="wrap clear">
                        <div class="left">
                            <h4><span>强</span>实力</h4>
                            <strong>500万人民币注册资本金</strong>
                            <p>广州栋供科技有限公司经广州市政府批准成立并在广州市工商行政管理局正式注册登记，注册资本500万元人民币，是广州实力品牌策略公司之一。</p>
                        </div>
                        <div class="right">
                            <img src="/public/web/images/aqbz/pic-16.png" alt="">
                        </div>
                    </div>
                </li>
                <li class="safe_you">
                    <!-- <a name="4"></a> -->
                    <div class="wrap clear">
                        <div class="left">
                            <img src="/public/web/images/aqbz/pic-21.png" alt="">
                        </div>
                        <div class="right">
                            <h4>有<span>保险</span></h4>
                            <strong>保险机构100%风险保障</strong>
                            <p>保险机构承保“信用履约保证保险”。如果被保险人（即平台方）不按照合同约定或法律的规定履行义务，保险机构对投资人风险全额保障。</p>
                        </div>
                    </div>
                </li>
                <li class="safe_bao">
                    <!-- <a name="3"></a> -->
                    <div class="wrap clear">
                        <div class="left">
                            <h4><span>技术</span>保障</h4>
                            <strong>专业的技术保障交易安全</strong>
                            <p>强大的技术团队、独立研发系统、科学严格的权限管理及银行级数据灾备系统保障用户信息以及交易信息的绝对安全，为用户资金及个人信息提供360度无死角的安全保障。</p>
                        </div>
                        <div class="right">
                            <img src="/public/web/images/aqbz/pic-18.png" alt="">
                        </div>
                    </div>

                </li>
                <li class="safe_chao">
                    <!-- <a name="2"></a> -->
                    <div class="wrap clear">
                        <div class="left">
                            <img src="/public/web/images/aqbz/pic-17.png" alt="">
                        </div>
                        <div class="right">
                            <h4><span>风控</span>管理</h4>
                            <strong>科学严密的风控运维体系</strong>
                            <p>采用先进的安全风控体系，由一批业内顶尖的风控专业人员建立并完善了一系列风险控制机制和风险管理制度，确保用户的个人信息、交易信息安全，并及时采取风控措施降低用户交易风险。</p>
                        </div>
                    </div>
                </li>
                <li class="safe_zhen">
                    <!-- <a name="5"></a> -->
                    <div class="wrap clear">
                        <div class="left">
                            <h4>三方<span>存管</span></h4>
                            <strong>资金第三方存管，专款专用</strong>
                            <p>使用证券公司及银行合作监管，所有资金通过证券公司和银行合作监管进行结算。平台账户、投资人资管账户完全隔离，避免资金管理风险；平台注用户须进行实名认证，保证提现资金的安全性。</p>
                        </div>
                        <div class="right">
                            <img src="/public/web/images/aqbz/pic-19.png" width="425" alt="">
                        </div>
                    </div>

                </li>
            </ul>
            <ol class="safe_icon">
                <li class="on"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ol>
        </div>





        <!-- online custom service start -->


        <script type="text/javascript">
            $(function() {

                var WscrollTop = document.body.scrollTop || document.documentElement.scrollTop;
                Wscroll(WscrollTop);
                $(window).scroll(function() {
                    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
                    Wscroll(scrollTop);
                })
                if (window.location.hash == "#1") {
                    $(window).scrollTop(500);
                } else if (window.location.hash == "#4") {
                    $(window).scrollTop(1041);
                } else if (window.location.hash == "#3") {
                    $(window).scrollTop(1582);
                } else if (window.location.hash == "#2") {
                    $(window).scrollTop(2164);
                } else if (window.location.hash == "#5") {
                    $(window).scrollTop(2705);
                }
                $('.safe_icon li').click(function() {
                    var index = $(this).index();
                    $('html,body').animate({scrollTop: 541 * index}, 800);
                    return false;

                })

                function Wscroll(scrolltop) {
                    if (0 <= scrolltop && scrolltop < 440) {
                        $('.safe_icon li').removeClass('on');
                        $('.safe_icon li:eq(0)').addClass('on');
                        $('.safe_creat_safe1').delay(500).fadeIn();
                        $('.safe_creat_safe2').delay(700).fadeIn();
                        $('.safe_creat_safe3').delay(900).fadeIn();
                        $('.safe_creat_safe4').delay(1100).fadeIn();
                        $('.safe_creat_safe5').delay(1300).fadeIn();
                    } else if (440 <= scrolltop && scrolltop < 980) {
                        $('.safe_icon li').removeClass('on');
                        $('.safe_icon li:eq(1)').addClass('on');
                        $('.safe_guo .left').animate({marginLeft: '0'}, 1000, 'swing');
                        $('.safe_guo .right').animate({marginRight: '0'}, 1000, 'swing');
                    } else if (980 < scrolltop && scrolltop < 1520) {
                        $('.safe_icon li').removeClass('on');
                        $('.safe_icon li:eq(2)').addClass('on');
                        $('.safe_you .left').animate({marginLeft: '0'}, 1000, 'swing');
                        $('.safe_you .right').animate({marginRight: '0'}, 1000, 'swing');
                    } else if (1520 < scrolltop && scrolltop < 2060) {
                        $('.safe_icon li').removeClass('on');
                        $('.safe_icon li:eq(3)').addClass('on');
                        $('.safe_bao .left').animate({marginLeft: '0'}, 1000, 'swing');
                        $('.safe_bao .right').animate({marginRight: '0'}, 1000, 'swing');
                    } else if (2060 < scrolltop && scrolltop < 2600) {
                        $('.safe_icon li').removeClass('on');
                        $('.safe_icon li:eq(4)').addClass('on');
                        $('.safe_chao .left').animate({marginLeft: '0'}, 1000, 'swing');
                        $('.safe_chao .right').animate({marginRight: '0'}, 1000, 'swing');
                    } else if (2600 < scrolltop && scrolltop < 3140) {
                        $('.safe_icon li').removeClass('on');
                        $('.safe_icon li:eq(5)').addClass('on');
                        $('.safe_zhen .left').animate({marginLeft: '0'}, 1000, 'swing');
                        $('.safe_zhen .right').animate({marginRight: '0'}, 1000, 'swing');
                    }
                }

            });
        </script>
        <!-- Content End -->
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