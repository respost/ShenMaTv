<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
$tzurl=$_SERVER["QUERY_STRING"];
$action=$_GET[action];
$delid=$_GET[delid];
$id=$_GET[id];
$time=time();
if($action=="del"){
$type="id='$delid'";
dbdel(ubotj,$type);
echo msglayerurl("删除成功，返回页面",8,"shuju.php?$tzurl");
}
if($action=="qrdz"){
    $ddnr=getone("select * from ubotj WHERE id=".$id);
    $hylx=$ddnr['leixing'];
	$uid=$ddnr['uid'];
	$hqzt=$ddnr['ddzt'];
    $money=$ddnr[money];
$ddzt=3;
if ($hylx==5 && $hqzt<2)
{
$ddzt=2;
$type="money=money+$money where id='$uid'";
upalldt(ubouser,$type);
$type="ddzt='$ddzt' where id='$id'";
upalldt(ubotj,$type);
}elseif ($hylx<5 && $hqzt<2){
$ddzt=2;
$time=time();
$info=getone("select * from ubouser WHERE id=".$uid);
$oldendtime=$info['endtime'];
$hy=getone("select * from ubozf WHERE id=1");
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
$hytime1=$hy[hytime1];
$hytime2=$hy[hytime2];
$hytime3=$hy[hytime3];
$hytime4=$hy[hytime4];
if ($hylx==1){echo $hymc=$member1;$days=$hytime1;}elseif ($hylx==2){echo $hymc=$member2;$days=$hytime2;}elseif ($hylx==3){echo $hymc=$member3;$days=$hytime3;}elseif ($hylx==4){echo $hymc=$member4;$days=$hytime4;}
if ($oldendtime<$time)
{$oldendtime=0;}
$endtime=strtotime("".intval($days)." days",$oldendtime==0?time():$oldendtime);
$endtimexx=date("Y-m-d",strtotime($yxqx." day"))." 23:59:59";
$endtimexx=strtotime($endtime);
$type="hylx='$hylx',hymc='$hymc',kstime='$time',endtime='$endtime' where id='$uid'";
upalldt(ubouser,$type);
$type="ddzt='$ddzt' where id='$id'";
upalldt(ubotj,$type);
}
echo msglayerurl("操作成功，返回页面",8,"shuju.php?$tzurl");
}
if($action=="swdz"){
$ddzt=3;
$type="ddzt='$ddzt' where id='$id'";
upalldt(ubotj,$type);
echo msglayerurl("操作成功，返回页面",8,"shuju.php?$tzurl");
}
$userid=$_GET["userid"];
$btime=$_GET["btime"];
$etime=$_GET["etime"];
function user($id)
{
    $name=getone("select * from ubouser WHERE id=".$id);
    $return=$name['user'];
	return $return;
	}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>订单管理</title>
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
<li class="layui-this"><a href="shuju.php">订单列表</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form class="search" method="get" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="layui-table">
  <tr>
    <td>会员ID：<input id="userid" name="userid" style="width:150px;" type="text" value="<?php if($userid==null){ }else{ echo $userid;}?>" class="layui-input"> 
开始时间：<input style="width:100px;" name="btime" id="btime" value="<?php if($btime){ echo $btime;}?>" class="layui-input">&nbsp;结束时间：<input style="width:100px;" name="etime" id="etime" value="<?php if($etime){ echo $etime;}?>" class="layui-input">&nbsp;订单状态: <select name="ztcx" style="margin:0px;">
<option value="" <?php $ztcx=$_GET[ztcx]; if ($ztcx==0){ echo "selected";}?>>选择状态</option>
<option value="1" <?php if ($ztcx==1){ echo "selected";}?>>未支付</option>
<option value="2" <?php if ($ztcx==2){ echo "selected";}?>>已支付</option>
<option value="3" <?php if ($ztcx==3){ echo "selected";}?>>已完成</option>
</select>&nbsp;&nbsp;<input type="submit" class="layui-btn" value="搜索"></td>
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
 <tbody>
<tr class="color1">
<th><div align="center">订单ID</div></th>
<th><div align="center">会员号</div></th>
<th><div align="center">付款金额</div></th>

