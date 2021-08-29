<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$hurl = $_SERVER['HTTP_REFERER'];//来源;
$wangzhi = $_SERVER['SERVER_NAME'];
$userid=$_COOKIE[uid];
$time=time();
/**
* PHP产生随机字符串
*
* @param int $length 输出长度
* @param string $chars 可选的 ，默认为 0123456789
* @return string 字符串
*/
function random($length, $chars='0123456789') {
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}
if($userid==null){
	echo "<script>location.href='login.php'</script>";
	exit;
}else{
$hycs="where id='1'";
$hy=queryall(ubozf,$hycs);
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$money1=$hy[money1];
$money2=$hy[money2];
$money3=$hy[money3];
$money4=$hy[money4];
$hytime1=$hy[hytime1];
$hytime2=$hy[hytime2];
$hytime3=$hy[hytime3];
$hytime4=$hy[hytime4];


$uid=$_POST[uid];
if (empty($uid))
{$uid=$_GET[uid];}
$hylx=$_POST[hylx];
if (empty($hylx))
{$hylx=$_GET[hylx];}

//升级会员
if($uid && $hylx){
	$info=getone("select * from ubouser WHERE userid='$userid'");
	$oldendtime=$info['endtime'];
	$mgr=$info['user'];
	$user_money=$info['money'];
	$user_jifen=$info['jifen'];
		if ($hylx==1){$days=$hytime1;$pay_money=$money1;}
	elseif ($hylx==2){$days=$hytime2;$pay_money=$money2;}
	elseif ($hylx==3){$days=$hytime3;$pay_money=$money3;}
	elseif ($hylx==4){$days=$hytime4;$pay_money=$money4;}
	if($user_money<$pay_money){
		echo msglayerurl("升级需支付".$pay_money."元，余额不足请充值！",8,"user_gold.php");
		exit;
	}
	if ($oldendtime<$time){
		$oldendtime=0;
	}	
	mysql_query("SET AUTOCOMMIT=0"); //设置mysql不自动提交，需自行用commit语句提交	
	try{			
		$endtime=strtotime("".intval($days)." days",$oldendtime==0?time():$oldendtime);
		//扣除用户金额
		$user_current_money=$user_money-$pay_money;
		//计算用户积分（消费1元，得1积分）
		$user_current_jifen=$user_jifen+$pay_money;
		if($user_current_jifen<200){
			$vipid=1;
		}elseif($user_current_jifen>=200&&$user_current_jifen<500){
			$vipid=2;
		}elseif($user_current_jifen>=500&&$user_current_jifen<1000){
			$vipid=3;
		}elseif($user_current_jifen>=1000){
			$vipid=4;
		}
		if($vipid==1){$hymc=$member1;}
		elseif($vipid==2){$hymc=$member2;}
		elseif($vipid==3){$hymc=$member3;}
		elseif($vipid==4){$hymc=$member4;}
		$type="money='$user_current_money',jifen='$user_current_jifen',hylx='$vipid',hymc='$hymc',kstime='$time',endtime='$endtime' where id='$uid'";
		$res1=upalldt(ubouser,$type);
		$ddzt=2;
		$pid=random(10, '0123456789');	
		$zffs=4;//支付方式	
		$type="(`id`, `pid`, `uid`, `money`, `leixing`, `ddzt`, `zffs`, `addtime`,`remind`) VALUES (null,'$pid','$uid','$pay_money','$hylx','$ddzt','$zffs','$time','1')";
		$res2=dbinsert(ubotj,$type);		
		if($res1&&$res2){
			echo msglayerurl("会员升级成功！",8,"/user/");
			mysql_query("COMMIT");//提交事务
			exit;
		}else{
			mysql_query("ROLLBACK");//至少有一条sql语句执行错误，事务回滚
			echo msglayer("升级失败！",8);
			exit;
		}			
	}catch(Exception $e){
		mysql_query("ROLLBACK");//至少有一条sql语句执行错误，事务回滚
		echo msglayer("升级失败！",8);
		exit;
	}	
	mysql_query("END");//事务结束		
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-会员升级</title>
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

.qx {color: #999;}

</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">会员升级</i>
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
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_pay.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">会员升级</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_gold.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">金币充值</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_pay_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">财务记录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%;"> 
<p class="login_lj" align="center">当前账号：<font color="blue" size="2"><?php echo $neirong[user] ?></font>
&nbsp;&nbsp;&nbsp;可用余额：<font color="red" size="2"><?php echo $neirong[money] ?></font> 元</span>
<a style="width:45px;height:20px;line-height:20px;display:inline-block;margin-left:10px;" href="user_gold.php">去充值</a></p>
<form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
<td  height="50" style="border-bottom:1px solid #F6F6F6;"><strong>会员类型</strong></td>
</tr>
<tr>
<td  height="50" ><div id="pay">
<label id="<?php echo $money1;?>"><input name="hylx" type="radio" value="1" checked>
    <?php echo $member1;?> <span class="qx">（有效期<?php echo $hytime1;?>天）</span>￥<?php echo $money1;?>元</label>
<label id="<?php echo $money2;?>"><input type="radio" name="hylx" value="2">
    <?php echo $member2;?> <span class="qx">（有效期<?php echo $hytime2;?>天）</span>￥<?php echo $money2;?>元</label>
<label id="<?php echo $money3;?>"><input type="radio" name="hylx" value="3">
    <?php echo $member3;?> <span class="qx">（有效期<?php echo $hytime3;?>天）</span>￥<?php echo $money3;?>元</label>
<label id="<?php echo $money4;?>"><input type="radio" name="hylx" value="4">
  <?php echo $member4;?> <span class="qx">（有效期<?php echo $hytime4;?>天）</span>￥<?php echo $money4;?>元</label>
</div></td>
</tr>
<td height="60" align="center" valign="middle">
	<input name="uid" type="hidden" value="<?php echo $neirong[id]?>">
  <button type="submit" id="submit" class="oy-btn oy-btn-fluid-lg">升级会员</button></td>
</tr>
</tbody></table>
</form>
</section>
<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 