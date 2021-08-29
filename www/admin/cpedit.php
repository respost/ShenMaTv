<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$laiyuan = $_SERVER['HTTP_REFERER'];
$type="where id='$_GET[id]'";
$xg=queryall(se2nr,$type);
$id=rand(1000,90000);
if($_POST[add]){
include_once('cppic.php'); 
$pic=$uploadfile; 
$time=time();
$laiyuan=$_POST[laiyuan];
if ($pic==null){
$pic=$_POST[pic2]; 
$sort=$_POST[sort]; 
$type="name='$_POST[name]',fenlei='$_POST[fenlei]' ,url='$_POST[url]' ,download='$_POST[download]',pic='$pic',shijian='$_POST[shijian]',member='$_POST[member]',source='$_POST[source]',sort='$sort',addtime='$time',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(se2nr,$type);
echo msglayerurl("修改成功，返回页面",5,"$laiyuan");
}else{
$pic=$uploadfile; 
$sort=$_POST[sort]; 
$type="name='$_POST[name]',fenlei='$_POST[fenlei]' ,url='$_POST[url]' ,download='$_POST[download]' ,pic='$pic',shijian='$_POST[shijian]',member='$_POST[member]',source='$_POST[source]',sort='$sort',addtime='$time',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(se2nr,$type);
echo msglayerurl("修改成功，返回页面",5,"$laiyuan");
}

}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>视频修改</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">视频修改</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data"><input name="laiyuan" type="hidden" value="<?php echo $laiyuan;?>"><input type="hidden" name="pid" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
	
<tr class="color2">
   <td width="100"><p align="left"><b>视频名称:</b></p></td>
   <td><p><input name="name"  class="layui-input" type="text"  value="<?php echo $xg[name]?>" style="width:280px;">&nbsp;&nbsp;分类：<select name="fenlei" >
<?php
$query = mysql_query("SELECT * FROM se2fl ");
while($a = mysql_fetch_array($query)) {
$member=$xg[member];
$source=$xg[source];
$sort=$xg[sort];
?>
<option value="<?php echo $a[id]?>" <?php if ($xg[fenlei]==$a[id]){ echo "selected";}?>><?php echo $a[name]?></option>
<?php }?>
</select> </p></td>
  </tr>

<tr class="color2">
   <td width="100" height="38"><p align="left"><b>上传图片:</b></p></td>
   <td><p>
<input name="file" type="file" value="浏览"  class="text-input big-input"   >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='img_<?php echo $id?><?php echo $id?>'> 
</p></td>
  </tr>



<tr class="color2">
   <td width="100"><p align="left"><b>外部图片:</b></p></td>
   <td><p><input name="pic2"  class="layui-input" type="text" value="<?php echo $xg[pic]?>"></p></td>
  </tr>

<tr class="color2">
   <td width="100"><p align="left"><b>视频地址:</b></p></td>
   <td><p><textarea name="url"  class="layui-input" style="height:100px;"><?php echo $xg[url]?></textarea></p></td>
  </tr>

<tr class="color2">
  <td valign="middle"><p align="left"><b>下载地址:</b></p></td>
  <td><p><textarea name="download"  class="layui-input" style="height:100px;"><?php echo $xg[download]?></textarea></p></td>
</tr>
<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>播放时间:</b></p></td>
   <td><p><input name="shijian"  class="layui-input" type="text" value="<?php echo $xg[shijian]?>" style="width:100px;"></p></td>
  </tr>

<tr class="color2">
  <td height="38" valign="middle"><b>VIP权限:</b></td>
  <td><label>
    <input class="demo--radioInput" name="member" type="radio" value="0" <?php if ($member==0){echo "checked";}?>>
普通视频</label>
    &nbsp;&nbsp;
    <label>
    <input class="demo--radioInput" type="radio" name="member" value="1" <?php if ($member==1){echo "checked";}?>>
    VIP视频</label></td>
</tr>
<tr class="color2">
  <td height="38" valign="middle"><b>视频来源:</b></td>
  <td>
      <?php
$query = mysql_query("SELECT * FROM ubotj3 order by id asc");
while($a = mysql_fetch_array($query)) {
$name=$a[pid];
$lyid=$a[shijian];
?>
<label><input class="demo--radioInput" name="source" type="radio" value="<?php echo $lyid;?>" <?php if ($source==$lyid){echo "checked";}?>>&nbsp;<?php echo $name;?></label>&nbsp;&nbsp;
<?php }?>  </td>
</tr>
<tr class="color2">
  <td height="38" valign="middle"><b>视频排序:</b></td>
  <td><input name="sort" type="text" class="layui-input" id="sort" value="<?php echo $sort;?>" style="width:100px;">
    &nbsp;&nbsp;数字越大越靠前</td>
</tr>
<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>视频介绍:</b></p></td>
   <td><p>
     <textarea name="contents" class="layui-input" style=" height:100px;"><?php echo $xg[contents]?></textarea>
   </p></td>
  </tr>
</tbody>
</table>
<p>

<br><input type="submit" class="layui-btn" value="保存" id="btnPost" onClick=""  name= "add"     style="margin-left:132px;" >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>