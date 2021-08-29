<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$id=base64_decode($id);
$id=($id-12865379)/512;
$style=$_GET["style"];
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//来源;
$the_host = $_SERVER['HTTP_HOST'];//取得当前域名
$url=str_replace($the_host,"",$url);
$url=str_replace("http:///","",$url);
if($userid== null && $style){ 
echo msglayer("收藏失败，请先登录会员！",8);
exit;
} 
$type="where id='$id'";
$neirong=queryall(se2nr,$type);
$favorite=$neirong[favorite];
$division=$neirong[division];
$i=rand(1,20);
if ($style && $userid)
{
if ($division==1)
{
$uid=$neirong[uid];
$type="favorite=favorite+1 where id=".$uid;
upalldt(ubozb,$type);
}
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$uid=$user['id'];
$url="play.php?playid=".$id;
$scjc=getone("select * from se2sc WHERE uid='".$uid."' and url='".$url."'");
if (empty($scjc))
{
$pic=$neirong[pic];
$name=$neirong[name];
$favorite=$neirong[favorite]+1;
$time=time();
$type="favorite='$favorite' where id='$id'";
upalldt(se2nr,$type);
$type="(`id`, `name`,`uid`,`url`,`pic`,`addtime`) VALUES (null,'$name','$uid', '$url', '$pic','$time')";
dbinsert(se2sc,$type);
echo msglayer("收藏成功！",8);
}
else
{
echo msglayer("您已收藏该视频！",8);
exit;
}
}
else
{$favorite=$neirong[favorite];}
$id = ($id*512)+12865379; 
$id = base64_encode($id);
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312'><SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById('favorite_".$id."').innerHTML='$favorite';
//-->
</SCRIPT>";
?>