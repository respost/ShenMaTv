<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>��ܼƾڪ�</title>
<link href="images/css.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function CheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if(e.name=='bakstru'||e.name=='bakstrufour'||e.name=='beover'||e.name=='autoauf'||e.name=='baktype'||e.name=='bakdatatype')
		{
		continue;
	    }
	if (e.name != 'chkall')
       e.checked = form.chkall.checked;
    }
  }
function reverseCheckAll(form)
{
  for (var i=0;i<form.elements.length;i++)
  {
    var e = form.elements[i];
    if(e.name=='bakstru'||e.name=='bakstrufour'||e.name=='beover'||e.name=='autoauf'||e.name=='baktype'||e.name=='bakdatatype')
	{
		continue;
	}
	if (e.name != 'chkall')
	{
	   if(e.checked==true)
	   {
       		e.checked = false;
	   }
	   else
	   {
	  		e.checked = true;
	   }
	}
  }
}
function SelectCheckAll(form)
  {
  for (var i=0;i<form.elements.length;i++)
    {
    var e = form.elements[i];
    if(e.name=='bakstru'||e.name=='bakstrufour'||e.name=='beover'||e.name=='autoauf'||e.name=='baktype'||e.name=='bakdatatype')
		{
		continue;
	    }
	if (e.name != 'chkall')
	  	e.checked = true;
    }
  }
function check()
{
	var ok;
	ok=confirm("�T�{�n���榹�ާ@?");
	return ok;
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="51%">��m�G�ƥ��ƾ� -&gt; <a href="ChangeDb.php">��ܼƾڮw</a>(<b><?=$mydbname?></b>) -&gt; <a href="ChangeTable.php?mydbname=<?=$mydbname?>">��ܳƥ���</a></td>
    <td width="49%"><div align="right"> </div></td>
  </tr>
  <tr> 
    <td height="25" colspan="2"><div align="center">�ƥ��B�J�G��ܼƾڮw -&gt; <font color="#FF0000">��ܭn�ƥ�����</font> 
        -&gt; �}�l�ƥ� -&gt; ����</div></td>
  </tr>
