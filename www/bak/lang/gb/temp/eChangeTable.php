<?php
if(!defined('InEmpireBak'))
{
	exit();
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>ѡ�����ݱ�</title>
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
	ok=confirm("ȷ��Ҫִ�д˲���?");
	return ok;
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr> 
    <td width="51%">λ�ã��������� -&gt; <a href="ChangeDb.php">ѡ�����ݿ�</a>(<b><?=$mydbname?></b>) -&gt; <a href="ChangeTable.php?mydbname=<?=$mydbname?>">ѡ�񱸷ݱ�</a></td>
    <td width="49%"><div align="right"> </div></td>
  </tr>
  <tr> 
    <td height="25" colspan="2"><div align="center">���ݲ��裺ѡ�����ݿ� -&gt; <font color="#FF0000">ѡ��Ҫ���ݵı�</font> 
        -&gt; ��ʼ���� -&gt; ���</div></td>
  </tr>
</table>
<form name="ebakchangetb" method="post" action="phomebak.php" onsubmit="return check();">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#0472BC">
    <tr> 
      <td height="25"><font color="#FFFFFF">���ݲ������ã� 
        <input name="phome" type="hidden" id="phome" value="DoEbak">
        <input name="mydbname" type="hidden" id="mydbname" value="<?=$mydbname?>">
        </font></td>
    </tr>
    <tr> 
      <td height="25" bgcolor="#FFFFFF"> <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DBEAF5">
          <tr> 
            <td width="22%">&nbsp;</td>
            <td> [<a href="#ebak" onclick="javascript:window.open('ListSetbak.php?mydbname=<?=$mydbname?>&change=1','','width=550,height=380,scrollbars=yes');">��������</a>]&nbsp;&nbsp;&nbsp;[<a href="#ebak" onclick="javascript:showsave.style.display='';">��������</a>]&nbsp;&nbsp;&nbsp;[<a href="#ebak" onclick="javascript:showreptable.style.display='';">�����滻����</a>]</td>
          </tr>
          <tr id="showsave" style="display:none">
            <td>&nbsp;</td>
            <td>�����ļ���:setsave/ 
              <input name="savename" type="text" id="savename" value="<?=$_GET['savefilename']?>">
              <input name="Submit4" type="submit" id="Submit4" onClick="document.ebakchangetb.phome.value='DoSave';document.ebakchangetb.action='phome.php';" value="��������">
              <font color="#666666">(�ļ�������Ӣ����ĸ,�磺test)</font></td>
          </tr>
		  <tr id="showreptable" style="display:none">
            <td>&nbsp;</td>
            <td> ԭ�ַ�: 
              <input name="oldtablepre" type="text" id="oldtablepre" size="18">
              ���ַ�:
              <input name="newtablepre" type="text" id="newtablepre" size="18"> 
              <input name="Submit4" type="submit" id="Submit4" onClick="document.ebakchangetb.phome.value='ReplaceTable';document.ebakchangetb.action='phome.php';" value="�滻ѡ�б���">
            </td>
          </tr>
        </table>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
            <td width="22%"><input type="radio" name="baktype" value="0"<?=$dbaktype==0?' checked':''?>> 
              <strong>���ļ���С����</strong> </td>
            <td width="78%" height="23"> ÿ�鱸�ݴ�С: 
              <input name="filesize" type="text" id="filesize" value="<?=$dfilesize?>" size="6">
              KB <font color="#666666">(1 MB = 1024 KB)</font></td>
          </tr>
          <tr> 
            <td><input type="radio" name="baktype" value="1"<?=$dbaktype==1?' checked':''?>> 
              <strong>����¼������</strong></td>
            <td height="23">ÿ�鱸�� 
              <input name="bakline" type="text" id="bakline" value="<?=$dbakline?>" size="6">
              ����¼�� 
              <input name="autoauf" type="checkbox" id="autoauf" value="1"<?=$dautoauf==1?' checked':''?>>
              �Զ�ʶ�������ֶ�<font color="#666666">(�˷�ʽЧ�ʸ���)</font></td>
          </tr>
          <tr> 
            <td>�������ݿ�ṹ</td>
            <td height="23"><input name="bakstru" type="checkbox" id="bakstru" value="1"<?=$dbakstru==1?' checked':''?>>
              �� <font color="#666666">(û�����������ѡ��)</font></td>
          </tr>
          <tr> 
            <td>���ݱ���</td>
            <td height="23"> <select name="dbchar" id="dbchar">
                <option value="auto"<?=$ddbchar=='auto'?' selected':''?>>�Զ�ʶ�����</option>
                <option value=""<?=$ddbchar==''?' selected':''?>>������</option>
                <?php
				echo Ebak_ReturnDbCharList($ddbchar);
				?>
              </select> <font color="#666666">(��mysql4.0����mysql4.1���ϰ汾��Ҫѡ��̶����룬����ѡ�Զ�)</font></td>
          </tr>
          <tr>
            <td>���ݴ�Ÿ�ʽ</td>
            <td height="23"><input type="radio" name="bakdatatype" value="0"<?=$dbakdatatype==0?' checked':''?>>
              ����
              <input type="radio" name="bakdatatype" value="1"<?=$dbakdatatype==1?' checked':''?>>
              ʮ�����Ʒ�ʽ<font color="#666666">(ʮ�����Ʊ����ļ���ռ�ø���Ŀռ�)</font></td>
          </tr>
          <tr> 
            <td>���Ŀ¼</td>
            <td height="23"> 
              <?=$bakpath?>
              / 
              <input name="mypath" type="text" id="mypath" value="<?=$mypath?>" size="28"> 
              <font color="#666666"> 
              <input type="button" name="Submit2" value="ѡ��Ŀ¼" onclick="javascript:window.open('ChangePath.php?change=1&toform=ebakchangetb','','width=750,height=500,scrollbars=yes');">
              (Ŀ¼�����ڣ�ϵͳ���Զ�����)</font></td>
          </tr>
          <tr> 
            <td>����ѡ��</td>
            <td height="23">���뷽ʽ: 
              <select name="insertf" id="select">
                <option value="replace"<?=$dinsertf=='replace'?' selected':''?>>REPLACE</option>
                <option value="insert"<?=$dinsertf=='insert'?' selected':''?>>INSERT</option>
              </select>
              , 
              <input name="beover" type="checkbox" id="beover" value="1"<?=$dbeover==1?' checked':''?>>
              �������룬
              <input name="bakstrufour" type="checkbox" id="bakstrufour" value="1"<?=$dbakstrufour==1?' checked':''?>>
              <a title="��Ҫת�����ݱ����ʱѡ��">ת��MYSQL4.0��ʽ</a>, ÿ�鱸�ݼ���� 
              <input name="waitbaktime" type="text" id="waitbaktime" value="<?=$dwaitbaktime?>" size="2">
              ��</td>
          </tr>
          <tr> 
            <td valign="top">����˵��<br> <font color="#666666">(ϵͳ������һ��readme.txt)</font></td>
            <td height="23"><textarea name="readme" cols="80" rows="5" id="readme"><?=$dreadme?></textarea></td>
          </tr>
          <tr> 
            <td valign="top">ȥ������ֵ���ֶ��б�<br> <font color="#666666">(��ʽ��<strong>����.�ֶ���</strong><br>
              �������&quot;,&quot;��)</font></td>
            <td height="23"><textarea name="autofield" cols="80" rows="5" id="autofield"><?=$dautofield?></textarea></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td height="25">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="50%"><font color="#FFFFFF">ѡ��Ҫ���ݵı�( <a href="#ebak" onclick="SelectCheckAll(document.ebakchangetb)"><font color="#ffffff"><u>ȫѡ</u></font></a> 
              | <a href="#ebak" onclick="reverseCheckAll(document.ebakchangetb);"><font color="#ffffff"><u>��ѡ</u></font></a> )</font></td>
            <td><div align="right"><font color="#FFFFFF">��ѯ:</font> 
                <input name="keyboard" type="text" id="keyboard" value="<?=$keyboard?>">
                <input type="button" name="Submit32" value="��ʾ���ݱ�" onclick="self.location.href='ChangeTable.php?sear=1&mydbname=<?=$mydbname?>&keyboard='+document.ebakchangetb.keyboard.value;">
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="25" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr bgcolor="#DBEAF5"> 
            <td width="5%" height="23"> <div align="center">ѡ��</div></td>
            <td width="27%" height="23" bgcolor="#DBEAF5"> 
              <div align="center">����(����鿴�ֶ�)</div></td>
            <td width="13%" height="23" bgcolor="#DBEAF5"> 
              <div align="center">����</div></td>
            <td width="15%" bgcolor="#DBEAF5">
<div align="center">����</div></td>
            <td width="15%" height="23"> 
              <div align="center">��¼��</div></td>
            <td width="14%" height="23"> 
              <div align="center">��С</div></td>
            <td width="11%" height="23"> 
              <div align="center">��Ƭ</div></td>
          </tr>
          <?php
		  $tbchecked=' checked';
		  if($dtblist)
		  {
		  	$check=1;
		  }
		  $totaldatasize=0;//�����ݴ�С
		  $tablenum=0;//�ܱ���
		  $datasize=0;//���ݴ�С
		  $rownum=0;//�ܼ�¼��
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
            <td height="23"> <div align="left"><a href="#ebak" onclick="window.open('ListField.php?mydbname=<?=$mydbname?>&mytbname=<?=$r[Name]?>','','width=660,height=500,scrollbars=yes');" title="����鿴���ֶ��б�"> 
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
          <input type="submit" name="Submit" value="��ʼ����" onclick="document.ebakchangetb.phome.value='DoEbak';document.ebakchangetb.action='phomebak.php';">
          &nbsp;&nbsp; &nbsp;&nbsp;
          <input type="submit" name="Submit2" value="�޸����ݱ�" onclick="document.ebakchangetb.phome.value='DoRep';document.ebakchangetb.action='phome.php';">
          &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="�Ż����ݱ�" onclick="document.ebakchangetb.phome.value='DoOpi';document.ebakchangetb.action='phome.php';">
        &nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="ɾ�����ݱ�" onclick="document.ebakchangetb.phome.value='DoDrop';document.ebakchangetb.action='phome.php';">
		&nbsp;&nbsp; &nbsp;&nbsp; 
          <input type="submit" name="Submit22" value="������ݱ�" onclick="document.ebakchangetb.phome.value='EmptyTable';document.ebakchangetb.action='phome.php';">
		</div></td>
    </tr>
  </table>
</form>
</body>
</html>