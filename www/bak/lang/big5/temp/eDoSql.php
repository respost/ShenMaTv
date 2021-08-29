<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>執行SQL語句</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td height="25">位置：執行SQL語句</td>
  </tr>
</table>

<form action="phome.php" method="POST" name="form1" onsubmit="return confirm('確認要執行？');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><div align="center"><strong><font color="#FFFFFF">執行SQL語句</font></strong></div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <table width="560" border="0" cellpadding="3" cellspacing="1">
            <tr>
              <td width="50%">數據庫： 
                <select name="mydbname" id="mydbname">
				<option value=""></option>
				<?php
				echo $db;
				?>
                </select>
              </td>
              <td><div align="right">數據編碼： 
                  <input name="mydbchar" type="text" id="mydbchar" value="<?=$phome_db_char?>" size="16">
                  <font color="#666666"> 
                  <select name="selectchar" onchange="document.form1.mydbchar.value=this.value">
                    <option value="">選擇</option>
                    <?php
				echo $chars;
				?>
                  </select>
                  </font></div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <textarea name="query" cols="90" rows="12" id="query"></textarea>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <input type="submit" name="Submit" value=" 執行SQL">
          &nbsp;&nbsp; 
          <input type="reset" name="Submit2" value="重置">
          <input name="phome" type="hidden" id="phome" value="DoExecSql">
        </div></td>
    </tr>
  </table>
  </form>
  <br>
<form action="phome.php" method="post" enctype="multipart/form-data" name="form2" onsubmit="return confirm('確認要導入？');">
  <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><div align="center"><strong><font color="#FFFFFF">導入SQL文件</font></strong></div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <table width="560" border="0" cellpadding="3" cellspacing="1">
            <tr> 
              <td width="50%">數據庫： 
                <select name="mydbname" id="mydbname">
                  <option value=""></option>
                  <?php
				echo $db;
				?>
                </select> </td>
              <td><div align="right">數據編碼： 
                  <input name="mydbchar" type="text" id="mydbchar" value="<?=$phome_db_char?>" size="16">
                  <font color="#666666"> 
                  <select name="selectchar" onchange="document.form2.mydbchar.value=this.value">
                    <option value="">選擇</option>
                    <?php
				echo $chars;
				?>
                  </select>
                  </font></div></td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center">
          <table width="560" border="0" cellspacing="1" cellpadding="3">
            <tr>
              <td>SQL文件：
                <input name="file" type="file" size="38">
                <font color="#666666">(*.sql，最大文件：<?php echo @get_cfg_var("file_uploads")?@get_cfg_var("upload_max_filesize"):'不允許上傳';?>)</font> 
              </td>
            </tr>
          </table>
        </div></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"><div align="center"> 
          <input type="submit" name="Submit3" value="導入SQL">
          &nbsp;&nbsp; 
          <input type="reset" name="Submit22" value="重置">
          <input name="phome" type="hidden" id="phome" value="DoTranExecSql">
        </div></td>
    </tr>
  </table>
</form>
</body>
</html>