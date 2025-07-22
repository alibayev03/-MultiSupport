-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 06 2025 г., 13:31
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `init`
--

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `chat_id` bigint(20) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `block` varchar(10) DEFAULT NULL,
  `floor` varchar(10) DEFAULT NULL,
  `apartment` varchar(10) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `chat_id`, `problem`, `block`, `floor`, `apartment`, `created_at`, `photo`) VALUES
(41, 293349337, '⚡ Электричество', 'B', '13', '23', '2025-07-05 06:13:26', NULL),
(42, 293349337, '💧 Вода', 'C', '13', '23', '2025-07-05 06:18:18', 'BQACAgIAAxkBAAIBwmhofVf2SyoJYlHyaQZX3yHJ0XaRAALncAACiPNJSzrqBIZlZjE4NgQ'),
(43, 293349337, '🔥💧 Кондиционер', 'C', '12', '23', '2025-07-05 06:32:06', NULL),
(44, 293349337, '🔥💧 Кондиционер', 'E', '5', 'Оилл', '2025-07-05 08:24:48', NULL),
(45, 2088824456, '⚡ Электричество', 'A', '15', '5', '2025-07-05 13:36:01', 'AgACAgIAAxkBAAIB6Who4-tdBOzQo6atJAkuFfrvHr7PAAIT7TEbcRJIS0E7weNLTaC5AQADAgADeQADNgQ'),
(46, 2088824456, '💧 Вода', 'A', '30', '357', '2025-07-05 13:37:08', 'BQACAgIAAxkBAAIB9mho5C-Z6KmBhNcOfjw_Xy9lM70IAAI5cQACcRJIS6qXXSXhkP_rNgQ');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `chat_id` bigint(20) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `lang` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `chat_id`, `username`, `lang`) VALUES
(7, 293349337, 'sadullaevich_f', 'ru'),
(8, 2088824456, 'Stormtradee', 'ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
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
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
