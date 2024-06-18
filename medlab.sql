-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июн 06 2024 г., 10:45
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `medlab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `title_category` varchar(255) NOT NULL,
  `description_category` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `title_category`, `description_category`, `photo`) VALUES
(1, 'Стоматология', 'Стоматология - это наука о физиологии, патологии, профилактике и лечении заболеваний полости рта и челюстно-лицевой области (ЧЛО).', 'libs/imgs/categories/1.png'),
(2, 'Онкология', 'Специализация, занимающаяся диагностикой, лечением и профилактикой онкологических заболеваний (рака).', 'libs/imgs/categories/2.png'),
(3, 'Гинекология', 'Медицинская область, которая изучает заболевания женских репродуктивных органов и обеспечивает здоровье женщин.', 'libs/imgs/categories/3.png'),
(4, 'Дерматология', 'Специализация, связанная с лечением кожных заболеваний, включая дерматиты, экземы и псориаз.', 'libs/imgs/categories/4.png'),
(5, 'Маммология', 'Отрасль медицины, занимающаяся диагностикой и лечением заболеваний молочных желез у женщин.', 'libs/imgs/categories/5.png'),
(6, 'Педиатрия', 'Медицинская специализация, ориентированная на заботу о здоровье детей.', 'libs/imgs/categories/6.png'),
(7, 'Массаж', 'Процедура, направленная на расслабление мышц, улучшение кровообращения и общее благополучие.', 'libs/imgs/categories/7.png'),
(9, 'Ревматология', 'Область медицины, изучающая заболевания соединительных тканей, суставов и костей.', 'libs/imgs/categories/2.png'),
(10, 'Ортопедия', 'Специализация, связанная с лечением заболеваний опорно-двигательной системы, включая переломы и деформации.', 'libs/imgs/categories/3.png');

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `id_doctor` int(11) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_lastname` varchar(255) NOT NULL,
  `doctor_secondname` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `work_category` varchar(255) DEFAULT NULL,
  `description_doctor` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`id_doctor`, `doctor_name`, `doctor_lastname`, `doctor_secondname`, `login`, `password`, `id_category`, `experience`, `type`, `work_category`, `description_doctor`) VALUES
