<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/seller\view\task\dispatch.html";i:1593528116;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\header.html";i:1698557939;s:71:"D:\phpstudy\WWW\zhan\shua_li\application\seller\view\public\footer.html";i:1698558175;}*/ ?>
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
  <!-- 选择任务类型和商品信息 -->
  <div class="right" id="first">
    <div class="right-top">
      <b>发布任务 / <strong>选择任务类型和商品信息 </strong></b>
    </div>
    <div class="bottm">
      <!-- 时间轴 -->
      <div class="timeline">
						<span class="alternative">
							<i class="el-icon-edit "></i>
							<b class="size">选择任务类型和商品信息</b>
						</span>
        <i class="el-icon-arrow-right"></i>
        <span>
							<i class="el-icon-s-tools"></i>
							<b class="size">设置活动计划和增值服务</b>
						</span>
        <i class="el-icon-arrow-right"></i>
        <span>
							<i class="el-icon-success"></i>
							<b class="size-font">支付</b>
						</span>
      </div>
      <!-- 类型和商品信息 -->
      <h5>1.选择店铺</h5>
      <div class="radio">
        <el-select placeholder="请选择" v-model="datainfo.shop_id">
          <el-option :disabled="disabled" :key="key" :label="item.shop_name" :value="item.id"
                     v-for="(item,key) in shop"></el-option>
        </el-select>
      </div>
      <h5>2.任务类型</h5>
      <div class="radio">
        <el-radio :label="1" border size="medium" style='width: 150px;' v-model="datainfo.task_type">
          <b class="icon iconfont icon-picture"></b> 文字好评
          <el-tooltip class="item" content="<?php echo $pics[1]; ?>" effect="dark" placement="top">
            <img src="/static/seller/img/wenhao.png">
          </el-tooltip>
        </el-radio>
        <el-radio :label="2" border size="medium" style='width: 138px;' v-model="datainfo.task_type">
          <b class="icon iconfont icon-zhongzhirenzhengkouling"></b> 淘口令
          <el-tooltip class="item" content="<?php echo $pics[2]; ?>" effect="dark" placement="top">
            <img src="/static/seller/img/wenhao.png">
          </el-tooltip>
        </el-radio>
        <el-radio :label="3" border size="medium" style='width: 138px;' v-model="datainfo.task_type">
          <b class="icon iconfont icon-ico"></b> 二维码
          <el-tooltip class="item" content="<?php echo $pics[3]; ?>" effect="dark" placement="top">
            <img src="/static/seller/img/wenhao.png">
          </el-tooltip>
        </el-radio>
        <el-radio :label="4" border size="medium" style='width:138px;' v-model="datainfo.task_type">
          <b class="icon iconfont icon-zhitongche"></b> 直通车
          <el-tooltip class="item" content="<?php echo $pics[4]; ?>" effect="dark" placement="top">
            <img src="/static/seller/img/wenhao.png">
          </el-tooltip>
        </el-radio>
        <el-radio :label="5" border size="medium" style='width:138px;' v-model="datainfo.task_type">
          <b class="icon iconfont icon-zhitongche"></b> 通道类
          <el-tooltip class="item" content="<?php echo $pics[5]; ?>" effect="dark" placement="top">
            <img src="/static/seller/img/wenhao.png">
          </el-tooltip>
        </el-radio>
      </div>
      <h5>3.做任务终端</h5>
      <div class="radio">
        <el-radio :label="2" :value="2" border size="medium" style='width: 138px;' v-model="datainfo.terminal">
          <b class="el-icon-mobile-phone"></b> 手机
        </el-radio>
        <el-radio :label="1" :value="1" border size="medium" style='width: 150px;' v-model="datainfo.terminal">
          <b class="el-icon-s-platform"></b> pc端
        </el-radio>
      </div>
      <h5>4.选择商品</h5>
      <div class="radio" id='bangding'>
        <el-button @click="selectGoods()" class='choose' size='medium' type="text"><i class="el-icon-plus"></i>从商品库中选择商品
        </el-button>

        <el-button @click="goodsAdd()" class="chooses" size='medium' type="primary"><i class="el-icon-plus"></i>
          新建商品
        </el-button>

        <p style="color: red">( 注：请选择同一个店铺商品，如非同一店铺造成的损失平台概不承担，最多选择3个商品，1个主商品，2个副商品，每个副商品增加 <b style="font-size: 16px">2</b> 银锭 ) </p>
        <!-- 表格 -->
        <div id="tables" style="margin-top:20px ;">
          <div class="topHeader_s">
            <div style="width:300px;">商品信息</div>
            <div style="width: 110px;">价格</div>
            <div style="width: 150px;">下单数量</div>
            <div style="width: 120px;">搜索价格</div>
            <div style="width: 190px;">操作</div>
          </div>
          <!-- 数组 -->
          <div id='form' v-for="(item,index) in datainfo.goods">
            <div id="table" style="margin-bottom: 10px;">
              <div class="goodsCommon">
                <table border="0" cellspacing="0" class="goodTable">
                  <tr>
                    <td colspan="4">
                      <strong>
                        <img alt="" class="iconImg" :src="item.pic"/>&nbsp;{{item.type}}店铺：<span>{{item.shop_name}}</span>
                      </strong>
                    </td>
                    <td>
                      <div style="float: right;width:150px;">
                        <el-button :disabled="item.is_del" @click="goodsDel(index)" size='small'
                                   style="float: right;display: block;"
                                   type="danger">删除
                        </el-button>
                        <span style="color: red;float: right;margin-right:10px ;"> {{item.goods_type}}<template
                                v-if="index > 0">{{index}}</template></span>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="td-one">
                      <img :src="url+item.pc_img" alt="" class="goodsPicture"
                           onerror="imgError(this)">&nbsp;&nbsp;
                      <p class="titles">{{item.name}}</p>
                    </td>
                    <td style="width:150px;text-align:left;">
                      <span style="color: red;">
                        <el-input style="width: 120px" v-model="item.price"></el-input> 元
                      </span>
                    </td>
                    <td style="width: 100px;text-align: center;"><span style="color: red;"><el-input v-model="item.num" style="width: 50px"></el-input> 件</span></td>
                    <td style="width: 110px;text-align: center;"><span style="color: red;">{{item.show_price}} 元</span>
                    </td>
                    <td style="text-align: right;">
                      <div style="text-align: right;margin-right:20px ;">
                        <el-button @click='goodsEdit(item.id)' plain size='small' type="primary">
                          编辑
                        </el-button>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div>
                商品规格：<el-input placeholder="填写商品规格" style='width: 450px;' v-model="item.goods_spec"></el-input><span style="display: inline;color: red">*请确认评价图片与商品库内选择规格是否一致</span>
            </div>
            <div class="moder" v-for="(row, key) in item.key_word" :key="key">
              <b>关键词：</b>
              搜索词=
              <el-input placeholder="请输入内容" size="small" style='width: 250px;' v-model="row.key_word"></el-input>
              <el-button @click="advanced(index,row,key)" size="small" type="primary"><i class="el-icon-s-tools"></i>&nbsp;&nbsp;高级设置
              </el-button>
              <el-button @click='keyRemove(index,key)' size="small" type="danger"><i class="el-icon-delete"></i>&nbsp;&nbsp;删除
              </el-button>
            </div>
            <span class="add">
              <i @click="keyAdd(index)" class="el-icon-plus"></i>
              <b style="color: red"> ( 添加加关键词，最多5组 )</b>
            </span>

          </div>
        </div>
      </div>
      <div v-if="datainfo.task_type==2">
        <h5>5.添加淘口令</h5>
        <div>
          <el-form label-width="70px" ref="form">
            <el-form-item label="淘口令：">
              <el-input type="textarea" v-model="datainfo.tao_word" maxlength="100" placeholder="输入通道入口,限制100字"></el-input>
            </el-form-item>
          </el-form>
        </div>
      </div>
      <div v-show="datainfo.task_type==3">
        <h5>5.上传二维码</h5>
        <div class="upload_pic">
          <p>二维码：</p>
          <div class="el_pic_upload">
            <el-upload :auto-upload="false" :file-list="url+img"
                       :limit="1"
                       :on-change="handleChange"
                       :on-remove="ewmRemove"
                       action="string"
                       list-type="picture-card"
                       ref="unload">
              <i class="el-icon-plus"></i>
            </el-upload>
          </div>
        </div>
      </div>
      <div v-show="datainfo.task_type==5">
        <h5>5.填写通道入口</h5>
        <div class="upload_pic">
          <p>通道入口：</p>
          <div class="el_pic_upload">
            <el-upload
                    ref="upLoad2"
                    action="<?php echo url('task/uploadImg'); ?>"
                    list-type="picture-card"
                    :on-remove="handleRemove"
                    :on-success="imgSuccress"
                    :limit="3"
                    :before-upload="beforeUploads">
              <i class="el-icon-plus"></i>
            </el-upload>
          </div>
        </div>
      </div>
      <div class="foots">
        <el-button @click="cancel()" class='open3' type="text"><i class="el-icon-back"></i> 取消发布</el-button>
        <el-button :plain="true" @click="nextStep()" class='open2'>下一步 <i class="el-icon-d-arrow-right"></i>
        </el-button>
      </div>

    </div>

  </div>
  <el-dialog :visible.sync="gaojiVisible" class="one"  title="【关键词1 搜索词】高级设置" width="1000px">
    <div class="gaojiSearch">
      <div class="gaojiSearch_p">
        <div class="gaojiSearch_left">折扣服务：</div>
        <div class="gaojiSearch_right">
          <el-checkbox-group v-model="advanceds.discount">
            <el-checkbox :label="item" :value="key" v-for="(item,key) in discount" :key="key"></el-checkbox>
          </el-checkbox-group>
        </div>
      </div>
      <div class="gaojiSearch_p">
        <div class="gaojiSearch_left">筛选分类：</div>
        <div class="gaojiSearch_right">
          <el-input placeholder="分类1" size="small" style='width:100px;margin-right:6px;' v-model="advanceds.filter.class1"></el-input>
          <el-input placeholder="分类2" size="small" style='width:100px;margin-right:6px;' v-model="advanceds.filter.class2"></el-input>
          <el-input placeholder="分类3" size="small" style='width:100px;margin-right:6px;' v-model="advanceds.filter.class3"></el-input>
          <el-input placeholder="分类4" size="small" style='width:100px;margin-right:6px;' v-model="advanceds.filter.class4"></el-input>最多四个分类
        </div>
      </div>
      <div class="gaojiSearch_p">
        <div class="gaojiSearch_left">排序方式：</div>
        <div class="gaojiSearch_right">
          <el-select placeholder="请选择" size="small" style='width: 128px;' v-model="advanceds.sort">
            <el-option :label="item" :value="item" v-for="(item,k) in options" :key="k"></el-option>
          </el-select>
          &nbsp;价格：
          <el-input placeholder="最低价" size="small" style='width:100px;margin-right:6px;' v-model="advanceds.min_price"></el-input>
          -&nbsp;
          <el-input placeholder="最高价" size="small" style='width:100px;margin-right:6px;' v-model="advanceds.max_price"></el-input>
          &nbsp;发货地：
          <el-select placeholder="请选择省份" size="small" style='width: 128px;' v-model="advanceds.province">
            <el-option :key="key" :label="item" :value="item" v-for="(item,key) in province" :key="key"></el-option>
          </el-select>
        </div>
      </div>
    </div>
    <div class="gaojiSearch_center">
      <el-button @click='quxiao' style='width: 200px;'>取消</el-button>
      <el-button @click='quren()' style='width: 200px;' type="danger">确认</el-button>
    </div>
  </el-dialog>
  <el-dialog :visible.sync="goodsShow" title="选择商品">
    <div class="center">
      <!-- 选项 -->
      <div class="hang" style="text-align: left;">
        <el-form :inline="true" :model="searchGoods" class="demo-form-inline">
          <el-form-item label="价格">
            <el-input class='low' placeholder="最低价" v-model="searchGoods.min_price"></el-input>
            -
            <el-input class='low' placeholder="最高价" v-model="searchGoods.max_price"></el-input>
          </el-form-item>
          <el-form-item>
            <el-input class='sousuo' placeholder="请输入关键字搜索" v-model="searchGoods.search"></el-input>
          </el-form-item>
          <el-form-item>
            <el-button @click="search()" class='search' type="primary"><i class="el-icon-search"></i> 搜索</el-button>
          </el-form-item>
        </el-form>
      </div>
      <!-- 表格 -->
      <div class="topHeader_s">
        <div style="width: 400px;">商品信息</div>
        <div style="width: 70px;">搜索价格</div>
        <div style="width: 380px;">操作</div>
      </div>
      <!-- 数组 -->
      <div class='form'>
        <div class="table" style="margin-bottom: 10px;">
          <div class="goodsCommon">
            <table :key="index" border="0" cellspacing="0" class="goodTable" v-for="(item,index) in goodslist">
              <tr>
                <td colspan="4">
                  <strong>
                    <img class="iconImg" :src="item.pic"/>&nbsp;{{item.type}}店铺：<span
                          v-html="item.shop_name"></span>
                  </strong>
                </td>
                <td style="width: 350px;border-bottom:1px solid #eee;">
                </td>
              </tr>
              <tr>
                <td class="td-one">
                  <img :src="url+item.pc_img" alt="" class="goodsPicture" onerror="imgError(this)">&nbsp;&nbsp;
                  <p class="titles">{{item.name}}</p>
                </td>
                <td style="width:150px;text-align:left;padding-left:20px ;"><span style="color: red;">{{item.show_price}} 元</span>
                </td>
                <td style="text-align:left;">
                  <div style="margin-right:20px;">
                    <el-button :disabled="judge(item.id)" @click="choose(item)" class='dangerous' type="danger"><i
                            class="el-icon-circle-plus"></i>&nbsp;选择
                    </el-button>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- 页数 -->
      <div class="hang">
        <el-pagination :current-page="searchGoods.page" :page-size="searchGoods.size" :page-sizes="sizes" :total="total"
                       @current-change="changePage" @size-change="changeSize" background
                       layout="total, sizes, prev, pager, next, jumper"></el-pagination>
      </div>
    </div>
  </el-dialog>

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
                disabled: false,
                shop: [],
                datainfo: {
                    id:'',
                    shop_id: '',
                    task_type: 1,
                    qr_code: '',
                    tao_word: '',
                    channel_img: [],
                    terminal: 2,
                    goods:[],
                },
                goods_id:[],
                goodsShow: false, //选择商品弹窗
                goodslist: [],
                total: 0,
                sizes: [5, 10,],
                searchGoods: {
                    shop_id: '',
                    min_price: '',//最低价
                    max_price: '',//最高价
                    search: '',//搜索
                    page: 1,
                    size: 5,
                },
                key:false,
                key_word:[],
                goods_index:'',
                subscript:'',
                advanceds:{
                    key_word:'',
                    discount:[],
                    filter:{
                        class1:'',
                        class2:'',
                        class3:'',
                        class4:'',
                    },
                    sort:'',
                    max_price:'',
                    min_price:'',
                    province:'',
                },
                gaojiVisible:false,
                discount:{
                    0:'包邮',
                    1:'公益宝贝',
                    2:'全球购',
                    3:'消费者保障',
                    4:'货到付款',
                    5:'淘金币抵钱',
                    6:'天猫',
                    7:'花呗分期',
                    8:'7+天退货',
                    9:'天猫超市',
                    10:'天猫直送',
                    11:'通用排序',
                },
                options:{
                    0:'综合排序',
                    1:'销量优先',
                    2:'价格由高到低',
                    3:'价格由低到高',
                    4:'信用排序'
                },
                province:{},
            }
        },
        created: function () {
            that = this;
            this.taskJudge();
            this.getData();
            this.getProvince();
        },
        computed: {

        },
        methods: {
            getProvince:function(){
                var that = this;
                axios.get("/static/seller/json/province.json").then(function (province) {
                    that.province = province.data;
                }).catch(function (error) {
                })
            },
            taskJudge: function () {
                $.post("<?php echo url('task/taskJudge'); ?>", {}, function (res) {
                    if (res.code == 1) {
                      console.log(res.data);
                      that.datainfo = res.data;
                    }
                })
            },
            getData: function () {
                $.post("<?php echo url('task/shop'); ?>", {}, function (res) {
                    if (res.code == 1) {
                        that.shop = res.data;
                    } else {
                        layer.msg(res.msg, {icon: 2}, function () {
                            location.href = res.url;
                        });
                    }
                })
            },
            judge: function (id) {
                if (this.goods_id.indexOf(id) > -1) {
                    return true;
                } else {
                    return false;
                }
            },
            selectGoods: function () {
                if (!this.datainfo.shop_id) return layer.msg('请先选择店铺！', {icon: 2});
                that.searchGoods.shop_id = this.datainfo.shop_id;
                that.goodsShow = true;
                this.getGoodsData();
            },
            getGoodsData: function () {
                $.post("<?php echo url('task/getGoods'); ?>", this.searchGoods, function (res) {
                    console.log(res);
                    if (res.code == 1) {
                        that.goodslist = res.data.list;
                        that.total = res.data.total;

                    } else {
                        layer.msg(res.msg, {icon: 2});
                    }
                })
            },
            search: function () {
                this.getGoodsData();
            },
            changeSize: function (val) {
                this.searchGoods.size = val;
                this.getGoodsData();
            },
            changePage: function (val) {
                this.searchGoods.page = val;
                this.getGoodsData();
            },
            choose: function (item) {
                var that = this;
                $.post("<?php echo url('task/verifyGoods'); ?>", {id: item.id}, function (res) {
                    if (res.code == 1) {
                        that.goodsShow = false;
                        that.disabled = true;
                        if (that.datainfo.goods.length >= 3) return layer.msg('商品最多只能添加3个！', {icon: 2});
                        if (that.datainfo.goods.length > 0) {
                            item.goods_type = '副商品';
                        } else {
                            item.goods_type = '主商品';
                        }
                        that.datainfo.goods.push(item);
                        that.goods_id.push(item.id);
                    } else {
                        return layer.msg(res.msg, {icon: 2});
                    }
                })

            },
            goodsDel: function (index) {
                this.datainfo.goods.splice(index, 1);
                this.goods_id.splice(index, 1);
                if (this.datainfo.goods.length == 0) {
                    this.disabled = false;
                }
            },
            goodsEdit: function (id) {
              app.openSidebar({
                title: '商品修改',
                area: ['1000px', '90%'],
                url: '<?php echo url("goods/edit","","",true); ?>/id/'+id,
              });
            },
            goodsAdd: function () {
                app.openSidebar({
                    title: '商品添加',
                    area: ['1000px', '90%'],
                    url: '<?php echo url("goods/taskGoods"); ?>',
                });
            },
            keyAdd: function(index) {
                if(this.datainfo.goods[index].key_word.length==5){
                    return layer.msg('最多添加5组关键词',{icon:3,time:2000});
                }
                var arrays = {
                    key_word:'',
                    discount:[],
                    filter:{
                        class1:'',
                        class2:'',
                        class3:'',
                        class4:'',
                    },
                    sort:'',
                    max_price:'',
                    min_price:'',
                    province:'',
                };
                this.datainfo.goods[index].key_word.push(arrays);
            },
            // 删除关键词数组
            keyRemove: function(index,key) {
                this.datainfo.goods[index].key_word.splice(key,1);
            },
            advanced:function(index,row,key){
                this.gaojiVisible=true;
                this.advanceds = row;
                this.subscript = key;
                this.goods_index = index;
            },

            //高级搜索取消
            quxiao: function() {
                this.gaojiVisible = false
            },
            //高级搜索取消
            quren: function() {
                this.gaojiVisible = false;
                this.datainfo.goods[this.goods_index].key_word[this.subscript] = this.advanceds;
            },

            /* 获取图片的base64路径 */
            handleChange: function (e) {
                var that = this;
                var reader = new FileReader();
                reader.readAsDataURL(e.raw);
                reader.onload = function () {
                    that.localFile = reader.result;
                    that.datainfo.qr_code = reader.result;
                }
            },
            /* 删除图片 */
            ewmRemove: function (file) {
                // console.log(file);
            },
            /* 通道图片*/
            imgSuccress:function(res){
                if(res.code==1){
                    this.datainfo.channel_img.push(url+res.data);
                }else{
                    layer.alert(res.msg);
                }
            },
            handleRemove:function(file, fileList) {
                var i = 0;
                this.datainfo.channel_img = [];
                for(i;i<fileList.length;i++){
                    this.datainfo.channel_img.push(fileList[i].response.data);
                }
            },
            beforeUploads:function(file){
                const isJPEG = file.type === 'image/jpeg';
                const isPNG = file.type === 'image/png';
                const isJPG = file.type === 'image/jpg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPEG && !isPNG && !isJPG) {
                    return layer.msg('上传图片格式错误!',{icon:2});
                }
                if (!isLt2M) {
                    return layer.msg('上传头像图片大小不能超过 2MB!',{icon:2});
                }
            },
            /*通道图片处理*/
            //下一步
            nextStep: function () {
                if (!this.datainfo.shop_id) return layer.msg('请选择店铺!', {icon: 2});
                if (!this.datainfo.task_type) return layer.msg('请选择任务类型!', {icon: 2});
                if (this.datainfo.goods.length <= 0) return layer.msg('请选择商品!', {icon: 2});
                if (!this.datainfo.terminal) return layer.msg('请选择终端类型', {icon: 2});
                if (this.datainfo.task_type==2 && this.datainfo.tao_word=='')return  layer.msg('淘口令不能为空', {icon: 2});
                if (this.datainfo.task_type==3 && this.datainfo.qr_code=='')return  layer.msg('二维码不能为空', {icon: 2});
                if (this.datainfo.task_type==5 && this.datainfo.channel_img=='')return  layer.msg('通道名称不能为空', {icon: 2});
                if (this.datainfo.terminal == 1 && (this.datainfo.task_type == 2 || this.datainfo.task_type == 3)) return layer.msg('淘口令和二维码只能在手机上使用', {icon: 2});
                $.post("<?php echo url('task/taskOneDo'); ?>", this.datainfo, function (res) {
                    if (res.code == 1) {
                        location.href=res.url;
                    } else {
                        return layer.msg(res.msg, {icon: 2});
                    }
                });
            },
            //取消发布
            cancel: function () {
                $.post("<?php echo url('Release/cancel'); ?>", {id:this.datainfo.id}, function (res) {
                    if (res.code == 1) {
                        return  location.href="<?php echo url('index/index'); ?>";
                    }else{
                      layer.msg(res.msg,{icon:2});
                    }
                })
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
