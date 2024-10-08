-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 07:06 PM
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
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `block_id` int(11) NOT NULL,
  `block_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`block_id`, `block_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

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
(1, 1, 'charuzu444', '$2y$10$o3YpXrhSciOxhbfkh00Cw.0G7pxzrNr.lwWBEnyobv8WY6oOY91Ea'),
(2, 2, 'cedric', '$2y$10$oh6vhiC/K7fbkWYsYalp5ObJu75nBJYJX01XR1mJkbP8C4qIBF/6a'),
(3, 3, 'majo', '$2y$10$cWx6Utky/kEtbFn19bQe.uYmAulQwB867u/knHlIyDFJFT7uQcAv6'),
(4, 4, 'emman', '$2y$10$iNt.25IskR6GzcoMnu5Bw./gAmf/kyJnZam4oyv7R.MJJDkIdmVPG'),
(5, 5, 'carl', '$2y$10$A2VEmLbJXQ9bFWNAkI7N7e9aqt.slUJqVWbR0auMS96yjroUsi7Tq'),
(6, 6, 'brad', '$2y$10$GVIzHJrQa/8VBMKItndu1.Ymq6jfGDj6opCHZ3QuC.vTQtiYmItn.'),
(7, 13, 'tine', '$2y$10$53fjU9C.EhjpkL1pBGY7Guva.Hl8oCR99dX370q6ACZP2JW9wEON.'),
(8, 16, 'apable', '$2y$10$.gEmsRZ.CDDJDB.0ZBMXve20dZxo.s1cFU/bltxMKdNA3FuwaEAPy');

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
  `age` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`reg_id`, `faculty_id`, `first_name`, `last_name`, `middle_name`, `email`, `birthday`, `age`, `profile_picture`) VALUES
(1, '7490f0f9', 'Charles', 'Alamares', 'Marfil', 'charles@gmail.com', '2002-07-30', 22, '260742788_225642179707073_8699292937256620403_n.jpg'),
(2, 'fd947588', 'Cedric', 'Naño', 'Lawrence', 'cedric@gmail.com', '2002-03-08', 0, '256759877_448379213318839_7307962930220879254_n.jpg'),
(3, 'a06c1c5c', 'Mark', 'Joseph', 'Ante', 'majo@gmail.com', '2004-01-25', 0, NULL),
(4, '01860f2f', 'Emman', 'Espenia', 'Lopez', 'emman@gmail.com', '2004-05-01', 20, NULL),
(5, '80499a83', 'Carl', 'Dolino', 'Cruz', 'carl@gmail.com', '2022-01-06', 2, NULL),
(6, '', 'Brad', 'Soloria', 'C', 'brad@gmail.com', '2009-02-05', 15, NULL),
(13, '2e61f8c6', 'Christine', 'Rholda', 'Mae', 'tine@gmail.com', '2020-09-09', 4, NULL),
(16, 'cf8fabe9', 'Francis', 'Ramirez', 'Lopez', 'francis@gmail.com', '2002-02-07', 22, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`) VALUES
(1, 'St. Arnoldus Hall'),
(2, '214'),
(3, '301'),
(4, '315CompL	'),
(5, '317A-GSBM'),
(6, '317B-GSBM'),
(7, '318CompL');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `day_of_week` varchar(4) NOT NULL,
  `start_time` varchar(5) NOT NULL,
  `end_time` varchar(5) NOT NULL,
  `room_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `subject_id`, `block_id`, `day_of_week`, `start_time`, `end_time`, `room_id`, `teacher_id`) VALUES
(1, 1, 2, 'MW', '9:30', '12:00', 5, 2),
(2, 2, 2, 'ThSa', '9:30', '12:00', 7, 1),
(3, 3, 2, 'TF', '13:00', '15:30', 5, 5),
(4, 4, 1, 'MW', '15:30', '18:00', 4, 6),
(5, 5, 1, 'MW', '7:30', '9:00', 2, 7),
(6, 6, 2, 'TF', '9:00', '10:30', 3, 8),
(7, 7, 4, 'Thu', '13:00', '15:00', 1, 9);

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
(1, 1, 'James', 'Ricarte', 'Cao', 7110972, 2, 3, 1),
(3, 1, 'Cedric', 'Naño', 'L', 7434343, 2, 3, 1),
(4, 2, 'Mark Joseph', 'Ante', 'M', 743534, 1, 3, 1),
(5, 2, 'James Mickel', 'Ricarte', 'C', 7110972, 2, 3, 2),
(8, 1, 'Emman', 'Espenia', 'B', 77741, 1, 3, 1),
(10, 3, 'Emman', 'Espenia', 'C', 82332, 1, 3, 1),
(11, 1, 'Christian', 'Dacillo', 'F', 7234234, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_schedules`
--

CREATE TABLE `student_schedules` (
  `student_schedule_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `catalog_number` varchar(255) NOT NULL,
  `descriptive_title` varchar(255) NOT NULL,
  `units` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `catalog_number`, `descriptive_title`, `units`) VALUES
(1, 'CC105 A', 'APPLICATION DEVELOPMENT & EMERGING TECHNOLOGIES (MOBILE DEV\'T.)', 3),
(2, 'IT ELEC 04 WT', 'WEB SYSTEMS & TECHNOLOGIES', 3),
(3, 'IT PC 311', 'ADVANCE DATABASE SYSTEMS', 3),
(4, 'IT PC 312', 'NETWORKING 2', 3),
(5, 'IT PC 313', 'SYSTEMS INTEGRATION AND ARCHITECTURE', 3),
(6, 'IT PC 314', 'SOCIAL AND PROFESSIONAL ISSUES', 3),
(7, 'PATHFit 3', 'PHYSICAL ACTIVITIES TOWARDS HEALTH & FITNESS 3: DANCE', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `department` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `school_id`, `first_name`, `last_name`, `middle_name`, `department`) VALUES
(1, 28822, 'Dhan Davish', 'Alamo', 'Vergara', NULL),
(2, 92323, 'Emmanuel Isaiah', 'Zuñiga', 'Detera', NULL),
(5, 94545, 'Jp Remar', 'Serrano', 'Alita', NULL),
(6, 28374, 'Victor Jr.', 'Quinzon', 'Parillas', NULL),
(7, 25664, 'Abegail', 'Herrera', 'Palmes', NULL),
(8, 92334, 'Aljohn', 'Marilag', 'Saberdo', NULL),
(9, 34355, 'Erika', 'Mendoza', 'Aldave', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`block_id`);

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `connectFromSubjects` (`subject_id`),
  ADD KEY `connectFromBlocks` (`block_id`),
  ADD KEY `connectFromRooms` (`room_id`),
  ADD KEY `connectFromTeachers` (`teacher_id`);

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
-- Indexes for table `student_schedules`
--
ALTER TABLE `student_schedules`
  ADD PRIMARY KEY (`student_schedule_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_schedules`
--
ALTER TABLE `student_schedules`
  MODIFY `student_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `from_reg_id` FOREIGN KEY (`reg_id`) REFERENCES `registration` (`reg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `connectFromBlocks` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`block_id`),
  ADD CONSTRAINT `connectFromRooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `connectFromSubjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `connectFromTeachers` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`);

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
