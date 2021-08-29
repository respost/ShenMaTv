<?php
define("TOKEN", "weixing");
define('IN_QISHI', true); 
error_reporting(0);
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//来源;
$the_host = $_SERVER['HTTP_HOST'];//取得当前域名
$wechatObj = new wechatCallbackapiTest();

		if( isset($_REQUEST['echostr']) )
					 $wechatObj->valid();
		elseif( isset( $_REQUEST['signature'] ) ){			  
				$wechatObj->responseMsg();
			 }
class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
		$keyword = iconv("utf-8","gb2312",$keyword);
                $time = time(); 
                $RX_TYPE = trim($postObj->MsgType);
                $Event = trim($postObj->Event);
                $EventKey = trim($postObj->EventKey);
                if ($Event == "subscribe")
                            {
                            $content = "您好，感谢关注西瓜污漫公众号！\n\n你可以在这里直接查找最新的国内外漫画。\n\n输入“n”或“最新”查看最新漫画，例如：最新漫画、看漫画、新漫画等等。\n\n输入“g”或“国产”查看最新国产漫画，例如：国产、国内等等。\n\n输入“r”或“日本”查看最新日本漫画，例如：日本、日本漫画等等。\n\n输入#加搜索关键词可以查找相关的漫画，例如：#斗破苍穹、#妖怪名单、#狐妖小红娘等等。\n\n输入@加搜索关键词可以查找相关的更新章节，例如：@银之守墓人、@微光世界、@银魂等等。\n\n输入“人气”或“人气排行”显示人气的漫画排行榜。\n\n查看帮助请直接输入“help”或“帮助”。";  
                            $text="<xml>
		                     <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
		                     <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
		                     <CreateTime>".$time."</CreateTime>
		                     <MsgType><![CDATA[text]]></MsgType>
		                     <Content><![CDATA[".$content."]]></Content>
		                     </xml> ";
                             $text=iconv("gb2312","utf-8",$text);
	                         echo $text;
                             exit;
                            }
		                   define("WELCOME" , "欢迎关注西瓜污漫公众号！回复g,返回国产漫画，回复n返回最新漫画！");
	                    	//定义欢迎词
	                       define(ROOT,"http://api.cqsfw.com");
		                  //定义网站路径
		                   $default_pic=ROOT."/plus/default5.jpg";
		                  //默认的图片(正方形)
		                   $first_pic=ROOT."/plus/weixin5.jpg"; 
		                   //默认的第一张图片(长方形),仅支持jpeg格式
                          if (!empty($keyword) || $Event == "CLICK")
                           {
						   $jlss=substr_count($keyword,'%');
                          if ($keyword=="帮助" || $keyword=="help")
                          {
                          if ($keyword=="帮助" || $keyword=="help")
                               {$content =  "输入“n”或“最新”查看最新漫画。\n\n输入“g”或“国产”查看最新国产漫画。\n\n输入“r”或“日本”查看最新日本漫画。\n\n输入#加搜索关键词可以查找相关的漫画信息，例如：#斗破苍穹、#妖怪名单、#狐妖小红娘等等。\n\n输入@加搜索关键词可以查找相关的更新章节，例如：@银之守墓人、@微光世界、@银魂等等。\n\n输入“人气”或“人气排行”显示人气的漫画排行榜。\n\n输入“help”或“帮助”显示操作指令大全。";}  
                                $text="<xml>
	                        	<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
	                        	<FromUserName><![CDATA[".$toUsername."]]></FromUserName>
	                         	<CreateTime>".$time."</CreateTime>
	                         	<MsgType><![CDATA[text]]></MsgType>
		                        <Content><![CDATA[".$content."]]></Content>
		                        </xml> ";
                                $text=iconv("gb2312","utf-8",$text);
		                        echo $text;
                                exit;
                           }else{			
						        if($keyword=="n" || $keyword=="N" || $keyword=="最新" || $keyword=="最新漫画" || $keyword=="看漫画" || $keyword=="新漫画" || $EventKey == "newjobs")                  
						        { 		
								$zhiling="1=1";
						        $limit="LIMIT 0,8";
                                $style="1";
								$table="se2mh";			 
                                }
							    else if($keyword=="g" || $keyword=="G" || $keyword=="国产" || $keyword=="国内" || $keyword=="国漫" || $EventKey == "emergencyjobs")
						        {
					 	        $zhiling="fenlei=1";
                                $style="2";
						        $limit="LIMIT 0,8";
								$table="se2mh";
						        }else if($keyword=="r" || $keyword=="R" || $keyword=="日本" || $keyword=="日本漫画"  || $keyword=="日漫" || $EventKey == "recommendjobs"){
					 	        $zhiling="fenlei=2";
								$style="4";
                                $limit="LIMIT 0,8";		
								$table="se2mh"; 
					            }else{
                                             $style="3";
                                             $mhcx=substr_count($keyword,'@');
                                             $zjcx=substr_count($keyword,'#');
                                             $cx=($mhcx-$zjcx)*1;
                                             if ($cx>0)
                                             {$table="se2mh";}
                                             else if($cx<0)
                                             {$table="se2mhzj";}
                                             else if($cx==0)
                                             {$table="se2mh";}
                                             $keyword=str_replace("@","",$keyword);
                                             $keyword=str_replace("#","",$keyword);
                                             $zhiling="name like '%".$keyword."%' ";
						                     $limit="LIMIT 0,8";}    
                                            
							 $wheresql="select * from ".$table." where ".$zhiling." order by addtime desc ".$limit;
							 $wheresql=mysql_query($wheresql);								
							 $count=mysql_num_rows($wheresql);
								if($count==0){
									 $word="没有找到包含关键字的漫画，试试其他关键字？比如“邪恶”“少女”。回复g，返回国内漫画，回复r返回日本漫画！";
                                     $text="<xml>
											<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
											<FromUserName><![CDATA[".$toUsername."]]></FromUserName>
											<CreateTime>".$time."</CreateTime>
											<MsgType><![CDATA[text]]></MsgType>
											<Content><![CDATA[".$word."]]></Content>
											</xml> ";
                                            $text=iconv("gb2312","utf-8",$text);
											echo $text;
                                            exit;
								}else{                    
							   while($row=mysql_fetch_array($wheresql))
                                  {$name=$row['name'];			
								   $pic=ROOT."/".$row['pic'];	
                                   $addtime=$row['addtime'];
								   $addtime=date("Y年m月d日",$addtime);
								   $url=ROOT."/touch/position/posInfo.php?m.posId=".$row['id']."&m.isBidding=0";
                                   $word=$word."\n<a href=\"".$url."\">".$name."</a>\n".$addtime."\n";
								   	         $strmiddle.="<item>
											 <Title><![CDATA[".$name."]]></Title> 
											 <Description><![CDATA[".$con."]]></Description>
											 <PicUrl><![CDATA[".$pic."]]></PicUrl>	
											 <Url><![CDATA[".$url."]]></Url>
											 </item>";	
                                   }
                                    $date=date("Y年m月d日",$time);
								   		$strbegin="<xml>
										 <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
										 <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
										 <CreateTime>".$time."</CreateTime>
										 <MsgType><![CDATA[news]]></MsgType>
										 <ArticleCount>".$count."</ArticleCount>
										 <Articles>";
										$strend = "</Articles>
										 <FuncFlag>1</FuncFlag>
										 </xml>";
                                           $text="<xml>
		                                   <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>
	                                       <FromUserName><![CDATA[".$toUsername."]]></FromUserName>
		                                   <CreateTime>".$time."</CreateTime>
		                                   <MsgType><![CDATA[text]]></MsgType>
	                                       <Content><![CDATA[".$content."]]></Content>
		                                   </xml> ";
										   $strbegin=iconv("gb2312","utf-8",$strbegin);
                                           $strmiddle=iconv("gb2312","utf-8",$strmiddle);
                                           $strend=iconv("gb2312","utf-8",$strend);	
                                           $text=iconv("gb2312","utf-8",$text);
	                                       echo $strbegin.$strmiddle.$strend;
                                           exit;
								   }	
								      }
						                 }
										 else 
										 {
			                              echo "";
			                              exit;
										  }
									  }
							      }	
	                          private function checkSignature()
	                             {
                                    $signature = $_GET["signature"];
                                    $timestamp = $_GET["timestamp"];
                                    $nonce = $_GET["nonce"];	
        		              		$token = TOKEN;
	                            	$tmpArr = array($token, $timestamp, $nonce);
	                            	sort($tmpArr);
	                             	$tmpStr = implode( $tmpArr );
		                            $tmpStr = sha1( $tmpStr );
		                      if( $tmpStr == $signature ){
		                          return true;
								  }else{
								  return false;
								  }
								      }
                                           }
                              function get_user_info($fromUsername)
                               {
                               $info="SELECT * FROM ".table('members')." WHERE weixin_openid='".$fromUsername."' LIMIT 1";
                               $result = mysql_query($info);
                               while($row_uid = mysql_fetch_assoc($result))
                              {$usinfo=$row_uid['uid'];}
                               return $usinfo;
                               }
							   function get_user_setmeal($uid)
                               {
							   $setmeal_time=time();
                               $setmeal="SELECT * FROM ".table('members_setmeal')." WHERE uid='".$uid."' and setmeal_id>1 and endtime>=".$setmeal_time." LIMIT 1";
                               mysql_query($setmeal);
                               if (mysql_affected_rows())
                               {$content = "1";}else{$content = "0";}
                               return $content;
                               }
?>