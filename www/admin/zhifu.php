<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE id='1'";
$zhifu=queryall(se2zf,$type);
$id=rand(1000,90000);
if($_POST[jslok]){
include_once('cppic.php'); 
$pic=$uploadfile; 
if ($pic==null){
$pic=$zhifu[weixin]; 
}else{
$pic=$uploadfile; 
}
$type="weixin='$pic'  where id='1'";
upalldt(se2zf,$type);
echo msglayerurl("恭喜你修改成功，返回页面",4,"zhifu.php");
}

if($_POST[keyok]){
include_once('cppic.php'); 
$pic=$uploadfile; 
if ($pic==null){
$pic=$zhifu[alipay]; 
}else{
$pic=$uploadfile; 
}
$type="alipay='$pic'  where id='1'";
upalldt(se2zf,$type);
echo msglayerurl("恭喜你修改成功，返回页面",4,"zhifu.php");
}
if($_POST[ok]){
$type="zhifu='$_POST[zhifu]'  where id='1'";
upalldt(se2zf,$type);
echo msglayerurl("恭喜你修改成功，返回页面",4,"zhifu.php");
}


?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>支付设置</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="css/layui.css" media="all">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/style2.css">
<!--CSS引用-->
<link rel="stylesheet" href="css/peizhi.css">
<!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<SCRIPT language=javascript src="../app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="../app/layer/layer.js"></SCRIPT>
<script language="javascript">
function checkdel()
{if (confirm("确实要删除吗？"))
     {return (true);}
     else
     {return (false);}
}
</script>
</head>
<body>
<div class="layui-layout layui-layout-admin">
<?php include_once('header.php'); ?> 
<?php include_once('left.php'); ?> 
<!--主体-->
<div class="layui-body">
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="zhifu.php">支付方式设置</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color3">
<td height="32" width="100"><p align="left"><b>选择显示</b></p></td>
<td>
<?php if ($zhifu[zhifu]=="1"){ ?>
<input type="radio" name="zhifu" checked="" value="1" class="demo--radioInput">微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="2" class="demo--radioInput">支付宝支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="3" class="demo--radioInput">支付宝和微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="4" class="demo--radioInput">卡密支付&nbsp;&nbsp;
<?php }elseif ($zhifu[zhifu]=="2"){ ?>
<input type="radio" name="zhifu"  value="1" class="demo--radioInput">微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu" checked="" value="2" class="demo--radioInput">支付宝支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="3" class="demo--radioInput">支付宝和微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="4" class="demo--radioInput">卡密支付&nbsp;&nbsp;
<?php }elseif ($zhifu[zhifu]=="3"){ ?>
<input type="radio" name="zhifu"  value="1" class="demo--radioInput">微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu" value="2" class="demo--radioInput">支付宝支付&nbsp;&nbsp;
<input type="radio" name="zhifu" checked="checked" value="3" class="demo--radioInput">支付宝和微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="4" class="demo--radioInput">卡密支付&nbsp;&nbsp;
<?php }elseif ($zhifu[zhifu]=="4"){ ?>
<input type="radio" name="zhifu"  value="1" class="demo--radioInput">微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="2" class="demo--radioInput">支付宝支付&nbsp;&nbsp;
<input type="radio" name="zhifu"  value="3" class="demo--radioInput">支付宝和微信支付&nbsp;&nbsp;
<input type="radio" name="zhifu" checked="checked"  value="4" class="demo--radioInput">卡密支付&nbsp;&nbsp;
<?php }?>
</td>
           
              
</tr>

</tbody>
</table>
<p>
<br>
<input type="submit" class="layui-btn" value="设置" id="btnPost" onClick="" name="ok"  >
</p>
</form>
</div>
</div>
</div>
<!--tab标签-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="zhifu.php">微信支付设置</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color3">
<td><p align="center"><b>预览：</b></p></td>
<td><p><img id="ewm" width="149" height="149" src="/<?php echo $zhifu[weixin]?>"></p></td>
</tr>
<tr class="color2">
   <td width="100" height="32"><p align="center"><b>二维码:</b></p></td>
   <td><p>
<input name="file" type="file" value="浏览" >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='wxewm_<?php echo $id?><?php echo $id?>'> 
</p></td>
  </tr>
</tbody>
</table>
<p>
<br>
<input type="submit" class="layui-btn" value="设置" id="btnPost" onClick="" name="jslok"  >
</p>
</form>
</div>
</div>
</div>
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="zhifu.php">支付宝支付设置</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color3">
<td><p align="center"><b>预览：</b></p></td>
<td><p><img id="ewm" width="149" height="149" src="/<?php echo $zhifu[alipay]?>"></p></td>
</tr>
<tr class="color2">
   <td width="100" height="32"><p align="center"><b>二维码:</b></p></td>
   <td><p>
<input name="file" type="file" value="浏览" >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='zfbewm_<?php echo $id?><?php echo $id?>'> 
</p></td>
  </tr>
</tbody>
</table>
<p>
<br>
<input type="submit" class="layui-btn" value="设置" id="btnPost" onClick="" name="keyok" >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>