<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$name=$_GET["name"];
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(ubopl,$type);
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"pl.php");
}
$array = $_POST["del_id"]; 
if(!empty($array)){
$del_sun=count($array); 
for($i=0;$i<$del_sun;$i++){
$type="id=".$array[$i];
dbdel(ubopl,$type);
}
echo"<script>alert('ɾ���ɹ�');location.href='pl.php'</script>";  
}

function name($id,$style)
{
	switch ($style){
	case '1':
 	$datasheet= 'se2nr';
	break;
	case '2':
 	$datasheet= 'se2dsjnr';
	break;
	case '3':
 	$datasheet= 'se2dynr';
	break;
  	case '4':
	$datasheet= 'se2dmnr';
	break;
	case '5':
	$datasheet= 'se2mvnr';
	break;
	case '6':
	$datasheet= 'se2tunr';
	break;
	case '7':
	$datasheet= 'se2zynr';
	break;
	}
    $name=getone("select * from ".$datasheet." WHERE id=".$id);
    $return=$name['name'];
	return $return;
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>���۹���</title>
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
����


}
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
<li class="layui-this"><a href="pl.php">���۹���</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>������<input id="name" name="name" style="width:150px;" type="text" value="" class="layui-input"> 
<input type="submit" class="layui-btn" value="����"></td>
  </tr>
</table>
</form>
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
 <tbody>
<tr class="color1">
<th width="4%">&nbsp;</th>
<th width="12%" align="left">��Դ����</th>
<th width="7%"><div align="center">������Ŀ</div></th>
<th width="50%" align="left" >��������</th>
<th width="8%"><div align="center">�û���</div></th>
<th width="8%"><div align="center">����ʱ��</div></th>
<th width="11%"><div align="center">����</div></th>
</tr>
<form id="form1" name="form1" method="post" action="?act=set_apply_jobs">
<?php 
$Page_size=10; 
$sql = "WHERE 1=1";
if($name){
$sql .=" and neirong like '%$name%' ";
}
$result = mysql_query("select id from ubopl   ".$sql."  ");
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
$query = mysql_query("select * from  ubopl   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$time=time();
$dqtime=intval($time);
$sctime=$a[addtime];
$sctime=intval($sctime);
$sytime=$dqtime-$sctime;
if ($sytime>0)
{
if ($sytime<60){
     $sctime=floor($sytime)."��";}
	 elseif ($sytime<3600){
     $sctime=floor($sytime/60)."����";}
     elseif ($sytime<86400){
     $sctime=floor($sytime/3600)."Сʱ";}
     else{$sctime=floor($sytime/86400)."��";}
 }
?> 	
<tr class="color2">
  <td align="center" height="24"><input class="demo--radioInput" style="margin:0;" type="checkbox" name="del_id[]" value="<?php echo $a['id']; ?>" id="del_id" <?php if($nrid==0){echo "disabled=\"disabled\"";}?> /></td>
<td align="left"><span style="margin-left:10px; line-height:40px; height:40px; overflow:hidden; width:90%; display:block;"><?php $nrid=$a[nrid]; if ($nrid==0){echo "ϵͳ����";}else{$zyname=name($nrid,$a[lanmu]); echo $zyname;}?></span></td>			
<td align="center"><?php $lanmu=$a[lanmu]; if ($lanmu==1){echo "��Ƶ";}elseif ($lanmu==2){echo "�缯";}elseif ($lanmu==3){echo "��Ӱ";}elseif ($lanmu==4){echo "����";}elseif ($lanmu==5){echo "����";}elseif ($lanmu==6){echo "��ͼ";}elseif ($lanmu==7){echo "����";}elseif ($lanmu==7){echo "����";}elseif ($lanmu==0){echo "ϵͳ";}?></td>
<td align="left"><span style="margin-left:10px; line-height:40px; height:40px; overflow:hidden; width:90%; display:block;"><?php echo $a[neirong];?></span></td>
<td align="center"><span style="margin-left:10px; line-height:40px; height:40px; overflow:hidden; width:90%; display:block;"><?php echo $a[name];?></span></td>
<td align="center"><?php if($nrid==0){echo $a['shijian'];}else{echo $sctime."ǰ";}?></td>
<td align="center">
<?php if($nrid==0){echo "��ֹɾ��";}else{?><a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=del&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" target="msgubotj">ɾ��</a><?php }?></td>
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
<tr>
  <td colspan=16 style="padding-left:20px;" height="38"><label id="chkAll"><input class="demo--radioInput" style="margin:0;" type="checkbox" name="chkAll" id="chk" title="ȫѡ/��ѡ" onClick="All(this, 'del_id[]')" />
  ȫѡ </label> <input type="submit" name="jiesuan" value="һ��ɾ��" onClick="javascript:if(checkdel(del_id,'check')){return true;}else{return false;};" class="layui-btn" style="position:relative; height:26px; line-height:26px; margin-left:6px;" border="0"  target="msgubotj"></td>
</tr>
 </form>

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