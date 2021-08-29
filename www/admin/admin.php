<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE name='$_POST[username]'";
$row=queryall(uboadmin,$type);  
if($_POST[add]){
if($_POST[username]==null){
echo msglayer("帐号不能为空！",3);
}elseif($_POST[password]==null){
echo msglayer("密码不能为空！",3);
}elseif($row){
echo msglayer("管理员已存在！",3);
}else{
$newpass=md5($_POST[password]);
$type="(`id`, `name`, `pass`) VALUES (null, '$_POST[username]', '$newpass')";
dbinsert(uboadmin,$type);
echo msglayerurl("添加管理成功，返回页面",5,"admin.php");
}
}
$userid=$_GET[id];
$type="WHERE id='$userid'";
$duqu=queryall(uboadmin,$type);
if($_POST[edit]){
if($_POST[username]==null){
echo msglayer("帐号不能为空！",3);
}elseif($_POST[password]==null){
echo msglayer("密码不能为空！",3);
}else{
$newpass=md5($_POST[password]);
$type="name='$_POST[username]',pass='$newpass'   where id='$userid'";
upalldt(uboadmin,$type);
echo msglayerurl("修改成功，返回页面",4,"admin.php");
}
}
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(uboadmin,$type);
echo msglayerurl("删除成功，返回页面",8,"admin.php");
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>管理列表</title>
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
</head>
<body>
<div class="layui-layout layui-layout-admin">
<?php include_once('header.php'); ?> 
<?php include_once('left.php'); ?> 
<!--主体-->
<div class="layui-body">
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="admin.php">添加管理员</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
 <table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tr>
<td width="100" scope="col"><p>管理员用户：</p></td>
<td  scope="col">
<?php if($userid==null){ ?>
<input class="layui-input" type="text" name="username" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="username" value="<?php echo $duqu[name]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td scope="col"><p>管理员密码：</p></td>
<td scope="col">
<?php if($userid==null){ ?>
<input class="layui-input" type="text" name="password" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="password" value="<?php echo $duqu[pass]?>"/>
<?php  } ?>
</td>
</tr>

</td>
</tr>
</table>
<p>
<br>
<?php if($userid==null){ ?>
<input type="submit" class="layui-btn" value="添加" id="btnPost" onClick=""  name="add" >
<?php }else{ ?>
<input type="submit" class="layui-btn" value="修改" id="btnPost" onClick=""  name="edit" >
<?php  } ?>
</p>
</form>
</div>
</div>
</div>
<!--tab标签-->
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="admin.php">管理列表</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color1">
 <th><p align="center"><b>编号</b></p></th>
 <th><p align="center"><b>用户名</b></p></th>

<th><p align="center"><b>操作</b></p></th>
</tr>
<?php 
$Page_size=5; 
$result=mysql_query("SELECT * FROM uboadmin  "); 
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
$query = mysql_query("select * from  uboadmin  limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 
<tr class="color3">
 <td height="30" align="center"><p align="center"><?php echo $a[id]?></p></td>
 <td align="center"><p align="center"><?php echo $a[name]?></p></td>

 
<td align="center"><a href="admin.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a><a href="admin.php?action=del&delid=<?php echo $a[id]?>" target="msgubotj" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a></td>
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
	
<tr><td colspan=15><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
