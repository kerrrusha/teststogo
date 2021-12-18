-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 08 2021 г., 01:29
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

--
-- База данных: `teststogo-db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE `answer` (
  `id` int(11) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `picture_url` text NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id`, `ticket_id`, `picture_url`, `answer`, `is_correct`) VALUES
(1, 1, '', '18 см', 0),
(2, 1, '', '24 см', 0),
(3, 1, '', '29 см', 0),
(4, 1, '', '31 см', 1),
(5, 2, '', '48 см', 0),
(6, 2, '', '56 см', 0),
(7, 2, '', '46 см', 0),
(8, 2, '', '62 см', 1),
(9, 3, '', '28 см', 0),
(10, 3, '', '56 см', 0),
(11, 3, '', '30 см', 1),
(12, 3, '', '15 см', 0),
(13, 4, '', '26', 0),
(14, 4, '', '36', 0),
(15, 4, '', '13', 0),
(16, 4, '', '42', 1),
(17, 5, '', '28', 1),
(18, 5, '', '22', 0),
(19, 5, '', '24', 0),
(20, 5, '', '48', 0),
(21, 6, '', '30', 0),
(22, 6, '', '32', 1),
(23, 6, '', '24', 0),
(24, 6, '', '28', 0),
(25, 7, '', '8', 0),
(26, 7, '', '7', 1),
(27, 7, '', '10', 0),
(28, 7, '', '21', 0),
(29, 8, '', '5', 0),
(30, 8, '', '3', 0),
(31, 8, '', '6', 0),
(32, 8, '', '4', 1),
(33, 9, '', '7 см', 0),
(34, 9, '', '28 см', 0),
(35, 9, '', '21 см', 1),
(36, 9, '', '14 см', 0),
(37, 10, '', '18 см', 0),
(38, 10, '', '72 см', 0),
(39, 10, '', '24 см', 0),
(40, 10, '', '36 см', 1),
(41, 11, '', '4', 0),
(42, 11, '', '-14', 1),
(43, 11, '', '15', 0),
(44, 11, '', '-13', 0),
(45, 12, '', '3.9', 0),
(46, 12, '', '2.9', 0),
(47, 12, '', '-2.1', 0),
(48, 12, '', '2.1', 1),
(49, 13, '', '20.9', 1),
(50, 13, '', '-19.1', 0),
(51, 13, '', '20.1', 0),
(52, 13, '', '19.1', 0),
(53, 14, '', '-3', 1),
(54, 14, '', '-4', 0),
(55, 14, '', '3', 0),
(56, 14, '', '4', 0),
(57, 15, '', '-2.5', 0),
(58, 15, '', '-3.6', 0),
(59, 15, '', '2.5', 0),
(60, 15, '', '3.5', 1),
(61, 16, '', '-5', 0),
(62, 16, '', '-3', 0),
(63, 16, '', '-4', 1),
(64, 16, '', '-4.4', 0),
(65, 17, '', '0.9', 1),
(66, 17, '', '1.1', 0),
(67, 17, '', '0.8', 0),
(68, 17, '', '1', 0),
(69, 18, '', '-11.4', 1),
(70, 18, '', '-12.4', 0),
(71, 18, '', '-10.4', 0),
(72, 18, '', '-11.6', 0),
(73, 19, '', '11.4', 0),
(74, 19, '', '10.4', 0),
(75, 19, '', '10.1', 0),
(76, 19, '', '11.1', 1),
(77, 20, '', '9', 0),
(78, 20, '', '11.1', 0),
(79, 20, '', '11', 1),
(80, 20, '', '10.9', 0),
(81, 21, 'images/tests/3/21.1.png', '', 1),
(82, 21, 'images/tests/3/21.2.png', '', 0),
(83, 21, 'images/tests/3/21.3.png', '', 0),
(84, 21, 'images/tests/3/21.4.png', '', 0),
(85, 22, 'images/tests/3/22.1.png', '', 0),
(86, 22, 'images/tests/3/22.2.png', '', 0),
(87, 22, 'images/tests/3/22.3.png', '', 1),
(88, 22, 'images/tests/3/22.4.png', '', 0),
(89, 23, '', '0.25 с', 0),
(90, 23, '', '0.025 с', 1),
(91, 23, '', '0.4 с', 0),
(92, 23, '', '4 с', 0),
(93, 24, '', '80 км/год', 0),
(94, 24, '', '25 км/год', 0),
(95, 24, '', '40 км/год', 0),
(96, 24, '', '60 км/год', 1),
(97, 25, '', 'Механічний рух', 0),
(98, 25, '', 'Переміщення', 0),
(99, 25, '', 'Траєкторія', 1),
(100, 25, '', 'Пройдений шлях', 0),
(101, 26, '', '0.2 Гц', 1),
(102, 26, '', '0.5 Гц', 0),
(103, 26, '', '2.4 Гц', 0),
(104, 26, '', '2.6 Гц', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `answer_result`
--

CREATE TABLE `answer_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `chosen_answer_id` int(10) UNSIGNED NOT NULL,
  `ticket_result_id` int(10) UNSIGNED NOT NULL,
  `creating_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `answer_result`
--

INSERT INTO `answer_result` (`id`, `chosen_answer_id`, `ticket_result_id`, `creating_time`) VALUES
(66, 79, 66, '2021-12-08 02:06:04'),
(67, 42, 67, '2021-12-08 02:06:08'),
(68, 49, 68, '2021-12-08 02:06:13'),
(69, 65, 69, '2021-12-08 02:06:16'),
(70, 48, 70, '2021-12-08 02:06:20'),
(71, 53, 71, '2021-12-08 02:06:24'),
(72, 60, 72, '2021-12-08 02:06:32'),
(73, 69, 73, '2021-12-08 02:06:35'),
(74, 76, 74, '2021-12-08 02:06:39'),
(75, 63, 75, '2021-12-08 02:06:43'),
(82, 81, 82, '2021-12-08 02:16:25'),
(83, 99, 83, '2021-12-08 02:16:52'),
(84, 102, 84, '2021-12-08 02:19:32'),
(85, 96, 85, '2021-12-08 02:19:35'),
(86, 90, 86, '2021-12-08 02:19:37'),
(87, 85, 87, '2021-12-08 02:19:38'),
(88, 38, 88, '2021-12-08 02:23:59'),
(89, 20, 89, '2021-12-08 02:24:00'),
(90, 10, 90, '2021-12-08 02:24:01'),
(91, 16, 91, '2021-12-08 02:24:02'),
(92, 21, 92, '2021-12-08 02:24:03'),
(93, 27, 93, '2021-12-08 02:24:04');

-- --------------------------------------------------------

--
-- Структура таблицы `key`
--

CREATE TABLE `key` (
  `id` int(11) UNSIGNED NOT NULL,
  `uid` int(11) UNSIGNED DEFAULT NULL,
  `secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sendtime` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `key`
--

INSERT INTO `key` (`id`, `uid`, `secret`, `sendtime`, `login`) VALUES
(31, NULL, '$2y$10$dBvNy/TLCZHU43k9MUV5guNaXnNyvrcuz7e4a4Enpgqib4b5mRqUy', '06-12-2021 01:50:02', 'test@gmail.com'),
(32, NULL, '$2y$10$E3hlGIWZn7TPXNu9dqekkO1OKePSqaafacR4NtoUOETu324Of6X/O', '06-12-2021 01:53:49', 'knkirill46@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `test_category_id` int(10) UNSIGNED NOT NULL,
  `creating_date` datetime NOT NULL DEFAULT current_timestamp(),
  `logo_url` text NOT NULL,
  `show_answers` tinyint(1) NOT NULL DEFAULT 0,
  `testing_for_exam_points` tinyint(1) DEFAULT 0,
  `time_constraint_is_active` tinyint(1) NOT NULL DEFAULT 0,
  `time_constraint_in_seconds` int(11) NOT NULL DEFAULT 0,
  `tickets_shuffle` tinyint(1) NOT NULL DEFAULT 1,
  `for_authorised_users_only` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `name`, `description`, `author_id`, `test_category_id`, `creating_date`, `logo_url`, `show_answers`, `testing_for_exam_points`, `time_constraint_is_active`, `time_constraint_in_seconds`, `tickets_shuffle`, `for_authorised_users_only`) VALUES
(1, '5-6 класи. Периметр та площа', 'Ми пропонуємо вам перевірити рівень шкільних знань з математики за темою \"Периметр та площа\" (рівень 5-6 класу).\nПери́метр — сумарна довжина границь, які обмежують геометричну фігуру на площині. \nПлоща — фізична величина, що визначає розмір поверхні, одна з основних властивостей геометричних фігур, у математиці розглядається як міра множини точок, які займають поверхню або якусь її частину.', NULL, 1, '2021-12-04 00:00:00', '/images/png/test_icon_default.png', 0, 1, 0, 0, 1, 0),
(2, 'Арифметика. Завдання на додавання та віднімання', 'Даний тест надає можливість перевірити арифметичні навички додавання та віднімання (рівня 5-го класу).', NULL, 1, '2021-12-04 05:14:30', '/images/png/test_icon_default.png', 1, 0, 0, 0, 1, 0),
(3, 'Фізика. Механічний рух. 7 клас', 'Даний тест розрахований на учнів 7 класів. Він допоможе повторити та систематизувати вивчений матеріал по темі \"Механічний рух\", та підготуватися до контрольної роботи.', NULL, 4, '2021-12-04 05:15:56', '/images/png/test_icon_default.png', 0, 1, 1, 360, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `test_category`
--

CREATE TABLE `test_category` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `test_category`
--

INSERT INTO `test_category` (`id`, `name`) VALUES
(1, 'освітні'),
(2, 'розважальні'),
(3, 'психологічні'),
(4, 'екзамен');

-- --------------------------------------------------------

--
-- Структура таблицы `test_status`
--

CREATE TABLE `test_status` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `test_status`
--

INSERT INTO `test_status` (`id`, `name`) VALUES
(1, 'В процесі'),
(2, 'Завершено');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `picture_url` text NOT NULL,
  `question` text NOT NULL,
  `reward_score_points` double DEFAULT 0,
  `exam_points` double DEFAULT 0,
  `ticket_type_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`id`, `test_id`, `picture_url`, `question`, `reward_score_points`, `exam_points`, `ticket_type_id`) VALUES
(1, 1, '', 'Одна сторона трикутника дорівнює 10 см, друга на 4 см коротша, а третя на 5 см довша за першу. Чому дорівнює периметр трикутника?', 2, 1, 1),
(2, 1, '', 'Знайдіть периметр трикутника, якщо одна сторона трикутника дорівнює 14 см, друга в 2 рази більша за першу, а третя на 8 см менша за другу.', 2, 1, 1),
(3, 1, '', 'Знайдіть периметр прямокутника зі сторонами 7 см та 8 см.', 2, 1, 1),
(4, 1, '', 'Знайдіть площу прямокутника зі сторонами 6 см і 7 см. Дайте відповідь у квадратних сантиметрах.', 2, 1, 1),
(5, 1, '', 'Одна сторона прямокутника дорівнює 8 см, а інша на 2 см коротша. Знайдіть периметр прямокутника. Дайте відповідь у сантиметрах.', 2, 1.25, 1),
(6, 1, '', 'Одна сторона прямокутника дорівнює 4 см, а інша вдвічі довша. Знайдіть площу прямокутника. Дайте відповідь у квадратних сантиметрах.', 2, 1, 1),
(7, 1, '', 'Одна сторона прямокутника дорівнює 6 см, а його площа становить 42 см^2. Чому дорівнює інша сторона прямокутника? Дайте відповідь у сантиметрах.', 2, 1, 1),
(8, 1, '', 'Одна сторона прямокутника втричі більша за іншу, а його периметр дорівнює 32 см. Чому дорівнює менша сторона прямокутника? Дайте відповідь у сантиметрах.', 2, 1, 1),
(9, 1, '', 'Одна сторона прямокутника втричі більша за іншу, а периметр прямокутника дорівнює 56 см. Знайдіть більшу сторону прямокутника.', 2, 1, 1),
(10, 1, '', 'Два однакові квадрати, площею 36 см^2 кожен, склали так, що вийшов прямокутник. Чому дорівнює периметр цього прямокутника?', 2, 1, 1),
(11, 2, '', 'Виконати додавання:    -5 + (-9) =', 0, 1.5, 1),
(12, 2, '', 'Виконати додавання:    -3.1 + 5.2 =', 0, 1.5, 1),
(13, 2, '', 'Виконати додавання:    11 + 9.9 =', 1, 1.5, 1),
(14, 2, '', 'Виконати дії:    -7 + 4 =', 1, 1.5, 1),
(15, 2, '', 'Виконати віднімання:    7.1 - 3.6 =', 1, 1.5, 1),
(16, 2, '', 'Виконати дії:    4 - 8 =', 1, 1.5, 1),
(17, 2, '', 'Виконати дії:    1.5 + (-0.6) =', 1, 1.5, 1),
(18, 2, '', 'Виконати віднімання:    -10 - 1.4 =', 1, 1.5, 1),
(19, 2, '', 'Виконати додавання:    7.4 + 3.7 =', 1, 1.5, 1),
(20, 2, '', 'Виконати дії:    5.4 - (-5.6) =', 1, 1.5, 1),
(21, 3, '', 'Час руху тіла визначається за формулою:', 2, 1, NULL),
(22, 3, '', 'Частота обертання визначається за формулою:', 2, 1, NULL),
(23, 3, 'images/tests/3/23.jpg', 'Кулер комп’ютера за 50 секунд здійснює 2000 обертів. Чому дорівнює період обертання кулера?', 2, 1.5, NULL),
(24, 3, 'images/tests/3/24.jpg', 'Визначити швидкість руху поїзда:', 2, 1.5, NULL),
(25, 3, 'images/tests/3/25.jpg', 'Уявна лінія, яку описує в просторі точка, що рухається - це ...', 2, 3, NULL),
(26, 3, 'images/tests/3/26.jpg', 'Визначте, яка частота коливань гойдалки, якщо її період становить 5 с.', 2, 4, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_result`
--

CREATE TABLE `ticket_result` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_test_result_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL,
  `creating_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `ticket_result`
--

INSERT INTO `ticket_result` (`id`, `user_test_result_id`, `ticket_id`, `creating_time`) VALUES
(66, 16, 20, '2021-12-08 02:06:04'),
(67, 16, 11, '2021-12-08 02:06:08'),
(68, 16, 13, '2021-12-08 02:06:13'),
(69, 16, 17, '2021-12-08 02:06:16'),
(70, 16, 12, '2021-12-08 02:06:20'),
(71, 16, 14, '2021-12-08 02:06:24'),
(72, 16, 15, '2021-12-08 02:06:32'),
(73, 16, 18, '2021-12-08 02:06:35'),
(74, 16, 19, '2021-12-08 02:06:39'),
(75, 16, 16, '2021-12-08 02:06:43'),
(82, 19, 21, '2021-12-08 02:16:25'),
(83, 19, 25, '2021-12-08 02:16:52'),
(84, 19, 26, '2021-12-08 02:19:32'),
(85, 19, 24, '2021-12-08 02:19:35'),
(86, 19, 23, '2021-12-08 02:19:37'),
(87, 19, 22, '2021-12-08 02:19:38'),
(88, 20, 10, '2021-12-08 02:23:59'),
(89, 20, 5, '2021-12-08 02:24:00'),
(90, 20, 3, '2021-12-08 02:24:01'),
(91, 20, 4, '2021-12-08 02:24:02'),
(92, 20, 6, '2021-12-08 02:24:03'),
(93, 20, 7, '2021-12-08 02:24:04');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_type`
--

CREATE TABLE `ticket_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `ticket_type`
--

INSERT INTO `ticket_type` (`id`, `name`) VALUES
(1, 'single_answer'),
(2, 'multiple_answers');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthmonth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthyear` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mailing` tinyint(1) UNSIGNED DEFAULT NULL,
  `creating_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `username`, `birthday`, `birthmonth`, `birthyear`, `sex`, `mailing`, `creating_date`) VALUES
(1, 'asd@asd', '$2y$10$w7g5GGHbGe52XmQ41xBAjOcYlAsprJuyf0ySM5ptrJJg2Nfm2BVKy', 'asd@asd', '', '', '', '', 1, NULL),
(2, 'skdf@fsdjf', '$2y$10$FFtcEXkstd2xWY.UcJ4v0e8.EpkpX2YsJYeEjoH/4JxGCOzx3u.0O', 'fsdjf', '', '', '', '', 1, 'Sunday 21st 2021f November 2021 12:0:27 AM'),
(5, 'test@gmail.com', '$2y$10$osSg.0bSsB9StWYS0m5wkeIe4.HHHOcuf4sHqS27NSJTzUpzT9rPi', 'test', '4', '6', '2003', '1', 1, '05-12-2021 00:26:02'),
(6, 'knkirill46@gmail.com', '$2y$10$MeVLyu.fu4Me7CDXEpLFIucIywsUDgsujtHH43YFvDujc/B4kUIV.', 'kerrrusha', '4', '6', '2003', '1', 1, '06-12-2021 01:53:37');

-- --------------------------------------------------------

--
-- Структура таблицы `user_test_result`
--

CREATE TABLE `user_test_result` (
  `id` int(11) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `test_status_id` int(10) UNSIGNED NOT NULL,
  `in_favourite_list` tinyint(1) NOT NULL DEFAULT 0,
  `creating_time` datetime NOT NULL DEFAULT current_timestamp(),
  `last_start_time` datetime DEFAULT NULL,
  `last_finish_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_test_result`
--

INSERT INTO `user_test_result` (`id`, `uid`, `test_id`, `test_status_id`, `in_favourite_list`, `creating_time`, `last_start_time`, `last_finish_time`) VALUES
(16, 5, 2, 2, 0, '2021-12-08 02:05:56', '2021-12-08 01:05:56', '2021-12-08 01:15:14'),
(19, 5, 3, 2, 0, '2021-12-08 02:16:22', '2021-12-08 01:16:22', '2021-12-08 01:19:41'),
(20, 5, 1, 1, 0, '2021-12-08 02:23:58', '2021-12-08 01:23:58', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Индексы таблицы `answer_result`
--
ALTER TABLE `answer_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_id` (`chosen_answer_id`),
  ADD KEY `ticket_result_id` (`ticket_result_id`);

--
-- Индексы таблицы `key`
--
ALTER TABLE `key`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`uid`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_category_id` (`test_category_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `test_category`
--
ALTER TABLE `test_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `test_status`
--
ALTER TABLE `test_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `ticket_type_id` (`ticket_type_id`);

--
-- Индексы таблицы `ticket_result`
--
ALTER TABLE `ticket_result`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usertest_ticket` (`user_test_result_id`,`ticket_id`),
  ADD KEY `user_test_info_id` (`user_test_result_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Индексы таблицы `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_test_result`
--
ALTER TABLE `user_test_result`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user-test-unique` (`uid`,`test_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `test_status_id` (`test_status_id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT для таблицы `answer_result`
--
ALTER TABLE `answer_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `key`
--
ALTER TABLE `key`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `test_category`
--
ALTER TABLE `test_category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `test_status`
--
ALTER TABLE `test_status`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `ticket_result`
--
ALTER TABLE `ticket_result`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user_test_result`
--
ALTER TABLE `user_test_result`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`);

--
-- Ограничения внешнего ключа таблицы `answer_result`
--
ALTER TABLE `answer_result`
  ADD CONSTRAINT `answer_result_ibfk_1` FOREIGN KEY (`chosen_answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answer_result_ibfk_2` FOREIGN KEY (`ticket_result_id`) REFERENCES `ticket_result` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `key`
--
ALTER TABLE `key`
  ADD CONSTRAINT `key_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`test_category_id`) REFERENCES `test_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`ticket_type_id`) REFERENCES `ticket_type` (`id`);

--
-- Ограничения внешнего ключа таблицы `ticket_result`
--
ALTER TABLE `ticket_result`
  ADD CONSTRAINT `ticket_result_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ticket_result_ibfk_2` FOREIGN KEY (`user_test_result_id`) REFERENCES `user_test_result` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_test_result`
--
ALTER TABLE `user_test_result`
  ADD CONSTRAINT `user_test_result_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `user_test_result_ibfk_2` FOREIGN KEY (`test_status_id`) REFERENCES `test_status` (`id`),
  ADD CONSTRAINT `user_test_result_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);
COMMIT;
