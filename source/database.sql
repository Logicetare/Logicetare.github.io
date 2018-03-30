-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 24 2017 г., 10:56
-- Версия сервера: 5.6.35
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `skyflar1_1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blacklist`
--

CREATE TABLE `blacklist` (
  `ID` int(11) NOT NULL,
  `IP` varchar(269) NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `boot_methods`
--

CREATE TABLE `boot_methods` (
  `method` varchar(32) NOT NULL,
  `friendly_name` varchar(32) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `boot_methods`
--

INSERT INTO `boot_methods` (`method`, `friendly_name`, `active`) VALUES
('SUDP', 'SUDP', '0'),
('CHARGEN', 'CHARGEN', '1'),
('NTP', 'NTP', '1'),
('SSDP', 'SSDP', '1'),
('SSYN', 'SSYN', '1'),
('ESSYN', 'ESSYN', '1'),
('TCP', 'TCP', '1'),
('VSE', 'VSE', '1'),
('ARME', 'ARME', '0'),
('RUDY', 'RUDY', '0'),
('GET', 'GET', '0'),
('HEAD', 'HEAD', '0'),
('POST', 'POST', '0'),
('JOOMLA', 'JOOMLA', '1'),
('Test', 'Test Name', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `fe`
--

CREATE TABLE `fe` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `gateway`
--

CREATE TABLE `gateway` (
  `email` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `iplogs`
--

CREATE TABLE `iplogs` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `logged` varchar(15) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `loggers`
--

CREATE TABLE `loggers` (
  `logger_id` int(11) NOT NULL,
  `address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `loggers`
--

INSERT INTO `loggers` (`logger_id`, `address`) VALUES
(2, 'http://purestress.net/download.php?id=%'),
(3, 'http://purestress.net/image.php?id=%'),
(1, 'http://purestress.net/logger.php?id=%'),
(4, 'http://purestress.net/song.php?id=%'),
(5, 'http://purestress.net/video.php?id=%');

-- --------------------------------------------------------

--
-- Структура таблицы `loggers_ips`
--

CREATE TABLE `loggers_ips` (
  `id` int(11) NOT NULL,
  `logger_id` int(11) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `date` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `username` varchar(75) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `date` int(16) NOT NULL,
  `http_agent` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `login_history`
--

INSERT INTO `login_history` (`id`, `username`, `ip`, `date`, `http_agent`) VALUES
(1, 'Adversary', '99.72.208.250', 1433044652, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),
(2, 'FFFF', '72.90.77.168', 1433048714, 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36'),
(3, 'Adversary', '99.72.208.250', 1433063344, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),
(4, 'Adversary', '99.72.208.250', 1433063965, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),
(5, 'Adversary', '99.72.208.250', 1433063982, 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0'),
(6, 'prana199', '120.22.87.144', 1433064221, 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_5 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B601 Safari/9537.53'),
(7, 'xanex', '109.225.55.196', 1503560120, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36'),
(8, 'rentlen', '109.225.55.196', 1503561196, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36');

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `user` varchar(15) NOT NULL,
  `ip` varchar(269) NOT NULL COMMENT '69 bottles of beer on the wall',
  `port` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `method` varchar(10) NOT NULL,
  `date` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `stopped` varchar(30) NOT NULL,
  `server_used` varchar(69) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `logs`
--

INSERT INTO `logs` (`user`, `ip`, `port`, `time`, `method`, `date`, `ID`, `stopped`, `server_used`) VALUES
('xanex', '51.15.142.142', 80, 1200, 'NTP', 1503560591, 1, 'No', 'Alpha');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `messageid` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `content` text NOT NULL,
  `sender` varchar(30) NOT NULL,
  `date` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`messageid`, `ticketid`, `content`, `sender`, `date`) VALUES
(1, 1, 'Hello', 'Adversary', 1433061685);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author_id` int(11) NOT NULL,
  `detail` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `paid` float NOT NULL,
  `plan` int(11) NOT NULL,
  `user` int(15) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `btc_addr` varchar(69) DEFAULT NULL,
  `type` enum('btc','stripe','pp','') DEFAULT NULL,
  `tid` varchar(30) NOT NULL,
  `date` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `ping_tokens`
--

CREATE TABLE `ping_tokens` (
  `pt_id` int(11) NOT NULL,
  `token` varchar(36) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attack_id` int(11) NOT NULL,
  `date` int(16) NOT NULL,
  `runs` int(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `ping_tokens`
--

INSERT INTO `ping_tokens` (`pt_id`, `token`, `user_id`, `attack_id`, `date`, `runs`) VALUES
(1, '4ab1e03b4cbbb3ea0c44ef912c32bc22', 4, 1, 1503560591, 19);

-- --------------------------------------------------------

--
-- Структура таблицы `plans`
--

CREATE TABLE `plans` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `mbt` int(11) NOT NULL,
  `max_boots` tinyint(2) NOT NULL DEFAULT '1',
  `unit` varchar(10) NOT NULL,
  `length` int(11) NOT NULL,
  `price` float NOT NULL,
  `allowed_methods` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `plans`
--

INSERT INTO `plans` (`ID`, `name`, `description`, `mbt`, `max_boots`, `unit`, `length`, `price`, `allowed_methods`) VALUES
(2, 'Test', 'test', 3600, 3, 'Years', 3, 30, 'SUDP,NTP,SSDP,POST,JOOMLA');

-- --------------------------------------------------------

--
-- Структура таблицы `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `addr` varchar(128) NOT NULL,
  `resource` varchar(512) NOT NULL,
  `description` text,
  `strength` varchar(256) DEFAULT NULL,
  `last_used` int(16) NOT NULL,
  `status` enum('good','caution','gone') NOT NULL DEFAULT 'gone',
  `delay` varchar(10) NOT NULL DEFAULT '0',
  `active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `servers`
--

INSERT INTO `servers` (`id`, `name`, `addr`, `resource`, `description`, `strength`, `last_used`, `status`, `delay`, `active`) VALUES
(1, 'Alpha', 'http://96.8.115.114', '/send.php?key=LinuxSolutions&target=%host%&port=%port%&method=%method%&time=%time%', 'Swag as fuck', '30gbps', 1503560591, 'gone', '38', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(64) NOT NULL,
  `context` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `date` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `context`, `status`, `username`, `date`) VALUES
(1, 'Hello', 'Hello', 'Closed', 'Adversary', 1433061662),
(2, 'lol', 'ololol', 'Waiting for Staff response.', 'xanex', 1503560303);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(26) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `max_boots` tinyint(2) NOT NULL DEFAULT '0',
  `expire` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `test_boot` int(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `rank`, `membership`, `max_boots`, `expire`, `status`, `test_boot`) VALUES
(5, 'rentlen', '4694c6087f568151a105d90c753bffc4ad218478', 'web.rentlen@gmail.com', 1, 2, 0, 999, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users_fucked`
--

CREATE TABLE `users_fucked` (
  `ID` int(11) NOT NULL,
  `username` varchar(26) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `max_boots` tinyint(2) NOT NULL DEFAULT '0',
  `expire` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `test_boot` int(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `users_loggers`
--

CREATE TABLE `users_loggers` (
  `id` int(11) NOT NULL,
  `logger_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `minified_url` varchar(256) DEFAULT NULL,
  `date` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `boot_methods`
--
ALTER TABLE `boot_methods`
  ADD UNIQUE KEY `method` (`method`);

--
-- Индексы таблицы `fe`
--
ALTER TABLE `fe`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `iplogs`
--
ALTER TABLE `iplogs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Индексы таблицы `loggers`
--
ALTER TABLE `loggers`
  ADD PRIMARY KEY (`logger_id`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Индексы таблицы `loggers_ips`
--
ALTER TABLE `loggers_ips`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`ip`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ping_tokens`
--
ALTER TABLE `ping_tokens`
  ADD PRIMARY KEY (`pt_id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Индексы таблицы `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`,`addr`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Индексы таблицы `users_fucked`
--
ALTER TABLE `users_fucked`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Индексы таблицы `users_loggers`
--
ALTER TABLE `users_loggers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `fe`
--
ALTER TABLE `fe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `iplogs`
--
ALTER TABLE `iplogs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `loggers`
--
ALTER TABLE `loggers`
  MODIFY `logger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `loggers_ips`
--
ALTER TABLE `loggers_ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `ping_tokens`
--
ALTER TABLE `ping_tokens`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `plans`
--
ALTER TABLE `plans`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `users_fucked`
--
ALTER TABLE `users_fucked`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users_loggers`
--
ALTER TABLE `users_loggers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
