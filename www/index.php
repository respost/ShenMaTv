<?php
error_reporting(0);
$installfile='config/ubo.php.loc';
if(file_exists($installfile)){
include("config/conn.php");
include("config/common.php");
$type="where id='1'";
$wangzhan=queryall(se2wz,$type);
$title=$wangzhan[title];
$keywords=$wangzhan[keywords];
$description=$wangzhan[description];
$lujing=$wangzhan[lujing];
$wap=$wangzhan[wap];
$automatic=$wangzhan[automatic];
$iseveryday=$wangzhan[iseveryday];
$apache=$wangzhan[apache];
$pull=$wangzhan[pull];
$isgive=$wangzhan[isgive];
$givetime=$wangzhan[givetime];
$givevips=$wangzhan[givevip];
}else{ 
echo "<script>location.href='install/'</script>";
exit;
}
?>
<?php 
if ($automatic==1)
{include_once('include/automatic.php');} ?> 
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title><?php echo $title ?> - 最出色的手机电影网站</title>
<meta name="keywords" content="<?php echo $keywords ?>">
<meta name="description" content="<?php echo $description ?>">
<?php include_once('include/meta.php');?>
<?php include_once('include/css.php'); ?> 
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<!--<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h"/></i></span>-->
<i class="ico21"><?php echo $title ?></i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('include/column.php'); ?> 
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="请输入视频名称" autocomplete="off" value="" name="k" id="k"/>
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
<section class="ui-slider" style="padding-top:41.75%">
<ul class="ui-slider-content" style="width:400%">
<!--优播幻灯调用-->
<?php
$query = mysql_query("SELECT * FROM se2hd  order by id  limit 8 ");
while($a = mysql_fetch_array($query)) {
?>
<li><span onClick="<?php $url=$a[url]; $pu=substr_count($url,'?'); if($pu==1){?>location.href='<?php echo $a[url]?>'<?php }else{?>uboplay('<?php echo $a[url]?>','ubosk')<?php }?>"  style="background-image:url(<?php echo $a[mpic];?>)"><em></em></span></li>
<?php
$i++; 
}?>
</ul>
</section>
<?php
$total=mysql_query("SELECT COUNT(*) AS num FROM se2nr");
$row=mysql_fetch_array($total);
$sptj=$row[0];
$zgtj=$sptj;
?> 
<div class="sort"><div class="left"><i></i>视频<span><?php echo $zgtj;?></span>部</div><div class="right"><a href="vod_list.<?php echo $kz;?>?m=new&sort=heat">今日热门</a><a href="ent_list.<?php echo $kz;?>?m=new">今日动态</a><a href="vod_list.<?php echo $kz;?>?m=new">今日视频</a><span></span></div></div>
<div class="xulie"><div class="left"><i></i>最新视频</div><div class="right"><a href="vod_list.<?php echo $kz;?>?sort=new" rel="external" class="ui-link"><span>最新</span></a><a href="vod_list.<?php echo $kz;?>?sort=heat" rel="external" class="ui-link"><span>人气</span></a><a href="vod_list.<?php echo $kz;?>?sort=hot" rel="external" class="ui-link"><span>点赞</span></a><a href="vod_list.<?php echo $kz;?>?sort=fav" rel="external" class="ui-link"><span>收藏</span></a></div></div>
<!--广告开始-->
<?php 
$query = mysql_query("select id from uboad where fenlei=1 ");
while ($a=mysql_fetch_array($query)) { 
echo '<script language="javascript" src="/plus/api.php?id='.$a[id].'"></script>';
}
?> 
<!--广告结束-->
<section class="ui-panel">
<h2 class="ui-arrowlink"></h2>
<?php 
$pdid=$_GET["flid"];
$id=$_GET["id"];
$sort=$_GET["sort"];
$k=$_GET["k"];
$m=$_GET["m"];
if(empty($sort)){ 
$sort="new";
} 
$sql = "WHERE censor=0";
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
 	$order.= ', addtime DESC';
  	break;
  	case 'price':
	$order.= ', price ASC';
	break;
	case 'heat':
	$order.= ', cishu ASC';
	break;
	case 'hot':
	$order.= ', hits DESC';
 	break;
	case 'default':
	$order.= ', id DESC';
	break;
}
if ($s=="vip")
{
$sql .=" and member='1' ";
}else{
$sql .=" and member='0' ";
}
$Page_size=10; 
$result=mysql_query("SELECT * FROM  se2nr  ".$sql." "); 
$count = mysql_num_rows($result); 
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
<ul class="ui-grid-trisect" id="vlist">
<script>$(function (){
	var p = <?php if ($page>1){echo $page+1;}else{echo "2";}?>;
	var ajaxurl = "xml/xml.php?flid=<?php echo $pdid;?><?php if ($s){echo '&s=vip';}?>";	
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
						var title=sqlJson[i].title;
						if(!title){
							title="加载中";							
						}
					   if(sqlJson[i]['member']==1){
						html+='<li v-for="item in data" style="width: 49.5%;"><div class="ui-grid-trisect-img" style="padding-top: 54.47%;"><span  onclick="uboplay(\''+sqlJson[i].id+'\',\'ubosk\')" style="background-image:url(\''+sqlJson[i].pic_url+'\')"></span><div class="py-tag">会员</div><div class="cnl-tag tag">'+sqlJson[i].addtime+'</div></div><h4 class="ui-nowrap" style="font-size: 100%;font-weight: 400;text-align:center"><a href="javascript:;" onclick="uboplay(\''+sqlJson[i].id+'\',\'ubosk\')" >'+title+'</a></h4></li>';
						}else{
						html+='<li v-for="item in data" style="width: 49.5%;"><div class="ui-grid-trisect-img" style="padding-top: 54.47%;"><span  onclick="uboplay(\''+sqlJson[i].id+'\',\'ubosk\')" style="background-image:url(\''+sqlJson[i].pic_url+'\')"></span><div class="cnl-tag tag">'+sqlJson[i].addtime+'</div></div><h4 class="ui-nowrap" style="font-size: 100%;font-weight: 400;text-align:center"><a href="javascript:;" onclick="uboplay(\''+sqlJson[i].id+'\',\'ubosk\')" >'+title+'</a></h4></li>';						
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
<?php 
$query = mysql_query("select * from  se2nr  ".$sql." ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) {
$gxtime=date('m-d',$a[addtime]);
?>
<li v-for="item in data" style='width: 49.5%;'>
<div class="ui-grid-trisect-img" style='padding-top: 54.47%;'><?php $member=$a[member]; if($member=="1" && $hyzt=="0"){?><span onClick="pay()" style="background-image:url('<?php echo $a[pic]?>')"></span><?php }elseif($member=="0" || $hyzt==1){?>
<span onClick="uboplay('<?php echo $a[id]?>','ubosk')" style="background-image:url('<?php echo $a[pic]?>')"></span><?php }?>
<?php if ($member==1){?><div class="py-tag">会员</div><?php }?>
<div class="cnl-tag tag"><?php $sort=$a[sort]; if ($sort>0){echo "推荐";}else{echo $gxtime;}?></div>
</div>
<h4 class="ui-nowrap" style='font-size: 100%;font-weight: 400;text-align:center'><?php if($member=="1" && $hyzt=="0"){?><a href="javascript:;"  onclick="pay()" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }elseif($member=="0" || $hyzt==1){?><a href="javascript:;"  onclick="uboplay('<?php echo $a[id]?>','ubosk')" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }?></h4>
</li>
<?php 
$i++;  
};?>
</ul>
<div class="loading" id="loading" style="display: block;"><span><img src="/img/m_loading.gif" width="16" height="16" align="absmiddle"> 正在加载中，请稍后...</span></div>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe><input name="page" type="hidden" id="page" value="<?php if ($page>1){echo $page;}else{echo "1";}?>" /></div>
</section>
<script type="text/javascript">
function vplay(id){
document.getElementById('playerwrap').innerHTML = '<iframe id="baiduSpFrame" name="baiduSpFrame" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0"  frameborder="0" scrolling="no" width="100%" height="100%" src="/ckplayer/v1.php?id='+id+'"></iframe>';
}
function uboplay(id,ly){
var page=document.getElementById('page').value;
window.<?php if($iseveryday<2){echo "msgubotj.";}?>location.href='vod_list.php?playid='+id+'&ly='+ly+'&page='+page+''; 
}
</script>
<?php if(empty($s)){?>
<div style="text-align:center; font-size:16px;" onClick="pay()">更多精华资源，仅限会员专享。。。</div>
<?php }?>

<?php include_once('include/foot.php'); ?> 
<?php include_once('include/nav1.php'); ?> 

</body>
</html>