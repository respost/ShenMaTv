<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$rfr = $_SERVER['HTTP_REFERER'];//��Դ;
$userid=$_COOKIE[uid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$url=$_POST[url];
$money=$_POST[money];
$content=$_POST[content];
$number=$_POST[number];
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$avatar=$neirong[avatar];
$name=$neirong[name];
if (empty($name))
{$name=$neirong[user];}
$uid=$neirong[id];
$yue=$neirong[money];
if ($yue<$money){
echo msglayer("���㣬���ȳ�ֵ��",8);
exit;
}
if($number>1 && $money>0 && ($yue>=$money))
{
if ($money>0.99 && $money<1000 && $number>1)
{
$time=time();
$type="money=money-$money where id='$uid'";
upalldt(ubouser,$type);
$type="(`id`, `uid`, `name`, `thname`, `avatar`, `money`, `number`, `surplus`, `balance`, `addtime`) VALUES (null,'$uid','$content','$name','$avatar','$money','$number','$number','$money','$time')"; 
dbinsert(ubopacket,$type);
echo msglayerurl("������ųɹ���",8,"$url");
exit;
}
else
{
if ($money<1){
echo msglayer("��������ܵ���1Ԫ��",8);
exit;
}
if ($money>999){
echo msglayer("��������ܸ���999Ԫ��",8);
exit;
}
if ($number<2){
echo msglayer("������Ҫ����2�������",8);
exit;
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>��Ա����-�����</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<?php include_once('../include/css.php'); ?> 
<style>
.open_vip{
background-color: lightcyan;;
}
.ui-border li i em{
font-size: 0.75rem;
}
.aboutpic li{
margin-top: 0.6rem
}
.aboutpic li i img{
width: 2.5rem;
height: 2.5rem;
}
</style>
<script src="/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function()
{
    $("#avatar li").click(function()
    {
        $("#avatar li").removeClass("select");
        $(this).addClass("select");
		var id=$(this).attr('id');
        document.getElementById('avatar_id').value=id;
    });
});  
</script>

</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">�����</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('../include/column.php'); ?>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="/vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="��������Ƶ�ؼ���" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>����
</button>
</div>
</form>
</div>
<?php include_once('../include/nav_s.php'); ?>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1></h1>
</header>
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_packet_send.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_packet.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_packet_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����¼</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%;"> 
<form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
<td  height="15" width="30%" ></td>
<td width="70%"></td>
</tr>
<tr>
  <td align="right">���������</td>
  <td><input name="number" type="text" id="number" onkeyup='this.value=this.value.replace(/\D/gi,"")' value="5" class="make_resume_input" style="width:80%;"> ��</td>
</tr>
<tr>
  <td align="right">�ܽ�</td>
  <td><input name="money" type="text" id="money" onkeyup='this.value=this.value.replace(/\D/gi,"")' value="1" class="make_resume_input" style="width:80%;"> Ԫ</td>
</tr>
<tr>
<td align="right">���ԣ�</td>
<td><input name="content" type="text" id="content" value="��ϲ���ƣ��󼪴�����" class="make_resume_input" style="width:80%;"></td>
</tr>

<tr>
<td align="right"></td>
<td height="50" valign="middle"><input name="url" type="hidden" value="<?php echo $rfr;?>">
  <button type="submit" id="submit" class="oy-btn oy-btn-fluid-sm" style="width:80%;">��Ǯ�����</button></td>
</tr>
</tbody></table>
</form>
</section>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
