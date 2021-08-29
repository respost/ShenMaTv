<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//来源;
$the_host = $_SERVER['HTTP_HOST'];//取得当前域名
$url=str_replace($the_host,"",$url);
$url=str_replace("http:///","",$url);
$id=intval($_GET["id"]);
$leixing=intval($_GET["type"]);
$price=intval($_GET["price"]);
if ($price==0)
{$price=1;}
if ($leixing==8)
{$state=1;}else{$state=0;}
$time=time();
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}
if ($state==1)
{
$row2=getone("select * from ubozb WHERE id='".$id."'");
$room=intval($row2['room']);
$enroll=intval($row2['enroll']);
if ($enroll>=$room){
echo msglayerurl("房间已满！",8,"/perform_list.php");
exit;
}
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$user=$neirong[user];
$userid=$neirong[userid];
$avatar=$neirong[avatar];
$money=$neirong[money];
if ($money>=1)
{
$row=getone("select * from uboxfjl WHERE type='".$leixing."' and uid='".$uid."' and zyid='".$id."'");
if (empty($row))
{
$type="(`id`, `uid`, `zyid`, `type`, `state`, `url`, `userid`, `money`, `user`, `addtime`) VALUES (null,'$uid','$id','$leixing','$state','$url','$userid','$price','$user','$time')"; 
dbinsert(uboxfjl,$type);

$type="money=money-$price where id='$uid'";
upalldt(ubouser,$type);
if ($state==1)
{
$row=getone("select * from ubozb WHERE id='".$id."'");
$room=intval($row[room]);
$room_j=intval($row[room])-1;
$enroll=intval($row[enroll]);
$xcstate=intval($row[xcstate]);
if ($enroll>=$room_j)
{$isstate=1;$surplus=$room;}else{
if ($xcstate==1)
{$isstate=1;$surplus=0;}else{$isstate=0;$surplus=0;}
}
if ($xcstate==2)
{$isstate=2;$surplus=0;}
$type="enroll=enroll+1, xcstate=$isstate,surplus=$surplus where id='$id'";
upalldt(ubozb,$type);
}
echo msglayerurl("购买成功！",8,"/"."$url");
exit;
}
else
 {
echo msglayer("您已经购买过了！",8);
exit;
 }
}
else
{
echo msglayerurl("余额不足，请先充值！",8,"/user/user_gold.php");
exit;
}
?>