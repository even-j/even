<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/admin\view\seller\updatepwd.html";i:1578363030;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>押金</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/admin_style/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/admin_style/css/public.css" media="all" />
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1308190_7kttvg3l5i.css" media="all" />
</head>

<body class="childrenBody">
<input  type="hidden" name="dataid" lay-verify="beizhu" autocomplete="off" class="layui-input dataid"
        placeholder="备注">
<form class="layui-form">
    <blockquote class="layui-elem-quote layui-quote-nm">
        <div class="layui-form-item layui-form-text">
            <input placeholder="修改密码" class="layui-textarea wgbz" name="wgbz" lay-verify="wgbz">
        </div>
        <div class="layui-form-item layui-form-text">
            <input placeholder="确认密码" class="layui-textarea wgbz1" name="wgbz1" lay-verify="wgbz1">
        </div>
        <div class="layui-form-item layui-form-text" style="text-align: right; padding-top:30px;">
            <div class="">
                <a class="layui-btn search_btn" data-type="reload" lay-filter="reload" lay-submit> 确 定 </a>
            </div>
        </div>
    </blockquote>
</form>
<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
<script>
    layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer,
            $ = layui.jquery,
            laytpl = layui.laytpl,
            table = layui.table;
        laydate = layui.laydate;
        var dataid = $(".dataid").val(); //id
        //验证数据
        form.verify({
            phone: function (value, item) { //value：表单的值、item：表单的DOM对象
                //   if(!/^1[3456789]\d{9}$/.test(value)){
                //     return '手机号码有误，请重填';
                //   }
            }
            , name: function (value, item) {

            }
            //我们既支持上述函数式的方式，也支持下述数组的形式
            //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
            , pass: [
                /^[\S]{6,12}$/
                , '密码必须6到12位，且不能出现空格'
            ]
        });
        //表单提交
        form.on("submit(reload)", function (data) {
            var field = data.field;
            var curr=$(".layui-laypage-em").next().html(); //当前页码值
            //弹出loading 加载
            var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });

            var wgbz = field.wgbz;
            var wgbz1 = field.wgbz1;
            var dataid = $(".dataid").val(); //id
            console.log(dataid);
            $.ajax({
                type: "post",
                url: '/index.php/admin/seller/updatepwd/id/'+dataid+'',
                data: {
                    'id':dataid,
                    'login_pwd':wgbz,
                    'login_pwd2':wgbz1
                },
                dataType: "json",
                async:true,
                success:function(data) {
                    if(data.code == 1){
                        layer.msg(data.msg, {icon: 1},function () {
                            // 搜索条件
                            var name = $("input[name=name]").val(); //姓名
                            var expireTime = $("input[name=expireTime]").val(); //会员到期
                            var registerTime = $("input[name=registerTime]").val(); //注册时间
                            var phone = $("input[name=phone]").val(); //手机号
                            var state = $('#state1 option:selected').val(); //状态
                            var account = $("input[name=account]").val(); //账户
                            var username = $("input[name=username]").val(); //用户名
                            var qq = $("input[name=qq]").val(); //QQ号
                            var tjuser = $("input[name=tjuser]").val(); //来源id
                            parent.layui.table.reload('userListTable', {
                                method: 'post'
                                , where: {
                                    'name': name, //姓名
                                    'expireTime': expireTime,    //会员到期
                                    'registerTime': registerTime,    //注册时间
                                    'phone': phone,  //手机号
                                    'state': state, //状态
                                    'account': account, //账户
                                    'username': username, //用户名
                                    'qq': qq, //QQ号
                                    'tjuser': tjuser, //来源id
                                }
                                , page: {
                                    curr: curr
                                }
                            });
                            setTimeout(function () {
                                parent.layui.layer.closeAll();
                                top.layer.msg("操作成功！");

                            }, 500);
                            return false;
                        });
                    }else{
                        layer.msg(data.msg, {icon: 2});
                        //layer.msg('删除失败', {icon: 2});
                    }
                }
            });
            // setTimeout(function () {
            //     top.layer.close(index);
            //     top.layer.msg("搜索成功！");
            // }, 500);
            // return false;
        });

    })

</script>
</body>

</html>
