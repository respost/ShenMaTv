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
$id=$_GET['id'];
if($id== null){ 
echo "<script>alert('��Ǹ������ʵ���Դ�Ѿ�ɾ��')</script><script>location.href='index.php'</script>";
exit;
} 
$type="where id='$id'";
$neirong=queryall(ubopacket,$type);
$number=$neirong[number];
$zje=$neirong[money];
$surplus=$neirong[surplus];
$row=getone("select * from ubohbjl WHERE bhid='".$id."' order by money desc");
$max_uid=$row['uid'];
$max=$row['money'];
?>
<!DOCTYPE html>
<html>
<head>
<title>��Ա����-�����</title>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">�����</i>
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
<h1></h1>
</header>
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_packet_send.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_packet.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_packet_list.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">�����¼</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<?php 
$order = 'order by money desc ';
$sql = "WHERE bhid=".$id;
$Page_size=10; 
$result=mysql_query("SELECT * FROM  ubohbjl ".$sql.""); 
$count = mysql_num_rows($result); 
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
  <td height="40" colspan="2" style="font-size:14px;"><?php echo $number;?>�������<?php echo $zje;?>Ԫ��<?php if ($surplus>0){?>��δ<?php }else{?>�Ѿ�<?php }?>������</td>
  </tr>
<?php 
$query = mysql_query("select * from  ubohbjl ".$sql." ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) { 
$sctime=date('m-d H:i',$a[addtime]);
$avatar=$a[avatar];
$name=$a[name];
if (empty($name))
{$name=$a[user];}
$money=$a[money];
$uid=$a[uid];
?> 
<tr class="pn">
  <td width="20%" align="center"><div class="avatar"><img src="/img/pl/<?php echo $avatar;?>.jpg"></div></td>
  <td height="35" align="center" style="padding-right:5px;"><div class="left"><span><?php echo $name;?></span><span style="color:#999;"><?php echo $sctime;?></span></div><div class="right"><span><?php echo $money;?>Ԫ</span><span><?php if ($max_uid==$uid){?><i></i><font color="#EC8D00">�������</font><?php }?></span></div></td>
  </tr>
<?php 
$i++;  
};
$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ����� 
$pageoffset = ($page_len-1)/2;//ҳ���������ƫ���� 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?id=".$id."&page=1\">��ҳ</a> "; //��ҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?id=".$id."&page=".($page-1)."\">< ��һҳ</a>"; //��һҳ 
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

$key.=" <a href=\"".$_SERVER['PHP_SELF']."?id=".$id."&page=".($page+1)."\">��һҳ ></a> ";//��һҳ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?id=".$id."&page={$pages}\">ĩҳ</a>"; //���һҳ 
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
