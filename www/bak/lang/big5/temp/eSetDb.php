<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�ѼƳ]�m</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script>
function ChangeSet(cset){
	if(cset=="setuser")
	{
		setdb.style.display="none";
		setuser.style.display="";
		setck.style.display="none";
		//setlang.style.display="none";
		setother.style.display="none";
	}
	else if(cset=="setck")
	{
		setdb.style.display="none";
		setuser.style.display="none";
		setck.style.display="";
		//setlang.style.display="none";
		setother.style.display="none";
	}
	else if(cset=="setlang")
	{
		setdb.style.display="none";
		setuser.style.display="none";
		setck.style.display="none";
		//setlang.style.display="";
		setother.style.display="none";
	}
	else if(cset=="setother")
	{
		setdb.style.display="none";
		setuser.style.display="none";
		setck.style.display="none";
		//setlang.style.display="none";
		setother.style.display="";
	}
	else
	{
		setdb.style.display="";
		setuser.style.display="none";
		setck.style.display="none";
		//setlang.style.display="none";
		setother.style.display="none";
	}
}
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td>��m�G<a href="SetDb.php">�ѼƳ]�m</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr bgcolor="#FFFFFF"> 
    <td width="20%" height="23" id="dbtd" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setdb');">�ƾڮw�]�m</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setuser');">�b���]�m</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setck');">COOKIE�]�m</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setother');">�䥦�]�m</a></strong></div></td>
  </tr>
