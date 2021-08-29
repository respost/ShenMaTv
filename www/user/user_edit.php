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
$id=$_POST[id];
$user=$_POST[username];
$email=$_POST[email];
$name=$_POST[name];
$tel=$_POST[tel];
$qq=$_POST[qq];
$alipayname=$_POST[alipayname];
$alipay=$_POST[alipay];
if($id)
{
$type="user='$user',email='$email',name='$name',tel='$tel',qq='$qq',alipayname='$alipayname',alipay='$alipay' where id='$id'";
upalldt(ubouser,$type);
echo msglayerurl("修改成功！",8,"/user/");
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-资料修改</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script language="javascript" src="/js/Comm.js"></script>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">资料修改</i>
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
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">资料修改</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_edit_pass.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">密码修改</h2>
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
<form id="Form1" method="post" action="" style="padding:0 10px;" onSubmit="return CheckForm();" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody><tr>
<td width="35%" height="40" align="right">账&nbsp;&nbsp;&nbsp;号：</td>
<td height="40"><input type="text" id="username" name="username" class="make_resume_input" value="<?php echo $neirong[user]?>"></td>
</tr>
<tr>
<td height="40" align="right">昵&nbsp;&nbsp;&nbsp;称：</td>
<td height="40"><input type="text" name="name" class="make_resume_input" value="<?php echo $neirong[name]?>"></td>
</tr>
<tr>
<td height="40" align="right">邮&nbsp;&nbsp;&nbsp;箱：</td>
<td height="40"><input type="text" name="email" class="make_resume_input" value="<?php echo $neirong[email]?>"></td>
</tr>
<tr>
<td height="40" align="right">Q&nbsp;&nbsp;&nbsp;Q：</td>
<td height="40"><input type="text" name="qq" class="make_resume_input" value="<?php echo $neirong[qq]?>"></td>
</tr>
<tr>
<td height="40" align="right">手&nbsp;&nbsp;&nbsp;机：</td>
<td height="40"><input type="text" name="tel" class="make_resume_input" value="<?php echo $neirong[tel]?>"></td>
</tr>
<tr>
<td height="40" align="right">收&nbsp;款&nbsp;人：</td>
<td height="40"><input type="text" name="alipayname" class="make_resume_input" value="<?php echo $neirong[alipayname]?>"></td>
</tr>
<tr>
<td height="40" align="right">支付宝账号：</td>
<td height="40">
<input name="alipay" type="text" class="make_resume_input" value="<?php echo $neirong[alipay]?>"></td>
</tr>
<tr>
<td height="40"><input name="id" type="hidden" value="<?php echo $neirong[id]?>"></td>
<td height="40">
<button type="submit" id="submit" class="oy-btn oy-btn-lg">保存修改</button>
</td>
</tr>
</tbody></table>
</form>
</section>
<script language="javascript">
	$(document).ready(function(){ 
		//失去焦点时，开始检测
		$("#username").blur(CheckUser);
	});
	function CheckForm()
	{		
		if(!checkLength("username" , "用户名称" , 3 , 16 , "~!@#$%^&*+=\\\'\"\<\>"))
			return false;
	}
	
	function CheckUser()
	{
		if(Form1.username.value!='<?php echo $neirong[user]?>'){
			if(!checkLength("username" , "用户名" , 3 , 16 , "~!@#$%^&*+=\\\'\"\<\>"))
				return false;
			window.msgubotj.location.href = 'jc.php?name=用户名&username=' + Form1.username.value;
		}
	}
</script>
<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
