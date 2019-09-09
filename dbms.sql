-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2016 at 10:48 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE IF NOT EXISTS `attendence` (
  `course_id` varchar(10) NOT NULL,
  `present` varchar(250) DEFAULT NULL,
  `fac_id` varchar(10) NOT NULL,
  `absent` varchar(250) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`course_id`, `present`, `fac_id`, `absent`, `date`) VALUES
('CSE1001', '15bce0003,15bce0004,15bce0005,15bce0006', '0001', '15bce0001,15bce0002', '2016-11-02'),
('CSE1001', '15bce0001,15bce0002,15bce0003,15bce0005', '0001', '', '2016-11-03'),
('CSE1001', '15bce0003,15bce0005', '0001', '15bce0001,15bce0002', '2016-11-04'),
('CSE1001', '15bce0001,15bce0002,15bce0003', '0001', '15bce0005', '2016-11-05'),
('CSE1001', '15bce0001,15bce0002,15bce0003,15bce0005', '0001', NULL, '2016-11-06'),
('CSE1002', '15bce0002,15bce0003', '0003', '15bce0001,15bce0005', '2016-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id_course` int(11) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_title` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_course`, `course_id`, `course_title`) VALUES
(1, 'CSE1001', 'Internet and Web Programing'),
(2, 'CSE1002', 'database management system'),
(3, 'CSE1003', 'Object Oriented Programing'),
(4, 'CSE1004', 'Data Structures'),
(5, 'CSE1005', 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `id_fac` int(11) NOT NULL,
  `fac_name` varchar(50) NOT NULL,
  `fac_id` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id_fac`, `fac_name`, `fac_id`, `password`) VALUES
(1, 'faculty 1', '0001', 'faculty'),
(2, 'faculty 2', '0002', 'faculty'),
(3, 'faculty 3', '0003', 'faculty'),
(4, 'faculty 4', '0004', 'faculty'),
(5, 'faculty 5', '0005', 'faculty'),
(6, 'faculty 6', '0006', 'faculty'),
(7, 'faculty 7', '0007', 'faculty'),
(8, 'faculty 8', '0008', 'faculty'),
(9, 'faculty 9', '0009', 'faculty'),
(10, 'faculty 10', '0010', 'faculty'),
(11, 'faculty 11', '0011', 'faculty'),
(12, 'faculty 12', '0012', 'faculty'),
(13, 'faculty 13', '0013', 'faculty'),
(14, 'faculty 14', '0014', 'faculty'),
(15, 'faculty 15', '0015', 'faculty'),
(16, 'faculty 16', '0016', 'faculty');

-- --------------------------------------------------------

--
-- Table structure for table `fac_courses`
--

CREATE TABLE IF NOT EXISTS `fac_courses` (
  `course_id` varchar(20) NOT NULL,
  `fac_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fac_courses`
--

INSERT INTO `fac_courses` (`course_id`, `fac_id`) VALUES
('CSE1001', '0001'),
('CSE1001', '0002'),
('CSE1002', '0003'),
('CSE1002', '0004'),
('CSE1003', '0005'),
('CSE1003', '0006'),
('CSE1004', '0007'),
('CSE1004', '0008'),
('CSE1005', '0009'),
('CSE1005', '0010'),
('CSE1004', '0011'),
('CSE1005', '0012'),
('CSE1001', '0013'),
('CSE1003', '0014'),
('CSE1002', '0015'),
('CSE1003', '0016'),
('CSE1004', '0017');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id_stud` int(11) NOT NULL,
  `stud_name` varchar(50) NOT NULL,
  `regno` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_stud`, `stud_name`, `regno`, `password`) VALUES
(1, 'student_01', '15bce0001', 'student'),
(2, 'student_02', '15bce0002', 'student'),
(3, 'student_03', '15bce0003', 'student'),
(4, 'student_05', '15bce0005', 'student'),
(5, 'student_04', '15bce0004', 'student'),
(6, 'student_06', '15bce0006', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `student_teacher`
--

CREATE TABLE IF NOT EXISTS `student_teacher` (
  `fac_id` varchar(10) NOT NULL,
  `regno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_teacher`
--

INSERT INTO `student_teacher` (`fac_id`, `regno`) VALUES
('0001', '15bce0001'),
('0001', '15bce0002'),
('0001', '15bce0003'),
('0001', '15bce0004'),
('0001', '15bce0005'),
('0001', '15bce0006'),
('0003', '15bce0001'),
('0003', '15bce0002'),
('0003', '15bce0003'),
('0003', '15bce0004'),
('0003', '15bce0005'),
('0003', '15bce0006'),
('0005', '15bce0001'),
('0005', '15bce0002'),
('0005', '15bce0003'),
('0005', '15bce0004'),
('0005', '15bce0005'),
('0005', '15bce0006'),
('0007', '15bce0001'),
('0007', '15bce0002'),
('0007', '15bce0003'),
('0007', '15bce0004'),
('0007', '15bce0005'),
('0007', '15bce0006'),
('0009', '15bce0001'),
('0009', '15bce0002'),
('0009', '15bce0003'),
('0009', '15bce0004'),
('0009', '15bce0005'),
('0009', '15bce0006');

-- --------------------------------------------------------

--
-- Table structure for table `stud_courses`
--

CREATE TABLE IF NOT EXISTS `stud_courses` (
  `regno` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stud_courses`
--

INSERT INTO `stud_courses` (`regno`, `course_id`) VALUES
('15bce0001', 'CSE1001'),
('15bce0001', 'CSE1002'),
('15bce0001', 'CSE1003'),
('15bce0001', 'CSE1004'),
('15bce0001', 'CSE1005'),
('15bce0002', 'CSE1001'),
('15bce0002', 'CSE1002'),
('15bce0002', 'CSE1003'),
('15bce0002', 'CSE1004'),
('15bce0002', 'CSE1005'),
('15bce0003', 'CSE1001'),
('15bce0003', 'CSE1002'),
('15bce0003', 'CSE1003'),
('15bce0003', 'CSE1004'),
('15bce0003', 'CSE1005'),
('15bce0004', 'CSE1001'),
('15bce0004', 'CSE1002'),
('15bce0004', 'CSE1003'),
('15bce0004', 'CSE1004'),
('15bce0004', 'CSE1005'),
('15bce0005', 'CSE1001'),
('15bce0005', 'CSE1002'),
('15bce0005', 'CSE1003'),
('15bce0005', 'CSE1004'),
('15bce0005', 'CSE1005'),
('15bce0006', 'CSE1001'),
('15bce0006', 'CSE1002'),
('15bce0006', 'CSE1003'),
('15bce0006', 'CSE1004'),
('15bce0006', 'CSE1005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`fac_id`,`date`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`,`course_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id_fac`,`fac_id`);

--
-- Indexes for table `fac_courses`
--
ALTER TABLE `fac_courses`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_stud`,`regno`);

--
-- Indexes for table `student_teacher`
--
ALTER TABLE `student_teacher`
  ADD PRIMARY KEY (`fac_id`,`regno`);

--
-- Indexes for table `stud_courses`
--
ALTER TABLE `stud_courses`
  ADD PRIMARY KEY (`regno`,`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id_fac` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_stud` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
