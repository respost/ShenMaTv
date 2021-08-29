<?php
error_reporting(0); 
include("include/os.php");
include("config/conn.php");
include("config/common.php");
include("include/limit_play.php");
$userid=$_COOKIE[uid];
$time=time();
$ip=$_SERVER["REMOTE_ADDR"];
if ($userid)
{
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$user=$neirong[user];
$avatar=$neirong[avatar];
$cuid=$neirong[id];
}
$sz="where id='1'";
$shezhi=queryall(se2wz,$sz);
$iseveryday=$shezhi[iseveryday];
$sk=$shezhi[sk];
$playid=$_GET["playid"];
$rfr=$_COOKIE[ulr];//来源（用于返回）;
$zt=$_GET[zt];
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{
$row=getone("select * from uboxfjl WHERE type=1 and userid='".$userid."' and zyid='".$playid."'");
if ($row)
{$hyzt=1;}else{$hyzt=0;}
}
$ly=$_GET["ly"];
if($ly=="ubosk" || $ly=="up" || empty($ly)){
$type="where id='$playid'";
$neirong=queryall(se2nr,$type);
$type="where id='1'";
$play=queryall(ubozf,$type);
$shijian=$play[sktime];
$renqi=$neirong[cishu];
$favorite = $neirong[favorite];
$uid = $neirong[uid];
$division = $neirong[division];
$member = $neirong[member];
if ($member==1){$s="vip";}
if ($renqi>9999)
{
$renqi = number_format($renqi/10000,1);
$renqi = round($renqi, 1)."万";
}
$cishu=$neirong[cishu]+1;
$fenlei=$neirong[fenlei];
$contents = $neirong[contents];
$censor = $neirong[censor];
//播放链接
$url = $neirong[url];
$type="cishu='$cishu' where id='$playid'";
upalldt(se2nr,$type);
}elseif($ly=="down"){
$type="where id='$playid'";
$neirong=queryall(se2nr,$type);
$type="where id='1'";
$play=queryall(ubozf,$type);
$shijian=$play[sktime];
$renqi=$neirong[cishu];
$favorite = $neirong[favorite];
$uid = $neirong[uid];
$division = $neirong[division];
$member = $neirong[member];
$censor = $neirong[censor];
if ($member==1){$s="vip";}
if ($renqi>9999)
{
$renqi = number_format($renqi/10000,1);
$renqi = round($renqi, 1)."万";
}
$playid=$neirong[id];
$fenlei=$neirong[fenlei];
$cishu=$neirong[cishu]+1;
$contents = $neirong[contents];
//播放链接
$url = $neirong[url];
$type="cishu='$cishu' where id='$playid'";
upalldt(se2nr,$type);
} 
//标题
$name=$neirong[name];
$name=str_replace("?","",$name); 
$val1 = getone("select id from se2nr WHERE id>".$playid." ORDER BY id asc LIMIT 1");
$val1 = $val1[id];
$val2 = getone("select id from se2nr WHERE id<".$playid." ORDER BY id desc LIMIT 1");
$val2 = $val2[id];
if($playid== null){ 
echo "<script>alert('抱歉，你访问的资源已经删除！');location.href='/';</script>";
exit;
}
if($censor>0 && empty($zt)){ 
echo "<script>alert('视频审核中！');location.href='/user/user_video_list.php';</script>";
exit;
}
if($member=="1" && $hyzt=="0")
{
echo "<script>alert('VIP会员视频，请升级会员！');location.href='/user/user_pay.php';</script>";
exit;
}
$i=rand(1,14);
//判断是不是伪静态
if ($apache==1){
	$kz="html"; 
	$link="/play/";
}else{
	$kz="php"; 
	$link="/play.php";
}
function uname($id,$lx)
{
    $lx=intval($lx);
	if ($lx==1)
	{
	$fname=getone("select * from ubozb WHERE id=".$id);
	$name=$fname['name'];
    $return="/".$fname['pic']."|".$name."|".intval($fname['money'])."|".$fname['concern']."|".$fname['trends'];
	}else{
    $fname=getone("select * from ubouser WHERE id=".$id);
	$name=$fname['name'];
	if (empty($name))
	{$name=$fname['user'];}
    $return="/img/pl/".$fname['avatar'].".jpg|".$name."|".intval($fname['money'])."|".$fname['concern']."|".$fname['trends'];
	}
	return $return;
}
function gzzt($id,$uid)
{
	$fname=getone("select * from se2sc WHERE uid=".$uid." and zbid=".$id);
	if ($fname)
	{
    $return="√ 已关注";
	}else{
    $return="+ 关注";
	}
	return $return;
}
$hysj=uname($uid,$division);
$hysj=explode('|',$hysj);
$ncname=$hysj[1];
$concern=$hysj[3];
$trends=$hysj[4];
$money=round($hysj[2],2);
$avatar=$hysj[0];
$guanzhu=gzzt($uid,$cuid);
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $name;?></title>
<?php include_once('include/meta.php');?>
<?php include_once('include/css.php'); ?> 
<SCRIPT language=javascript src="/js/jquery.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script type="text/javascript" src="/js/manhuaHtmlArea.1.0.js"></script>
<link href="/css/manhuaHtmlArea.1.0.css" rel="stylesheet" type="text/css" />
<link href="/tcplayer/tcplayer.css" rel="stylesheet">
<script language="JavaScript" type="text/JavaScript"> 
$(function (){
	$("#bq").manhuaHtmlArea({
		Event : "click",
		Left : -38,
		Top : -312,			
		id : "content"
	});
});
$(document).ready(function()
{

    $("#tvlists a").click(function()
    {
        $("#tvlists a").removeClass("select");
        $(this).addClass("select");

    }); 
    $("#change ul li a").click(function(){
        if ($(this).parent().hasClass('tabactive')) {
            return false;
        } else {
            $(this).parent().addClass('tabactive').siblings().removeClass('tabactive');
            if ($(this).attr('class') == 'tab1') {
                $('#juji').show();
				$('#xiaxia').hide();
                $('#juqing').hide();
                $('#dashang').hide();
            }else if ($(this).attr('class') == 'tab2') {
                $('#juji').hide();
				$('#xiaxia').show();
                $('#juqing').hide();
                $('#dashang').hide();
            }else if ($(this).attr('class') == 'tab4') {
                $('#juji').hide();
				$('#xiaxia').hide();
                $('#juqing').hide();
                $('#dashang').show();
            }else {
				$('#juji').hide();
				$('#xiaxia').hide();
                $('#juqing').show();
                $('#dashang').hide();
            }
        }
    }); 
});
function jsname(dd)
{
document.getElementById('jishu').innerHTML='（'+dd+'）';
}
</script>
</head>
<body id="play">
<header id="header" class="ui-header ui-header-positive ui-border-b"><i class="ui-icon-return" id="return"    onclick='location.href="<?php echo $rfr;?>"'></i>
<h1 class="ui-nowrap ui-whitespace"><?php echo $name;?></h1>
<div class="soc" ><a title="收藏" href="plus/vod_favorite.php?id=<?php echo $playid;?>&style=k" style="color:#fff;" rel="external" target="msgubotj"><span class="left">收藏</span><span class="right" id="favorite"><?php echo $favorite;?></span></a></div>
</header>
<div class="container">
<div id="playerwrap" style="width: 100%; height: 214.669px;">
	<div id="player" style="width:100%;height:100%;"></div>
	<video width="100%" height="100%" src="" controls="controls" autoplay="true" id="mp4" preload='no' style="display: none;">
	<source src="movie.mp4" type="video/mp4">
	<source src="movie.ogg" type="video/ogg">
		您的浏览器不支持视频播放。
	</video>
