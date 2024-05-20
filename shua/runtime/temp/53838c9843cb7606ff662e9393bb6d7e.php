<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/admin\view\seller\buy_number_list.html";i:1578878158;}*/ ?>
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
		/* .layui-table-cell{
    height:100px;
    line-height: 100px;
} */
		.layui-table-cell {
			font-size:16px;
			padding:0 5px;
			height:auto;
			overflow:visible;
			text-overflow:inherit;
			white-space:normal;
			word-break: break-all;
		}
		.layui-table-fixed {
			display: none!important;
		}
		.layui-table-fixed-r{
			display: none!important;
		}
	</style>
</head>

<body class="childrenBody">
	<form class="layui-form">
		<blockquote class="layui-elem-quote quoteBox">
			<form class="layui-form">
				<div class="layui-inline">
					<label class="layui-form-label">用户名：</label>
					<div class="layui-input-inline">
						<input type="tel" name="name" lay-verify="name" autocomplete="off" class="layui-input name"
							placeholder="请输入用户名">
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label">店铺旺旺：</label>
					<div class="layui-input-inline">
						<input type="text" name="wangwang" lay-verify="wangwang" autocomplete="off" class="layui-input name"
							   placeholder="请输入店铺旺旺">
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label">手机号：</label>
					<div class="layui-input-inline">
						<input type="text" name="mobile" lay-verify="mobile" autocomplete="off" class="layui-input name"
							   placeholder="请输入手机号">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">QQ号：</label>
					<div class="layui-input-inline">
						<input type="text" name="qq" lay-verify="qq" autocomplete="off" class="layui-input qq"
							   placeholder="请输入QQ号">
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label">店铺名：</label>
					<div class="layui-input-inline">
						<input type="tel" name="shopName" lay-verify="shopName" autocomplete="off" class="layui-input shopName"
							placeholder="请输入店铺名">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label" >店铺类型：</label>
					<div class="layui-input-inline" style="width: 100px;">
						<select name="type" id="type" lay-verify="" >
							<option value="" selected>全部</option><!-- 默认选中 -->
							<option value="1">淘宝</option><!-- 禁用 -->
							<option value="2">天猫</option>
							<option value="3">飞猪</option>
						</select>
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label" >审核状态：</label>
					<div class="layui-input-inline" style="width: 100px;">
						<select name="state" id="state1" lay-verify="" >
							<option value="" selected>全部</option><!-- 默认选中 -->
							<option value="0">待审核</option><!-- 禁用 -->
							<option value="1">审核通过</option>
							<option value="2">审核不通过</option>
						</select>
					</div>
				</div>

				<div class="layui-inline">
					<label class="layui-form-label" >邮费状态：</label>
					<div class="layui-input-inline" style="width: 100px;">
						<select name="logistics" id="logistics" lay-verify="" >
							<option value="" selected>全部</option><!-- 默认选中 -->
							<option value="0">无需物流</option><!-- 禁用 -->
							<option value="1">需要物流</option>
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
<!--		<a class="layui-btn layui-btn-xs" lay-event="examine">审核</a>-->
		<a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit">审核|编辑</a>
		<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
		</script>
	</form>
	<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
	<script type="text/javascript" src="/admin_style/BusinessNumberList.js"></script>
	<script type="text/javascript" src="/static/seller/js/jquery.min.js"></script>
</body>
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
					var wangwang = $("input[name=wangwang]").val(); //店铺旺旺
					var shopName = $("input[name=shopName]").val(); //店铺名
					var type = $('#type option:selected').val(); //店铺类型
					var state = $('#state option:selected').val(); //状态
					var logistics = $('#logistics option:selected').val(); //物流状态
					var mobile = $("input[name=mobile]").val(); //手机号
					var qq = $("input[name=qq]").val(); //手机号
					table.reload('userListTable', {
						method: 'post'
						, where: {
							'name': name, //姓名
							'wangwang': wangwang,    //店铺旺旺
							'shopName': shopName,    //店铺名
							'type': type,  //店铺类型
							'state': state, //状态
							'logistics': logistics, //物流状态
							'mobile': mobile,
							'qq': qq,
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
</script>

</html>
