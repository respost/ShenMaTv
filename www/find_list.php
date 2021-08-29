<?php
error_reporting(0); 
include("include/os.php");
include("config/common.php");
include("config/conn.php");
$userid=$_COOKIE[uid];
$pdid=$_GET["flid"];
$id=$_GET["id"];
$sort=$_GET["sort"];
$k=$_GET["k"];
$m=$_GET["m"];
$s=$_GET["s"];
$play="xcplay.php";
include("include/xc_limit_list.php");
if(empty($sort)){ 
$sort="default";
} 
if($pdid)
{
$query = mysql_query("SELECT * FROM se2fl  where id='$pdid'");
while($a = mysql_fetch_array($query)) { 
$column=$a[name];
 }}else{
	switch ($sort){
	case 'new':
 	$name= '最新视频';
  	break;
  	case 'price':
	$name= '金币排行';
	break;
	case 'heat':
	$name= '人气排行';
	break;
	case 'hot':
	$name= '点赞排行';
 	break;
	case 'fav':
	$name= '收藏排行';
 	break;
	case 'default':
	$name= '随便看看';
	break;
	}
if ($k)
{
$column="视频搜索";
}
elseif ($m)
{
$column="今日更新";
}
else{
$column=$name;
}}
if ($s)
{$column="VIP-".$column;}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $column;?></title>
<?php include_once('include/meta.php');?>
<?php include_once('include/css.php'); ?> 
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px"<?php if($m || $pdid || $k || $sort){ ?> class="h"<?php } ?>/></i></span><i class="ico21"><?php echo $column;?></i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('include/column.php'); ?> 
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<?php if ($s){?><input name="s" type="hidden" value="vip"><?php }?><input x-webkit-speech type="text"  placeholder="请输入视频关键字" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>搜索
</button>
</div>
</form>
</div>
<?php include_once('include/nav_s.php'); ?> 
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b">
<h1 class="ui-nowrap ui-whitespace"></h1>
</header>
<?php 
if(empty($sort)){ 
$sort="default";
} 
$show=getone("select * from ubouser WHERE userid='$userid'");
$uid=$show['id'];
$sql = "WHERE censor=0 ";
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

$order = 'order by rand()';

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
	$type="where userid='$userid'";
	$time=time();
	$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
	if ($user){
		$hyzt=1;
	}else{
		$hyzt=0;
	}
	$sql .=" and member='1' ";
}else{
	$hyzt==0;
	$sql .=" and member='0' ";
}
$total = mysql_query("SELECT COUNT(*) AS num FROM se2nr ".$sql." ");
$row = mysql_fetch_array($total);
$count = $row[0];
?>
<div class="liebiao"><div class="left"><i></i>找到<span><?php echo $count ?></span>个视频</div><div class="right"><a href="" rel="external" class="ui-link" style="float:right; width:34%;margin-left: 0; margin-right:2px;"><span><i style="padding:0 12px;background:url(/img/hh.png) 4px -1px no-repeat;background-size: 16px 16px; vertical-align: middle; margin-left:-6px;"></i>换一批</span></a></div></div>
<section class="ui-panel">
<h2 class="ui-arrowlink"><?php if ($count==0){echo "<span style=\"display:block; width:100%; line-height:80px;height:90px;text-align:center;\">暂无视频！</span>";}?></h2>
<!--广告开始-->
<?php 
$query = mysql_query("select id from uboad where fenlei=2 ");
while ($a=mysql_fetch_array($query)) { 
echo '<script language="javascript" src="/plus/api.php?id='.$a[id].'"></script>';
}
?> 
<!--广告结束-->
<ul class="ui-grid-trisect" id="vlist" style="padding-right:10px;">
<?php 
$query = mysql_query("select * from  se2nr ".$sql." ".$order." limit 1, 10");
$i=1;
while ($a=mysql_fetch_array($query)) { 
$gxtime=date('m-d',$a[addtime]);
?>
<li v-for="item in data" style='width: 49.5%;'>
<div class="ui-grid-trisect-img" style='padding-top: 54.47%;'><?php $member=$a[member]; if($member==1 && $hyzt=="0"){?><span onClick="pay()" style="background-image:url('<?php echo $a[pic]?>')"></span><?php }elseif($member==0 || $hyzt==1){?>
<span onClick="uboplay('<?php echo $a[id]?>','ubosk')" style="background-image:url('<?php echo $a[pic]?>')"></span><?php }?>
<?php if ($member==1){?><div class="py-tag">会员</div><?php }?>
<div class="cnl-tag tag"><?php $sort=$a[sort]; if ($sort>0){echo "推荐";}else{echo $gxtime;}?></div>
</div>
<h4 class="ui-nowrap" style='font-size: 100%;font-weight: 400;text-align:center'><?php if($member==1 && $hyzt=="0"){?><a href="javascript:;"  onclick="pay()" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }elseif($member==0 || $hyzt==1){?><a href="javascript:;"  onclick="uboplay('<?php echo $a[id]?>','ubosk')" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }?></h4>
</li>
<?php 
$i++;  
};?>
</ul>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe><input name="page" type="hidden" id="page" value="<?php if ($page>1){echo $page;}else{echo "1";}?>" /></div>
</section>
<script type="text/javascript">
function uboplay(id,ly){
var page=document.getElementById('page').value;
window.<?php if($iseveryday<2){echo "msgubotj.";}?>location.href='vod_list.php?playid='+id+'&ly='+ly+'&page='+page+''; 
}
</script>
<?php if($hyzt==0){?>
<!-- 提示付费窗口 -->
<div id="paybox" class="ui-dialog">
<div class="ui-dialog-cnt">
<a class="ui-icon-close-page" data-role="button"></a>
<div class="info">
<h4>
<p class="ui-txt-red" style="margin:12px 0;">
您目前是普通会员无法观看VIP会员视频，请先升级VIP会员！
</p>
</p>
<div class="payBtn">
<a class="paybtn weixin" href="user/user_pay.php">升级VIP会员</a>
</div>
</div>
</div>
</div>
<?php }?>
<?php include_once('include/foot.php'); ?> 
<?php include_once('include/nav4.php'); ?> 
</body>
</html>

