<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubopacket`;");
E_C("CREATE TABLE `ubopacket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `thname` varchar(100) NOT NULL,
  `avatar` int(2) NOT NULL,
  `money` varchar(100) NOT NULL,
  `number` int(5) NOT NULL,
  `surplus` int(5) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>