<?php
$userid=$_COOKIE[uid];
$time=time();
$ip=$_SERVER["REMOTE_ADDR"];
//�����ۿ�����
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
		$mt="����";
		$tx="���չۿ�����������";
	}elseif($iseveryday==1){
		$mt="ȫ��";
		$tx="ȫ���ۿ�����������";
	}
	if (empty($userid)){	
		$type="where ip='$ip'";
		$user=queryall(uboip,$type);
		if ($user){
			$cishu=$user[cs];
			if($cishu<1)
			{
			echo "<script>alert('�οͽ��ɹۿ�".$youke."�Σ�');location.href='/user/reg.php';</script>";
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
				//echo "<script>alert('".$mt."�ۿ�ʣ��".$cishu."�Σ�');</script>";
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
				//echo "<script>alert('".$mt."�ۿ�ʣ��".$youke."�Σ�');</script>";
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
			$hymc="VIP��Ա";
		}else{
			$hylx=0;
			$hymc="��ͨ��Ա";
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
				//echo "<script>alert('".$mt."�ۿ�ʣ��".$views."�Σ�');</script>";
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
				//echo "<script>alert('".$mt."�ۿ�ʣ��".$cishu."�Σ�');</script>";
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
				//echo "<script>alert('".$mt."�ۿ�ʣ��".$cishu."�Σ�');</script>";
			}else{
				if($views<0){
					echo "<script>alert('".$mt."');location.href='/';</script>";
				}
				$type="views='$views' where userid='$userid'";
				upalldt(ubouser,$type);
				//echo "<script>alert('".$mt."�ۿ�ʣ��".$views."�Σ�');</script>";
			}
		}
	}
}
?>