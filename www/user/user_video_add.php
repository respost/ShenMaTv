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
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
if($_POST[add]){
$name=$_POST[name];
$fenlei=$_POST[fenlei];
$pic2=$_POST[pic2];
$url=$_POST[url];
$url2=$_POST[url2];
$money=$_POST[money];
$content=$_POST[content];
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$uname=$neirong[user];
$yue=$neirong[money];
if ($yue<1 && 1==2){
echo msglayer("余额不足，请先充值！",8);
exit;
}
include_once('cppic.php'); 
$pic=$uploadfile; 
$url2_t=strlen($url2);
$pic2_t=strlen($pic2);
if($name && ($url || $url2_t>7) && ($pic || $pic2_t>7))
{
$time=time();
if ($pic==null)
{
//$type="money=money-1 where id='$uid'";
//upalldt(ubouser,$type);
$pic=$pic2; 
if (empty($url))
{$url=$url2;}
$type="trends=trends+1 where id=".$uid;
upalldt(ubouser,$type);
$type="(`id`, `name`, `fenlei`,`uid`,`status`,`cishu`,`tuijian`,`url`,`pic`,`shijian`,`member`,`source`,`sort`,`censor`,`addtime`,`contents`) VALUES (null,'$_POST[name]','$_POST[fenlei]','$uid','1','1','2', '$url', '$pic','0','0','0','0','1','$time','$_POST[contents]')";
dbinsert(se2nr,$type);
echo msglayerurl("视频添加成功！",8,"/user/user_video_list.php");
exit;
}else{
//$type="money=money-1 where id='$uid'";
//upalldt(ubouser,$type);
if (empty($url))
{$url=$url2;}
$type="trends=trends+1 where id=".$uid;
upalldt(ubouser,$type);
$type="(`id`, `name`, `fenlei`,`uid`,`status`,`cishu`,`tuijian`,`url`,`pic`,`shijian`,`member`,`source`,`sort`,`censor`,`addtime`,`contents`) VALUES (null,'$_POST[name]','$_POST[fenlei]','$uid','1','1','2', '$url', '$pic','0','0','0','0','1','$time','$_POST[contents]')";
dbinsert(se2nr,$type);
echo msglayerurl("视频上传成功！",8,"/user/user_video_list.php");
exit;
}
}else{
if (empty($name)){
echo msglayer("填写视频名称！",8);
exit;
}
if (empty($url)){
echo msglayer("上传视频文件！",8);
exit;
}else if($url2_t==7){
echo msglayer("上传视频文件！",8);
exit;
}
if (empty($pic) ){
echo msglayer("上传视频图片！",8);
exit;
}else if($pic2_t==7){
echo msglayer("上传视频文件！",8);
exit;
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-视频发布</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script type="text/javascript" src="/dist/webuploader.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
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
.a-upload {
    padding: 5px 5px;
    height: 26px;
    line-height: 26px;
    position: relative;
    cursor: pointer;
    color: #888;
    background: #fff;
    *background: #fafafa;
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">发布视频</i>
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
<a href="user_video_add.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">发布视频</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_video_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">视频管理</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%;"> 
<form method="post" action="" style="padding:0 10px;" target="msgubotj" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td  height="15" width="30%" ></td>
<td width="70%"></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">视频名称：</td>
  <td><input name="name" type="text" id="name" value="" class="make_resume_input" style="width:90%;margin-bottom: 0;"></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">视频类型：</td>
  <td valign="middle"><select name="fenlei" style="width:150px;padding:4px 0px 4px 6px; height:32px; line-height:24px; border:none;border:1px solid #d2d2d2;-moz-appearance: none;appearance:none;-webkit-appearance:none; background:url(/img/shop_icon.png) no-repeat 104% -206px #fff; color:#222; border-radius:3px; font-size:14px;background-position:130px -206px!important;margin:0px;">
<?php
$query = mysql_query("SELECT * FROM se2fl  ");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>"><?php echo $a[name]?></option>
<?php }?>
</select></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">上传图片：</td>
  <td><input name="fm_file" type="file" value="浏览" style="width:90%;" class="a-upload"><input type="hidden" name="MAX_FILE_SIZE" value="2000000"><input type="hidden" name="id" value="img_<?php echo $id?><?php echo $id?>"><input name="url" id="url" type="hidden"></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">外部图片：</td>
  <td><input name="pic2" type="text" class="make_resume_input" id="pic2" style="width:90%;margin-bottom: 0;" value="http://"></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">上传视频：</td>
  <td><div id="uploader" class="wu-example">
    <!--用来存放文件信息-->
    <div id="thelist" class="uploader-list"></div>
    <div class="btns">
        <div id="picker">选择文件</div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
    </div>
</div></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">外部视频：</td>
  <td><input name="url2" type="text" class="make_resume_input" id="url2" style="width:90%;margin-bottom: 0;" value="http://"></td>
</tr>
<tr>
  <td height="46" align="right" valign="middle">付费观看：</td>
  <td><input name="money" type="text" id="money" onkeyup='this.value=this.value.replace(/\D/gi,"")' value="0" class="make_resume_input" style="width:80%;margin-bottom: 0;"> 元</td>
</tr>
<tr>
<td align="right" valign="top" style="padding-top:6px;">视频介绍：</td>
<td><textarea name="content" class="make_resume_input" id="content" style="width:90%; height:100px; margin-top:3px;resize: none;"></textarea></td>
</tr>

<tr>
<td height="50" colspan="2" align="center" valign="middle">
  <input name="add" type="hidden" value="确定发布">
  <button type="submit" id="submit" class="oy-btn oy-btn-lg">确定发布</button></td>
</tr>
</tbody></table>
</form>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
