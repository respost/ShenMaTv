<?php
error_reporting(0); 
if($_COOKIE[adminname]==null){
echo "<script>alert('管理身份已失效请重新登录!')</script><script>location.href='index.php'</script>";
exit;
}
include("../config/conn.php");
include("../config/common.php");
if($_POST[add]){
if($_POST[type]==null){
echo msglayer("请先设置会员类型！",3);
}elseif($_POST[terrace]==null){
echo msglayer("请先设置所属平台！",3);
}else{
function random($length, $chars) {
$hash = '';
$max = strlen($chars) - 1;
for($i = 0; $i < $length; $i++) {
$hash .= $chars[mt_rand(0, $max)];
}
return $hash;
}

$number=intval($_POST[number]); 
$time=time();
$terrace=intval($_POST[terrace]);
$type=intval($_POST[type]);
$ter_2=getone("select * from uboterrace WHERE small_id=".$terrace." and type=".$type);
if ($ter_2){
$serve=$ter_2[name];
$serve_id=$ter_2[id];
}
$ter_1=getone("select * from uboterrace WHERE id=".$terrace);
if ($ter_1){
$terrace=$ter_1[name];
$terrace_id=$ter_1[id];
}
$hy=getone("select * from ubozf WHERE id=1");
if ($hy)
{
$money1=$hy[money1];
$money2=$hy[money2];
$money3=$hy[money3];
$money4=$hy[money4];
}
if ($type==1){$money=$money1;}elseif ($type==2){$money=$money2;}elseif ($type===3){$money=$money3;}elseif ($type==4){$money=$money4;}
for($i=0;$i<$number;$i++){
//$user=random(6, '0123456789');
$user=getRandNumber();
$pass=makeCardPassword();
$type="(`id`, `user`, `pass`,`money`, `serve`, `serve_id`, `kstime`,`terrace`,`terrace_id`,`status`) VALUES (null,'$user','$pass','$money','$serve','$serve_id','$time','$terrace','$terrace_id','0')";
dbinsert(ubocard,$type);
}
echo msglayerurl("成功生成".$number."张，返回页面",5,"card.php");
}
}

/**
?*?生成不重复的随机数字
?*?@param??int?$start??需要生成的数字开始范围
?*?@param??int?$end????结束范围
?*?@param??int?$length?需要生成的随机数个数
?*?@return?number??????生成的随机数
?*/
function getRandNumber($start=0,$end=9,$length=8){
	//初始化变量为0
	$connt = 0;
	//建一个新数组
	$temp = array();
	while($connt < $length){
	//在一定范围内随机生成一个数放入数组中
	$temp[] = mt_rand($start, $end);
	//$data = array_unique($temp);
	//去除数组中的重复值用了“翻翻法”，就是用array_flip()把数组的key和value交换两次。这种做法比用 array_unique() 快得多。	
	$data = array_flip(array_flip($temp));
	//将数组的数量存入变量count中	
	$connt = count($data);
	}
	//为数组赋予新的键名
	shuffle($data);
	//数组转字符串
	$str=implode(",", $data);
	//替换掉逗号
	$number=str_replace(',', '', $str);
	return $number;
}
//随机生成不重复的8位卡密
function makeCardPassword() {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
            .strtoupper(dechex(date('m')))
            .date('d').substr(time(),-5)
            .substr(microtime(),2,5)
            .sprintf('%02d',rand(0,99));
        for(
            $a = md5( $rand, true ),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 8;
            $g = ord( $a[ $f ] ),
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
            $f++
        );
        return  $d;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="gb2312">
<title>生成卡密</title>
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
<li class="layui-this"><a href="javascript:history.go(-1);">生成卡密</a></li>
</ul>
<div class="layui-tab-content">
<div class="layui-tab-item layui-show">
<form action="" method="post" target="msgubotj">	
<table width="100%" class="layui-table" cellspacing="0" cellpadding="0">
<tbody>
<tr class="color2">
  <td width="100"><p align="left"><b>会员类型</b></p></td>
  <td height="38"><p><?php
$hy=getone("select * from ubozf WHERE id=1");
if ($hy)
{
$member1=$hy[member1];
$member2=$hy[member2];
$member3=$hy[member3];
$member4=$hy[member4];
} ?><select name="type" style="margin:0px">
<option value="1"><?php echo $member1;?></option>
<option value="2"><?php echo $member2;?></option>
<option value="3"><?php echo $member3;?></option>
<option value="4"><?php echo $member4;?></option>
</select></p></td>
</tr>
<tr class="color2">
  <td><p align="left"><b>所属平台</b></p></td>
  <td height="38"><p><select name="terrace" style="margin:0px">
<?php
$query = mysql_query("SELECT * FROM uboterrace where small_id=0 order by sort desc");
while($a = mysql_fetch_array($query)) {?>
<option value="<?php echo $a[id]?>" ><?php echo $a[name]?></option>
<?php }?>
</select></p></td>
</tr>
<tr class="color2">
  <td><p align="left"><b>生成数量</b></p></td>
  <td height="38"><p><select name="number" style="margin:0px"><?php for ($x=1; $x<=10; $x++) {?><option value="<?php echo $x;?>0"><?php echo $x;?>0&nbsp;张</option><?php }?></select></p></td>
</tr>


</tbody>
</table>
<p>
<br><input type="submit" class="layui-btn" value="保存" id="btnPost"  name= "add"   >
</p>
</form>
</div>
</div>
</div>
</div>
<?php include_once('foot.php'); ?> 
</div>
</html>
