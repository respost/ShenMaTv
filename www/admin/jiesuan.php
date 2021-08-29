<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$tzurl=$_SERVER["QUERY_STRING"];
$del=$_GET[action];
$delid=$_GET[delid];
if($del=="shtg"){
$id=$_GET[id];
$time=time();
$type="jiesuan='2',jsshijian='$time' where id=".$id;
upalldt(ubopayjs,$type);
echo msglayerurl("结算成功，返回页面",8,"jiesuan.php");
}
if($del=="del"){
$type="id='$delid'";
dbdel(ubopayjs,$type);
echo msglayerurl("删除成功，返回页面",8,"jiesuan.php?$tzurl");
}
$t1=date("Y-m-d");
$t2=date("Y-m-d",strtotime("-1 day"));
$userid=$_GET["userid"];
$btime=$_GET["btime"];
$etime=$_GET["etime"];

if($_POST[jiesuan]){
$array = $_POST["del_id"]; 
if(!empty($array)){
$del_sun=count($array); 
for($i=0;$i<$del_sun;$i++){
$sql='select * from ubopayjs where id='.$array[$i];
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
if(!empty($row['file'])){
if(unlink($row['file'])==false){
echo '';
exit;
}
}
date_default_timezone_set('PRC');
$time=time();
$shijian=date("Y-m-d H:i:s" ,time());
mysql_query("UPDATE  ubopayjs set jiesuan='2',jsshijian='$time'  where  id='$array[$i]'"); 
echo msglayerurl("提现成功，返回页面",4,"jiesuan.php");
}
echo('');
}else{ 
echo(""); 
}}


?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>提现审核</title>
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
<li class="layui-this"><a href="jiesuan.php">提现审核</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>会员ID：<input id="userid" name="userid" style="width:150px;" type="text" value="<?php if($userid==null){ }else{ echo $userid;}?>" class="layui-input"> 
开始时间：<input style="width:100px;" name="btime" id="btime" value="<?php if($btime==null){ echo date('Y-m-d',strtotime("-1 day"));}else{ echo $btime;}?>" class="layui-input">&nbsp;结束时间：<input style="width:100px;" name="etime" id="etime" value="<?php if($etime==null){ echo date('Y-m-d',strtotime("+1 day"));}else{ echo $etime;}?>" class="layui-input">&nbsp;<input type="submit" class="layui-btn" value="搜索"></td>
  </tr>
</table>
</form>
<SCRIPT language=javascript src="../app/laydate/laydate.js" charset="gb2312"></SCRIPT>
<script>
!function(){
laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
laydate({elem: '#btime'});//绑定元素
laydate({elem: '#etime'});//绑定元素
}();
</script>
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
<thead>
<tr>
<th align="center">今日提现金额</th>
<th align="center">昨日提现金额</th>
<th align="center">总提现金额</th>
<th align="center">提现审核中</th>
<th align="center">已提现</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$a="select sum(money) from ubopayjs ";
if ($res=mysql_query($a)){
list($zong)=mysql_fetch_row($res);
mysql_free_result($res);
} 

$b="select sum(money) from ubopayjs   WHERE   jsshijian like '%".$t1."%'";
if ($res=mysql_query($b)){
list($day)=mysql_fetch_row($res);
mysql_free_result($res);
} 
$c="select sum(money) from ubopayjs   WHERE   jsshijian like '%".$t2."%' ";
if ($res=mysql_query($c)){
list($zuori)=mysql_fetch_row($res);
mysql_free_result($res);
} 
$sql = mysql_query("SELECT * FROM ubopayjs WHERE  jiesuan=2");
$yjs = mysql_num_rows($sql);
$sql = mysql_query("SELECT * FROM ubopayjs WHERE  jiesuan=1");
$js = mysql_num_rows($sql);
?>
<td align="center">￥ <?php if($day==null){?>0<?php }else{?> <?php echo round($day,2);?><?php }?> 元</td>
<td align="center">￥ <?php if($zuori==null){?>0<?php }else{?> <?php echo round($zuori,2);?><?php }?> 元</td>

<td align="center">￥ <?php if($zong==null){?>0<?php }else{?> <?php echo round($zong,2);?><?php }?> 元</td>
<td align="center"><?php if($js==null){?>0<?php }else{?><?php echo $js?><?php }?> 笔</td>
<td align="center"><?php if($yjs==null){?>0<?php }else{?><?php echo $yjs?><?php }?> 笔</td>
</tr>
</tbody>
</table>
<table width=100% border="1" cellspacing="0" cellpadding="0" class="layui-table" style="margin-top:6px;">
<tbody>
<tr class="color1">
<th align="center">选择</th>
<th align="center">会员号</th>
<th align="center">收款人</th>
<th align="center">支付宝</th>
<th align="center">提现金额</th>
<th align="center">提现时间</th>
<th align="center">结算时间</th>
<th align="center">结算状态</th>
<th align="center">管理操作</th>
</tr>
<?php 
$Page_size=8; 
$sql = "WHERE 1=1";
if($userid){
$sql .=" and   pid like '%$userid%'   and jsshijian between '$btime' and '$etime'";
}
$result = mysql_query("select id from ubopayjs  ".$sql."");
if($result == 0){
echo '<tr class="color2"><td colspan=12 align="center">查询不到数据</td></tr>';
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
$query = mysql_query("select * from ubopayjs ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
?> <FORM action="" method="post" target="msgubotj">
<tr class="color2">
<td align="center"><input type="checkbox" title="<?php echo $a['id']; ?>" name="del_id[]" value="<?php echo $a['id']; ?>" id="del_id" />ID:<?php echo $a[id]?></td>
<td align="center"><?php echo $a[user]?></td>
<td align="center"><?php echo $a[alipayname]?></td>
<td align="center"><?php echo $a[alipay]?></td>
<td align="center">￥ <?php echo $a[money]*0.95?> 元</td>
<td align="center"><?php echo date('Y-m-d H:i:s',$a[sqshijian]);?></td>
<td align="center"><?php if ($a[jsshijian]==0){echo "--";}else{echo date('Y-m-d H:i:s',$a[jsshijian]);}?></td>
<td align="center"><?php if ($a[jiesuan]==1){echo "待结算";}else{echo "已结算";}?></td>
<td align="center"><?php $status=$a[jiesuan]; if ($status==1){?><a href="?action=shtg&id=<?php echo $a[id]?>" class="layui-btn layui-btn-normal layui-btn-mini"  target="msgubotj">结算</a>&nbsp;<?php }?><a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"  target="msgubotj">删除</a></td>
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
<tr>
  <td colspan=18 style="padding-left:20px;" height="38"><label id="chkAll"><input class="demo--radioInput" style="margin:0;" type="checkbox" name="chkAll" id="chk" title="全选/反选" onClick="All(this, 'del_id[]')" /> 全选 </label> <input class="layui-btn" style="position:relative; height:26px; line-height:26px; margin-left:6px;"  type="submit" name="jiesuan" value="一键提现" onclick="return window.confirm('您确定要一键提现所有吗?');javascript:if(checkdel(del_id,'check')){return true;}else{return false;};"  border="0"  target="msgubotj"/></td>
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