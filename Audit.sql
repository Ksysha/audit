-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 20 2016 г., 15:53
-- Версия сервера: 10.1.10-MariaDB-log
-- Версия PHP: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Audit`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Auditorium`
--

CREATE TABLE `Auditorium` (
  `id` int(4) NOT NULL,
  `NumberAudit` int(4) NOT NULL,
  `Corps_id` int(3) NOT NULL,
  `Type` int(4) NOT NULL,
  `Capacity` int(4) NOT NULL,
  `CountSeats` int(5) NOT NULL,
  `TableType` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Sockets` int(3) NOT NULL,
  `Conditioner` tinyint(1) NOT NULL,
  `Area` int(5) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Auditorium`
--

INSERT INTO `Auditorium` (`id`, `NumberAudit`, `Corps_id`, `Type`, `Capacity`, `CountSeats`, `TableType`, `Sockets`, `Conditioner`, `Area`, `Date`) VALUES
(89, 324, 6, 2, 10, 10, '3', 1, 1, 1, '2016-08-20 13:46:31'),
(92, 100, 6, 5, 12, 2, '2', 2, 0, 2, '2016-08-20 13:46:09'),
(93, 316, 10, 1, 20, 20, '2', 2, 1, 2, '2016-08-20 13:46:09'),
(94, 111, 6, 2, 12, 12, '1', 12, 1, 1, '2016-08-20 13:45:52'),
(95, 102, 2, 2, 2, 23, '1', 2, 1, 23, '2016-08-20 13:45:52'),
(96, 22, 0, 1, 2, 2, '3', 2, 1, 2, '2016-08-20 13:46:31'),
(97, 23, 6, 1, 2, 2, '1', 2, 1, 2, '2016-08-20 13:45:52'),
(98, 123, 1, 2, 12, 12, '1', 2, 1, 2, '2016-08-20 13:45:52'),
(99, 23, 2, 1, 2, 22, '1', 2, 1, 22, '2016-08-20 13:45:52'),
(101, 12, 6, 2, 2, 2, '1', 2, 1, 2, '2016-08-20 13:45:52'),
(102, 150, 6, 3, 1, 1, '1', 1, 1, 1, '2016-08-20 13:45:52'),
(103, 160, 6, 5, 1, 1, '2', 2, 1, 2, '2016-08-20 13:46:09'),
(104, 20, 4, 3, 12, 12, '2', 1, 0, 1, '2016-08-20 13:46:09');

-- --------------------------------------------------------

--
-- Структура таблицы `Auditorium_Equipment`
--

CREATE TABLE `Auditorium_Equipment` (
  `id` int(3) NOT NULL,
  `Equipment_id` int(4) NOT NULL,
  `Auditorium_id` int(4) NOT NULL,
  `Amount` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Auditorium_Equipment`
--

INSERT INTO `Auditorium_Equipment` (`id`, `Equipment_id`, `Auditorium_id`, `Amount`) VALUES
(43, 3, 89, 1),
(46, 2, 92, 1),
(47, 3, 93, 1),
(48, 2, 94, 1),
(49, 2, 95, 1),
(50, 1, 96, 2),
(51, 1, 97, 2),
(52, 3, 98, 1),
(53, 2, 99, 1),
(54, 1, 101, 2),
(55, 1, 102, 1),
(56, 2, 102, 1),
(57, 1, 103, 20),
(58, 2, 104, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Corps`
--

CREATE TABLE `Corps` (
  `id` int(3) NOT NULL,
  `Abbr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Политехническая, 19',
  `ext_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Corps`
--

INSERT INTO `Corps` (`id`, `Abbr`, `Name`, `Address`, `ext_id`) VALUES
(1, '1 к.', '1-й учебный корпус', 'Политехническая, 19', 6),
(2, '2 к.', '2-й учебный корпус', 'Политехническая, 19', 7),
(3, '3 к.', '3-й учебный корпус', 'Политехническая, 19', 8),
(4, '4 к.', '4-й учебный корпус', 'Политехническая, 19', 9),
(5, '5 к.', '5-й учебный корпус', 'Политехническая, 19', 2),
(6, '6 к.', '6-й учебный корпус', 'Политехническая, 19', 11),
(7, '8 к.', '8-й учебный корпус', 'Политехническая, 19', 12),
(8, '9 к.', '9-й учебный корпус', 'Политехническая, 19', 13),
(9, '10 к.', '10-й учебный корпус', 'Политехническая, 19', 14),
(10, '11 к.', '11-й учебный корпус', 'Политехническая, 19', 15),
(11, '15 к.', '15-й учебный корпус', 'Политехническая, 19', 16),
(12, '16 к.', '16-й учебный корпус', 'Политехническая, 19', 18),
(13, 'ГК', 'Гидротехнический корпус-1', 'Политехническая, 19', 3),
(14, 'ГК-2', 'Гидротехнический корпус-2', 'Политехническая, 19', 4),
(15, 'ГЗ', 'Главное здание', 'Политехническая, 19', 1),
(16, 'Мех. к.', 'Механический корпус', 'Политехническая, 19', 5),
(17, 'НОЦ', 'НОЦ УчК', 'Политехническая, 19', 0),
(18, 'Не опр.', 'Не определено', 'Политехническая, 19', 0),
(19, 'СК', 'Спорткомплекс', 'Политехническая, 19', 0),
(20, 'Хим к.', 'Химический корпус', 'Политехническая, 19', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Equipment`
--

CREATE TABLE `Equipment` (
  `id` int(4) NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Equipment`
--

INSERT INTO `Equipment` (`id`, `Name`) VALUES
(1, 'computer'),
(2, 'projector'),
(3, 'special');

-- --------------------------------------------------------

--
-- Структура таблицы `TypeOfAuditorium`
--

CREATE TABLE `TypeOfAuditorium` (
  `ext_id` int(4) NOT NULL,
  `type` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `TypeOfAuditorium`
--

INSERT INTO `TypeOfAuditorium` (`ext_id`, `type`) VALUES
(1, 'Лекционная'),
(2, 'Компьютерный класс'),
(3, 'Практическая'),
(4, 'Спортивный зал'),
(5, 'Лаборатория');

-- --------------------------------------------------------

--
-- Структура таблицы `TypeOfTable`
--

CREATE TABLE `TypeOfTable` (
  `ext_id` int(4) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `TypeOfTable`
--

INSERT INTO `TypeOfTable` (`ext_id`, `type`) VALUES
(1, 'Амфитеатр'),
(2, 'Парты'),
(3, 'Компьютерные столы');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(4) NOT NULL,
  `Login` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Password` char(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `Login`, `Password`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'ksysha', '21232f297a57a5a743894a0e4a801fc3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Auditorium`
--
ALTER TABLE `Auditorium`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NumberAudit` (`NumberAudit`,`Corps_id`),
  ADD KEY `Corps_id` (`Corps_id`),
  ADD KEY `Corps_id_2` (`Corps_id`);

--
-- Индексы таблицы `Auditorium_Equipment`
--
ALTER TABLE `Auditorium_Equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Auditorium_id` (`Auditorium_id`),
  ADD KEY `Equipment_id` (`Equipment_id`);

--
-- Индексы таблицы `Corps`
--
ALTER TABLE `Corps`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Equipment`
--
ALTER TABLE `Equipment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `TypeOfAuditorium`
--
ALTER TABLE `TypeOfAuditorium`
  ADD PRIMARY KEY (`ext_id`);

--
-- Индексы таблицы `TypeOfTable`
--
ALTER TABLE `TypeOfTable`
  ADD PRIMARY KEY (`ext_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Auditorium`
--
ALTER TABLE `Auditorium`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT для таблицы `Auditorium_Equipment`
--
ALTER TABLE `Auditorium_Equipment`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT для таблицы `Corps`
--
ALTER TABLE `Corps`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `Equipment`
--
ALTER TABLE `Equipment`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Auditorium_Equipment`
--
ALTER TABLE `Auditorium_Equipment`
  ADD CONSTRAINT `auditorium_equipment_ibfk_1` FOREIGN KEY (`Auditorium_id`) REFERENCES `Auditorium` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
