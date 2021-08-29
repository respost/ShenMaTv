<?php
$act=$_GET[act];
if($act == 'check_weixinpay_notify'){
	if(file_exists('/data/wxpay/'.$_SESSION['wxpay_no'].'.tmp')){
		exit('1');
	}else{
		@unlink('/data/wxpay/'.$_SESSION['wxpay_no'].'.tmp');
		unset($_SESSION['wxpay_no']);
		exit('user_pay_list.php');
	}
}
?>