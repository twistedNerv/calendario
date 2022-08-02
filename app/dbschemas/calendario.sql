-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 02, 2022 at 07:01 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendario`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomodation`
--

CREATE TABLE `accomodation` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `price` decimal(10,0) DEFAULT 0,
  `comment` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `accomodation`
--

INSERT INTO `accomodation` (`id`, `customer_id`, `bed_id`, `date_start`, `date_end`, `price`, `comment`, `room_id`) VALUES
(1, 1, 1, '2022-07-28', '2022-08-05', '45', '', 1),
(3, 1, 7, '2022-08-07', '2022-08-13', '55', 'test', 2),
(8, 2, 10, '2022-08-15', '2022-08-23', '150', '', 3),
(10, 3, 4, '2022-08-03', '2022-08-24', '200', '', 1),
(11, 1, 9, '2022-09-04', '2022-09-11', '90', '', 3),
(12, 2, 10, '2022-08-01', '2022-08-07', '90', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `actiongroup`
--

CREATE TABLE `actiongroup` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `action` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `section` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `bed_type` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `room_id`, `title`, `description`, `bed_type`) VALUES
(1, 1, 'Top left', 'Bunk bed on top of the left side of the room', 'bunk'),
(2, 1, 'Bottom left', 'Bunk bed on top of the left side of the room', 'bunk'),
(3, 1, 'Top right', 'Bunk bed on top of the right side of the room', 'bunk'),
(4, 1, 'Bottom right', 'Bunk bed on bottom of the right side of the room', 'bunk'),
(5, 2, 'First bed', 'First single bed in the room', 'single'),
(6, 2, 'Second bed', 'Second single bed in the room', 'single'),
(7, 2, 'Top bunk', 'Top bed in bunk composition', 'bunk'),
(8, 2, 'Bottom bunk', 'Bottom bunk bed in the room', 'bunk'),
(9, 3, 'Double left', 'Left side of bed in double room ', 'double'),
(10, 3, 'Double right', 'Right side of the double bed', 'double');

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `content` longtext COLLATE utf8_slovenian_ci NOT NULL,
  `postdate` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `postuser` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `visible` varchar(45) COLLATE utf8_slovenian_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `hash` varchar(45) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `gender`, `address`, `city`, `country`, `phone`, `email`, `comment`, `hash`) VALUES
(1, 'Sebastjan', 'Mlekuž', 1, 'Trubarjeva 40', 'Celje', 'Slovenia', '345678', 'ghjkl@hgdfs.jk', NULL, '62e7e6e59dfe3'),
(2, 'Ana', 'Ban', 2, 'Slovenska 35', 'Ljubljana', 'Slovenia', '67890', 'anaban@gmail.com', NULL, '62e7e6f6a8bce'),
(3, 'Janez', 'Novak', 1, 'Na piramido 16', 'Maribor', 'Slovenia', '98765', 'janez.novak@gmail.si', NULL, '62e7e709cd8f1');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `section` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `date` date NOT NULL,
  `start` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `duration` int(11) DEFAULT 1,
  `location` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `title` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT 0,
  `comment` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `pickup_location` varchar(100) COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `section`, `date`, `start`, `duration`, `location`, `title`, `description`, `price`, `comment`, `pickup_location`) VALUES
