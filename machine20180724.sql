-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-07-24 05:19:30
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `machine`
--

-- --------------------------------------------------------

--
-- 表的结构 `account`
--

CREATE TABLE `account` (
  `id` int(8) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(24) CHARACTER SET utf8 DEFAULT NULL,
  `avatar` varchar(18) NOT NULL DEFAULT 'avatar-default.png'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `nickname`, `avatar`) VALUES
(119, 'Fez@qq.com', 'c2afaf3e36d7b443d9fe04400ab06411', 'fez', '249761544070.png'),
(125, 'fez@163.com', 'c2afaf3e36d7b443d9fe04400ab06411', '艾吉奥', 'avatar-default.png'),
(127, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'avatar-default.png');

-- --------------------------------------------------------

--
-- 表的结构 `barrage`
--

CREATE TABLE `barrage` (
  `id` int(8) NOT NULL,
  `v_id` varchar(12) NOT NULL COMMENT 'video_id',
  `content` varchar(32) CHARACTER SET utf8 NOT NULL,
  `username` varchar(32) NOT NULL,
  `v_time` int(6) NOT NULL COMMENT 'video_time',
  `color` varchar(24) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(8) NOT NULL,
  `pid` varchar(12) NOT NULL,
  `content` varchar(144) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `pid`, `content`, `username`, `time`) VALUES
(106, '201807221546', '管理员需直接修改数据库进行注册；管理员登陆验证时若为邮箱账户则登陆后为普通用户权限；', 'fez@qq.com', '2018-07-22 13:15:46'),
(105, '201807220848', '文档模块需要Libreoffice的支持，上传文件时需要调用Libreoffice将文件转为pdf保存，以便在网页预览', 'fez@qq.com', '2018-07-22 13:08:48');

-- --------------------------------------------------------

--
-- 表的结构 `doc`
--

CREATE TABLE `doc` (
  `id` int(8) NOT NULL,
  `pid` varchar(12) NOT NULL,
  `original_name` varchar(24) CHARACTER SET utf8 NOT NULL,
  `extension_name` varchar(6) NOT NULL,
  `keywords` varchar(32) CHARACTER SET utf8 NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `doc`
--

INSERT INTO `doc` (`id`, `pid`, `original_name`, `extension_name`, `keywords`, `time`) VALUES
(29, '201807220148', 'OverWatch', '.doc', '守望先锋', '2018-07-22 13:01:48');

-- --------------------------------------------------------

--
-- 表的结构 `pic`
--

CREATE TABLE `pic` (
  `id` varchar(12) NOT NULL,
  `original_name` varchar(24) CHARACTER SET utf8 DEFAULT NULL,
  `extension_name` varchar(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `pic`
--

INSERT INTO `pic` (`id`, `original_name`, `extension_name`, `time`) VALUES
('201807224613', NULL, '.jpg', '2018-07-22 12:46:14'),
('201807224557', NULL, '.jpg', '2018-07-22 12:45:57'),
('201807224404', NULL, '.jpg', '2018-07-22 12:44:04'),
('201807224117', NULL, '.jpg', '2018-07-22 12:41:17');

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE `post` (
  `id` int(8) NOT NULL,
  `pid` varchar(12) NOT NULL,
  `topic` varchar(36) CHARACTER SET utf8 DEFAULT NULL,
  `isTop` tinyint(1) DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`id`, `pid`, `topic`, `isTop`, `username`, `time`) VALUES
(27, '201807221546', '管理员说明', 1, 'fez@qq.com', '2018-07-22 13:17:24'),
(26, '201807220848', '文档模块说明', 0, 'fez@qq.com', '2018-07-22 13:08:48');

-- --------------------------------------------------------

--
-- 表的结构 `video`
--

CREATE TABLE `video` (
  `id` int(8) NOT NULL,
  `pid` varchar(12) NOT NULL,
  `original_name` varchar(24) CHARACTER SET utf8 NOT NULL,
  `extension_name` varchar(6) NOT NULL,
  `keywords` varchar(32) CHARACTER SET utf8 NOT NULL,
  `cover` varchar(18) NOT NULL DEFAULT 'video_cover.jpg',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `video`
--

INSERT INTO `video` (`id`, `pid`, `original_name`, `extension_name`, `keywords`, `cover`, `time`) VALUES
(31, '201807224613', '演示5', '.mp4', '演示5', '201807224613.jpg', '2018-07-22 13:17:03'),
(30, '201807224557', '演示4', '.mp4', '演示4', '201807224557.jpg', '2018-07-22 13:17:12'),
(28, '201807224404', '演示3', '.mp4', '演示3', '201807224404.jpg', '2018-07-22 12:44:04'),
(27, '201807224117', '演示2', '.mp4', '演示视频2', '201807224117.jpg', '2018-07-22 12:41:17'),
(26, '201807222829', '演示', '.mp4', '演示视频', 'video_cover.jpg', '2018-07-22 12:28:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barrage`
--
ALTER TABLE `barrage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `account`
--
ALTER TABLE `account`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- 使用表AUTO_INCREMENT `barrage`
--
ALTER TABLE `barrage`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- 使用表AUTO_INCREMENT `doc`
--
ALTER TABLE `doc`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- 使用表AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- 使用表AUTO_INCREMENT `video`
--
ALTER TABLE `video`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
