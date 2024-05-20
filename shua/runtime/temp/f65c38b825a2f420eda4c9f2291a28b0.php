<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:94:"/www/wwwroot/xbt.com/pubic/../application/admin/view/finance/seller_reward_balance_record.html";i:1572253852;}*/ ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>买手银锭记录</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/admin_style/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/admin_style/css/public.css" media="all" />
	<link rel="stylesheet" href="//at.alicdn.com/t/font_1308190_7kttvg3l5i.css" media="all" />
</head>
<style>
	.text-danger{
		color: red!important;
	}
	.text-success{
		color: green!important;
	}
	.layui-table-cell {
		font-size:16px;
		padding:0 5px;
		height:auto;
		overflow:visible;
		text-overflow:inherit;
		white-space:normal;
		word-break: break-all;
	}
</style>
<body class="childrenBody">
	<form class="layui-form">
		<blockquote class="layui-elem-quote quoteBox">
			<form class="layui-form">
				<div class="layui-inline">
					<label class="layui-form-label">日志类型：</label>
					<div class="layui-input-inline" style="width: 150px;">
						<select name="logType" id="logType" lay-verify="">
							<option value="" selected>全部类型</option>
							<?php foreach(config('finance.financeClass') as $key=>$item): ?>
							<option value="<?php echo $key; ?>" ><?php echo $item; ?></option><!-- 默认选中 -->
							<?php endforeach; ?>
						</select>
					</div>
				</div>
<!--				<div class="layui-inline">-->
<!--					<label class="layui-form-label">用户类型：</label>-->
<!--					<div class="layui-input-inline" style="width: 150px;">-->
<!--						<select name="userType" lay-verify="">-->
<!--							<option value="">用户类型：</option>-->
<!--							<option value="0" selected>全部</option>&lt;!&ndash; 默认选中 &ndash;&gt;-->
<!--							<option value="1" disabled>刷手</option>&lt;!&ndash; 禁用 &ndash;&gt;-->
<!--							<option value="2">商家</option>-->
<!--						</select>-->
<!--					</div>-->
<!--				</div>-->
				<div class="layui-inline">
					<label class="layui-form-label">用户名：</label>
					<div class="layui-input-inline">
						<input type="tel" name="name" lay-verify="name" autocomplete="off" class="layui-input name"
							placeholder="请输入用户名">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">手机号：</label>
					<div class="layui-input-inline">
						<input type="tel" name="phone" lay-verify="phone" autocomplete="off" class="layui-input phone"
							placeholder="请输入手机号">
					</div>
				</div>
				<div class="layui-inline">
					<label class="layui-form-label">描述：</label>
					<div class="layui-input-inline">
						<input type="tel" name="account" lay-verify="account" autocomplete="off"
							class="layui-input account" placeholder="描述">
					</div>
				</div>
				<div class="layui-inline">
					<a class="layui-btn search_btn" data-type="reload" lay-filter="reload" lay-submit><i class="layui-icon">&#xe615;</i>搜 索</a>
				</div>
			</form>
		</blockquote>
		<table id="userList" lay-filter="userList"></table>
	</form>
	<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
	<script type="text/javascript" src="/admin_style/SellerRewardBalanceRecord.js"></script>
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
					var phone = $("input[name=phone]").val(); //手机号
					var logType = $('#logType option:selected').val(); //状态
					var userType = $('#userType option:selected').val(); //状态
					var account = $("input[name=account]").val(); //账户
					table.reload('userListTable', {
						method: 'post'
						, where: {
							'name': name, //姓名
							'phone': phone,  //手机号
							'logType': logType, //状态
							'userType': userType, //状态
							'account': account, //账户
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
