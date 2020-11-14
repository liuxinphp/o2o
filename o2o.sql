create table if not exists `o2o_category`(
    `id` int(11) unsigned not null primary key auto_increment,
    `name` varchar(50) not null default '',
    `parent_id` int(11) unsigned not null default 0,
    
);