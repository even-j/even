<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/www/wwwroot/xbt.com/pubic/../application/seller/view/finance/finance.html";i:1575363928;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
	<link rel="stylesheet" type="text/css" href="/static/seller/css/shouzhijilv.css" />
		<!-- 右边盒子部分 -->
		<div class="right">
			<!-- 基本信息标题 -->
			<div class="right-top">
			    <b>个人中心 / 资金管理 /<strong> {{str[state-1]}} </strong></b>
			</div>
			<div class="user_content">
				<!-- 本金提现 -->
				<div class="web_gonggao">
					<div class="gonggao_row">
						<div class="gonggao_top" @click="state=1">
							<a href="javascript:" :class="state==1 ? 'select_on' : ''">押金记录</a>
						</div>
						<div class="gonggao_top" @click="state=3">
							<a href="javascript:" :class="state==3 ? 'select_on' : ''">银锭记录</a>
						</div>
						<div class="gonggao_top" @click="state=2">
							<a href="javascript:" :class="state==2 ? 'select_on' : ''">提现记录</a>
						</div>
					</div>
				</div>
				<div>
					<!-- 押金记录部分 -->
					<div class="shuju_table" v-if="state==1">
						<!-- 搜索区域 -->
						<div class="benjin_search">
							<el-select v-model="type" placeholder="请选择">
								<el-option
												label="请选择"
												value="">
								</el-option>
								<el-option
												v-for="(item,key) in config"
												:key="key"
												:label="item"
												:value="key">
								</el-option>
							</el-select>
							<el-date-picker class="el_date" v-model="dateValue" type="daterange" range-separator="至"
															start-placeholder="开始日期" end-placeholder="结束日期" value-format="yyyy-MM-dd">
							</el-date-picker>
							<el-button type="primary" @click="searchDeposit()"><i class="el-icon-search"></i> 搜索</el-button>
							<el-button type="primary" @click="excelDeposit()"><i class="el-icon-download"></i> 导出</el-button>
						</div>
						<!-- 数据列表 -->
						<el-table :data="tableData" border header-cell-style="background:#f5f7fa;" :cell-style="cellStyle">
							<el-table-column prop="id" label="流水号" align="center">
							</el-table-column>
							<el-table-column prop="price" label="收支明细" align="center">
							</el-table-column>
							<el-table-column prop="type" label="财务类型" align="center">
							</el-table-column>
							<el-table-column prop="yprice" label="结余" align="center">
							</el-table-column>
							<el-table-column prop="create_time" label="日期" align="center" width="100">
							</el-table-column>
							<el-table-column prop="memo" label="备注" align="center">
							</el-table-column>
						</el-table>
						<!-- 分页 -->
						<div class="fenye">
							<el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange"
														 :current-page="currentPage"
														 :page-sizes="sizes" :page-size="1"
														 layout="total, sizes, prev, pager, next, jumper"
														 :total="total1"
														 background>
							</el-pagination>
						</div>
					</div>

					<!-- 提现记录部分 -->
					<div class="shuju_table2" v-if="state==2">
						<!-- 搜索区域 -->
						<div class="benjin_search">
							<el-date-picker class="el_date" v-model="dateValue2" type="daterange" range-separator="至"
															start-placeholder="开始日期" end-placeholder="结束日期" value-format="yyyy-MM-dd">
							</el-date-picker>
							<el-button type="primary" @click="searchCash()"><i class="el-icon-search"></i> 搜索</el-button>
						</div>
						<!-- 数据列表 -->
						<el-table :data="tableData2" border header-cell-style="background:#f5f7fa;" :cell-style="cellStyle2">
							<el-table-column prop="id" label="流水号" align="center">
							</el-table-column>
							<el-table-column prop="price" label="金额" align="center">
							</el-table-column>
							<el-table-column prop="poundage" label="费用" align="center">
							</el-table-column>
							<el-table-column prop="toaccount" label="到账金额" align="center">
							</el-table-column>
							<el-table-column prop="yprice" label="账户余额" align="center">
							</el-table-column>
							<el-table-column prop="state" label="状态" align="center">
							</el-table-column>
							<el-table-column prop="create_time" label="日期" align="center">
							</el-table-column>
							<el-table-column prop="memo" label="拒绝原因" align="center">
							</el-table-column>
						</el-table>
						<!-- 分页 -->
						<div class="fenye2">
							<el-pagination @size-change="handleSizeChange2" @current-change="handleCurrentChange2"
														 :current-page="currentPage2"
														 :page-sizes="sizes" :page-size="1"
														 layout="total, sizes, prev, pager, next, jumper"
														 :total="total2"
														 background>
							</el-pagination>
						</div>
					</div>

					<!-- 银锭提现部分 -->
					<div class="shuju_table3" v-if="state==3">
						<!-- 搜索区域 -->
						<div class="benjin_search">
							<el-select v-model="type2" placeholder="请选择">
								<el-option
												label="请选择"
												value="">
								</el-option>
								<el-option
												v-for="(item,key) in config"
												:key="key"
												:label="item"
												:value="key">
								</el-option>
							</el-select>
							<el-date-picker class="el_date" v-model="dateValue3" type="daterange" range-separator="至"
															start-placeholder="开始日期" end-placeholder="结束日期" value-format="yyyy-MM-dd">
							</el-date-picker>
							<el-button type="primary" @click="searchReward()"><i class="el-icon-search"></i> 搜索</el-button>
							<el-button type="primary" @click="excelReward()"><i class="el-icon-download"></i> 导出</el-button>
						</div>
						<!-- 数据列表 -->
						<el-table :data="tableData3" border header-cell-style="background:#f5f7fa;" :cell-style="cellStyle3">
							<el-table-column prop="id" label="流水号" align="center">
							</el-table-column>
							<el-table-column prop="price" label="收支明细" align="center">
							</el-table-column>
							<el-table-column prop="type" label="财务类型" align="center">
							</el-table-column>
							<el-table-column prop="yprice" label="结余" align="center">
							</el-table-column>
							<el-table-column prop="create_time" label="日期" align="center" width="100">
							</el-table-column>
							<el-table-column prop="memo" label="备注" align="center">
							</el-table-column>
						</el-table>
						<!-- 分页 -->
						<div class="fenye3">
							<el-pagination @size-change="handleSizeChange3" @current-change="handleCurrentChange3"
														 :current-page="currentPage3"
														 :page-sizes="sizes" :page-size="1"
														 layout="total, sizes, prev, pager, next, jumper"
														 :total="total3"
														 background>
							</el-pagination>
						</div>
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
						/* 起止日期value值 */
						dateValue: "",
						dateValue2: "",
						dateValue3: "",
						/* 搜索框value值 */
						type: "",
						type2: "",
						config:[],
						state:1,
						str:['押金记录','提现记录','银锭记录'],
						total1:0,
						total2:0,
						total3:0,
						size1:10,
						size2:10,
						size3:10,
						sizes:[10,20,30,40,50],
						/* 表格数据 */
						tableData: [],
						/* 表格数据2 */
						tableData2: [],
						tableData3: [],
						/* 默认选中第一页 */
						currentPage: 1,
						currentPage2: 1,
						currentPage3: 1
					}
				},
				created:function(){
					this.getData();
				},
				methods: {
					getData:function(){
						var loadingFlag;
						loadingFlag= layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:6000 });
						var that = this;
						$.post("<?php echo url('finance/financeDo'); ?>",{},function (res) {
							if(res.code==1){
								console.log(res.data.list3);
								that.tableData = res.data.list1;
								that.tableData2 = res.data.list2;
								that.tableData3 = res.data.list3;
								that.total1 = res.data.total1;
								that.total2 = res.data.total2;
								that.total3 = res.data.total3;
								that.config = res.data.config;
								layer.close(loadingFlag);
							}else{
								layer.close(loadingFlag);
								layer.msg('网络错误！',{icon:2});
							}
						})
					},
					getYpriceData:function(){
						var that = this;
						$.post("<?php echo url('finance/depositRecharge'); ?>",{page:this.currentPage,datetime:this.dateValue,size:this.size1,type:this.type},function (res) {
							if(res.code==1){
								that.tableData = res.data.list;
								that.total1 = res.data.total;
							}else{
								layer.msg('网络错误！',{icon:2});
							}
						})
					},
					getDpriceData:function(){
						var that = this;
						$.post("<?php echo url('finance/rewardRecharge'); ?>",{page:this.currentPage3,datetime:this.dateValue3,size:this.size1,type:this.type2},function (res) {
							if(res.code==1){
								that.tableData3 = res.data.list;
								that.total3 = res.data.total;
							}else{
								layer.msg('网络错误！',{icon:2});
							}
						})
					},
					getCashData:function(){
						var that = this;
						$.post("<?php echo url('finance/cash'); ?>",{page:this.currentPage2,datetime:this.dateValue2,size:this.size1},function (res) {
							if(res.code==1){
								that.tableData2 = res.data.list;
								that.total2 = res.data.total;
							}else{
								layer.msg('网络错误！',{icon:2});
							}
						})
					},
					searchDeposit:function(){
						this.currentPage = 1;
						this.getYpriceData();
					},
					searchCash:function(){
						this.currentPage2 = 1;
						this.getCashData();
					},
					searchReward:function(){
						this.currentPage3 = 1;
						this.getDpriceData();
					},
					/* 给表格1上色 */
					cellStyle: function (e) {
						var jinE = this.tableData[e.rowIndex].price;
						jinE = Number(jinE);

						if (e.columnIndex === 1) {
							if (jinE > 0) {
								return "color: rgb(103, 194, 58);";
							} else if (jinE <= 0) {
								return "color:red;";
							}
						};
						if (e.columnIndex === 2) {
							return "color:#66b1ff";
						};

					},
					/* 给表格2上色 */
					cellStyle2: function (e) {
						var jinE = this.tableData2[e.rowIndex].price;
						jinE = Number(jinE);

						if (e.columnIndex === 1) {
							if (jinE > 0) {
								return "color: rgb(103, 194, 58);";
							} else if (jinE <= 0) {
								return "color:red;";
							}
						};
						if (e.columnIndex === 3) {
							return "color:#66b1ff";
						};

					},
					/* 给表格3上色 */
					cellStyle3: function (e) {
						var jinE = this.tableData3[e.rowIndex].price;
						jinE = Number(jinE);

						if (e.columnIndex === 1) {
							if (jinE > 0) {
								return "color: rgb(103, 194, 58);";
							} else if (jinE <= 0) {
								return "color:red;";
							}
						};
						if (e.columnIndex === 2) {
							return "color:#66b1ff";
						};

					},
					/* 给表格
					/* 分页事件1 */
					handleSizeChange: function (val) {
						this.size1 = val;
						this.currentPage = 1;
						this.getYpriceData();
					},
					handleCurrentChange: function (val) {
						this.currentPage = val;
						this.getYpriceData();
					},
					/* 分页事件2 */
					handleSizeChange2: function (val) {
						this.size2 = val;
						this.currentPage2 = 1;
						this.getCashData();
					},
					handleCurrentChange2: function (val) {
						this.currentPage2 = val;
						this.getCashData();
					},
					/* 分页事件3 */
					handleSizeChange3: function (val) {
						this.size3 = val;
						this.currentPage3 = 1;
						this.getDpriceData();
					},
					handleCurrentChange3: function (val) {
						this.currentPage3 = val;
						this.getDpriceData();
					},
					excelDeposit:function () {
						var start = "";
						var end = "";
						if(this.dateValue){
							start = this.dateValue[0];
							end = this.dateValue[1];
						}else{
							return layer.msg('确请选着时间区间，并最多只能选择1个月的区间',{icon:2,time:2000});
						}
						window.open("<?php echo url('finance/excelDeposit','','',false); ?>/start/"+start+"/end/"+end+"/type/"+this.type);
					},
					excelReward:function () {
						var start = "";
						var end = "";
						if(this.dateValue3){
							 start = this.dateValue3[0];
							 end = this.dateValue3[1];
						}else{
							return layer.msg('确请选着时间区间，并最多只能选择1个月的区间',{icon:2,time:2000});
						}
						window.open("<?php echo url('finance/excelReward','','',false); ?>/start/"+start+"/end/"+end+"/type/"+this.type2);
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