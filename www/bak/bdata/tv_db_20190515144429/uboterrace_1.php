<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `uboterrace`;");
E_C("CREATE TABLE `uboterrace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT '0',
  `big_id` int(2) NOT NULL,
  `small_id` decimal(10,2) NOT NULL DEFAULT '0.00',
  `link` varchar(100) DEFAULT '',
  `sort` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk");
E_D("replace into `uboterrace` values('1','VIP月度会员','0','0','0.00','http://pr.kuaifaka.com/','0');");
E_D("replace into `uboterrace` values('2','VIP季度会员','0','0','0.00','http://pr.kuaifaka.com/','0');");
E_D("replace into `uboterrace` values('3','VIP半年会员','0','0','0.00','http://pr.kuaifaka.com/','0');");
E_D("replace into `uboterrace` values('4','VIP年度会员','0','0','0.00','http://pr.kuaifaka.com/','0');");

require("../../inc/footer.php");
?>