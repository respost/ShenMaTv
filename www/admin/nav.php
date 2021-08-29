<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$type="WHERE name='$_POST[name]' and member='$_POST[member]'";
$row=queryall(se2nav,$type);  
if($_POST[add]){
if($_POST[name]==null){
echo msglayer("名称不能为空！",3);
}elseif($_POST[url]==null){
echo msglayer("链接不能为空！",3);
}elseif($row){
echo msglayer("该导航已存在！",3);
}else{
$url=$_POST[url];
$sort=$_POST[sort];
$member=$_POST[member];
$type="(`id`, `name`, `url`, `sort`, `member`) VALUES (null, '$_POST[name]', '$url', '$sort', '$member')";
dbinsert(se2nav,$type);
echo msglayerurl("导航添加成功，返回页面",5,"nav.php");
}
}
$id=$_GET[id];
$type="WHERE id='$id'";
$duqu=queryall(se2nav,$type);
if($_POST[edit]){
if($_POST[name]==null){
echo msglayer("名称不能为空！",3);
}elseif($_POST[url]==null){
echo msglayer("链接不能为空！",3);
}else{
$url=$_POST[url];
$sort=$_POST[sort];
$member=$_POST[member];
$type="name='$_POST[name]',url='$url',sort='$sort',member='$member' where id='$id'";
upalldt(se2nav,$type);
echo msglayerurl("修改成功，返回页面",4,"nav.php");
}
}
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$type="id='$delid'";
dbdel(se2nav,$type);
echo msglayerurl("删除成功，返回页面",8,"nav.php");
}
$mor=$_GET[action];
$morid=$_GET[morid];
$m=$_GET[m];
if($mor=="mor"){
$type="mor='1' where id='$morid'";
upalldt(se2nav,$type);
if ($m=="vip")
{$sql=" and member=1";}else{$sql=" and member=0";}
$type="mor='0' where id<>'$morid' and mor>0".$sql;
upalldt(se2nav,$type);
echo msglayerurl("设置成功，返回页面",8,"nav.php");
}
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>导航管理</title>
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
<div class="layui-tab layui-tab-brief">
<ul class="layui-tab-title">
<li class="layui-this"><a href="nav.php">添加导航</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
 <table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tr>
<td width="100" scope="col" height="32"><p>导航名称：</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="name" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="name" value="<?php echo $duqu[name]?>"/>
<?php  } ?></td>
</tr>
<tr>
<td scope="col" height="32"><p>导航链接：</p></td>
<td  scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="url" value="" />
<?php }else{ ?>
<input class="layui-input" type="text" name="url" value="<?php echo $duqu[url]?>"/>
<?php  } ?></td>
</tr>

<tr>
<td  scope="col" height="32"><p>导航排序：</p></td>
<td  scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="sort" value="0" />
<?php }else{ ?>
<input class="layui-input" type="text" name="sort" value="<?php echo $duqu[sort]?>"/>
<?php  } ?></td>
</tr>
<tr>
  <td height="42" scope="col">会员设置：</td>
  <td scope="col"><label><input class="demo--radioInput" name="member" type="radio" value="0" <?php $member=$duqu[member]; if ($member==0 || $id==null){echo "checked";}?>>
    普通导航</label>&nbsp;&nbsp;
    <label><input class="demo--radioInput" type="radio" name="member" value="1" <?php if ($member==1){echo "checked";}?>>会员导航</label></td>
</tr>

</td>
</tr>
</table>
<p>
<br>
<?php if($id==null){ ?>
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
<li class="layui-this"><a href="nav.php">导航列表</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color1">
 <td><p align="center"><b>排序</b></p></td>
 <td><div align="center"><strong>归属</strong></div></td>
 <td><p align="center"><b>导航名称</b></p></td>

<td><p align="center"><b>操作</b></p></td>
</tr>
<?php 
$Page_size=10; 
$result=mysql_query("SELECT * FROM se2nav"); 
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
$order = 'order by member desc,sort desc';
$query = mysql_query("select * from  se2nav ".$order." limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 
<tr class="color3">
 <td height="30" align="center"><p align="center"><?php echo $a[sort]?></p></td>
 <td align="center"><?php $member=$a[member]; if ($member==1){echo "会员"; }else{echo "普通";}?></td>
 <td align="center"><p align="center"><?php echo $a[name]?></p></td>

 
<td align="center"><p align="center"><a href="nav.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>&nbsp;<a  onclick="return checkdel()"  target="msgubotj"  href="nav.php?action=del&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >删除</a>&nbsp;<?php if ($a[mor]==0){?><a target="msgubotj"  href="nav.php?action=mor&morid=<?php echo $a[id]?><?php if ($member==1){echo "&m=vip"; }?>" class="layui-btn layui-btn-normal layui-btn-mini" >默认</a><?php }else{?><a target="msgubotj"  href="nav.php?action=mor&morid=<?php echo $a[id]?><?php if ($member==1){echo "&m=vip"; }?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >主键</a><?php }?> </p></td>
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