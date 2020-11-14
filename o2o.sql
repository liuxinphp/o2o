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
    key city_id('city_id'),
    key name('name')
)ENGINE=INNODB auto_increment DEFAULT CHARSET=utf8;

#商户账户表
create table if not exists `o2o_bis_account`(
    
);






















