<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$id=rand(1000,90000);
$cishu=rand(1,10000);
$rfr = $_SERVER['HTTP_REFERER'];//来源;
$userid=$_COOKIE[uid];
$time=time();
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$jilu=getone("select * from ubofx WHERE promo='".$userid."'");
if ($jilu)
{
$url=$jilu[url];
$people=$jilu[people];
$money=round($jilu[money],0);
$withdrawal=$jilu[withdrawal];
$status=$jilu[status];
$divide=$jilu[divide];
$level=$jilu[level];
$grade=$jilu[grade];
$amount=$jilu[amount];
$upgrade=$jilu[upgrade];
$sjjy=$grade*200;
if ($upgrade>=$sjjy)
{
//$sjjy=round($upgrade-$sjjy);
$type="grade=grade+1,upgrade=upgrade-$sjjy where promo='".$userid."'";
upalldt(ubofx,$type);
}
}else{
$hycs="where id='1'";
$hy=queryall(ubofxfc,$hycs);
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$money1=$hy[money1];
$money2=$hy[money2];
$money3=$hy[money3];
$money4=$hy[money4];
$hydivide1=$hy[hydivide1];
$hydivide2=$hy[hydivide2];
$hydivide3=$hy[hydivide3];
$hydivide4=$hy[hydivide4];
$status=0;
}

if($_POST[add])
{
$fxid=$_POST[id];
$hycs="where id='1'";
$hy=queryall(ubofxfc,$hycs);
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$money1=$hy[money1];
$money2=$hy[money2];
$money3=$hy[money3];
$money4=$hy[money4];
$hydivide1=$hy[hydivide1];
$hydivide2=$hy[hydivide2];
$hydivide3=$hy[hydivide3];
$hydivide4=$hy[hydivide4];
if ($fxid==1){$divide=$hydivide1;$member=$member1;$money=$money1;}elseif ($fxid==2){$divide=$hydivide2;$member=$member2;$money=$money2;}elseif ($fxid==3){$divide=$hydivide3;$member=$member3;$money=$money3;}elseif ($fxid==4){$divide=$hydivide4;$member=$member4;$money=$money4;}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
$uid=$neirong[id];
$user=$neirong[user];
$surplus=$neirong[money];
$fx_uid_1=intval($neirong[fx_uid_1]);
$fx_uid_2=intval($neirong[fx_uid_2]);
$fx_uid_3=intval($neirong[fx_uid_3]);
if ($userid && $surplus>=$money)
{
$web=$_SERVER['HTTP_HOST'];
$url="http://".$web."/?dt=".$userid;
$api = base64_decode('aHR0cDovL2FwaS50LnNpbmEuY29tLmNuL3Nob3J0X3VybC9zaG9ydGVuLmpzb24/c291cmNlPTMxNjQxMDM1JnVybF9sb25nPQ==');
$ret = file_get_contents($api.$url);
$url_1 = explode(',',$ret);
$url = $url_1[0];
$url = str_replace("[{\"url_short\":\"","",$url);
$url = str_replace("\"","",$url);
$tdate2=date("Y-m-d",strtotime("+1 day"))." 00:00:01";
$settr2=strtotime($tdate2);
$type="(`id`, `uid`, `promo`,`user`,`url`,`people`,`money`,`withdrawal`,`divide`,`level`,`status`,`addtime`,`renew`,`contents`,`fx_uid_1`,`fx_uid_2`,`fx_uid_3`) VALUES (null,'$uid','$userid','$user','$url','0','0', '0', '$divide', '$member', '1', '$time','$settr2','分销','$fx_uid_1','$fx_uid_2','$fx_uid_3')";
dbinsert(ubofx,$type);
$djfc=round(25/99,2);
if ($fx_uid_1>0)
{
$fx=getone("select * from ubofx WHERE uid=".$fx_uid_1);
//$money=$money*($divide/100);
$divide_1=$fx[divide];
$grade_1=$fx[grade];
$djfc_1=$grade_1*$djfc;
$fx_money_1=$money*(($divide_1+$djfc_1)/100);
$upgrade_1=$money*1;
$type="money=money+$fx_money_1,upgrade=upgrade+$upgrade_1,people=people+1 where uid=".$fx_uid_1;
upalldt(ubofx,$type);
$type="(`id`, `uid`,`user`,`money`,`addtime`,`contents`,`upgrade`) VALUES (null,'$fx_uid_1','$user','$fx_money_1','$time','明细','$upgrade_1')";
dbinsert(ubofxmx,$type);
}
if ($fx_uid_2>0)
{
$fx=getone("select * from ubofx WHERE uid=".$fx_uid_2);
//$money=$money*($divide/100);
$divide_2=$fx[divide];
$grade_2=$fx[grade];
$djfc_2=$grade_2*$djfc;
$fx_money_2=$money*((($divide_2+$djfc_2)/2)/100);
$upgrade_2=$money*0.5;
$type="money=money+$fx_money_2,upgrade=upgrade+$upgrade_2,people=people+1 where uid=".$fx_uid_2;
upalldt(ubofx,$type);
$type="(`id`, `uid`,`user`,`money`,`addtime`,`contents`,`upgrade`) VALUES (null,'$fx_uid_2','$user','$fx_money_2','$time','明细','$upgrade_2')";
dbinsert(ubofxmx,$type);
}
if ($fx_uid_3>0)
{
$fx=getone("select * from ubofx WHERE uid=".$fx_uid_3);
//$money=$money*($divide/100);
$divide_3=$fx[divide];
$grade_3=$fx[grade];
$djfc_3=$grade_3*$djfc;
$fx_money_3=$money*((($divide_3+$djfc_3)/3)/100);
$upgrade_3=$money*0.3;
$type="money=money+$fx_money_3,upgrade=upgrade+$upgrade_3,people=people+1 where uid=".$fx_uid_3;
upalldt(ubofx,$type);
$type="(`id`, `uid`,`user`,`money`,`addtime`,`contents`,`upgrade`) VALUES (null,'$fx_uid_3','$user','$fx_money_3','$time','明细','$upgrade_3')";
dbinsert(ubofxmx,$type);
}
$type="money=money-$money where id=".$uid;
upalldt(ubouser,$type);
$people=0;
$money=0;
$withdrawal=0;
$status=1;
echo msglayerurl("申请成功，待审核！",8,"user_distributor.php");
exit;
}else{
echo msglayer("余额不足！",8);
exit;
}

}
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-分销推广</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<script type="text/javascript" src="/dist/webuploader.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script type="text/javascript" src="/js/clipboard.js"></script>
<?php include_once('../include/css.php'); ?> 
<script type="text/javascript">  
function copyUrl()  
{  
    var copyBtn = document.getElementById('copyBtn');
    var clipboard = new ClipboardJS(copyBtn);
	clipboard.on('success', function(e) {
    alert("推广链接复制成功！");  
    e.clearSelection();
	});
	clipboard.on('error', function(e) {
		alert("推广链接复制成功！");  
	});
 /*
  var Url=document.getElementById("name");  
  Url.select(); 
  document.execCommand("Copy");
  alert("推广链接复制成功！");  
  */
}  
</script>
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
.a-upload {
    padding: 5px 5px;
    height: 26px;
    line-height: 26px;
    position: relative;
    cursor: pointer;
    color: #888;
    background: #fafafa;
    border: 1px solid  rgba(0, 0, 0, .2);
    border-radius: 4px;
    overflow: hidden;
    display: inline-block;
    *display: inline;
    *zoom: 1
}
.a-upload:hover {
    color: #444;
    background: #eee;
    border-color: #ccc;
    text-decoration: none
}
.btn {
    display: inline-block; width:30%;padding: 6px 0;margin-bottom: 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer; background-image: none;border: 1px solid transparent;border-radius: 4px; -webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;user-select: none; float: left; margin-left:2%;}
