<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$id=rand(1000,90000);
$type="WHERE name='$_POST[name]'";
$row=queryall(sj3sk,$type);
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("名称不能为空！",3);
}elseif($row){
echo msglayer("已存在！",3);
}else{
include_once('cppic.php'); 
$pic=$uploadfile; 
date_default_timezone_set('PRC');
$shijian=date("Y-m-d H:i:s" ,time());
if ($pic==null){
$pic=$_POST[pic2]; 
$type="(`id`, `name`,`url`,`pic`) VALUES (null,'$_POST[name]','$_POST[url]','$pic2')";
dbinsert(sj3sk,$type);
echo msglayerurl("添加成功，返回页面",5,"sk.php");
}else{
$pic=$uploadfile; 
$type="(`id`, `name`,`url`,`pic`) VALUES (null,'$_POST[name]','$_POST[url]','$pic2')";
dbinsert(sj3sk,$type);
echo msglayerurl("添加成功，返回页面",5,"sk.php");
}
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Language" content="zh-CN">
<title>添加</title>
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
  <div class="divHeader">添加</div>
<div id="divMain2">
<div class="tab-content" style="border: none; padding: 0px; margin: 0px; display: block;" id="tab3">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	
<table width="100%" style="padding:0px;margin:0px;" cellspacing="0" cellpadding="0">
 <tbody>
<tr class="color2">
   <td width="100"><p align="left"><b>名称:</b></p></td>
   <td><p><input name="name"  class="text-input big-input" type="text"   value="">   </p></td>
  </tr>
<tr class="color2">
   <td width="100"><p align="left"><b>图片:</b></p></td>
   <td><p>
<input name="file" type="file" value="浏览"  class="text-input big-input"   >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='img_<?php echo $id?><?php echo $id?>'> 
</p> 如果使用外部图片请为空</td>
  </tr>
<tr class="color2">
   <td width="100"><p align="left"><b>外部图片:</b></p></td>
   <td><p><input name="pic2"  class="text-input big-input" type="text"   value=""></p>如果使用上传图片请为空</td>
  </tr>
<tr>
<td align="right">视频连接</td>
<td>
<input type="text" name="url" value="" size="80" class="inpMain" />
</td>
</tr>

</tbody>
</table>
<p>

<br><input type="submit" class="button" value="提交" id="btnPost" onClick=""  name= "add"   >
</p>
</form>
</div></div>
    </div>
    </div>
  </div>
</div>


</div>

</body></html>
