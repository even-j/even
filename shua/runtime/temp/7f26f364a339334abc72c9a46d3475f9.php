<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"/www/wwwroot/xbt.com/pubic/../application/seller/view/shop/shop.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/seller/css/management.css" />
<style>
	table{
		border-collapse: collapse;
		border: none;
	}
	table td{
		border: solid #eeeeee 1px;
	}
	.el-message-box{
		min-width: 350px!important;
	}
</style>
			<div class="right">
				<div class="right-top">
					<b>个人中心 / 店铺管理 /<strong> {{taoBaoDianPu}} </strong></b>
				</div>
				<div class="slider" v-cloak>
					<el-tabs v-model="activeName" @tab-click="handleClick">
						<el-tab-pane label="淘宝店铺" name="taobao" >
							<!--<el-button type="primary"><i class="el-icon-plus"></i> 添加淘宝店铺</el-button>-->
							<div class="list-shop" v-for="(item,key) in list" v-if="item.type==1">
								<div class="list-left">
									<p><b>店铺名称：</b><strong>{{item.shop_name}}</strong></p>
									<p><b>店铺链接：</b><a :href=item.link target="_blank">查看店铺</a></p>
									<p><b>店铺旺旺ID：</b><strong>{{item.wangwang}}</strong></p>
								</div>
								<div class="list-right">
									<p><b>发件人信息：</b><strong>{{item.name}} : {{item.mobile}}</strong></p>
									<p><b>发件地址：</b><strong>{{item.province}} {{item.city}} {{item.area}} {{item.address}}</strong></p>
									<p>
										<b>审核状态：</b>
										<i v-if="item.state==0">待审核</i>
										<i class="green" v-if="item.state==1">审核通过</i>
										<i class="red" v-if="item.state==2">审核拒绝</i>
										<a href="javascript:void(0)" class="why" v-if="item.state==2" @click="viewCause(item.cause)">查看原因</a>
									</p>
								</div>
								<div>
									<el-button type="primary"  @click="edit(item)" size="small"><i class="el-icon-edit"></i> 修改</el-button>
								</div>
							</div>
						</el-tab-pane>
						<el-tab-pane label="天猫店铺" name="tianmao" >
							<!--<el-button type="primary" @click = 'tiaozhuan'><i class="el-icon-plus"></i> 添加淘宝店铺</el-button>-->
							<div class="list-shop" v-for="(item,key) in list" v-if="item.type==2">
								<div class="list-left">
									<p><b>店铺名称：</b><strong>{{item.shop_name}}</strong></p>
									<p><b>店铺链接：</b><a :href=item.link target="_blank">查看店铺</a></p>
									<p><b>店铺旺旺ID：</b><strong>{{item.wangwang}}</strong></p>
								</div>
								<div class="list-right">
									<p><b>发件人信息：</b><strong>{{item.name}} : {{item.mobile}}</strong></p>
									<p><b>发件地址：</b><strong>{{item.province}} {{item.city}} {{item.area}} {{item.address}}</strong></p>
									<p>
										<b>审核状态：</b>
										<i v-if="item.state==0">待审核</i>
										<i class="green" v-if="item.state==1">审核通过</i>
										<i class="red" v-if="item.state==2">审核拒绝</i>
										<a href="javascript:void(0)" class="why" v-if="item.state==2" @click="viewCause(item.cause)">查看原因</a>
									</p>
								</div>
								<div>
									<el-button type="primary"  @click="edit(item)" size="small"><i class="el-icon-edit"></i> 修改</el-button>
								</div>
							</div>
						</el-tab-pane>
						<el-tab-pane label="飞猪店铺" name="feizhu" >
							<!--<el-button type="primary" @click = 'tiaozhuan()'><i class="el-icon-plus"></i> 添加淘宝店铺</el-button>-->
							<div class="list-shop" v-for="(item,key) in list" v-if="item.type==3">
								<div class="list-left">
									<p><b>店铺名称：</b><strong>{{item.shop_name}}</strong></p>
									<p><b>店铺链接：</b><a :href=item.link target="_blank">查看店铺</a></p>
									<p><b>店铺旺旺ID：</b><strong>{{item.wangwang}}</strong></p>
								</div>
								<div class="list-right">
									<p><b>发件人信息：</b><strong>{{item.name}} : {{item.mobile}}</strong></p>
									<p><b>发件地址：</b><strong>{{item.province}} {{item.city}} {{item.area}} {{item.address}}</strong></p>
									<p>
										<b>审核状态：</b>
										<i v-if="item.state==0">待审核</i>
										<i class="green" v-if="item.state==1">审核通过</i>
										<i class="red" v-if="item.state==2">审核拒绝</i>
										<a href="javascript:void(0)" class="why" v-if="item.state==2" @click="viewCause(item.cause)">查看原因</a>
									</p>
								</div>
								<div>
									<el-button type="primary"  @click="edit(item)" size="small"><i class="el-icon-edit"></i> 修改</el-button>
								</div>
							</div>
						</el-tab-pane>
						<el-tab-pane label="绑定店铺" name="bangding">
							<table border="0" cellpadding="0" cellspacing="0" class="indorms">
								<tr>
									<td style="width:13%;">店铺链接：</td>
									<td colspan="3">
										<el-input v-model="form.link" placeholder="请输入内容" style='width: 496px;' size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">店铺类型：</td>
									<td colspan="3">
										<div class="radio">
											<el-radio v-model="form.type" label="1" size="medium"><img src="/static/seller/img/taobao.png" class="taobao"> 淘宝</el-radio>
											<el-radio v-model="form.type" label="2" size="medium"><img src="/static/seller/img/tianmao.png" class="taobao"> 天猫</el-radio>
											<el-radio v-model="form.type" label="3" size="medium"><img src="/static/seller/img/feizhu.png" class="taobao"> 飞猪</el-radio>
										</div>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">店铺名称：</td>
									<td>
										<el-input v-model="form.shop_name" placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
									<td style="width:13%;">店主旺旺号：</td>
									<td>
										<el-input v-model=form.wangwang placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">发件人姓名：</td>
									<td>
										<el-input v-model=form.name placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
									<td style="width:13%;">发件人手机：</td>
									<td>
										<el-input v-model=form.mobile placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">发件地址：</td>
									<td colspan="3">
										<el-select v-model="form.province" @change="chooseProvince" placeholder="请选择省份" size="small" style='width: 180px;'>
											<el-option v-for="item in provinceList" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
										<el-select v-model="form.city" @change="chooseCity" placeholder="请选择城市" size="small" style='width: 180px;'>
											<el-option v-for="item in cityList" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
										<el-select v-model="form.area" @change="chooseBlock" placeholder="请选择地区" size="small" style='width: 180px;'>
											<el-option v-for="item in blockList" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
									</td>


								</tr>
								<tr>
									<td style="width:13%;">详细地址：</td>
									<td colspan="3">
										<el-input v-model=form.address placeholder="请输入内容" size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">发货仓：</td>
									<td colspan="3">
										<el-select v-model="form.code" placeholder="请选择" size="small">
											<el-option
													v-for="item in delivery"
													:key="item.id"
													:value="item.name">
												<el-popover
														placement="top-start" v-if="item.remarks"
														width="200"
														trigger="hover"
														:content="item.remarks">
													<span slot="reference">{{item.name}}</span>
												</el-popover>
											</el-option>
										</el-select>
									</td>
								</tr>
							</table>
							<div class="save">
								<el-button type="danger" style='width: 200px;' @click="submit()">保存</el-button>
							</div>
							<div class="attention">
								<h4><i class="el-icon-info"></i>请注意：</h4>
								<p>1、每个账号可绑定淘宝、天猫、飞猪三大平台，总共最多可绑定8个店铺（绑定的店铺永久有效）</p>
								<p>2、邀请好友只能是朋友，亲戚，同事，熟人等等，一律不可向陌生人发送邀请链接，邀请进小白兔注册做任务</p>
							</div>
						</el-tab-pane>
						<el-dialog title="编辑店铺信息" :visible.sync="dialogTableVisible">
							<table border="1" cellpadding="0" bordercolor="#eee" cellspacing="0" class="indorms">
								<tr>
									<td style="width:13%;">店铺链接：</td>
									<td colspan="3">
										<el-input v-model=formEdit.link placeholder="请输入内容" style='width: 496px;' size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">店铺类型：</td>
									<td colspan="3">
										<div class="radio">
											<el-radio v-model="formEdit.type" label="1" size="medium"><img src="/static/seller/img/taobao.png" class="taobao"> 淘宝</el-radio>
											<el-radio v-model="formEdit.type" label="2" size="medium"><img src="/static/seller/img/tianmao.png" class="taobao"> 天猫</el-radio>
											<el-radio v-model="formEdit.type" label="3" size="medium"><img src="/static/seller/img/tianmao.png" class="taobao"> 飞猪</el-radio>
										</div>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">店铺名称：</td>
									<td>
										<el-input v-model="formEdit.shop_name" placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
									<td style="width:13%;">店主旺旺号：</td>
									<td>
										<el-input v-model="formEdit.wangwang" placeholder="请输入内容" style='width: 298px;' size="small" readonly></el-input>
										<p style="font-size: 12px;color: red">*店铺旺旺号不能修改</p>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">发件人姓名：</td>
									<td>
										<el-input v-model="formEdit.name" placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
									<td style="width:13%;">发件人手机：</td>
									<td>
										<el-input v-model="formEdit.mobile" placeholder="请输入内容" style='width: 298px;' size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">发件地址：</td>
									<td colspan="3">
										<el-select v-model="formEdit.province" @change="chooseProvince2" placeholder="请选择省份" size="small" style='width: 180px;'>
											<el-option v-for="item in provinceList" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
										<el-select v-model="formEdit.city" @change="chooseCity2" placeholder="请选择城市" size="small" style='width: 180px;'>
											<el-option v-for="item in cityList" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
										<el-select v-model="formEdit.area" @change="chooseBlock2" placeholder="请选择地区" size="small" style='width: 180px;'>
											<el-option v-for="item in blockList" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">详细地址：</td>
									<td colspan="3">
										<el-input v-model="formEdit.address" placeholder="请输入内容" size="small"></el-input>
									</td>
								</tr>
								<tr>
									<td style="width:13%;">发货仓：</td>
									<td colspan="3">
										<el-select v-model="formEdit.code" placeholder="请选择" size="small">
											<el-option
													v-for="item in delivery"
													:key="item.id"
													:value="item.name">
												<el-popover v-if="item.remarks"
														placement="top-start"
														width="200"
														trigger="hover"
														:content="item.remarks">
													<span slot="reference">{{item.name}}</span>
												</el-popover>
											</el-option>
										</el-select>
									</td>
								</tr>
							</table>
							<div class="save">
								<el-button type="danger" style='width: 200px;' @click='editDo()'>保存</el-button>
							</div>
						</el-dialog>
					</el-tabs>
				</div>
			</div>
