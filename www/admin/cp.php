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
$uid=$_GET[uid];
$division=$_GET[division];
$fenlei=$_GET[fenlei];
$member=$_GET[member];
$page=$_GET[page];
$host = $_SERVER['HTTP_HOST'];
if($del=="via"){
$shipin=getone("select * from se2nr WHERE censor>0 and shijian<>'0' and id=".$delid);
if ($shipin)
{
$type="censor='0' where id='$delid'";
upalldt(se2nr,$type);
echo msglayerurl("审核成功，返回页面",8,"cp.php");
}
else
{
echo msglayer("视频未查看！",8);
exit;
}
}
if($del=="del"){
$type="where id='$delid'";
$nr=queryall(se2nr,$type);
$url=$nr[url];
$pic="../".$nr[pic];
$url_1 = $url;
$url_2 = explode('|',$url_1); 
$array = $url_2;
$count = count($url_2);
if ($count>1){
for($index=0;$index<$count;$index++) 
{ 
$url=$array[$index];
$url=str_replace("http://".$host ,"..",$url);
unlink($url); 
}}else{
$url=str_replace("http://".$host ,"..",$url);
unlink($url); 
}
unlink($pic); 
$type="id='$delid'";
dbdel(se2nr,$type);
if ($division==1){
$type="trends=trends-1 where id='$uid'";
upalldt(ubozb,$type);
}else{
$type="trends=trends-1 where id='$uid'";
upalldt(ubouser,$type);
}
if ($dtid){
$ulr="?id=".$dtid;}
echo msglayerurl("删除成功，返回页面",8,"cp.php".$ulr);
}
$array = $_POST["del_id"]; 
if(!empty($array)){
$del_sun=count($array); 
for($i=0;$i<$del_sun;$i++){
$type="where id=".$array[$i];
$nr=queryall(se2nr,$type);
$url=$nr[url];
$pic="../".$nr[pic];
$url_1 = $url;
$url_2 = explode('|',$url_1); 
$array2 = $url_2;
$count = count($url_2);
if ($count>1){
for($index=0;$index<$count;$index++) 
{ 
$url=$array2[$index];
$url=str_replace("http://".$host ,"..",$url);
unlink($url); 
}}else{
$url=str_replace("http://".$host ,"..",$url);
unlink($url); 
}
unlink($pic); 
$type="id=".$array[$i];
dbdel(se2nr,$type);
}
if ($fenlei || $page)
{echo "<script> alert('删除成功');location.href='cp.php?fenlei=".$fenlei."&page=".$page."'; </script>"; exit;}
else
{echo "<script> alert('删除成功');location.href='cp.php';</script>";exit; }
}
if($_POST[sub]){
$tuijian=$_POST[tuijian];
$shijian=$_POST[shijian];
$id=$_POST[id];
$type="tuijian='$tuijian',shijian='$shijian'  where id='$id'";
upalldt(se2nr,$type);
echo msglayerurl("设置成功，返回页面",5,"cp.php");
}
function fenlei($id)
{
    $fname=getone("select * from se2fl WHERE id=".$id);
    $return=$fname['name'];
	return $return;
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>视频管理</title>
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
<li class="layui-this"><?php if($dtid){?><a href="ly.php">返回上级</a><?php }else{?><a href="cp.php">视频管理</a><?php }?></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>
搜索：
<input id="name" name="name" style="width:150px;" type="text" value="" class="layui-input"> 分类: <select name="fenlei" >
<option value="" <?php if (empty($fenlei)){ echo "selected";}?>>视频分类</option>
<?php
$query = mysql_query("SELECT * FROM se2fl ");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>" <?php if ($fenlei==$a[id]){ echo "selected";}?>><?php echo $a[name]?></option>
<?php }?>
</select>

<select name="member" >
<option value="0"  <?php if ($member==0){ echo "selected";}?>>全部视频</option>
<option value="1"  <?php if ($member==1){ echo "selected";}?>>普通视频</option>
<option value="2"  <?php if ($member==2){ echo "selected";}?>>VIP视频</option>
</select>
<input type="submit" class="layui-btn" value="搜索" style="margin-left:15px;">
<input type="button" class="layui-btn" value="添加视频" onClick="location.href='add.php<?php if($dtid){echo "?id=".$dtid;}?>'">
  <span style="float:right;margin-top:15px;font-size:14px">共查询到<span id="total" style="color:red;"></span>条数据</span>
</td>
  </tr>
</table>
</form>

<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
 <tbody>
