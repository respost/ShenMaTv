<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
}
include("../config/conn.php");
include("../config/common.php");
$name=$_GET["name"];
$del=$_GET[action];
$delid=$_GET[delid];
$dtid=$_GET[id];
//单个删除
if($del=="del"){
	$type="id='$delid'";
	dbdel(uboidea,$type);
	echo msglayerurl("删除成功，返回页面",8,"idea.php");
}
//批量删除
$array = $_POST["del_id"]; 
if(!empty($array)){
	$del_sun=count($array); 
	for($i=0;$i<$del_sun;$i++){
		$row=getone("select * from uboidea WHERE id=".$array[$i]);
		$type="id=".$array[$i];
		dbdel(uboidea,$type);
	}
	echo msglayerurl("批量删除成功，返回页面",8,"idea.php");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>意见反馈</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="css/layui.css" media="all">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/style2.css">
<!--CSS引用-->
<link rel="stylesheet" href="css/peizhi.css">
<style>
.head{width: 50px; height: 50px; float:left; border-radius: 50%; border: 3px solid #eee; overflow: hidden;}
.name-c{ height: 50px;line-height:50px;color:red;}
</style>
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
　　function All(e, itemName)
　　{
　　var aa = document.getElementsByName(itemName);
　　for (var i=0; i<aa.length; i++)
　　aa[i].checked = e.checked; 
　　}
function checkdel(delid,formname){
var flag = false;
for(i=0;i<delid.length;i++){
if(delid[i].checked == true){
flag = true;
break;
}
}
if(!flag){
return true;
}
else
{
formname.submit();
}
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
<li class="layui-this"><a href="zbdtgl.php">意见反馈</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>搜索:
<input id="name" name="name" style="width:150px;" type="text" value="" class="layui-input">
<input type="submit" value="搜索" class="layui-btn"></td>
  </tr>
</table>
</form>
  <form id="form1" name="form1" method="post" action="">
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
  <tbody>
    <tr class="color1" style="background-color: #f2f2f2;">
      <th align="center" width="5%">&nbsp;</th>
	  <th align="center" width="15%">用户</th>
      <th align="left">意见内容</th>
      <th align="center" width="10%">手机号码</th>
      <th align="center" width="10%">邮箱</th>   
      <th align="center" width="15%">添加时间</th>
      <th align="center" width="5%">操作</th>
    </tr>
    <?php 
$Page_size=10; 
$sql = "WHERE 1=1";
if($name){
$sql .=" and (content like '%$name%' or phone like '%$name%' or email like '%$name%')";
}
if($dtid){
$sql .=" and zbid=".$dtid;
}
$result = mysql_query("select id from uboidea  ".$sql."  ");
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
$query = mysql_query("select * from  uboidea ".$sql." order by id desc  limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
//查询用户信息
$uid=$a[uid];
$type="where id='$uid'";
$user=queryall(ubouser,$type);
if($user[name]){
	$username=$user[name];
}else{
	$username=$user[user];
}
$avatar=$user[avatar];
?>
    <tr class="color2">
      <td align="center" height="46"><input type="checkbox" name="del_id[]" value="<?php echo $a['id']; ?>" id="del_id" class="demo--radioInput" style="margin:0;"e/></td>
      <td align="center"><img class="head" alt="" src="../img/pl/<?php echo $avatar;?>.jpg"><span class="name-c"><?php echo $username;?></span></td>
	  <td align="left"><?php echo $a[content]?></td>
      <td align="center"><?php echo $a[phone];?></td>
      <td align="center"><?php echo $a[email];?></td>     
      <td align="center"><?php echo $a[addtime];?></td>
      <td align="center"><a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" target="msgubotj">删除</a></td>
    </tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<li>'; 
$key.="<a class=\"number\">当前第 $page 页/共 $pages 页</a></li>"; //第几页,共几页 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&id=".$dtid."&page=1\">&laquo; 首页</a></li> "; //首页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&id=".$dtid."&page=".($page-1)."\">&laquo; 上一页</a></li>"; //上一页 
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
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&id=".$dtid."&page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&id=".$dtid."&page=".($page+1)."\">下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&id=".$dtid."&page={$pages}\">最后一页 &raquo;</a></li>"; //最后一页 
}else { 
$key.=" <li><a >下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a>最后一页 &raquo;</a></li>"; //最后一页 
} 
$key.=''; 
?> 
<tr>
  <td colspan=15 style="padding-left:20px;" height="38"><label id="chkAll"><input class="demo--radioInput" style="margin:0;" type="checkbox" name="chkAll" id="chk" title="全选/反选" onClick="All(this, 'del_id[]')" />
  全选 </label> <input type="submit" name="jiesuan" value="一键删除" onClick="javascript:if(checkdel(del_id,'check')){return true;}else{return false;};" class="layui-btn" style="position:relative; height:26px; line-height:26px; margin-left:6px;" border="0"  target="msgubotj"></td>
</tr>

<tr><td colspan=15><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
 </form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>