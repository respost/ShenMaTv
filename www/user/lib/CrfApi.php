<?php
define('CHARSET', 'utf-8');

class CrfApi {

    private static $config;

    public function __construct() {
        self::$config = array(
            '_service' => 'https://v1.api.023tx.cn/?', //支付API地址
            'partner' => '1326895915',
            'key' => 'UAMA75INB12JL3Y8KFWU2A3MVPYSR4LL',
            'cacert_url' => dirname(__FILE__) . '/cert/crfpay.pem',
        ); //支付配置
    }

    /**
     * 支付能力接口
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
     * 支付验证
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
     * 构造数据
     * @param array $data
     * @return type
     */
    public static function buildRequestPara($data) {
        $data['partner'] = self::$config['partner'];
        $data['sign'] = self::Md5Hash($data, self::$config['key']);
        return $data;
    }

    /**
     * 远程请求
     * @param type $array
     * @return type
     */
    public static function curl_init_post($postdata) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::$config['_service']);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); //SSL证书认证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); //严格认证
        curl_setopt($ch, CURLOPT_CAINFO, self::$config['cacert_url']); //证书地址

        curl_setopt($ch, CURLOPT_HEADER, false); // 过滤HTTP头
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); //设置超时
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0); //设置curl使用的HTTP协议
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 显示输出结果
        curl_setopt($ch, CURLOPT_POST, true); // post传输数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postdata));
        $data = curl_exec($ch);
        $getinfo = curl_getinfo($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if (empty($data)) {
            return CrfApiTloos::ToIconv('访问地址:') . $getinfo['url'] . 'http_code:' . $getinfo['http_code'] . CrfApiTloos::ToIconv('Curl错误码:') . $errno . CrfApiTloos::ToIconv('Curl错误描述:') . $error;
        }
        return json_decode($data);
    }

    /**
     * 支付请求
     * @return string
     */
    public static function HpayBuildForm($array) {

        $postdata = self::buildRequestPara($array);

        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='" . self::$config['_service'] . "' method='post'>";
        while (list ($key, $val) = each($postdata)) {
            $sHtml = $sHtml . "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "Loading......</form>";

        $sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script>";

        return $sHtml;
    }

    /**
     * 生成签名
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
     * 外部获取签名
     * @return type
     */
    public static function SignVerify($post) {
        unset($post['sign']);
        return self::Md5Hash($post, self::$config['key']);
    }

}

class CrfApiTloos {

    /**
     * 字符串转换
     * @param type $original
     * @return type
     */
    public static function ToIconv($original) {
        if (function_exists('mb_detect_encoding')) {
            $encoding = mb_detect_encoding($original, array("ASCII", "UTF8", "GBK", "GB2312", "BIG5")); //自动识别
            if ($encoding == CHARSET) {
                return $original;
            }
            return iconv($encoding, CHARSET, $original);
        } else {
            return $original;
        }
    }

    /**
     * 写日志，方便测试（看网站需求，也可以改成把记录存入数据库）
     * 注意：服务器需要开通fopen配置
     * @param $word 要写入日志里的文本内容 默认值：空值
     */
    public static function logResult($word = '') {
        $fp = fopen(getcwd() . "\\log.txt", "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "TIME：" . @strftime("%Y%m%d%H%M%S", time()) . "\n" . $word . "\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    public static function createLinkstring($para) {
        $arg = "";
        while (list ($key, $val) = each($para)) {
            $arg .= $key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);
        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        return $arg;
    }

}
?>