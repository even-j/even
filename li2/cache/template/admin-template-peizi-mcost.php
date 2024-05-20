<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)) echo $title.'_'?><?php echo SITE_NAME;?>—后台管理</title>
<link rel="stylesheet" type="text/css" href="/public/admin/css/common.css?v=201812202"/>
<link rel="stylesheet" type="text/css" href="/public/admin/css/main.css?v=5"/>
<script type="text/javascript" src="/public/admin/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/public/admin/js/common.js?v=201812202"></script>
<script type="text/javascript" src="/public/admin/js/libs/modernizr.min.js"></script>
<script type="text/javascript" src="/public/admin/js/layer/layer.js"></script>

</head>

<body>
<?php $admin_user = \Model\Admin\User::getAdminInfo(array('admin_id'=>\Model\Admin\User::checks())); ?>
<link type="text/css" href="/public/admin/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
<link type="text/css" href="/public/admin/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
<script type="text/javascript" src="/public/admin/js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="/public/admin/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="/public/admin/js/jquery-ui-timepicker-zh-CN.js"></script>
<script type="text/javascript">
    $(function () {
        $(".ui_timepicker").datetimepicker();
    })
</script>

<div class="container clearfix">
    <div class="main-wrap">
       <div class="crumb-wrap">
  <div class="crumb-list"><i class="icon-font"></i><a href="/index.php?app=admin&mod=index&ac=view" target="_top">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><?php if(isset($title)) echo $title?></span></div>
</div>   
        <div class="search-wrap">
            <div class="search-content">
                <form action="/index.php" method="get">
                    <input type="hidden" name="app" value="admin" >
                    <input type="hidden" name="mod" value="peizi" >
                    <input type="hidden" name="ac" value="mcost" >
                    <table class="search-tab">
                        <tr>
                            <th width="80">实盘单号:</th>
                            <td><input class="common-text" placeholder="实盘单号" name="order_id" value="<?php echo $condition['order_id']?>" id="" type="text"></td>
                            <th width="80"><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
      
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div id="div_content" class="result-content" style="width:100%;overflow: auto">
                    <table class="result-tab" style="width:100%" >
                        <tr>
                            <th style="width: 80px;">策略类型</th>
                            <th style="width: 100px;">用户姓名</th>
                            <th style="width: 100px;">用户手机</th>
                            <th style="width: 100px;">余额</th>
                            <th style="width: 100px;">管理费</th>
                            <th style="width: 120px;">证券帐户</th>
                            <th style="width: 100px;">保证金</th>
                            <th style="width: 60px;">倍数</th>
                            <th style="width: 100px;">策略金额</th>
                            <th style="width: 100px;">总操盘金额</th>
                            <th style="width: 100px;">开始时间</th>
                            <th style="width: 100px;">结束时间</th>
                            <th style="width: 60px;">剩余时间</th>
                        </tr>
                         														
                        <?php foreach ($list as $item){?>
                            <tr>
                                <td><?php echo \Model\Peizi\Peizi::getPzType($item['pz_type'])  ?></td>
                                <td><a target="_blank" href="/index.php?app=admin&mod=user&ac=info&uid=<?php echo $item['uid']?>" ><?php echo $item['true_name']?></a></td>
                                <td><?php echo $item['mobile'] ?></td>
                                <td><?php echo $item['balance']/100 ?></td>
                                <td><?php echo floatval($item['manage_cost_day'])/100 ?></td>
                                <td><?php echo $item['sp_user'] ?></td>
                                <td><?php echo floatval($item['bond_total'])/100 ?></td>
                                <td><?php echo floatval($item['pz_ratio'])?></td>
                                <td><?php echo floatval($item['bond_total'])*floatval($item['pz_ratio'])/100 ?></td>
                                <td><?php echo floatval($item['trade_money_total'])/100 ?></td>
                                <td><?php echo date('Y-m-d',$item['start_time']) ?></td>
                                <td><?php echo date('Y-m-d',$item['end_time']) ?></td>
                                <td><?php echo \Model\Sys\Common::countdown($item['end_time']); ?></td>
                            </tr>
                        <?php }?>             
                    </table>
                    
                </div>
            </form>
        </div>
       <div class="list-page"><?php echo $pager;?></div>
    </div>
  
    <script>
        function huabo(pz_id){
            window.location.href = '/index.php?app=admin&mod=peizi&ac=fundedit&pz_id='+pz_id;
        }
    </script>
    <!--/main-->
</div>
<script type="text/javascript">

function show(title,url){
	//iframe层
    layer.open({
        type: 2,
        title: title,
        shadeClose: true,
        shade: 0.8,
        fix: false, //不固定
        maxmin: true,
        area: ['60%', '500px'],
        content: url //iframe的url
    }); 
}
var layerIndex = 0;
var isOpen=false;
var interval= window.setInterval("showWindow()",20000);
function showWindow(){
	$.post('/index.php?app=admin&mod=index&ac=showWindow',{},function(res){
		 if(res.status=='1'){
                    if(isOpen){
                        layer.close(layerIndex);
                    }
                    //iframe窗
                    layerIndex = layer.open({
                        type: 1,
                        title: '您有新的<b class="red"> '+res.num+' </b>条待办事项',
                        shade: false,
                        //skin: 'layui-layer-demo', //样式类名
                        area: ['340px', '315px'],
                        shadeClose: false, //开启遮罩关闭
                        offset: 'rb', //右下角弹出
                        content: '<div class="result-content"><ul id="wait-do" class="sys-info-list pt10">'+res.msg+'</ul></div><div style="display:none;"><audio controls="true" autoplay="autoplay" loop="loop"><source src="/public/admin/sound/music.mp3" /><source src="/public/admin/sound/music.ogg" /></audio></div>', 
                        end:function(){ // 点击右上角关闭按钮  
                            isOpen=false;
                            layerIndex=0;
                        }
                    });
                    isOpen = true;
		 }
	},'json');
}

</script>
</body>
</html>