(4, '2', '2022-08-04', '12:30', 3, 'Puerto del Carmen', 'Sup session', 'Some sup session', '35', 'Lorem ipsum dolor sit amet', 'House front'),
(5, '3', '2022-07-04', '11:00', 2, 'Gym', 'Yoga class', 'Some description', '30', 'Today meditating yoga', 'House front'),
(7, '1', '2022-08-12', '11:00', 3, 'wer', 'wer', 'wer', '35', '35', 'wer'),
(8, '5', '2022-08-11', '17:00', 2, 'sdf', 'sdf', 'sdf', '45', '', 'sdf'),
(9, '1', '2022-08-21', '11:30', 2, 'sdf', 'dwf', 'sdf', '40', '', 'sdf'),
(11, '4', '2022-08-13', '09:00', 3, 'rtz', 'rtz', 'rtz', '33', '', 'rtz'),
(12, '5', '2022-08-04', '12:00', 3, 'Behind', 'Climbing', 'Some description', '35', '', 'Parking'),
(13, '1', '2022-08-18', '13.30', 3, 'Arrieta', 'test', 'with instructor', '35', '', 'House front'),
(14, '5', '2022-08-25', '16:00', 4, 'Montagna Roja', 'skydiving', 'Parachute flying session', '60', '', 'Hostel'),
(15, '4', '2022-08-01', '08:00', 4, 'dfgdf', 'gdfsgd', 'dfgd', '44', '', 'dfgdf'),
(16, '4', '2022-08-11', '11:00', 5, 'asdas', 'asdas', 'dfasdas', '55', '', 'asdsa'),
(17, '1', '2022-08-01', '09:00', 2, 'Famara', 'dfgfd', 'dfgdfg', '35', 'fdsdf', 'dfgdfg'),
(18, '1', '2022-08-15', '11:00', 3, 'sdfgsdfgsdf', 'fdsdf', 'sdfgsdfg', '35', '', 'gsdfgsdfg'),
(19, '3', '2022-08-15', '02:00', 6, 'dfgh', 'hfgh', 'dfghdfg', '66', '', 'dfgh'),
(20, '2', '2022-08-02', '13:30', 4, 'ghdfghdf', 'dfghd', 'dfghdf', '45', '', 'ghdg'),
(23, '3', '2022-08-11', '21:00', 6, 'dfg', 'dfg', 'dfg', '50', '', 'dfg'),
(24, '4', '2022-08-08', '10:00', 2, 'test', 'test', 'test', '35', '', 'test'),
(25, '1', '2022-08-04', '11:30', 3, 'uuu', 'uuu', 'uuu', '45', 'test', 'uuu'),
(27, '1', '2022-08-16', '10:00', 3, 'Arrieta', 'Beginner course', 'Bla bla', '45', 'Some new people trying to surf', 'House front');

-- --------------------------------------------------------

--
-- Table structure for table `event_customer`
--

CREATE TABLE `event_customer` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `event_customer`
--

