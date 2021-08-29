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
$user=getone("select * from ubouser WHERE userid='".$userid."'");
$uid=$user['id'];
if($id)
{
$type="concern=concern-1 where id=".$uid;
upalldt(ubouser,$type);
$type="uid=".$uid." and id=".$id;
dbdel(se2sc,$type);
echo msglayerurl("删除成功！",8,"user_scj.php");
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-视频收藏夹</title>
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">视频收藏</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<?php include_once('../include/column.php'); ?>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="/vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="请输入视频关键字" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>搜索
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
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div> 
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_mtscj.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">美图收藏</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
<a href="user_scj.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">视频收藏</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a>
<a href="user_gz.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">我的关注</h2>
<span class="r login_yj"><i class="fa fa-angle-right fa-lg"></i></span>
</li>
</a> 
</section>
<?php
$order = 'order by id desc ';
$sql = "WHERE zbid=0 and uid=".$uid;
$Page_size=10; 
$result=mysql_query("SELECT * FROM  se2sc ".$sql." "); 
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
<table width="100%" border="0" style="font-size:14px;">
<tr>
  <td align="center" style="line-height:40px;" width="20%"><strong>视频图片</strong></td>
<td height="40" align="left" style="line-height:40px;"width="58%"><strong>详情</strong></td>
<td height="40" align="center" style="line-height:40px;" width="22%"><strong>操作</strong></td>
</tr>
<?php 
$query = mysql_query("select * from  se2sc ".$sql." ".$order." limit $offset, $Page_size");
$i=1;
while ($a=mysql_fetch_array($query)) { 
$sctime=date('Y-m-d H:i:s',$a[addtime]);
$scid=$a[id];
$name=$a[name];
$pic=$a[pic];
$url=$a[url];
?> 
<tr class="re">
  <td style="border-top: 1px solid #ddd;line-height:45px;" align="center"><span class="yulan" style="background-image:url('<?php $imis = substr_count($pic,'http'); if ($imis==0){ $pic=str_replace("//","/","/".$pic); echo $pic;}else{echo $pic;}?>')"></span></td>
<td height="35" style="border-top: 1px solid #ddd;line-height:45px;" align="center"><div class="xiangqing"><span class="left"><i></i><?php echo $name;?></span><span class="right"><i></i><?php echo $sctime;?></span></div></td>
<td height="35" style="border-top: 1px solid #ddd;line-height:45px;" align="center"><div class="caozuo"><span class="left"><a href="?id=<?php echo $scid;?>" target="msgubotj" onClick="return window.confirm(&quot;单击“确定”删除。单击“取消”撤销。&quot;);">删除</a></span><span class="right"><a href="/<?php echo $url;?>">观看</a></span></div></td>
</tr>
<?php 
$i++;  
};
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">首页</a> "; //首页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">< 上一页</a>"; //上一页 
}else { 
$key.="<a>首页</a> "; //首页 
$key.="<a >< 上一页</a>"; //上一页  
} 
if($pages>$page_len){ 
//如果当前页小于等于左偏移 
if($page<=$pageoffset){ 
$init=1; 
$max_p = $page_len; 
}else{//如果当前页大于左偏移 
//如果当前页码右偏移超出最大分页数 
if($page+$pageoffset>=$pages+1){ 
$init = $pages-$page_len+1; 
}else{ 
//左右偏移都存在时的计算 
$init = $page-$pageoffset; 
$max_p = $page+$pageoffset; 
} 
} 
} 
if($page!=$pages){ 

$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页 ></a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">末页</a>"; //最后一页 
}else { 
$key.=" <a >下一页 ></a> ";//下一页 
$key.="<a>末页</a>"; //最后一页 
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
