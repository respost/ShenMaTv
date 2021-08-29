<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `uboxfjl`;");
E_C("CREATE TABLE `uboxfjl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `zyid` int(11) NOT NULL DEFAULT '0',
  `type` int(10) NOT NULL DEFAULT '0',
  `state` int(1) unsigned NOT NULL DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `money` decimal(10,2) NOT NULL,
  `user` varchar(100) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>