<tr class="color1">
<th width="4%" align="center">&nbsp;</th>
<th width="6%" align="center">缩略图</th>
<th align="left">资源名称</th>
<th width="10%" align="center">所属类型</th>
<th width="8%" align="center">播放次数</th>
<th width="8%" align="center">喜欢人数</th>
<th width="8%" align="center">收藏人数</th>
<th width="8%" align="center">动态条数</th>
<!--<th width="8%" align="center">播放时间</th>-->
<th width="8%" align="center">视频类型</th>
<th width="10%" align="center">添加时间</th>
<th width="12%" align="center">操作</th>
</tr>
<form id="form1" name="form1" method="post" action="?act=set_apply_jobs&page=<?php echo $page-1; ?>&fenlei=<?php echo $fenlei; ?>">
<?php 
$Page_size=10; 
if ($dtid)
{$sql = "WHERE division=1 and uid=".$dtid;}
else
{$sql = "WHERE 1=1";}

if($name){
$sql .=" and name like '%$name%' ";
}
if($fenlei){
$sql .=" and fenlei = '$fenlei'  ";
}
if($member==1||$member==2){
	$member=$member-1;
	$sql .=" and member = '$member' ";
}
$result = mysql_query("select id from se2nr ".$sql."  ");
if($result == 0){
echo '<tr class="color2"><td colspan=5 align="center">查询不到数据</td></tr>';
}
$count = mysql_num_rows($result);
//显示总条数到页面
echo "<script>var total = document.getElementById('total');total.innerHTML=".$count."</script>"; 
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
$query = mysql_query("select * from  se2nr   ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$division=$a[division];
$uid=$a[uid];
?> 	
<tr class="color2">
  <td align="center"><input type="checkbox" name="del_id[]" value="<?php echo $a['id']; ?>" id="del_id" /></td>
  <td align="center"><span style="background-image:url('<?php $pic=$a[pic]; $pic_c=substr_count($pic,'http'); if ($pic_c==1){echo $pic;}else{echo "/".$pic;}?>')" class="mt_simg" onClick="window.open('/play.php?playid=<?php echo $a[id]?>&ly=ubosk&zt=sh');"></span></td>
  <td align="left"><span style="margin-left:10px; line-height:40px; height:40px; overflow:hidden; width:90%; display:block;"><a href="/play.php?playid=<?php echo $a['id']; ?>&ly=ubosk&zt=sh" target="_blank"><?php echo $a[name];?></a></span></td>			
<td align="center"><?php $flname=fenlei($a[fenlei]); echo $flname;?></td>
<td align="center"><?php echo $a[cishu]?> 次</td>
<td align="center"><?php echo $a[hits]?> 人</td>
<td align="center"><?php echo $a[favorite]?> 人</td>
<td align="center"><?php echo $a[trends]?> 条</td>
<td align="center"><?php if ($a[member]=="0"){echo "普通视频";}else{echo "VIP视频";}?></td>
<!--<td align="center"><?php if ($a[shijian]=="0"){echo "未查看";}else{echo $a[shijian];}?></td>-->
<td align="center"><?php echo date('Y-m-d H:i',$a[addtime]);?></td>
<td align="center">
<?php if ($a[censor]>0){?><a href="?action=via&delid=<?php echo $a[id]?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete" style=" background-color:#77c;" target="msgubotj">通过</a>&nbsp;<?php }?><a href="zbdtgl.php?spid=<?php echo $a[id]?>" class="layui-btn layui-btn-mini ajax-delete">动态</a>&nbsp;<a href="cpedit.php?id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>&nbsp;<a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&delid=<?php 

echo $a[id]?>&division=<?php echo $division;?>&uid=<?php echo $uid;?><?php if($dtid){echo "&id=".$dtid;}?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"target="msgubotj">删除</a></td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<li>'; 
$key.="<a class=\"number\">当前第 $page 页/共 $pages 页</a></li>"; //第几页,共几页 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&fenlei=".$fenlei."&id=".$dtid."&page=1\">&laquo; 首页</a></li> "; //首页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&fenlei=".$fenlei."&id=".$dtid."&page=".($page-1)."\">&laquo; 上一页</a></li>"; //上一页 
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
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&fenlei=".$fenlei."&id=".$dtid."&page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&fenlei=".$fenlei."&id=".$dtid."&page=".($page+1)."\">下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?name=".$name."&fenlei=".$fenlei."&id=".$dtid."&page={$pages}\">最后一页 &raquo;</a></li>"; //最后一页 
}else { 
$key.=" <li><a >下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a>最后一页 &raquo;</a></li>"; //最后一页 
} 
$key.=''; 
?> 
<tr>
  <td colspan=18 style="padding-left:20px;" height="38"><label id="chkAll"><input class="demo--radioInput" style="margin:0;" type="checkbox" name="chkAll" id="chk" title="全选/反选" onClick="All(this, 'del_id[]')" />
  全选 </label> <input type="submit" name="jiesuan" value="一键删除" onClick="javascript:if(checkdel(del_id,'check')){return true;}else{return false;};" class="layui-btn" style="position:relative; height:26px; line-height:26px; margin-left:6px;" border="0"  target="msgubotj"></td>
</tr>
 </form>

<tr><td colspan=18><ul class="pagination"><?php echo $key?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>