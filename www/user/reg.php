<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$ip=$_SERVER["REMOTE_ADDR"];
$type="where ip='$ip'";
$user=queryall(uboip,$type);
$pid=$user[pid];
$uid=$user[uid];
$username=$_POST[username];
$password=$_POST[password];
//$email=$_POST[email];
$tel=$_POST[tel];
$avatar=rand(1,40);
function random($length, $chars) {
$hash = '';
$max = strlen($chars) - 1;
for($i = 0; $i < $length; $i++) {
$hash .= $chars[mt_rand(0, $max)];
}
return $hash;
}
if ($username && $password && $tel){
$newpass=md5($_POST[password]);
$user=getone("select * from ubouser WHERE user='".$username."' or tel='".$tel."'");
if(empty($user))
{
$time=time();
$userid=random(10, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
$ip=$_SERVER["REMOTE_ADDR"];
$hypz="where id='1'";
$hy=queryall(se2wz,$hypz);
$isgive=$hy[isgive];
$givetime=$hy[givetime];
	if ($isgive==1)
	{
	$hylx=5;
	$endtime=date("Y-m-d",time())." ".date('H:i:s',strtotime("".$givetime." minute"));
	$endtime=strtotime($endtime);
	$type="(`id`, `user`, `pass`, `tel`, `userid`, `avatar`, `ip`, `zctime`, `hylx`, `kstime`, `endtime`) VALUES (null,'$username','$newpass','$_POST[tel]','$userid','$avatar','$ip','$time','$hylx','$time','$endtime')"; 
	}
	else
	{
	$type="(`id`, `user`, `pass`, `tel`, `userid`, `avatar`, `ip`, `zctime`) VALUES (null,'$username','$newpass','$_POST[tel]','$userid','$avatar','$ip','$time')"; 
	}
dbinsert(ubouser,$type);
setcookie("uid",$userid,time()+3600*24*365*3,"/");
echo msglayerurl("注册成功！",8,"/user/");
exit;
}
else
{
echo msglayer("注册失败！",8);
exit;
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>会员注册</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script language="javascript" src="/js/Comm.js"></script>
<script language="javascript">
	function CheckForm()
	{
		if(!checkLength("username" , "用户名称" , 3 , 16 , "~!@#$%^&*+=\\\'\"\<\>"))
			return false;
		if(!checkLength("password" , "登录密码" , 6 , 16 , "&<>\'"))
			return false;
		if(!checkLength("password1" , "确认密码" , 6 , 16 , "&<>\'"))
			return false;
		if(!checkLength("tel" , "手机号码" , 11 , "&<>\'"))
			return false;
		if(RegForm.password.value.toLowerCase() != RegForm.password1.value.toLowerCase())
		{
			alert("输入的密码和确认密码不一致");
			return false;
		}
		if(!checkLength("email" , "电子信箱" , 1 , 100))
			return false;
		if(!checkEmail("email" , "电子信箱"))
			return false;
		}
	
	function CheckUser()
	{
		if(!checkLength("username" , "用户名称" , 3 , 16 , "~!@#$%^&*+=\\\'\"\<\>"))
			return false;
		window.msgubotj.location.href = 'jc.php?name=用户名&username=' + RegForm.username.value;
	}
	function Checkemail()
	{
		if(!checkLength("email" , "邮箱名称" , 3 , 20 , "~!#$%^&*+=\\\'\"\<\>"))
			return false;
		window.msgubotj.location.href = 'jc.php?email=' + RegForm.email.value;
	}
	function CheckTel()
	{
		if(!checkLength("tel" , "手机号码" , 11 , "~!#$%^&*+=\\\'\"\<\>"))
			return false;
		window.msgubotj.location.href = 'jc.php?name=手机号码&tel=' + RegForm.tel.value;
	}
</script>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h"/></i></span><i class="ico21">会员注册</i>
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
<section class="register" style="margin-top:40px;">
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<form id="RegForm" class="RegForm" action="" method="post" onSubmit="return CheckForm();" target="msgubotj">
<div class="form_up">
<div class="username"><span style="float:left;">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</span>
<input type="text" id="username" name="username" placeholder="请输入您的用户名" class="input1">
</div>
<div class="username"><span style="float:left;">手机号码：</span>
<input type="text" name="tel" id="tel" placeholder="请输入您的手机号码" class="input1" >
</div>
<!--
<div class="username"><span style="float:left;">常用邮箱：</span>
<input type="text" name="email" id="email" placeholder="请输入您的邮箱" class="input1" >
</div>
-->
<div class="username"><span style="float:left;">输入密码：</span><input type="password" name="password" id="password" placeholder="请输入您的密码" class="input1"></div>
<div class="username"><span style="float:left;">确认密码：</span>
<input name="password1" type="password" id="password1" placeholder="请再次输入您的密码" class="input1">
</div>

</div>
<div class="botton" >
<input name="reg" type="hidden" value="立即注册">
<button name="reg" type="submit" class="oy-btn oy-btn-fluid-lg oy-btn-green" id="reg">立即注册</button>
</div>
<a href="" class="t9">点击注册表示已同意【用户服务协议】</a><div style="display:none;"><iframe src="" width=0 height=0 name="jcIframe" id="jcIframe"></iframe></div>
<br><br><br>
</form>
</section>
<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>