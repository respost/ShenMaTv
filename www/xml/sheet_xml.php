<?php
error_reporting(0); 
include("../config/common.php");
include("../config/conn.php");
?>
<?php 
$id=$_GET["id"];
$sort=$_GET["sort"];
if(empty($sort)){ 
$sort="front";
} 
$sql = "WHERE 1=1";
$sql .=" and mhid='$id' ";

	switch ($sort){
	case 'front':
 	$order.= 'order by id DESC';
  	break;
  	case 'opposite':
	$order.= 'order by id ASC';
	break;
}
$Page_size=15; 
$total = mysql_query("SELECT COUNT(*) AS num FROM se2mhzj ".$sql);
$row = mysql_fetch_array($total);
$count = $row[0];
$page_count = ceil($count/$Page_size); 
$init=1; 
$page_len=7; 
$max_p=$page_count; 
$pages=$page_count; 
if(empty($_GET['p'])||$_GET['p']<0){ 
$page=1; 
}else { 
$page=$_GET['p']; 
} 
$offset=$Page_size*($page-1); 

$query = mysql_query("select * from se2mhzj ".$sql." ".$order." limit $offset, $Page_size");
$dqjl = mysql_num_rows($query);
$i=1;
?>
{"status":1,"msg":"","data":[<?php while ($a=mysql_fetch_array($query)) { ?>{"k":"<?php echo $i;?>","id":"<?php echo $a[id];?>","title":<?php $title=autoChangeCode($a[name]); echo json_encode($title)?>}<?php if ($i !== $dqjl){?>,<?php }?><?php 
$i++;  
};?>],"dialog":""}