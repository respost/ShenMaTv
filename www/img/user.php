<?php
error_reporting(0); 
include("os.php");
include("config/common.php");
include("config/conn.php");
$i=rand(1,40);
$cishu=rand(1,10000);
$ip=$_SERVER["REMOTE_ADDR"];
$type="where ip='$ip'";
$user=queryall(uboip,$type);
$pid=$user[pid];
$uid=$user[uid];
$userid=$_COOKIE[userid];
if($userid==null){
echo "<script>location.href='login.php'</script>";
exit;
}else{
$type="where user='$userid'";
$neirong=queryall(ubouser,$type);
$tdate3=date("Y-m-d")." 00:00:01";
$tdate4=date("Y-m-d")." 23:59:59";
$settr3=strtotime($tdate3);
$settr4=strtotime($tdate4);
$dqtime=$neirong[dqtime];
$money=$neirong[money];
if (($dqtime>$settr3) && ($dqtime<$settr4))
{$qdpd="1";}else{$qdpd="0";}
?>
<!DOCTYPE html>
<html>
<head>
<title>��Ա����</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<meta name="format-detection" content="telephone=no">
<?php include_once('css.php'); ?> 
<style>
.open_vip{
background-color: lightcyan;;
}
.ui-border li i em{
font-size: 0.75rem;
}
.aboutpic li{
margin-top: 0.6rem
}
.aboutpic li i img{
width: 2.5rem;
height: 2.5rem;
}
</style>
</head>
<body>
<div id="head" >
<div class="fixtop">
<span id="home"><a href="/" rel="external"><i class="ico08"><img src="/img/homepage.png" width="30px" /></i></a></span>
<span id="index"><i class="ico07"><img src="/img/logo.png" width="88px" class="h" /></i></span><i class="ico21">��Ա����</i>
<span id="find"><i class="ico08"><img src="/img/ss1.png" width="29px" /></i></span>
</div>
<ul class="head-nav">
<a href="vod_list.php?m=new" rel="external"><li>���ո���</li></a>
<a href="vod_list.php?flid=4" rel="external"><li>��Ů����</li></a>
<a href="vod_list.php?flid=3" rel="external"><li>������Ƶ</li></a>
<a href="vod_list.php?flid=6" rel="external"><li>��Ц�̾�</li></a>
<a href="img_list.php" rel="external"><li>�Ը�д��</li></a>
</ul>
<div id="nav" class="view currents out">
<div id="search-box">
<form method="get" action="vod_list.php" data-ajax="false" id="search-form">
<div class="box-search">
<span class="icon-search icon"></span>
<input x-webkit-speech type="text"  placeholder="��������Ƶ�ؼ���" autocomplete="off" value="" name="k" id="k"/>
</div>
<div class="search_submit"><button type="submit" >
<i class="ico01"></i>����
</button>
</div>
</form>
</div>
<ul class="nav-list">
<?php 
$query = mysql_query("SELECT * FROM se2fl limit 6 ");
while($a = mysql_fetch_array($query)) {?>			
<a href="vod_list.php?flid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
<?php
$query = mysql_query("SELECT * FROM se2tufl order by id limit 12 ");
while($a = mysql_fetch_array($query)) {?>
<a href="/img_list.php?tid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
</ul>
</div>
</div>
<header id="header" class="ui-header ui-header-positive ui-border-b" >
<h1><?php if($user[ms]=="�ƽ��Ա"){?>�ƽ��Ա<?php }elseif($user[ms]=="���û�Ա"){?>��ʯ��Ա<?php }?></h1>
</header>
<div class="login" style=" margin-top:40px;"><div class="ui-avatar"><span style="background-image:url(img/pl/<?php echo $i?>.jpg)"></span></div>
<div class="login_t">
<h3><span style="color:#0180cf">��ӭ�� </span> , <?php echo $userid;?></h3>
<span class="login_lj" style="font-size:14px;">���ý�ң�<font color="red" size="3"><?php echo $money;?></font> ��</span>
<span class="login_lj"><p style="margin:5px 0;">��Ա����<font color="red">ע���Ա</font>&nbsp;</p></span> </div>
</div>
<?php if(1==2){?>
<section class="kaitong"> <a href="http://m.jjrsp.com/index.php/user/pay/group">
<li> <span class="mui-icon myFont-Icon t1 l"></span>
<h2 class="t2 l">����VIP</h2>
<span class="r login_yj"> &gt; </span>
</li>
<div class="clear"></div>
<li class="xian" style="padding-top:5px;"> <span class="t4">VIP�û���Ч����ȫվ���徫�����������⿴~��</span> </li>
</a> 
</section>
<?php }?>
<section class="jilu" style="margin-top: 2.2%; padding-top:3.8%;">
<a href="user_edit.php">
<li>
</li><li><span class="t5 l"><img src="/img/zlxg.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">�����޸�</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="qd.php">
<li>
</li><li><span class="t5 l"><img src="/img/qiandao.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;" id="qd"><?php if ($qdpd==1){echo '������ǩ��';}else{echo 'ǩ������';}?></h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="scj.php">
<li>
</li><li><span class="t5 l"><img src="/img/scj.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">�ҵ��ղ�</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<?php if(1==2){?>
<a href="http://m.jjrsp.com/index.php/user/pay">
<li>
</li><li><span class="t5 l"><img src="/img/jifen.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">��Ա��ֵ</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="http://m.jjrsp.com/index.php/user/pay/lists">
<li>
</li><li><span class="t5 l"><img src="/img/cwjl.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">�����¼</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="http://m.jjrsp.com/index.php/user/share">
<li>
</li><li><span class="t5 l"><img src="/img/xzfx.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">��������</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<a href="http://m.jjrsp.com/index.php/vod/user/fav">
<li>
</li><li><span class="t5 l"><img src="/img/shipin.png" width="17" height="17"></span>
<h2 class="t2 l" style="padding-top:1.5%;">�ҵ���Ƶ</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
<?php }?>
<a href="logout.php?out=out">
<li>
</li><li><span class="t5 l"><img src="/img/tui.png" width="19" height="19"></span>
<h2 class="t2 l" style="padding-top:1.5%;">�˳���¼</h2>
<span class="r login_yj"> &gt; </span>
</li>
</a>
</section>
<section class="ui-panel" style="background-color: white">
<h3 style="text-align: center;line-height: 40px!important;"><span>��Ա��Ȩ</span></h3>
<ul class="ui-tiled ui-border-t aboutpic">
<li><i class="ui-icon-zy"><img src="img/about_zy.png"></i>����Ƭ��</li>
<li><i class="ui-icon-tp"><img src="img/about_tp.png"></i>����ͼ��</li>
<li><i class="ui-icon-hd"><img src="img/about_hd.png"></i>����ר��</li>
<li><i class="ui-icon-kf"><img src="img/about_kf.png"></i>��Ů�ͷ�</li>
</ul>
</section>

<section class="ui-panel" style="background-color: white">
<div class="about">
<h3>��������</h3>
<p>1��һ���ƶ��ͻ����û������ز����
<span><?php echo $t?></span>���ʱ������Ϊ�Ѿ���ϸ�Ķ��������ȫͬ�⡣�����κη�ʽ��½��վ����ֱ�ӡ����ʹ�ñ�վ�����ߣ�������Ϊ��Ը���ܱ���վ����������û�����Э���Լ����</p>
<p>2��<?php echo $t?>ת�ص����ݲ�������
<span><?php echo $t?></span>֮������۵㣬Ҳ����ζ�ű�վ��ͬ��۵��֤ʵ�����ݵ���ʵ�ԡ�</p>
<p>3��
<span><?php echo $t?></span>ת�ص����֡�ͼƬ������Ƶ�����Ͼ��ɱ�վ�û��ṩ������ʵ�ԡ�׼ȷ�ԺͺϷ�������Ϣ�����˸���
<span><?php echo $t?></span>���ṩ�κα�֤�������е��κη������Ρ�</p>
<p>4��
<span><?php echo $t?></span>��ת�ص����֡�ͼƬ������Ƶ�����ϣ�����ַ��˵�������֪ʶ��Ȩ������Ȩ�������������߻�ת���߱��˳е�����վ�Դ˲��е����Ρ�</p>
<p>
<br></p>
<p>
<br></p>
<details>
<summary style="text-align:right;color:#225599;font-size:12px">��ʾ����</summary>
<p>5��
<span><?php echo $t?></span>����֤Ϊ���û��ṩ���������õ��ⲿ���ӵ�׼ȷ�Ժ������ԣ�ͬʱ�����ڸ��ⲿ����ָ��Ĳ���
<span><?php echo $t?></span>ʵ�ʿ��Ƶ��κ���ҳ�ϵ����ݣ�
<span><?php echo $t?></span>���е��κ����Ρ�</p>
<p>6���û���ȷ��ͬ����ʹ��
<span><?php echo $t?></span>������������ڵķ��ս���ȫ���䱾�˳е�������ʹ��
<span><?php echo $t?></span>��������������һ�к��Ҳ���䱾�˳е���
<span><?php echo $t?></span>�Դ˲��е��κ����Ρ�</p>
<p>7����
<span><?php echo $t?></span>ע��֮���������⣬�����򲻵�ʹ�ñ�վ�����µ��κ����⡢�������Լ�ٻ����̰�����Ȩ������֪ʶ��Ȩ�ַ���������ɵ��κ���ʧ��
<span><?php echo $t?></span>�Ų������಻�е��κη������Ρ�</p>
<p>8�������򲻿ɿ�������ڿ͹�����ͨѶ��·�жϵ�
<span><?php echo $t?></span>���ܿ��Ƶ�ԭ����ɵ���������жϻ�����ȱ�ݣ������û���������ʹ��
<span><?php echo $t?></span>��
<span><?php echo $t?></span>���е��κ����Σ���������������˸��û���ɵ���ʧ��Ӱ�졣</p>
<p>9��������δ�漰��������μ������йط��ɷ��棬��������������йط��ɷ����ͻʱ���Թ��ҷ��ɷ���Ϊ׼��</p>
<p>10������վ���������Ȩ�����޸�Ȩ������Ȩ�����ս���Ȩ����
<span><?php echo $t?></span>���С�</p>
<p>
<br></p>
<p>
<br></p>
</details>
<h3>ʹ�ð���</h3>
<p>��һ�����û����Զ�ӰƬ�����Կ����Կ���Ϻ���Ҫ��Ϊ��Ա������Ա���ĳ�ֵ��</p>
<p>�ڶ�������ֵ�ɹ���Ϊ��Ա����Զ��ص���ҳ��</p>
<p>����������Ϊ��Ա�󣬻ص���ҳ���ڿ��Խ����������ҳ�������ӰƬ��</p>
<!--<a href="javascript:login()">��¼</a>--></div>
</section>
<?php include_once('foot.php'); ?> 
<footer id="footer" class="ui-footer ui-footer-stable ui-border-t">
<ul class="ui-tiled ui-border-t">
<li onClick="ubourl('/')"><i class="ui-icon-index"></i>��&nbsp;&nbsp;ҳ</li>
<li onClick="ubourl('vod_list.php')" ><i class="ui-icon-sp"></i>��Ƶ��</li>
<li onClick="ubourl('img_list.php')" ><i class="ui-icon-tp"></i>��ͼ��</li>
<li  onclick="ubourl('user.php')" class="active"><i class="ui-icon-user2"></i>��Ա����</li>
</ul>
</footer>
</body>
</html>
<?php }?> 