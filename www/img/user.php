<?php
error_reporting(0); 
include("os.php");
include("config/common.php");
include("config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$ip=$_SERVER["REMOTE_ADDR"];
$type="where ip='$ip'";
$user=queryall(uboip,$type);
$pid=$user[pid];
$uid=$user[uid];
$userid=$_COOKIE[userid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$type="where user='$userid'";
$neirong=queryall(ubouser,$type);
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
$dqtime=$neirong[dqtime];
$money=$neirong[money];
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
<?php include_once('css.php'); ?> 
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
<ul class="head-nav">
<a href="vod_list.php?m=new" rel="external"><li>今日更新</li></a>
<a href="vod_list.php?flid=4" rel="external"><li>美女热舞</li></a>
<a href="vod_list.php?flid=3" rel="external"><li>主播视频</li></a>
<a href="vod_list.php?flid=6" rel="external"><li>搞笑短剧</li></a>
<a href="img_list.php" rel="external"><li>性感写真</li></a>
</ul>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="vod_list.php" data-ajax="false" id="search-form">
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
<ul class="nav-list">
<?php 
$query = mysql_query("SELECT * FROM se2fl limit 6 ");
while($a = mysql_fetch_array($query)) {?>			
<a href="vod_list.php?flid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
<?php
$query = mysql_query("SELECT * FROM se2tufl order by id limit 12 ");
while($a = mysql_fetch_array($query)) {?>
<a href="/img_list.php?tid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
</ul>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1><?php if($user[ms]=="黄金会员"){?>黄金会员<?php }elseif($user[ms]=="永久会员"){?>钻石会员<?php }?></h1>
</header>
<div class="login" style=" margin-top:40px;"><div class="ui-avatar"><span style="background-image:url(img/pl/<?php echo $i?>.jpg)"></span></div>
<div class="login_t">
<h3><span style="color:#0180cf">欢迎您 </span> , <?php echo $userid;?></h3>
<span class="login_lj" style="font-size:14px;">可用金币：<font color="red" size="3"><?php echo $money;?></font> 个</span>
<span class="login_lj"><p style="margin:5px 0;">会员级别：<font color="red">注册会员</font>&nbsp;</p></span> </div>
</div>
<?php if(1==2){?>
<section class="kaitong"> <a href="http://m.jjrsp.com/index.php/user/pay/group">
<li> <span class="mui-icon myFont-Icon t1 l"></span>
<h2 class="t2 l">升级VIP</h2>
<span class="r login_yj"> &gt; </span>
</li>
<div class="clear"></div>
<li class="xian" style="padding-top:5px;"> <span class="t4">VIP用户有效期内全站高清精彩无限制任意看~！</span> </li>
</a> 
</section>
<?php }?>
<section class="jilu" style="margin-top: 2.2%; padding-top:3.8%;">
<a href="user_edit.php">
<li>
</li><li><span class="t5 l"><img src="/img/zlxg.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">资料修改</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="qd.php">
<li>
</li><li><span class="t5 l"><img src="/img/qiandao.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;" id="qd"><?php if ($qdpd==1){echo '今天已签到';}else{echo '签到领金币';}?></h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="scj.php">
<li>
</li><li><span class="t5 l"><img src="/img/scj.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">我的收藏</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<?php if(1==2){?>
<a href="http://m.jjrsp.com/index.php/user/pay">
<li>
</li><li><span class="t5 l"><img src="/img/jifen.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">会员充值</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="http://m.jjrsp.com/index.php/user/pay/lists">
<li>
</li><li><span class="t5 l"><img src="/img/cwjl.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">财务记录</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="http://m.jjrsp.com/index.php/user/share">
<li>
</li><li><span class="t5 l"><img src="/img/xzfx.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">宣传分享</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="http://m.jjrsp.com/index.php/vod/user/fav">
<li>
</li><li><span class="t5 l"><img src="/img/shipin.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">我的视频</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<?php }?>
<a href="logout.php?out=out">
<li>
</li><li><span class="t5 l"><img src="/img/tui.png" width="19" height="19"></span>
<h2 class="t2 l" style="padding-top:1.5%;">退出登录</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
</section>
<section class="ui-panel" style="background-color: white">
<h3 style="text-align: center;line-height: 40px!important;"><span>会员特权</span></h3>
<ul class="ui-tiled ui-border-t aboutpic">
<li><i class="ui-icon-zy"><img src="img/about_zy.png"></i>海量片库</li>
<li><i class="ui-icon-tp"><img src="img/about_tp.png"></i>海量图库</li>
<li><i class="ui-icon-hd"><img src="img/about_hd.png"></i>高清专享</li>
<li><i class="ui-icon-kf"><img src="img/about_kf.png"></i>美女客服</li>
</ul>
</section>

<section class="ui-panel" style="background-color: white">
<div class="about">
<h3>免责声明</h3>
<p>1、一切移动客户端用户在下载并浏览
<span><?php echo $t?></span>软件时均被视为已经仔细阅读本条款并完全同意。凡以任何方式登陆本站，或直接、间接使用本站资料者，均被视为自愿接受本网站相关声明和用户服务协议的约束。</p>
<p>2、<?php echo $t?>转载的内容并不代表
<span><?php echo $t?></span>之意见及观点，也不意味着本站赞同其观点或证实其内容的真实性。</p>
<p>3、
<span><?php echo $t?></span>转载的文字、图片、音视频等资料均由本站用户提供，其真实性、准确性和合法性由信息发布人负责。
<span><?php echo $t?></span>不提供任何保证，并不承担任何法律责任。</p>
<p>4、
<span><?php echo $t?></span>所转载的文字、图片、音视频等资料，如果侵犯了第三方的知识产权或其他权利，责任由作者或转载者本人承担，本站对此不承担责任。</p>
<p>
<br></p>
<p>
<br></p>
<details>
<summary style="text-align:right;color:#225599;font-size:12px">显示更多</summary>
<p>5、
<span><?php echo $t?></span>不保证为向用户提供便利而设置的外部链接的准确性和完整性，同时，对于该外部链接指向的不由
<span><?php echo $t?></span>实际控制的任何网页上的内容，
<span><?php echo $t?></span>不承担任何责任。</p>
<p>6、用户明确并同意其使用
<span><?php echo $t?></span>网络服务所存在的风险将完全由其本人承担；因其使用
<span><?php echo $t?></span>网络服务而产生的一切后果也由其本人承担，
<span><?php echo $t?></span>对此不承担任何责任。</p>
<p>7、除
<span><?php echo $t?></span>注明之服务条款外，其它因不当使用本站而导致的任何意外、疏忽、合约毁坏、诽谤、版权或其他知识产权侵犯及其所造成的任何损失，
<span><?php echo $t?></span>概不负责，亦不承担任何法律责任。</p>
<p>8、对于因不可抗力或因黑客攻击、通讯线路中断等
<span><?php echo $t?></span>不能控制的原因造成的网络服务中断或其他缺陷，导致用户不能正常使用
<span><?php echo $t?></span>，
<span><?php echo $t?></span>不承担任何责任，但将尽力减少因此给用户造成的损失或影响。</p>
<p>9、本声明未涉及的问题请参见国家有关法律法规，当本声明与国家有关法律法规冲突时，以国家法律法规为准。</p>
<p>10、本网站相关声明版权及其修改权、更新权和最终解释权均属
<span><?php echo $t?></span>所有。</p>
<p>
<br></p>
<p>
<br></p>
</details>
<h3>使用帮助</h3>
<p>第一步：用户可以对影片进行试看，试看完毕后想要成为会员请进入会员中心充值。</p>
<p>第二步：充值成功成为会员后会自动回到首页。</p>
<p>第三布：成为会员后，回到首页现在可以进入各个播放页欣赏相关影片。</p>
<!--<a href="javascript:login()">登录</a>--></div>
</section>
<?php include_once('foot.php'); ?> 
<footer id="footer" class="ui-footer ui-footer-stable ui-border-t">
<ul class="ui-tiled ui-border-t">
<li onClick="ubourl('/')"><i class="ui-icon-index"></i>首&nbsp;&nbsp;页</li>
<li onClick="ubourl('vod_list.php')" ><i class="ui-icon-sp"></i>视频区</li>
<li onClick="ubourl('img_list.php')" ><i class="ui-icon-tp"></i>美图区</li>
<li  onclick="ubourl('user.php')" class="active"><i class="ui-icon-user2"></i>会员中心</li>
</ul>
</footer>
</body>
</html>
<?php }?> 