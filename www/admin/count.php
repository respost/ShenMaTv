<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
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
<li class="layui-this"><a href="count.php">��վͳ��</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<?php
$total=mysql_query("SELECT COUNT(*) AS num FROM se2nr");
$row=mysql_fetch_array($total);
$sptj=$row[0];

$zgtj=$sptj;
$total8=mysql_query("SELECT COUNT(*) AS num FROM ubouser");
$row8=mysql_fetch_array($total8);
$hytj=$row8[0];
$total9=mysql_query("SELECT COUNT(*) AS num FROM ubotj");
$row9=mysql_fetch_array($total9);
$ddtj=$row9[0];
$total10=mysql_query("SELECT COUNT(*) AS num FROM ubopl");
$row10=mysql_fetch_array($total10);
$pltj=$row10[0];

$tdate=date("Y-m-d")." 00:00:01";
$tdate2=date("Y-m-d")." 23:59:59";
$settr1=strtotime($tdate);
$settr3=strtotime($tdate2);
$total=mysql_query("SELECT COUNT(*) AS num FROM se2nr where addtime>= ".$settr1." and addtime<= ".$settr3);
$row=mysql_fetch_array($total);
$sptj_jr=$row[0];
$zgtj_jr=$sptj_jr;
$total8=mysql_query("SELECT COUNT(*) AS num FROM ubouser where zctime>= ".$settr1." and zctime<= ".$settr3);
$row8=mysql_fetch_array($total8);
$hytj_jr=$row8[0];
$total9=mysql_query("SELECT COUNT(*) AS num FROM ubotj where addtime>= ".$settr1." and addtime<= ".$settr3);
$row9=mysql_fetch_array($total9);
$ddtj_jr=$row9[0];
$total10=mysql_query("SELECT COUNT(*) AS num FROM ubopl where addtime>= ".$settr1." and addtime<= ".$settr3);
$row10=mysql_fetch_array($total10);
$pltj_jr=$row10[0];
?> 
<table width="100%" cellspacing="0" cellpadding="0" class="layui-table">
 <tbody>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>��Ƶͳ��</b></p></td>
 <td width="90%"><p>�ܹ���<?php echo $sptj;?>&nbsp;&nbsp;��&nbsp;&nbsp;|&nbsp;&nbsp;���գ�<?php echo $sptj_jr;?>&nbsp;&nbsp;��</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>��Դ�ܼ�</b></p></td>
 <td width="90%"><p>�ܹ���<?php echo $zgtj;?>&nbsp;&nbsp;��&nbsp;&nbsp;|&nbsp;&nbsp;���գ�<?php echo $zgtj_jr;?>&nbsp;&nbsp;��</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>��Աͳ��</b></p></td>
 <td width="90%"><p>�ܹ���<?php echo $hytj;?>&nbsp;&nbsp;��&nbsp;&nbsp;|&nbsp;&nbsp;���գ�<?php echo $hytj_jr;?>&nbsp;&nbsp;��</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>����ͳ��</b></p></td>
 <td width="90%"><p>�ܹ���<?php echo $ddtj;?>&nbsp;&nbsp;��&nbsp;&nbsp;|&nbsp;&nbsp;���գ�<?php echo $ddtj_jr;?>&nbsp;&nbsp;��</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>����ͳ��</b></p></td>
 <td width="90%"><p>�ܹ���<?php echo $pltj;?>&nbsp;&nbsp;��&nbsp;&nbsp;|&nbsp;&nbsp;���գ�<?php echo $pltj_jr;?>&nbsp;&nbsp;��</p></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>