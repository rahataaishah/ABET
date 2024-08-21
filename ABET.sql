-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2022 at 12:24 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ABET`
--
CREATE DATABASE IF NOT EXISTS `ABET` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `ABET`;

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `assessment_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `assessment_type` varchar(30) NOT NULL,
  `assessment_name` varchar(30) NOT NULL,
  `assessment_description` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `assessment_average` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`assessment_number`, `assessment_type`, `assessment_name`, `assessment_description`, `assessment_average`) VALUES
('COSC 1351-05', 'Exam', 'Exam 1', 'Questions relating to the concepts covered so far in class', '80.77'),
('COSC 2352-01', 'Project', 'My Malloc Assignment', 'Demonstrate the understanding of the malloc and calloc functions', '77.70'),
('COSC 2353-01', 'Exam', 'Exam 1', 'Questions relating to the concepts covered so far in class', '86.40'),
('COSC 2353-02', 'Midterm', 'Oral midterm', 'Professor testing to see how much information student is actually able to retain', '78.00'),
('COSC 2354-02', 'Homework', 'Priority Queues and Heaps', 'Apply knowledge of data structures learned (queues and heaps) to program', '78.60'),
('COSC 2354-04', 'Project', 'Distributed Data Structures', 'Using threads in Java to create a client and server object and establishing their connection', '96.86'),
('COSC 2354-07', 'Homework', 'OOP exercises', 'Demonstrate the understanding of utilizing hashmaps, hashtables, and dictionaries', '84.80'),
('COSC 3353-01', 'Homework', 'Database Creation', 'Use MySQL to create a database, tables and their relationships.', '85.89'),
('COSC 3353-02', 'Homework', 'SQL Injection Attack', 'Demonstrate the use of the SQL Injection attack on UPDATE statement', '82.50'),
('COSC 3353-03', 'Extra Credit', 'Todays Leaders in Metaverse', 'Chance to increase your grade by attending a talk and gaining some insight in the tech world', '89.50');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_number` varchar(30) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_syllabus` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_number`, `course_name`, `course_syllabus`) VALUES
('COSC 1351', 'Introduction to Computer Programming', 'COSC 1351 syllabus'),
('COSC 2352', 'Systems Programming', 'COSC 2352 syllabus'),
('COSC 2353', 'Operating Systems', 'COSC 2353 syllabus'),
('COSC 2354', 'Advanced Data Structures', 'COSC 2354 syllabus'),
('COSC 3353', 'Programming Languages', 'COSC 3353 syllabus');

-- --------------------------------------------------------

--
-- Table structure for table `course_outcome`
--

CREATE TABLE `course_outcome` (
  `outcome` varchar(30) NOT NULL,
  `performIndicator` varchar(30) NOT NULL,
  `course` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course_outcome`
--

INSERT INTO `course_outcome` (`outcome`, `performIndicator`, `course`) VALUES
('O1', 'PI-B', 'COSC 1351'),
('O2', 'PI-A', 'COSC 2354'),
('O3', 'PI-D', 'COSC 3353'),
('O1', 'PI-B', 'COSC 2352'),
('O5', 'PI-C', 'COSC 2353'),
('O4', 'PI-D', 'COSC 1351');

-- --------------------------------------------------------

--
-- Table structure for table `outcomes`
--

