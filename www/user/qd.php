<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$yttime=time ()- ( 1  *  24  *  60  *  60 );
$zttime=date("Y-m-d",$yttime);
$tdate1=$zttime." 00:00:01";
$tdate2=$zttime." 23:59:59";
$settr1=strtotime($tdate1);
$settr2=strtotime($tdate2);
$time=time();
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$id=$neirong[id];
$money=$neirong[money];
$lxcs==$neirong[lxcs];
$dqtime=$neirong[dqtime];
$qdzs=$neirong[qdzs];
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
$hycs="where id='1'";
$hy=queryall(ubozf,$hycs);
$sign=$hy[sign];
if (($dqtime>$settr3) && ($dqtime<$settr4))
{
echo msglayer("今天已签过到了！",8);
exit;
}
else
{
$lxcs=$lxcs+1;
$money=$money+$sign;
$qdzs=$qdzs+1;
$type="lxcs='$lxcs',qdzs='$qdzs',money='$money',dqtime='$time' where id='$id'";
upalldt(ubouser,$type);
echo msglayerurl("签到成功，奖励".$sign."元！",8,"/user/");
exit;
}
?>