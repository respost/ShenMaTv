<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$division=intval($_GET["division"]);
$style=$_GET["style"];
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//��Դ;
$the_host = $_SERVER['HTTP_HOST'];//ȡ�õ�ǰ����
$url=str_replace($the_host,"",$url);
$url=str_replace("http:///","",$url);
if($userid== null && $style){ 
echo msglayer("��עʧ�ܣ����ȵ�¼��Ա��",8);
exit;
} 
$type="where id=".$id;
if ($division==1){
$neirong=queryall(ubozb,$type);
}else{
$neirong=queryall(ubouser,$type);
}
$concern=$neirong[concern];
if ($style && $userid)
{
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$uid=$user['id'];
$url="vod_list.php?uid=".$id;
$scjc=getone("select * from se2sc WHERE uid='".$uid."' and url='".$url."'");
if (empty($scjc))
{
$name=$neirong['name'];
if (empty($name))
{$name=$neirong['user'];}
$concern=$concern+1;
$time=time();
if ($division==1){
$pic="/".$neirong[pic];
$type="concern=concern+1 where id=".$id;
upalldt(ubozb,$type);
}else{
$pic="/img/pl/".$neirong[avatar].".jpg";
$type="concern=concern+1 where id=".$id;
upalldt(ubouser,$type);
}
$type="(`id`, `name`,`uid`,`zbid`,`url`,`pic`,`addtime`) VALUES (null,'$name','$uid','$id', '$url', '$pic','$time')";
dbinsert(se2sc,$type);
echo msglayer("��ע�ɹ���",8);
}
else
{
echo msglayer("���ѹ�ע�ˣ�",8);
exit;
}
}
else
{$concern=$neirong[concern];}
echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312'><SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById('concern_".$id."').innerHTML='$concern';
parent.document.getElementById('gzzt_".$id."').innerHTML='�� �ѹ�ע';
//-->
</SCRIPT>";
?>