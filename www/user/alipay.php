<?php
//����֧������
function get_code($order, $payment)
{
	global $_CFG;
	if (!is_array($order) ||!is_array($payment))  return false;
$partner		= trim($payment['partnerid']);
$key			= trim($payment['ytauthkey']);
$seller_email	= trim($payment['parameter1']);
$notify_url		= "";
$return_url		= $order['v_url'];
$show_url		= $_CFG['site_domain'].$_CFG['site_dir'];
$mainname		= $_CFG['site_name'];
$sign_type		= "MD5";
$_input_charset	= "GBK";
$transport		= "http";

$out_trade_no = $order['oid'];		//�������վ����ϵͳ�е�Ψһ������ƥ��
$subject        =  "�����ţ�" . $out_trade_no;	
$body           = $order['remark1'];
$price          = intval($order['v_amount']);
$quantity		= "1";
/* �������� */
$logistics_fee		= "0.00";				//�������ã����˷ѡ�
$logistics_type		= "EXPRESS";			//�������ͣ�����ֵ��ѡ��EXPRESS����ݣ���POST��ƽ�ʣ���EMS��EMS��
$logistics_payment	= "SELLER_PAY";			//����֧����ʽ������ֵ��ѡ��SELLER_PAY�����ҳе��˷ѣ���BUYER_PAY����ҳе��˷ѣ�

$receive_name		= "�ջ�������";			//�ջ����������磺����
$receive_address	= "�ջ��˵�ַ";			//�ջ��˵�ַ���磺XXʡXXX��XXX��XXX·XXXС��XXX��XXX��ԪXXX��
$receive_zip		= "402560";				//�ջ����ʱ࣬�磺123456
$receive_phone		= "0571-81234567";		//�ջ��˵绰���룬�磺0571-81234567
$receive_mobile		= "13312341234";		//�ջ����ֻ����룬�磺13312341234



//��չ���ܲ�������Ĭ��֧����ʽ
$pay_mode	  = $_POST['pay_bank'];
if ($pay_mode == "directPay") {
	$paymethod    = "directPay";
	$defaultbank  = "";
}
else {
	$paymethod    = "bankPay";
	$defaultbank  = $pay_mode;
}
$anti_phishing_key  = '';			//������ʱ���
$exter_invoke_ip = '';				//��ȡ�ͻ��˵�IP��ַ�����飺��д��ȡ�ͻ���IP��ַ�ĳ���
$extra_common_param = '';			//�Զ���������ɴ���κ����ݣ���=��&�������ַ��⣩��������ʾ��ҳ����
$buyer_email		= '';			//Ĭ�����֧�����˺�
$royalty_type		= "";			//������ͣ���ֵΪ�̶�ֵ��10������Ҫ�޸�
$royalty_parameters	= "";
$parameter = array(
        "service"			=> "trade_create_by_buyer",	//�ӿ����ƣ�����Ҫ�޸�
        "payment_type"		=> "1",               			//�������ͣ�����Ҫ�޸�

        //��ȡ�����ļ�(alipay_config.php)�е�ֵ
        "partner"			=> $partner,
        "seller_email"		=> $seller_email,
        "return_url"		=> $return_url,
        "notify_url"		=> $notify_url,
        "_input_charset"	=> $_input_charset,
        "show_url"			=> $show_url,

        //�Ӷ��������ж�̬��ȡ���ı������
        "out_trade_no"		=> $out_trade_no,
        "subject"			=> $subject,
        "body"				=> $body,
        "price"			    => $price,
		"quantity"		=> $quantity,
        //��������
		"logistics_fee"		=> $logistics_fee,
		"logistics_type"	=> $logistics_type,
		"logistics_payment"	=> $logistics_payment,
		//�ջ���Ϣ
		"receive_name"		=> $receive_name,
		"receive_address"	=> $receive_address,
		"receive_zip"		=> $receive_zip,
		"receive_phone"		=> $receive_phone,
		"receive_mobile"	=> $receive_mobile,
        //��չ���ܲ�������������ǰ
        "paymethod"			=> $paymethod,
        "defaultbank"		=> $defaultbank,

        //��չ���ܲ�������������
        "anti_phishing_key"	=> $anti_phishing_key,
		"exter_invoke_ip"	=> $exter_invoke_ip,

		//��չ���ܲ��������Զ������
		"buyer_email"		=> $buyer_email,
        "extra_common_param"=> $extra_common_param,
		
		//��չ���ܲ�����������
        "royalty_type"		=> $royalty_type,
        "royalty_parameters"=> $royalty_parameters
);
$alipay = new alipay_service($parameter,$key,$sign_type);
$sHtmlText = $alipay->build_form();
$sHtmlText.="<input type=\"image\" src='".$_CFG['site_template']."images/25.gif'  onclick=\"document.forms['alipaysubmit'].submit()\"/>";
return $sHtmlText;
}
/**
 * ��Ӧ����
*/
function respond()
{
	$payment= get_payment_info('alipay');	
	$partner		= trim($payment['partnerid']);
	$key			= trim($payment['ytauthkey']);
	$sign_type		= "MD5";
	$_input_charset	= "GBK";
	$transport		= "http";
	$alipay = new alipay_notify($partner,$key,$sign_type,$_input_charset,$transport);
	$verify_result = $alipay->return_verify();
	if($verify_result) {//��֤�ɹ�
		$dingdan           = $_GET['out_trade_no'];		//��ȡ������
		$total_fee         = $_GET['total_fee'];		//��ȡ�ܼ۸�
		return order_paid($dingdan);
	}
	else {
	   return false;
	}	
}
function pay_info()
{
$arr['p_introduction']="֧�������������";
$arr['notes']="֧������ϸ������";
$arr['partnerid']="���������(Partner ID)��";
$arr['ytauthkey']="��ȫУ����(Key)��";
$arr['fee']="֧�������������ѣ�";
$arr['parameter1']="֧�����ʺţ�";
return $arr;
}
//----------------------------------------------------
//֧�����Դ�class
class alipay_service {

