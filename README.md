# 2022年信息安全综合时间小组作业仓库

下载仓库到本地

```git
git clone https://github.com/Vir-Dominary/2022-Cybersecurity-Practices.git
```


## 部署环境

1. 安装[小皮面板PhpStudy](https://www.xp.cn/)

2. 启动Apache、MySQL服务

3. 新建网站`localhost`，端口自定，其他选项默认，将网站根目录设置为仓库根目录下的`/www`路径:`./2022-Cybersecurity-Practices/www`

4. 创建数据库并命名为`www`，域名localhost，设置用户名为`root1`密码`123456`。

5. 返回主界面安装SQL_front插件，打开数据库查看创建的www数据库，使用`root1/123456`登陆数据库。

6. __如果按照先前的口令以及域名创建的数据库，则可以忽略这一步__，打开`/www/php/connect.php`文件，修改数据库配置
```php
    $servername='设置的域名';
    $username='用户名';
    $password='密码';
    $dbname='数据库名';
```

7. 你可以直接导入`www.sql`文件，也可以复制下面的初始化配置到SQL编辑器下运行

```SQL
-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-07-14 06:42:06
-- 服务器版本： 8.0.29
-- PHP 版本： 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `www`
--

-- --------------------------------------------------------

--
-- 表的结构 `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` timestamp NOT NULL,
  `private` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `image`
--

INSERT INTO `image` (`id`, `address`, `username`, `time`, `private`) VALUES
(26, '../image/admin/test.png', 'admin', '2022-07-14 06:15:15', 1),
(27, '../image/a/戈薇.png', 'a', '2022-07-14 06:22:48', 1),
(28, '../image/a/戈薇1.png', 'a', '2022-07-14 06:23:54', 0),
(29, '../image/admin/犬夜叉2.png', 'admin', '2022-07-14 06:38:49', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('a', 'a'),
('admin', 'admin');

--
-- 转储表的索引
--

--
-- 表的索引 `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 限制导出的表
--

--
-- 限制表 `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```

8. 完成以上配置后，你应该就可以登陆`127.0.0.1:port`来查看网站内容了。

## 相关配置

前端: HTML\Javascript

后端：php

数据库: MySQL

服务器：apache

## 模拟场景

本项目模拟了一个类似于推特一样的社交网站，用户可以注册自己的账号、将自己的照片上传到网站、查看其他用户的图片以及给其他人的图片点赞。

## 漏洞利用点

 ### 漏洞预期

 通过文件上传漏洞绕过检测手段上传webshell是获取flag的唯一途径

 ### 选择该漏洞的原因

 通过选择该漏洞可以学习文件上传部分的文件名后缀检测机制等防护手段，同时也能学习SQL注入、XSS、非授权访问、CSRF等漏洞的修补

 ### 漏洞利用

 通过上传webshell使用antsword连接获取文件系统权限并浏览网站目录，可以在隐藏的文件路径下找到flag.txt

 