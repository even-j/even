<!--include file "admin_include.php"-->
<div class="container clearfix">
    <div class="main-wrap">
    	 <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/index.php?app=admin&mod=index&ac=view" target="_top">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/index.php?app=admin&mod=peizi&ac=win">结束策略</a><span class="crumb-step">&gt;</span><span><?php echo $nav_title;?></span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
             <form action="/index.php?app=admin&mod=peizi&ac=doWinEdit" method="post" onclick="return validateForm();" id="myform" name="myform" enctype="multipart/form-data">
                 <input type="hidden" name="pz_id" value="<?php echo $_GET['pz_id']?>" />
                 <table class="insert-tab" width="100%">
                    <tbody>
                        <tr>
                            <th width="120">策略类型：</th>
                            <td><?php echo \Model\Peizi\Peizi::getPzType($pz_row['pz_type'])  ?></td>
                        </tr>
                        <tr>
                            <th>订单时间：</th>
                            <td><?php echo date('Y-m-d H:i',$pz_row['pz_time']);?></td>
                        </tr>
                        <tr>
                            <th>证券账户：</th>
                            <td><?php echo $pz_row['sp_user'] ?></td>
                        </tr>
                        <tr>
                            <th>保证金：</th>
                            <td id='bond_total'><?php echo floatval($pz_row['bond_total'])/100 ?></td>
                        </tr>
                        <tr>
                            <th>倍数：</th>
                            <td id='pz_ratio'><?php echo floatval($pz_row['pz_ratio']) ?></td>
                        </tr>
                        <tr>
                            <th>策略金额：</th>
                            <td id='bond_total'><?php echo floatval($pz_row['bond_total'])*floatval($pz_row['pz_ratio'])/100 ?></td>
                        </tr>
                        <tr>
                            <th>总操盘金额：</th>
                            <td id='trade_money_total'><?php echo floatval($pz_row['trade_money_total'])/100 ?></td>
                        </tr>
                        <tr>
                            <th>实盘单号：</th>
                            <td><?php echo date('Ymd',$pz_row['pz_time']).$pz_row['pz_id'] ?></td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>证券总资产(元)：</th>
                            <td><input type="text" id="trade_balance" name="trade_balance" value="" oninput="balance_change(this)"/><i class="tip left pd10"></i></td>
                        </tr>
                        <tr>
                            <th>盈亏(元)：</th>
                            <td id='profit_loss_money'><?php echo floatval($pz_row['profit_loss_money'])/100 ?></td>
                        </tr>
                        <tr>
                            <th>剩余保证金(元)：</th>
                            <td id='back_money'><?php echo floatval($pz_row['back_money'])/100 ?></td>
                        </tr>
                        
                        <tr>
                            <th><i class="require-red">*</i>状态：</th>
                            <td>
                                <?php if($pz_row['status'] == 2){?>
                                <select name="status" id="status">
                                    <option value="2">操盘中</option>
                                    <option value="4">结束</option>
                                </select>
                                <?php }else if( $pz_row['status'] == 3){?>
                                <select name="status" id="status">
                                    <option value="3">申请结束</option>
                                    <option value="4">结束</option>
                                </select>
                                <?php }else{?>
                                    已结束
                                <?php }?>
                            </td>
                        </tr>
                         
                             <tr>
                            <th></th>
                            <td>
                                <?php if($pz_row['status'] == 2 ||$pz_row['status'] == 3){?>
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
    function balance_change(obj){
        inputCheck(obj,'money');
        //总盈亏
        var profit_loss_money = parseFloat($(obj).val())- parseFloat( $('#trade_money_total').html());
        $('#profit_loss_money').html(profit_loss_money.toFixed(2));
        //剩余保证金
        var back_money = parseFloat($('#bond_total').html())+profit_loss_money;
        $('#back_money').html(back_money.toFixed(2));
    }
    
function validateForm(){
        var trade_balance = $('#trade_balance');
	
        if(trade_balance.val() == ""){
            trade_balance.next().html('证券总资产不能为空');
            return false;
        }
	return true;
}
function goback(){
    var url = '/index.php?app=admin&mod=peizi&ac=win';
    window.location.href = url;
}
</script>
<!--include file "admin_bottom.php"-->