<script>
	$(function(){
		var vm = new Vue({
			el: ".right",
			data: function() {
				return {
					activeName: '<?php echo $str; ?>', //默认淘宝
					radio2: '',
					/* 省市区地址 */
					mapJson: "/static/seller/json/map.json",
					provinceList: [],
					cityList: [],
					blockList: [],
					newCity: [],
					newBlock: [],
					taoBaoDianPu: "淘宝店铺", //淘宝店铺名称
					list:[],
                    delivery:[],
					form:{
						wangwang:'',
						province:'',
						city:'',
						area:'',
						shop_name:'',
						link:'',
						name:'',
						type:'',
						mobile:'',
						address:'',
						code:'',
					},
					formEdit:{
						wangwang:'',
						province:'',
						city:'',
						area:'',
						shop_name:'',
						link:'',
						name:'',
						type:'',
						mobile:'',
						address:'',
						code:'',
					},
					dialogTableVisible:false,
				}
			},
			created:function(){
				this.getData();
				this.getDelivery();
			},
			methods: {
				getData:function(){
					var that=this;
					var loadingFlag;
					loadingFlag= layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
					$.post("<?php echo url('shop/shop'); ?>",{},function(res){
						if(res.code==1){
							that.list=res.data;
							layer.close(loadingFlag);
						}else{
							layer.close(loadingFlag);
							layer.msg(res.msg,{icon:1,time:2000});
						}
					})
				},
                getDelivery:function(){
				    console.log(111);
					var that=this;
					$.post("<?php echo url('shop/getDelivery'); ?>",{},function(res){
						if(res.code==1){
							that.delivery=res.msg;
							console.log(that.delivery);
						}else{
							layer.msg(res.msg,{icon:1,time:2000});
						}
					})
				},
				tiaozhuan(e){
					// console.log(e)
				},
				//变换label
				handleClick(tab, event) {
					// console.log(tab.index);
            if(tab.index==3){
                this.cityList = [];
                this.blockList = [];
            }
					this.taoBaoDianPu = tab.label;
				},
				/* 省市区三级联动方法 */
				// 获取json数据,三级联动
				getCityData: function() {
					var that = this;
					axios.get(this.mapJson).then(function(response) {
						if (response.status === 200) {
							var data = response.data;
							// 省市区数据分类
							for (var item in data) {
								if (item.match(/0000$/)) {
									that.provinceList.push({
										id: item,
										value: data[item],
										children: []
									});
								} else if (item.match(/00$/)) {
									that.newCity.push({
										id: item,
										value: data[item],
										children: []
									});
								} else {
									that.newBlock.push({
										id: item,
										value: data[item]
									});
								}
							}
							// 分类市级
							for (var index in that.provinceList) {
								for (var index1 in that.newCity) {
									if (that.provinceList[index].id.slice(0, 2) === that.newCity[index1].id.slice(0, 2)) {
										that.provinceList[index].children.push(that.newCity[index1]);
									}
								}
							}
							// 分类区级
							for (var item1 in that.newCity) {
								for (var item2 in that.newBlock) {
									if (that.newBlock[item2].id.slice(0, 4) === that.newCity[item1].id.slice(0, 4)) {
										that.newCity[item1].children.push(that.newBlock[item2]);
									}
								}
							}
						} else {
							// console.log(response.status);
						}
					}).catch(function(error) {
						// console.log(typeof + error);
					})
				},
				// 选省
				chooseProvince: function(e) {
					for (var index2 in this.provinceList) {
						if (e === this.provinceList[index2].id) {
							this.form.province = this.provinceList[index2].value;
							this.cityList = this.provinceList[index2].children;
							this.form.city = this.provinceList[index2].children[0].value;
							this.blockList = this.provinceList[index2].children[0].children;
							this.form.area = this.provinceList[index2].children[0].children[0].value;
						}
					}
					console.log(this.form.province);
				},
				// 选市
				chooseCity: function(e) {
					for (var index3 in this.newCity) {
						if (e === this.newCity[index3].id) {
							this.form.city = this.newCity[index3].value;
							this.blockList = this.newCity[index3].children;
							this.form.area = this.newCity[index3].children[0].value;
						}
					}
					console.log(this.form.city);
				},
				// 选区
				chooseBlock: function(e) {
					for (var index4 in this.newBlock) {
						if (e === this.newBlock[index4].id) {
							this.form.area = this.newBlock[index4].value;
						}
					}
					console.log(this.form.area);
				},
				// 选省
				chooseProvince2: function(e) {
					for (var index2 in this.provinceList) {
						if (e === this.provinceList[index2].id) {
							this.formEdit.province = this.provinceList[index2].value;
							this.cityList = this.provinceList[index2].children;
							this.formEdit.city = this.provinceList[index2].children[0].value;
							this.blockList = this.provinceList[index2].children[0].children;
							this.formEdit.area = this.provinceList[index2].children[0].children[0].value;
						}
					}
					console.log(this.cityList);
				},
				// 选市
				chooseCity2: function(e) {
					for (var index3 in this.newCity) {
						if (e === this.newCity[index3].id) {
							this.formEdit.city = this.newCity[index3].value;
							this.blockList = this.newCity[index3].children;
							this.formEdit.area = this.newCity[index3].children[0].value;
						}
					}
					console.log(this.form.city);
				},
				// 选区
				chooseBlock2: function(e) {
					for (var index4 in this.newBlock) {
						if (e === this.newBlock[index4].id) {
							this.formEdit.area = this.newBlock[index4].value;
						}
					}
					console.log(this.form.area);
				},
				submit:function () {
					if(!this.form.link)return layer.msg("请填写店铺链接",{icon:2});
					if(!this.form.type)return layer.msg("请选择店铺类型",{icon:2});
					if(!this.form.shop_name)return layer.msg("请填写店铺名称",{icon:2});
					if(!this.form.name)return layer.msg("请填写发货人",{icon:2});
					if(!this.form.mobile)return layer.msg("请填写发货手机号",{icon:2});
					if(!this.form.wangwang)return layer.msg("请填写旺旺号",{icon:2});
					if(!this.form.province || !this.form.city || !this.form.area)return layer.msg("请选择发货地址",{icon:2});
					if(!this.form.address)return layer.msg("请填写发货详细地址",{icon:2});
					if(!this.form.code)return layer.msg("请选择发货仓",{icon:2});
					$.post("<?php echo url('shop/shopAdd'); ?>",this.form,function(res){
							if(res.code==1){
								return layer.msg(res.msg,{icon:1},function () {
									location.reload();
								});
							}else{
								return layer.msg(res.msg,{icon:2});
							}
					})
				},
				edit:function (item) {
					this.dialogTableVisible = true;
					this.formEdit = item;
					this.formEdit.type=String(this.formEdit.type);
					console.log(this.formEdit.type);
				},
				editDo:function () {
            if(!this.formEdit.link)return layer.msg("请填写店铺链接",{icon:2});
            if(!this.formEdit.type)return layer.msg("请选择店铺类型",{icon:2});
            if(!this.formEdit.shop_name)return layer.msg("请填写店铺名称",{icon:2});
            if(!this.formEdit.name)return layer.msg("请填写发货人",{icon:2});
            if(!this.formEdit.mobile)return layer.msg("请填写发货手机号",{icon:2});
            if(!this.formEdit.wangwang)return layer.msg("请填写旺旺号",{icon:2});
            if(!this.formEdit.province || !this.formEdit.city || !this.formEdit.area)return layer.msg("请选择发货地址",{icon:2});
            if(!this.formEdit.address)return layer.msg("请填写发货详细地址",{icon:2});
					if(!this.formEdit.code)return layer.msg("请选择发货仓",{icon:2});
            $.post("<?php echo url('shop/shopEdit'); ?>",this.formEdit,function(res){
                if(res.code==1){
                    return layer.msg(res.msg,{icon:1},function () {
                        location.reload();
                    });
                }else{
                    return layer.msg(res.msg,{icon:2});
                }
            })
				},
				viewCause:function(cause){
						this.$alert(cause, '原因');
				},
			}
		});

		vm.getCityData();
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
