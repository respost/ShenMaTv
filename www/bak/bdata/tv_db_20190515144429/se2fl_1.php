<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `se2fl`;");
E_C("CREATE TABLE `se2fl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=gbk");
E_D("replace into `se2fl` values('1','视频');");
E_D("replace into `se2fl` values('2','自拍');");
E_D("replace into `se2fl` values('3','国产');");
E_D("replace into `se2fl` values('4','日韩');");
E_D("replace into `se2fl` values('5','欧美');");
E_D("replace into `se2fl` values('6','制服');");
E_D("replace into `se2fl` values('7','人妻');");
E_D("replace into `se2fl` values('8','动漫');");

require("../../inc/footer.php");
?>