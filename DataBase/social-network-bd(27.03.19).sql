-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 27 2019 г., 10:43
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Структура таблицы `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `access_type` int(11) NOT NULL,
  `default_user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `chats`
--

INSERT INTO `chats` (`id`, `name`, `icon`, `access_type`, `default_user_role`) VALUES
(1, 'chat №1', 'https://www.surrealist.com.tr/images/photos/online-havaalani-transfer-sistemimizin-baslica-ozellikleri_69098973074826520999.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `chat_id`, `data`, `date`) VALUES
(31, 1, 1, 'Привет', '2019-03-27 10:18:36');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `firstname`, `icon`) VALUES
(1, 'admin', 'admin', 'admin', 'https://image.flaticon.com/icons/png/512/762/762624.png'),
(2, 'tetanurae', '123', 'Ivan', 'https://thenakedlondon.com/wp-content/uploads/2017/09/cropped-nakedicon.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mail` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `verification` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `firstname`, `lastname`, `verification`, `icon`) VALUES
(1, 'thedarkarthur@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Артур', 'Осташов', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_chat`
--

CREATE TABLE `user_chat` (
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_chat`
--

INSERT INTO `user_chat` (`user_id`, `chat_id`, `user_role`) VALUES
(1, 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
