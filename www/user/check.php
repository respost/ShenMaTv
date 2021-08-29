<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$type="where id='1'";
$zhifu=queryall(ubozf,$type);
$ip=$_SERVER["REMOTE_ADDR"];
$type="where ip='$ip'";
$user=queryall(uboip,$type);
$pid=$user[pid];
$uid=$user[uid];
if(1==1){ 
echo "<script>location.href='index.php'</script>";
exit;
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="gb2312">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<meta name="format-detection" content="telephone=no">
<title>会员充值</title>
<link rel="stylesheet" href="css/frozen.min.css">
<link rel="stylesheet" href="css/style.min.css">
<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<style>
.paytips span{color:#ff0000;}
.swiper-container {
width: 100%;
height: 200px;
margin-left: auto;
margin-right: auto;
background-color: #f0f0f0;
}
.swiper-slide {
background-color: #f0f0f0;
color: gray;
display: -webkit-box;
display: -ms-flexbox;
display: -webkit-flex;
display: flex;
}
.swiper-slide span {
color: #fd6b8f;
margin-right: 3px;
}
</style>
</head>
<link href="css/swiper.min.css" rel="stylesheet" type="text/css" />
<body>
<header id="header" class="ui-header ui-header-positive ui-border-b">
  <i class="ui-icon-return"  onclick='location.href="i.php"'></i>
  <h1 class="ui-nowrap ui-whitespace">会员充值</h1></header>
<div class="videoimg"><img src="css/1.gif" width="100%" alt="">
</div>
<div class="paytips" style="padding-left:5px;">
<font size="3px"><span style="margin-left: 0px;"><span id="lbluck" style="margin-left: 0px">
<span style='margin-left: 30px; font-weight: bold; color: #1D34E4;'>幸运之神</span>降临
<br>
<span style='color: #666; margin-left: 30px;font-size:12px;'>原价</span><span style='text-decoration: line-through;
margin-left: 0px;  color: #1D34E4;font-size:12px;'>￥<?php echo $zhifu[money3]?></span></span></span>
<span style="margin-left: 0px;font-size:12px;">开通VIP会员，现只需 ￥<span id="paymoney" style="margin-left: 0px"><?php echo $zhifu[money1]?></span>
<br>
<span style='color: #666; margin-left: 30px;font-size:12px;'>原价</span><span style='text-decoration: line-through;
margin-left: 0px;  color: #1D34E4;font-size:12px;'>￥<?php echo $zhifu[money3]+$zhifu[money2]?></span></span></span>
<span style="margin-left: 0px;font-size:12px;">开通黄金会员，现只需 ￥<span id="paymoney" style="margin-left: 0px"><?php echo $zhifu[money2]?></span>
<br>
<span style='color: #666; margin-left: 30px;font-size:12px;'>原价</span><span style='text-decoration: line-through;
margin-left: 0px; color: #1D34E4;font-size:12px;'>￥<?php echo $zhifu[money3]+$zhifu[money2]+$zhifu[money1]?></span></span></span>
 <span style="margin-left: 0px;font-size:12px;">开通钻石会员，现只需￥<span id="paymoney" style="margin-left: 0px"><?php echo $zhifu[money3]?></span>
</span>
<br>
<span id="lbtime" style="margin-left: 30px;font-size:14px;"><span style='color: #666; margin-left: 0px;'>
只剩下</span>
<span id='paydate' style='margin-left: 0px;'>2069</span><span style='color: #666;
margin-left: 0px;'>秒了</span></span> </font>
</div>
<div id="checkdesk">
<div class="info">
<p class="ui-txt-red">VIP，享受所有影片观看权限！</p>
<p>VIP注意事项：<br>1.未满18岁用户，禁止购买观看。<br>2.购买VIP，享有所有影片观看权限。</p>
</div>
<form name="p" action="pay/pay.php" method="post" >
<h2 class="paytitle">选择会员类型</h2>
<ul id="rad">
<li><img src="css/2.png"><span>VIP会员&nbsp;<?php echo $zhifu[money1];?>元&nbsp;&nbsp;&nbsp;<label for="radio_yj" onClick="pay('<?php echo $zhifu[money1];?>','vip会员','vip')" ></label></span></li>
<li><img src="css/1.png"><span>黄金会员&nbsp;<?php echo $zhifu[money2];?>元&nbsp;&nbsp;<label  class="checked" for="radio_jd" onClick="pay('<?php echo $zhifu[money2];?>','黄金会员','hjvip')" ></label></span></li>
<li><img src="css/3.png"><span>钻石会员&nbsp;<?php echo $zhifu[money3];?>元&nbsp;&nbsp;&nbsp;<label for="radio_nf"  onClick="pay('<?php echo $zhifu[money3];?>','钻石会员','zuanvip')" ></label></span></li>

</ul>
<div class="ui-btn-wrap">
<form name="p" action="pay/pay.php" method="post"  id="tform">
<input type="hidden" name="ubodes" value="钻石会员" id="body" >
<input type="hidden" name="ubobz" value="<?php echo $user[userid]?>">
<input type="hidden" name="ubopid" value="<?php echo $pid?>">
<input type="hidden" name="ubouid" value="<?php echo $uid?>">
<input type="hidden" name="ubo" value="hjvip" id="ubo" >
<input type="hidden"  name="vipType"  value="<?php echo $zhifu[money2]?>"  id="money">
<input type="submit"  value="确认支付" class="ui-btn-lg ui-btn-weixin"  style="margin-top:20px;">
</form>

</div>
<div class="hjzs">
<div class="swiper-container swiper-container-vertical swiper-container-android">
<div class="swiper-wrapper" style="transition: 3000ms; transform: translate3d(0px, -1464.43px, 0px);">
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="0" style="height: 27.7143px; margin-bottom: 1px;">
<span>[缘份]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="1" style="height: 27.7143px; margin-bottom: 1px;">
<span>[兵王]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="2" style="height: 27.7143px; margin-bottom: 1px;">
<span>[what ever]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="3" style="height: 27.7143px; margin-bottom: 1px;">
<span>[霓虹灯下的声影]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="4" style="height: 27.7143px; margin-bottom: 1px;">
<span>[阳光总在风雨后]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="5" style="height: 27.7143px; margin-bottom: 1px;">
<span>[山药不是药]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="6" style="height: 27.7143px; margin-bottom: 1px;">
<span>[少平]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="7" style="height: 27.7143px; margin-bottom: 1px;">
<span>[葬雪]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="8" style="height: 27.7143px; margin-bottom: 1px;">
<span>[勿忘心安]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="9" style="height: 27.7143px; margin-bottom: 1px;">
<span>[幽冥舰]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="10" style="height: 27.7143px; margin-bottom: 1px;">
<span>[青年老文]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="11" style="height: 27.7143px; margin-bottom: 1px;">
<span>[孤僻]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="12" style="height: 27.7143px; margin-bottom: 1px;">
<span>[唯郁]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="13" style="height: 27.7143px; margin-bottom: 1px;">
<span>[笑_漾在唇边]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="14" style="height: 27.7143px; margin-bottom: 1px;">
<span>[颜彦]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="15" style="height: 27.7143px; margin-bottom: 1px;">
<span>[缘定今生]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="16" style="height: 27.7143px; margin-bottom: 1px;">
<span>[【~寻找未来 ~】]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[找老婆]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="18" style="height: 27.7143px; margin-bottom: 1px;">
<span>[曹辉]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="19" style="height: 27.7143px; margin-bottom: 1px;">
<span>[东仔]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="20" style="height: 27.7143px; margin-bottom: 1px;">
<span>[宗洒洒]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping swiper-slide-duplicate" data-swiper-slide-index="21" style="height: 27.7143px; margin-bottom: 1px;">
<span>[黎cs]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="0" style="height: 27.7143px; margin-bottom: 1px;">
<span>[缘份]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="1" style="height: 27.7143px; margin-bottom: 1px;">
<span>[兵王]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="2" style="height: 27.7143px; margin-bottom: 1px;">
<span>[what ever]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="3" style="height: 27.7143px; margin-bottom: 1px;">
<span>[霓虹灯下的声影]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="4" style="height: 27.7143px; margin-bottom: 1px;">
<span>[阳光总在风雨后]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="5" style="height: 27.7143px; margin-bottom: 1px;">
<span>[山药不是药]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="6" style="height: 27.7143px; margin-bottom: 1px;">
<span>[少平]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="7" style="height: 27.7143px; margin-bottom: 1px;">
<span>[葬雪]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="8" style="height: 27.7143px; margin-bottom: 1px;">
<span>[勿忘心安]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="9" style="height: 27.7143px; margin-bottom: 1px;">
<span>[幽冥舰]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="10" style="height: 27.7143px; margin-bottom: 1px;">
<span>[青年老文]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="11" style="height: 27.7143px; margin-bottom: 1px;">
<span>[孤僻]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="12" style="height: 27.7143px; margin-bottom: 1px;">
<span>[唯郁]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="13" style="height: 27.7143px; margin-bottom: 1px;">
<span>[笑_漾在唇边]</span>成为了VIP会员。4星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="14" style="height: 27.7143px; margin-bottom: 1px;">
<span>[颜彦]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="15" style="height: 27.7143px; margin-bottom: 1px;">
<span>[缘定今生]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="16" style="height: 27.7143px; margin-bottom: 1px;">
<span>[【~寻找未来 ~】]</span>成为了VIP会员。5星好评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[找老婆]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[好B啊]</span>成为了VIP会员。4星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[缘来是你]</span>成为了VIP会员。5星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[今夜会回来]</span>成为了VIP会员。5星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[水中花]</span>成为了VIP会员。3星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[物是人非]</span>成为了VIP会员。4星中评
</div>
<div class="swiper-slide stop-swiping" data-swiper-slide-index="17" style="height: 27.7143px; margin-bottom: 1px;">
<span>[~灯火阑珊处]</span>成为了VIP会员。5星中评
</div>
</div>
</div>
</div>
</div>
<script src="css/swiper-3.3.1.min.js"></script>
<script type="text/javascript">
function showTime() {
var timeo;
timeo = document.getElementById('paydate').innerHTML;
if (timeo - 1 > 0) {
document.getElementById('paydate').innerHTML = timeo - 1;
}else {
document.getElementById('paydate').innerHTML = "0";
}
}
setInterval("showTime()", 1000);
var swiper = new Swiper('.swiper-container', {
slidesPerView:7,
direction: 'vertical',
speed: 3000,
autoplay: 1,
loop: true,
loopedSlides: 100,
noSwiping: true,
noSwipingClass: 'stop-swiping',
spaceBetween: 1
});
</script>
<script type="text/javascript">
function pay(money,name,lx){
document.getElementById('money').value=money;
document.getElementById('body').value=name;
document.getElementById('ubo').value=lx;

}
</script>
<script>
$(function(){
/*单选选中*/
$('#rad label').click(function(){
var radioId = $(this).attr('name');
$('#rad label').removeAttr('class') && $(this).attr('class', 'checked');
$('#rad input[type="radio"]').removeAttr('checked') && $('#' + radioId).attr('checked', 'checked');
});
});
</script>
</body>
</html>