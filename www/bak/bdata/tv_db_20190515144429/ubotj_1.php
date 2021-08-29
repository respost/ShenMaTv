<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubotj`;");
E_C("CREATE TABLE `ubotj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(100) DEFAULT NULL,
  `uid` varchar(1000) DEFAULT NULL,
  `money` int(10) NOT NULL DEFAULT '0',
  `leixing` varchar(100) DEFAULT NULL,
  `ddzt` int(2) NOT NULL DEFAULT '0',
  `zffs` int(2) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL DEFAULT '0',
  `remind` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>