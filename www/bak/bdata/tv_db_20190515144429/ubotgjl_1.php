<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubotgjl`;");
E_C("CREATE TABLE `ubotgjl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `promo` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `ip` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `money` int(1) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC");

require("../../inc/footer.php");
?>