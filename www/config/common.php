<?php
//ͳһ���ñ���
header("content-type:text/html;charset=gb2312");
//���ؿ���(1Ϊ������0�ر�)
$webscan_switch=1;
//�ύ��ʽ����(1��������,0�ر�����,post,get,cookie,referreѡ����Ҫ���صķ�ʽ)
$webscan_post=1;
$webscan_get=1;
$webscan_cookie=1;
$webscan_referre=1;

//get���ع���
$getfilter = "<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\\(\d+?|sleep\s*?\\([\d\.]+?\\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
//post���ع���
$postfilter = "<.*=(&#\\d+?;?)+?>|<.*data=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\\(\d+?|sleep\s*?\\([\d\.]+?\\)|load_file\s*?\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
//cookie���ع���
$cookiefilter = "benchmark\s*?\\(\d+?|sleep\s*?\\([\d\.]+?\\)|load_file\s*?\\(|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

//referer��ȡ
$webscan_referer = empty($_SERVER['HTTP_REFERER']) ? array() : array('HTTP_REFERER'=>$_SERVER['HTTP_REFERER']);
/**
* php��ʾָ�����ȵ��ַ���������������ʡ�Ժ�(...)�β����ʾ
* @ str �ַ���
* @ len ָ������
**/
function cutSubstr($str,$len=30){
 if (strlen($str)>$len) {
	$str=substr($str,0,$len) . '...';
 }
 return $str;
}
/**
* php�Զ�ʶ���ַ������벢ת��ΪĿ����루UTF-8���ķ���
* @ data     ��Ҫת�����ַ���
* @ encoding Ŀ�����
**/
function autoChangeCode($data,$encoding = 'utf-8'){
  if( !empty($data) ){    
    $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;   
    if( $fileType != $encoding){   
      $data = mb_convert_encoding($data ,$encoding , $fileType);   
    }   
  }   
  return $data;    
}
/**
*  �������
*/
function webscan_arr_foreach($arr) {
  static $str;
  if (!is_array($arr)) {
    return $arr;
  }
  foreach ($arr as $key => $val ) {
    if (is_array($val)) {
      webscan_arr_foreach($val);
    } else {
      $str[] = $val;
    }
  }
  return implode($str);
}

/**
*  ������ʾҳ
*/
function webscan_pape(){
$pape="<!---�������ݴ���Σ���ַ�����Ĳ���������--->";
$pape.="<h1>��ӭ���٣��������飡</h1>";
echo $pape;
exit();
}

/**
*  �����������
*/
function webscan_StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq,$method) {
  $StrFiltValue=webscan_arr_foreach($StrFiltValue);
  if (preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){
    webscan_pape();
  }
  if (preg_match("/".$ArrFiltReq."/is",$StrFiltKey)==1){
   webscan_pape();
  }
}

  if ($webscan_get) {
    foreach($_GET as $key=>$value) {
      webscan_StopAttack($key,$value,$getfilter,"GET");
    }
  }
  if ($webscan_post) {
    foreach($_POST as $key=>$value) {
      webscan_StopAttack($key,$value,$postfilter,"POST");
    }
  }
  if ($webscan_cookie) {
    foreach($_COOKIE as $key=>$value) {
      webscan_StopAttack($key,$value,$cookiefilter,"COOKIE");
    }
  }
  if ($webscan_referre) {
    foreach($webscan_referer as $key=>$value) {
      webscan_StopAttack($key,$value,$postfilter,"REFERRER");
    }
  }

function dbinsert($table, $type)
{
    $dbin = mysql_query("INSERT INTO `{$table}` {$type}");
    return $dbin;
}
function dbquery($table, $type)
{
    $dbq = mysql_query("SELECT * FROM `{$table}` {$type}");
    while ($rdb = mysql_fetch_array($dbq)) {
        $rdbq[] = $rdb;
    }
    return $rdbq;
}
function dbquerysun($table, $type)
{
    $dbqsun = mysql_query("SELECT count(id) FROM `{$table}` {$type}");
    $rdbsun = mysql_fetch_array($dbqsun);
    return $rdbsun;
}
function dbdel($table, $type)
{
    $dbdel = mysql_query("delete FROM `{$table}` where {$type}");
    return $rdel;
}
function queryall($table, $type)
{
    $sql = mysql_query("SELECT * FROM `{$table}` {$type}");
    $row = mysql_fetch_array($sql);
    return $row;
}
function upalldt($table, $type)
{
    $dbup = mysql_query("UPDATE `{$table}` SET {$type}");
    return $dbup;
}
//���Ƶ�������
function cutstr($str, $cutleng)
{
    $str = $str;
    $cutleng = $cutleng;
    $strleng = strlen($str);
    if ($cutleng > $strleng) {
        return $str;
    }
    $notchinanum = 0;
    for ($i = 0; $i < $cutleng; $i++) {
        if (ord(substr($str, $i, 1)) <= 128) {
            $notchinanum++;
        }
    }
    if ($cutleng % 2 == 1 && $notchinanum % 2 == 0) {
        $cutleng++;
    }
    if ($cutleng % 2 == 0 && $notchinanum % 2 == 1) {
        $cutleng++;
    }
    return substr($str, 0, $cutleng);
}
//��ȡʹ��
function GetBetween($content, $start, $end)
{
    $r = explode($start, $content);
    if (isset($r[1])) {
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}
//ip��ȡ
function getIP()
{
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $realip = $_SERVER['REMOTE_ADDR'];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } elseif (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}
//�����ļ�
function writefile($fname, $str)
{
    $fp = fopen($fname, "w");
    fputs($fp, $str);
    fclose($fp);
}
function inject_check($sql_str)
{
    $check = eregi('select|insert|update|delete|script|iframe|\'|\\/\\*|\\*|\\.\\.\\/|\\.\\/|union|into|load_file|outfile', $sql_str);
    // ���й���
    if ($check) {
        echo "����Ƿ�ע�����ݣ�";
        die;
    } else {
        return $sql_str;
    }
}
function msglayer($str, $num)
{
    $dbin = "<script>parent.layer.msg('{$str}',{shade: 0.3,shift:{$num}});</script>";
    return $dbin;
}
function msglayerurl($str, $num, $url)
{
    $dbin = "<script>parent.layer.msg('{$str}',{shade: 0.3,shift:{$num}});setTimeout(function(){top.location.href='{$url}'},3000);</script>";
    return $dbin;
}
function getall($sql) {
    $query=mysql_query($sql);
    if($query) {
        $temp=array();
        while($res=mysql_fetch_assoc($query)) {
            $temp[]=$res;
        }
        return $temp;
    }
    else{
    return false;
    }
}

function getone($sql) {
    $query=mysql_query($sql);
    if($query) {
        $res=mysql_fetch_assoc($query);
        return $res;
    }
    else{
        return false;
    }
}
?>