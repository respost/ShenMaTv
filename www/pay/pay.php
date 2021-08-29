<?php
error_reporting(0);
include_once("config.php"); 
$agent = $_SERVER['HTTP_USER_AGENT'];
$ubomoney=$_POST["ubomoney"];//提交的支付金额
$ubopid=$_POST["ubopid"];//提交的渠道
$ubouid=$_POST["ubouid"];//提交的渠道
$userid=$_POST["userid"];//提交的用户ID
$ubodes="vip";//提交的用户等级
$ubotzurl=$ubotzurl;//通知信息
$ubobackurl=$ubobackurl;//跳转地址
if($ubopid==null){$ubopid=$uboid;}
if($ubouid==null){$ubouid=$uboid;}
$ubodingdan=date("YmdHis");//订单号
$ubostr=$uboid.$ubodingdan.$ubomoney.$ubotzurl.$ubokey;
$ubosign = md5($ubostr);//签名数据 32位小写的组合加密验证串
if (strpos($agent, 'MicroMessenger') === false) {
$pay="alipaywap";
}else{
$pay="gzh";
}
$post= array(
'uboid' =>$uboid,
'ubodingdan' =>$ubodingdan,
'ubopid' =>$ubopid,
'ubouid' =>$ubouid,
'ubodes' =>$ubodes,
'ubobz' =>$userid,
'ubomoney' =>$ubomoney,
'ubotzurl' =>$ubotzurl,
'ubobackurl' =>$ubobackurl,
'ubosign' =>$ubosign,
'pay' =>$pay
);
$postch = curl_init();
curl_setopt($postch, CURLOPT_POST, 1);
curl_setopt($postch, CURLOPT_URL,$url);
curl_setopt($postch, CURLOPT_POSTFIELDS, $post);
ob_start();
curl_exec($postch);
$con = ob_get_contents() ;
ob_end_clean();
$paysj=json_decode($con, true); 
$tzurl=$paysj[payUrl];
$json_data = array ('paylink'=>$tzurl);   
echo json_encode($json_data);
?>
