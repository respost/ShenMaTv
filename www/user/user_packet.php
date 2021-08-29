<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$userid=$_COOKIE[uid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$id=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-抢红包</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<?php include_once('../include/css.php'); ?> 
<style>
.open_vip{
background-color: lightcyan;;
}
.ui-border li i em{
font-size: 0.75rem;
}
.aboutpic li{
margin-top: 0.6rem
}
.aboutpic li i img{
width: 2.5rem;
height: 2.5rem;
}
</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">抢红包</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('../include/column.php'); ?>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="/vod_list.php" data-ajax="false" id="search-form">
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
<?php include_once('../include/nav_s.php'); ?>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1><?php if($user[ms]=="黄金会员"){?>黄金会员<?php }elseif($user[ms]=="永久会员"){?>钻石会员<?php }?></h1>
</header>
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_packet_send.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">发红包</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_packet.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">抢红包</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_packet_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">红包记录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<?php 
$order = 'order by id desc ';
$Page_size=10; 
$result=mysql_query("SELECT * FROM  ubopacket"); 
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
<section class="bao" style="margin-top: 2.2%;"> 
<table width="100%" border="0" style="font-size:14px;">
<tr><td height="5" colspan="2" align="center"></td></tr>
<?php 
$query = mysql_query("select * from  ubopacket ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) { 
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
$number=$a[number];
$id=$a[id];
$name=$a[name];
$thname=$a[thname];
$surplus=$a[surplus];
$balance=round($a[balance], 2); 
$money=$a[money];
$avatar=$a[avatar];
$bl=round(($surplus/$number)*100);
?> 
<tr class="packet" onclick='<?php if($surplus>0){?>msgubotj.location.href="qhb.php?id=<?php echo $id;?><?php }else{?>location.href="user_packet_notes.php?id=<?php echo $id;?><?php }?>"'>
  <td width="20%" align="center"><span class="hongbao" ><i class="je"><?php echo $money;?>元</i></span></td>
  <td height="35" align="center" style="padding-right:5px;"><div class="fbr"><span class="left"><div class="avatar"><img src="/img/pl/<?php echo $avatar;?>.jpg"></div></span><span class="right"><?php echo $thname;?></span><span class="time"><i></i><?php echo $sctime;?>前</span></div><div class="ly"><span class="left"><?php echo $name;?></span></div><div class="sy"><div class="p"><div class="p_1">剩余</div><div class="p_2"><span style="width:<?php echo $bl;?>%"></span></div><div class="p_3"><?php if($surplus>0){?><?php echo $balance;?>元<?php }else{?>已抢完<?php }?></div></div></div>    </td>
  </tr>
<tr><td height="12" colspan="2" align="center"></td></tr>
<?php 
$i++;  
};
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">首页</a> "; //首页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">< 上一页</a>"; //上一页 
}else { 
$key.="<a>首页</a> "; //首页 
$key.="<a >< 上一页</a>"; //上一页  
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

$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页 ></a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">末页</a>"; //最后一页 
}else { 
$key.=" <a >下一页 ></a> ";//下一页 
$key.="<a>末页</a>"; //最后一页 
} 
$key=str_replace("HTTP_REFERER","",$key); 
?>
</table>
</section>
<div class="page" align="center"> 
<?php echo $key?>
</div>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
