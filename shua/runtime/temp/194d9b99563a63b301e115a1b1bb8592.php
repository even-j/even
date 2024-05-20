<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:70:"/www/wwwroot/xbt.com/pubic/../application/mobile/view/login/index.html";i:1698586735;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>登录</title>
    <link rel="stylesheet" href="/static/mobile/css/plugin.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/public.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/page.css" type="text/css">
    <script src="/static/mobile/js/all.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/jquery-1.12.4.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/vue-2.6.10.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/vant.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/public.js" type="text/javascript" charset="UTF-8"></script>
    <script>
        $(function () {
            var vm = new Vue({
                el: ".tfkz-container",
                data: function () {
                    return {
                        name: "",
                        password: "",
                        code: ""
                    };
                },
                methods:{
                    click:function(){
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('mobile/login/index'); ?>",
                            async : true,
                            data : {
                                "aoData" : 'aaaa',//测试数据,
                                "captcha_code":vm.code,
                                "name":vm.name,
                                "password":vm.password
                            },
                            success : function(data){
                                console.log(data);
                                if(data.code==1){
                                    alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    },
                },
                mounted:function () {
                    publicFunction();
                    $('.yzm-box').click(function(){
                        $(this).children().attr('src',"<?php echo url('login/yanzhengma'); ?>");
                    })
                }
            });
        });
    </script>
</head>
<body>
<div class="tfkz-container">
    <div class="login-box">
        <!-- 登录框 -->
        <div class="login-wrap">
            <h1>买家登录</h1>
            <div class="input-box">
                <input type="text" placeholder="请输入用户名" v-model="name" />
            </div>
            <div class="input-box">
                <input type="password" placeholder="请输入密码" v-model="password" />
            </div>
          <!--  <div class="input-box">
                <input type="text" maxlength="5" placeholder="请输验证码" v-model="code" />
                <div class="yzm-box"><img src="<?php echo url('login/yanzhengma'); ?>" alt=""></div>
            </div>-->
            <div class="forget-password">
                <a href="<?php echo url('login/register'); ?>">注册有礼</a>
            </div>
            <div class="login-btn">
                <van-button @click="click" class="login-btn-item" type="info">点击登录</van-button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