</div>
<script src="/tcplayer/TcPlayer-2.2.2.js" charset="utf-8"></script>
<script type="text/javascript">
			$(function(){
				var url="<?php echo $url;?>";
				if(url.indexOf("m3u8") != -1){
					//1.m3u8视频
					$("#mp4").hide();
					$("#player").show();
					//先移除节点
					//$("#player").remove();
					//添加节点
					//$("#playerwrap").append("<div id='player' style='width:100%;height:100%;'></div>");	
					var player = new TcPlayer('player', {
						"m3u8": url,
						"autoplay" : true,   
						"width" :  '100%',
						"height" : '100%'})
				}else{
					//2.mp4视频
					$("#player").hide();
					$("#mp4").show();
					$("#mp4").attr("src",url);//更新url				
				}
			});
</script>
<?php if ($uid>0){?>
<div id="playTip4">
<div class="ui-avatar"><span style="background-image:url(<?php echo $avatar;?>)" onclick='location.href="/vod_list.php?uid=<?php echo $uid;?>"'></span></div>
<div class="login_t">
<h3><span style="color:#000">昵称：</span><?php echo $ncname;?> <a href="/plus/concern_favorite.php?id=<?php echo $uid;?>&division=<?php echo $division;?>&style=1" rel="external" target="msgubotj"><span id="gzzt_<?php echo $uid;?>"><?php echo $guanzhu;?></span></a></h3>
<span class="login_lj" style="font-size:14px;">关注：<font color="red" size="3" id="concern_<?php echo $uid;?>"><?php echo $concern;?></font> 人 视频：<font color="red" size="3" onclick='location.href="/vod_list.php?uid=<?php echo $uid;?>"'><?php echo $trends;?></font> 个</span></div>
</div>
<?php }?>
<div id="playTip2">
<div class="ck1">
<a title="喜欢" href="plus/give.php?id=<?php echo $playid;?>&style=k" style="color:#fff;" rel="external" target="msgubotj">喜欢(<span id="hits"><?php echo $neirong[hits];?></span>)</a></div>
<div class="ck1">
<a href="javascript:;" style="color:#fff;">人气(<font id="shits"><?php echo $renqi;?></font>)</a></div>
<div class="ck1">
<a href="<?php if ($val2){?><?php echo $link;?>
<?php 
if($apache==1){
	echo $val2.".html?ly=up&count=yes";
}else{
	echo "?playid=".$val2."&ly=up&count=yes";
}
?>
<?php }else{?>javascript:alert('已是最上一集！');<?php }?>" rel="external" style="color:#fff;">上一集</a></div>
<div class="ck2">
<a href="<?php if ($val1){?><?php echo $link;?>
<?php 
if($apache==1){
	echo $val2.".html?ly=down&count=yes";
}else{
	echo "?playid=".$val2."&ly=down&count=yes";
}
?>
<?php }else{?>javascript:alert('已是最后一集！');<?php }?>" rel="external"  style="color:#fff;">下一集</a></div>
</div> 
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<div id="hotVideo">
<!--广告开始-->
<?php 
$query = mysql_query("select id from uboad where fenlei=3 ");
while ($a=mysql_fetch_array($query)) { 
echo '<script language="javascript" src="/plus/api.php?id='.$a[id].'"></script>';
}
?> 
<!--广告结束-->
<h2><span onclick='location.href="/vod_list.<?php echo $kz;?>?flid=<?php echo $fenlei;?>"'>更多</span>猜你喜欢</h2>
<ul class="ui-grid-trisect">
<?php
$query = mysql_query("SELECT * FROM se2nr where fenlei='$fenlei' order by rand()  limit 4");
while($a = mysql_fetch_array($query)) {
$gxtime=date('m-d',$a[addtime]);
?>  
<li v-for="item in data" style='width: 49.5%;'>
<div class="ui-grid-trisect-img" style='padding-top: 54.47%;'><?php $member=$a[member]; if($member=="1" && $hyzt=="0"){?><span onClick="pay()" style="background-image:url('<?php echo $a[pic]?>')"></span><?php }elseif($member=="0" || $hyzt==1){?>
<span onClick="uboplay('<?php echo $a[id]?>','ubosk')" style="background-image:url('<?php echo $a[pic]?>')"></span><?php }?>
<?php if ($member==1){?><div class="py-tag">会员</div><?php }?>
<div class="cnl-tag tag"><?php echo $gxtime;?></div>
</div>
<h4 class="ui-nowrap" style='font-size: 100%;font-weight: 400;text-align:center'><?php if($member=="1" && $hyzt=="0"){?><a href="javascript:;"  onclick="pay()" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }elseif($member=="0" || $hyzt==1){?><a href="javascript:;"  onclick="uboplay('<?php echo $a[id]?>','ubosk')" /><?php $name=$a[name];$name=str_replace("?","",$name); echo $name;?></a><?php }?></h4>
</li> 
<?php }?>
</ul>
</div>
<div id="commentList">
<h2><span><i></i>
<a onclick='location.href="/user/user_pay.php"'>加入会员</a>
</span>网友热评</h2>
<?php
$query = mysql_query("SELECT * FROM  ubopl where nrid='$playid' or nrid=0 order by rand() limit 10");
while($a = mysql_fetch_array($query)) {
$time=time();
$dqtime=intval($time);
$sctime=$a[addtime];
$sctime=intval($sctime);
$sytime=$dqtime-$sctime;
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
$shijian=$a[shijian];
?> 
<div class="comment" >
<div class="avatar"><img src="<?php echo $a[pic];?>"></div>
<div class="commentCnt">
<div class="username"><?php echo $a[name];?></div>
<div class="usermsg"><?php echo $a[neirong];?></div>
<div class="metainfo"><span>热评</span><?php if ($shijian==0){echo $sctime."前";}else{echo $shijian;}?></div>
</div>
</div>
<?php }?>  
</div>
<?php if($avatar){?>
<div id="comment"><form name="comment" method="post" action="/plus/comment.php" target="msgubotj"><div class="ui-left"><span><img src="/images/smail.png" id="bq" alt="选择表情" class="bq" /></span><span>表情</span></div><div class="plnr"><div class="left">
  <textarea name="content" rows="3" class="content" id="content"></textarea>
  <input type="hidden" name="id" value="<?php echo $playid;?>">
  <input name="type" type="hidden" value="1">
</div><div class="right"><button type="submit" style="height:50px;" class="oy-btn oy-btn-lg">发表评论</button>
</div></div></form></div><?php }?>
</div>
<script type="text/javascript">
$(document).ready(function()
{
	var commentList=document.getElementById('commentList').innerHTML;
	$("#commentList").replaceContent(commentList);
});
function uboplay(id,ly){
	<?php 
	//伪静态
	if($apache==1){
		echo "window.location.href='/play/'+id+'.html?count=yes' ";
	}else{
		echo "window.location.href='/play.php?playid='+id+'&count=yes'";
	}
	?>	
}
</script>
<?php include_once('include/nav1.php'); ?> 
<?php if($hyzt==0){?>
<!-- 提示付费窗口 -->
<div id="paybox" class="ui-dialog">
<div class="ui-dialog-cnt">
<a class="ui-icon-close-page" data-role="button"></a>
<div class="info">
<h4>
<p class="ui-txt-red" style="margin:12px 0;">
您目前是普通会员仅能试看<?php echo $sk;?>分钟，升级VIP会员无限制哦！
</p>
</p>
<!--<div class="payBtn">
<a class="paybtn weixin" href="plus/gm.php?id=<?php echo $playid;?>&type=1" target="msgubotj">单独购买，支付1元</a>
</div>-->
<div class="payBtn">
<a class="paybtn weixin" href="user/user_pay.php">升级VIP会员</a>
</div>
</div>
</div>
</div>
<?php }?>
<?php include_once('include/foot.php'); ?> 
</body>
</html>