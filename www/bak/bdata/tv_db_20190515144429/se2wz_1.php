<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('gbk');
E_D("DROP TABLE IF EXISTS `se2wz`;");
E_C("CREATE TABLE `se2wz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `keywords` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `lujing` varchar(1000) NOT NULL,
  `sk` int(3) NOT NULL DEFAULT '0',
  `wap` varchar(100) NOT NULL,
  `youke` int(6) NOT NULL DEFAULT '0',
  `pthy` int(6) NOT NULL DEFAULT '0',
  `viphy` int(6) NOT NULL DEFAULT '0',
  `iseveryday` int(1) NOT NULL DEFAULT '0',
  `today` int(10) NOT NULL DEFAULT '0',
  `automatic` int(1) NOT NULL DEFAULT '0',
  `apache` int(1) NOT NULL DEFAULT '0',
  `pull` int(1) NOT NULL DEFAULT '0',
  `givetime` int(5) NOT NULL DEFAULT '0',
  `isgive` int(1) NOT NULL DEFAULT '0',
  `givevip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk");
E_D("replace into `se2wz` values('1','ǧɫӰԺ','ǧɫ��Ӱ,ǧɫ��Ӱ��,ǧɫTV,���˵�Ӱ��,��������վ,�պ��ֻ�ӰԺ','ǧɫӰԺ���й���רҵ�ĵ�Ӱ��ֱ��վ,���ǻ��ŷ�����պ���������������Ƶ�͸����Ӱ��ȫ��λ�������պ���Ƶ��Դ��������߲��š��޹�棬 ���ܹ���ϰ����˿���Ȱ���','/','30000','m.123.com','50','100','500','0','0','1','0','1','5','1','����VIP��Ա');");

require("../../inc/footer.php");
?>