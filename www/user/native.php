<?php
//error_reporting(E_ERROR);

require_once "wxpay/WxPay.Api.php";
require_once "wxpay/WxPay.NativePay.php";
require_once "wxpay/WxPay.Data.php";
require_once 'log.php';

$notify = new NativePay();


//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */

$input = new WxPayUnifiedOrder();
$input->SetBody("微信支付");//描述
$input->SetAttach("test");//回调附加参数
$input->SetOut_trade_no($pid);//商户订单号
$input->SetTotal_fee($money*100);//支付金额
$input->SetTime_start(date("YmdHis"));//交易起始时间
$input->SetTime_expire(date("YmdHis", time() + 600));//交易结束时间
$input->SetGoods_tag("test");//商品标记
$input->SetNotify_url("http://".$wangzhi."/notify.php");//支付通知回调地址
$input->SetTrade_type("NATIVE");//交易类型
$input->SetProduct_id("123456789");
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
?>