<?php
file_exists('./ext/php_curl.dll') && dl('php_curl.dll'); // 加载扩展
if( $LabelArray['PageType']=='Save')//对标签进行处理时
{ 
	function_exists('curl_init') && $LabelArray['内容'] = 'CURL加载成功'; // 测试扩展是否加载成功
}
else
{
	function_exists('curl_init') &&	$LabelArray['Html'].='  CURL加载成功';
}
echo serialize($LabelArray); // 打印数据让采集器读取
?>