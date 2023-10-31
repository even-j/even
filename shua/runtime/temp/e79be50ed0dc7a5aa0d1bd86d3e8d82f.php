<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:64:"/www/wwwroot/xbt.com/pubic/../application/buy/view/my/index.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/header.html";i:1698557938;s:58:"/www/wwwroot/xbt.com/application/buy/view/public/left.html";i:1574049114;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>小白兔</title>
    <link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
    <!-- 页面内容CSS -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/myCenter.css"/>
    <link rel="Shortcut Icon" type="image/x-icon" href="/static/buy/img/index.png" />
    <style>
        .el-message-box__message p{
            word-break: break-all !important;
        }
    </style>
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
                        /* 表格数据 */
                        tableData: [{
                            shangJia: "13245672345",
                            count: 1,
                            dianFuPrice: "23.00",
                            yongJin: "3.80",
                            taskCount: 1,
                            taskProgress: 100
                        }, {
                            shangJia: "13245672345",
                            count: 1,
                            dianFuPrice: "23.00",
                            yongJin: "3.80",
                            taskCount: 1,
                            taskProgress: 100
                        }, {
                            shangJia: "13245672345",
                            count: 1,
                            dianFuPrice: "23.00",
                            yongJin: "3.80",
                            taskCount: 1,
                            taskProgress: 0
                        }, {
                            shangJia: "13245672345",
                            count: 1,
                            dianFuPrice: "23.00",
                            yongJin: "3.80",
                            taskCount: 1,
                            taskProgress: 0
                        }],
                        /* 下拉选项卡数据 */
                        options1: [
                            {
                            value1: "1",
                            label1: "已打印快递单，待发货"
                        }, {
                            value1: "2",
                            label1: "已发货，待确认收货"
                        },
                            {
                                value1: "3",
                                label1: "已确认收货，待商家返款"
                            },
                            {
                                value1: "4",
                                label1: "商家已返款，待确认返款"
                            },
                            {
                                value1: "5",
                                label1: "已完成"
                            },
                            {
                                value1: "6",
                                label1: "已超时"
                            },
                            {
                                value1: "7",
                                label1: "已取消"
                            },
                            {
                                value1: "8",
                                label1: "自动放弃"
                            },
                        ],
                        options2: [
                            <?php if(is_array($buyno) || $buyno instanceof \think\Collection || $buyno instanceof \think\Paginator): $i = 0; $__LIST__ = $buyno;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            {
                            value2: "<?php echo $vo['id']; ?>",
                            label2: "<?php echo $vo['wwid']; ?>"
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
                        }],
                        options4: [{
                            value4: "3",
                            label4: "全部"
                        }, {
                            value4: "2",
                            label4: "手机"
                        }, {
                            value4: "1",
                            label4: "电脑"
                        }],
                        options5: [
                            {
                                value5: "1",
                                label5: "待处理追评任务"
                            },
                            {
                                value5: "2",
                                label5: "待返款追评任务"
                            },
                            {
                                value5: "3",
                                label5: "已完成追评任务"
                            },
                            {
                                value5: "4",
                                label5: "已拒接追评任务"
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
                        /* 淘宝数据 */
                        taoBaoList:[],
                        /* 默认不全选 */
                        checkedAll: false,
                        curIndex: 0,
                        /* 选择的数据 */
                        // multipleSelection: [],
                        // 搜索框
                        indexorder:"",
                        arrchecedk:[],
                        all_seller_principal:"",
                        // 按钮文字
                        buttonvalue:`<?php if($value ==2): ?>去收货<?php elseif($value ==4): ?>确认返款<?php else: ?>查看详情<?php endif; ?>`,
                        buttonvalue2:"去追评",
                        // 链接值
                        urlvalue:"",
                        urlvalue2:""
                    }
                },
                methods: {

                    // 点击搜索
                    searchOrder:function(val){
                        this.currentPage = 1;
                        var that = this;
                        $.post("<?php echo url('my/index'); ?>", {
                            page: that.currentPage,
                            datetime: that.dateValue,
                            size: that.size,
                            indexorder:that.indexorder,
                        }, function (res) {
                            console.log(res);
                            if (res.code == 1) {
                                that.taoBaoList = res.data.list;
                                 console.log(that.list)
                                that.total = res.data.total;
                                for (var i = 0; i < that.taoBaoList.length; i++) {
                                    that.taoBaoList[i].progress = that.taoBaoList[i].progress + "%"
                                }
                            } else {
                                vm.alertError(res.msg);
                            }
                        })
                    },
                    /*查看详情，去收货*/
                    chooseTiao:function(id){
                        var val = this.urlvalue;
                        <?php if(!(empty($value) || (($value instanceof \think\Collection || $value instanceof \think\Paginator ) && $value->isEmpty()))): ?>
                        var value=<?php echo $value; ?>;
                        <?php endif; if(empty($value) || (($value instanceof \think\Collection || $value instanceof \think\Paginator ) && $value->isEmpty())): ?>
                            var value=1;
                            <?php endif; ?>
                        if(val == 4 || value ==4){
                            location.href='/index.php/buy/my/shoukuan/id/'+id+'';
                        }else if(val == 2 || value ==2){
                            location.href='/index.php/buy/my/shouhuo/id/'+id+'';
                        }else {
                            location.href='/index.php/buy/my/detail/id/'+id+'';
                        }
                    },
                    // 默认按钮
                    defaultBtn:function(value){
                        if(value == 4){
                            return "确认返款";
                        } else if(value == 2){
                            return "去收货";
                        }else {
                            return "查看详情";
                        }
                    },
                    // 默认按钮跳转链接
                    defaultBtnClick:function(val,id){
                        if(!val || val==="4"){
                            location.href='/index.php/buy/my/shoukuan/id/'+id+'';
                        }else if(val==="2"){
                            location.href='/index.php/buy/my/shouhuo/id/'+id+'';
                        }else{
                            location.href='/index.php/buy/my/detail/id/'+id+'';
                        }
                    },
                    // 去追评链接
                    chooseTiao2:function(review_task_id){
                        var that=this;
                        var val = that.urlvalue2;
                        if(val == 1){
                            this.$confirm("您确定要拒接任务吗？","温馨提示",{
                                confirmButtonText: '确定',
                                cancelButtonText: '取消',
                                type: 'warning'
                            }).then(function(){
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo url('buy/my/refuse_zhuipin'); ?>",
                                    async: true,
                                    data: {
                                        'id': review_task_id,
                                    },
                                    success: function (data) {
                                        if (data.code == 1) {
                                            that.alertSuccess(data.msg);
                                            setTimeout(function () {
                                                return location.href = data.url;
                                            }, 3000);
                                        } else {
                                            return that.alertError(data.msg);
                                        }
                                    },
                                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                                        alert(XMLHttpRequest.status + "," + textStatus);
                                    }
                                });
                            }).catch(function(){
                                that.$message({
                                    type: 'info',
                                    message: '您取消了操作'
                                });
                            })
                        }else {
                            location.href='/index.php/buy/my/zhuidetail/id/'+review_task_id+'';
                        }
                    },
                    // 去追评zhuipin
                    goZhuiPin(review_task_id){
                        location.href='/index.php/buy/my/zhuipin/id/'+review_task_id+'';
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
                    getData: function () {
                        var that = this;
                        $.post("<?php echo url('my/index'); ?>", {
                            page: that.currentPage,
                            datetime: that.dateValue,
                            size: that.size,
                            choose_a:that.value1,
                            buyno:that.value2,
                            task_type:that.value3,
                            terminal:that.value4,
                            zhuipin:that.value5,
                        }, function (res) {
                            console.log(res);
                            if (res.code == 1) {
                                that.taoBaoList = res.data.list;
                               // console.log(that.list)
                                that.total = res.data.total;
                                for (var i = 0; i < that.taoBaoList.length; i++) {
                                    that.taoBaoList[i].progress = that.taoBaoList[i].progress + "%"
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
                    //获取待处理事项
                    getChooseValue:function(value){
                        // console.log(value);
                        this.value5="";
                        this.urlvalue=value;
                        this.currentPage = 1;
                        this.getData();
                        if(value == 4){
                            this.buttonvalue = "确认返款";
                        } else if(value == 2){
                            this.buttonvalue = "去收货";
                        }else{
                            this.buttonvalue = "查看详情";
                        }
                    },
                    // 获取追评任务
                    getZhuiPingValue(value){
                        // console.log(value);
                        this.value1="";
                        this.urlvalue2=value;
                        this.currentPage = 1;
                        this.getData();
                        if(value == 1){
                            this.buttonvalue = "拒接任务";
                        } else{
                            this.buttonvalue = "查看详情";
                        }
                    },
                    //获取买号
                    getBuynoValue:function(val){
                        // console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    // 获取日期的值
                    getDateValue: function (val) {
                        // console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    // 获取任务类型的值
                    getTaskValue: function (val) {
                        // console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    // 获取任务终端的值
                    getTaskTerminal: function (val) {
                        // console.log(val);
                        this.currentPage = 1;
                        this.getData();
                    },
                    /* 待处理事件 */
                    handleClick: function (tab, event) {
                        // console.log(tab, event);
                    },
                    /* 分页事件 */
                    handleSizeChange: function (val) {
                        // console.log("每页" + val + "条");
                        this.size = val;
                        this.currentPage = 1;
                        this.getData();
                    },
                    handleCurrentChange: function (val) {
                        // console.log("当前页" + val);
                        this.currentPage = val;
                        this.getData();
                    },
                    /* 全选 */
                    handleSelectAll: function (val) {
                        for (var i = 0; i < this.taoBaoList.length; i++) {
                            this.arrchecedk.splice(i,1,this.taoBaoList[i].id);
                            this.taoBaoList[i].checked = val;
                        }
                    },
                    /* 单选 */
                    handleSelectItem: function () {
                        var res = this.taoBaoList.filter(function(item){
                            return item.checked === true
                        });
                        this.checkedAll = res.length === this.taoBaoList.length;
                        for(var i = 0;i<res.length;i++){
                            this.arrchecedk[i]=res[i].id;
                        }
                    },
                    // 确认返款
                    allfankuan:function () {
                        var that = this;
                        $.post("<?php echo url('task/all_seller_principal'); ?>", {
                            taskid: that.arrchecedk,
                        }, function (res) {
                            if (res.code == 1) {
                                that.all_seller_principal = res.data.all_seller_principal;
                                that.principal = res.data.principal;
                                that.$confirm('商家确认返款金额为:' + that.principal, '温馨提示', {
                                    confirmButtonText: '确定',
                                    cancelButtonText: '取消',
                                    type: 'warning'
                                }).then(function() {
                                    var id=that.arrchecedk;
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo url('buy/task/allfankuan'); ?>",
                                        async: true,
                                        data: {
                                            'taskid': that.arrchecedk,
                                        },
                                        success: function (data) {
                                            if (data.code == 1) {
                                                that.alertSuccess(data.msg);
                                                setTimeout(function () {
                                                    return location.href = data.url;
                                                }, 3000);
                                            } else {
                                                return that.alertError(data.msg);
                                            }
                                        },
                                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                                            alert(XMLHttpRequest.status + "," + textStatus);
                                        }
                                    });
                                }).catch(function() {
                                    that.$message({
                                        type: 'info',
                                        message: '您取消了操作'
                                    });
                                });
                            } else {
                                vm.alertError(res.msg);
                            }
                        })
                    },
                    /* 切换新闻列表 */
                    changeNews: function (index) {
                        this.curIndex = index;
                    },
                },
                created: function () {
                    <?php if(!(empty($value) || (($value instanceof \think\Collection || $value instanceof \think\Paginator ) && $value->isEmpty()))): ?>
                    var val=<?php echo $value; ?>;
                        console.log(val,123123123);
                    this.value1=val+"";
                    this.getChooseValue(<?php echo $value; ?>);
                    <?php endif; ?>
                    this.getData();
                }
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
            <!-- 用户信息盒子 -->
            <div class="right_box_item">
                <!-- 用户信息 -->
                <div class="user_info">
                    <img class="user_touxiang" src="/static/buy/img/imgheade.png" alt=""/>
                    <div class="user_name">
                        <span class="user_name_left1"><?php echo $users['username']; ?> <span class="user_name_right1">/用户名</span></span>
                        <span class="user_name_left2">绑定手机号: <span class="user_name_right2"><?php echo $users['mobile']; ?></span></span>
                        <span class="user_name_left2">经验值: <span class="user_name_right2"><span style="color:red;"><?php echo $all_num_task; ?></span></span></span>
                        <span class="user_name_left2">累计赚取银锭: <span class="user_name_right2"><span style="color:red;"><?php echo $all_obtain_reward; ?></span>银锭</span></span>
                    </div>
                    <div class="vip_name">
                        <span class="vip_name_left1">会员状态<span class="vip_name_right1">/
                            <?php if($users['vip'] ==1): ?>VIP会员
                                    <?php else: ?> 不是会员
                                    <?php endif; ?>
                        </span></span>
                        <span class="vip_name_left2">到期时间: <span class="vip_name_right2"><?php echo date("Y-m-d",$users['vip_time']); ?></span>
                  <a href="<?php echo url('my/vip_recharge'); ?>" class="vip_name_a">点击延时VIP</a>
                </span>
                        <span class="vip_name_left2">本月可做: <span class="vip_name_right2"><span style="color:red;"><?php echo $residue_task; ?></span>单任务</span></span>
                            <p></p>
                              <span class="vip_name_left2">待商家发放银锭: <span class="vip_name_right2"><span style="color:red;"><?php echo $wait_shop_issue; ?></span>银锭</span>
                </span>
                    </div>
                </div>
            </div>

            <!-- 充值入口 -->
            <div class="chongzhi">
                <div class="chongzhi_top">
                    <a href="javascript:;" class="select_on">充值入口</a>
                </div>
                <div class="chongzhi_row">
                    <!-- 我的本金 -->
                    <div class="mybenjin">
                        <p class="mybenjin_title">我的本金</p>
                        <div class="mybenjin_row">
                            <img src="/static/buy/img/yuanbao1.png" alt=""/>
                            <span class="mybenjin_price"><?php echo $users['balance']; ?>元</span>
                            <span class="mybenjin_txt">(可提现本金)</span>
                        </div>
                        <div class="mybenjin_row">
                            <img src="/static/buy/img/yuanbao1.png" alt=""/>
                            <span class="mybenjin_price"><?php echo $all_user_principal; ?>元</span>
                            <span class="mybenjin_txt">(总计垫付本金)</span>
                        </div>
                        <a style="text-decoration: none;color: #fff;" href="<?php echo url('money/withdrawal'); ?>">
                        <el-button size="small" type="primary" class="mybenjin_btn">
                           提现
                        </el-button></a>
                    </div>
                    <!-- 我的银锭 -->
                    <div class="myyingding">
                        <p class="myyingding_title">我的银锭</p>
                        <div class="myyingding_row">
                            <img src="/static/buy/img/yuanbao3.png" alt=""/>
                            <span class="myyingding_price"><?php echo $myself['reward']; ?>银锭 = <?php echo $discounting; ?>元</span>
                            <span class="myyingding_txt">(总银锭)</span>
                        </div>
                        <div class="myyingding_row">
                            <img src="/static/buy/img/yuanbao3.png" alt=""/>
                            <span class="myyingding_price myyinding_dongjie"><?php echo $freeze_reward; ?>银锭</span>
                            <span class="myyingding_txt">(冻结银锭)</span>
                        </div>
                        <div class="myyingding_row">
                            <img src="/static/buy/img/yuanbao3.png" alt=""/>
                            <span class="myyingding_price myyinding_dongjie"><?php echo $ejang; ?>银锭</span>
                            <span class="myyingding_txt">(额外奖励)</span>
                        </div>
                        <div class="myyingding_btn">
                            <a href="<?php echo url('money/withsilver'); ?>">
                                <el-button style="margin-right:10px;" size="small">充值</el-button>
                            </a>
                            <a href="<?php echo url('money/withdrawal',['ydtx'=>1]); ?>">
                            <el-button size="small">提现</el-button>
                            </a>
                        </div>
                    </div>
                    <!-- 邀请好友 -->
                    <div class="myyaoqing">
                        <p class="myyaoqing_title">我的邀请</p>
                        <div class="myyaoqing_row">
                            <img src="/static/buy/img/jinpai.png" alt=""/>
                            <span class="myyaoqing_price">总计获得奖励: <?php echo $myself['tj_award']; ?>银锭</span>
                        </div>
                        <div class="myyaoqing_row">
                            <img src="/static/buy/img/user_lan.png" alt=""/>
                            <span class="myyaoqing_price">总计邀请人数: <?php echo $all_invite; ?>人</span>
                        </div>
                        <div class="myyaoqing_row">
                            <span class="myyaoqing_price myyaoqing_margin">今日获得奖励: <?php echo $myself['tj_award_day']; ?>银锭</span>
                        </div>
                        <div class="myyaoqing_row">
                            <span class="myyaoqing_price myyaoqing_margin">今日邀请人数: <?php echo $day_invite; ?>人</span>
                        </div>
                        <a href="<?php echo url('recommend/index'); ?>">
                            <el-button size="small" type="primary" class="myyaoqing_btn">邀请</el-button>
                        </a>
                    </div>
                </div>
                <!-- 历史记录 -->
                <div class="lishijilu">
                    <span>历史记录:</span>
                    <a href="<?php echo url('money/withdrawal',['editpass'=>1]); ?>">本金记录</a>
                    <a href="<?php echo url('money/withsilver',['editpass'=>1]); ?>">银锭记录</a>
                    <a href="<?php echo url('money/drawal_record'); ?>">提现记录</a>
                    <a href="<?php echo url('my/vip_record'); ?>">会员记录</a>
                </div>
            </div>


            <!-- 任务管理 -->
            <div class="renwuguanli_box">
                <!-- 任务管理标题 -->
                <div class="renwuguanli">
                    <div class="renwuguanli_item">
                        <a href="javascript:" class="renwuguanli_item_select">任务管理</a>
                    </div>
                </div>
                <div style="width: 300px;margin-top: 20px;float: left;">
                    <el-input placeholder="请输入任务编号" v-model="indexorder">
                        <el-button @click="searchOrder(indexorder)" slot="append" icon="el-icon-search"></el-button>
                    </el-input>
                </div>
                <div style="width: 300px;margin-top: 20px;float: left;margin-left: 20px;">
                    <button v-if="value1==4" type="button" @click="allfankuan" class="el-button el-button el-button--warning el-button--small">
                        <!----><!----><span><i class="el-icon-d-arrow-right"></i>
                                确认返款
                            </span>
                    </button>
                </div>
                <div style="clear:both;"></div>
                <!-- 选项卡第一行 -->
                <div class="select_row_one">
                    <p>待处理事项:</p>
                    <el-select class="el_select" @change="getChooseValue" v-model="value1" clearable placeholder="请选择" size="small">
                        <el-option v-for="item in options1" :key="item.value1" :label="item.label1" :value="item.value1">
                        </el-option>
                    </el-select>

                    <p>买号:</p>
                    <el-select class="el_select" @change="getBuynoValue" v-model="value2" clearable placeholder="请选择" size="small">
                        <el-option v-for="item in options2" :key="item.value2" :label="item.label2" :value="item.value2">
                        </el-option>
                    </el-select>
                    <p>任务类型:</p>
                    <el-select class="el_select" @change="getTaskValue" v-model="value3" clearable placeholder="请选择"
                               size="small">
                        <el-option v-for="(item,index) in options3" :key="index" :label="item.label3"
                                   :value="item.value3">
                        </el-option>
                    </el-select>

                </div>
                <!-- 选项卡第二行 -->
                <div class="select_row_two">
                    <p>终端:</p>
                    <el-select class="el_select" v-model="value4" @change="getTaskTerminal" clearable placeholder="请选择" size="small">
                        <el-option v-for="item in options4" :key="item.value4" :label="item.label4" :value="item.value4">
                        </el-option>
                    </el-select>
                    <p>追评任务:</p>
                    <el-select class="el_select" @change="getZhuiPingValue" v-model="value5" clearable placeholder="请选择" size="small">
                        <el-option v-for="item in options5" :key="item.value5" :label="item.label5" :value="item.value5">
                        </el-option>
                    </el-select>
                    <p>任务起止时间:</p>
                    <el-date-picker class="el_date" @change="getDateValue" v-model="dateValue" type="daterange"
                                    range-separator="至"
                                    start-placeholder="开始日期" end-placeholder="结束日期" size="small"
                                    value-format="yyyy-MM-dd">
                    </el-date-picker>
                </div>
                <!-- 全选 -->
                <div class="select_all">
                    <el-checkbox v-model="checkedAll" @change="handleSelectAll">全选</el-checkbox>
                    <!--                    <el-button class="el_daochu" type="primary" size="mini"><i class="el-icon-download"></i>导出</el-button>-->
                </div>
                <!-- 暂无数据 -->
                <div class="swell">
                    <div class="sample" v-for="(item,index) in taoBaoList" :key="index">
                        <div class="sample-top">
                            <div class="sample-top-left">
                                <el-checkbox v-model="item.checked" @change="handleSelectItem"></el-checkbox>
                                <img :src="item.shop_img" alt="" /> {{item.type}}店铺：{{item.shop_name.substr(0,3)+"..."}}
                            </div>
                            <div class="sample-top-right">
                                <p style="display: flex;align-items: center;">
                                    任务编号：<b>{{item.task_number}}</b>
                                    <img src="/static/buy/img/shou.png" alt="" style="width: 16px;margin-left: 16px;">
                                </p>
                                <p>接单时间：<b>{{item.create_time}}</b></p>
                                <p>任务类型：<strong>{{item.task_type}}</strong></p>
                            </div>
                        </div>
                        <div class="sample-center">
                            <img :src="item.main_product_pc_img" alt="" />
                            {{item.main_product_name.substr(0,3)+"..."}}
                            <!-- 默认的按钮 -->
                            <el-button v-if="!value5 && !value1" @click="defaultBtnClick(item.index_state,item.id)" type="warning" size="small" class="el-button">
                                <i class="el-icon-d-arrow-right"></i>
                                {{defaultBtn(item.index_state)}}
                            </el-button>
                            <!-- 根据条件渲染的按钮 -->
                            <el-button v-if="value5 || value1" type="warning" size="small" @click="value5?chooseTiao2(item.review_task_id):chooseTiao(item.id)" class="el-button"><i class="el-icon-d-arrow-right"></i>
                                {{buttonvalue}}
                            </el-button>
                            <!-- 去追评按钮 -->
                            <el-button @click="goZhuiPin(item.review_task_id)" style="right: 110px;" v-if="value5==='1'" type="warning" size="small" class="el-button">
                                <i class="el-icon-d-arrow-right"></i>
                                {{buttonvalue2}}
                            </el-button>
                        </div>
                        <div class="sample-bottm">
                            <div>
                                <p>任务状态： <b>{{item.state}}</b></p>
                                <p>买号： <b>{{item.wwid}}</b></p>
                            </div>
                            <div>
                                <p>佣金：<b>{{item.commission}}+{{item.user_divided}}</b>银锭</p>
                                <p>垫付资金：<b>{{item.seller_principal}}</b>元</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 分页 -->
                <div class="fenye">
                    <el-pagination
                            @size-change="handleSizeChange"
                            @current-change="handleCurrentChange"
                            :current-page="currentPage"
                            :page-sizes=sizes
                            :page-size=size
                            layout="total, sizes, prev, pager, next, jumper"
                            :total=total
                            background>
                    </el-pagination>
                </div>
            </div>

        </div>

    </div>

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
