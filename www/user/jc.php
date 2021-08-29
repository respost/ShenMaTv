<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$name=$_GET["name"];
$username=$_GET["username"];
$email=$_GET["email"];
$tel=$_GET["tel"];
if ($username ||$email||$tel){ 
if ($username)
{
$user=getone("select * from ubouser WHERE user='".$username."'");
}
elseif($email)
{
$user=getone("select * from ubouser WHERE email='".$email."'");
}
elseif($tel)
{
$user=getone("select * from ubouser WHERE tel='".$tel."'");
}

if(empty($user))
{
//echo msglayer("可以注册！",8);
exit;
}
else
{
echo msglayer($name."已被占用！",8);
exit;
}
} 
?>