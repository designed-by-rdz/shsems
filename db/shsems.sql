-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2025 at 11:35 PM
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
-- Database: `shsems`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblAssessments`
--

CREATE TABLE `tblAssessments` (
  `assessment_id` int(11) NOT NULL,
  `assessment_questions` longtext NOT NULL,
  `assessment_choices` longtext NOT NULL,
  `assessment_strands` longtext NOT NULL,
  `assessment_status` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblAssessments`
--

INSERT INTO `tblAssessments` (`assessment_id`, `assessment_questions`, `assessment_choices`, `assessment_strands`, `assessment_status`) VALUES
(1, '{\"0\":{\"question\":\"Which subject do you enjoy the most?\"},\"1\":{\"question\":\"Which activity sounds most interesting to you?\"},\"2\":{\"question\":\"Which career path appeals to you the most?\"},\"3\":{\"question\":\"How do you prefer to learn?\"},\"4\":{\"question\":\"How do you solve problems?\"},\"5\":{\"question\":\"What type of challenges do you enjoy most?\"},\"6\":{\"question\":\"How do you usually express your creativity?\"},\"7\":{\"question\":\"In group work, what role do you usually take?\"},\"8\":{\"question\":\"What do you value most in a future career?\"},\"9\":{\"question\":\"Which statement describes you best?\"}}', '{\"0\":{\"a\":\"Mathematics or Science\",\"b\":\"Business or Economics\",\"c\":\"Social Studies or English\",\"d\":\"A mix of different subjects\",\"e\":\"TLE or hands-on practical subjects\"},\"1\":{\"a\":\"Conducting experiments and solving problems\",\"b\":\"Starting a small business or managing money\",\"c\":\"Debating, writing essays, or discussing current events\",\"d\":\"Exploring various topics to find what I like most\",\"e\":\"Building, cooking, fixing, or designing something practical\"},\"2\":{\"a\":\"Engineer, doctor, scientist\",\"b\":\"Entrepreneur, accountant, manager\",\"c\":\"Lawyer, teacher, psychologist, journalist\",\"d\":\"Undecided but open to different fields\",\"e\":\"Chef, mechanic, programmer, fashion designer\"},\"3\":{\"a\":\"Through research, analysis, and logical reasoning\",\"b\":\"Through real-life business simulations and teamwork\",\"c\":\"Through discussions and expressing ideas\",\"d\":\"By exploring multiple approaches\",\"e\":\"By doing things hands-on\"},\"4\":{\"a\":\"Analyze daya or use formulas\",\"b\":\"Think of practical or financial solutions\",\"c\":\"Consider moral, emotional, or social effects\",\"d\":\"Mix different solutions and test which works best\",\"e\":\"Fix it with tools, actions, or step-by-step work\"},\"5\":{\"a\":\"Solving math/science problems\",\"b\":\"Managing money or planning business strategies\",\"c\":\"Understanding peopple or communicating ideas\",\"d\":\"Exploring new experiences\",\"e\":\"Working with my hands and creating tangible results\"},\"6\":{\"a\":\"Designing experiments or inventions\",\"b\":\"Developing business ideas or marketing plans\",\"c\":\"Writing, acting, or speaking\",\"d\":\"Mixing different interests or hobbies\",\"e\":\"Making crafts, food, or repairs\"},\"7\":{\"a\":\"The researcher or problem solver\",\"b\":\"The organizer or leader\",\"c\":\"The communicator or writer\",\"d\":\"The flexible helper who does various tasks\",\"e\":\"The does who handles practical work\"},\"8\":{\"a\":\"Innovation and discovery\",\"b\":\"Financial success and leadership\",\"c\":\"Helping others and expressing ideas\",\"d\":\"Flexibility and variety\",\"e\":\"Skills mastery and job readiness\"},\"9\":{\"a\":\"I like challenging myself intellectually\",\"b\":\"I am business-minded and confident\",\"c\":\"I am curious about people and society\",\"d\":\"I like to keep my options open\",\"e\":\"I prefer to work with tools or technology\"}}', '{\"a\":{\"name\":\"STEM\", \"fullname\":\"Science, Technology, Engineering, and Mathematics\", \"description\":\"Your assessment results show that you have strong analytical and logical thinking skills — the kind of mind that loves solving problems and uncovering how things work. The STEM strand will help you develop these abilities further through science, mathematics, and technology-based learning. You’ll engage in experiments, data analysis, and real-world problem-solving that prepare you for innovation and discovery. This strand builds a solid foundation for future careers in engineering, medicine, computer science, architecture, research, and other scientific fields. With your curiosity, precision, and determination, you have what it takes to thrive in STEM and contribute to shaping the future through innovation and technology.\"},\"b\":{\"name\":\"ABM\",\"fullname\":\"Accountancy, Business, and Management\", \"description\":\"Your results indicate a strong sense of leadership, practicality, and strategic thinking — qualities that fit perfectly in the ABM strand. This strand focuses on developing your skills in entrepreneurship, business management, finance, and marketing. You’ll learn how organizations operate and how to make smart decisions that lead to success. ABM prepares you for careers such as accountant, business owner, manager, marketing professional, or banker. With your confidence, goal-oriented mindset, and ability to plan effectively, you are ready to take on challenges in the world of business and turn ideas into success.\"},\"c\":{\"name\":\"HUMSS\",\"fullname\":\"Humanities and Social Sciences\", \"description\":\"Your strengths in communication, empathy, and critical thinking make you an excellent fit for the HUMSS strand. This strand nurtures your passion for understanding people, society, and the world around you. Through studies in communication, culture, literature, and social sciences, you’ll learn how to express yourself clearly and think deeply about real-life issues. HUMSS prepares you for meaningful careers in education, journalism, law, psychology, public service, and social work. With your creativity, compassion, and strong sense of purpose, you are well-equipped to make a positive impact on others and use your voice to inspire change.\"},\"d\":{\"name\":\"GAS\",\"fullname\":\"General Academic Strand\", \"description\":\"Your results show that you have diverse interests and flexible thinking, making the GAS strand a great match for you. This strand offers a balanced mix of subjects from different disciplines, allowing you to explore various fields before choosing a specific college course or career path. You’ll gain a broad academic foundation while developing skills in communication, problem-solving, and critical thinking. GAS can lead to opportunities in education, business, social sciences, and other professional fields. With your curiosity, adaptability, and eagerness to learn, you are well-prepared to succeed in whichever direction you choose to take in the future.\"},\"e\":{\"name\":\"TVL\",\"fullname\":\"Technical-Vocational-Livelihood\", \"description\":\"Your assessment results highlight your practical skills, creativity, and hands-on approach to learning — qualities that make you a great fit for the TVL strand. This strand focuses on developing job-ready and entrepreneurial skills through real-world training in areas such as information and communication technology, home economics, industrial arts, or agri-fishery arts. You’ll gain valuable technical experience and can even earn TESDA certifications that allow you to work or start a business right after senior high school. With your resourcefulness, dedication, and passion for doing things with excellence, you are ready to build a successful and rewarding career through the TVL strand.\"}}', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblData`
--

CREATE TABLE `tblData` (
  `did` int(11) NOT NULL,
  `dvalue` varchar(1000) NOT NULL,
  `dkey` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblData`
--

INSERT INTO `tblData` (`did`, `dvalue`, `dkey`) VALUES
(1, 'ay', '2025-2026'),
(2, 'sem', '1'),
(3, 'available', 'Yes'),
(4, 'school', 'Daniel R. Aguinaldo National High School'),
(5, 'version', '3.0');

-- --------------------------------------------------------

--
-- Table structure for table `tblEmployees`
--

CREATE TABLE `tblEmployees` (
  `employee_numid` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `employee_surname` varchar(150) NOT NULL,
  `employee_givenname` varchar(150) NOT NULL,
  `employee_middlename` varchar(150) NOT NULL,
  `employee_extname` varchar(10) DEFAULT NULL,
  `employee_birthdate` varchar(20) NOT NULL,
  `employee_gender` varchar(20) NOT NULL,
  `employee_religion` varchar(100) NOT NULL,
  `address_street` varchar(200) NOT NULL,
  `address_city` varchar(200) NOT NULL,
  `address_province` varchar(200) NOT NULL,
  `employee_cp` varchar(11) NOT NULL,
  `employee_email` varchar(200) NOT NULL,
  `employee_designation` varchar(200) NOT NULL,
  `account_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblEmployees`
--

INSERT INTO `tblEmployees` (`employee_numid`, `employee_id`, `employee_surname`, `employee_givenname`, `employee_middlename`, `employee_extname`, `employee_birthdate`, `employee_gender`, `employee_religion`, `address_street`, `address_city`, `address_province`, `employee_cp`, `employee_email`, `employee_designation`, `account_username`) VALUES
(1, '1001', 'Rizal', 'Alavar', 'Reyes', '', '1997-03-29', 'Male', 'Iglesia+ni+Cristo', 'Sokah-Sokah', 'Sapa-Sapa', 'Tawi-Tawi', '09999999999', 'rizalalavar%40gmail.com', 'Instructor+1', 'evaluator'),
(2, '1002', 'Barrios', 'Mike+Anthony', 'I', 'Jr.', '1997-12-01', 'Male', 'Roman+Catholic', 'Zone+2', 'Indanan', 'Sulu', '09999999999', 'mike.anthony.97%40gmail.com', 'Instructor+1', 'encoder'),
(3, '1003', 'Coronel', 'Josefina', 'Misposa', NULL, '2004-12-18', 'Female', 'Roman+Catholic', 'Don+Navarro', 'Zamboanga+City', 'NA', '09999999999', 'jmisposa%40gmail.com', 'Instructor+2', 'admin'),
(5, '00679898', 'Tarro', 'Murriendo', 'Claro', 'III', '1999-01-20', 'Male', 'Iglesia+ni+Cristo', 'Poblacion', 'Jaro', 'Ilo-Ilo', '09999999999', 'murriendotarrothethird%40gmail.com', 'Instructor+1', 'eva');

-- --------------------------------------------------------

--
-- Table structure for table `tblEnrollment`
--

CREATE TABLE `tblEnrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_lrn` varchar(12) NOT NULL,
  `enrollment_data` varchar(20) NOT NULL,
  `academic_year` varchar(10) NOT NULL,
  `academic_sem` varchar(2) NOT NULL,
  `enrollment_date` varchar(20) NOT NULL,
  `enrollment_status` varchar(20) NOT NULL,
  `enrollment_flags` varchar(100) DEFAULT NULL,
  `evaluator_id` varchar(100) DEFAULT NULL,
  `evaluator_date` varchar(20) DEFAULT NULL,
  `encoder_id` varchar(100) DEFAULT NULL,
  `encoder_date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblEnrollment`
--

INSERT INTO `tblEnrollment` (`enrollment_id`, `student_lrn`, `enrollment_data`, `academic_year`, `academic_sem`, `enrollment_date`, `enrollment_status`, `enrollment_flags`, `evaluator_id`, `evaluator_date`, `encoder_id`, `encoder_date`) VALUES
(1, '112312432543', 'STEM11A', '2025-2026', '1', '2025-11-01 00:19', 'ENROLLED', 'No+downpayment', 'evaluator', '2025-11-01 20:47', 'encoder', '2025-11-01 22:46'),
(2, '122423356432', 'GAS|11', '2025-2026', '1', '2025-11-02 00:34', 'EVALUATED', NULL, 'evaluator', '2025-11-02 00:35', NULL, NULL),
(3, '123456789012', 'STEM11A', '2025-2026', '1', '2025-11-02 18:54', 'ENROLLED', NULL, 'evaluator', '2025-11-02 18:50', 'encoder', '2025-11-02 18:54'),
(4, '123456789012', 'STEM11A', '2024-2025', '2', '2025-11-01 22:56', 'ENROLLED', NULL, 'evaluator', '2025-11-01 22:55', 'encoder', '2025-11-01 22:56'),
(5, '124742543453', 'STEM|12', '2025-2026', '1', '2025-11-13 02:22', 'PENDING', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblFlags`
--

CREATE TABLE `tblFlags` (
  `flag_code` varchar(20) NOT NULL,
  `flag_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblFlags`
--

INSERT INTO `tblFlags` (`flag_code`, `flag_description`) VALUES
('ALS', 'ALS'),
('New Student', 'New Student'),
('Old Student', 'Old Student'),
('Retaker', 'Retaker'),
('Transferee', 'Transferee');

-- --------------------------------------------------------

--
-- Table structure for table `tblGenders`
--

CREATE TABLE `tblGenders` (
  `gender_code` varchar(20) NOT NULL,
  `gender_description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblGenders`
--

INSERT INTO `tblGenders` (`gender_code`, `gender_description`) VALUES
('Female', 'Female'),
('Male', 'Male'),
('Nonbinary', 'Nonbinary'),
('Prefer+not+to+Say', 'Prefer+not+to+Say');

-- --------------------------------------------------------

--
-- Table structure for table `tblLogs`
--

CREATE TABLE `tblLogs` (
  `log_id` int(11) NOT NULL,
  `log_user` varchar(100) NOT NULL,
  `log_action` varchar(5000) NOT NULL,
  `log_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblLogs`
--

INSERT INTO `tblLogs` (`log_id`, `log_user`, `log_action`, `log_date`) VALUES
(1, 'admin', 'user logged in', '2025-10-29 23:19'),
(2, 'admin', 'user logged out', '2025-10-30 00:07'),
(3, 'admin', 'user logged in', '2025-10-30 00:07'),
(4, 'admin', 'user logged out', '2025-10-30 00:22'),
(5, 'admin', 'user logged in', '2025-10-30 09:25'),
(6, 'admin', 'user logged out', '2025-10-30 09:26'),
(7, 'admin', 'user logged in', '2025-10-30 09:27'),
(8, 'admin', 'user logged out', '2025-10-30 09:49'),
(9, 'admin', 'user logged in', '2025-10-30 09:49'),
(10, 'admin', 'user logged in', '2025-10-30 11:06'),
(11, 'admin', 'user logged out', '2025-10-30 11:07'),
(12, 'admin', 'user logged in', '2025-10-30 11:07'),
(13, 'admin', 'user logged out', '2025-10-30 11:10'),
(14, 'student_test', 'user registered an account', '2025-10-30 13:28'),
(15, 'student', 'user registered an account', '2025-10-30 13:29'),
(16, 'student', 'user logged in', '2025-10-30 13:30'),
(17, 'student', 'user logged out', '2025-10-30 13:30'),
(18, 'admin', 'user logged in', '2025-10-30 13:30'),
(19, '', 'user set user 3 status to Inactive', '2025-10-30 16:29'),
(20, '', 'user set user 3 status to Inactive', '2025-10-30 16:30'),
(21, '', 'user set user 3 status to Active', '2025-10-30 16:31'),
(22, 'admin', 'user logged out', '2025-10-30 17:00'),
(23, 'admin', 'user logged in', '2025-10-30 17:00'),
(24, 'stud', 'user registered an account', '2025-10-30 17:14'),
(25, 'admin', 'user logged out', '2025-10-30 17:16'),
(26, 'stud', 'user logged in', '2025-10-30 17:16'),
(27, 'stud', 'user logged out', '2025-10-30 17:16'),
(28, 'admin', 'user logged in', '2025-10-30 17:16'),
(29, 'admin', 'user logged out', '2025-10-30 21:00'),
(30, 'admin', 'user logged in', '2025-10-30 21:01'),
(31, 'admin', 'user logged out', '2025-10-30 21:01'),
(32, 'stud', 'user logged in', '2025-10-30 21:01'),
(33, 'stud', 'user logged out', '2025-10-30 21:46'),
(34, 'admin', 'user logged in', '2025-10-30 21:46'),
(35, 'stud', 'user registered an account', '2025-10-30 21:59'),
(36, 'admin', 'user logged out', '2025-10-30 21:59'),
(37, 'stud', 'user logged in', '2025-10-30 21:59'),
(38, 'stud', 'user updated his/her personal information', '2025-10-30 22:58'),
(39, 'stud', 'user logged out', '2025-10-30 23:02'),
(40, 'stud', 'user logged in', '2025-10-30 23:02'),
(41, 'stud', 'user updated his/her educational information', '2025-10-30 23:47'),
(42, 'stud', 'user updated his/her emergency contact information', '2025-10-31 00:06'),
(43, 'stud', 'user logged out', '2025-10-31 00:15'),
(44, 'admin', 'user logged in', '2025-10-31 00:16'),
(45, 'admin', 'user logged out', '2025-10-31 00:16'),
(46, 'stud', 'user logged in', '2025-10-31 00:16'),
(47, 'stud', 'user updated his/her personal information', '2025-10-31 00:17'),
(48, 'stud', 'user logged out', '2025-10-31 00:33'),
(49, 'admin', 'user logged in', '2025-10-31 00:33'),
(50, 'admin', 'user logged out', '2025-10-31 00:43'),
(51, 'stud', 'user logged in', '2025-10-31 14:36'),
(52, 'stud', 'user logged out', '2025-10-31 19:52'),
(53, 'admin', 'user logged in', '2025-10-31 19:52'),
(54, 'admin', 'user logged out', '2025-10-31 19:53'),
(55, 'stud', 'user logged in', '2025-10-31 19:53'),
(56, 'stud', 'user logged out', '2025-10-31 21:21'),
(57, 'admin', 'user logged in', '2025-10-31 21:21'),
(58, 'admin', 'user created STEM strand', '2025-10-31 23:05'),
(59, 'admin', 'user logged out', '2025-10-31 23:05'),
(60, 'admin', 'user logged in', '2025-10-31 23:15'),
(61, 'admin', 'user created GAS strand', '2025-10-31 23:15'),
(62, 'admin', 'user created GAS strand', '2025-10-31 23:19'),
(63, '', 'user deleted 3 from tblStrands', '2025-10-31 23:19'),
(64, 'admin', 'user logged out', '2025-10-31 23:19'),
(65, 'stud', 'user logged in', '2025-10-31 23:20'),
(66, 'stud', 'user enrolled as grade  ', '2025-11-01 00:19'),
(67, 'stud', 'user logged out', '2025-11-01 00:21'),
(68, 'stud', 'user logged in', '2025-11-01 00:21'),
(69, 'stud', 'user logged out', '2025-11-01 00:21'),
(70, 'admin', 'user logged in', '2025-11-01 00:21'),
(71, 'evaluator', 'user registered an account', '2025-11-01 00:21'),
(72, 'evaluator', 'user registered an account', '2025-11-01 00:29'),
(73, 'admin', 'user logged out', '2025-11-01 00:29'),
(74, 'evaluator', 'user logged in', '2025-11-01 00:29'),
(75, 'evaluator', 'user logged out', '2025-11-01 00:29'),
(76, 'encoder', 'user registered an account', '2025-11-01 00:30'),
(77, 'encoder', 'user logged in', '2025-11-01 00:30'),
(78, 'encoder', 'user logged out', '2025-11-01 00:30'),
(79, 'evaluator', 'user logged in', '2025-11-01 00:30'),
(80, 'evaluator', 'user logged out', '2025-11-01 00:45'),
(81, 'admin', 'user logged in', '2025-11-01 00:46'),
(82, 'admin', 'user logged out', '2025-11-01 09:44'),
(83, 'stud', 'user logged in', '2025-11-01 09:44'),
(84, 'stud', 'user logged out', '2025-11-01 09:48'),
(85, 'admin', 'user logged in', '2025-11-01 09:48'),
(86, 'admin', 'user logged out', '2025-11-01 09:51'),
(87, 'evaluator', 'user logged in', '2025-11-01 09:51'),
(88, 'evaluator', 'user updated his/her personal information', '2025-11-01 10:11'),
(89, 'evaluator', 'user updated his/her personal information', '2025-11-01 10:12'),
(90, 'evaluator', 'user updated his/her personal information', '2025-11-01 10:12'),
(91, 'evaluator', 'user logged out', '2025-11-01 10:12'),
(92, 'admin', 'user logged in', '2025-11-01 10:12'),
(93, 'admin', 'user logged out', '2025-11-01 10:12'),
(94, 'encoder', 'user logged in', '2025-11-01 10:12'),
(95, 'encoder', 'user logged out', '2025-11-01 10:14'),
(96, 'evaluator', 'user logged in', '2025-11-01 10:15'),
(97, 'evaluator', 'user logged out', '2025-11-01 10:15'),
(98, 'encoder', 'user logged in', '2025-11-01 10:15'),
(99, 'encoder', 'user updated his/her personal information', '2025-11-01 10:17'),
(100, 'encoder', 'user logged out', '2025-11-01 10:17'),
(101, 'admin', 'user logged in', '2025-11-01 10:17'),
(102, 'admin', 'user created faculty 1003', '2025-11-01 11:42'),
(103, 'admin', 'user logged out', '2025-11-01 11:45'),
(104, 'evaluator', 'user logged in', '2025-11-01 11:45'),
(105, 'evaluator', 'user logged out', '2025-11-01 11:48'),
(106, 'admin', 'user logged in', '2025-11-01 11:48'),
(107, 'admin', 'user logged out', '2025-11-01 11:52'),
(108, 'evaluator', 'user logged in', '2025-11-01 11:53'),
(109, '', 'user approved evaluation of student 112312432543', '2025-11-01 13:25'),
(110, 'evaluator', 'user logged out', '2025-11-01 13:32'),
(111, 'encoder', 'user logged in', '2025-11-01 13:36'),
(112, 'encoder', 'user logged out', '2025-11-01 13:42'),
(113, 'admin', 'user logged in', '2025-11-01 13:42'),
(114, 'admin', 'user logged out', '2025-11-01 13:43'),
(115, 'evaluator', 'user logged in', '2025-11-01 13:43'),
(116, 'evaluator', 'user logged out', '2025-11-01 16:38'),
(117, 'admin', 'user logged in', '2025-11-01 16:39'),
(118, 'admin', 'user logged out', '2025-11-01 20:23'),
(119, 'evaluator', 'user logged in', '2025-11-01 20:23'),
(120, 'evaluator', 'user updated remarks for evaluation of student 112312432543', '2025-11-01 20:37'),
(121, 'evaluator', 'user updated remarks for evaluation of student 112312432543', '2025-11-01 20:38'),
(122, 'evaluator', 'user approved evaluation of student 112312432543', '2025-11-01 20:38'),
(123, 'evaluator', 'user logged out', '2025-11-01 20:41'),
(124, 'admin', 'user logged in', '2025-11-01 20:41'),
(125, 'admin', 'user logged out', '2025-11-01 20:42'),
(126, 'encoder', 'user logged in', '2025-11-01 20:42'),
(127, 'encoder', 'user updated remarks for evaluation of student 112312432543', '2025-11-01 20:47'),
(128, 'encoder', 'user updated encoding remarks of student 112312432543', '2025-11-01 20:57'),
(129, 'encoder', 'user logged out', '2025-11-01 21:20'),
(130, 'admin', 'user logged in', '2025-11-01 21:20'),
(131, 'admin', 'user created GAS strand', '2025-11-01 21:21'),
(132, 'admin', 'user created section Alpha for STEM', '2025-11-01 22:03'),
(133, 'admin', 'user logged out', '2025-11-01 22:13'),
(134, 'encoder', 'user logged in', '2025-11-01 22:13'),
(135, 'encoder', 'user enrolled student 112312432543 to STEM11A', '2025-11-01 22:46'),
(136, 'encoder', 'user logged out', '2025-11-01 22:53'),
(137, 'evaluator', 'user logged in', '2025-11-01 22:55'),
(138, 'evaluator', 'user logged out', '2025-11-01 23:02'),
(139, 'encoder', 'user logged in', '2025-11-01 23:02'),
(140, 'encoder', 'user logged out', '2025-11-01 23:03'),
(141, 'stud', 'user logged in', '2025-11-01 23:03'),
(142, 'stud', 'user logged out', '2025-11-01 23:18'),
(143, 'admin', 'user logged in', '2025-11-01 23:18'),
(144, 'admin', 'user logged out', '2025-11-02 00:09'),
(145, 'stud', 'user logged in', '2025-11-02 00:14'),
(146, 'stud', 'user logged out', '2025-11-02 00:15'),
(147, 'admin', 'user logged in', '2025-11-02 00:20'),
(148, 'admin', 'user created section Alpha for STEM', '2025-11-02 00:22'),
(149, 'admin', 'user logged out', '2025-11-02 00:23'),
(150, 'student', 'user registered an account', '2025-11-02 00:26'),
(151, 'student', 'user registered an account', '2025-11-02 00:30'),
(152, 'student', 'user logged in', '2025-11-02 00:30'),
(153, 'student', 'user updated his/her personal information', '2025-11-02 00:31'),
(154, 'student', 'user updated his/her emergency contact information', '2025-11-02 00:32'),
(155, 'student', 'user updated his/her educational information', '2025-11-02 00:34'),
(156, 'student', 'user enrolled as grade  ', '2025-11-02 00:34'),
(157, 'student', 'user logged out', '2025-11-02 00:34'),
(158, 'evaluator', 'user logged in', '2025-11-02 00:35'),
(159, 'evaluator', 'user downloaded 1224233564322025-20261.zip', '2025-11-02 00:35'),
(160, 'evaluator', 'user approved evaluation of student 122423356432', '2025-11-02 00:35'),
(161, 'evaluator', 'user logged out', '2025-11-02 00:35'),
(162, 'student', 'user logged in', '2025-11-02 00:35'),
(163, 'student', 'user logged out', '2025-11-02 00:37'),
(164, 'encoder', 'user logged in', '2025-11-02 00:38'),
(165, 'encoder', 'user logged out', '2025-11-02 00:38'),
(166, 'admin', 'user logged in', '2025-11-02 00:54'),
(167, 'estudyante', 'user registered an account', '2025-11-02 18:37'),
(168, 'estudyante', 'user logged in', '2025-11-02 18:37'),
(169, 'estudyante', 'user updated his/her personal information', '2025-11-02 18:40'),
(170, 'estudyante', 'user updated his/her emergency contact information', '2025-11-02 18:42'),
(171, 'estudyante', 'user updated his/her educational information', '2025-11-02 18:43'),
(172, 'estudyante', 'user enrolled as grade  ', '2025-11-02 18:45'),
(173, 'estudyante', 'user logged out', '2025-11-02 18:46'),
(174, 'evaluator', 'user logged in', '2025-11-02 18:47'),
(175, 'evaluator', 'user downloaded 1234567890122025-20261.zip', '2025-11-02 18:49'),
(176, '', 'user downloaded 1234567890122025-20261.zip', '2025-11-02 18:49'),
(177, 'evaluator', 'user approved evaluation of student 123456789012', '2025-11-02 18:50'),
(178, 'evaluator', 'user logged out', '2025-11-02 18:52'),
(179, 'encoder', 'user logged in', '2025-11-02 18:53'),
(180, 'encoder', 'user enrolled student 123456789012 to STEM11A', '2025-11-02 18:54'),
(181, 'encoder', 'user logged out', '2025-11-02 18:56'),
(182, 'admin', 'user logged in', '2025-11-02 18:58'),
(183, 'admin', 'user logged out', '2025-11-02 19:03'),
(184, 'admin', 'user logged out', '2025-11-02 21:25'),
(185, 'admin', 'user logged in', '2025-11-02 21:25'),
(186, 'admin', 'user logged out', '2025-11-02 21:28'),
(187, 'evaluator', 'user logged in', '2025-11-02 21:29'),
(188, 'evaluator', 'user logged out', '2025-11-02 21:29'),
(189, 'encoder', 'user logged in', '2025-11-02 21:29'),
(190, 'encoder', 'user logged out', '2025-11-02 21:34'),
(191, 'evaluator', 'user logged in', '2025-11-02 21:34'),
(192, 'evaluator', 'user downloaded 1234567890122025-20261.zip', '2025-11-02 21:35'),
(193, 'evaluator', 'user logged out', '2025-11-02 21:35'),
(194, 'admin', 'user logged in', '2025-11-02 21:35'),
(195, 'admin', 'user made changes with Semester', '2025-11-02 22:14'),
(196, 'admin', 'user made changes with Semester', '2025-11-02 22:15'),
(197, 'admin', 'user made changes with Academic Year', '2025-11-02 22:15'),
(198, 'admin', 'user made changes with Academic Year', '2025-11-02 22:15'),
(199, 'admin', 'user made changes with Availability', '2025-11-02 22:15'),
(200, 'admin', 'user logged out', '2025-11-02 22:15'),
(201, 'estudyante', 'user logged in', '2025-11-02 22:15'),
(202, 'estudyante', 'user logged out', '2025-11-02 22:16'),
(203, 'admin', 'user logged in', '2025-11-02 22:16'),
(204, 'admin', 'user made changes with Availability', '2025-11-02 22:16'),
(205, 'admin', 'user deleted Bilingual from tblGenders', '2025-11-02 22:21'),
(206, 'admin', 'user inserted Nonbinary as new gender', '2025-11-02 22:33'),
(207, 'admin', 'user inserted Shinto as new religion', '2025-11-02 22:35'),
(208, 'admin', 'user deleted Nonbinary from tblGenders', '2025-11-02 22:35'),
(209, 'admin', 'user deleted Shinto from tblReligions', '2025-11-02 22:35'),
(210, 'admin', 'user downloaded 1234567890122025-20261.zip', '2025-11-02 22:48'),
(211, 'admin', 'user logged out', '2025-11-02 22:54'),
(212, 'estudyante', 'user logged in', '2025-11-02 22:54'),
(213, 'estudyante', 'user enrolled as grade  ', '2025-11-02 22:54'),
(214, 'estudyante', 'user logged out', '2025-11-02 22:55'),
(215, 'admin', 'user logged in', '2025-11-02 22:55'),
(216, 'admin', 'user logged out', '2025-11-02 22:55'),
(217, 'evaluator', 'user logged in', '2025-11-02 22:55'),
(218, 'evaluator', 'user approved evaluation of student 123456789012', '2025-11-02 22:55'),
(219, 'evaluator', 'user logged out', '2025-11-02 22:55'),
(220, 'encoder', 'user logged in', '2025-11-02 22:56'),
(221, 'encoder', 'user enrolled student 123456789012 to STEM11A', '2025-11-02 22:56'),
(222, 'encoder', 'user logged out', '2025-11-02 22:56'),
(223, 'admin', 'user logged in', '2025-11-02 22:56'),
(224, 'admin', 'user made changes with Academic Year', '2025-11-02 22:56'),
(225, 'admin', 'user made changes with Semester', '2025-11-02 22:56'),
(226, 'admin', 'user inserted Shinto as new religion', '2025-11-02 23:15'),
(227, 'admin', 'user deleted Shinto from tblReligions', '2025-11-02 23:16'),
(228, 'admin', 'user logged out', '2025-11-02 23:21'),
(229, 'estudyante', 'user logged in', '2025-11-02 23:21'),
(230, 'estudyante', 'user logged out', '2025-11-02 23:23'),
(231, 'evaluator', 'user logged in', '2025-11-02 23:23'),
(232, 'evaluator', 'user logged out', '2025-11-02 23:24'),
(233, 'encoder', 'user logged in', '2025-11-02 23:24'),
(234, 'encoder', 'user logged out', '2025-11-02 23:25'),
(235, 'admin', 'user logged in', '2025-11-02 23:31'),
(236, 'admin', 'user logged out', '2025-11-02 23:45'),
(237, 'estudyante', 'user logged in', '2025-11-02 23:45'),
(238, 'estudyante', 'user logged out', '2025-11-02 23:49'),
(239, 'admin', 'user logged in', '2025-11-02 23:49'),
(240, 'admin', 'user updated GAS strand', '2025-11-02 23:57'),
(241, 'admin', 'user updated section details Alpha of STEM strand', '2025-11-03 00:13'),
(242, 'admin', 'user inserted Nonbinary as new gender', '2025-11-03 00:15'),
(243, 'admin', 'user updated details of account admin', '2025-11-03 00:37'),
(244, 'admin', 'user logged out', '2025-11-03 00:47'),
(245, 'evaluator', 'user logged in', '2025-11-03 00:47'),
(246, 'evaluator', 'user logged out', '2025-11-03 00:47'),
(247, 'encoder', 'user logged in', '2025-11-03 00:47'),
(248, 'encoder', 'user logged out', '2025-11-03 00:48'),
(249, 'admin', 'user logged in', '2025-11-03 00:48'),
(250, 'admin', 'user updated details of account admin', '2025-11-03 00:49'),
(251, 'admin', 'user updated details of account admin', '2025-11-03 00:53'),
(252, 'admin', 'user inserted Budhist as new religion', '2025-11-03 00:53'),
(253, 'admin', 'user updated details of account student', '2025-11-03 01:02'),
(254, 'admin', 'user logged out', '2025-11-03 01:03'),
(255, 'admin', 'user logged in', '2025-11-03 01:03'),
(256, 'admin', 'user set user 10 status to Active', '2025-11-03 01:03'),
(257, 'admin', 'user logged out', '2025-11-03 01:11'),
(258, 'admin', 'user logged in', '2025-11-03 01:18'),
(259, 'admin', 'user logged out', '2025-11-03 01:25'),
(260, 'admin', 'user logged in', '2025-11-03 01:25'),
(261, 'admin', 'user logged out', '2025-11-03 01:28'),
(262, 'admin', 'user logged in', '2025-11-03 01:30'),
(263, 'admin', 'user deleted Budhist from tblReligions', '2025-11-03 01:31'),
(264, 'admin', 'user logged out', '2025-11-03 01:32'),
(265, 'admin', 'user logged in', '2025-11-03 07:05'),
(266, 'admin', 'user made changes with School', '2025-11-03 07:11'),
(267, 'admin', 'user made changes with School', '2025-11-03 07:11'),
(268, 'admin', 'user logged in', '2025-11-03 07:36'),
(269, 'admin', 'user logged out', '2025-11-03 08:02'),
(270, 'abc', 'user registered an account', '2025-11-03 08:02'),
(271, 'abc', 'user logged in', '2025-11-03 08:02'),
(272, 'abc', 'user logged out', '2025-11-03 08:06'),
(273, 'abc', 'user logged in', '2025-11-03 08:06'),
(274, 'abc', 'user logged out', '2025-11-03 08:09'),
(275, 'admin', 'user logged in', '2025-11-03 08:09'),
(276, 'admin', 'user updated details of account abc', '2025-11-03 08:09'),
(277, 'admin', 'user updated details of account abc', '2025-11-03 08:10'),
(278, 'admin', 'user logged out', '2025-11-03 08:10'),
(279, 'abc', 'user logged in', '2025-11-03 08:10'),
(280, 'abc', 'user logged out', '2025-11-03 08:11'),
(281, 'trial', 'user registered an account', '2025-11-03 08:11'),
(282, 'momo', 'user registered an account', '2025-11-03 10:21'),
(283, 'momo', 'user registered an account', '2025-11-03 10:22'),
(284, 'momo', 'user logged in', '2025-11-03 10:22'),
(285, 'momo', 'user logged out', '2025-11-03 10:23'),
(286, 'eva', 'user registered an account', '2025-11-03 10:23'),
(287, 'eva', 'user logged in', '2025-11-03 10:23'),
(288, 'eva', 'user logged out', '2025-11-03 10:31'),
(289, 'admin', 'user logged in', '2025-11-03 10:31'),
(290, 'admin', 'user logged out', '2025-11-03 10:33'),
(291, 'eva', 'user logged in', '2025-11-03 10:33'),
(292, 'eva', 'user logged out', '2025-11-03 10:33'),
(293, 'momo', 'user logged in', '2025-11-03 10:33'),
(294, 'momo', 'user logged out', '2025-11-03 10:33'),
(295, 'admin', 'user logged in', '2025-11-06 08:44'),
(296, 'admin', 'user logged out', '2025-11-08 21:40'),
(297, 'stud', 'user logged in', '2025-11-08 21:40'),
(298, 'stud', 'user logged out', '2025-11-08 21:42'),
(299, 'evaluator', 'user logged in', '2025-11-08 21:42'),
(300, 'evaluator', 'user logged out', '2025-11-08 21:51'),
(301, 'encoder', 'user logged in', '2025-11-08 21:51'),
(302, 'encoder', 'user logged out', '2025-11-08 21:53'),
(303, 'admin', 'user logged in', '2025-11-08 21:53'),
(304, 'admin', 'user updated faculty 1002', '2025-11-08 22:23'),
(305, 'admin', 'user logged out', '2025-11-08 22:30'),
(306, 'admin', 'user logged in', '2025-11-08 22:33'),
(307, 'admin', 'user updated personal information of student 123456789012', '2025-11-09 22:59'),
(308, 'admin', 'user updated emergency information of student 112312432543', '2025-11-09 22:59'),
(309, 'admin', 'user updated educational information of student 122423356432', '2025-11-09 23:00'),
(310, 'admin', 'user updated faculty 00679898', '2025-11-09 23:53'),
(311, 'admin', 'user logged out', '2025-11-10 00:12'),
(312, 'momo', 'user logged in', '2025-11-10 00:12'),
(313, 'momo', 'user logged out', '2025-11-10 00:13'),
(314, 'admin', 'user logged in', '2025-11-10 00:13'),
(315, 'admin', 'user logged out', '2025-11-10 22:46'),
(316, 'estudyante', 'user logged in', '2025-11-10 22:46'),
(317, 'estudyante', 'user took the strand assessment', '2025-11-11 00:19'),
(318, 'estudyante', 'user took the strand assessment', '2025-11-11 01:29'),
(319, 'estudyante', 'user took the strand assessment', '2025-11-11 01:33'),
(320, 'estudyante', 'user logged out', '2025-11-12 19:46'),
(321, 'admin', 'user logged in', '2025-11-12 19:50'),
(322, 'admin', 'user logged in', '2025-11-12 20:47'),
(323, 'admin', 'user logged out', '2025-11-13 01:59'),
(324, 'estudyante', 'user logged in', '2025-11-13 02:00'),
(325, 'estudyante', 'user logged out', '2025-11-13 02:15'),
(326, 'evaluator', 'user logged in', '2025-11-13 02:16'),
(327, 'evaluator', 'user logged out', '2025-11-13 02:18'),
(328, 'admin', 'user logged in', '2025-11-13 02:19'),
(329, 'admin', 'user logged out', '2025-11-13 02:19'),
(330, 'abc', 'user registered an account', '2025-11-13 02:19'),
(331, 'abc', 'user logged in', '2025-11-13 02:19'),
(332, 'abc', 'user updated his/her personal information', '2025-11-13 02:20'),
(333, 'abc', 'user updated his/her personal information', '2025-11-13 02:20'),
(334, 'abc', 'user updated his/her emergency contact information', '2025-11-13 02:21'),
(335, 'abc', 'user updated his/her educational information', '2025-11-13 02:21'),
(336, 'abc', 'user enrolled as grade  ', '2025-11-13 02:22'),
(337, 'abc', 'user logged out', '2025-11-13 02:22'),
(338, 'evaluator', 'user logged in', '2025-11-13 02:22'),
(339, 'evaluator', 'user approved evaluation of student 124742543453', '2025-11-13 02:32'),
(340, 'evaluator', 'user logged out', '2025-11-13 02:32'),
(341, 'encoder', 'user logged in', '2025-11-13 02:32'),
(342, 'encoder', 'user logged out', '2025-11-13 10:49'),
(343, 'admin', 'user logged in', '2025-11-13 10:49'),
(344, 'admin', 'user logged out', '2025-11-13 13:35'),
(345, 'evaluator', 'user logged in', '2025-11-13 13:35'),
(346, 'evaluator', 'user logged out', '2025-11-13 13:41'),
(347, 'encoder', 'user logged in', '2025-11-13 13:41'),
(348, 'encoder', 'user logged out', '2025-11-13 14:34'),
(349, 'admin', 'user logged in', '2025-11-13 14:34'),
(350, 'admin', 'user logged out', '2025-11-13 14:35'),
(351, 'admin', 'user logged in', '2025-11-13 14:42'),
(352, 'admin', 'user logged out', '2025-11-13 14:49'),
(353, 'estudyante', 'user logged in', '2025-11-13 14:50'),
(354, 'estudyante', 'user logged out', '2025-11-13 15:34'),
(355, 'encoder', 'user logged in', '2025-11-13 22:24'),
(356, 'encoder', 'user logged out', '2025-11-13 22:24'),
(357, 'evaluator', 'user logged in', '2025-11-13 22:24'),
(358, 'evaluator', 'user logged out', '2025-11-13 22:52'),
(359, 'admin', 'user logged in', '2025-11-13 22:52'),
(360, 'admin', 'user inserted Undertaker as new enrollment flag', '2025-11-13 22:58'),
(361, 'admin', 'user deleted Undertaker from tblFlags', '2025-11-13 22:58'),
(362, 'admin', 'user logged out', '2025-11-14 22:40'),
(363, 'estudyante', 'user logged in', '2025-11-14 22:40'),
(364, 'estudyante', 'user logged out', '2025-11-14 22:42'),
(365, 'evaluator', 'user logged in', '2025-11-14 22:42'),
(366, 'evaluator', 'user logged out', '2025-11-14 22:43'),
(367, 'encoder', 'user logged in', '2025-11-14 22:43'),
(368, 'encoder', 'user logged out', '2025-11-14 22:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblReligions`
--

CREATE TABLE `tblReligions` (
  `religion_code` varchar(100) NOT NULL,
  `religion_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblReligions`
--

INSERT INTO `tblReligions` (`religion_code`, `religion_description`) VALUES
('Iglesia+ni+Cristo', 'INC'),
('Islam', 'Islam'),
('Protestant', 'Protestant'),
('Roman+Catholic', 'Roman+Catholic'),
('Seventh+Day+Adventist', 'Seventh+Day+Adventist');

-- --------------------------------------------------------

--
-- Table structure for table `tblResults`
--

CREATE TABLE `tblResults` (
  `result_id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result_points` mediumtext NOT NULL,
  `result_date` varchar(20) NOT NULL,
  `student_lrn` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblResults`
--

INSERT INTO `tblResults` (`result_id`, `examination_id`, `result_points`, `result_date`, `student_lrn`) VALUES
(2, 1, '1,0,2,5,2', '2025-11-11 01:29', '123456789012'),
(3, 1, '1,1,5,2,1', '2025-11-11 01:33', '123456789012');

-- --------------------------------------------------------

--
-- Table structure for table `tblRoles`
--

CREATE TABLE `tblRoles` (
  `role_code` varchar(20) NOT NULL,
  `role_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblRoles`
--

INSERT INTO `tblRoles` (`role_code`, `role_description`) VALUES
('Administrator', 'Overall+in+charge+of+the+system'),
('Encoder', 'Teachers+who+will+assign+students+to+their+respective+classes'),
('Evaluator', 'Teachers+who+will+verify+student+registrations%2C+documents%2C+and+flag+issues+or+concerns+if+any'),
('Student', 'Students');

-- --------------------------------------------------------

--
-- Table structure for table `tblSections`
--

CREATE TABLE `tblSections` (
  `section_id` varchar(25) NOT NULL,
  `section_strand` varchar(25) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `section_grade` int(11) NOT NULL,
  `section_max_count` int(11) NOT NULL,
  `section_adviser` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblSections`
--

INSERT INTO `tblSections` (`section_id`, `section_strand`, `section_name`, `section_grade`, `section_max_count`, `section_adviser`) VALUES
('STEM11A', 'STEM', 'Alpha', 11, 20, ''),
('STEM12A', 'STEM', 'Alpha', 12, 35, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblStrands`
--

CREATE TABLE `tblStrands` (
  `strand_id` int(11) NOT NULL,
  `strand_name` varchar(200) NOT NULL,
  `strand_description` varchar(500) NOT NULL,
  `strand_max_section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblStrands`
--

INSERT INTO `tblStrands` (`strand_id`, `strand_name`, `strand_description`, `strand_max_section`) VALUES
(1, 'STEM', 'Science%2C+Technology%2C+Engineering%2C+and+Mathematics', 4),
(4, 'GAS', 'General+Academic+Strand', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblStudents`
--

CREATE TABLE `tblStudents` (
  `student_id` int(11) NOT NULL,
  `student_lrn` varchar(12) NOT NULL,
  `student_surname` varchar(150) NOT NULL,
  `student_givenname` varchar(150) NOT NULL,
  `student_middlename` varchar(150) NOT NULL,
  `student_extname` varchar(10) DEFAULT NULL,
  `student_gender` varchar(20) NOT NULL,
  `student_religion` varchar(100) NOT NULL,
  `student_birthdate` varchar(20) NOT NULL,
  `address_street` varchar(200) DEFAULT NULL,
  `address_city` varchar(200) NOT NULL,
  `address_province` varchar(200) NOT NULL,
  `student_cpnumber` varchar(11) NOT NULL,
  `student_email` varchar(100) DEFAULT NULL,
  `contact_person` varchar(200) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `contact_address` varchar(500) NOT NULL,
  `contact_relationship` varchar(100) NOT NULL,
  `educ_primary` varchar(200) NOT NULL,
  `educ_primary_year` varchar(4) NOT NULL,
  `educ_jhs` varchar(200) NOT NULL,
  `educ_jhs_year` varchar(4) NOT NULL,
  `educ_jhs_grade` varchar(10) NOT NULL,
  `account_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblStudents`
--

INSERT INTO `tblStudents` (`student_id`, `student_lrn`, `student_surname`, `student_givenname`, `student_middlename`, `student_extname`, `student_gender`, `student_religion`, `student_birthdate`, `address_street`, `address_city`, `address_province`, `student_cpnumber`, `student_email`, `contact_person`, `contact_number`, `contact_address`, `contact_relationship`, `educ_primary`, `educ_primary_year`, `educ_jhs`, `educ_jhs_year`, `educ_jhs_grade`, `account_username`) VALUES
(1, '112312432543', 'Aguinaldo', 'Mario', 'Del+Rey', '', 'Male', 'Roman+Catholic', '2010-05-09', 'Ayala', 'Zamboanga+City', 'Zamboanga+del+Sur', '09999999999', 'marioadr%40gmail.com', 'Sandro+Aguinaldo', '09199999999', 'Zamboanga+City', 'Sibling', 'Talon-Talon+Elementary+School', '2020', 'Ateneo+de+Zamboanga+Junior+High+School', '2024', '89.5', 'stud'),
(2, '122423356432', 'Marasigan', 'Emorada', 'Nana', '', 'Female', 'Protestant', '2011-01-11', 'Poblacion', 'Malaybalay+City', 'Bukidnon', '09222222222', '', 'Luzviminda+Marasigan', '09999999999', 'Bukidnon', 'Parent', 'Campo+Militar+Elementary+School', '2020', 'Bukidnon+National+High+School', '2024', '83.25', 'student'),
(3, '123456789012', 'Manulon', 'Nurshaima', 'Idjirani', '', 'Female', 'Islam', '2010-11-12', 'Sinunuc', 'Zamboanga+City', 'Zamboanga+del+Sur', '09959999999', '', 'Fatima+Reeza+I.+Manulon', '09999999999', 'Sinunuc%2C+Zamboanga+City', 'Parent', 'Sinunuc+Elementary+School', '2019', 'Sinunuc+National+High+School', '2025', '87.25', 'estudyante'),
(5, '77707189', '', '', '', NULL, '', '', '', NULL, '', '', '', NULL, '', '', '', '', '', '', '', '', '', 'momo'),
(6, '124742543453', 'Mag', 'Testing', 'Sadja', '', 'Male', 'Islam', '2000-02-04', 'Sanga-Sanga', 'Bongao', 'Tawi-Tawi', '09999999999', '', 'Bang+Maka+Pass', '09999999999', 'Bongao%2C+Tawi-Tawi', 'Relative', 'Testing', '2003', 'Testong', '2000', '94.2', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserAccounts`
--

CREATE TABLE `tblUserAccounts` (
  `account_id` int(11) NOT NULL,
  `account_username` varchar(100) NOT NULL,
  `account_password` varchar(100) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  `permission_rights` varchar(20) DEFAULT 'R',
  `account_user` varchar(20) DEFAULT NULL,
  `account_last_active` varchar(20) DEFAULT NULL,
  `account_status` varchar(50) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblUserAccounts`
--

INSERT INTO `tblUserAccounts` (`account_id`, `account_username`, `account_password`, `user_role`, `permission_rights`, `account_user`, `account_last_active`, `account_status`) VALUES
(1, 'admin', 'TwabpR6EuBE%3D', 'Administrator', 'RWA', '1003', '2025-11-13 22:52', 'Active'),
(5, 'stud', 'XRaDqBXb%2FhNqGw%3D%3D', 'Student', 'R', '112312432543', '2025-11-08 21:40', 'Active'),
(7, 'evaluator', 'SxSXoAXU%2Fk0qGYdx', 'Evaluator', 'RW', '1001', '2025-11-14 22:42', 'Active'),
(8, 'encoder', 'SwyVoxTQ%2BBNqGw%3D%3D', 'Encoder', 'R', '1002', '2025-11-14 22:43', 'Active'),
(10, 'student', 'XRaDqBXb%2FhNqGw%3D%3D', 'Student', 'R', '122423356432', '2025-11-02 00:35', 'Active'),
(11, 'estudyante', 'H1DF%2BEWDvRo%3D', 'Student', 'R', '123456789012', '2025-11-14 22:40', 'Active'),
(13, 'trial', 'WhCfrRyEuBE%3D', 'Evaluator', 'R', NULL, NULL, 'Active'),
(15, 'momo', 'Qw2bow%3D%3D', 'Student', 'R', '77707189', '2025-11-10 00:12', 'Active'),
(16, 'eva', 'SxSX%2FUKG', 'Evaluator', 'R', '00679898', '2025-11-03 10:33', 'Active'),
(17, 'abc', 'H1DF', 'Student', 'R', '46972025', '2025-11-13 02:19', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblAssessments`
--
ALTER TABLE `tblAssessments`
  ADD PRIMARY KEY (`assessment_id`);

--
-- Indexes for table `tblData`
--
ALTER TABLE `tblData`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `tblEmployees`
--
ALTER TABLE `tblEmployees`
  ADD PRIMARY KEY (`employee_numid`);

--
-- Indexes for table `tblEnrollment`
--
ALTER TABLE `tblEnrollment`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `tblFlags`
--
ALTER TABLE `tblFlags`
  ADD PRIMARY KEY (`flag_code`);

--
-- Indexes for table `tblGenders`
--
ALTER TABLE `tblGenders`
  ADD PRIMARY KEY (`gender_code`);

--
-- Indexes for table `tblLogs`
--
ALTER TABLE `tblLogs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `tblReligions`
--
ALTER TABLE `tblReligions`
  ADD PRIMARY KEY (`religion_code`);

--
-- Indexes for table `tblResults`
--
ALTER TABLE `tblResults`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `tblRoles`
--
ALTER TABLE `tblRoles`
  ADD PRIMARY KEY (`role_code`);

--
-- Indexes for table `tblSections`
--
ALTER TABLE `tblSections`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `tblStrands`
--
ALTER TABLE `tblStrands`
  ADD PRIMARY KEY (`strand_id`);

--
-- Indexes for table `tblStudents`
--
ALTER TABLE `tblStudents`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tblUserAccounts`
--
ALTER TABLE `tblUserAccounts`
  ADD PRIMARY KEY (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblAssessments`
--
ALTER TABLE `tblAssessments`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblData`
--
ALTER TABLE `tblData`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblEmployees`
--
ALTER TABLE `tblEmployees`
  MODIFY `employee_numid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblEnrollment`
--
ALTER TABLE `tblEnrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblLogs`
--
ALTER TABLE `tblLogs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT for table `tblResults`
--
ALTER TABLE `tblResults`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblStrands`
--
ALTER TABLE `tblStrands`
  MODIFY `strand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblStudents`
--
ALTER TABLE `tblStudents`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblUserAccounts`
--
ALTER TABLE `tblUserAccounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