CREATE TABLE `outcomes` (
  `outcomeNum` varchar(30) NOT NULL,
  `outcomeDes` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `outcomes`
--

INSERT INTO `outcomes` (`outcomeNum`, `outcomeDes`) VALUES
('O1', 'An ability to analyze a complex computing problem and to apply principles of computing and other relevant disciplines to identify solutions.'),
('O2', 'An ability to design, implement, and evaluate a computing-based solution to meet a given set of computing requirements in context of the programs discipline.'),
('O3', 'An ability to communicate effectively in a variety of professional contexts.'),
('O4', 'An ability to recognize professional responsibilities and make informed judgments in computing practice based on legal and ethical principles.'),
('O5', 'An ability to function effectively as a member or leader of a team engaged in activities appropriate to the programs discipline.'),
('O6', 'An ability to apply computer science theory and software development fundamentals to produce computing-based solutions');

-- --------------------------------------------------------

--
-- Table structure for table `performIndicator`
--

CREATE TABLE `performIndicator` (
  `performIndicatorNum` varchar(30) NOT NULL,
  `performIndicatorDes` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `performIndicator`
--

INSERT INTO `performIndicator` (`performIndicatorNum`, `performIndicatorDes`) VALUES
('PI-A', 'sdfgh'),
('PI-B', 'sdfghj'),
('PI-C', 'Some Description C'),
('PI-D', 'Some Description D');

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `prof_id` int NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`prof_id`, `last_name`, `first_name`, `position`, `email`, `password`) VALUES
(1, 'Fox', 'Ricky', 'Professor of Computer Science', 'foxr@hbu.edu', '$2y$10$9nI0kxGDdlRCIQ0SXbc.7uml60j9zpvMdqLzx/Gg0H6d.SJr6V65i'),
(2, 'Eastwood', 'Minahil', 'Assistant Professor of Computer Science', 'eastwoodm@hbu.edu', '$2y$10$7kpXLl9HG8G5mQQCvWOAWuVLMZX1GnNNGcHqIYdeIQNoMZhii5Lzu '),
(3, 'Trujillo', 'Leyton', 'Assistant Professor of Computer Science', 'trujillol@hbu.edu', '$2y$10$e0ruSyCYpg3A.HKXfoLqSuuHqnMoU895QTu0LCzf0uybCzvvwjqFi '),
(4, 'Testing', 'Test', NULL, 'test@test.com', '$2y$10$NxQvY2bJnOLj8P5f5UfDY.J2n1toD0vvf3imgPLk15W5z8dVBCT9G');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `assessment_number` varchar(30) NOT NULL,
  `student_id` int NOT NULL,
  `grade` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`assessment_number`, `student_id`, `grade`) VALUES
