<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `uboip`;");
E_C("CREATE TABLE `uboip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(1000) NOT NULL,
  `cs` int(6) NOT NULL DEFAULT '0',
  `today` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>