<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=intval($_GET["id"]);
$zbid=intval($_GET["zbid"]);
$style=intval($_GET["style"]);
$division=intval($_GET["division"]);
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//��Դ;
$the_host = $_SERVER['HTTP_HOST'];//ȡ�õ�ǰ����
$url=str_replace($the_host,"",$url);
$url=str_replace("http:///","",$url);
if($userid== null && $style){ 
echo msglayer("����ʧ�ܣ����ȵ�¼��Ա��",8);
exit;
}
if ($style==1){$number=1;}elseif ($style==2){$number=5;}elseif ($style==3){$number=10;}elseif ($style==4){$number=20;}elseif ($style==5){$number=50;}
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$uid=$user['id'];
$surplus=$user[money];
//$i=rand(1,20);
if ($division==1)
{
if ($style>0 && $userid && $surplus>=$number)
{
$type="where id='$id'";
$neirong=queryall(ubozb,$type);
$money=$neirong[money];

$type="money=money-$number where id=".$uid;
upalldt(ubouser,$type);
$type="money=money+$number where id=".$id;
upalldt(ubozb,$type);
$money=$money+$number;
echo msglayer("���ͳɹ���",8);
}
else
{
echo msglayer("���㣡",8);
exit;
}
}
else
{
if ($style>0 && $userid && $surplus>=$number)
{
$type="where id='$id'";
$neirong=queryall(ubouser,$type);
$money=$neirong[money];

$type="money=money-$number where id=".$uid;
upalldt(ubouser,$type);
$type="money=money+$number where id=".$id;
upalldt(ubouser,$type);
$money=$money+$number;
echo msglayer("���ͳɹ���",8);
}
else
{
echo msglayer("���㣡",8);
exit;
}
}

echo "<meta http-equiv='Content-Type' content='text/html; charset=gb2312'><SCRIPT LANGUAGE=\"JavaScript\">
<!--
parent.document.getElementById('reward_".$id."').innerHTML='$money';
//-->
parent.guanbi();
</SCRIPT>";
?>