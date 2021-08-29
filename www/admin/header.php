<!--头部文件-->
<?php 
$adminname=$_COOKIE[adminname];
$type="where id='1'";
$wangzhan=queryall(se2wz,$type);
$title=$wangzhan[title];
$keywords=$wangzhan[keywords];
$description=$wangzhan[description];
$lujing=$wangzhan[lujing];
?>
<!--头部-->
<div class="layui-header header">
<a href=""><img class="logo" src="images/logo.png" alt=""></a>
<div class="user-action">
<a href="admin.php">管理员：<?php echo $_COOKIE[adminname]?></a>
<a href="<?php echo $lujing?>" target="_blank">站点首页</a>
<a href="gl.php" >配置</a>
<a class="" href="quit.php?out=out">退出</a>
</div>
</div>
<div style="display:none"><iframe id="msgubotj" name="msgubotj" width=0 height=0></iframe></div>



