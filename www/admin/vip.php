<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$name=$_GET["name"];
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(ubovip,$type);
$page=$_GET["page"];
if ($page){
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"vip.php?page=$page");
}else{
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"vip.php");
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Language" content="zh-CN">
<title>��Դ�б�</title>
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
<div class="divHeader">��Դ�б�</div><div class="SubMenu"></div><div id="divMain2">
<form class="search" method="get" action="">
<p>����:
<input id="name" name="name" style="width:150px;" type="text" value="">
<input type="submit" class="button" value="�ύ">
<input type="button" class="button" value="��Դ���" onClick="location.href='viptj.php'">
</p></form>
<table width=100% border="1" cellspacing="0" cellpadding="0" class="tableBorder tableBorder-thcenter">
<tbody>
<tr>
<tr class="color1">
<th>����</th>
<th>��ַ</th>
<th>����</th>
</tr>
<?php 
$Page_size=8; 
$sql = "WHERE 1=1";
if($name){
$sql .=" and name like '%$name%' ";
}
$result = mysql_query("select id from ubovip   ".$sql."  ");
if($result == 0){
echo '<tr class="color2"><td colspan=5 align="center">��ѯ��������</td></tr>';
}
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
$query = mysql_query("select * from  ubovip   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 	
<tr class="color2">
<td align="center"><?php echo $a[name]?></td>			

<td align="center"><?php if($a[url]==null){ ?>����Ƶ��ַ<?php }else{ ?><?php echo $a[url]?><?php } ?></td>
<td align="center">
<a href="vipedit.php?id=<?php echo $a[id]?>&page=<?php echo $page?>" class="button"><img src="images/page_edit.png" alt="���ӱ༭" title="���ӱ༭" width="16"></a>&nbsp;<a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="button"target="msgubotj"><img src="images/delete.png" alt="����ɾ��" title="����ɾ��" width="16"></a>
</td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ����� 
$pageoffset = ($page_len-1)/2;//ҳ���������ƫ���� 
$key='<tr><td colspan=5><div class="pagination">'; 
$key.="<a class='number' >��ǰ�� $page ҳ/�� $pages ҳ</a> "; //�ڼ�ҳ,����ҳ 
if($page!=1){ 
if($name){
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1&name=$name\">��ҳ</a> "; //��ҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."&name=$name\">��һҳ</a>"; //��һҳ 
}else {
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">��ҳ</a> "; //��ҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">��һҳ</a>"; //��һҳ 

}
}else { 
$key.="<a> ��ҳ</a> "; //��ҳ 
$key.="<a >��һҳ</a>"; //��һҳ  
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
$key.=' <a  class="number current">'.$i.'</a>'; 
} else { 
if($name){
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."&name=$name\">".$i."</a>"; 
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>"; 
}
} 
} 
if($page!=$pages){ 
if($name){
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."&name=$name\">��һҳ</a> ";//��һҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}&name=$name\">���һҳ</a>"; //���һҳ 
}else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">��һҳ</a> ";//��һҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">���һҳ</a>"; //���һҳ 
}
}else { 
$key.=" <a >��һҳ</a> ";//��һҳ 
$key.="<a>���һҳ</a>"; //���һҳ 
} 
$key.='</div>'; 
?> 
<tr><td colspan=5><div class="pagination"><?php echo $key?></td></tr>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
