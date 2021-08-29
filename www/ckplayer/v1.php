<?php
error_reporting(0); 
$rfr = $_SERVER['HTTP_REFERER'];//来源;
$cshq = $_SERVER["QUERY_STRING"];//参数
$fdis = substr_count($rfr,$cshq);
$pdsjs = substr_count("down",$cshq);
$zt=$_GET[zt];
if ($fdis==1 || $pdsjs=1)
{
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$style=$_GET["style"];
$userid=$_COOKIE[uid];
$page=$_GET["page"];
if ($page)
{
$page=floor($page-1);
}
else
{$page=0;}
if($id== null){ 
echo "<script>alert('抱歉，你访问的资源已经删除')</script>";
exit;
} 
$id=base64_decode($id);
$id=($id-12865379)/512;
$sz="where id='1'";
$shezhi=queryall(se2wz,$sz);
$sk=$shezhi[sk];
$type="where id='$id'";
$neirong=queryall(se2nr,$type);
$member = $neirong[member];
$url = $neirong[url];
$shijian = $neirong[shijian];
$url_1 = $url;//按逗号分离字符串 
$url_2 = explode('|',$url_1); 
$array = $url_2;
$count = count($url_2);
if ($count>1)
{
$url=$array[$page];
}
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent,"NetFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS") || $the_host=="m.smdyw.cn")
{$terminal=1;}else{$terminal=0;}
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{
$row=getone("select * from uboxfjl WHERE type=1 and userid='".$userid."' and zyid='".$id."'");
if ($row)
{$hyzt=1;}else{$hyzt=0;}
}
if($member=="1" && $hyzt=="0")
{
header('Location: about:blank');
exit;
}  
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $neirong[name];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">body,html,div{background-color:black;padding: 0;margin: 0;width:100%;height:100%;}</style>
<?php if($hyzt==0 || $zt=="sh"){?>
<script type="text/javascript">
function get_dt(t)
{
if(t>=<?php echo floor(60*$sk);?>){
<?php if ($terminal==1){?>
document.querySelector('video').currentTime = 0;
document.querySelector('video').pause();
<?php }elseif ($terminal==0){?>
CKobject.getObjectById('ckplayer_a1').videoClear();
<?php }?>
location.href='about:blank';
parent.pay();
}
}
<?php if ($terminal==1){?>
function gettime()
{
var t=document.querySelector('video').currentTime;
t=Math.floor(t);
get_dt(t);
}
setInterval("gettime()",1000);
<?php }?>
</script>
<?php }?>
</head>
<body>
<div id="a1" style="psotion:relative;"></div>
<?php
if (1==1){
$mtis = substr_count($url,'http://');
$wyis = substr_count($url,'Yklk');
$shis = substr_count($url,'#');
if(($wyis==2 || $wyis==0) && $mtis==0 && $shis==0)
{
$source=0;
$laiyuan=getone("select * from ubotj3 WHERE shijian='$source' and money<>'system'");
$ly_url=$laiyuan['uid'];
$ly_jx=$laiyuan['money'];
$url=str_replace("(*)",$url,$ly_url); 
if ($ly_url)
{$ly_jx=$ly_jx.$url;}else{$ly_jx="about:blank";}
?>
<script type="text/javascript">document.getElementById('a1').innerHTML = '<iframe id="baiduSpFrame" name="baiduSpFrame" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0"  frameborder="0" scrolling="no" width="100%" height="100%" src="<?php echo $ly_jx;?>"></iframe>';</script>
<?php 
exit;  
}}?>
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="gb2312"></script>
<script type="text/javascript">
<?php if($hyzt==0 || 1==1){?>
		function loadedHandler(){
		if(CKobject.getObjectById('ckplayer_a1').getType()){
			 CKobject.getObjectById('ckplayer_a1').addListener('time',timeHandler);
			 <?php if ($shijian=="0"){?>CKobject.getObjectById('ckplayer_a1').addListener('totaltime',totaltimeHandler);<?php };?>
		}
		else{
			CKobject.getObjectById('ckplayer_a1').addListener('time','timeHandler');
			<?php if ($shijian=="0"){?>CKobject.getObjectById('ckplayer_a1').addListener('totaltime','totaltimeHandler');<?php };?>
		}
	}
	function timeHandler(t){
		if(t>-1){
		    t=Math.floor(t);
			get_dt(t);
		}
	}
<?php }?>
	<?php if ($shijian=="0"){?>
function totaltimeHandler(t){
		    t=Math.floor(t);
    $.get("audio_ajax.php?id=<?php echo $id;?>&time="+t,function(data){
        if(data!="1"){
            location.href=data;
        }
   });
 }
<?php };?>
var u = navigator.userAgent;
var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
var Aois = 0;
if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
    //alert(navigator.userAgent);  
    Aois = 3;
} else if (/(Android)/i.test(navigator.userAgent)) {
    //alert(navigator.userAgent); 
    Aois = 2;
} else {
    Aois = 1;
};

