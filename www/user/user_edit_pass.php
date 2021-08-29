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
$style=$_POST[style];
$id=$_POST[id];
$user=$_POST[user];
$userpass=$_POST[userpass];
$userpass1=$_POST[userpass1];
$userpass2=$_POST[userpass2];
if ($style==1)
{
if ($user && $userpass ){
$newpass=md5($userpass);
$user=getone("select * from ubouser WHERE user='".$user."' and pass='".$newpass."'");
if(!empty($user) && ($userpass1==$userpass2))
{
$password=md5($userpass1);
$type="pass='$password' where id='$id'";
upalldt(ubouser,$type);
echo msglayerurl("密码修改成功！",8,"/user/");
}
else
{
echo msglayerurl("原密码错误！",8,"user_edit_pass.php");
}
}
}elseif ($style==2){
$user=getone("select * from ubouser WHERE user='".$user."' and userid='".$userid."'");
if(!empty($user) && $userpass1 && ($userpass1==$userpass2))
{
$password=md5($userpass1);
$type="pass='$password' where id='$id'";
upalldt(ubouser,$type);
echo msglayerurl("密码修改成功！",8,"user_edit_pass.php");
}
else
{
echo msglayerurl("密码修改失败！",8,"user_edit_pass.php");
}
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-密码修改</title>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px"  class="h"/></i></span><i class="ico21">密码修改</i>
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
<a href="user_edit.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">资料修改</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_edit_pass.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">密码修改</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_avatar.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">头像设置</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%;"> 
<form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody><tr>
<td height="40">账号：</td>
<td height="40"><?php echo $neirong[user]?></td>
</tr>
<tr>
<?php if($neirong[pass]=='0'){?>
<tr>
<td height="40">设置密码：</td>
<td height="40"><input name="style" type="hidden" value="2"><input name="userpass1" type="password" class="make_resume_input" id="userpass1"></td>
</tr>
<tr>
<td height="40">确认密码：</td>
<td height="40"><input name="userpass2" type="password" class="make_resume_input" id="userpass2"></td>
</tr>
<?php }else{?>
<tr>
<td height="40">原密码：</td>
<td height="40"><input name="style" type="hidden" value="1"><input name="userpass" type="password" class="make_resume_input" id="userpass"></td>
</tr>
<tr>
<td height="40">新密码：</td>
<td height="40"><input name="userpass1" type="password" class="make_resume_input" id="userpass1"></td>
</tr>
<tr>
<td height="40">确认新密码：</td>
<td height="40"><input name="userpass2" type="password" class="make_resume_input" id="userpass2"></td>
</tr>
<?php }?>
<td height="40"><input name="user" type="hidden" value="<?php echo $neirong[user]?>"><input name="id" type="hidden" value="<?php echo $neirong[id]?>"></td>
<td height="40">
<button type="submit" id="submit" class="oy-btn oy-btn-lg">保存修改</button>
</td>
</tr>
</tbody></table>
</form>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
