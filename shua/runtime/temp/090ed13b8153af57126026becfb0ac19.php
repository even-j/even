<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"/www/wwwroot/xbt.com/pubic/../application/buy/view/recommend/index.html";i:1698557938;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/header.html";i:1698557938;s:58:"/www/wwwroot/xbt.com/application/buy/view/public/left.html";i:1574049114;s:60:"/www/wwwroot/xbt.com/application/buy/view/public/footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>小白兔</title>
	<link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
	<!-- 页面内容CSS -->
	<link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/yaoQingFriends.css"/>
	<script src="/static/buy/js/vue-2.6.10.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="/static/buy/js/vue-clipboard.js"></script>
	<script src="/static/buy/element-ui/lib/index.js" type="text/javascript" charset="utf-8"></script>
	<script src="/static/buy/js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$(function () {

			/* 初始化一个Vue */
			var vm = new Vue({
				el: ".center_box",
				data: function () {
					return {
						state:"<?php echo $state; ?>",
						linkValue:"<?php echo $url['seller']; ?>",
						linkValue2:"<?php echo $url['user']; ?>",
					}
				},
				methods: {
					/* 下拉菜单事件 */
					handleOpen: function (key, keyPath) {
						// console.log(key, keyPath);
					},
					handleClose: function (key, keyPath) {
						// console.log(key, keyPath);
					},
					/* 消息弹框事件 */
					openMsg: function () {
						this.$alert("暂无消息通知", "个人通知", {});
					},
					/* 引入vue-clipboard实现复制链接1 */
					copySuccess: function (e) {
						this.$message({
							message: "商家邀请链接复制成功",
							type: "success"
						});
						console.log(e.text);
					},
					copyError: function () {
						this.$message.error("商家邀请链接复制失败,请稍后重试");
					},
					/* 引入vue-clipboard实现复制链接2*/
					copySuccess2: function (e) {
						this.$message({
							message: "买手邀请链接复制成功",
							type: "success"
						});
						console.log(e.text);
					},
					copyError2: function () {
						this.$message.error("买手邀请链接复制失败,请稍后重试");
					}

				}
			});

			/* 初始化jQuery */
			$(function () {
				/* 调用jQuery实现选择导航栏效果 */
				$(".title a").click(function () {
					$(this).addClass("add_color").siblings().removeClass("add_color");
				});
			});

		});
	</script>
</head>
<body>
<div class="container">

	<!-- 头部 -->
	<link rel="stylesheet" type="text/css" href="/static/buy/css/header.css"/>
