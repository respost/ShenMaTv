<?php
error_reporting(0); 
include("../include/os.php");
include("../config/common.php");
include("../config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$userid=$_COOKIE[uid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$uid=$user['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>��Ա����-���Ѽ�¼</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<SCRIPT language=javascript src="/app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="/app/layer/layer.js"></SCRIPT>
<?php include_once('../include/css.php'); ?> 
<style>
.open_vip{
background-color: lightcyan;;
}
.ui-border li i em{
font-size: 0.75rem;
}
.aboutpic li{
margin-top: 0.6rem
}
.aboutpic li i img{
width: 2.5rem;
height: 2.5rem;
}
</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">���Ѽ�¼</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('../include/column.php'); ?>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="/vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="��������Ƶ�ؼ���" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>����
</button>
</div>
</form>
</div>
<?php include_once('../include/nav_s.php'); ?>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1><?php if($user[ms]=="�ƽ��Ա"){?>�ƽ��Ա<?php }elseif($user[ms]=="���û�Ա"){?>��ʯ��Ա<?php }?></h1>
</header>
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_pay_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����¼</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_consume.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">���Ѽ�¼</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<?php 
$order = 'order by money desc ';
$sql = "WHERE uid=".$uid;
$Page_size=10; 
$result=mysql_query("SELECT * FROM  uboxfjl ".$sql.""); 
$count = mysql_num_rows($result); 
$total=mysql_query("SELECT SUM(money) AS num FROM uboxfjl  ".$sql."");
$row=mysql_fetch_array($total);
$money_count=$row[0];

$page_count = ceil($count/$Page_size); 
$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 
if(empty($_GET['page'])||$_GET['page']<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 
$offset=$Page_size*($page-1); 
?>
<section class="jilu" style="margin-top: 2.2%;"> 
<table width="100%" border="0" >
<tr class="pn">
  <td height="40" colspan="3" style="font-size:14px;">�ܹ�������<?php echo $count;?>�Σ���������<?php if ($money_count) {echo $money_count;}else{echo "0";}?>Ԫ</td>
  </tr>
  <tr class="xf">
  <td height="35" align="center" ><strong>��Դ���</strong></td>
  <td align="center" ><strong>�۸�</strong></td>
  <td align="center" style="padding-right:5px;"><strong>����ʱ��</strong></td>
</tr>
<?php 
$query = mysql_query("select * from  uboxfjl ".$sql." ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) { 
$sctime=date('m-d H:i',$a[addtime]);
$avatar=$a[avatar];
$name=$a[name];
if (empty($name))
{$name=$a[user];}
$money=$a[money];
$uid=$a[uid];
$zyid=$a[zyid];
$url=$a[url];
$ttype=$a[type];
?> 
<tr class="xf">
  <td height="35" align="center" ><a href="/<?php echo $url;?>" target="_blank"><?php if ($ttype==1){echo "SP";}elseif ($ttype==2){echo "TV";}elseif ($ttype==3){echo "DM";}elseif ($ttype==4){echo "DY";}elseif ($ttype==5){echo "MT";}elseif ($ttype==6){echo "ZY";}elseif ($ttype==7){echo "MV";}?><?php echo $zyid;?></a></td>
  <td align="center" ><?php echo $money;?>Ԫ</td>
  <td align="center" ><span style="color:#999;"><?php echo $sctime;?></span></td>
</tr>
<?php 
$i++;  
};
$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ����� 
$pageoffset = ($page_len-1)/2;//ҳ���������ƫ���� 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">��ҳ</a> "; //��ҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">< ��һҳ</a>"; //��һҳ 
}else { 
$key.="<a>��ҳ</a> "; //��ҳ 
$key.="<a >< ��һҳ</a>"; //��һҳ  
} 
if($pages>$page_len){ 
//�����ǰҳС�ڵ�����ƫ�� 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{//�����ǰҳ������ƫ�� 
//�����ǰҳ����ƫ�Ƴ�������ҳ�� 
if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
//����ƫ�ƶ�����ʱ�ļ��� 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
if($page!=$pages){ 

$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">��һҳ ></a> ";//��һҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">ĩҳ</a>"; //���һҳ 
}else { 
$key.=" <a >��һҳ ></a> ";//��һҳ 
$key.="<a>ĩҳ</a>"; //���һҳ 
} 
$key=str_replace("HTTP_REFERER","",$key); 
?>
</table>
</section>
<div class="page" align="center"> 
<?php echo $key?>
</div>

<?php include_once('../include/foot.php'); ?> 
<?php include_once('user_bottom.php'); ?> 
</body>
</html>
<?php }?> 
