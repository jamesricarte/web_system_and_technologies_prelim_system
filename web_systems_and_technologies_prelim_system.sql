-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 02:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_systems_and_technologies_prelim_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `department` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `department`) VALUES
(1, 'BSIT', NULL),
(2, 'BSCS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `reg_id`, `username`, `password`) VALUES
(1, 1, 'charles', '$2y$10$RVAAm8r7DmF118j/0kL35egelATG7xX6tciA0okLfaeornS.jpPqq'),
(2, 2, 'cedric', '$2y$10$oh6vhiC/K7fbkWYsYalp5ObJu75nBJYJX01XR1mJkbP8C4qIBF/6a'),
(3, 3, 'majo', '$2y$10$cWx6Utky/kEtbFn19bQe.uYmAulQwB867u/knHlIyDFJFT7uQcAv6'),
(4, 4, 'emman', '$2y$10$iNt.25IskR6GzcoMnu5Bw./gAmf/kyJnZam4oyv7R.MJJDkIdmVPG'),
(5, 5, 'carl', '$2y$10$A2VEmLbJXQ9bFWNAkI7N7e9aqt.slUJqVWbR0auMS96yjroUsi7Tq'),
(6, 6, 'brad', '$2y$10$GVIzHJrQa/8VBMKItndu1.Ymq6jfGDj6opCHZ3QuC.vTQtiYmItn.');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `reg_id` int(11) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`reg_id`, `faculty_id`, `first_name`, `last_name`, `middle_name`, `email`, `birthday`, `age`) VALUES
(1, 'faculty_id_test', 'Charles', 'Alamares', 'Marfil', 'charles@gmail.com', '2003-01-22', 1),
(2, 'fd947588', 'Cedric', 'Naño', 'Lawrence', 'gdashrobtob@gmail.com', '2002-03-08', 0),
(3, 'a06c1c5c', 'Mark', 'Joseph', 'Ante', 'majo@gmail.com', '2004-01-25', 0),
(4, '01860f2f', 'Emman', 'Espenia', 'Lopez', 'emman@gmail.com', '2004-05-01', 20),
(5, '80499a83', 'Carl', 'Dolino', 'Cruz', 'carl@gmail.com', '2022-01-06', 2),
(6, '', 'Brad', 'Soloria', 'C', 'brad@gmail.com', '2009-02-05', 15);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `status_name`) VALUES
(1, 'present'),
(2, 'absent'),
(3, 'late');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `school_id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `reg_id`, `first_name`, `last_name`, `middle_name`, `school_id`, `course`, `year_level`, `status`) VALUES
(1, 1, 'Jame', 'Ricarte', 'Cao', 7110972, 2, 3, 2),
(2, 1, 'Charles', 'Alamares', 'M', 77454, 2, 4, 3),
(3, 1, 'Cedric', 'Naño', 'L', 7434343, 2, 4, 2),
(4, 2, 'Mark Joseph', 'Ante', 'M', 743534, 1, 3, 1),
(5, 2, 'James Mickel', 'Ricarte', 'C', 7110972, 2, 3, 1),
(8, 1, 'Emman', 'Espenia', 'B', 77741, 1, 3, 1),
(10, 3, 'Emman', 'Espenia', 'C', 82332, 1, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `from_reg_id` (`reg_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`reg_id`),
  ADD UNIQUE KEY `faculty_id` (`faculty_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `connectFromRegId` (`reg_id`),
  ADD KEY `ConnectFromCoursesId` (`course`),
  ADD KEY `connectFromStatusesId` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `from_reg_id` FOREIGN KEY (`reg_id`) REFERENCES `registration` (`reg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `ConnectFromCoursesId` FOREIGN KEY (`course`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `connectFromRegId` FOREIGN KEY (`reg_id`) REFERENCES `registration` (`reg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `connectFromStatusesId` FOREIGN KEY (`status`) REFERENCES `statuses` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
