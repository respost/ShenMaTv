<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
if($_POST[sdok]){
$suoding=$_POST[suoding];
$suodingid=$_POST[suodingid];
$type="suoding='$suoding' where id='$suodingid'";
upalldt(ubouser,$type);
$page=$_GET["page"];
if ($page){
if($_POST[suoding]== "True"){ 
echo msglayerurl("�������������ҳ��",5,"user.php?page=$page");
}else{ 
echo msglayerurl("������������ҳ��",5,"user.php?page=$page");
}
}else{
if($_POST[suoding]== "True"){ 
echo msglayerurl("�������������ҳ��",5,"user.php");
}else{ 
echo msglayerurl("������������ҳ��",5,"user.php");
}
}
}
$userid=$_GET["userid"];
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(ubouser,$type);
$page=$_GET["page"];
if ($page){
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"user.php?page=$page");
}else{
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"user.php");
}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>��Ա����</title>
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
<li class="layui-this"><a href="user.php">��Ա����</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>��ԱID��<input id="userid" name="userid" style="width:150px;" type="text" value="<?php if($userid==null){ }else{ echo $userid;}?>" class="layui-input"> 
<input type="submit" class="layui-btn" value="����">&nbsp;<input type="button" class="layui-btn" value="��ӻ�Ա" onClick="location.href='adduser.php'"></td>
  </tr>
</table>
</form>

<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
<tbody>
<tr class="color1">
<th><div align="center">�ƹ�ID</div></th>
<th><div align="center">�û���</div></th>
<th><div align="center">ǩ������</div></th>
<th><div align="center">����ǩ��</div></th>
<th><div align="center">ǩ������</div></th>
<th><div align="center">ע��IP</div></th>
<th><div align="center">ע��ʱ��</div></th>
<th><div align="center">���</div></th>
<th><div align="center">��Ա����</div></th>
<th><div align="center">����</div></th>
</tr>
<?php 
$Page_size=16; 
$sql = "WHERE 1=1";
if($userid){
$sql .=" and (user like '%$userid%' or name like '%$userid%' )";
}
$result = mysql_query("select id from ubouser   ".$sql."  ");
if($result == 0){
echo '<tr class="color2"><td colspan=10 align="center">��ѯ��������</td></tr>';
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
$query = mysql_query("select * from  ubouser   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$dqtime=$a[dqtime];
$lxcs=$a[lxcs];
$ip=$a[ip];
?> 	
<tr class="color2">
<td align="center" height="24"><?php echo $a[userid]?></td>
<td align="center"><?php echo $a[user]?></td>
<td align="center"><?php echo $a[qdzs]?></td>
<td align="center"><?php if ($lxcs>1){echo $lxcs;}else{echo "0";}?></td>
<td align="center"><?php if ($dqtime>0){echo date('Y-m-d H:i:s',$dqtime);}else{echo "δǩ��";}?></td>
<td align="center"><?php if ($ip=='0'){echo "δ֪";}else{echo $ip;}?></td>
<td align="center"><?php echo date('Y-m-d H:i:s',$a[zctime]);?></td>
<td align="center">��<?php echo $a[money]?> Ԫ</td>
<td align="center">
<!--<?php if ($a[hylx]>0) {echo "VIP��Ա";}else{echo "��ͨ��Ա";}?>-->
<?php echo $a[hymc];?>
 </td>	
<td align="center"><a href="useredit.php?id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-normal layui-btn-mini">�༭</a>&nbsp;<a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"target="msgubotj">ɾ��</a></td>
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