<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$page=$_GET["page"];
$type="where id='$_GET[id]'";
$xg=queryall(ubovip,$type);
if($_POST[add]){
include_once('cppic.php'); 
$pic=$uploadfile; 
if ($pic==null){
$pic2=$_POST[pic2]; 
$type="name='$_POST[name]',pic='$pic2' ,url='$_POST[url]' ,ms='$_POST[ms]'      where id='$_POST[pid]'";
upalldt(ubovip,$type);
}else{
$pic2=$uploadfile; 
$type="name='$_POST[name]',pic='$pic2' ,url='$_POST[url]' ,ms='$_POST[ms]'      where id='$_POST[pid]'";
upalldt(ubovip,$type);
}

if ($page){
echo msglayerurl("�޸ĳɹ�������ҳ��",8,"vip.php?page=$page");
}else{
echo msglayerurl("�޸ĳɹ�������ҳ��",5,"vip.php");
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Language" content="zh-CN">
<title>�޸�</title>
<link href="images/admin2.css" rel="stylesheet" type="text/css">
<script src="images/common.js" type="text/javascript"></script>
<script src="images/c_admin_js_add.js" type="text/javascript"></script>
<link rel="stylesheet" href="images/jquery.bettertip.css" type="text/css" media="screen">
<script src="images/jquery.bettertip.pack.js" type="text/javascript"></script>
<script src="images/jquery-ui.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="images/jquery-ui.custom.css">
<SCRIPT language=javascript src="../app/layer/layer.js"></SCRIPT>
<SCRIPT language=javascript src="../app/layer/diy.js"></SCRIPT>
</head>
<body>
<?php include_once('header.php'); ?> 
<?php include_once('left.php'); ?> 
<div class="main_right">
<div class="yui">
<div class="content">
<div id="divMain">
<div class="divHeader">�޸�</div>
<div id="divMain2">
<div class="tab-content" style="border: none; padding: 0px; margin: 0px; display: block;" id="tab3">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	<input type="hidden" name="pid" value="<?php echo $xg[id]?>">	
<table width="100%" style="padding:0px;margin:0px;" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color2">
<td width="100"><p align="left"><b>����:</b></p></td>
<td><p><input name="name"  class="text-input big-input" type="text"   value="<?php echo $xg[name]?>">  
</p>
</td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>ͼƬ:</b></p></td>
<td><p>
<input name="file" type="file" value="���"  class="text-input big-input"   >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='zy_<?php echo $id?><?php echo $id?>'>  
</p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>�Կ���Ƶ����:</b></p></td>
<td><p><input name="url"  class="text-input big-input" type="text"   value="<?php echo $xg[url]?>"></p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>����ͼƬ:</b></p></td>
<td><p><input name="pic2"  class="text-input big-input" type="text"   value="<?php echo $xg[pic]?>"></p></td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>����:</b></p></td>
<td><p>
<select name="ms" class="col-xs-5" >
<option value="vip">VIP</option>
<option value="���Ƽ�">���Ƽ�</option>
<option value="����">����</option>
<option value="�Կ�">�Կ�</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="����">����</option>
<option value="�ջ�">�ջ�</option>
</select>
</p></td>
</tr>
</tbody>
</table>
<p>
<br><input type="submit" class="button" value="�ύ" id="btnPost" onClick=""  name= "add"   >
</p>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>

