<?php
require('class/connect.php');
//------------------------------------------------------取得随机数
function domake_password($pw_length)
{
$low_ascii_bound=48;
$upper_ascii_bound=57;
$notuse=array(58,59,60,61,62,63,64,73,79,91,92,93,94,95,96,108,111);
while($i<$pw_length)
{mt_srand((double)microtime()*1000000);
$randnum=mt_rand($low_ascii_bound,$upper_ascii_bound);
if(!in_array($randnum,$notuse))
{$password1=$password1.chr($randnum);
$i++;
}
}
return $password1;
}
//------------------------------------------------------显示验证码
function ShowKey()
{
$key=strtolower(domake_password(4));
$set=esetcookie("checkkey",$key);
	//是否支持gd库
if (function_exists("imagejpeg")) {
   header ("Content-type: image/jpeg");
   $img=imagecreate(69,20);
   $black=imagecolorallocate($img,255,255,255);
   $gray=imagecolorallocate($img,102,102,102);
   imagefill($img,0,0,$gray);
   imagestring($img,3,14,3,$key,$black);
   imagejpeg($img);
   imagedestroy($img);
}
elseif (function_exists("imagegif")) {
   header ("Content-type: image/gif");
   $img=imagecreate(69,20);
   $black=imagecolorallocate($img,255,255,255);
   $gray=imagecolorallocate($img,102,102,102);
   imagefill($img,0,0,$gray);
   imagestring($img,3,14,3,$key,$black);
   imagegif($img);
   imagedestroy($img);
}
elseif (function_exists("imagepng")) {
	header ("Content-type: image/png");
   $img=imagecreate(69,20);
   $black=imagecolorallocate($img,255,255,255);
   $gray=imagecolorallocate($img,102,102,102);
   imagefill($img,0,0,$gray);
   imagestring($img,3,14,3,$key,$black);
   imagepng($img);
   imagedestroy($img);
}
elseif (function_exists("imagewbmp")) {
	header ("Content-type: image/vnd.wap.wbmp");
   $img=imagecreate(69,20);
   $black=imagecolorallocate($img,255,255,255);
   $gray=imagecolorallocate($img,102,102,102);
   imagefill($img,0,0,$gray);
   imagestring($img,3,14,3,$key,$black);
   imagewbmp($img);
   imagedestroy($img);
}
else {
	$set=esetcookie("checkkey","ebak");
	@include("class/functions.php");
	echo ReadFiletext("images/ebak.jpg");
}
}
ShowKey();
?>