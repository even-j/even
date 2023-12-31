<?php
error_reporting(0);//PHP报错不显示
header("content-Type: text/html; charset=Utf-8"); 
//导入配置文件 一般配置这个文件即可 如果你是高手任你发挥

require_once("config.php");
$base = base64_decode($_REQUEST['data']);
if(!$base){
	exit('error data');
}
$base = explode(',',$base);
//将主要数据列入数组
$yundata = array(
   "appid"  => $congig['appid'],//获取appid
   "data"    =>  $base[0],//数据单号
   "money"    =>  $base[1],//金额
   "atype"    =>  1,//H5模式1
   "type"   =>  1
);

//订单查询签名格式
//$sing = md5('appid='.$appid.'&data='.$data.'&money='.$money.'&type='.$type.'&appkey='.&appkey.'');
//以上是token签名规则
$token = array(
  "appid"  =>  $congig['appid'],//APPID号码
  "data"    =>  $yundata['data'],//数据单号
  "money"    =>  $yundata['money'],//金额
  "type"   =>  1,//支持支付宝
  "appkey" =>  $congig['appkey']//appkey密匙
);

 //加密token 32位  小写
$token = md5(urlparams($token));
//exit($token);
//重组条件
$postdata = urlparams($yundata).'&token='.$token;



//订单查询网关地址后面加 order
$fdata = curl_post_https($congig['server'].'Alipay',$postdata);

$sdata = json_decode($fdata, true);//将json代码转换为数组

if($sdata['state']==0){
	print_r($yundata);
	exit( $sdata['text']);
}
$sdata = $sdata['text'];
/*
返回
$sdata['money'] 金额
$sdata['alipayid'] ID号
$sdata['data'] 数据
*/
?>
<!DOCTYPE html>
<html>
<head>
  	<title>支付宝</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="zh-cn">
    <meta name="apple-mobile-web-app-capable" content="no"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no,email=no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script> 
</head>
<body>
请使用支付宝扫码

<script>
//本实例仅在 支付宝内置才有效，根据自己需求进行开发。
document.addEventListener("resume",
function(a) {
    returnApp();
});

function returnApp() {
    AlipayJSBridge.call("exitApp");
}
function ready(a) {
    window.AlipayJSBridge ? a && a() : document.addEventListener("AlipayJSBridgeReady", a, !1);
}

ready(function() {
    try {
        var a = {
            actionType: "scan",
            u: "<?=$sdata['alipayid']?>",//支付宝ID号 可根据优云宝提供的API里面进行查询
            a: "<?=$sdata['money']?>",//扫码支付付款金额
            m: "<?=$sdata['data']?>",//自动备注
            biz_data: {
                s: "money",
                u: "<?=$sdata['alipayid']?>",//支付宝ID号 可根据优云宝提供的API里面进行查询
                a: "<?=$sdata['money']?>",//扫码支付付款金额
                m: "<?=$sdata['data']?>"//自动备注
            }
        }
    } catch(b) {
        returnApp()
    }
    AlipayJSBridge.call("startApp", {
        appId: "20000123",//不做修改
        param: a
    },
    function(a) {});
});
</script>


</body>
</html>