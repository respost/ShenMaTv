<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubouser`;");
E_C("CREATE TABLE `ubouser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT '',
  `qq` varchar(12) DEFAULT NULL,
  `tel` varchar(12) DEFAULT NULL,
  `alipayname` varchar(200) DEFAULT NULL,
  `alipay` varchar(200) DEFAULT NULL,
  `suoding` varchar(1000) DEFAULT 'True',
  `userid` varchar(100) DEFAULT NULL,
  `fencheng` varchar(100) DEFAULT NULL,
  `avatar` int(3) unsigned NOT NULL DEFAULT '1',
  `ip` varchar(100) DEFAULT '0',
  `lxcs` int(2) unsigned NOT NULL DEFAULT '1',
  `qdzs` int(5) unsigned NOT NULL DEFAULT '0',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dqtime` int(10) unsigned NOT NULL DEFAULT '0',
  `zctime` int(10) unsigned NOT NULL DEFAULT '0',
  `hylx` int(10) unsigned NOT NULL DEFAULT '0',
  `hymc` varchar(20) DEFAULT NULL,
  `kstime` int(10) NOT NULL DEFAULT '0',
  `endtime` int(10) NOT NULL DEFAULT '0',
  `today` int(10) NOT NULL DEFAULT '0',
  `views` int(6) NOT NULL DEFAULT '0',
  `fx_uid_1` int(10) unsigned NOT NULL DEFAULT '0',
  `fx_uid_2` int(10) unsigned NOT NULL DEFAULT '0',
  `fx_uid_3` int(10) unsigned NOT NULL DEFAULT '0',
  `concern` int(6) unsigned NOT NULL DEFAULT '0',
  `trends` int(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=gbk");
E_D("replace into `ubouser` values('1','0746083581','0',NULL,'',NULL,NULL,NULL,NULL,'True','RVxpzp65da',NULL,'38','127.0.0.1','1','0','0.00','0','1557840402','5',NULL,'1557840402','1557840702','1557840518','495','0','0','0','0','0');");
E_D("replace into `ubouser` values('2','4647546602','0',NULL,'',NULL,NULL,NULL,NULL,'True','lymndEUIe9',NULL,'18','127.0.0.1','1','0','0.00','0','1557840771','5',NULL,'1557840771','1557841071','1557840772','47','0','0','0','0','0');");
E_D("replace into `ubouser` values('3','1292165972','0',NULL,'',NULL,NULL,NULL,NULL,'True','fe1J7KPIYL',NULL,'1','127.0.0.1','1','0','0.00','0','1557886125','5',NULL,'1557886125','1557886425','1557887508','99','0','0','0','0','0');");
E_D("replace into `ubouser` values('4','5977800046','0',NULL,'',NULL,NULL,NULL,NULL,'True','2pWvQLhLxs',NULL,'22','127.0.0.1','1','0','0.00','0','1557889787','5',NULL,'1557889787','1557890087','1557894587','91','0','0','0','0','0');");
E_D("replace into `ubouser` values('5','2403590490','0',NULL,'',NULL,NULL,NULL,NULL,'True','cP9xtCYUex',NULL,'17','127.0.0.1','1','0','0.00','0','1557892822','5',NULL,'1557892822','1557893122','0','0','0','0','0','0','0');");
E_D("replace into `ubouser` values('6','4549024043','0',NULL,'',NULL,NULL,NULL,NULL,'True','uhRF1nAawy',NULL,'38','127.0.0.1','1','0','0.00','0','1557892882','5',NULL,'1557892882','1557893182','0','0','0','0','0','0','0');");
E_D("replace into `ubouser` values('7','4268987391','0',NULL,'',NULL,NULL,NULL,NULL,'True','D1hRBR2aNF',NULL,'32','127.0.0.1','1','0','0.00','0','1557900056','5',NULL,'1557900056','1557900356','0','0','0','0','0','0','0');");

require("../../inc/footer.php");
?>