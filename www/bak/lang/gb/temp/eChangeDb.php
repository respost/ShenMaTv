<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>ѡ�����ݿ�</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function DoDrop(dbname)
{
	var ok;
	ok=confirm("ȷ��Ҫɾ�������ݿ�?");
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
    <td>λ�ã��������� -&gt; <a href="ChangeDb.php">ѡ�����ݿ�</a></td>
  </tr>
  <tr>
    <td height="25"><div align="center">���ݲ��裺<font color="#FF0000">ѡ�����ݿ�</font> 
        -&gt; ѡ��Ҫ���ݵı� -&gt; ��ʼ���� -&gt; ���</div></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr bgcolor="#0472BC"> 
    <td width="56%" height="25" bgcolor="#0472BC"> 
      <div align="center"><strong><font color="#FFFFFF">���ݿ���</font></strong></div></td>
    <td width="44%" height="25"> 
      <div align="center"><strong><font color="#FFFFFF">����</font></strong></div></td>
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
        <input type="button" name="Submit" value="��������" onclick="self.location.href='ChangeTable.php?mydbname=<?=$r[0]?>';">
        &nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value="ִ��SQL" onclick="self.location.href='DoSql.php?mydbname=<?=$r[0]?>';">
		&nbsp;&nbsp;&nbsp;<input type="button" name="Submit3" value="ɾ�����ݿ�" onclick="javascript:DoDrop('<?=$r[0]?>')">
      </div></td>
  </tr>
  <?
  }
  ?>
  <tr> 
    <td height="25" colspan="2"><form name="form1" method="post" action="phome.php">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
          <tr> 
            <td height="25"><strong><font color="#FFFFFF">�������ݿ�
              <input name="phome" type="hidden" id="phome" value="CreateDb">
              </font></strong></td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">���ݿ����� 
              <input name="mydbname" type="text" id="mydbname">
              <select name="mydbchar" id="mydbchar">
                <option value="">Ĭ�ϱ���</option>
                <?php
				echo Ebak_ReturnDbCharList('');
				?>
              </select>
              <input type="submit" name="Submit2" value="����">
            </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>