</table>
<form name="ebakchangetb" method="post" action="phomebak.php" onsubmit="return check();">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><font color="#FFFFFF">�ƥ��ѼƳ]�m�G 
        <input name="phome" type="hidden" id="phome" value="DoEbak">
        <input name="mydbname" type="hidden" id="mydbname" value="<?=$mydbname?>">
        </font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="22%">&nbsp;</td>
            <td> [<a href="#ebak" onclick="javascript:window.open('ListSetbak.php?mydbname=<?=$mydbname?>&change=1','','width=550,height=380,scrollbars=yes');">�ɤJ�]�m</a>]&nbsp;&nbsp;&nbsp;[<a href="#ebak" onclick="javascript:showsave.style.display='';">�O�s�]�m</a>]&nbsp;&nbsp;&nbsp;[<a href="#ebak" onclick="javascript:showreptable.style.display='';">��q������W</a>]</td>
          </tr>
          <tr id="showsave" style="display:none">
            <td>&nbsp;</td>
            <td>�O�s���W:setsave/ 
              <input name="savename" type="text" id="savename" value="<?=$_GET['savefilename']?>">
              <input name="Submit4" type="submit" id="Submit4" onClick="document.ebakchangetb.phome.value='DoSave';document.ebakchangetb.action='phome.php';" value="�O�s�]�m">
              <font color="#666666">(���W�Хέ^��r��,�p�Gtest)</font></td>
          </tr>
		  <tr id="showreptable" style="display:none">
            <td>&nbsp;</td>
            <td> ��r��: 
              <input name="oldtablepre" type="text" id="oldtablepre" size="18">
              �s�r��:
              <input name="newtablepre" type="text" id="newtablepre" size="18"> 
              <input name="Submit4" type="submit" id="Submit4" onClick="document.ebakchangetb.phome.value='ReplaceTable';document.ebakchangetb.action='phome.php';" value="�����襤��W">
            </td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="22%"><input type="radio" name="baktype" value="0"<?=$dbaktype==0?' checked':''?>> 
              <strong>�����j�p�ƥ�</strong> </td>
            <td width="78%" height="23"> �C�ճƥ��j�p: 
              <input name="filesize" type="text" id="filesize" value="<?=$dfilesize?>" size="6">
              KB <font color="#666666">(1 MB = 1024 KB)</font></td>
          </tr>
          <tr> 
            <td><input type="radio" name="baktype" value="1"<?=$dbaktype==1?' checked':''?>> 
              <strong>���O���Ƴƥ�</strong></td>
            <td height="23">�C�ճƥ� 
              <input name="bakline" type="text" id="bakline" value="<?=$dbakline?>" size="6">
              ���O���A 
              <input name="autoauf" type="checkbox" id="autoauf" value="1"<?=$dautoauf==1?' checked':''?>>
              �۰��ѧO�ۼW�r�q<font color="#666666">(���覡�Ĳv��)</font></td>
          </tr>
          <tr> 
            <td>�ƥ��ƾڮw���c</td>
            <td height="23"><input name="bakstru" type="checkbox" id="bakstru" value="1"<?=$dbakstru==1?' checked':''?>>
              �O <font color="#666666">(�S�S���p�A�п��)</font></td>
          </tr>
          <tr> 
            <td>�ƾڽs�X</td>
            <td height="23"> <select name="dbchar" id="dbchar">
                <option value="auto"<?=$ddbchar=='auto'?' selected':''?>>�۰��ѧO�s�X</option>
                <option value=""<?=$ddbchar==''?' selected':''?>>���]�m</option>
                <?php
				echo Ebak_ReturnDbCharList($ddbchar);
				?>
              </select> <font color="#666666">(�qmysql4.0�ɤJmysql4.1�H�W�����ݭn��ܩT�w�s�X�A�����۰�)</font></td>
          </tr>
          <tr>
            <td>�ƾڦs��榡</td>
            <td height="23"><input type="radio" name="bakdatatype" value="0"<?=$dbakdatatype==0?' checked':''?>>
              ���`
              <input type="radio" name="bakdatatype" value="1"<?=$dbakdatatype==1?' checked':''?>>
              �Q���i��覡<font color="#666666">(�Q���i��ƥ����|���Χ�h���Ŷ�)</font></td>
          </tr>
          <tr> 
            <td>�s��ؿ�</td>
            <td height="23"> 
              <?=$bakpath?>
              / 
              <input name="mypath" type="text" id="mypath" value="<?=$mypath?>" size="28"> 
              <font color="#666666"> 
              <input type="button" name="Submit2" value="��ܥؿ�" onclick="javascript:window.open('ChangePath.php?change=1&toform=ebakchangetb','','width=750,height=500,scrollbars=yes');">
              (�ؿ����s�b�A�t�η|�۰ʫإ�)</font></td>
          </tr>
          <tr> 
            <td>�ƥ��ﶵ</td>
            <td height="23">�ɤJ�覡: 
              <select name="insertf" id="select">
                <option value="replace"<?=$dinsertf=='replace'?' selected':''?>>REPLACE</option>
                <option value="insert"<?=$dinsertf=='insert'?' selected':''?>>INSERT</option>
              </select>
              , 
              <input name="beover" type="checkbox" id="beover" value="1"<?=$dbeover==1?' checked':''?>>
              ���㴡�J�A
              <input name="bakstrufour" type="checkbox" id="bakstrufour" value="1"<?=$dbakstrufour==1?' checked':''?>>
              <a title="�ݭn�ഫ�ƾڪ�s�X�ɿ��">�নMYSQL4.0�榡</a>, �C�ճƥ����j�G 
              <input name="waitbaktime" type="text" id="waitbaktime" value="<?=$dwaitbaktime?>" size="2">
              ��</td>
          </tr>
          <tr> 
            <td valign="top">�ƥ�����<br> <font color="#666666">(�t�η|�ͦ��@��readme.txt)</font></td>
            <td height="23"><textarea name="readme" cols="80" rows="5" id="readme"><?=$dreadme?></textarea></td>
          </tr>
          <tr> 
            <td valign="top">�h���ۼW�Ȫ��r�q�C��G<br> <font color="#666666">(�榡�G<strong>��W.�r�q�W</strong><br>
              �h�ӽХ�&quot;,&quot;��})</font></td>
            <td height="23"><textarea name="autofield" cols="80" rows="5" id="autofield"><?=$dautofield?></textarea></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="25">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%"><font color="#FFFFFF">��ܭn�ƥ�����G( <a href="#ebak" onclick="SelectCheckAll(document.ebakchangetb)"><font color="#ffffff"><u>����</u></font></a> 
              | <a href="#ebak" onclick="reverseCheckAll(document.ebakchangetb);"><font color="#ffffff"><u>�Ͽ�</u></font></a> )</font></td>
            <td><div align="right"><font color="#FFFFFF">�d��:</font> 
                <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
                <input type="button" name="Submit32" value="��ܼƾڪ�" onclick="self.location.href='ChangeTable.php?sear=1&mydbname=<?=$mydbname?>&keyboard='+document.ebakchangetb.keyboard.value;">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr bgcolor="#DBEAF5"> 
            <td width="5%" height="23"> <div align="center">���</div></td>
            <td width="27%" height="23" bgcolor="#DBEAF5"> 
              <div align="center">��W(�I���d�ݦr�q)</div></td>
            <td width="13%" height="23" bgcolor="#DBEAF5"> 
              <div align="center">����</div></td>
            <td width="15%" bgcolor="#DBEAF5">
<div align="center">�s�X</div></td>
            <td width="15%" height="23"> 
              <div align="center">�O����</div></td>
            <td width="14%" height="23"> 
              <div align="center">�j�p</div></td>
            <td width="11%" height="23"> 
              <div align="center">�H��</div></td>
          </tr>
          <?php
		  $tbchecked=' checked';
		  if($dtblist)
		  {
		  	$check=1;
		  }
		  $totaldatasize=0;//�`�ƾڤj�p
		  $tablenum=0;//�`���
		  $datasize=0;//�ƾڤj�p
		  $rownum=0;//�`�O����
		  while($r=$empire->fetch($sql))
		  {
		  	$rownum+=$r[Rows];
		  	$tablenum++;
		  	$datasize=$r[Data_length]+$r[Index_length];
		  	$totaldatasize+=$r[Data_length]+$r[Index_length]+$r[Data_free];
			if($check==1)
			{
				if(strstr($dtblist,','.$r[Name].','))
				{
					$tbchecked=' checked';
				}
				else
				{
					$tbchecked='';
				}
			}
			$collation=$r[Collation]?$r[Collation]:'---';
		  ?>
          <tr id=tb<?=$r[Name]?>> 
            <td height="23"> <div align="center"> 
                <input name="tablename[]" type="checkbox" id="tablename[]" value="<?=$r[Name]?>" onclick="if(this.checked){tb<?=$r[Name]?>.style.backgroundColor='#F1F7FC';}else{tb<?=$r[Name]?>.style.backgroundColor='#ffffff';}"<?=$tbchecked?>>
              </div></td>
            <td height="23"> <div align="left"><a href="#ebak" onclick="window.open('ListField.php?mydbname=<?=$mydbname?>&mytbname=<?=$r[Name]?>','','width=660,height=500,scrollbars=yes');" title="�I���d�ݪ�r�q�C��"> 
                <?=$r[Name]?>
                </a></div></td>
            <td height="23"> <div align="center">
                <?=$r[Type]?$r[Type]:$r[Engine]?>
              </div></td>
            <td><div align="center">
				<?=$collation?>
              </div></td>
            <td height="23"> <div align="right">
                <?=$r[Rows]?>
              </div></td>
            <td height="23"> <div align="right">
                <?=Ebak_ChangeSize($datasize)?>
              </div></td>
            <td height="23"> <div align="right">
                <?=Ebak_ChangeSize($r[Data_free])?>
              </div></td>
          </tr>
          <?
		  }
		  ?>
          <tr bgcolor="#DBEAF5"> 
            <td height="23"> <div align="center">
                <input type=checkbox name=chkall value=on onclick="CheckAll(this.form)"<?=$check==0?' checked':''?>>
              </div></td>
            <td height="23"> <div align="center"> 
                <?=$tablenum?>
              </div></td>
            <td height="23"> <div align="center">---</div></td>
            <td><div align="center">---</div></td>
            <td height="23"> <div align="center">
                <?=$rownum?>
              </div></td>
            <td height="23" colspan="2"> <div align="center">
                <?=Ebak_ChangeSize($totaldatasize)?>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td height="25">
<div align="center">
          <input type="submit" name="Submit" value="�}�l�ƥ�" onclick="document.ebakchangetb.phome.value='DoEbak';document.ebakchangetb.action='phomebak.php';">
          &nbsp;&nbsp; &nbsp;&nbsp;
          <input type="submit" name="Submit2" value="�״_�ƾڪ�" onclick="document.ebakchangetb.phome.value='DoRep';document.ebakchangetb.action='phome.php';">
          &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�u�Ƽƾڪ�" onclick="document.ebakchangetb.phome.value='DoOpi';document.ebakchangetb.action='phome.php';">
        &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�R���ƾڪ�" onclick="document.ebakchangetb.phome.value='DoDrop';document.ebakchangetb.action='phome.php';">
		&nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�M�żƾڪ�" onclick="document.ebakchangetb.phome.value='EmptyTable';document.ebakchangetb.action='phome.php';">
		</div></td>
    </tr>
  </table>
</form>
</body>
</html>