<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");

$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
?>
<!DOCTYPE html>
<html>
<head>
<title>购买充值卡</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<?php include_once('../include/css.php'); ?> 
<style>
</style>
</head>
<body>
<table style="width:90%;margin:0 auto;" border="0" cellpadding="5" cellspacing="5">
<tbody>
<?php
$query = mysql_query("SELECT * FROM uboterrace where small_id=0 order by sort desc");
while($a = mysql_fetch_array($query)) {
	$name=$a[name];
	if(strpos($name,'月度')){
		$name="10元充值卡";
	}elseif(strpos($name,'季度')){
		$name="30元充值卡";
	}elseif(strpos($name,'半年')){
		$name="50元充值卡";
	}elseif(strpos($name,'年度')){
		$name="100元充值卡";
	}
?>
<tr>
<td width="50%" height="50" align="right"><?php echo $name?>：</td>
<td height="50"><a href="<?php echo $a[link]?>" target="_blank" ><button class="oy-btn oy-btn-normal">点击购买</button></a></td>
</tr>
<?php }?>
</tbody></table>
</body>
</html>
