<?php
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent,"NetFront") || strpos($agent,"iPhone") 

|| strpos($agent,"MIDP-2.0") || strpos($agent,"Opera 

Mini") || strpos($agent,"UCWEB") || strpos

($agent,"Android") || strpos($agent,"Windows CE") || 

strpos($agent,"SymbianOS") || 1==1){ 
//手机访问的
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
echo '<TITLE>错误：您所请求的网址（URL）无法获取

</TITLE>';
echo '<STYLE type="text/css"><!--BODY{background-

color:#ffffff;font-family:verdana,sans-serif}PRE{font-

family:sans-serif}--></STYLE>';
echo '</HEAD>';
echo '<BODY>';
echo '<H1>错误</H1>';
echo '<H2>您所请求的网址（URL）无法获取</H2>';
echo '<HR noshade size="1px">';
echo "<P>当尝试读取以下网址（URL）时：<A HREF='$url'> 

$url</A><P>发生了下列的错误：";
echo '<UL>';
echo '<LI>';
echo '<STRONG>Access Denied.<BR>拒绝访问

</STRONG><P>Access control configuration prevents your 

request frombeing allowed at this time.  ';
echo 'Please contact your service provider if you feel 

this is incorrect.';
echo '<BR>当前的存取控制设定禁止您的请求被接受，如果您

觉得这是错误的，请与您网路服务的提供者联系。</UL></P>';
echo '<P>本缓存服务器管理员：<A 

HREF="mailto:wssupport@chinanetcenter.com">wssupport@ch

inanetcenter.com</A>';
echo '<P>Via:mzhdx135:8101 (Cdn Cache Server V2.0)

</P>';
echo '<BR clear="all">';
echo '<HR noshade size="1px">';
echo "<ADDRESS>Generated $shijian (Cdn Cache Server 

V2.0)</ADDRESS>";
echo "<ADDRESS>错误提示</ADDRESS>";
echo '</BODY>';
echo '</HTML>';
exit;
}
