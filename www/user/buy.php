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
<title>�����ֵ��</title>
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
	if(strpos($name,'�¶�')){
		$name="10Ԫ��ֵ��";
	}elseif(strpos($name,'����')){
		$name="30Ԫ��ֵ��";
	}elseif(strpos($name,'����')){
		$name="50Ԫ��ֵ��";
	}elseif(strpos($name,'���')){
		$name="100Ԫ��ֵ��";
	}
?>
<tr>
<td width="50%" height="50" align="right"><?php echo $name?>��</td>
<td height="50"><a href="<?php echo $a[link]?>" target="_blank" ><button class="oy-btn oy-btn-normal">�������</button></a></td>
</tr>
<?php }?>
</tbody></table>
</body>
</html>
