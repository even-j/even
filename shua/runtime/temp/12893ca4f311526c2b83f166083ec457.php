<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"/www/wwwroot/xbt.com/pubic/../application/admin/view/system/delivery.html";i:1589544774;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>佣金比例</title>
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
<table id="userList" lay-filter="userList"></table>
<!--头部-->
<script type="text/html" id="toolbarDemo">
    <div class="layui-btn-container table-tool">
        <button class="layui-btn layui-btn-normal addBasicParameter"  lay-event="detail">新增发货仓<i class="layui-icon">&#xe605;</i></button>
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
    <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"> 编 辑 </a>
    <a class="layui-btn layui-btn-xs" lay-event="deletebp"> 删 除 </a>
</script>
<script type="text/javascript" src="/admin_style/layui/layui.js"></script>
<script type="text/javascript" src="/admin_style/delivery.js"></script>
</body>
</html>
