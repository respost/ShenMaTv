<?php
/* 2014年8月6日 优酷视频解析 PC版 默认返回xml格式
* update 2015年4月28日  增加判断视频是否存在
* update 2015年11月27日 更改视频信息页获取地址。算法基本没变。
* 2015年12月10日  flv,mp4增加hd后缀
* 2016年1月20日 add cookies,fixed 视频地址404
* 2016年5月25日 增加密码视频,会员视频判断
* 调用方法：
* CK部分
* 1. 网址格式：yk_pc.php?url=http://v.youku.com/v_show/id_XMTM4NTQ5MzM2NA==.html
* 1.1 网址格式：yk_pc.php?url=http://player.youku.com/player.php/sid/XOTM1MTEwODQ0/v.swf
* 1.2 网址格式：yk_pc.php?url=http://player.youku.com/player.php/Type/Folder/Fid/22981439/Ob/1/sid/XNzQ3Mjk2NzE2/v.swf
* 2. id格式：yk_pc.php?id=XMTM4NTQ5MzM2NA==
* 2.1 id格式：yk_pc.php?id=XMTM4NTQ5MzM2NA==.3
* cmp部分
* 3. cmp调用：yk_pc.php?cmpurl=http://v.youku.com/v_show/id_XMTM4NTQ5MzM2NA==.html
* 3.1 cmp调用：yk_pc.php?cmpid=XMTM4NTQ5MzM2NA==
* 3.2 cmp调用：yk_pc.php?cmpid=XMTM4NTQ5MzM2NA==.3
* 仅供学习参考，勿用于商业用途
*/
error_reporting(0);
include("../config/conn.php");
include("../config/common.php");
header('Content-Type: application/json;charset=UTF-8');
$id=$_GET["id"];
$id=base64_decode($id);
$id=($id-61857329)/628;
$style=$_GET["style"];
$page=$_GET["page"];
if (!is_numeric($id))
{
$ykurl=$_GET["id"];
}
else
{
if($id== null){ 
echo "<script>alert('抱歉，你访问的资源已经删除')</script>";
} 
$type="where id='$id'";
if(empty($style)){ 
$style="2";
}
switch ($style){
	case '2':
 	$datasheet= 'se2nr';
	break;
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
$url_1 = $url;//按逗号分离字符串 
$url_2 = explode('|',$url_1); 
$array = $url_2;
$count = count($url_2);
if ($count>1)
{
$url=$array[$page];
}
$ykurl=$url;
}
header("Content-Type:text/xml;charset=utf-8");
$sign = ".";
define("SG", "$sign");
$url = $_GET["url"];
if (isset($url) && $url != "") {
    $ykid = strpos($url, "youku.com");
    if ($ykid > 0) {
        $ykvid = checkyk($url);
        $ykdata = getyk($ykvid,$qxd);
        getckxml($ykdata);
        exit;
    }
}
$url = $_GET["cmpurl"];
if (isset($url) && $url != "") {
    $ykid = strpos($url, "youku.com");
    if ($ykid > 0) {
        $ykvid = checkyk($url);
        $ykdata = getyk($ykvid,$qxd);
        getcmpxml($ykdata);
        exit;
    }
}
$id = $ykurl;
if ($id && $id != "") {
    $ykids = explode(SG, $id);
    $arrlen = count($ykids);
    $qxd = $ykids[1];
    $ykid = $ykids[0];
    $ykdata = getyk($ykid,$qxd);
    getckxml($ykdata);
    exit;
}
$id = $_GET["cmpid"];
if ($id && $id != "") {
    $ykids = explode(SG, $id);
    $arrlen = count($ykids);
    $qxd = $ykids[1];
    $ykid = $ykids[0];
    $ykdata = getyk($ykid,$qxd);
    getcmpxml($ykdata);
    exit;
}
//调用出错
Get_CW();
function checkyk($url){
    if (strpos($url,"swf") > 0) {
        $vids = explode("/",$url);
        $num = count($vids);
        if ($num == 7) {
            $vid = $vids[5];
            if ($vid != null && $vid != "") {
                return $vid;
            }
        }elseif ($num == 13) {
            $vid = $vids[11];
            if ($vid != null && $vid != "") {
                return $vid;
            }
        }
    }else{
        preg_match("|id\_([\w=]+)|", $url, $vids);
        $vid = $vids[1];
        if (isset($vid) && $vid != null){
            return $vid;
        }
    }
    Get_CW();
}
function getyk($vid, $qxd){
    $api = "http://play.youku.com/play/get.json";
    $app = "&ran=";
    $ctype = "&ct=".(chr(49).(dechex("111001") << 2)/2);
    $kurl ="http://k.youku.com/player/getFlvPath/sid/";
    $url = $api . "?vid=" . $vid . $ctype . $app . rand(0,9999);
    $html = get_curl_contents($url);
    $jdata = json_decode($html);
    $ykdata = $jdata->data;
    $pay = $ykdata->pay;
    $price = $pay->price;
    $privacy = $ykdata->video->privacy;//password
    if (is_numeric($price) && $price != "") {
        Get_CW2();
        exit;
    }
    if ($privacy == "password") {
        Get_CW3();
        exit;
    }
    $oip = $ykdata->security->ip;
    $ep = $ykdata->security->encrypt_string;
    if (!$ep) {
        Get_CW();
    }
    $stream = $ykdata->stream;
    $st = explode("_", yk_e("becaf9be", base64_decode($ep)));
    $sid = $st[0];
    $token = $st[1];
    if (!$sid) {
        Get_CW();
    }
    $definition = $stream;
    $types = array();
    foreach ($definition as $key => $v) {
        $stream_type = $v->stream_type;
        $audio_lang = $v->audio_lang;
        if ($stream_type == "3gphd") {
            continue;
        }
        if ($audio_lang == "default" || $audio_lang == "guoyu") {
            array_push($types, $stream_type);
        }
    }
    $xhcs = count($types);
    $hden2 = array("1","2","3","4");
    if (!$qxd) {
        $vtype = $hden2[$xhcs-1];
        $qxurl = $vid.SG.$vtype;
        $vtype = $types[$xhcs-1];
    }else{
        $vtype2 = $qxd;
        $qxurl = $vid.SG.$vtype2;
    }
    if ($vtype2 != "") {
        for ($i=0; $i < $xhcs; $i++) { 
            if ($hden2[$i] == $vtype2) {
                $num = $i;
                $vtype = $types[$num];
                break;
            }
        }
        if ($vtype == "") {
            $vtype = $types[$xhcs-1];
        }
    }
    $yktypes = array("flvhd","mp4hd","mp4hd2","mp4hd3");
    $ykhd = array("0","1","2","3");
    $ykformatname = array("flv","mp4","flv","flv");
    $ykclear = array("标清","高清","超清","1080");
    $ykarr = array("type"=>$yktypes,"hd"=>$ykhd,"fn"=>$ykformatname,"cl"=>$ykclear);
    $title = $ykdata->show->title;
    if (!$title) {
        $title = $ykdata->video->title;
    }
    $xml["data"]["qxurl"] = $qxurl;
    $xml["data"]["defa"] = getdefa($xhcs,$vid);
    $xml["data"]["deft"] = getdeft($xhcs);
    $xml["data"]["phpself"] = $_SERVER["PHP_SELF"];
    $xml["data"]["title"] = $title;
    foreach ($stream as $key => $v) {
        $stream_fileid = $v->stream_fileid;
        $stream_type = $v->stream_type;
        if ($stream_type == $vtype) {
            $segs = $v->segs;
            $fileid_1 = substr($stream_fileid, 0, 8);
            $fileid_2 = substr($stream_fileid, 10);
            for ($i=0; $i < count($types); $i++) {
                if ($stream_type == $ykarr["type"][$i]) {
                    $hd = $ykarr["hd"][$i];
                    $formatname = $ykarr["fn"][$i];
                    $clear = $ykarr["cl"][$i];
                    break;
                }
            }
            $xml["data"]["clear"] = $clear;
            foreach ($segs as $k => $value) {
                $hex = strtoupper(dechex($k)) ."";
                if (strlen($hex) < 2){
                    $hex = "0" . $hex;
                }                    
                $fileid = $fileid_1 . $hex . $fileid_2;
                $ep1 = urlencode(iconv("gbk", "UTF-8", base64_encode(yk_e("bf7e5f01", $sid . "_" . $fileid . "_" . $token))));
                $key = $value->key;            
                $ts = $value->total_milliseconds_video;
                $downlink = $kurl . $sid ."_".$hex."/st/" . $formatname . "/fileid/" . $fileid. "?K=" . $key . "&hd=".$hd."&myp=0&ts=".intval($ts/1E3). "&ypp=0&ymovie=1&ctype=".str_replace("&ct=", "", $ctype)."&ev=1&token=". $token ."&oip=". $oip ."&ep=". $ep1;
                $xml["data"]["url"][$k]["downlink"] = $downlink;
                $xml["data"]["url"][$k]["size"] = $value->size;
                $xml["data"]["url"][$k]["ts"] = intval($ts/1E3);
            }
            return $xml;
        }
    }
    return;
}
/*输出ckxml格式*/
function getckxml($data){
    $ckxml .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $ckxml .= "<ckplayer><flashvars>{h->3}{a->".$data["data"]["qxurl"]."}{defa->".$data["data"]["defa"]."}{deft->".$data["data"]["deft"]."}{f->".$data["data"]["phpself"]."?id=[\$pat]}</flashvars><filename><![CDATA[".$data["data"]["title"]."]]></filename><type><![CDATA[".$data["data"]["clear"]."]]></type>";
    foreach ($data["data"]["url"] as $k => $value) {
        $downlink = $value["downlink"];
        $size = $value["size"];
        $ts = $value["ts"];
        $ckxml .= "<video><file><![CDATA[".$downlink."]]></file><size>".$size."</size><seconds>".$ts."</seconds></video>";
    }
    $ckxml .= "</ckplayer>";
    echo $ckxml;
    return;
}
/*cmpxml格式*/
function getcmpxml($data){
    $label = $data["data"]["title"];
    $clear = $data["data"]["clear"];
    $merge = "<m starttype=\"0\" label=\"$label\" type=\"flv\" bytes=\"$clear\" duration=\"\">";
    foreach ($data["data"]["url"] as $k => $value) {
        $downlink = $value["downlink"];
        $size = $value["size"];
        $ts = $value["ts"];
        $merge .= "<u duration=\"$ts\"  bytes=\"$size\" src=\"$downlink\" />";
    }
    $merge .= "</m>";
    echo $merge;
    return;
}
function getdefa($xhcs,$vid){
    $hden2 = array("1","2","3","4");
    for ($i=0; $i < $xhcs; $i++) { 
        if ($i>0) {
            $defa .= "|".$vid.SG.$hden2[$i];
        }else{
            $defa .= $vid.SG.$hden2[$i];
        }
    }
    return $defa;
}

function getdeft($xhcs){
    $hdcn = array("标清","高清","超清","1080P");
    for ($i=0; $i < $xhcs; $i++) { 
        if ($i>0) {
            $qxd .= "|".$hdcn[$i];
        }else{
            $qxd .= $hdcn[$i];
        }
    }
    return $qxd;
}
function yk_e($a, $c){
    for ($f = 0, $i, $e = '', $h = 0; 256 > $h; $h++)
        $b[$h] = $h;
    for ($h = 0; 256 > $h; $h++) {
        $f     = ($f + $b[$h] + charCodeAt($a, $h % strlen($a))) % 256;
        $i     = $b[$h];
        $b[$h] = $b[$f];
        $b[$f] = $i;
    }
    for ($q = $f = $h = 0; $q < strlen($c); $q++) {
        $h     = ($h + 1) % 256;
        $f     = ($f + $b[$h]) % 256;
        $i     = $b[$h];
        $b[$h] = $b[$f];
        $b[$f] = $i;
        $e .= fromCharCode(charCodeAt($c, $q) ^ $b[($b[$h] + $b[$f]) % 256]);
    }
    return $e;
}
//接受一个指定的 Unicode 值，然后返回一个字符串
function fromCharCode($codes){
    if (is_scalar($codes))
        $codes = func_get_args();
    $str = '';
    foreach ($codes as $code)
        $str .= chr($code);
    return $str;
}
//返回指定位置的字符的 Unicode 编码。这个返回值是 0 - 65535 之间的整数。
function charCodeAt($str, $index){
    static $charCode = array();
    $key   = md5($str);
    $index = $index + 1;
    if (isset($charCode[$key])) {
        return $charCode[$key][$index];
    }
    $charCode[$key] = unpack("C*", $str);
    return $charCode[$key][$index];
}
/*等价于as3的charAt*/
function charAt($str, $index = 0){
    return substr($str, $index, 1);
}
//curl方法
function get_curl_contents($url){ 
    if(!function_exists("curl_init")){
        die("php.ini未开启php_curl.dll");
    }
    $cweb = curl_init(); 
    curl_setopt($cweb,CURLOPT_URL,$url);
    curl_setopt($cweb,CURLOPT_HEADER,0);
    curl_setopt($cweb,CURLOPT_RETURNTRANSFER, 1);
    $header = array(
        "Accept:*/*",
        "Accept-Language:zh-CN,zh;q=0.8",
        "Connection:keep-alive",
        "Cookie:__ysuid=".time().";",
        "Host:play.youku.com",
        "Referer:http://static.youku.com/v1.0.0598/v/swf/player_yknpsv.swf",
        "User-Agent:Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36");
    curl_setopt($cweb,CURLOPT_HTTPHEADER, $header);
    $cnt = curl_exec($cweb);
    curl_close($cweb); 
    return $cnt;
}
function Get_CW() {
    header("Content-Type:text/json;charset=utf-8");
    $jsdata["error"] = 403;
    $jsdata["msg"] = "illegal parameters";
    echo json_encode($jsdata);
    exit;
}
function Get_CW2($vid){
    header("Content-Type:text/json;charset=utf-8");
    $jsdata["error"] = -112;
    $jsdata["msg"] = "not support for vip video";
    echo json_encode($jsdata);
    exit;
}
function Get_CW3() {
    header("Content-Type:text/json;charset=utf-8");
    $jsdata["error"] = -203;
    $jsdata["msg"] = "not support for privacy video";
    echo json_encode($jsdata);
    exit;
}
?>