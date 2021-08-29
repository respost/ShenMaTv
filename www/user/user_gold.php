<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$hurl = $_SERVER['HTTP_REFERER'];//来源;
$userid=$_COOKIE[uid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$money=$_POST[money];
$lanmu=$_GET[type];
if (empty($money))
{$money=$_GET[money];}
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
	if ($lanmu){
	switch ($lanmu){
	case '1':
 	$lmwj= 'play';
	break;
  	case '2':
	$lmwj= 'tvplay';
	break;
	case '3':
	$lmwj= 'movieplay';
	break;
	case '4':
	$lmwj= 'comicplay';
	break;
	case '5':
	$lmwj= 'images';
	break;
	case '6':
    $lmwj= 'entplay';
	break;
	case '7':
    $lmwj= 'mvplay';
	break;
	case '8':
    $lmwj= 'xcplay';
	break;
	}}
	$urlis=substr_count($url,'gm.php');
	if ($urlis==1){
		$url=str_replace("plus/gm.php?id",$lmwj.".php?playid",$url."&ly=ubosk"); 
	}else{
		$url="/user/";
	}
	echo msglayerurl("申请成功待核实！",8,"$url");
	exit;
}

if($uid)
{	
	if($pay==3){
		card();//卡密支付
	}else{
		if($money){
			$pid=random(10, '0123456789');
			$ddzt=0;
			$leixing=5;
			$time=time();
			$httpurl="?pid=$pid&pay=$pay&money=$money&url=$url";
			$type="(`id`, `pid`, `uid`, `money`, `leixing`, `ddzt`, `zffs`, `addtime`,`remind`) VALUES (null,'$pid','$uid','$money','$leixing','$ddzt','$pay','$time','1')"; 
			dbinsert(ubotj,$type);
			echo msglayerurl("订单创建成功！",8,"$httpurl");
			$httpurl="?pid=$pid&pay=$pay&money=$money&url=$url";
			exit;
		}else{
			echo msglayer("请输入要充值的金额！",8);
			exit;
		}
	}
}
$type="where userid='$userid'";
$neirong=queryall(ubouser,$type);
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-金币充值</title>
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
.qx {color: #999;}
.info{
	font-size:14px;
	color:#333;
	height:30px;
	line-height:30px;
	background-color:#fff;
	text-align: center;
	border-top: 1px dashed #ccc;
	border-bottom: 1px dashed #ccc;
}
</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">金币充值</i>
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
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">会员升级</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_gold.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">金币充值</h2>
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
<p class="info">【卡密支付】没有充值卡？
<a style="cursor: pointer;color: blue;" href="javascript:void(0)" id="gotoBuy" target="_blank">点击这里购买</a>
</p>
<section class="jilu"> 

<form id="Form1" method="post" action="" style="padding:0 10px;" target="msgubotj" >
<input type="hidden" name="token" value="<?php echo $_SESSION['token']?>"> 
<table width="100%" border="0" cellpadding="5" cellspacing="5">
<tbody>
<?php if($money && $pay){?>
<tr>
<td  height="50" colspan="2" align="center"><strong><?php if($pay==1){echo "微信支付";}elseif ($pay==2){echo "支付宝支付";}?></strong></td>
</tr>
<tr>
  <td  height="15" colspan="2" align="center"><img id="ewm" width="149" height="149" src="<?php if($pay==1){echo "/".$weixin;}elseif ($pay==2){echo "/".$alipay;}?>"></td>
</tr>
<tr>
  <td  height="30" colspan="2" align="center" style="color:#FF0000;font-size:14px;">需要支付 <?php echo $money;?> 元 </td>
</tr>
<tr>
  <td  height="30" colspan="2" align="center" style="color:#FF0000;font-size:14px;">扫描二维码 / 长按图片保存后扫描支付
    <input name="qdfk" type="hidden" value="1"><input name="pid" type="hidden" value="<?php echo $pid?>"><input name="url" type="hidden" value="<?php echo $url;?>"></td>
</tr>
<tr>
<td  height="50" colspan="2" align="center" valign="middle"><input type="submit" id="submit" value="支付后确认" class="user_reg_but" style="width:120px;"></td>
</tr>
<?php }else{?>
<tr>
  <td  height="20" colspan="2" align="center" >&nbsp;</td>
  </tr>
<tr class="money" style="display:none;">
<td width="30%"  height="50" align="center" style="border-bottom:1px solid #F6F6F6;">充值金额：</td>
<td width="70%" height="50" style="border-bottom:1px solid #F6F6F6;"><input name="money" type="text" class="make_resume_input" id="money" value="10" style="margin-top:5px;width:100%;float: right;" onkeyup='this.value=this.value.replace(/\D/gi,"")'></td>
</tr>
<tr>
  <td height="36" align="center" valign="middle" style="border-bottom:1px solid #F6F6F6;"><label>支付方式：</label></td>
  <td height="50" valign="middle" style="border-bottom:1px solid #F6F6F6;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" align="left" valign="middle"  style="border-bottom:1px solid #F6F6F6;"><label>
        <input type="radio" name="pay" value="1">
		微信支付</label></td>
  </tr>
    <tr>
      <td height="30" align="left" valign="middle"><label>
        <input type="radio" name="pay" value="2">
		支付宝</label></td>
  </tr>
  <tr>
      <td height="30" align="left" valign="middle"><label>
        <input type="radio" name="pay" value="3" checked>
		卡密支付（推荐）</label></td>
  </tr>
</table></td></tr>
	<tr class="cardBox">
	<td width="30%"  height="50" align="center" style="border-bottom:1px solid #F6F6F6;"><font color="red">*</font> 卡号：</td>
	<td width="70%" valign="middle" height="50" style="border-bottom:1px solid #F6F6F6;"><input name="user" type="text"  class="make_resume_input" style="margin-top:5px; width:100%;float: right;"></td>
	</tr>
	<tr class="cardBox">
	<td width="30%"  height="50" align="center" style="border-bottom:1px solid #F6F6F6;"><font color="red">*</font> 卡密：</td>
	<td width="70%" valign="middle" height="50" style="border-bottom:1px solid #F6F6F6;"><input name="pass" type="text" class="make_resume_input" style="margin-top:5px; width:100%;float: right;"></td>
	</tr>
<tr>
<td width="70%" valign="middle" height="60" colspan="2"  >
	<input name="uid" type="hidden" value="<?php echo $neirong[id]?>">
	<input name="url" type="hidden" value="<?php echo $hurl;?>">
    <button type="submit" id="submit" class="oy-btn oy-btn-fluid-lg oy-btn-normal">确认充值</button></td>
</tr>
<?php }?>
</tbody></table>
</form>
</section>
<script>
	$("input:radio[name='pay']").click(function () { 
	　　var payid=$('input:radio[name="pay"]:checked').val();
		if(payid==3){
			$(".cardBox").show();
			$(".money").hide();
		}else{
			$(".cardBox").hide();
			$(".money").show();
		}
　　});
	//点击登录
	$("#gotoBuy").click(function(){
		//iframe层-禁滚动条
		layer.open({
		  type: 2,
		  title:'购买充值卡',
		  area: ['320px', '300px'],
		  skin: 'layui-layer-rim', //加上边框
		  content: ['buy.php', 'no']
		}); 
	});
</script>
<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?>
<?php
/*
* 卡密支付功能
*/
function card(){
	$userid=$_COOKIE[uid];
	$time=time();
	if($userid==null){
		echo "<script>location.href='login.php'</script>";
		exit;
	}
	$user=$_POST[user];
	$pass=$_POST[pass];
	if(empty($user)){
		echo msglayer("卡号不能为空！",8);
		exit;
	}
	if(empty($pass)){
		echo msglayer("卡密不能为空！",8);
		exit;
	}
	$activate=getone("select * from ubocard WHERE user='$user' and pass='$pass' ");
	if ($activate)
	{
		$id=$activate[id];
		$status=$activate[status];
		$card_money=$activate[money];
		$terrace_id=$activate[terrace_id];//卡属于哪个类型
		$terrace=getone("select * from uboterrace WHERE id='$terrace_id'");
		$hylx=$terrace['type'];//会员类型
		if ($status==0){//$status=0表示该卡未使用
			$info=getone("select * from ubouser WHERE userid='$userid'");
			$uid=$info['id'];
			$user_money=$info['money'];
			$mgr=$info['user'];	
			mysql_query("SET AUTOCOMMIT=0"); //设置mysql不自动提交，需自行用commit语句提交			
			try{									
				//修改用户金额
				$new_money=$card_money+$user_money;
				$type="money='$new_money' where id='$uid'";
				$res1=upalldt(ubouser,$type);
				$ddzt=2;//订单状态
				$pid=random(10, '0123456789');
				$zffs=3;//支付方式
				$leixing=5;//类型
				$type="(`id`, `pid`, `uid`, `money`, `leixing`, `ddzt`, `zffs`, `addtime`,`remind`) VALUES (null,'$pid','$uid','$card_money','$leixing','$ddzt','$zffs','$time','1')"; 
				$res2=dbinsert(ubotj,$type);
				$type="status='1',endtime='$time',mgr='$mgr' where id='$id'";
				$res3=upalldt(ubocard,$type);
				if($res1&&$res2&&$res3){
					mysql_query("COMMIT");//提交事务
					echo msglayerurl("充值成功！",8,"/user/");
					exit;
				}else{
					mysql_query("ROLLBACK");//至少有一条sql语句执行错误，事务回滚
					echo msglayer("充值失败！",8);
					exit;
				}			
			}catch(Exception $e){
				mysql_query("ROLLBACK");//至少有一条sql语句执行错误，事务回滚
				echo msglayer("充值失败！",8);
				exit;
			}
			mysql_query("END");//事务结束			
		}else{
			echo msglayer("该充值卡已使用过！",8);
			exit;
		}
	}else{
		echo msglayer("卡号或卡密错误！",8);
		exit;
	}
}
?>