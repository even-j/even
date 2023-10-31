<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"/www/wwwroot/xbt.com/pubic/../application/buy/view/money/withsilver.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/header.html";i:1698557938;s:58:"/www/wwwroot/xbt.com/application/buy/view/public/left.html";i:1574049114;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>小白兔</title>
    <link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
    <!-- 页面内容CSS -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/yinDingChongZhi.css"/>
    <link rel="Shortcut Icon" type="image/x-icon" href="/static/buy/img/index.png" />
    <script src="/static/buy/js/vue-2.6.10.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/element-ui/lib/index.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function () {

            /* 初始化一个Vue */
            var vm = new Vue({
               el: ".center_box",
                data: function () {
                    return {
                        /* 起止日期value值 */
                        dateValue: "",
                        /* 搜索框value值 */
                        searchInput: "",
                        /* 表格数据 */
                        list:[],
                        /* 默认选中第一页 */
                        currentPage: 1,
                        total:0,
                        size:10,
                        sizes:[10,20,30,40,50],
                        priceList:[
                            // {price:0.01},
                            {price:10},{price:20},{price:30},{price:50},{price:100},{price:300},
                        ],
                        paylist:[
                            {name:"支付宝",pic:"/static/buy/img/zhifubao.png"},{name:"本金支付",pic:"/static/buy/img/yuanbao2.png"}
                        ],
                        curPrice:10,
                        curIndex:0,
                        curIndex2:0

                    }
                },
                created: function () {
                    this.getData();
                },
                mounted:function(){
                    $(".shuju_table").hide();
                    <?php if(!(empty($editpass) || (($editpass instanceof \think\Collection || $editpass instanceof \think\Paginator ) && $editpass->isEmpty()))): if($editpass ==1): ?>
                    $(".user_content .web_gonggao .gonggao_row .gonggao_top").eq(1).children().addClass("select_on").end().siblings().children().removeClass("select_on");
                    $(".shuju_table").show();
                    $(".yingding_chongzhi").hide();
                    <?php else: endif; endif; ?>
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
                    alertError: function(e) {
                        this.$message.error(e);
                    },
                    /* 成功的弹框 */
                    alertSuccess: function(e) {
                        this.$message({
                            message: e,
                            type: "success"
                        });
                    },
                    agreeZhiFu: function () {
                        var that = this;
                        that.$confirm("您确定要支付吗?", "温馨提示", {
                            confirmButtonText: "确定",
                            cancelButtonText: "取消",
                            type: "warning"
                        }).then(function () {
                            console.log(that.curIndex2);
                            if(that.curIndex2 == 0){
                            $.ajax({
                                type : 'POST',
                                url : "<?php echo url('buy/money/creat_order'); ?>",
                                async : true,
                                data : {
                                     "user_type":2,
                                     "recharge_type":2,
                                     "type":1,
                                     "price":that.curPrice,
                                },
                                success : function(data){
                                    if(data.code==1){
                                        that.alertSuccess(data.msg);
                                        setTimeout(function(){
                                            return location.href=data.url;
                                        },3000)

                                    }else{
                                        return that.alertError(data.msg);
                                    }
                                },
                                error : function(XMLHttpRequest, textStatus, errorThrown) {
                                    alert(XMLHttpRequest.status + "," + textStatus);
                                }
                            });
                            }else{
                                $.ajax({
                                    type : 'POST',
                                    url : "<?php echo url('buy/money/principal'); ?>",
                                    async : true,
                                    data : {
                                        "type":2,//账号充值
                                        "price":that.curPrice,
                                    },
                                    success : function(data){
                                        if(data.code==1){
                                            that.alertSuccess(data.msg);
                                            setTimeout(function(){
                                                return location.href=data.url;
                                            },3000)

                                        }else{
                                            return that.alertError(data.msg);
                                        }
                                    },
                                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert(XMLHttpRequest.status + "," + textStatus);
                                    }
                                });
                            }
                            // that.$message({
                            //     type: "success",
                            //     message: "恭喜您,支付成功"
                            // });
                        }).catch(function () {
                            that.$message({
                                type: "info",
                                message: "您取消了操作"
                            });
                        });
                    },
                    /* 给表格上色 */
                    cellStyle: function (e) {
                        var price = this.list[e.rowIndex].price;
                        price = Number(price);

                        if (e.columnIndex === 0) {
                            if (price >= 1) {
                                return "color: rgb(103, 194, 58);";
                            } else if (price <= 0) {
                                return "color:red;";
                            }
                        }
                    },
                    getData:function(){
                        var that = this;
                        $.post("<?php echo url('money/withsilver'); ?>",{page:this.currentPage,inputcontent:this.searchInput,datetime:this.dateValue,size:this.size},function (res) {
                            console.log(res);
                            if(res.code==1){
                                that.list = res.data.list;
                                that.total = res.data.total;
                            }else{
                                vm.alertError(res.msg);
                            }
                        })
                    },
                    search:function(){
                        this.currentPage = 1;
                        this.getData();
                    },
                    handleSizeChange(val) {
                        this.size = val;
                        this.currentPage = 1;
                        this.getData();
                    },
                    handleCurrentChange(val) {
                        this.currentPage = val;
                        this.getData();
                    },
                    getPrice:function(index){
                        var price=Number(this.priceList[index].price);
                        this.curPrice=price.toFixed(2);
                        this.curIndex=index;
                        console.log(this.curPrice);
                    },
                    paychoose:function(index){
                        this.curIndex2=index;
                    },
                    excelReward:function () {
                        var start = "";
                        var end = "";
                        if(this.dateValue){
                            start = this.dateValue[0];
                            end = this.dateValue[1];
                        }
                        window.open("<?php echo url('Money/excelReward','','',false); ?>/start/"+start+"/end/"+end);
                    },

                },
                // created:function () {
                //     this.curPrice=this.curPrice.toFixed(2);
                //     for (var i =0;i<this.priceList.length;i++){
                //         this.priceList[i].price=(this.priceList[i].price).toFixed(2);
                //     }
                // }
            });

            /* 初始化jQuery */
            $(function () {

                /* 调用jQuery实现选择导航栏效果 */
                $(".title a").click(function () {
                    $(this).addClass("add_color").siblings().removeClass("add_color");
                });

                /* 点击切换支付方式 */
                $(".zhifubao .zhifubao_row .zhifubao_item").click(function () {
                    $(this).addClass("zhifubao_color").siblings().removeClass("zhifubao_color");
                });

                /* 点击切换显示和隐藏 */
                $(".user_content .web_gonggao .gonggao_row .gonggao_top").click(function () {
                    $(this).children().addClass("select_on").end().siblings().children().removeClass("select_on");
                    var index = $(this).index();
                    if (index === 0) {
                        $(".shuju_table").hide().siblings(".yingding_chongzhi").show();
                        $(".msg_title_txt").text("银锭充值");
                    } else {
                        $(".shuju_table").show().siblings(".yingding_chongzhi").hide();
                        $(".msg_title_txt").text("银锭记录");
                    }
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
        <div class="right_box">
            <!-- 基本信息标题 -->
            <div class="msg_title">
                <p>个人中心&nbsp;/&nbsp;账号信息&nbsp;/&nbsp;<span class="msg_title_txt">银锭充值</span></p>
            </div>
            <div class="user_content">

                <!-- 银锭充值 -->
                <div class="web_gonggao">
                    <div class="gonggao_row">
                        <div class="gonggao_top">
                            <a href="javascript:" class="select_on">银锭充值</a>
                        </div>
                        <div class="gonggao_top">
                            <a href="javascript:">银锭记录</a>
                        </div>
                    </div>
                </div>

                <!-- 银锭充值部分 -->
                <div class="yingding_chongzhi">
                    <!-- 账户余额 -->
                    <div class="zhanghu_yue">
                        <p>账户余额:</p>
                        <div class="zhanghu_row">
                            <div class="zhanghu_row_item">
                                <img src="/static/buy/img/yuanbao2.png" alt="">
                                <span><?php echo $users['balance']; ?></span>
                                <span>(剩余本金)</span>
                            </div>
                            <div class="zhanghu_row_item">
                                <img src="/static/buy/img/yuanbao3.png" alt="">
                                <span><?php echo $users['reward']; ?></span>
                                <span>(剩余银锭)</span>
                            </div>
                        </div>
                    </div>
                    <!-- 选择金额 -->
                    <div class="select_jine">
                        <p>选择金额:</p>
                        <div class="select_jine_row">
                            <div class="select_jine_item" :class="index===curIndex?'select_jine_item_bg':''" v-for="(item,index) in  priceList" @click="getPrice(index)">
                                <span>{{item.price}}</span>
                                <span>元</span>
                            </div>
                        </div>
                    </div>
                    <!-- 支付方式 -->
                    <div class="zhifubao">
                        <p class="zhifubao_title">支付方式:</p>
                        <div class="zhifubao_row">
                  <span class="zhifubao_item" v-for="(item,index) in paylist" :class="index===curIndex2?'zhifubao_color':''" :key="index" @click="paychoose(index)">
                    <img class="zhifubao_img" :src="item.pic" alt=""/>
                    <span class="zhifubao_name">{{item.name}}</span>
                  </span>
                        </div>
                    </div>
                    <!-- 支付金额 -->
                    <div class="zhifu_price">
                        <span class="zhifu_price_txt">支付金额:</span>
                        <img class="zhifu_price_img" src="/static/buy/img/vip_money.png" alt=""/>
                        <span class="zhifu_price_count"><span>{{curPrice}}</span>元</span>
                    </div>
                    <div class="zhifu_price">
                        <span class="zhifu_price_txt">你已选择购买  <span class="zhifu_price_count"><span>{{curPrice}}</span>银锭包</span></span>
                    </div>
                    <!-- 支付按钮 -->
                    <div class="zhifu_btn" @click="agreeZhiFu">
                        <el-button class="zhifu_btn_item" type="primary" icon="el-icon-circle-check">确定支付</el-button>
                    </div>
                </div>

                <!-- 银锭记录部分 -->
                <div class="shuju_table">
                    <!-- 搜索区域 -->
                    <div class="benjin_search">
                        <!--<el-input placeholder="请输入提现流水号" v-model="searchInput" clearable style="width: 200px;margin-right: 20px;"-->
                                  <!--clearable>-->
                        <!--</el-input>-->
                        <el-date-picker class="el_date" v-model="dateValue" type="daterange" range-separator="至"
                                        start-placeholder="开始日期" end-placeholder="结束日期" value-format="yyyy-MM-dd">
                        </el-date-picker>
                        <el-button type="primary" icon="el-icon-search" @click="search">搜索</el-button>
                        <el-button type="primary" icon="el-icon-download" @click="excelReward()">导出</el-button>
                    </div>
                    <!-- 数据列表 -->
                    <el-table :data="list" border header-cell-style="background:#f5f7fa;" :cell-style="cellStyle">

                        <el-table-column prop="price" label="收支明细" align="center">
                        </el-table-column>
                        <el-table-column prop="yprice" label="结余" align="center">
                        </el-table-column>
                        <el-table-column prop="create_time" label="日期" align="center">
                        </el-table-column>
                        <el-table-column prop="memo" label="备注" align="center">
                        </el-table-column>
                    </el-table>
                    <!-- 分页 -->
                    <div class="fenye">
                        <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="currentPage" :page-sizes=sizes :page-size=size
                                       layout="total, sizes, prev, pager, next, jumper" :total=total
                                       background>
                        </el-pagination>
                    </div>
                </div>

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
