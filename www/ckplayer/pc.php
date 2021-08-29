<?php
@header("Content-Type: text/xml");
error_reporting(0);
include_once('./Common/functions.php');
include("../config/conn.php");
include("../config/common.php");
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
if (!is_numeric($id)||!is_numeric($style)||!is_numeric($page)){
exit('参数错误');
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
if(!isset($_GET['vtype'])&&!isset($_GET['u'])&&isset($ykurl)){
    $ids='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"]."?url=".$ykurl."_youku";
	$ids=urldecode($ids);
	$ids=end(explode('url=',$ids));
$domain_list = array("*.*.com", "*.*.com");//白名单就是只允许这些来源域
$is_black_list = FALSE;

$allow_empty_referer =true;//是否允许空来源(默认允许),就是如果来源页为空时,允许通过,否则必须要有正确的来源地址,比如直接打开没有referer，还有Firefox中，wmp中，可能不一定每次都有referer来源地址

$referer = $_SERVER["HTTP_REFERER"];        
if($referer) {

        $refererhost = parse_url($referer);
        $host = strtolower($refererhost['host']);
        if($is_black_list) {

                if (in_array($host, $domain_list)) {
                        die;
                } else {
                        $arr=explode('_',$ids);
                }
        } else {
                if($host == $_SERVER['HTTP_HOST'] || in_array($host, $domain_list)) {
                      $arr=explode('_',$ids);
                } else {
                        die;
                }
        }
} else {
        if ($allow_empty_referer) {
             $arr=explode('_',$ids);
        } else {
                die;
        }
}
	$np=2;
	switch($arr[0]){
		case __CQ__:
			$pid='3';
			setcookie("pidcookie", $pid, time()+360000);
			break;
		case __GQ__:
			$pid='2';
			setcookie("pidcookie", $pid, time()+360000);
			break;
		case __BQ__:
			$pid='1';
			setcookie("pidcookie", $pid, time()+360000);
			break;
		default:
			$pid=$np;
			isset($_COOKIE["pidcookie"])&&$pid=$_COOKIE["pidcookie"];
			!$pid&&$pid=$np;
			break;
	}

	if(strstr($ids,'http://')==false){
	
		$type=end($arr);
		$id=strtr($ids,array(__BQ__."_" => "", __GQ__."_" => "", __CQ__."_" => "", "_".$type => ""));
		if(strpos($ids,'_wd')){
			switch($type){
			case 'wd1':
				$type='youku';
				break;
			case 'wd2':
				$type='wasu';
				break;
			case 'wd3':
				$type='letv';
				break;
			case 'wd4':
				$type='56';
				break;
			case 'wd5':
				$type='ku6';
				break;
			case 'wd6':
				$type='qq';
				break;	
			case 'wd7':
				$type='cntv';
				break;	
			case 'wd8':
				$type='mgtv';
				break;	
			case 'wd9':
				$type='sohu';
				break;	
			case 'wd10':
				$type='iqiyi';
				break;
			case 'wd11':
				$type='tudou';
				break;	
			case 'wd12':
				$type='ifeng';
				break;
			case 'wd13':
				$type='17173';
				break;	
			case 'wd14':
				$type='yinyuetai';
				break;
			case 'wd15':
				$type='bilibili';
				break;		
			case 'wd16':
				$type='pps';
				break;		
			case 'wd17':
				$type='sina';
				break;	
			case 'wd18':
				$type='pptv';
				break;
            case 'wd19':
				$type='fun';
				break;				
			default:
				break;
			}
		}
	}else{
		if(strpos($ids,'_http://')){
			$url=str_replace($arr[0].'_','',$ids);
		}else{
			$url=$ids;
		}
		include_once('./Common/vids.php');
		$data=getvideoid($url);
		$id=$data['id'];
		$type=$data['type'];
	}
}else{
	if(isset($_GET['vtype'])){
		$type=$_GET['vtype'];
		$id=$_GET['vid'];
	}elseif(isset($_GET['u'])){
		$ids = base64_decode($_GET['u']);
		if(preg_match("/^[a-zA-Z0-9-_]{4,41}\.[a-z0-9]{2,12}$/",$url)){
			list($id, $type)=explode('.', $ids);
		}else{
			include_once('./Common/vids.php');
			$data = getvideoid($url);
			if($data['status']<0){
				
				die;
			}
		}
	}
	
}
if(isset($type)){
	if($type){
		$type=ucfirst(strtolower($type));
		$filename='./Models/'.$type.'Model.php';
		if(file_exists($filename)){
			include_once($filename);
		}else{
			include_once('./Models/UrlModel.php');
		}
	}else{
		include_once('./Models/UrlModel.php');
	}
}else{
	include_once('./Models/UrlModel.php');
}
if(isset($id)){
	if($id){
		!$pid&&$pid=2;
		$t=getvideo($id,$pid);
		echo get_xml($t);
		die;
	}else{
		
		die;
	}
}else{
	
	die;
}

?>