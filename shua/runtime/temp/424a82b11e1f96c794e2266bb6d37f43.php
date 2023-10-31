<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/seller\view\task\task_tow.html";i:1593528064;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\header.html";i:1698557939;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\footer.html";i:1698558175;}*/ ?>
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
<link href="/static/seller/css/editor.css" rel="stylesheet" type="text/css"/>
<link href="/static/seller/css/My_goods.css" rel="stylesheet" type="text/css"/>
<style>
  /* 上传图片 */
  .upload_pic {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    padding: 20px;
  }

  .upload_pic:last-child {
    border-bottom: none;
  }

  .upload_pic p {
    width: 130px;
  }

  .el_pic_upload {
    display: flex;
    flex-direction: row;
    align-items: center;
  }
  .layui-layer {
    top: 0px!important;
  }
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>
<div id="content" v-cloak>
  <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------			 -->
  <!-- 设置活动计划和增值服务-->
  <div class="right" id="second">
    <div class="right-top">
      <b>发布任务 / <strong>设置活动计划和增值服务 </strong></b>
    </div>
    <div class="bottm">
      <!-- 时间轴 -->
      <div class="timeline">
						<span class="alternatives">
							<i class="el-icon-check "></i>
							<b class="size">选择任务类型和商品信息</b>
						</span>
        <i class="el-icon-arrow-right"></i>
        <span class="alternative">
							<i class="el-icon-s-tools"></i>
							<b class="size">设置活动计划和增值服务</b>
						</span>
        <i class="el-icon-arrow-right"></i>
        <span>
							<i class="el-icon-success"></i>
							<b class="size-font">支付</b>
						</span>
      </div>
      <h5>1.设置任务单数 &nbsp;&nbsp;&nbsp;&nbsp;<p>注：平台每次发布最多 <b>10</b> 单任务</p>
      </h5>
      <table border="1" bordercolor="#eee" cellpadding="0" cellspacing="0" class="singular">
        <tr style="background: #f5f7fa;">
          <td>终端</td>
          <td>关键词类型</td>
          <td>关键词/淘口令/二维码</td>
          <td>设置单数</td>
        </tr>
        <tr>
          <td v-if="datainfo.terminal==1">电脑端</td>
          <td v-if="datainfo.terminal==2">手机端</td>
          <td v-if="datainfo.task_type==1">关键词分布</td>
          <td v-if="datainfo.task_type==2">淘口令</td>
          <td v-if="datainfo.task_type==3">二维码</td>
          <td v-if="datainfo.task_type==4">关键词分布</td>
          <td v-if="datainfo.task_type==5">关键词分布</td>
          <td v-if="datainfo.task_type==2">{{datainfo.tao_word}}</td>
          <td v-if="datainfo.task_type==3"><img :src="url+datainfo.qr_code" alt="二维码" onerror="imgError(this)" style="height: 50px"></td>
          <td v-if="datainfo.task_type==4 || datainfo.task_type==1 || datainfo.task_type==5">
              <div v-for="item in datainfo.goods" style="margin: 5px 0">
                <span style="margin: 5px 0">商品：{{item.name.substr(0,5)+'...'}}</span>
                <span v-for="val in item.key_word" style="margin: 5px 0"><el-input style="width: 120px" v-model="val.num" placeholder="输入使用次数"></el-input>关键词：<span style="color: red;display: inline;margin-right: 10px">{{val.key_word}}</span></span>
              </div>
          </td>
         <!-- <td v-if="datainfo.task_type==5">{{datainfo.channel_name}}</td>-->
          <td>
            <el-input-number :max='10' :min="0" label="描述文字" size="small"
                             v-model="datainfo.num"></el-input-number>
          </td>
        </tr>
        <tr style="background: #f5f7fa;">
          <td colspan="4">
            <div>总计投放：{{datainfo.num}} 单</div>
          </td>
        </tr>
      </table>
      <div class="headline">
        <h5>2.下单提示<p>（非必填）</p>
        </h5>
        <span>注：买手接任务时可看见该提示，提示内容自由填写，如：商品在第*页*行、聊天时不要问发货地和哪家快递等。属可选项，限100字内。</span>
      </div>
      <el-input :rows="2" autosize placeholder="请输入内容" type="textarea"
                v-model="datainfo.memo" maxlength="100"></el-input>
      <h5 style="margin-top:20px ;">3.增值服务 </h5>
      <div class="service">
        <div class="service-p ">
          <div class="service-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            是否包邮
          </div>
          <div class="service-right">
            <div class="between-left">
              <el-radio-group v-model="datainfo.is_free_shiping">
                <el-radio :label="1">包邮</el-radio>
                <el-radio :label="2">不包邮</el-radio>
              </el-radio-group>
            </div>
            <div class="between-right">
              <p v-if="datainfo.is_free_shiping==2"> 无需买手联系客服。商家每单额外支出 <b>10</b> 元作为运费押金，任务完成后运费押金将退还差价给商家 </p>
            </div>
          </div>
        </div>
        <div class="service-p">
          <div class="service-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            包裹重量
          </div>
          <div class="service-right">
            <div class="between-left">
              设置每个订单包裹重量
              <el-input-number :max='30' :min="0" label="描述文字" size="small" v-model="datainfo.weight"></el-input-number>
              kg
            </div>
            <div class="between-right">
              <p> 最大不超过 <b>30kg</b>，可设置小数点后两位</p>
            </div>
          </div>
        </div>
        <div class="service-p">
          <div class="service-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            快速返款
          </div>
          <div class="service-right">
            <div class="between-right">
              <p> 服务费用为每单任务商品价格的 <b>0.6%</b></p>
            </div>
            <div class="between-right">
              <el-tooltip effect="light" placement="bottom">
                <div class="content" slot="content">
                  <?php echo $pics[6]; ?>
                </div>
                <i class="el-icon-question"></i>
              </el-tooltip>
            </div>
          </div>
        </div>
        <div class="service-p ">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            加赏任务佣金
          </div>
          <div class="service-right">
            <div class="between-left">
              <el-input-number :min="0" label="描述文字" size="small" v-model="datainfo.add_reward"></el-input-number>
              银锭
            </div>
            <div class="between-right">
              <p> 总计 <b>{{datainfo.num}}</b> 单 金额 <b>{{datainfo.num * datainfo.add_reward}}</b> 银锭</p>
            </div>
          </div>
        </div>
        <div class="service-p ">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox v-model="datainfo.is_timing_pay">定时付款</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-left">
              <el-date-picker placeholder="选择日期时间" size="small" type="datetime" v-model="datainfo.timing_time"
                              value-format="yyyy-MM-dd HH:mm:ss"></el-date-picker>
            </div>
            <div class="between-right">
              <el-tooltip effect="light" placement="bottom">
                <div class="content" slot="content"><?php echo $pics[7]; ?></div>
                <i class="el-icon-question"></i>
              </el-tooltip>
            </div>
          </div>
        </div>
        <div class="service-p ">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox v-model="datainfo.next_day">隔天任务</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-left">
              接单后隔天付款
            </div>
            <div class="between-right">
              <el-tooltip effect="light" placement="bottom">
                <div class="content" slot="content"><?php echo $pics[8]; ?></div>
                <i class="el-icon-question"></i>
              </el-tooltip>
            </div>
          </div>
        </div>
        <div class="service-p ">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox v-model="datainfo.is_repay">设置回购任务</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-left">
              只有老顾客才能接的任务
            </div>
          </div>
        </div>
        <div class="service-p ">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox v-model="datainfo.is_timing_publish">定时发布</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-left">
              <el-date-picker placeholder="选择日期时间" size="small" type="datetime" v-model="datainfo.publish_time"
                              value-format="yyyy-MM-dd HH:mm:ss"></el-date-picker>
            </div>

          </div>
        </div>
        <div class="service-p">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            任务接单间隔
          </div>
          <div class="service-right">
            <div class="between-left">
              设置上一个买手提交完成任务后
              <el-input-number :min="0" label="描述文字" size="small"
                               v-model="datainfo.union_interval_time"></el-input-number>
              分钟后下一个买手接任务
            </div>

          </div>
        </div>
        <div class="service-p">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox v-model="datainfo.is_cycle_time">延长买家购物周期</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-left">
              <el-radio-group v-model="datainfo.cycle_time">
                <div class="label">
                  <el-radio :label="30">1个月<p>（ <b>1</b> 银锭/单/店铺）</p>
                  </el-radio>
                </div>
                <div class="label">
                  <el-radio :label="60">2个月<p>（ <b>2</b> 银锭/单/店铺）</p>
                  </el-radio>
                </div>
                <div class="label">
                  <el-radio :label="90">3个月<p>（ <b>3</b> 银锭/单/店铺）</p>
                  </el-radio>
                </div>
              </el-radio-group>
            </div>

          </div>
        </div>
        <div class="service-p">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox @change="onClick()" v-model="datainfo.is_praise">设置优质好评</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-comments">
              <b>如未设置优质好评将默认15字文字好评</b>
              <div class="comments" v-if="check">
                <div style="flex-wrap: wrap;" v-for="(val,k) in datainfo.praise">
                  <div v-for="(item,key) in val">
                    <span class="goods"><template v-if="key == 0">主商品</template><template v-else>副商品{{key}}</template>：</span>
                    <el-input :rows="2" placeholder="请输入内容" size="mini" style='width: 398px;' type="textarea"
                              v-model="item.str">
                    </el-input>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="service-p">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox @change="showImg()" v-model="datainfo.is_img_praise">上传图片好评</el-checkbox>
          </div>
          <div class="service-right">
            <div class="between-comments">
              <b>上传优质好评图片</b>
              <div class="comments" v-if="check_img">
                <div style="flex-wrap: wrap;" v-for="(val,k) in datainfo.img">
                  <div v-for="(item,key) in val">
                    <span class="goods"><template v-if="key == 0">主商品</template><template v-else>副商品{{key}}</template>：</span>
                    <div style="display: inline-block;position: relative;margin-right:4.5px;padding: 0;" v-for="(row,index) in item.img">
                      <img :src="url+row" alt="" onerror="imgError(this)" style="height: 80px;width: 80px">
                      <i @click="delImg(k,key,index)" class="el-icon-error" style="position: absolute;top:0px;right: 0px"></i>
                    </div>
                    <label style="display: inline-block">
                      <form action="">

                      </form>
                      <input @change="getImg($event,k,key)" accept="image/gif,image/jpeg,image/x-png" name="file"
                             style="position:absolute;opacity:0;" type="file"/>
                      <img src="/images/add.jpg" style="width: 80px;height: 80px;">
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="service-p  cover">
          <div class="service-left">&nbsp;&nbsp;&nbsp;
            <el-checkbox v-model="datainfo.is_video_praise" @change="showVideo()">上传视频好评</el-checkbox>
          </div>
          <div class="service-right">

            <div class="td-left">视频：</div>
            <div class="td-right" style="position:relative">
              <!-- 上传视频 -->
              <el-upload
                      class="avatar-uploader"
                      action="<?php echo url('task/uploadVideo'); ?>"
                      :show-file-list="false"
                      :on-success="succress">
                <video v-if="datainfo.video" :src="url+datainfo.video" controls class="avatar"></video>
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
              <span style="display: inline;position: absolute;right: 0px;top: 80px;color: red">*请确认评价图片与商品库内选择规格是否一致</span>
            </div>
          </div>
        </div>
      </div>
      <div class="foots">
        <el-button @click="cancel()" class='open3' type="text"><i class="el-icon-back"></i> 取消发布</el-button>
        <el-button @click="previous()" class='open3' type="text"><i class="el-icon-d-arrow-left"></i> 上一步</el-button>
        <el-button :plain="true" @click="nextStep()" class='open2'>下一步 <i class="el-icon-d-arrow-right"></i>
        </el-button>
      </div>
    </div>
  </div>

