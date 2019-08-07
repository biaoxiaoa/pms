-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:8889
-- 生成日期： 2019-08-07 17:32:44
-- 服务器版本： 5.7.25
-- PHP 版本： 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库： `pms`
--

-- --------------------------------------------------------

--
-- 表的结构 `pms_user`
--

CREATE TABLE `pms_user` (
  `ID` int(11) NOT NULL COMMENT 'ID',
  `account` varchar(12) NOT NULL COMMENT '账户',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nick_name` varchar(10) NOT NULL COMMENT '昵称',
  `salt` varchar(5) NOT NULL COMMENT '密码盐',
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `login_ip` varchar(20) DEFAULT NULL COMMENT '登录IP',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `session_id` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pms_user`
--

INSERT INTO `pms_user` (`ID`, `account`, `password`, `nick_name`, `salt`, `login_time`, `login_ip`, `status`, `session_id`) VALUES
(1, 'admin', 'b5732334201fd10fee7ace9fa3fd0a3b', '小A', 'plxsa', 1565170290, '0.0.0.0', 0, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `pms_user`
--
ALTER TABLE `pms_user`
  ADD PRIMARY KEY (`ID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `pms_user`
--
ALTER TABLE `pms_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;
