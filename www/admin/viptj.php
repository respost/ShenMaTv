<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("���Ʋ���Ϊ�գ�",3);
}else{
include_once('cppic.php'); 
$pic=$uploadfile; 
if ($pic==null){
$pic2=$_POST[pic2]; 
}else{
$pic2=$uploadfile; 
}
$type="(`id`, `name`,`url`,`pic`,`ms`) VALUES (null,'$_POST[name]','$_POST[url]','$pic2','$_POST[ms]')";
dbinsert(ubovip,$type);
echo msglayerurl("��ӳɹ�������ҳ��",5,"viptj.php");
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Language" content="zh-CN">
<title>���</title>
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
<div class="divHeader">���</div>
<div id="divMain2">
<div class="tab-content" style="border: none; padding: 0px; margin: 0px; display: block;" id="tab3">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	
<table width="100%" style="padding:0px;margin:0px;" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color2">
<td width="100"><p align="left"><b>����:</b></p></td>
<td><p><input name="name"  class="text-input big-input" type="text"   value="">   
</p>
</td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>ͼƬ:</b></p></td>
<td><p>
<input name="file" type="file" value="���"  class="text-input big-input"   >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='zy_<?php echo $id?><?php echo $id?>'> 
</p>���ʹ���ⲿͼƬ��Ϊ��</td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>����ͼƬ:</b></p></td>
<td><p><input name="pic2"  class="text-input big-input" type="text"   value=""></p>���ʹ���ϴ�ͼƬ��Ϊ��</td>
</tr>
<tr class="color2">
<td width="100"><p align="left"><b>�Կ���Ƶ����:</b></p></td>
<td><p><input name="url"  class="text-input big-input" type="text"   value=""></p></td>
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
