<?php
$userid=$_COOKIE[uid];
$avatar=rand(1,40);
if (empty($userid))
{
function random($length, $chars) {
$hash = '';
$max = strlen($chars) - 1;
for($i = 0; $i < $length; $i++) {
$hash .= $chars[mt_rand(0, $max)];
}
return $hash;
}
$username=random(10, '0123456789');
$userid=random(10, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
$user=getone("select * from ubouser WHERE user='".$username."' and userid='".$userid."'");
if(empty($user))
{
$newpass="0";
$time=time();
$ip=$_SERVER["REMOTE_ADDR"];
$distributor=$_GET["dt"];
if ($distributor){
$jilu=getone("select * from ubofx WHERE promo='".$distributor."'");
$fxuid=$jilu[uid];
$fx_uid_1=intval($jilu[fx_uid_1]);
$fx_uid_2=intval($jilu[fx_uid_2]);
$fx_uid_3=intval($jilu[fx_uid_3]);
$fx_uid=$fx_uid_1+$fx_uid_2+$fx_uid_3;
if ($fx_uid==0)
{
$fx_uid_1=$fxuid;
$fx_uid_2=0;
$fx_uid_3=0;
}
}
if ($isgive==1)
{
$hylx=5;
$endtime=date("Y-m-d",time())." ".date('H:i:s',strtotime("".$givetime." minute"));
$endtime=strtotime($endtime);
if (empty($fxuid))
{
$fxuid=0;
$fx_uid_1=0;
$fx_uid_2=0;
$fx_uid_3=0;
}
$type="(`id`, `user`, `pass`, `userid`, `avatar`, `ip`, `zctime`, `hylx`, `kstime`, `endtime`, `fx_uid_1`, `fx_uid_2`, `fx_uid_3`) VALUES (null,'$username','$newpass','$userid','$avatar','$ip','$time','$hylx','$time','$endtime','$fx_uid_1','$fx_uid_2','$fx_uid_3')"; 
}
else
{
$type="(`id`, `user`, `pass`, `userid`, `avatar`, `ip`, `zctime`, `fx_uid_1`, `fx_uid_2`, `fx_uid_3`) VALUES (null,'$username','$newpass','$userid','$avatar','$ip','$time','$fx_uid_1','$fx_uid_2','$fx_uid_3')"; 
}
dbinsert(ubouser,$type);
}
setcookie("uid",$userid,time()+3600*24*365*3);
$promo=$_GET["url"];
if ($promo){
$jilu=getone("select * from ubotg WHERE promo='".$promo."'");
if ($jilu)
{
$id=$jilu[id];
$uid=$jilu[uid];
$frequency=$jilu[frequency];
$today=$jilu[renew];
$cash=$jilu[money];
$url=$_SERVER['HTTP_REFERER'];
$agent=$_SERVER['HTTP_USER_AGENT']; 
$jlcx=getone("select * from ubotgjl WHERE uid=".$uid." and ip='".$ip."'");
if (empty($jlcx))
{
$tdate2=date("Y-m-d",strtotime("+1 day"))." 00:00:01";
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr2=strtotime($tdate2);
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
if ($today<$settr4)
{
$type="frequency='5',renew='$settr2' where id=".$id;
upalldt(ubotg,$type);
$frequency=5;
}
if ($frequency>0)
{
if ($cash<27)
{
$type="money=money+1,people=people+1,frequency=frequency-1 where id=".$id;
}else{
$type="money=money-27,people=people+1,frequency=frequency-1,consume=consume+28,liberal=liberal+1,fatalism=fatalism+30 where id=".$id;
}
upalldt(ubotg,$type);
$money=1;
}else{$money=0;}
$type="(`id`, `uid`, `promo`, `url`, `browser`, `ip`, `user`, `money`,`addtime`) VALUES (null,'$uid','$promo','$url','$agent','$ip','$username','$money','$time')"; 
dbinsert(ubotgjl,$type);
if ($cash>26 && $frequency>0)
{
$info=getone("select * from ubouser WHERE id='$uid'");
$uid=$info['id'];
$oldendtime=$info['endtime'];
if ($oldendtime<$time)
{$oldendtime=0;}
$endtime=strtotime("30 days",$oldendtime==0?time():$oldendtime);
$type="hylx='1',hymc='VIP»áÔ±',kstime='$time',endtime='$endtime' where id='$uid'";
upalldt(ubouser,$type);
}
}
}
}
}
else
{
$user=getone("select * from ubouser WHERE userid='".$userid."'");
if(empty($user))
{
$username=random(10, '0123456789');
$newpass="0";
$time=time();
$ip=$_SERVER["REMOTE_ADDR"];
if (empty($fxuid))
{
$fxuid=0;
$fx_uid_1=0;
$fx_uid_2=0;
$fx_uid_3=0;
}
if ($isgive==1)
{
$hylx=5;
$endtime=date("Y-m-d",time())." ".date('H:i:s',strtotime("".$givetime." minute"));
$endtime=strtotime($endtime);
$type="(`id`, `user`, `pass`, `userid`, `avatar`, `ip`, `zctime`, `hylx`, `kstime`, `endtime`, `fx_uid_1`, `fx_uid_2`, `fx_uid_3`) VALUES (null,'$username','$newpass','$userid','$avatar','$ip','$time','$hylx','$time','$endtime','$fx_uid_1','$fx_uid_2','$fx_uid_3')";  
}
else
{
$type="(`id`, `user`, `pass`, `userid`, `avatar`, `ip`, `zctime`, `fx_uid_1`, `fx_uid_2`, `fx_uid_3`) VALUES (null,'$username','$newpass','$userid','$avatar','$ip','$time','$fx_uid_1','$fx_uid_2','$fx_uid_3')"; 
}
dbinsert(ubouser,$type);
}
}
?>