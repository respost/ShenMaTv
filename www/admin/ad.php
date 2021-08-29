
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
$mhid=$_GET[mhid];
if($del=="del"){
$type="id='$delid'";
dbdel(uboad,$type);
$type="sheet=sheet-1 where id='$mhid'";
upalldt(se2mh,$type);
echo msglayerurl("删除成功，返回页面",8,"ad.php");
}
$array = $_POST["del_id"]; 
if(!empty($array)){
$del_sun=count($array); 
for($i=0;$i<$del_sun;$i++){
$row=getone("select * from uboad WHERE id=".$array[$i]);
if ($row)
{
$mhid=$row[mhid];
$type="sheet=sheet-1 where id='$mhid'";
upalldt(se2mh,$type);
}
$type="id=".$array[$i];
dbdel(uboad,$type);
}
echo"<script>alert('删除成功');history.go(-1);</script>";  
}
function fenlei($id)
{
    $fname=getone("select * from uboadfl WHERE id=".$id);
    $return=$fname['name'];
	return $return;
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>广告管理</title>
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
<li class="layui-this"><a href="ad.php">广告管理</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>搜索:
<input id="name" name="name" style="width:150px;" type="text" value="" class="layui-input">
<input type="submit" value="提交" class="layui-btn">
<input type="button" class="layui-btn" value="添加广告" onClick="location.href='adadd.php'">
</td>
  </tr>
</table>
</form>
  <form id="form1" name="form1" method="post" action="">
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
  <tbody>
    <tr class="color1" style="background-color: #f2f2f2;">
      <th align="center" width="4%">&nbsp;</th>
      <th align="center" width="6%">缩略图</th>
      <th align="left">广告名称</th>
	  <th align="center" width="16%">广告位置</th>
      <th align="center" width="16%">截止日期</th>
      <th align="center" width="12%">状态</th>
      <th align="center" width="18%">操作</th>
    </tr>
    <?php 
$Page_size=10; 
$sql = "WHERE 1=1";
if($name){
$sql .=" and name like '%$name%'";
}
$result = mysql_query("select id from uboad  ".$sql."  ");
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
$query = mysql_query("select * from  uboad ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$time_jr=time();
$time_dq=$a[endtime];
$state=$a[state];
$ts_value = $time_dq - $time_jr;
$fenzhong = round($ts_value / 60);
?>
    <tr class="color2">
      <td align="center"><input type="checkbox" name="del_id[]" value="<?php echo $a['id']; ?>" id="del_id" class="demo--radioInput" style="margin:0;"e/></td>
      <td align="center"><span style="background-image:url('<?php $pic=$a[pic]; $pic_c=substr_count($pic,'http://'); if ($pic_c==1){echo $pic;}else{echo "/".$pic;}?>')" class="mt_simg"></span></td>
      <td align="left"><?php echo $a[name]?></td>
	  <td align="center"><?php $flname=fenlei($a[fenlei]); echo $flname;?></td>
      <td align="center"><?php echo date('Y-m-d H:i',$a[endtime]);?></td>
      <td align="center"><?php if ($state==0){?><?php if ($fenzhong>0) {echo "正常";}else{echo "过期";}?><?php }else{ echo "停止";}?></td>
      <td align="center"><a href="addm.php?id=<?php 

echo $a[id]?>" class="layui-btn layui-btn-mini ajax-delete">代码</a>&nbsp;<a href="adedit.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>&nbsp;<a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&mhid=<?php echo $a[mhid]?>&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" target="msgubotj">删除</a></td>
    </tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<li>'; 
$key.="<a class=\"number\">当前第 $page 页/共 $pages 页</a></li>"; //第几页,共几页 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=1\">&laquo; 首页</a></li> "; //首页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=".($page-1)."\">&laquo; 上一页</a></li>"; //上一页 
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
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page=".($page+1)."\">下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&page={$pages}\">最后一页 &raquo;</a></li>"; //最后一页 
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