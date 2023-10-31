<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/www/wwwroot/xbt.com/pubic/../application/buy/view/helpcenter/index.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/header.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>小白兔</title>
    <link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
    <link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/helpCenter.css"/>
    <script src="/static/buy/js/vue-2.6.10.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/httpVueLoader.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/element-ui/lib/index.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>

</head>
<style>
    .el-pagination{
       margin-top: 20px;
        padding: 0;
        max-width: 340px;
        overflow: hidden;
    }
</style>
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

    <!-- 中间内容部分 -->
    <div class="center_box">
        <!-- 左边部分 -->
        <div class="left_box">
            <el-tabs style="width: 300px;margin-top: 20px;" v-model="type" @tab-click="handleClick">
                <el-tab-pane label="公告" name="1"></el-tab-pane>
                <el-tab-pane label="常见问题" name="2"></el-tab-pane>
            </el-tabs>
            <div class="left_input">
                <el-input style="width: 300px;" placeholder="请输入内容" v-model="search">
                    <el-button slot="append" icon="el-icon-search" @click="getSearch"></el-button>
                </el-input>
            </div>
            <div v-if="state==1">
                <div class="left_table">
                    <div class="left_table_item" :class="[index>=1?'hide_border':'',curIndex===index?'selectOn':'']"
                         v-for="(item,index) in list" @click="ggClick(item,index)">
                        <p v-html="item.title"></p>
                        <p>
                            <i class="el-icon-time"></i>
                            <span v-html="item.create_time"></span>
                        </p>
                    </div>
                </div>
                <div class="center">
                    <el-pagination background :page-size="6" @current-change="handleCurrentChange1" :current-page="page1" :pager-count="5"
                                   layout="prev, pager, next" :total="total" size="small">
                    </el-pagination>
                </div>
            </div>
            <div v-if="state==2">
                <div class="left_table">
                    <div class="left_table_item" :class="[index>=1?'hide_border':'',curIndex2===index?'selectOn':'']"
                         v-for="(item,index) in list2" @click="wtClick(item,index)">
                        <p v-html="item.title"></p>
                        <p>
                            <i class="el-icon-time"></i>
                            <span v-html="item.create_time"></span>
                        </p>
                    </div>
                </div>
                <div class="center">
                    <el-pagination background :page-size="6" @current-change="handleCurrentChange2" :page-count="10" :current-page="page2" :pager-count="5"
                                   layout="prev, pager, next" :total="total2">
                    </el-pagination>
                </div>
            </div>
        </div>
        <!-- 右边盒子部分 -->
        <div class="right_box">
            <!-- 基本信息标题 -->
            <div class="msg_title">
                <p>帮助中心&nbsp;/&nbsp;<span class="msg_title_txt">文章详情</span></p>
            </div>
            <div class="user_content">
                <div class="right_content">
                    <h1 v-html="title"></h1>
                    <div v-html="content"></div>
                </div>
                <p class="right_p">
                    文章分类：
                    <span v-html="msg"></span>
                    &nbsp;&nbsp;&nbsp;
                <p class="right_p"><span v-html="newDate"></span></p>
                </p>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(function () {

            /* 初始化一个Vue */
            var vm = new Vue({
                el: ".center_box",
                data: function () {
                    return {
                        type: '1',
                        state: 1,
                        inputValue: "",
                        /* 默认显示的栏目 */
                        msg: "",
                        /* 表单数据 */
                        list: [],
                        list2: [],
                        total: 0,
                        total2: 0,
                        page1: 1,
                        page2: 1,
                        search: '',
                        newDate: "",
                        /* 默认显示的内容 */
                        title: "",
                        content: "",
                        curIndex: 0,
                        curIndex2: 0,
                    }
                },
                methods: {
                    handleClick: function () {
                        console.log(this.type);
                        if (this.type == 1) {
                            this.state = 1;
                            this.msg = '公告';
                            this.search = '';
                            this.title = this.list.length > 0 ? this.list[0].title : '';
                            this.content = this.list.length > 0 ? this.list[0].content : '';
                            this.newDate = this.list.length > 0 ? this.list[0].create_time : '';
                        } else {
                            this.state = 2;
                            this.msg = '常见问题';
                            this.search = '';
                            this.title = this.list2.length > 0 ? this.list2[0].title : '';
                            this.content = this.list2.length > 0 ? this.list2[0].content : '';
                            this.newDate = this.list2.length > 0 ? this.list2[0].create_time : '';
                        }
                    },
                    ggClick: function (item, index) {
                        this.title = item.title;
                        this.content = item.content;
                        this.curIndex = index;
                        this.newDate = item.create_time;
                    },
                    wtClick: function (item, index) {
                        this.title = item.title;
                        this.content = item.content;
                        this.curIndex2 = index;
                        this.newDate = item.create_time;
                    },
                    handleCurrentChange1(val) {
                        var that = this;
                        this.page1 = val;
                        $.post("<?php echo url('help/getggData'); ?>", {search: this.search, page: this.page1}, function (res) {
                            if (res.code == 1) {
                                that.list = res.data.list;
                                that.total = res.data.total;
                                that.title = that.list.length > 0 ? that.list[0].title : '';
                                that.content = that.list.length > 0 ? that.list[0].content : '';
                                that.newDate = that.list.length > 0 ? that.list[0].create_time : '';
                            } else {
                                layer.msg('网络错误', {icon: 2});
                            }
                        })
                    },
                    handleCurrentChange2(val) {
                        var that = this;
                        this.page2 = val;
                        $.post("<?php echo url('help/getwtData'); ?>", {search: this.search, page: this.page2}, function (res) {
                            if (res.code == 1) {
                                that.list2 = res.data.list2;
                                that.total2 = res.data.total2;
                                that.title = that.list.length > 0 ? that.list[0].title : '';
                                that.content = that.list.length > 0 ? that.list[0].content : '';
                                that.newDate = that.list.length > 0 ? that.list[0].create_time : '';
                            } else {
                                layer.msg('网络错误', {icon: 2});
                            }
                        })
                    },
                    getSearch:function(){
                        var that = this;
                        if(this.type == 1){
                            this.page1 = 1;
                            $.post("<?php echo url('help/getggData'); ?>", {search: this.search, page: this.page1}, function (res) {
                                if (res.code == 1) {
                                    that.list = res.data.list;
                                    that.total = res.data.total;
                                } else {
                                    layer.msg('网络错误', {icon: 2});
                                }
                            })
                        }else{
                            this.page2 = 1;
                            $.post("<?php echo url('help/getwtData'); ?>", {search: this.search, page: this.page2}, function (res) {
                                if (res.code == 1) {
                                    that.list2 = res.data.list2;
                                    that.total2 = res.data.total2;
                                } else {
                                    layer.msg('网络错误', {icon: 2});
                                }
                            })
                        }
                    },
                    getData: function () {
                        var that = this;
                        $.post("<?php echo url('help/index'); ?>", {}, function (res) {
                            console.log(res);
                            if (res.code == 1) {
                                that.list = res.data.list;
                                that.total = res.data.total;
                                that.list2 = res.data.list2;
                                that.total2 = res.data.total2;
                                that.title = that.list.length > 0 ? that.list[0].title : '';
                                that.content = that.list.length > 0 ? that.list[0].content : '';
                                that.newDate = that.list.length > 0 ? that.list[0].create_time : '';
                            } else {
                                layer.msg('网络错误', {icon: 2});
                            }
                        })
                    },
                },
                /* 页面初始化的时候默认显示第一个内容的详情 */
                created: function () {
                    this.getData();
                    this.msg = '公告';
                }
            });

        });
    </script>
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
