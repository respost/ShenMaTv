<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/*
*外部编程接口处理标签内容示范文件																											
*该文件内自动系统的三个参数$LabelArray $LabelCookie,$LabelUrl
*对任意采集的标签都适用请对标签内容处理后直接将该数组serialize($LabelArray)输出，
*采集器内部即可接收到该标签的内容，对比以前的接口规则，新规则可以实现标签之间的数据调用和处理														
*参数说明：																																			
  *$LabelArray    -  标签名及标签内容集合 结构如：Array('栏目id' => 2,'出处'=>  '新浪微博','内容'=>'<center><b>暴笑短信')  ##
  *$LabelCookie   -  对应采集中用到的Cookie值							
  *$LabelUrl      -  当前采集的页面的Url地址 
  * 特别注意:如果是处理列表页,默认页,多页时会有以下两个标签
    $LabelArray['Html']       网页的源代码,没有经过采集器处理的,直接下载后的数据.修改这里的数据,请将新值赋予$LabelArray['Html']
    $LabelArray['PageType']   值可能为 List, Pages, Content 分别代表处理列表页,多页,默认页																				
*以上语句建议不更改,以下为用户操作区域  该区域只限对数组值进行操作，不得有打印输出产生，不得直接增加或删除相应标签名
*/
if($LabelArray['Html'])
{
	$LabelArray['Html']='当前页面的网址为:'.$LabelUrl."\r\n页面类型为:".$LabelArray['PageType']."\r\nCookies数据为:$LabelCookie\r\n接收到的数据是:".$LabelArray['Html'];
}
else
{
	isset($LabelArray['内容']) && $LabelArray['内容'] = $LabelArray['标题'].$LabelArray['内容'];  //★★★★★★注意这句。V2009SP2版后可实现多标签之间的相互调用★★★★★★
	isset($LabelArray['内容']) && $LabelArray['内容'] = str_replace('旧字符串','新字符串',$LabelArray['内容']); //简单替换一下

	isset($LabelArray['标题']) && $LabelArray['标题'] =  '【给标题标签加个前缀】'.$LabelArray['标题'];

	isset($LabelArray['时间']) && $LabelArray['时间'] =date('Y-m-d H:i:s',time()); //不用标签内容，直接获取time()函数得到的当前时间，用Y-m-d H:i:s格式输出，如2008-05-28 00:12:23
}
//#############以上为用户操作区域#############################################################################################################################
//#############以下语句必须保留，建议不更改###################################################################################################################
//ob_clean();
echo serialize($LabelArray);
?> 