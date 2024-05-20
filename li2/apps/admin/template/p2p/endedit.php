<!--include file "admin_include.php"-->
<div class="container clearfix">
    <div class="main-wrap">
    	 <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/index.php?app=admin&mod=index&ac=view" target="_top">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/index.php?app=admin&mod=p2p&ac=end">完标处理</a><span class="crumb-step">&gt;</span><span><?php echo $nav_title;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
             <form action="/index.php?app=admin&mod=p2p&ac=doEndEdit" method="post" onclick="return validateForm();" id="myform" name="myform" enctype="multipart/form-data">
                 <input type="hidden" name="pz_id" value="<?php echo $_GET['pz_id']?>" />
                 <table class="insert-tab" width="100%">
                    <tbody>
                        <tr>
                            <th width="120">策略类型：</th>
                            <td><?php echo \Model\Peizi\Peizi::getPzType($pz_row['pz_type'])  ?></td>
                        </tr>
                        <tr>
                            <th>实盘单号：</th>
                            <td><?php echo date('Ymd',$pz_row['pz_time']).$pz_row['pz_id'] ?></td>
                        </tr>
                        <tr>
                            <th>策略时间：</th>
                            <td><?php echo date('Y-m-d H:i',$pz_row['pz_time']);?></td>
                        </tr>
                        <tr>
                            <th>策略金额(万元)：</th>
                            <td><?php echo floatval($pz_row['pz_money'])/10000/100 ?></td>
                        </tr>
                        <tr>
                            <th>策略比例：</th>
                            <td><?php echo floatval($pz_row['pz_ratio'])?></td>
                        </tr>
                        <tr>
                            <th>年利率(%)：</th>
                            <td><?php echo floatval($pz_row['year_rate'])?></td>
                        </tr>
                        <tr>
                            <th>分成比例(%)：</th>
                            <td><?php echo floatval($pz_row['fencheng_rate'])?></td>
                        </tr>
                        <tr>
                            <th>风险保证金(元)：</th>
                            <td><?php echo floatval($pz_row['bond_total'])/100 ?></td>
                        </tr>
                        <tr>
                            <th>策略期限：</th>
                            <td><?php echo $pz_row['pz_times']. \Model\P2p\Peizi::getTimeUnitName($pz_row['pz_times_unit']) ?></td>
                        </tr>
                        <tr>
                            <th>策略开始时间：</th>
                            <td><?php echo empty($pz_row['start_time'])?'':date('Y-m-d H:i',$pz_row['start_time']) ?></td>
                        </tr>
                        <tr>
                            <th>策略结束时间：</th>
                            <td><?php echo empty($pz_row['end_time'])?'':date('Y-m-d H:i',$pz_row['end_time']) ?></td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>状态：</th>
                            <td>
                                <?php if($pz_row['p2pstatus'] == 6){?>
                                <select name="p2pstatus" id="p2pstatus">
                                    <option value="6">未结束</option>
                                    <option value="7">已结束</option>
                                </select>
                                <?php }else{?>
                                    已结束
                                <?php }?>
                            </td>
                        </tr>
                         <tr>
                            <th></th>
                            <td style="color:red">
                                请先结束操盘，提交审核后将退还投资资金给用户，谨慎操作
                            </td>
                        </tr>
                             <tr>
                            <th></th>
                            <td>
                                <?php if($pz_row['p2pstatus'] == 6){?>
                                <input class="btn btn-primary btn6 mr10" name="submit" value="提交" type="submit">
                                <?php }?>
                                <input class="btn btn6" onClick="goback()" value="返回" type="button">
                            </td>
                        </tr>
                    </tbody>
                 </table>
                </form> 
            </div>
        </div>

    </div>
    <!--/main-->
</div>
<script type="text/javascript">
function validateForm(){
	
	return true;
}
function goback(){
    var url = '/index.php?app=admin&mod=p2p&ac=end';
    window.location.href = url;
}
</script>
<!--include file "admin_bottom.php"-->