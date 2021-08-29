<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$userid=$_COOKIE["uid"];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
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
$jifen=$neirong[jifen];
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
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心</title>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">会员中心</i>
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
<span class="login_lj" style="font-size:14px;">财富：<font color="red" size="3"><?php echo $money;?></font> 元<a href="user_pay.php">升级</a>&nbsp;&nbsp;<a href="user_gold.php">充值</a></span>
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
<?php }?>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%; padding-top:3.8%;">
<a href="user_edit.php">
<li>
</li><li><span class="t5 l"><img src="/img/zlxg.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">资料修改</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_packet.php">
<li>
</li><li><span class="t5 l"><img src="/img/hb.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">抢红包</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="qd.php" target="msgubotj">
<li>
</li><li><span class="t5 l"><img src="/img/qiandao.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;" id="qd"><?php if ($qdpd==1){echo '今天已签到';}else{echo '签到领金币';}?></h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_gz.php">
<li>
</li><li><span class="t5 l"><img src="/img/ugz.png" width="18" height="18"></span>
<h2 class="t2 l" style="padding-top:1.5%;">我的关注</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_scj.php">
<li>
</li><li><span class="t5 l"><img src="/img/scj.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">我的收藏</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_pay.php">
<li>
</li><li><span class="t5 l"><img src="/img/jifen.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">会员升级</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_consume.php">
<li>
</li><li><span class="t5 l"><img src="/img/jyjl.png" width="20" height="20"></span>
<h2 class="t2 l" style="padding-top:1.5%;">消费记录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_pay_list.php">
<li>
</li><li><span class="t5 l"><img src="/img/cwjl.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">财务记录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_distributor.php">
<li>
</li><li><span class="t5 l"><img src="/img/fx.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">三级分销</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_share.php">
<li>
</li><li><span class="t5 l"><img src="/img/xzfx.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">宣传推广</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_video_add.php">
<li>
</li><li><span class="t5 l"><img src="/img/shipin3.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">我的视频</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_feedback.php">
<li>
</li><li><span class="t5 l"><img src="/img/xx.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">意见反馈</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="logout.php?out=out" target="msgubotj">
<li>
</li><li><span class="t5 l"><img src="/img/tui.png" width="19" height="19"></span>
<h2 class="t2 l" style="padding-top:1.5%;">退出登录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</footer>
</body>
</html>
<?php }?> 