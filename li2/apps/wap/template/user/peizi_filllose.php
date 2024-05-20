
<script src="/public/wap/js/jquery.js" type="text/javascript"></script>
<script src="/public/wap/js/layer_mobile/layer.js" type="text/javascript"></script>
<script src="/public/wap/js/common.js" type="text/javascript"></script>
<link href="/public/wap/css/dialog.css?v" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    $(function(){
        $('.submit').click(function(){
            var money = $("#total").val();
            var pz_id = $("#pz_id").val();
            var balance = <?php echo floatval($user['balance'])/100 ?>;
            if(money == ''){
                layermsg('金额不能为空');
                //top.dialog2('金额不能为空','error');
                return;
            }
            if(isNaN(money)){
                layermsg('金额应为数字');
                //top.dialog2('金额应为数字','error');
                return;
            }
            if(balance<money){
                layermsg('余额不足');
                //top.dialog2('余额不足','error');
                return;
            }
            var index = layerloading('提交中');
            $(this).attr("disabled","true");
            $.post("<?php echo \App::URL('wap/user/do_peizi_filllose')?>", {money:money,pz_id:pz_id},function(res){
                if(res.code==0){
                    layer.close(index);
                    layeralert(res.msg);
                    //top.dialog2(res.msg,'error');
                }else{
                    layerconfirm(res.msg,['确定'],function(){
                        closewin();
                    })
                    //top.dialog2(res.msg,'success');
                }                
            },'json');
            $(this).attr("disabled","false");
        });
    });
    function closewin(){
        parent.layer.closeAll();
    }
</script>
<form action="">
    <!--<div class="tip" id="message">盈利超过10%可提取10%以上部分，同时锁定10%以下部分，每周可提1次</div>-->
    <div class="tip" id="message">
        <span>账户余额：</span>
        <font class="cd22 f16 mymoney"><?php echo number_format(floatval($user['balance'])/100,2) ?></font>元  
        <a href="<?php echo \App::URL('wap/user/recharge');?>" target="_blank" class="link-blue f16" style="padding-left:10px">马上充值</a>
    </div>
    <table>
        <tr>
            <td style="width:100px;font-size:14px">补亏金额：</td>
            <td><input class="text" type="text" id="total" name="total" style="width:100%"> </td>
            <td>元</td>
        </tr>
    </table>
    <div class="actions">
        <input type="hidden" id="pz_id" name="pz_id" value="<?php echo $pz_id;?>">
        <input class="submit" type="button" value="确认">
        <input class="cancel" type="button" value="取消" onclick="closewin()">
    </div>
</form>