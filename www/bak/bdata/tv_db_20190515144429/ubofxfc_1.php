<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubofxfc`;");
E_C("CREATE TABLE `ubofxfc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member1` varchar(100) NOT NULL,
  `member2` varchar(100) NOT NULL,
  `member3` varchar(100) NOT NULL,
  `member4` varchar(100) NOT NULL,
  `money1` int(8) unsigned NOT NULL DEFAULT '0',
  `money2` int(8) unsigned NOT NULL DEFAULT '0',
  `money3` int(8) unsigned NOT NULL DEFAULT '0',
  `money4` int(8) unsigned NOT NULL DEFAULT '0',
  `hydivide1` int(3) unsigned NOT NULL DEFAULT '0',
  `hydivide2` int(3) unsigned NOT NULL DEFAULT '0',
  `hydivide3` int(3) unsigned NOT NULL DEFAULT '0',
  `hydivide4` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `ubofxfc` values('1','青铜分销商','黄金分销商','铂金分销商','钻石分销商','100','300','500','1000','5','10','15','30');");

require("../../inc/footer.php");
?>