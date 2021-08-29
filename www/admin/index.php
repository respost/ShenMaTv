<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
if($_POST[btnPost]){
$user=$_POST[username];
$newpass=md5($_POST[password]);
$type="WHERE name='$user'";
$row=queryall(uboadmin,$type);  
if($user==null){
echo msglayer("用户名不能为空！",6);
}elseif($newpass==null){
echo msglayer("密码不能为空！",6);
}elseif($row[pass]==$newpass and $row[name]==$user){
setcookie("adminname", $user,time()+7200);
echo msglayerurl("恭喜你账户登录成功，马上进入管理页面",4,"home.php");
 }else{
echo msglayer("SORRY！用户名或者密码错误,请重新输入",6);
 }
}
?>

<html>
<head>
<title>管理后台</title>
<style>
html,body,div,p,form,span,input,h3{margin:0;padding:0;font-family:Microsoft Yahei;}
body{background:url(images/bg.jpg) no-repeat scroll center top;}
.box{margin:0 auto;width:450px;border:5px solid #e1cfb6;border-radius:5px;box-shadow:5px #fff;height:300px;background:#f8f8f8;margin-top:200px;box-shadow:0 0 70px #111;background: #7FB2A4; background: rgba(0,0,0,0.1);box-shadow: 0 0 5px rgba(0,0,0,0.1);border: 1px solid rgba(255,255,255,0.1);-webkit-border-radius: 15px 15px 0 0; -moz-border-radius: 15px 15px 0 0; border-radius: 15px 15px 0 0;}
input{opacity: 0.6;width: 260px;height: 40px;color: #999;font-weight: 400;font-family: Microsoft Yahei;outline: none; padding: 10px;line-height: 40px; border: 0;color: #333;font-size: 13px;box-shadow: 1px 1px 1px rgba(0,0,0,0.3);background: #FAFAFA;}
p{height:36px;line-height:36px;margin-bottom:30px;margin-top:30px;}
h3{background:#ff5500;height:60px; font-size:22px; letter-spacing:2px;color:#fff;line-height:60px;font-weight:bold;text-align:center;width: 100%;display: block;cursor: pointer;text-align: center;background: #7FB2A4;background: rgba(0,0,0,0.1);box-shadow: 0 0 5px rgba(0,0,0,0.1); border: 1px solid rgba(255,255,255,0.1);-webkit-border-radius: 15px 15px 0 0;-moz-border-radius: 15px 15px 0 0;border-radius: 15px 15px 0 0;}
span{color:#a97c50;display:block;float:left;font-size: 14px;font-weight:bolder;text-align:right;width:120px;}
.btn{opacity: 0.6;width: 260px;height: 40px;cursor: pointer;text-align: center;color: rgb(255, 255, 255);border-image-source: initial;border-image-slice: initial;border-image-width: initial;border-image-outset: initial;border-image-repeat: initial;box-shadow: rgba(0, 0, 0, 0.298039) 1px 1px 1px;border-width: initial;border-style: none;border-color: initial;background: rgb(255, 153, 204);font: 16px 'MicroSoft Yahei', 宋体, 宋体;margin: 0 0 30px 0;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Cache-Control" content="no-store"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
<link href="new/ui.css" type="text/css" rel="stylesheet"/>
<link href="new/style.css" type="text/css" rel="stylesheet"/>
<SCRIPT language=javascript src="../app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="../app/layer/layer.js"></SCRIPT>
</head>
<body  style="margin:0 auto;" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="myonload()">
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div>
<div style='text-align:center;'>
<div class='box'>
<h3>管理后台</h3>
<form  method="post" action="" target="msgubotj">
<p><input name="username" value=""  id="username" type="text" > </p>
<p><input name="password" type="password" id="password"  ></p> 
<p><input  id="btnPost" name="btnPost" type="submit"  class="btn" value="登 录"/></p>
</form>
</div>
</div>
</body>
</html>