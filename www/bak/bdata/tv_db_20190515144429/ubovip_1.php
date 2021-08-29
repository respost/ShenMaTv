<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubovip`;");
E_C("CREATE TABLE `ubovip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `ms` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>