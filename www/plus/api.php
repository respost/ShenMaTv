<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$style=$_GET["style"];
if($id== null){ 
echo "<script>alert('广告ID无效!');location.href='/'</script>";
exit;
} 
$time=time();
$type="where endtime>$time and state=0 and id='$id'";
$neirong=queryall(uboad,$type);
if ($neirong)
{
$type1=$neirong[type];
$contents=$neirong[contents];
$pic=$neirong[pic];
$url=$neirong[url];
if ($type1==0)
{?>
document.write('<a href="<?php echo $url;?>" target="_blank"><img src="<?php $pic_c=substr_count($pic,'http'); if ($pic_c==1){echo $pic;}else{echo "/".$pic;}?>" width="100%" border="0"></a>');
<?php exit;}elseif ($type1==1){?>
document.write('<?php echo $contents;?>');
<?php exit;}}?>