<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubouid`;");
E_C("CREATE TABLE `ubouid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `qq` varchar(12) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `alipayname` varchar(200) NOT NULL,
  `alipay` varchar(200) NOT NULL,
  `suoding` varchar(1000) NOT NULL DEFAULT 'True',
  `userid` varchar(100) NOT NULL,
  `fencheng` varchar(100) NOT NULL,
  `money` varchar(100) NOT NULL,
  `pid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk");

require("../../inc/footer.php");
?>