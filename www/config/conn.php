<?php

////////////////////////////这里信息根据自己的实际情况可以修改//////////////////////////////////
$localhost = "127.0.0.1";  //服务器地址，一般为localhost
$root = "root";            //服务器MYSQL登陆用户名
$password = "123456";      //服务器的MYsQL登陆密码
$database = "tv_db";       //你使用的数据库
////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////以下内容,非专业人员请不要修改，避免错误////////////////////////////////
$conn = @mysql_connect("$localhost","$root","$password") or die ("数据库连接出错，请检查");
@mysql_select_db("$database",$conn) or die ("数据库表不存在或者未连接");
mysql_query("set names gbk"); //使用GBK中文件编码，防止出错
////////////////////////////////////////////////////////////////////////////////////////////////
?>