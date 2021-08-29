<?php
error_reporting(0);
include("../config/conn.php");
include("../config/common.php");
$id=$_POST["vid"];
$id=base64_decode($id);
$id=($id-12865379)/512;
$userid=$_COOKIE[uid];
$time=time();
if($id== null){ 
echo msglayer("抱歉，你访问的资源已经删除！",8);
exit;
} 
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if ($user)
{
if (!is_numeric($id))
{
$ykurl=$_GET["id"];
}
else
{
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
	
function Thunder($url, $type='en') {
if($type =='en'){
return "thunder://".base64_encode("AA".$url."ZZ");
}else{
return substr(base64_decode(substr(trim($url),10)),2,-2);
}
}

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

$type="where id='$id'";
$neirong=queryall(se2mvnr,$type);
$ykurl = $neirong[url];
$jiance = substr_count($ykurl,'qq.com');
$jiance2 = substr_count($ykurl,'youku.com');
$yyt = substr_count($ykurl,'v.yinyuetai.com/video/');
}
if ($yyt==1)
{
$url=$ykurl;
$time=$_SERVER['REQUEST_TIME'];
preg_match('/[\d]+/',$url,$song_id);
$song_id=$song_id[0];
$songurl = "http://www.yinyuetai.com/api/info/get-video-urls?callback=callback&videoId=".$song_id."&_=".$time;
$data = file_get_contents($songurl);
$bqxz=str_replace("\"","",$data);
$bqxz = substr_count($bqxz,'error:true');
if ($bqxz==1){
$url = 'http://s.tool.chinaz.com/tools/pagecode.aspx';
$post_data['searchMode'] = '1';
$post_data['q'] = $songurl;
$post_data['codecolor'] = '0';
//$post_data = array();
$res = request_post($url, $post_data);
$res=myTrim($res);
$get_c_str = new get_c_str;  
$res=$get_c_str -> get_str($res,"hcVideoUrl&quot;:&quot;","&quot;,&quot;logined");  
$res=Thunder($res);
echo msglayerurl("资源获取中…",8,"$res");
exit;

if (1==2){  
$ejtz=rawurlencode($songurl); 
$file_name="http://i.links.cn/viewcode.asp?weburl=".$ejtz;
$file_handle = fopen("$file_name", "r");  
while (!feof($file_handle)) {  
   $line = fgets($file_handle);  
   $sjb=$sjb.$line;  
}  
fclose($file_handle);}

$sjb=mb_convert_encoding($sjb, "UTF-8", "GBK");
$sjb=myTrim($sjb);
$get_c_str = new get_c_str;  
$sjb=$get_c_str -> get_str($sjb,"hcVideoUrl&quot;:&quot;","&quot;,&quot;logined");  
echo $sjb;
exit;
header('Location: '.$sjb);
}
if (strpos($data, "callback") !== false){
    $lpos = strpos($data, "(");
    $rpos = strrpos($data, ")");
    $data  = substr($data, $lpos + 1, $rpos - $lpos -1);
}
$json= json_decode($data,true);
if(empty($clarity)){ 
$clarity="1";
} 
	switch ($clarity){
	case '1':
 	$yyturl= $json['hcVideoUrl'];
	break;
  	case '2':
	$yyturl= $json['hdVideoUrl'];
	break;
	case '3':
	$yyturl= $json['heVideoUrl'];
	break;
	}
$res=Thunder($yyturl);
echo msglayerurl("资源获取中…",8,"$res");
exit;
}
else
{
if ($jiance==1 || $jiance2==1)
{
        $id = $neirong[mvbh];
        $url = 'http://www.mvxz.net/player/down.php';
        $post_data['vid'] = $id;
		$post_data['pid'] = '0';
        //$post_data = array();
        $res = request_post($url, $post_data);   
		$res=str_replace("'","",$res); 
        $res=str_replace(",","",$res); 
        $res=str_replace(array("\r\n", "\r", "\n"), "", $res);   
        $res=str_replace("	","",$res);
		$res=myTrim($res);
		$get_c_str = new get_c_str;  
		$res=$get_c_str -> get_str($res,"<ahref=\"","\"target"); 
		$res=str_replace("&amp;","&",$res); 
$res=Thunder($res);
echo msglayerurl("资源获取中…",8,"$res");
exit;
}else{
$ykurl=str_replace("&amp;","&",$ykurl);
$ykurl=Thunder($ykurl);
echo msglayerurl("资源获取中…",8,"$ykurl");
exit;
}
}
}
else
{
echo msglayer("VIP会员才可下载！",8);
exit;
}
?>