<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$type="where id='$_GET[id]'";
$xg=queryall(ubouser,$type);
$page=$_GET["page"];
if($_POST[edit]){
$etime=$_POST[etime]." ".date('H:i:s',time());
$etime=strtotime($etime);
$hylx=$_POST[hylx];
if ($hylx==1)
{$hymc="VIP会员";}else{$hymc="普通会员";}
if($_POST[pass]==null){
$type="name='$_POST[name]',tel='$_POST[tel]',qq='$_POST[qq]',alipayname='$_POST[alipayname]',alipay='$_POST[alipay]',hylx='$_POST[hylx]',hymc='$hymc',endtime='$etime'  where id='$_POST[id]'";
}else{
$newpass=md5($_POST[pass]);
$type="pass='$newpass',tel='$_POST[tel]',qq='$_POST[qq]',alipayname='$_POST[alipayname]',alipay='$_POST[alipay]',hylx='$_POST[hylx]',hymc='$hymc',endtime='$etime'  where id='$_POST[id]'";
}
upalldt(ubouser,$type);
if ($page){
echo msglayerurl("修改成功，返回页面",8,"user.php?page=$page");
}else{
echo msglayerurl("修改成功，返回页面",5,"user.php");
}}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>会员修改</title>
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
<!--tab标签-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="javascript:history.go(-1);">会员修改</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj"><input type="hidden" name="id" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color2">
  <td width="100"><p align="left"><b>账号</b></p></td>
  <td height="38"><p><?php echo $xg[user]?></p></td>
</tr>
<tr class="color2">
  <td width="100"><p align="left"><b>昵称</b></p></td>
  <td><input name="name" type="text"  class="layui-input"   value="<?php echo $xg[name]?>"></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>密码</b></p></td>
<td><p><input name="pass" type="text"  class="layui-input"   value=""> </p></td>
</tr>
<tr class="color3">
<td width="100"><p align="left"><b>QQ</b></p></td>
<td><p><input name="qq" type="text"  class="layui-input"  value="<?php echo $xg[qq]?>" ></p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>电话</b><br></p></td>
<td><p><input name="tel" type="text"  class="layui-input"  value="<?php echo $xg[tel]?>" ></p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>收款人</b><br>
</p></td>
<td><p><input name="alipayname" type="text"  class="layui-input" value="<?php echo $xg[alipayname]?>"  > </p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>支付宝帐号</b><br>
</p></td>
<td><p><input name="alipay" type="text"  class="layui-input" value="<?php echo $xg[alipay]?>"  > </p></td>
</tr>
<tr class="color2">
<td height="38" width="100"><p align="left"><b>会员类型</b><br>
</p></td>
<td><p>

<input type="radio" name="hylx"  value="0" class="demo--radioInput" <?php if ($xg[hylx]==0) {echo "checked=\"checked\"";}?>>普通会员&nbsp;&nbsp;
<input type="radio" name="hylx" value="1" class="demo--radioInput" <?php if ($xg[hylx]==1) {echo "checked=\"checked\"";}?>>VIP会员
</p></td>
</tr>
<tr class="color2">
  <td width="100"><p align="left"><b>会员截止</b><br>
</p></td>
  <td><input style="width:100px;" name="etime" id="etime" value="<?php $etime=$xg[endtime]; if($etime==0){ echo date('Y-m-d',strtotime("+1 day"));}else{ echo date('Y-m-d',$etime);}?>" class="layui-input"></td>
</tr>
<SCRIPT language=javascript src="../app/laydate/laydate.js" charset="gb2312"></SCRIPT>
<script>
!function(){
laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
laydate({elem: '#etime'});//绑定元素
}();
</script>
</tbody>
</table>
<p>
<br><input type="submit" class="layui-btn" value="保存" id="btnPost" onClick=""  name= "edit"   style="margin-left:132px;">
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
