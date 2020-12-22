-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 22 2020 г., 16:08
-- Версия сервера: 5.7.32-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_samson`
--

-- --------------------------------------------------------

--
-- Структура таблицы `a_category`
--

CREATE TABLE `a_category` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_code` mediumint(9) NOT NULL,
  `category_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `a_ price`
--

CREATE TABLE `a_ price` (
  `price_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price_title` varchar(50) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `a_product`
--

CREATE TABLE `a_product` (
  `product_id` int(11) NOT NULL,
  `product_code` mediumint(9) NOT NULL,
  `product_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `a_product_category`
--

CREATE TABLE `a_product_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `a_property`
--

CREATE TABLE `a_property` (
  `property_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `property_title` varchar(50) NOT NULL,
  `property_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `a_category`
--
ALTER TABLE `a_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `a_ price`
--
ALTER TABLE `a_ price`
  ADD PRIMARY KEY (`price_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `a_product`
--
ALTER TABLE `a_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `a_product_category`
--
ALTER TABLE `a_product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `a_property`
--
ALTER TABLE `a_property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `a_category`
--
ALTER TABLE `a_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `a_ price`
--
ALTER TABLE `a_ price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `a_product`
--
ALTER TABLE `a_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `a_product_category`
--
ALTER TABLE `a_product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `a_property`
--
ALTER TABLE `a_property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `a_ price`
--
ALTER TABLE `a_ price`
  ADD CONSTRAINT `a_ price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `a_product` (`product_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `a_product_category`
--
ALTER TABLE `a_product_category`
  ADD CONSTRAINT `a_product_category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `a_product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `a_product_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `a_category` (`category_id`);

--
-- Ограничения внешнего ключа таблицы `a_property`
--
ALTER TABLE `a_property`
  ADD CONSTRAINT `a_property_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `a_product` (`product_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
