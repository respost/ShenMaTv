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
$s=$_GET["s"];
$page=$_GET['page'];
$remove=$_GET['remove'];
$style=intval($_GET['style']);
$uid=intval($_GET['uid']);
$userid=$_COOKIE[uid];
$spid=$_COOKIE[spid];
if ($userid && $uid>0){
$show=getone("select * from ubouser WHERE userid='$userid'");
$cuid=$show['id'];}
if($remove)
{
$remove=intval($remove);
$spid=$_COOKIE[spid];
$spid = str_replace(",","#",$spid);
$lid = "#".$remove;
$spid = str_replace($lid,"","#".$spid);
$spid = str_replace("##","","#".$spid);
$spid = str_replace("#",",",$spid);
setcookie("spid",$spid,time()+3600*24*365*3,"/");
echo msglayerurl("移除成功！",8,"follow_list.php");
exit;
}
$play="play.php";
if (empty($page))
{
$page=1;
}
if (($pdid || $sort || $m || $k || $s || $uid) || (empty($pdid) && empty($sort) && empty($m) && empty($k) && empty($s) && empty($uid)) && $page<2)
{
$isplay=$_COOKIE[play];
if ($isplay==$play || $isplay==null)
{
if ($pdid){setcookie("c_flid",$pdid,time()+3600*24,"/");}else{setcookie("c_flid","0",time()-1,"/");}
if ($uid){setcookie("c_uid",$uid,time()+3600*24,"/");}else{setcookie("c_uid","0",time()-1,"/");}
if ($sort){setcookie("c_sort",$sort,time()+3600*24,"/");}else{setcookie("c_sort","0",time()-1,"/");}
if ($k){setcookie("c_k",$k,time()+3600*24,"/");}else{setcookie("c_k","0",time()-1,"/");}
if ($m){setcookie("c_m",$m,time()+3600*24,"/");}else{setcookie("c_m","0",time()-1,"/");}
if ($s){setcookie("c_s",$s,time()+3600*24,"/");}else{setcookie("c_s","0",time()-1,"/");}
setcookie("play",$play,time()+3600*24,"/");
}
else
{
setcookie("c_flid",$pdid,time()+3600*24,"/");
setcookie("c_uid",$uid,time()+3600*24,"/");
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
$uid=$_COOKIE[c_uid];
$sort=$_COOKIE[c_sort];
$k=$_COOKIE[c_k];
$m=$_COOKIE[c_m];
$s=$_COOKIE[c_s];
}
include("include/limit_list.php");
if(empty($sort)){ 
$sort="new";
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
	$name= '全部视频';
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
<title>历史记录</title>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px"<?php if($m || $pdid || $k || $sort){ ?> class="h"<?php } ?>/></i></span><i class="ico21">历史记录</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('include/column.php'); ?> 
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="follow_list.php" data-ajax="false" id="search-form">
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
$userid=$_COOKIE[uid];
$type="where userid='$userid'";
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{$hyzt=0;}
$sql .=" and  member='1' ";
}else{
$userid=$_COOKIE[uid];
$type="where userid='$userid'";
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{$hyzt=0;}
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
if(empty($page)||$page<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 
$offset=$Page_size*($page-1); 
?>
<div class="liebiao"><div class="left"><i></i>共有<span><?php echo $count;?></span>个</div><div class="right"><a href="follow_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=new<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-

link"><span <?php if ($sort=='new'){echo 'class="cur"';}?>>最新</span></a><a href="follow_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=heat<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='heat'){echo 

'class="cur"';}?>>人气</span></a><a href="follow_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=hot<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='hot'){echo 'class="cur"';}?>>点赞</span></a><a 

href="follow_list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=fav<?php if ($s){echo '&s=vip';}?>" rel="external" class="ui-link"><span <?php if ($sort=='fav'){echo 'class="cur"';}?>>收藏</span></a></div></div>
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
<ul class="ui-grid-trisect" id="vlist">
<?php if ($count>10 && $pull==1){?>
<script>$(function (){
	var p = <?php if ($page>1){echo $page+1;}else{echo "2";}?>;
	var ajaxurl = "xml/follow_xml.php?flid=<?php echo $pdid;?>&sort=<?php echo $sort;?>&k=<?php echo $k;?>&m=<?php echo $m;?><?php if ($uid>0){echo "&uid=".$uid;}?><?php if ($s){echo '&s=vip';}?>";	
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
					   if(sqlJson[i]['member']==1){
						html+='<li v-for="item in data" style="width: 49.5%;"><div class="ui-grid-trisect-img" style="padding-top: 54.47%;"><span onclick="<?php if($hyzt=="1" || empty($s)){?>uboplay(\''+sqlJson[i].id+'\',\'ubosk\')<?php }else{?>pay()<?php }?>" style="background-image:url(\''+sqlJson[i].pic_url+'\');background-size:auto 122.36px;background-position:center center;"></span><div class="py-tag">会员</div><div class="cnl-tag tag">'+sqlJson[i].addtime+'</div></div><h4 class="ui-nowrap" style="font-size: 100%;font-weight: 400;text-align:center"><a href="javascript:;" onclick="<?php if($hyzt=="1" || empty($s)){?>uboplay(\''+sqlJson[i].id+'\',\'ubosk\')<?php }else{?>pay()<?php }?>" >'+sqlJson[i].title+'</a></h4></li>';
						}else{
						html+='<li v-for="item in data" style="width: 49.5%;"><div class="ui-grid-trisect-img" style="padding-top: 54.47%;"><span  onclick="<?php if($hyzt=="1" || empty($s)){?>uboplay(\''+sqlJson[i].id+'\',\'ubosk\')<?php }else{?>pay()<?php }?>" style="background-image:url(\''+sqlJson[i].pic_url+'\')"></span><div class="cnl-tag tag">'+sqlJson[i].addtime+'</div></div><h4 class="ui-nowrap" style="font-size: 100%;font-weight: 400;text-align:center"><a href="javascript:;" onclick="<?php if($hyzt=="1" || 

empty($s)){?>uboplay(\''+sqlJson[i].id+'\',\'ubosk\')<?php }else{?>pay()<?php }?>" >'+sqlJson[i].title+'</a></h4></li>';						
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
$gxtime=date('m-d',$a[addtime]);
?>
<li v-for="item in data" style='width: 49.5%;'>
<div class="ui-grid-trisect-img" style='padding-top: 54.47%;'><?php $member=$a[member]; if($member==1 && $hyzt=="0"){?><span onClick="pay()" style="background-image:url('<?php echo $a[pic]?>');background-size:auto 122.36px;background-position:center center;"></span><?php }elseif($member==0 || $hyzt==1){?>
<span onClick="uboplay('<?php $id=$a[id]; echo $id;?>','ubosk')" style="background-image:url('<?php echo $a[pic]?>');background-size:224.64px auto;background-position:center center;"></span><?php }?>
<?php if ($member==1){?><div class="py-tag">会员</div><?php }?>
<div class="cnl-tag tag"><?php $sort=$a[sort]; if ($sort>0){echo "推荐";}else{echo $gxtime;}?></div>
</div>
<h4 class="ui-nowrap" style='font-size: 100%;font-weight: 400;text-align:center'><?php if($member==1 && $hyzt=="0"){?><a href="javascript:;"  onclick="pay()" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }elseif($member==0 || $hyzt==1){?><a href="javascript:;"  onclick="uboplay('<?php echo $id;?>','ubosk')" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }?></h4>
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
} 
?>
</ul>
<?php if ($count>10 && $pull==1){?>
<div class="loading" id="loading" style="display: block;"><span><img src="/img/m_loading.gif" width="16" height="16" align="absmiddle"> 正在加载中，请稍后...</span></div>
<?php }?>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe><input name="page" type="hidden" id="page" value="<?php if ($page>1){echo $page;}else{echo "1";}?>" /></div>
</section>
<?php if ($count>10 && $pull==0){?>
<div class="page" align="left" style="border: 0"> 
<?php echo $key2?>
</div>
<?php }?>
<script type="text/javascript">
<?php if ($pull==0){?>window.onload=page(<?php echo $page;?>,<?php echo $pages;?>);<?php }?>
function uboplay(id,ly){
var page=document.getElementById('page').value;
window.<?php if($iseveryday<2){echo "msgubotj.";}?>location.href='?playid='+id+'&ly='+ly+'&page='+page+''; 
}
function remove(id){
if(confirm("单击“确定”移除。单击“取消”撤销。"))
{window.msgubotj.location.href='?remove='+id; }
}
</script>
<?php if(empty($s) && 1==2){?>
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
<?php include_once('include/nav5.php'); ?> 
</body>
</html>

