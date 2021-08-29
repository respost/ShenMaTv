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
$sort="new";
} 
$sql = "WHERE censor=0 and uid>0";
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
function uname($id,$lx)
{
    $lx=intval($lx);
	if ($lx==1)
	{
	$fname=getone("select * from ubozb WHERE id=".$id);
	$name=$fname['name'];
    $return="/".$fname['pic']."|".$name."|".intval($fname['money']);
	}else{
    $fname=getone("select * from ubouser WHERE id=".$id);
	$name=$fname['name'];
	if (empty($name))
	{$name=$fname['user'];}
    $return="/img/pl/".$fname['avatar'].".jpg|".$name."|".intval($fname['money']);
	}
	return $return;
	}

$Page_size=3; 
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
{"status":1,"msg":"","data":[<?php while ($a=mysql_fetch_array($query)) {$time=time();$dqtime=intval($time);$sctime=$a[addtime];$sctime=intval($sctime);$sytime=$dqtime-$sctime;$renqi=$a[cishu];if ($renqi>9999){$renqi = number_format($renqi/10000,1);$renqi = round($renqi, 1)."万";};$hysj=uname($a[uid],$a[division]);$hysj = explode('|',$hysj);if ($sytime>0){if ($sytime<60){$sctime=floor($sytime)."秒";}elseif ($sytime<3600){$sctime=floor($sytime/60)."分钟";}elseif ($sytime<86400){$sctime=floor($sytime/3600)."小时";}else{$sctime=floor($sytime/86400)."天";}}?>{"k":"<?php echo $i;?>","id":"<?php $id=$a[id]; $id = ($id*512)+12865379; $id = base64_encode($id); echo $id;?>","title":<?php $title=autoChangeCode($a[name]); echo json_encode($title)?>,"name":<?php echo json_encode(iconv('gb2312','utf-8',$hysj[1]))?>,"sctime":<?php echo json_encode(iconv('gb2312','utf-8',$sctime))?>,"status":<?php echo json_encode(iconv('gb2312','utf-8',$a[shijian]))?>,"tx_url":"<?php echo $hysj[0]?>","pic_url":"<?php echo $a[pic]?>","cishu":<?php echo json_encode(iconv('gb2312','utf-8',$renqi));?>,"favorite":"<?php echo $a[favorite]?>","money":"<?php echo $hysj[2]?>","uid":"<?php echo $a[uid]?>","division":"<?php echo $a[division]?>","hits":"<?php echo $a[hits]?>"}<?php if ($i !== $dqjl){?>,<?php }?><?php 
$i++;  
};?>],"dialog":""}