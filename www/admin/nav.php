<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE name='$_POST[name]' and member='$_POST[member]'";
$row=queryall(se2nav,$type);  
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("���Ʋ���Ϊ�գ�",3);
}elseif($_POST[url]==null){
echo msglayer("���Ӳ���Ϊ�գ�",3);
}elseif($row){
echo msglayer("�õ����Ѵ��ڣ�",3);
}else{
$url=$_POST[url];
$sort=$_POST[sort];
$member=$_POST[member];
$type="(`id`, `name`, `url`, `sort`, `member`) VALUES (null, '$_POST[name]', '$url', '$sort', '$member')";
dbinsert(se2nav,$type);
echo msglayerurl("������ӳɹ�������ҳ��",5,"nav.php");
}
}
$id=$_GET[id];
$type="WHERE id='$id'";
$duqu=queryall(se2nav,$type);
if($_POST[edit]){
if($_POST[name]==null){
echo msglayer("���Ʋ���Ϊ�գ�",3);
}elseif($_POST[url]==null){
echo msglayer("���Ӳ���Ϊ�գ�",3);
}else{
$url=$_POST[url];
$sort=$_POST[sort];
$member=$_POST[member];
$type="name='$_POST[name]',url='$url',sort='$sort',member='$member' where id='$id'";
upalldt(se2nav,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",4,"nav.php");
}
}
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(se2nav,$type);
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"nav.php");
}
$mor=$_GET[action];
$morid=$_GET[morid];
$m=$_GET[m];
if($mor=="mor"){
$type="mor='1' where id='$morid'";
upalldt(se2nav,$type);
if ($m=="vip")
{$sql=" and member=1";}else{$sql=" and member=0";}
$type="mor='0' where id<>'$morid' and mor>0".$sql;
upalldt(se2nav,$type);
echo msglayerurl("���óɹ�������ҳ��",8,"nav.php");
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
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="nav.php">��ӵ���</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
 <table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tr>
<td width="100" scope="col" height="32"><p>�������ƣ�</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="name" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="name" value="<?php echo $duqu[name]?>"/>
<?php  } ?></td>
</tr>
<tr>
<td scope="col" height="32"><p>�������ӣ�</p></td>
<td  scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="url" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="url" value="<?php echo $duqu[url]?>"/>
<?php  } ?></td>
</tr>

<tr>
<td  scope="col" height="32"><p>��������</p></td>
<td  scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="sort" value="0" />
<?php }else{ ?>
<input class="layui-input" type="text" name="sort" value="<?php echo $duqu[sort]?>"/>
<?php  } ?></td>
</tr>
<tr>
  <td height="42" scope="col">��Ա���ã�</td>
  <td scope="col"><label><input class="demo--radioInput" name="member" type="radio" value="0" <?php $member=$duqu[member]; if ($member==0 || $id==null){echo "checked";}?>>
    ��ͨ����</label>&nbsp;&nbsp;
    <label><input class="demo--radioInput" type="radio" name="member" value="1" <?php if ($member==1){echo "checked";}?>>��Ա����</label></td>
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
<li class="layui-this"><a href="nav.php">�����б�</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color1">
 <td><p align="center"><b>����</b></p></td>
 <td><div align="center"><strong>����</strong></div></td>
 <td><p align="center"><b>��������</b></p></td>

<td><p align="center"><b>����</b></p></td>
</tr>
<?php 
$Page_size=10; 
$result=mysql_query("SELECT * FROM se2nav"); 
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
$order = 'order by member desc,sort desc';
$query = mysql_query("select * from  se2nav ".$order." limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 
<tr class="color3">
 <td height="30" align="center"><p align="center"><?php echo $a[sort]?></p></td>
 <td align="center"><?php $member=$a[member]; if ($member==1){echo "��Ա"; }else{echo "��ͨ";}?></td>
 <td align="center"><p align="center"><?php echo $a[name]?></p></td>

 
<td align="center"><p align="center"><a href="nav.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">�༭</a>&nbsp;<a  onclick="return checkdel()"  target="msgubotj"  href="nav.php?action=del&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >ɾ��</a>&nbsp;<?php if ($a[mor]==0){?><a target="msgubotj"  href="nav.php?action=mor&morid=<?php echo $a[id]?><?php if ($member==1){echo "&m=vip"; }?>" class="layui-btn layui-btn-normal layui-btn-mini" >Ĭ��</a><?php }else{?><a target="msgubotj"  href="nav.php?action=mor&morid=<?php echo $a[id]?><?php if ($member==1){echo "&m=vip"; }?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >����</a><?php }?> </p></td>
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