('COSC 3353-01', 1, '80.45'),
('COSC 3353-01', 4, '76.90'),
('COSC 1351-05', 2, '55.43'),
('COSC 2354-04', 3, '96.86'),
('COSC 1351-05', 3, '90.20'),
('COSC 1351-05', 9, '67.40'),
('COSC 1351-05', 1, '87.00'),
('COSC 1351-05', 5, '90.00'),
('COSC 1351-05', 7, '80.35'),
('COSC 1351-05', 4, '95.00'),
('COSC 2352-01', 10, '89.00'),
('COSC 2352-01', 8, '87.50'),
('COSC 2352-01', 7, '65.00'),
('COSC 2352-01', 6, '70.00'),
('COSC 2352-01', 4, '77.00'),
('COSC 2353-01', 2, '88.00'),
('COSC 2353-01', 1, '89.00'),
('COSC 2353-01', 3, '87.00'),
('COSC 2353-01', 7, '91.00'),
('COSC 2353-01', 9, '77.00'),
('COSC 2354-02', 4, '55.67'),
('COSC 2354-02', 8, '95.10'),
('COSC 2354-02', 9, '70.50'),
('COSC 2354-02', 7, '88.99'),
('COSC 2354-02', 2, '82.72'),
('COSC 2354-04', 2, '91.00'),
('COSC 2354-04', 5, '83.00'),
('COSC 2354-04', 10, '72.00'),
('COSC 2354-04', 4, '83.00'),
('COSC 2354-04', 1, '67.00'),
('COSC 2354-07', 8, '79.00'),
('COSC 2354-07', 5, '86.00'),
('COSC 2354-07', 6, '95.00'),
('COSC 2354-07', 2, '87.00'),
('COSC 2354-07', 4, '77.00'),
('COSC 3353-01', 8, '75.00'),
('COSC 3353-01', 5, '98.00'),
('COSC 3353-01', 9, '100.00'),
('COSC 3353-01', 3, '85.00'),
('COSC 3353-02', 1, '93.00'),
('COSC 3353-02', 3, '75.00'),
('COSC 3353-02', 5, '84.00'),
('COSC 3353-02', 7, '78.00'),
('COSC 3353-03', 5, '93.00'),
('COSC 3353-03', 9, '98.00'),
('COSC 3353-03', 10, '100.00'),
('COSC 3353-03', 4, '67.00'),
('COSC 2353-02', 10, '78.00'),
('COSC 2353-02', 5, '56.00'),
('COSC 2353-02', 1, '87.00'),
('COSC 2353-02', 2, '91.00');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `course_number` varchar(30) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `prof_id` int NOT NULL,
  `assessment_number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`course_number`, `year`, `semester`, `prof_id`, `assessment_number`) VALUES
('COSC 3353', '2022', 'Fall', 1, 'COSC 3353-01'),
('COSC 1351', '2022', 'Spring', 2, 'COSC 1351-05'),
('COSC 2354', '2021', 'Fall', 3, 'COSC 2354-04'),
('COSC 1351', '2021', 'Spring', 1, 'COSC 1351-05'),
('COSC 2353', '2022', 'Fall', 2, 'COSC 2353-02'),
('COSC 2352', '2022', 'Spring', 3, 'COSC 2352-01'),
('COSC 2353', '2022', 'Fall', 2, 'COSC 2353-02'),
('COSC 2354', '2021', 'Fall', 3, 'COSC 2354-02'),
('COSC 2354', '2021', 'Fall', 3, 'COSC 2354-07'),
('COSC 3353', '2022', 'Fall', 1, 'COSC 3353-02'),
('COSC 3353', '2022', 'Fall', 1, 'COSC 3353-03');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `last_name`, `first_name`) VALUES
(1, 'Neale', 'Isadora'),
(2, 'Tucker', 'Elwood'),
(3, 'Valdez', 'Jacques'),
(4, 'Myers', 'Alexander'),
(5, 'Smith', 'John'),
(6, 'Lee', 'Sarah'),
(7, 'Grater', 'Ally'),
(8, 'Tucker', 'Savannah'),
(9, 'Leta', 'Carver'),
(10, 'Cooper', 'Alice');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`assessment_number`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_number`);

--
-- Indexes for table `course_outcome`
--
ALTER TABLE `course_outcome`
  ADD KEY `PIs` (`performIndicator`),
  ADD KEY `outcome` (`outcome`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `outcomes`
--
ALTER TABLE `outcomes`
  ADD PRIMARY KEY (`outcomeNum`);

--
-- Indexes for table `performIndicator`
--
ALTER TABLE `performIndicator`
  ADD PRIMARY KEY (`performIndicatorNum`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`prof_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD KEY `student` (`student_id`),
  ADD KEY `assessment` (`assessment_number`);

--
-- Indexes for table `reference`
--
ALTER TABLE `reference`
  ADD KEY `courseNum` (`course_number`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `assessment_number` (`assessment_number`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `prof_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_outcome`
--
ALTER TABLE `course_outcome`
  ADD CONSTRAINT `course` FOREIGN KEY (`course`) REFERENCES `courses` (`course_number`),
  ADD CONSTRAINT `outcome` FOREIGN KEY (`outcome`) REFERENCES `outcomes` (`outcomeNum`),
  ADD CONSTRAINT `PIs` FOREIGN KEY (`performIndicator`) REFERENCES `performIndicator` (`performIndicatorNum`);

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `assessment` FOREIGN KEY (`assessment_number`) REFERENCES `assessments` (`assessment_number`),
  ADD CONSTRAINT `student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `reference`
--
ALTER TABLE `reference`
  ADD CONSTRAINT `assessment_number` FOREIGN KEY (`assessment_number`) REFERENCES `assessments` (`assessment_number`),
  ADD CONSTRAINT `courseNum` FOREIGN KEY (`course_number`) REFERENCES `courses` (`course_number`),
  ADD CONSTRAINT `prof_id` FOREIGN KEY (`prof_id`) REFERENCES `professors` (`prof_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
