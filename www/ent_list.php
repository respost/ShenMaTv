<?php
error_reporting(0); 
include("include/os.php");
include("config/common.php");
include("config/conn.php");
$pdid=$_GET["flid"];
$id=$_GET["id"];
$sort=$_GET["sort"];
$k=$_GET["k"];
$m=$_GET["m"];
$page=$_GET['page']; 
$play="entplay.php";
if (empty($page))
{
$page=1;
}
if (($pdid || $sort || $m || $k || $s) || (empty($pdid) && empty($sort) && empty($m) && empty($k) && empty($s)) && $page<2)
{
$isplay=$_COOKIE[play];
if ($isplay!==$play || $isplay==null)
{
if ($pdid){setcookie("c_flid",$pdid,time()+3600*24,"/");}else{setcookie("c_flid","0",time()-1,"/");}
if ($sort){setcookie("c_sort",$sort,time()+3600*24,"/");}else{setcookie("c_sort","0",time()-1,"/");}
if ($k){setcookie("c_k",$k,time()+3600*24,"/");}else{setcookie("c_k","0",time()-1,"/");}
if ($m){setcookie("c_m",$m,time()+3600*24,"/");}else{setcookie("c_m","0",time()-1,"/");}
if ($s){setcookie("c_s",$s,time()+3600*24,"/");}else{setcookie("c_s","0",time()-1,"/");}
setcookie("play",$play,time()+3600*24,"/");
}
else
{
setcookie("c_flid",$pdid,time()+3600*24,"/");
setcookie("c_sort",$sort,time()+3600*24,"/");
setcookie("c_k",$k,time()+3600*24,"/");
setcookie("c_m",$m,time()+3600*24,"/");
setcookie("c_s",$s,time()+3600*24,"/");
setcookie("play",$play,time()+3600*24,"/");
}
}
else
{
$pdid=$_COOKIE[c_flid];
$sort=$_COOKIE[c_sort];
$k=$_COOKIE[c_k];
$m=$_COOKIE[c_m];
$s=$_COOKIE[c_s];
}
include("include/limit_list.php");
if(empty($sort)){ 
$sort="default";
} 
if($pdid)
{
$query = mysql_query("SELECT * FROM se2dsjfl where id='$pdid'");
while($a = mysql_fetch_array($query)) { 
$column=$a[name];
$column=$column."视频动态";
 }}else{
	switch ($sort){
	case 'new':
 	$name= '最新动态';
  	break;
  	case 'price':
	$name= '动态排行';
	break;
	case 'heat':
	$name= '人气排行';
	break;
	case 'hot':
	$name= '点赞排行';
 	break;
	case 'default':
	$name= '视频动态';
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
<?php if ($pull==0){?>
<script type="text/javascript"> 
function page(p,pageCount)
{
var html="";
var ks=p;
if (p>49)
{ks=p-49;}
else
{ks=1;}
var zd=pageCount;
if (zd>ks+100)
{zd=ks+100;}

	for(var i=ks;i<=zd;i++)
	{
	if (p==i)
	{html +="<option value="+i+" selected>第"+i+"页</option>";}
	else
	{html +="<option value="+i+">第"+i+"页</option>";}
	}
	document.getElementById('gotoPage').innerHTML=html;
}
$(document).ready(function()
{	
	$('#gotoPage').change(function(){ 
	var p1=$(this).children('option:selected').val();
	window.location.href="?page="+p1;
	});
});
</SCRIPT>
<?php }?>
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
<form method="get" action="ent_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="请输入视频关键字" autocomplete="off" value="" name="k" id="k"/>
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

$Page_size=3; 
$total = mysql_query("SELECT COUNT(*) AS num FROM se2nr ".$sql." ");
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
<div class="liebiao"><div class="left"><i style="background:url(/img/xdt.png) 4px -1px no-repeat;background-size: 20px 20px; vertical-align: middle;"></i>共有<span><?php echo $count;?></span>条</div><div class="right"><a href="ent_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=new<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-

link"><span <?php if ($sort=='new'){echo 'class="cur"';}?>>最新</span></a><a href="ent_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=heat<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='heat'){echo 

'class="cur"';}?>>人气</span></a><a href="ent_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=hot<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='hot'){echo 'class="cur"';}?>>点赞</span></a><a 

href="ent_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=fav<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='fav'){echo 'class="cur"';}?>>收藏</span></a></div></div>
<section class="ui-panel">
<?php if ($count==0){echo "<h2 class=\"ui-arrowlink\"><span style=\"display:block; width:100%; line-height:80px;height:90px;text-align:center;\">暂无视频！</span></h2>";}?>
<ul class="ui-grid-trisect" id="vlist" style="padding-left: 0;">
<?php if ($count>3 && $pull==1){?>
<script>$(function (){
	var p = <?php if ($page>1){echo $page+1;}else{echo "2";}?>;
	var ajaxurl = "xml/ent_xml.php?flid=<?php echo $pdid;?>&sort=<?php echo $sort;?>&k=<?php echo $k;?>&m=<?php echo $m;?>";	
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
					   if(sqlJson[i]['k']>0){
						html+='<li v-for="item in data" style=\'width: 100%; BORDER-BOTTOM: #f2ede6 12px solid;padding-right:0px;padding-bottom:0\' id="'+sqlJson[i].id+'"><div class="dt_01"><div class="dt_02" onclick=\'location.href="/vod_list.php?uid='+sqlJson[i].uid+'"\'><div class="ui-avatar"><span style="background-image:url('+sqlJson[i].tx_url+')"></span></div></div><div class="dt_03"><span style="font-size:14px;font-weight:bold; color:#000;">'+sqlJson[i].name+'</span><span>'+sqlJson[i].sctime+'前</span></div><div class="dt_04"><div class="dt_gz" onclick="reward('+sqlJson[i].uid+','+sqlJson[i].division+');"><span id="reward_'+sqlJson[i].uid+'">'+sqlJson[i].money+'</span>元<i></i></div></div></div><div class="ui-grid-trisect-img" style=\'padding-top: 60%; width:96%; margin-left:2%; margin-right:2%;\' id="playerwrap_'+sqlJson[i].id+'"><span style="background-image:url(\''+sqlJson[i].pic_url+'\');background-repeat: no-repeat;background-position:center center;"></span><span class="vbg"></span><span onClick="vplay(\''+sqlJson[i].id+'\',\''+sqlJson[i].pic_url+'\',\''+sqlJson[i].title+'\',\''+sqlJson[i].status+'\')" class="vplay"></span><span class="vbt">'+sqlJson[i].title+'</span><span class="vtimebg"></span><span class="vtime">'+sqlJson[i].status+'</span></div><div class="zbdt_cz"><a title="喜欢" href="plus/entgive.php?id='+sqlJson[i].id+'&style=k" target="msgubotj"><span style="margin-left:0.3%;BORDER-left: #fff 1px solid;"><i class="xh"></i>喜欢 (<font id="hits_'+sqlJson[i].id+'">'+sqlJson[i].hits+'</font>)</span></a><span><i class="rq"></i>人气 ('+sqlJson[i].cishu+')</span><a title="收藏" href="plus/ent_favorite.php?id='+sqlJson[i].id+'&style=k" target="msgubotj"><span style="float:right;margin-right:0.2%;BORDER-right:#fff 1px solid;"><i class="sc"></i>收藏 (<font id="favorite_'+sqlJson[i].id+'">'+sqlJson[i].favorite+'</font>)</span></a></div></li>';
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
$query = mysql_query("select * from  se2nr  ".$sql." ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) { 
$time=time();
$dqtime=intval($time);
$sctime=$a[addtime];
$sctime=intval($sctime);
$sytime=$dqtime-$sctime;
$division=$a[division];
$renqi=$a[cishu];
if ($sytime>0)
{
if ($sytime<60){
     $sctime=floor($sytime)."秒";}
	 elseif ($sytime<3600){
     $sctime=floor($sytime/60)."分钟";}
     elseif ($sytime<86400){
     $sctime=floor($sytime/3600)."小时";}
     else{$sctime=floor($sytime/86400)."天";}
 }
 if ($renqi>9999)
{
$renqi = number_format($renqi/10000,1);
$renqi = round($renqi, 1)."万";
}
?>
<li v-for="item in data" style='width: 100%; BORDER-BOTTOM: #f2ede6 12px solid;padding-right:0px;padding-bottom:0' id="<?php $id=$a[id]; $id = ($id*512)+12865379; $id = base64_encode($id);echo $id;?>">
<div class="dt_01"><div class="dt_02" onclick='location.href="/vod_list.php?uid=<?php $uid=$a[uid]; echo $uid;?>"'><div class="ui-avatar"><span style="background-image:url(<?php $hysj=uname($uid,$division);$hysj = explode('|',$hysj); echo $hysj[0]?>)"></span></div></div><div class="dt_03"><span style="font-size:14px;font-weight:bold; color:#000;"><?php echo $hysj[1]?></span><span><?php echo $sctime;?>前</span></div><div class="dt_04"><div class="dt_gz"  onclick="reward(<?php echo $uid.",".$division?>);"><span id="reward_<?php echo $uid;?>"><?php echo $hysj[2];?></span>元<i></i></div></div></div>
<div class="ui-grid-trisect-img" style='padding-top: 60%; width:96%; margin-left:2%; margin-right:2%;' id="playerwrap_<?php echo $id;?>"><span style="background-image:url('<?php echo $a[pic]?>');background-repeat: no-repeat;background-position:center center;"></span><span class="vbg"></span><span onClick="vplay('<?php echo $id;?>','<?php echo $a[pic]?>','<?php echo $a[name]?>','<?php echo $a[shijian]?>')" class="vplay"></span><span class="vbt"><?php echo $a[name]?></span><span class="vtimebg"></span><span class="vtime"><?php echo $a[shijian]?></span></div>
<div class="zbdt_cz"><a title="喜欢" href="plus/entgive.php?id=<?php echo $id;?>&style=k" target="msgubotj"><span style="margin-left:0.3%;BORDER-left: #fff 1px solid;"><i class="xh"></i>喜欢 (<font id="hits_<?php echo $id?>"><?php echo $a[hits];?></font>)</span></a><span><i class="rq"></i>人气 (<?php echo $renqi;?>)</span><a title="收藏" href="plus/ent_favorite.php?id=<?php echo $id;?>&style=k" target="msgubotj"><span style=" float:right;margin-right:0.2%;BORDER-right: #fff 1px solid;"><i class="sc"></i>收藏 (<font id="favorite_<?php echo $id?>"><?php echo $a[favorite];?></font>)</span></a></div>
</li>
<?php 
$i++;  
};
if ($pull==0)
{
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
if($page!=1){ 
$key2.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\" >上一页</a> "; //上一页 
}else { 
$key2.="<a class=\"first\" >上一页</a> "; //上一页  
} 
if($pages>$page_len){ 
//如果当前页小于等于左偏移 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{//如果当前页大于左偏移 
//如果当前页码右偏移超出最大分页数 
if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
//左右偏移都存在时的计算 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
if($page!=$pages){ 

$key2.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\" >下一页</a> ";//下一页 
}else { 
$key2.=" <a  class=\"first\">下一页</a> ";//最后一页 
} 
$key2.='<span class="jump selectOption"><div>'.$page.' / '.$pages.'</div><select id="gotoPage" class="gotoPage" pageNo="'.$page.'" pageCount="'.$pages.'" ></select></span>';
$key2=str_replace("HTTP_REFERER","",$key2); 
};
?>
</ul>
<?php if ($count>3 && $pull==1){?>
<div class="loading" id="loading" style="display: block;"><span><img src="/img/m_loading.gif" width="16" height="16" align="absmiddle"> 正在加载中，请稍后...</span></div>
<?php }?>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe><input name="vtime" type="hidden" id="vtime" value="" /><input name="vtitle" type="hidden" id="vtitle" value="" /><input name="vtitle" type="hidden" id="vtitle" value="" /><input name="vimgs" type="hidden" id="vimgs" value="" /><input name="vid" type="hidden" id="vid" value="" /><input name="page" type="hidden" id="page" value="<?php if ($page>1){echo $page;}else{echo "1";}?>" /></div>
</section>
<?php if ($count>3 && $pull==0){?>
<div class="page" align="left" style="border: 0"> 
<?php echo $key2?>
</div>
<?php }?>
<script type="text/javascript">
$(document).ready(function()
{
    $(".ui-icon-close-page").click(function(){
    $('#paybox').removeClass("show");
	});

});
function guanbi(){
$('#paybox').removeClass("show");
}
function reward(id,division){
$("#paybox").addClass("show");
document.getElementById('scje').innerHTML = "<div class=\"payBtn\"><a class=\"paybtn weixin\" href=\"plus/ent_reward.php?id="+id+"&division="+division+"&style=1\" target=\"msgubotj\">1元</a></div><div class=\"payBtn\"><a class=\"paybtn weixin\" href=\"plus/ent_reward.php?id="+id+"&division="+division+"&style=2\" target=\"msgubotj\">5元</a></div><div class=\"payBtn\"><a class=\"paybtn weixin\" href=\"plus/ent_reward.php?id="+id+"&division="+division+"&style=3\" target=\"msgubotj\">10元</a></div>";
}
function vplay(id,imgs,title,time){
var vid = document.getElementById('vid').value;
var vimgs = document.getElementById('vimgs').value;
var vtitle = document.getElementById('vtitle').value;
var vtime = document.getElementById('vtime').value;
if (vid!=="")
{
document.getElementById('playerwrap_'+vid).innerHTML = "<span style=\"background-image:url('"+vimgs+"');background-repeat: no-repeat;background-position:center center;\"></span><span class=\"vbg\"></span><span onClick=\"vplay('"+vid+"','"+vimgs+"','"+vtitle+"','"+vtime+"')\" class=\"vplay\"></span><span class=\"vbt\">"+vtitle+"</span><span class=\"vtimebg\"></span><span class=\"vtime\">"+vtime+"</span>";
}
document.getElementById('playerwrap_'+id).innerHTML = '<iframe id="baiduSpFrame" name="baiduSpFrame" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" frameborder="0" scrolling="no" width="100%" height="100%" src="/ckplayer/v.php?id='+id+'" style="width:100%;height:100%;position: absolute;top: 0;left:0;"></iframe>';
document.getElementById('vid').value=id;
document.getElementById('vimgs').value=imgs;
document.getElementById('vtitle').value=title;
document.getElementById('vtime').value=time;
var ifr = document.getElementById("baiduSpFrame");
ifr.onload=function(){
ifr.contentWindow.cplay();
};
/*ifr.contentWindow.cplay();*/
/*parent.ifr.cplay();*/
return false;
}
<?php if ($pull==0){?>window.onload=page(<?php echo $page;?>,<?php echo $pages;?>);<?php }?>
function uboplay(id,ly){
var page=document.getElementById('page').value;
window.<?php if($iseveryday<2){echo "msgubotj.";}?>location.href='?playid='+id+'&ly='+ly+'&page='+page+''; 
}
</script>
<?php if(empty($s) && 1==2){?>
<div style="text-align:center; font-size:16px;" onClick="pay()">更多精华资源，仅限会员专享。。。</div>
<?php }?>
<!-- 提示付费窗口 -->
<div id="paybox" class="ui-dialog">
<div class="ui-dialog-cnt">
<a class="ui-icon-close-page" data-role="button"></a>
<div class="info">
<h4></h4>
<p class="ui-txt-red" style="margin:12px 0;">
如您喜欢本视频, 就打赏鼓励一下吧~！
</p>
</p>
<div id="scje"></div>
</div>
</div>
</div>
<?php include_once('include/foot.php'); ?> 
<?php include_once('include/nav3.php'); ?> 
</body>
</html>

