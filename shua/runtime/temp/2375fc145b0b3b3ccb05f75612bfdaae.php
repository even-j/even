<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"/www/wwwroot/xbt.com/pubic/../application/buy/view/my/information.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/header.html";i:1698557938;s:58:"/www/wwwroot/xbt.com/application/buy/view/public/left.html";i:1574049114;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>小白兔</title>
    <link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
    <!-- 页面内容CSS -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/jiBenXinXi.css"/>
    <link rel="Shortcut Icon" type="image/x-icon" href="/static/buy/img/index.png" />
    <script src="/static/buy/js/vue-2.6.10.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/element-ui/lib/index.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function () {

            // 手机号正则表达式
            var phoneReg = /^1[3-9]\d{9}$/;
            // 支付密码正则,6位数字密码,验证码同样适用
            var zhifuReg = /^\d{6}$/;

            /* 为element-ui组件提供数据绑定和事件 */
            var vm = new Vue({
               el: ".center_box",
                data: function () {
                    return {
                        /* 默认隐藏弹框 */
                        dialogusername: false,
                        dialogPhoneNum: false,
                        dialogPassWord: false,
                        dialogZhiFuPassWord: false,
                        /* 验证码按钮默认不禁用 */
                        yzmDisabled: false,
                        yzmDisabled2: false,
                        yzmDisabled3: false,
                        /* 默认的验证码按钮文字内容 */
                        yzmMsg: "发送验证码",
                        yzmMsg2: "发送验证码",
                        yzmMsg3: "发送验证码",
                        usernameObj:{
                            username:"",
                        },
                        phoneNumObj: {
                            oldPhoneNum: "",
                            zhifuPassWord: "",
                            newPhoneNum: "",
                            newYzmNum: ""
                        },
                        passWordObj: {
                            oldPassWord: "",
                            newPassWord: "",
                            queRenPassWord: "",
                            phoneNum: "",
                            newYzmNum: ""
                        },
                        zhifuPassWordObj: {
                            oldZhiFuPassWord: "",
                            newZhiFuPassWord: "",
                            queRenZhiFuPassWord: "",
                            phoneNum: "",
                            yzmNum: ""
                        }
                    }
                },
                methods: {
                    /* 下拉菜单事件 */
                    handleOpen: function (key, keyPath) {
                        // console.log(key, keyPath);
                    },
                    handleClose: function (key, keyPath) {
                        // console.log(key, keyPath);
                    },
                    /* 消息弹框事件 */
                    openMsg: function () {
                        this.$alert("暂无消息通知", "个人通知", {});
                    },
                    /* 失败的弹框 */
                    alertError: function (e) {
                        this.$message.error(e);
                    },
                    /* 成功的弹框 */
                    alertSuccess: function (e) {
                        this.$message({
                            message: e,
                            type: "success"
                        });
                    },
                    /* 打开弹框并清空表单 */
                    openDialogusername: function () {
                        this.dialogusername = true;
                        this.usernameObj.username = "";
                    },
                    openDialogPassWord: function () {
                        this.dialogPassWord = true;
                        this.passWordObj.oldPassWord = "";
                        this.passWordObj.newPassWord = "";
                        this.passWordObj.queRenPassWord = "";
                        this.passWordObj.phoneNum = "";
                        this.passWordObj.newYzmNum = "";
                    },
                    openDialogZhiFuPassWord: function () {
                        this.dialogZhiFuPassWord = true;
                        this.zhifuPassWordObj.oldZhiFuPassWord = "";
                        this.zhifuPassWordObj.newZhiFuPassWord = "";
                        this.zhifuPassWordObj.queRenZhiFuPassWord = "";
                        this.zhifuPassWordObj.phoneNum = "";
                        this.zhifuPassWordObj.yzmNum = "";
                    },
                    openDialogPhoneNum: function () {
                        this.dialogPhoneNum = true;
                        this.phoneNumObj.oldPhoneNum = "";
                        this.phoneNumObj.zhifuPassWord = "";
                        this.phoneNumObj.newPhoneNum = "";
                        this.phoneNumObj.newYzmNum = "";
                    },
                    usernameBtnActive:function (){
                        if(!this.usernameObj.username) return vm.alertError("新昵称输入不能为空");
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('buy/my/editusername'); ?>",
                            async : true,
                            data : {
                                "username":vm.usernameObj.username,
                            },
                            success : function(data){
                                if(data.code==1){
                                    vm.alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return vm.alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    },
                    /* 第一个表单验证 */
                    phoneBtnActive: function () {
                             if(!this.phoneNumObj.oldPhoneNum){ return vm.alertError("原手机号码不能为空");}
                             if(!this.phoneNumObj.zhifuPassWord) {return vm.alertError("支付密码不能为空");}
                             if(!this.phoneNumObj.newPhoneNum) {return vm.alertError("新手机号码不能为空");}
                             if(!this.phoneNumObj.newYzmNum) {return vm.alertError("新手机号码验证码不能为空");}
                            $.ajax({
                                type : 'POST',
                                url : "<?php echo url('buy/my/editphone'); ?>",
                                async : true,
                                data : {
                                    "oldphone":vm.phoneNumObj.oldPhoneNum,
                                    "pay_pwd":vm.phoneNumObj.zhifuPassWord,
                                    "mobile":vm.phoneNumObj.newPhoneNum,
                                    "dxyzm":vm.phoneNumObj.newYzmNum,
                                },
                                success : function(data){
                                    if(data.code==1){
                                        vm.alertSuccess(data.msg);
                                        setTimeout(function(){
                                            return location.href=data.url;
                                        },3000)

                                    }else{
                                        return vm.alertError(data.msg);
                                    }
                                },
                                error : function(XMLHttpRequest, textStatus, errorThrown) {
                                    alert(XMLHttpRequest.status + "," + textStatus);
                                }
                            });
                    },
                    /* 第二个表单验证 */
                    editBtnActive: function () {
                        if(!this.passWordObj.oldPassWord) {return vm.alertError("原登录密码不能为空");}
                        if(!this.passWordObj.newPassWord) {return vm.alertError("新登录密码不能为空");}
                        if(!this.passWordObj.queRenPassWord){ return vm.alertError("确认登录密码不能为空");}
                        if(!this.passWordObj.phoneNum){ return vm.alertError("手机号码不能为空");}
                        if(!this.passWordObj.newYzmNum) {return vm.alertError("验证码不能为空");}
                        if (!zhifuReg.test(this.passWordObj.newYzmNum)) {
                            return vm.alertError("验证码格式不规范");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('buy/my/edit_login_pwd'); ?>",
                            async : true,
                            data : {
                                "oldloginpwd":vm.passWordObj.oldPassWord,
                                "login_pwd":vm.passWordObj.newPassWord,
                                "login_pwd2":vm.passWordObj.queRenPassWord,
                                "mobile":vm.passWordObj.phoneNum,
                                "dxyzm":vm.passWordObj.newYzmNum,
                            },
                            success : function(data){
                                if(data.code==1){
                                    vm.alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return vm.alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    },
                    /* 第三个表单验证 */
                    zhiFuBtnActive: function () {
                        if(!this.zhifuPassWordObj.newZhiFuPassWord) {return vm.alertError("新支付密码不能为空");}
                        if(!this.zhifuPassWordObj.queRenZhiFuPassWord) {return vm.alertError("确认新密码不能为空");}
                        if(!this.zhifuPassWordObj.phoneNum){ return vm.alertError("手机号码不能为空");}
                        if(!this.zhifuPassWordObj.yzmNum) return vm.alertError("验证码不能为空");
                        if (!zhifuReg.test(this.zhifuPassWordObj.newZhiFuPassWord)) {
                            return vm.alertError("您输入的密码不规范");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('buy/my/edit_pay_pwd'); ?>",
                            async : true,
                            data : {
                                "pay_pwd":vm.zhifuPassWordObj.newZhiFuPassWord,
                                "pay_pwd2":vm.zhifuPassWordObj.queRenZhiFuPassWord,
                                "mobile":vm.zhifuPassWordObj.phoneNum,
                                "dxyzm":vm.zhifuPassWordObj.yzmNum,
                            },
                            success : function(data){
                                if(data.code==1){
                                    vm.alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return vm.alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    },
                    /* 发送验证码 */
                    sendYzm: function () {
                        if(!vm.phoneNumObj.newPhoneNum){ return vm.alertError("手机号码不能为空");}
                        if (!phoneReg.test(vm.phoneNumObj.newPhoneNum)) {
                            return vm.alertError("手机号码格式不规范,请检查后重新输入");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('way/send_code'); ?>",
                            async : true,
                            data : {
                                "mobile":vm.phoneNumObj.newPhoneNum,
                                "dxyzm":vm.phoneNumObj.newYzmNum,
                            },
                            success : function(data){
                                // vm.alertError(data.msg);
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                        var num = 60;
                        var that = this;
                        var timer = setInterval(function () {
                            num--;
                            that.yzmDisabled = true;
                            that.yzmMsg = "还剩 " + num + " 秒";
                            if (num <= 0) {
                                clearInterval(timer);
                                that.yzmMsg = "重新发送";
                                that.yzmDisabled = false;
                            } else if (num === 59) {
                                that.alertSuccess("验证码发送成功,若接收失败请耐心等待一分钟后点击重新发送");
                            }
                        }, 1000);
                    },
                    sendYzm2: function () {
                        if(!this.passWordObj.phoneNum){ return vm.alertError("手机号码不能为空");}
                        if (!phoneReg.test(vm.passWordObj.phoneNum)) {
                            return vm.alertError("手机号码格式不规范,请检查后重新输入");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('way/send_code'); ?>",
                            async : true,
                            data : {
                                "mobile":vm.passWordObj.phoneNum,
                                "dxyzm":vm.passWordObj.newYzmNum,
                            },
                            success : function(data){
                                // vm.alertError(data.msg);
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                        var num = 60;
                        var that = this;
                        var timer = setInterval(function () {
                            num--;
                            that.yzmDisabled2 = true;
                            that.yzmMsg2 = "还剩 " + num + " 秒";
                            if (num <= 0) {
                                clearInterval(timer);
                                that.yzmMsg2 = "重新发送";
                                that.yzmDisabled2 = false;
                            } else if (num === 59) {
                                that.alertSuccess("验证码发送成功,若接收失败请耐心等待一分钟后点击重新发送");
                            }
                        }, 1000);
                    },
                    sendYzm3: function () {
                        if(!this.zhifuPassWordObj.phoneNum){ return vm.alertError("手机号码不能为空");}
                        if (!phoneReg.test(vm.zhifuPassWordObj.phoneNum)) {
                            return vm.alertError("手机号码格式不规范,请检查后重新输入");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('way/send_code'); ?>",
                            async : true,
                            data : {
                                "mobile":vm.zhifuPassWordObj.phoneNum,
                                "dxyzm":vm.zhifuPassWordObj.yzmNum,
                            },
                            success : function(data){
                                // vm.alertError(data.msg);
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                        var num = 60;
                        var that = this;
                        var timer = setInterval(function () {
                            num--;
                            that.yzmDisabled3 = true;
                            that.yzmMsg3 = "还剩 " + num + " 秒";
                            if (num <= 0) {
                                clearInterval(timer);
                                that.yzmMsg3 = "重新发送";
                                that.yzmDisabled3 = false;
                            } else if (num === 59) {
                                that.alertSuccess("验证码发送成功,若接收失败请耐心等待一分钟后点击重新发送");
                            }
                        }, 1000);
                    }

                },
            <?php if(!(empty($editpass) || (($editpass instanceof \think\Collection || $editpass instanceof \think\Paginator ) && $editpass->isEmpty()))): if($editpass ==1): ?>
                created:function(){
                    this.dialogZhiFuPassWord=true;
                }
            <?php else: endif; endif; ?>
            });

            /* 调用jQuery实现选择导航栏效果 */
            $(function () {

                $(".title a").click(function () {
                    $(this).addClass("add_color").siblings().removeClass("add_color");
                });

            });

        });
    </script>
</head>
<body>
<div class="container">

    <!-- 头部 -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/header.css"/>
<div class="header" v-cloak>
    <div class="top_bg">
        <div class="top">
            <div class="top_left">
                <span><?php echo $users['username']; ?></span>
                <span class="gang">|</span>
                <a href="javascript:void (0)" class="tuichu">退出</a>
            </div>
            <div class="top_right">
                <span>本金: <span class="price_color"><?php echo $users['balance']; ?></span>元</span>
                <span class="gang">|</span>
                <span>银锭: <span class="price_color"><?php echo $users['reward']; ?></span>银锭</span>
            </div>
        </div>
    </div>
    <!-- 导航栏 -->
    <div class="nav">
        <a href="javascript:"><img class="logo" src="/static/buy/img/logo.png" alt="小白兔"/></a>
        <div class="title">
            <a href="<?php echo url('my/index'); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 1): ?>class="add_color" <?php endif; endif; ?>>
            个人中心</a>
            <a href="<?php echo url('helpcenter/index'); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 2): ?>class="add_color" <?php endif; endif; ?>> 帮助中心</a>
            <a href="<?php echo url('money/withsilver',['hnav'=>'3','nav'=>'2']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 3): ?>class="add_color" <?php endif; endif; ?>> 银锭充值</a>
            <a href="<?php echo url('money/withdrawal',['hnav'=>'3','nav'=>'1']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 4): ?>class="add_color" <?php endif; endif; ?>> 提现</a>
            <a href="<?php echo url('task/index',['hnav'=>'2','nav'=>'1']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 5): ?>class="add_color" <?php endif; endif; ?>>
            任务大厅</a>
        </div>
        <div class="bell_btn">
            <button type="button" class="el-button el-button--default el-button--small is-circle"
                    @click="dialogVisible = true">
                <i class="el-icon-bell"></i>
            </button>
            <div class="red_type" v-show="num > 0">{{num}}</div>
        </div>
        <div class="renwu_btn">
            <button class="el-button el-button--danger" @click="maketask">
                <img class="renwu_img" src="/static/buy/img/renwu.png" alt=""/>
                <span>继续任务</span>
            </button>
        </div>
    </div>
    <!-- 弹出框内容 -->
    <el-dialog :visible.sync="dialogVisible" title="个人通知">
        <div v-if="state==1" class="center_box1">

            <!-- 左边部分 -->
            <div class="left_box1">
                <div class="left_table">
                    <div :class="[index>=1?'hide_border':'',currentIndex===index?'selectOn':'']"
                         @click="handleClickTable(index)"
                         class="left_table_item"
                         v-for="(item,index) in tableList">
                        <div class="txt">
                            <span :class="item.look==1?'type_color':''"></span>
                            <p v-html="item.title"></p>
                        </div>
                        <div class="time">
                            <i class="el-icon-time"></i>
                            <span v-html="item.create_time"></span>
                        </div>
                    </div>
                </div>
                <div class="fenye">
                    <el-pagination @current-change="setPage"
                                   :page-size="5"
                                   :total="total" :pager-count="5"
                                   background
                                   layout="prev, pager, next">
                    </el-pagination>
                </div>
            </div>

            <!-- 右边盒子部分 -->
            <div class="right_box1">
                <h1 v-html="title" style="margin-bottom: 20px;"></h1>
                <div>
                    <p style="text-indent: 2em" v-html="content">
                </div>
                <div style="display: flex;flex-direction: column;align-self: flex-end;justify-content: flex-end; margin-top: 20px">
                    <p v-html="admin"></p>
                    <p v-html="datetime"></p>
                </div>
            </div>

        </div>
                <div v-else>
                    <span class="masigg">暂无通知</span>
                </div>
    </el-dialog>

</div>
<script>
    $(function () {

        vm=new Vue({
            el: ".header",
            data: function () {
                return {
                    curIndex: 0,
                    dialogVisible: false,
                    tableList: [],
                    currentIndex: 0,
                    title: "",
                    state: 0,
                    content: "",
                    datetime: "",
                    admin: "",
                    total: 0,
                    page: 1,
                    num:0
                }
            },
            methods: {
                maketask:function(){
                    location.href="<?php echo url('task/maketask'); ?>"
                },
                /* 消息弹框事件 */
                openMsg: function () {
                    this.dialogTableVisible = true;
                    if(this.tableList.length > 0){
                        this.setData(0);
                    }
                },
                handleClickTable: function (index) {
                    this.title = this.tableList[index].title;
                    this.content = this.tableList[index].content;
                    this.datetime = this.tableList[index].create_time;
                    this.admin = this.tableList[index].author;
                    this.currentIndex = index;
                    this.tableList[index].type = true;
                    this.setData(index);
                },
                getData: function () {
                    var that = this;
                    $.post("<?php echo url('index/msg'); ?>", {page: that.page}, function (res) {
                        if (res.code == 1) {
                            console.log(res);
                            that.tableList = res.data.list;
                            that.total = res.data.total;
                            that.num = res.data.num;
                            if (that.tableList.length > 0) {
                                that.state = 1;
                                that.title = that.tableList[0].title;
                                that.content = that.tableList[0].content;
                                that.datetime = that.tableList[0].create_time;
                                that.admin = that.tableList[0].author;
                            } else {
                                that.state = 0;
                            }
                        } else {
                            layer.msg('网络错误');
                        }
                    })
                },
                panduan:function(){
                    var timer = setInterval(function(){
                        $.post("<?php echo url('login/getSession'); ?>",{},function(res){
                            console.log(12);
                            if(res.code==1){
                                location.href="<?php echo url('login/index'); ?>";
                            }else{

                            }
                        })
                    },10000);
                },
                setData:function(index){
                    var that = this;
                    if(this.tableList[index].look==1)return;
                    that.tableList[index].look=1;
                    $.post("<?php echo url('index/setMsg'); ?>", {id: this.tableList[index].id}, function (res) {
                        if(res.data == 0)that.num=0;
                    })
                },
                setPage(val) {
                    this.page = val;
                    console.log(123);
                    this.getData();
                },
                addColor: function (index) {
                    this.curIndex = index;
                },

                /* 失败的弹框 */
                alertError: function (e) {
                    this.$message.error(e);
                },
                /* 成功的弹框 */
                alertSuccess: function (e) {
                    this.$message({
                        message: e,
                        type: "success"
                    });
                },
            },
            created() {
                this.getData();
                this.panduan();
            }
        });

        $(function () {
            $(".tuichu").click(function () {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('login/logout'); ?>",
                    async: true,
                    data: {
                        "aoData": 'aaaa',//测试数据,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.code == 1) {
                            vm.alertSuccess(data.msg);
                            setTimeout(function () {
                                return location.href = data.url;
                            }, 3000)

                        } else {
                            return vm.alertError(data.msg);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status + "," + textStatus);
                    }
                });
            });
        });

    });
</script>


    <!-- 中间内容部分 -->
    <div class="center_box">
        <!-- 下拉列表 -->
        <style>
    [v-cloak]{
        display: none!important;
    }
</style>
<div class="a_path" v-cloak>
    <el-col class="select_box">
        <el-menu default-active="<?php if(!(empty($hnav) || (($hnav instanceof \think\Collection || $hnav instanceof \think\Paginator ) && $hnav->isEmpty()))): ?><?php echo $hnav; ?>-<?php echo $nav; endif; ?>" class="el-menu-vertical-demo" unique-opened>
            <el-submenu default-openeds index="1">
                <template slot="title">
                    <img alt="" src="/static/buy/img/zhanghaoxinxi.png" style="width: 20px;margin-right: 5px;" />
                    <span>账号信息</span>
                </template>
                <el-menu-item-group class="el_menu1">
                    <el-menu-item class="el_item" index="1-1">基本信息</el-menu-item>
                    <el-menu-item  class="el_item" index="1-2">账号提现</el-menu-item>
                    <el-menu-item  class="el_item" index="1-3">买号添加</el-menu-item>
                    <el-menu-item  class="el_item" index="1-4">会员VIP</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="2">
                <template slot="title">
                    <img alt="" src="/static/buy/img/renwuqingkuang.png" style="width: 20px;margin-right: 5px;" />
                    <span>任务情况</span>
                </template>
                <el-menu-item-group class="el_menu2">
                    <el-menu-item  class="el_item" index="2-1">任务领取</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">
                    <img alt="" src="/static/buy/img/zijinguanli.png" style="width: 20px;margin-right: 5px;" />
                    <span>资金管理</span>
                </template>
                <el-menu-item-group class="el_menu3">
                    <el-menu-item  class="el_item" index="3-1">提现</el-menu-item>
                    <el-menu-item  class="el_item" index="3-2">银锭充值</el-menu-item>
                    <el-menu-item  class="el_item" index="3-3">提现记录</el-menu-item>
                    <!--<el-menu-item  class="el_item" index="3-4">佣金记录</el-menu-item>-->
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="4">
                <template slot="title">
                    <img alt="" src="/static/buy/img/haoyouyaoqing.png" style="width: 20px;margin-right: 5px;" />
                    <span>好友邀请</span>
                </template>
                <el-menu-item-group class="el_menu4">
                    <el-menu-item  class="el_item" index="4-1">邀请好友</el-menu-item>
                    <el-menu-item  class="el_item" index="4-2">邀请记录</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
        </el-menu>
    </el-col>
</div>

<script>
    $(function () {
        $(".select_box .el_menu1 .el_item").click(function () {
            var index=$(this).index();
            //console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('my/information',['hnav'=>'1','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('my/withdrawal',['hnav'=>'1','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('my/add_buyno',['hnav'=>'1','nav'=>'3']); ?>"
            }else if(index===3){
                location.href="<?php echo url('my/vip_record',['hnav'=>'1','nav'=>'4']); ?>"
            }

        });
        $(".select_box .el_menu2 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('task/index',['hnav'=>'2','nav'=>'1']); ?>"
            }

        });
        $(".select_box .el_menu3 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('money/withdrawal',['hnav'=>'3','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('money/withsilver',['hnav'=>'3','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('money/drawal_record',['hnav'=>'3','nav'=>'3']); ?>"
            }
            else if(index===3){
                location.href="<?php echo url('money/commission',['hnav'=>'3','nav'=>'4']); ?>"
            }
        });
        $(".select_box .el_menu4 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('recommend/index',['hnav'=>'4','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('recommend/record',['hnav'=>'4','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('money/drawal_record',['hnav'=>'3','nav'=>'3']); ?>"
            }
            else if(index===3){
                location.href="<?php echo url('money/commission',['hnav'=>'3','nav'=>'4']); ?>"
            }
        });
    });
</script>



        <!-- 右边盒子部分 -->
        <!-- 右边盒子部分 -->
        <div class="right_box">
            <!-- 基本信息标题 -->
            <div class="msg_title">
                <p>个人中心&nbsp;/&nbsp;账号信息&nbsp;/&nbsp;<span class="msg_title_txt">基本信息</span></p>
            </div>
            <div class="user_content">
                <img src="/static/buy/img/imgheade.png" alt="" class="user_touxiang"/>
                <p class="user_name"><?php echo $users['username']; ?></p>

                <!-- 用户信息 -->
                <div class="user_info">
                    <!-- 用户信息左 -->
                    <div class="user_left">
                        <div class="user_detail">
                            <div>昵称:</div>
                            <div class="user_gray"><?php echo $users['username']; ?></div>
                            <!--<el-button type="primary" icon="el-icon-edit" circle size="small"-->
                                       <!--@click="openDialogusername"></el-button>-->
                        </div>
                        <div class="user_detail">
                            <div>会员状态:</div>
                            <div class="user_gray">
                                <?php if($users['vip'] ==1): ?>VIP会员
                                <?php else: ?> 不是会员
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="user_detail">
                            <div>VIP时限:</div>
                            <div class="user_gray"><?php echo date("Y-m-d",$users['vip_time']); ?></div>
                        </div>
                        <div class="user_detail">
                            <div>QQ账号:</div>
                            <div class="user_gray"><?php echo $users['qq']; ?></div>
                        </div>
                    </div>
                    <!-- 用户信息右 -->
                    <div class="user_right">
                        <div class="user_detail">
                            <div>手机号码:</div>
                            <div class="user_gray"><?php echo $users['mobile']; ?></div>
                            <el-button type="primary" icon="el-icon-edit" circle size="small"
                                       @click="openDialogPhoneNum"></el-button>
                        </div>
                        <div class="user_detail">
                            <div>VIP延时:</div>
                            <div><a href="<?php echo url('my/vip_recharge'); ?>" class="user_blue">点击延时VIP</a></div>
                        </div>
                        <div class="user_detail">
                            <div>登录密码:</div>
                            <div class="user_blue">**********</div>
                            <div class="user_btn">
                                <el-button type="primary" icon="el-icon-edit" circle size="small"
                                           @click="openDialogPassWord"></el-button>
                            </div>
                        </div>
                        <div class="user_detail">
                            <div>支付密码:</div>
                            <div class="user_blue">**********</div>
                            <div class="user_btn">
                                <el-button type="primary" icon="el-icon-edit" circle size="small"
                                           @click="openDialogZhiFuPassWord"></el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 修改用户名 -->
                <el-dialog title="修改用户名" :visible.sync="dialogusername">
                    <div class="form_box">
                        <el-form ref="form" :model="usernameObj" class="el_form">
                            <div class="el_form_item">
                                <p>新用户名:</p>
                                <el-input v-model="usernameObj.username" placeholder="请输入新昵称" maxlength="11" class="el_form_width"
                                          clearable>
                                    <i
                                            slot="prefix"
                                            class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                            src="/static/buy/img/user.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                        </el-form>
                        <!-- 修改密码按钮 -->
                        <div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
                            <el-button @click="dialogusername = false" size="small">取 消</el-button>
                            <el-button @click="usernameBtnActive" type="primary" size="small">确 定</el-button>
                        </div>
                    </div>
                </el-dialog>
                <!-- 修改手机号码弹框 -->
                <el-dialog title="修改手机号码" :visible.sync="dialogPhoneNum">
                    <div class="form_box">
                        <el-form ref="form" :model="phoneNumObj" class="el_form">
                            <div class="el_form_item">
                                <p>原手机号码:</p>
                                <el-input v-model="phoneNumObj.oldPhoneNum" placeholder="请输入原手机号码" maxlength="11" class="el_form_width"
                                          clearable>
                                    <i
                                            slot="prefix"
                                            class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                            src="/static/buy/img/phone.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>支付密码:</p>
                                <el-input type="password"  v-model="phoneNumObj.zhifuPassWord" placeholder="请输入6位支付密码"
                                          class="el_form_width" maxlength="6"></el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>新手机号码:</p>
                                <el-input v-model="phoneNumObj.newPhoneNum" placeholder="请输入新手机号码" maxlength="13" class="el_form_width"
                                          clearable>
                                    <i
                                            slot="prefix"
                                            class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                            src="/static/buy/img/phone.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>验证码:</p>
                                <el-input v-model="phoneNumObj.newYzmNum" placeholder="请输入验证码" maxlength="6" class="el_form_width"
                                          style="width: 160px;margin-right: 40px;" clearable><i
                                        slot="prefix"
                                        class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                        src="/static/buy/img/123.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <el-button type="primary" style="width: 100px;padding: 0;height: 40px;line-height: 40px;"
                                           @click="sendYzm" :disabled="yzmDisabled" v-html="yzmMsg"></el-button>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                        </el-form>
                        <!-- 修改密码按钮 -->
                        <div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
                            <el-button @click="dialogPhoneNum = false" size="small">取 消</el-button>
                            <el-button @click="phoneBtnActive" type="primary" size="small">确 定</el-button>
                        </div>
                    </div>
                </el-dialog>

                <!-- 修改密码弹框 -->
                <el-dialog title="修改登录密码" :visible.sync="dialogPassWord">
                    <div class="form_box">
                        <el-form ref="form" :model="passWordObj" class="el_form">
                            <div class="el_form_item">
                                <p>原登录密码:</p>
                                <el-input type="password"  v-model="passWordObj.oldPassWord" placeholder="请输入原登录密码"
                                          class="el_form_width" maxlength="16"></el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>新登录密码:</p>
                                <el-input type="password" show-password v-model="passWordObj.newPassWord" placeholder="请输入新登录密码"
                                          class="el_form_width" maxlength="16"></el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>确认新密码:</p>
                                <el-input type="password" show-password v-model="passWordObj.queRenPassWord" placeholder="请确认新登录密码"
                                          class="el_form_width" maxlength="16"></el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>手机号码:</p>
                                <el-input v-model="passWordObj.phoneNum" placeholder="请输入手机号码" maxlength="11" class="el_form_width"
                                          clearable>
                                    <i
                                            slot="prefix"
                                            class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                            src="/static/buy/img/phone.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>验证码:</p>
                                <el-input v-model="passWordObj.newYzmNum" placeholder="请输入验证码" maxlength="6" class="el_form_width"
                                          style="width: 160px;margin-right: 40px;" clearable><i
                                        slot="prefix"
                                        class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                        src="/static/buy/img/123.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <el-button type="primary" style="width: 100px;padding: 0;height: 40px;line-height: 40px;"
                                           @click="sendYzm2" :disabled="yzmDisabled2" v-html="yzmMsg2"></el-button>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                        </el-form>
                        <!-- 修改密码按钮 -->
                        <div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
                            <el-button @click="dialogPassWord = false" size="small">取 消</el-button>
                            <el-button @click="editBtnActive" type="primary" size="small">确 定</el-button>
                        </div>
                    </div>
                </el-dialog>

                <!-- 支付密码弹框 -->
                <el-dialog title="修改支付密码" :visible.sync="dialogZhiFuPassWord">
                    <div class="form_box">
                        <el-form ref="form" :model="zhifuPassWordObj" class="el_form">
                            <!--<?php if($users['pay_pwd']): ?>-->
                            <!--<div class="el_form_item">-->
                                <!--<p>原支付密码:</p>-->
                                <!--<el-input type="password"  v-model="zhifuPassWordObj.oldZhiFuPassWord"-->
                                          <!--placeholder="请输入原支付密码"-->
                                          <!--class="el_form_width" maxlength="6"></el-input>-->
                                <!--<span style="margin-left: 10px;color: red;">*</span>-->
                            <!--</div>-->
                            <!--<?php else: ?>-->
                            <!--<?php endif; ?>-->
                            <div class="el_form_item">
                                <p>新支付密码:</p>
                                <el-input type="password" show-password v-model="zhifuPassWordObj.newZhiFuPassWord"
                                          placeholder="请输入6位支付密码"
                                          class="el_form_width" maxlength="6"></el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>确认新密码:</p>
                                <el-input type="password" show-password v-model="zhifuPassWordObj.queRenZhiFuPassWord"
                                          placeholder="请确认新支付密码"
                                          class="el_form_width" maxlength="6"></el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>手机号码:</p>
                                <el-input v-model="zhifuPassWordObj.phoneNum" placeholder="请输入手机号" maxlength="11" class="el_form_width"
                                          clearable>
                                    <i
                                            slot="prefix"
                                            class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                            src="/static/buy/img/phone.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                            <div class="el_form_item">
                                <p>验证码:</p>
                                <el-input v-model="zhifuPassWordObj.yzmNum" placeholder="请输入验证码" maxlength="6" class="el_form_width"
                                          style="width: 160px;margin-right: 40px;" clearable><i
                                        slot="prefix"
                                        class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
                                        src="/static/buy/img/123.png" alt="" style="width: 24px;"/></i>
                                </el-input>
                                <el-button type="primary" style="width: 100px;padding: 0;height: 40px;line-height: 40px;"
                                           @click="sendYzm3" :disabled="yzmDisabled3" v-html="yzmMsg3"></el-button>
                                <span style="margin-left: 10px;color: red;">*</span>
                            </div>
                        </el-form>
                        <!-- 支付密码按钮 -->
                        <div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
                            <el-button @click="dialogZhiFuPassWord = false" size="small">取 消</el-button>
                            <el-button type="primary" @click="zhiFuBtnActive" size="small">确 定</el-button>
                        </div>
                    </div>
                </el-dialog>

            </div>
        </div>

    </div>

    <!-- 底部 -->
    <!-- 底部 -->
<link rel="stylesheet" type="text/css" href="/static/buy/css/footer.css" />
<div class="commonFooter">
    <div class="contents">
        <!--©版权所有: <a href="#">安徽云梭网络科技有限公司</a>-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        技术支持: <a style="margin-right: 70px;" href="#">小白兔 </a>

    </div>
</div>

</div>

</body>
</html>
