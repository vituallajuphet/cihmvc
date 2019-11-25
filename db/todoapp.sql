-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 11:06 AM
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
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(55) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `category_status` int(11) NOT NULL,
  `created_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `created_date`, `updated_date`, `category_status`, `created_id`) VALUES
(1, 'Filipino', '2019-11-18', '0000-00-00', 1, 46),
(2, 'Maths', '2019-11-19', '0000-00-00', 1, 36),
(3, 'Science', '2019-11-19', '0000-00-00', 1, 36),
(6, 'English', '2019-11-19', '0000-00-00', 1, 36),
(8, 'TLE', '2019-11-19', '0000-00-00', 1, 36);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exams`
--

CREATE TABLE `tbl_exams` (
  `exam_id` int(11) NOT NULL,
  `category` varchar(55) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `created_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exams`
--

INSERT INTO `tbl_exams` (`exam_id`, `category`, `created_date`, `updated_date`, `created_id`, `type`) VALUES
(15, 'Math', '2019-11-15', '0000-00-00', 36, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam_questions`
--

CREATE TABLE `tbl_exam_questions` (
  `question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(55) NOT NULL,
  `choiceA` varchar(55) NOT NULL,
  `choiceB` varchar(55) NOT NULL,
  `choiceC` varchar(55) NOT NULL,
  `qtype` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exam_questions`
--

INSERT INTO `tbl_exam_questions` (`question_id`, `exam_id`, `question`, `answer`, `choiceA`, `choiceB`, `choiceC`, `qtype`) VALUES
(27, 15, '1 + 1 = ?', '2', '', '', '', 'No Choices'),
(28, 15, '2 + 2 =?', '4', '', '', '', 'No Choices'),
(29, 15, '3 + 3 = ?', '6', '', '', '', 'No Choices'),
(30, 15, '5 x 6 = ?', '30', '', '', '', 'No Choices'),
(31, 15, '6 x 6 = ?', '36', '', '', '', 'No Choices');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam_results`
--

CREATE TABLE `tbl_exam_results` (
  `result_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `passed` varchar(55) NOT NULL,
  `answers` text NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_exam_results`
--

INSERT INTO `tbl_exam_results` (`result_id`, `exam_id`, `student_id`, `score`, `passed`, `answers`, `created_date`, `updated_date`) VALUES
(1, 15, 43, 4, 'Passed', '[\"2\",\"4\",\"6\",\"11\",\"36\"]', '2019-11-19', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam_result_details`
--

CREATE TABLE `tbl_exam_result_details` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forgotpassord_keys`
--

CREATE TABLE `tbl_forgotpassord_keys` (
  `key_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(32, 21, '<p><strong>please sad update sa orc thanks!</strong></p>\r\n', '2019-11-13', '0000-00-00', 36),
(33, 22, '<p>pag antos lang</p>\r\n', '2019-11-13', '0000-00-00', 36),
(34, 23, '<p><strong>asdasd asd</strong></p>\r\n', '2019-11-13', '2019-11-13', 36),
(35, 27, '<p><strong>asd asd</strong></p>\r\n', '2019-11-19', '0000-00-00', 36);

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
(43, 'James does', 'student2', '12345', 2, 1, 1),
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
(60, 'jave', 'test4', 'test4', 2, 1, 1),
(61, 'Proweaver Test', 'Frank', 'Frank', 2, 1, 1),
(62, 'Proweaver Test', 'Lynn', 'password', 2, 0, 1),
(63, 'Proweaver Test', 'Marion', 'password', 2, 1, 0),
(64, 'Proweaver Test', 'Cliff', 'password', 2, 1, 0),
(65, 'Proweaver Test', 'Sue', 'password', 2, 1, 1),
(66, 'Karl Test', 'test1', 'test1', 2, 1, 1);

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
(3, 43, 'prospteam@gmail.com', 34),
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
(16, 60, 'asd@asdsaa.com', 22),
(17, 61, 'example@proweaver.com', 21),
(18, 62, 'example@proweaver.com', 0),
(19, 63, 'example@proweaver.com', 0),
(20, 64, 'example@proweaver.com', 0),
(21, 65, 'example@proweaver.com', 0),
(22, 66, 'new@test', 20);

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
(7, 42, 'Please remove banenr area please', '2019-11-12', 36, 1, 'Break'),
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
(21, 48, 'please update website', '2019-11-13', 36, 1, 'Pending'),
(22, 42, 'asda sdasd asdasd asd', '2019-11-13', 36, 1, 'In-Progress'),
(23, 59, 'sdad asd asda sdasd asd', '2019-11-13', 36, 1, 'Pending'),
(24, 66, 'This is a todo', '2019-11-14', 36, 0, 'Pending'),
(25, 66, 'test', '2019-11-14', 36, 1, 'For QA'),
(26, 42, 'new', '2019-11-14', 36, 1, 'Pending'),
(27, 43, 'asda sd asd', '2019-11-19', 36, 1, 'In-Progress');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_exams`
--
ALTER TABLE `tbl_exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `tbl_exam_questions`
--
ALTER TABLE `tbl_exam_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_exam_results`
--
ALTER TABLE `tbl_exam_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `tbl_exam_result_details`
--
ALTER TABLE `tbl_exam_result_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forgotpassord_keys`
--
ALTER TABLE `tbl_forgotpassord_keys`
  ADD PRIMARY KEY (`key_id`);

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
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_exams`
--
ALTER TABLE `tbl_exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_exam_questions`
--
ALTER TABLE `tbl_exam_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_exam_results`
--
ALTER TABLE `tbl_exam_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_exam_result_details`
--
ALTER TABLE `tbl_exam_result_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_forgotpassord_keys`
--
ALTER TABLE `tbl_forgotpassord_keys`
  MODIFY `key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_todolist_details`
--
ALTER TABLE `tbl_todolist_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `todo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
