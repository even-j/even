<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/seller\view\index\info.html";i:1698725734;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\header.html";i:1698733825;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\footer.html";i:1698558175;}*/ ?>
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
			<link rel="stylesheet" type="text/css" href="/static/seller/css/jiBenXinXi.css" />
			<!-- 右边盒子部分 -->
			<div class="right">
				<!-- 基本信息标题 -->
				<div class="right-top">
					<b>个人中心 / 账号信息 /<strong> 基本信息 </strong></b>
				</div>
				<div class="user_content">
					<img src="/static/seller/img/imgheade.png" alt="" class="user_touxiang"/>
					<p class="user_name">{{seller.seller_name}}</p>

					<!-- 用户信息 -->
					<div class="user_info">
						<!-- 用户信息左 -->
						<div class="user_left">
							<div class="user_detail">
								<div>用户名:</div>
								<div class="user_gray">{{seller.seller_name}}</div>
							</div>
							<div class="user_detail">
								<div>会员状态:</div>
								<div class="user_gray" v-if="seller.vip==1">VIP会员</div>
								<div class="user_gray" v-else>普通用户</div>
							</div>
							<div class="user_detail">
								<div>VIP时限:</div>
								<div class="user_gray">{{seller.vip_time}}</div>
							</div>
							<div class="user_detail">
								<div>QQ账号:</div>
								<div class="user_gray">{{seller.qq}}</div>
								<el-button type="primary" icon="el-icon-edit" circle size="small" @click="editQQ()"></el-button>
							</div>
						</div>
						<!-- 用户信息右 -->
						<div class="user_right">
							<div class="user_detail">
								<div>手机号码:</div>
								<div class="user_gray">{{seller.mobile}}</div>
								<el-button type="primary" icon="el-icon-edit" circle size="small" @click="editMobile()"></el-button>
							</div>

							<!--
							<div class="user_detail">
								<div>VIP延时:</div>
								<div><a href="javascript:void (0)" class="user_blue yanshi" @click="vip()">
										<< 延时vip>>
									</a></div>
							</div>
							-->

							<div class="user_detail">
								<div>登录密码:</div>
								<div class="user_blue">**********</div>
								<div class="user_btn">
									<el-button type="primary" icon="el-icon-edit" circle size="small" @click="editLoginPwd()"></el-button>
								</div>
							</div>
							<div class="user_detail">
								<div>支付密码:</div>
								<div class="user_blue">**********</div>
								<div class="user_btn">
									<el-button type="primary" icon="el-icon-edit" circle size="small" @click="editPayPwd()"></el-button>
								</div>
							</div>




						</div>
					</div>

					<!-- 修改QQ号码弹框 -->
					<el-dialog title="修改QQ号" :visible.sync="dialogQqNum">
						<div class="form_box">
							<el-form ref="form" class="el_form">
								<div class="el_form_item">
									<p>原QQ号码:</p>
									<el-input v-model="seller.qq" class="el_form_width" clearable style='width: 200px;' readonly >
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>新QQ号码:</p>
									<el-input v-model="qq" placeholder="请输入新QQ号码"  class="el_form_width">
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
							</el-form>
							<div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
								<el-button @click="dialogQqNum = false" size="small">取 消</el-button>
								<el-button @click="editQQDo()" type="primary" size="small">确 定</el-button>
							</div>
						</div>
					</el-dialog>

					<!-- 修改昵称弹框 -->
					<el-dialog title="修改昵称" :visible.sync="dialogName">
						<div class="form_box">
							<el-form ref="form" class="el_form">
								<div class="el_form_item">
									<p>原昵称:</p>
									<el-input v-model="seller.seller_name" class="el_form_width" clearable style='width: 200px;' readonly >
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>新昵称:</p>
									<el-input v-model="name" placeholder="请输入新昵称"  class="el_form_width">
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
							</el-form>
							<div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
								<el-button @click="dialogName = false" size="small">取 消</el-button>
								<el-button @click="editNameDo()" type="primary" size="small">确 定</el-button>
							</div>
						</div>
					</el-dialog>

					<el-dialog title="修改手机号码" :visible.sync="dialogPhoneNum">
						<div class="form_box">
							<el-form ref="form" class="el_form">
								<div class="el_form_item">
									<p>原手机号码:</p>
									<el-input v-model="seller.mobile" maxlength="11" class="el_form_width" clearable style='width: 200px;' readonly >
										<i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;">
											<img src="/static/seller/img/phone.png" alt="" style="width: 24px;" />
										</i>
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>支付密码:</p>
									<el-input type="password" show-password v-model="pay_pwd" placeholder="请输入6位支付密码" class="el_form_width"
									 maxlength="6"></el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>新手机号码:</p>
									<el-input v-model="mobile" placeholder="请输入新手机号码" maxlength="11" class="el_form_width"
									 clearable>
										<i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
											 src="/static/seller/img/phone.png" alt="" style="width: 24px;" /></i>
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>验证码:</p>
									<el-input v-model="code" placeholder="请输入验证码" maxlength="6" class="el_form_width" style="width: 160px;margin-right: 40px;"
									 clearable><i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
											 src="/static/seller/img/123.png" alt="" style="width: 24px;" /></i>
									</el-input>
									<el-button type="primary" style="width: 100px;padding: 0;height: 40px;line-height: 40px;" @click="sendCode()"
									 :disabled="yzmDisabled" v-html="yzmMsg"></el-button>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
							</el-form>
							<!-- 修改密码按钮 -->
							<div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
								<el-button @click="dialogPhoneNum = false" size="small">取 消</el-button>
								<el-button @click="editMobileDo()" type="primary" size="small">确 定</el-button>
							</div>
						</div>
					</el-dialog>

					<!-- 修改密码弹框 -->
					<el-dialog title="修改登录密码" :visible.sync="dialogPassWord">
						<div class="form_box">
							<el-form ref="form" class="el_form">
								<div class="el_form_item">
									<p>手机号码:</p>
									<el-input v-model="mobile" maxlength="11" class="el_form_width" clearable style='width: 200px;' readonly >
										<i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;">
											<img src="/static/seller/img/phone.png" alt="" style="width: 24px;" />
										</i>
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>验证码:</p>
									<el-input v-model="code" placeholder="请输入验证码" maxlength="6" class="el_form_width" style="width: 160px;margin-right: 40px;">
										<i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;">
											<img src="/static/seller/img/123.png" alt="" style="width: 24px;" />
										</i>
									</el-input>
									<el-button type="primary" style="width: 100px;padding: 0;height: 40px;line-height: 40px;" @click="sendCode()"
														 :disabled="yzmDisabled" v-html="yzmMsg"></el-button>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>新登录密码:</p>
									<el-input type="password" show-password v-model="login_pwd" placeholder="请输入新登录密码" class="el_form_width"
									 maxlength="16"></el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>确认新密码:</p>
									<el-input type="password" show-password v-model="repwd" placeholder="请确认新登录密码" class="el_form_width"
									 maxlength="16"></el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
							</el-form>
							<!-- 修改密码按钮 -->
							<div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
								<el-button @click="dialogPassWord = false" size="small">取 消</el-button>
								<el-button @click="editLoginPwdDo()" type="primary" size="small">确 定</el-button>
							</div>
						</div>
					</el-dialog>

					<!-- 支付密码弹框 -->
					<el-dialog title="修改支付密码" :visible.sync="dialogZhiFuPassWord">
						<div class="form_box">
							<el-form ref="form" class="el_form">
								<div class="el_form_item">
									<p>手机号码:</p>
									<el-input v-model="mobile" maxlength="11" class="el_form_width" clearable style='width: 200px;' readonly >
										<i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;">
											<img src="/static/seller/img/phone.png" alt="" style="width: 24px;" />
										</i>
									</el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>验证码:</p>
									<el-input v-model="code" placeholder="请输入验证码" maxlength="6" class="el_form_width" style="width: 160px;margin-right: 40px;"
														clearable><i slot="prefix" class="el-input__icon" style="display: flex;flex-direction: row;align-items: center;"><img
													src="/static/seller/img/123.png" alt="" style="width: 24px;" /></i>
									</el-input>
									<el-button type="primary" style="width: 100px;padding: 0;height: 40px;line-height: 40px;" @click="sendCode"
														 :disabled="yzmDisabled" v-html="yzmMsg"></el-button>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>新支付密码:</p>
									<el-input type="password" show-password v-model="pay_pwd" placeholder="请输入6位支付密码"
									 class="el_form_width" maxlength="6"></el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
								<div class="el_form_item">
									<p>确认新密码:</p>
									<el-input type="password" show-password v-model="repwd" placeholder="请确认新支付密码"
									 class="el_form_width" maxlength="6"></el-input>
									<span style="margin-left: 10px;color: red;">*</span>
								</div>
							</el-form>
							<!-- 支付密码按钮 -->
							<div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
								<el-button @click="dialogZhiFuPassWord = false" size="small">取 消</el-button>
								<el-button type="primary" @click="editPayPwdDo()" size="small">确 定</el-button>
							</div>
						</div>
					</el-dialog>

				</div>
			</div>

		</div>
		<script type="text/javascript">
			$(function() {

				// 手机号正则表达式
				var phoneReg = /^1[3-9]\d{9}$/;
				/* 为element-ui组件提供数据绑定和事件 */
				var vm = new Vue({
					el: ".right",
					data: function() {
						return {
							seller:<?php echo $seller; ?>,
							/* 默认隐藏弹框 */
							dialogPhoneNum: false,
							dialogPassWord: false,
							dialogZhiFuPassWord: false,
							/* 验证码按钮默认不禁用 */
							yzmDisabled: false,
							dialogQqNum:false,
							dialogName:false,
							/* 默认的验证码按钮文字内容 */
							yzmMsg: "发送验证码",
							pay_pwd:'',
							login_pwd:'',
							mobile:'',
							repwd:'',
							code:'',
							qq:'',
							name:'',
						}
					},
					methods: {
						/* 下拉菜单事件 */
						handleOpen: function(key, keyPath) {
							// console.log(key, keyPath);
						},
						handleClose: function(key, keyPath) {
							// console.log(key, keyPath);
						},
						/* 打开弹框并清空表单 */
						editLoginPwd: function() {
							this.dialogPassWord = true;
							this.mobile = this.seller.mobile;
							this.login_pwd = "";
							this.code = "";
							this.yzmMsg= "发送验证码";
							this.yzmDisabled = false;
							this.repwd = '';
						},
						editPayPwd: function() {
							this.dialogZhiFuPassWord = true;
							this.mobile = this.seller.mobile;
							this.pay_pwd = "";
							this.code = "";
							this.yzmMsg= "发送验证码";
							this.yzmDisabled = false;
							this.repwd = '';
						},
						editMobile: function() {
							this.dialogPhoneNum = true;
							this.mobile = '';
							this.code='';
							this.pay_pwd='';
							this.yzmMsg= "发送验证码";
							this.yzmDisabled = false;
						},
						editQQ: function() {
							this.dialogQqNum = true;
							this.qq = '';
						},
						editName: function() {
							this.dialogName = true;
							this.name = '';
						},
						vip:function(){
							location.href = "<?php echo url('vip/index'); ?>";
						},
						/* 第一个表单验证 */
						editMobileDo: function() {
							var that = this;
							$.post("<?php echo url('Index/editMobileDo'); ?>",{mobile:this.mobile,pay_pwd:this.pay_pwd,code:this.code},function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:1500},function(){
										that.dialogPhoneNum = false;
										location.reload();
									});
								}else{
									layer.msg(res.msg,{icon:2,time:1500});
								}
							});
						},
						editQQDo: function() {
							var that = this;
							$.post("<?php echo url('Index/editQqDo'); ?>",{qq:this.qq},function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:1500},function(){
										that.dialogQqNum = false;
										location.reload();
									});
								}else{
									layer.msg(res.msg,{icon:2,time:1500});
								}
							});
						},
						editNameDo: function() {
							var that = this;
							$.post("<?php echo url('Index/editNameDo'); ?>",{seller_name:this.name},function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:1500},function(){
										that.dialogName = false;
										location.reload();
									});
								}else{
									layer.msg(res.msg,{icon:2,time:1500});
								}
							});
						},
						/* 第二个表单验证 */
						editLoginPwdDo: function() {
							var that = this;
							if(this.login_pwd != this.repwd)return layer.msg("确认密码不正确",{icon:1,time:1500});
							$.post("<?php echo url('Index/editLoginPwdDo'); ?>",{mobile:this.mobile,login_pwd:this.login_pwd,code:this.code},function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:1500},function(){
										that.dialogPassWord = false;
										location.reload();
									});
								}else{
									layer.msg(res.msg,{icon:2,time:1500});
								}
							});
						},
						/* 第三个表单验证 */
						editPayPwdDo: function() {
							var that = this;
							if(this.pay_pwd != this.repwd)return layer.msg("确认密码不正确",{icon:1,time:1500});
							$.post("<?php echo url('Index/editPayPwdDo'); ?>",{mobile:this.mobile,pay_pwd:this.pay_pwd,code:this.code},function(res){
								if(res.code==1){
									layer.msg(res.msg,{icon:1,time:1500},function(){
										that.dialogZhiFuPassWord = false;
										location.reload();
									});
								}else{
									layer.msg(res.msg,{icon:2,time:1500});
								}
							});
						},
						/* 发送验证码 */
						sendCode: function() {
							var num = 60;
							var that = this;
							$.post("<?php echo url('Login/mobileDo'); ?>",{mobile:this.mobile},function(res){
									if(res.code==1){
										var timer = setInterval(function() {
											num--;
											that.yzmDisabled = true;
											that.yzmMsg = "还剩 " + num + " 秒";
											if (num <= 0) {
												clearInterval(timer);
												that.yzmMsg = "重新发送";
												that.yzmDisabled = false;
											} else if (num === 59) {
												layer.msg("验证码发送成功,若接收失败请耐心等待一分钟后点击重新发送",{icon:1,time:2000});
											}
										}, 1000);
									}else{
										layer.msg(res.msg,{icon:2});
									}
							});
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

