<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/www/wwwroot/xbt.com/pubic/../application/seller/view/goods/index.html";i:1593440428;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/seller/css/myGoods.css" />
<style>
</style>
<div class="right">
	<!-- 基本信息标题 -->
	<div class="right-top">
		<b>个人中心 / 商品管理 /<strong> 商品列表 </strong></b>
	</div>
	<div class="user_content" v-cloak>
		<el-button type="primary"  @click="addGoods()" style="margin-bottom: 30px"><i class="el-icon-plus"></i> 添加商品</el-button>
		<div class="user_content_top">
			<!-- 选项 -->
			<el-form :inline="true" class="demo-form-inline">
				<el-form-item label="平台">
					<el-select v-model="platform" placeholder="全部" size="medium" style='width: 100px;'>
						<el-option label="全部" :value=0></el-option>
						<el-option label="淘宝" :value=1></el-option>
						<el-option label="天猫" :value=2></el-option>
						<el-option label="飞猪" :value=3></el-option>
					</el-select>
				</el-form-item>
				<el-form-item label="店铺">
					<el-select v-model="shop" placeholder="全部" size="medium" style='width: 149px;'>
						<el-option label="全部" :value=0></el-option>
						<el-option :label="item.shop_name" :value=item.id v-for="(item,key) in shops" :key="key"></el-option>
					</el-select>
				</el-form-item>
				<el-form-item>
					<el-input v-model="word" placeholder="请输入商品名搜索" size="medium" style='width:158px;'></el-input>
				</el-form-item>
				<el-form-item>
					<el-button type="primary" size="small" @click="search()"><i class="el-icon-search"></i> 搜索</el-button>
				</el-form-item>
			</el-form>
		</div>
		<!-- 表格 -->
		<div class="topHeader_s">
			<div style="width: 450px;">商品信息</div>
			<div style="width: 180px;">搜索价格</div>
			<div style="width: 200px;">操作</div>
		</div>
		<!-- 数组 -->
		<div >
			<div style="margin-bottom: 10px;" v-for="(item,index) in list" :key="index">
				<div class="goodsCommon">
					<table class="goodTable" border="0" cellspacing="0">
						<tr>
							<td colspan="2" style="width:800px;">
								<strong>
									<img :src="item.pic" class="iconImg" />&nbsp;{{item.type}}店铺：<span>{{item.shop_name}}</span>
								</strong>
							</td>
							<td style="width: 250px;border-bottom:1px solid #eee;text-align: center">
								<el-button type="danger" size="mini"  @click="delGoods(item.id)">删除</el-button>
							</td>
						</tr>
						<tr>
							<td class="td-one">
								<img onerror="imgError(this)" class="goodsPicture" alt="" :src="url+item.pc_img">&nbsp;&nbsp;
								<p class="titles">{{item.name}}</p>
							</td>
							<td style="width:130px;text-align:left;padding-left:20px ;"><span style="color: red;">{{item.show_price}} 元</span></td>
							<td>
								<div style="text-align: center!important;">
									<el-button type="primary" plain size="small" @click="edit(item.id)">编辑</el-button>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- 页数 -->
		<div class="hang">
			<el-pagination
							background
							:current-page="page"
							@current-change="pageChange"
							@size-change="sizeChange"
							:page-sizes="sizes"
							:page-size="size"
							layout="total, sizes, prev, pager, next, jumper"
							:total="total">
			</el-pagination>
		</div>

	</div>
</div>
<link rel="stylesheet" href="/static/seller/css/main.css">
<script src="/static/seller/js/app.js"></script>
<script type="text/javascript">
$(function() {

	/* 初始化一个Vue */
	var vm = new Vue({
		el: ".right",
		data: function() {
			return {
				shops:{},
				list:[],
				sizes:[5,10,15,20,25],
				size:5,
				total:0,
				page:1,
				platform: 0, //平台
				shop: 0, //店铺
				min_price: '', //最低价
				max_price: '', //最高价
				word: '', //搜索
				url:'http://tfkzpic.oss-cn-hangzhou.aliyuncs.com',
			}
		},
		created:function(){
			this.getData();
		},
		methods: {
			getData:function(){
				var loadingFlag= layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
				var that = this;
				$.post("<?php echo url('goods/index'); ?>", {shop:this.shop,size:this.size,page:this.page,type:this.platform,min_price:this.min_price,max_price:this.max_price,word:this.word},function(res){
					if(res.code==1){
						that.shops = res.data.shop;
						that.total = res.data.total;
						that.list = res.data.list;
						layer.close(loadingFlag);
					}else{
						layer.close(loadingFlag);
						layer.msg('网络错误',{icon:2,time:2000});
					}
				});
			},
			search:function(){
				this.getData();
			},
			pageChange:function(val){
				this.page = val;
				this.getData();
			},
			sizeChange:function(val){
				this.page = 1;
				this.size = val;
				this.getData();
			},
			//添加
			addGoods:function(code){
				app.openSidebar({
					title: '商品添加',
					area: ['1000px','600px'],
					url:'<?php echo url("goods/goods"); ?>',
				});
			},
			edit:function(id){
				app.openSidebar({
					title: '商品编辑',
					area: ['1000px', '600px'],
					url:'<?php echo url("goods/edit","","",true); ?>/id/'+id,
				});
			},
			delGoods:function(id){
				var that = this;
				$.post("<?php echo url('goods/del'); ?>",{id:id},function(res){
					if(res.code==1){
						layer.msg(res.msg,{icon:1,time:2000},function(){
							that.getData();
						});
					}else{
						layer.msg('网络错误',{icon:2,time:2000});
					}
				});
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
