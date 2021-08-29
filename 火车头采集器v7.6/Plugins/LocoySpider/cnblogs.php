<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

switch($LabelArray['PageType'])
{
	case 'List'://处理列表页，只能处理html
		$LabelArray['Html']='id="post_list"><a href="http://www.cnblogs.com/rq204/archive/2012/01/02/2310113.html">测试的网址的</a><id="pager_block">';
		break;
	case 'Pages'://处理多页，只能处理html
		$LabelArray['Html']=str_replace('入园时间：</span>','入园时间：</span>插件添加在多页时间前:',$LabelArray['Html']);
		break;
	case 'Content'://处理默认页，只能处理html
		$LabelArray['Html']=str_replace('<title>','<title>默认页给标题加个前缀:',$LabelArray['Html']);
		break;
	case 'Save'://只有保存时是可以处理标签值的
		isset($LabelArray['作者']) && $LabelArray['作者'].=' 保存时您可以修改任意标签的值';
		break;
}

echo serialize($LabelArray);
?>