<?php
error_reporting(0); 
include("../config/common.php");
include("../config/conn.php");
?>
<?php 
$pdid=$_GET["flid"];
$id=$_GET["id"];
$lxid=$_GET["lxid"];
$sort=$_GET["sort"];
$k=$_GET["k"];
$m=$_GET["m"];
$s=$_GET["s"];
if(empty($sort)){ 
$sort="default";
} 
$sql = "WHERE 1=1";
if ($lxid)
{
	switch ($lxid){
	case '1':
 	$flmc= '�ƻ�Ƭ';
  	break;
  	case '2':
	$flmc= 'ϲ��Ƭ';
	break;
	case '3':
	$flmc= '����Ƭ';
	break;
	case '4':
	$flmc= '����Ƭ';
 	break;
	case '5':
	$flmc= '����Ƭ';
	break;
	case '6':
	$flmc= '�ֲ�Ƭ';
	break;
	case '7':
	$flmc= 'ս��Ƭ';
	break;
	}
$sql .= " and shijian='$flmc'";
}
if($k){
$sql .=" and name like '%$k%' ";
}
else
{
if ($pdid)
{
if ($pdid==2 || $pdid==3)
{$sql .=" and (fenlei='2' or fenlei='3') ";}
else
{$sql .=" and fenlei='$pdid' ";}
}
elseif ($m=='new')
{
$tdate=date("Y-m-d")." 00:00:01";
$tdate2=date("Y-m-d")." 23:59:59";
$settr1=strtotime($tdate);
$settr3=strtotime($tdate2);
$sql .=" and addtime>= ".$settr1." and addtime<= ".$settr3;
}
}

$order = 'order by sort desc ';
$sort = 'new';
	switch ($sort){
	case 'new':
 	$order.= ', addtime DESC';
  	break;
  	case 'price':
	$order.= ', price DESC';
	break;
	case 'heat':
	$order.= ', cishu DESC';
	break;
	case 'hot':
	$order.= ', hits DESC';
 	break;
	case 'default':
	$order.= ', id DESC';
	break;
}
$sql .=" and shijian<>'��ɫƬ' ";
if ($s || $m=='new')
{
$userid=$_COOKIE[uid];
$type="where userid='$userid'";
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{$hyzt=0;}
if ($m=='new')
{$sql .=" and (member='1' or  member='0') ";}
else
{$sql .=" and member='1'";}
}else{
$hyzt=0;
if ($m=='new')
{$sql .=" and (member='1' or  member='0') ";}
else
{$sql .=" and member='0'";}
}
$Page_size=9; 
$total = mysql_query("SELECT COUNT(*) AS num FROM se2dynr ".$sql." ");
$row = mysql_fetch_array($total);
$count = $row[0];
$page_count = ceil($count/$Page_size); 
$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 
if(empty($_GET['p'])||$_GET['p']<0){ 
$page=1; 
}else { 
$page=$_GET['p']; 
} 
$offset=$Page_size*($page-1); 

$query = mysql_query("select * from  se2dynr  ".$sql." ".$order." limit $offset, $Page_size");
$dqjl = mysql_num_rows($query);
$i=1;
?>
{"status":1,"msg":"","data":[<?php while ($a=mysql_fetch_array($query)) { $source=$a[source]; switch ($source){ case '0': $pyname= '�ſ�'; break; case '1': $pyname= '����'; break; case '2': $pyname= '��Ѷ'; break; case '3': $pyname= '����'; break;case '4': $pyname= 'â��'; break;case '5': $pyname= '������';break; case '6' : $pyname= '����'; break;} ?>{"k":"<?php echo $i;?>","id":"<?php echo $a[id];?>","title":<?php $title=autoChangeCode($a[name]); echo json_encode($title)?>,"status":<?php echo json_encode(iconv('gb2312','utf-8',$a[shijian]))?>,"member":"<?php echo $a[member]?>","source":<?php echo json_encode(iconv('gb2312','utf-8',$pyname))?>,"pic_url":"<?php echo $a[pic]?>","cishu":"<?php echo $a[cishu]?>","hits":"<?php echo $a[hits]?>"}<?php if ($i !== $dqjl){?>,<?php }?><?php 
$i++;  
};?>],"dialog":""}