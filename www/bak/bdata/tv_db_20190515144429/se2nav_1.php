<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `se2nav`;");
E_C("CREATE TABLE `se2nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mor` int(2) unsigned NOT NULL DEFAULT '0',
  `name` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `sort` int(8) unsigned NOT NULL DEFAULT '0',
  `member` int(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk");
E_D("replace into `se2nav` values('1','1','视频','vod_list.php?flid=1','10','0');");
E_D("replace into `se2nav` values('2','0','自拍','vod_list.php?flid=2','9','0');");
E_D("replace into `se2nav` values('3','0','国产','vod_list.php?flid=3','8','0');");
E_D("replace into `se2nav` values('4','0','日韩','vod_list.php?flid=4','7','0');");
E_D("replace into `se2nav` values('5','0','欧美','vod_list.php?flid=5','6','0');");
E_D("replace into `se2nav` values('6','0','制服','vod_list.php?flid=6','5','0');");
E_D("replace into `se2nav` values('7','0','人妻','vod_list.php?flid=7','4','0');");
E_D("replace into `se2nav` values('8','0','动漫','vod_list.php?flid=8','3','0');");

require("../../inc/footer.php");
?>