INSERT INTO `event_customer` (`id`, `event_id`, `customer_id`) VALUES
(1, 4, 1),
(2, 5, 3),
(3, 5, 2),
(4, 5, 1),
(7, 4, 3),
(8, 14, 1),
(11, 23, 3),
(12, 24, 2),
(13, 24, 1),
(31, 25, 1),
(32, 25, 2),
(38, 27, 1),
(39, 27, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event_instructor`
--

CREATE TABLE `event_instructor` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `event_instructor`
--

INSERT INTO `event_instructor` (`id`, `event_id`, `instructor_id`) VALUES
(1, 23, 1),
(2, 24, 1),
(6, 25, 1),
(9, 27, 2);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `name`, `surname`, `gender`, `address`, `city`, `country`, `phone`, `email`, `comment`) VALUES
(1, 'John', 'Instructor', 1, 'Some address 44', 'Puerto del Carmen', 'Spain', '6534543', 'john@instructor.com', 'Here be some comment'),
(2, 'Diego', 'Gabrielli', 1, 'C. la Graciosa, 5', 'Puerto del Carmen', 'Spain', '45235965', 'diego@school3s.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `log` varchar(300) DEFAULT NULL,
  `datetime` varchar(45) DEFAULT NULL,
  `userid` varchar(45) DEFAULT NULL,
  `userip` varchar(45) DEFAULT NULL,
  `useragent` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `type`, `log`, `datetime`, `userid`, `userip`, `useragent`) VALUES
(1, 'login', 'Logged in with userid: 1 / mail: test@test.test', '20.07.2022 08:27:18', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(2, 'login', 'Logged in with userid: 1 / mail: test@test.test', '20.07.2022 09:34:37', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(3, 'section', 'section successfully added.', '20.07.2022 09:49:26', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(4, 'section', 'section successfully added.', '20.07.2022 09:50:53', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(5, 'section', 'section successfully added.', '20.07.2022 09:51:09', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(6, 'section', 'Section element with id: 2 updated successfully.', '20.07.2022 09:51:17', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(7, 'section', 'Section element with id: 1 updated successfully.', '20.07.2022 09:51:24', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(8, 'section', 'section successfully added.', '20.07.2022 09:51:46', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(9, 'section', 'section successfully added.', '20.07.2022 09:52:08', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(10, 'api', 'event successfully added.', '22.07.2022 10:07:02', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(11, 'api', 'Event element with title:Sup session event successfully added.', '22.07.2022 10:09:58', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(12, 'api', 'Event element with title:Yoga class event successfully added.', '22.07.2022 10:13:41', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(13, 'login', 'Logged in with userid: 1 / mail: test@test.test', '22.07.2022 10:18:48', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(14, 'login', 'Logged in with userid: 1 / mail: test@test.test', '22.07.2022 10:28:26', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(15, 'login', 'Logged in with userid: 1 / mail: test@test.test', '22.07.2022 10:28:51', '1', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Safari/537.36'),
(16, 'section', 'Section element with id: 3 updated successfully.', '22.07.2022 12:10:27', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(17, 'api', 'Event element with title:Ocean yoga event successfully added.', '22.07.2022 12:21:52', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(18, 'section', 'Section element with id: 2 updated successfully.', '22.07.2022 14:40:07', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(19, 'section', 'Section element with id: 2 updated successfully.', '22.07.2022 14:40:10', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(20, 'api', 'Event element with title:wer event successfully added.', '25.07.2022 10:42:25', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(21, 'api', 'Event element with title:sdf event successfully added.', '25.07.2022 10:53:24', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(22, 'api', 'Event element with title:dwf event successfully added.', '25.07.2022 11:04:57', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(23, 'api', 'Event element with title:asd event successfully added.', '25.07.2022 11:10:42', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(24, 'api', 'Event element with title:rtz event successfully added.', '25.07.2022 12:00:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(25, 'api', 'Event element with title:Climbing event successfully added.', '25.07.2022 12:14:48', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(26, 'login', 'Logged in with userid: 1 / mail: test@test.test', '27.07.2022 09:56:04', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(27, 'instructor', 'instructor successfully added.', '27.07.2022 10:54:29', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(28, 'api', 'Event element with title:test event successfully added.', '27.07.2022 11:04:30', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(29, 'api', 'Event element with title:skydiving event successfully added.', '27.07.2022 11:21:44', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(30, 'api', 'Event element with title:gdfsgd event successfully added.', '27.07.2022 11:25:35', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(31, 'api', 'Event element with title:asdas event successfully added.', '27.07.2022 11:29:32', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(32, 'api', 'Event element with title:dfgfd event successfully added.', '27.07.2022 11:30:27', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(33, 'api', 'Event element with title:fdsdf event successfully added.', '27.07.2022 11:42:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(34, 'api', 'Event element with title:hfgh event successfully added.', '27.07.2022 11:45:42', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(35, 'api', 'Event element with title:dfghd event successfully added.', '27.07.2022 11:53:53', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(36, 'api', 'Event element with title:sdf event successfully added.', '27.07.2022 12:20:21', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(37, 'api', 'Event element with title:ghj event successfully added.', '27.07.2022 12:25:05', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(38, 'api', 'Event element with title:dfg event successfully added.', '27.07.2022 12:27:43', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(39, 'login', 'Logged in with userid: 1 / mail: test@test.test', '28.07.2022 09:52:23', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(40, 'login', 'Logged in with userid: 1 / mail: test@test.test', '28.07.2022 10:28:58', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(41, 'menu', 'Menu item with id: 10 and its potential subitems removed.', '28.07.2022 13:50:59', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(42, 'menu', 'Menu item with id: 12 and its potential subitems removed.', '28.07.2022 13:51:03', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(43, 'menu', 'New menu element Section added', '28.07.2022 13:51:14', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(44, 'menu', 'New menu element Accomodation added', '28.07.2022 13:51:19', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(45, 'menu', 'New menu element Instructor added', '28.07.2022 13:51:45', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(46, 'menu', 'New menu element Accomodation added', '28.07.2022 13:52:51', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(47, 'menu', 'Menu item with id: 14 moved up.', '28.07.2022 13:56:10', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(48, 'menu', 'Menu item with id: 13 moved down.', '28.07.2022 13:56:20', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:102.0) Gecko/20100101 Firefox/102.0'),
(49, 'room', 'room successfully added.', '29.07.2022 10:47:27', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(50, 'room', 'room successfully added.', '29.07.2022 10:47:58', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(51, 'room', 'room successfully added.', '29.07.2022 10:48:20', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(52, 'room', 'Room element with id: 1 updated successfully.', '29.07.2022 10:53:27', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(53, 'room', 'Room element with id: 2 updated successfully.', '29.07.2022 10:53:45', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(54, 'room', 'Room element with id: 3 updated successfully.', '29.07.2022 10:54:38', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(55, 'room', 'Room element with id: 2 updated successfully.', '29.07.2022 10:55:42', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(56, 'room', 'Room element with id: 2 updated successfully.', '29.07.2022 10:55:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(57, 'room', 'Room element with id: 1 updated successfully.', '29.07.2022 10:55:58', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(58, 'room', 'Room element with id: 2 updated successfully.', '29.07.2022 10:56:22', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(59, 'room', 'Room element with id: 2 updated successfully.', '29.07.2022 10:56:39', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(60, 'bed', 'bed successfully added.', '29.07.2022 11:06:15', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(61, 'bed', 'bed successfully added.', '29.07.2022 11:08:01', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(62, 'bed', 'bed successfully added.', '29.07.2022 11:08:16', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(63, 'bed', 'bed successfully added.', '29.07.2022 11:08:36', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(64, 'bed', 'bed successfully added.', '29.07.2022 11:19:55', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(65, 'bed', 'bed successfully added.', '29.07.2022 11:20:17', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(66, 'bed', 'bed successfully added.', '29.07.2022 11:20:33', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(67, 'bed', 'bed successfully added.', '29.07.2022 11:21:01', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(68, 'bed', 'bed successfully added.', '29.07.2022 11:21:37', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(69, 'bed', 'bed successfully added.', '29.07.2022 11:21:55', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(70, 'room', 'Room element with id: 1 updated successfully.', '29.07.2022 11:22:14', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(71, 'room', 'Room element with id: 3 updated successfully.', '29.07.2022 11:22:19', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(72, 'accomodation', 'accomodation successfully added.', '29.07.2022 11:25:12', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(73, 'accomodation', 'accomodation successfully added.', '29.07.2022 11:39:20', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(74, 'login', 'Logged in with userid: 1 / mail: test@test.test', '01.08.2022 09:10:55', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(75, 'login', 'Logged in with userid: 1 / mail: test@test.test', '01.08.2022 09:30:15', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(76, 'menu', 'Menu item with id: 15 and its potential subitems removed.', '01.08.2022 09:38:10', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(77, 'menu', 'New menu element Settings added', '01.08.2022 09:40:06', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(78, 'menu', 'New menu element Section added', '01.08.2022 09:40:16', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(79, 'menu', 'New menu element Rooms added', '01.08.2022 09:40:30', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(80, 'menu', 'New menu element Customer added', '01.08.2022 09:40:36', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(81, 'menu', 'New menu element Instructor added', '01.08.2022 09:40:44', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(82, 'menu', 'New menu element Beds added', '01.08.2022 09:40:51', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(83, 'menu', 'Menu item with id: 16 moved up.', '01.08.2022 09:40:59', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(84, 'menu', 'Menu item with id: 11 moved up.', '01.08.2022 09:41:07', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(85, 'menu', 'Menu item with id: 14 moved up.', '01.08.2022 09:41:09', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(86, 'menu', 'Menu item with id: 11 moved up.', '01.08.2022 09:41:12', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(87, 'menu', 'Menu item with id: 14 moved up.', '01.08.2022 09:41:14', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(88, 'menu', 'Menu item with id: 9 moved down.', '01.08.2022 09:41:17', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(89, 'menu', 'Menu item with id: 9 moved down.', '01.08.2022 09:41:18', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(90, 'menu', 'Menu item with id: 17 moved down.', '01.08.2022 09:41:20', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(91, 'menu', 'Menu item with id: 9 moved down.', '01.08.2022 09:41:29', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(92, 'api', 'Accomodation from 2022-08-07 to 2022-08-13 successfully added.', '01.08.2022 15:03:25', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(93, 'api', 'Accomodation from 2022-08-08 to 2022-08-13 successfully added.', '01.08.2022 15:20:37', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(94, 'api', 'Accomodation from 2022-08-08 to 2022-08-13 successfully added.', '01.08.2022 15:36:55', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(95, 'api', 'Accomodation from 2022-08-08 to 2022-08-13 successfully added.', '01.08.2022 15:38:05', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(96, 'api', 'Accomodation from 2022-08-08 to 2022-08-13 successfully added.', '01.08.2022 15:43:55', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(97, 'api', 'Accomodation from 2022-08-15 to 2022-08-23 successfully added.', '01.08.2022 15:44:36', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(98, 'api', 'Accomodation from 2022-08-03 to 2022-08-18 successfully added.', '01.08.2022 15:50:18', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(99, 'api', 'Accomodation from 2022-08-03 to 2022-08-24 successfully added.', '01.08.2022 15:51:00', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(100, 'api', 'Event element with title:test event successfully added.', '02.08.2022 09:40:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(101, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:25:14', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(102, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:26:42', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(103, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:27:11', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(104, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:27:32', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(105, 'api', 'Event element with title:uuu2 event successfully added.', '02.08.2022 12:27:55', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(106, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:28:15', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(107, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:31:26', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(108, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:31:33', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(109, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:31:56', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(110, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:32:29', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(111, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:50:48', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(112, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:50:57', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(113, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:51:11', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(114, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:51:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(115, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:53:18', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(116, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:53:26', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(117, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:54:06', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(118, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 12:54:16', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(119, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 13:20:32', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(120, 'api', 'Event element with title:uuu event successfully added.', '02.08.2022 13:27:59', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(121, 'api', 'Accomodation from 2022-09-04 to 2022-09-11 successfully added.', '02.08.2022 15:44:42', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(122, 'api', 'Event element with title:Advanced course event successfully added.', '02.08.2022 17:35:13', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(123, 'api', 'Event element with title:Advanced course event successfully added.', '02.08.2022 17:35:29', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(124, 'section', 'Section element with id: 2 updated successfully.', '02.08.2022 18:03:42', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(125, 'section', 'Section element with id: 4 updated successfully.', '02.08.2022 18:03:52', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(126, 'section', 'Section element with id: 5 updated successfully.', '02.08.2022 18:04:07', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(127, 'instructor', 'instructor successfully added.', '02.08.2022 18:05:38', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(128, 'api', 'Event element with title:Beginner course event successfully added.', '02.08.2022 18:07:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0'),
(129, 'api', 'Accomodation from 2022-08-01 to 2022-08-07 successfully added.', '02.08.2022 18:08:49', '1', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `actiongroup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `url` varchar(150) COLLATE utf8_slovenian_ci NOT NULL,
  `level` int(11) DEFAULT 1,
  `position` int(11) DEFAULT 1,
  `parent` int(11) DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `description`, `url`, `level`, `position`, `parent`, `active`, `admin`) VALUES
