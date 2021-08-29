<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$id=rand(1000,90000);
$cishu=rand(1,10000);
$rfr = $_SERVER['HTTP_REFERER'];//来源;
$userid=$_COOKIE[uid];
$time=time();
//月度会员
$hycs="where id='1'";
$hy=queryall(ubozf,$hycs);
$money1=$hy[money1];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$jilu=getone("select * from ubotg WHERE promo='".$userid."'");
if ($jilu)
{
$url=$jilu[url];
$people=$jilu[people];
$tg_money=$jilu[money];
$consume=$jilu[consume];
$liberal=$jilu[liberal];
$fatalism=$jilu[fatalism];
$frequency=$jilu[frequency];
$hypz="where id='1'";
$hy=queryall(se2wz,$hypz);
$isgive=$hy[isgive];
$givetime=$hy[givetime];
$givevips=$hy[givevip];
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
$dqtime=$neirong[dqtime];
$money=round($neirong[money], 2); 
$name=$neirong[name];
$user=$neirong[user];
$hylx=$neirong[hylx];
if ($isgive==1 && $hylx==5)
{$hymc=$givevips;}
else
{$hymc=$neirong[hymc];}
$time_jr=time();
$time_dq=$neirong[endtime];
$ts_value = $time_dq - $time_jr;
$tianshu = intval($ts_value / 86400);
$fenzhong = round($ts_value / 60);
$kstime=date('Y-m-d H:i:s',$neirong[kstime]);
$endtime=date('Y-m-d H:i:s',$time_dq);
$avatar=$neirong[avatar];
if (($dqtime>$settr3) && ($dqtime<$settr4))
{$qdpd="1";}else{$qdpd="0";}
}
else
{
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$user=$neirong[user];
$web=$_SERVER['HTTP_HOST'];
$url="http://".$web."/?url=".$userid;
$api = base64_decode('aHR0cDovL2FwaS50LnNpbmEuY29tLmNuL3Nob3J0X3VybC9zaG9ydGVuLmpzb24/c291cmNlPTMxNjQxMDM1JnVybF9sb25nPQ==');
$ret = file_get_contents($api.$url);
$url_1 = explode(',',$ret);
$url = $url_1[0];
$url = str_replace("[{\"url_short\":\"","",$url);
$url = str_replace("\"","",$url);
$tdate2=date("Y-m-d",strtotime("+1 day"))." 00:00:01";
$settr2=strtotime($tdate2);
$type="(`id`, `uid`, `promo`,`user`,`url`,`people`,`money`,`consume`,`frequency`,`addtime`,`renew`,`contents`) VALUES (null,'$uid','$userid','$user','$url','0','0', '0', '5', '$time','$settr2','推广')";
dbinsert(ubotg,$type);
$people=0;
$money=0;
$consume=0;
$liberal=0;
$fatalism=0;
$frequency=5;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-宣传推广</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script type="text/javascript" src="/dist/webuploader.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script type="text/javascript" src="/js/clipboard.js"></script>
<?php include_once('../include/css.php'); ?> 
<script type="text/javascript">  
function copyUrl()  
{  
    var copyBtn = document.getElementById('copyBtn');
    var clipboard = new ClipboardJS(copyBtn);
	clipboard.on('success', function(e) {
    alert("推广链接复制成功！");  
    e.clearSelection();
	});
	clipboard.on('error', function(e) {
		alert("推广链接复制成功！");  
	});
 /*
  var Url=document.getElementById("name");  
  Url.select(); 
  document.execCommand("Copy");
  alert("推广链接复制成功！");  
  */
}  
</script> 
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
.a-upload {
    padding: 5px 5px;
    height: 26px;
    line-height: 26px;
    position: relative;
    cursor: pointer;
    color: #888;
    background: #fafafa;
    border: 1px solid  rgba(0, 0, 0, .2);
    border-radius: 4px;
    overflow: hidden;
    display: inline-block;
    *display: inline;
    *zoom: 1
}
.a-upload:hover {
    color: #444;
    background: #eee;
    border-color: #ccc;
    text-decoration: none
}
.btn {
    display: inline-block; width:30%;padding: 6px 0;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer; background-image: none;border: 1px solid transparent;border-radius: 4px; -webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none; float: left; margin-left:2%;}
.btn-default{text-shadow:0 1px 0 #fff;background-image:-webkit-linear-gradient(top,#fff 0,#e0e0e0 100%);background-image:linear-gradient(to bottom,#fff 0,#e0e0e0 100%);background-repeat:repeat-x;border-color:#dbdbdb;border-color:#ccc;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe0e0e0',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);}
.btn-default:hover{background-color:#e0e0e0;background-position:0 -15px;}
.webuploader-container {
	position: relative;  overflow:hidden; float: left;
}
.webuploader-element-invisible {
	position: absolute !important;
	clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
	position: relative;
	display: inline-block;
	cursor: pointer;
	background: #d64f4f;
	padding: 5px 11px;
	color: #fff;
	text-align: center;
	border-radius: 3px;
	overflow: hidden;
	font-size:16px;
}
.webuploader-pick-hover {
	background: #d64f4f;
}

.webuploader-pick-disable {
	opacity: 0.6;
	pointer-events:none;
}
.item{position: relative;padding:5px 1%;line-height: 23px; height: 23px;border: 1px solid rgba(0, 0, 0, .2);border-radius: 3px; overflow:hidden; width:65%; float:left; }
.item .state{position: absolute;padding:0 6px;top:0;right:0; background-color:#d64f4f; height:33px; line-height:33px;border-radius: 0; color:#FFFFFF;}
.item .info{ line-height:25px;}

.progress{position: absolute; width:100%; height:33px; background-color:#fff; left:0; top:0;}
.progress .progress-bar{width:0%;height:33px; background-color:#d64f4f;}

</style>
<script src="/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function()
{
    $("#avatar li").click(function()
    {
        $("#avatar li").removeClass("select");
        $(this).addClass("select");
		var id=$(this).attr('id');
        document.getElementById('avatar_id').value=id;
    });
});  
</script>

</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">宣传推广</i>
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
<h1></h1>
</header>
  
  <div class="login" style=" margin-top:46px;"><div class="ui-avatar"><span style="background-image:url(/img/pl/<?php echo $avatar;?>.jpg)" onclick='location.href="user_avatar.php"'></span></div>
<div class="login_t">
<h3><?php if($name){?><span style="color:#0180cf">昵称：</span><?php echo $name;?><?php }else{?><span style="color:#0180cf">账号：</span><?php echo $user;?><?php }?></h3>
<span class="login_lj" style="font-size:14px;">财富：<font color="red" size="3"><?php echo $money;?></font> 元</span>
<span class="login_lj"><p style="margin:5px 0;font-size:14px;">级别：<font color="red"><?php if($hylx==0){echo "普通会员";}else if($hylx==5){echo $givevips; }else{ echo $hymc; }?></font>&nbsp;</p></span> </div>
</div>
<?php if($tianshu>0 || ($isgive==1 && $fenzhong>0 && $hylx==5)){?>
<section class="kaitong">
<li> <span class="mui-icon myFont-Icon t1 l"></span>
<h2 class="t2 l">VIP会员</h2>
<span class="r login_yj"></span>
</li>
<div class="clear"></div>
<li class="xian" style="padding-top:5px;height:80px;"> <span class="t4" style="color: #222;">会员级别：<?php echo $hymc;?>&nbsp;&nbsp; <font color="#999999">[ 剩余：<?php if ($isgive==1 && $fenzhong>0 && $hylx==5){?><?php echo $fenzhong;?> 分钟 ]<?php }else{?><?php echo $tianshu;?> 天 ]<?php }?></font><br>开始时间：<?php echo $kstime;?><br>结束时间：<?php echo $endtime;?><br></span> </li>
</section>
  <?php } ?>
  
<section class="jilu" style=" padding-top:0px;"> 
<a href="user_share.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">宣传推广</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_share_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">推广记录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div>
<section class="jilu" style="margin-top: 2.2%;" > 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="27" align="left">推广人数：<?php echo $people;?> 人</td>
  <td height="27" align="left">推广金额：<?php echo $tg_money;?> 元</td>
  </tr>
<tr style="border-top: 1px solid #F6F6F6;">
  <td align="left">消费金额：<?php echo $consume;?> 元</td>
  <td align="left">开通次数：<?php echo $liberal;?> 次</td>
  </tr>
<tr style="border-top: 1px solid #F6F6F6;">
  <td align="left">累积天数：<?php echo $fatalism;?> 天</td>
  <td align="left">今日次数：<?php echo $frequency;?> 次</td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td  height="15" width="30%" ></td>
<td width="70%"></td>
</tr>
<tr>
  <td height="40" align="right" valign="middle">推广链接：</td>
  <td><textarea name="name" class="make_resume_input" id="shareUrl" style="width:80%; height:50px;margin-bottom: 0;resize: none;"><?php echo $url ?> 美女视频，真心觉得不错，您快去看看吧！</textarea></td>
</tr>
<tr>
<td align="right" valign="top" style="padding-top:6px;">二维码：</td>
<td><img src="qrcode.php?url=<?php echo $url ?>" width="150" height="150" style="border: 1px solid rgba(0, 0, 0, .2); padding:4px; margin-top:5px;"></td>
</tr>

<tr>
<td height="50" colspan="2" align="center" valign="middle" style="padding-top:6px;">
  <button  id="copyBtn" data-clipboard-action="copy" data-clipboard-target="#shareUrl"  class="oy-btn oy-btn-lg" onClick="copyUrl()">复制链接</button></td>
</tr>
</tbody></table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td height="40">复制宣传代码发给QQ好友、微信好友、QQ群、微信群，被好友或其他用户通过链接访问，每个用户访问可获得1元，
每天最多获得5次，金额达到<?php echo $money1;?>元，自动开通VIP会员30天，可叠加。</td>
</tr>
</table>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
