<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>參數設置</title>
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
    <td>位置：<a href="SetDb.php">參數設置</a></td>
  </tr>
</table>
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
  <tr bgcolor="#FFFFFF"> 
    <td width="20%" height="23" id="dbtd" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setdb');">數據庫設置</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setuser');">帳號設置</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setck');">COOKIE設置</a></strong></div></td>
    <td width="20%" onmouseover="this.style.backgroundColor='#DBEAF5'" onmouseout="this.style.backgroundColor='#ffffff'"> 
      <div align="center"><strong><a href="#ebak" onclick="javascript:ChangeSet('setother');">其它設置</a></strong></div></td>
  </tr>
</table>
<form name="form1" method="post" action="phome.php">
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setdb">
    <tr> 
      <td height="25" colspan="2"><font color="#FFFFFF"><strong>數據庫設置 
        <input name="phome" type="hidden" id="phome" value="SetDb">
        </strong></font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>MYSQL版本</strong></td>
      <td height="25" bgcolor="#FFFFFF"><p> 
          <input type="radio" name="mysqlver" value="5.0"<?=$phome_db_ver=='5.0'?' checked':''?>>
          MYSQL5.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="4.1"<?=$phome_db_ver=='4.1'?' checked':''?>>
          MYSQL 4.1.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="4.0"<?=$phome_db_ver=='4.0'?' checked':''?>>
          MYSQL 4.0.*/3.*&nbsp;&nbsp; 
          <input type="radio" name="mysqlver" value="auto"<?=$phome_db_ver==''?' checked':''?>>
          自動選擇</p></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF"><strong>數據庫服務器</strong></td>
      <td width="76%" height="25" bgcolor="#FFFFFF"><input name="dbhost" type="text" id="dbhost" value="<?=$phome_db_server?>"> 
        <font color="#666666">(比如：localhost)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">數據庫服務器端口</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbport" type="text" id="dbport" value="<?=$phome_db_port?>"> 
        <font color="#666666">(一般情況下為空即可)</font> </td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>數據庫用戶名</strong></td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbusername" type="text" id="dbusername" value="<?=$phome_db_username?>"> 
        <font color="#666666">(比如：root)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><strong>數據庫密碼</strong></td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbpassword" type="password" id="dbpassword">
        (<font color="#FF0000">不想修改請留空。無密碼用「null」表示</font>)</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">默認備份的數據庫</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbname" type="text" id="dbname" value="<?=$phome_db_dbname?>"> 
        <font color="#666666">(可為空,如輸入數據庫名,備份直接轉到這個庫.) </font></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">默認備份數據表的前綴</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbaktbpre" type="text" id="sbaktbpre" value="<?=$baktbpre?>">
        <font color="#666666">(空為列出所有數據表.)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">默認編碼</td>
      <td height="25" bgcolor="#FFFFFF"><input name="dbchar" type="text" id="dbchar" value="<?=$phome_db_char?>"> 
        <font color="#666666"> 
        <select name="selectchar" onchange="document.form1.dbchar.value=this.value">
          <option value="">選擇</option>
          <?php
				echo Ebak_ReturnDbCharList('');
				?>
        </select>
        (一般情況下為空即可) </font></td>
    </tr>
  </table>
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setuser" style="display:none">
    <tr> 
      <td height="25" colspan="2"><strong><font color="#FFFFFF">帳號設置</font></strong></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">用戶名</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="adminusername" type="text" id="adminusername" value="<?=$set_username?>">
        <font color="#666666">(修改後要重新登錄)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">密碼</td>
      <td height="25" bgcolor="#FFFFFF"> <input name="adminpassword" type="password" id="adminpassword"> 
        <font color="#666666">(不想修改請留空)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">認證碼</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginauth" type="text" id="adminloginauth" value="<?=$set_loginauth?>">
        <font color="#666666">(二級密碼,空為不設置)</font></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF">驗證隨機碼</td>
      <td height="25" bgcolor="#FFFFFF"><input name="adminloginrnd" type="text" id="adminloginrnd" value="<?=$set_loginrnd?>">
        <font color="#666666">
        <input type="button" name="Submit3" value="隨機" onclick="document.form1.adminloginrnd.value='<?=$loginauthrnd?>';">
        (修改後要重新登錄)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">超時限制</td>
      <td height="25" bgcolor="#FFFFFF"><input name="outtime" type="text" id="outtime" value="<?=$set_outtime?>">
        分鐘</td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">登錄是否需要驗證碼</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="loginkey" value="0"<?=$set_loginkey==0?' checked':''?>>
        是 
        <input type="radio" name="loginkey" value="1"<?=$set_loginkey==1?' checked':''?>>
        否</td>
    </tr>
  </table>
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setck" style="display:none">
    <tr> 
      <td height="25" colspan="2"><font color="#FFFFFF"><strong>COOKIE設置(通常不需要修改)</strong></font></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">COOKIE作用域</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckdomain" type="text" id="ckdomain" value="<?=$phome_cookiedomain?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE作用路徑</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckpath" type="text" id="ckpath" value="<?=$phome_cookiepath?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">COOKIE變量前綴</td>
      <td height="25" bgcolor="#FFFFFF"><input name="ckvarpre" type="text" id="ckvarpre" value="<?=$phome_cookievarpre?>"></td>
    </tr>
	</table>
	
	
  <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC" id="setother" style="display:none">
    <tr> 
      <td height="25" colspan="2"><strong><font color="#FFFFFF">其它設置</font></strong></td>
    </tr>
    <tr> 
      <td width="24%" height="25" bgcolor="#FFFFFF">數據備份目錄</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbakpath" type="text" id="sbakpath" value="<?=$bakpath?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">壓縮包存放目錄</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sbakzippath" type="text" id="sbakzippath" value="<?=$bakzippath?>"></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">文件生成權限設置</td>
      <td height="25" bgcolor="#FFFFFF"><input type="radio" name="sfilechmod" value="0"<?=$filechmod0?>>
        0777 
        <input type="radio" name="sfilechmod" value="1"<?=$filechmod1?>>
        不限制<font color="#666666">(如果空間不支持運行0777的.php文件,選擇不限制即可.)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">PHP運行於安全模式</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sphpsafemod" type="checkbox" id="sphpsafemod" value="1"<?=$phpsafemod==1?' checked':''?>>
        是<font color="#666666">(如果運行於安全模式，所有數據均備份到bdata/safemod目錄)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF">PHP超時時間設置</td>
      <td height="25" bgcolor="#FFFFFF"><input name="sphp_outtime" type="text" id="sphp_outtime" value="<?=$php_outtime?>" size="6">
        秒 <font color="#666666">(一般不需要設置，需要set_time_limit()支持才有效)</font></td>
    </tr>
    <tr> 
      <td rowspan="2" bgcolor="#FFFFFF"> <p>MYSQL支持查詢方式</p></td>
      <td height="25" bgcolor="#FFFFFF"><input name="slimittype" type="checkbox" id="slimittype" value="1"<?=$checklimittype?>>
        支持 <font color="#666666">(如果備份時出現下面錯誤,請將打勾去掉即可解決)</font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><font color="#FF0000">You have an error 
        in your SQL syntax; check the manual that corresponds to your MySQL server 
        version for the right syntax to use near '-1' at line 1</font></td>
    </tr>
	<tr>
      <td height="25" bgcolor="#FFFFFF">空間不支持數據庫列表</td>
      <td height="25" bgcolor="#FFFFFF"><input name="scanlistdb" type="checkbox" id="scanlistdb" value="1"<?=$canlistdb==1?' checked':''?>>
        不支持<font color="#666666">(如果空間不允許列出數據庫,請打勾；並且要設置默認備份的數據庫)</font></td>
    </tr>
  </table>
	<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25" colspan="2" bgcolor="#FFFFFF"> <div align="left"> 
          <input type="submit" name="Submit" value="提交">&nbsp;&nbsp;
          <input type="reset" name="Submit2" value="重置">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>