(1, 'Menu', 'Editing menu and menu groups', 'menu', 4, 1, 0, 1, 1),
(2, 'Users', 'Editing users', 'user/update', 4, 1, 0, 1, 1),
(3, 'Groups', 'Editing action groups', 'actiongroup/update', 4, 2, 0, 1, 1),
(4, 'Logs', 'View logs', 'logs/index', 4, 3, 0, 1, 1),
(5, 'Builder', 'Building modules, forms, edit config,...', 'builder/form', 5, 4, 0, 1, 1),
(6, 'Board', 'Board - main menu group', 'board', 2, 1, 0, 1, 0),
(7, 'View posts', 'View last board posts', 'board/index', 1, 2, 6, 1, 0),
(8, 'Edit posts', 'Edit board posts', 'board/update', 2, 3, 6, 1, 0),
(9, 'Section', 'Here you can edit section', 'section/update', 2, 2, 18, 1, 0),
(11, 'Instructor', 'Here you can edit instructor', 'instructor/update', 2, 1, 18, 1, 0),
(13, 'Accomodation', 'Here you can edit accomodation', 'accomodation/update', 2, 3, 0, 0, 0),
(14, 'Customer', 'Edit customers', 'customer/update', 2, 1, 18, 1, 0),
(16, 'Rooms', 'Here you can edit room', 'room/update', 2, 2, 18, 1, 0),
(17, 'Beds', 'Here you can edit bed', 'bed/update', 2, 2, 18, 1, 0),
(18, 'Settings', 'General content settings', 'settings', 2, 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `total_beds` int(11) NOT NULL,
  `color` varchar(45) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `title`, `description`, `total_beds`, `color`) VALUES
