
<script src="/public/wap/js/jquery.js" type="text/javascript"></script>
<script src="/public/wap/js/layer_mobile/layer.js" type="text/javascript"></script>
<script src="/public/wap/js/common.js" type="text/javascript"></script>
<link href="/public/wap/css/dialog.css?v" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    function closewin() {
        parent.layer.closeAll();
    }
</script>
<style>
    .sqyanqi table{ margin:20px 0 15px;border-collapse:  collapse}
    .sqyanqi table td,.sqyanqi table th{width:120px; padding:5px 10px; border:solid 1px #ddd; text-align:center; line-height:27px;font-weight: normal}
</style>
<form action="/member/deposit/save.html">
    <div class="tip" id="message">温馨提示：请妥善保管您的账户密码，切勿告诉他人。 </div>
    <div class="sqyanqi">
        <table>
            <tr>
                <th>证券账号：</th>
                <td><?php echo $pz_row['sp_user'] ? $pz_row['sp_user'] : '已注销或未开户'; ?></td>
            </tr>
            <tr>
                <th>交易密码：</th>
                <td><?php echo $pz_row['sp_pwd'] ? $pz_row['sp_pwd'] : '******'; ?></td>
            </tr>
            <tr>
                <th>交易软件下载：</th>
                <td><a href="<?php echo \App::URL("wap/help/tradeapp"); ?>" target="_blank" style="background: #FF3F00; padding: 5px 30px;color: #fff;margin-right: 10px;border-radius: 3px;cursor: pointer;font-size: 14px">下载</a></td>
            </tr>
        </table>
    </div>


    <div class="actions" style="border-top:0">
        <input class="cancel" type="button" value="关闭" onclick="closewin()">
    </div>
</form>