    var $gateway;			//���ص�ַ
    var $_key;				//��ȫУ����
    var $mysign;			//ǩ�����
    var $sign_type;			//ǩ������
    var $parameter;			//��Ҫǩ���Ĳ�������
    var $_input_charset;    //�ַ������ʽ

    /**���캯��
	*�������ļ�������ļ��г�ʼ������
	*$parameter ��Ҫǩ���Ĳ�������
	*$key ��ȫУ����
	*$sign_type ǩ������
    */
    function alipay_service($parameter,$key,$sign_type) {
        $this->gateway		= "https://www.alipay.com/cooperate/gateway.do?";
        $this->_key  		= $key;
        $this->sign_type	= $sign_type;
        $this->parameter	= para_filter($parameter);
		
        //�趨_input_charset��ֵ,Ϊ��ֵ�������Ĭ��ΪGBK
        if($parameter['_input_charset'] == '')
            $this->parameter['_input_charset'] = 'GBK';

        $this->_input_charset   = $this->parameter['_input_charset'];

        //���ǩ�����
        $sort_array   = arg_sort($this->parameter);    //�õ�����ĸa��z������ǩ����������
        $this->mysign = build_mysign($sort_array,$this->_key,$this->sign_type);
    }

    /********************************************************************************/

    /**������ύHTML
	*return ���ύHTML�ı�
     */
    function build_form() {
		//GET��ʽ����
        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$this->gateway."_input_charset=".$this->parameter['_input_charset']."' method='get' target='_blank'>";
		//POST��ʽ���ݣ�GET��POST����ѡһ��
		//$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$this->gateway."_input_charset=".$this->parameter['_input_charset']."' method='post'>";

        while (list ($key, $val) = each ($this->parameter)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

        $sHtml = $sHtml."<input type='hidden' name='sign' value='".$this->mysign."'/>";
        $sHtml = $sHtml."<input type='hidden' name='sign_type' value='".$this->sign_type."'/>";

		//submit��ť�ؼ��벻Ҫ����name����
        $sHtml = $sHtml."</form>";
		
		$sHtml = $sHtml."";
        return $sHtml;
    }
    /********************************************************************************/

}
class alipay_notify {
    var $gateway;           //���ص�ַ
    var $_key;  			//��ȫУ����
    var $partner;           //�������ID
    var $sign_type;         //ǩ����ʽ ϵͳĬ��
    var $mysign;            //ǩ�����
    var $_input_charset;    //�ַ������ʽ
    var $transport;         //����ģʽ

