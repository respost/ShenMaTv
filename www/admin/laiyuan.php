<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE pid='$_POST[name]'";
$row=queryall(ubotj3,$type);  
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("��Դ���Ʋ���Ϊ�գ�",3);
}elseif($_POST[url]==null){
echo msglayer("��Դ������Ϊ�գ�",3);
}elseif($_POST[jiexi]==null){
echo msglayer("�����ӿڲ���Ϊ�գ�",3);
}elseif($_POST[lyid]==null){
echo msglayer("��ԴID�Ų���Ϊ�գ�",3);
}elseif($row){
echo msglayer("��Դ�Ѵ��ڣ�",3);
}else{
$type="(`id`, `pid`, `uid`, `money`, `shijian`) VALUES (null, '$_POST[name]', '$_POST[url]', '$_POST[jiexi]', '$_POST[lyid]')";
dbinsert(ubotj3,$type);
echo msglayerurl("�����Դ�ɹ�������ҳ��",5,"laiyuan.php");
}
}
$id=$_GET[id];
$type="WHERE id='$id'";
$duqu=queryall(ubotj3,$type);
if($_POST[edit]){
if($_POST[name]==null){
echo msglayer("��Դ���Ʋ���Ϊ�գ�",3);
}elseif($_POST[url]==null){
echo msglayer("��Դ������Ϊ�գ�",3);
}elseif($_POST[jiexi]==null){
echo msglayer("��������Ϊ�գ�",3);
}elseif($_POST[lyid]==null){
echo msglayer("��ԴID����Ϊ�գ�",3);
}else{
$type="pid='$_POST[name]',uid='$_POST[url]',shijian='$_POST[lyid]',money='$_POST[jiexi]' where id='$id'";
upalldt(ubotj3,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",4,"laiyuan.php");
}
}
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(ubotj3,$type);
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"laiyuan.php");
}
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��Դ����</title>
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
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="laiyuan.php">�����Դ</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
 <table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tr>
<td width="100" scope="col" height="26"><p>��Դ���ƣ�</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="name" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="name" value="<?php echo $duqu[pid]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td scope="col" height="26"><p>��ԴID�ţ�</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="lyid" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="lyid" value="<?php echo $duqu[shijian]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td scope="col" height="26"><p>�������ã�</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="url" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="url" value="<?php echo $duqu[uid]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td scope="col" height="26"><p>�����ӿڣ�</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="jiexi" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="jiexi" value="<?php echo $duqu[money]?>"/>
<?php  } ?>
</td>
</tr>
</td>
</tr>
</table>
<p>
<br>
<?php if($id==null){ ?>
<input type="submit" class="layui-btn" value="���" id="btnPost" onClick=""  name="add" >
<?php }else{ ?>
<input type="submit" class="layui-btn" value="�޸�" id="btnPost" onClick=""  name="edit" >
<?php  } ?>
</p>
</form>
</div>
</div>
</div>
<!--tab��ǩ-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="laiyuan.php">��Դ�б�</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color1">
  <td><p align="center"><b>��ԴID��</b></p></td>
 <td><p align="center"><b>��Դ����</b></p></td>
 <td><p align="center"><b>��Դ����</b></p></td>

<td><p align="center"><b>����</b></p></td>
</tr>
<?php 
$Page_size=12; 
$result=mysql_query("SELECT * FROM ubotj3  "); 
$count = mysql_num_rows($result); 
$page_count = ceil($count/$Page_size); 
$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 

//�жϵ�ǰҳ�� 
if(empty($_GET['page'])||$_GET['page']<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 
$offset=$Page_size*($page-1); 
$query = mysql_query("select * from  ubotj3  limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 
<tr class="color3">
  <td align="center"><p align="center"><?php echo $a[shijian]?></p></td>
 <td height="30" align="center"><p align="center"><?php echo $a[pid]?></p></td>
 <td align="center"><p align="center"><?php echo $a[uid]?></p></td>

 
<td align="center"><p align="center"><a href="laiyuan.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">�༭</a>&nbsp;<a  onclick="return checkdel()"  target="msgubotj"  href="laiyuan.php?action=del&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >ɾ��</a> </p></td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ����� 
$pageoffset = ($page_len-1)/2;//ҳ���������ƫ���� 
$key='<li>'; 
$key.="<a class=\"number\">��ǰ�� $page ҳ/�� $pages ҳ</a></li>"; //�ڼ�ҳ,����ҳ 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=1\">&laquo; ��ҳ</a></li> "; //��ҳ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">&laquo; ��һҳ</a></li>"; //��һҳ 
}else { 
$key.="<li><a>&laquo; ��ҳ</a></li> "; //��ҳ 
$key.="<li><a >&laquo; ��һҳ</a></li>"; //��һҳ  
} 
if($pages>$page_len){ 
//�����ǰҳС�ڵ�����ƫ�� 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{//�����ǰҳ������ƫ�� 
//�����ǰҳ����ƫ�Ƴ�������ҳ�� 
if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
//����ƫ�ƶ�����ʱ�ļ��� 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <li class="active"><span>'.$i.'</span></li>'; 
} else { 
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">��һҳ &raquo;</a></li> ";//��һҳ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">���һҳ &raquo;</a></li>"; //���һҳ 
}else { 
$key.=" <li><a >��һҳ &raquo;</a></li> ";//��һҳ 
$key.="<li><a>���һҳ &raquo;</a></li>"; //���һҳ 
} 
$key.=''; 
?> 
	
<tr><td colspan=16><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>