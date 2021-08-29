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
$column=$column."频道";
 }}else{
	switch ($sort){
	case 'new':
 	$name= '最新房间';
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
	$name= '直播房间';
	break;
	}
if ($k)
{
$column="房间搜索";
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
<form method="get" action="perform_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<?php if ($s){?><input name="s" type="hidden" value="vip"><?php }?><input x-webkit-speech type="text"  placeholder="请输入房间名称" autocomplete="off" value="" name="k" id="k"/>
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
$type="where userid='$userid'";
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{$hyzt=0;}
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
if(empty($_GET['page'])||$_GET['page']<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 
$offset=$Page_size*($page-1); 
?>
<div class="liebiao"><div class="left"><i style="background:url(/img/home.png) 4px -3px no-repeat;background-size: 20px 20px; vertical-align: middle;"></i>共有<span><?php echo $count;?></span>个房间</div><div class="right"><a href="?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=new<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='new'){echo 'class="cur"';}?>>最新</span></a><a href="?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=heat<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='heat'){echo 'class="cur"';}?>>人气</span></a><a href="?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=hot<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='hot'){echo 'class="cur"';}?>>点赞</span></a><a href="?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=fav<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='fav'){echo 'class="cur"';}?>>收藏</span></a></div></div>
<section class="ui-panel">
<h2 class="ui-arrowlink"></h2>
<ul class="ui-grid-trisect" id="vlist" style="padding-right:10px;">
<?php if ($count>8){?>
<script>$(function (){
	var p = <?php if ($page>1){echo $page+1;}else{echo "2";}?>;
	var ajaxurl = "xml/perform_xml.php?flid=<?php echo $pdid;?>&sort=<?php echo $sort;?>&k=<?php echo $k;?>&m=<?php echo $m;?><?php if ($s){echo '&s=vip';}?>";	
	var maxpage = "<?php echo $max_p;?>";
	var btop = $(".loading").offset().top;  
	var loading = $("#loading").data("on", false);
	$(window).scroll(function(){
	document.getElementById("loading").style.display = "block";
	if(loading.data("on")) return;	
		if($(window).scrollTop()+$(window).height()>=$(document).height()-555){	
		    loading.data("on", true).fadeIn();
		    $.getJSON(ajaxurl,{p:p},function(renul){   
			var sqlJson = eval(renul.data);
			(function(sqlJson){
			if(p>maxpage){
					$("#loading").show();					
					$(".loading").appendTo("<span>加载完成</span>");
				}else{
				    var html="";
                                                                                document.getElementById('page').value = p-1;				
					for(var i in sqlJson){	
					   if(sqlJson[i]['state']==1){
					    html+='<li v-for="item in data" style="width: 49.5%;"><a title="直播" href="xcplay.php?playid='+sqlJson[i].id+'" ><div class="ui-grid-trisect-img" style="padding-top: 62%;"><span style="background-image:url(\''+sqlJson[i].pic_url+'\')"></span><div class="mbt"><i class="zb"></i>'+sqlJson[i].reveal+'</div><div class="mbg"></div><div class="cnl-tag root">'+sqlJson[i].room+''+sqlJson[i].enroll+'人</div><div class="cnl-tag price">'+sqlJson[i].price+'元</div><div class="cnl-tag bg"></div></div><h4 class="ui-nowrap" style="font-size: 100%;font-weight: 400;text-align:center">'+sqlJson[i].title+'/'+sqlJson[i].diqu+'</h4></a></li>';
						}else{
					    html+='<li v-for="item in data" style="width: 49.5%;"><a title="直播" href="xcplay.php?playid='+sqlJson[i].id+'" ><div class="ui-grid-trisect-img" style="padding-top: 62%;"><span style="background-image:url(\''+sqlJson[i].pic_url+'\')"></span><div class="mbt">'+sqlJson[i].reveal+'</div><div class="mbg"></div><div class="cnl-tag root">'+sqlJson[i].room+''+sqlJson[i].enroll+'人</div><div class="cnl-tag price">'+sqlJson[i].price+'元</div><div class="cnl-tag bg"></div></div><h4 class="ui-nowrap" style="font-size: 100%;font-weight: 400;text-align:center">'+sqlJson[i].title+'/'+sqlJson[i].diqu+'</h4></a></li>';			
						}
						
					}
					
					$('#vlist').append(html);
					document.getElementById("loading").style.display = "none";
					loading.data("on",false).fadeIn(500);
				}
				p++;
			})(sqlJson);			
			loading.fadeOut();
			
			});
		}
	});
		
}); 

</script>
<?php }?>
<?php 
$query = mysql_query("select p.*,i.state,i.type,i.uid from  ubozb  AS p LEFT JOIN  uboxfjl  AS i  ON  p.id=i.zyid AND i.type='8' AND  i.uid=$uid ".$sql." ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) { 
$gxtime=date('m-d',$a[addtime]);
$state=$a[state];
$xcstate=$a[xcstate];
if ($state=="")
{
$state=1;
}
?>
<li v-for="item in data" style='width: 49.5%;'>
<a title="直播" href="xcplay.php?playid=<?php echo $a[id];?>" >
<div class="ui-grid-trisect-img" style='padding-top: 62%;'><span style="background-image:url('<?php echo $a[pic]?>')"></span>
<div class="mbt"><?php if ($xcstate==1){if ($state==0){ echo "已结束"; }else{ echo "<i class=\"zb\"></i>直播"; }}else{ $ptime=$a['addtime'];$ptime=date('H:i',$ptime);$tdate=date("Y-m-d")." ".$ptime.":01";$dtae=intval(strtotime($tdate));$nexttime=date("Y-m-d")." ".date('H:i:s',strtotime("60 minute",$dtae));$time=time();$dtae1=strtotime($tdate);$dtae2=strtotime($nexttime); if ($xcstate==2){if ($state==0){ echo "已结束"; }else{if($time>$dtae1 && $dtae2>$time){echo "直播中";}else{if ($dtae2<$time){echo "已结束";}else{echo  "<i></i>".date('H:i',$a[addtime]);}}}}else{echo "人满开播";}}?></div>
<div class="mbg"></div>
<div class="cnl-tag root"><?php $room=$a[room]; echo $room;?><?php $enroll=$a[enroll]; echo $enroll;?>人</div>
<div class="cnl-tag price"><?php $price=$a[price]; echo $price;?>元</div>
<div class="cnl-tag bg"></div>
</div>
<h4 class="ui-nowrap" style='font-size: 100%;font-weight: 400;text-align:center'><?php echo $a[name]?>/<?php $diqu=$a[diqu]; echo $diqu;?></h4></a>
</li>
<?php 
$i++;  
};?>
</ul>
<?php if ($count>8){?>
<div class="loading" id="loading" style="display: block;"><span><img src="/img/m_loading.gif" width="16" height="16" align="absmiddle"> 正在加载中，请稍后...</span></div>
<?php }?>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe><input name="page" type="hidden" id="page" value="<?php if ($page>1){echo $page;}else{echo "1";}?>" /></div>
</section>
<script type="text/javascript">
function uboplay(id,ly){
var page=document.getElementById('page').value;
window.msgubotj.location.href='?playid='+id+'&ly='+ly+'&page='+page+''; 
}
</script>
<?php if(empty($s)){?>
<div style="text-align:center; font-size:16px;" onClick="pay()">更多精华资源，仅限会员专享。。。</div>
<?php }?>
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
<?php include_once('include/nav1.php'); ?> 
</body>
</html>

