
<!-- 以post方式提交所有接口参数到多的宝支付网关https://pay.ddbill.com/gateway?input_charset=UTF-8 -->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>	
	<body onLoad="document.dinpayForm.submit();">
		<form name="dinpayForm" method="post" action="https://pay.ddbill.com/gateway?input_charset=UTF-8">
			<input type="hidden" name="sign"		  value="<?php echo $var['sign']?>" />
			<input type="hidden" name="merchant_code" value="<?php echo $var['merchant_code']?>" />
			<input type="hidden" name="bank_code"     value="<?php echo $var['bank_code']?>"/>
			<input type="hidden" name="order_no"      value="<?php echo $var['order_no']?>"/>
			<input type="hidden" name="order_amount"  value="<?php echo $var['order_amount']?>"/>
			<input type="hidden" name="service_type"  value="<?php echo $var['service_type']?>"/>
			<input type="hidden" name="input_charset" value="<?php echo $var['input_charset']?>"/>
			<input type="hidden" name="notify_url"    value="<?php echo $var['notify_url']?>">
			<input type="hidden" name="interface_version" value="<?php echo $var['interface_version']?>"/>
			<input type="hidden" name="sign_type"     value="<?php echo $var['sign_type']?>"/>
			<input type="hidden" name="order_time"    value="<?php echo $var['order_time']?>"/>
			<input type="hidden" name="product_name"  value="<?php echo $var['product_name']?>"/>
			<input Type="hidden" Name="client_ip"     value="<?php echo $var['client_ip']?>"/>
			<input Type="hidden" Name="extend_param"  value="<?php echo $var['extend_param']?>"/>
			<input Type="hidden" Name="extra_return_param" value="<?php echo $var['extra_return_param']?>"/>
			<input Type="hidden" Name="pay_type"  value="<?php echo $var['pay_type']?>"/>
			<input Type="hidden" Name="product_code"  value="<?php echo $var['product_code']?>"/>
			<input Type="hidden" Name="product_desc"  value="<?php echo $var['product_desc']?>"/>
			<input Type="hidden" Name="product_num"   value="<?php echo $var['product_num']?>"/>
			<input Type="hidden" Name="return_url"    value="<?php echo $var['return_url']?>"/>
			<input Type="hidden" Name="show_url"      value="<?php echo $var['show_url']?>"/>
			<input Type="hidden" Name="redo_flag"     value="<?php echo $var['redo_flag']?>"/>
		</form>
	</body>
</html>