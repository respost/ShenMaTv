<?php
$id=$_GET["id"];
$id=base64_decode($id);
$id=($id-12865379)/512;
$id = ($id*628)+61857329;
$id = base64_encode($id);
$purl="/ckplayer/url.php?id=".$id."&page=1";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CK播放器</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">
body,html,div{padding: 0;margin: 0;width:100%;height:100%;}
video::-internal-media-controls-download-button {display:none;}
video::-webkit-media-controls-enclosure {overflow:hidden;}
video::-webkit-media-controls-panel {width: calc(100% + 30px);}
</style>
</head>
<body>
<div id="a1" style="psotion:relative;"></div>
<script type="text/javascript">
document.getElementById('a1').innerHTML = '<video src="<?php echo $purl;?>" controls="controls" autoplay="autoplay" width="100%" height="100%" id="v"></video>';
function cplay()
{
var v = document.getElementById('v');
setInterval("v.play()",1000);
return false;
}
</script>
</body>
</html>