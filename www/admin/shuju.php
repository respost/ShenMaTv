<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$tzurl=$_SERVER["QUERY_STRING"];
$action=$_GET[action];
$delid=$_GET[delid];
$id=$_GET[id];
$time=time();
if($action=="del"){
$type="id='$delid'";
dbdel(ubotj,$type);
echo msglayerurl("ɾ���ɹ�������ҳ��",8,"shuju.php?$tzurl");
}
if($action=="qrdz"){
    $ddnr=getone("select * from ubotj WHERE id=".$id);
    $hylx=$ddnr['leixing'];
	$uid=$ddnr['uid'];
	$hqzt=$ddnr['ddzt'];
    $money=$ddnr[money];
$ddzt=3;
if ($hylx==5 && $hqzt<2)
{
$ddzt=2;
$type="money=money+$money where id='$uid'";
upalldt(ubouser,$type);
$type="ddzt='$ddzt' where id='$id'";
upalldt(ubotj,$type);
}elseif ($hylx<5 && $hqzt<2){
$ddzt=2;
$time=time();
$info=getone("select * from ubouser WHERE id=".$uid);
$oldendtime=$info['endtime'];
$hy=getone("select * from ubozf WHERE id=1");
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$hytime1=$hy[hytime1];
$hytime2=$hy[hytime2];
$hytime3=$hy[hytime3];
$hytime4=$hy[hytime4];
if ($hylx==1){echo $hymc=$member1;$days=$hytime1;}elseif ($hylx==2){echo $hymc=$member2;$days=$hytime2;}elseif ($hylx==3){echo $hymc=$member3;$days=$hytime3;}elseif ($hylx==4){echo $hymc=$member4;$days=$hytime4;}
if ($oldendtime<$time)
{$oldendtime=0;}
$endtime=strtotime("".intval($days)." days",$oldendtime==0?time():$oldendtime);
$endtimexx=date("Y-m-d",strtotime($yxqx." day"))." 23:59:59";
$endtimexx=strtotime($endtime);
$type="hylx='$hylx',hymc='$hymc',kstime='$time',endtime='$endtime' where id='$uid'";
upalldt(ubouser,$type);
$type="ddzt='$ddzt' where id='$id'";
upalldt(ubotj,$type);
}
echo msglayerurl("�����ɹ�������ҳ��",8,"shuju.php?$tzurl");
}
if($action=="swdz"){
$ddzt=3;
$type="ddzt='$ddzt' where id='$id'";
upalldt(ubotj,$type);
echo msglayerurl("�����ɹ�������ҳ��",8,"shuju.php?$tzurl");
}
$userid=$_GET["userid"];
$btime=$_GET["btime"];
$etime=$_GET["etime"];
function user($id)
{
    $name=getone("select * from ubouser WHERE id=".$id);
    $return=$name['user'];
	return $return;
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
<!--tab��ǩ-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="shuju.php">�����б�</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>��ԱID��<input id="userid" name="userid" style="width:150px;" type="text" value="<?php if($userid==null){ }else{ echo $userid;}?>" class="layui-input"> 
��ʼʱ�䣺<input style="width:100px;" name="btime" id="btime" value="<?php if($btime){ echo $btime;}?>" class="layui-input">&nbsp;����ʱ�䣺<input style="width:100px;" name="etime" id="etime" value="<?php if($etime){ echo $etime;}?>" class="layui-input">&nbsp;����״̬: <select name="ztcx" style="margin:0px;">
<option value="" <?php $ztcx=$_GET[ztcx]; if ($ztcx==0){ echo "selected";}?>>ѡ��״̬</option>
<option value="1" <?php if ($ztcx==1){ echo "selected";}?>>δ֧��</option>
<option value="2" <?php if ($ztcx==2){ echo "selected";}?>>��֧��</option>
<option value="3" <?php if ($ztcx==3){ echo "selected";}?>>�����</option>
</select>&nbsp;&nbsp;<input type="submit" class="layui-btn" value="����"></td>
  </tr>
</table>
</form>
<SCRIPT language=javascript src="../app/laydate/laydate.js" charset="gb2312"></SCRIPT>
<script>
!function(){
laydate.skin('molv');//�л�Ƥ������鿴skins����Ƥ����
laydate({elem: '#btime'});//��Ԫ��
laydate({elem: '#etime'});//��Ԫ��
}();
</script>
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
 <tbody>
<tr class="color1">
<th><div align="center">����ID</div></th>
<th><div align="center">��Ա��</div></th>
<th><div align="center">������</div></th>

<th><div align="center">���ʽ</div></th>
<th><div align="center">������</div></th>
<th><div align="center">��Ʒ����</div></th>
<th><div align="center">����ʱ��</div></th>
<th><div align="center">����״̬</div></th>
<th><div align="center">����</div></th>
</tr>
<?php 
$Page_size=16; 
$sql = "WHERE 1=1";
$ztcx=$_GET[ztcx];
if($userid || $btime || $ztcx){
$btime=strtotime($btime);
$etime=strtotime($etime);
if ($userid)
{$sql .=" and uid='$userid'";}
if ($ztcx)
{
if ($ztcx=='1'){$ztcx2="0";}
if ($ztcx=='2'){$ztcx2="1";}
if ($ztcx=='3'){$ztcx2="2";}
$sql .=" and ddzt='$ztcx2'";
}
if ($btime && $etime)
{
$sql .=" and (addtime>$btime and addtime<$etime)";
}
}
$result = mysql_query("select id from ubotj ".$sql."");
if($result == 0){
echo '<tr class="color2"><td colspan=12 align="center">��ѯ��������</td></tr>';
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
$query = mysql_query("select * from ubotj ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$sctime=date('Y-m-d H:i',$a[addtime]);
$leixing=$a[leixing];
$pid=$a[pid];
$ddzt=$a[ddzt];
$money=$a[money];
$zffs=$a[zffs];
?> 

<tr class="color2">
<td align="center" height="24"><?php echo $a[id]?></td>
<td align="center"><?php $name=user($a[uid]); echo $name;?></td>
<td align="center">��<?php echo $money?>Ԫ</td>
<td align="center"><?php if ($zffs==1){echo "΢��֧��";}elseif ($zffs==2){echo "֧����";}elseif ($zffs==3){echo "����֧��";}else{echo "���۳�";}?></td>
<td align="center"><?php echo $pid;?></td>
<td align="center"><?php if ($leixing==1){echo "VIP��ͭ��Ա";}elseif ($leixing==2){echo "VIP������Ա";}elseif ($leixing==3){echo "VIP�ƽ��Ա";}elseif ($leixing==4){echo "VIP��ʯ��Ա";}else{echo "��ҳ�ֵ";}?></td>
<td align="center"><?php echo $sctime;?></td>
<td align="center"><?php if ($ddzt==0){echo "δ֧��";}elseif ($ddzt==1){echo "��֧��";}elseif ($ddzt==2){echo "�ɹ�";}elseif ($ddzt==3){echo "ʧ��";}?></td>
<td align="center"><?php if ($ddzt==1 || $ddzt==0){?><a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=qrdz&id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-normal layui-btn-mini"  target="msgubotj">ȷ�ϵ���</a><?php }?><?php if ($ddzt==1){?><a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=swdz&id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"  target="msgubotj">��δ����</a><?php }?><?php if ($ddzt==0){?><a onClick="return window.confirm(&quot;������ȷ����������������ȡ����ֹͣ��&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"  target="msgubotj">ɾ������</a><?php }?><?php if ($ddzt==2){?>���׳ɹ�<?php }elseif ($ddzt==3){?>����ʧ��<?php }?></td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ����� 
$pageoffset = ($page_len-1)/2;//ҳ���������ƫ���� 
$key='<li>'; 
$key.="<a class=\"number\">��ǰ�� $page ҳ/�� $pages ҳ</a></li>"; //�ڼ�ҳ,����ҳ 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=1\">&laquo; ��ҳ</a></li> "; //��ҳ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=".($page-1)."\">&laquo; ��һҳ</a></li>"; //��һҳ 
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
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=".($page+1)."\">��һҳ &raquo;</a></li> ";//��һҳ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page={$pages}\">���һҳ &raquo;</a></li>"; //���һҳ 
}else { 
$key.=" <li><a >��һҳ &raquo;</a></li> ";//��һҳ 
$key.="<li><a>���һҳ &raquo;</a></li>"; //���һҳ 
} 
$key.=''; 
?> 
<tr><td colspan=16><ul class="pagination"><?php echo $key;?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>