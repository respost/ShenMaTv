<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE id='1'";
$wz=queryall(se2wz,$type);
if($_POST[wzok]){
$cs=$_POST[cs]+1;
$type="title='$_POST[title]',keywords='$_POST[keywords]',description='$_POST[description]' ,lujing='$_POST[lujing]',sk='$_POST[sk]',youke='$_POST[youke]',pthy='$_POST[pthy]',viphy='$_POST[viphy]',iseveryday='$_POST[iseveryday]',automatic='$_POST[automatic]',wap='$_POST[wap]',apache='$_POST[apache]',pull='$_POST[pull]',givetime='$_POST[givetime]',isgive='$_POST[isgive]',givevip='$_POST[givevip]' where id='1'";
upalldt(se2wz,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",4,"gl.php");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��վ����</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="css/layui.css" media="all">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/style2.css">
<!--CSS����-->
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
<!--����-->
<div class="layui-body">
<!--tab��ǩ-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="gl.php">��վ����</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
<tr>
 <td height="32" width="100"><p align="left"><b>��վ����</b></p></td>
 <td ><p><input name="title" size=6 value="<?php echo $wz[title]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>�ؼ���</b></p></td>
 <td ><p><input name="keywords" size=6 value="<?php echo $wz[keywords]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>����</b></p></td>
 <td ><p><input name="description" size=6 value="<?php echo $wz[description]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>Ĭ��·��</b></p></td>
 <td ><p><input name="lujing" size=6 value="<?php echo $wz[lujing]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>�Կ�ʱ�䣨�룩</b></p></td>
 <td ><p><input name="sk" size=6 value="<?php echo $wz[sk]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>��ͨ�οͣ��Σ�</b></p></td>
 <td ><p><input name="youke" size=6 value="<?php echo $wz[youke]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>��ͨ��Ա���Σ�</b></p></td>
 <td ><p><input name="pthy" size=6 value="<?php echo $wz[pthy]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td  height="32" width="100"><p align="left"><b>VIP��Ա���Σ�</b></p></td>
 <td ><p><input name="viphy" size=6 value="<?php echo $wz[viphy]?>" class="layui-input"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>�ۿ�ģʽ</b></p></td>
 <td ><p><?php $isms=$wz[iseveryday];?><label><input class="demo--radioInput" name="iseveryday" type="radio" value="0" <?php if ($isms==0){echo "checked";}?>>&nbsp;ÿ��</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="iseveryday" type="radio" value="1" <?php if ($isms==1){echo "checked";}?>>&nbsp;ȫ��</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="iseveryday" type="radio" value="2" <?php if ($isms==2){echo "checked";}?>>&nbsp;�ر�</label></p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>�Զ�ע��</b></p></td>
 <td ><p><?php $iszc=$wz[automatic];?><label><input class="demo--radioInput" name="automatic" type="radio" value="1" <?php if ($iszc==1){echo "checked";}?>>&nbsp;����</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="automatic" type="radio" value="0" <?php if ($iszc==0){echo "checked";}?>>&nbsp;�ر�</label></p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>��ҳģʽ</b></p></td>
 <td ><p><?php $pull=$wz[pull];?><label><input class="demo--radioInput" name="pull" type="radio" value="1" <?php if ($pull==1){echo "checked";}?>>&nbsp;�Զ�</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="pull" type="radio" value="0" <?php if ($pull==0){echo "checked";}?>>&nbsp;�ֶ�</label></p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>α��̬</b></p></td>
 <td ><p><?php $apache=$wz[apache];?><label><input class="demo--radioInput" name="apache" type="radio" value="1" <?php if ($apache==1){echo "checked";}?>>&nbsp;����</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="apache" type="radio" value="0" <?php if ($apache==0){echo "checked";}?>>&nbsp;�ر�</label></p></td>
</tr>
<tr>
<tr>
 <td height="32" width="100"><p align="left"><b>VIP����</b></p></td>
 <td ><p><?php $isgive=$wz[isgive];?><label><input class="demo--radioInput" name="isgive" type="radio" value="1" <?php if ($isgive==1){echo "checked";}?>>&nbsp;����</label>&nbsp;&nbsp;<label><input class="demo--radioInput" name="isgive" type="radio" value="0" <?php if ($isgive==0){echo "checked";}?>>&nbsp;�ر�</label></p></td>
</tr>
<tr>
  <td height="32"><p align="left"><b>VIP����ʱ��</b></p></td>
  <td ><p><input name="givetime" size=6 value="<?php echo $wz[givetime]?>" class="layui-input" style="width:100px;"> ����</p></td>
</tr>
<tr>
  <td height="32"><p align="left"><b>VIP��������</b></p></td>
  <td ><p><input name="givevip" size=6 value="<?php echo $wz[givevip]?>" class="layui-input" style="width:200px;"> </p></td>
</tr>
<tr>
 <td height="32" width="100"><p align="left"><b>�ֻ�����ַ</b></p></td>
 <td ><p><input name="wap" size=6 value="<?php echo $wz[wap]?>" class="layui-input"> </p></td>
</tr>
</tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:6px;">
  <tr>
    <td width="100" height="32" style="padding: 6px 10px;">&nbsp;</td>
    <td style="padding: 6px 10px;"><input name="Action" type="hidden" id="Action" value="SaveConfig">
<input type="submit" class="layui-btn" value="����" id="btnPost" onClick="" name="wzok"></td>
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