<div class="header" v-cloak>
    <div class="top_bg">
        <div class="top">
            <div class="top_left">
                <span><?php echo $users['username']; ?></span>
                <span class="gang">|</span>
                <a href="javascript:void (0)" class="tuichu">退出</a>
            </div>
            <div class="top_right">
                <span>本金: <span class="price_color"><?php echo $users['balance']; ?></span>元</span>
                <span class="gang">|</span>
                <span>银锭: <span class="price_color"><?php echo $users['reward']; ?></span>银锭</span>
            </div>
        </div>
    </div>
    <!-- 导航栏 -->
    <div class="nav">
        <a href="javascript:"><img class="logo" src="/static/buy/img/logo.png" alt="小白兔"/></a>
        <div class="title">
            <a href="<?php echo url('my/index'); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 1): ?>class="add_color" <?php endif; endif; ?>>
            个人中心</a>
            <a href="<?php echo url('helpcenter/index'); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 2): ?>class="add_color" <?php endif; endif; ?>> 帮助中心</a>
            <a href="<?php echo url('money/withsilver',['hnav'=>'3','nav'=>'2']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 3): ?>class="add_color" <?php endif; endif; ?>> 银锭充值</a>
            <a href="<?php echo url('money/withdrawal',['hnav'=>'3','nav'=>'1']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 4): ?>class="add_color" <?php endif; endif; ?>> 提现</a>
            <a href="<?php echo url('task/index',['hnav'=>'2','nav'=>'1']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 5): ?>class="add_color" <?php endif; endif; ?>>
            任务大厅</a>
        </div>
        <div class="bell_btn">
            <button type="button" class="el-button el-button--default el-button--small is-circle"
                    @click="dialogVisible = true">
                <i class="el-icon-bell"></i>
            </button>
            <div class="red_type" v-show="num > 0">{{num}}</div>
        </div>
        <div class="renwu_btn">
            <button class="el-button el-button--danger" @click="maketask">
                <img class="renwu_img" src="/static/buy/img/renwu.png" alt=""/>
                <span>继续任务</span>
            </button>
        </div>
    </div>
    <!-- 弹出框内容 -->
    <el-dialog :visible.sync="dialogVisible" title="个人通知">
        <div v-if="state==1" class="center_box1">

            <!-- 左边部分 -->
            <div class="left_box1">
                <div class="left_table">
                    <div :class="[index>=1?'hide_border':'',currentIndex===index?'selectOn':'']"
                         @click="handleClickTable(index)"
                         class="left_table_item"
                         v-for="(item,index) in tableList">
                        <div class="txt">
                            <span :class="item.look==1?'type_color':''"></span>
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
            <div class="right_box1">
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
<script>
    $(function () {

        vm=new Vue({
            el: ".header",
            data: function () {
                return {
                    curIndex: 0,
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
                    num:0
                }
            },
            methods: {
                maketask:function(){
                    location.href="<?php echo url('task/maketask'); ?>"
                },
                /* 消息弹框事件 */
                openMsg: function () {
                    this.dialogTableVisible = true;
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
                getData: function () {
                    var that = this;
                    $.post("<?php echo url('index/msg'); ?>", {page: that.page}, function (res) {
                        if (res.code == 1) {
                            console.log(res);
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
                },
                setData:function(index){
                    var that = this;
                    if(this.tableList[index].look==1)return;
                    that.tableList[index].look=1;
                    $.post("<?php echo url('index/setMsg'); ?>", {id: this.tableList[index].id}, function (res) {
                        if(res.data == 0)that.num=0;
                    })
                },
                setPage(val) {
                    this.page = val;
                    console.log(123);
                    this.getData();
                },
                addColor: function (index) {
                    this.curIndex = index;
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
            },
            created() {
                this.getData();
                this.panduan();
            }
        });

        $(function () {
            $(".tuichu").click(function () {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('login/logout'); ?>",
                    async: true,
                    data: {
                        "aoData": 'aaaa',//测试数据,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.code == 1) {
                            vm.alertSuccess(data.msg);
                            setTimeout(function () {
                                return location.href = data.url;
                            }, 3000)

                        } else {
                            return vm.alertError(data.msg);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status + "," + textStatus);
                    }
                });
            });
        });

    });
</script>


	<!-- 中间内容部分 -->
	<div class="center_box">
		<!-- 下拉列表 -->
		<style>
    [v-cloak]{
        display: none!important;
    }
</style>
<div class="a_path" v-cloak>
    <el-col class="select_box">
        <el-menu default-active="<?php if(!(empty($hnav) || (($hnav instanceof \think\Collection || $hnav instanceof \think\Paginator ) && $hnav->isEmpty()))): ?><?php echo $hnav; ?>-<?php echo $nav; endif; ?>" class="el-menu-vertical-demo" unique-opened>
            <el-submenu default-openeds index="1">
                <template slot="title">
                    <img alt="" src="/static/buy/img/zhanghaoxinxi.png" style="width: 20px;margin-right: 5px;" />
                    <span>账号信息</span>
                </template>
                <el-menu-item-group class="el_menu1">
                    <el-menu-item class="el_item" index="1-1">基本信息</el-menu-item>
                    <el-menu-item  class="el_item" index="1-2">账号提现</el-menu-item>
                    <el-menu-item  class="el_item" index="1-3">买号添加</el-menu-item>
                    <el-menu-item  class="el_item" index="1-4">会员VIP</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="2">
                <template slot="title">
                    <img alt="" src="/static/buy/img/renwuqingkuang.png" style="width: 20px;margin-right: 5px;" />
                    <span>任务情况</span>
                </template>
                <el-menu-item-group class="el_menu2">
                    <el-menu-item  class="el_item" index="2-1">任务领取</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">
                    <img alt="" src="/static/buy/img/zijinguanli.png" style="width: 20px;margin-right: 5px;" />
                    <span>资金管理</span>
                </template>
                <el-menu-item-group class="el_menu3">
                    <el-menu-item  class="el_item" index="3-1">提现</el-menu-item>
                    <el-menu-item  class="el_item" index="3-2">银锭充值</el-menu-item>
                    <el-menu-item  class="el_item" index="3-3">提现记录</el-menu-item>
                    <!--<el-menu-item  class="el_item" index="3-4">佣金记录</el-menu-item>-->
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="4">
                <template slot="title">
                    <img alt="" src="/static/buy/img/haoyouyaoqing.png" style="width: 20px;margin-right: 5px;" />
                    <span>好友邀请</span>
                </template>
                <el-menu-item-group class="el_menu4">
                    <el-menu-item  class="el_item" index="4-1">邀请好友</el-menu-item>
                    <el-menu-item  class="el_item" index="4-2">邀请记录</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
        </el-menu>
    </el-col>
</div>

<script>
    $(function () {
        $(".select_box .el_menu1 .el_item").click(function () {
            var index=$(this).index();
            //console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('my/information',['hnav'=>'1','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('my/withdrawal',['hnav'=>'1','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('my/add_buyno',['hnav'=>'1','nav'=>'3']); ?>"
            }else if(index===3){
                location.href="<?php echo url('my/vip_record',['hnav'=>'1','nav'=>'4']); ?>"
            }

        });
        $(".select_box .el_menu2 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('task/index',['hnav'=>'2','nav'=>'1']); ?>"
            }

        });
        $(".select_box .el_menu3 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('money/withdrawal',['hnav'=>'3','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('money/withsilver',['hnav'=>'3','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('money/drawal_record',['hnav'=>'3','nav'=>'3']); ?>"
            }
            else if(index===3){
                location.href="<?php echo url('money/commission',['hnav'=>'3','nav'=>'4']); ?>"
            }
        });
        $(".select_box .el_menu4 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('recommend/index',['hnav'=>'4','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('recommend/record',['hnav'=>'4','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('money/drawal_record',['hnav'=>'3','nav'=>'3']); ?>"
            }
            else if(index===3){
                location.href="<?php echo url('money/commission',['hnav'=>'3','nav'=>'4']); ?>"
            }
        });
    });
