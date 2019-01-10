create database IF NOT EXISTS jebook DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use jebook;
CREATE TABLE `je_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL COMMENT '书的ID',
  `user_id` int(11) NOT NULL COMMENT '用户的ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `content` longtext NOT NULL COMMENT '文章内容',
  `desc` longtext,
  `keywords` longtext,
  `path` varchar(255) NOT NULL COMMENT '路径',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '最后保存时间',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '是否发布，默认未发布0',
  PRIMARY KEY (`id`),
  KEY `title` (`title`) USING BTREE,
  KEY `book_id` (`book_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  FULLTEXT KEY `desc` (`desc`),
  FULLTEXT KEY `keywords` (`keywords`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `je_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户的ID',
  `book_name` varchar(255) NOT NULL COMMENT '书名',
  `book_en_name` varchar(255) NOT NULL COMMENT '英文书名',
  `readme` longtext,
  `summary` longtext,
  `path` varchar(255) NOT NULL COMMENT '路径',
  `domain` varchar(255) NOT NULL COMMENT '域名',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '最后保存时间',
  `status` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '审核状态，0未审核，1审核通过，2审核不通过',
  `audit_time` int(11) unsigned NOT NULL COMMENT '审核时间',
  `public` int(11) unsigned NOT NULL DEFAULT 1 COMMENT '可见,1大家可见，不可见',
  `reason` varchar(255) COMMENT '不通过原因',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  FULLTEXT KEY `book_name` (`book_name`),
  FULLTEXT KEY `book_en_name` (`book_en_name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `je_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL COMMENT '用户真实姓名',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `sex` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '性别，1女，2男',
  `level` varchar(255) NOT NULL DEFAULT '1' COMMENT '用户等级',
  `integral` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '用户积分',
  `create_time` int(11) unsigned NOT NULL COMMENT '注册时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  `occupation` varchar(255) NOT NULL COMMENT '职业',
  `verify` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '邮箱是否认证，0未认证，1已经认证',
  `status` int(4) unsigned NOT NULL DEFAULT 1 COMMENT '是否可用，0不可用，1可用',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  FULLTEXT KEY `username` (`username`),
  FULLTEXT KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `je_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) COMMENT '用户的ID',
  `method` varchar(255) NOT NULL COMMENT 'method',
  `ip` varchar(255) NOT NULL COMMENT 'IP',
  `model` varchar(255) NOT NULL COMMENT '模块',
  `data` longtext COMMENT '数据',
  `create_time` int(11) unsigned NOT NULL COMMENT '访问时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '访问时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `je_black_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL COMMENT 'IP',
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `je_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COMMENT '姓名',
  `content` varchar(255) COMMENT '内容',
  `static` int(11) DEFAULT 0 COMMENT '状态',
  `reply` varchar(255) COMMENT '回复内容',
  `create_time` int(11) unsigned NOT NULL COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE `je_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `create_time` int(11) unsigned NOT NULL COMMENT '注册时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  `status` int(4) unsigned NOT NULL DEFAULT 1 COMMENT '是否可用，0不可用，1可用',
  PRIMARY KEY (`id`),
  KEY `id` (`id`) USING BTREE,
  FULLTEXT KEY `username` (`username`),
  FULLTEXT KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
