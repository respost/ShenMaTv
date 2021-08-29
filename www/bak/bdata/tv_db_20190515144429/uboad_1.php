<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `uboad`;");
E_C("CREATE TABLE `uboad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fenlei` int(5) unsigned NOT NULL DEFAULT '0',
  `state` int(2) unsigned NOT NULL DEFAULT '0',
  `type` int(2) unsigned NOT NULL DEFAULT '0',
  `pic` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `sort` int(2) unsigned NOT NULL DEFAULT '0',
  `contents` text,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC");

require("../../inc/footer.php");
?>