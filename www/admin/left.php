<?php
$call=$_SERVER["REQUEST_URI"];
$call=parse_url($call);
$call=$call[path];
$call = substr ($call, strrpos($call,'/'), -4);
$call= substr ($call, 1); 
?>
<!--�����-->
<div class="layui-side layui-bg-black" id="menus_area">
<div class="layui-side-scroll">
<style type="text/css">
.menus_area{width:200px;height:auto !important;overflow:visible !important;position:fixed;height:100% !important;background-color:#393D49;color:#c2c2c2}
.menus_area li{line-height:33px;font-size:14px;color:#333;float:left;width:100%;}
.menus_area li ul{display:none;color:#666;padding:5px 0 5px 30px;}
.menus_area li ul li{float:none;background-image:none;height:26px;line-height:26px;margin-top:0px;font-size:12px;}
.menus_area li ul li a{padding-left:30px;display:block;color:#c2c2c2;line-height:20px;}
.menus_area li ul li a.cur{color: #fff;text-decoration:none;}
.menus_area li ul a:hover{color:#6fb600;}
.menus_area dt img{position:absolute;right:10px;top:20px;}
.menus_area dt{padding-left:40px;padding-right:10px;background-repeat:no-repeat;background-position:10px center;background-color: #393D49;color:#c2c2c2;font-size:14px;position:relative;line-height:48px;cursor:pointer;}
</style>
<div class="menus_area">
<ul class="clearfix" >
<li><dt><i class="fa fa-home"></i>   ����˵�<img src="images/select_xl01.png"></dt>
<ul  <?php if ($call=="home" or $call=="count"){?>style="display:block;" <?php }?> >               
<li><a href="home.php" <?php if ($call=="home"){?>class="cur"<?php }?>>��վ����</a></li>
<li><a href="count.php" <?php if ($call=="count"){?>class="cur"<?php }?>>��վͳ��</a></li>                    
</ul>
</li>
<li><dt><i class="fa fa-gears"></i>   ϵͳ����<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="gl"  or $call=="peizhi"  or $call=="admin"  or $call=="nav" or $call=="dsjfl" or $call=="zhifu" or $call=="laiyuan" or $call=="lb" or $call=="tulb" or $call=="hd" or $call=="ly"){?>style="display:block;" <?php }?>>               
<li><a href="gl.php" <?php if ($call=="gl"){?>class="cur"<?php }?>>��������</a></li>    
<li><a href="peizhi.php" <?php if ($call=="peizhi"){?>class="cur"<?php }?>>��Ա����</a></li>    
<li><a href="admin.php" <?php if ($call=="admin"){?>class="cur"<?php }?>>�����˻�</a></li>          
<li><a href="nav.php" <?php if ($call=="nav" ){?>class="cur"<?php }?>>��������</a></li>
<li><a href="zhifu.php" <?php if ($call=="zhifu" ){?>class="cur"<?php }?>>֧������</a></li>
<li><a href="lb.php" <?php if ($call=="lb" ){?>class="cur"<?php }?>>����༭</a></li>
<li><a href="ly.php" <?php if ($call=="ly" ){?>class="cur"<?php }?>>��������</a></li>
<li><a href="hd.php" <?php if ($call=="hd" ){?>class="cur"<?php }?>>�õ�����</a></li>
</ul>
</li>
<li><dt><i class="fa fa-bar-chart"></i>  ��������<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="jiesuan" or $call=="shuju"){?>style="display:block;" <?php }?> >               
<li><a href="shuju.php" <?php if ($call=="shuju"){?>class="cur"<?php }?>>�����б�</a></li>  
<li><a href="jiesuan.php" <?php if ($call=="jiesuan"){?>class="cur"<?php }?>>�������</a></li>              
</ul>
</li>
<li><dt><i class="fa fa-credit-card"></i> ��ֵ����<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="card"  or $call=="cardedit" or $call=="addcard" or $call=="terrace"){?>style="display:block;" <?php }?>>
<li><a href="terrace.php" <?php if ($call=="terrace"){?>class="cur"<?php }?>>ƽ̨����</a></li> 
<li><a href="card.php" <?php if ($call=="card" or $call=="cardedit" or $call=="addcard"){?>class="cur"<?php }?>>���ܹ���</a></li>               
</ul>
</li>
<li><dt><i class="fa fa-user"></i> ��Ա����<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="user"  or $call=="useredit" or $call=="adduser" ){?>style="display:block;" <?php }?>>
<li><a href="user.php" <?php if ($call=="user" or $call=="useredit" or $call=="adduser"){?>class="cur"<?php }?>>��Ա�б�</a></li>               
</ul>
</li>
<li><dt><i class="fa fa-video-camera"></i>  ý�����<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="cp" or $call=="add" or $call=="cpedit" or $call=="dygl" or $call=="dyadd" or $call=="dyedit" or $call=="dsjgl" or $call=="dsjadd" or $call=="dsjedit" or $call=="dmgl" or $call=="dmadd" or $call=="dsjedit" or $call=="dmgl" or $call=="dmadd" or $call=="dmedit" or $call=="zygl" or $call=="zyadd" or $call=="zyedit" or $call=="xc2" or $call=="xcadd" or $call=="xcedit"){?>style="display:block;" <?php }?>>               
<li><a href="cp.php" <?php if ($call=="cp" or $call=="add" or $call=="cpedit"){?>class="cur"<?php }?>>��Ƶ����</a></li>
</ul>
</li>
<li><dt><i class="fa fa-book"></i>  ��̬����<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="zbdtadd"  or $call=="zbdtdit" or $call=="zbdtgl"){?>style="display:block;" <?php }?>>
<li><a href="zbdtgl.php" <?php if ($call=="zbdtadd"  or $call=="zbdtdit" or $call=="zbdtgl"){?>class="cur"<?php }?>>��̬����</a></li>
<li><a href="idea.php" <?php if ($call=="idea" ){?>class="cur"<?php }?>>�������</a></li>
</ul>
</li>
<li><dt><i class="fa fa-feed"></i> ������<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="ad"  or $call=="adadd" or $call=="adedit" or $call=="adfl" or $call=="addm"){?>style="display:block;" <?php }?>>
<li><a href="adfl.php" <?php if ($call=="adfl"){?>class="cur"<?php }?>>���λ����</a></li>   
<li><a href="ad.php" <?php if ($call=="ad" or $call=="adadd" or $call=="adedit" or $call=="addm"){?>class="cur"<?php }?>>����б�</a></li>               
</ul>
</li>
</li>
<li><dt><i class="fa fa-sitemap"></i> ��������<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="distributor"  or $call=="distributor_list"  or $call=="distributor_base"){?>style="display:block;" <?php }?>>
<li><a href="distributor.php" <?php if ($call=="distributor"){?>class="cur"<?php }?>>������Ա</a></li>   
<li><a href="distributor_list.php" <?php if ($call=="distributor_list"){?>class="cur"<?php }?>>�����¼</a></li>     
<li><a href="distributor_base.php" <?php if ($call=="distributor_base"){?>class="cur"<?php }?>>�ֳ�����</a></li>          
</ul>
</li>
<li><dt><i class="fa fa-share-alt"></i> �ƹ����<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="share"  or $call=="share_list"){?>style="display:block;" <?php }?>>
<li><a href="share.php" <?php if ($call=="share"){?>class="cur"<?php }?>>�ƹ����</a></li>   
<li><a href="share_list.php" <?php if ($call=="share_list"){?>class="cur"<?php }?>>�ƹ��¼</a></li>               
</ul>
</li>
<li><dt><i class="fa fa-commenting"></i> ���۹���<img src="images/select_xl01.png"></dt>
<ul <?php if ($call=="pl" ){?>style="display:block;" <?php }?>>
<li><a href="pl.php" <?php if ($call=="pl"){?>class="cur"<?php }?>>�����б�</a></li>               
</ul>
</li>
</ul>
</div>
<script type="text/javascript">
$(function () {
$(".menus_area ul li").click(function(){
var thisSpan=$(this);
$(".menus_area ul li ul").prev("a").removeClass("cur");
$("ul", this).prev("a").addClass("cur");
$(this).children("ul").slideDown("fast");
$(this).siblings().children("ul").slideUp("fast");
})
});
</script>
</div>
</div>