<?php
error_reporting(0); 
include("./lib/CrfApi.php");
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
function random($length, $chars) {
$hash = '';
$max = strlen($chars) - 1;
for($i = 0; $i < $length; $i++) {
$hash .= $chars[mt_rand(0, $max)];
}
return $hash;
}
$money = intval($_POST['money']);
if ($money>0)
{
$fee = $money;
$id = "5";
}
else
{
$fee = intval($_POST['fee']);
$id = intval($_POST[id]);
}
$type = $_POST['type'];
$uid = intval($_POST[uid]);
$pid=random(10, '0123456789');
$ddzt=0;
$time=time();
if ($fee>0 and $uid>0 )
{
if ($type=="Wechatnative"){$pay="1";}elseif ($type=="Alipay"){$pay="2";}else{$pay="3";}
$sql="(`id`, `pid`, `uid`, `money`, `leixing`, `ddzt`, `zffs`, `addtime`,`remind`) VALUES (null,'$pid','$uid','$fee','$id','$ddzt','$pay','$time','1')"; 
dbinsert(ubotj,$sql);
if ($money>0)
{setcookie("money",$money,time()+600,"/");}
setcookie("types",$id,time()+600,"/");
setcookie("pid",$pid,time()+600,"/");
$data = array(
    'service' => 'Pay.Request',
    'type' => $type, //ͨ��֧�������ӿڻ�ȡ
    'charset' => 'gb2312', //����
    'total_fee' => $fee, //���
    'out_trade_no' =>  date('YmdHis') . time(), //�̻�������,��С��16λ
    'common_param' => '������Ա', //�̻����ݣ�ԭ������
    'notify_url' => 'http://m.smdyw.cn/user/notify_url.php', //֪ͨ��ַ,���ܴ��κβ���
    'return_url' => 'http://m.smdyw.cn/user/return_url.php',
    'subject' => time(), //����
    'body' => time(), //����
);

$array = new CrfApi();
echo $array->HpayBuildForm($data);
exit;
}else{
echo "<script> alert('��������ʧ�ܣ�');parent.location.href='user_pay.php'; </script>"; 
exit;
}
?>