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
<title>֧���ɹ�</title>
<meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=no;" />
<meta name= "format-detection" content= "telephone=no" />
<link href="css/payok.css" rel="stylesheet">
</head>
<body>
<div class="hi">
<div class="sx">��������</div>
<div class="wei">΢�Ű�ȫ֧��</div>
</div>
<div id="" class="">
<div class="content">
<div class="status_wrap">
<div class="icon_success"></div>
<p class="status_txt col_blue">֧���ɹ�</p>
<p class="status_txt col_blue">�����ţ�<?php echo $ubodingdan?></p>
<p class="status_txt">��<?php echo $ubomoney?>Ԫ</p>
<p class="status_txt"><input type="submit"  onClick="window.location='<?php echo $url?>'" value="���֧��" class="ui-btn-weixin"  style="font-size: 20px;margin-top:10px; width:98%;background-color:#00bbee;border-radius:5px; height:40px;" > 
</p>
</div>
</div>
</div>
</body>
</html>
