-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 11 2019 г., 15:28
-- Версия сервера: 10.1.33-MariaDB
-- Версия PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `social-network-bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `images` varchar(10000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '["K4DPWqo_i9U.jpg"]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `id_user`, `text`, `datetime`, `images`) VALUES
(1, 1, 'ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ТРЕТИЙ ПОСТ ПЕРВОГО ЮЗЕРААА  ', '2019-04-09 10:45:23', '[\"751a6d97.png\"]'),
(4, 1, 'первый пост первого юзера', '2019-04-09 10:17:12', '[\"751a6d97.png\",\"art-photo.jpg\"]'),
(5, 2, 'первый пост второго юзера', '2019-04-09 10:17:12', ''),
(6, 2, 'второй пост второго юзера', '2019-04-09 10:17:48', ''),
(7, 1, 'второй пост первого юзера', '2019-04-09 10:17:48', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
