<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>�滻Ŀ¼�ļ�����</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�<a href="RepFiletext.php">�滻Ŀ¼�ļ�����</a></td>
  </tr>
</table>
<form name="ebakrepfiletext" method="post" action="phome.php" onsubmit="return confirm('ȷ��Ҫ�滻��');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td width="34%" height="25"><strong><font color="#FFFFFF">�滻Ŀ¼�ļ�����</font></strong> 
        <input name="phome" type="hidden" id="phome" value="RepPathFiletext"></td>
      <td width="66%" height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�滻Ŀ¼��</td>
      <td height="25"> 
        <?=$bakpath?>
        / 
        <input name="mypath" type="text" id="mypath" value="<?=$mypath?>" size="38"> 
        <input type="button" name="Submit2" value="ѡ��Ŀ¼" onclick="javascript:window.open('ChangePath.php?change=1&toform=ebakrepfiletext','','width=750,height=500,scrollbars=yes');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">���ַ���<br> <br> <font color="#666666">(���������滻�����á�*����ʾ�����ַ�) 
        </font></td>
      <td height="25"><textarea name="oldword" cols="70" rows="8" id="oldword"></textarea> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�滻Ϊ��</td>
      <td height="25"><textarea name="newword" cols="70" rows="8" id="newword"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">ѡ�</td>
      <td height="25"><input name="dozz" type="checkbox" id="dozz" value="1">
        �����滻</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="left"> </div>
        
      </td>
      <td height="25"><input type="submit" name="Submit" value="��ʼ�滻">&nbsp;&nbsp;
        <input type="reset" name="Submit3" value="����"> </td>
    </tr>
  </table>
</form>
</body>
</html>