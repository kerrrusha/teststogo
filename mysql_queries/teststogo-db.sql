-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.0.57
-- Время создания: Дек 28 2021 г., 00:13
-- Версия сервера: 5.7.35-38
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `f0610890_teststogo-db`
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
  `is_correct` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
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
  `creating_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `answer_result`
--

INSERT INTO `answer_result` (`id`, `chosen_answer_id`, `ticket_result_id`, `creating_time`) VALUES
(124, 81, 124, '2021-12-13 00:21:35'),
(125, 87, 125, '2021-12-13 00:21:53'),
(126, 90, 126, '2021-12-13 00:22:59'),
(127, 96, 127, '2021-12-13 00:23:03'),
(128, 99, 128, '2021-12-13 00:23:26'),
(129, 101, 129, '2021-12-13 00:24:09'),
(130, 40, 130, '2021-12-13 00:24:54'),
(131, 26, 131, '2021-12-13 00:25:18'),
(132, 22, 132, '2021-12-13 00:25:38'),
(133, 32, 133, '2021-12-13 00:26:24'),
(134, 4, 134, '2021-12-13 00:26:41'),
(135, 11, 135, '2021-12-13 00:26:56'),
(136, 16, 136, '2021-12-13 00:27:01'),
(137, 17, 137, '2021-12-13 00:27:23'),
(138, 35, 138, '2021-12-13 00:28:44'),
(139, 8, 139, '2021-12-13 00:29:33'),
(140, 63, 140, '2021-12-13 00:30:29'),
(141, 60, 141, '2021-12-13 00:30:53'),
(142, 65, 142, '2021-12-13 00:30:59'),
(143, 49, 143, '2021-12-13 00:31:07'),
(144, 79, 144, '2021-12-13 00:31:27'),
(145, 42, 145, '2021-12-13 00:31:31'),
(146, 48, 146, '2021-12-13 00:31:55'),
(147, 69, 147, '2021-12-13 00:32:00'),
(148, 76, 148, '2021-12-13 00:32:22'),
(149, 53, 149, '2021-12-13 00:32:31'),
(191, 26, 191, '2021-12-19 05:10:08'),
(192, 10, 192, '2021-12-19 05:10:11'),
(193, 4, 193, '2021-12-19 05:10:31'),
(194, 32, 194, '2021-12-19 05:10:43'),
(195, 5, 195, '2021-12-19 05:11:32'),
(196, 35, 196, '2021-12-19 05:11:42'),
(197, 16, 197, '2021-12-19 05:11:45'),
(198, 17, 198, '2021-12-19 05:12:05'),
(199, 22, 199, '2021-12-19 05:12:18'),
(200, 40, 200, '2021-12-19 05:12:27'),
(201, 81, 201, '2021-12-19 05:13:00'),
(202, 87, 202, '2021-12-19 05:13:02'),
(203, 90, 203, '2021-12-19 05:13:04'),
(204, 96, 204, '2021-12-19 05:13:06'),
(205, 99, 205, '2021-12-19 05:13:08'),
(206, 101, 206, '2021-12-19 05:13:10'),
(207, 49, 207, '2021-12-19 05:15:22'),
(208, 48, 208, '2021-12-19 05:15:29'),
(209, 76, 209, '2021-12-19 05:15:33'),
(210, 63, 210, '2021-12-19 05:15:36'),
(211, 79, 211, '2021-12-19 05:15:39'),
(212, 60, 212, '2021-12-19 05:15:42'),
(213, 69, 213, '2021-12-19 05:15:45'),
(214, 65, 214, '2021-12-19 05:15:48'),
(215, 42, 215, '2021-12-19 05:15:51'),
(216, 53, 216, '2021-12-19 05:15:53'),
(217, 81, 217, '2021-12-19 05:37:12'),
(218, 87, 218, '2021-12-19 05:37:14'),
(219, 90, 219, '2021-12-19 05:37:16'),
(220, 96, 220, '2021-12-19 05:37:18'),
(221, 99, 221, '2021-12-19 05:37:19'),
(222, 101, 222, '2021-12-19 05:37:20'),
(230, 81, 230, '2021-12-19 05:39:10'),
(231, 87, 231, '2021-12-19 05:39:12'),
(232, 90, 232, '2021-12-19 05:39:13'),
(233, 96, 233, '2021-12-19 05:39:15'),
(234, 99, 234, '2021-12-19 05:39:16'),
(235, 101, 235, '2021-12-19 05:39:17'),
(236, 81, 236, '2021-12-19 05:43:31'),
(237, 86, 237, '2021-12-19 05:43:34'),
(238, 90, 238, '2021-12-19 05:43:37'),
(239, 96, 239, '2021-12-19 05:43:38'),
(240, 99, 240, '2021-12-19 05:43:40'),
(241, 101, 241, '2021-12-19 05:43:41'),
(242, 42, 242, '2021-12-19 05:44:33'),
(243, 79, 243, '2021-12-19 05:44:34'),
(244, 65, 244, '2021-12-19 05:44:38'),
(245, 49, 245, '2021-12-19 05:44:44'),
(246, 69, 246, '2021-12-19 05:44:46'),
(247, 76, 247, '2021-12-19 05:44:49'),
(248, 60, 248, '2021-12-19 05:45:05'),
(249, 53, 249, '2021-12-19 05:45:07'),
(250, 63, 250, '2021-12-19 05:45:10'),
(251, 48, 251, '2021-12-19 05:45:14');

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
(31, NULL, '$2y$10$dBvNy/TLCZHU43k9MUV5guNaXnNyvrcuz7e4a4Enpgqib4b5mRqUy', '06-12-2021 01:50:02', NULL),
(32, NULL, '$2y$10$E3hlGIWZn7TPXNu9dqekkO1OKePSqaafacR4NtoUOETu324Of6X/O', '06-12-2021 01:53:49', NULL),
(33, NULL, '$2y$10$/l1G.v4U88i.kme4cZXRUenGDxkm8.7oENtteSsWIKuz6uGckra2y', '14-12-2021 15:53:34', 'test@gmail.com');

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
  `creating_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo_url` text NOT NULL,
  `show_answers` tinyint(1) NOT NULL DEFAULT '0',
  `testing_for_exam_points` tinyint(1) DEFAULT '0',
  `time_constraint_is_active` tinyint(1) NOT NULL DEFAULT '0',
  `time_constraint_in_seconds` int(11) NOT NULL DEFAULT '0',
  `tickets_shuffle` tinyint(1) NOT NULL DEFAULT '1',
  `for_authorised_users_only` tinyint(1) NOT NULL DEFAULT '0'
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
  `reward_score_points` double DEFAULT '0',
  `exam_points` double DEFAULT '0',
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
  `creating_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `ticket_result`
