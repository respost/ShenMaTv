<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$time=time();
if($_POST[sdok]){
$page=$_GET["page"];
$array = $_POST["del_id"]; 
if(!empty($array)){
$del_sun=count($array); 
for($i=0;$i<$del_sun;$i++){
$type="id=".$array[$i];
dbdel(ubocard,$type);
}
echo"<script>alert('ɾ���ɹ�');history.go(-1);</script>";  
exit;
}
}
//�����ı�
if($_POST[dcok]){
$page=$_GET["page"];
$array = $_POST["del_id"]; 
if(!empty($array)){
$query = mysql_query("select * from  ubocard where status=0 and id IN (".implode(',',$array).")");
$i=1;
Header("Content-type: application/octet-stream");
Header("Accept-Ranges: bytes");
header( "Content-Disposition:attachment;filename=$time.txt "); 
header( "Expires:0"); 
header( "Cache-Control:must-revalidate,post-check=0,pre-check=0"); 
header( "Pragma:public"); 
while ($a=mysql_fetch_array($query)) { 
echo $a[user]."  ".$a[pass]."\r\n";  
$i++;  
};
exit;
}; 
echo"<script>alert('����ѡ��Ҫ�����Ŀ���');</script>";  
}
$userid=$_GET["userid"];
$del=$_GET[action];
$delid=$_GET[delid];
$page=$_GET["page"];
if($del=="del"){
$type="id='$delid'";
dbdel(ubocard,$type);
$page=$_GET["page"];
if ($page){
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"card.php?page=$page");
exit;
}else{
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"card.php");
exit;
}
}

