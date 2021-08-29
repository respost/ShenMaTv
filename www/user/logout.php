<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$out= $_GET[out];
switch($out){
case 'out':
setcookie("userid", $_COOKIE[userid],time()-7300);
echo msglayerurl("会员退出成功！",8,"login.php");
exit;
}
?>