    /**���캯��
	*�������ļ��г�ʼ������
	*$partner ���������ID
	*$key ��ȫУ����
	*$sign_type ǩ������
	*$_input_charset �ַ������ʽ
	*$transport ����ģʽ
     */
    function alipay_notify($partner,$key,$sign_type,$_input_charset = "GBK",$transport= "https") {

        $this->transport = $transport;
        if($this->transport == "https") {
            $this->gateway = "https://www.alipay.com/cooperate/gateway.do?";
        }else {
            $this->gateway = "http://notify.alipay.com/trade/notify_query.do?";
        }
        $this->partner          = $partner;
        $this->_key    			= $key;
        $this->mysign           = "";
        $this->sign_type	    = $sign_type;
        $this->_input_charset   = $_input_charset;
    }

/**��notify_url����֤
*���ص���֤�����true/false
*/
function notify_verify() {
        //��ȡԶ�̷�����ATN�������֤�Ƿ���֧��������������������
        if($this->transport == "https") {
            $veryfy_url = $this->gateway. "service=notify_verify" ."&partner=" .$this->partner. "&notify_id=".$_POST["notify_id"];
        } else {
            $veryfy_url = $this->gateway. "partner=".$this->partner."&notify_id=".$_POST["notify_id"];
        }
        $veryfy_result = $this->get_verify($veryfy_url);

        //����ǩ�����
		if(empty($_POST)) {							//�ж�POST���������Ƿ�Ϊ��
			return false;
		}
		else {
			$post          = para_filter($_POST);	//������POST���صĲ���ȥ��
			$sort_post     = arg_sort($post);	    //������POST������������������
			$this->mysign  = build_mysign($sort_post,$this->_key,$this->sign_type);   //����ǩ�����
	
			//д��־��¼
			log_result("veryfy_result=".$veryfy_result."\n notify_url_log:sign=".$_POST["sign"]."&mysign=".$this->mysign.",".create_linkstring($sort_post));
	
			//�ж�veryfy_result�Ƿ�Ϊture�����ɵ�ǩ�����mysign���õ�ǩ�����sign�Ƿ�һ��
			//$veryfy_result�Ľ������true����������������⡢���������ID��notify_idһ����ʧЧ�й�
			//mysign��sign���ȣ��밲ȫУ���롢����ʱ�Ĳ�����ʽ���磺���Զ�������ȣ��������ʽ�й�
			if (preg_match("/true$/i",$veryfy_result) && $this->mysign == $_POST["sign"]) {
				return true;
			} else {
				return false;
			}
		}
    }

    /********************************************************************************/

    /**��return_url����֤
	*return ��֤�����true/false
     */
    function return_verify() {
        //��ȡԶ�̷�����ATN�������֤�Ƿ���֧��������������������
        if($this->transport == "https") {
            $veryfy_url = $this->gateway. "service=notify_verify" ."&partner=" .$this->partner. "&notify_id=".$_GET["notify_id"];
        } else {
            $veryfy_url = $this->gateway. "partner=".$this->partner."&notify_id=".$_GET["notify_id"];
        }
        $veryfy_result = $this->get_verify($veryfy_url);

        //����ǩ�����
		if(empty($_GET)) {							//�ж�GET���������Ƿ�Ϊ��
			return false;
		}
		else {
			$get          = para_filter($_GET);	    //������GET��������������ȥ��
			$sort_get     = arg_sort($get);		    //������GET������������������
			$this->mysign  = build_mysign($sort_get,$this->_key,$this->sign_type);    //����ǩ�����
	
			//д��־��¼
			//log_result("veryfy_result=".$veryfy_result."\n return_url_log:sign=".$_GET["sign"]."&mysign=".$this->mysign."&".create_linkstring($sort_get));
	
			//�ж�veryfy_result�Ƿ�Ϊture�����ɵ�ǩ�����mysign���õ�ǩ�����sign�Ƿ�һ��
			//$veryfy_result�Ľ������true����������������⡢���������ID��notify_idһ����ʧЧ�й�
			//mysign��sign���ȣ��밲ȫУ���롢����ʱ�Ĳ�����ʽ���磺���Զ�������ȣ��������ʽ�й�
			if (preg_match("/true$/i",$veryfy_result) && $this->mysign == $_GET["sign"]) {            
				return true;
			}else {
				return false;
			}
		}
    }

    /********************************************************************************/

    /**��ȡԶ�̷�����ATN���
	*$url ָ��URL·����ַ
	*return ������ATN�����
     */
    function get_verify($url,$time_out = "60") {
        $urlarr     = parse_url($url);
        $errno      = "";
        $errstr     = "";
        $transports = "";
        if($urlarr["scheme"] == "https") {
            $transports = "ssl://";
            $urlarr["port"] = "443";
        } else {
            $transports = "tcp://";
            $urlarr["port"] = "80";
        }
        $fp=@fsockopen($transports . $urlarr['host'],$urlarr['port'],$errno,$errstr,$time_out);
        if(!$fp) {
            die("ERROR: $errno - $errstr<br />\n");
        } else {
            fputs($fp, "POST ".$urlarr["path"]." HTTP/1.1\r\n");
            fputs($fp, "Host: ".$urlarr["host"]."\r\n");
            fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-length: ".strlen($urlarr["query"])."\r\n");
            fputs($fp, "Connection: close\r\n\r\n");
            fputs($fp, $urlarr["query"] . "\r\n\r\n");
            while(!feof($fp)) {
                $info[]=@fgets($fp, 1024);
            }
            fclose($fp);
            $info = implode(",",$info);
            return $info;
        }
    }