</script>



		<!-- 右边盒子部分 -->
		<div class="right_box">
			<!-- 基本信息标题 -->
			<div class="msg_title">
				<p>个人中心&nbsp;/&nbsp;账号信息&nbsp;/&nbsp;<span class="msg_title_txt">邀请好友</span></p>
			</div>
			<div class="user_content">

				<!-- 邀请好友 -->
				<div class="web_gonggao">
					<div class="gonggao_row">
						<div class="gonggao_top">
							<a href="javascript:" class="select_on">邀请好友</a>
						</div>
					</div>
				</div>

				<!-- 邀请好友部分 -->
				<div class="yaoqing_friend">
					<p class="yaoqing_txt">复制您的 <span>小白兔</span> 邀请链接，邀请好友成功注册 <span>小白兔</span> 账号之后，好友做任务您可以获得邀请奖励</p>
					<!-- 复制链接 -->
					<div class="yaoqing_link">
						<p><span>商家</span>邀请链接:</p>
						<el-input v-model="linkValue" :title="linkValue" readonly class="yaoqing_link_input"></el-input>
						<el-button type="primary" class="copy_link_btn" v-clipboard:copy="linkValue"
								   v-clipboard:success="copySuccess" v-clipboard:error="copyError">复制链接
						</el-button>
					</div>
					<div class="yaoqing_link">
						<p><span>买手</span>邀请链接:</p>
						<el-input v-model="linkValue2" :title="linkValue2" readonly class="yaoqing_link_input"></el-input>
						<el-button type="primary" class="copy_link_btn" v-clipboard:copy="linkValue2"
								   v-clipboard:success="copySuccess2" v-clipboard:error="copyError2">复制链接
						</el-button>
					</div>
					<!-- 请注意 -->
					<div class="alert">
						<div class="alert_title">
							<i class="el-icon-warning" style="font-size: 26px;margin-right: 10px"></i>
							<p>请注意:</p>
						</div>
						<div class="alert_txt">
							<p>1、邀请链接只能发布于聊天工具中，如微信，QQ等等，禁止推广于外部网站，如微博，博客，贴吧等等 的各大网站，平台会定期核实，如有发现一律邀请链接作废！</p>
							<p>2、邀请好友只能是朋友，亲戚，同事，熟人等等，一律不可向陌生人发送邀请链接，邀请进小白兔注册做任务。</p>
						</div>
					</div>
				</div>

				<!-- 邀请奖励 -->
				<div class="web_gonggao">
					<div class="gonggao_row">
						<div class="gonggao_top">
							<a href="javascript:" class="select_on">邀请奖励</a>
						</div>
					</div>
				</div>

				<!-- 邀请奖励部分 -->
				<div class="yaoqing_jiangli">

					<!-- 商家奖励 -->
					<p class="yaoqing_jiangli_txt">邀请商家成功，商家发布任务每单任务可获得 <span>1</span> 银锭作为奖励&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注:
						<span>商家发布任务的奖金由小白兔平台承担，不会扣除商家发布任务的金额</span>
					</p>
					<div class="yaoqing_table">
						<div class="yaoqing_table_left">商家发布任务奖励</div>
						<div class="yaoqing_table_right">
							<p>邀请好友每发布一单任务完结后，邀请人均可获得奖励 <span>1</span> 银锭；</p>
							<p>每邀请一个好友可获得奖励上限 <span>500</span> 银锭</p>
						</div>
					</div>

					<!-- 买手奖励 -->
					<p class="yaoqing_jiangli_txt">邀请买手完成任务后，可获得奖励&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注: <span>买手完成任务的奖金由小白兔平台承担，不会扣除买手完成任务获得的佣金
</span>
					</p>
					<div class="yaoqing_table">
						<div class="yaoqing_table_left">买家完成任务奖励</div>
						<div class="yaoqing_table_right">
							<p>邀请好友每完成一单任务（完结后），邀请人均可获得奖励 <span>0.5</span> 银锭；</p>
							<p>每邀请一个好友可获得奖励上限 <span>1000</span> 银锭</p>
						</div>
					</div>
					<!-- 请注意 -->
					<div class="alert">
						<div class="alert_title">
							<i class="el-icon-warning" style="font-size: 26px;margin-right: 10px"></i>
							<p>请注意:</p>
						</div>
						<div class="alert_txt">
							<p>任何用户不得利用此活动，自己邀请自己获得返利；一旦平台排查出这种情况，违规将给予处罚。</p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

	<!-- 底部 -->
	<!-- 底部 -->
<link rel="stylesheet" type="text/css" href="/static/buy/css/footer.css" />
<div class="commonFooter">
    <div class="contents">
        <!--©版权所有: <a href="#">安徽云梭网络科技有限公司</a>-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        技术支持: <a style="margin-right: 70px;" href="#">小白兔 </a>

    </div>
</div>

</div>

</body>
</html>
