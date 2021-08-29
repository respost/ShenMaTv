<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$name=$_GET["name"];
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(ubovip,$type);
$page=$_GET["page"];
if ($page){
echo msglayerurl("删除成功，返回页面",8,"vip.php?page=$page");
}else{
echo msglayerurl("删除成功，返回页面",8,"vip.php");
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="Content-Language" content="zh-CN">
<title>资源列表</title>
<link href="images/admin2.css" rel="stylesheet" type="text/css">
<script src="images/common.js" type="text/javascript"></script>
<script src="images/c_admin_js_add.js" type="text/javascript"></script>
<link rel="stylesheet" href="images/jquery.bettertip.css" type="text/css" media="screen">
<script src="images/jquery.bettertip.pack.js" type="text/javascript"></script>
<script src="images/jquery-ui.custom.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="images/jquery-ui.custom.css">
<SCRIPT language=javascript src="../app/layer/layer.js"></SCRIPT>
<SCRIPT language=javascript src="../app/layer/diy.js"></SCRIPT>
</head>
<body>
<?php include_once('header.php'); ?> 
<?php include_once('left.php'); ?> 
<div class="main_right">
<div class="yui">
<div class="content">
<div id="divMain">
<div class="divHeader">资源列表</div><div class="SubMenu"></div><div id="divMain2">
<form class="search" method="get" action="">
<p>搜索:
<input id="name" name="name" style="width:150px;" type="text" value="">
<input type="submit" class="button" value="提交">
<input type="button" class="button" value="资源添加" onClick="location.href='viptj.php'">
</p></form>
<table width=100% border="1" cellspacing="0" cellpadding="0" class="tableBorder tableBorder-thcenter">
<tbody>
<tr>
<tr class="color1">
<th>名称</th>
<th>地址</th>
<th>操作</th>
</tr>
<?php 
$Page_size=8; 
$sql = "WHERE 1=1";
if($name){
$sql .=" and name like '%$name%' ";
}
$result = mysql_query("select id from ubovip   ".$sql."  ");
if($result == 0){
echo '<tr class="color2"><td colspan=5 align="center">查询不到数据</td></tr>';
}
$count = mysql_num_rows($result); 
$page_count = ceil($count/$Page_size); 
$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 

//判断当前页码 
if(empty($_GET['page'])||$_GET['page']<0){ 
$page=1; 
}else { 
$page=$_GET['page']; 
} 
$offset=$Page_size*($page-1); 
$query = mysql_query("select * from  ubovip   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 	
<tr class="color2">
<td align="center"><?php echo $a[name]?></td>			

<td align="center"><?php if($a[url]==null){ ?>无视频地址<?php }else{ ?><?php echo $a[url]?><?php } ?></td>
<td align="center">
<a href="vipedit.php?id=<?php echo $a[id]?>&page=<?php echo $page?>" class="button"><img src="images/page_edit.png" alt="可视编辑" title="可视编辑" width="16"></a>&nbsp;<a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="button"target="msgubotj"><img src="images/delete.png" alt="彻底删除" title="彻底删除" width="16"></a>
</td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<tr><td colspan=5><div class="pagination">'; 
$key.="<a class='number' >当前第 $page 页/共 $pages 页</a> "; //第几页,共几页 
if($page!=1){ 
if($name){
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1&name=$name\">首页</a> "; //首页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."&name=$name\">上一页</a>"; //上一页 
}else {
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">首页</a> "; //首页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">上一页</a>"; //上一页 

}
}else { 
$key.="<a> 首页</a> "; //首页 
$key.="<a >上一页</a>"; //上一页  
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
if($name){
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."&name=$name\">".$i."</a>"; 
} else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>"; 
}
} 
} 
if($page!=$pages){ 
if($name){
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."&name=$name\">下一页</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}&name=$name\">最后一页</a>"; //最后一页 
}else { 
$key.=" <a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a> ";//下一页 
$key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a>"; //最后一页 
}
}else { 
$key.=" <a >下一页</a> ";//下一页 
$key.="<a>最后一页</a>"; //最后一页 
} 
$key.='</div>'; 
?> 
<tr><td colspan=5><div class="pagination"><?php echo $key?></td></tr>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
