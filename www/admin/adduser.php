<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
if($_POST[add]){
if($_POST[user]==null){
echo msglayer("�ʺŲ���Ϊ�գ�",3);
}elseif($_POST[pass]==null){
echo msglayer("���벻��Ϊ�գ�",3);
}else{
function random($length, $chars) {
$hash = '';
$max = strlen($chars) - 1;
for($i = 0; $i < $length; $i++) {
$hash .= $chars[mt_rand(0, $max)];
}
return $hash;
}
$userid=random(10, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
$newpass=md5($_POST[pass]);
$hylx=$_POST[hylx];
if ($hylx==1)
{$hymc="VIP��Ա";}else{$hymc="��ͨ��Ա";}
$etime=$_POST[etime]." ".date('H:i:s',time());
$etime=strtotime($etime);
$time=time();
$type="(`id`, `user`, `pass`,`userid`, `name`, `hylx`,`hymc`,`endtime`,`zctime`) VALUES (null,'$_POST[user]','$newpass','$userid','$_POST[name]','$hylx','$hymc','$etime','$time')"; 
dbinsert(ubouser,$type);
echo msglayerurl("��ӳɹ�������ҳ��",5,"user.php");
}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��Ա���</title>
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
<script language="javascript">
function checkdel()
{if (confirm("ȷʵҪɾ����"))
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
<!--����-->
<div class="layui-body">
<!--tab��ǩ-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="javascript:history.go(-1);">��Ա���</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color2">
  <td><p align="left"><b>�˺�</b></p></td>
  <td height="38"><p><input name="user"  class="layui-input" type="text"   value=""></p></td>
</tr>
<tr class="color2">
<td><p align="left"><b>����</b></p></td>
<td><p><input name="pass" type="text"  class="layui-input"   value=""> </p></td>
</tr>
<tr class="color2">
  <td><p align="left"><b>�ǳ�</b></p></td>
  <td><input name="name" type="text"  class="layui-input"   value=""></td>
</tr>
<tr class="color2">
<td height="38"><p align="left"><b>��Ա����</b><br>
</p></td>
<td><p>
<input type="radio" name="hylx"  value="0" class="demo--radioInput" checked="checked">��ͨ��Ա&nbsp;&nbsp;
<input type="radio" name="hylx" value="1" class="demo--radioInput">VIP��Ա
</p></td>
</tr>
<tr class="color2">
  <td><p align="left"><b>��Ա��ֹ</b><br>
</p></td>
  <td><input style="width:100px;" name="etime" id="etime" value="<?php echo date('Y-m-d',strtotime("+1 day"));?>" class="layui-input"></td>
</tr>
<SCRIPT language=javascript src="../app/laydate/laydate.js" charset="gb2312"></SCRIPT>
<script>
!function(){
laydate.skin('molv');//�л�Ƥ������鿴skins����Ƥ����
laydate({elem: '#etime'});//��Ԫ��
}();
</script>
</tbody>
</table>
<p>
<br><input type="submit" class="layui-btn" value="����" id="btnPost"  name= "add"   >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
