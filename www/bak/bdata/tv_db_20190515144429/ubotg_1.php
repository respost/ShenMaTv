<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubotg`;");
E_C("CREATE TABLE `ubotg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `promo` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL,
  `people` int(5) unsigned NOT NULL DEFAULT '0',
  `money` int(5) unsigned NOT NULL DEFAULT '0',
  `consume` int(5) unsigned NOT NULL DEFAULT '0',
  `frequency` int(5) unsigned NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `renew` int(10) unsigned NOT NULL DEFAULT '0',
  `liberal` int(5) unsigned NOT NULL DEFAULT '0',
  `fatalism` int(5) unsigned NOT NULL DEFAULT '0',
  `contents` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC");
E_D("replace into `ubotg` values('1','0','znLieAxzy4','','http://t.cn/EKJnwZ2','0','0','0','5','1557831566','1557849601','0','0','推广');");
E_D("replace into `ubotg` values('2','2','ahRKHNM7Ye','9779139522','http://t.cn/EKiZ96j','0','0','0','5','1557834915','1557849601','0','0','推广');");
E_D("replace into `ubotg` values('3','4','2pWvQLhLxs','5977800046','http://t.cn/EKoRD98','0','0','0','5','1557899236','1557936001','0','0','推广');");

require("../../inc/footer.php");
?>