<?php
error_reporting(0);
include("../config/conn.php");
include("../config/common.php");
$rfr = $_SERVER['HTTP_REFERER'];//来源;
$cshq = $_SERVER["QUERY_STRING"];//参数
$dqwz = $_SERVER['HTTP_HOST'];
$task = $_GET["task"];
$userid = $_COOKIE[uid];
$time = time();
$wzis = substr_count($rfr,$dqwz);
$csjs = substr_count($rfr,"v1");
if (empty($task))
{
header('Content-Type: application/json;charset=UTF-8');
if (($wzis==0 || $csjs==0) && 1==2)
{
header('Location: http://'.$dqwz);
exit;
}
}
else
{
$user=getone("select * from ubouser WHERE hylx>0 and endtime>$time and userid='$userid'");
if (empty($user))
{
echo msglayer("VIP会员才可下载！",8);
exit;
}
}
$id=$_GET["id"];
$clarity=$_GET["clarity"];
$page=$_GET["page"];
if ($page)
{
$page=floor($page-1);
}
else
{$page=0;}
$id=base64_decode($id);
$id=($id-61857329)/628;
if (!is_numeric($id))
{
$ykurl=$_GET["id"];
}
else
{
if($id== null){ 
echo "<script>alert('抱歉，你访问的资源已经删除')</script>";
exit;
}
$spid=$_COOKIE[spid];
$spid = str_replace(",","#",$spid);
$lid="#".$id;
$lstj=substr_count("#".$spid,$lid);
if ($lstj==0)
{
$sp_2 = explode('#',$spid); 
$sp_count = count($sp_2);
if ($spid)
{
$spid=$spid.$lid;
$arr=explode('#',$spid);
$sp_count = count($arr);
if ($sp_count>100)
{
$spid = str_replace($arr[0]."#","",$spid);
}
$spid = str_replace("#",",",$spid);
setcookie("spid",$spid,time()+3600*24*365*3,"/");
}else{
setcookie("spid",$id,time()+3600*24*365*3,"/");
}
}
//$arr = array($spid);
//$result=array_pop($arr);
//setcookie("ccid",$result,time()+3600*24*365,"/");
//}else{
//$spid=$lid.$spid;
//$ccid=$_COOKIE[ccid];
//if (isset($ccid))
//{
//$ccid=$ccid."|".$id;
//$arr=explode('|',$ccid); 
//$arr = array_unique($arr);
//$count = count($arr);
//for($index=0;$index<$count;$index++) 
//{
//$bbid.="|".$arr[$index];
//}
//$spid = str_replace("#0","",$spid."0");
//$spid = str_replace("#",",",$spid);
//if(count($spid)>2){
//array_pop($spid);
//}
//$arr = array($spid.",0");
//array_shift($arr);
//$result=array_pop($arr);
//$result=array_shift($arr);
//setcookie("ccid",$bbid,time()+3600*24*365,"/");
//}
//else
//{
//setcookie("ccid",$id,time()+3600*24*365,"/");
//}
//}
//}
//setcookie("spid",$spid,time()-1000,"/");
//setcookie("ccid",$spid,time()-1000,"/");
//$spid=$_COOKIE[spid];
//if(isset($spid)){
// $urls = $spid;
// $arr = unserialize($urls);
// $arr[] = $id;
// $arr = array_unique($arr);
// if(count($arr)>100){
//  array_shift($arr);
// }
// $urls = serialize($arr);
// setcookie("spid",$urls,time()+3600*24*365,"/");
// $getcontent = unserialize(str_replace("\\", "", $urls)); 
//foreach($getcontent as $row=>$r) 
//{ 
//$spid.=$r."#";
//}
//}else{
// $url = $id;
// $arr[] = $url;
// $urls = serialize($arr);
// setcookie("spid",$urls,time()+3600*24*365,"/");
// $getcontent = unserialize(str_replace("\\", "", $urls)); 
//foreach($getcontent as $row=>$r) 
//{ 
//$spid.=$r."#";
//} 
//}

$type="where id='$id'";
$neirong=queryall(se2nr,$type);
$type="cishu=cishu+1 where id=".$id;
upalldt(se2nr,$type);
$ykurl = $neirong[url];
$name = $neirong[name];
$division=$neirong[division];
if ($division==1)
{
$uid=$neirong[uid];
$type="cishu=cishu+1 where id=".$uid;
upalldt(ubozb,$type);
}
$url_1 = $ykurl;//按逗号分离字符串 
$url_2 = explode('|',$url_1); 
$array = $url_2;
$count = count($url_2);
if ($count>1)
{
$ykurl=$array[$page];
}
$downloadurl = $neirong[download];
$downloadurl_1 = $downloadurl;//按逗号分离字符串 
$downloadurl_2 = explode('|',$downloadurl_1); 
$array_2 = $downloadurl_2;
$count_2 = count($downloadurl_2);
if ($count_2>1)
{
$downloadurl=$array_2[$page];
}
if ($task=="download" && $count_2>0){
$islx = substr_count($downloadurl,'http');
$ismp4 = substr_count($downloadurl,'.mp4');
$isflv = substr_count($downloadurl,'.flv');
if ($islx==0 && $ismp4==0 && $isflv==0)
{
echo msglayer("此类型文件不支持下载！",8);
exit;
}
}
}
$yyt = substr_count($ykurl,'yinyuetai.com/video/');
if ($yyt==1)
{
$url=$ykurl;
$time=$_SERVER['REQUEST_TIME'];
preg_match('/[\d]+/',$url,$song_id);
$song_id=$song_id[0];
$songurl = "http://www.yinyuetai.com/api/info/get-video-urls?callback=callback&videoId=".$song_id."&_=".$time;
$data = file_get_contents($songurl);
if (strpos($data, "callback") !== false){
    $lpos = strpos($data, "(");
    $rpos = strrpos($data, ")");
    $data  = substr($data, $lpos + 1, $rpos - $lpos -1);
}
$json= json_decode($data,true);
if(empty($clarity)){ 
$clarity="2";
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
	if ($task=="download"){
$yyturl = iconv('gb2312','utf-8',$yyturl);
//$Type = str_replace(".","#.",$yyturl);
//$Type = preg_replace("/#[^>]+#/", "", "#".$Type);
//$type=explode('.',$ykurl);
//$type=$type[count($type)-1];
$filesize=filesize($yyturl);
header("Content-type: application/octet-stream"); 
header("Accept-Ranges: bytes");
header("Accept-Length:".$filesize ); 
header("Content-Disposition: attachment; filename=".$name.".flv");
ob_clean();
flush();
readfile($yyturl);
exit;
}
else
{
header('Location: '.$yyturl);
exit;
}
}
else
{
if ($task=="download"){

//$file = file_get_contents($ykurl);
if ($downloadurl)
{$ykurl=$downloadurl;}
$ykurl = iconv('gb2312','utf-8',$ykurl);
$Type = str_replace(".","#.",$ykurl);
$Type = preg_replace("/#[^>]+#/", "", "#".$Type);
//$type=explode('.',$ykurl);
//$type=$type[count($type)-1];
$filesize=filesize($ykurl);
header("Content-type: application/octet-stream"); 
header("Accept-Ranges: bytes");
header("Accept-Length:".$filesize ); 
header("Content-Disposition: attachment; filename=".$name.$Type);
ob_clean();
flush();
readfile($ykurl);
exit;
}
else
{
header('Location:'.$ykurl);
exit;
}
}
?>