<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="where id='$_GET[id]'";
$xg=queryall(ubozb,$type);
$id=rand(1000,90000);
if($_POST[add]){
include_once('cppic.php'); 
$pic=$uploadfile; 
$time=time();
if ($pic==null){
$pic=$_POST[pic2]; 
$price=$_POST[price]; 
$ptime=$_POST[time]; 
$tdate=date("Y-m-d")." ".$ptime.":01";
$settr=strtotime($tdate);
$type="name='$_POST[name]' ,fenlei='$_POST[fenlei]' ,url='$_POST[url]' ,pic='$pic',room='$_POST[room]',member='$_POST[member]',diqu='$_POST[diqu]',price='$price',xcstate='$_POST[xcstate]',switch='$_POST[switch]',addtime='$settr',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(ubozb,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",5,"xc2.php");
}else{
$pic=$uploadfile; 
$ptime=$_POST[time]; 
$tdate=date("Y-m-d")." ".$ptime.":01";
$settr=strtotime($tdate);
$type="name='$_POST[name]',fenlei='$_POST[fenlei]',url='$_POST[url]' ,pic='$pic',room='$_POST[room]',member='$_POST[member]',diqu='$_POST[diqu]',price='$price',xcstate='$_POST[xcstate]',switch='$_POST[switch]',addtime='$settr',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(ubozb,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",5,"xc2.php");
}

}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��������</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">��������</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	<input type="hidden" name="pid" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
	
<tr class="color2">
   <td width="100"><p align="left"><b>��������:</b></p></td>
   <td><p><input name="name"  class="layui-input" type="text"  value="<?php echo $xg[name]?>" style="width:280px;">&nbsp;&nbsp;���ࣺ<select name="fenlei" >
<?php
$query = mysql_query("SELECT * FROM se2fl ");
while($a = mysql_fetch_array($query)) {
$member=$xg[member];
$source=$xg[source];
$sort=$xg[sort];
?>
<option value="<?php echo $a[id]?>" <?php if ($xg[fenlei]==$a[id]){ echo "selected";}?>><?php echo $a[name]?></option>
<?php }?>
</select> 
   </p></td>
  </tr>

<tr class="color2">
   <td width="100" height="38"><p align="left"><b>�ϴ�ͼƬ:</b></p></td>
   <td><p>
<input name="file" type="file" value="���" >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='img_<?php echo $id?><?php echo $id?>'> 
</p></td>
  </tr>

<tr class="color2">
   <td width="100"><p align="left"><b>�ⲿͼƬ:</b></p></td>
   <td><p><input name="pic2"  class="layui-input" type="text"   value="<?php echo $xg[pic]?>"></p></td>
  </tr>

<tr class="color2">
   <td width="100"><p align="left"><b>��Ƶ��ַ:</b></p></td>
   <td><p><textarea name="url"  class="layui-input" style="height:100px;"><?php echo $xg[url]?></textarea></p></td>
  </tr>

<tr class="color2">
   <td width="100"><p align="left"><b>��������:</b></p></td>
   <td><p><input name="room"  class="layui-input" type="text"   value="<?php echo $xg[room]?>" style="width:100px;"> ��</p></td>
  </tr>

<tr class="color2">
  <td height="40" valign="middle"><b>���ڵ���:</b></td>
  <td><input name="diqu" type="text" class="layui-input" id="diqu" value="<?php echo $xg[diqu];?>" style="width:100px;"></td>
</tr>
<tr class="color2">
  <td height="40" valign="middle"><b>�볡Ʊ��:</b></td>
  <td><label></label><label>
    <input name="price"  class="layui-input" type="text" value="<?php echo $xg[price]?>" style="width:100px;"> Ԫ</label></td>
</tr>
<tr class="color2">
  <td height="40" valign="middle"><b>��ԱȨ��:</b></td>
  <td><label>
    <input class="demo--radioInput" name="member" type="radio" value="0" <?php $member=$xg[member]; if ($member==0){echo "checked";}?>>
��ͨ��Ա</label>
&nbsp;&nbsp;
<label>
<input class="demo--radioInput" type="radio" name="member" value="1" <?php if ($member==1){echo "checked";}?>>
VIP��Ա</label></td>
</tr>
<tr class="color2">
  <td height="40" valign="middle"><b>ֱ��״̬:</b></td>
  <td><label>
    <input class="demo--radioInput" name="xcstate" type="radio" value="0" <?php $xcstate=$xg[xcstate]; if ($xcstate==0){echo "checked";}?>>
������ʼ</label>
&nbsp;&nbsp;
<label>
<input class="demo--radioInput" type="radio" name="xcstate" value="1" <?php if ($xcstate==1){echo "checked";}?>>
������ʼ</label>&nbsp;&nbsp;
<label>
<input class="demo--radioInput" type="radio" name="xcstate" value="2" <?php if ($xcstate==2){echo "checked";}?>>
��ʱ��ʼ</label></td>
</tr>
<tr class="color2">
  <td height="40" valign="middle"><b>����ʱ��:</b></td>
  <td><label></label><label>
    <input class="layui-input" name="time" type="text" value="<?php echo date('H:i',$xg[addtime]);?>" style="width:100px;"> </label></td>
</tr>
<tr class="color2">
  <td height="40" valign="middle"><b>ǿ�ƹر�:</b></td>
  <td height="40"><label>
    <input class="demo--radioInput" name="switch" type="radio" value="0" <?php $switch=$xg['switch']; if ($switch==0){echo "checked";}?>>
��������</label>
&nbsp;&nbsp;
<label>
<input class="demo--radioInput" type="radio" name="switch" value="1" <?php if ($switch==1){echo "checked";}?>>
�رշ���</label></td>
</tr>
<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>�������:</b></p></td>
   <td><p>
     <textarea name="contents" class="layui-input" style="height:100px;"><?php echo $xg[contents]?></textarea>
   </p></td>
  </tr>
</tbody>
</table>
<p>

<br><input type="submit" class="layui-btn" value="����" id="btnPost" name= "add" style="margin-left:132px;">
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>