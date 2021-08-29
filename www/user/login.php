<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$username=$_POST[UserName];
$password=$_POST[PassWord];
if ($username && $password ){
$newpass=md5($password);
$user=getone("select * from ubouser WHERE user='".$username."' and pass='".$newpass."' or tel='".$username."' and pass='".$newpass."' ");
if(!empty($user))
{
$userid=$user['userid'];
setcookie("uid", $userid,time()+3600*24*365*3,"/");
echo msglayerurl("登录成功！",8,"/user/");
exit;
}
else
{
echo msglayer("用户名或密码错误！",8);
exit;
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>会员登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script language="javascript">
 function login_check(){
 if (LoginForm.UserName.value==""){
  alert("请输入用户名！");
  LoginForm.UserName.focus();
  return false;
 }
  if (LoginForm.PassWord.value==""){
  alert("请输入密码！");
  LoginForm.PassWord.focus();
  return false;
 }
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h"/></i></span><i class="ico21">会员登录</i>
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
<section class="register" style="margin-top:40px;padding:40px 0 40px 0;">
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<form id="LoginForm" class="LoginForm" action="" method="post" onSubmit="return login_check();" target="msgubotj">
<div class="form_up">
<div class="username"><span style="float:left;margin-left:7px;">用 户 名：</span>
<input type="text" id="UserName" name="UserName" placeholder="请输入您的用户名/手机号码" class="input1">
</div>
<div class="username"><span style="float:left;margin-left:5px;">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：</span><input type="password" name="PassWord" id="PassWord" placeholder="请输入您的密码" class="input1"></div>
</div>
<div class="botton" >
<button type="submit" class="oy-btn oy-btn-fluid-lg">登 录</button>
</div><br>
</form>
<div class="botton" >
<button class="oy-btn oy-btn-fluid-lg oy-btn-warm" onclick="location.href='reg.php';">注册会员</button>
</div>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>