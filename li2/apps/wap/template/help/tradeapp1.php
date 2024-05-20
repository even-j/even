﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <!--include file "common.php"-->
    </head>
    <style>
        body{ background: #FFFFFF ;}
        .header { background: #79b4ff!important;}
        .down_hd{ background-image: linear-gradient(120deg, #7eb5ff 0%, #51afff 100%); text-align: center; padding-top: 30px;}
        .app_down_rwm{ position: relative;  background: url(public/wap/images/down/app_rwm.png) no-repeat center;  background-size: 350px;  margin: 0 auto;}
        .app_down_rwm img{ width: 163px;  margin-top: 30px;}
        .inputBox{ width: 276px; background: url(public/wap/images/down/app_button.png) no-repeat; background-size: 276px;margin: 30px auto; height: 46px;}
        .inputBox input{ border: none ; background: none; font-size: 16px; color: #ffffff; width: 180px;float: left;  margin-left: 19px; margin-top: 22px;}
        .inputBox button{ border: none; background: none;height: 30px; width: 70px;margin-top: 16px;margin-left: 5px; cursor:pointer;color:#fd5440;text-align: center;}
        .down_hd p{font-size: 16px;color: #fff; line-height: 22px;}
        .ewm{width: 134px !important; margin: 0 auto;left: 0; right: 0; position: absolute; height: 134px; top: 71px;
        background: url(public/wap/images/down/733a.png?v=2) no-repeat; background-size: 100%;}
		.ewm1{width: 134px !important; margin: 0 auto;left: 0; right: 0; position: absolute; height: 134px; top: 71px;
        background: url(public/wap/images/down/733i.jpg?v=2) no-repeat; background-size: 100%;}
        .shuoming{ line-height: 25px; padding: 15px;}
        .shuoming p{ color: #776f6f; font-size: 14px; padding-top: 10px;}
        .shuoming p span{ background:url(public/wap/images/down/nub.png) no-repeat ; width: 44px; height: 18px; float: left; font-size: 14px; color: #fff; margin-right: 5px; display: block; text-align: center;background-size: 45px;
    line-height: 19px;}
        .shuoming h4{ color: #51afff; font-size: 16px; text-align: center;}
        .shuoming img{ text-align: center;  display: block; padding: 10px 0; margin: 0 auto;}
     </style>
    <body> 
        <div class="header">
            <h1>交易软件</h1>
            <a class="l-link" href="javascript:history.go(-1)"><span>返回</span></a> 
            <div class="top-menu">
                <!--<button type="button" class="btn"></button>-->
            </div>
        </div>
        <div style="height:40px;"></div>
        <div class="down_hd">
        	<img src="public/wap/images/down/app_text.png" width="70%"/>
        	
        	<div class="app_down_rwm">
        		<img src="public/wap/images/down/app_rwm_rwm.png" />
        		<div class="ewm"></div>
				<!--<div class="ewm1"><p>苹果下载</p></div>-->
        	</div>
        	<div class="inputBox">
        		<input type="" name="" id="inp_url" value="https://46sgja.org/A5Ro.app" />        		
        		<button type="" id="btn_down" value="">复制链接</button>
        	</div>
        	<p>扫描二维码下载APP</p>
        	<p>或</p>
        	<p>复制链接在浏览器打开下载APP</p>
        	<img src="public/wap/images/down/app_yun.png" width="100%"/>
        </div>
        
        <div class="shuoming">
        	<h4>《苹果手机添加信任操作说明》</h4>
        	<p><span>1</span>点击“华亿交易端”弹出下面对话框！</p>
        	<img src="public/wap/images/down/J/p01.png" width="90%"/>        	
        	<p><span>2</span>点击“设置”！</p>
        	<img src="public/wap/images/down/J/p02.png" width="90%"/>
        	<p><span>3</span>点击“通用”！</p>
        	<img src="public/wap/images/down/J/p03.png" width="90%"/>
        	<p><span>4</span>点击“设备管理”！</p>
        	<img src="public/wap/images/down/J/p04.png" width="90%"/>
        	<p><span>5</span>点击“企业级应用”-“...”！</p>
        	<img src="public/wap/images/down/J/p05.png" width="90%"/>
        	<p><span>6</span>点击“信任...”！</p>
        	<img src="public/wap/images/down/J/p06.png" width="90%"/>
        	<p><span>7</span>点击“信任”</p>
        	<img src="public/wap/images/down/J/p07.png" width="90%"/>
                <p><span>8</span>完成操作，可以正常使用“华亿交易端”了！</p>
        </div>
        <script src="/public/wap/js/clipboard.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function(){
                var text = $("#inp_url").val();
                var clipboard = new Clipboard('#btn_down', {
                    text: function() {
                        return text;
                    }
                });

                clipboard.on('success', function(e) {
                    layermsg('复制成功');
                });
            })
        </script>

    </body>
    
</html>