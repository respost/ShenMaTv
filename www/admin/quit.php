<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
if($_COOKIE[adminname]==null){
echo "<script>location.href='index.php'</script>";
exit;
}
$out= $_GET[out];
switch($out){
case 'out':
setcookie("adminname", $_COOKIE[adminname],time()-7300);
echo "<script>location.href='index.php'</script>";
}
?>
