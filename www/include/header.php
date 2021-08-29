<div class="header">
  <div class="head"><div class="toolbar"><div class="top-nav w980"><p class="top-txt fl"><a href="<?php echo $lujing?>" target="_blank"><?php echo $title ?></a> 欢迎光临<?php echo $title ?>，祝你看得开心！</p><div id="userlogin" style="display:block">
<?php if($cook==null){?>
<p class="other-links fr"><span> <a href="javascript:void(0)" onclick="AddFavorite(true)" style="margin-right:6px;">加入收藏夹</a><a onclick="SetHome(window.location)" href="javascript:void(0)" style="margin-right:6px;">设为首页</a><a href="http://<?php echo $wap;?>" target="_blank" style="margin-right:6px;">手机版</a><span class="dl"><a href="#" class="whi">登录</a></span>  / <a href="/index.php?m=user&amp;a=register" class="whi">免费注册</a></span><span>|</span><span><a class="vip pay-trigger" data-target="0" href="#">开通VIP</a></span></p>
<?php }else{?>
<p class="other-links fr"><span> <a href="javascript:void(0)" onclick="AddFavorite(true)" style="margin-right:6px;">加入收藏夹</a><a onclick="SetHome(window.location)" href="javascript:void(0)" style="margin-right:6px;">设为首页</a><a href="http://<?php echo $wap;?>" target="_blank" style="margin-right:6px;">手机版</a><a href="#" class="whi">会员中心</a></span><span>|</span><span><a href="logout.php?out=out">退出登录</a></span></p>
</div>
<?php }?>
</div>
</div></div><div class="logo"><h1><a title="<?php echo $title ?>" href="<?php echo $lujing?>"><img src="/img/logo.png"></a></h1><div class="links fr"></div><div class="search_box"><form method="get" action="/list.php" onsubmit="return search_submit();"><input x-webkit-speech="" name="k" id="keywords" value="" class="text"><button type="submit" value="" class="btn2">搜视频</button></form></div></div>

<div id="head_nav">
<div class="area clearfix">
<div class="left_nav">
<?php if($pdid==null){ ?>
<a class="fl on" href="<?php echo $lujing?>" _hover-ignore="1">首页<i></i></a><span class="sep">|</span>
<?php }else{  ?>
<a class="fl" href="<?php echo $lujing?>" _hover-ignore="1">首页<i></i></a><span class="sep">|</span>
<?php } 
$query = mysql_query("SELECT * FROM se2fl   limit 6 ");
while($a = mysql_fetch_array($query)) {?>
<a href='list.php?flid=<?php echo $a[id]?>' <?php if($pdid==$a[id] || $fenlei==$a[id]){ ?>class="fl on"<?php }else{  ?>class="fl"<?php }  ?> _hover-ignore="1"><?php echo $a[name]?><i></i></a><span class="sep">|</span>
<?php }?>
</div><ul class="fr"><li class="sign_panel"><div class="left_nav" style="float:right"><a href="idea.php" class="signin sign_btn signin normal-a dosign"><em></em>意见反馈<i></i></a></div></li></ul><div class="sep" style="float:right">|</div><div class="left_nav" style="float:right"><a href="#" class="fl">影视剧场</a></div></div></div></div>

<div class="jiu-nav-main" _hover-ignore="1"><div class="jiu-nav w980"><div class="nav-item fl"><div class="item-list">
<ul>
<li><a href="#" <?php if(empty($tid)){ ?>class="active"<?php }  ?>>全部</a></li>
<li><a href="#" title="科幻片" >科幻片</a></li>
<li><a href="#" title="动作片" >动作片</a></li>
<li><a href="#" title="恐怖片" >恐怖片</a></li>
<li><a href="#" title="喜剧片" >喜剧片</a></li>
<li><a href="#" title="爱情片" >爱情片</a></li>
<li><a href="#" title="剧情片" >剧情片</a></li>
<li><a href="#" title="战争片" >战争片</a></li>
<?php
$tdate=date("Y-m-d")." 00:00:01";
$tdate2=date("Y-m-d")." 23:59:59";
$settr1=strtotime($tdate);
$settr3=strtotime($tdate2);
$total=mysql_query("SELECT COUNT(*) AS num FROM se2nr where member='0' and addtime>= ".$settr1." and addtime<= ".$settr3);
$row=mysql_fetch_array($total);
$xsptj=$row[0];
$total2=mysql_query("SELECT COUNT(*) AS num FROM se2tunr where shijian>= ".$settr1." and shijian<= ".$settr3);
$row2=mysql_fetch_array($total2);
$xmttj=$row2[0];
?>   
</ul></div></div><div class="nav-other fl"><ul><li><a href="list.php?m=new"><i class="today"></i><span>今日视频</span></a><em><?php echo $xsptj;?></em></li><li><a href="/tuku/list.php?m=new"><i class="tw"></i><span>今日美图</span></a><em><?php echo $xmttj;?></em></li></ul></div><div class="n_h"><span>排序：</span><a href="list.php<?php if ($pdid){echo '?flid='.$pdid;} if($m){echo '?m=new';}?>" <?php if (empty($sort) || $sort=='default'){echo 'class="active"';}?>>默认</a><a href="list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=new" <?php if ($sort=='new'){echo 'class="active"';}?>>最新</a><a href="list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=heat" <?php if ($sort=='heat'){echo 'class="active"';}?>>人气</a><a href="list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=price" <?php if ($sort=='price'){echo 'class="active"';}?>>金币</a><a href="list.php?<?php if ($pdid){echo 'flid='.$pdid.'&';} if($m){echo 'm=new&';}?>sort=hot" <?php if ($sort=='hot'){echo 'class="active"';}?>>点赞</a></div></div></div>

</div> 