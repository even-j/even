<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"/www/wwwroot/xbt.com/pubic/../application/mobile/view/my/index.html";i:1594086812;s:61:"/www/wwwroot/xbt.com/application/mobile/view/public/left.html";i:1577592620;s:63:"/www/wwwroot/xbt.com/application/mobile/view/public/footer.html";i:1578366492;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>首页</title>
    <link rel="stylesheet" href="/static/mobile/css/plugin.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/iconfont/iconfont.css" type="text/css">
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
                    return {};
                },
                methods:{
                    tixiana:function () {
                        location.href="<?php echo url('money/withdrawal'); ?>"
                    },
                    gochongzhi:function () {
                        location.href="<?php echo url('money/withsilver'); ?>"
                    },
                    tixianb:function () {
                        location.href="<?php echo url('money/withdrawal',['ydtx'=>1]); ?>"
                    },
                    goyaoqing:function () {
                        location.href="<?php echo url('recommend/index'); ?>"
                    },
                    maketask:function () {
                        location.href="<?php echo url('task/maketask'); ?>"
                    },
                    personmessage:function(){
                        location.href="<?php echo url('helpcenter/msg'); ?>"
                    },
                },
                // 调用混入
                mixins: [singlePersonMixin],
                mounted: function () {
                    publicFunction();
                }
            });
        });
    </script>
</head>
<body>
<div class="tfkz-container">

    <!-- 头部 -->
    <div class="public-header">
        <div class="renwu-btn">
            <van-button  class="renwu-btn-item" icon="passed" @click="maketask" type="warning">继续任务</van-button>
            <van-button class="renwu-btn-item" icon="passed" @click="personmessage" type="warning">
                <b>个人通知</b>
                <div class="renwu-btn-item-tag" v-if="tagShow">
                    <van-tag class="slide-van-tag" round type="danger">{{tagNum}}</van-tag>
                </div>
            </van-button>
        </div>
        <div class="logo-box"><img src="/static/mobile/img/logo.png" alt=""></div>
        <div class="menu-box" onclick="slideBarClick()">
            <van-icon class="menu-box-item" name="bars" />
        </div>
    </div>

    <!-- 下拉列表 -->
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

        <!-- 首页内容 -->
        <div class="index-box">
            <div class="touxiang-box"><img src="/static/mobile/img/imgheade.png" alt=""></div>
            <div class="content-one">
                <p class="text">用户名/<span><?php echo $users['username']; ?></span></p>
                <div class="text2">
                    <p>绑定手机号：<span><?php echo $users['mobile']; ?></span></p>
                    <p>经验值：<span><?php echo $all_num_task; ?></span> <span></span></p>
                </div>
                <p class="text3">累积赚取银锭：<span><?php echo $all_obtain_reward; ?></span> <span>银锭</span></p>
            </div>
            <div class="content-two">
                <p class="text">会员状态<span>
                    /<?php if($users['vip'] ==1): ?>VIP会员
                                    <?php else: ?> 不是会员
                                    <?php endif; ?>
                </span></p>
                <div class="text2">
                    <p>到期时间：<span><?php echo date("Y-m-d",$users['vip_time']); ?></span></p>
                    <a href="<?php echo url('my/vip_recharge'); ?>">点击延时VIP</a>
                </div>
                <div class="text3">
                    <p>本月可做：<span><?php echo $residue_task; ?></span> <span>单任务</span></p>
                    <p>待商家发放银锭：<span><?php echo $wait_shop_issue; ?></span> <span>银锭</span></p>
                </div>
            </div>
        </div>

        <!-- 分割线 -->
        <div class="index-line"></div>

        <!-- 公用tab标签 -->
        <div class="public-tab-title">
            <span class="active">充值入口</span>
        </div>

        <!-- 充值入口 -->
        <div class="index-chongzhi">
            <!-- 我的本金 -->
            <div class="my-benjin">
                <p>我的本金</p>
                <div class="my-benjin-item">
                    <img src="/static/mobile/img/yuanbao1.png" alt="">
                    <span><?php echo $users['balance']; ?>元</span>
                    <span>(可提现本金)</span>
                </div>
                <div class="my-benjin-item">
                    <img src="/static/mobile/img/yuanbao1.png" alt="">
                    <span><?php echo $all_user_principal; ?>元</span>
                    <span>(总计垫付本金)</span>
                </div>
                <div class="index-chongzhi-btn-box">
                    <van-button class="index-chongzhi-btn" @click="tixiana" type="info">提现</van-button>
                </div>
            </div>
            <!-- 我的银锭 -->
            <div class="my-yinding">
                <p>我的银锭</p>
                <div class="my-yinding-item">
                    <img src="/static/mobile/img/yuanbao2.png" alt="">
                    <span><?php echo $myself['reward']; ?>银锭 = <?php echo $discounting; ?>元</span>
                    <span>(总银锭)</span>
                </div>
                <div class="my-yinding-item">
                    <img src="/static/mobile/img/yuanbao2.png" alt="">
                    <span><?php echo $freeze_reward; ?>银锭</span>
                    <span>(冻结银锭)</span>
                </div>
                <div class="index-yinding-btn-box">
                    <van-button class="index-yinding-btn" @click="gochongzhi" type="primary">充值</van-button>
                    <van-button class="index-yinding-btn" @click="tixianb" type="primary">提现</van-button>
                </div>
            </div>
            <!-- 我的邀请 -->
            <div class="my-invite">
                <p>我的邀请</p>
                <div class="my-invite-item">
                    <img src="/static/mobile/img/jinpai.png" alt="">
                    <span>总计获得奖励:<?php echo $myself['tj_award']; ?>银锭</span>
                </div>
                <div class="my-invite-item">
                    <img src="/static/mobile/img/user_lan.png" alt="">
                    <span>总计邀请人数: <?php echo $all_invite; ?>人</span>
                </div>
                <p>今日获得奖励: <?php echo $myself['tj_award_day']; ?>银锭</p>
                <p>今日邀请人数: <?php echo $day_invite; ?>人</p>
                <div class="my-invite-item-btn-box">
                    <van-button class="my-invite-item-btn" @click="goyaoqing" type="info">邀请</van-button>
                </div>
            </div>
            <!-- 历史记录 -->
            <div class="history">
                <span>历史记录：</span>
                <a href="<?php echo url('money/withdrawal',['editpass'=>1]); ?>">本金记录</a>
                <a href="<?php echo url('money/withsilver',['editpass'=>1]); ?>">银锭记录</a>
                <a href="<?php echo url('money/drawal_record'); ?>">提现记录</a>
                <a href="<?php echo url('my/vip_record'); ?>">会员记录</a>
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


