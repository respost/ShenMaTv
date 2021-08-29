<?php
/*
m3u8和mp4整段默认最高清晰度
m3u8
php?vid=CMzcxNTUzMg==&type=m3u8
mp4整段
php?vid=CMzcxNTUzMg==&type=mp4
分段
php?vid=CMzcxNTUzMg==
分段清晰度
php?vid=CMzcxNTUzMg==&qxd=gq

ckplayerXML分段调用配置方法
http://www.ckplayer.com/tool/#p_3_7_32

ckplayer单地址调用配置方法
http://www.ckplayer.com/tool/#p_3_7_30

ckplayer手机端调用配置方法
ckplayer下载：http://bbs.ckplayer.com/forum.php?mod=forumdisplay&fid=2
参考：demo2.htm
mp4整段
var video=['http://127.0.0.1/7/acfun87.php?vid=CMzcxNTUzMg==&type=mp4->video/mp4'];
m3u8
var video=['http://127.0.0.1/7/acfun87.php?vid=CMzcxNTUzMg==&type=m3u8->application/x-mpegurl'];
*/
error_reporting(0);
include("../config/conn.php");
include("../config/common.php");
header('Content-Type: application/json;charset=UTF-8');
$id=$_GET["id"];
$id=base64_decode($id);
$style=$_GET["style"];
$page=$_GET["page"];
if ($page)
{
$page=floor($page);
}
else
{$page=0;}
$vid = $_GET['vid'];//'CMzcxNTUzMg==';
$qxd = $_GET['qxd'];//bq gq cq
$m3u8 = $_GET['type'];//mp4 m3u8
if($id== null){ 
echo "<script>alert('抱歉，你访问的资源已经删除')</script>";
} 
if (!is_numeric($id)||!is_numeric($style)||!is_numeric($page)){
exit('参数错误');
}
	switch ($style){
	case '3':
 	$datasheet= 'se2dsjnr';
	break;
  	case '4':
	$datasheet= 'se2dynr';
	break;
	case '5':
	$datasheet= 'se2dmnr';
	break;
	case '6':
	$datasheet= 'se2mvnr';
	break;
	case '7':
	$datasheet= 'se2zynr';
	break;
	}
$type="where id='$id'";
$neirong=queryall($datasheet,$type);
$url = $neirong[url];
$name = $neirong[name];
$url_1 = $url;//按逗号分离字符串 
$url_2 = explode('|',$url_1); 
$array = $url_2;
$count = count($url_2);
if ($count>1)
{
$url=$array[$page];
}
$vid=$url;

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

function myTrim($str)
{
 $search = array(" ","　","\n","\r","\t");
 $replace = array("","","","","");
 return str_replace($search, $replace, $str);
}

$file_name="http://vip.filmyun.cn/YoukuCloud.php?vid=".$vid;
$file_handle = fopen("$file_name", "r");  
while (!feof($file_handle)) {  
   $line = fgets($file_handle);  
   $sjb=$sjb.$line;  
}  
fclose($file_handle);  

