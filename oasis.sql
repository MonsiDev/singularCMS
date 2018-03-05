-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 05 2018 г., 18:34
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oasis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cms_album`
--

CREATE TABLE `cms_album` (
  `album_id` int(11) NOT NULL,
  `album_name` varchar(125) NOT NULL,
  `album_title` varchar(125) NOT NULL,
  `album_images` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cms_category`
--

CREATE TABLE `cms_category` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(125) NOT NULL,
  `category_name` varchar(125) NOT NULL,
  `category_parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_category`
--

INSERT INTO `cms_category` (`category_id`, `category_title`, `category_name`, `category_parent`) VALUES
(3, 'Квартиры', 'kvartiry', 0),
(4, 'Дома', 'doma', 0),
(5, 'Дачи', 'dachi', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `cms_menu`
--

CREATE TABLE `cms_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(125) NOT NULL,
  `menu_title` varchar(125) NOT NULL,
  `menu_json` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cms_object`
--

CREATE TABLE `cms_object` (
  `object_id` int(11) NOT NULL,
  `object_name` varchar(125) NOT NULL,
  `object_user` int(11) NOT NULL,
  `object_title` varchar(125) NOT NULL,
  `object_content` varchar(20000) NOT NULL,
  `object_album` int(11) NOT NULL,
  `object_type` int(11) NOT NULL,
  `object_category` int(11) NOT NULL,
  `object_price` int(11) NOT NULL,
  `object_user_price` int(11) NOT NULL,
  `object_pubdate` date NOT NULL,
  `object_debupdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_object`
--

INSERT INTO `cms_object` (`object_id`, `object_name`, `object_user`, `object_title`, `object_content`, `object_album`, `object_type`, `object_category`, `object_price`, `object_user_price`, `object_pubdate`, `object_debupdate`) VALUES
(1, 'fsdf', 1, 'Ул. Марцинкевичв', 'dfsafsdgf', 0, 1, 4, 1, 23, '2018-03-05', 4234234),
(2, 'fsdf5', 1, '6454', 'dfsafsdgf', 0, 1, 5, 1, 23, '2018-03-05', 4234234);

-- --------------------------------------------------------

--
-- Структура таблицы `cms_type`
--

CREATE TABLE `cms_type` (
  `type_id` int(11) NOT NULL,
  `type_title` varchar(125) NOT NULL,
  `type_name` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_type`
--

INSERT INTO `cms_type` (`type_id`, `type_title`, `type_name`) VALUES
(1, 'Аренда', 'rental'),
(2, 'Продажа', 'sale');

-- --------------------------------------------------------

--
-- Структура таблицы `cms_users`
--

CREATE TABLE `cms_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(125) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_nickname` varchar(125) NOT NULL,
  `user_phone` varchar(12) NOT NULL,
  `user_mail` varchar(125) NOT NULL,
  `user_photo` varchar(512) NOT NULL,
  `user_gid` int(11) NOT NULL,
  `user_delete` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cms_users`
--

INSERT INTO `cms_users` (`user_id`, `user_name`, `user_password`, `user_nickname`, `user_phone`, `user_mail`, `user_photo`, `user_gid`, `user_delete`) VALUES
(1, 'Admin', '', 'Administrator', '2342', 'sd@mail.ru', '/Admin/Admin.png', 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cms_album`
--
ALTER TABLE `cms_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Индексы таблицы `cms_category`
--
ALTER TABLE `cms_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `cms_menu`
--
ALTER TABLE `cms_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Индексы таблицы `cms_object`
--
ALTER TABLE `cms_object`
  ADD PRIMARY KEY (`object_id`);

--
-- Индексы таблицы `cms_type`
--
ALTER TABLE `cms_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Индексы таблицы `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cms_album`
--
ALTER TABLE `cms_album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `cms_category`
--
ALTER TABLE `cms_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `cms_menu`
--
ALTER TABLE `cms_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `cms_object`
--
ALTER TABLE `cms_object`
  MODIFY `object_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `cms_type`
--
ALTER TABLE `cms_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
