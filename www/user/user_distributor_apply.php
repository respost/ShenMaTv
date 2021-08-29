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
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$jilu=getone("select * from ubofx WHERE promo='".$userid."' and status=2");
if ($jilu)
{
$uid=$jilu[uid];
$tixian=getone("select * from ubopayjs WHERE uid=".$uid." order by id desc");
if ($jilu)
{
$status=$tixian[jiesuan];
$money=$tixian[money];
}
else
{
$status=0;
}
}else{
echo "<script>alert('未开通分销!');location.href='user_distributor.php'</script>";
exit;
}

if($_POST[add])
{
$alipayname=$_POST[alipayname];
$alipay=$_POST[alipay];
$money=intval($_POST[money]);
if (empty($alipayname) || empty($alipay))
{
echo msglayer("请设置收款账号！",8);
exit;
}
else
{
if ($money<100)
{
echo msglayer("金额小于100元，无法提取！",8);
exit;
}
}

$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$user=$neirong[user];
$jilu=getone("select * from ubofx WHERE uid=".$uid);
$surplus=intval($jilu[money]);
if ($uid && $surplus>=$money)
{
$type="(`id`, `uid`,`user`,`money`,`sqshijian`,`jsshijian`,`jiesuan`,`alipay`,`alipayname`) VALUES (null,'$uid','$user','$money','$time','0','1','$alipay','$alipayname')";
dbinsert(ubopayjs,$type);
$type="money=money-$money where uid=".$uid;
upalldt(ubofx,$type);
$status=1;
echo msglayerurl("申请成功，待处理！",8,"user_distributor_apply.php");
exit;
}else{
echo msglayer("余额不足！",8);
exit;
}

}
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-申请提现</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script type="text/javascript" src="/dist/webuploader.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<?php include_once('../include/css.php'); ?> 
<script type="text/javascript">  
function copyUrl2()  
{  
  var Url2=document.getElementById("name");  
  Url2.select(); 
  document.execCommand("Copy");
  alert("推广链接复制成功！");  
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">申请提现</i>
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
<a href="user_distributor.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">分销推广</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_distributor_staff.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">推广会员</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_distributor_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">入账明细</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_distributor_apply.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">申请提现</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_distributor_distill.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">提现明细</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div>
<?php if ($status==0 || $status==2){?>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
提现步骤：<font color="#FF0000">1：申请提现</font> >> 2：提现处理 >> 3：提现成功  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="220" colspan="2" align="center">
  <form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
<td height="15" width="30%"></td>
<td width="70%"></td>
</tr>
<tr>
  <td align="right">提现金额：</td>
  <td><input name="money" type="text" id="money" onKeyUp="this.value=this.value.replace(/\D/gi,&quot;&quot;)" value="100" class="make_resume_input" style="width:80%;"> 元</td>
</tr>
<tr>
  <td align="right">收&nbsp;款&nbsp;人：</td>
  <td><input name="alipayname" type="text" id="alipayname" style="width:80%" class="make_resume_input"></td>
</tr>
<tr>
  <td align="right">支付宝账号：</td>
  <td><input name="alipay" type="text" id="alipay" style="width:80%" class="make_resume_input"></td>
</tr>


<tr>
<td height="50" colspan="2" align="center" valign="middle">
  <input type="submit" id="submit" name= "add" value="申请提现" class="user_reg_but" style="width:120px;"></td>
</tr>
</tbody></table>
</form>
  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
提现说明：单笔提现金额≥100元，手续费5%，72小时内处理，单笔提现金额不能低于100元。
  </td>
  </tr>
</table>
</section>
<?php }else if($status==1){?>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
提现步骤：1：申请提现 >> <font color="#FF0000">2：提现处理</font> >> 3：提现成功  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="220" colspan="2" align="center">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
  <td height="40" align="center">提现金额 <?php echo $money*0.95;?> 元（手续费 <?php echo $money*0.05;?> 元）</td>
</tr>
<tr>
<td height="40" align="center">
  <input type="button" id="submit" name= "add" value="提现处理中" class="user_reg_but" style="width:120px;"></td>
</tr>
</tbody></table>
  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
提现说明：单笔提现金额≥100元，手续费5%，72小时内处理，单笔提现金额不能低于100元。
  </td>
  </tr>
</table>
</section>
<?php }?>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
