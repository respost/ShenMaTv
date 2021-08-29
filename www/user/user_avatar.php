<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$rfr = $_SERVER['HTTP_REFERER'];//来源;
$userid=$_COOKIE[uid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$id=$_POST[id];
$avatar_id=$_POST[avatar_id];
$url=$_POST[url];
if($id)
{
$type="avatar='$avatar_id' where id='$id'";
upalldt(ubouser,$type);
echo msglayerurl("头像设置成功！",8,"/user/");
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$avatar=$neirong[avatar];
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-头像修改</title>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">头像设置</i>
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
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">密码修改</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_avatar.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">头像设置</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%;"> 
<form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
<td  height="15"></td>
</tr>
<tr>
<td id="avatar">
<?PHP 
for($i=1;$i<=50;$i++){
   if ($avatar==$i)
   {
   echo '<li style="background-image:url(/img/pl/'.$i.'.jpg)" id="'.$i.'" class="select"></li>';
   }
   else
   {
  echo '<li style="background-image:url(/img/pl/'.$i.'.jpg)" id="'.$i.'"></li>';
   }
}
?></td>
</tr>

<tr>
<td height="50" align="center" valign="middle"><input name="id" type="hidden" value="<?php echo $neirong[id]?>"><input name="avatar_id" id="avatar_id" type="hidden" value="<?php echo $avatar;?>"><input name="url" type="hidden" value="<?php echo $rfr;?>">
  <button type="submit" id="submit" class="oy-btn oy-btn-lg" >保存头像</button></td>
</tr>
</tbody></table>
</form>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