</table>
<form name="form1" method="post" action="phome.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setdb">
    <tr> 
      <td height="25" colspan="2"><font color="#FFFFFF"><strong>�ƾڮw�]�m 
        <input name="phome" type="hidden" id="phome" value="SetDb">
        </strong></font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>MYSQL����</strong></td>
      <td height="25" bgcolor="#FFFFFF"><p> 
          <input type="radio" name="mysqlver" value="5.0"<?=$phome_db_ver=='5.0'?' checked':''?>>
          MYSQL5.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="4.1"<?=$phome_db_ver=='4.1'?' checked':''?>>
          MYSQL 4.1.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="4.0"<?=$phome_db_ver=='4.0'?' checked':''?>>
          MYSQL 4.0.*/3.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="auto"<?=$phome_db_ver==''?' checked':''?>>
          �۰ʿ��</p></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF"><strong>�ƾڮw�A�Ⱦ�</strong></td>
      <td width="76%" height="25" bgcolor="#FFFFFF"><input name="dbhost" type="text" id="dbhost" value="<?=$phome_db_server?>"> 
        <font color="#666666">(��p�Glocalhost)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�ƾڮw�A�Ⱦ��ݤf</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbport" type="text" id="dbport" value="<?=$phome_db_port?>"> 
        <font color="#666666">(�@�뱡�p�U���ŧY�i)</font> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>�ƾڮw�Τ�W</strong></td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbusername" type="text" id="dbusername" value="<?=$phome_db_username?>"> 
        <font color="#666666">(��p�Groot)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>�ƾڮw�K�X</strong></td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbpassword" type="password" id="dbpassword">
        (<font color="#FF0000">���Q�ק�Яd�šC�L�K�X�Ρunull�v���</font>)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�q�{�ƥ����ƾڮw</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbname" type="text" id="dbname" value="<?=$phome_db_dbname?>"> 
        <font color="#666666">(�i����,�p��J�ƾڮw�W,�ƥ��������o�Ӯw.) </font></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">�q�{�ƥ��ƾڪ��e��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbaktbpre" type="text" id="sbaktbpre" value="<?=$baktbpre?>">
        <font color="#666666">(�Ŭ��C�X�Ҧ��ƾڪ�.)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�q�{�s�X</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbchar" type="text" id="dbchar" value="<?=$phome_db_char?>"> 
        <font color="#666666"> 
        <select name="selectchar" onchange="document.form1.dbchar.value=this.value">
          <option value="">���</option>
          <?php
				echo Ebak_ReturnDbCharList('');
				?>
        </select>
        (�@�뱡�p�U���ŧY�i) </font></td>
    </tr>
  </table>
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setuser" style="display:none">
    <tr> 
      <td height="25" colspan="2"><strong><font color="#FFFFFF">�b���]�m</font></strong></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">�Τ�W</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="adminusername" type="text" id="adminusername" value="<?=$set_username?>">
        <font color="#666666">(�ק��n���s�n��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�K�X</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="adminpassword" type="password" id="adminpassword"> 
        <font color="#666666">(���Q�ק�Яd��)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�{�ҽX</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginauth" type="text" id="adminloginauth" value="<?=$set_loginauth?>">
        <font color="#666666">(�G�űK�X,�Ŭ����]�m)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">�����H���X</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginrnd" type="text" id="adminloginrnd" value="<?=$set_loginrnd?>">
        <font color="#666666">
        <input type="button" name="Submit3" value="�H��" onclick="document.form1.adminloginrnd.value='<?=$loginauthrnd?>';">
        (�ק��n���s�n��)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�W�ɭ���</td>
      <td height="25" bgcolor="#FFFFFF"><input name="outtime" type="text" id="outtime" value="<?=$set_outtime?>">
        ����</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">�n���O�_�ݭn���ҽX</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginkey" value="0"<?=$set_loginkey==0?' checked':''?>>
        �O 
        <input type="radio" name="loginkey" value="1"<?=$set_loginkey==1?' checked':''?>>
        �_</td>
    </tr>
  </table>
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setck" style="display:none">
    <tr> 
      <td height="25" colspan="2"><font color="#FFFFFF"><strong>COOKIE�]�m(�q�`���ݭn�ק�)</strong></font></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">COOKIE�@�ΰ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckdomain" type="text" id="ckdomain" value="<?=$phome_cookiedomain?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE�@�θ��|</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckpath" type="text" id="ckpath" value="<?=$phome_cookiepath?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE�ܶq�e��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckvarpre" type="text" id="ckvarpre" value="<?=$phome_cookievarpre?>"></td>
    </tr>
	</table>
	
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setother" style="display:none">
    <tr> 
      <td height="25" colspan="2"><strong><font color="#FFFFFF">�䥦�]�m</font></strong></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">�ƾڳƥ��ؿ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbakpath" type="text" id="sbakpath" value="<?=$bakpath?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���Y�]�s��ؿ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbakzippath" type="text" id="sbakzippath" value="<?=$bakzippath?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">���ͦ��v���]�m</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="sfilechmod" value="0"<?=$filechmod0?>>
        0777 
        <input type="radio" name="sfilechmod" value="1"<?=$filechmod1?>>
        ������<font color="#666666">(�p�G�Ŷ�������B��0777��.php���,��ܤ�����Y�i.)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">PHP�B���w���Ҧ�</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sphpsafemod" type="checkbox" id="sphpsafemod" value="1"<?=$phpsafemod==1?' checked':''?>>
        �O<font color="#666666">(�p�G�B���w���Ҧ��A�Ҧ��ƾڧ��ƥ���bdata/safemod�ؿ�)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">PHP�W�ɮɶ��]�m</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sphp_outtime" type="text" id="sphp_outtime" value="<?=$php_outtime?>" size="6">
        �� <font color="#666666">(�@�뤣�ݭn�]�m�A�ݭnset_time_limit()����~����)</font></td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF"> <p>MYSQL����d�ߤ覡</p></td>
      <td height="25" bgcolor="#FFFFFF"><input name="slimittype" type="checkbox" id="slimittype" value="1"<?=$checklimittype?>>
        ��� <font color="#666666">(�p�G�ƥ��ɥX�{�U�����~,�бN���ĥh���Y�i�ѨM)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><font color="#FF0000">You have an error 
        in your SQL syntax; check the manual that corresponds to your MySQL server 
        version for the right syntax to use near '-1' at line 1</font></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">�Ŷ�������ƾڮw�C��</td>
      <td height="25" bgcolor="#FFFFFF"><input name="scanlistdb" type="checkbox" id="scanlistdb" value="1"<?=$canlistdb==1?' checked':''?>>
        �����<font color="#666666">(�p�G�Ŷ������\�C�X�ƾڮw,�Х��ġF�åB�n�]�m�q�{�ƥ����ƾڮw)</font></td>
    </tr>
  </table>
	<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <div align="left"> 
          <input type="submit" name="Submit" value="����">&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="���m">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>