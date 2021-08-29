<!-- 提示充值消息 -->
<div class="u-layer-ath">
<div class="ath_addhome_area"></div>
<div class="ath_close_area" data-role="button"></div>
</div>
<!--流量统计代码 start-->
<div align="center"><script type="text/javascript" src="https://js.users.51.la/20069079.js"></script></div>
<!--流量统计代码 end-->
<script src="/js/zepto.min.js"></script>
<script src="/js/vue.min.js"></script>
<script src="/js/frozen.js"></script>
<script src="/js/mjp.min.js"></script>
<script>
$(document).ready(function()
{
    $(".ui-icon-close-page").click(function(){
    $('#paybox').removeClass("show");
	});

});
function ubourl(url){
window.location.href=url; 
}
function pay(){
$("#paybox").addClass("show");
}
//创建cookie
function setCookie(name,value,time) {
var strsec = getsec(time);
var exp = new Date();
exp.setTime(exp.getTime() + strsec*1);
document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
setInterval("getNo()", 10000);
//弹出VIP用户充值公告
function getNo() {
if (Math.floor(Math.random() * 2 + 1) != 1) return;
var ckname = 'x_a_no';
var ckinit = 12850;
var ckno = getCookie(ckname);
if (!ckno) {
setCookie(ckname, ckinit, 'd30');
} else {
_ckno = parseInt(ckno) + 1;
setCookie(ckname, _ckno, 'd30');
}
ckno = ckno ? _ckno: ckinit;
$('#showno').html(ckno);
$('.ui-newstips-wrap').show().addClass('flip-top');
setTimeout(function() {
$('.ui-newstips-wrap').hide()
},
5000);
}
//读取cookie
function getCookie(name){
var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
if(arr=document.cookie.match(reg))
return (arr[2]);
else
return null;
}
function getsec(str){
var str1=str.substring(1,str.length)*1;
var str2=str.substring(0,1);
if (str2=="s"){
return str1*1000;
}else if (str2=="h"){
return str1*60*60*1000;
}else if (str2=="d"){
return str1*24*60*60*1000;
}
}
</script>
<script type="text/javascript">
(function() {
var slider = new fz.Scroll('.ui-slider', {
role: 'slider',
indicator: true,
autoplay: true,
interval: 3000
});
})();
</script>