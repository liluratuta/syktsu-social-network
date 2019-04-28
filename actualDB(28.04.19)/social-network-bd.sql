-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 28 2019 г., 20:21
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
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `id_post`, `id_user`, `text`, `datetime`) VALUES
(47, 28, 3, 'дароу', '2019-04-18 22:45:34'),
(48, 29, 3, 'хуй', '2019-04-19 11:34:30'),
(49, 28, 3, 'sdcszc', '2019-04-19 12:06:01'),
(50, 29, 3, 'увыфа', '2019-04-19 12:17:23'),
(51, 29, 3, 'яччя', '2019-04-19 12:29:07'),
(52, 29, 3, 'чяяччс', '2019-04-19 12:29:22'),
(53, 27, 3, 'хуй', '2019-04-19 12:30:01'),
(54, 30, 23, 'xzczxc', '2019-04-26 23:15:53'),
(55, 30, 23, 'cazxcc', '2019-04-26 23:16:31');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post_or_comment` int(11) NOT NULL,
  `bool_PoC` tinyint(1) NOT NULL,
  `bool_like` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `id_post_or_comment`, `bool_PoC`, `bool_like`) VALUES
(68, 3, 28, 1, 1),
(69, 3, 27, 1, 1),
(71, 3, 47, 0, 1),
(72, 3, 29, 1, 0),
(73, 3, 53, 0, 1),
(74, 3, 51, 0, 1),
(75, 23, 30, 1, 1),
(76, 23, 54, 0, 1),
(77, 23, 31, 1, 1);

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
(27, 3, 'Мой новый пост', '2019-04-18 22:36:41', ''),
(28, 3, 'Пост с несколькими картинками', '2019-04-18 22:37:00', '[\"David_Teniers,_o_Jovem_-_Interior_de_taverna_2(1).jpg\",\"wwalls.ru-1052(1).jpg\"]'),
(29, 3, 'csdsvc', '2019-04-18 22:42:17', '[\"wwalls.ru-1052(2).jpg\"]'),
(30, 23, 'xcxzc', '2019-04-26 23:02:03', ''),
(31, 23, 'Урааа посты работают', '2019-04-26 23:16:45', '[\"/2019/04/26/David_Teniers,_o_Jovem_-_Interior_de_taverna_2(5).jpg\"]');

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
  `icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `friends` text COLLATE utf8_unicode_ci NOT NULL,
  `my_invite` text COLLATE utf8_unicode_ci NOT NULL,
  `me_invite` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `mail`, `password`, `firstname`, `lastname`, `verification`, `icon`, `friends`, `my_invite`, `me_invite`) VALUES
(2, 'awsfdsad@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'Иван', 'Козлов', '', '', '[]', '[3]', '[]'),
(3, 'test@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Максим', 'Кравцов', '', '', '[]', '[]', '[2]'),
(23, 'thedarkarthur@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'Артур', 'Осташов', '', '/2019/04/26/David_Teniers,_o_Jovem_-_Interior_de_taverna_2(6).jpg', '[]', '[]', '[]');

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
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
