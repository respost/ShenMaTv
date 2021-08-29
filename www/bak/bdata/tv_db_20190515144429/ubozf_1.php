<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubozf`;");
E_C("CREATE TABLE `ubozf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member1` varchar(100) NOT NULL,
  `member2` varchar(100) NOT NULL,
  `member3` varchar(100) NOT NULL,
  `member4` varchar(100) NOT NULL,
  `money1` int(8) unsigned NOT NULL DEFAULT '0',
  `money2` int(8) unsigned NOT NULL DEFAULT '0',
  `money3` int(8) unsigned NOT NULL DEFAULT '0',
  `money4` int(8) unsigned NOT NULL DEFAULT '0',
  `sign` decimal(10,2) NOT NULL DEFAULT '0.00',
  `hytime1` int(3) unsigned NOT NULL DEFAULT '0',
  `hytime2` int(3) unsigned NOT NULL DEFAULT '0',
  `hytime3` int(3) unsigned NOT NULL DEFAULT '0',
  `hytime4` int(3) unsigned NOT NULL DEFAULT '0',
  `tx` int(5) unsigned NOT NULL DEFAULT '0',
  `xcprice` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `ubozf` values('1','月度会员','季度会员','半年会员','年度会员','5','10','30','50','0.10','30','90','180','365','100','0');");

require("../../inc/footer.php");
?>