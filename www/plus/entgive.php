<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$id=base64_decode($id);
$id=($id-12865379)/512;
$style=$_GET["style"];
if($id== null){ 
echo msglayer("抱歉，你访问的资源已经删除",8);
exit;
} 
$type="where id='$id'";
$neirong=queryall(se2nr,$type);
$i=rand(1,20);
$division=$neirong[division];
if ($style)
{
if ($division==1)
{
$uid=$neirong[uid];
$type="hits=hits+1 where id=".$uid;
upalldt(ubozb,$type);
}
$hits=$neirong[hits]+1;
$type="hits='$hits',cishu=cishu+$i where id='$id'";
upalldt(se2nr,$type);
}
else
{$hits=$neirong[hits];}
$id = ($id*512)+12865379; 
$id = base64_encode($id);
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312'><SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById('hits_".$id."').innerHTML='$hits';
//-->
</SCRIPT>";
if ($style)
{
echo msglayer("点赞成功！",8);
exit;
}
?>