<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/admin\view\system\user_record.html";i:1572256998;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>平台返款管理</title>
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
		.wgbz {
			color: red;
		}
	</style>
</head>

<body class="childrenBody">
<form class="layui-form">
	<blockquote class="layui-elem-quote quoteBox">
		<form class="layui-form">
			<div class="layui-inline">
				<label class="layui-form-label">用户名:</label>
				<div class="layui-input-inline">
					<input type="tel" name="username" lay-verify="username" autocomplete="off" class="layui-input wwid"
						   placeholder="用户名">
				</div>
			</div>
							<div class="layui-inline">
								<label class="layui-form-label">日期：</label>
								<div class="layui-input-inline">
									<input type="text" name="time" lay-verify="time" class="layui-input time" id="application-Time"
										placeholder="日期">
								</div>
							</div>

			<div class="layui-inline">
				<label class="layui-form-label">模块：</label>
				<div class="layui-input-inline">
					<input type="tel" name="modular" lay-verify="modular" autocomplete="off" class="layui-input id"
						   placeholder="请输入模块关键词">
				</div>
			</div>
			<div class="layui-inline">
				<div class="layui-input-inline">
					<a class="layui-btn search_btn" data-type="reload" lay-filter="reload" lay-submit><i class="layui-icon">&#xe615;</i>搜 索</a>
				</div>
			</div>
		</form>
	</blockquote>
	<table id="userList" lay-filter="userList" style="font-size: 14px"></table>
	<script type="text/html" id="toolbarDemo">
		<div class="layui-btn-container table-tool">
			<button class="layui-btn layui-btn-normal delAll_btn">批量审核通过 <i class="layui-icon">&#xe605;</i></button>
		</div>
	</script>


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
		<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop">详 情</a>
		<a class="layui-btn layui-btn-xs" lay-event="jeidan">接单情况</a>
		<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="fangqi">放弃情况</a>
	</script>
</form>
	<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
	<script type="text/javascript" src="/admin_style/userRecord.js"></script>
<script src="/admin_style/assets/plugins/jquery/jquery.min.js"></script>
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
					var username = $("input[name=username]").val(); //用户名
					var modular = $("input[name=modular]").val(); //模块
					var time = $("input[name=time]").val(); //接单时间
					table.reload('userListTable', {
						method: 'post'
						, where: {
							'username': username, //用户名
							'modular': modular, //模块
							'time': time, //接单时间
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
