<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"/www/wwwroot/xbt.com/pubic/../application/buy/view/task/index.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/header.html";i:1698557938;s:58:"/www/wwwroot/xbt.com/application/buy/view/public/left.html";i:1574049114;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>小白兔</title>
    <link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
    <!-- 页面内容CSS -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/maskLingQu.css"/>
    <link rel="Shortcut Icon" type="image/x-icon" href="/static/buy/img/index.png"/>
    <script src="/static/buy/js/vue-2.6.10.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/element-ui/lib/index.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function () {

            /* 为element-ui组件提供数据绑定和事件 */
            var vm = new Vue({
                el: ".center_box",
                data: function () {
                    return {
                        /* 待处理数据 */
                        activeName: "first",

                        /* 下拉选项卡数据 */
                        options1: [{
                            value1: 0,
                            label1: "全部"
                        }, {
                            value1: 1,
                            label1: "天猫"
                        }, {
                            value1: 2,
                            label1: "淘宝"
                        }],
                        options2: [
                            <?php if(is_array($buyno) || $buyno instanceof \think\Collection || $buyno instanceof \think\Paginator): $i = 0; $__LIST__ = $buyno;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            {
                            value2: '<?php echo $vo['id']; ?>',
                            label2: '<?php echo $vo['wwid']; ?>',
                                op2number:'<?php echo $vo['count']; ?>',
                            },
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        ],
                        options3: [{
                            value3: 0,
                            label3: "全部"
                        }, {
                            value3: 1,
                            label3: "文字好评"
                        }, {
                            value3: 2,
                            label3: "淘口令"
                        }, {
                            value3: 3,
                            label3: "二维码"
                        }, {
                            value3: 4,
                            label3: "直通车"
                        }, {
                            value3: 5,
                            label3: "通道任务"
                        },{
                            value3: 6,
                            label3: "预付款任务"
                        },],
                        options4: [
                            {
                            value4: 1,
                            label4: "电脑"
                        },
                            {
                            value4: 2,
                            label4: "手机"
                        }],
                        options5: [
                            {
                                value5: 1,
                                label5: "0-200"
                            },
                            {
                                value5: 2,
                                label5: "200-500"
                            },
                            {
                                value5: 3,
                                label5: "500-1000"
                            },
                            {
                                value5: 4,
                                label5: "1000-2000"
                            },
                            {
                                value5: 5,
                                label5: ">2000"
                            },
                        ],
                        value1: "",
                        value2: "",
                        value3: "",
                        value4: "",
                        value5: "",
                        /* 日期的value值 */
                        dateValue: "",
                        /* 默认选中第一页 */
                        currentPage: 1,
                        total: 0,
                        size: 10,
                        sizes: [10, 20, 30, 40, 50],
                        currentPage2: 1,
                        /* 表格数据 */
                        list: [],
                        op2count:"",
                    }
                },
                methods: {
                    selectChange(val) {
                        for(var i=0;i<this.options2.length;i++){
                            if(this.options2[i].value2 == val){
                                this.op2count =this.options2[i].op2number;
                            }
                        }
                        this.currentPage = 1;
                        this.getData();
                    },
                    /* 所有任务 */
                    handleClick: function (tab, event) {
                        // console.log(tab, event);
                    },
                    /* 分页事件 */
                    handleSizeChange: function (val) {
                        $("html,body").animate({ scrollTop: 0 }, 0);
                        this.size = val;
                        this.currentPage = 1;
                        this.getData();
                    },
                    handleCurrentChange: function (val) {
                        $("html,body").animate({ scrollTop: 0 }, 0);
                        this.currentPage = val;
                        this.getData();
                    },
                    /* 失败的弹框 */
                    alertError: function (e) {
                        this.$message({
                            message: e,
                            type: "error"
                        });
                    },
                    /* 成功的弹框 */
                    alertSuccess: function (e) {
                        this.$message({
                            message: e,
                            type: "success"
                        });
                    },
                    addTask: function (index) {
                        var that = this;
                        that.$confirm("是否添加此任务?", "温馨提示", {
                            confirmButtonText: "确定",
                            cancelButtonText: "取消",
                            type: "warning"
                        }).then(function () {
                            //console.log(that.list[index].task_number);
                            var task_number = that.list[index].task_number;
                            var commission = that.list[index].user_reward;
                            var total_price = that.list[index].total_price;
                            var buyno_id = that.value2;
                            var terminal=that.value4;
                            var user_divided=that.list[index].user_divided ;
                            console.log(that.value2);
                            $.ajax({
                                type: "POST",
                                url: "<?php echo url('buy/task/get_task'); ?>",
                                async: true,
                                data: {
                                    'task_number': task_number,
                                    'buyno_id': buyno_id,
                                    'commission': commission,
                                    'total_price': total_price,
                                    'terminal':terminal,
                                    'user_divided':user_divided,
                                },
                                success: function (data) {
                                    if (data.code == 1) {
                                        that.alertSuccess(data.msg);
                                        setTimeout(function () {
                                            return location.href = data.url;
                                        }, 3000);
                                    } else {
                                        that.alertError(data.msg);
                                        // setTimeout(function () {
                                        //     return location.href = "<?php echo url('task/index'); ?>";
                                        // }, 3000);
                                        // return that.alertError(data.msg);
                                    }
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    alert(XMLHttpRequest.status + "," + textStatus);
                                }
                            });
                            // that.alertSuccess("添加成功");
                        }).catch(function (error) {
                        });
                    },
                    /* 给表格上色 */
                    cellStyle: function (e) {
                        // console.log(e);
                        if (e.columnIndex === 4) {
                            var taskProgress = this.list[e.rowIndex].progress;
                            /* 截取后面的百分比符号并转换成NumBer类型 */
                            taskProgress = taskProgress.substring(taskProgress, taskProgress.lastIndexOf("%"));
                            taskProgress = Number(taskProgress);
                            // console.log(taskProgress);

                            /* 根据完成百分比动态改变颜色 */
                            if (taskProgress === 100) {
                                return "color:green";
                            } else {
                                return "color:red";
                            }

                        } else if (e.columnIndex === 2) {
                            return "color:rgb(30, 144, 255);"
                        }
                    },
                    getData: function () {
                        var that = this;
                        $.post("<?php echo url('task/index'); ?>", {
                            page: that.currentPage,
                            datetime: that.dateValue,
                            size: that.size,
                            buyno_id: that.value2,
                            task_type:that.value3,
                            terminal:that.value4,
                            getprice:that.value5
                        }, function (res) {
                            console.log(res);
                            if (res.code == 1) {
                                that.list = res.data.list;
                                console.log(that.list)
                                that.total = res.data.total;
                                for (var i = 0; i < that.list.length; i++) {
                                    that.list[i].progress =parseInt(that.list[i].progress) + "%"
                                }
                            } else {
                                vm.alertError(res.msg);
                            }
                        })
                    },
                    search: function () {
                        this.currentPage = 1;
                        this.getData();
                    },
                    // 获取日期的值
                    getDateValue: function (val) {
                        console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    // 获取任务类型的值
                    getTaskValue: function (val) {
                        // console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    //    获取终端的值
                    getZhongDuanValue: function (val) {
                        // console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    getPriceValue:function(val){
                        this.currentPage = 1;
                        this.getData();
                    }
                },
                created: function () {
                    this.getData();
                }
            });

            /* 初始化jQuery */
            $(function () {

                /* 调用jQuery实现选择导航栏效果 */
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
        <div class="right_box">

            <!-- 任务管理 -->
            <div class="renwuguanli_box">
                <!-- 任务管理标题 -->
                <div class="renwuguanli">
                    <div class="renwuguanli_item">
                        <a href="javascript:" class="renwuguanli_item_select">任务管理</a>
                    </div>
                </div>
                <!-- 所有任务 -->
                <div class="alltask" style="margin-top: 10px;">
                    <el-tabs v-model="activeName" @tab-click="handleClick">
                        <el-tab-pane label="所有任务" name="first"></el-tab-pane>
                    </el-tabs>
                </div>
                <!-- 选项卡第一行 -->
                <div class="select_row_one">
                    <p>买号:</p>
                    <el-select class="el_select" @change="selectChange" v-model="value2" clearable placeholder="请选择" size="small">
                        <el-option v-for="(item,index) in options2" :key="index" :label="item.label2"
                                   :value="item.value2">
                        </el-option>
                    </el-select>
                    <p v-if="op2count" class="task-admin-pp">今日可接{{op2count}}单</p>
                    <p class="task-admin-pp">(当日只可以接同一个商家的1单任务)</p>

                </div>
                <!-- 选项卡第二行 -->
                <div class="select_row_two">
                    <p>任务类型:</p>
                    <el-select class="el_select" @change="getTaskValue" v-model="value3" clearable placeholder="请选择"
                               size="small">
                        <el-option v-for="(item,index) in options3" :key="index" :label="item.label3"
                                   :value="item.value3">
                        </el-option>
                    </el-select>
                    <p>终端:</p>
                    <el-select class="el_select" @change="getZhongDuanValue" v-model="value4" clearable placeholder="请选择" size="small">
                        <el-option v-for="item in options4" :key="item.value4" :label="item.label4"
                                   :value="item.value4">
                        </el-option>
                    </el-select>
                    <p>任务价格:</p>
                    <el-select class="el_select" @change="getPriceValue" v-model="value5" clearable placeholder="请选择" size="small">
                        <el-option v-for="item in options5" :key="item.value5" :label="item.label5"
                                   :value="item.value5">
                        </el-option>
                    </el-select>
                    <!--<p>任务起止时间:</p>-->
                    <!--<el-date-picker class="el_date" @change="getDateValue" v-model="dateValue" type="daterange"-->
                                    <!--range-separator="至"-->
                                    <!--start-placeholder="开始日期" end-placeholder="结束日期" size="small"-->
                                    <!--value-format="yyyy-MM-dd">-->
                    <!--</el-date-picker>-->
                </div>
                <!-- 数据列表 -->
                <div class="shuju_table">
                    <template>
                        <el-table :data="list" border :header-cell-style="{background:'#f5f7fa'}"
                                  :cell-style="cellStyle">
                            <el-table-column prop="rand_num" label="商家任务ID" align="center">
                            </el-table-column>
                            <el-table-column prop="seller_name" label="商家" align="center">
                            </el-table-column>
                            <el-table-column prop="total_price" label="垫付资金" align="center">
                            </el-table-column>
                            <el-table-column label="佣金" align="center">
                                <template slot-scope="scope">
                                    <div>{{list[scope.$index].user_reward}}<span>+{{(list[scope.$index].user_divided/list[scope.$index].num).toFixed(2) }}</span></div>
                                </template>
                            </el-table-column>
                            <el-table-column prop="num" label="任务总数" align="center">
                            </el-table-column>
                            <el-table-column prop="progress" label="任务领取进度" align="center">
                            </el-table-column>
                            <el-table-column label="接收状态" align="center">
                                <template slot-scope="scope">
                                    <el-button @click="addTask(scope.$index)">添加任务单</el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                    </template>
                </div>
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
