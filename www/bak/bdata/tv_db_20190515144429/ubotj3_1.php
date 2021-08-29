<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubotj3`;");
E_C("CREATE TABLE `ubotj3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(100) NOT NULL,
  `uid` varchar(1000) NOT NULL,
  `money` varchar(1000) NOT NULL,
  `shijian` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>