(1, 'Евгений', 'Шакун', 'Владимирович', 'evgeniu', 'Evgeniu123', 1, 14, 'Взрослый', 'Высшая', 'Проработал 10 лет в Минской городской поликлинике №10, отучился в МГЛУ'),
(2, 'Елена', 'Малахова', 'Васильевна', 'elena12', '123', 1, 10, 'Взрослый', 'Высшая', ''),
(3, 'Надежда', 'Войтко', 'Сергеевна', 'nadya43', '123', 4, 12, 'Детский', 'Высшая', ''),
(5, 'Ксения', 'Серконова', 'Андреевна', 'ksenia2324', '123', 5, 13, 'Детский', 'Вторая', 'Образование и карьера. Образование: Доктор Серконова получила высшее медицинское образование в Московском медицинском университете имени И.М. Сеченова. Она успешно окончила факультет общей медицины и затем специализировалась в области рентгенологи. Специализация: Серконова Ксения Андреевна является маммологом с богатым опытом работы. Она специализируется на диагностике и лечении заболеваний молочных желез. Ее профессиональные интересы включают в себя раннюю диагностику рака молочной железы, маммографию, ультразвуковую диагностику и хирургическое лечение. \nСпециализация: Серконова Ксения Андреевна является маммологом с богатым опытом работы. Она специализируется на диагностике и лечении заболеваний молочных желез. Ее профессиональные интересы включают в себя раннюю диагностику рака молочной железы, маммографию, ультразвуковую диагностику и хирургическое лечение'),
(6, 'Александра', 'Макарова', 'Дмитриевна', 'alexsandra2', '123', 3, 10, 'Взрослый', 'Высшая', ''),
(7, 'Генадий', 'Серафимов', 'Дмитриевич', 'genadui', '123', 6, 8, 'Детский', 'Высшая', ''),
(8, 'Владимир', 'Миронов', 'Валерьевич', 'vlad435', '123', 7, 6, 'Детский', 'Высшая', ''),
(9, 'Марина', 'Петрова', 'Владимировна', 'marina', '12345', 2, 12, 'Взрослый', '14', ''),
(10, 'Георгий', 'Петров', 'Генадьевич', 'genadii', '12345', 7, NULL, NULL, NULL, NULL),
(11, 'Анна', 'Серафимович', 'Андреевна', 'anna234', '123', 9, 10, 'Детский', 'Высшая', 'Образование и карьера. Образование: Доктор Серафимович получила высшее медицинское образование в Минском Государственном медицинском университете. Она успешно окончила факультет общей медицины и затем специализировалась в области ревматологии. Она специализируется на диагностике и лечении заболеваний ревматологии. Ее профессиональные интересы включают в себя раннюю диагностику'),
(12, 'Елизавета', 'Афдосионова', 'Андреевна', 'liza45234', '12345', 4, NULL, NULL, NULL, NULL),
(15, 'Георгий', 'Петровинов', 'Генадьевич', 'geor12', '123', 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `iddoctorservice`
--

CREATE TABLE `iddoctorservice` (
  `id_doctorservice` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `time_work` time NOT NULL,
  `date_work` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `iddoctorservice`
--

INSERT INTO `iddoctorservice` (`id_doctorservice`, `id_doctor`, `id_category`, `status`, `time_work`, `date_work`) VALUES
(1, 2, 1, 'free', '12:00:00', '2024-05-23'),
(2, 2, 1, 'free', '13:00:00', '2024-05-23'),
(7, 2, 1, 'free', '14:00:00', '2024-05-23'),
(8, 1, 1, 'reserve', '13:00:00', '2024-05-23'),
(9, 2, 1, 'reserve', '15:00:00', '2024-05-23'),
(10, 2, 1, 'reserve', '15:00:00', '2024-05-27'),
(11, 2, 1, 'reserve', '12:00:00', '2024-05-28'),
(12, 2, 1, 'reserve', '12:00:00', '2024-05-29'),
(13, 1, 1, 'free', '12:00:00', '2024-05-29'),
(14, 2, 1, 'reserve', '12:00:00', '2024-05-28'),
(15, 2, 1, 'reserve', '13:00:00', '2024-05-26'),
(16, 3, 4, 'free', '13:00:00', '2024-05-27'),
(18, 5, 5, 'reserve', '18:00:00', '2024-06-10'),
(19, 2, 1, 'reserve', '14:00:00', '2024-05-27'),
(20, 2, 1, 'free', '13:00:00', '2024-05-27'),
(21, 1, 1, 'free', '14:00:00', '2024-05-29'),
(22, 1, 1, 'free', '13:00:00', '2024-05-29'),
(23, 1, 1, 'reserve', '11:00:00', '2024-05-29'),
(24, 1, 1, 'free', '11:00:00', '2024-05-30'),
(25, 1, 1, 'reserve', '12:00:00', '2024-05-30'),
(26, 1, 1, 'free', '11:00:00', '2024-05-28'),
(27, 1, 1, 'free', '12:00:00', '2024-05-28'),
(28, 1, 1, 'free', '13:00:00', '2024-05-28'),
(29, 1, 1, 'free', '10:00:00', '2024-05-28'),
(30, 1, 1, 'free', '09:00:00', '2024-05-28'),
(31, 1, 1, 'free', '08:00:00', '2024-05-28'),
(32, 1, 1, 'free', '14:00:00', '2024-05-28'),
(33, 1, 1, 'free', '08:00:00', '2024-05-29'),
(34, 1, 1, 'free', '09:00:00', '2024-05-29'),
(35, 1, 1, 'free', '10:00:00', '2024-05-29'),
(36, 1, 1, 'free', '08:00:00', '2024-05-30'),
(37, 1, 1, 'free', '09:00:00', '2024-05-30'),
(38, 1, 1, 'free', '10:00:00', '2024-05-30'),
(39, 1, 1, 'free', '13:00:00', '2024-05-30'),
(40, 1, 1, 'free', '14:00:00', '2024-05-30'),
(41, 1, 1, 'free', '08:00:00', '2024-05-27'),
(42, 1, 1, 'free', '09:00:00', '2024-05-27'),
(43, 1, 1, 'free', '10:00:00', '2024-05-27'),
(44, 1, 1, 'free', '08:00:00', '2024-05-31'),
(45, 1, 1, 'free', '09:00:00', '2024-05-31'),
(46, 1, 1, 'free', '10:00:00', '2024-05-31'),
(47, 1, 1, 'free', '11:00:00', '2024-05-27'),
(48, 1, 1, 'free', '12:00:00', '2024-05-27'),
(49, 1, 1, 'free', '18:00:00', '2024-05-28'),
(50, 1, 1, 'free', '17:00:00', '2024-05-28'),
(51, 1, 1, 'free', '17:00:00', '2024-05-29'),
(52, 1, 1, 'free', '18:00:00', '2024-05-29'),
(53, 1, 1, 'free', '17:00:00', '2024-05-30'),
(54, 1, 1, 'free', '18:00:00', '2024-05-30'),
(55, 1, 1, 'reserve', '08:00:00', '2024-06-13'),
(56, 1, 1, 'free', '09:00:00', '2024-06-13'),
(57, 1, 1, 'free', '10:00:00', '2024-06-13'),
(58, 1, 1, 'reserve', '11:00:00', '2024-06-13'),
(59, 1, 1, 'free', '12:00:00', '2024-06-13'),
(60, 1, 1, 'reserve', '13:00:00', '2024-06-13'),
(61, 1, 1, 'free', '08:00:00', '2024-06-12'),
(62, 1, 1, 'free', '09:00:00', '2024-06-12'),
(63, 1, 1, 'cancel', '10:00:00', '2024-06-12'),
(64, 1, 1, 'free', '11:00:00', '2024-06-12'),
(65, 1, 1, 'reserve', '12:00:00', '2024-06-12'),
(66, 1, 1, 'free', '13:00:00', '2024-06-12'),
(67, 1, 1, 'free', '08:00:00', '2024-06-11'),
(68, 1, 1, 'reserve', '09:00:00', '2024-06-11'),
(69, 1, 1, 'free', '10:00:00', '2024-06-11'),
(70, 1, 1, 'free', '11:00:00', '2024-06-11'),
(71, 1, 1, 'free', '12:00:00', '2024-06-11'),
(72, 1, 1, 'free', '13:00:00', '2024-06-11'),
(73, 1, 1, 'free', '15:00:00', '2024-05-28'),
(74, 1, 1, 'free', '12:00:00', '2024-05-31'),
(75, 1, 1, 'free', '13:00:00', '2024-05-31'),
(76, 1, 1, 'free', '14:00:00', '2024-05-31'),
(77, 1, 1, 'free', '15:00:00', '2024-05-31'),
(78, 1, 1, 'free', '12:00:00', '2024-06-19'),
(79, 1, 1, 'free', '13:00:00', '2024-06-19'),
(80, 1, 1, 'free', '14:00:00', '2024-06-19'),
(81, 1, 1, 'free', '15:00:00', '2024-06-19'),
(82, 1, 1, 'free', '11:00:00', '2024-05-31'),
(83, 1, 1, 'free', '11:00:00', '2024-06-20'),
(84, 1, 1, 'free', '12:00:00', '2024-06-20'),
(85, 1, 1, 'free', '10:00:00', '2024-06-21'),
(86, 1, 1, 'free', '11:00:00', '2024-06-21'),
(87, 1, 1, 'free', '10:00:00', '2024-06-10'),
(88, 1, 1, 'free', '11:00:00', '2024-06-10'),
(91, 5, 5, 'cancel', '08:00:00', '2024-06-07'),
(92, 5, 5, 'free', '11:00:00', '2024-06-07'),
(93, 5, 5, 'free', '12:00:00', '2024-06-07'),
(94, 5, 5, 'free', '13:00:00', '2024-06-07'),
(95, 5, 5, 'reserve', '08:00:00', '2024-06-08'),
(96, 5, 5, 'free', '09:00:00', '2024-06-08'),
(97, 5, 5, 'reserve', '10:00:00', '2024-06-08'),
(98, 5, 5, 'free', '11:00:00', '2024-06-08'),
(99, 5, 5, 'free', '12:00:00', '2024-06-08'),
(100, 5, 5, 'free', '13:00:00', '2024-06-08'),
(101, 5, 5, 'free', '08:00:00', '2024-06-12'),
(103, 5, 5, 'free', '10:00:00', '2024-06-12'),
(104, 5, 5, 'free', '11:00:00', '2024-06-12'),
(105, 5, 5, 'cancel', '12:00:00', '2024-06-12'),
(106, 5, 5, 'free', '13:00:00', '2024-06-12'),
(107, 5, 5, 'free', '08:00:00', '2024-06-11'),
(108, 5, 5, 'free', '09:00:00', '2024-06-11'),
(109, 5, 5, 'free', '10:00:00', '2024-06-11'),
(110, 5, 5, 'free', '11:00:00', '2024-06-11'),
(111, 5, 5, 'free', '12:00:00', '2024-06-11'),
(112, 5, 5, 'free', '13:00:00', '2024-06-11'),
(113, 5, 5, 'free', '12:00:00', '2024-06-06'),
(114, 5, 5, 'free', '12:00:00', '2024-06-05'),
(115, 5, 5, 'free', '12:00:00', '2024-06-20'),
(116, 5, 5, 'free', '13:00:00', '2024-06-20'),
(117, 5, 5, 'free', '12:00:00', '2024-06-19'),
(118, 5, 5, 'free', '13:00:00', '2024-06-19'),
(119, 8, 7, 'free', '08:00:00', '2024-06-19'),
(120, 8, 7, 'reserve', '08:00:00', '2024-06-20'),
(121, 8, 7, 'free', '09:00:00', '2024-06-20'),
(122, 8, 7, 'reserve', '09:00:00', '2024-06-19'),
(123, 8, 7, 'free', '08:00:00', '2024-06-18'),
(124, 8, 7, 'free', '09:00:00', '2024-06-18'),
(125, 8, 7, 'free', '08:00:00', '2024-06-21'),
(126, 8, 7, 'free', '09:00:00', '2024-06-21'),
(127, 8, 7, 'free', '18:00:00', '2024-06-14'),
(128, 8, 7, 'free', '18:00:00', '2024-06-15'),
(129, 11, 9, 'free', '14:00:00', '2024-06-20'),
(131, 11, 9, 'cancel', '16:00:00', '2024-06-20'),
(132, 11, 9, 'cancel', '14:00:00', '2024-06-21'),
(133, 11, 9, 'free', '15:00:00', '2024-06-21'),
(134, 11, 9, 'free', '16:00:00', '2024-06-21'),
(135, 11, 9, 'free', '14:00:00', '2024-06-27'),
(136, 11, 9, 'reserve', '15:00:00', '2024-06-27'),
(137, 11, 9, 'free', '16:00:00', '2024-06-27'),
(138, 11, 9, 'free', '12:00:00', '2024-06-21'),
(139, 11, 9, 'free', '13:00:00', '2024-06-21'),
(140, 11, 9, 'reserve', '12:00:00', '2024-06-20'),
(141, 11, 9, 'free', '13:00:00', '2024-06-20'),
(142, 11, 9, 'free', '10:00:00', '2024-06-30'),
(143, 11, 9, 'free', '11:00:00', '2024-06-29'),
(144, 11, 9, 'free', '12:00:00', '2024-06-29'),
(145, 11, 9, 'free', '10:00:00', '2024-06-29'),
(146, 11, 9, 'free', '11:00:00', '2024-06-30'),
(147, 11, 9, 'free', '12:00:00', '2024-06-30'),
(148, 9, 2, 'free', '12:00:00', '2024-06-03'),
(149, 9, 2, 'free', '13:00:00', '2024-06-03'),
(150, 9, 2, 'free', '14:00:00', '2024-06-03'),
(152, 9, 2, 'free', '16:00:00', '2024-06-03'),
(153, 9, 2, 'free', '17:00:00', '2024-06-03'),
(154, 9, 2, 'free', '18:00:00', '2024-06-03'),
(155, 9, 2, 'free', '19:00:00', '2024-06-03'),
(156, 9, 2, 'free', '14:00:00', '2024-06-07'),
(157, 9, 2, 'free', '13:00:00', '2024-06-07'),
(158, 9, 2, 'free', '12:00:00', '2024-06-07'),
(159, 9, 2, 'free', '15:00:00', '2024-06-07'),
(160, 9, 2, 'free', '16:00:00', '2024-06-07'),
(161, 9, 2, 'free', '17:00:00', '2024-06-07'),
(162, 9, 2, 'free', '18:00:00', '2024-06-07'),
(163, 9, 2, 'free', '19:00:00', '2024-06-07'),
(164, 9, 2, 'free', '12:00:00', '2024-06-04'),
(165, 9, 2, 'free', '13:00:00', '2024-06-04'),
(166, 9, 2, 'free', '14:00:00', '2024-06-04'),
(167, 9, 2, 'free', '17:00:00', '2024-06-04'),
(169, 9, 2, 'free', '15:00:00', '2024-06-04'),
(170, 9, 2, 'free', '18:00:00', '2024-06-04'),
(171, 9, 2, 'free', '19:00:00', '2024-06-04'),
(172, 9, 2, 'free', '14:00:00', '2024-06-05'),
(173, 9, 2, 'free', '13:00:00', '2024-06-05'),
(174, 9, 2, 'free', '12:00:00', '2024-06-05'),
(175, 9, 2, 'free', '15:00:00', '2024-06-05'),
(176, 9, 2, 'free', '16:00:00', '2024-06-05'),
(177, 9, 2, 'free', '17:00:00', '2024-06-05'),
(178, 9, 2, 'free', '18:00:00', '2024-06-05'),
(179, 9, 2, 'free', '19:00:00', '2024-06-05'),
(180, 9, 2, 'free', '12:00:00', '2024-06-06'),
(181, 9, 2, 'free', '15:00:00', '2024-06-06'),
(182, 9, 2, 'free', '14:00:00', '2024-06-06'),
(183, 9, 2, 'free', '13:00:00', '2024-06-06'),
(184, 9, 2, 'free', '16:00:00', '2024-06-06'),
(185, 9, 2, 'free', '17:00:00', '2024-06-06'),
(186, 9, 2, 'free', '18:00:00', '2024-06-06'),
(187, 9, 2, 'free', '19:00:00', '2024-06-06'),
(188, 6, 3, 'free', '12:00:00', '2024-06-27'),
(189, 6, 3, 'free', '13:00:00', '2024-06-27'),
(190, 6, 3, 'free', '14:00:00', '2024-06-27'),
(191, 6, 3, 'free', '12:00:00', '2024-06-29'),
(192, 6, 3, 'free', '13:00:00', '2024-06-29'),
(193, 6, 3, 'free', '14:00:00', '2024-06-29'),
(194, 6, 3, 'free', '12:00:00', '2024-06-28'),
(195, 6, 3, 'free', '13:00:00', '2024-06-28'),
(196, 6, 3, 'free', '14:00:00', '2024-06-28'),
(197, 6, 3, 'free', '11:00:00', '2024-06-14'),
(198, 6, 3, 'free', '12:00:00', '2024-06-14'),
(199, 6, 3, 'free', '11:00:00', '2024-06-13'),
(200, 6, 3, 'free', '12:00:00', '2024-06-13'),
(201, 12, 4, 'free', '18:00:00', '2024-06-26'),
(202, 12, 4, 'free', '19:00:00', '2024-06-26'),
(203, 12, 4, 'free', '20:00:00', '2024-06-26'),
(204, 12, 4, 'free', '21:00:00', '2024-06-26'),
(205, 12, 4, 'free', '18:00:00', '2024-06-25'),
(206, 12, 4, 'free', '19:00:00', '2024-06-25'),
(207, 12, 4, 'free', '20:00:00', '2024-06-25'),
(208, 12, 4, 'free', '21:00:00', '2024-06-25'),
(209, 12, 4, 'free', '18:00:00', '2024-06-24'),
(210, 12, 4, 'free', '19:00:00', '2024-06-24'),
(211, 12, 4, 'free', '20:00:00', '2024-06-24'),
(212, 12, 4, 'free', '21:00:00', '2024-06-24'),
(213, 3, 4, 'free', '09:00:00', '2024-06-20'),
(214, 3, 4, 'free', '08:00:00', '2024-06-20'),
(215, 3, 4, 'free', '10:00:00', '2024-06-20'),
(216, 3, 4, 'free', '11:00:00', '2024-06-20'),
(217, 3, 4, 'free', '12:00:00', '2024-06-20'),
(218, 3, 4, 'free', '13:00:00', '2024-06-20'),
(219, 3, 4, 'free', '08:00:00', '2024-06-21'),
(220, 3, 4, 'free', '09:00:00', '2024-06-21'),
(221, 3, 4, 'free', '10:00:00', '2024-06-21'),
(222, 3, 4, 'free', '11:00:00', '2024-06-21'),
(223, 3, 4, 'free', '12:00:00', '2024-06-21'),
(224, 3, 4, 'free', '13:00:00', '2024-06-21'),
(225, 3, 4, 'free', '08:00:00', '2024-06-22'),
(226, 3, 4, 'free', '09:00:00', '2024-06-22'),
(227, 3, 4, 'free', '10:00:00', '2024-06-22'),
(228, 3, 4, 'free', '11:00:00', '2024-06-22'),
(229, 3, 4, 'free', '12:00:00', '2024-06-22'),
(230, 3, 4, 'free', '13:00:00', '2024-06-22'),
(231, 3, 4, 'free', '08:00:00', '2024-06-18'),
(232, 3, 4, 'free', '09:00:00', '2024-06-18'),
(233, 3, 4, 'free', '10:00:00', '2024-06-18'),
(234, 3, 4, 'free', '11:00:00', '2024-06-18'),
(235, 3, 4, 'free', '12:00:00', '2024-06-18'),
(236, 3, 4, 'free', '13:00:00', '2024-06-18'),
(237, 3, 4, 'free', '08:00:00', '2024-06-19'),
(238, 3, 4, 'free', '09:00:00', '2024-06-19'),
(239, 3, 4, 'free', '12:00:00', '2024-06-19'),
(240, 3, 4, 'free', '11:00:00', '2024-06-19'),
(241, 3, 4, 'free', '10:00:00', '2024-06-19'),
(242, 3, 4, 'free', '13:00:00', '2024-06-19'),
(243, 2, 1, 'free', '09:00:00', '2024-06-19'),
(244, 2, 1, 'free', '10:00:00', '2024-06-19'),
(245, 2, 1, 'free', '11:00:00', '2024-06-19'),
(246, 2, 1, 'free', '12:00:00', '2024-06-19'),
(247, 2, 1, 'free', '13:00:00', '2024-06-19'),
(248, 2, 1, 'free', '09:00:00', '2024-06-20'),
(249, 2, 1, 'free', '10:00:00', '2024-06-20'),
(250, 2, 1, 'free', '11:00:00', '2024-06-20'),
(251, 2, 1, 'free', '12:00:00', '2024-06-20'),
(252, 2, 1, 'free', '13:00:00', '2024-06-20'),
(253, 2, 1, 'free', '09:00:00', '2024-06-21'),
(254, 2, 1, 'free', '10:00:00', '2024-06-21'),
(255, 2, 1, 'free', '11:00:00', '2024-06-21'),
(256, 2, 1, 'free', '12:00:00', '2024-06-21'),
(257, 2, 1, 'free', '13:00:00', '2024-06-21'),
(258, 2, 1, 'free', '09:00:00', '2024-06-22'),
(259, 2, 1, 'free', '10:00:00', '2024-06-22'),
(260, 2, 1, 'free', '11:00:00', '2024-06-22'),
(261, 2, 1, 'free', '13:00:00', '2024-06-22'),
(262, 2, 1, 'free', '12:00:00', '2024-06-22'),
(263, 2, 1, 'free', '08:00:00', '2024-07-04'),
(264, 2, 1, 'free', '09:00:00', '2024-07-04'),
(265, 2, 1, 'free', '10:00:00', '2024-07-04'),
(267, 2, 1, 'free', '12:00:00', '2024-07-04'),
(268, 2, 1, 'free', '13:00:00', '2024-07-04'),
(269, 2, 1, 'free', '14:00:00', '2024-07-04'),
(270, 2, 1, 'free', '08:00:00', '2024-07-05'),
(271, 2, 1, 'free', '11:00:00', '2024-07-05'),
(272, 2, 1, 'free', '10:00:00', '2024-07-05'),
(273, 2, 1, 'free', '09:00:00', '2024-07-05'),
(274, 2, 1, 'free', '12:00:00', '2024-07-05'),
(275, 2, 1, 'free', '13:00:00', '2024-07-05'),
(276, 2, 1, 'free', '14:00:00', '2024-07-05'),
(277, 2, 1, 'free', '08:00:00', '2024-07-06'),
(278, 2, 1, 'free', '09:00:00', '2024-07-06'),
(279, 2, 1, 'free', '10:00:00', '2024-07-06'),
(280, 2, 1, 'free', '11:00:00', '2024-07-06'),
(281, 2, 1, 'free', '12:00:00', '2024-07-06'),
(282, 2, 1, 'free', '13:00:00', '2024-07-06'),
(283, 2, 1, 'free', '14:00:00', '2024-07-06'),
(284, 2, 1, 'free', '10:00:00', '2024-06-13'),
(285, 2, 1, 'free', '09:00:00', '2024-06-13'),
(286, 2, 1, 'free', '08:00:00', '2024-06-13'),
(287, 2, 1, 'free', '11:00:00', '2024-06-13'),
(288, 2, 1, 'free', '12:00:00', '2024-06-13'),
(289, 2, 1, 'free', '13:00:00', '2024-06-13'),
(290, 2, 1, 'free', '14:00:00', '2024-06-13'),
(291, 2, 1, 'free', '15:00:00', '2024-06-13'),
(292, 2, 1, 'free', '08:00:00', '2024-06-14'),
(293, 2, 1, 'free', '09:00:00', '2024-06-14'),
(294, 2, 1, 'free', '10:00:00', '2024-06-14'),
(295, 2, 1, 'free', '11:00:00', '2024-06-14'),
(296, 2, 1, 'free', '12:00:00', '2024-06-14'),
(297, 2, 1, 'free', '13:00:00', '2024-06-14'),
(298, 2, 1, 'free', '14:00:00', '2024-06-14'),
(299, 2, 1, 'free', '15:00:00', '2024-06-14'),
(300, 2, 1, 'free', '08:00:00', '2024-06-15'),
(301, 2, 1, 'free', '09:00:00', '2024-06-15'),
(302, 2, 1, 'free', '10:00:00', '2024-06-15'),
(303, 2, 1, 'free', '11:00:00', '2024-06-15'),
(304, 2, 1, 'free', '12:00:00', '2024-06-15'),
(305, 2, 1, 'free', '13:00:00', '2024-06-15'),
(306, 2, 1, 'free', '14:00:00', '2024-06-15'),
(307, 2, 1, 'free', '15:00:00', '2024-06-15'),
(308, 2, 1, 'free', '08:00:00', '2024-06-16'),
(309, 2, 1, 'free', '09:00:00', '2024-06-16'),
(310, 2, 1, 'free', '10:00:00', '2024-06-16'),
(311, 2, 1, 'free', '11:00:00', '2024-06-16'),
(312, 2, 1, 'free', '12:00:00', '2024-06-16'),
(313, 2, 1, 'free', '13:00:00', '2024-06-16'),
(314, 2, 1, 'free', '14:00:00', '2024-06-16'),
(315, 2, 1, 'free', '15:00:00', '2024-06-16'),
(316, 2, 1, 'free', '16:00:00', '2024-06-13'),
(317, 2, 1, 'free', '17:00:00', '2024-06-13'),
(318, 2, 1, 'free', '18:00:00', '2024-06-13'),
(319, 2, 1, 'free', '19:00:00', '2024-06-13'),
(320, 2, 1, 'free', '20:00:00', '2024-06-13'),
(321, 2, 1, 'free', '21:00:00', '2024-06-13');

-- --------------------------------------------------------

--
-- Структура таблицы `reservation`
--

CREATE TABLE `reservation` (
  `id_reserve` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_reserve` date NOT NULL,
  `time_reserve` time NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reservation`
--

INSERT INTO `reservation` (`id_reserve`, `id_user`, `date_reserve`, `time_reserve`, `id_doctor`, `id_category`, `status`) VALUES
(8, 7, '2024-04-24', '12:00:00', 2, 1, 'cancel'),
(9, 4, '2024-05-18', '12:00:00', 2, 1, 'cancel'),
(10, 4, '2024-04-27', '13:00:00', 6, 7, 'cancel'),
(11, 8, '2024-04-26', '12:00:00', 2, 1, 'cancel'),
(12, 9, '2024-05-27', '15:00:00', 2, 1, 'cancel'),
(14, 4, '2024-06-10', '18:00:00', 5, 5, 'cancel'),
(16, 4, '2024-05-15', '19:00:00', 5, 5, 'cancel'),
(17, 4, '2024-05-15', '18:00:00', 3, 4, 'отзыв'),
(18, 4, '2024-05-13', '18:00:00', 6, 6, 'завершен'),
(19, 4, '2024-05-23', '13:00:00', 1, 1, 'завершен'),
(20, 4, '2024-05-27', '14:00:00', 2, 1, 'отзыв'),
(21, 6, '2024-06-20', '08:00:00', 8, 7, 'cancel'),
(22, 5, '2024-06-21', '14:00:00', 11, 9, 'cancel'),
(23, 5, '2024-06-20', '16:00:00', 11, 9, 'cancel'),
(24, 7, '2024-06-13', '08:00:00', 1, 1, 'confirmed'),
(25, 7, '2024-06-19', '09:00:00', 8, 7, 'confirmed'),
(26, 9, '2024-06-27', '15:00:00', 11, 9, 'confirmed'),
(27, 9, '2024-06-20', '12:00:00', 11, 9, 'confirmed'),
(28, 9, '2024-06-13', '11:00:00', 1, 1, 'confirmed'),
(29, 10, '2024-06-12', '10:00:00', 1, 1, 'cancel');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text_review` text NOT NULL,
  `review_star` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id_review`, `id_user`, `text_review`, `review_star`, `id_doctor`) VALUES
(1, 4, 'Я хочу выразить свою благодарность доктору Евгению за его профессионализм и заботу. ', 5, 1),
(2, 5, 'Я обратился к нему с проблемой болей в спине, и он провел тщательное обследование, чтобы выяснить причину моих болей. Спасибо!', 4, 1),
(3, 7, 'Доктор Иванова - исключительный стоматолог. Она всегда тщательно объясняет процедуры и делает все возможное, чтобы сделать визит комфортным. Я очень рекомендую ее!', 3, 1),
(4, 7, 'Она всегда тщательно объясняет процедуры и делает все возможное, чтобы сделать визит комфортным. Я очень рекомендую ее!', 3, 3),
(5, 8, 'Прекрасный врач Маммолог. Хочу к ней на протяжении 5 лет. Всегда делает диагностику целиком.', 4, 5),
(6, 7, 'Иван лучший врач! Хожу к нему на протяжении 5 лет, всегда делает полный осмотр и показывает свою квалификацию!', 3, 9),
(7, 8, 'Рекомендую Ксению как врача. Знаток своего дела, всегда выполняет работу на все 100 процентов.', 3, 5),
(8, 4, 'Добрый день! Посещала прием данного врача, могу сказать тольке хорошее о ней!', 5, 6),
(9, 4, 'Прекрасный врач!! Осталось только хорошее впечатление!!', 5, 3),
(10, 4, 'Добрый день! Прекрасный врач! Надежда невероятно профессиональный врач!', 5, 3),
(11, 4, 'Врач очень профессиональный! Хорошо справляется со своей работой!', 5, 3),
(12, 4, 'Посещала прием у данного врача, могу сказать только хорошие слова. Спасибо большое за вашу работу!', 5, 3),
(13, 4, 'Я хочу выразить свою благодарность доктору Надежде за его профессионализм и заботу. ', 5, 3),
(14, 4, 'Добрый день! Посещала прием данного врача, могу сказать только хорошее о ней!', 5, 3),
(15, 4, 'Прекрасный врач!! Осталось только хорошее впечатление!! Понравился сервис и сам врач добрая и отзывчивая!', 5, 5),
(16, 4, 'Макарова Александра Дмитриевна лучший врач! Хожу к ней на протяжении 5 лет, всегда делает полный осмотр и показывает свою квалификацию!', 5, 6),
(17, 4, 'Добрый день! Посещала прием данного врача, могу сказать тольке хорошее о ней!', 5, 11),
(18, 10, 'Я хочу выразить свою благодарность доктору Анне за ее профессионализм и заботу. ', 5, 11),
(19, 6, 'Доктор Серафимов - исключительный педиатр. Он всегда тщательно объясняет процедуры и делает все возможное, чтобы сделать визит комфортным. Я очень рекомендую его!', 4, 7),
(20, 10, 'Добрый день! Посещала прием данного врача, могу сказать только хорошее о нем!', 4, 15),
(21, 5, 'Прекрасный врач! Посещала прием данного врача, могу сказать только хорошее о нем!', 5, 15),
(22, 4, 'Прекрасный врач!! Осталось только хорошее впечатление!!', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `role`) VALUES
(1, 'Администратор'),
(2, 'Пациент');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id_service` int(11) NOT NULL,
  `title_service` varchar(255) NOT NULL,
  `description_service` text NOT NULL,
  `price` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id_service`, `title_service`, `description_service`, `price`, `id_category`) VALUES
(4, 'Консультация стоматолога-терапевта', 'Врач проводит осмотр, диагностику и консультацию по лечению зубов.', 20, 1),
(5, 'Лечение кариеса', 'Удаление пораженной ткани и пломбирование зубов.', 170, 1),
(6, 'Лечение одного канала', 'Эндодонтическое лечение для спасения зуба. ', 250, 1),
(7, 'Консультация стоматолога-ортодонта', 'Оценка состояния прикуса и рекомендации по ортодонтическому лечению.', 40, 1),
(8, 'Сканирование зубного ряда с планом лечения на брекет-системах', 'Подготовка к ортодонтическому лечению.', 460, 1),
(9, 'Консультация стоматолога-хирурга', 'Оценка состояния зубов и челюсти, рекомендации по хирургическим вмешательствам.', 40, 1),
(10, 'Панорамный снимок зубов', 'Диагностика состояния зубочелюстной системы', 50, 1),
(11, 'Телерентгенография (цифровая цефалография)', 'Диагностика прикуса и челюстей', 50, 1),
(12, 'Эстетическая реставрация переднего зуба', 'Восстановление внешнего вида зуба с использованием современных материалов.', 220, 1),
(13, 'Консультация гинеколога', 'Врач проводит осмотр, диагностику и консультацию по женскому здоровью.', 50, 3),
(14, 'Диагностика беременности', 'Ультразвуковое исследование для определения беременности и оценки состояния плода.', 30, 3),
(15, 'Лечение бесплодия', 'Диагностика и лечение женского бесплодия.', 380, 3),
(16, 'Женский Чек-ап', 'Комплексное обследование женского здоровья, включая анализы, УЗИ и консультацию специалистов.', 340, 3),
(17, 'Диагностика рака', 'Комплексное обследование для выявления онкологических заболеваний. Включает в себя лабораторные анализы, УЗИ, МРТ, КТ и биопсию.', 950, 2),
(18, 'Хирургическое лечение', 'Операции для удаления опухолей, лимфоузлов или других пораженных тканей.', 990, 2),
(19, 'Лучевая терапия', 'Использование рентгеновских лучей или частиц для лечения рака.', 670, 2),
(20, 'Иммунотерапия', 'Активация иммунной системы для борьбы с раковыми клетками.', 450, 2),
(21, 'Гормонотерапия', 'Применение гормонов для контроля роста опухоли.', 450, 2),
(22, 'Реабилитация после лечения', 'Физиотерапия, психологическая поддержка и восстановление после операций и химиотерапии.', 320, 2),
(23, 'Общий осмотр педиатра', 'Оценка физического и нервно-психического развития ребенка. Врач проводит осмотр, измеряет параметры, задает вопросы и дает рекомендации.', 30, 6),
(24, 'Профилактические осмотры и вакцинация', 'Регулярные осмотры для контроля роста, развития и вакцинации. Врач следит за соответствием ребенка возрастным нормам.', 50, 6),
(25, 'Диагностика аллергических реакций', 'Исследование аллергических состояний, аллергенов и назначение лечения.', 40, 6),
(26, 'Лечение ОРВИ и других инфекций', 'Диагностика и лечение вирусных и бактериальных заболеваний у детей.', 20, 6),
(27, 'Удаление родинок', 'Удаление родинок радиоволновым методом и на новейшем CO2-лазере AcuPulse от компании Lumenis', 50, 4),
(28, 'Удаление бородавок', 'Удаление бородавок радиоволновым методом и на новейшем CO2-лазере AcuPulse от компании Lumenis', 50, 4),
(29, 'Массаж \"Полное расслабление\"', 'Неверотяно приятный 70-ти минутный массаж с маслами кокоса', 100, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `name`, `last_name`, `second_name`, `phone`, `email`, `id_role`, `age`, `created_at`, `password`) VALUES
(4, 'Софья', 'Шкуратова', 'Витальевна', '+375447924677', 'sonya.shkur@bk.ru', 2, 28, '2024-04-15 06:09:55', '$2y$10$.pU1tRl06yeyLUTjesL1nO3siXDFzeGpObKtp5xhXVOEbXuD5RaSO'),
(5, 'Иван', 'Беганский', 'Сергеевич', '+375297924777', 'ivansdf@mail.com', 2, 18, '2024-04-15 14:11:48', '$2y$10$gPZ2.jXzIyDXMGezH07nG.N2ygR8sh6zrZ8MThkxaKLpd.rHw1o8G'),
(6, 'Виталий', 'Сидоров', 'Георгиевич', '+375447923456', 'soka@bk.ru', 2, 27, '2024-04-18 14:18:59', '$2y$10$MkHs6Js7lUR6npZeX.GMv.Vhf39o3hv5ScK1XGl1OL0qN4lmWuGeu'),
(7, 'Иван', 'Гаврилов', '', '+375447654344', 'sof.hr@gmail.ru', 2, 0, '2024-04-19 06:07:29', '$2y$10$kHoA61CEl5o0IM6si6XNgeVgKf0qedeMG7m.dDyR9dE2O17pwhXp2'),
(8, 'Евгений', 'Шимаров', NULL, 'admin', 'doasod@', 1, NULL, NULL, '$2y$10$Tb34BMutkGh53K.7E.GRreDKN0p0xoqcE3ywR7rK1tEdSmBMVv7gi'),
(9, 'Егор', 'Петров', '', '+375295609433', '', 2, 18, '2024-05-11 07:21:44', '$2y$10$Tb34BMutkGh53K.7E.GRreDKN0p0xoqcE3ywR7rK1tEdSmBMVv7gi'),
(10, 'Ксюша', 'Крюкова', '', '+375445799559', '', 2, 21, '2024-06-03 07:41:24', '$2y$10$NOq5weP/V2hhpXQSpFs/cOKdHYZxkIF.L5tnnEme4kcHIvnIfssG2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id_doctor`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `iddoctorservice`
--
ALTER TABLE `iddoctorservice`
  ADD PRIMARY KEY (`id_doctorservice`),
  ADD KEY `id_doctorservice` (`id_doctorservice`),
  ADD KEY `id_user` (`id_doctor`,`id_category`),
  ADD KEY `iddoctorservice_ibfk_2` (`id_category`);

--
-- Индексы таблицы `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reserve`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_reserve` (`id_reserve`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_review` (`id_review`,`id_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_doctor_2` (`id_doctor`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD KEY `id_role` (`id_role`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `id_service` (`id_service`,`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `iddoctorservice`
--
ALTER TABLE `iddoctorservice`
  MODIFY `id_doctorservice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT для таблицы `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reserve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `iddoctorservice`
--
ALTER TABLE `iddoctorservice`
  ADD CONSTRAINT `iddoctorservice_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iddoctorservice_ibfk_3` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`id_doctor`) REFERENCES `doctors` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
