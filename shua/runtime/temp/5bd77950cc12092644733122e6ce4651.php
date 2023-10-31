<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/www/wwwroot/xbt.com/pubic/../application/seller/view/index/index.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>

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
			<link rel="stylesheet" type="text/css" href="/static/seller/css/myCenter.css" />
			<!-- 右边盒子部分 -->
			<div class="right" v-cloak>
				<!-- 用户信息盒子 -->
				<div class="right_box_item">
					<!-- 用户信息 -->
					<div class="user_info">
						<img class="user_touxiang" src="/static/seller/img/imgheade.png" alt="" />
						<div class="user_name">
							<p class="user_name_left1"><?php echo $seller['seller_name']; ?> <b>/会员用户名</b></p>
							<p class="user_name_left2">绑定手机号: <b><?php echo $seller['mobile']; ?></b></p>
						</div>
						<div class="vip_name">
							<p class="vip_name_left1"><?php if($seller['vip']==1): ?> vip会员 <?php else: ?> 普通用户 <?php endif; ?><b>/会员状态</b></p>
							<p class="vip_name_left2">到期时间: <b><?php echo date('Y-m-d',$seller['vip_time']); ?></b> <a href="javascript:;" @click="vip()"><<<strong>延时VIP</strong>>></a></p>
						</div>
					</div>
				</div>
				<!-- 充值入口 -->
				<div class="chongzhi">
					<div class="chongzhi_top">
						<a class="select_on">充值入口</a>
					</div>
					<div class="chongzhi_row">
						<!-- 我的押金 -->
						<div class="mybenjin">
							<p class="mybenjin_title">我的押金</p>
							<div class="mybenjin_row">
								<img src="/static/seller/img/yuanbao2.png" alt="" />
								<span class="mybenjin_price"> <?php echo $seller['balance']; ?> 元</span>
								<span class="mybenjin_txt">(可用押金)</span>
							</div>
							<!--<div class="mybenjin_row">
								<img src="/static/seller/img/yuanbao4.png" alt="" />
								<span class="mybenjin_price_color"> 0.00 元</span>
								<span class="mybenjin_txt">(冻结押金)</span>
							</div>
							<div class="mybenjin_row">
								<img src="/static/seller/img/yuanbao1.png" alt="" />
								<span class="mybenjin_price"><?php echo $seller['balance']; ?> 元</span>
								<span class="mybenjin_txt">(总押金)</span>
							</div>-->
							<div class="myyingding_btn">
								<el-button size="small" @click="chongzi()">充值</el-button>
								<el-button size="small" @click="cash()" type="primary">提现</el-button>
							</div>
						</div>
						<!-- 我的银锭 -->
						<div class="myyingding">
							<p class="myyingding_title">我的银锭</p>
							<div class="myyingding_row">
								<img src="/static/seller/img/yuanbao3.png" alt="" />
								<span class="myyingding_price"><?php echo $seller['reward']; ?> 银锭</span>
								<span class="myyingding_txt">(可用银锭)</span>
							</div>
							<div class="myyingding_row">
								<img src="/static/seller/img/yuanbao4.png" alt="" />&nbsp;&nbsp;&nbsp;
								<span class="myyingding_txt" style="color: red"> 银锭不可提现</span>
							</div>
							<div class="myyingding_row">
								<img src="/static/seller/img/yuanbao1.png" alt="" />
								<span class="myyingding_price"><?php echo $ejang; ?> 银锭</span>
								<span class="myyingding_txt">(推荐额外奖励)</span>
							</div>
							<div class="myyingding_btn">
								<el-button size="small" @click="chongzi()">充值</el-button>
							</div>
						</div>
						<!-- 邀请好友 -->
						<div class="myyaoqing">
							<p class="myyaoqing_title">邀请好友</p>
							<div class="myyaoqing_row">
								<img src="/static/seller/img/jinpai.png" alt="" />
								<span class="myyaoqing_price">总计获得奖励: <?php echo $seller['tj_award']; ?> 银锭</span>
							</div>
							<div class="myyaoqing_row">
								<img src="/static/seller/img/user_lan.png" alt="" />
								<span class="myyaoqing_price">总计邀请人数: <?php echo $num; ?> 人</span>
							</div>
							<div class="myyaoqing_row_p">
								<span class="myyaoqing_price myyaoqing_margin">今 日 获 得 奖 励: <?php echo $seller['tj_award_day']; ?> 银锭</span>
							</div>
							<div class="myyaoqing_row_p">
								<span class="myyaoqing_price myyaoqing_margin">今 日 邀 请 人 数: <?php echo $num_day; ?> 人</span>
							</div>
							<div class="myyingding_btn">
								<el-button size="small" @click="recommend()" type="primary">邀请</el-button>
							</div>
						</div>
					</div>
					<!-- 历史记录 -->
					<!--<div class="lishijilu">
						<span>历史记录:</span>
						<a href="javascript:;">押金记录</a>
						<a href="javascript:;">银锭记录</a>
						<a href="javascript:;">提现记录</a>
					</div>-->
				</div>
				<!-- 网站公告 -->
				<!--<div class="web_gonggao">
					<div class="gonggao_row">
						<div class="gonggao_top">
							<a href="javascript:;" class="select_on">网站公告</a>
						</div>
						<div class="gonggao_top">
							<a href="javascript:;">常见问题</a>
						</div>
					</div>
					<div class="web_news"></div>
				</div>-->
				<!-- 任务管理 -->
				<div class="renwuguanli_box">
					<!-- 任务管理标题 -->
					<div class="renwuguanli">
						<div class="renwuguanli_item">
							<a href="javascript:;" class="renwuguanli_item_select">任务管理</a>
						</div>
					</div>
					<div class="switch">
						<el-tabs v-model="activeName" @tab-click="handleClick">
							<el-tab-pane label="所有任务" name="first"></el-tab-pane>
							<el-tab-pane label="待付款" name="second"></el-tab-pane>
							<el-tab-pane label="待审核" name="third"></el-tab-pane>
							<el-tab-pane label="已通过" name="fourth"></el-tab-pane>
							<el-tab-pane label="已拒绝" name="fifth"></el-tab-pane>
							<el-tab-pane label="已取消" name="eighth"></el-tab-pane>
							<el-tab-pane label="已完成" name="sixth"></el-tab-pane>
							<el-tab-pane label="今日订单" name="seventh"></el-tab-pane>
						</el-tabs>
					</div>
					<!-- 选项卡第一行 -->
					<div class="select_row_one">
						<p>终端:</p>
						<el-select class="el_select label" v-model="info.terminal" clearable placeholder="全部" size="small">
							<el-option label="PC端" value="1"></el-option>
							<el-option label="移动端" value="2"></el-option>
						</el-select>
						<p> 店铺:</p>
						<el-select class="el_select label2" v-model="info.shop_id" clearable placeholder="全部" size="small">
							<el-option v-for="(item,key) in shop" :key="key" :label="item.shop_name" :value="item.id">
							</el-option>
						</el-select>
						<p>任务类型:</p>
						<el-select class="el_select label6" v-model="info.task_type" clearable placeholder="全部" size="small">
							<el-option v-for="(item,key) in taskType" :key="key" :label="item" :value="key">
							</el-option>
						</el-select>
					</div>
					<!-- 选项卡第二行 -->
					<div class="select_row_two">
						<p>任务起止时间:</p>
						<el-date-picker class="el_date label3" v-model="info.searchTime" type="daterange" range-separator="至"
														start-placeholder="开始日期" end-placeholder="结束日期" size="small" value-format="yyyy-MM-dd">
						</el-date-picker>
						<p>任务编号 : </p>
						<el-input v-model="info.search" placeholder="请输入内容" class="label5" size="small"></el-input>
						<p>淘宝单号 : </p>
						<el-input v-model="info.order_number" placeholder="请输入淘宝单号" class="label5" size="small"></el-input>
					</div>
					<div class="select_row_two">
						<p>商品价格区间 : </p>
						<el-input v-model="info.min_price" placeholder="请输入最小价格" class="label5" size="small"></el-input>-
						<el-input v-model="info.max_price" placeholder="请输入最大价格" class="label5" size="small"></el-input>
						<el-button type="primary" size="small" @click="search()"><i class="el-icon-search"></i> 搜索</el-button>
						<!--<el-button class="el_daochu" type="primary" size="small"><i class="el-icon-download"></i> 导出</el-button>-->
					</div>
					<!-- 切换 -->
					<div>
						<div class="swell">
							<div v-if="list.length == 0">
								<div class="no_null">暂无数据</div>
							</div>
							<div class="sample" v-for="(item,index) in list" :key="index">
								<div class="sample-top">
									<div class="sample-top-left">
										<img :src="item.shop_id.img" alt="" /> {{item.shop_id.shop_name.substr(0,3)+"..."}}
									</div>
									<div class="sample-top-right">
										<p>任务编号：<b>{{item.task_number}} [ <a href="javascript:void (0)" @click="view(item.id)">查看详情</a> ]</b></p>
										<p>发布时间：<b>{{item.publish_time}}</b></p>
										<p>任务类型：<strong>{{item.task_type}}</strong></p>
									</div>
								</div>
								<div class="sample-center">
									<img onerror="imgError(this)" :src="url+item.goods_id[0].pc_img" alt="" />
									{{item.goods_id[0].name}}
									<div class="center-btn">
										<el-button type="warning" size="small" class="el-button" v-if="item.status==1" @click="goToPay(item.id)"><i class="el-icon-d-arrow-right"></i> 继续发布
										</el-button>
										<el-button type="warning" size="small" class="el-button" v-if="item.nums==1" @click="goToCancel(item.id)"> 取消
										</el-button>
										<el-button type="warning" size="small" class="el-button" v-if="item.status >= 3 && item.status != 4 && item.is_shengji==2" @click="goTo(item.id)"> 一键发布
										</el-button>
									</div>
								</div>
								<div class="sample-bottm">
									<div>
										<p>任务状态:<b>{{item.status_type}}</b></p>
										<p>进行中:(<b>{{item.jxz}}</b>)</p>
										<p>待发货:(<b>{{item.dfh}}</b>)</p>
										<p>待收货:(<b>{{item.dsh}}</b>)</p>
										<p>待返款:(<b>{{item.dfk}}</b>)</p>
										<p>已完成:(<b>{{item.ywc}}</b>)</p>
										<p>未接:(<b>{{item.incomplete_num}}</b>)</p>
									</div>
									<div>
										<p>押金:<b>{{item.deposit}}</b>元</p>
										<p>银锭:<b>{{item.silver_ingot}}</b>银锭</p>
									</div>
								</div>
							</div>
							<!-- 分页 -->
							<div class="fenye">
								<el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="currentPage"
															 :page-sizes="sizes" :page-size="info.size" layout="total, sizes, prev, pager, next, jumper" :total="total"
															 background>
								</el-pagination>
							</div>
						</div>
					</div>

				</div>
				<el-dialog title="提示" :visible.sync="type" width="700px">
					<span>
						<p>关于平台特色</p> 
						 <p>★☆★☆★☆★☆★</p>
						<p>【一】物流篇</p>
						<p>1.有些喜欢操作拍a发b的商家可以换来这边啦！大大减少您的营销成本及人力成本.一切我们包！礼物免费送！</p>
						<p>2.真实物流真实包裹在快递环节解决您所有后顾之忧！</p>
						<p>【二】风控篇</p>
						<p>平台买手均一证一号，自有验号渠道从包括但不仅限于芝麻信用、淘气值、账号消费比重等维度评估，确保每一个买号都是自用买号。且平台秉承一周一小检，一月一大查的力度过滤买号环境，尽可能的对于黑化买号早发现早处理...对于新买手的引进力度，我们只能说：只要资源足够好，要多少钱给多少 。</p>
						<p>【三】财务篇</p>
						<p>商家银行卡的变更需要经过客服人工审核（店铺主旺旺对暗号），保证您的资金安全，避免运营人员更替之后的平台财务风险。为确保一证一号，买家绑定的银行卡须与其买号所绑定的支付宝姓名一致.......平台对补单过程中的资金安全承担责任，如遇到恶意工作室退款、售后...在商家配合我们的前提下，平台承担损失...我们历史上已经成功击退很多批恶意退款工作室.有效保障了商家的合理利益。</p>
						<p>【四】服务篇</p>
						<p>平台数十个客服9-23点全天候确保您的售前、售后能得到快速保障.工作时间闪电速度响应。</p>
						<p>【五】数据篇</p>
						<p>平台商家、买手数据保留2-3个月，以外数据全部清空.保护商家补单隐私...若平台遭 受不可逆因素打击，我们也有类似一键自毁的功能.将会瞬间清空所有商家、买手的一切资料...请无需担心，关于账户注册信息及财务数据由独立隐秘服务器备份保存...届时将有专职人员主动联系您退款之事宜...</p>
						<p>小白兔五年稳定运营，只想做一家佛系小众的补单平台...在商家与买手的支持下，相信未来五年依然会平稳发展，为大家提供优质服务...平台未完善之地方欢迎广大商家、买手积极提议...合理的框架内我们会积极落实！也欢迎有高质量买手资源的伙伴来洽谈合作...先定一个调！资源好，五五开起步！提醒：补单如劲酒，且莫要贪杯...警告：这里只是避风港不是安全屋.补单有风险，被查要认命！</p>
					</span>
					<span slot="footer" class="dialog-footer">
					<el-button @click="lookMsgDo()">不在提示</el-button>
					<el-button type="primary" @click="type= false">关闭</el-button>
				  </span>
				</el-dialog>

			</div>
			<script type="text/javascript">
				$(function() {
					/* 为element-ui组件提供数据绑定和事件 */
					var vm = new Vue({
						el: ".right",
						data: function() {
							return {
								// /* 待处理数据 */
								// activeName: "first",
								// /* 下拉选项卡数据 */
                                url:'http://tfkzpic.oss-cn-hangzhou.aliyuncs.com',
								info:{
									shop_id:'',
									task_type:'',
									searchTime:'',
									terminal:'',
									order_number:'',
									search:'',
									min_price:'',
									max_price:'',
									size:10,
									page:1,
									is_day:0,
									status:0,
								},
								shop:{},
								taskType: ["全部","文字好评","淘口令","二维码","直通车","通道任务"],
								sizes:[5,10,15,20,25],
								total:0,
								list:{},
								zhuangtai: '待付款', //状态
								activeName: 'first', //默认选项卡第一
								multipleTable: true,
								isActive: true,
								tabId: 0,
								type:false,
							}
						},
						created:function(){
							that = this;
							this.getShop();
							this.getData();
							this.getMsg();
						},
						methods: {
							getShop:function(){
								$.post("<?php echo url('task/shop'); ?>",{},function(res){
									if(res.code==1){
										that.shop = res.data;
									}else{
										layer.msg('网络错误',{icon:2});
									}
								})
							},
							getMsg:function(){
								$.post("<?php echo url('index/lookMsg'); ?>",{},function(res){
									if(res.code==1){
										that.type = true;
									}
								})
							},
							lookMsgDo:function(){
								$.post("<?php echo url('index/lookMsgDo'); ?>",{},function(res){
									if(res.code==1){
										that.type = false;
									}
								})
							},
							chongzi:function(){
								location.href = "<?php echo url('recharge/recharge'); ?>";
							},
							cash:function(){
								location.href = "<?php echo url('recharge/cash'); ?>";
							},
							recommend:function(){
								location.href = "<?php echo url('recommend/index'); ?>";
							},
							vip:function(){
								location.href = "<?php echo url('vip/index'); ?>";
							},
							getData:function(){
								var loading = layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
								$.post("<?php echo url('task/getData'); ?>",this.info,function(res){
									console.log(res.data);
									if(res.code==1){
										that.list = res.data.list;
										that.total = res.data.total;
										layer.close(loading);
									}else{
										layer.msg('网络错误',{icon:2});
										layer.close(loading);
									}
								})
							},
							search:function(){
								this.info.page = 1;
								this.info.size = 10;
								this.getData();
							},
							/* 分页事件 */
							handleSizeChange: function(val) {
								this.info.size = val;
								this.info.page = 1;
								this.getData();
							},
							/*分页跳转*/
							handleCurrentChange: function(val) {
								this.info.page = val;
								this.getData();
							},
							// 标签页
							handleClick(tab, event) {
								console.log(tab.index);
								this.zhuangtai = tab.label;
								this.info.is_day=0;
								this.info.page = 1;
								this.info.size = 10;
								if(tab.index==0)this.info.status = 0;
								if(tab.index==1)this.info.status = 1;
								if(tab.index==2)this.info.status = 2;
								if(tab.index==3)this.info.status = 3;
								if(tab.index==4)this.info.status = 4;
								if(tab.index==5)this.info.status = 5;
								if(tab.index==6)this.info.status = 6;
								if(tab.index==7){
									this.info.status = 0;
									this.info.is_day=1;
								}
								this.getData();
							},
							view:function(id){
								window.open("<?php echo url('task/status','','',true); ?>/id/"+id);
							},
							goToPay:function(id){
								window.open("<?php echo url('task/gotopay','','',true); ?>/id/"+id);
							},
							goTo:function(id){
								var that = this;
								this.$confirm('此操作将发布一单同样的订单, 是否继续?', '友情提示', {
									confirmButtonText: '确定',
									cancelButtonText: '取消',
									type: 'warning'
								}).then(function() {
									$.post("<?php echo url('release/release'); ?>",{id:id},function(res){
										if(res.code==1){
											location.href = res.url;
										}else{
											layer.msg(res.msg,{icon:2});
										}
									})
								}).catch(function() {});
							},
							goToCancel:function(id){
								var that = this;
								this.$confirm('此操作将取消该订单, 取消后支付的押金/银锭自动退回账户,是否继续?', '友情提示', {
									confirmButtonText: '确定',
									cancelButtonText: '取消',
									type: 'warning'
								}).then(function() {
									$.post("<?php echo url('task/taskCancel'); ?>",{id:id},function(res){
										if(res.code==1){
											layer.msg('取消成功',{icon:1},function(){
												that.getData();
											});
										}else{
											layer.msg(res.msg,{icon:2});
										}
									})
								}).catch(function() {});
							},

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


