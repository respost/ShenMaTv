<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubozbdt`;");
E_C("CREATE TABLE `ubozbdt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(1000) DEFAULT NULL,
  `zbpic` varchar(1000) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `zbid` int(10) NOT NULL DEFAULT '0',
  `spid` int(10) NOT NULL DEFAULT '0',
  `zbname` varchar(30) DEFAULT NULL,
  `cishu` int(10) NOT NULL DEFAULT '0',
  `shijian` varchar(1000) DEFAULT NULL,
  `price` int(7) unsigned NOT NULL DEFAULT '0',
  `zbprice` int(7) unsigned NOT NULL DEFAULT '0',
  `hits` int(5) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `favorite` int(5) unsigned NOT NULL DEFAULT '0',
  `member` int(2) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `contents` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>