<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>菜單</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0">
<div align="center"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="65"> 
        <div align="center"><a href="http://www.phome.net" target="_blank"><img src="images/logo.gif" alt="Empire Soft" width="151" height="58" border="0"></a></div></td>
    </tr>
  </table>
  <br>
</div>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr> 
    <td height="30"><div align="center"><font color="#FFFFFF"><strong>帝國備份王菜單</strong></font></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"><div align="center"><a href="main.php" target="ebakmain">控制面板首頁</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"> <div align="center"><a href="SetDb.php" target="ebakmain">參數設置</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"> <div align="center"><a href="ChangeDb.php" target="ebakmain">備份數據</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"><div align="center"><a href="ListSetbak.php" target="ebakmain">管理備份設置</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"> <div align="center"><a href="ReData.php" target="ebakmain">恢復數據</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"><div align="center"><a href="ChangePath.php" target="ebakmain">管理備份目錄</a></div></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"><div align="center"><a href="RepFiletext.php" target="ebakmain">替換目錄文件</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"><div align="center"><a href="DoSql.php" target="ebakmain">執行SQL語句</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"><div align="center"><a href="doc.html" target="ebakmain">說明文檔</a></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF" onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.backgroundColor='#DBEAF5'"> <div align="center"><a href="phome.php?phome=exit" onclick="return confirm('確認要退出系統？');" target="_parent">退出系統</a></div></td>
  </tr>
</table>
</body>
</html>