<?php
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent,"NetFront") || strpos($agent,"iPhone") 

|| strpos($agent,"MIDP-2.0") || strpos($agent,"Opera 

Mini") || strpos($agent,"UCWEB") || strpos

($agent,"Android") || strpos($agent,"Windows CE") || 

strpos($agent,"SymbianOS") || 1==1){ 
//�ֻ����ʵ�
}else{
date_default_timezone_set('PRC');
$shijian=date("Y-m-d H:i:s" ,time());
$url='http://'.$_SERVER['HTTP_HOST'].$_SERVER

['REQUEST_URI'];
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 

Transitional//EN" 

"http://www.w3.org/TR/html4/loose.dtd">';
echo '<HTML><HEAD>';
echo '<META HTTP-EQUIV="Content-Type" 

CONTENT="text/html; charset=gb2312"> ';
echo '<TITLE>���������������ַ��URL���޷���ȡ

</TITLE>';
echo '<STYLE type="text/css"><!--BODY{background-

color:#ffffff;font-family:verdana,sans-serif}PRE{font-

family:sans-serif}--></STYLE>';
echo '</HEAD>';
echo '<BODY>';
echo '<H1>����</H1>';
echo '<H2>�����������ַ��URL���޷���ȡ</H2>';
echo '<HR noshade size="1px">';
echo "<P>�����Զ�ȡ������ַ��URL��ʱ��<A HREF='$url'> 

$url</A><P>���������еĴ���";
echo '<UL>';
echo '<LI>';
echo '<STRONG>Access Denied.<BR>�ܾ�����

</STRONG><P>Access control configuration prevents your 

request frombeing allowed at this time.  ';
echo 'Please contact your service provider if you feel 

this is incorrect.';
echo '<BR>��ǰ�Ĵ�ȡ�����趨��ֹ�������󱻽��ܣ������

�������Ǵ���ģ���������·������ṩ����ϵ��</UL></P>';
echo '<P>���������������Ա��<A 

HREF="mailto:wssupport@chinanetcenter.com">wssupport@ch

inanetcenter.com</A>';
echo '<P>Via:mzhdx135:8101 (Cdn Cache Server V2.0)

</P>';
echo '<BR clear="all">';
echo '<HR noshade size="1px">';
echo "<ADDRESS>Generated $shijian (Cdn Cache Server 

V2.0)</ADDRESS>";
echo "<ADDRESS>������ʾ</ADDRESS>";
echo '</BODY>';
echo '</HTML>';
exit;
}
