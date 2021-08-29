<?php
error_reporting(0); 
include("../config/common.php");
include("../config/conn.php");
?>
<?php 
$pdid=$_GET["flid"];
$id=$_GET["id"];
$sort=$_GET["sort"];
$k=$_GET["k"];
$m=$_GET["m"];
if(empty($sort)){ 
$sort="default";
} 
$sql = "WHERE 1=1";
if($k){
$sql .=" and name like '%$k%' ";
}
else
{
if ($pdid)
{$sql .=" and fenlei='$pdid' ";}
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
 	$order.= ', shijian DESC';
  	break;
  	case 'price':
	$order.= ', price DESC';
	break;
	case 'heat':
	$order.= ', hit DESC';
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

$Page_size=10; 
$total = mysql_query("SELECT COUNT(*) AS num FROM se2tunr ".$sql." ");
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

$query = mysql_query("select * from  se2tunr  ".$sql." ".$order." limit $offset, $Page_size");
$dqjl = mysql_num_rows($query);
$i=1;
$addtime=date('m-d',$a[addtime]);
?>
{"status":1,"msg":"","data":[<?php while ($a=mysql_fetch_array($query)) { ?>{"k":"<?php echo $i;?>","id":"<?php echo $a[id];?>","title":<?php $title=autoChangeCode($a[name]); echo json_encode($title)?>,"pic_url":"<?php echo $a[pic]?>","cishu":"<?php echo $a[cishu]?>","d":"<?php echo $a[d];?>","addtime":"<?php echo $addtime;?>","hits":"<?php echo $a[hits]?>"}<?php if ($i !== $dqjl){?>,<?php }?><?php 
$i++;  
};?>],"dialog":""}