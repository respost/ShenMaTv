<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!');location.href='index.php'</script>";
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
if ($leixing==1){$lxmc="�¶Ȼ�Ա";}elseif ($leixing==2){$lxmc="���Ȼ�Ա";}elseif ($leixing==3){$lxmc="�����Ա";}elseif ($leixing==4){$lxmc="ȫ���Ա";}else{$lxmc="��ҳ�ֵ";}
if ($ddzt==0){$ztmc="δ֧��";}elseif ($ddzt==1){$ztmc="��֧��";}elseif ($ddzt==2){$ztmc="��ͨ�ɹ�";}elseif ($ddzt==3){$ztmc="��ͨʧ��";}
$contents=$name.",".$lxmc.",".$ztmc;
$type="remind='0' where id='$id'";
upalldt(ubotj,$type);
$contents=iconv('gb2312','utf-8',$contents);
echo $contents;
exit;
}
?>