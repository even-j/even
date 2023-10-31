<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/www/wwwroot/xbt.com/pubic/../application/mobile/view/money/withdrawal.html";i:1698587824;s:61:"/www/wwwroot/xbt.com/application/mobile/view/public/left.html";i:1577592620;s:63:"/www/wwwroot/xbt.com/application/mobile/view/public/footer.html";i:1578366492;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>本金提现</title>
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
                        radio: "1",
                        /* 输入框数量默认值5 */
                        tiXianNum: <?php echo $admin_limit['user_min_money']; ?>,
                        /* 提现密码的值 */
                        tiXianPassWordValue: "",
                        /* 到账金额 */
                        daoZhangPrice: <?php echo $admin_limit['user_min_money']; ?>-<?php echo $admin_limit['user_cash_free']; ?>,
                        /* 提现最低金额 */
                        tiXianPrice: <?php echo $admin_limit['user_min_money']; ?>,
                        /* 提现手续费内容 */
                        tiXianContent: "本金提现<?php echo $admin_limit['user_fee_max_price']; ?>元及以下操作平台将收取 <?php echo $admin_limit['user_cash_free']; ?>元 的手续费",
                        // 默认分页
                        currentPage: 1,
                        // 表格数据
                        list: [],
                        total:0,
                    };
                },
                // 调用混入
                mixins: [dateMixin, tabMixin, singlePersonMixin],
                methods: {
                    /* 数字框事件 */
                    handleChange: function (value) {
                        //console.log(value);
                        if(this.radio==="1"){
                            if(value<=<?php echo $admin_limit['user_fee_max_price']; ?>){
                                this.daoZhangPrice=parseFloat(value-1).toFixed(2);
                            }else{
                                this.daoZhangPrice=parseFloat(value).toFixed(2);
                            }
                        }else if(this.radio==="2"){
                            this.daoZhangPrice=parseFloat(value*<?php echo $admin_limit['reward_price']; ?>).toFixed(2)

                        }
                    },
                    // 动态修改radio样式
                    radioChange: function (e) {
                         console.log(e);
                        $(".radio-box .radio-box-item").toggleClass("active");
                        var num = parseInt(e);
                        // console.log(num);
                        if (num === 1) {
                            this.tiXianNum=<?php echo $admin_limit['user_min_money']; ?>;
                            this.daoZhangPrice = <?php echo $admin_limit['user_min_money']; ?>-<?php echo $admin_limit['user_cash_free']; ?>;
                            this.tiXianPrice = <?php echo $admin_limit['user_min_money']; ?>;
                            this.tiXianContent = "提现本金大于<?php echo $admin_limit['user_fee_max_price']; ?>元免<?php echo $admin_limit['user_cash_free']; ?>元手续费.";
                        } else if (num === 2) {
                            this.tiXianNum=<?php echo $admin_limit['user_min_reward']; ?>;
                            this.daoZhangPrice = <?php echo $admin_limit['user_min_reward']; ?>*<?php echo $admin_limit['reward_price']; ?>;
                            this.tiXianPrice = <?php echo $admin_limit['user_min_reward']; ?>;
                            this.tiXianContent = "银锭提现按当前单价<?php echo $admin_limit['reward_price']; ?>自动取整";
                        }
                    },
                    // 点击申请提现按钮
                    tixianActive: function () {
                        var that=this;
                        this.$dialog.confirm({
                            title: "温馨提示",
                            message: "您确定要提现吗？"
                        }).then(function () {
                            if(!that.tiXianPassWordValue) return alertError("请输入支付密码");
                            $.ajax({
                                type : 'POST',
                                url : "<?php echo url('mobile/money/creat_withdrawal'); ?>",
                                async : true,
                                data : {
                                    "price":that.tiXianNum,
                                    "password":that.tiXianPassWordValue,
                                    "radio":that.radio
                                },
                                success : function(data){
                                    if(data.code==1){
                                        alertSuccess(data.msg);
                                        setTimeout(function(){
                                            return location.href=data.url;
                                        },3000)

                                    }else{
                                        alertError(data.msg);
                                        setTimeout(function(){
                                            return location.href=data.url;
                                        },3000)
                                    }
                                },
                                error : function(XMLHttpRequest, textStatus, errorThrown) {
                                    alert(XMLHttpRequest.status + "," + textStatus);
                                }
                            });
                        }).catch(function () {});
                    },
                    // 修改表格样式
                    filterColor(val) {
                        if (val > 0) {
                            return "#74f574";
                        } else {
                            return "red";
                        }
                    },
                    // 分页事件
                    pageChange: function (val) {
                        this.currentPage = val;
                        this.getData();
                    },
                    // 日期事件
                    dateChange: function (val) {
                        // 转换标准时间为时间戳
                        this.defaultDate = val.getTime();
                    },
                    dateChange2: function (val) {
                        // 转换标准时间为时间戳
                        this.defaultDate2 = val.getTime();
                    },
                    //本金记录数据
                    getData:function(){
                        var that = this;
                        $.post("<?php echo url('money/withdrawal'); ?>",{
                            page:that.currentPage,
                            datetime1:that.defaultDate,
                            datetime2:that.defaultDate2
                        },function (res) {
                            console.log(res);
                            if(res.code==1){
                                that.list = res.data.list;
                                that.total = res.data.total;
                            }else{
                                alertError(res.msg);
                            }
                        })
                    },
                    search:function(){
                        this.currentPage = 1;
                        this.getData();
                    },
                },
                mounted: function () {
                    publicFunction();
                    this.getData();
                    <?php if(!(empty($show) || (($show instanceof \think\Collection || $show instanceof \think\Paginator ) && $show->isEmpty()))): ?>
                    this.isShow=false;
                    this.showType=1;
                    <?php endif; if(!(empty($editpass) || (($editpass instanceof \think\Collection || $editpass instanceof \think\Paginator ) && $editpass->isEmpty()))): if($editpass ==1): ?>
                        this.isShow=false;
                        this.showType=1;
                        <?php else: endif; endif; ?>
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
        <div class="page-title">提现</div>
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
            <span :class="{active:showType===0}" data-type="0" @click="setTabColor">提现</span>
            <span :class="{active:showType===1}" data-type="1" @click="setTabColor">本金记录</span>
        </div>

        <!-- 本金提现内容 -->
        <div class="benjin-tixian" v-show="isShow">
            <div class="select-tixian">
                <span>选择提现：</span>
                <van-radio-group class="radio-box" v-model="radio" @change="radioChange">
                    <van-radio class="radio-box-item active" name="1">本金提现</van-radio>
                    <van-radio class="radio-box-item" name="2">银锭提现</van-radio>
                </van-radio-group>
            </div>
            <p class="yue">本金余额：<span><?php echo $users['balance']; ?></span><span>元</span></p>
            <p class="yue">银锭余额：<span><?php echo $users['reward']; ?></span><span>银锭</span></p>
            <div class="dakuan-style">
                <span class="dakuan-style-title">打款方式：</span>
                <span class="zhuanzhang">银行卡转账</span>
                <a href="<?php echo url('my/withdrawal'); ?>">查看提现账户</a>
                <p>提示: <span>提现账户只能绑定一张银行卡</span></p>
            </div>
            <div class="tixian-jine">
                <span class="tixian-jine-title">提现金额：</span>
                <div class="stepper">
                    <van-stepper v-model="tiXianNum" @change="handleChange"  :decimal-length="2" :min="tiXianPrice" />
                </div>
                <p class="tixian-min">单笔提现最低 <span>{{tiXianPrice}}</span> 元</p>

                <div class="alert">
                   <!--<p v-html="tiXianContent"><span></span></p>-->
                   <p><span></span></p>
                   <p>预计2个工作日内（国家法定假日和双休日顺延）平台完成提现操作 到账时间以各大银行为准,预计3-5工作日左右</p>
 
                </div>
            </div>
            <div class="daozhang-jine">到账金额：<span>{{daoZhangPrice}}</span><span>元</span></div>
            <div class="tixian-password">
                <span>提现密码：</span>
                <div class="public-input">
                    <input type="password" v-model="tiXianPassWordValue" placeholder="请输入6位提现密码" maxlength="6">
                </div>
                <a href="<?php echo url('my/information',['editpass'=>1]); ?>">重置提现密码</a>
            </div>
            <div class="shenqing-tixian">
                <van-button
                        @click="tixianActive"
                        class="shenqing-tixian-item"
                        icon="passed"
                        type="danger">申请提现
                </van-button>
            </div>
        </div>

        <!-- 本金记录内容 -->
        <div class="benjin-record" v-show="!isShow">
            <div class="select-date">
                <!-- 选择日期 -->
                <div class="span-date">
                    <mu-date-input
                            @change="dateChange"
                            class="span-date-item"
                            v-model="defaultDate"
                            label="请选择开始日期"
                            label-float></mu-date-input>
                    <mu-date-input
                            @change="dateChange2"
                            class="span-date-item"
                            v-model="defaultDate2"
                            label="请选择结束日期"
                            label-float></mu-date-input>
                </div>
                <!-- 按钮 -->
                <div class="date-btn" style="justify-content: flex-start">
                    <van-button id="benjin-date-btn-item" class="date-btn-item" icon="search" @click="search" type="info">搜索</van-button>

                </div>

                <!-- 卡片 -->
                <div class="TaskManagement">
                    <div class="Task-management" v-for="(item,index) in list" :key="index">
                        <div class="TaskTop">
                            <div class="managementHeng">
                                <p>收支明细：</p>
                                <p :style="{color:filterColor(item.price)}">
                                    {{Number(item.price).toFixed(2)}}
                                </p>
                            </div>
                            <div class="managementHeng">
                                <p>结余：</p>
                                <p>{{Number(item.yprice).toFixed(2)}}</p>
                            </div>
                            <div class="managementHeng">
                                <p>日期：</p>
                                <p>{{item.creata_time}}</p>
                            </div>
                        </div>
                        <div class="TaskBottom">
                            <img src="/static/mobile/img/bolang.png" alt="" />
                            <div class="TaskBottomPosition">
                                <p>备注：</p>
                                <p>{{item.memo}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="Task-management" v-if="list.length===0">
                        <div class="TaskTop" style="text-align: center">暂无内容</div>
                        <div class="TaskBottom">
                            <img src="/static/mobile/img/bolang.png" alt="" />
                            <div class="TaskBottomPosition"></div>
                        </div>
                    </div>
                </div>

                <!-- 分页 -->
                <div class="public-page">
                    <span class="public-page-total">共 {{total}} 条</span>
                    <van-pagination
                            class="public-page-item"
                            @change="pageChange"
                            v-model="currentPage"
                            :items-per-page="10"
                            :total-items="total"
                            :show-page-size="2"
                            force-ellipses></van-pagination>
                </div>
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

