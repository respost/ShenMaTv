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
$neirong=queryall(se2dynr,$type);
$i=rand(1,20);
if ($style)
{
$hits=$neirong[hits]+1;
$type="hits='$hits' where id='$id'";
upalldt(se2dynr,$type);
}
else
{$hits=$neirong[hits];}
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312'><SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById('hits').innerHTML='$hits';
//-->
</SCRIPT>";
if ($style)
{
echo msglayer("点赞成功！",8);
exit;
}
?>