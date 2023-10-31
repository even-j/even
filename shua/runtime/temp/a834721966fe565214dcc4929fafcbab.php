<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/www/wwwroot/xbt.com/pubic/../application/mobile/view/task/maketask.html";i:1584735180;s:61:"/www/wwwroot/xbt.com/application/mobile/view/public/left.html";i:1577592620;s:63:"/www/wwwroot/xbt.com/application/mobile/view/public/footer.html";i:1578366492;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>任务大厅</title>
    <link rel="stylesheet" href="/static/mobile/css/plugin.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/iconfont/iconfont.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/public.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/page.css" type="text/css">
    <script src="/static/mobile/js/all.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/jquery-1.12.4.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/vue-2.6.10.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/vant.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/muse-ui.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/public.js" type="text/javascript" charset="UTF-8"></script>
    <script>
        $(function () {
            var vm = new Vue({
                el: ".tfkz-container",
                data: function () {
                    return {
                        // 表格数据
                        tableData: [
                            <?php if(is_array($have_task) || $have_task instanceof \think\Collection || $have_task instanceof \think\Paginator): $i = 0; $__LIST__ = $have_task;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            {
                                id:"<?php echo $vo['id']; ?>",
                                zhongDuan: "<?php if($vo['terminal'] ==1): ?>电脑<?php elseif($vo['terminal'] ==2): ?>手机端<?php endif; ?>",
                                taskType: "<?php echo $vo['task_type']; ?>",
                                shangJia: "<?php echo $vo['seller']; ?>",
                                benJin: "<?php echo $vo['principal']; ?>",
                                yongJin: "<?php echo $vo['commission']; ?>",
                                user_divided:"<?php echo $vo['user_divided']; ?>",
                                maiHao: "<?php echo $vo['user_buyno_wangwang']; ?>",
                                taskStep:"<?php echo $vo['task_step']; ?>",
                                is_ys:"<?php echo $vo['is_ys']; ?>",
                            },
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        ],
                        currentPage: 1
                    };
                },
                    filters: {
                        filterPhone(val) {
                            return val.substr(0, 3) + "****" + val.substr(7);
                        }
                    },
                    // 调用混入
                    mixins: [singlePersonMixin],
                        methods: {
                        //去完成任务
                        gostep:function(index){
                            var that = this;
                            var id=that.tableData[index].id;
                            var taskStep=that.tableData[index].taskStep;
                            var ys=that.tableData[index].is_ys;
                            if(ys ==1 && taskStep==4){
                                console.log(1);
                                location.href='/index.php/mobile/task/wk/id/'+id+'';
                            }else{
                                console.log(ys,123);
                                sessionStorage.setItem("active",taskStep);
                                location.href='/index.php/mobile/task/taskstep/id/'+id+'';
                            }
                        },
                        // 分页事件
                        pageChange: function (val) {
                            // 当前页码
                            // console.log(val);
                        },
                        // 点击放弃事件
                        cancelActive: function (index) {
                            var that=this;
                            this.$dialog.confirm({
                                title: "温馨提示",
                                message: "是否放弃此条订单，每人每天前2单任务自行放弃不扣银锭，超出订单冻结的银锭将不会返还"
                            }).then(function () {
                                var id=that.tableData[index].id;
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo url('mobile/task/del_task'); ?>",
                                    async: true,
                                    data: {
                                        'id': id,
                                    },
                                    success: function (data) {
                                        if (data.code == 1) {
                                            alertSuccess(data.msg);
                                            setTimeout(function () {
                                                return location.href = data.url;
                                            }, 3000);
                                        } else {
                                            return alertError(data.msg);
                                        }
                                    },
                                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                                        alert(XMLHttpRequest.status + "," + textStatus);
                                    }
                                });
                            }).catch(function () {});
                        }
                    },
                    mounted: function () {
                        publicFunction();
                    }
                });
        });
    </script>
</head>
<body>
<div class="tfkz-container">

    <!-- 页面头部 -->
    <div class="page-header">
        <div class="arrow-left" onclick="javascript:history.back(-1);">
            <van-icon class="arrow-left-item" name="arrow-left" />
        </div>
        <div class="page-title">
            <span ><a href="<?php echo url('mobile/task/index'); ?>">任务大厅</a></span>
        </div>
        <div class="menu-box" onclick="slideBarClick()">
            <van-icon class="menu-box-item" name="bars" />
        </div>
    </div>

    <!-- 下拉菜单 -->
    <link rel="stylesheet" type="text/css" href="/static/mobile/css/table.css"/>
<!-- 下拉菜单 -->
<div class="silde-bar">
    <div class="slide-bar-item">
        <div class="slide-bar-item-title <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav ==1): ?>add-color<?php endif; endif; ?>">
            <img src="/static/mobile/img/mycenter_active.png" alt="">
            <a href="<?php echo url('my/index',['hnav'=>'0','nav'=>'1']); ?>">个人中心</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/helpcenter.png" alt="">
            <a href="<?php echo url('helpcenter/index'); ?>">帮助中心</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/yindingchongzhi.png" alt="">
            <span>银锭充值</span>
            <van-icon class="slide-arrow" name="arrow-down" />
        </div>
        <div class="slide-bar-item-detail">
            <a href="<?php echo url('money/withsilver'); ?>">银锭充值</a>
            <a href="<?php echo url('money/withsilver',['show'=>'2']); ?>">银锭记录</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/benjintixian.png" alt="">
            <span>提现</span>
            <van-icon class="slide-arrow" name="arrow-down" />
        </div>
        <div class="slide-bar-item-detail">
            <a href="<?php echo url('money/withdrawal'); ?>">提现</a>
            <a href="<?php echo url('money/withdrawal',['show'=>'2']); ?>">本金记录</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/renwudating.png" alt="">
            <a href="<?php echo url('task/index'); ?>">任务大厅</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/renwuguanli.png" alt="">
            <a href="<?php echo url('my/taskmanagement'); ?>">任务管理</a>
        </div>
    </div>
