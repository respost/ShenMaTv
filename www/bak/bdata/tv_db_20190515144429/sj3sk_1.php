<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `sj3sk`;");
E_C("CREATE TABLE `sj3sk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dizhi` varchar(100) NOT NULL,
  `pic` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>