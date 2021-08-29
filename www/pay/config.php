<?php
error_reporting(0); 
//平台商户ID，需要更换成自己的商户ID
$uboid='2017100';
//接口密钥，需要更换成你自己的密钥，要跟后台设置的一致
$ubokey='5e69884efaa90df71ab9ba4a8d4e2ddd';
//网关地址，要更新成你所在的平台网关地址
$url="http://wxrhjc.com/pay/";
//支付成功，通知地址
$ubotzurl="http://".$_SERVER['HTTP_HOST']."/pay/ubotzurl.php";
//同步跳转地址，支付成功跳转
$ubobackurl="http://".$_SERVER['HTTP_HOST']."/pay/ubobackurl.php";

?>