(1, 'Ocean', 'Room on the top floor', 4, '#729fcf'),
(2, 'Volcano', 'Left room in the basement', 4, '#cf7777'),
(3, 'Sand', 'Right room in the basement', 2, '#e9b96e');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `title` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `color` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `title`, `color`, `description`) VALUES
(1, 'Surf', '#9DD6E1', 'Surfing lesson'),
(2, 'Paddle surf', '#cbd0d8', 'Sup lesson'),
(3, 'Yoga', '#a6ab5a', 'Yoga session'),
(4, 'Yoga sup', '#d3e4e5', 'Yoga sup session'),
(5, 'Retreats', '#d0947c', 'Adventures activity');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(45) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 2,
  `active` int(11) DEFAULT 1,
  `lastloginDT` varchar(45) DEFAULT NULL,
  `lastloginIP` varchar(45) DEFAULT NULL,
  `createdDT` varchar(45) DEFAULT NULL,
  `createdIP` varchar(45) DEFAULT NULL,
  `theme` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `username`, `password`, `email`, `location`, `description`, `level`, `active`, `lastloginDT`, `lastloginIP`, `createdDT`, `createdIP`, `theme`) VALUES
(1, 'Flying', 'Framework', 'ffw', '$2y$10$FmSqt6i683A5uKtNXZMSmuvpYtMN4e7.1N3D2n0Nf.aLmLhWnsTeK', 'test@test.test', NULL, NULL, 5, 1, NULL, NULL, NULL, NULL, 'default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accomodation`
--
ALTER TABLE `accomodation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actiongroup`
--
ALTER TABLE `actiongroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_customer`
--
ALTER TABLE `event_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_instructor`
--
ALTER TABLE `event_instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`id`,`user_id`,`actiongroup_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accomodation`
--
ALTER TABLE `accomodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `actiongroup`
--
ALTER TABLE `actiongroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `event_customer`
--
ALTER TABLE `event_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `event_instructor`
--
ALTER TABLE `event_instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
