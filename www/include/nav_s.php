<ul class="nav-list">
<?php
if ($apache==1)
{$kz="html"; }
else
{$kz="php"; }
$query = mysql_query("SELECT * FROM se2fl limit 12 ");
while($a = mysql_fetch_array($query)) {?>
<a href="/vod_list.<?php echo $kz;?>?flid=<?php echo $a[id]?>" rel="external" title="<?php echo $a[name]?>" ><li><?php echo $a[name]?></li></a>
<?php }?>
</ul>