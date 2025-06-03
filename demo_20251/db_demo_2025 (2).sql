-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июн 03 2025 г., 11:53
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
-- База данных: `db_demo_2025`
--

-- --------------------------------------------------------

--
-- Структура таблицы `application`
--

CREATE TABLE `application` (
  `id_application` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pay` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `status_info` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `phone` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `application`
--

INSERT INTO `application` (`id_application`, `id_user`, `id_pay`, `id_service`, `id_status`, `status_info`, `description`, `date`, `time`, `phone`, `address`) VALUES
(1, 2, 1, 1, 2, 'т ', '', '2024-12-29', '01:31:00', '+7(999)-999-99-99', 'Заявка'),
(2, 1, 2, 1, 2, 'Плохая заявка', 'Описание', '2024-12-15', '23:35:00', '+7(999)-999-99-99', 'Просто заявка'),
(3, 2, 2, 3, 3, NULL, '', '2024-12-01', '21:04:00', '+7(999)-999-99-99', 'Просто заявка'),
(4, 3, 1, 2, 2, 'простол', '', '2025-05-29', '12:12:00', '+79688566074', 'Химки '),
(5, 3, 1, 2, 3, NULL, '', '2025-05-16', '11:11:00', '+79688566074', 'Химки '),
(6, 2, 2, 4, 2, 'y', '', '2025-05-24', '23:23:00', '+79688566074', 'Химки '),
(7, 4, 1, 2, 3, NULL, '', '2025-12-12', '12:12:00', '+723456789', 'Химки '),
(8, 2, 1, 1, 3, NULL, '', '1111-11-11', '11:01:00', '+723456789', 'Ленина д. 1, кв. 2'),
(9, 10, 1, 1, 2, 'просто', 'уборка', '5555-05-05', '05:55:00', '+79688566074', 'Ленина д. 1, кв. 2'),
(10, 10, 1, 1, 4, NULL, 'тест', '6666-06-06', '07:59:00', '+7 (993) 266-6074', 'Химки'),
(11, 10, 1, 2, 3, NULL, '', '8888-08-08', '08:59:00', '+7 (993) 266-60-7', 'Химки'),
(12, 11, 1, 3, 1, NULL, '', '2025-11-11', '11:01:00', '+79688566074', 'Ленина д. 1, кв. 2');

-- --------------------------------------------------------

--
-- Структура таблицы `pay`
--

CREATE TABLE `pay` (
  `id_pay` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pay`
--

INSERT INTO `pay` (`id_pay`, `name`) VALUES
(1, 'Наличные'),
(2, 'Банковская карта');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id_role`, `name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id_service`, `name`) VALUES
(1, 'Иная услуга'),
(2, 'Общий клининг'),
(3, 'Генеральная уборка'),
(4, 'Послестроительная уборка'),
(5, 'Химчистка ковров и мебели');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `code`, `status`) VALUES
(1, 'new', 'Новая'),
(2, 'canceled', 'Отменена'),
(3, 'confirmed', 'Выполнена'),
(4, 'process', 'В работе');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `name`, `surname`, `patronymic`, `login`, `phone`, `email`, `password`, `id_role`) VALUES
(1, 'Татьяна', 'Михеева', 'Александровна', 'pechora', '+7(999)-999-99-99', 'pechora@mail.ru', '123456', 1),
(2, 'Админ', 'Админ', 'Админович', 'adminka', '+7(999)-999-99-99', 'admin@mail.ru', 'password', 2),
(3, 'Мери', 'Варданян', 'Вардановна', 'maryvard', '+7(968)-856-60-74', 'mary.vardanian.1@gmail.com', '87654321', 1),
(4, 'Иван', 'Иванов', 'Петрович', 'ivan', '+723456789', 'Ivan@mail.ru', '123456', 1),
(5, 'Иван', 'Иванов', 'Иванович', 'vanyan', '+723456789', 'Ivannnn@mail.ru', 'admin', 1),
(6, 'Коля', 'Колян', 'Никол', 'kolya', '+723456789', 'kol@mail.ru', 'admin', 1),
(7, 'Вася', 'Пупкин', 'Васьян', 'vaska', '12345678', 'vasyannn@mail.ru', 'admin', 1),
(8, 'Мери', 'Варданян', 'Петрович', 'pis', '12345678', 'mary.vardanian.11111@gmail.com', 'admin', 1),
(9, 'Пшыощу', 'Поымщуво', 'Иванович', 'hnkj', '+79688566074', 'ytfvu@mail.ru', 'admin', 1),
(10, 'Паша', 'Пупкин', 'Иванович', 'pasha', '+79688566074', 'pasha@mail.ru', '123456', 1),
(11, 'катя', 'кате', 'иинолд', 'kate', '+79688566074', 'mary.vardanian.1@gmail.com', 'password', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id_application`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pay` (`id_pay`),
  ADD KEY `id_service` (`id_service`),
  ADD KEY `id_status` (`id_status`);

--
-- Индексы таблицы `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `application`
--
ALTER TABLE `application`
  MODIFY `id_application` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `pay`
--
ALTER TABLE `pay`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`id_pay`) REFERENCES `pay` (`id_pay`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`),
  ADD CONSTRAINT `application_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
