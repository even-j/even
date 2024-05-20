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
<div class="container clearfix">
    <div class="main-wrap">
       <div class="crumb-wrap">
  <div class="crumb-list"><i class="icon-font"></i><a href="/index.php?app=admin&mod=index&ac=view" target="_top">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><?php if(isset($title)) echo $title?></span></div>
</div>   
        <div class="search-wrap">
            <div class="search-content">
                <form action="/index.php" method="get">
                    <input type="hidden" name="app" value="admin" >
                    <input type="hidden" name="mod" value="finance" >
                    <input type="hidden" name="ac" value="rechargeoffline" >
                    <table class="search-tab">
                        <tr>
                             <th width="70">用户ID:</th>
                            <td><input class="common-text" placeholder="用户ID" name="uid" value="<?php echo empty($_GET['uid'])?'':$_GET['uid']?>" id="" type="text"></td>
                            <th width="70">手机:</th>
                            <td><input class="common-text" placeholder="手机" name="mobile" value="<?php echo empty($_GET['mobile'])?'':$_GET['mobile']?>" id="" type="text"></td>
                            <th width="60">姓名:</th>
                            <td><input class="common-text" placeholder="姓名" name="true_name" value="<?php echo empty($_GET['true_name'])?'':$_GET['true_name']?>" id="" type="text"></td>
                            <th width="70">充值状态:</th>
                            <td>
                                <select name="status">
                                    <option value="" <?php if(!isset($_GET['status']) || $_GET['status']=='' ) {echo 'selected="selected"';}?>>全部</option>
                                    <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0' ) {echo 'selected="selected"';}?> >未处理</option>
                                    <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1' ) {echo 'selected="selected"';}?> >审核成功</option>
                                    <option value="2" <?php if(isset($_GET['status']) && $_GET['status']=='2' ) {echo 'selected="selected"';}?>>拒绝审核</option>
                                </select>
                            </td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
       <!--<div class="toolbar-wrap">
            <div class="toolbar-item">
                <a href="/index.php?app=admin&mod=user&ac=add"><i class="icon-font"></i>添加会员</a>
                <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
            </div>
        </div>-->
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                </div>
                <div  id="div_content" class="result-content" style="width:100%;overflow: auto">
                    <table class="result-tab" style="width:100%" >
                        <tr>
                             <!--<th class="tc" width="40px"><input class="allChoose" name="" type="checkbox"></th>-->
                            <th style="width:100px">定单号</th>
                            <th style="width:100px">用户ID</th>
                            <th style="width:100px">姓名</th>
                            <th style="width:120px">手机</th>
                            <th style="width:100px">渠道</th>
                            <th style="width:120px">充值金额</th>
                            <th style="width:120px">汇款人姓名</th>
                            <th style="width:140px">充值时间</th>
                            <th style="width:180px">充值状态</th>
                            <th style="width:180px">审核时间</th>
                            <th style="width: 160px;">操作</th>
                        </tr>
                        <?php foreach ($list as $item){
                            $statusname = '';
                            if($item['status']==0){
                                $statusname = '未处理';
                            }
                            elseif($item['status']==1){
                                $statusname = '审核通过';
                            }
                            elseif($item['status']==2){
                                $statusname = '拒绝审核';
                            }
                            ?>
                            <tr>
                                <!--<td class="tc"><input name="id[]" value="59" type="checkbox"></td>-->
                                <td><?php echo $item['id'] ?></td>
                                <td><?php echo $item['uid'] ?></td>
                                 <td><a href="/index.php?app=admin&mod=user&ac=info&uid=<?php echo $item['uid']?>" ><?php echo $item['true_name']?></a></td>
                                <td><?php echo $item['mobile'] ?></td>
                                <td><?php echo $item['channel'] ?></td>
                                <td><?php echo '¥ '.number_format((floatval($item['money']) /100),2) ?></td>
                                <td><?php echo $item['name'] ?></td>
                                <td><?php echo date('Y-m-d H:i',$item['add_time']) ?></td>
                                <td><?php echo $statusname; ?></td>
                                <td><?php echo $item['update_time']?date('Y-m-d H:i',$item['update_time']):'' ?></td>
                                <td>
                                    <?php if($item['status'] ==0){?>
                                    <?php echo '<a href="javascript:bianji('.$item['id'].')">编辑</a>&nbsp;&nbsp;<a href="javascript:pass('.$item['id'].')">通过</a>&nbsp;&nbsp;<a href="javascript:refuse('.$item['id'].')">拒绝</a>&nbsp;&nbsp;<a href="javascript:del('.$item['id'].')">删除</a>' ?>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>             
                    </table>
                </div>
                <div class="list-page"><?php echo $pager;?></div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="/public/admin/js/layer/extend/layer.ext.js"></script> 
    <script>
        function bianji(id){
            window.location.href = '/index.php?app=admin&mod=finance&ac=offlineedit&id='+id;
        }
        function pass(id){
            var recharge_rebate = "<?php echo \apps\Config::getInstance()->recharge_rebate;?>";
            if(recharge_rebate=="" || recharge_rebate=="0"){
                var index = layer.confirm('是否确认通过充值？', function(index) {
                    window.location.href = '/index.php?app=admin&mod=finance&ac=offlinepass&id='+id;
                });
            }
            else{
                //需引入扩展才可使用layer.prompt
                layer.config({
                    extend: '/public/admin/js/layer/extend/layer.ext.js'
                });
                layer.prompt({title: '输入返利金额（元）,并确定', formType: 2}, function(value, index,elem){
                    layer.close(index);
                    window.location.href = '/index.php?app=admin&mod=finance&ac=offlinepass&id='+id+"&money="+value;
                });
            }
        }
        function refuse(id){
            if(window.confirm("是否确认拒绝充值?")){
                window.location.href = '/index.php?app=admin&mod=finance&ac=offlinerefuse&id='+id;
            }
        }
        function del(id){
            if(window.confirm("是否确认删除记录?")){
                window.location.href = '/index.php?app=admin&mod=finance&ac=offlinedel&id='+id;
            }
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
