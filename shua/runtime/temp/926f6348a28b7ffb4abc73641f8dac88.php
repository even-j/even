<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"/www/wwwroot/xbt.com/pubic/../application/seller/view/vip/index.html";i:1571629196;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
            <el-menu-item index="1-2"><a :class="menu==='1-2'?'active':''" href="<?php echo url('index/bank'); ?>"> 账号提现</a>
            </el-menu-item>
            <el-menu-item index="1-3"><a :class="menu==='1-3'?'active':''" href="<?php echo url('vip/index'); ?>"> 会员VIP</a>
            </el-menu-item>
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
        <el-submenu index="5">
          <template slot="title">
            <img alt="" src="/static/seller/img/unnititled5.png"/>
            <span>商品管理</span>
          </template>
          <el-menu-item-group>
            <el-menu-item index="5-1"><a :class="menu==='5-1'?'active':''" href="<?php echo url('goods/index'); ?>"> 我的商品</a>
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
	<link rel="stylesheet" type="text/css" href="/static/seller/css/VIP.css" />
		<!-- 右边盒子部分 -->
		<div class="right">
			<!-- 基本信息标题 -->
			<div class="right-top">
				<b>个人中心 / 资金管理 /<strong> 充值会员 </strong></b>
			</div>
			<div class="user_content">

				<!-- 充值会员 -->
				<div class="chongzhi_vip">

					<div class="web_gonggao">
						<div class="gonggao_row">
							<div class="gonggao_top">
								<a href="<?php echo url('vip/index'); ?>" class="select_on">充值会员</a>
							</div>
							<div class="gonggao_top">
								<a href="<?php echo url('vip/record'); ?>">历史记录</a>
							</div>
						</div>
					</div>

					<!-- 会员状态 -->
					<div class="vip_zhuangtai">
						<p>会员: <span><?php echo $seller['seller_name']; ?></span></p>
						<p>状态: <span><?php if($seller['vip']==1): ?> vip会员 <?php else: ?> 普通用户 <?php endif; ?></span></p>
						<p>到期时间: <span><?php echo date('Y-m-d',$seller['vip_time']); ?></span></p>
					</div>

					<!-- 会员套餐 -->
					<div class="vip_taocan">
						<p class="vip_taocan_title">会员套餐:</p>
						<ul>
							<li v-for="(item,index) in list" @click="clickVip(index)" :class="index===curIndex?'vip_taocan_selecton':''">
								<p><span>{{(index+1)*3}}</span>个月</p>
								<p><img src="/static/seller/img/vip_money.png" alt=""/><span>{{item}}</span>元/银锭</p>
							</li>
						</ul>
					</div>

					<!-- 当前选中套餐 -->
					<div class="current_select_taocan">
						<span class="current_select_item">当前选中套餐:</span>
						<img class="current_select_img" src="/static/seller/img/clock.png" alt=""/>
						<span class="current_select_date"><span>{{num}}</span>个月</span>
						<span class="current_select_gang">|</span>
						<img class="current_select_img" src="/static/seller/img/vip_money.png" alt=""/>
						<span class="current_select_price"><span>{{price}}</span>元/银锭</span>
					</div>

					<!-- 支付方式 -->
					<div class="zhifubao">
						<p class="zhifubao_title">支付方式:</p>
						<div class="zhifubao_row">
                  <span class="zhifubao_item" :class="status==1 ? 'zhifubao_color': ''" @click="payState(1)">
                    <img class="zhifubao_img" src="/static/seller/img/zhifubao.png" alt="" />
                    <span class="zhifubao_name">支付宝</span>
                  </span>
									<span class="zhifubao_item" :class="status==2 ? 'zhifubao_color': ''" @click="payState(2)">
                    <img class="zhifubao_img" src="/static/seller/img/yuanbao2.png" alt="" />
                    <span class="zhifubao_name">押金支付</span>
                  </span><span class="zhifubao_item" :class="status==3 ? 'zhifubao_color': ''" @click="payState(3)">
                    <img class="zhifubao_img" src="/static/seller/img/yuanbao3.png" alt="" />
                    <span class="zhifubao_name">银锭支付</span>
                  </span>
						</div>
					</div>

					<!-- 支付金额 -->
					<div class="zhifu_price">
						<span class="zhifu_price_txt">支付金额:</span>
						<img class="zhifu_price_img" src="/static/seller/img/vip_money.png" alt=""/>
						<span class="zhifu_price_count"><span>{{price}}</span>元/银锭</span>
					</div>

					<!-- 支付按钮 -->
					<div class="zhifu_btn" @click="agreePay()">
						<el-button class="zhifu_btn_item" type="primary"><i class="el-icon-circle-check"></i> 确定支付</el-button>
					</div>

				</div>
			</div>
		</div>
	<script type="text/javascript">
		$(function () {

			/* 初始化一个Vue */
			var vm = new Vue({
				el: ".right",
				data: function () {
					return {
						list:<?php echo json_encode($sys); ?>,
						curIndex:0,
						status:1,
						price:0,
						num:3,
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
					clickVip:function(index){
						this.curIndex = index;
						this.price = Number(this.list[index]).toFixed(2);
						this.num = (index+1)*3;
					},
					payState:function(index){
						this.status = index;
					},
					agreePay: function () {
						var that = this;
						that.$confirm("您确定要支付吗?", "温馨提示", {
							confirmButtonText: "确定",
							cancelButtonText: "取消",
							type: "warning"
						}).then(function () {
							var vip = that.curIndex+1;
							$.post("<?php echo url('Vip/rechargeVip'); ?>",{vip:vip,pay_type:that.status},function (res) {
									if(res.code==1){
										return layer.msg(res.msg,{icon:1,time:2000},function(){
											location.href=res.url;
										});
									}else{
										return layer.msg(res.msg,{icon:2,time:2000});
									}
							})
						}).catch(function () {
							layer.msg('您取消了操作！');
						});
					}
				},
				created:function(){
					this.price = Number(this.list[0]).toFixed(2);
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
