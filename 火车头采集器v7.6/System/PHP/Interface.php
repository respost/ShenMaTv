<?php
if ($argc != 5)
{
?>
  接口文件PHP执行脚本文件
  使用方法:
  <?php echo $argv[0]; ?> <option> 个参数列表

  <option> LabelArray - 标签数组序列化后的字符串
  <option> LabelCookie - 标签Cookie
  <option> LabelUrl - 当前页地址
  <option> InterfaceFile - 接口文件名

<?php
}
else
{
	$InterFaceFile=iconv("UTF-8", "GBK//IGNORE", urldecode($argv[1]));
	$LabelCookie = urldecode($argv[2]);
	$LabelUrl = urldecode($argv[3]);
	$SerializerStr = urldecode($argv[4]);

	if(substr($SerializerStr,0,2)!="a:")
	{
		$file=$SerializerStr;
		$SerializerStr=file_get_contents($SerializerStr);
		$SerializerStr = urldecode($SerializerStr);
		unlink($file);
	}

	$LabelArray = unserialize($SerializerStr);
	include  $InterFaceFile;
}
?>