</div>
<style>
  .el-dialog {
    width: 950px !important;
  }

  .goodTable {
    margin-bottom: 10px !important;
    background: #f9f9f9 !important;
  }
</style>
<link href="/static/seller/css/main.css" rel="stylesheet">
<script src="/static/seller/js/app.js"></script>
<script>
    var name = new Vue({
        el: "#content",
        data: function () {
            return {
                url:'http://tfkzpic.oss-cn-hangzhou.aliyuncs.com',
                task_id:"<?php echo $id; ?>",
                datainfo: {
                    shop_id: '',
                    task_type: 1,
                    qr_code: '',
                    tao_word: '',
                    channel_name: '',
                    terminal: 2,
                    num: 0,
                    memo: '',
                    is_free_shiping: '',
                    is_timing_publish: '',
                    next_day: '',
                    postage: 5,
                    weight: '',
                    add_reward: '',
                    is_timing_pay: '',
                    timing_time: '',
                    is_repay:'',
                    union_interval_time: 0,
                    is_cycle_time: '',
                    cycle_time: '',
                    is_praise: '',
                    praise: [],
                    is_img_praise: '',
                    img: [],
                    is_video_praise: '',
                    video: '',
                    text_day:'',
                    is_ys:'',
                    ys_time:'',
                    yf_price:'',
                    wk_price:'',
                    goods:[],
                },
                praise: [],
                praise_img: [],
                check: false,
                check_img: false,
            }
        },
        created: function () {
            that = this;
            this.getData();
        },
        methods: {
            getData: function () {
                $.post("<?php echo url('task/taskTowData'); ?>", {id:this.task_id}, function (res) {
                    console.log(res);
                    if (res.code == 1) {
                        that.datainfo = res.data;
                        if(that.datainfo.is_praise==1)that.check=true;
                        if(that.datainfo.is_img_praise==1)that.check_img=true;
                    } else {
                        layer.msg(res.msg, {icon: 2,time:2000}, function () {
                            location.href = res.url;
                        });
                    }
                })
            },
            //下一步
            nextStep: function () {
                if (this.datainfo.num <= 0) return layer.msg('请填写任务单数!', {icon: 2});
                if (this.datainfo.weight <= 0) return layer.msg('请填写商品重量!', {icon: 2});
                if (this.datainfo.add_reward == 1) return layer.msg('加赏佣金最少2银锭!', {icon: 2});
                if (this.datainfo.add_reward > 20) return layer.msg('加赏佣金，最多20银锭!', {icon: 2});
                if(this.datainfo.is_video_praise==true && this.datainfo.video==''){
                    return layer.msg('请上传视频并等视频上传完成！',{icon: 2});
                };
                var loadingFlag;
                loadingFlag= layer.msg('正在读取数据，请稍候……', { icon: 16, shade: 0.5,shadeClose:false,time:100000 });
                $.post("<?php echo url('task/taskTowDo'); ?>", this.datainfo, function (res) {
                    if (res.code == 1) {
                        location.href=res.url;
                    } else {
                        layer.close(loadingFlag);
                        layer.msg(res.msg, {icon: 2});
                    }
                })
            },
            //取消发布
            cancel: function () {
                $.post("<?php echo url('Release/cancel'); ?>", {id: this.task_id}, function (res) {
                    if (res.code == 1) {
                        return  location.href="<?php echo url('index/index'); ?>";
                    }
                })
            },
            //上一步
            previous: function () { //:TODO
                $.post("<?php echo url('task/nextStep'); ?>", {id:this.task_id,step: 0}, function (res) {
                    if (res.code == 1) {
                        return  location.href=res.url;
                    }
                })
            },
            // 显示隐藏优质好评
            onClick:function() {
                if (that.datainfo.num <= 0){
                    this.datainfo.is_praise = false;
                    return layer.msg('请填写任务单数', {icon: 2});
                }
                this.datainfo.praise = [];
                if (this.datainfo.is_praise == true) {
                    for (var j = 0; j < this.datainfo.num; j++) {
                        this.praise = [];
                        for (var i = 0; i < this.datainfo.goods.length; i++) {
                            this.praise.push({str: ''});
                        }
                        this.datainfo.praise.push(this.praise);
                    }
                    this.check = true;
                } else {
                    this.praise = [];
                    this.check = false;
                }
            },
            /**
             * 好评图片
             */
            showImg:function() {
                if (that.datainfo.num <= 0){
                    this.datainfo.is_img_praise = false;
                    return layer.msg('请填写任务单数', {icon: 2});
                }
                if (that.datainfo.num > 5){
                    this.datainfo.is_img_praise = false;
                    return layer.msg('图片任务一次仅能发布5单任务', {icon: 2});
                }
                this.datainfo.img = [];
                if (this.datainfo.is_img_praise == true) {
                    for (var j = 0; j < this.datainfo.num; j++) {
                        this.praise_img = [];
                        for (var i = 0; i < this.datainfo.goods.length; i++) {
                            var img_list = {img:[]};
                            this.praise_img.push(img_list);
                        }
                        this.datainfo.img.push(this.praise_img);
                    }
                    this.check_img = true;
                } else {
                    this.praise_img = [];
                    this.check_img = false;
                }
            },

            showVideo:function() {
                if (that.datainfo.num != 1){
                    this.datainfo.is_video_praise = false;
                    return layer.msg('视频任务有且仅能发一单任务！', {icon: 2});
                }
                if (that.datainfo.goods.length > 1){
                    this.datainfo.is_video_praise = false;
                    return layer.msg('视频好评只能发布单一商品任务！', {icon: 2});
                }
            },

            /* 获取图片的base64路径 */
            getImg: function (e, index,val) {
                var reader = new FileReader();
                var img = '';
                reader.readAsDataURL(e.target.files[0]);
                reader.onload = function () {
                    if (that.datainfo.img[index][val].img.length >= 5) return layer.msg('最多上传5张图片', {icon: 2});
                    $.post("<?php echo url('task/uploadBast64'); ?>",{img:reader.result},function(res){
                        if(res.code==1){
                            that.datainfo.img[index][val].img.push(res.data);
                            that.datainfo = JSON.parse(JSON.stringify(that.datainfo))
                        }
                    })
                };
            },
            /* 删除图片 */
            delImg: function (k,key, index) {
                that.datainfo.img[k][key].img.splice(index, 1);
            },

            succress:function(res){
                if(res.code==1){
                    that.datainfo.video = res.data;
                    that.datainfo = JSON.parse(JSON.stringify(that.datainfo))
                }else{
                    layer.alert(res.msg);
                }
            },
        },
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