echo $sjb;
exit;
if (1==2)
{
if (is_numeric($vid)||!$vid){
exit('{"eo":"-1","vid":"参数错误"}');
}
$acfun = new AcfunAppfu___();
$acfun -> Acfun_qq1024031521($vid,$qxd,$m3u8);
$acfun -> Acfun_appfu_();
class AcfunAppfu___{
public $vid;
public $qxd;
public $m3u8;
function Appfu_results() {
$appfu_vip = self::Appfu_data();

//file_put_contents("debug_yjn.log",var_export($appfu_vip,true).PHP_EOL);
if ($appfu_vip['results']->hd2[0]->url){
$appfu_a = 'hd2';
}
elseif($appfu_vip['results']->mp4hd[0]->url){
$appfu_a = 'mp4hd';
}
elseif($appfu_vip['results']->mp4[0]->url){
$appfu_a = 'mp4';
}
elseif($appfu_vip['results']->flvhd[0]->url){
$appfu_a = 'flvhd';
}
elseif($appfu_vip['results']->flv[0]->url){
$appfu_a = 'flv';
}
elseif($appfu_vip['results']->{'3gphd'}[0]->url){
$appfu_a = '3gphd';
}

if (($this->m3u8)=='m3u8'){
$Appfu_ep = $appfu_vip['sid'].'_'.($this->vid).'_'.$appfu_vip['token'];
$$Appfu_ep = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
$$$Appfu_ep = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, 'zx26mfbsuebv72ja', $Appfu_ep, MCRYPT_MODE_ECB, $$Appfu_ep);
$Appfu_m3u8 = 'http://pl.youku.com/partner/m3u8?vid='.($this->vid).'&type='.$appfu_a.'&ep='.urlencode(base64_encode($$$Appfu_ep)).'&sid='.$appfu_vip['sid'].'&token='.$appfu_vip['token'].'&ctype=87&ev=1&oip='.$appfu_vip['oip'];
header('Content-Type: application/x-mpegurl;charset=UTF-8');
header('Location:'.$Appfu_m3u8);
exit();
}
else{
$Appfu_xml .= '<?xml version="1.0" encoding="UTF-8"?>';
$Appfu_xml .= '<ckplayer>';
$Appfu_xml .= '<flashvars>{h->3}{s->2}</flashvars>';
if (($this->qxd)=='bq'||($this->qxd)=='gq'||($this->qxd)=='cq'){
if (($this->qxd)=='gq'&&$appfu_vip['results']->mp4hd[0]->url){
$Appfu_sk = $appfu_vip['results']->mp4hd;
}
elseif(($this->qxd)=='gq'&&$appfu_vip['results']->mp4[0]->url){
$Appfu_sk = $appfu_vip['results']->mp4;
}
elseif(($this->qxd)=='bq'&&$appfu_vip['results']->flvhd[0]->url){
$Appfu_sk = $appfu_vip['results']->flvhd;

}
elseif(($this->qxd)=='bq'&&$appfu_vip['results']->flv[0]->url){
$Appfu_sk = $appfu_vip['results']->flv;
}
elseif(($this->qxd)=='cq'&&$appfu_vip['results']->hd2[0]->url){
$Appfu_sk = $appfu_vip['results']->hd2;
}
else{
$Appfu_sk = $appfu_vip['results']->$appfu_a;	
}
}else{
$Appfu_sk = $appfu_vip['results']->$appfu_a;
}

if (($this->m3u8)=='mp4'){
	if($appfu_vip['results']->{'mp4'}[0]->url){
		$Appfu_sk = $appfu_vip['results']->{'mp4'};
	}else{
		$Appfu_sk = $appfu_vip['results']->$appfu_a;	
	}
}

if (($this->m3u8)=='3gphd'){
	if($appfu_vip['results']->{'3gphd'}[0]->url){
		$Appfu_sk = $appfu_vip['results']->{'3gphd'};
	}else{
		$Appfu_sk = $appfu_vip['results']->$appfu_a;	
	}
}
//file_put_contents("debug_yjn2.log",var_export($Appfu_sk,true).PHP_EOL);
foreach ($Appfu_sk AS $k=>$v){
	$Appfu_Fileid_Ep = $appfu_vip['sid'].'_'.($v->fileid).'_'.$appfu_vip['token'];
	$$Appfu_Fileid_Ep = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
	$$$Appfu_Fileid_Ep = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, 'zx26mfbsuebv72ja', $Appfu_Fileid_Ep, MCRYPT_MODE_ECB, $$Appfu_Fileid_Ep);
	$Appfu_url = ($v->url).'&oip='.$appfu_vip['oip'].'&sid='.$appfu_vip['sid'].'&token='.$appfu_vip['token'].'&did='.$appfu_vip['did'].'&ev=1&ctype=87&ep='.urlencode(base64_encode($$$Appfu_Fileid_Ep));
	
	
	if (($this->m3u8)=='3gphd'){
		header('Location:'.$Appfu_url);
		exit();
	}

	if (($this->m3u8)=='mp4'){
	//header('Location:'.$Appfu_url);
	//exit();
	}
	$curl = curl_init(); 
	// 设置你需要抓取的URL 
	curl_setopt($curl, CURLOPT_URL, $Appfu_url); 
	// 设置header 响应头是否输出
	curl_setopt($curl, CURLOPT_HEADER, 1); 
	// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
	// 1如果成功只将结果返回，不自动输出任何内容。如果失败返回FALSE 
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	// 运行cURL，请求网页 
	$data = curl_exec($curl); 
	// 关闭URL请求 
	curl_close($curl); 
	// 显示获得的数据 
	//print_r($data); 
	preg_match("/Location:(.*)\\n/",$data,$data2); 
	$Appfu_url = $data2[1];
	$Appfu_xml .= '<video>';
	$Appfu_xml .= '<file>';
	$Appfu_xml .=trim($Appfu_url);
	$Appfu_xml .= '</file>';
	$Appfu_xml .='<size>'.$v->size.'</size>';
	$Appfu_xml .='<seconds>'.$v->seconds.'</seconds>';
	$Appfu_xml .= '</video>';
}
header('Content-Type: application/xml;charset=UTF-8');
$Appfu_xml .= '</ckplayer>';
file_put_contents("debug_yjn3.log",var_export($Appfu_xml,true).PHP_EOL);
exit($Appfu_xml);
}
}
function Acfun_appfu_(){
self::Appfu_results();
}
function Appfu_data() {
$Appfu_Did = self::Appfu_did();
$appfu_a = 'http://acfun.api.mobile.youku.com/common/partner/play?point=1&id='.($this->vid).'&local_time=&local_vid=&format=1,2,3,4,5,6,7,8,9&language=guoyu&did='.$Appfu_Did.'&ctype=87&local_point=&audiolang=1&pid=528a34396e9040f3&guid=ac3e09d2d2485a2b52bedad890d9a151&mac=02:00:00:00:00:00&imei=99000693108561&ver=270&operator=中国电信_46003&network=WIFI';
$appfu_b = json_decode(self::sk($appfu_a))->data;
$appfu_iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
$appfu_c = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, 'qwer3as2jin4fdsa', base64_decode($appfu_b), MCRYPT_MODE_ECB, $appfu_iv);
$appfu_d = json_decode($appfu_c);
$appfu_results = $appfu_d->results;
$appfu_e = $appfu_d->sid_data;
$appfu_vip = $appfu_e->oip;
$$appfu_vip = $appfu_e->token;
$$$appfu_vip = $appfu_e->sid;
return array(
'results'=>$appfu_results,
'oip'=>$appfu_vip,
'token'=>$$appfu_vip,
'sid'=>$$$appfu_vip,
'did'=>$Appfu_Did
);
}	
function Appfu_did() {
return md5(time().($this->vid).time().'87qq1024031521');	
}
function Acfun_qq1024031521($vid,$qxd,$m3u8){
$this->vid = $vid;
$this->qxd = $qxd;
$this->m3u8 = $m3u8;
}
function sk($url) {
	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_USERAGENT, 'yk_acfun;270;Android;6.0.1;MI 4LTE');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$_SERVER["REMOTE_ADDR"], 'CLIENT-IP:'.$_SERVER["REMOTE_ADDR"]));
	curl_setopt($curl, CURLOPT_REFERER, $url);  
	$AppfuSk = curl_exec($curl);
    curl_close($curl);
	return $AppfuSk;
}
}
}