--

INSERT INTO `ticket_result` (`id`, `user_test_result_id`, `ticket_id`, `creating_time`) VALUES
(124, 28, 21, '2021-12-13 00:21:35'),
(125, 28, 22, '2021-12-13 00:21:53'),
(126, 28, 23, '2021-12-13 00:22:59'),
(127, 28, 24, '2021-12-13 00:23:03'),
(128, 28, 25, '2021-12-13 00:23:26'),
(129, 28, 26, '2021-12-13 00:24:09'),
(130, 29, 10, '2021-12-13 00:24:54'),
(131, 29, 7, '2021-12-13 00:25:18'),
(132, 29, 6, '2021-12-13 00:25:38'),
(133, 29, 8, '2021-12-13 00:26:24'),
(134, 29, 1, '2021-12-13 00:26:41'),
(135, 29, 3, '2021-12-13 00:26:56'),
(136, 29, 4, '2021-12-13 00:27:01'),
(137, 29, 5, '2021-12-13 00:27:23'),
(138, 29, 9, '2021-12-13 00:28:44'),
(139, 29, 2, '2021-12-13 00:29:33'),
(140, 30, 16, '2021-12-13 00:30:29'),
(141, 30, 15, '2021-12-13 00:30:53'),
(142, 30, 17, '2021-12-13 00:30:59'),
(143, 30, 13, '2021-12-13 00:31:07'),
(144, 30, 20, '2021-12-13 00:31:27'),
(145, 30, 11, '2021-12-13 00:31:31'),
(146, 30, 12, '2021-12-13 00:31:55'),
(147, 30, 18, '2021-12-13 00:32:00'),
(148, 30, 19, '2021-12-13 00:32:22'),
(149, 30, 14, '2021-12-13 00:32:31'),
(191, 41, 7, '2021-12-19 05:10:08'),
(192, 41, 3, '2021-12-19 05:10:11'),
(193, 41, 1, '2021-12-19 05:10:31'),
(194, 41, 8, '2021-12-19 05:10:43'),
(195, 41, 2, '2021-12-19 05:11:32'),
(196, 41, 9, '2021-12-19 05:11:42'),
(197, 41, 4, '2021-12-19 05:11:45'),
(198, 41, 5, '2021-12-19 05:12:05'),
(199, 41, 6, '2021-12-19 05:12:18'),
(200, 41, 10, '2021-12-19 05:12:27'),
(201, 42, 21, '2021-12-19 05:13:00'),
(202, 42, 22, '2021-12-19 05:13:02'),
(203, 42, 23, '2021-12-19 05:13:04'),
(204, 42, 24, '2021-12-19 05:13:06'),
(205, 42, 25, '2021-12-19 05:13:08'),
(206, 42, 26, '2021-12-19 05:13:10'),
(207, 43, 13, '2021-12-19 05:15:22'),
(208, 43, 12, '2021-12-19 05:15:29'),
(209, 43, 19, '2021-12-19 05:15:33'),
(210, 43, 16, '2021-12-19 05:15:36'),
(211, 43, 20, '2021-12-19 05:15:39'),
(212, 43, 15, '2021-12-19 05:15:42'),
(213, 43, 18, '2021-12-19 05:15:45'),
(214, 43, 17, '2021-12-19 05:15:48'),
(215, 43, 11, '2021-12-19 05:15:51'),
(216, 43, 14, '2021-12-19 05:15:53'),
(217, 44, 21, '2021-12-19 05:37:12'),
(218, 44, 22, '2021-12-19 05:37:14'),
(219, 44, 23, '2021-12-19 05:37:16'),
(220, 44, 24, '2021-12-19 05:37:18'),
(221, 44, 25, '2021-12-19 05:37:19'),
(222, 44, 26, '2021-12-19 05:37:20'),
(230, 46, 21, '2021-12-19 05:39:10'),
(231, 46, 22, '2021-12-19 05:39:12'),
(232, 46, 23, '2021-12-19 05:39:13'),
(233, 46, 24, '2021-12-19 05:39:15'),
(234, 46, 25, '2021-12-19 05:39:16'),
(235, 46, 26, '2021-12-19 05:39:17'),
(236, 47, 21, '2021-12-19 05:43:31'),
(237, 47, 22, '2021-12-19 05:43:34'),
(238, 47, 23, '2021-12-19 05:43:37'),
(239, 47, 24, '2021-12-19 05:43:38'),
(240, 47, 25, '2021-12-19 05:43:40'),
(241, 47, 26, '2021-12-19 05:43:41'),
(242, 48, 11, '2021-12-19 05:44:33'),
(243, 48, 20, '2021-12-19 05:44:34'),
(244, 48, 17, '2021-12-19 05:44:38'),
(245, 48, 13, '2021-12-19 05:44:44'),
(246, 48, 18, '2021-12-19 05:44:46'),
(247, 48, 19, '2021-12-19 05:44:49'),
(248, 48, 15, '2021-12-19 05:45:05'),
(249, 48, 14, '2021-12-19 05:45:07'),
(250, 48, 16, '2021-12-19 05:45:10'),
(251, 48, 12, '2021-12-19 05:45:14');

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
  `creating_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/avatar/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `username`, `birthday`, `birthmonth`, `birthyear`, `sex`, `mailing`, `creating_date`, `avatar_url`) VALUES
(1, 'asd@asd', '$2y$10$w7g5GGHbGe52XmQ41xBAjOcYlAsprJuyf0ySM5ptrJJg2Nfm2BVKy', 'asd@asd', '', '', '', '', 1, NULL, 'images/avatar/default.jpg'),
(2, 'skdf@fsdjf', '$2y$10$FFtcEXkstd2xWY.UcJ4v0e8.EpkpX2YsJYeEjoH/4JxGCOzx3u.0O', 'fsdjf', '', '', '', '', 1, 'Sunday 21st 2021f November 2021 12:0:27 AM', 'images/avatar/default.jpg'),
(5, 'test@gmail.com', '$2y$10$osSg.0bSsB9StWYS0m5wkeIe4.HHHOcuf4sHqS27NSJTzUpzT9rPi', 'test', '4', '6', '2003', '1', 1, '05-12-2021 00:26:02', 'images/avatar/default.jpg'),
(6, 'knkirill46@gmail.com', '$2y$10$MeVLyu.fu4Me7CDXEpLFIucIywsUDgsujtHH43YFvDujc/B4kUIV.', 'kerrrusha', '4', '6', '2003', '1', 1, '06-12-2021 01:53:37', '../images/avatar/6/photo_2021-09-01_17-17-22.jpg'),
(7, 'tfghjkh76@gmm', '$2y$10$nVEH7fykRnntJMT4sY9Dgu35cL9e44OPtbRay.3mcPRXWakEpxmLC', 'lalisa', '17', '4', '2011', '1', 1, '12-12-2021 23:17:08', 'images/avatar/default.jpg'),
(8, 'example@gmail.com', '$2y$10$kHDf0zeao0HB0bRTML0DK.o9bY3IMQwZRry56LxX.G3c5ryWyqvuO', 'example', '4', '6', '2003', '1', 1, '14-12-2021 18:47:26', 'images/avatar/default.jpg'),
(9, 'fall1n1@gmail.com', '$2y$10$fU9DvTya0h7zVVvNy8YNdeowByEdsS0YOdhcxFE3yKPfW/IBWeO.e', 'fall1n1', '4', '6', '2003', '1', 1, '19-12-2021 04:43:18', 'images/avatar/default.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `user_test_result`
--

CREATE TABLE `user_test_result` (
  `id` int(11) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `score_points` double NOT NULL DEFAULT '0',
  `exam_points` double NOT NULL DEFAULT '0',
  `test_status_id` int(10) UNSIGNED NOT NULL,
  `in_favourite_list` tinyint(1) NOT NULL DEFAULT '0',
  `creating_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_start_time` datetime DEFAULT NULL,
  `last_finish_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_test_result`
--

INSERT INTO `user_test_result` (`id`, `uid`, `test_id`, `score_points`, `exam_points`, `test_status_id`, `in_favourite_list`, `creating_time`, `last_start_time`, `last_finish_time`) VALUES
(28, 7, 3, 0, 0, 2, 0, '2021-12-13 00:21:28', '2021-12-12 23:21:28', '2021-12-12 23:24:11'),
(29, 7, 1, 0, 0, 2, 0, '2021-12-13 00:24:22', '2021-12-12 23:24:22', '2021-12-12 23:29:34'),
(30, 7, 2, 0, 0, 2, 0, '2021-12-13 00:30:21', '2021-12-12 23:30:21', '2021-12-12 23:32:32'),
(41, 5, 1, 16, 8.25, 2, 0, '2021-12-19 05:09:57', '2021-12-19 04:09:57', '2021-12-19 04:12:28'),
(42, 5, 3, 12, 12, 2, 0, '2021-12-19 05:12:58', '2021-12-19 04:12:58', '2021-12-19 04:13:11'),
(43, 5, 2, 8, 15, 2, 0, '2021-12-19 05:15:10', '2021-12-19 04:15:10', '2021-12-19 04:15:53'),
(44, 6, 3, 12, 12, 2, 0, '2021-12-19 05:37:11', '2021-12-19 04:37:11', '2021-12-19 04:37:21'),
(46, 8, 3, 12, 12, 2, 0, '2021-12-19 05:39:09', '2021-12-19 04:39:09', '2021-12-19 04:39:18'),
(47, 9, 3, 10, 11, 2, 0, '2021-12-19 05:43:30', '2021-12-19 04:43:30', '2021-12-19 04:43:42'),
(48, 6, 2, 8, 15, 2, 0, '2021-12-19 05:44:29', '2021-12-19 04:44:29', '2021-12-19 04:45:14'),
(54, 6, 1, 0, 0, 2, 0, '2021-12-22 21:34:29', '2021-12-22 20:34:29', '2021-12-22 20:34:38');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT для таблицы `key`
--
ALTER TABLE `key`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT для таблицы `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `user_test_result`
--
ALTER TABLE `user_test_result`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
