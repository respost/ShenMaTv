<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `se2hd`;");
E_C("CREATE TABLE `se2hd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `pic` varchar(1000) NOT NULL,
  `mpic` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `syurl` varchar(1000) NOT NULL,
  `shijian` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=gbk");
E_D("replace into `se2hd` values('1','ÂÖ²¥Í¼1','/pic/MD_1.jpg','/pic/MD_1.jpg','1','1','10');");
E_D("replace into `se2hd` values('2','ÂÖ²¥Í¼2','/pic/MD_2.jpg','/pic/MD_2.jpg','2','2','10');");
E_D("replace into `se2hd` values('3','ÂÖ²¥Í¼3','/pic/MD_3.jpg','/pic/MD_3.jpg','3','3','10');");
E_D("replace into `se2hd` values('4','ÂÖ²¥Í¼4','/pic/MD_4.jpg','/pic/MD_4.jpg','4','4','10');");
E_D("replace into `se2hd` values('5','ÂÖ²¥Í¼5','/pic/MD_5.jpg','/pic/MD_5.jpg','5','5','10');");

require("../../inc/footer.php");
?>