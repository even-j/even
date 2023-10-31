<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/seller\view\recommend\index.html";i:1698735419;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\header.html";i:1698733825;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\footer.html";i:1698558175;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="renderer" content="webkit"/>
  <meta name="force-rendering" content="webkit"/>
  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
  <title>小白兔</title>
  <link href="/static/seller/css/iconfont.css" rel="stylesheet" type="text/css"/>
  <link href="/static/seller/node_modules/element-ui/lib/theme-chalk/index.css" rel="stylesheet" type="text/css"/>
  <script charset="utf-8" src="/static/seller/js/vue.js" type="text/javascript"></script>
  <script src="/static/seller/node_modules/element-ui/lib/index.js"></script>
  <script src="/static/seller/js/jquery.min.js"></script>
  <script charset="utf-8" src="/static/seller/layer/layer.js" type="text/javascript"></script>
  <script src="/static/seller/js/axios.min.js"></script>
  <link href="/static/seller/css/public.css" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css"  href="/static/seller/css/header.css" />
</head>
<body>
<div class="top" v-cloak>
  <header>
    <div class="header">
      <div class="header-left">
        <b><?php echo $sellerinfo['seller_name']; ?></b>
        <a href="<?php echo url('login/loginOut'); ?>">退出</a>
      </div>
      <div class="header-right">
        <span>押金：<b><?php echo $sellerinfo['balance']; ?></b>元</span>
        <span>银锭：<b><?php echo $sellerinfo['reward']; ?></b>银锭</span>
      </div>
    </div>
  </header>
  <div class="log">
    <div class="log-padding">
      <a class="title" href="#"><img src="/static/seller/img/log.png"/></a>
      <ul>
        <li><a :class="menu=='0'?'list':''" href="<?php echo url('index/index'); ?>">个人中心</a></li>
        <li><a href="<?php echo url('help/index'); ?>">帮助中心</a></li>
        <li><a :class="menu=='1-3'?'list':''" href="<?php echo url('vip/index'); ?>">会员续费</a></li>
        <li><a :class="menu==='3-1'?'list':''" href="<?php echo url('recharge/recharge'); ?>">账户充值</a></li>
      </ul>
      <span class="log-right">
					<el-button @click="openMsg()" class='message' type="text"><b
                  class="icon iconfont icon-lingdang"></b></el-button>
					<a href="<?php echo url('task/dispatch'); ?>"><b class="icon iconfont icon-paper-airplane"></b>发布任务</a>
        <div class="red_type" v-show="num > 0">{{num}}</div>
				</span>
    </div>
  </div>
  <!-- 弹出框内容 -->
  <el-dialog :visible.sync="dialogVisible" title="个人通知">
    <div v-if="state==1" class="center_box_header">

      <!-- 左边部分 -->
      <div class="left_box_header">
        <div class="left_table">
          <div :class="[index>=1?'hide_border':'',currentIndex===index?'selectOn':'']"
               @click="handleClickTable(index,item.id)"
               class="left_table_item"
               v-for="(item,index) in tableList">
            <div class="txt">
              <span :class="item.look==1 ?'type_color':''"></span>
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
      <div class="right_box_header">
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
<div class="body">
  <!-- 中间内容部分 -->
  <div class="left" v-cloak>
    <!-- 下拉列表 -->
    <el-col>
      <el-menu :default-active="menu" class="el-menu-vertical-demo left-ul" unique-opened>
        <el-submenu index="1">
          <template slot="title">
            <img alt="" src="/static/seller/img/untitled.png"/>
            <span>账号信息</span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="1-1"><a :class="menu==='1-1'?'active':''" href="<?php echo url('index/info'); ?>">基本信息</a>
            </el-menu-item>
            <el-menu-item index="1-2"><a :class="menu==='1-2'?'active':''" href="<?php echo url('index/bank'); ?>"> 商家认证</a>
            </el-menu-item>
            <!--
            <el-menu-item index="1-3"><a :class="menu==='1-3'?'active':''" href="<?php echo url('vip/index'); ?>"> 会员VIP</a>
            </el-menu-item>
            -->
            <el-menu-item index="1-4"><a :class="menu==='1-4'?'active':''" href="<?php echo url('Black/index'); ?>"> 店铺黑名单</a>
            </el-menu-item>
          </el-menu-item-group>
        </el-submenu>
        <el-submenu index="2">
          <template slot="title">
            <img alt="" src="/static/seller/img/unnititled2.png"/>
            <span>任务情况</span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="2-1"><a :class="menu==='2-1'?'active':''" href="<?php echo url('task/task'); ?>"> 任务列表</a></el-menu-item>
            <el-menu-item index="2-2"><a :class="menu==='2-2'?'active':''" href="<?php echo url('task/pending'); ?>"> 待处理任务</a></el-menu-item>
            <el-menu-item index="2-3"><a :class="menu==='2-3'?'active':''" href="<?php echo url('review/task'); ?>"> 追评任务</a></el-menu-item>

            <el-menu-item index="2-4"><a :class="menu==='2-4'?'active':''" href="<?php echo url('goods/index'); ?>"> 我的商品</a>
            </el-menu-item>

          </el-menu-item-group>
        </el-submenu>
        <el-submenu index="3">
          <template slot="title">
            <img alt="" src="/static/seller/img/unnititled3.png"/>
            <span>资金管理</span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="3-1"><a :class="menu==='3-1'?'active':''" href="<?php echo url('recharge/recharge'); ?>"> 账户充值</a>
            </el-menu-item>
            <el-menu-item index="3-2"><a :class="menu==='3-2'?'active':''" href="<?php echo url('finance/finance'); ?>"> 收支记录</a>
            </el-menu-item>
            <el-menu-item index="3-3"><a :class="menu==='3-3'?'active':''" href="<?php echo url('recharge/cash'); ?>"> 押金提现</a>
            </el-menu-item>
          </el-menu-item-group>
        </el-submenu>
        <el-submenu index="4">
          <template slot="title">
            <img alt="" src="/static/seller/img/unnititled4.png"/>
            <span>店铺管理</span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="4-1"><a :class="menu==='4-1'?'active':''" href="<?php echo url('shop/shop'); ?>"> 已绑店铺</a>
            </el-menu-item>
            <el-menu-item index="4-2"><a :class="menu==='4-2'?'active':''" href="<?php echo url('shop/shop',['str'=>'bangding']); ?>"> 绑定店铺</a>
            </el-menu-item>
          </el-menu-item-group>
        </el-submenu>

        <el-submenu index="6">
          <template slot="title">
            <img alt="" src="/static/seller/img/unnititled6.png"/>
            <span>好友邀请</span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="6-1"><a :class="menu==='6-1'?'active':''" href="<?php echo url('Recommend/index'); ?>"> 邀请好友</a>
            </el-menu-item>
            <el-menu-item index="6-2"><a :class="menu==='6-2'?'active':''" href="<?php echo url('Recommend/record'); ?>"> 邀请记录</a>
            </el-menu-item>
          </el-menu-item-group>
        </el-submenu>
      </el-menu>
    </el-col>
  </div>
  <script>
      function imgError(e){
          e.src = '/static/seller/img/moren.jpg';
      }
  </script>
  <script>
      var name = new Vue({
          el: ".left",
          data: function () {
              return {
                  menu: "<?php echo $menu; ?>",
              };

          },
      })
  </script>
  <script>
      var name = new Vue({
          el: ".top",
          data: function () {
              return {
                  menu: "<?php echo $menu; ?>",
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
                  num:0,
              };

          },
          created:function() {
              this.getData();
              this.panduan();
          },
          methods: {
              /* 消息弹框事件 */
              openMsg: function () {
                  this.dialogVisible = true;
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
              setData:function(index){
                  var that = this;
                  if(this.tableList[index].look==1)return;
                  that.tableList[index].look=1;
                  $.post("<?php echo url('index/setMsg'); ?>", {id: this.tableList[index].id}, function (res) {
                        if(res.data == 0)that.num=0;
                  })
              },
              getData: function () {
                  var that = this;
                  $.post("<?php echo url('index/msg'); ?>", {page: this.page}, function (res) {
                      if (res.code == 1) {
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
              setPage:function(val) {
                  this.page = val;
                  this.getData();
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
              }
          }
      })
  </script>
<link rel="stylesheet" type="text/css" href="/static/seller/css/yaoQingFriends.css" />
<!-- 右边盒子部分 -->
<div class="right">
	<!-- 基本信息标题 -->
	<div class="right-top">
		<b>个人中心 / 好友邀请 /<strong> 邀请好友 </strong></b>
	</div>
	<div class="user_content">



		<!-- 邀请好友 -->
		<div class="web_gonggao">
			<div class="gonggao_row">
				<div class="gonggao_top">
					<a href="javascript:" class="select_on">邀请链接<?php echo $url['seller']; ?><?php echo $url['user']; ?></a>
				</div>
			</div>
		</div>

		<!-- 邀请好友部分 -->
		<div class="yaoqing_friend">
			<p class="yaoqing_txt">复制您的 <span>小白兔</span> 邀请链接，邀请好友成功注册 <span>小白兔</span> 账号之后，好友做任务您可以获得邀请奖励</p>
			<!-- 复制链接 -->
			<div v-show="state==1">
				<div class="yaoqing_link">
					<p><span>商家</span>邀请链接:</p>
					<el-input v-model="linkValue" :title="linkValue" readonly class="yaoqing_link_input"></el-input>
					<el-button type="primary" class="copy_link_btn" v-clipboard:copy="linkValue"
										 v-clipboard:success="copySuccess" v-clipboard:error="copyError">复制链接
					</el-button>
				</div>
				<div class="yaoqing_link">
					<p><span>买手</span>邀请链接:</p>
					<el-input v-model="linkValue2" :title="linkValue2" readonly class="yaoqing_link_input"></el-input>
					<el-button type="primary" class="copy_link_btn" v-clipboard:copy="linkValue2"
										 v-clipboard:success="copySuccess2" v-clipboard:error="copyError2">复制链接
					</el-button>
				</div>
			</div>
			<!-- 请注意 -->
			<div class="alert">
				<div class="alert_title">
					<i class="el-icon-warning" style="font-size: 26px;margin-right: 10px"></i>
					<p>请注意:</p>
				</div>
				<div class="alert_txt">
					<p>1、您必须要发布任务之后才能邀请好友！</p>
					<p>2、邀请链接只能发布于聊天工具中，如微信，QQ，等等，禁止推广于外部网站，如微博，博客，贴吧等等 的各大网站，平台会定期核实，如有发现一律邀请链接作废！</p>
					<p>3、邀请好友只能是朋友，亲戚，同事，熟人等等，一律不可向陌生人发送邀请链接，邀请进小白兔注册做任务。</p>
				</div>
			</div>
		</div>

		<!-- 邀请奖励 -->
		<div class="web_gonggao">
			<div class="gonggao_row">
				<div class="gonggao_top">
					<a href="javascript:" class="select_on">邀请奖励</a>
				</div>
			</div>
		</div>

		<!-- 邀请奖励部分 -->
		<div class="yaoqing_jiangli">

			<!-- 商家奖励 -->
			<p class="yaoqing_jiangli_txt">邀请商家成功，商家发布任务每单任务可获得 <span>1</span> 银锭作为奖励&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注:
				<span>商家发布任务的奖金由小白兔平台承担，不会扣除商家发布任务的金额</span>
			</p>
			<div class="yaoqing_table">
				<div class="yaoqing_table_left">商家发布任务奖励</div>
				<div class="yaoqing_table_right">
					<p>邀请好友每发布一单任务完结后，邀请人均可获得奖励 <span>1</span> 银锭；</p>
					<p>每邀请一个好友可获得奖励上限 <span>500</span> 银锭</p>
				</div>
			</div>

			<!-- 买手奖励 -->
			<p class="yaoqing_jiangli_txt">邀请买手完成任务后，可获得奖励&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注: <span>买手完成任务的奖金由小白兔平台承担，不会扣除买手完成任务获得的佣金
</span>
			</p>
			<div class="yaoqing_table">
				<div class="yaoqing_table_left">买家完成任务奖励</div>
				<div class="yaoqing_table_right">
					<p>邀请好友每完成一单任务（完结后），邀请人均可获得奖励 <span>0.5</span> 银锭；</p>
					<p>每邀请一个好友可获得奖励上限 <span>1000</span> 银锭</p>
				</div>
			</div>
			<!-- 请注意 -->
			<div class="alert">
				<div class="alert_title">
					<i class="el-icon-warning" style="font-size: 26px;margin-right: 10px"></i>
					<p>请注意:</p>
				</div>
				<div class="alert_txt">
					<p>任何用户不得利用此活动，自己邀请自己获得返利；一旦平台排查出这种情况，违规将给予罚金并没收奖励。</p>
				</div>
			</div>

		</div>

	</div>
</div>
<script src="/static/buy/js/vue-clipboard.js"></script>
<script type="text/javascript">
$(function () {

	/* 初始化一个Vue */
	var vm = new Vue({
		el: ".right",
		data: function () {
			return {
				state:"<?php echo $state; ?>",
				linkValue:"<?php echo $url['seller']; ?>",
				linkValue2:"<?php echo $url['user']; ?>",
			}
		},
		methods: {
			copyLink: function () {

			},
			/* 引入vue-clipboard实现复制链接1 */
			copySuccess: function (e) {
				this.$message({
					message: "商家邀请链接复制成功",
					type: "success"
				});
				console.log(e.text);
			},
			copyError: function () {
				this.$message.error("商家邀请链接复制失败,请稍后重试");
			},
			/* 引入vue-clipboard实现复制链接2*/
			copySuccess2: function (e) {
				this.$message({
					message: "买手邀请链接复制成功",
					type: "success"
				});
				console.log(e.text);
			},
			copyError2: function () {
				this.$message.error("买手邀请链接复制失败,请稍后重试");
			}

		}
	});


});
</script>
<!-- 底部 -->
</div>
<footer>
  <div class="footer">
    <h2><b>技术支持:&nbsp;</b><a href="#">小白兔</a></h2>
  </div>
</footer>
</body>
</html>