<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$hurl = $_SERVER['HTTP_REFERER'];//来源;
$wangzhi = $_SERVER['SERVER_NAME'];
$userid=$_COOKIE[uid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$id=$_POST[id];
$terrace=$_POST[terrace];
if (empty($id))
{$id=$_GET[id];}
$uid=$_POST[uid];
$pay=$_POST[pay];
if (empty($pay))
{$pay=$_GET[pay];}
$url=$_POST[url];
if (empty($url))
{$url=$_GET[url];}
$pid=$_POST[pid];
if (empty($pid))
{$pid=$_GET[pid];}
$qdfk=$_REQUEST[qdfk];
$money=$_REQUEST[money];
$hycs="where id='1'";
$hy=queryall(ubozf,$hycs);
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$money1=$hy[money1];
$money2=$hy[money2];
$money3=$hy[money3];
$money4=$hy[money4];
$hytime1=$hy[hytime1];
$hytime2=$hy[hytime2];
$hytime3=$hy[hytime3];
$hytime4=$hy[hytime4];
$hyzf="where id='1'";
$zf=queryall(se2zf,$hyzf);
$zhifu=$zf[zhifu];
$alipay=$zf[alipay];
$weixin=$zf[weixin];
function random($length, $chars) {
$hash = '';
$max = strlen($chars) - 1;
for($i = 0; $i < $length; $i++) {
$hash .= $chars[mt_rand(0, $max)];
}
return $hash;
}
if($pid && $qdfk==1)
{
$ddzt=1;
$type="ddzt='$ddzt',remind='1' where pid='$pid'";
upalldt(ubotj,$type);
echo msglayerurl("申请成功待核实！",8,"$url");
exit;
}
if($uid && $id)
{
$pid=random(10, '0123456789');
$ddzt=0;
$time=time();
if ($id==1){$money=$money1;}elseif ($id==2){$money=$money2;}elseif ($id==3){$money=$money3;}elseif ($id==4){$money=$money4;}
if (empty($pay) && $terrace)
{
$ddzt=0;
$terrace=intval($_REQUEST[terrace]);
$type=intval($_REQUEST[id]);
$ter=getone("select * from uboterrace WHERE small_id=".$terrace." and type=".$type);
if ($ter)
{
$ulr="kami.php?type=".$type."&terrace=".$terrace."&pid=".$pid;
$type="(`id`, `pid`, `uid`, `money`, `leixing`, `ddzt`, `zffs`, `addtime`,`remind`) VALUES (null,'$pid','$uid','$money','$id','$ddzt','$pay','$time','1')"; 
dbinsert(ubotj,$type);
echo msglayerurl("发卡平台连接中...",8,"$ulr");}
else
{echo msglayer("发卡平台缺货！",8);}
exit;
}
else
{
$httpurl="?id=$id&pid=$pid&pay=$pay&money=$money&url=$url";
$type="(`id`, `pid`, `uid`, `money`, `leixing`, `ddzt`, `zffs`, `addtime`,`remind`) VALUES (null,'$pid','$uid','$money','$id','$ddzt','$pay','$time','1')"; 
dbinsert(ubotj,$type);
echo msglayerurl("订单创建成功！",8,"$httpurl");
exit;
}
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-会员升级</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<?php if ($zhifu==5){?>
<script type="text/javascript">
$(document).ready(function()
{
    $("#pay label").click(function()
    {
		var id=$(this).attr('id');
        document.getElementById('fee').value=id;
    });
});  
</script>
<?php }?> 
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

.qx {color: #999;}

</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">会员升级</i>
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
<a href="user_pay.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">会员升级</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_gold.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">金币充值</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_pay_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">财务记录</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style="margin-top: 2.2%;"> 
<form id="Form1" method="post" action="<?php if($zhifu==5){echo "pay.php";}?>" style="padding:0 10px;" <?php if($zhifu<5){?>target="msgubotj"<?php }?>>
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<?php if($id && $pay){?>
<?php if($pay==1)
{
		require_once('native.php');
		$w_url=urlencode($url2);
		fopen('data/wxpay/'.$pid.'.tmp', "w") or die("无法打开缓存文件!");
		setcookie("wxpay_no",$pid,time()+3600);
}
?>
<tr>
<td  height="50" align="center"><strong><?php if($pay==1){echo "微信支付";}elseif ($pay==2){echo "支付宝支付";}?></strong></td>
</tr>
<tr>
  <td  height="15" align="center"><img id="ewm" width="149" height="149" src="<?php if($pay==1){echo "/".$weixin;}elseif($pay==3){echo "/wxpay/url_qrcode.php?url=".$w_url;}elseif ($pay==2){echo "/".$alipay;}?>"></td>
</tr>
<tr>
  <td  height="30" align="center" style="color:#FF0000;font-size:14px;">需要支付 <?php echo $money;?> 元 </td>
</tr>
<tr>
  <td  height="30" align="center" style="color:#FF0000;font-size:14px;">扫描二维码 / 长按图片保存后扫描支付<input name="qdfk" type="hidden" value="1"><input name="pid" type="hidden" value="<?php echo $pid?>"><input name="url" type="hidden" value="<?php echo $url;?>"></td>
</tr>
<tr>
<td  height="50" align="center" valign="middle"><input type="submit" id="submit" value="支付后确认" class="user_reg_but" style="width:120px;"></td>
</tr>
<?php }else{?>
<tr>
<td  height="50" style="border-bottom:1px solid #F6F6F6;"><strong>会员类型</strong></td>
</tr>
<tr>
<td  height="50" ><div id="pay">
<label id="<?php echo $money1;?>"><input name="id" type="radio" value="1" checked>
    <?php echo $member1;?> <span class="qx">（有效期<?php echo $hytime1;?>天）</span>￥<?php echo $money1;?>元</label>
<label id="<?php echo $money2;?>"><input type="radio" name="id" value="2">
    <?php echo $member2;?> <span class="qx">（有效期<?php echo $hytime2;?>天）</span>￥<?php echo $money2;?>元</label>
<label id="<?php echo $money3;?>"><input type="radio" name="id" value="3">
    <?php echo $member3;?> <span class="qx">（有效期<?php echo $hytime3;?>天）</span>￥<?php echo $money3;?>元</label>
<label id="<?php echo $money4;?>"><input type="radio" name="id" value="4">
  <?php echo $member4;?> <span class="qx">（有效期<?php echo $hytime4;?>天）</span>￥<?php echo $money4;?>元</label>
</div></td>
</tr>
<tr>
  <td height="50" align="left" valign="middle" style="border-bottom:1px solid #F6F6F6;"><strong><?php if ($zhifu==4){echo "发卡平台";}else{echo "支付方式";}?></strong></td>
</tr>
<?php if ($zhifu==4){?>
<tr>
  <td height="50" align="left" valign="middle" style="border-bottom:1px solid #F6F6F6;">
<select name="terrace" style="width:270px;padding:4px 0px 4px 6px; height:36px; line-height:24px; border:none;border:1px solid #d2d2d2;-moz-appearance: none;appearance:none;-webkit-appearance:none; background:url(/img/shop_icon.png) no-repeat 104% -206px #fff; color:#222; border-radius:3px; font-size:14px;background-position:250px -206px!important;margin:0px;" >
<?php
$query = mysql_query("SELECT * FROM uboterrace where small_id=0 order by sort desc");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>" ><?php echo $a[name]?></option>
<?php }?>
</select></td>
</tr>
<?php }?>
<?php if ($zhifu==1 || $zhifu==3){?>
<tr>
  <td height="36" align="left" valign="middle" style="border-bottom:1px solid #F6F6F6;"><label><input name="pay" type="radio" value="1" <?php if ($zhifu==1 || $zhifu==3){?>checked<?php }?> >
    微信支付</label></td>
</tr>
<?php }?>
<?php if ($zhifu==2 || $zhifu==3){?>
<tr>
  <td height="36" align="left" valign="middle" style="border-bottom:1px solid #F6F6F6;"><label><input type="radio" name="pay" value="2" <?php if ($zhifu==2){?>checked<?php }?> >
支付宝支付</label></td>
</tr>
<?php }?>
<?php if ($zhifu==5){?>
<tr>
  <td height="36" align="left" valign="middle" style="border-bottom:1px solid #F6F6F6;"><label><input name="type" type="radio" value="Wechatnative" checked>
    微信支付</label></td>
</tr>
<tr>
  <td height="36" align="left" valign="middle" style="border-bottom:1px solid #F6F6F6;"><label><input type="radio" name="type" value="Alipay" >
支付宝支付</label></td>
</tr>
<?php }?>
<tr>
<td height="60" align="center" valign="middle"><input name="uid" type="hidden" value="<?php echo $neirong[id]?>"><input name="url" type="hidden" value="<?php echo $hurl;?>"><?php if ($zhifu==5){?><input name="fee" id="fee" type="hidden" value="<?php echo $money1;?>"><?php }?>
  <input type="submit" id="submit" value="升级会员" class="user_reg_but" style="width:120px;"></td>
</tr>
<?php }?>
</tbody></table>
</form>
</section>
<script type="text/javascript">
window.setInterval(run, 880000);
function run(){
    $.get("pay_ajax.php?act=check_weixinpay_notify",function(data){
        if(data!="1"){
            location.href=data;
        }
   });
 }
</script>
<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
