<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$id=$_GET["id"];
$time=time();
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$user=$neirong[user];
$name=$neirong[name];
$avatar=$neirong[avatar];
$row=getone("select * from ubohbjl WHERE uid='".$uid."' and bhid='".$id."'");
if (empty($row))
{
$bao=getone("select * from ubopacket WHERE id='".$id."'");
$balance=$bao['balance'];
$surplus=$bao['surplus'];
if ($surplus>0)
{
$total=$balance;//����ܽ��    
$num=$surplus;// �ֳ�10�������֧��10�������ȡ    
$min=0.01;//ÿ�����������յ�0.01Ԫ    
if ($surplus==1)
{
$money=$balance;
$total=0;
}
else if($surplus>1)
{
$i=1;
$safe_total=($total-($num-$i)*$min)/($num-$i);//�����ȫ����    
$money=mt_rand($min*100,$safe_total*100)/100;    
$total=$total-$money;   
}
$type="balance='$total',surplus=surplus-1 where id='$id'";
upalldt(ubopacket,$type);

$type="(`id`, `uid`, `bhid`, `money`, `user`, `name`, `avatar`, `addtime`) VALUES (null,'$uid','$id','$money','$user','$name','$avatar','$time')"; 
dbinsert(ubohbjl,$type);

$type="money=money+$money where id='$uid'";
upalldt(ubouser,$type);
echo msglayerurl("��ϲ������".$money."Ԫ��",8,"user_packet.php");
exit;
}
else
 {
echo msglayer("��������꣡",8);
exit;
 }
}
else
{
echo msglayer("���Ѿ������ˣ�",8);
exit;
}
?>