<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��ܼƾڮw</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function DoDrop(dbname)
{
	var ok;
	ok=confirm("�T�{�n�R�����ƾڮw?");
	if(ok)
	{
		self.location.href='phome.php?phome=DropDb&mydbname='+dbname;
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G�ƥ��ƾ� -&gt; <a href="ChangeDb.php">��ܼƾڮw</a></td>
  </tr>
  <tr>
    <td height="25"><div align="center">�ƥ��B�J�G<font color="#FF0000">��ܼƾڮw</font> 
        -&gt; ��ܭn�ƥ����� -&gt; �}�l�ƥ� -&gt; ����</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr bgcolor="#0472BC"> 
    <td width="56%" height="25" bgcolor="#0472BC"> 
      <div align="center"><strong><font color="#FFFFFF">�ƾڮw�W</font></strong></div></td>
    <td width="44%" height="25"> 
      <div align="center"><strong><font color="#FFFFFF">�ƥ�</font></strong></div></td>
  </tr>
  <?php
  $i=0;
  while($r=$empire->fetch($sql))
  {
	$i++;
	if($i%2==0)
	{
		$bgcolor="#DBEAF5";
	}
	else
	{
		$bgcolor="#ffffff";
	}
  ?>
  <tr bgcolor="<?=$bgcolor?>"> 
    <td height="25"> 
      <div align="center"><?=$r[0]?></div></td>
    <td height="25"> 
      <div align="center"> 
        <input type="button" name="Submit" value="�ƥ��ƾ�" onclick="self.location.href='ChangeTable.php?mydbname=<?=$r[0]?>';">
        &nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value="����SQL" onclick="self.location.href='DoSql.php?mydbname=<?=$r[0]?>';">
		&nbsp;&nbsp;&nbsp;<input type="button" name="Submit3" value="�R���ƾڮw" onclick="javascript:DoDrop('<?=$r[0]?>')">
      </div></td>
  </tr>
  <?
  }
  ?>
  <tr> 
    <td height="25" colspan="2"><form name="form1" method="post" action="phome.php">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
          <tr> 
            <td height="25"><strong><font color="#FFFFFF">�إ߼ƾڮw
              <input name="phome" type="hidden" id="phome" value="CreateDb">
              </font></strong></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">�ƾڮw�W�G 
              <input name="mydbname" type="text" id="mydbname">
              <select name="mydbchar" id="mydbchar">
                <option value="">�q�{�s�X</option>
                <?php
				echo Ebak_ReturnDbCharList('');
				?>
              </select>
              <input type="submit" name="Submit2" value="�إ�">
            </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>