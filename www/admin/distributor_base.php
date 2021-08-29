<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE id='1'";
$zhifu=queryall(ubofxfc,$type);
if($_POST[ok]){
$type="member1='$_POST[member1]',member2='$_POST[member2]',member3='$_POST[member3]',member4='$_POST[member4]',money1='$_POST[money1]',money2='$_POST[money2]',money3='$_POST[money3]',money4='$_POST[money4]',hydivide1='$_POST[hydivide1]',hydivide2='$_POST[hydivide2]',hydivide3='$_POST[hydivide3]',hydivide4='$_POST[hydivide4]' where id='1'";
upalldt(ubofxfc,$type);
echo msglayerurl("分成设置成功，返回页面",4,"distributor_base.php");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>分成设置</title>
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
</head>
<body>
<div class="layui-layout layui-layout-admin">
<?php include_once('header.php'); ?> 
<?php include_once('left.php'); ?> 
<!--主体-->
<div class="layui-body">
<!--tab标签-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="distributor_base.php">分成设置</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" >
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color3">
<td width="100" align="left"><p align="right">
  <input name="member1" type="text" class="layui-input" value="<?php echo $zhifu[member1]?>" size="20" style="width:100px; text-align:center;">
</p></td>
<td><p><input name="money1" size=30 value="<?php echo $zhifu[money1]?>" class="layui-input" style="width:100px;">&nbsp;元&nbsp;&nbsp;<input name="hydivide1" type="text" class="layui-input" value="<?php echo $zhifu[hydivide1]?>" size="10" style="width:60px;">&nbsp;%</p></td>
</tr>
<tr class="color3">
<td align="left"><p align="right">
  <input name="member2" type="text" class="layui-input" value="<?php echo $zhifu[member2]?>" size="20" style="width:100px;text-align:center;">
</p></td>
<td><p><input name="money2" size=30  value="<?php echo $zhifu[money2]?>" class="layui-input" style="width:100px;">&nbsp;元&nbsp;&nbsp;<input name="hydivide2" type="text" class="layui-input" value="<?php echo $zhifu[hydivide2]?>" size="10" style="width:60px;">&nbsp;%</p></td>
</tr>
<tr class="color3">
<td align="left"><p align="right">
  <input name="member3" type="text" class="layui-input" value="<?php echo $zhifu[member3]?>" size="20" style="width:100px;text-align:center;">
</p></td>
<td><p><input name="money3" size=30  value="<?php echo $zhifu[money3]?>" class="layui-input" style="width:100px;">&nbsp;元&nbsp;&nbsp;<input name="hydivide3" type="text" class="layui-input" value="<?php echo $zhifu[hydivide3]?>" size="10" style="width:60px;">&nbsp;%</p></td>
</tr>
<tr class="color3">
<td align="left"><p align="right">
  <input name="member4" type="text" class="layui-input" value="<?php echo $zhifu[member4]?>" size="20" style="width:100px;text-align:center;">
</p></td>
<td><p><input name="money4" class="layui-input" id="money4"  value="<?php echo $zhifu[money4]?>" size=30 style="width:100px;">&nbsp;元&nbsp;&nbsp;<input name="hydivide4" type="text" class="layui-input" value="<?php echo $zhifu[hydivide4]?>" size="10" style="width:60px;">&nbsp;%</p></td>
</tr>
</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:6px;">
  <tr>
    <td width="100" height="32" style="padding: 6px 10px;">&nbsp;</td>
    <td  style="padding: 6px 10px;"><input type="submit" class="layui-btn" value="保存" id="btnPost" onClick="" name="ok" ></td>
  </tr>
</table>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