<div class="slide-bar-item">
    <div class="slide-bar-item-title">
        <img src="/static/mobile/img/loginout.png" alt="">
        <a class="tuichu" href="javascript:void (0)" >退出登录</a>
    </div>
</div>
</div>
<script>
    $(function () {
        var timer = setInterval(function(){
            $.post("<?php echo url('login/getSession'); ?>",{},function(res){
                console.log(12);
                if(res.code==1){
                    location.href="<?php echo url('login/index'); ?>";
                }else{

                }
            })
        },10000);
        $(".tuichu").click(function () {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('mobile/login/logout'); ?>",
                async: true,
                data: {
                    "aoData": 'aaaa',//测试数据,
                },
                success: function (data) {
                    console.log(data);
                    if (data.code == 1) {
                        alertSuccess(data.msg);
                        setTimeout(function () {
                            return location.href = data.url;
                        }, 3000)

                    } else {
                        return alertError(data.msg);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status + "," + textStatus);
                }
            });
        });
    });
</script>


    <!-- 滚动容器 -->
    <div class="scroll-wrapper" style="padding-bottom: 1.6rem">

        <!-- 公用tab标签 -->
        <div class="public-tab-title">
            <span class="active">做任务</span>
        </div>

        <!-- 做任务 -->
        <div class="make-task">

            <!-- 卡片 -->
            <div class="TaskManagement">
                <div class="Task-management" v-for="(item,index) in tableData" :key="index">
                    <div class="TaskTop">
                        <div class="managementHeng">
                            <p>终端：</p>
                            <p>{{item.zhongDuan}}</p>
                        </div>
                        <div class="managementHeng">
                            <p>任务类型：</p>
                            <p>{{item.taskType}}</p>
                        </div>
                        <div class="managementHeng">
                            <p>商家：</p>
                            <p>{{item.shangJia|filterPhone}}</p>
                        </div>
                        <div class="managementHeng">
                            <p>垫付本金(元)：</p>
                            <p>{{item.benJin}}</p>
                        </div>
                        <div class="managementHeng">
                            <p>佣金：</p>
                            <p style="color: blue">
                                {{item.yongJin}}<span>+{{item.user_divided}}</span>
                            </p>
                        </div>
                        <div class="managementHeng">
                            <p>接手买号：</p>
                            <p>{{item.maiHao}}</p>
                        </div>
                    </div>
                    <div class="TaskBottom">
                        <img src="/static/mobile/img/bolang.png" alt="" />
                        <div class="TaskBottomPosition">
                            <p>
                                操作：
                                <b class="task-bottom-a-box">
                                    <a href="javascript:" @click="gostep(index)">去完成</a>
                                    <a href="javascript:" @click="cancelActive(index)">放弃</a>
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="Task-management" v-if="tableData.length===0">
                    <div class="TaskTop" style="text-align: center">暂无内容</div>
                    <div class="TaskBottom">
                        <img src="/static/mobile/img/bolang.png" alt="" />
                        <div class="TaskBottomPosition"></div>
                    </div>
                </div>
            </div>

            <!-- 分页 -->
            <div class="public-page">
                <span class="public-page-total">共 {{tableData.length}} 条</span>
                <van-pagination
                        class="public-page-item"
                        @change="pageChange"
                        v-model="currentPage"
                        :items-per-page="10"
                        :total-items="tableData.length"
                        :show-page-size="2"
                        force-ellipses></van-pagination>
            </div>
        </div>

    </div>

    <!-- tabBar -->
<div class="public-tabBar">
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('my/information'); ?>">基本信息</a>
            <a href="<?php echo url('my/withdrawal'); ?>">账号提现</a>
            <a href="<?php echo url('my/add_buyno'); ?>">买号添加</a>
            <a href="<?php echo url('my/vip_recharge'); ?>">会员VIP</a>
        </div>
        <div class="public-tabBar-item-title add-color">
            <span class="iconfont">&#xe60d;</span>
            <span>账号信息</span>
        </div>
    </div>
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('task/maketask'); ?>">继续任务</a>
            <a href="<?php echo url('task/index'); ?>">任务大厅</a>
            <a href="<?php echo url('my/taskmanagement'); ?>">任务管理</a>
        </div>
        <div class="public-tabBar-item-title" style="    color: #fff;
    background-color: #ff976a;">
            <span class="iconfont">&#xe77a;</span>
            <span>任务情况</span>
        </div>
    </div>
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('money/withdrawal'); ?>">提现</a>
            <a href="<?php echo url('money/withsilver'); ?>">银锭充值</a>
            <a href="<?php echo url('money/drawal_record'); ?>">提现记录</a>
        </div>
        <div class="public-tabBar-item-title">
            <span class="iconfont">&#xe601;</span>
            <span>资金管理</span>
        </div>
    </div>
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('Recommend/index'); ?>">邀请好友</a>
            <a href="<?php echo url('Recommend/record'); ?>">邀请记录</a>
        </div>
        <div class="public-tabBar-item-title">
            <span class="iconfont">&#xe888;</span>
            <span>好友邀请</span>
        </div>
    </div>
</div>
</div>
</body>
</html>

