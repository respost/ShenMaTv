<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('���������ʧЧ�����µ�¼!')</script><script>location.href='index.php'</script>";
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
echo "<script>alert('ת���ɹ���')</script><script>location.href='zh.php'</script>";
exit; 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
</head>
<div style="margin:0 auto; font-size:16px; text-align:center; line-height:50px;">����ת��</div>
<div style="margin:0 auto;text-align:center; line-height:50px; margin-top:20px;"><form action="" method="post"><input name="ks" type="hidden" id="ks" value="1" />
   <label>
    <select name="sj" size="1" >
      <option value="1" selected>��Ӱ����</option>
      <option value="2">��Ƶ����</option>
      <option value="3">���Ӿ�����</option>
    </select>
    </label> <label>
    <select name="ms" size="1" >
      <option value="1" selected>��Աת��ͨ</option>
      <option value="2">��ͨת��Ա</option>
    </select>
    </label>
<input name="p" type="submit" id="p" value="��ʼת��" />
</form></div>

<body>
</body>
</html>
