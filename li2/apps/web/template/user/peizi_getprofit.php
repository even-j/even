<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--include file "common.php"-->
        <link href="/public/web/css/dialog.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            $(function(){
                $('.submit').click(function(){
                    var money = $("#total").val();
                    var pz_id = $("#pz_id").val();
                    if(money == ''){
                        layer.alert('金额不能为空',{icon:2});
                        //top.dialog2('金额不能为空','error');
                        return;
                    }
                    if(isNaN(money)){
                        layer.alert('金额应为数字',{icon:2});
                        //top.dialog2('金额应为数字','error');
                        return;
                    }
                    $(this).attr("disabled","true");
                    $.post("<?php echo \App::URL('web/user/do_peizi_getprofit')?>", {money:money,pz_id:pz_id},function(res){
                        if(res.code==0){
                            //top.dlg.destroy();
                            layer.alert(res.msg,{icon:2});
                            //top.dialog2(res.msg,'error');
                        }else{
                            layer.alert(res.msg,{icon:1},function(index){
                                closeWin();
                            });
//                            dlg.destroy();
//                            top.dialog2(res.msg,'success');
                        }                
                    },'json');
                    $(this).attr("disabled","false");
                });
            });
            function closeWin(){
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            }
        </script>
    </head>
    <body>
        <form action="">
            <!--<div class="tip" id="message">盈利超过10%可提取10%以上部分，同时锁定10%以下部分，每周可提1次</div>-->
            <div class="tip" id="message">
                <em>请确认操盘账户里有足够的可用余额！</em>
            </div>
            <table>
                <tr>
                    <th>提盈金额：</th>
                    <td><input class="text" type="text" id="total" name="total"> 元</td>
                </tr>
            </table>
            <div class="actions">
                <input type="hidden" id="pz_id" name="pz_id" value="<?php echo $pz_id;?>">
                <input class="submit" type="button" value="确认">
                <input class="cancel" type="button" value="取消" onclick="closeWin()">
                <!--<input class="cancel" type="button" value="取消" onclick="dlg.destroy()">-->
            </div>
        </form>
    </body>
</html>