<?php 
$c_url_cs=$_SERVER['QUERY_STRING'];
$c_url=$_SERVER['PHP_SELF'].'?'.$c_url_cs;
if (empty($c_url_cs))
{$c_url=str_replace("?","",$c_url);}
$c_url=str_replace("/","",$c_url); 
$vipis=substr_count($c_url,'s=vip');
?>
<div class="m-nav-head">
<div class="naviBar">
<ul class="head-nav">
<?php 
if ($vipis==1)
{$where="where member=1";}
else
{$where="where member=0";}
$query = mysql_query("SELECT * FROM se2nav ".$where." order by sort desc limit 8 ");
while($a = mysql_fetch_array($query)) {
$n_url=$a[url]; 
$n_mor=$a[mor]; 
if ($s){$s_url='s=vip';}
if ($apache==1)
{$w_url=str_replace(".php",".html",$n_url); }
else
{$w_url=$n_url; }
?>
<a href="/<?php if ($s_url){$urlis = substr_count($n_url,'=');if ($urlis==0){echo $w_url."?".$s_url;}else{echo $w_url."&".$s_url;}}else{echo $w_url;}?>" rel="external"><li<?php $c_url=str_replace("&","#",$c_url."#");$c_url=str_replace("##","#",$c_url);$c_url=str_replace("?","#",$c_url);$c_url=preg_replace("/page=(\d+)/","",$c_url);$c_url=str_replace("##","#",$c_url);$n_url=str_replace("?","#",$n_url);$bzis= substr_count($c_url,$n_url."#"); if($bzis==1 || ($n_mor==1 && $c_url=="index.php#")){echo " class=\"active\"";}?>><?php echo $a[name];echo $c_url;?><?php if($bzis==1 || ($n_mor==1 && $c_url=="index.php#")){echo "<i></i>";}?></li></a>
<?php }?>
</ul>
</div>
</div>