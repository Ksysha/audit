-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 10 2016 г., 20:38
-- Версия сервера: 10.1.10-MariaDB
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
  `Number` int(4) NOT NULL,
  `Corps_id` int(3) NOT NULL,
  `Type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Capacity` int(4) NOT NULL,
  `TableType` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Sockets` int(3) NOT NULL,
  `Conditioner` tinyint(1) NOT NULL,
  `Area` int(5) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Auditorium`
--

INSERT INTO `Auditorium` (`id`, `Number`, `Corps_id`, `Type`, `Capacity`, `TableType`, `Sockets`, `Conditioner`, `Area`, `Date`) VALUES
(1, 316, 11, 'Практическая', 30, 'Парты', 4, 0, 30, '2016-05-09'),
(2, 216, 11, 'Компьютерный класс', 12, 'Компьютерные столы', 5, 1, 20, '2016-05-09');

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
(1, 1, 2, 7),
(2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Corps`
--

CREATE TABLE `Corps` (
  `id` int(3) NOT NULL,
  `Abbr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Политехническая, 19'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Corps`
--

INSERT INTO `Corps` (`id`, `Abbr`, `Name`, `Address`) VALUES
(1, '1 к.', '1-й учебный корпус', 'Политехническая, 19'),
(2, '2 к.', '2-й учебный корпус', 'Политехническая, 19'),
(3, '3 к.', '3-й учебный корпус', 'Политехническая, 19'),
(4, '4 к.', '4-й учебный корпус', 'Политехническая, 19'),
(5, '5 к.', '5-й учебный корпус', 'Политехническая, 19'),
(6, '6 к.', '6-й учебный корпус', 'Политехническая, 19'),
(7, '8 к.', '8-й учебный корпус', 'Политехническая, 19'),
(8, '9 к.', '9-й учебный корпус', 'Политехническая, 19'),
(9, '10 к.', '10-й учебный корпус', 'Политехническая, 19'),
(10, '11 к.', '11-й учебный корпус', 'Политехническая, 19'),
(11, '15 к.', '15-й учебный корпус', 'Политехническая, 19'),
(12, '16 к.', '16-й учебный корпус', 'Политехническая, 19'),
(13, 'ГК', 'Гидротехнический корпус-1', 'Политехническая, 19'),
(14, 'ГК-2', 'Гидротехнический корпус-2', 'Политехническая, 19'),
(15, 'ГЗ', 'Главное здание', 'Политехническая, 19'),
(16, 'Мех. к.', 'Механический корпус', 'Политехническая, 19'),
(17, 'НОЦ', 'НОЦ УчК', 'Политехническая, 19'),
(18, 'Не опр.', 'Не определено', 'Политехническая, 19'),
(19, 'СК', 'Спорткомплекс', 'Политехническая, 19'),
(20, 'Хим к.', 'Химический корпус', 'Политехническая, 19');

-- --------------------------------------------------------

--
-- Структура таблицы `Equipment`
--

CREATE TABLE `Equipment` (
  `id` int(2) NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `Equipment`
--

INSERT INTO `Equipment` (`id`, `Name`) VALUES
(1, 'Компьютеры'),
(2, 'Проектор'),
(3, 'Спец. Оборудование');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Auditorium`
--
ALTER TABLE `Auditorium`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Auditorium_Equipment`
--
ALTER TABLE `Auditorium_Equipment`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Auditorium`
--
ALTER TABLE `Auditorium`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Auditorium_Equipment`
--
ALTER TABLE `Auditorium_Equipment`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `Corps`
--
ALTER TABLE `Corps`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `Equipment`
--
ALTER TABLE `Equipment`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
