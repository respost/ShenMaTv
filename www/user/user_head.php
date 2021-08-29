<?php 
$c_url_cs=$_SERVER['QUERY_STRING'];
$c_url=$_SERVER['PHP_SELF'].'?'.$c_url_cs;
if (empty($c_url_cs))
{$c_url=str_replace("?","",$c_url);}
$c_url=str_replace("/","",$c_url); 
?>
<ul class="head-nav">
<?php 
$query = mysql_query("SELECT * FROM se2nav order by sort desc limit 8 ");
while($a = mysql_fetch_array($query)) {
$n_url=$a[url]; 
$n_mor=$a[mor]; 
?>
<a href="<?php echo $n_url;?>" rel="external"><li<?php if($n_url==$c_url || ($n_mor==1 && $c_url=="index.php")){echo " class=\"active\"";}?>><?php echo $a[name];?></li></a>
<?php }?>
</ul>