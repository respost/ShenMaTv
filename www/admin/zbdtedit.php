<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="where id='$_GET[id]'";
$xg=queryall(ubozbdt,$type);
$id=rand(1000,90000);
if($_POST[add]){
include_once('cppic.php'); 
$pic=$uploadfile; 
$time=time();
if ($pic==null){
$pic=$_POST[pic2]; 
$sort=$_POST[sort]; 
$type="name='$_POST[name]',pic='$pic',shijian='0',member='$_POST[member]',addtime='$time',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(ubozbdt,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",5,"zbdtgl.php");
}else{
$pic=$uploadfile; 
$sort=$_POST[sort]; 
$type="name='$_POST[name]',pic='$pic',shijian='0',member='$_POST[member]',addtime='$time',contents='$_POST[contents]' where id='$_POST[pid]'";
upalldt(ubozbdt,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",5,"zbdtgl.php");
}

}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��̬�޸�</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">��̬�޸�</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	<input type="hidden" name="pid" value="<?php echo $xg[id]?>">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
	
<tr class="color2">
   <td width="100"><p align="left"><b>��̬����:</b></p></td>
   <td><p><input name="name"  class="layui-input" type="text"  value="<?php echo $xg[name]?>" style="width:280px;"></p></td>
  </tr>

<tr class="color2">
   <td width="100" height="38"><p align="left"><b>�ϴ�ͼƬ:</b></p></td>
   <td><p>
<input name="file" type="file" value="���"  class="text-input big-input"   >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='img_<?php echo $id?><?php echo $id?>'> 
</p></td>
  </tr>



<tr class="color2">
   <td width="100"><p align="left"><b>�ⲿͼƬ:</b></p></td>
   <td><p><input name="pic2"  class="layui-input" type="text" value="<?php echo $xg[pic]?>"></p></td>
  </tr>


<tr class="color2">
  <td height="38" valign="middle"><b>VIPȨ��:</b></td>
  <td><label>
    <input class="demo--radioInput" name="member" type="radio" value="0" <?php $member=$xg[member]; if ($member==0){echo "checked";}?>>
��ͨ��Ա</label>
    &nbsp;&nbsp;
    <label>
    <input class="demo--radioInput" type="radio" name="member" value="1" <?php if ($member==1){echo "checked";}?>>
    VIP��Ա</label></td>
</tr>

<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>��̬����:</b></p></td>
   <td><p>
     <textarea name="contents" class="layui-input" style=" height:360px;"><?php echo $xg[contents]?></textarea>
   </p></td>
  </tr>
</tbody>
</table>
<p>

<br><input type="submit" class="layui-btn" value="����" id="btnPost" onClick=""  name= "add"     style="margin-left:132px;" >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>