<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"/www/wwwroot/xbt.com/pubic/../application/seller/view/black/index.html";i:1581339246;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/header.html";i:1698557939;s:63:"/www/wwwroot/xbt.com/application/seller/view/public/footer.html";i:1698558175;}*/ ?>
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
<style>
  .el-form-item__label {
    width: 120px;
  }

  .el-dialog {
    width: 600px !important;
  }
</style>
<!-- 右边盒子部分 -->
<div class="right">
  <!-- 基本信息标题 -->
  <div class="right-top">
    <b>个人中心 / 黑名单列表</b>
  </div>
  <div style="background: white;padding: 20px;">
    <el-button type="primary" style="width: 120px;margin-bottom: 20px;" @click="add"><i
            class="el-icon-plus"></i>添加
    </el-button>
    <el-table :data="list" border :header-cell-style="{background:'#f5f7fa'}">
      <el-table-column prop="wangwang" label="旺旺号" align="center">
      </el-table-column>
      <el-table-column label="拉黑类型" align="center">
        <teemlate slot-scope="scope">
          <div v-html="list[scope.$index].state===0?'永久拉黑':'限时拉黑'"></div>
        </teemlate>
      </el-table-column>
      <!--<el-table-column prop="end_time" label="拉黑时限" align="center" width="100">
      </el-table-column>-->
      <el-table-column prop="status" label="状态" align="center">
      </el-table-column>
      <el-table-column prop="remarks" label="审核备注" align="center" width="200">
      </el-table-column>
      <el-table-column prop="create_time" label="添加时间" align="center" width="100">
      </el-table-column>
      <el-table-column prop="update_time" label="修改时间" align="center" width="100">
      </el-table-column>
      <el-table-column label="操作" align="center">
        <teemlate slot-scope="scope">
          <!--<el-button type="primary" @click="edit(scope.$index)"><i class="el-icon-edit"></i>修改</el-button>-->
          <el-button type="primary" @click="del(list[scope.$index].id)" v-if="list[scope.$index].status!=1"><i class="el-icon-delete"></i>删除</el-button>
        </teemlate>
      </el-table-column>
    </el-table>
    <div style="padding-top: 20px;display: flex;align-items: center;justify-content: center;">
      <el-pagination background
                     @size-change="handleSizeChange"
                     @current-change="handleCurrentChange"
                     :current-page="page"
                     :page-sizes="sizes"
                     :page-size="size"
                     layout="total, sizes, prev, pager, next, jumper"
                     :total="total">
      </el-pagination>
    </div>
  </div>
  <el-dialog :title="name[state]" :visible.sync="dialog">
    <el-form :model="form">
      <el-form-item label="旺旺号">
        <el-input v-model="form.wangwang" autocomplete="off" style="width: 300px;"></el-input>
      </el-form-item>
      <el-form-item label="拉黑类型">
        <el-select v-model="form.state" placeholder="请选择拉黑类型" style="width: 300px;">
          <el-option label="永久拉黑" :value="0"></el-option>
          <!--<el-option label="限时拉黑" :value="1"></el-option>-->
        </el-select>
        </el-form-item>
      <p style="color:red;font-size: 20px;font-weight: bold">*添加后,请带截图私聊在线客服拉黑原因</p>
      <!--<el-form-item label="拉黑时限" v-if="form.state===1">
          <el-date-picker v-model="form.end_time" type="datetime" placeholder="选择日期时间" style="width: 300px;" value-format="yyyy-MM-dd HH:mm">
          </el-date-picker>
        </el-form-item>-->
      </el-form>
    <div slot="footer" class="dialog-footer">
      <el-button @click="dialog = false">取 消</el-button>
      <el-button type="primary" @click="agree()">确 定</el-button>
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
                    list: [],
                    size: 10,
                    sizes: [10, 15, 20, 25, 30],
                    page: 1,
                    total: 0,
                    dialog: false,
                    form: {
                        id:'',
                        wangwang: '',
                        state: '',
                        end_time: '',
                    },
                    state: 0,
                    name: ['添加黑名单', '修改黑名单'],
                }
            },
            created: function () {
                this.getData();
            },
            methods: {
                getData: function () {
                    var loadingFlag;
                    loadingFlag = layer.msg('正在读取数据，请稍候……', {icon: 16, shade: 0.5, shadeClose: false, time: 6000});
                    var that = this;
                    $.post("<?php echo url('Black/getData'); ?>", {size: this.size, page: this.page}, function (res) {
                        if (res.code === 1) {
                            that.list = res.data.list;
                            that.total = res.data.total;
                            layer.close(loadingFlag);
                        } else {
                            layer.close(loadingFlag);
                            layer.msg('网络错误！', {icon: 2});
                        }
                    })
                },
                edit: function (index) {
                    this.form.wangwang = this.list[index].wangwang;
                    this.form.state = this.list[index].state;
                    this.form.end_time = this.list[index].end_time=='暂无数据' ? '' : this.list[index].end_time;
                    this.form.id = this.list[index].id;
                    this.state = 1;
                    this.dialog = true;
                    console.log(this.form.end_time)
                },
                add: function () {
                    this.form.wangwang = '';
                    this.form.id = '';
                    this.form.state = 0;
                    this.form.end_time = '';
                    this.state = 0;
                    this.dialog = true;
                },
                handleSizeChange: function (val) {
                    this.size = val;
                    this.getData();
                },
                handleCurrentChange: function (val) {
                    this.page = val;
                    this.getData();
                },
                agree:function(){
                    this.dialog = false;
                    var that = this;
                    $.post("<?php echo url('Black/editData'); ?>", this.form, function (res) {
                        if (res.code === 1) {
                            layer.msg(res.msg, {icon: 1},function(){
                                that.getData();
                            });
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    })
                },
                del:function(id){
                    $.post("<?php echo url('Black/del'); ?>", {id:id}, function (res) {
                        if (res.code === 1) {
                            layer.msg(res.msg, {icon: 1},function(){
                                that.getData();
                            });
                        } else {
                            layer.msg(res.msg, {icon: 2});
                        }
                    })
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
