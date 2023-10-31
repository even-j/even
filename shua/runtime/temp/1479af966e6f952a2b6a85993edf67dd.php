<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/www/wwwroot/xbt.com/pubic/../application/seller/view/review/task.html";i:1593527126;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/seller/css/daFuKuan.css" />
<div class="right" v-cloak>
	<!-- 基本信息标题 -->
	<div class="right-top">
		<b>个人中心 / 追评任务 /<strong> 任务列表 </strong></b>
	</div>
	<div class="user_content">
		<!-- 任务管理 -->
		<div class="renwuguanli_box">
			<!-- 任务管理标题 -->
			<div class="renwuguanli">
				<div class="renwuguanli_item">
					<a href="javascript:;" class="renwuguanli_item_select">任务管理</a>
				</div>
			</div>
			<!-- 选项卡第一行 -->
			<div class="select_row_one">
				<p> 店铺:</p>
				<el-select class="el_select label2" v-model="info.shop_id" clearable placeholder="全部" size="small">
					<el-option v-for="(item,key) in shop" :key="key" :label="item.shop_name" :value="item.id">
					</el-option>
				</el-select>
				<p>任务状态:</p>
				<el-select class="el_select label6" v-model="info.type" clearable placeholder="全部" size="small">
					<el-option label="未支付" value=0></el-option>
					<el-option label="已支付" value=1></el-option>
					<el-option label="已审核" value=2></el-option>
					<el-option label="已上传好评截图" value=3></el-option>
					<el-option label="已完成" value=4></el-option>
					<el-option label="已取消" value=5></el-option>
					<el-option label="已拒接" value=6>
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
				<el-button type="primary" size="small" @click="search()"><i class="el-icon-search"></i> 搜索</el-button>
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
								<img onerror="imgError(this)" :src="item.shop_id.img" alt="" /> {{item.shop_id.shop_name.substr(0,3)+"..."}}
							</div>
							<div class="sample-top-right">
								<p>任务编号：<b>{{item.task_number}} [ <a href="javascript:void (0)" @click="view(item.id)">查看详情</a> ]</b></p>
								<p>发布时间：<b>{{item.create_time}}</b></p>
								<p>旺旺号：<strong>{{item.buy_id}}</strong></p>
							</div>
						</div>
						<div class="sample-center">
							<img onerror="imgError(this)" :src="url+item.goods.pc_img" alt="" />
							{{item.goods.name}}
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
								<p>任务状态:<b>{{item.state}}</b></p>
								<p>买手支付金额:<b>{{item.pay_price}}</b></p>
								<p>淘宝单号:<b>{{item.taobao_number}}</b></p>
							</div>
							<div>
								<p>商家支付:<b>{{item.money}}</b>元/银锭</p>
							</div>
						</div>
					</div>
					<!-- 分页 -->
					<div class="fenye">
						<el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange" :current-page="info.page"
						 :page-sizes="sizes" :page-size="info.size" layout="total, sizes, prev, pager, next, jumper" :total="total"
						 background>
						</el-pagination>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
<script type="text/javascript">
	$(function() {
		/* 初始化一个Vue */
		var vm = new Vue({
			el: ".right",
			data: function() {
				return {
                    url:'http://tfkzpic.oss-cn-hangzhou.aliyuncs.com',
					info:{
						shop_id:'',
						type:'',
						searchTime:'',
						terminal:'',
						search:'',
						order_number:'',
						size:10,
						page:1,
						is_day:0,
						status:0,
					},
					shop:{},
					sizes:[5,10,15,20,25],
					total:0,
					list:{},
				}
			},
			created:function(){
				that = this;
				this.getShop();
				this.getData();
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
				getData:function(){
					var loading = layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
					$.post("<?php echo url('review/getTaskData'); ?>",this.info,function(res){
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
				view:function(id){
					window.open("<?php echo url('review/view','','',true); ?>/id/"+id);
				},
				goToPay:function(id){
					window.open("<?php echo url('review/pay','','',true); ?>/id/"+id);
				},
				goToCancel:function(id){
					var that = this;
					this.$confirm('此操作将取消该订单, 取消后支付的押金/银锭自动退回账户,是否继续?', '友情提示', {
						confirmButtonText: '确定',
						cancelButtonText: '取消',
						type: 'warning'
					}).then(function() {
						$.post("<?php echo url('review/taskCancel'); ?>",{id:id},function(res){
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
			},
		})
	})
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
