<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/xbt.com/pubic/../application/admin/view/buyer/buy_number_list.html";i:1578364410;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商家列表</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/admin_style/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/admin_style/css/public.css" media="all" />
	<link rel="stylesheet" href="//at.alicdn.com/t/font_1308190_7kttvg3l5i.css" media="all" />

	<style>
		.layui-table-cell {
			font-size:16px;
			padding:0 5px;
			height:auto;
			overflow:visible;
			text-overflow:inherit;
			white-space:normal;
			word-break: break-all;
		}
		.red{
			color: red;
		}
		.green{
			color: green;
		}
	</style>
</head>

<body class="childrenBody">
	<form class="layui-form">
		<blockquote class="layui-elem-quote quoteBox">
			<form class="layui-form">
				<div class="layui-inline">
					<label style="width:125px;" class="layui-form-label">用户名：</label>
					<div class="layui-input-inline">
						<input type="tel" name="username" lay-verify="username" autocomplete="off" class="layui-input phone"
							   placeholder="请输入用户名">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">旺旺号：</label>
					<div class="layui-input-inline">
						<input type="tel" name="wangwang" lay-verify="wangwang" autocomplete="off" class="layui-input name"
							placeholder="请输入旺旺号">
					</div>
				</div>

<!--				<div class="layui-inline">-->
<!--					<label style="width:125px;" class="layui-form-label">手机号：</label>-->
<!--					<div class="layui-input-inline">-->
<!--						<input type="tel" name="userphone" lay-verify="userphone" autocomplete="off" class="layui-input phone"-->
<!--							   placeholder="请输入手机号">-->
<!--					</div>-->
<!--				</div>-->

				<div class="layui-inline">
					<label style="width:125px;" class="layui-form-label">收货人手机号码：</label>
					<div class="layui-input-inline">
						<input type="tel" name="phone" lay-verify="phone" autocomplete="off" class="layui-input phone"
							placeholder="请输入收货人手机号码">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">QQ号：</label>
					<div class="layui-input-inline">
						<input type="tel" name="qq" lay-verify="qq" autocomplete="off" class="layui-input qq"
							   placeholder="请输入QQ号">
					</div>
				</div>
				<div class="layui-inline">
					<label style="width:125px;" class="layui-form-label">收货地址：</label>
					<div class="layui-input-inline">
						<input type="text" name="detail_address" lay-verify="detail_address" autocomplete="off" class="layui-input phone"
							   placeholder="请输入收货地址">
					</div>
				</div>

				<div class="layui-inline">
					<label style="width:125px;" class="layui-form-label">支付宝认证姓名：</label>
					<div class="layui-input-inline">
						<input type="text" name="alipayname" lay-verify="alipayname" autocomplete="off" class="layui-input phone"
							   placeholder="支付宝认证姓名">
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label" >审核状态：</label>
					<div class="layui-input-inline" style="width: 100px;">
						<select name="state" id="state1" lay-verify="" >
							<option value="" selected>全部</option><!-- 默认选中 -->
							<option value="0">未审核</option>
							<option value="1">审核通过</option>
							<option value="2">已禁用</option>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<div class="layui-input-inline">
						<a class="layui-btn search_btn" data-type="reload" lay-filter="reload" lay-submit><i class="layui-icon">&#xe615;</i>搜 索</a>
					</div>
				</div>
			</form>
		</blockquote>
		<table id="userList" lay-filter="userList"></table>
		<!--审核状态-->
		<script type="text/html" id="state">
			{{#  if(d.newsStatus == "2"){ }}
			<span class="layui-red">不通过</span>
			{{#  } else if(d.newsStatus == "1"){ }}
			<span class="layui-blue">等待审核</span>
			{{#  } else if(d.newsStatus == "0"){ }}
				审核通过
			{{#  } else { }}
				无法识别
			{{#  }}}
		</script>
		<!--操作-->
		<script type="text/html" id="userListBar">
<!--			<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="select">查看</a>-->
<!--			<a class="layui-btn layui-btn-xs" lay-event="examine">审核</a>-->
			<a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit">审核|编辑</a>
<a class="layui-btn layui-btn-xs" lay-event="editstar">调整星级</a>
			<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
		</script>
	</form>
	<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
	<script type="text/javascript" src="/admin_style/BuyNumberList.js"></script>
	<script src="/admin_style/assets/plugins/jquery/jquery.min.js"></script>
	<script>
		layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
			var form = layui.form,
					layer = parent.layer === undefined ? layui.layer : top.layer,
					$ = layui.jquery,
					laytpl = layui.laytpl,
					table = layui.table;
			laydate = layui.laydate;
			/*点击回车登录*/
			$(document).on('keydown', function(e){
				if(event.keyCode == 13){
					e.preventDefault();//防止两次询问
					if($(".layui-layer-btn0").length<1){
						// 搜索条件
						var name = $("input[name=name]").val(); //姓名
						var phone = $("input[name=phone]").val(); //手机号
						var state = $('#state1 option:selected').val(); //状态
						var userphone = $("input[name=userphone]").val(); //买手号码
						var alipayname = $("input[name=alipayname]").val(); //支付宝姓名
						var detail_address = $("input[name=detail_address]").val(); //收货地址
						var wangwang = $("input[name=wangwang]").val(); //旺旺号
						var username = $("input[name=username]").val(); //用户名
						var qq = $("input[name=qq]").val(); //QQ号
						table.reload('userListTable', {
							method: 'post'
							, where: {
								'name': name, //姓名
								'phone': phone,  //收货人手机号码
								'userphone': userphone,  //买手号码
								'alipayname': alipayname, //支付宝姓名
								'detail_address': detail_address, //收货地址
								'wangwang': wangwang, //旺旺号
								'state': state, //状态
								'username': username, //用户名
								'qq': qq, //QQ号
							}
							, page: {
								curr: 1
							}
						});
						setTimeout(function () {
							//top.layer.close(index);
							top.layer.msg("操作成功！");
						}, 500);
						return false;
					}
				}

			})
		})

		$('.img-rounded').click(function(){
			var img = $(this).attr('src');
			return  window.open($(this).attr('src'));
			layer.open({
				type: 1,
				skin: 'layui-layer-rim', //加上边框
				area: ['600px', '600px'], //宽高
				shadeClose: true, //开启遮罩关闭
				end: function (index, layero) {
					return false;
				},
				content: '<div style="text-align:center"><img src='+img+' style="width:90%"/></div>'
			});
		})
	</script>
</body>

</html>

