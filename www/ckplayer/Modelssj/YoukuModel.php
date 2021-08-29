<?php
function getvideo($id, $pid = 3) {
    $ysid = $id;
    $hz = '_youku';
     $html = get_curl_contents('http://play.youku.com/play/get.json?vid='.$id.'&ct=12'); 
    $json = json_decode($html);
    switch ($pid) {
        case '1':
            $qvars = __BQ__ . '_' . $ysid . $hz . '|' . __GQ__ . '_' . $ysid . $hz . '|' . __CQ__ . '_' . $ysid . $hz;
            $qxd = '标清|高清|超清';
            $qxurl = 'bq_' . $ysid . '_youku';
            break;

        case '2':
            $qvars = __GQ__ . '_' . $ysid . $hz . '|' . __BQ__ . '_' . $ysid . $hz . '|' . __CQ__ . '_' . $ysid . $hz;
            $qxd = '高清|标清|超清';
            $qxurl = 'gq_' . $ysid . '_youku';
            break;

        case '3':
            $qvars = __CQ__ . '_' . $ysid . $hz . '|' . __BQ__ . '_' . $ysid . $hz . '|' . __GQ__ . '_' . $ysid . $hz;
            $qxd = '超清|标清|高清';
            $qxurl = 'cq_' . $ysid . '_youku';
            break;
    }
    $data = $json->data;
    $fileids = $data->stream[0]->stream_fileid;
    $segs = $data->stream[0]->segs;

    $fileid_1 = substr($fileids, 0, 8);
    $fileid_2 = substr($fileids, 10);
    list($sid, $token) = explode('_', yk_e('becaf9be', yk_na($data->security->encrypt_string)));
    foreach ($segs as $k => $v) {
        $hex = strtoupper(dechex($k)) . '';        if (strlen($hex) < 2) $hex = '0' . $hex;        $fileid = $fileid_1 . $hex . $fileid_2;
        $key = $v->key;
        if (!$key || $key == '' || $key == '-1') $key = $segs[$k]->key;
        $ep = urlencode(iconv("gbk", "UTF-8", yk_d(yk_e('bf7e5f01', $sid . '_' . $fileid . '_' . $token))));
        $tvaddr = "http://k.youku.com/player/getFlvPath/sid/" . $sid . '_00/st/mp4/fileid/' . $fileid . '?K=' . $key . '&hd=1&myp=0&ts=';        
        $tvaddr.= $v->total_milliseconds_video . '&ypp=0&ctype=12&ev=1&token=' . $token . '&oip=' . $data->security->ip . '&ep=' . $ep;
        $urllist['urls'][$k]['url'] = $tvaddr;
    }

        $urllist['vars'] = "{h->3}{a->$qxurl}{defa->$qvars}{deft->$qxd}{f->".__HOSTURL__."?url=[\$pat]}"; 
    return $urllist;
}
function yk_file_id($fileId, $seed) {
    $mixed = yk_Mix_String($seed);
    $ids = explode('*', $fileId);
    unset($ids[count($ids) - 1]);
    $realId = '';
    for ($i = 0; $i < count($ids); $i++) {
        $idx = $ids[$i];
        $realId.= substr($mixed, $idx, 1);
    }
    return $realId;
}
function yk_Mix_String($seed) {
    $string = strtolower("abcdefghijklmnopqrstuvwxyz") . strtoupper("abcdefghijklmnopqrstuvwxyz") . '/\\:._-1234567890';
    $count = strlen($string);
    for ($i = 0; $i < $count; $i++) {
        $seed = ($seed * 211 + 30031) % 65536;
        $index = ($seed / 65536 * strlen($string));
        $item = substr($string, $index, 1);
        $mixed.= $item;
        $string = str_replace($item, '', $string);
    }
    return $mixed;
    unset($mixed);
}
function yk_na($a) {
    if (!$a) return "";
    $h = explode(',', "-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,62,-1,-1,-1,63,52,53,54,55,56,57,58,59,60,61,-1,-1,-1,-1,-1,-1,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,-1,-1,-1,-1,-1,-1,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,-1,-1,-1,-1,-1");
    $i = strlen($a);
    $f = 0;
    for ($e = ""; $f < $i;) {
        do $c = $h[charCodeAt($a, $f++) & 255];
        while ($f < $i && - 1 == $c);
        if (-1 == $c) break;

        do $b = $h[charCodeAt($a, $f++) & 255];
        while ($f < $i && - 1 == $b);
        if (-1 == $b) break;

        $e.= fromCharCode($c << 2 | ($b & 48) >> 4);
        do {
            $c = charCodeAt($a, $f++) & 255;
            if (61 == $c) return $e;
            $c = $h[$c];
        }
        while ($f < $i && - 1 == $c);
        if (-1 == $c) break;

        $e.= fromCharCode(($b & 15) << 4 | ($c & 60) >> 2);
        do {
            $b = charCodeAt($a, $f++) & 255;
            if (61 == $b) return $e;
            $b = $h[$b];
        }
        while ($f < i && - 1 == $b);
        if (-1 == $b) break;

        $e.= fromCharCode(($c & 3) << 6 | $b);
    }
    return $e;
} function yk_d($a) {
    if (!$a) return '';
    $f = strlen($a);
    $b = 0;
    $str = strtoupper("abcdefghijklmnopqrstuvwxyz") . strtolower("abcdefghijklmnopqrstuvwxyz") . '0123456789+/';
    for ($c = ''; $b < $f;) {
        $e = charCodeAt($a, $b++) & 255;
        if ($b == $f) {
            $c.= charAt($str, ($e >> 2));
            $c.= charAt($str, (($e & 3) << 4));
            $c.= "==";
            break;
        }
        $g = charCodeAt($a, $b++);
        if ($b == f) {
            $c.= charAt($str, ($e >> 2));
            $c.= charAt($str, (($e & 3) << 4 | ($g & 240) >> 4));
            $c.= charAt($str, (($g & 15) << 2));
            $c.= "=";
            break;
        }
        $h = charCodeAt($a, $b++);
        $c.= charAt($str, ($e >> 2));
        $c.= charAt($str, (($e & 3) << 4 | ($g & 240) >> 4));
        $c.= charAt($str, (($g & 15) << 2 | ($h & 192) >> 6));
        $c.= charAt($str, ($h & 63));
    }
    return $c;
}
function yk_e($a, $c) {
    for ($f = 0, $i, $e = '', $h = 0; 256 > $h; $h++) $b[$h] = $h;
    for ($h = 0; 256 > $h; $h++) {
        $f = ($f + $b[$h] + charCodeAt($a, $h % strlen($a))) % 256;
        $i = $b[$h];
        $b[$h] = $b[$f];
        $b[$f] = $i;
    }
    for ($q = $f = $h = 0; $q < strlen($c); $q++) {
        $h = ($h + 1) % 256;
        $f = ($f + $b[$h]) % 256;
        $i = $b[$h];
        $b[$h] = $b[$f];
        $b[$f] = $i;
        $e.= fromCharCode(charCodeAt($c, $q) ^ $b[($b[$h] + $b[$f]) % 256]);
    }
    return $e;
}
function fromCharCode($codes) {
    if (is_scalar($codes)) $codes = func_get_args();
    $str = '';
    foreach ($codes as $code) $str.= chr($code);
    return $str;
}
function charCodeAt($str, $index) {
    static $charCode = array();
    $key = md5($str);
    $index = $index + 1;
    if (isset($charCode[$key])) {
        return $charCode[$key][$index];
    }
    $charCode[$key] = unpack("C*", $str);
    return $charCode[$key][$index];
}
function charAt($str, $index = 0) {
    return substr($str, $index, 1);
}

?>