<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `ubocard`;");
E_C("CREATE TABLE `ubocard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `money` decimal(10,2) DEFAULT '0.00',
  `serve` varchar(100) DEFAULT '',
  `serve_id` int(10) DEFAULT '0',
  `mgr` varchar(12) DEFAULT NULL,
  `terrace` varchar(100) DEFAULT NULL,
  `terrace_id` int(10) DEFAULT NULL,
  `kstime` int(10) DEFAULT '0',
  `endtime` int(10) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=gbk");
E_D("replace into `ubocard` values('1','49318056','MFFITE7N','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('2','40731586','A73OGHR0','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('3','70891436','CP3FNK71','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('4','03764589','9DPND56P','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('5','35176948','G3O04IMH','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('6','76028359','9SV2I42I','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('7','05246389','5FNNTCE0','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('8','36815497','O6CVILNE','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('9','76184590','1O35FQQD','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('10','74308596','8APHC488','5.00','','0',NULL,'VIP月度会员','1','1557844938','0','0');");
E_D("replace into `ubocard` values('11','95168730','4SG90FTF','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('12','85730241','NJ3ORSG7','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('13','49867123','0TC8K8BK','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('14','13096524','4B6EVUMU','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('15','41320597','UUFQJO1O','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('16','80937251','MOT74IGP','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('17','58267319','55O9KPFG','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('18','56214083','UUSCBDMG','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('19','26538940','GLLDIAC7','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('20','37102465','JL9VD42P','10.00','','0',NULL,'VIP季度会员','2','1557845066','0','0');");
E_D("replace into `ubocard` values('21','56948702','M1UHJC5M','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('22','95680432','01CEL4A8','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('23','98516274','ANU45SAS','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('24','73108629','41UHI9JU','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('25','89357241','D3IS2GJ5','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('26','30694587','A97MSUT8','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('27','08234591','ES8IK1G3','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('28','21364985','JB8UL321','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('29','60348579','JO3SPCUJ','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('30','81439706','QF49IE1L','30.00','','0',NULL,'VIP半年会员','3','1557845075','0','0');");
E_D("replace into `ubocard` values('31','35480679','AV85QN0V','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('32','01359268','ANQAPIDS','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('33','54086129','9RUDVVGL','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('34','72809435','OO5LDPVD','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('35','85436970','T9EP7Q8R','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('36','31746509','5HODRS6O','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('37','80276941','KL1PKRCG','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('38','04351729','QUHV46CE','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('39','74396025','HKKJO343','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");
E_D("replace into `ubocard` values('40','74092681','NMUQ8RHR','50.00','','0',NULL,'VIP年度会员','4','1557845083','0','0');");

require("../../inc/footer.php");
?>