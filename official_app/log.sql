ALTER TABLE `mallbuilder_shop` add `lng` varchar(50) NOT NULL COMMENT '����';
ALTER TABLE `mallbuilder_shop` add `lat` varchar(50) NOT NULL COMMENT 'γ��'

ALTER TABLE `mallbuilder_sns` add `like_count` int(11) NOT NULL DEFAULT '0' COMMENT '������';
ALTER TABLE `mallbuilder_sns_comment` add `like` tinyint(1) NOT NULL DEFAULT '0' COMMENT '�Ƿ����'



