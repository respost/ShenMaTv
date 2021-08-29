<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
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
<li class="layui-this"><a href="count.php">网站统计</a></li>
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
 <td width="10%" height="32" align="center"><p align="center"><b>视频统计</b></p></td>
 <td width="90%"><p>总共：<?php echo $sptj;?>&nbsp;&nbsp;部&nbsp;&nbsp;|&nbsp;&nbsp;今日：<?php echo $sptj_jr;?>&nbsp;&nbsp;部</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>资源总计</b></p></td>
 <td width="90%"><p>总共：<?php echo $zgtj;?>&nbsp;&nbsp;个&nbsp;&nbsp;|&nbsp;&nbsp;今日：<?php echo $zgtj_jr;?>&nbsp;&nbsp;个</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>会员统计</b></p></td>
 <td width="90%"><p>总共：<?php echo $hytj;?>&nbsp;&nbsp;人&nbsp;&nbsp;|&nbsp;&nbsp;今日：<?php echo $hytj_jr;?>&nbsp;&nbsp;人</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>订单统计</b></p></td>
 <td width="90%"><p>总共：<?php echo $ddtj;?>&nbsp;&nbsp;条&nbsp;&nbsp;|&nbsp;&nbsp;今日：<?php echo $ddtj_jr;?>&nbsp;&nbsp;条</p></td>
</tr>
<tr>
 <td width="10%" height="32" align="center"><p align="center"><b>评论统计</b></p></td>
 <td width="90%"><p>总共：<?php echo $pltj;?>&nbsp;&nbsp;条&nbsp;&nbsp;|&nbsp;&nbsp;今日：<?php echo $pltj_jr;?>&nbsp;&nbsp;条</p></td>
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