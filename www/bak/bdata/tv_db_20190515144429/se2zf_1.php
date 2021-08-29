<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `se2zf`;");
E_C("CREATE TABLE `se2zf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zhifu` varchar(1000) NOT NULL,
  `alipay` varchar(1000) NOT NULL,
  `weixin` varchar(1000) NOT NULL,
  `money1` varchar(1000) NOT NULL,
  `money2` varchar(1000) NOT NULL,
  `money3` varchar(255) NOT NULL,
  `money4` varchar(255) NOT NULL,
  `money5` varchar(255) NOT NULL,
  `daxiu1` varchar(255) NOT NULL,
  `daxiu2` varchar(255) NOT NULL,
  `zhibo1` varchar(255) NOT NULL,
  `zhibo2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `se2zf` values('1','4','d/zfb.png','d/wx.png','5','10','30','50','100','15','40','45','60');");

require("../../inc/footer.php");
?>