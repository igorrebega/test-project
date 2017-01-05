-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 05 2017 г., 20:34
-- Версия сервера: 5.5.53-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `soft_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `name`, `text`) VALUES
  (1, 'Post1', 'TExt for post1'),
  (2, 'Post2', 'Text for post222');

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `is_plus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `user_id`, `comment_id`, `is_plus`) VALUES
  (1, 1, 100, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
  (1, 'admin', '$2y$10$VurMyCfSFjbFUO4ncn94aOTqrMjXFRedjgi2agZVQ/aqleVDH8RkK'),
  (2, 'admin2', '$2y$10$/.djeRFCZPKi7okfTNHbc.Qz0iuQueySUk9CqHs8Ys.XJbYaMw0bW');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;