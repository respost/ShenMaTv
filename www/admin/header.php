<!--ͷ���ļ�-->
<?php 
$adminname=$_COOKIE[adminname];
$type="where id='1'";
$wangzhan=queryall(se2wz,$type);
$title=$wangzhan[title];
$keywords=$wangzhan[keywords];
$description=$wangzhan[description];
$lujing=$wangzhan[lujing];
?>
<!--ͷ��-->
<div class="layui-header header">
<a href=""><img class="logo" src="images/logo.png" alt=""></a>
<div class="user-action">
<a href="admin.php">����Ա��<?php echo $_COOKIE[adminname]?></a>
<a href="<?php echo $lujing?>" target="_blank">վ����ҳ</a>
<a href="gl.php" >����</a>
<a class="" href="quit.php?out=out">�˳�</a>
</div>
</div>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div>



