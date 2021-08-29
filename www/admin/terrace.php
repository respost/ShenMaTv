<?php
error_reporting(0); 

if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$t="WHERE name='$_POST[name]'";
$row=queryall(uboterrace,$t);  
if($_POST[add]){
$name=$_POST[name];
$fenlei=$_POST[fenlei];
$sort=$_POST[sort];
$link=$_POST[link];
$type=$_POST[type];
if($fenlei==0)
{$t="(`id`, `name`, `type`, `big_id`, `small_id`, `sort`) VALUES (null, '$name','$type', '0', '$fenlei', '$sort')";}
else
{$t="(`id`, `name`, `type`, `big_id`, `small_id`, `link`, `sort`) VALUES (null, '$name', '$type', '0', '$fenlei', '$link', '$sort')";}
dbinsert(uboterrace,$t);
echo msglayerurl("添加成功，返回页面",5,"terrace.php");
}
$id=$_GET[id];
$t="WHERE id='$id'";
$duqu=queryall(uboterrace,$t);
if($_POST[edit]){
$name=$_POST[name];
$fenlei=$_POST[fenlei];
$sort=$_POST[sort];
$link=$_POST[link];
$type=$_POST[type];
if($fenlei==0)
{$t="name='$name',type='$type',sort='$sort'  where id='$id'";}
else
{$t="name='$name',type='$type',small_id='$fenlei',link='$link',sort='$sort'  where id='$id'";}
upalldt(uboterrace,$t);
echo msglayerurl("修改成功，返回页面",4,"terrace.php");
}
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="del"){
$t="id='$delid'";
dbdel(uboterrace,$t);
echo msglayerurl("删除成功，返回页面",8,"terrace.php");
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>平台管理</title>
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
<li class="layui-this"><a href="terrace.php">添加平台</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">
 <table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tr>
<td width="100" scope="col" height="32"><p>平台/商品名称：</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="name" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="name" value="<?php echo $duqu[name]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td width="100" scope="col" height="32"><p>所属平台：</p></td>
<td scope="col">
<select name="fenlei" style="margin:0px">
<option value="0">默认为平台</option>
<?php
$query = mysql_query("SELECT * FROM uboterrace where small_id=0 order by sort desc");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>" <?php if ($duqu[small_id]==$a[id]){ echo "selected";}?>><?php echo $a[name]?></option>
<?php $query2 = mysql_query("SELECT * FROM uboterrace where small_id=".$a[id]." order by sort desc");
while($a2 = mysql_fetch_array($query2)){?>
<option value="<?php echo $a2[id]?>">┣&nbsp;<?php echo $a2[name]?></option>
<?php }?>
<?php }?>
</select> 
</td>
</tr>
<tr>
<td width="100" scope="col" height="32"><p>会员类型：</p></td>
<td scope="col">
<?php
$hy=getone("select * from ubozf WHERE id=1");
if ($hy)
{
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
} 
$type=$duqu[type];
?>
<select name="type" style="margin:0px">
<option value="1" <?php if ($type==1){ echo "selected";}?>><?php echo $member1;?></option>
<option value="2" <?php if ($type==2){ echo "selected";}?>><?php echo $member2;?></option>
<option value="3" <?php if ($type==3){ echo "selected";}?>><?php echo $member3;?></option>
<option value="4" <?php if ($type==4){ echo "selected";}?>><?php echo $member4;?></option>
</select>
</tr>
<tr>
<td width="100" scope="col" height="32"><p>商品链接：</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="link" value=""/>
<?php }else{ ?>
<input class="layui-input" type="text" name="link" value="<?php echo $duqu[link]?>"/>
<?php  } ?>
</td>
</tr>
<tr>
<td width="100" scope="col" height="32"><p>平台排序：</p></td>
<td scope="col">
<?php if($id==null){ ?>
<input class="layui-input" type="text" name="sort" value="0" style="width:100px;"/>
<?php }else{ ?>
<input class="layui-input" type="text" name="sort" value="<?php echo $duqu[sort]?>" style="width:100px;"/>
<?php  } ?>
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
<li class="layui-this"><a href="terrace.php">平台/商品列表</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color1">
 <td height="32"><p align="center"><b>平台/商品编号</b></p></td>
 <td><p align="center"><b>平台/商品名称</b></p></td>

<td><p align="center"><b>操作</b></p></td>
</tr>
<?php 
$Page_size=10; 
$result=mysql_query("SELECT * FROM uboterrace where small_id=0"); 
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
$query = mysql_query("select * from  uboterrace where small_id=0 order by sort desc limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> 
<tr class="color3">
 <td height="30" align="center"><p align="center">┏&nbsp;<?php echo $a[id]?></p></td>
 <td align="center"><p align="center"><?php echo $a[name]?></p></td>
<td align="center"><p align="center"><a href="terrace.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>&nbsp;<a  onclick="return checkdel()"  target="msgubotj"  href="?action=del&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >删除</a> </p></td>
</tr>
<?php $query2 = mysql_query("SELECT * FROM uboterrace where small_id=".$a[id]." order by sort desc");
while($a2 = mysql_fetch_array($query2)){?>
<tr class="color3">
 <td height="30" align="center"><p align="center">┣&nbsp;<?php echo $a2[id]?></p></td>
 <td align="center"><p align="center"><?php echo $a2[name]?></p></td>
<td align="center"><p align="center"><a href="terrace.php?id=<?php echo $a2[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>&nbsp;<a  onclick="return checkdel()"  target="msgubotj"  href="?action=del&delid=<?php echo $a2[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" >删除</a> </p></td>
</tr>
<?php }?>
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