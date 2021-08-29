<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubofx`;");
E_C("CREATE TABLE `ubofx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `user` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `people` int(5) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `withdrawal` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `renew` int(10) unsigned NOT NULL DEFAULT '0',
  `contents` text,
  `promo` varchar(30) NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '0',
  `amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `grade` int(2) unsigned NOT NULL DEFAULT '1',
  `divide` int(3) unsigned NOT NULL DEFAULT '0',
  `upgrade` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `level` varchar(10) DEFAULT NULL,
  `fx_uid_1` int(10) unsigned NOT NULL DEFAULT '0',
  `fx_uid_2` int(10) unsigned NOT NULL DEFAULT '0',
  `fx_uid_3` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC");

require("../../inc/footer.php");
?>