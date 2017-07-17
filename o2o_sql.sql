#生活服务分类表
CREATE TABLE `o2o_category`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL DEFAULT '',
    `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY parent_id(`parent_id`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#城市表
CREATE TABLE `o2o_city`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL DEFAULT '',
    `uname` VARCHAR(50) NOT NULL DEFAULT '',
    `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY uname(`uname`),
    KEY parent_id(`parent_id`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#商圈表
CREATE TABLE `o2o_area`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL DEFAULT '',
    `city_id` int(11) unsigned NOT NULL DEFAULT 0,
    `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY city_id(`city_id`),
    KEY parent_id(`parent_id`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#商户表
CREATE TABLE `o2o_bis`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL DEFAULT '',
    `email` VARCHAR(50) NOT NULL DEFAULT '',
    `logo` VARCHAR(255) NOT NULL DEFAULT '',
    `licence_logo` VARCHAR(255) NOT NULL DEFAULT '',
    `description` text NOT NULL,
    `city_id` int(11) unsigned NOT NULL DEFAULT 0,
    `city_path` VARCHAR(50) NOT NULL DEFAULT '',
    `bank_info` VARCHAR(50) NOT NULL DEFAULT '',
    `money` decimal(20,2) NOT NULL DEFAULT '0.00',
    `bank_name` VARCHAR(50) NOT NULL DEFAULT '',
    `bank_user` VARCHAR(50) NOT NULL DEFAULT '',
    `faren` VARCHAR(20) NOT NULL DEFAULT '',
    `faren_tel` VARCHAR(20) NOT NULL DEFAULT '',
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY city_id(`city_id`),
    KEY name(`name`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#商户账户表
CREATE TABLE `o2o_bis_account`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `password` CHAR(32) NOT NULL DEFAULT '',
    `code` VARCHAR(10) NOT NULL DEFAULT '',
    `bis_id` int(11) unsigned NOT NULL DEFAULT 0,
    `last_login_ip` VARCHAR(30) NOT NULL DEFAULT '',
    `last_login_time` int(11) unsigned NOT NULL DEFAULT 0,
    `is_main` tinyint(1) unsigned NOT NULL DEFAULT 0,
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY bis_id(`bis_id`),
    KEY username(`username`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#商户门店表
CREATE TABLE `o2o_bis_location`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL DEFAULT '',
    `logo` VARCHAR(255) NOT NULL DEFAULT '',
    `address` VARCHAR(255) NOT NULL DEFAULT '',
    `tel` VARCHAR(20) NOT NULL DEFAULT '',
    `contact` VARCHAR(20) NOT NULL DEFAULT '',
    `xpoint` VARCHAR(20) NOT NULL DEFAULT '',
    `ypoint` VARCHAR(20) NOT NULL DEFAULT '',
    `bis_id` int(11) unsigned NOT NULL DEFAULT 0,
    `open_time` int(11) unsigned NOT NULL DEFAULT 0,
    `content` text NOT NULL,
    `is_main` tinyint(1) unsigned NOT NULL DEFAULT 0,
    `api_address` VARCHAR(255) NOT NULL DEFAULT '',
    `city_id` int(11) unsigned NOT NULL DEFAULT 0,
    `city_path` VARCHAR(50) NOT NULL DEFAULT '',
    `category_id` int(11) unsigned NOT NULL DEFAULT 0,
    `category_path` VARCHAR(50) NOT NULL DEFAULT '',
    `bank_info` VARCHAR(50) NOT NULL DEFAULT '',
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY city_id(`city_id`),
    KEY bis_id(`bis_id`),
    KEY category_id(`category_id`),
    KEY name(`name`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#团购商品表
CREATE TABLE `o2o_deal`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL DEFAULT '',
    `category_id` int(11) unsigned NOT NULL DEFAULT 0,
    `se_category_id` VARCHAR(100)  NOT NULL DEFAULT '',
    `bis_id` int(11) unsigned NOT NULL DEFAULT 0,
    `location_ids` VARCHAR(200) NOT NULL DEFAULT '',
    `image` VARCHAR(100) NOT NULL DEFAULT '',
    `description` text NOT NULL,
    `start_time` int(11) unsigned NOT NULL DEFAULT 0,
    `end_time` int(11) unsigned NOT NULL DEFAULT 0,
    `origin_price` decimal(20,2) NOT NULL DEFAULT '0.00',
    `current_price` decimal(20,2) NOT NULL DEFAULT '0.00',
    `city_id` int(11) unsigned NOT NULL DEFAULT 0,
    `buy_count` int(11) unsigned NOT NULL DEFAULT 0,
    `total_count` int(11) unsigned NOT NULL DEFAULT 0,
    `coupons_start_time` int(11) unsigned NOT NULL DEFAULT 0,
    `coupons_end_time` int(11) unsigned NOT NULL DEFAULT 0,
    `xpoint` VARCHAR(20) NOT NULL DEFAULT '',
    `ypoint` VARCHAR(20) NOT NULL DEFAULT '',
    `bis_account_id` int(10) unsigned NOT NULL DEFAULT 0,
    `balance_price` decimal(20,2) NOT NULL DEFAULT '0.00',
    `notes` text NOT NULL,
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY city_id(`city_id`),
    KEY category_id(`category_id`),
    KEY se_category_id(`se_category_id`),
    KEY start_time(`start_time`),
    KEY end_time(`end_time`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#用户表
CREATE TABLE `o2o_user`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `password` CHAR(32) NOT NULL DEFAULT '',
    `code` VARCHAR(10) NOT NULL DEFAULT '',
    `last_login_ip` VARCHAR(30) NOT NULL DEFAULT '',
    `last_login_time` int(11) unsigned NOT NULL DEFAULT 0,
    `email` VARCHAR(30) NOT NULL DEFAULT '',
    `mobile` VARCHAR(20) NOT NULL DEFAULT '',
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE KEY email(`email`),
    UNIQUE KEY username(`username`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#推荐位表
CREATE TABLE `o2o_featured`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `type` tinyint(1) NOT NULL DEFAULT 0,
    `title` VARCHAR(30) NOT NULL DEFAULT '',
    `image` VARCHAR(255) NOT NULL DEFAULT '',
    `url` VARCHAR(255) NOT NULL DEFAULT '',
    `description` VARCHAR(255) NOT NULL DEFAULT '',
    `listorder` int(8) unsigned NOT NULL DEFAULT 0,
    `status` tinyint(1) NOT NULL DEFAULT 0,
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;

#订单表
CREATE TABLE `o2o_order`(
    `id` int(11) unsigned  NOT NULL AUTO_INCREMENT,
    `out_trade_no` VARCHAR(100) NOT NULL DEFAULT '' comment'订单编号',
    `transaction_id` VARCHAR(100) NOT NULL DEFAULT '' comment'微信订单编号',
    `user_id` int(11) unsigned NOT NULL DEFAULT 0,
    `username` VARCHAR(50) NOT NULL DEFAULT '',
    `pay_time` VARCHAR(20) NOT NULL DEFAULT '',
    `payment_id` tinyint(1) NOT NULL DEFAULT 1 comment'支付方式',
    `deal_id` int(11) unsigned NOT NULL DEFAULT 0,
    `deal_count` int(11) unsigned NOT NULL DEFAULT 0,
    `pay_status` tinyint(1) NOT NULL DEFAULT 1 comment'支付状态 0:未支付 1:支付成功 2:支付失败',
    `total_price` decimal(20,2) NOT NULL DEFAULT '0.00',
    `pay_amount` decimal(20,2) NOT NULL DEFAULT '0.00' comment'微信支付总额',
    `status` tinyint(1) NOT NULL DEFAULT 1,
    `referer` VARCHAR(255) NOT NULL DEFAULT '' comment'订单来源url',
    `create_time` int(11) unsigned NOT NULL DEFAULT 0,
    `update_time` int(11) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE out_trade_no(`out_trade_no`),
    KEY user_id(`user_id`),
    KEY create_time(`create_time`)
)ENGINE=Innodb AUTO_INCREMENT=1 DEFAULT CHARSET=UTF8;