-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 17 2021 г., 20:21
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eccovenik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lan_camps`
--

CREATE TABLE `lan_camps` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` bigint(20) NOT NULL,
  `utm_source` varchar(255) DEFAULT NULL,
  `utm_campaign` varchar(255) DEFAULT NULL,
  `utm_content` varchar(255) DEFAULT NULL,
  `utm_term` varchar(255) DEFAULT NULL,
  `ref` varchar(500) DEFAULT NULL,
  `date` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `lan_counts`
--

CREATE TABLE `lan_counts` (
  `id` int(2) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `count` int(10) UNSIGNED DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lan_counts`
--

INSERT INTO `lan_counts` (`id`, `name`, `title`, `count`, `unit`) VALUES
(1, 'count_views', 'Количество просмотров', 0, 'шт.'),
(2, 'count_visitors', 'Количество посетителей', 0, 'чел.'),
(3, 'count_sessions', 'Количество визитов', 0, 'виз.'),
(4, 'count_conversion', 'Конверсия', 0, '%');

-- --------------------------------------------------------

--
-- Структура таблицы `lan_orders`
--

CREATE TABLE `lan_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(11,2) UNSIGNED DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `date_order` int(10) UNSIGNED NOT NULL,
  `date_confirm` int(10) UNSIGNED DEFAULT NULL,
  `date_pay` int(10) UNSIGNED DEFAULT NULL,
  `date_cancel` int(10) UNSIGNED DEFAULT NULL,
  `camp_id` int(10) UNSIGNED DEFAULT NULL,
  `split` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `lan_prices`
--

CREATE TABLE `lan_prices` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(11,0) NOT NULL,
  `img_src` varchar(255) NOT NULL,
  `data-wow-delay` float(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lan_prices`
--

INSERT INTO `lan_prices` (`id`, `title`, `price`, `img_src`, `data-wow-delay`) VALUES
(1, 'Дубовый веник', '179', 'duboviy-venik.png', 0.0),
(2, 'Берёзовый веник', '139', 'berezoviy-venik.png', 0.1),
(3, 'Пихтовый веник', '129', 'pihtoviy-venik.png', 0.2),
(4, 'Липовый веник', '199', 'lipoviy-venik.png', 0.3),
(5, 'Можжевеловый веник', '139', 'mozheveloviy-venik.png', 0.4),
(6, 'Эвкалиптовый веник', '139', 'evkaviptoviy-venik.png', 0.5),
(7, 'Веник из канадского дуба', '299', 'iz-kanadskogo-duba-venik.png', 0.6),
(8, 'Веник из кавказского дуба', '179', 'iz-kavkazskogo-duba-venik.png', 0.7),
(9, 'Кленовый веник', '149', 'klenoviy-venik.png', 0.8),
(10, 'Рябиновый веник', '149', 'ryabinoviy-venik.png', 0.9),
(11, 'Бамбуковый веник', '299', 'bambukoviy-venik.png', 1.0),
(12, 'Веник из черноклена', '149', 'iz-chernoklena-venik.png', 1.1);

-- --------------------------------------------------------

--
-- Структура таблицы `lan_users`
--

CREATE TABLE `lan_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `sex` varchar(55) DEFAULT NULL,
  `date_birth` int(10) UNSIGNED DEFAULT NULL,
  `date_register` int(10) UNSIGNED NOT NULL,
  `sum_paid` decimal(11,2) UNSIGNED DEFAULT NULL,
  `hash` varchar(55) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `lan_visitors`
--

CREATE TABLE `lan_visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `userhash` varchar(255) DEFAULT NULL,
  `referer` varchar(255) DEFAULT NULL,
  `date` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lan_camps`
--
ALTER TABLE `lan_camps`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lan_counts`
--
ALTER TABLE `lan_counts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lan_orders`
--
ALTER TABLE `lan_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lan_prices`
--
ALTER TABLE `lan_prices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lan_users`
--
ALTER TABLE `lan_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lan_visitors`
--
ALTER TABLE `lan_visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lan_camps`
--
ALTER TABLE `lan_camps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `lan_counts`
--
ALTER TABLE `lan_counts`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `lan_orders`
--
ALTER TABLE `lan_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `lan_prices`
--
ALTER TABLE `lan_prices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `lan_users`
--
ALTER TABLE `lan_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `lan_visitors`
--
ALTER TABLE `lan_visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
