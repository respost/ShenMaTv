<?php
error_reporting(0); 
$rfr = $_SERVER['HTTP_REFERER'];//��Դ;
$cshq = $_SERVER["QUERY_STRING"];//����
$fdis = substr_count($rfr,$cshq);
$pdsjs = substr_count("down",$cshq);
if ($fdis==1 || $pdsjs=1)
{
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$style=$_GET["style"];
$userid=$_COOKIE[uid];
if($id== null){ 
echo "<script>alert('��Ǹ������ʵ���Դ�Ѿ�ɾ��')</script>";
exit;
} 
$id=base64_decode($id);
$id=($id-12865379)/512;
$sz="where id='1'";
$shezhi=queryall(se2wz,$sz);
$sk=$shezhi[sk];
$type="where id='$id'";
$neirong=queryall(se2mvnr,$type);
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent,"NetFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS") || $the_host=="m.smdyw.cn")
{$terminal=1;}else{$terminal=0;}
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{
$row=getone("select * from uboxfjl WHERE type=5 and userid='".$userid."' and zyid='".$id."'");
if ($row)
{$hyzt=1;}else{$hyzt=0;}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $neirong[name];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">body,html,div{background-color:black;padding: 0;margin: 0;width:100%;height:100%;}</style>
</style>
<?php if($hyzt==0){?>
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
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="gb2312"></script>
<script type="text/javascript">
<?php if($hyzt==0){?>
		function loadedHandler(){
		if(CKobject.getObjectById('ckplayer_a1').getType()){
			 CKobject.getObjectById('ckplayer_a1').addListener('time',timeHandler);
		}
		else{
			CKobject.getObjectById('ckplayer_a1').addListener('time','timeHandler');
		}
	}
	function timeHandler(t){
		if(t>-1){
		    t=Math.floor(t);
			get_dt(t);
		}
	}
<?php }?>
var u = navigator.userAgent;
var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android�ն�
var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios�ն�
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
$url = $neirong[url];
$mtis = substr_count($url,'http://');
    $id = ($id*628)+61857329;
    $id = base64_encode($id);?>  
	var purl='mvurl.php?id=<?php echo $id;?>';
	var ljfs=0;
	var flashvars={
	    f: purl, 		//��Ƶ��ַ  
	    c: 0,           //�Ƿ��ȡ�ı�����,0���ǣ�1��
		s: ljfs,		//���÷�ʽ��0=��ͨ������f=��Ƶ��ַ����1=��ַ��ʽ,2=xml��ʽ��3=swf��ʽ
	    p: 1,		    //��ƵĬ��0����ͣ��1�ǲ��ţ�2�ǲ�������Ƶ
		h: 0,           //����http��Ƶ��ʱ���ú����϶�������=0��ʹ�������϶���=1��ʹ�ð��ؼ�֡��=2�ǰ�ʱ��㣬=3���Զ��жϰ�ʲô
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