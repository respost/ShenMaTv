<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$id=intval($_GET["id"]);
$leixing=intval($_GET["type"]);
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$row=getone("select * from uboxfjl WHERE type='".$leixing."' and uid='".$uid."' and zyid='".$id."'");
if (empty($row))
{
$shuchu='0';
$shuchu=iconv("gbk","utf-8",$shuchu);
exit($shuchu);
}
else
{
$state=$row['state'];
if ($state=='1')
{
$row2=getone("select * from ubozb WHERE id='".$id."'");
$enroll=intval($row2['enroll']);
$xcstate=intval($row2['xcstate']);
$ptime=$row2['addtime'];
if ($xcstate==1)
{
if ($enroll==1)
{
$isstate=0;
}else{
$isstate=1;
}
$type="state=0 where uid='".$uid."' and zyid='".$id."'";
upalldt(uboxfjl,$type);
$type="enroll=enroll-1, xcstate=$isstate, cishu=cishu+1 where id='$id'";
upalldt(ubozb,$type);
$shuchu="1,".$row2['url'];
$shuchu=iconv("gbk","utf-8",$shuchu);
exit($shuchu);
}
elseif ($xcstate==2)
{
$ptime=date('H:i',$ptime);
$tdate=date("Y-m-d")." ".$ptime.":01";
$dtae=intval(strtotime($tdate));
$nexttime=date("Y-m-d")." ".date('H:i:s',strtotime("60 minute",$dtae));
$time=time();
$dtae1=strtotime($tdate);
$dtae2=strtotime($nexttime);
 if ($time>$dtae1 && $dtae2>$time )
{
$type="state=0 where uid='".$uid."' and zyid='".$id."'";
upalldt(uboxfjl,$type);
$type="enroll=enroll-1, cishu=cishu+1 where id='$id'";
upalldt(ubozb,$type);
$shuchu="4,".$row2['url'];
$shuchu=iconv("gbk","utf-8",$shuchu);
exit($shuchu);
}
else{
if ($dtae2<$time)
{
$ptime="6,".str_replace(":","点",$ptime)."分";
$ptime=iconv("gbk","utf-8",$ptime);
exit($ptime);
}else{
$ptime="5,".str_replace(":","点",$ptime)."分";
$ptime=iconv("gbk","utf-8",$ptime);
exit($ptime);
}
}
}
else
{exit('2');}
}
else
{exit('3');}
}
?>