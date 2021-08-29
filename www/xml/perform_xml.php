

<?php
error_reporting(0); 
include("../config/common.php");
include("../config/conn.php");
?>
<?php 
$userid=$_COOKIE[uid];
$pdid=$_GET["flid"];
$id=$_GET["id"];
$sort=$_GET["sort"];
$k=$_GET["k"];
$m=$_GET["m"];
$s=$_GET["s"];
if(empty($sort)){ 
$sort="default";
} 
$show=getone("select * from ubouser WHERE userid='$userid'");
$uid=$show['id'];
$sql = "WHERE 1=1 and switch='0'  ";
if($k){
$sql .=" and p.name like '%$k%' ";
}
else
{
if ($pdid)
{$sql .=" and p.fenlei='$pdid' ";}
elseif ($m=='new')
{
$tdate=date("Y-m-d")." 00:00:01";
$tdate2=date("Y-m-d")." 23:59:59";
$settr1=strtotime($tdate);
$settr3=strtotime($tdate2);
$sql .=" and p.addtime>= ".$settr1." and p.addtime<= ".$settr3;
}
}

$order = 'order by p.enroll desc ';

	switch ($sort){
	case 'new':
 	$order.= ', p.addtime DESC';
  	break;
  	case 'price':
	$order.= ', p.price DESC';
	break;
	case 'heat':
	$order.= ', p.cishu DESC';
	break;
	case 'hot':
	$order.= ', p.hits DESC';
 	break;
	case 'fav':
	$order.= ', p.favorite DESC';
 	break;
	case 'default':
	$order.= ', p.id DESC';
	break;
}
if ($s=="vip")
{
$sql .=" and p.member='1' ";
}else{
$hyzt==0;
$sql .=" and p.member='0' ";
}
$Page_size=8; 
$total = mysql_query("SELECT COUNT(*) AS num FROM ubozb  AS p  ".$sql." ");
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

$query = mysql_query("select p.*,i.state,i.type,i.uid from  ubozb  AS p LEFT JOIN  uboxfjl  AS i  ON  p.id=i.zyid AND i.type='8' AND  i.uid=$uid ".$sql." ".$order." limit $offset, $Page_size");
$dqjl = mysql_num_rows($query);
$i=1;
?>
{"status":1,"msg":"","data":[<?php while ($a=mysql_fetch_array($query)) { ?>{"k":"<?php echo $i;?>","id":"<?php echo $a[id];?>","title":<?php $title=autoChangeCode($a[name]); echo json_encode($title)?>,"pic_url":"<?php echo $a[pic]?>","cishu":"<?php echo $a[cishu]?>","member":"<?php echo $a[member]?>","source":"<?php echo $a[source];?>","diqu":<?php $diqu=$a[diqu]; echo json_encode(iconv('gb2312','utf-8',$diqu))?>,"room":"<?php $room=$a[room]; echo $room;?>","enroll":"<?php $enroll=$a[enroll]; echo $enroll;?>","state":"<?php $xcstate=$a[xcstate];echo $xcstate;?>","reveal":"<?php if ($xcstate==1){if ($state==0){ echo "\u5df2\u7ed3\u675f"; }else{ echo "\u76f4\u64ad\u4e2d"; }}else{ $ptime=$a['addtime'];$ptime=date('H:i',$ptime);$tdate=date("Y-m-d")." ".$ptime.":01";$dtae=intval(strtotime($tdate));$nexttime=date("Y-m-d")." ".date('H:i:s',strtotime("60 minute",$dtae));$time=time();$dtae1=strtotime($tdate);$dtae2=strtotime($nexttime); if ($xcstate==2){if ($state==0){ echo "\u5df2\u7ed3\u675f"; }else{if($time>$dtae1 && $dtae2>$time){echo "\u76f4\u64ad\u4e2d";}else{if ($dtae2<$time){echo "\u5df2\u7ed3\u675f";}else{echo  "<i></i>".date('H:i',$a[addtime]);}}}}else{echo "\u4eba\u6ee1\u5f00\u59cb";}}?>","price":"<?php $price=$a[price]; echo $price;?>","addtime":"<?php $addtime=date('m-d',$a[addtime]); echo $addtime;?>","hits":"<?php echo $a[hits]?>"}<?php if ($i !== $dqjl){?>,<?php }?><?php 
$i++;  
};?>],"dialog":""}