<?php
if(!defined('InEmpireBak'))
{
	exit();
}
$onclickword='(���ת��ָ�����)';
$change=(int)$_GET['change'];
if($change==1)
{
	$onclickword='(���ѡ��)';
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>������Ŀ¼</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function ChangePath(pathname)
{
	opener.document.<?=$form?>.mypath.value=pathname;
	window.close();
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>λ�ã�<a href="ChangePath.php">������Ŀ¼</a>&nbsp;(���Ŀ¼��<b><?=$bakpath?></b>)</td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr bgcolor="#0472BC"> 
    <td width="42%" height="25" bgcolor="#0472BC"> <div align="center"><strong><font color="#FFFFFF">����Ŀ¼��<?=$onclickword?></font></strong></div></td>
    <td width="16%" height="25"> <div align="center"><strong><font color="#FFFFFF">�鿴˵���ļ�</font></strong></div></td>
    <td width="42%"><div align="center"><font color="#FFFFFF">����</font></div></td>
  </tr>
  <?php
  while($file=@readdir($hand))
  {
	if($file!="."&&$file!=".."&&is_dir($bakpath."/".$file))
	{
		if($change==1)
		{
			$showfile="<a href='#ebak' onclick=\"javascript:ChangePath('$file');\" title='$file'>$file</a>";
		}
		else
		{
			$showfile="<a href='phome.php?phome=PathGotoRedata&mypath=$file' title='$file'>$file</a>";
		}
  ?>
  <tr bgcolor="#DBEAF5"> 
    <td height="25"> <div align="left"><img src="images/dir.gif" width="19" height="15">&nbsp; 
        <?=$showfile?> </div></td>
    <td height="25"> <div align="center"> [<a href="<? echo $bakpath."/".$file."/readme.txt"?>" target=_blank>�鿴����˵��</a>]</div></td>
    <td><div align="center">[<a href="#ebak" onclick="window.open('phome.php?phome=DoZip&p=<?=$file?>&change=<?=$change?>','','width=350,height=160');">���������</a>]&nbsp;&nbsp;[<a href="RepFiletext.php?mypath=<?=$file?>">�滻�ļ�����</a>]&nbsp;&nbsp;[<a href="phome.php?phome=DelBakpath&path=<?=$file?>&change=<?=$change?>" onclick="return confirm('ȷ��Ҫɾ����');">ɾ��Ŀ¼</a>]</div></td>
  </tr>
  <?
     }
  }
  ?>
  <tr> 
    <td height="25" colspan="3"><font color="#666666">(˵�����������Ŀ¼�ļ��϶ཨ��ֱ�Ӵ�FTP���ر���Ŀ¼��)</font></td>
  </tr>
</table>
</body>
</html>