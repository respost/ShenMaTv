<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$style=$_GET["style"];
if($id== null){ 
echo msglayer("抱歉，你访问的资源已经删除",8);
exit;
} 
$type="where id='$id'";
$neirong=queryall(ubozbdt,$type);
$i=rand(1,20);
if ($style)
{
$hits=$neirong[hits]+1;
$zbid=$neirong[zbid];
$type="hits='$hits',cishu=cishu+$i where id='$id'";
upalldt(ubozbdt,$type);
$type="hits=hits+1,cishu=cishu+$i where id='$zbid'";
upalldt(ubozb,$type);
}
else
{$hits=$neirong[hits];}
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