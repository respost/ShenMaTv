<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$time=time();
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}
$hycs="where id='1'";
$hy=queryall(ubozf,$hycs);
$tx=$hy[tx];
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$alipayname=$user[alipayname];
$alipay=$user[alipay];
$money=$user[money];
if (empty($alipayname) || empty($alipay))
{
echo msglayerurl("�������տ��˺ţ�",8,"user_edit.php");
}
else
{
if ($money<$tx)
{echo msglayer("���С��".$tx."Ԫ���޷���ȡ��",8);}
else
{echo msglayer("�ù��ܿ����У�",8);}
}
exit;
?>