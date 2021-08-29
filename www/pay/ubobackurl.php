<?php
error_reporting(0); 
$ubodingdan=$_GET["ubodingdan"];
$ubomoney=$_GET["ubomoney"];
$pid=$_GET["pid"];
$uid=$_GET["uid"];
$url="../index.php?pid=".$pid."&uid=".$uid;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gb2312">
<title>支付成功</title>
<meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=no;" />
<meta name= "format-detection" content= "telephone=no" />
<link href="css/payok.css" rel="stylesheet">
</head>
<body>
<div class="hi">
<div class="sx">交易详情</div>
<div class="wei">微信安全支付</div>
</div>
<div id="" class="">
<div class="content">
<div class="status_wrap">
<div class="icon_success"></div>
<p class="status_txt col_blue">支付成功</p>
<p class="status_txt col_blue">订单号：<?php echo $ubodingdan?></p>
<p class="status_txt">￥<?php echo $ubomoney?>元</p>
<p class="status_txt"><input type="submit"  onClick="window.location='<?php echo $url?>'" value="完成支付" class="ui-btn-weixin"  style="font-size: 20px;margin-top:10px; width:98%;background-color:#00bbee;border-radius:5px; height:40px;" > 
</p>
</div>
</div>
</div>
</body>
</html>
