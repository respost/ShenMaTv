<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
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
{$hymc="VIP��Ա";}else{$hymc="��ͨ��Ա";}
if($_POST[pass]==null){
$type="name='$_POST[name]',tel='$_POST[tel]',qq='$_POST[qq]',alipayname='$_POST[alipayname]',alipay='$_POST[alipay]',hylx='$_POST[hylx]',hymc='$hymc',endtime='$etime'  where id='$_POST[id]'";
}else{
$newpass=md5($_POST[pass]);
$type="pass='$newpass',tel='$_POST[tel]',qq='$_POST[qq]',alipayname='$_POST[alipayname]',alipay='$_POST[alipay]',hylx='$_POST[hylx]',hymc='$hymc',endtime='$etime'  where id='$_POST[id]'";
}
upalldt(ubouser,$type);
if ($page){
echo msglayerurl("�޸ĳɹ�������ҳ��",8,"user.php?page=$page");
}else{
echo msglayerurl("�޸ĳɹ�������ҳ��",5,"user.php");
}}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��Ա�޸�</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">��Ա�޸�</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj"><input type="hidden" name="id" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color2">
  <td width="100"><p align="left"><b>�˺�</b></p></td>
  <td height="38"><p><?php echo $xg[user]?></p></td>
</tr>
<tr class="color2">
  <td width="100"><p align="left"><b>�ǳ�</b></p></td>
  <td><input name="name" type="text"  class="layui-input"   value="<?php echo $xg[name]?>"></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>����</b></p></td>
<td><p><input name="pass" type="text"  class="layui-input"   value=""> </p></td>
</tr>
<tr class="color3">
<td width="100"><p align="left"><b>QQ</b></p></td>
<td><p><input name="qq" type="text"  class="layui-input"  value="<?php echo $xg[qq]?>" ></p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>�绰</b><br></p></td>
<td><p><input name="tel" type="text"  class="layui-input"  value="<?php echo $xg[tel]?>" ></p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>�տ���</b><br>
</p></td>
<td><p><input name="alipayname" type="text"  class="layui-input" value="<?php echo $xg[alipayname]?>"  > </p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>֧�����ʺ�</b><br>
</p></td>
<td><p><input name="alipay" type="text"  class="layui-input" value="<?php echo $xg[alipay]?>"  > </p></td>
</tr>
<tr class="color2">
<td height="38" width="100"><p align="left"><b>��Ա����</b><br>
</p></td>
<td><p>

<input type="radio" name="hylx"  value="0" class="demo--radioInput" <?php if ($xg[hylx]==0) {echo "checked=\"checked\"";}?>>��ͨ��Ա&nbsp;&nbsp;
<input type="radio" name="hylx" value="1" class="demo--radioInput" <?php if ($xg[hylx]==1) {echo "checked=\"checked\"";}?>>VIP��Ա
</p></td>
</tr>
<tr class="color2">
  <td width="100"><p align="left"><b>��Ա��ֹ</b><br>
</p></td>
  <td><input style="width:100px;" name="etime" id="etime" value="<?php $etime=$xg[endtime]; if($etime==0){ echo date('Y-m-d',strtotime("+1 day"));}else{ echo date('Y-m-d',$etime);}?>" class="layui-input"></td>
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
<br><input type="submit" class="layui-btn" value="����" id="btnPost" onClick=""  name= "edit"   style="margin-left:132px;">
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
