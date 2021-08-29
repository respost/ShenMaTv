<?php
error_reporting(0); 
include("os.php");
include("config/common.php");
include("config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$ip=$_SERVER["REMOTE_ADDR"];
$type="where ip='$ip'";
$user=queryall(uboip,$type);
$pid=$user[pid];
$uid=$user[uid];
$userid=$_COOKIE[userid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$id=$_GET['id'];
$user=getone("select * from ubouser WHERE user='".$userid."'");
$uid=$user['id'];
if($id)
{
$type="uid=".$uid." and id=".$id;
dbdel(se2sc,$type);
echo "<script>alert('删除成功！')</script><script>location.href='user_scj.php'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
<title>会员中心-视频收藏夹</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<?php include_once('css.php'); ?> 
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
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">资料修改</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<ul class="head-nav">
<a href="vod_list.php?m=new" rel="external"><li>今日更新</li></a>
<a href="vod_list.php?flid=4" rel="external"><li>美女热舞</li></a>
<a href="vod_list.php?flid=3" rel="external"><li>主播视频</li></a>
<a href="vod_list.php?flid=6" rel="external"><li>搞笑短剧</li></a>
<a href="img_list.php" rel="external"><li>性感写真</li></a>
</ul>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="vod_list.php" data-ajax="false" id="search-form">
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
<ul class="nav-list">
<?php 
$query = mysql_query("SELECT * FROM se2fl limit 6 ");
while($a = mysql_fetch_array($query)) {?>			
<a href="vod_list.php?flid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
<?php
$query = mysql_query("SELECT * FROM se2tufl order by id limit 12 ");
while($a = mysql_fetch_array($query)) {?>
<a href="/img_list.php?tid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
</ul>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1><?php if($user[ms]=="黄金会员"){?>黄金会员<?php }elseif($user[ms]=="永久会员"){?>钻石会员<?php }?></h1>
</header>
<section class="jilu" style=" margin-top:46px;"> 
<a href="user_mtscj.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">美图收藏</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a> 
<a href="user_scj.php">
<li>
<h2 class="t2 l" style="padding-top:1.5%;color:red;"><img src="/img/ustb.png" width="12" height="12" style="margin-right:5px;">视频收藏</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a> 
</section>
<?php if(1==2){?>
<section class="kaitong"> <a href="http://m.jjrsp.com/index.php/user/pay/group">
<li> <span class="mui-icon myFont-Icon t1 l"></span>
<h2 class="t2 l">升级VIP</h2>
<span class="r login_yj"> &gt; </span>
</li>
<div class="clear"></div>
<li class="xian" style="padding-top:5px;"> <span class="t4">VIP用户有效期内全站高清精彩无限制任意看~！</span> </li>
</a> 
</section>
<?php }
$order = 'order by id desc ';
$sql = "WHERE uid=".$uid;
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
  <td align="center" style="line-height:40px;"><strong>预览</strong></td>
<td height="40" align="center" style="line-height:40px;"><strong>详情</strong></td>
<td height="40" align="center" style="line-height:40px;"><strong>操作</strong></td>
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
  <td style="border-top: 1px solid #ddd;line-height:45px;" align="center"><span class="yulan" style="background-image:url('<?php echo $pic;?>')"></span></td>
<td height="35" style="border-top: 1px solid #ddd;line-height:45px;" align="center"><div class="xiangqing"><span class="left"><i></i><?php echo $name;?></span><span class="right"><i></i><?php echo $sctime;?></span></div></td>
<td height="35" style="border-top: 1px solid #ddd;line-height:45px;" align="center"><div class="caozuo"><span class="left"><a href="?id=<?php echo $scid;?>" onClick="return window.confirm(&quot;单击“确定”删除。单击“取消”撤销。&quot;);">删除收藏</a></span><span class="right"><a href="<?php echo $url;?>">继续观看</a></span></div></td>
</tr>
<?php 
$i++;  
};
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<tr><td colspan=15><div class="pagination">'; 
$key.="<a class='number' >当前第 $page 页/共 $pages 页</a> "; //第几页,共几页 
if($page!=1){ 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=1\">&laquo; 首页</a> "; //首页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=".($page-1)."\">&laquo; 上一页</a>"; //上一页 
}else { 
$key.="<a>&laquo; 首页</a> "; //首页 
$key.="<a >&laquo; 上一页</a>"; //上一页  
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
for($i=$init;$i<=$max_p;$i++){ 
if($i==$page){ 
$key.=' <a  class="number current">'.$i.'</a>'; 
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=".$i."\">".$i."</a>"; 
} 
} 
if($page!=$pages){ 

$key.=" <a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=".($page+1)."\">下一页 &raquo;</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page={$pages}\">最后一页 &raquo;</a>"; //最后一页 
}else { 
$key.=" <a >下一页 &raquo;</a> ";//下一页 
$key.="<a>最后一页 &raquo;</a>"; //最后一页 
} 
$key.='</div>'; 
?>
</table>
</section>
<div style="margin-top: 2.2%;background:#fff;height:40px;line-height:40px;border: 1px solid #ddd;" align="center"> 
<?php echo $key?>
</div>

<?php include_once('foot.php'); ?> 
<footer id="footer" class="ui-footer ui-footer-stable ui-border-t">
<ul class="ui-tiled ui-border-t">
<li onClick="ubourl('/')"><i class="ui-icon-index"></i>首&nbsp;&nbsp;页</li>
<li onClick="ubourl('vod_list.php')" ><i class="ui-icon-sp"></i>视频区</li>
<li onClick="ubourl('img_list.php')" ><i class="ui-icon-tp"></i>美图区</li>
<li  onclick="ubourl('user.php')" class="active"><i class="ui-icon-user2"></i>会员中心</li>
</ul>
</footer>
</body>
</html>
<?php }?> 