    /********************************************************************************/

}
function build_mysign($sort_array,$key,$sign_type = "MD5") {
    $prestr = create_linkstring($sort_array);     	//����������Ԫ�أ����ա�����=����ֵ����ģʽ�á�&���ַ�ƴ�ӳ��ַ���
    $prestr = $prestr.$key;							//��ƴ�Ӻ���ַ������밲ȫУ����ֱ����������
    $mysgin = sign($prestr,$sign_type);			    //�����յ��ַ���ǩ�������ǩ�����
    return $mysgin;
}	

/********************************************************************************/

/**����������Ԫ�أ����ա�����=����ֵ����ģʽ�á�&���ַ�ƴ�ӳ��ַ���
	*$array ��Ҫƴ�ӵ�����
	*return ƴ������Ժ���ַ���
*/
function create_linkstring($array) {
    $arg  = "";
    while (list ($key, $val) = each ($array)) {
        $arg.=$key."=".$val."&";
    }
    $arg = substr($arg,0,count($arg)-2);		     //ȥ�����һ��&�ַ�
    return $arg;
}

/********************************************************************************/

/**��ȥ�����еĿ�ֵ��ǩ������
	*$parameter ǩ��������
	*return ȥ����ֵ��ǩ�����������ǩ��������
 */
function para_filter($parameter) {
    $para = array();
    while (list ($key, $val) = each ($parameter)) {
        if($key == "sign" || $key == "sign_type" || $val == "")continue;
        else	$para[$key] = $parameter[$key];
    }
    return $para;
}

/********************************************************************************/

/**����������
	*$array ����ǰ������
	*return ����������
 */
function arg_sort($array) {
    ksort($array);
    reset($array);
    return $array;
}

/********************************************************************************/

/**ǩ���ַ���
	*$prestr ��Ҫǩ�����ַ���
	*return ǩ�����
 */
function sign($prestr,$sign_type) {
    $sign='';
    if($sign_type == 'MD5') {
        $sign = md5($prestr);
    }elseif($sign_type =='DSA') {
        //DSA ǩ����������������
        die("DSA ǩ����������������������ʹ��MD5ǩ����ʽ");
    }else {
        die("֧�����ݲ�֧��".$sign_type."���͵�ǩ����ʽ");
    }
    return $sign;
}

/********************************************************************************/

// ��־��Ϣ,��֧�������صĲ�����¼����
// ��ע��������Ƿ�ͨfopen����
function  log_result($word) {
    $fp = fopen("log.txt","a");
    flock($fp, LOCK_EX) ;
    fwrite($fp,"ִ�����ڣ�".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
    flock($fp, LOCK_UN);
    fclose($fp);
}

/********************************************************************************/

/**ʵ�ֶ����ַ����뷽ʽ
	*$input ��Ҫ������ַ���
	*$_output_charset ����ı����ʽ
	*$_input_charset ����ı����ʽ
	*return �������ַ���
 */
function charset_encode($input,$_output_charset ,$_input_charset) {
    $output = "";
    if(!isset($_output_charset) )$_output_charset  = $_input_charset;
    if($_input_charset == $_output_charset || $input ==null ) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
    } elseif(function_exists("iconv")) {
        $output = iconv($_input_charset,$_output_charset,$input);
    } else die("sorry, you have no libs support for charset change.");
    return $output;
}

/********************************************************************************/

/**ʵ�ֶ����ַ����뷽ʽ
	*$input ��Ҫ������ַ���
	*$_output_charset ����Ľ����ʽ
	*$_input_charset ����Ľ����ʽ
	*return �������ַ���
 */
function charset_decode($input,$_input_charset ,$_output_charset) {
    $output = "";
    if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
    if($_input_charset == $_output_charset || $input ==null ) {
        $output = $input;
    } elseif (function_exists("mb_convert_encoding")) {
        $output = mb_convert_encoding($input,$_output_charset,$_input_charset);
    } elseif(function_exists("iconv")) {
        $output = iconv($_input_charset,$_output_charset,$input);
    } else die("sorry, you have no libs support for charset changes.");
    return $output;
}

/*********************************************************************************/

/**���ڷ����㣬���ýӿ�query_timestamp����ȡʱ����Ĵ�����
ע�⣺���ڵͰ汾��PHP���û�����֧��Զ��XML��������˱�������������ص�����װ��֧��DOMDocument��SSL��PHP���û��������鱾�ص���ʱʹ��PHP�������
*$partner ���������ID
*return ʱ����ַ���
*/
function query_timestamp($partner) {
    $URL = "https://mapi.alipay.com/gateway.do?service=query_timestamp&partner=".$partner;
	$encrypt_key = "";
//��Ҫʹ�÷����㣬��ȡ�������4��ע��
//    $doc = new DOMDocument();
//    $doc->load($URL);
//    $itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
//    $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
    return $encrypt_key;
}
?>