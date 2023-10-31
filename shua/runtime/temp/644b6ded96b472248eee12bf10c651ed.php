<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/www/wwwroot/xbt.com/pubic/../application/seller/view/help/index.html";i:1698558136;s:61:"/www/wwwroot/xbt.com/application/seller/view/public/head.html";i:1698557939;}*/ ?>
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
        <li><a href="<?php echo url('index/index'); ?>">个人中心</a></li>
        <li><a class="list" href="<?php echo url('help/index'); ?>">帮助中心</a></li>
        <li><a href="<?php echo url('vip/index'); ?>">会员续费</a></li>
        <li><a href="<?php echo url('recharge/recharge'); ?>">账户充值</a></li>
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
          <el-pagination current-change="setPage"
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
  <script>
      function imgError(e){
          e.src = '/static/seller/img/moren.jpg';
      }
  </script>
  <script>
      var name = new Vue({
          el: ".top",
          data: function () {
              return {
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
          }
      })
  </script>
<style>
  span {
     display: inline!important;
  }
</style>
<link rel="stylesheet" type="text/css" href="/static/seller/css/helpCenter.css"/>
  <!-- 中间内容部分 -->
  <div class="center_box" v-cloak>
    <!-- 左边部分 -->
    <div class="left_box">
      <!--<el-select style="width: 300px;margin-top: 20px;" v-model="type" @change="handleChangeSelect" placeholder="请选择">
        <el-option label="公告" :value="1"></el-option>
        <el-option label="常见问题" :value="2"></el-option>
      </el-select>-->
      <el-tabs style="width: 300px;margin-top: 20px;" v-model="type" @tab-click="handleClick">
        <el-tab-pane label="公告" name="1"></el-tab-pane>
        <el-tab-pane label="常见问题" name="2"></el-tab-pane>
      </el-tabs>
      <div class="left_input">
        <el-input style="width: 300px;" placeholder="请输入内容" v-model="search">
          <el-button slot="append" icon="el-icon-search" @click="getSearch"></el-button>
        </el-input>
      </div>
      <div v-if="state==1">
        <div class="left_table">
          <div class="left_table_item" :class="[index>=1?'hide_border':'',curIndex===index?'selectOn':'']"
               v-for="(item,index) in list" @click="ggClick(item,index)">
            <p v-html="item.title"></p>
            <p>
              <i class="el-icon-time"></i>
              <span v-html="item.create_time"></span>
            </p>
          </div>
        </div>
        <div class="center">
          <el-pagination background :page-size="6" @current-change="handleCurrentChange1" :current-page="page1" :pager-count="3"
                         layout="prev, pager, next" :total="total">
          </el-pagination>
        </div>
      </div>
      <div v-if="state==2">
        <div class="left_table">
          <div class="left_table_item" :class="[index>=1?'hide_border':'',curIndex2===index?'selectOn':'']"
               v-for="(item,index) in list2" @click="wtClick(item,index)">
            <p v-html="item.title"></p>
            <p>
              <i class="el-icon-time"></i>
              <span v-html="item.create_time"></span>
            </p>
          </div>
        </div>
       <div class="center">
         <el-pagination background :page-size="6" @current-change="handleCurrentChange2" :current-page="page2" :pager-count="3"
                        layout="prev, pager, next" :total="total2">
         </el-pagination>
       </div>
      </div>
    </div>
    <!-- 右边盒子部分 -->
    <div class="right_box">
      <!-- 基本信息标题 -->
      <div class="msg_title">
        <p>帮助中心&nbsp;/&nbsp;<span class="msg_title_txt">文章详情</span></p>
      </div>
      <div class="user_content">
        <div class="right_content">
          <h1 v-html="title"></h1>
          <div v-html="content"></div>
        </div>
        <p class="right_p">
          文章分类：
          <span v-html="msg"></span>
          &nbsp;&nbsp;&nbsp;
        <p class="right_p"><span v-html="newDate"></span></p>
        </p>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
    $(function () {

        /* 初始化一个Vue */
        var vm = new Vue({
            el: ".center_box",
            data: function () {
                return {
                    type: '1',
                    state: 1,
                    inputValue: "",
                    /* 默认显示的栏目 */
                    msg: "",
                    /* 表单数据 */
                    list: [],
                    list2: [],
                    total: 0,
                    total2: 0,
                    page1: 1,
                    page2: 1,
                    search: '',
                    newDate: "",
                    /* 默认显示的内容 */
                    title: "",
                    content: "",
                    curIndex: 0,
                    curIndex2: 0,
                }
            },
            methods: {
                handleClick: function () {
                    console.log(this.type);
                    if (this.type == 1) {
                        this.state = 1;
                        this.msg = '公告';
                        this.search = '';
                        this.title = this.list.length > 0 ? this.list[0].title : '';
                        this.content = this.list.length > 0 ? this.list[0].content : '';
                        this.newDate = this.list.length > 0 ? this.list[0].create_time : '';
                    } else {
                        this.state = 2;
                        this.msg = '常见问题';
                        this.search = '';
                        this.title = this.list2.length > 0 ? this.list2[0].title : '';
                        this.content = this.list2.length > 0 ? this.list2[0].content : '';
                        this.newDate = this.list2.length > 0 ? this.list2[0].create_time : '';
                    }
                },
                ggClick: function (item, index) {
                    this.title = item.title;
                    this.content = item.content;
                    this.curIndex = index;
                    this.newDate = item.create_time;
                },
                wtClick: function (item, index) {
                    this.title = item.title;
                    this.content = item.content;
                    this.curIndex2 = index;
                    this.newDate = item.create_time;
                },
                handleCurrentChange1(val) {
                    var that = this;
                    this.page1 = val;
                    $.post("<?php echo url('help/getggData'); ?>", {search: this.search, page: this.page1}, function (res) {
                        if (res.code == 1) {
                            that.list = res.data.list;
                            that.total = res.data.total;
                            that.title = that.list.length > 0 ? that.list[0].title : '';
                            that.content = that.list.length > 0 ? that.list[0].content : '';
                            that.newDate = that.list.length > 0 ? that.list[0].create_time : '';
                        } else {
                            layer.msg('网络错误', {icon: 2});
                        }
                    })
                },
                handleCurrentChange2(val) {
                    var that = this;
                    this.page2 = val;
                    $.post("<?php echo url('help/getwtData'); ?>", {search: this.search, page: this.page2}, function (res) {
                        if (res.code == 1) {
                            that.list2 = res.data.list2;
                            that.total2 = res.data.total2;
                            that.title = that.list.length > 0 ? that.list[0].title : '';
                            that.content = that.list.length > 0 ? that.list[0].content : '';
                            that.newDate = that.list.length > 0 ? that.list[0].create_time : '';
                        } else {
                            layer.msg('网络错误', {icon: 2});
                        }
                    })
                },
                getSearch:function(){
                    var that = this;
                    if(this.type == 1){
                        this.page1 = 1;
                        $.post("<?php echo url('help/getggData'); ?>", {search: this.search, page: this.page1}, function (res) {
                            if (res.code == 1) {
                                that.list = res.data.list;
                                that.total = res.data.total;
                            } else {
                                layer.msg('网络错误', {icon: 2});
                            }
                        })
                    }else{
                        this.page2 = 1;
                        $.post("<?php echo url('help/getwtData'); ?>", {search: this.search, page: this.page2}, function (res) {
                            if (res.code == 1) {
                                that.list2 = res.data.list2;
                                that.total2 = res.data.total2;
                            } else {
                                layer.msg('网络错误', {icon: 2});
                            }
                        })
                    }
                },
                getData: function () {
                    var that = this;
                    $.post("<?php echo url('help/index'); ?>", {}, function (res) {
                        console.log(res);
                        if (res.code == 1) {
                            that.list = res.data.list;
                            that.total = res.data.total;
                            that.list2 = res.data.list2;
                            that.total2 = res.data.total2;
                            that.title = that.list.length > 0 ? that.list[0].title : '';
                            that.content = that.list.length > 0 ? that.list[0].content : '';
                            that.newDate = that.list.length > 0 ? that.list[0].create_time : '';
                        } else {
                            layer.msg('网络错误', {icon: 2});
                        }
                    })
                },
            },
            /* 页面初始化的时候默认显示第一个内容的详情 */
            created: function () {
                this.getData();
                this.msg = '公告';
            }
        });

    });
</script>
<!-- 底部 -->
<footer>
  <div class="footer">
    <h2><b>©版权所有:&nbsp;</b><a href="#">安徽云梭网络科技有限公司</a></h2>
    <h2><b>技术支持:&nbsp;</b><a href="#">小白兔</a></h2>
  </div>
</footer>

</body>
</html>
