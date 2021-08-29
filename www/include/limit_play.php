<?php
$userid=$_COOKIE[uid];
$time=time();
$ip=$_SERVER["REMOTE_ADDR"];
//减掉观看次数
$count=$_GET["count"];
if($count=="yes"){
	$sz="where id='1'";
	$shezhi=queryall(se2wz,$sz);
	$iseveryday=$shezhi[iseveryday];
	$sk=$shezhi[sk];
	$youke=$shezhi[youke];
	$pthy=$shezhi[pthy];
	$viphy=$shezhi[viphy];
	if($iseveryday==0){
		$mt="今日";
		$tx="今日观看次数已用完";
	}elseif($iseveryday==1){
		$mt="全部";
		$tx="全部观看次数已用完";
	}
	if (empty($userid)){	
		$type="where ip='$ip'";
		$user=queryall(uboip,$type);
		if ($user){
			$cishu=$user[cs];
			if($cishu<1)
			{
			echo "<script>alert('游客仅可观看".$youke."次！');location.href='/user/reg.php';</script>";
			}
			$cishu=$cishu-1;
			$today=$user[today];
			$tdate3=date("Y-m-d")." 00:00:01";
			$tdate4=date("Y-m-d")." 23:59:59";
			$settr3=strtotime($tdate3);
			$settr4=strtotime($tdate4);
			if($iseveryday==0){
				if (($today>$settr3) && ($today<$settr4)){
					$type="cs='$cishu' where ip='$ip'";
					upalldt(uboip,$type);
				}else{
					$youke=$youke-1;
					$type="cs='$youke',today='$time' where ip='$ip'";
					upalldt(uboip,$type);
				}
				//echo "<script>alert('".$mt."观看剩余".$cishu."次！');</script>";
			}elseif ($iseveryday==1){
				$today=$user[today];
				if ($today==0){
					$youke=$youke-1;
					$type="cs='$youke',today='$time' where ip='$ip'";
					upalldt(uboip,$type);
				}else{
					$type="cs='$cishu' where ip='$ip'";
					upalldt(uboip,$type);
				}
				//echo "<script>alert('".$mt."观看剩余".$youke."次！');</script>";
			}
			
		}else{
			$youke=$youke-1;
			$type="(`id`, `ip`, `cs`, `today`) VALUES (null,'$ip','$youke','$time')"; 
			dbinsert(uboip,$type);
		}
	}
	if ($userid){
		$type="where userid='$userid'";
		$user=queryall(ubouser,$type);
		$views=$user[views];
		$hylx=$user[hylx];
		$endtime=$user[endtime];
		if($hylx>0 && $endtime>$time){
			$hylx=1;
			$hymc="VIP会员";
		}else{
			$hylx=0;
			$hymc="普通会员";
		}
		if ($hylx>0){
			$ckcs=$viphy;
		}elseif ($hylx==0){
			$ckcs=$pthy;
		}else{
			$ckcs=$youke;
		}
		$views=$views-1;
		$today=$user[today];
		if($iseveryday==0){			
			$tdate3=date("Y-m-d")." 00:00:01";
			$tdate4=date("Y-m-d")." 23:59:59";
			$settr3=strtotime($tdate3);
			$settr4=strtotime($tdate4);
			if (($today>$settr3) && ($today<$settr4)){
				if($views<0)
				{
					echo "<script>alert('".$mt."');location.href='/';</script>";
				}
				$type="views='$views' where userid='$userid'";
				upalldt(ubouser,$type);
				//echo "<script>alert('".$mt."观看剩余".$views."次！');</script>";
			}else{
				if ($hylx>0){
					$cishu=$viphy;
				}elseif ($hylx==0){
					$cishu=$pthy;
				}else{
					$cishu=$youke;
				}
				$cishu=$cishu-1;
				$type="views='$cishu',today='$time' where userid='$userid'";
				upalldt(ubouser,$type);
				//echo "<script>alert('".$mt."观看剩余".$cishu."次！');</script>";
			}
		}elseif($iseveryday==1){
			if ($today==0){
				if ($hylx>0){
					$cishu=$viphy;
				}elseif ($hylx==0){
					$cishu=$pthy;
				}else{
					$cishu=$youke;
				}
				$cishu=$cishu-1;
				$type="views='$cishu',today='$time' where userid='$userid'";
				upalldt(ubouser,$type);
				//echo "<script>alert('".$mt."观看剩余".$cishu."次！');</script>";
			}else{
				if($views<0){
					echo "<script>alert('".$mt."');location.href='/';</script>";
				}
				$type="views='$views' where userid='$userid'";
				upalldt(ubouser,$type);
				//echo "<script>alert('".$mt."观看剩余".$views."次！');</script>";
			}
		}
	}
}
?>