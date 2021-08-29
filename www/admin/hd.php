<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
if($_POST[ok]){
$type="name='$_POST[f1]',pic='$_POST[p1]',mpic='$_POST[m1]',url='$_POST[u1]',syurl='$_POST[t1]' where id='$_POST[fl1]'";
upalldt(se2hd,$type);
$type="name='$_POST[f2]',pic='$_POST[p2]',mpic='$_POST[m2]',url='$_POST[u2]',syurl='$_POST[t2]' where id='$_POST[fl2]'";
upalldt(se2hd,$type);
$type="name='$_POST[f3]',pic='$_POST[p3]',mpic='$_POST[m3]',url='$_POST[u3]',syurl='$_POST[t3]' where id='$_POST[fl3]'";
upalldt(se2hd,$type);
$type="name='$_POST[f4]',pic='$_POST[p4]',mpic='$_POST[m4]',url='$_POST[u4]',syurl='$_POST[t4]' where id='$_POST[fl4]'";
upalldt(se2hd,$type);
$type="name='$_POST[f5]',pic='$_POST[p5]',mpic='$_POST[m5]',url='$_POST[u5]',syurl='$_POST[t5]' where id='$_POST[fl5]'";
upalldt(se2hd,$type);
echo msglayerurl("修改成功，返回页面",6,"hd.php");
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>幻灯设置</title>
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
<li class="layui-this"><a href="hd.php">幻灯设置</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form id="addform" action="" method="post" target="msgubotj">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<?php
$query = mysql_query("SELECT * FROM se2hd ");
while($a = mysql_fetch_array($query)) {
?>  
<input type="hidden" name="fl<?php echo $a[id]?>" value="<?php echo $a[id]?>">
<tr class="color2">
<td width="100"><p align="left"><b>幻灯片（<?php echo $a[id]?>）：</b></p></td>
<td><p><input name="f<?php echo $a[id]?>"  type="text"   value="<?php echo $a[name]?>" class="layui-input" style="width:180px;">  PC图片：<input name="p<?php echo $a[id]?>" type="text"   value="<?php echo $a[pic]?>" class="layui-input" style="width:100px;">  WAP图片：<input name="m<?php echo $a[id]?>" type="text"   value="<?php echo $a[mpic]?>" class="layui-input" style="width:100px;">  WAP视频ID：<input name="u<?php echo $a[id]?>"  type="text"   value="<?php echo $a[url]?>" class="layui-input" style="width:60px;">  PC视频ID：<input name="t<?php echo $a[id]?>" type="text"   value="<?php echo $a[syurl]?>" class="layui-input" style="width:60px;"></p></td>
</tr>
<?php
}
?>
</tbody>
</table>
<p>
<br>
<input type="submit" class="layui-btn" value="保存" id="btnPost" class="layui-btn"  name= "ok"   style="margin-left:132px;">
</p>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