<?php
$mtis = substr_count($url,'http://');
$mupd = substr_count($url,'m3u8');
if ($mtis>=1){
if ($mupd==1)
{?>
	var purl='<?php echo $url;?>';
	var ljfs=4;
<?php }else{
    $id = ($id*628)+61857329;
    $id = base64_encode($id);?>  
	var purl='url.php?id=<?php echo $id;?>&page=<?php $page=$page+1; echo $page;?>';
	var ljfs=0;
<?php }}else{
$wyis = substr_count($url,'Yklk');
$shis = substr_count($url,'#');?>
   <?php if($wyis==2 || ($wyis==0 && $shis==0)){
    $id = ($id*628)+61857329;
    $id = base64_encode($id);
    $isyk = 1;?>
    var vid='<?php echo $id;?>';
	var purl1='yk_pc.php?id='+vid;
	var purl2='youku.php?id='+vid+'&style=2&type=3gphd&page=1';
	var purl3='yk_ios.php?id='+vid;
	var ljfs=2;
	if (Aois==2 && isAndroid==true){purl=purl2;}else if(Aois==3 && isiOS==true){purl=purl2;}else{purl=purl2;ljfs=4;}
	<?php }elseif ($wyis==1){?>
	var purl='http://hyrcw.qj171.wshost.cc/vlook.php?id=<?php echo $url;?>';
	var ljfs=0;
	<?php }elseif ($shis==1){?>
	var purl='http://hyrcw.qj171.wshost.cc/sohu.php?id=<?php echo $url;?>';
	var ljfs=0;
	<?php }?>
<?php }?>
	var flashvars={
<?php if ($isyk ==1 || $mupd==1){?>
                f:'m3u8.swf',
	a:encodeURIComponent(purl),
<?php }else{?>
               	f: purl, 		//视频地址
<?php }?>
	    c: 0,           //是否读取文本配置,0不是，1是
		s: ljfs,		//调用方式，0=普通方法（f=视频地址），1=网址形式,2=xml形式，3=swf形式
	    p: 1,		    //视频默认0是暂停，1是播放，2是不加载视频
		h: 0,           //播放http视频流时采用何种拖动方法，=0不使用任意拖动，=1是使用按关键帧，=2是按时间点，=3是自动判断按什么
		<?php if ($terminal==0){?>loaded:'loadedHandler',<?php }?>
		my_url:encodeURIComponent(window.location.href)
	};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always'};
	var isiPad = navigator.userAgent.match(/iPad|iPhone|Linux|Android|iPod/i) != null;
    if (isiPad && Aois>1 && (isAndroid==true || isiOS==true)) {
        document.getElementById('a1').innerHTML = '<video src="'+purl+'" controls="controls" autoplay="autoplay" width="100%" height="100%" style="psotion:relative;""></video>'
	}else{
	var video=['->video/mp4'];
	CKobject.embed('/ckplayer/ckplayer.swf','a1','ckplayer_a1','100%','100%',false,flashvars,video,params);
	}
  </script>
</body>
</html>
<?php }?>