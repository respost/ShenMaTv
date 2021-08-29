<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$ks=$_REQUEST[ks]; 
$sj=intval($_REQUEST[sj]); 
$ms=intval($_REQUEST[ms]); 
if($ks && $ks=="1"){

if ($sj==1){$v3="se2dynr";}elseif ($sj==2){$v3="se2nr";}elseif ($sj==3){$v3="se2dsjnr";}
if ($ms==1){$v1="0";$v2="1";}elseif ($ms==2){$v1="1";$v2="0";}
$type="member='$v1' where member='$v2'";
upalldt($v3,$type);
echo "<script>alert('转换成功！')</script><script>location.href='zh.php'</script>";
exit; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>
<div style="margin:0 auto; font-size:16px; text-align:center; line-height:50px;">数据转换</div>
<div style="margin:0 auto;text-align:center; line-height:50px; margin-top:20px;"><form action="" method="post"><input name="ks" type="hidden" id="ks" value="1" />
   <label>
    <select name="sj" size="1" >
      <option value="1" selected>电影数据</option>
      <option value="2">视频数据</option>
      <option value="3">电视剧数据</option>
    </select>
    </label> <label>
    <select name="ms" size="1" >
      <option value="1" selected>会员转普通</option>
      <option value="2">普通转会员</option>
    </select>
    </label>
<input name="p" type="submit" id="p" value="开始转换" />
</form></div>

<body>
</body>
</html>
