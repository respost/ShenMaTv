<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>����ѹ����</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr> 
    <td height="30"> <div align="center"><strong><font color="#FFFFFF">����ѹ����(Ŀ¼�� 
        <?=$p?>
        )</font></strong></div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF"> 
      <div align="center">[<a href="<?=$file?>">����ѹ����</a>]</div></td>
  </tr>
  <tr> 
    <td height="30" bgcolor="#FFFFFF"> 
      <div align="center">[<a href="phome.php?f=<?=$f?>&phome=DelZip" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��ѹ����</a>]</div></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFFF">
<div align="center">��<font color="#FF0000">˵������ȫ������������������ɾ��ѹ������</font>��</div></td>
  </tr>
</table>
</body>
</html>