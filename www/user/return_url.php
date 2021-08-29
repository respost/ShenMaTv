<?php
error_reporting(0); 
include("./lib/CrfApi.php");
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$array = new CrfApi();

if ($array->SignVerify($_GET) != $_GET['sign']) {
    echo 'fail-sign';
    exit;
}

$Auth = $array->getPayVerify($_GET);

if ($Auth->data->trade_no) {

    if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
        $out_trade_no = $_GET['out_trade_no'];
        $ovalue = $Auth->data->total_fee;
        //尽量做到比对金额
        if ($ovalue != $_GET['total_fee']) {
            echo 'fail-金额不对';
            exit;
        }
$userid=$_COOKIE[uid];
$money=$_COOKIE[money];
$hylx=$_COOKIE[types];
$pid=$_COOKIE[pid];
$time=time();
if ($hylx and $pid){
$info=getone("select * from ubouser WHERE userid='$userid'");
$uid=$info['id'];
$oldendtime=$info['endtime'];
$mgr=$info['user'];

if ($money and $hylx==5)
{
$ddzt=2;
$type="money=money+$money where id='$uid'";
upalldt(ubouser,$type);
$type="ddzt='$ddzt',remind='1' where pid='$pid'";
upalldt(ubotj,$type);
setcookie("money", "",time()-3600,"/");
}else{
$hy=getone("select * from ubozf WHERE id=1");
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$hytime1=$hy[hytime1];
$hytime2=$hy[hytime2];
$hytime3=$hy[hytime3];
$hytime4=$hy[hytime4];
if ($hylx==1){echo $hymc=$member1;$days=$hytime1;}elseif ($hylx==2){echo $hymc=$member2;$days=$hytime2;}elseif ($hylx==3){echo $hymc=$member3;$days=$hytime3;}elseif ($hylx==4){echo $hymc=$member4;$days=$hytime4;}
if ($oldendtime<$time)
{$oldendtime=0;}
$endtime=strtotime("".intval($days)." days",$oldendtime==0?time():$oldendtime);
$endtimexx=date("Y-m-d",strtotime($yxqx." day"))." 23:59:59";
$endtimexx=strtotime($endtime);
$type="hylx='$hylx',hymc='$hymc',kstime='$time',endtime='$endtime' where id='$uid'";
upalldt(ubouser,$type);
$ddzt=2;
$type="ddzt='$ddzt',remind='1' where pid='$pid'";
upalldt(ubotj,$type);
}
setcookie("types", "",time()-3600,"/");
setcookie("pid", "",time()-3600,"/");
echo "<script> alert('支付成功！');parent.location.href='user_pay_list.php'; </script>"; 
exit;
}else{
echo "<script> alert('支付失败！');parent.location.href='user_pay.php'; </script>"; 
}
    } else {
echo "<script> alert('支付失败！');parent.location.href='user_pay.php'; </script>"; 
    }
} else {
echo "<script> alert('验证失败！');parent.location.href='user_pay.php'; </script>"; 
}
?>