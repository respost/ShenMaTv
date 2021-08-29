<?php
define ("__CQ__", "cq");
define ("__GQ__", "gq");
define ("__BQ__", "bq");
$hosturl= $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
list($hosturl,$end)=explode('?',$hosturl);
define ("__HOSTURL__", 'http://'.$hosturl);
unset($end,$hosturl);
function get_xml($data){
	$urls=$data['urls'];
	$vars=$data['vars'];
	$urllist='';
	foreach($urls as $key=>$value){
		$urllist.='		<video>'.chr(13);
		$urllist.="			<file><![CDATA[".$urls[$key]['url']."]]></file>".chr(13);
		if(isset($urls[$key]['sec'])){
			if(!isset($urls[$key]['size']))$urls[$key]['size']=0;
			$urllist.="			<size>".$urls[$key]['size']."</size>".chr(13);
			$urllist.="			<seconds>".$urls[$key]['sec']."</seconds>".chr(13);
		}
		$urllist.='		</video>'.chr(13);
	}
	$urllist2 = '';
	$urllist2.='<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	$urllist2.='	<ckplayer>';
	$urllist2.='	<flashvars>'.chr(13);
	$urllist2.='	<![CDATA['.$vars.']]>'.chr(13);
	$urllist2.='	</flashvars>'.chr(13);
	$urllist2.=$urllist;

	$urllist2.='	</ckplayer>';
	echo $urllist2;
}

function get_curl_contents($url,$header=0,$nobody=0){
		if(!function_exists('curl_init')) die('php.ini未开启php_curl.dll');
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_HEADER, $header);
		$cookie = array(
		'__ysuid=14471486699465Mt; __xmft=1447226049620; __tft=1450262360271; __vtft=1450262365440; __hpage_style=0; advideo={"adv205987_5": 4, "adv206012_2": 2, "adv206026_2": 2, "adv88187_1": 2, "adv88187_2": 2, "adv205916_3": 2, "adv206025_1": 2, "adv206025_2": 1, "adv206012_1": 1, "adv205916_4": 1, "adv206014_2": 2, "adv206028_1": 1, "adv205987_3": 3, "adv88186_1": 1, "adv88186_2": 2, "adv88186_3": 2, "adv88186_4": 21}; __ali=14541352788532cO; __aliCount=1; yktk=1%7C1454135282%7C15%7CaWQ6NDQ2ODEzMzkxLG5uOuaIkeS7rOmDveaYr%2BWwj%2BWkqumYs%2BS4tix2aXA6dHJ1ZSx5dGlkOjQ0NjgxMzM5MSx0aWQ6MA%3D%3D%7C540cf87a300c7e702033fe1ab64fb48b%7C39ee133b8ca7236c37aed5c51abe122ad0c43804%7C1',
		);
//随机取一个cookie
$rand = array_rand($cookie,1);
$cookie = $cookie[$rand];
curl_setopt($c, CURLOPT_COOKIE, $cookie);
		curl_setopt($c, CURLOPT_NOBODY, $nobody);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_REFERER, $url);
		curl_setopt($c, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$_SERVER["REMOTE_ADDR"], 'CLIENT-IP:'.$_SERVER["REMOTE_ADDR"]));
		$content = curl_exec($c);

		curl_close($c);
	return $content;
}

function urldebug($url,$off = false){//如果不希望往服务器回传数据，请自己把$off的值改为true
	$data['status'] = -1;
	$data['msg'] = '该地址不能正常解析，已经记录，会在最短的时间内解决该问题';
	$data['url'] = $url;
	if($off == false){
		$url= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		$out = 'http://debug.flv.pw/urldebug.php?url='.base64_encode($url);
		if($out != '1'){
			$data['msg'] = '该地址不能正常解析，地址记录无法正常记入数据库';
		}
	}
	echo json_encode($data);
	die;
}
?>