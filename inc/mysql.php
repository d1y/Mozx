<?php

$NAME = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/config.json'))->MOX_DB_NAME;

$createUserTable = "CREATE TABLE `$NAME`.`user` ( 
  `id` TEXT NOT NULL COMMENT '用户id',
  `nickname` TEXT NOT NULL COMMENT '用户花名',
  `username` TEXT NOT NULL COMMENT '登录用户名',
  `password` TEXT NOT NULL COMMENT '密码',
  `login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建账号时间戳', 
  `view` INT NOT NULL COMMENT '主页访问量', 
  `admin` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否为管理员'
) ENGINE = InnoDB";

$createVideosTable = "CREATE TABLE `$NAME`.`videos` (
  `url` JSON NOT NULL COMMENT '链接' ,
  `cover` TEXT NOT NULL COMMENT '封面' ,
  `title` TEXT NOT NULL COMMENT '标题' , 
  `tags` TEXT NOT NULL COMMENT '标签' , 
  `intro` TEXT NOT NULL COMMENT '介绍' , 
  `view` INT NOT NULL COMMENT '播放量 - 查看量' , 
  `author_id` TEXT NOT NULL COMMENT '用户的 id' , 
  `id` TEXT NOT NULL COMMENT '本身的id' , 
  `nick` INT NOT NULL COMMENT '点赞数' , 
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE = InnoDB";

$createMusicsTable = "CREATE TABLE `$NAME`.`music` (
  `url` JSON NOT NULL COMMENT '链接' ,
  `cover` TEXT NOT NULL COMMENT '封面' ,
  `title` TEXT NOT NULL COMMENT '标题' , 
  `tags` TEXT NOT NULL COMMENT '标签' , 
  `intro` TEXT NOT NULL COMMENT '介绍' , 
  `view` INT NOT NULL COMMENT '播放量 - 查看量' , 
  `author_id` TEXT NOT NULL COMMENT '用户的 id' , 
  `id` TEXT NOT NULL COMMENT '本身的id' , 
  `nick` INT NOT NULL COMMENT '点赞数' , 
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE = InnoDB";

$createWriteTable = "CREATE TABLE `$NAME`.`write` (
  `md` TEXT NOT NULL COMMENT '内容' ,
  `cover` TEXT NOT NULL COMMENT '封面' ,
  `title` TEXT NOT NULL COMMENT '标题' , 
  `tags` TEXT NOT NULL COMMENT '标签' , 
  `show` TEXT NOT NULL COMMENT '一句话介绍' , 
  `view` INT NOT NULL COMMENT '播放量 - 查看量' , 
  `author_id` TEXT NOT NULL COMMENT '用户的 id' , 
  `id` TEXT NOT NULL COMMENT '本身的id' , 
  `nick` INT NOT NULL COMMENT '点赞数' , 
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE = InnoDB";