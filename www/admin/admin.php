<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE name='$_POST[username]'";
$row=queryall(uboadmin,$type);  
if($_POST[add]){
if($_POST[username]==null){
echo msglayer("�ʺŲ���Ϊ�գ�",3);
}elseif($_POST[password]==null){
echo msglayer("���벻��Ϊ�գ�",3);
}elseif($row){
echo msglayer("����Ա�Ѵ��ڣ�",3);
}else{
$newpass=md5($_POST[password]);
$type="(`id`, `name`, `pass`) VALUES (null, '$_POST[username]', '$newpass')";
dbinsert(uboadmin,$type);
echo msglayerurl("��ӹ���ɹ�������ҳ��",5,"admin.php");
}
}
$userid=$_GET[id];
$type="WHERE id='$userid'";
$duqu=queryall(uboadmin,$type);
if($_POST[edit]){
if($_POST[username]==null){
echo msglayer("�ʺŲ���Ϊ�գ�",3);
}elseif($_POST[password]==null){
echo msglayer("���벻��Ϊ�գ�",3);
}else{
$newpass=md5($_POST[password]);
$type="name='$_POST[username]',pass='$newpass'   where id='$userid'";
upalldt(uboadmin,$type);
echo msglayerurl("�޸ĳɹ�������ҳ��",4,"admin.php");
}
}
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(uboadmin,$type);
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"admin.php");
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>�����б�</title>
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
</head>
<body>
<div class="layui-layout layui-layout-admin">
<?php include_once('header.php'); ?> 
<?php include_once('left.php'); ?> 
<!--����-->
<div class="layui-body">
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="admin.php">��ӹ���Ա</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
 <table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tr>
<td width="100" scope="col"><p>����Ա�û���</p></td>
<td  scope="col">
<?php if($userid==null){ ?>
<input class="layui-input" type="text" name="username" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="username" value="<?php echo $duqu[name]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td scope="col"><p>����Ա���룺</p></td>
<td scope="col">
<?php if($userid==null){ ?>
<input class="layui-input" type="text" name="password" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="password" value="<?php echo $duqu[pass]?>"/>
<?php  } ?>
</td>
</tr>

</td>
</tr>
</table>
<p>
<br>
<?php if($userid==null){ ?>
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
<li class="layui-this"><a href="admin.php">�����б�</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color1">
 <th><p align="center"><b>���</b></p></th>
 <th><p align="center"><b>�û���</b></p></th>

<th><p align="center"><b>����</b></p></th>
</tr>
<?php 
$Page_size=5; 
$result=mysql_query("SELECT * FROM uboadmin  "); 
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
$query = mysql_query("select * from  uboadmin  limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 
<tr class="color3">
 <td height="30" align="center"><p align="center"><?php echo $a[id]?></p></td>
 <td align="center"><p align="center"><?php echo $a[name]?></p></td>

 
<td align="center"><a href="admin.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">�༭</a><a href="admin.php?action=del&delid=<?php echo $a[id]?>" target="msgubotj" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">ɾ��</a></td>
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
	
<tr><td colspan=15><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
