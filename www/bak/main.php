<?php
require('class/connect.php');
require('class/functions.php');
$lur=islogin();
$loginin=$lur['username'];
$rnd=$lur['rnd'];
//��һ��ʹ��
if(empty($phome_db_ver))
{
	printerror("FirstUseMsg","SetDb.php");
}
require LoadAdminTemp('emain.php');
?>