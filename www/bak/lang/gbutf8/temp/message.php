<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>信息提示</title>
<link href="<?=$a?>images/css.css" rel="stylesheet" type="text/css">
<SCRIPT language=javascript>
var secs=3;//3秒
for(i=1;i<=secs;i++) 
{ window.setTimeout("update(" + i + ")", i * 1000);} 
function update(num) 
{ 
if(num == secs) 
{ <?=$gotourl_js?>; } 
else 
{ } 
}
</SCRIPT>
</head>

<body>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr> 
    <td height="25"><div align="center"><strong><font color="#FFFFFF">信息提示</font></strong></div></td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="80"> 
      <div align="center">
	  <br>
        <b><?=$error?></b>
        <br>
        <br><a href="<?=$gotourl?>">如果您的浏览器没有自动跳转，请点击这里</a>
<br><br>
	  </div></td>
  </tr>
</table>
</body>
</html>