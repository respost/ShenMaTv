<?php
require('class/connect.php');
require('class/db_sql.php');
require('class/functions.php');
$lur=islogin();
$loginin=$lur['username'];
$rnd=$lur['rnd'];
$link=db_connect();
$empire=new mysqlquery();
$mydbname=RepPostVar($_GET['mydbname']);
if(empty($mydbname))
{
	printerror("NotChangeDb","history.go(-1)");
}
//选择数据库
$udb=$empire->query("use `".$mydbname."`");
//存放目录
$mypath=$mydbname."_".date("YmdHis");
if($phpsafemod)
{
	$mypath="safemod";
}
//导入设置
$loadfile=RepPostVar($_GET['savefilename']);
if(strstr($loadfile,'.')||strstr($loadfile,'/')||strstr($loadfile,"\\"))
{
	$loadfile='';
}
if(empty($loadfile))
{
	$loadfile='def';
}
$loadfile='setsave/'.$loadfile;
@include($loadfile);
if($dmypath)
{
	$mypath=$dmypath;
}
//查询
$keyboard=RepPostVar($_GET['keyboard']);
if(empty($keyboard))
{
	$keyboard=$dkeyboard;
	if(empty($keyboard))
	{
		$keyboard=$baktbpre;
	}
}
$and="";
if($keyboard)
{
	$and=" LIKE '%$keyboard%'";
}
$sql=$empire->query("SHOW TABLE STATUS".$and);
require LoadAdminTemp('eChangeTable.php');
db_close();
$empire=null;
?>