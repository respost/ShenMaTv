<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubozb`;");
E_C("CREATE TABLE `ubozb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fenlei` int(5) unsigned NOT NULL DEFAULT '0',
  `member` int(2) unsigned NOT NULL DEFAULT '0',
  `pic` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `hit` varchar(255) NOT NULL DEFAULT '1993',
  `diqu` varchar(255) DEFAULT NULL,
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `price` int(2) unsigned NOT NULL DEFAULT '0',
  `cishu` int(5) unsigned NOT NULL DEFAULT '0',
  `hits` int(5) unsigned NOT NULL DEFAULT '0',
  `favorite` int(5) unsigned NOT NULL DEFAULT '0',
  `room` int(3) unsigned NOT NULL DEFAULT '30',
  `enroll` int(3) unsigned NOT NULL DEFAULT '0',
  `surplus` int(3) unsigned NOT NULL DEFAULT '30',
  `xcstate` int(2) unsigned NOT NULL DEFAULT '0',
  `switch` int(2) unsigned NOT NULL DEFAULT '0',
  `trends` int(4) unsigned NOT NULL DEFAULT '0',
  `contents` text,
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `concern` int(6) unsigned NOT NULL DEFAULT '0',
  `division` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC");
E_D("replace into `ubozb` values('1','0','0','d/9lVJ8K91tivm.jpeg','����Ů��','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','11',NULL,'0','0','1');");
E_D("replace into `ubozb` values('2','0','0','d/I1sA7Hsdb0o6.jpg','ǰ·��Ȼ����','','1993',NULL,'0.00','0','1','0','0','30','0','30','0','0','22',NULL,'0','0','1');");
E_D("replace into `ubozb` values('3','0','0','d/VUpAPYAWNhaj.jpeg','����ˮ����','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','11',NULL,'0','0','1');");
E_D("replace into `ubozb` values('4','0','0','d/csyyOthhaapo.jpg','�һ��� �Ұ�Ц','','1993',NULL,'0.00','0','1','0','0','30','0','30','0','0','14',NULL,'0','0','1');");
E_D("replace into `ubozb` values('5','0','0','d/U5CVg0Zzng30.jpg','��������ʹ','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','12',NULL,'0','0','1');");
E_D("replace into `ubozb` values('6','0','0','d/7uIuPaMgsLAb.jpeg','Ϧʰ����','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','12',NULL,'0','0','1');");
E_D("replace into `ubozb` values('7','0','0','d/w5Ng0FJhX7g6.jpeg','�賿��ױ','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','15',NULL,'0','0','1');");
E_D("replace into `ubozb` values('8','0','0','d/BDGaZNIr9siX.jpeg','1st����b','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','6',NULL,'0','0','1');");
E_D("replace into `ubozb` values('9','0','0','d/wyK0YnEMD64v.jpeg','�����ҷ��ˡ�','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','17',NULL,'0','0','1');");
E_D("replace into `ubozb` values('10','0','0','d/KjebXbsEo1WJ.jpg','�n�գ�����ؼ','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','10',NULL,'0','0','1');");
E_D("replace into `ubozb` values('11','0','0','d/yZcMZ8p1De66.jpg','�š�����','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','11',NULL,'0','0','1');");
E_D("replace into `ubozb` values('12','0','0','d/Lybrye8iWt0H.jpeg','û�뿪��','','1993',NULL,'0.00','0','1','0','0','30','0','30','0','0','14',NULL,'0','0','1');");
E_D("replace into `ubozb` values('13','0','0','d/nAFSJ28jBnJK.jpeg','����Ů��i','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','10',NULL,'0','0','1');");
E_D("replace into `ubozb` values('14','0','0','d/jRs0PRXsfTvb.jpeg','����̬��Ҫ����','','1993',NULL,'0.00','0','1','0','0','30','0','30','0','0','11',NULL,'0','0','1');");
E_D("replace into `ubozb` values('15','0','0','d/KzPpwgZBInlD.jpeg','�� �� һ Ц��','','1993',NULL,'0.00','0','0','0','0','30','0','30','0','0','17',NULL,'0','0','1');");

require("../../inc/footer.php");
?>