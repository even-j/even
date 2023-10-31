<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"/www/wwwroot/xbt.com/pubic/../application/seller/view/task/pending.html";i:1579141960;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/seller/css/daiChuLi.css" />
<style>
	.el-checkbox {
		margin-right: 30px!important;
	}
	.el-dialog{
		width: 400px!important;
	}
</style>
<div class="right" v-cloak>
	<!-- 基本信息标题 -->
	<div class="right-top">
		<b>个人中心 / 任务情况 /<strong> 待处理任务 </strong></b>
	</div>
	<div class="user_content">
		<div class="line">
			状态:
			<el-select style="width: 200px;" v-model="info.type" @change="handleChangeSelect" placeholder="全部"  size="small">
				<el-option v-for="(item,key) in type" :key="key" :label="item" :value="key"></el-option>
			</el-select>
			店铺:
			<el-select style="width: 200px;" v-model="info.shop_id" placeholder="全部"  size="small">
				<el-option v-for="(item,key) in shop" :key="key" :label="item.shop_name" :value="item.id"></el-option>
			</el-select>
			上传单号时间:
			<el-date-picker class="el_date label3" v-model="info.searchTime" type="daterange" range-separator="至"
											start-placeholder="开始日期" end-placeholder="结束日期" size="small" value-format="yyyy-MM-dd" style="width: 280px!important;">
			</el-date-picker>
			<br>
			<br>
			&nbsp;&nbsp; 订单号:  &nbsp;&nbsp;
			<el-input v-model="info.task_number" placeholder="请输入内容" size="small" style="width: 250px;"></el-input>
			<el-button type="primary" size="small" @click="searchData()"><i class="el-icon-search"></i>搜索</el-button>
			<el-button type="primary" size="small" @click="download()"><i class="el-icon-download"></i></i>导出</el-button>
		</div>
		<!-- 全选 -->
		<!--<div class="select_entile">
			<el-checkbox v-model="checkedAll" @change="handleSelectAll()">全选</el-checkbox>
			<el-button type="danger" size="small" @click="rebates()">批量返款</el-button>
		</div>-->
		<div>
			<div v-if="list.length == 0">
				<div class="no_null">暂无数据</div>
			</div>
			<div class="entile" v-for="(item,index) in list" :key="index">
				<div class="entile-top">
					<span>
						<!--<el-checkbox v-model="item.checked" @change="handleSelectItem"></el-checkbox>-->
						<p>任务编号：<b>{{item.seller_task_id.task_number}}</b>&nbsp;&nbsp;&nbsp; 店铺：<b>{{item.shop}}</b></p>
					</span>
					<a href="javascript:void (0)" @click="view(item.id)" >查看详情</a>
				</div>
				<div class="entile-top">
					<p>子任务编号：<b>{{item.task_number}}</b></p>
					<div>
						<strong>买号： <b> {{item.user_buyno_wangwang}}  </b></strong>&nbsp;&nbsp;&nbsp;
						<strong>状态： <b> {{item.state}} </b></strong>&nbsp;&nbsp;&nbsp;
						<!--<strong>进店方式： <b> {{item.seller_task_id.task_type}} </b></strong>-->
					</div>
					<button type="button"  class='small el-button--danger' @click="returnPay(item.id,item.principal)" v-if="item.state=='待返款'">返款</button>
					<button type="button"  class='small el-button--danger' @click="fahuo(item.id)" v-if="item.state=='待发货' && item.delivery_state==1">发货</button>
					<button type="button"  class='small el-button--danger' @click="zhuiping(item.id)" v-if="item.state=='已完成' && item.is_shengji > 1 && item.is_zp==0">发布追评</button>
				</div>
				<div class="entile-top">
					<p>淘宝订单号：<b>{{item.table_order_id}}</b></p>
					<div>
						<strong>快递：{{item.delivery}}&nbsp;&nbsp;{{item.delivery_num}}</strong>
					</div>
				</div>
				<div class="entile-top">
					<div><p>返款金额：<b>{{item.principal}}</b>元</p></div>
					<div>
						<strong>买手实付金额： <b>{{item.user_principal}}</b>元</strong>&nbsp;&nbsp;&nbsp;
					</div>
					<div>
						<p>创建日期：<b>{{item.create_time}}</b></p>
					</div>
				</div>
				
			</div>
			<div class="fenye">
				<el-pagination @size-change="sizeChange" @current-change="pageChange" :current-page="info.page"
											 :page-sizes="sizes" :page-size="info.size" layout="total, sizes, prev, pager, next, jumper" :total="total"
											 background>
				</el-pagination>
			</div>
		</div>
	</div>
	<el-dialog title="填写返款金额" width="400px" :visible.sync="returnState" >
		<el-form :model="form">
			<el-form-item label="返款金额">
				<el-input v-model="form.price" autocomplete="off"></el-input>
			</el-form-item>
		</el-form>
		<div slot="footer" class="dialog-footer">
			<el-button @click="returnState = false">取 消</el-button>
			<el-button type="primary" @click="returnPayDo()">确 定</el-button>
		</div>
	</el-dialog>
