-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2019 at 08:19 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todoapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todolist_details`
--

CREATE TABLE `tbl_todolist_details` (
  `id` int(11) NOT NULL,
  `todo_id` int(11) NOT NULL,
  `instruction` text NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `created_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_todolist_details`
--

INSERT INTO `tbl_todolist_details` (`id`, `todo_id`, `instruction`, `created_date`, `updated_date`, `created_id`) VALUES
(1, 7, '<p>asdasdasd</p>\r\n', '2019-11-12', '0000-00-00', 36),
(2, 7, '<p>asdasdasdasdasd asd asd</p>\r\n', '2019-11-12', '0000-00-00', 36),
(3, 7, '<p>asdasdasdasdasd asd asdasd asd</p>\r\n', '2019-11-12', '0000-00-00', 36),
(4, 7, '<p><strong>asdasdasdasdasd asd asdasd asdasd </strong></p>\r\n', '2019-11-12', '0000-00-00', 36),
(5, 7, '<p><strong>asdasd</strong></p>\r\n', '2019-11-12', '0000-00-00', 36),
(6, 7, '<p><em><strong>asdasdgasd asd</strong></em></p>\r\n', '2019-11-12', '0000-00-00', 36),
(7, 8, '<p><strong>pag antos</strong></p>\r\n', '2019-11-12', '0000-00-00', 36),
(8, 8, '<p><em><strong>as dasd asd asd</strong></em></p>\r\n', '2019-11-12', '0000-00-00', 36),
(9, 9, '<p><strong>asd asd asda</strong></p>\r\n', '2019-11-12', '0000-00-00', 36),
(10, 7, '<p><strong>asdas das d</strong></p>\r\n', '2019-11-12', '0000-00-00', 36),
(11, 7, '<p>asdasd asd</p>\r\n', '2019-11-13', '0000-00-00', 36),
(21, 18, '<p>please delete ang files <a href=\"https://www.google.com/search?client=firefox-b-d&amp;ei=JpHLXeCuMpXB-wSui7rQCw&amp;q=es6+self+invoking+async+function+&amp;oq=es6+self+invoking+async+function+&amp;gs_l=psy-ab.3..0i13i30j0i13i5i30j0i8i13i30l4j0i333l3.88291.93392..93519...0.2..0.342.1741.2-5j1......0....1..gws-wiz.......0i71j0i22i30.3eWzUUiXk4M&amp;ved=0ahUKEwjg2dr8tublAhWV4J4KHa6FDroQ4dUDCAo&amp;uact=5\" target=\"_blank\">https://www.google.com/search?client=firefox-b-d&amp;ei=JpHLXeCuMpXB-wSui7rQCw&amp;q=es6+self+invoking+async+function+&amp;oq=es6+self+invoking+async+function+&amp;gs_l=psy-ab.3..0i13i30j0i13i5i30j0i8i13i30l4j0i333l3.88291.93392..93519...0.2..0.342.1741.2-5j1......0....1..gws-wiz.......0i71j0i22i30.3eWzUUiXk4M&amp;ved=0ahUKEwjg2dr8tublAhWV4J4KHa6FDroQ4dUDCAo&amp;uact=5</a></p>\r\n', '2019-11-13', '2019-11-13', 36),
(26, 17, '<p><strong>asd asdas das dasd asd</strong></p>\r\n', '2019-11-13', '2019-11-13', 36),
(28, 17, '<p>ambot ha em</p>\r\n', '2019-11-13', '2019-11-13', 36),
(30, 17, '<p>asd asdas das dasd asd</p>\r\n', '2019-11-13', '0000-00-00', 36),
(31, 17, '<p>please take note of this:</p>\r\n\r\n<p><a href=\"https://reactjs.org/\" target=\"_blank\">https://reactjs.org/</a></p>\r\n\r\n<p>&nbsp;</p>\r\n', '2019-11-13', '2019-11-13', 36),
(32, 21, '<p><strong>please sad update sa orc thanks!</strong></p>\r\n', '2019-11-13', '0000-00-00', 36);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  `approved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `fullname`, `username`, `password`, `user_type`, `user_status`, `approved`) VALUES
(36, 'juphet Vitualla', 'test', 'test', 1, 1, 1),
(42, 'John doe1111', 'student1', 'student2', 2, 1, 1),
(43, 'James does', 'student2', 'student2', 2, 1, 1),
(46, 'jessie samople', 'student5', 'student5', 2, 1, 1),
(47, 'mark zuecke', 'student6', 'student6', 2, 1, 1),
(48, 'juan dela cruz', 'student7', 'student7', 2, 1, 1),
(51, 'asdasd', 'test66', 'test66', 2, 1, 1),
(52, 'asfasfasfasd', 'test111', 'test111', 2, 1, 1),
(53, 'jjj', 'test00', 'test00', 2, 0, 1),
(54, 'Alvin Requina', 'test121', 'test121', 2, 1, 1),
(55, 'jobel', 'test131', 'test131', 2, 1, 1),
(56, 'james re', 'test55', 'test55', 2, 1, 1),
(57, 'ggasdasd', 'test615', 'test615', 2, 1, 1),
(58, 'ggasdasdasdasd', 'test1111', 'test1111', 2, 1, 1),
(59, 'jake', 'opet', 'opet', 2, 1, 1),
(60, 'jave', 'test4', 'test4', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`id`, `user_id`, `email`, `age`) VALUES
(1, 36, 'asd@sa.com', 23),
(2, 42, 'asd@asd.com', 22),
(3, 43, 'asdasd@asdasd.com', 34),
(4, 46, 'asd@asdas.comasd', 22),
(5, 47, 'ggasd@asdas.com', 22),
(6, 48, 'ggg@ggg.com', 33),
(7, 51, 'asd@asdas.com', 21),
(8, 52, 'ggasd@asdas.com', 44),
(9, 53, 'asd@asd.com', 22),
(10, 54, 'asd@aaa.com', 22),
(11, 55, 'asd@aaa.com', 22),
(12, 56, 'asd@asdsaa.com', 234),
(13, 57, 'asd@aaa.com', 21),
(14, 58, 'asd@asdsdaa.com', 22),
(15, 59, 'asd@asdssaa.com', 24),
(16, 60, 'asd@asdsaa.com', 22);

