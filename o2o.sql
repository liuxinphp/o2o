//分类表
create table if not exists `o2o_category`(
    `id` int(11) unsigned not null primary key auto_increment,
    `name` varchar(50) not null default '',
    `parent_id` int(11) unsigned not null default 0,
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key parent_id(`parent_id`)
)ENGINE=INNODB auto_increment=1 DEFAULT CHARSET=utf8;

//城市表
create table if not exists `o2o_city`(
    `id` int(11) unsigned not null primary key auto_increment,
    `name` varchar(50) not null default '',
    `uname` varchar(50) not null default '',
    `parent_id` int(10) unsigned not null default 0,
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key parent_id(`parent_id`),
    unique key uname(`uname`)
)ENGINE=INNODB auto_increment=1 DEFAULT CHARSET=utf8;

#商圈表
create table if not exists `o2o_area`(
    `id` int(11) unsigned not null primary key auto_increment,
    `name` varchar(50) not null default '',
    `city_id` int(11) unsigned not null default 0,
    `parent_id` int(10) unsigned not null default 0,
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key parent_id(`parent_id`),
    key city_id(`city_id`)
)ENGINE=INNODB auto_increment=1 DEFAULT CHARSET=utf8;

#商户表
create table if not exists `o2o_bis`(
    `id` int(11) not null primary key auto_increment,
    `name` varchar(50) not null default '',
    `email` varchar(50) not null default '',
    `logo` varchar(255) not null default '',
    `licence_log` varchar(255) not null default '',
    `description` text not null,
    `city_id` int(11) unsigned not null default 0,
    `city_path` varchar(50) not null default '',
    `bank_info` varchar(50) not null default '',
    `money` decimal(20,2) not null default '0.00',
    `bank_name` varchar(50) not null default '',
    `bank_user` varchar(50) not null default '',
    `faren` varchar(20) not null default '',
    `faren_tel` varchar(20) not null default '',
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key city_id(`city_id`),
    key name(`name`)
)ENGINE=INNODB auto_increment=1 DEFAULT CHARSET=utf8;

#商户账户表
create table if not exists `o2o_bis_account`(
    `id` int(11) not null primary key auto_increment,
    `username` varchar(50) not null default '',
    `password` char(32) not null default '',
    `code` varchar(10) not null default '',
    `bis_id` int(11) unsigned not null default 0,
    `last_login_ip` varchar(20) not null default '',
    `last_login_time` int(11) unsigned not null default 0,
    `is_main` tinyint(1) unsigned not null default 0,
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key bis_id(`bis_id`),
    key username(`username`)
)ENGINE=INNODB auto_increment=1 DEFAULT CHARSET=utf8;

#商户门店表
create table if not exists `o2o_bis_location`(
    `id` int(11) not null primary key auto_increment,
    `name` varchar(50) not null default '',
    `logo` varchar(255) not null default '',
    `address` varchar(255) not null default'',
    `tel` varchar(20) not null default '',
    `contact` varchar(20) not null default '',
    `xpoint` varchar(20) not null default '',
    `ypoint` varchar(20) not null default '',
    `bis_id` int(11) unsigned not null default 0,
    `open_time` int(11) unsigned not null default 0,
    `content` text not null,
    `is_main` tinyint(1) unsigned not null default 0,
    `api_address` varchar(255) not null default '',
    `city_id` int(11) unsigned not null default 0,
    `city_path` varchar(50) not null default '',
    `category_id` int(11) unsigned not null default 0,
    `category_path` varchar(50) not null default '',
    `bank_info` varchar(50) not null default '',
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key city_id(`city_id`),
    key bis_id(`bis_id`),
    key category_id(`category_id`),
    key name(`name`)
)ENGINE=INNODB auto_increment=1 CHARSET=utf8;

