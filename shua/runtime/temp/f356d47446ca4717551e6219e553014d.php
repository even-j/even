<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"/www/wwwroot/xbt.com/pubic/../application/seller/view/index/bank.html";i:1593528954;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
	<link rel="stylesheet" type="text/css" href="/static/seller/css/zhangHaoTiXian.css"/>
		<!-- 右边盒子部分 -->
		<div class="right">
			<!-- 基本信息标题 -->
			<div class="right-top">
				<b>个人中心 / 账号信息 /<strong> 账号提现 </strong></b>
			</div>
			<div class="user_content">

				<!-- 提现账户管理 -->
				<div class="web_gonggao">
					<div class="gonggao_row">
						<div class="gonggao_top">
							<a href="javascript:" class="select_on">提现账户管理</a>
						</div>
					</div>
				</div>

					<!-- 暂无银行卡 -->
					<div class="yinhangka" v-if="is_true==0">
						<img src="/static/seller/img/yinhangka.png" alt=""/>
						<p>暂未绑定银行卡</p>
						<el-button type="success" size="small" @click="openDialogForm"><i class="el-icon-plus"></i> 绑定银行卡</el-button>
					</div>
					<!--银行卡信息-->
					<div v-else>
						<el-table :data="seller_bank" border header-cell-style="background:#f5f7fa;" style="width: 100%;margin: 20px 0;">
							<el-table-column prop="bank_seller" label="开户名" align="center">
							</el-table-column>
							<el-table-column prop="mobile" label="预留手机号码" align="center">
							</el-table-column>
							<el-table-column label="银行" align="center">
								<template slot-scope="scope">
									<img onerror="imgError(this)" :src="seller_bank[scope.$index].img" alt="" style="float: left;width: 20px"><span style="float: left;margin-left: 10px">{{seller_bank[scope.$index].name}}</span>
								</template>
							</el-table-column>
							<el-table-column prop="bank_number" label="卡号" align="center">
							</el-table-column>
							<el-table-column label="状态" align="center">
								<template slot-scope="scope" >
									<span v-if="seller_bank[scope.$index].state==0" >待审核</span>
									<span style="color: green" v-if="seller_bank[scope.$index].state==1">已通过</span>
									<span style="color: red" v-if="seller_bank[scope.$index].state==2">已拒绝</span>
								</template>
							</el-table-column>
							<el-table-column label="操作" align="center">
								<template slot-scope="scope">
									<el-button type="warning" size="small" :disabled="seller_bank[scope.$index].state==0" @click="editBank()">更换银行卡</el-button>
								</template>
							</el-table-column>
						</el-table>
					</div>
					<!-- 嵌套表单内容 -->
					<el-dialog title="银行卡信息" :visible.sync="dialogFormVisible">
						<div class="form_box">
							<el-form ref="form" :model="form" class="el_form">
								<div class="el_form_item">
									<p>开户名:</p>
									<el-input v-model="form.bank_seller" placeholder="请输入开户名" class="el_form_width"></el-input>
								</div>
								<div class="el_form_item">
									<p>银行:</p>
									<el-select v-model="form.bank_id" placeholder="请选择银行" class="el_form_width">
										<el-option v-for="item in bank" :value="item.id" :label="item.name" style="display: flex;align-items: center;">
											<img onerror="imgError(this)" :src=item.img alt="" style="float: left; height: 70%;"><span style="margin-left: 10px; ">{{item.name}}</span>
										</el-option>
									</el-select>
								</div>
								<div class="el_form_item">
									<p>开户行城市:</p>
									<div class="el_form_width">
										<el-select class="el_select" v-model="provinceValue2" @change="chooseProvince2"
															 placeholder="请选择省份">
											<el-option v-for="item in provinceList2" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
										<el-select class="el_select" v-model="cityValue2" @change="chooseCity2" placeholder="请选择城市">
											<el-option v-for="item in cityList2" :key="item.id" :label="item.value" :value="item.id">
											</el-option>
										</el-select>
									</div>
								</div>
								<div class="el_form_item">
									<p>开户行支行名称:</p>
									<el-input v-model="form.branch_name" placeholder="请输入内容" class="el_form_width"></el-input>
								</div>
								<div class="el_form_item">
									<p>银行卡号:</p>
									<el-input v-model="form.bank_number" placeholder="请输入银行卡号" class="el_form_width"></el-input>
								</div>
								<div class="el_form_item">
									<p>身份证号码:</p>
									<el-input v-model="form.idcard" placeholder="请输入身份证号" class="el_form_width"></el-input>
								</div>
								<div class="el_form_item">
									<p>手机号码:</p>
									<el-input v-model="form.mobile" placeholder="请输入手机号" class="el_form_width" maxlength="11" @change="getMobile()"></el-input>
								</div>

								<!-- 头像上传 -->
								<div class="upload_pic">
									<p>身份证上传(正面):</p>
									<div class="el_pic_upload">
										<el-upload ref="unload" action="string" list-type="picture-card" :on-remove="handleRemove"
															 :before-upload="beforeUpload" :on-change="handleChange" :limit="1" :auto-upload="false" :file-list="img">
											<i class="el-icon-plus"></i>
										</el-upload>
									</div>
								</div>
							</el-form>
						</div>
						<!-- 确定取消按钮 -->
						<div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
							<el-button @click="dialogFormVisible = false" size="small">取 消</el-button>
							<el-button type="primary" @click="queDingBtnActive" size="small" v-if="is_edit==0">确定添加</el-button>
							<el-button type="primary" @click="editDo()" size="small" v-else>确定修改</el-button>
						</div>
					</el-dialog>

			</div>
		</div>
	<script type="text/javascript">
		$(function () {

			/* 为element-ui组件提供数据绑定和事件 */
			var vm = new Vue({
				el: ".right",
				data: function () {
					return {
                        url:'http://tfkzpic.oss-cn-hangzhou.aliyuncs.com',
						seller_bank:[],
						bank:{},
						is_true:1,
						dialogFormVisible: false,
						img:[],
						is_edit:0,
						form: {
							bank_seller: "",
							bank_id: "",
							branch_name: "",
							bank_number: "",
							province: "",
							city:"",
							mobile: "",
							idcard:"",
							idcard_img:"",
						},
						/* 省市常用登陆地 */
						mapJson: "/static/seller/json/map.json",
						provinceValue2: "",
						cityValue2: "",
						blockValue2: "",
						provinceList2: [],
						cityList2: [],
						blockList2: [],
						newCity2: [],
						newBlock2: [],
						/* 默认只能选择一张图片 */
						picNum: 1,
						/* 变量保存图片 */
						localFile: "",
						localFile2: ""
					}
				},
				methods: {
					getData:function(){
						var loadingFlag;
						loadingFlag= layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
						$.post("<?php echo url('index/bank'); ?>",{},function(res){
							if(res.code==1){
									if(res.data.seller_bank.length > 0){
										vm.seller_bank = res.data.seller_bank;
									}else{
										vm.is_true = 0;
									}
									vm.bank = res.data.bank;
								layer.close(loadingFlag);
							}
						})
					},
					getMobile:function(){
						var setData = {
							'mobile' : this.form.mobile,
							'is_edit' : this.is_edit,
							'id': this.is_edit==1 ? this.form.id : '',
						};
						console.log(setData);
						$.post("<?php echo url('index/bankMobile'); ?>",setData,function(res){
							if(res.code!=1){
								return layer.msg(res.msg,{icon:2},function(){
									vm.form.mobile='';
								});
							}
						})
					},
					/* 打开弹框的时候让表单初始化 */
					openDialogForm: function () {
						/* 让弹框显示 */
						this.dialogFormVisible = true;
						/* 清空表单数据 */
						this.provinceValue2 = "";
						this.cityValue2 = "";
						this.form.bank_seller= "";
						this.form.bank_id= "";
						this.form.branch_name= "";
						this.form.bank_number= "";
						this.form.province= "";
						this.form.city="";
						this.form.mobile= "";
						this.form.idcard="";
						this.form.idcard_img="";
						this.is_edit=0;
					},
					editBank:function(){
						/* 让弹框显示 */
						this.dialogFormVisible = true;
						this.form = this.seller_bank[0];
						this.provinceValue2 = this.form.province;
						this.cityValue2 = this.form.city;
						this.img = [
							{'url':this.url+this.form.idcard_img}
										];
						this.is_edit=1;
					},
					/* 获取图片的base64路径 */
					handleChange: function (e) {
						var that = this;
						var reader = new FileReader();
						reader.readAsDataURL(e.raw);
						reader.onload = function () {
							// console.log(reader.result);
							that.localFile = reader.result;
							that.form.idcard_img = reader.result;
						}
					},
					/* 判断上传文件类型和大小 */
					beforeUpload: function (file) {
						var isJPG = file.type === "image/jpeg";
						var isPng = file.type === "image/png";
						var picSize = file.size / 1024 / 1024 < 20;

						if (!(isJPG || isPng)) {
							this.$message.error("上传头像图片只能是 JPG和PNG 格式");
						}
						if (!picSize) {
							this.$message.error("上传图片大小不能超过 20MB");
						}
						return (isJPG && picSize) || (isPng && picSize);
					},
					/* 删除图片 */
					handleRemove: function (file) {
						// console.log(file);
					},
					/* 省市区二级联动方法 */
					// 获取json数据,二级联动
					getCityData2: function () {
						var that = this;
						axios.get(this.mapJson).then(function (response) {
							if (response.status === 200) {
								var data = response.data;
								// 省市区数据分类
								for (var item in data) {
									if (item.match(/0000$/)) {
										that.provinceList2.push({
											id: item,
											value: data[item],
											children: []
										});
									} else if (item.match(/00$/)) {
										that.newCity2.push({
											id: item,
											value: data[item],
											children: []
										});
									} else {
										that.newBlock2.push({
											id: item,
											value: data[item]
										});
									}
								}
								// 分类市级
								for (var index in that.provinceList2) {
									for (var index1 in that.newCity2) {
										if (that.provinceList2[index].id.slice(0, 2) === that.newCity2[index1].id.slice(0,2)) {
											that.provinceList2[index].children.push(that.newCity2[index1]);
										}
									}
								}
								// 分类区级
								for (var item1 in that.newCity2) {
									for (var item2 in that.newBlock2) {
										if (that.newBlock2[item2].id.slice(0, 4) === that.newCity2[item1].id.slice(0, 4)) {
											that.newCity2[item1].children.push(that.newBlock2[item2]);
										}
									}
								}
							} else {
								// console.log(response.status);
							}
						}).catch(function (error) {
							// console.log(typeof + error);
						})
					},
					// 选省
					chooseProvince2: function (e) {
						for (var index2 in this.provinceList2) {
							if (e === this.provinceList2[index2].id) {
								this.provinceValue2 = this.provinceList2[index2].value;
								this.cityList2 = this.provinceList2[index2].children;
								this.cityValue2 = this.provinceList2[index2].children[0].value;
								this.blockList2 = this.provinceList2[index2].children[0].children;
							}
						}
						this.form.province = this.provinceValue2;
						this.form.city = this.cityValue2;
						console.log(this.provinceValue2, this.cityValue2);
					},
					// 选市
					chooseCity2: function (e) {
						for (var index3 in this.newCity2) {
							if (e === this.newCity2[index3].id) {
								this.cityValue2 = this.newCity2[index3].value;
								this.blockList2 = this.newCity2[index3].children;
							}
						}
						this.form.city = this.cityValue2;
						console.log(this.cityValue2);
					},

					/* 失败的弹框 */
					alertError: function (e) {
						this.$message.error(e);
					},
					/* 成功的弹框 */
					alertSuccess: function (e) {
						this.$message({
							message: e,
							type: "success"
						});
					},

					/* 确定按钮进行表单验证 */
					queDingBtnActive: function () {
						/* 查看图片的base64路径 */
						$.post("<?php echo url('index/bankAdd'); ?>",this.form,function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:2000},function(){
										location.reload();
									})
								}else{
									layer.msg(res.msg,{icon:2,time:2000})
								}
						});
					},
					editDo: function () {
						/* 查看图片的base64路径 */
						$.post("<?php echo url('index/bankEdit'); ?>",this.form,function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:2000},function(){
										location.reload();
									})
								}else{
									layer.msg(res.msg,{icon:2,time:2000})
								}
						});
					}
				},
				created: function () {
					this.getCityData2();
					this.getData();
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
