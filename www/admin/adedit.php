<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="where id='$_GET[id]'";
$xg=queryall(uboad,$type);
$id=rand(1000,90000);
if($_POST[add]){
include_once('cppic.php'); 
$pic=$uploadfile; 
$time=time();
$etime=$_POST[etime]." ".date('H:i:s',time());
$etime=strtotime($etime);
if ($pic==null){
$pic=$_POST[pic2]; 
$sort=$_POST[sort]; 
$type="name='$_POST[name]',pic='$pic',fenlei='$_POST[fenlei]',state='$_POST[state]',type='$_POST[type]',url='$_POST[url]',sort='$sort',endtime='$etime',addtime='$time',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(uboad,$type);
echo msglayerurl("修改成功，返回页面",5,"ad.php");
}else{
$pic=$uploadfile; 
$sort=$_POST[sort]; 
$type="name='$_POST[name]',pic='$pic',fenlei='$_POST[fenlei]',state='$_POST[state]',type='$_POST[type]',url='$_POST[url]',sort='$sort',endtime='$etime',addtime='$time',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(uboad,$type);
echo msglayerurl("修改成功，返回页面",5,"ad.php");
}

}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>广告修改</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">广告修改</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	<input type="hidden" name="pid" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
	
<tr class="color2">
   <td width="100"><p align="left"><b>广告名称:</b></p></td>
   <td><p><input name="name"  class="layui-input" type="text"  value="<?php echo $xg[name]?>" style="width:280px;"></p></td>
  </tr>

<tr class="color2">
  <td height="38" valign="middle"><b>显示状态:</b></td>
  <td><label>
    <input class="demo--radioInput" name="state" type="radio" value="0" <?php $state=$xg[state]; if ($state==0){echo "checked";}?>>
正常</label>
    &nbsp;&nbsp;
    <label>
    <input class="demo--radioInput" type="radio" name="state" value="1" <?php if ($state==1){echo "checked";}?>>
    停止</label></td>
</tr>


<tr class="color2">
   <td width="100"><p align="left"><b>广告位置:</b></p></td>
   <td><p><select name="fenlei" class="col-xs-5" style="margin:0px;">
<?php
$query = mysql_query("SELECT * FROM uboadfl ");
while($a = mysql_fetch_array($query)) {
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
  <td height="38" valign="middle"><p align="left"><b>广告链接:</b></p></td>
  <td><p><input name="url"  class="layui-input" type="text" value="<?php echo $xg[url]?>"></p></td>
</tr>
<tr class="color2">
  <td height="38" valign="middle"><b>广告类型:</b></td>
  <td><label>
    <input class="demo--radioInput" name="type" type="radio" value="0" <?php $type1=$xg[type]; if ($type1==0){echo "checked";}?>>
图片广告</label>
    &nbsp;&nbsp;
    <label>
    <input class="demo--radioInput" type="radio" name="type" value="1" <?php if ($type1==1){echo "checked";}?>>
    代码广告</label></td>
</tr>

<tr class="color2">
  <td width="100" height="38" ><p align="left"><b>截止日期</b><br>
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
<tr class="color2">
  <td height="38" valign="middle"><p align="left"><b>排序:</b></p></td>
  <td><p><input style="width:100px;" name="sort"  class="layui-input" type="text" value="<?php echo $xg[sort]?>"></p></td>
</tr>
<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>广告代码:</b></p></td>
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