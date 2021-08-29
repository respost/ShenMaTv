<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE id='1'";
$wz=queryall(se2wz,$type);
if($_POST[wzok]){
$cs=$_POST[cs]+1;
$type="title='$_POST[title]',keywords='$_POST[keywords]',description='$_POST[description]' ,lujing='$_POST[lujing]',sk='$_POST[sk]',youke='$_POST[youke]',pthy='$_POST[pthy]',viphy='$_POST[viphy]',iseveryday='$_POST[iseveryday]',automatic='$_POST[automatic]',wap='$_POST[wap]',apache='$_POST[apache]',pull='$_POST[pull]',givetime='$_POST[givetime]',isgive='$_POST[isgive]',givevip='$_POST[givevip]' where id='1'";
upalldt(se2wz,$type);
echo msglayerurl("修改成功，返回页面",4,"gl.php");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>网站配置</title>
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
<li class="layui-this"><a href="gl.php">网站设置</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
<tr>
 <td height="32" width="100"><p align="left"><b>网站名称</b></p></td>
 <td ><p><input name="title" size=6 value="<?php echo $wz[title]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>关键词</b></p></td>
 <td ><p><input name="keywords" size=6 value="<?php echo $wz[keywords]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>描述</b></p></td>
 <td ><p><input name="description" size=6 value="<?php echo $wz[description]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>默认路径</b></p></td>
 <td ><p><input name="lujing" size=6 value="<?php echo $wz[lujing]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>试看时间（秒）</b></p></td>
 <td ><p><input name="sk" size=6 value="<?php echo $wz[sk]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>普通游客（次）</b></p></td>
 <td ><p><input name="youke" size=6 value="<?php echo $wz[youke]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>普通会员（次）</b></p></td>
 <td ><p><input name="pthy" size=6 value="<?php echo $wz[pthy]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>VIP会员（次）</b></p></td>
 <td ><p><input name="viphy" size=6 value="<?php echo $wz[viphy]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>观看模式</b></p></td>
 <td ><p><?php $isms=$wz[iseveryday];?><label><input class="demo--radioInput" name="iseveryday" type="radio" value="0" <?php if ($isms==0){echo "checked";}?>>&nbsp;每天</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="iseveryday" type="radio" value="1" <?php if ($isms==1){echo "checked";}?>>&nbsp;全部</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="iseveryday" type="radio" value="2" <?php if ($isms==2){echo "checked";}?>>&nbsp;关闭</label></p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>自动注册</b></p></td>
 <td ><p><?php $iszc=$wz[automatic];?><label><input class="demo--radioInput" name="automatic" type="radio" value="1" <?php if ($iszc==1){echo "checked";}?>>&nbsp;开启</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="automatic" type="radio" value="0" <?php if ($iszc==0){echo "checked";}?>>&nbsp;关闭</label></p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>翻页模式</b></p></td>
 <td ><p><?php $pull=$wz[pull];?><label><input class="demo--radioInput" name="pull" type="radio" value="1" <?php if ($pull==1){echo "checked";}?>>&nbsp;自动</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="pull" type="radio" value="0" <?php if ($pull==0){echo "checked";}?>>&nbsp;手动</label></p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>伪静态</b></p></td>
 <td ><p><?php $apache=$wz[apache];?><label><input class="demo--radioInput" name="apache" type="radio" value="1" <?php if ($apache==1){echo "checked";}?>>&nbsp;开启</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="apache" type="radio" value="0" <?php if ($apache==0){echo "checked";}?>>&nbsp;关闭</label></p></td>
</tr>
<tr>
<tr>
 <td height="32" width="100"><p align="left"><b>VIP试用</b></p></td>
 <td ><p><?php $isgive=$wz[isgive];?><label><input class="demo--radioInput" name="isgive" type="radio" value="1" <?php if ($isgive==1){echo "checked";}?>>&nbsp;开启</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="isgive" type="radio" value="0" <?php if ($isgive==0){echo "checked";}?>>&nbsp;关闭</label></p></td>
</tr>
<tr>
  <td height="32"><p align="left"><b>VIP试用时间</b></p></td>
  <td ><p><input name="givetime" size=6 value="<?php echo $wz[givetime]?>" class="layui-input" style="width:100px;"> 分钟</p></td>
</tr>
<tr>
  <td height="32"><p align="left"><b>VIP试用名称</b></p></td>
  <td ><p><input name="givevip" size=6 value="<?php echo $wz[givevip]?>" class="layui-input" style="width:200px;"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>手机版网址</b></p></td>
 <td ><p><input name="wap" size=6 value="<?php echo $wz[wap]?>" class="layui-input"> </p></td>
</tr>
</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:6px;">
  <tr>
    <td width="100" height="32" style="padding: 6px 10px;">&nbsp;</td>
    <td style="padding: 6px 10px;"><input name="Action" type="hidden" id="Action" value="SaveConfig">
<input type="submit" class="layui-btn" value="保存" id="btnPost" onClick="" name="wzok"></td>
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