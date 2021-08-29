<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubopayjs`;");
E_C("CREATE TABLE `ubopayjs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT '0',
  `user` int(10) NOT NULL DEFAULT '0',
  `money` decimal(10,0) NOT NULL DEFAULT '0',
  `sqshijian` int(10) NOT NULL DEFAULT '0',
  `jsshijian` int(10) NOT NULL DEFAULT '0',
  `jiesuan` int(1) NOT NULL DEFAULT '0',
  `alipay` varchar(50) DEFAULT NULL,
  `alipayname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>