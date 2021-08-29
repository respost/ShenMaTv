<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `uboadfl`;");
E_C("CREATE TABLE `uboadfl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk");
E_D("replace into `uboadfl` values('1','首页广告位');");
E_D("replace into `uboadfl` values('2','栏目广告位');");
E_D("replace into `uboadfl` values('3','内页广告位');");

require("../../inc/footer.php");
?>