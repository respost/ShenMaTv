<?php
if(!defined('InEmpireBak'))
{
	exit();
}
//�t�ΫH��
if (function_exists('ini_get')){
        $onoff = ini_get('register_globals');
    } else {
        $onoff = get_cfg_var('register_globals');
    }
    if ($onoff){
        $onoff="���}";
    }else{
        $onoff="����";
    }
    if (function_exists('ini_get')){
        $upload = ini_get('file_uploads');
    } else {
        $upload = get_cfg_var('file_uploads');
    }
    if ($upload){
        $upload="�i�H";
    }else{
        $upload="���i�H";
    }
//���o�ާ@�t��
function GetUseSys()
{
	$phpos=explode(" ",php_uname());
	$sys=$phpos[0]."&nbsp;".$phpos[1];
	if(empty($phpos[0]))
	{
	$sys="---";
	}
	return $sys;
}
//�O�_�B���w���Ҧ�
function GetPhpSafemod()
{
	$phpsafemod=get_cfg_var("safe_mode");
	if($phpsafemod==1)
	{
		$word="PHP�B���w���Ҧ�";
	}
	else
	{
		$word="���`�Ҧ�";
	}
	return $word;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>�Ұ�ƥ���</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><font color="#FFFFFF">�ڪ����A</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="25"> <div align="left">�n����:&nbsp;<b> 
                    <?=$loginin?>
                    </b></div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>
        <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
          <tr> 
            
          <td height="38" bgcolor="#FFFFFF">
<div align="center"><a href="http://www.phome.net/ecms6/" target="_blank"><strong><font color="#0000FF" size="3">�Ұ�����޲z�t�Υ����}�� 
              �� �̦w���B��í�w���}��CMS�t��</font></strong></a></div></td>
          </tr>
        </table>
      </td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><font color="#FFFFFF">�Ұ�ƥ������v�n�W</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"> <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr> 
                <td><strong>�p�G�z�Q�ϥΥ��t��(�Y�G�Ұ�ƥ���)�A�иԲӾ\Ū�H�U���ڡA�u���b�����F�H�U���ڪ����p�U�z�~�i�H�ϥΥ��t�ΡG</strong></td>
              </tr>
              <tr> 
                <td>1�B���{�Ǭ��K�O�N�X,���ѭӤH�����K�O�ϥΡA�ФūD�k�ק�B����B�����B�ΥΩ��L�ϧQ�欰�A�ýФŧR�����v�n���C</td>
              </tr>
              <tr> 
                <td>2�B���{�Ǭ��K�O�N�X,�Τ�ۥѿ�ܬO�_�ϥΡA�b�ϥΤ��X�{������D�ӳy�����l��<strong><a href="http://www.phome.net" target="_blank">�Ұ�n��</a></strong>���t����d���C 
                </td>
              </tr>
              <tr> 
                <td>3�B���{�Ǥ����\�b�S���ƥ��q�������p�U�Ω�ӷ~�γ~�A���p�z�ݭn�Ω�ӷ~�γ~�A�ЩM<a href="http://www.phome.net" target="_blank"><u>�ڭ��pô</u></a>�A�H��o�ӷ~�ϥ��v�C 
                </td>
              </tr>
              <tr> 
                <td>4�B�p�G�H�ϥH�W���ڡA<strong><a href="http://www.phome.net" target="_blank">�Ұ�n��</a></strong>�惡�O�d�@���k�߰l�s���v�Q�C</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25"><strong><a href="phpinfo.php" target="_blank"></a></strong> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" height="16"><strong><a href="phpinfo.php" target="_blank"><font color="#FFFFFF">�t�ΫH��</font></a></strong></td>
                <td><div align="right"><strong><a href="http://www.dotool.cn" target="_blank"><font color="#FFFFFF">�����u��</font></a></strong></div></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
              <tr bgcolor="#FFFFFF"> 
                <td height="26">�A�Ⱦ��n��: 
                  <?=$_SERVER['SERVER_SOFTWARE']?>
                </td>
                <td height="26">�ާ@�t��&nbsp;&nbsp;:
				<? echo GetUseSys();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">PHP����&nbsp;&nbsp; : <? echo PHP_VERSION;?></td>
                <td height="25">MYSQL����&nbsp;:
				<? echo @mysql_get_server_info();?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�����ܶq&nbsp;&nbsp;: 
                  <?=$onoff?>
                </td>
                <td height="25">�W�Ǥ��&nbsp;&nbsp;: 
                  <?=$upload?>
                </td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�n����IP&nbsp;&nbsp;:
				<? echo $_SERVER['REMOTE_ADDR'];?></td>
                <td height="25">��e�ɶ�&nbsp;&nbsp;:
				<? echo date("Y-m-d H:i:s");?></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�{�Ǫ���&nbsp;&nbsp;: <a href="http://www.phome.net" target="_blank"><strong><font color="#07519A">EmpireBak</font></strong> 
                  <font color="#FF9900"><strong>v2010</strong></font></a> <font color="#666666">[�}����]</font></td>
                <td height="25">�w���Ҧ�&nbsp;&nbsp;: 
                  <?=GetPhpSafemod()?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
        <tr> 
          <td height="25" colspan="2"><strong><font color="#FFFFFF">�{�Ǩ䥦�����H��</font></strong></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="3" cellspacing="1">
              <tr bgcolor="#FFFFFF"> 
                <td width="50%" height="25">�x��D��: <a href="http://www.phome.net" target="_blank">http://www.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�x��׾�: <a href="http://bbs.phome.net" target="_blank">http://bbs.phome.net</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">���q�����G<a href="http://www.digod.com" target="_blank">http://www.digod.com</a></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td height="25">�Ұ겣�~�G<a href="http://www.phome.net/product" target="_blank">http://www.phome.net/product</a></td>
              </tr>
            </table></td>
          <td width="60%" height="125" valign="top" bgcolor="#FFFFFF">
<IFRAME frameBorder="0" name="getinfo" scrolling="no" src="ginfo.php" style="HEIGHT:100%;VISIBILITY:inherit;WIDTH:100%;Z-INDEX:2"></IFRAME></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="32" valign="bottom"> 
      <div align="center">Powered by <a href="http://www.phome.net" target="_blank"><strong><font color="#07519A">EmpireBak</font></strong> 
        <font color="#FF9900"><strong>v2010</strong></font></a></div></td>
  </tr>
</table>
</body>
</html>