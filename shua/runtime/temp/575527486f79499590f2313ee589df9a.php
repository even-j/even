<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/admin\view\notice\news_add.html";i:1565840632;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章列表--layui后台管理模板 2.0</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/admin_style/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/admin_style/css/public.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form layui-row">
	<div class="layui-col-md11 layui-col-xs12">
		<div class="layui-row layui-col-space10">
			<div class="layui-col-md9 layui-col-xs7">
				<div class="layui-form-item magt3">
					<label class="layui-form-label">文章标题</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input newsName" lay-verify="newsName" placeholder="请输入文章标题">
						<input type="hidden" class="layui-input type" lay-verify="type" value="<?php echo $type; ?>">
						<input type="hidden" class="layui-input id" lay-verify="id">
					</div>
				</div>
			</div>
			<div class="layui-col-md2 layui-col-xs7">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i> 置　顶</label>
				<div class="layui-input-block">
					<input type="checkbox" class="newsTop" name="newsTop" lay-skin="switch"  lay-filter="newsTop" lay-text="是|否">
				</div>
			</div>
			<div class="layui-col-md1 layui-col-xs7">
				<div class="layui-form-item magt3">
					<a  class="layui-btn layui-btn-sm" lay-filter="addNews" lay-submit><i class="layui-icon">&#xe609;</i>确定</a>
				</div>
			</div>
		</div>
		<div class="layui-form-item magb0">
			<label class="layui-form-label">文章内容</label>
			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="news_content"></textarea>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
<script type="text/javascript" src="/admin_style/newsAdd.js"></script>
</body>
</html>