</div>
<script type="text/javascript">
	$(function () {

		/* 初始化一个Vue */
		var vm = new Vue({
			el: ".right",
			data: function () {
				return {
					info:{
						type:'',
						task_number:'',
						shop_id:'',
						searchTime:'',
						page:1,
						size:5,
					},
					shop:[],
					sizes:[5,10,15,20,25],
					total:0,
					type:{
						0:"进行中",
						3: "待发货",
						11: "已录入单号，待确认发货",
						4: "已发货，待买手确认收货",
						5: "买手已收货，待商家返款",
						6: "商家已返款,待买手确认返款",
						1: "已完成",
					},
					list:{},
					returnState:false,
					user_price:'',
					form:{
						id:'',
						price:'',
					},
					checkedAll:false,
				}
			},
			created:function(){
				that = this;
				this.getShop();
				this.getData();
			},
			methods: {
				getData:function(){
					var loading = layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
					$.post("<?php echo url('task/getUserTask'); ?>",this.info,function(res){
						if(res.code==1){
							that.list = res.data.list;
							that.total = res.data.total;
							layer.close(loading);
						}else{
							layer.msg('网络错误！',{icon:2});
							layer.close(loading);
						}
					})
				},
				getShop:function(){
					$.post("<?php echo url('task/shop'); ?>",{},function(res){
						if(res.code==1){
							that.shop = res.data;
						}else{
							layer.msg('网络错误！',{icon:2});
						}
					})
				},
				zhuiping:function(id){
					window.open("<?php echo url('review/index','','',true); ?>/id/"+id);
				},
				sizeChange:function(val){
					this.info.size = val;
					this.info.page = 1;
					this.getData();
				},
				pageChange:function(val){
					this.info.page = val;
					this.getData();
				},
				searchData:function(){
					this.info.size = 5;
					this.info.page = 1;
					console.log(12312);
					this.getData();
				},
				view:function(id){
					location.href = "<?php echo url('task/detail','','',true); ?>/id/"+id;
				},

				handleChangeSelect:function(){
					console.log(this.info.type);
				},
				/* 全选 */
				handleSelectAll: function() {
					for (var i = 0; i < this.list.length; i++) {
						this.list[i].checked = this.checkedAll;
					}
				},
				/* 单选 */
				handleSelectItem: function() {
					for (var i = 0; i < this.list.length; i++) {
						if (!this.list[i].checked) {
							this.checkedAll = false;
							return false;
						}
					}
					this.checkedAll = true;
				},
				returnPay: function(id,price){
					this.form.id = id;
					this.user_price = price;
					this.form.price = '';
					this.returnState=true;
				},
				returnPayDo: function(){
					var that = this;
					if(this.form.price < (this.user_price * 0.8))return layer.msg('返款金额向下只能在预付金额20%浮动！',{icon:2,time:2500});
					$.post("<?php echo url('task/returnPay'); ?>",this.form,function(res){
						if(res.code==1){
							layer.msg(res.msg,{icon:1},function(){
								that.returnState=false;
								that.getData();
							});
						}else{
							layer.msg(res.msg,{icon:2},function(){
								that.getData();
							});
						}
					})
				},
				fahuo:function(id){
					$.post("<?php echo url('task/fahuo'); ?>",{id:id},function(res){
						if(res.code==1){
							layer.msg(res.msg,{icon:1},function(){
								that.getData();
							});
						}else{
							layer.msg(res.msg,{icon:2},function(){
								that.getData();
							});
						}
					})
				},
				download:function () {
					var start = "";
					var end = "";
					if(this.searchTime){
						start = this.searchTime[0];
						end = this.searchTime[1];
					}else{
						start = 0;
						end = 0;
					}
					window.open("<?php echo url('task/excel','','',false); ?>/start/"+start+"/end/"+end+"/type/"+this.info.type);
				},


				rebates: function(){
					var ids = [];
					for (var i = 0; i < this.list.length; i++) {
						if (this.list[i].checked) {
							ids.push(this.list[i].id);
						}
					}
					if(ids.length <= 0)return layer.msg('请选择要返款的订单！',{icon:2});
					$.post("<?php echo url('task/allReturnPay'); ?>",{ids:ids},function(res){
						if(res.code==1){
							layer.msg(res.msg,{icon:1},function(){
								this.returnState=false;
								location.reload();
							});
						}else{
							layer.msg(res.msg,{icon:2},function(){
								location.reload();
							});
						}
					})
				}
			},
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