$id=$_GET[id];
$page=$_GET[page];
if($id){
$adminname=$_COOKIE[adminname];
$type="status='1',endtime='$time',mgr='$adminname' where id=".$id;
upalldt(ubocard,$type);
echo msglayerurl("ʹ�óɹ���",8,"card.php?page=$page");
exit;
}
$cid=$_GET[cid];
$page=$_GET[page];
if($cid){
$type="status='0',endtime='0',mgr='' where id=".$cid;
upalldt(ubocard,$type);
echo msglayerurl("���óɹ���",8,"card.php?page=$page");
exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>���ܹ���</title>
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
����function All(e, itemName)
����{
����var aa = document.getElementsByName(itemName);
����for (var i=0; i<aa.length; i++)
����aa[i].checked = e.checked; 
����}
function checkdel(delid,formname){
var flag = false;
for(i=0;i<delid.length;i++){
if(delid[i].checked == true){
flag = true;
break;
}
}
if(!flag){
return true;
}
else
{
formname.submit();
}
}
</script>
</head>
<body>
<div class="layui-layout layui-layout-admin">
<?php include_once('header.php'); ?>
<?php include_once('left.php'); ?>
<?php 
//ÿҳ��ʾ����������
if(empty($_GET['pagesize'])){ 
$Page_size=10; 
}else { 
$Page_size=$_GET['pagesize']; 
} 
$userid=$_GET["userid"];
$terrace=$_GET["terrace"];

?>
<!--����-->
<div class="layui-body">
<!--tab��ǩ-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="card.php">���ܹ���</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>���ţ�<input id="userid" name="userid" style="width:150px;" type="text" value="<?php if($userid==null){ }else{ echo $userid;}?>" class="layui-input"> 	
	���ࣺ<select name="terrace">
		<option value="0">ȫ��</option>
		<option value="1" <?php if ($terrace==1){?> selected <?php } ?> >10Ԫ��ֵ��</option>
		<option value="2" <?php if ($terrace==2){?> selected <?php } ?>>30Ԫ��ֵ��</option>
		<option value="3" <?php if ($terrace==3){?> selected <?php } ?>>50Ԫ��ֵ��</option>
		<option value="4" <?php if ($terrace==4){?> selected <?php } ?>>100Ԫ��ֵ��</option>
	</select>&nbsp;&nbsp;
	ÿҳ��ʾ��<select name="pagesize" lay-filter="number">
	  <?php for ($x=1; $x<=10; $x++) {?><option <?php if (($Page_size/10)==$x){?> selected <?php } ?> value="<?php echo $x;?>0"><?php echo $x;?>0&nbsp;��/ҳ</option><?php }?>
	</select>&nbsp;&nbsp;
<input type="submit" class="layui-btn" value="����">&nbsp;<input type="button" class="layui-btn" value="���ɿ���" onClick="location.href='addcard.php'"></td>
  </tr>
</table>
</form>
<form id="form1" name="form1" method="post" action="">
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
<tbody>
<tr class="color1">
  <th>&nbsp;</th>
<th><div align="center">���ܱ��</div></th>
<th><div align="center">����</div></th>
<th><div align="center">����</div></th>
<th><div align="center">��ֵ</div></th>
<th><div align="center">����</div></th>
<th><div align="center">����ʱ��</div></th>
<th><div align="center">ʹ��ʱ��</div></th>
<th><div align="center">������</div></th>
<th><div align="center">����ƽ̨</div></th>
<th><div align="center">״̬</div></th>
<th><div align="center">����</div></th>
</tr>
<?php 
$sql = "WHERE 1=1";
if($userid){
$sql .=" and (user like '%$userid%' )";
}
if(!empty($terrace)&&$terrace!=0){
$sql .=" and terrace_id= '$terrace' ";
}
$result = mysql_query("select id from ubocard   ".$sql."  ");
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
$query = mysql_query("select * from  ubocard   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$dqtime=$a[dqtime];
$lxcs=$a[lxcs];
$ip=$a[ip];
?> 	
<tr class="color2">
  <td align="center"><input type="checkbox" name="del_id[]" value="<?php echo $a['id']; ?>" id="del_id" class="demo--radioInput" style="margin:0;"e/></td>
<td align="center" height="24"><?php echo $a[id]?></td>
<td align="center"><?php echo $a[user];?></td>
<td align="center"><?php echo $a[pass];?></td>
<td align="center"><?php echo "��".$a[money]."Ԫ";?></td>
<td align="center"><?php echo $a[serve];?></td>
<td align="center"><?php echo date('Y-m-d H:i',$a[kstime]);?></td>
<td align="center"><?php $endtime=$a[endtime]; if ($endtime) {echo date('Y-m-d H:i:s',$a[endtime]);}else{echo "-";}?></td>
<td align="center"><?php $mgr=$a[mgr]; if ($mgr){echo $a[mgr];}else{echo "-";}?></td>
<td align="center"><?php echo $a[terrace];?></td>	
<td align="center"><?php $status=$a[status]; if ($status>0) {echo "��ʹ��";}else{echo "δʹ��";}?></td>
<td align="center"><?php if ($status>0){?><a href="?cid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-normal layui-btn-mini" target="msgubotj">����</a><?php }else{?><a href="?id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-normal layui-btn-mini" target="msgubotj">ʹ��</a><?php }?>&nbsp;<a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"target="msgubotj">ɾ��</a></td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ����� 
$pageoffset = ($page_len-1)/2;//ҳ���������ƫ���� 
$key='<li>'; 
$key.="<a class=\"number\">�����鵽$count �����ݣ� ��ǰ�� $page ҳ/�� $pages ҳ</a></li>"; //�ڼ�ҳ,����ҳ 
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
<tr>
  <td colspan=18 style="padding-left:20px;" height="38"><label id="chkAll"><input class="demo--radioInput" style="margin:0;" type="checkbox" name="chkAll" id="chk" title="ȫѡ/��ѡ" onClick="All(this, 'del_id[]')" />
  ȫѡ </label> <input type="submit" name="dcok" value="�����ı�" class="layui-btn" style="position:relative; height:26px; line-height:26px; margin-left:6px;" border="0"  target="msgubotj">&nbsp;&nbsp;<input type="submit" name="sdok" value="һ��ɾ��" onClick="javascript:if(checkdel(del_id,'check')){return true;}else{return false;};" class="layui-btn" style="position:relative; height:26px; line-height:26px; margin-left:6px;" border="0"  target="msgubotj"></td>
</tr>

<tr><td colspan=18><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
 </form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>