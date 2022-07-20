-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-07-20 22:35:57
-- 伺服器版本： 10.4.22-MariaDB
-- PHP 版本： 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `beareat`
--

-- --------------------------------------------------------

--
-- 資料表結構 `accounttable`
--

CREATE TABLE `accounttable` (
  `Account` text COLLATE utf8_bin NOT NULL,
  `Password` text COLLATE utf8_bin NOT NULL,
  `Status` text COLLATE utf8_bin NOT NULL,
  `Notice` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 傾印資料表的資料 `accounttable`
--

INSERT INTO `accounttable` (`Account`, `Password`, `Status`, `Notice`) VALUES
('admin', '1234', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `foodtable`
--

CREATE TABLE `foodtable` (
  `_ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_bin NOT NULL,
  `Price` int(80) NOT NULL,
  `Mount` int(11) NOT NULL,
  `Status` text COLLATE utf8_bin NOT NULL,
  `Info` text COLLATE utf8_bin NOT NULL,
  `Isdel` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 傾印資料表的資料 `foodtable`
--

INSERT INTO `foodtable` (`_ID`, `Name`, `Price`, `Mount`, `Status`, `Info`, `Isdel`) VALUES
(1, '部落草地便當', 325, 25, '1', '經典排骨是精選帶骨豬里肌，讓排骨擁有完美咀嚼厚度，口感扎實不軟爛，並使用數種中式香料及天然釀造醬油，24小時低溫熟成排骨，油炸後鮮嫩多汁', '0'),
(2, '特製便當', 110, 0, '1', '每日特選新鮮食材熬煮醬汁，製成傳統美食', '0'),
(3, '雙主便當', 800, 2, '1', '雙主菜 雙享受', '0');

-- --------------------------------------------------------

--
-- 資料表結構 `ordertable`
--

CREATE TABLE `ordertable` (
  `_ID` int(11) NOT NULL,
  `OrderDateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `GetDateTime` datetime NOT NULL,
  `Name` text COLLATE utf8_bin NOT NULL,
  `Phone` text COLLATE utf8_bin NOT NULL,
  `OrderList` text COLLATE utf8_bin NOT NULL,
  `Price` int(11) NOT NULL,
  `Status` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 傾印資料表的資料 `ordertable`
--

INSERT INTO `ordertable` (`_ID`, `OrderDateTime`, `GetDateTime`, `Name`, `Phone`, `OrderList`, `Price`, `Status`) VALUES
(1, '2022-07-20 17:56:45', '2022-07-20 19:40:18', '', '', '', 0, '已取消'),
(2, '2022-07-20 17:55:29', '2022-07-20 19:40:18', '', '', '', 0, '已取消'),
(3, '2022-07-20 17:54:27', '2022-07-20 23:40:18', '', '', '', 0, '已取消'),
(4, '2022-07-20 20:32:36', '2022-07-21 17:24:00', 'asd', 'zxc', '部落草地便當12份，雙主便當8份，', 6700, '已取消'),
(5, '2022-07-20 20:32:42', '2022-07-21 17:24:00', 'asd', 'zxc', '部落草地便當12份，雙主便當8份，', 6700, '已取消');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `accounttable`
--
ALTER TABLE `accounttable`
  ADD PRIMARY KEY (`Account`(80));

--
-- 資料表索引 `foodtable`
--
ALTER TABLE `foodtable`
  ADD PRIMARY KEY (`_ID`);

--
-- 資料表索引 `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `foodtable`
--
ALTER TABLE `foodtable`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
