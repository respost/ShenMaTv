<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!');location.href='index.php'</script>";
exit;
}
$time=time();
$neirong=getone("select * from ubotj where remind=1 order by id asc");
if ($neirong)
{
$id=$neirong[id];
$hy=getone("select * from ubouser WHERE id=".$neirong[uid]);
$name=$hy['user'];
$leixing=$neirong[leixing];
$ddzt=$neirong[ddzt];
if ($leixing==1){$lxmc="月度会员";}elseif ($leixing==2){$lxmc="季度会员";}elseif ($leixing==3){$lxmc="半年会员";}elseif ($leixing==4){$lxmc="全年会员";}else{$lxmc="金币充值";}
if ($ddzt==0){$ztmc="未支付";}elseif ($ddzt==1){$ztmc="已支付";}elseif ($ddzt==2){$ztmc="开通成功";}elseif ($ddzt==3){$ztmc="开通失败";}
$contents=$name.",".$lxmc.",".$ztmc;
$type="remind='0' where id='$id'";
upalldt(ubotj,$type);
$contents=iconv('gb2312','utf-8',$contents);
echo $contents;
exit;
}
?>