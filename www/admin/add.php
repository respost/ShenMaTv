<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$zbid=$_GET[id];
$id=rand(1000,90000);
$type="WHERE name='$_POST[name]'";
$row=queryall(se2nr,$type);
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("名称不能为空！",3);
}elseif($row){
echo msglayer("已存在！",3);
}else{
include_once('cppic.php'); 
$pic=$uploadfile; 
$time=time();
$zbid=$_POST[zbid];
if ($pic==null){
$pic=$_POST[pic2]; 
$type="(`id`, `name`, `fenlei`,`cishu`,`uid`,`division`,`tuijian`,`url`,`download`,`pic`,`shijian`,`member`,`source`,`sort`,`addtime`,`contents`) VALUES (null,'$_POST[name]','$_POST[fenlei]','1','$zbid','1','2', '$_POST[url]', '$_POST[download]', '$pic','$_POST[shijian]','$_POST[member]','$_POST[source]','$_POST[sort]','$time','$_POST[contents]')";
dbinsert(se2nr,$type);
if ($zbid)
{
$type="trends=trends+1 where id='$zbid'";
upalldt(ubozb,$type);
}
$ulr="?id=".$zbid;
echo msglayerurl("添加成功，返回页面",5,"cp.php".$ulr);
}else{
$pic=$uploadfile; 
$type="(`id`, `name`, `fenlei`,`cishu`,`uid`,`division`,`tuijian`,`url`,`download`,`pic`,`shijian`,`member`,`source`,`sort`,`addtime`,`contents`) VALUES (null,'$_POST[name]','$_POST[fenlei]','1','$zbid','1','2', '$_POST[url]', '$_POST[download]', '$pic','$_POST[shijian]','$_POST[member]','$_POST[source]','$_POST[sort]','$time','$_POST[contents]')";
dbinsert(se2nr,$type);
if ($zbid)
{
$type="trends=trends+1 where id='$zbid'";
upalldt(ubozb,$type);
}
$ulr="?id=".$zbid;
echo msglayerurl("添加成功，返回页面",5,"cp.php".$ulr);
}

}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>视频添加</title>
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
$(document).ready(function()
{
$('#scan').on('click', function(){
  layer.open({
  type: 2,
  title: '视频上传',
  area: ['600px', '360px'],
  shadeClose: true, //点击遮罩关闭
  content: ['upload', 'no']
  });
});
});
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
<li class="layui-this"><a href="javascript:history.go(-1);">视频添加</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
<tr class="color2">
   <td width="100"><p align="left"><b>视频名称:</b></p></td>
   <td><p><input name="name" id="name"  class="layui-input" type="text"  value="" style="width:280px;">&nbsp;&nbsp;<?php if ($zbid){?><input name="zbid" type="hidden" id="zbid" value="<?php echo $zbid;?>"><?php }?>分类: <select name="fenlei" >
<?php
$query = mysql_query("SELECT * FROM se2fl  ");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>"><?php echo $a[name]?></option>
<?php }?>
</select> </p></td>
  </tr>
<tr class="color2">
   <td width="100" height="38"><p align="left"><b>上传图片:</b></p></td>
   <td><p>
<input name="file" type="file" value="浏览" >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='img_<?php echo $id?><?php echo $id?>'> </td>
  </tr>
<tr class="color2">
   <td width="100" height="38"><p align="left"><b>外部图片:</b></p></td>
   <td><p style="margin-bottom:6px;"><input name="pic2"  class="layui-input" type="text"   value="" style="width:280px;"></p> 如果使用上传图片请为空</td>
  </tr>

<tr class="color2">
  <td height="38"><p align="left"><b>上传视频:</b></p></td>
  <td><span id="scan">选择上传文件</span></td>
</tr>
<tr class="color2">
   <td width="100"><p align="left"><b>视频地址:</b></p></td>
   <td><p><textarea name="url" id="url"  class="layui-input" style="height:100px;"></textarea></p> 视频地址不能为空</td>
  </tr>

<tr class="color2">
  <td valign="middle"><p align="left"><b>下载地址:</b></p></td>
  <td><p><textarea name="download" id="download"  class="layui-input" style="height:100px;"></textarea></p> 下载地址不能为空</td>
</tr>
<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>播放时间:</b></p></td>
   <td><p><input name="shijian"  class="layui-input" type="text" value="0" style="width:100px;"> 不能为空</p></td>
  </tr>

<tr class="color2">
  <td valign="middle"><b>VIP权限:</b></td>
  <td height="40"><label><input class="demo--radioInput" name="member" type="radio" value="0" checked>
    普通视频</label>&nbsp;&nbsp;
    <label><input class="demo--radioInput" type="radio" name="member" value="1">VIP视频</label></td>
</tr>
<tr class="color2">
  <td valign="middle"><b>视频来源:</b></td>
  <td height="40">
    <?php
$query = mysql_query("SELECT * FROM ubotj3 order by id asc");
while($a = mysql_fetch_array($query)) {
$name=$a[pid];
$lyid=$a[shijian];
?>
<label><input class="demo--radioInput" name="source" type="radio" value="<?php echo $lyid;?>" <?php if ($lyid==0){echo "checked";}?>>&nbsp;<?php echo $name;?></label>&nbsp;&nbsp;
<?php }?>  </td>
</tr>
<tr class="color2">
  <td height="40" valign="middle"><b>视频排序:</b></td>
  <td><input name="sort" type="text" class="layui-input" id="sort" value="0" style="width:100px;">
    &nbsp;&nbsp;数字越大越靠前</td>
</tr>

<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>视频介绍:</b></p></td>
   <td><p>
     <textarea name="contents" class="layui-input" style="height:100px;"></textarea>
   </p></td>
  </tr>
</tbody>
</table>
<p>

<br><input type="submit" class="layui-btn" value="添加" id="btnPost" onClick=""  name= "add"  style="margin-left:132px;" >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>