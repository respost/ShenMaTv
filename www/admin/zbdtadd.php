<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
if(empty($_GET[id]) and empty($_GET[spid])){ 
echo "<script>alert('��ѡ��Ҫ��ӵ�����/��Ƶ��̬��');location.href='xc2.php';</script>";
exit;
} 
include("../config/conn.php");
include("../config/common.php");
$spid=$_GET[spid];
$zbid=$_GET[id];
$id=rand(1000,90000);
$type="WHERE name='$_POST[name]' && zbid='$_POST[zbid]' ";
$row=queryall(ubozbdt,$type);
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("���Ʋ���Ϊ�գ�",3);
}elseif($row){
echo msglayer("�Ѵ��ڣ�",3);
}else{
include_once('cppic.php'); 
$pic=$uploadfile; 
$time=time();
$zbid=$_POST[zbid];
$row=getone("select * from ubozb WHERE id=".$zbid);
if ($row)
{
$zbname=$row[name];
$zbpic=$row[pic];
}
$spid=intval($_POST[spid]);
if ($pic==null){
$pic=$_POST[pic2]; 
$type="(`id`, `name`, `zbid`, `spid`,`cishu`,`zbname`,`pic`,`zbpic`,`shijian`,`member`,`sort`,`addtime`,`contents`) VALUES (null,'$_POST[name]','$zbid','$spid','1','$zbname','$pic','$zbpic','0','$_POST[member]','$_POST[sort]','$time','$_POST[contents]')";
dbinsert(ubozbdt,$type);
$type="trends=trends+1 where id='$zbid'";
upalldt(ubozb,$type);
$ulr="?id=".$zbid;
if ($spid>0){
$type="trends=trends+1 where id='$spid'";
upalldt(se2nr,$type);
$ulr="?spid=".$spid;
}
echo msglayerurl("��ӳɹ�������ҳ��",5,"zbdtgl.php".$ulr);
}else{
$pic=$uploadfile; 
$type="(`id`, `name`, `zbid`, `spid`,`cishu`,`zbname`,`pic`,`zbpic`,`shijian`,`member`,`sort`,`addtime`,`contents`) VALUES (null,'$_POST[name]','$zbid','$spid','1','$zbname','$pic','$zbpic','0','$_POST[member]','$_POST[sort]','$time','$_POST[contents]')";
dbinsert(ubozbdt,$type);
$type="trends=trends+1 where id='$zbid'";
upalldt(ubozb,$type);
$ulr="?id=".$zbid;
if ($spid>0){
$type="trends=trends+1 where id='$spid'";
upalldt(se2nr,$type);
$ulr="?spid=".$spid;
}
echo msglayerurl("��ӳɹ�������ҳ��",5,"zbdtgl.php".$ulr);
}

}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��̬���</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">��̬���</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj" enctype="multipart/form-data">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
 <tbody>
<tr class="color2">
   <td width="100"><p align="left"><b>��̬����:</b></p></td>
   <td><p><input name="name"  class="layui-input" type="text"  value="" style="width:280px;"><?php if ($zbid){?><input name="zbid" type="hidden" id="zbid" value="<?php echo $zbid;?>"><?php }else{?>&nbsp;&nbsp;<b>����:</b> <select name="zbid" >
<?php
$query = mysql_query("SELECT * FROM ubozb order by id desc ");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>"><?php echo $a[name]?></option>
<?php }?>
</select><?php }?><input name="spid" type="hidden" id="spid" value="<?php echo $spid;?>">
   </p></td>
  </tr>
<tr class="color2">
   <td width="100" height="38"><p align="left"><b>�ϴ�ͼƬ:</b></p></td>
   <td><p>
<input name="file" type="file" value="���" >
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type='hidden' name='id' value='img_<?php echo $id?><?php echo $id?>'> </td>
  </tr>
<tr class="color2">
   <td width="100" height="38"><p align="left"><b>�ⲿͼƬ:</b></p></td>
   <td><p style="margin-bottom:6px;"><input name="pic2"  class="layui-input" type="text"   value="" style="width:280px;"></p> ���ʹ���ϴ�ͼƬ��Ϊ��</td>
  </tr>


<tr class="color2">
  <td valign="middle"><b>VIPȨ��:</b></td>
  <td height="40"><label><input class="demo--radioInput" name="member" type="radio" value="0" checked>
    ��ͨ��Ա</label>&nbsp;&nbsp;
    <label><input class="demo--radioInput" type="radio" name="member" value="1">VIP��Ա</label></td>
</tr>


<tr class="color2">
   <td width="100" valign="middle"><p align="left"><b>��̬����:</b></p></td>
   <td><p>
     <textarea name="contents" class="layui-input" style="height:360px;"></textarea>
   </p></td>
  </tr>
</tbody>
</table>
<p>

<br><input type="submit" class="layui-btn" value="���" id="btnPost" onClick=""  name= "add"  style="margin-left:132px;" >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>