#商品表
create table `o2o_deal`(
    `id` int(11) not null primary key auto_increment,
    `name` varchar(100) not null default '',
    `category_id` int(10) not null default 0,
    `se_category_id` int(11) not null default 0,
    `bis_id` int(11) not null default 0,
    `location_ids` int(11) not null default 0,
    `image` varchar(200) not null default 0,
    `description` text not null,
    `start_time` int(10) not null default 0,
    `end_time` int(10) not null default 0,
    `origin_price` decimal(20,2) not null default '0.00',
    `current_price` decimal(20,2) not null default '0.00',
    `city_id` int(11) not null default 0,
    `buy_count` int(11) not null default 0,
    `total_count` int(11) not null default 0,
    `coupons_begin_time` int(10) not null default 0,
    `coupons_end_time` int(10) not null default 0,
    `xpoint` varchar(20) not null default 0,
    `ypoint` varchar(20) not null default 0,
    `bis_account_id` int(10) not null default 0,
    `balance_price` decimal(20,2) not null default '0.00',
    `notes` text not null,
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    key category_id(`category_id`),
    key se_category_id(`se_category_id`),
    key city_id(`city_id`),
    key start_time(`start_time`),
    key end_time(`end_time`)
)ENGINE=INNODB auto_increment=1 CHARSET=utf8;

#用户表
create table `o2o_user`(
    `id` int(11) not null primary key auto_increment,
    `username` varchar(30) not null default '',
    `password` char(32) not null default '',
    `code` varchar(10) not null default '',
    `last_login_ip` varchar(20) not null default '',
    `last_login_time` int(11) unsigned not null default 0,
    `email` varchar(30) not null default '',
    `mobile` varchar(30) not null default '',
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(10) unsigned not null default 0,
    `update_time` int(10) unsigned not null default 0,
    unique key username(`username`),
    unique key email(`email`)
)ENGINE=INNODB auto_increment=1 CHARSET=utf8;

#推荐表
create table if not exists `o2o_featured`(
    `id` int(11) unsigned primary key auto_increment,
    `type` tinyint(1) not null default 0,
    `title` varchar(30) not null default '',
    `image` varchar(255) not null default '',
    `url` varchar(255) not null default '',
    `description` varchar(255) not null default '',
    `listOrder` int(8) unsigned not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(10) unsigned not null default 0,
    `update_time` int(10) unsigned not null default 0
)ENGINE=INNODB auto_increment=1 CHARSET=utf8;

#订单表
create table if not exists `o2o_order`(
    `id` int(11) unsigned  auto_increment,
    `out_trade_no` varchar(100) not null default '' COMMENT '订单编号',
    `transaction_id` varchar(100) not null default '',
    `user_id` int(11) not null default 0,
    `username` varchar(25) not null default '',
    `pay_time` varchar(50) not null default '',
    `payment_id` int(11) not null default 0,
    `deal_id` int(11) not null default 0,
    `deal_count` int(11) not null default 0,
    `pay_status` tinyint(1) not null default 1 COMMENT '支付状态:1支付成功 0未支付 2支付失败 3其他',
    `total_price` decimal(20,2) not null default 0,
    `pay_amount` decimal(20,2) not null default 0,
    `status` tinyint(1) not null default 0,
    `create_time` int(10) unsigned not null default 0,
    `update_time` int(10) unsigned not null default 0 ,
    PRIMARY KEY(`id`),
    UNIQUE out_trade_no(`out_trade_no`),
    key user_id(`user_id`),
    key create_time(`create_time`)
)ENGINE=INNODB auto_increment=1 CHARSET=utf8;

#优惠券表
create table if not exists `o2o_coupons`(
    `id` int(11) unsigned auto_increment,
    `sn` varchar(25) not null default '',
    `password` varchar(100) not null default '',
    `user_id` int(11) not null default 0,
    `deal_id` int(11) not null default 0,
    `order_id` int(11) not null default 0,
    `status` tinyint(1) not null default 1 COMMENT '0:未发给用户 1：已发给用户 2：用户已经使用 3：禁用',
    `create_time` int(11) unsigned not null default 0,
    `update_time` int(11) unsigned not null default 0,
    primary key (`id`),
    key user_id (`user_id`),
    key deal_id (`deal_id`),
    key create_time (`create_time`)
)ENGINE=INNODB auto_increment=1 CHARSET=utf8;






















