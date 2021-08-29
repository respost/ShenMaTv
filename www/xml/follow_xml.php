<?php
error_reporting(0); 
include("../config/common.php");
include("../config/conn.php");
?>
<?php 
$pdid=$_GET["flid"];
$id=$_GET["id"];
$sort=$_GET["sort"];
$uid=intval($_GET['uid']);
$k=$_GET["k"];
$m=$_GET["m"];
$s=$_GET["s"];
$spid=$_COOKIE[spid];
if(empty($sort)){ 
$sort="default";
} 
$sql = "WHERE censor=0";

if($spid){
$sql .=" and id IN ($spid) ";
}

if($k){
$sql .=" and name like '%$k%' ";
}
else
{
if ($pdid)
{$sql .=" and fenlei='$pdid' ";}
if ($uid>0)
{$sql .=" and uid='$uid' ";}
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
	case 'fav':
	$order.= ', favorite DESC';
 	break;
	case 'default':
	$order.= ', id DESC';
	break;
}
if ($s=="vip")
{
$sql .=" and member='1' ";
}else{
$sql .=" and (member='0' or member='1' )";
}
$Page_size=10; 
$total = mysql_query("SELECT COUNT(*) AS num FROM se2nr ".$sql." ");
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

$query = mysql_query("select * from  se2nr  ".$sql." ".$order." limit $offset, $Page_size");
$dqjl = mysql_num_rows($query);
$i=1;
?>
{"status":1,"msg":"","data":[<?php while ($a=mysql_fetch_array($query)) { ?>{"k":"<?php echo $i;?>","id":"<?php echo $a[id];?>","title":<?php $title=autoChangeCode($a[name]); echo json_encode($title)?>,"pic_url":"<?php echo $a[pic]?>","cishu":"<?php echo $a[cishu]?>","member":"<?php echo $a[member]?>","source":"<?php echo $a[source]?>","addtime":"<?php $addtime=date('m-d',$a[addtime]); echo $addtime;?>","hits":"<?php echo $a[hits]?>"}<?php if ($i !== $dqjl){?>,<?php }?><?php 
$i++;  
};?>],"dialog":""}