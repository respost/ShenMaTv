<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$style=$_GET["style"];
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//��Դ;
$the_host = $_SERVER['HTTP_HOST'];//ȡ�õ�ǰ����
$url=str_replace($the_host,"",$url);
$url=str_replace("http:///","",$url);
if($userid== null && $style){ 
echo msglayer("�ղ�ʧ�ܣ����ȵ�¼��Ա��",8);
exit;
} 
$type="where id='$id'";
$neirong=queryall(se2xszj,$type);
$favorite=$neirong[favorite];
$i=rand(1,20);
if ($style && $userid)
{
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$uid=$user['id'];
$scjc=getone("select * from se2sc WHERE uid='".$uid."' and url='".$url."'");
if (empty($scjc))
{
$xsid=$neirong[xsid];
$xs=getone("select * from se2xs WHERE id='".$xsid."'");
$pic=$xs[pic];
$name=$neirong[name];
$favorite=$neirong[favorite]+1;
$time=time();
$type="favorite='$favorite' where id='$id'";
upalldt(se2xszj,$type);
$type="(`id`, `name`,`uid`,`url`,`pic`,`addtime`) VALUES (null,'$name','$uid', '$url', '$pic','$time')";
dbinsert(se2sc,$type);
echo msglayer("�ղسɹ���",8);
}
else
{
echo msglayer("�����ղظ��½ڣ�",8);
exit;
}
}
else
{$favorite=$neirong[favorite];}
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312'><SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById('favorite').innerHTML='$favorite';
//-->
</SCRIPT>";
?>