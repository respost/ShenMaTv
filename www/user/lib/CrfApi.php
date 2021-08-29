<?php
define('CHARSET', 'utf-8');

class CrfApi {

    private static $config;

    public function __construct() {
        self::$config = array(
            '_service' => 'https://v1.api.023tx.cn/?', //֧��API��ַ
            'partner' => '1326895915',
            'key' => 'UAMA75INB12JL3Y8KFWU2A3MVPYSR4LL',
            'cacert_url' => dirname(__FILE__) . '/cert/crfpay.pem',
        ); //֧������
    }

    /**
     * ֧�������ӿ�
     * @return type
     */
    public static function getPayModList() {
        $data = array(
            'service' => 'Pay.Paylist',
        );
        $request_data = self::buildRequestPara($data);
        return self::curl_init_post($request_data);
    }

    /**
     * ֧����֤
     * @param type $post
     * @return type
     */
    public static function getPayVerify($post) {

        $data = array(
            'service' => 'Pay.Payverify',
            'trade_no' => $post['trade_no']
        );

        $request_data = self::buildRequestPara($data);

        return self::curl_init_post($request_data);
    }

    /**
     * ��������
     * @param array $data
     * @return type
     */
    public static function buildRequestPara($data) {
        $data['partner'] = self::$config['partner'];
        $data['sign'] = self::Md5Hash($data, self::$config['key']);
        return $data;
    }

    /**
     * Զ������
     * @param type $array
     * @return type
     */
    public static function curl_init_post($postdata) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$config['_service']);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); //SSL֤����֤
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //�ϸ���֤
        curl_setopt($ch, CURLOPT_CAINFO, self::$config['cacert_url']); //֤���ַ

        curl_setopt($ch, CURLOPT_HEADER, false); // ����HTTPͷ
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); //���ó�ʱ
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); //����curlʹ�õ�HTTPЭ��
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // ��ʾ������
        curl_setopt($ch, CURLOPT_POST, true); // post��������
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        $data = curl_exec($ch);
        $getinfo = curl_getinfo($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if (empty($data)) {
            return CrfApiTloos::ToIconv('���ʵ�ַ:') . $getinfo['url'] . 'http_code:' . $getinfo['http_code'] . CrfApiTloos::ToIconv('Curl������:') . $errno . CrfApiTloos::ToIconv('Curl��������:') . $error;
        }
        return json_decode($data);
    }

    /**
     * ֧������
     * @return string
     */
    public static function HpayBuildForm($array) {

        $postdata = self::buildRequestPara($array);

        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='" . self::$config['_service'] . "' method='post'>";
        while (list ($key, $val) = each($postdata)) {
            $sHtml = $sHtml . "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }

        //submit��ť�ؼ��벻Ҫ����name����
        $sHtml = $sHtml . "Loading......</form>";

        $sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script>";

        return $sHtml;
    }

    /**
     * ����ǩ��
     * @param type $partner
     * @param type $key
     * @return type
     */
    private static function Md5Hash($data, $key) {
        ksort($data);
        $prestr = CrfApiTloos::createLinkstring($data) . $key;
        return md5($prestr);
    }

    /**
     * �ⲿ��ȡǩ��
     * @return type
     */
    public static function SignVerify($post) {
        unset($post['sign']);
        return self::Md5Hash($post, self::$config['key']);
    }

}

class CrfApiTloos {

    /**
     * �ַ���ת��
     * @param type $original
     * @return type
     */
    public static function ToIconv($original) {
        if (function_exists('mb_detect_encoding')) {
            $encoding = mb_detect_encoding($original, array("ASCII", "UTF8", "GBK", "GB2312", "BIG5")); //�Զ�ʶ��
            if ($encoding == CHARSET) {
                return $original;
            }
            return iconv($encoding, CHARSET, $original);
        } else {
            return $original;
        }
    }

    /**
     * д��־��������ԣ�����վ����Ҳ���ԸĳɰѼ�¼�������ݿ⣩
     * ע�⣺��������Ҫ��ͨfopen����
     * @param $word Ҫд����־����ı����� Ĭ��ֵ����ֵ
     */
    public static function logResult($word = '') {
        $fp = fopen(getcwd() . "\\log.txt", "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "TIME��" . @strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * ����������Ԫ�أ����ա�����=����ֵ����ģʽ�á�&���ַ�ƴ�ӳ��ַ���
     * @param $para ��Ҫƴ�ӵ�����
     * return ƴ������Ժ���ַ���
     */
    public static function createLinkstring($para) {
        $arg = "";
        while (list ($key, $val) = each($para)) {
            $arg .= $key . "=" . $val . "&";
        }
        //ȥ�����һ��&�ַ�
        $arg = substr($arg, 0, count($arg) - 2);
        //�������ת���ַ�����ôȥ��ת��
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        return $arg;
    }

}
?>