.btn-default{text-shadow:0 1px 0 #fff;background-image:-webkit-linear-gradient(top,#fff 0,#e0e0e0 100%);background-image:linear-gradient(to bottom,#fff 0,#e0e0e0 100%);background-repeat:repeat-x;border-color:#dbdbdb;border-color:#ccc;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe0e0e0',GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled=false);}
.btn-default:hover{background-color:#e0e0e0;background-position:0 -15px;}
.webuploader-container {
	position: relative;  overflow:hidden; float: left;
}
.webuploader-element-invisible {
	position: absolute !important;
	clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
    clip: rect(1px,1px,1px,1px);
}
.webuploader-pick {
	position: relative;
	display: inline-block;
	cursor: pointer;
	background: #d64f4f;
	padding: 5px 11px;
	color: #fff;
	text-align: center;
	border-radius: 3px;
	overflow: hidden;
	font-size:16px;
}
.webuploader-pick-hover {
	background: #d64f4f;
}

.webuploader-pick-disable {
	opacity: 0.6;
	pointer-events:none;
}
.item{position: relative;padding:5px 1%;line-height: 23px; height: 23px;border: 1px solid rgba(0, 0, 0, .2);border-radius: 3px; overflow:hidden; width:65%; float:left; }
.item .state{position: absolute;padding:0 6px;top:0;right:0; background-color:#d64f4f; height:33px; line-height:33px;border-radius: 0; color:#FFFFFF;}
.item .info{ line-height:25px;}

.progress{position: absolute; width:100%; height:33px; background-color:#fff; left:0; top:0;}
.progress .progress-bar{width:0%;height:33px; background-color:#d64f4f;}

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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">分销推广</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('../include/column.php'); ?>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="/vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="请输入视频关键字" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>搜索
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
<a href="user_distributor.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">分销推广</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_distributor_staff.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">推广会员</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_distributor_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">入账明细</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_distributor_apply.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">申请提现</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_distributor_distill.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">提现明细</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div>
<?php if ($status==0){?>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2">
开通步骤：<br>
<font color="#FF0000">1：申请分销</font> >> 2：申请审核 >> 3：开通服务  
</td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="220" colspan="2" align="center">
  <form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
  <td height="40" align="center"><label><input name="id" type="radio" value="1" checked>
    <?php echo $member1;?> <span class="qx">（基础分成<?php echo $hydivide1;?>%）</span>￥<?php echo $money1;?>元</label></td>
</tr>
<tr>
  <td height="40" align="center"><label><input name="id" type="radio" value="2">
    <?php echo $member2;?> <span class="qx">（基础分成<?php echo $hydivide2;?>%）</span>￥<?php echo $money2;?>元</label></td>
</tr>
<tr>
  <td height="40" align="center"><label><input name="id" type="radio" value="3">
    <?php echo $member3;?> <span class="qx">（基础分成<?php echo $hydivide3;?>%）</span>￥<?php echo $money3;?>元</label></td>
</tr>
<tr>
  <td height="40" align="center"><label><input name="id" type="radio" value="4">
    <?php echo $member4;?> <span class="qx">（基础分成<?php echo $hydivide4;?>%）</span>￥<?php echo $money4;?>元</label></td>
</tr>
<tr>
<td height="40" align="center">
  <input name="add" type="hidden" value="申请分销">
  <button type="submit" id="submit" class="oy-btn oy-btn-lg">申请分销</button></td>
</tr>
</tbody></table>
</form>
  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
分成说明：基础分成+等级加成。
  </td>
  </tr>
</table>
</section>
<?php }else if($status==1){?>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
开通步骤：1：申请分销 >> <font color="#FF0000">2：申请审核</font> >> 3：开通服务  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="220" colspan="2" align="center">
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<tr>
  <td height="40" align="center"><?php echo $level;?> （基础分成<?php echo $divide;?>%）</td>
</tr>
<tr>
<td height="40" align="center">
  <input type="button" id="submit" name= "add" value="申请审核中" class="user_reg_but" style="width:120px;"></td>
</tr>
</tbody></table>
  </td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="60" colspan="2" align="center">
分成说明：一级分销商<?php echo $divide;?>%收入分成，二级分销商<?php echo round($divide*0.5, 2);?>%收入分成，三级分销商<?php echo round($divide*0.3, 2);?>%收入分成。
  </td>
  </tr>
</table>
</section>
<?php }else if($status==2){?>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="90%" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
  <td height="27" align="left" width="45%">下线人数：<?php echo $people;?> 人</td>
  <td height="27" align="left">可提金额：<?php echo $money;?> 元</td>
  </tr>
<tr style="border-top: 1px solid #F6F6F6;">
  <td align="left">分销等级：<?php echo $grade;?> 级</td>
  <td align="left">分成比例：<?php echo $divide;?> % + <?php $djfc=round(25/99,2);$djfc=$grade*$djfc;echo $djfc;?> %</td>
  </tr>
<tr style="border-top: 1px solid #F6F6F6;display:none;">
  <td align="left">升级所需：<?php $sjsx=$grade*200;?><?php echo round($sjsx-$upgrade);?> 经验</td>
  <td align="left">已提金额：<?php echo $withdrawal;?> 元</td>
  </tr>
<tr style="border-top: 1px solid #F6F6F6;">
  <td colspan="2" align="left"><?php $sjsx=$grade*200;$sjwcd=round($sjsx-$upgrade);$jdt=round(($upgrade/$sjsx)*100);?><div class="sy"><div class="p"><div class="p_1">升级经验：</div><div class="p_2"><span style="width:<?php echo $jdt;?>%"></span><div class="p_3"><?php echo $jdt;?>%</div></div></div></div></td>
  </tr>
</table>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<form method="post" action="" style="padding:0 10px;" target="msgubotj" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td  height="15" width="30%" ></td>
<td width="70%"></td>
</tr>
<tr>
  <td height="40" align="right" valign="middle">分销链接：</td>
  <td><textarea name="name" class="make_resume_input" id="name" style="width:80%; height:50px;margin-bottom: 0;resize: none;" onClick="copyUrl2()"><?php echo $url ?> 玩视频转大钱，真心觉得不错，快去看看吧！</textarea></td>
</tr>
<tr>
<td align="right" valign="top" style="padding-top:6px;">二维码：</td>
<td><img src="qrcode.php?url=<?php echo $url ?>" width="150" height="150" style="border: 1px solid rgba(0, 0, 0, .2); padding:4px; margin-top:5px;"></td>
</tr>

<tr>
<td height="50" colspan="2" align="center" valign="middle" style="padding-top:6px;">
   <button  id="copyBtn" data-clipboard-action="copy" data-clipboard-target="#shareUrl"  class="oy-btn oy-btn-lg" onClick="copyUrl()">复制链接</button></td>
</tr>
</tbody></table>
</form>
</section>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td height="40">复制宣传代码发给QQ好友、微信好友、QQ群、微信群，被好友或其他用户通过链接访问，您可以获得该用户的上级代理权限，该用户开通分销即可获得分成，分成说明：基础分成+等级加成。</td>
</tr>
</table>
</section>
<?php }else{?>
<?php }?>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
