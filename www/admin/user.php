<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
if($_POST[sdok]){
$suoding=$_POST[suoding];
$suodingid=$_POST[suodingid];
$type="suoding='$suoding' where id='$suodingid'";
upalldt(ubouser,$type);
$page=$_GET["page"];
if ($page){
if($_POST[suoding]== "True"){ 
echo msglayerurl("解除锁定，返回页面",5,"user.php?page=$page");
}else{ 
echo msglayerurl("已锁定，返回页面",5,"user.php?page=$page");
}
}else{
if($_POST[suoding]== "True"){ 
echo msglayerurl("解除锁定，返回页面",5,"user.php");
}else{ 
echo msglayerurl("已锁定，返回页面",5,"user.php");
}
}
}
$userid=$_GET["userid"];
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(ubouser,$type);
$page=$_GET["page"];
if ($page){
echo msglayerurl("删除成功，返回页面",8,"user.php?page=$page");
}else{
echo msglayerurl("删除成功，返回页面",8,"user.php");
}
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>会员管理</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="css/layui.css" media="all">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/style2.css">
<!--CSS引用-->
<link rel="stylesheet" href="css/peizhi.css">
<!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<SCRIPT language=javascript src="../app/layer/jquery-1.9.1.min.js"></SCRIPT>
<SCRIPT language=javascript src="../app/layer/layer.js"></SCRIPT>
<script language="javascript">
function checkdel()
{if (confirm("确实要删除吗？"))
     {return (true);}
     else
     {return (false);}
}
</script>
</head>
<body>
<div class="layui-layout layui-layout-admin">
<?php include_once('header.php'); ?>
<?php include_once('left.php'); ?>
<!--主体-->
<div class="layui-body">
<!--tab标签-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="user.php">会员管理</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>会员ID：<input id="userid" name="userid" style="width:150px;" type="text" value="<?php if($userid==null){ }else{ echo $userid;}?>" class="layui-input"> 
<input type="submit" class="layui-btn" value="搜索">&nbsp;<input type="button" class="layui-btn" value="添加会员" onClick="location.href='adduser.php'"></td>
  </tr>
</table>
</form>

<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
<tbody>
<tr class="color1">
<th><div align="center">推广ID</div></th>
<th><div align="center">用户名</div></th>
<th><div align="center">签到次数</div></th>
<th><div align="center">连续签到</div></th>
<th><div align="center">签到日期</div></th>
<th><div align="center">注册IP</div></th>
<th><div align="center">注册时间</div></th>
<th><div align="center">金币</div></th>
<th><div align="center">会员类型</div></th>
<th><div align="center">操作</div></th>
</tr>
<?php 
$Page_size=16; 
$sql = "WHERE 1=1";
if($userid){
$sql .=" and (user like '%$userid%' or name like '%$userid%' )";
}
$result = mysql_query("select id from ubouser   ".$sql."  ");
if($result == 0){
echo '<tr class="color2"><td colspan=10 align="center">查询不到数据</td></tr>';
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
$query = mysql_query("select * from  ubouser   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$dqtime=$a[dqtime];
$lxcs=$a[lxcs];
$ip=$a[ip];
?> 	
<tr class="color2">
<td align="center" height="24"><?php echo $a[userid]?></td>
<td align="center"><?php echo $a[user]?></td>
<td align="center"><?php echo $a[qdzs]?></td>
<td align="center"><?php if ($lxcs>1){echo $lxcs;}else{echo "0";}?></td>
<td align="center"><?php if ($dqtime>0){echo date('Y-m-d H:i:s',$dqtime);}else{echo "未签到";}?></td>
<td align="center"><?php if ($ip=='0'){echo "未知";}else{echo $ip;}?></td>
<td align="center"><?php echo date('Y-m-d H:i:s',$a[zctime]);?></td>
<td align="center">￥<?php echo $a[money]?> 元</td>
<td align="center">
<!--<?php if ($a[hylx]>0) {echo "VIP会员";}else{echo "普通会员";}?>-->
<?php echo $a[hymc];?>
 </td>	
<td align="center"><a href="useredit.php?id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>&nbsp;<a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"target="msgubotj">删除</a></td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<li>'; 
$key.="<a class=\"number\">当前第 $page 页/共 $pages 页</a></li>"; //第几页,共几页 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=1\">&laquo; 首页</a></li> "; //首页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">&laquo; 上一页</a></li>"; //上一页 
}else { 
$key.="<li><a>&laquo; 首页</a></li> "; //首页 
$key.="<li><a >&laquo; 上一页</a></li>"; //上一页  
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
$key.=' <li class="active"><span>'.$i.'</span></li>'; 
} else { 
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页 &raquo;</a></li>"; //最后一页 
}else { 
$key.=" <li><a >下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a>最后一页 &raquo;</a></li>"; //最后一页 
} 
$key.=''; 
?> 
<tr><td colspan=16><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>