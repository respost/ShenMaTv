<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `daxiu`;");
E_C("CREATE TABLE `daxiu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `hit` varchar(255) DEFAULT NULL,
  `diqu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC");

require("../../inc/footer.php");
?>