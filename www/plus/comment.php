<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//��Դ;
$id=$_POST["id"];
$leixing=$_POST["type"];
$content=$_POST["content"];
$time=time();
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
if ($content)
{
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$name=$neirong[name];
$avatar=$neirong[avatar];
$avatar="./img/pl/".$avatar.".jpg";
if (empty($name))
{$name=$neirong[user];}
$type="(`id`, `name`, `neirong`, `shijian`, `pic`, `lanmu`, `uid`, `nrid`, `addtime`) VALUES (null,'$name','$content','0','$avatar','$leixing','$uid','$id','$time')"; 
dbinsert(ubopl,$type);
echo msglayer("���۳ɹ���",8);
exit;
}
else
{
echo msglayer("�������ݲ���Ϊ�գ�",8);
exit;
}
}

?>