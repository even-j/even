<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/www/wwwroot/xbt.com/pubic/../application/mobile/view/helpcenter/msg.html";i:1587647170;s:61:"/www/wwwroot/xbt.com/application/mobile/view/public/left.html";i:1577592620;s:63:"/www/wwwroot/xbt.com/application/mobile/view/public/footer.html";i:1578366492;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>个人通知</title>
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
                      // 弹框默认不显示
                      singleDialogShow: false,
                      // 红点默认显示
                      redShow: true,
                      singleIndex: 0,
                      // 右下角数据
                      detail: {
                          title: "",
                          author: "",
                          content: "",
                          create_time: ""
                      }
                  };
              },
              methods: {
                  // 分页事件
                  pageChange: function (val) {
                      this.msgPage = val;
                      this.msgGetData();
                  },
                  // 列表点击事件
                  singlePersonListActive: function (index) {
                      this.singleIndex = index;
                      this.singlePersonList[index].look = 1;
                      this.singleDialogShow = true;
                      this.detail = this.singlePersonList[index];
                      var id = this.singlePersonList[index].id;
                      $.post("<?php echo url('helpcenter/setMsg'); ?>", {id:id}, function (res) {
                          console.log(res);
                      })
                  }
              },
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

  <!-- 页面头部 -->
  <div class="page-header">
    <div class="arrow-left" onclick="javascript:history.back(-1);">
      <van-icon class="arrow-left-item" name="arrow-left" />
    </div>
    <div class="page-title">个人通知</div>
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
      <span class="active">个人通知</span>
    </div>

    <!-- 个人通知 -->
    <div class="help-center">
      <!-- 个人通知列表 -->
      <div class="help-center-list">
        <div
                class="help-center-list-item"
                @click="singlePersonListActive(index)"
                v-for="(item,index) in singlePersonList"
                :key="index">
          <span v-if="item.look===0" class="red-color"></span>
          <p>{{item.title}}</p>
          <div class="help-center-list-item-time">
            <van-icon class="help-center-list-item-time-icon" name="clock-o"></van-icon>
            <span>{{item.create_time}}</span>
          </div>
        </div>
      </div>
      <!-- 分页 -->
      <div class="public-page">
        <span class="public-page-total">共 {{msgTotal}} 条</span>
        <van-pagination
                class="public-page-item"
                @change="pageChange"
                v-model="msgPage"
                :items-per-page="5"
                :total-items="msgTotal"
                :show-page-size="2"
                force-ellipses></van-pagination>
      </div>
      <!-- 内容弹框 -->
      <van-dialog v-model="singleDialogShow" title="个人通知" show-cancel-button>
        <div class="help-detail">
          <h1 class="help-detail-title">{{detail.title}}</h1>
          <div class="help-detail-content">{{detail.content}}</div>
          <p class="help-detail-fenlei">{{detail.author}}</p>
          <p class="help-date">{{detail.create_time}}</p>
        </div>
      </van-dialog>
    </div>

  </div>

  <!-- tabBar -->
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

