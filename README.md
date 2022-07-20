# 2022年信息安全综合实践小组作业仓库

# build it

---


## 部署文档(开发过程)

克隆仓库到本地

`git clone https://github.com/Vir-Dominary/2022-Cybersecurity-Practices.git`

1. 安装[小皮面板](https://www.xp.cn/),创建网站，域名`localhost`，端口自定（我用的8088），其他选项默认。

2. 创建数据库，域名为`localhost`，数据库名为`www`，用户名`root1`，密码`123456`。

3. 设置网站根目录为仓库目录下的`www`文件夹，注意**路径上不要出现中文以及空格**。

4. 将`www.sql`配置文件导入到www数据库中，或者直接复制SQL语句到SQLfront的SQL编辑器下执行语句

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

5. (如果数据库名以及口令是按照我的上述内容创建的，则不需要这一步)打开/www/php/connect.php文件，修改对应的数据库参数

6. 在浏览器访问`localhost:port`即可查看网站页面了。

---

## break it
