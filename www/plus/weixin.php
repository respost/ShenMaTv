<?php
define("TOKEN", "weixing");
define('IN_QISHI', true); 
error_reporting(0);
include("../config/conn.php");
include("../config/common.php");
$userid=$_COOKIE[uid];
$url = $_SERVER['HTTP_REFERER'];//��Դ;
$the_host = $_SERVER['HTTP_HOST'];//ȡ�õ�ǰ����
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
                            $content = "���ã���л��ע�����������ںţ�\n\n�����������ֱ�Ӳ������µĹ�����������\n\n���롰n�������¡��鿴�������������磺�������������������������ȵȡ�\n\n���롰g���򡰹������鿴���¹������������磺���������ڵȵȡ�\n\n���롰r�����ձ����鿴�����ձ����������磺�ձ����ձ������ȵȡ�\n\n����#�������ؼ��ʿ��Բ�����ص����������磺#���Ʋ�񷡢#����������#����С����ȵȡ�\n\n����@�������ؼ��ʿ��Բ�����صĸ����½ڣ����磺@��֮��Ĺ�ˡ�@΢�����硢@����ȵȡ�\n\n���롰���������������С���ʾ�������������а�\n\n�鿴������ֱ�����롰help���򡰰�������";  
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
		                   define("WELCOME" , "��ӭ��ע�����������ںţ��ظ�g,���ع����������ظ�n��������������");
	                    	//���延ӭ��
	                       define(ROOT,"http://api.cqsfw.com");
		                  //������վ·��
		                   $default_pic=ROOT."/plus/default5.jpg";
		                  //Ĭ�ϵ�ͼƬ(������)
		                   $first_pic=ROOT."/plus/weixin5.jpg"; 
		                   //Ĭ�ϵĵ�һ��ͼƬ(������),��֧��jpeg��ʽ
                          if (!empty($keyword) || $Event == "CLICK")
                           {
						   $jlss=substr_count($keyword,'%');
                          if ($keyword=="����" || $keyword=="help")
                          {
                          if ($keyword=="����" || $keyword=="help")
                               {$content =  "���롰n�������¡��鿴����������\n\n���롰g���򡰹������鿴���¹���������\n\n���롰r�����ձ����鿴�����ձ�������\n\n����#�������ؼ��ʿ��Բ�����ص�������Ϣ�����磺#���Ʋ�񷡢#����������#����С����ȵȡ�\n\n����@�������ؼ��ʿ��Բ�����صĸ����½ڣ����磺@��֮��Ĺ�ˡ�@΢�����硢@����ȵȡ�\n\n���롰���������������С���ʾ�������������а�\n\n���롰help���򡰰�������ʾ����ָ���ȫ��";}  
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
						        if($keyword=="n" || $keyword=="N" || $keyword=="����" || $keyword=="��������" || $keyword=="������" || $keyword=="������" || $EventKey == "newjobs")                  
						        { 		
								$zhiling="1=1";
						        $limit="LIMIT 0,8";
                                $style="1";
								$table="se2mh";			 
                                }
							    else if($keyword=="g" || $keyword=="G" || $keyword=="����" || $keyword=="����" || $keyword=="����" || $EventKey == "emergencyjobs")
						        {
					 	        $zhiling="fenlei=1";
                                $style="2";
						        $limit="LIMIT 0,8";
								$table="se2mh";
						        }else if($keyword=="r" || $keyword=="R" || $keyword=="�ձ�" || $keyword=="�ձ�����"  || $keyword=="����" || $EventKey == "recommendjobs"){
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
									 $word="û���ҵ������ؼ��ֵ����������������ؼ��֣����硰а�񡱡���Ů�����ظ�g�����ع����������ظ�r�����ձ�������";
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
								   $addtime=date("Y��m��d��",$addtime);
								   $url=ROOT."/touch/position/posInfo.php?m.posId=".$row['id']."&m.isBidding=0";
                                   $word=$word."\n<a href=\"".$url."\">".$name."</a>\n".$addtime."\n";
								   	         $strmiddle.="<item>
											 <Title><![CDATA[".$name."]]></Title> 
											 <Description><![CDATA[".$con."]]></Description>
											 <PicUrl><![CDATA[".$pic."]]></PicUrl>	
											 <Url><![CDATA[".$url."]]></Url>
											 </item>";	
                                   }
                                    $date=date("Y��m��d��",$time);
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