-- --------------------------------------------------------

--
-- Table structure for table `todo_list`
--

CREATE TABLE `todo_list` (
  `todo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_date` date NOT NULL,
  `created_id` int(11) NOT NULL,
  `todo_status` int(11) NOT NULL,
  `completed` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todo_list`
--

INSERT INTO `todo_list` (`todo_id`, `user_id`, `content`, `created_date`, `created_id`, `todo_status`, `completed`) VALUES
(6, 42, 'sada sda sdasdasdasdasdasd', '2019-11-12', 36, 0, 'yes'),
(7, 42, 'Please remove banenr area please', '2019-11-12', 36, 1, 'In-Progress'),
(8, 42, 'sample tod', '2019-11-12', 36, 1, 'Break'),
(9, 42, 'asdj laksjdlj alsdjlk asd', '2019-11-12', 36, 1, 'For QA'),
(10, 42, 'test', '2019-11-12', 36, 1, 'Pending'),
(11, 42, 'asdasda sd', '2019-11-12', 36, 1, 'Pending'),
(12, 42, 'asdasd', '2019-11-12', 36, 1, 'Break'),
(13, 48, 'gasdasdasd', '2019-11-12', 36, 1, 'no'),
(14, 51, 'create programing language', '2019-11-12', 36, 1, 'Pending'),
(15, 54, 'pag antos lang', '2019-11-12', 36, 1, 'In-Progress'),
(16, 54, 'asdhakshd kjahsdjk asd', '2019-11-12', 36, 1, 'Pending'),
(17, 56, 'asda sd asd', '2019-11-13', 36, 1, 'Pending'),
(18, 57, 'asdasd', '2019-11-13', 36, 1, 'Pending'),
(19, 57, 'gasdasd', '2019-11-13', 36, 1, 'Pending'),
(20, 48, 'asda asd asd asd', '2019-11-13', 36, 1, 'Pending'),
(21, 48, 'please update website', '2019-11-13', 36, 1, 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_todolist_details`
--
ALTER TABLE `tbl_todolist_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo_list`
--
ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`todo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_todolist_details`
--
ALTER TABLE `tbl_todolist_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;