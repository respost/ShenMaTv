<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="where id='$_GET[id]'";
$xg=queryall(uboad,$type);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>������</title>
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
<script type="text/javascript">
function copy()
{
var Url2=document.getElementById("contents");
Url2.select(); // ѡ�����
document.execCommand("Copy"); // ִ���������������
alert("�������Ѹ��ƣ�");
}
</script>
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
<li class="layui-this"><a href="javascript:history.go(-1);">������</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	<input type="hidden" name="pid" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
	
<tr class="color2">
   <td width="100" height="38"><p align="left"><b>�������:</b></p></td>
   <td><p><?php echo $xg[name]?></p></td>
  </tr>
<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>������:</b></p></td>
   <td><p>
     <textarea name="contents" id="contents" class="layui-input" style=" height:100px;"><script language="javascript" src="/plus/api.php?id=<?php echo $xg[id]?>"></script></textarea>
   </p></td>
  </tr>
</tbody>
</table>
<p>

<br><input type="button" class="layui-btn" value="����" id="btnPost"  name= "add"  style="margin-left:132px;" onClick="copy();">
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>