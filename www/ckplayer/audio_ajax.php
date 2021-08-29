<?php
error_reporting(0); 
include("../config/common.php");
include("../config/conn.php");
$id=intval($_GET["id"]);
$time=$_GET["time"];
if ($id>0 && $time)
{
$id=$_GET["id"];
$time=gmdate("i:s",$time);
$type="shijian='$time' where id='$id'";
upalldt(se2nr,$type);
}
else
{
echo "0"; 
}

?>