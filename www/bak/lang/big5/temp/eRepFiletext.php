<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�����ؿ���󤺮e</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G<a href="RepFiletext.php">�����ؿ���󤺮e</a></td>
  </tr>
</table>
<form name="ebakrepfiletext" method="post" action="phome.php" onsubmit="return confirm('�T�{�n�����H');">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td width="34%" height="25"><strong><font color="#FFFFFF">�����ؿ���󤺮e</font></strong> 
        <input name="phome" type="hidden" id="phome" value="RepPathFiletext"></td>
      <td width="66%" height="25">&nbsp;</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�����ؿ��G</td>
      <td height="25"> 
        <?=$bakpath?>
        / 
        <input name="mypath" type="text" id="mypath" value="<?=$mypath?>" size="38"> 
        <input type="button" name="Submit2" value="��ܥؿ�" onclick="javascript:window.open('ChangePath.php?change=1&toform=ebakrepfiletext','','width=750,height=500,scrollbars=yes');"></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�N�r�šG<br> <br> <font color="#666666">(�Y�O���h�����A�i�Ρu*�v��ܥ��N�r��) 
        </font></td>
      <td height="25"><textarea name="oldword" cols="70" rows="8" id="oldword"></textarea> 
      </td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25" valign="top">�������G</td>
      <td height="25"><textarea name="newword" cols="70" rows="8" id="newword"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25">�ﶵ�G</td>
      <td height="25"><input name="dozz" type="checkbox" id="dozz" value="1">
        ���h����</td>
    </tr>
    <tr bgcolor="#FFFFFF"> 
      <td height="25"> <div align="left"> </div>
        
      </td>
      <td height="25"><input type="submit" name="Submit" value="�}�l����">&nbsp;&nbsp;
        <input type="reset" name="Submit3" value="���m"> </td>
    </tr>
  </table>
</form>
</body>
</html>