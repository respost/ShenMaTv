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
E_D("replace into `se2wz` values('1','千色影院','千色电影,千色电影网,千色TV,成人电影网,美国发布站,日韩手机影院','千色影院是中国最专业的电影垂直网站,涵盖华语、欧美、日韩地区海量在线视频和高清电影，全方位的亚洲日韩视频资源，免费在线播放、无广告， 深受广大上班族屌丝的热爱。','/','30000','m.123.com','50','100','500','0','0','1','0','1','5','1','试用VIP会员');");

require("../../inc/footer.php");
?>