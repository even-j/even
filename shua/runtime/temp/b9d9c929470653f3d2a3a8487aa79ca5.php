<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/www/wwwroot/xbt.com/pubic/../application/seller/view/recommend/record.html";i:1583552414;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/static/seller/css/InvitedRecord.css"/>
<div class="right" v-cloak>
    <!-- 基本信息标题 -->
    <div class="right-top">
        <b>个人中心 / 好友邀请 /<strong> 邀请记录 </strong></b>
    </div>
    <div class="user_content">
        <div class="web_gonggao">
            <div class="gonggao_row">
                <div class="gonggao_top" @click="changeTab(1)">
                    <a href="javascript:" :class="info.state==1 ? 'select_on' : ''">买手记录</a>
                </div>
                <div class="gonggao_top" @click="changeTab(2)">
                    <a href="javascript:" :class="info.state==2 ? 'select_on' : ''">商家记录</a>
                </div>
            </div>
        </div>
        <div class="chongzhi_vip">

            <!-- 选择日期 -->
            <div class="selete_date">
                <el-date-picker v-model="info.searchTime" type="daterange" range-separator="至" start-placeholder="开始日期"
                                end-placeholder="结束日期" style="margin-right: 20px;width:380px;" value-format="yyyy-MM-dd">
                </el-date-picker>
                <el-button type="primary" @click="search()"><i class="el-icon-search"></i>搜索</el-button>
                <el-button type="warning"  @click="sort(1)"><i class="el-icon-sort"></i>会员到期排序</el-button>
                <el-button type="warning"  @click="sort(2)"><i class="el-icon-sort"></i>{{strs}}</el-button>
            </div>
            <div class="invite-p">
                <p v-show="num==2">
                    以下好友已成功接受您的邀请，红色显示的好友超过30天没有<span>{{strsss}}</span>任务，您可以通过qq联系好友，待<span>{{strss}}</span>任务后即可获得奖励。
                </p>
                <p v-show="num==1">
                    以下好友已成功接受您的邀请，红色显示的好友会员已过期，您可以通过qq联系好友，待续费后<span>{{strss}}</span>任务即可获得奖励。
                </p>
            </div>
            <!-- 数据列表 -->
            <div class="shuju_table">
                <template>
                    <el-table :data="list" border style="width: 100%;" header-cell-style="background:#f5f7fa;"
                              :cell-style="cellStyle">
                        <el-table-column prop="create_time" label="日期">
                        </el-table-column>
                        <el-table-column prop="username" label="用户名">
                        </el-table-column>
                        <el-table-column prop="qq" label="qq号">
                        </el-table-column>
                        <el-table-column prop="num" label="完成任务数量">
                        </el-table-column>
                        <el-table-column prop="vip_time" label="会员到期时间">
                        </el-table-column>
                        <el-table-column prop="last_time" :label="str">
                        </el-table-column>
                        <el-table-column prop="price" label="奖励银锭">
                        </el-table-column>
                        <el-table-column label="完成单数记录" v-if="info.state==1">
                            <template slot-scope="scope">
                                <el-button @click="view(scope.row.id)" type="text" size="small">查看完成记录</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </template>
            </div>

            <!-- 分页 -->
            <div class="fenye">
                <el-pagination @size-change="handleSizeChange" @current-change="handleCurrentChange"
                               :current-page="info.page"
                               :page-sizes="sizes" :page-size="info.size"
                               layout="total, sizes, prev, pager, next, jumper" :total="total"
                               background>
                </el-pagination>
            </div>

        </div>

    </div>
    <el-dialog title="完成记录" :visible.sync="c_task">
        <div class="shuju_table">
            <template>
                <el-table :data="task_list" border style="width: 100%;" header-cell-style="background:#f5f7fa;">
                    <el-table-column prop="id" label="序号">
                    </el-table-column>
                    <el-table-column prop="username" label="用户名">
                    </el-table-column>
                    <el-table-column prop="month" label="月份">
                    </el-table-column>
                    <el-table-column prop="task_number" label="完成单数">
                    </el-table-column>
                </el-table>
            </template>
        </div>

        <!-- 分页 -->
        <div class="fenye">
            <el-pagination @size-change="sizeChange" @current-change="pageChange"
                           :current-page="get_task.page"
                           :page-sizes="sizes" :page-size="get_task.size"
                           layout="total, sizes, prev, pager, next, jumper" :total="total_task"
                           background>
            </el-pagination>
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
                        state:1,
                        searchTime: "",
                        page:1,
                        size:10,
                        sortNum:1,
                    },
                    num:0,
                    sizes:[10,20,30,40,50],
                    total:0,
                    list:[],
                    /* 默认选中第一页 */
                    str: '上次接单时间',
                    strs:'接单时间倒序',
                    strss:'完成',
                    strsss:'接手',
                    total_task:0,
                    c_task:false,
                    task_list:[],
                    get_task:{
                        id:'',
                        page:1,
                        size:10,
                    },
                }
            },
            created:function(){
                that = this;
                this.getData();
            },
            methods: {
                getData:function() {
                    var loading = layer.msg('正在读取数据，请稍候……', {icon: 16, shade: 0.5, shadeClose: false, time: 6000});
                    var that = this;
                    $.post("<?php echo url('recommend/recordData'); ?>", this.info, function (res) {
                        if (res.code == 1) {
                            that.list = res.data.list;
                            that.total = res.data.total;
                            layer.close(loading);
                        } else {
                            layer.close(loading);
                            layer.msg('网络错误！', {icon: 2});
                        }
                    })
                },
                getTaskData:function() {
                    var loading = layer.msg('正在读取数据，请稍候……', {icon: 16, shade: 0.5, shadeClose: false, time: 6000});
                    var that = this;
                    $.post("<?php echo url('recommend/getCTask'); ?>", this.get_task, function (res) {
                        if (res.code == 1) {
                            that.task_list = res.data.list;
                            that.total_task = res.data.total;
                            layer.close(loading);
                        } else {
                            layer.close(loading);
                            layer.msg('网络错误！', {icon: 2});
                        }
                    })
                },
                view:function(id){
                    this.get_task.id = id;
                    this.getTaskData();
                    this.c_task = true;
                },
                /* 分页事件 */
                sizeChange: function (val) {
                    this.get_task.size = val;
                    this.get_task.page = 1;
                    this.getTaskData();
                },
                pageChange: function (val) {
                    this.get_task.page = val;
                    this.getTaskData();
                },
                /* 给表格上色 */
                cellStyle: function (e) {
                    if (e.columnIndex === 4 && e.row.status==1) {
                        return "color:red;"
                    }
                    if (e.columnIndex === 3 && e.row.state==1) {
                        return "color:red;"
                    }
                },
                /* 分页事件 */
                handleSizeChange: function (val) {
                    this.info.size = val;
                    this.info.page = 1;
                    this.getData();
                },
                handleCurrentChange: function (val) {
                    this.info.page = val;
                    this.getData();
                },
                changeTab:function(num){
                    this.info.state = num;
                    this.num = 0;
                    if(num==1){
                        this.str = '上次接单时间';
                        this.strs = '接单时间排序';
                        this.strss = '完成';
                        this.strsss = '接手';

                    }else{
                        this.str = '上次发单时间';
                        this.strs = '发单时间排序';
                        this.strss = '发布完成';
                        this.strsss = '发布';
                    }
                    this.info.page = 1;
                    this.info.size = 10;
                    this.info.searchTime='';
                    this.getData();
                },
                search:function(){
                    this.info.page = 1;
                    this.info.size = 10;
                    this.getData();
                },
                sort:function(num){
                    this.info.sortNum = num;
                    this.info.page = 1;
                    this.info.size = 10;
                    this.info.searchTime='';
                    this.num = num;
                    this.getData();
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