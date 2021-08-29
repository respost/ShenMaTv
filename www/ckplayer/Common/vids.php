<?php
function getvideoid($url){
	$data['status'] = 0;
	if(strpos($url,'youku.com')){
		$data['type'] = 'youku';
		if(strpos($url,'html')){
			$data['id']=inter($url,'id_','.html');
		}
		
		elseif(strpos($url,'swf')){
			$data['id']=inter($url,'/sid/','/');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'letv.com')){
		$data['type'] = 'letv';
		if(strpos($url,'html')){
			$data['id']=inter($url,'vplay/','.html');
		}		
		elseif(strpos($url,'swf')){
			$data['id']=inter($url,'id=','&');
		}else{
			urldebug($url);
		}		
	}elseif(strpos($url,'wasu.cn')){
		$data['type'] = 'wasu';
		if(strpos($url,'/show/')){
			$data['id'] = inter($url,'id/','');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'yinyuetai.com')){
		$data['type'] = 'yinyuetai';
		if(strpos($url,'/video/')){
			$data['id'] = inter($url,'video/','');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'pptv.com')){
		$data['type'] = 'pptv';
		if(strpos($url,'show/')){
			$data['id'] = inter($url,'show/','.html');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'ifeng.com')){
		$data['type'] = 'ifeng';
		if(strpos($url,'shtml')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-1];
			$wd=str_replace('.shtml','',$wd);
			$data['id'] = $wd;
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'qq.com')){
		$data['type'] = 'qq';
		if(strpos($url,'html')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-1];
			$wd=str_replace('.html','',$wd);
			$data['id'] = $wd;
		}
		elseif(strpos($url,'swf')){
			$data['id']=inter($url,'vid=','&');
		}else{
			urldebug($url);
		}	
	}elseif(strpos($url,'56.com')){
		$data['type'] = '56';
		if(strpos($url,'v_')){
			$wd=inter($url,'v_','.');
		}elseif(strpos($url,'cpm_')){
			$wd=inter($url,'cpm_','.');
		}elseif(strpos($url,'vid-')){
			$wd=inter($url,'vid-','.');
		}elseif(strpos($url,'open_')){
			$wd=inter($url,'open_','.');
		}elseif(strpos($url,'redian/')){
			$wd=explode('redian/',$url);
			$wd2 = explode('/',$wd[1]);
			$wd = '';
			$wd = $wd2[0];
			if($wd2[1]){
				$wd = $wd2[1];
			}
		}
		if($wd){
			$data['id'] = $wd;
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'cntv.cn')){
		$data['type'] = 'cntv';
		$data['id']='';
		if(!$data['id']){
			$content=get_curl_contents($url);
			$data['id']=inter($content,'videoId:"','"');
		}elseif(strpos($url,'/video/')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-1];
			$data['id']=str_replace('','',$wd);
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'17173.com')){
		$data['type'] = '17173';
		$data['id']='';
		if(!$data['id']){
			$content=get_curl_contents($url);
			$data['id']=inter($content,'videoId: ',',');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'bilibili.com')){
		$data['type'] = 'bilibili';
		if(strpos($url,'/video/')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-2];
			$wd=inter($wd,'av','');
			$urlapi="http://www.bilibilijj.com/Api/AvToCid/$wd";
			$content=get_curl_contents($urlapi);
			
            $data['id'] = inter($content,'cid&quot;:','}');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'tudou.com')){
		$data['type'] = 'tudou';
		$data['id']='';
		if(strpos($url,'swf')){
			
			$wd=inter($url,'iid=','&');

			$data['id'] = $wd;
		}
		if(strpos($url,'programs/view')){
			$content=get_curl_contents($url);
			$wd=inter($content,'iid: ',' ');
			$data['id'] = $wd;
		}

		if(strpos($url,'tudou.com/v/')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-3];

			$url="http://www.tudou.com/programs/view/$wd/";
			$content=get_curl_contents($url);
			$wd=inter($content,'iid: ',' ');
			$data['id'] = $wd;
		}
		if(strpos($url,'tudou.com/listplay')){
			$content=get_curl_contents($url);
			$wd=inter($content,'iid: ',' ');
			$wd= substr($wd,0,9);
			$data['id'] = $wd;
		}
		if(!$data['id']){
			$content=get_curl_contents($url);
			$wd=inter($content,'vcode:"','"');
			if(!$wd){
				$wd=inter($content,'vcode: \'','\'');	
			}
			if ($wd){
				$data['type'] = 'tudou';
				$data['id'] = trim(inter($content,'iid:',','));
			}else{
			urldebug($url);
		}
		}
	}elseif(strpos($url,'hunantv.com')){
		$data['type'] = 'mgtv';
        if(strpos($url,'html')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-1];
			$data['id']=str_replace('.html','',$wd);
		}elseif(strpos($url,'swf')){
			$data['id']=inter($url,'video_id=','');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'sohu.com')){
		$data['type'] = 'sohu';
		$data['id']='';
		if(!$data['id']){
            $url=get_curl_contents($url);
			$wd=inter($url,'var vid="','";');
			$data['id']=$wd;
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'sina.com.cn')){
		$data['type'] = 'sina';
		if(strpos($url,'sina.com.cn')){
            $url=get_curl_contents($url);
			$wd=inter($url,"hd_vid:'","'");
			$data['id']=$wd;
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'pps.tv')){
		$data['type'] = 'pps';
		$data['id']='';
		if(strpos($url,'html')){
			$data['id']=inter($url,'play_','.html');
		}	
		else{
			urldebug($url);
		}
	}elseif(strpos($url,'fun.tv')){
		$data['type'] = 'fun';		
		$data['id']='';
		if(strpos($url,'fun.tv/')){
			$content=get_curl_contents($url);		
			$data['id']=inter($content,'vplay.videoid = ',';');
		}	
		else{
			urldebug($url);
		}
	}elseif(strpos($url,'iqiyi.com')){
		$data['type'] = 'iqiyi';
		$data['id']='';
		if(!$data['id']){
			$content=get_curl_contents($url);
			$data['id']=inter($content,'data-player-videoid="','"');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'ku6.com')){
		$data['type'] = 'ku6';
		if(strpos($url,'html')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-1];
			$wd=str_replace('.html','',$wd);
		}else{
			urldebug($url);
		}
		if($wd){
			$data['id'] = $wd;
		}else{
			urldebug($url);
		}
	}else{
		$data['type'] = 'url';
		$data['id'] = $url;
	}
	return $data;
}



function inter($str,$start,$end){
	$wd2='';
	if($str && $start){
		$arr=explode($start,$str);
		if(count($arr)>1){
			$wd=$arr[1];
			if($end){
				$arr2=explode($end,$wd);
				if(count($arr2)>1){
					$wd2=$arr2[0];
				}
				else{
					$wd2=$wd;
				}
			}
			else{
				$wd2=$wd;
			}
		}
	}
	return $wd2;
}
?>