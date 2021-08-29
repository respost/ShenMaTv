<?php
$page=intval($_GET["page"]);
$playid=$_GET["playid"];
$userid=$_COOKIE[uid];
$sz="where id='1'";
$shezhi=queryall(se2wz,$sz);
$iseveryday=$shezhi[iseveryday];
$apache=$shezhi[apache];
$pull=$shezhi[pull];
if ($playid)
{
$rfr=$_SERVER['HTTP_REFERER'];//来源
$isrfr=substr_count($rfr,'?');
$ispage1=substr_count($rfr,'&page');
$ispage2=substr_count($rfr,'?page');
if ($ispage1==1)
{
$current=$rfr."#";
preg_match('/page=(.*?)#/',$current,$result);
$thnr=$result[1];
$rfr=str_replace("&page=".$thnr,"",$rfr); 
}elseif ($ispage2==1){
$current=$rfr."#";
preg_match('/page=(.*?)#/',$current,$result);
$thnr=$result[1];
$rfr=str_replace("?page=".$thnr,"",$rfr); 
}
if ($isrfr==1 && $ispage1==0 && $ispage2==1 )
{
$rfr=$rfr."?page=".$page;
}
elseif ($ispage2==1)
{
$rfr=$rfr."&page=".$page;
}
elseif ($isrfr==1)
{
$rfr=$rfr."&page=".$page;
}
else
{
$rfr=$rfr."?page=".$page;
}
setcookie("ulr",$rfr,time()+3600*24,"/");
$sk=$shezhi[sk];
$youke=$shezhi[youke];
$pthy=$shezhi[pthy];
$viphy=$shezhi[viphy];
if ($apache==1)
{$play=str_replace(".php","",$play); }
if ($iseveryday==2)
{
if ($apache==1)
{header('Location: '.$play.'/'.$playid.'.html');}
else
{header('Location: '.$play.'?playid='.$playid.'&ly=ubosk');}
exit;  
}else{
if (empty($userid))
{
$ip=$_SERVER["REMOTE_ADDR"];
$time=time();
if($iseveryday==0){$mt="今日";$tx="今日观看次数已用完";}elseif($iseveryday==1){$mt="全部";$tx="全部观看次数已用完";}
$type="where ip='$ip'";
$user=queryall(uboip,$type);
if ($user)
{
$cishu=$user[cs];
if($cishu<1)
{
echo msglayerurl("游客仅可观看".$youke."次！",8,"/user/reg.php");
exit;
}
$cishu=$cishu-1;
$iseveryday=$shezhi[iseveryday];
$today=$user[today];
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
if($iseveryday==0)
{
if (($today>$settr3) && ($today<$settr4))
{
$type="cs='$cishu' where ip='$ip'";
upalldt(uboip,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
else
{
$youke=$youke-1;
$type="cs='$youke',today='$time' where ip='$ip'";
upalldt(uboip,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
}elseif ($iseveryday==1){
$today=$user[today];
if ($today==0)
{
$youke=$youke-1;
$type="cs='$youke',today='$time' where ip='$ip'";
upalldt(uboip,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$youke."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$youke."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
else
{
$type="cs='$cishu' where ip='$ip'";
upalldt(uboip,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
}
}
else
{
$youke=$youke-1;
$type="(`id`, `ip`, `cs`, `today`) VALUES (null,'$ip','$youke','$time')"; 
dbinsert(uboip,$type);
}
}
if ($userid)
{
$iseveryday=$shezhi[iseveryday];
$type="where userid='$userid'";
$user=queryall(ubouser,$type);
$views=$user[views];
$hylx=$user[hylx];
$endtime=$user[endtime];
$time=time();
if($hylx>0 && $endtime>$time){$hylx=1;$hymc="VIP会员";}else{$hylx=0;$hymc="普通会员";}
if($iseveryday==0){$mt="今日";$tx="今日观看次数已用完";}elseif($iseveryday==1){$mt="全部";$tx="全部观看次数已用完";}
if ($hylx>0){$ckcs=$viphy;}elseif ($hylx==0){$ckcs=$pthy;}else{$ckcs=$youke;}
$views=$views-1;
if($iseveryday==0)
{
$today=$user[today];
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
if (($today>$settr3) && ($today<$settr4))
{

if($views<0)
{
echo msglayer("".$tx."！",8);
exit;
}

$type="views='$views' where userid='$userid'";
upalldt(ubouser,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$views."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$views."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
else
{
if ($hylx>0){$cishu=$viphy;}elseif ($hylx==0){$cishu=$pthy;}else{$cishu=$youke;}
$cishu=$cishu-1;
$type="views='$cishu',today='$time' where userid='$userid'";
upalldt(ubouser,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
}
elseif($iseveryday==1)
{

$today=$user[today];
if ($today==0)
{
if ($hylx>0){$cishu=$viphy;}elseif ($hylx==0){$cishu=$pthy;}else{$cishu=$youke;}
$cishu=$cishu-1;
$type="views='$cishu',today='$time' where userid='$userid'";
upalldt(ubouser,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$cishu."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}
else
{
if($views<0)
{
echo msglayer("".$tx."！",8);
exit;
}
$type="views='$views' where userid='$userid'";
upalldt(ubouser,$type);
if ($apache==1)
{echo msglayerurl($mt."观看剩余".$views."次！",8,$play."/".$playid.".html");}
else
{echo msglayerurl($mt."观看剩余".$views."次！",8,$play."?playid=".$playid."&ly=ubosk");}
exit;
}

}
}
}
}
?>