-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost:8889
-- 生成日期： 2019-08-15 17:50:29
-- 服务器版本： 5.7.25
-- PHP 版本： 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库： `pms`
--

-- --------------------------------------------------------

--
-- 表的结构 `pms_account`
--

CREATE TABLE `pms_account` (
  `ID` int(11) NOT NULL COMMENT 'ID',
  `name` varchar(10) NOT NULL COMMENT '账户名称',
  `number` varchar(180) DEFAULT NULL COMMENT '账户号码',
  `remainlines` float DEFAULT NULL COMMENT '账户额度',
  `secret` varchar(4) DEFAULT NULL COMMENT '账户检验码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pms_menu`
--

CREATE TABLE `pms_menu` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(20) NOT NULL COMMENT '菜单标题',
  `name` varchar(20) NOT NULL COMMENT '桌面名称',
  `icon` varchar(20) DEFAULT NULL COMMENT '菜单图标',
  `module` varchar(20) DEFAULT NULL COMMENT '模块',
  `controller` varchar(20) DEFAULT NULL COMMENT '控制器',
  `action` varchar(20) DEFAULT NULL COMMENT '方法',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '状态 0-启用 1-禁用',
  `desk_show` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示在桌面 0-隐藏 1-显示',
  `parment_ID` int(11) NOT NULL COMMENT '父级菜单 0-根菜单',
  `maxOpen` int(11) NOT NULL DEFAULT '-1' COMMENT '启动最大化 -1：禁用窗口打开最大化。默认值   1：手动最大化，不推荐使用 2：开启最大化',
  `openType` int(11) NOT NULL DEFAULT '2' COMMENT '窗口打开方式 1:html方式 2:iFrame方式.默认值',
  `pageURL` varchar(50) NOT NULL COMMENT '页面地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pms_menu`
--

INSERT INTO `pms_menu` (`id`, `title`, `name`, `icon`, `module`, `controller`, `action`, `status`, `desk_show`, `parment_ID`, `maxOpen`, `openType`, `pageURL`) VALUES
(2, '账户设置', '账户设置', 'fa-list', 'financial', 'Account', 'Index', 0, 1, 0, -1, 2, '/account_add'),
(3, '菜单设置1', '菜单设置1', 'fa-list', 'Set', 'Menu', 'Index', 0, 1, 0, -1, 2, '/index.php/Set/Menu/Index');

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
(1, 'admin', 'b5732334201fd10fee7ace9fa3fd0a3b', '小A', 'plxsa', 1565832494, '0.0.0.0', 0, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `pms_account`
--
ALTER TABLE `pms_account`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `pms_menu`
--
ALTER TABLE `pms_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- 表的索引 `pms_user`
--
ALTER TABLE `pms_user`
  ADD PRIMARY KEY (`ID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `pms_account`
--
ALTER TABLE `pms_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- 使用表AUTO_INCREMENT `pms_menu`
--
ALTER TABLE `pms_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `pms_user`
--
ALTER TABLE `pms_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=2;
