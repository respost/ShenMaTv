<?php
error_reporting(0); 
include("../config/conn.php");
include("../config/common.php");
$id=$_GET["id"];
$page=$_GET["page"];
$userid=$_COOKIE[uid];
if ($page)
{
$page=floor($page-1);
}
else
{$page=0;}
$style=$_GET["style"];
function myTrim($str)
{
 $search = array(" ","　","\n","\r","\t");
 $replace = array("","","","","");
 return str_replace($search, $replace, $str);
}

function request_post($url = '', $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }
        
        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        
        return $data;
    }
//截取函数  
class get_c_str {  
var $str;  
var $start_str;  
var $end_str;  
var $start_pos;  
var $end_pos;  
var $c_str_l;  
var $contents;  
function get_str($str,$start_str,$end_str){  
   $this->str = $str;  
   $this->start_str = $start_str;  
   $this->end_str = $end_str;  
   $this->start_pos = strpos($this->str,$this->start_str)+strlen($this->start_str);  
     $this->end_pos = strpos($this->str,$this->end_str);  
   $this->c_str_l = $this->end_pos - $this->start_pos;  
   $this->contents = substr($this->str,$this->start_pos,$this->c_str_l);  
   return $this->contents;  
}  
}  
	
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
$neirong=queryall(se2zynr,$type);
$member = $neirong[member];
$url = $neirong[url];
$name = $neirong[name];
$source = $neirong[price];
$url_1 = $url;//按逗号分离字符串 
$url_2 = explode('|',$url_1); 
$array = $url_2;
$count = count($url_2);
if ($count>1)
{
$url=$array[$page];
}
$czpd = substr_count("#".$url,'#C');
$length = strlen($url);
$mp4is = substr_count($url,'.mp4');
$httpis = substr_count($url,'http');
if ($mp4is==1 || $httpis==1)
{$mp4is=1;}else{$mp4is==0;}
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent,"NetFront") || strpos($agent,"iPhone") || strpos($agent,"MIDP-2.0") || strpos($agent,"Opera Mini") || strpos($agent,"UCWEB") || strpos($agent,"Android") || strpos($agent,"Windows CE") || strpos($agent,"SymbianOS") || $the_host=="m.smdyw.cn")
{$terminal=1;}else{$terminal=0;} 
$time=time();
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{$hyzt=1;}
else
{
$row=getone("select * from uboxfjl WHERE type=2 and userid='".$userid."' and zyid='".$id."'");
if ($row)
{$hyzt=1;}else{$hyzt=1;}
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
<title><?php echo $name;?></title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" /> 
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">body,html,div{background-color:black;padding: 0;margin: 0;width:100%;height:100%;}</style>
<?php if($hyzt==0 && $member==1){?>
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
<div id="a1"></div>
<?php
$laiyuan=getone("select * from ubotj3 WHERE shijian='$source' and money<>'system'");
if ($laiyuan && $mp4is==0 )
{
$ly_url=$laiyuan['uid'];
$ly_jx=$laiyuan['money'];
$url=str_replace("(*)",$url,$ly_url); 
if ($ly_url)
{$ly_jx=$ly_jx.$url;}else{$ly_jx="about:blank";}
?>
<script type="text/javascript">document.getElementById('a1').innerHTML = '<iframe id="baiduSpFrame" name="baiduSpFrame" border="0" vspace="0" hspace="0" marginwidth="0" marginheight="0"  frameborder="0" scrolling="no" width="100%" height="100%" src="<?php echo $ly_jx;?>"></iframe>';</script>
<?php }else{?>
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="gb2312"></script>
<script type="text/javascript">
<?php if($hyzt==0 && $member==1 || 1==1){?>
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
<?php if($czpd==1){
$id = ($id*628)+61857329;
$id = base64_encode($id);?>
	var purl
	var vid1='<?php echo $id;?>&style=7&qxd=bq&page=<?php echo $page;?>';
	var vid2='<?php echo $id;?>&style=7&type=mp4&page=<?php echo $page;?>';
    var vid3='<?php echo $id;?>&style=7&type=3gphd&page=<?php echo $page;?>';
	var purl1='ykyun.php?id='+vid1;
	var purl2='ykyun.php?id='+vid2;
	var purl3='ykyun.php?id='+vid3;
	if (Aois==2 && isAndroid==true){purl=purl3;}else if(Aois==3 && isiOS==true){purl=purl3;}else{purl=encodeURIComponent(purl1)}
	var ljfs=4;
<?PHP }else{?>	
   <?php 
    if ($member==1 && $mp4is==0){
	$id = ($id*628)+61857329;
    $id = base64_encode($id);?>
    var vid='<?php echo $id;?>';
	var purl1='pc.php?id='+vid+'&style=7&page=<?php echo $page;?>';
	var purl2='android.php?id='+vid+'&style=7&page=<?php echo $page;?>';
	var purl3='android.php?id='+vid+'&style=7&page=<?php echo $page;?>';
	if (Aois==2 && isAndroid==true){purl=purl2;}else if(Aois==3 && isiOS==true){purl=purl3;}else{purl=purl2;}
	var ljfs=0;
	<?php }elseif ($mp4is==1){?>
	var purl='<?php echo $url;?>';
	var ljfs=0;
<?PHP }else{
    $id = ($id*628)+61857329;
	$id = base64_encode($id);?>
	var vid='<?php echo $id;?>';
	var purl='youku.php?id='+vid+'&style=7&page=<?php echo $page;?>';
	var ljfs=4;
<?php }}?>
	var flashvars={
<?php if($czpd==1){?>
		f:'m3u8.swf',
		a:purl,
<?PHP }else{
    if ($member==1){?>
	    f: purl, 		//视频地址  
<?php }else{?>
		f:'m3u8.swf',
		a:encodeURIComponent(purl),
<?php }}?>
		c:0,
		s:ljfs,
		p:1,
	    h:0,
		<?php if ($terminal==0){?>loaded:'loadedHandler',<?php }?>
		my_url:encodeURIComponent(window.location.href)
	};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
	var isiPad = navigator.userAgent.match(/iPad|iPhone|Linux|Android|iPod/i) != null;
    if (isiPad && Aois>1 && (isAndroid==true || isiOS==true)) {
        document.getElementById('a1').innerHTML = '<video src="'+purl+'" controls="controls" autoplay="autoplay" width="100%" height="100%" style="psotion:relative;""></video>'
	}else{
	var video=['->video/mp4'];
	CKobject.embed('/ckplayer/ckplayer.swf','a1','ckplayer_a1','100%','100%',false,flashvars,video,params);
	}
  </script>
 <?php }?>
</body>
</html>