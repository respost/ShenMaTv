<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubouidpayjs`;");
E_C("CREATE TABLE `ubouidpayjs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(100) NOT NULL,
  `money` varchar(1000) NOT NULL,
  `sqshijian` varchar(100) NOT NULL,
  `jsshijian` varchar(100) NOT NULL,
  `jiesuan` varchar(1000) NOT NULL,
  `shang` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>