<th><div align="center">付款方式</div></th>
<th><div align="center">订单号</div></th>
<th><div align="center">商品名称</div></th>
<th><div align="center">付款时间</div></th>
<th><div align="center">订单状态</div></th>
<th><div align="center">操作</div></th>
</tr>
<?php 
$Page_size=16; 
$sql = "WHERE 1=1";
$ztcx=$_GET[ztcx];
if($userid || $btime || $ztcx){
$btime=strtotime($btime);
$etime=strtotime($etime);
if ($userid)
{$sql .=" and uid='$userid'";}
if ($ztcx)
{
if ($ztcx=='1'){$ztcx2="0";}
if ($ztcx=='2'){$ztcx2="1";}
if ($ztcx=='3'){$ztcx2="2";}
$sql .=" and ddzt='$ztcx2'";
}
if ($btime && $etime)
{
$sql .=" and (addtime>$btime and addtime<$etime)";
}
}
$result = mysql_query("select id from ubotj ".$sql."");
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
$query = mysql_query("select * from ubotj ".$sql." order by id desc   limit $offset, $Page_size");
while ($a=mysql_fetch_array($query)) { 
$sctime=date('Y-m-d H:i',$a[addtime]);
$leixing=$a[leixing];
$pid=$a[pid];
$ddzt=$a[ddzt];
$money=$a[money];
$zffs=$a[zffs];
?> 

<tr class="color2">
<td align="center" height="24"><?php echo $a[id]?></td>
<td align="center"><?php $name=user($a[uid]); echo $name;?></td>
<td align="center">￥<?php echo $money?>元</td>
<td align="center"><?php if ($zffs==1){echo "微信支付";}elseif ($zffs==2){echo "支付宝";}elseif ($zffs==3){echo "卡密支付";}else{echo "余额扣除";}?></td>
<td align="center"><?php echo $pid;?></td>
<td align="center"><?php if ($leixing==1){echo "VIP青铜会员";}elseif ($leixing==2){echo "VIP白银会员";}elseif ($leixing==3){echo "VIP黄金会员";}elseif ($leixing==4){echo "VIP钻石会员";}else{echo "金币充值";}?></td>
<td align="center"><?php echo $sctime;?></td>
<td align="center"><?php if ($ddzt==0){echo "未支付";}elseif ($ddzt==1){echo "已支付";}elseif ($ddzt==2){echo "成功";}elseif ($ddzt==3){echo "失败";}?></td>
<td align="center"><?php if ($ddzt==1 || $ddzt==0){?><a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=qrdz&id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-normal layui-btn-mini"  target="msgubotj">确认到账</a><?php }?><?php if ($ddzt==1){?><a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=swdz&id=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"  target="msgubotj">尚未到账</a><?php }?><?php if ($ddzt==0){?><a onClick="return window.confirm(&quot;单击“确定”继续。单击“取消”停止。&quot;);" href="?action=del&delid=<?php echo $a[id]?>&page=<?php echo $page?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete"  target="msgubotj">删除订单</a><?php }?><?php if ($ddzt==2){?>交易成功<?php }elseif ($ddzt==3){?>交易失败<?php }?></td>
</tr>
<?php 
} 
$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数 
$pageoffset = ($page_len-1)/2;//页码个数左右偏移量 
$key='<li>'; 
$key.="<a class=\"number\">当前第 $page 页/共 $pages 页</a></li>"; //第几页,共几页 
if($page!=1){ 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=1\">&laquo; 首页</a></li> "; //首页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=".($page-1)."\">&laquo; 上一页</a></li>"; //上一页 
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
$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=".$i."\">".$i."</a></li>"; 
} 
} 
if($page!=$pages){ 

$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page=".($page+1)."\">下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?userid=".$_GET['userid']."&btime=".$_GET['btime']."&etime=".$_GET['etime']."&ztcx=".$_GET['ztcx']."&page={$pages}\">最后一页 &raquo;</a></li>"; //最后一页 
}else { 
$key.=" <li><a >下一页 &raquo;</a></li> ";//下一页 
$key.="<li><a>最后一页 &raquo;</a></li>"; //最后一页 
} 
$key.=''; 
?> 
<tr><td colspan=16><ul class="pagination"><?php echo $key;?></ul></td></tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>