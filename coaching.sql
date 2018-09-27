-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2018 at 10:11 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coaching`
--

-- --------------------------------------------------------

--
-- Table structure for table `applcation`
--

CREATE TABLE `applcation` (
  `Serial` int(11) NOT NULL,
  `Application Id` varchar(10) NOT NULL,
  `User Id` varchar(10) NOT NULL,
  `Subject` varchar(120) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applcation`
--

INSERT INTO `applcation` (`Serial`, `Application Id`, `User Id`, `Subject`, `Description`, `Status`) VALUES
(1, 'ACT001', 'TCR03001', 'Room Allocation', 'I need a room to held project defense tomorrow', 'Pending'),
(2, 'ACT002', 'TCR03001', 'Salary Withdraw', 'I need to withdraw my salary tomorrow', 'Approved'),
(3, 'ACT003', 'TCR01010', 'Room Allocation', 'I need a room to arrange a make-up class tomorrow', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `Serial` int(10) NOT NULL,
  `Course Id` varchar(10) NOT NULL,
  `Student Id` varchar(10) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`Serial`, `Course Id`, `Student Id`, `Status`, `Date`) VALUES
(3, 'CRS10012', 'STD10001', 'Present', '2018-04-30'),
(4, 'CRS10007', 'STD10001', 'Absent', '2018-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `Serial` int(11) NOT NULL,
  `Batch ID` varchar(10) NOT NULL,
  `BatchName` varchar(40) NOT NULL,
  `Class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`Serial`, `Batch ID`, `BatchName`, `Class`) VALUES
(10, 'BAT08001', 'Class 8 Slot 1', 8),
(11, 'BAT10002', 'Class 10 Slot 1', 10),
(12, 'BAT09003', 'Class 9 Slot 1', 9),
(13, 'BAT06004', 'Class 6 Slot 1', 6),
(14, 'BAT07005', 'Class 7 Slot 1', 7),
(15, 'BAT06006', 'Class 6 Slot 2', 6),
(16, 'BAT07007', 'Class 7 Slot 2', 7),
(17, 'BAT08008', 'Class 8 Slot 2', 8),
(18, 'BAT09009', 'Class 9 Slot 2', 9),
(19, 'BAT10010', 'Class 10 Slot 2', 10);

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `Serial` int(11) NOT NULL,
  `Complain Id` varchar(10) NOT NULL,
  `Teacher Id` varchar(10) NOT NULL,
  `Student Id` varchar(10) NOT NULL,
  `Subject` varchar(120) NOT NULL,
  `Description` varchar(256) NOT NULL,
  `Status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`Serial`, `Complain Id`, `Teacher Id`, `Student Id`, `Subject`, `Description`, `Status`) VALUES
(1, 'CMP001', 'TCR03001', 'STD10001', 'Late on Class', 'He was absent for last 2 weeks on all my classes', 'Pending'),
(2, 'CMP002', 'TCR03001', 'STD10001', 'Quiz Performance', 'He get 0 on each of the quizes', 'Approved'),
(3, 'CMP003', 'TCR01010', 'STD10001', 'Exam Manner', 'He submitted an empty script in quiz', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Serial` int(11) NOT NULL,
  `Course Id` varchar(8) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Class` int(10) NOT NULL,
  `Teacher Id` varchar(8) NOT NULL,
  `Batch Id` varchar(8) NOT NULL,
  `Slot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Serial`, `Course Id`, `Name`, `Class`, `Teacher Id`, `Batch Id`, `Slot`) VALUES
(9, 'CRS08001', 'Mathematics', 8, 'TCR03001', 'BAT08001', 2),
(10, 'CRS10002', 'Mathematics', 10, 'TCR03001', 'BAT10002', 3),
(11, 'CRS06003', 'Bangla 1st Paper', 6, 'TCR01010', 'BAT06004', 1),
(12, 'CRS06004', 'Mathematics', 6, 'TCR03007', 'BAT06004', 5),
(13, 'CRS06004', 'Mathematics', 6, 'TCR03007', 'BAT08008', 6),
(14, 'CRS06006', 'Bangla 2nd Paper', 6, 'TCR01004', 'BAT06004', 2),
(15, 'CRS10007', 'Bangla 2nd Paper', 10, 'TCR01010', 'BAT10010', 5),
(16, 'CRS07008', 'Bangla 1st Paper', 7, 'TCR01010', 'BAT07005', 1),
(17, 'CRS07009', 'Bangla 2nd Paper', 7, 'TCR01004', 'BAT07007', 1),
(18, 'CRS08010', 'Bangla 1st Paper', 8, 'TCR01004', 'BAT08001', 6),
(19, 'CRS09011', 'Bangla 1st Paper', 9, 'TCR01010', 'BAT09003', 4),
(20, 'CRS10012', 'Bangla 1st Paper', 10, 'TCR01004', 'BAT10010', 5);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `Serial` int(10) NOT NULL,
  `Exam_ID` varchar(32) NOT NULL,
  `Course_ID` varchar(10) NOT NULL,
  `Std_ID` varchar(20) NOT NULL,
  `Marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Serial`, `Exam_ID`, `Course_ID`, `Std_ID`, `Marks`) VALUES
(5, '1', 'CRS10012', 'STD10001', 85),
(6, '4', 'CRS10012', 'STD10001', 94),
(7, '4', 'CRS10007', 'STD10001', 92);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `Serial` int(10) NOT NULL,
  `Teacher Id` varchar(10) NOT NULL,
  `Course id` varchar(10) NOT NULL,
  `File Name` varchar(120) NOT NULL,
  `File Link` varchar(256) NOT NULL,
  `Upload Time` datetime(6) NOT NULL,
  `Size` double(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`Serial`, `Teacher Id`, `Course id`, `File Name`, `File Link`, `Upload Time`, `Size`) VALUES
(1, 'TCR01004', 'CRS08010', 'Lecture Note 1', '../resource/file/.Lab_Report_1.pdf', '2018-04-30 00:00:00.000000', 0.99),
(2, 'TCR03001', 'CRS10002', 'Lecture Note 1', '../resource/file/.Lab Assignment 1_v2.docx', '2018-04-30 00:00:00.000000', 0.02),
(3, 'TCR03001', 'CRS10002', 'Lecture Note 2', '../resource/file/.Lab Assignment 2.docx', '2018-04-30 00:00:00.000000', 0.03),
(4, 'TCR01004', 'CRS10012', 'Assignment', '../resource/file/.Assignment_Question.docx', '2018-04-30 00:00:00.000000', 0.02),
(5, 'TCR01004', 'CRS10012', 'Course Outline', '../resource/file/.Compiler Course_Outline Fall17-18.docx', '2018-04-30 00:00:00.000000', 0.03),
(6, 'TCR01010', 'CRS10007', 'TSF', '../resource/file/.upazilla.pdf', '2018-04-30 00:00:00.000000', 0.11);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Serial` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Serial`, `id`, `Password`, `Type`) VALUES
(1, 'admin', '4a7d1ed414474e4033ac29ccb8653d9b', 'Admin'),
(7, 'TCR03001', '589215416c29d9a38aec8b2bd3c763af', 'Teacher'),
(8, 'TCR06002', '02966bb8094db6fa7b9cc8b587cb0452', 'Teacher'),
(9, 'TCR02003', '9fca67713f60be76faa49866a9a11298', 'Teacher'),
(10, 'TCR01004', '1342f9e40839914cc6a59d5f284277e3', 'Teacher'),
(11, 'TCR04005', '9ee6d3f806a30e69a534ac3f6f1dcd8b', 'Teacher'),
(12, 'TCR05006', '8c024aa86158dd8acec3568d45b36a5a', 'Teacher'),
(13, 'TCR03007', '2302e8dd642e391f86771dd1c5601d0c', 'Teacher'),
(14, 'TCR04008', 'bb360535ed835ccf6f18d725345c8688', 'Teacher'),
(15, 'TCR06009', '3075a2ce1f7a95ddfcc268041a01ebf5', 'Teacher'),
(16, 'TCR01010', 'ccf46c68e20ed5d0a8731131892033e9', 'Teacher'),
(17, 'TCR05011', 'b0fd73dfa89a26b63b2b1008e395256a', 'Teacher'),
(18, 'STD10001', '7b5cda6e03740eaaa2efd4f21109a8ed', 'Student'),
(19, 'STD06002', 'e0e72c956445156513aed8e37fda8c06', 'Student'),
(20, 'STD07003', '73a94706b3aecbac80b238ad7ac371ca', 'Student'),
(21, 'STD09004', '3f70b2aa0601cfea9a7ffc5a751baa77', 'Student'),
(22, 'STD08005', 'e8b3136ea5024068fb0fe82def4a4afb', 'Student'),
(23, 'STD06006', '69be3eb3176bc5b686d51f67706c1edc', 'Student'),
(24, 'STD07007', 'ef07a88641ba6224739fe453d6cc9fc1', 'Student'),
(25, 'STD08008', 'cfde2f8427043041d5d4be637baf5086', 'Student'),
(26, 'STD09009', '219ce62190341d6e5390036ad4b5f98f', 'Student'),
(27, 'STD10010', 'b02e480817dbd6ae530d22f1087f296b', 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `Serial` int(10) NOT NULL,
  `Teacher Id` varchar(10) NOT NULL,
  `Course id` varchar(10) NOT NULL,
  `Subject` varchar(120) NOT NULL,
  `Description` varchar(1200) NOT NULL,
  `Upload Time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`Serial`, `Teacher Id`, `Course id`, `Subject`, `Description`, `Upload Time`) VALUES
(1, 'TCR01004', 'CRS08010', 'Greetings', 'Welcome to  your 1st Class', '2018-04-30 00:00:00.000000'),
(2, 'TCR01004', 'CRS08010', 'Attendence', '2 consecutive 15 minutes late or later will be considered as a absent', '2018-04-30 00:00:00.000000'),
(3, 'TCR03001', 'CRS10002', 'Greetings', 'Welcome to my Mathematics Class.', '2018-04-30 00:00:00.000000'),
(4, 'TCR03001', 'CRS10002', 'Attendence', 'No Late will be tolerated', '2018-04-30 00:00:00.000000'),
(5, 'TCR01004', 'CRS10012', 'Greetings', 'Welcome to Â your 1st Class', '2018-04-30 00:00:00.000000'),
(6, 'TCR01004', 'CRS10012', 'Attendance Issue', '2 consecutive 15 minutes late or later will be considered as a absent', '2018-04-30 00:00:00.000000'),
(7, 'TCR01004', 'CRS10012', 'Late Attendance', 'No Late after 15 minutes will be tolerated', '2018-04-30 00:00:00.000000'),
(8, 'TCR01010', 'CRS10007', 'Class Cancelled', 'Class is Cancelled due to bad weather', '2018-04-30 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Serial` int(10) NOT NULL,
  `User Id` varchar(10) NOT NULL,
  `Ammount` int(32) NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `Payment Type` varchar(10) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Serial`, `User Id`, `Ammount`, `Discount`, `Payment Type`, `Date`) VALUES
(1, 'TCR03001', 10000, 0, '1', '2018-04-30'),
(2, 'TCR03001', 200, 0, '2', '2018-04-30'),
(3, 'TCR06002', 15000, 0, '1', '2018-04-30'),
(4, 'TCR06002', 200, 0, '2', '2018-04-30'),
(5, 'TCR02003', 20000, 0, '1', '2018-04-30'),
(6, 'TCR02003', 450, 10, '2', '2018-04-30'),
(7, 'STD10001', 750, 25, '1', '2018-04-30'),
(8, 'STD06002', 900, 10, '1', '2018-04-30'),
(9, 'STD07003', 1000, 0, '1', '2018-04-30'),
(10, 'STD09004', 1000, 0, '1', '2018-04-30'),
(11, 'STD10001', 125, 50, '2', '2018-04-30'),
(12, 'STD10001', 25, 50, '3', '2018-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `Serial` varchar(10) NOT NULL,
  `Student Id` varchar(10) NOT NULL,
  `Grade` varchar(10) NOT NULL,
  `Number` int(10) NOT NULL,
  `Exam Id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `Serial` int(11) NOT NULL,
  `Day` varchar(40) NOT NULL,
  `Time` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot`
--

INSERT INTO `slot` (`Serial`, `Day`, `Time`) VALUES
(1, 'Sunday, Tuesday', '8:00 am - 10:00 am'),
(2, 'Sunday, Tuesday', '10:00am - 12:00pm'),
(3, 'Monday, Wednesday', '8:00 am - 10:00 am'),
(4, 'Monday, Wednesday', '10:00 am - 12:00 pm'),
(5, 'Sunday, Tuesday', '12:00pm - 2:00pm'),
(6, 'Monday, Wednesday', '12:00pm - 2:00pm');

-- --------------------------------------------------------

--
-- Table structure for table `std_profile`
--

CREATE TABLE `std_profile` (
  `Serial` int(11) NOT NULL,
  `Std_id` varchar(12) DEFAULT NULL,
  `Std_Name` varchar(100) NOT NULL,
  `Std_Father_Name` varchar(100) NOT NULL,
  `Std_Mother_Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Roll` varchar(10) NOT NULL,
  `Class` int(4) NOT NULL,
  `Batch` varchar(20) DEFAULT NULL,
  `DOB` date NOT NULL,
  `BG` varchar(8) NOT NULL,
  `Mobile` int(14) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `Religion` varchar(8) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Current Balance` int(32) NOT NULL,
  `Photo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `std_profile`
--

INSERT INTO `std_profile` (`Serial`, `Std_id`, `Std_Name`, `Std_Father_Name`, `Std_Mother_Name`, `Email`, `Roll`, `Class`, `Batch`, `DOB`, `BG`, `Mobile`, `Address`, `Religion`, `Gender`, `Current Balance`, `Photo`) VALUES
(1, 'STD10001', 'Omar Khaium Chowdhury', 'Monir Chowdhury', 'Shahida Begum', 'omar@emial.edu', '7', 10, 'BAT10010', '1996-05-08', '7', NULL, 'Bashundhara R/A', '1', 'male', 0, '../resource/image/student/omar.jpg'),
(2, 'STD06002', 'Jeffrey B. Adams', 'Adams Ben', 'Charlie Jeffrey', 'jeffrey@tutor.edu', '6', 6, 'BAT06004', '1998-11-16', '1', NULL, 'Franklee Lane, Philadelphia', '4', 'male', 0, '../resource/image/student/2D751EC000000578-0-image-a-20_1444967267166.jpg'),
(3, 'STD07003', 'Crystal J. Nelson', 'Jacob Nelson', 'Ammy Smith', 'crystal@tutor.edu', '7', 7, 'BAT07005', '1996-12-08', '4', NULL, 'Romano Street Malden, MA', '4', 'male', 0, '../resource/image/student/nelson-crystal-ce9u2404-edit.jpg'),
(4, 'STD09004', 'Sandra J. Hayes', 'James Hayes', 'Enna Steel', 'sandra@tutor.edu', '1', 9, 'BAT09003', '1999-01-07', '6', NULL, 'Hillside Drive Bedford, MA', '4', 'female', 0, '../resource/image/student/logan-square-20170622.jpg'),
(5, 'STD08005', 'Liam Painye', 'Billy Scott', 'Kara C. Levine', 'liam@tutor.edu', '8', 8, 'BAT08001', '2000-10-04', '5', NULL, 'Grant View Drive Milwaukee, WI', '4', 'male', 0, '../resource/image/student/cozy.jpg'),
(6, 'STD06006', 'Thomas V. Stewart', 'Kane Stewart', 'Lina jay', 'thomas@tutor.com', '9', 6, 'BAT06006', '2002-05-04', '5', NULL, 'Hurry Street Elkton, VA', '4', 'male', 0, '../resource/image/student/800px_COLOURBOX6941050.jpg'),
(7, 'STD07007', 'Chance L. Ramos', 'Sargio Ramos', 'Halen Rehexa', 'ramos@tutor.com', '1', 7, 'BAT07007', '2004-02-13', '8', NULL, 'Hilltop Street Chicopee, MA', '4', 'male', 0, '../resource/image/student/9794fbc4859d1c1bd5422a6a0c00fe47.jpg'),
(8, 'STD08008', 'Rosa J. Stancil Mendes', 'Rosa Mendes', 'Jinny Mendes', 'stancil@tutor.com', '11', 8, 'BAT08008', '2002-05-08', '7', NULL, 'Tibbs Avenue Plentywood, Auckland', '4', 'female', 0, '../resource/image/student/166669449.jpg'),
(9, 'STD09009', 'Jennifer T. White', 'Camerron White', 'Dana White', 'jennifer@tutor.edu', '4', 9, 'BAT09009', '2001-08-23', '2', NULL, 'Twin Willow Lane Southport, NC', '4', 'female', 0, '../resource/image/student/photo.jpg'),
(10, 'STD10010', 'Michael K. Thompson', 'Michael Pelps', 'Katy Perry', 'Thompson@tutor.com', '1', 10, 'BAT10002', '2000-12-27', '8', NULL, 'Coleman Avenue Palm Springs, CA', '4', 'male', 0, '../resource/image/student/photo2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tcr_profile`
--

CREATE TABLE `tcr_profile` (
  `Serial` int(11) NOT NULL,
  `Id` varchar(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Department` int(11) NOT NULL,
  `Designation` int(11) NOT NULL,
  `Salary` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `Blood group` int(11) NOT NULL,
  `Address` varchar(32) NOT NULL,
  `Religion` int(11) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Photo` varchar(100) DEFAULT NULL,
  `Current Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tcr_profile`
--

INSERT INTO `tcr_profile` (`Serial`, `Id`, `Name`, `Email`, `Mobile`, `Department`, `Designation`, `Salary`, `DOB`, `Blood group`, `Address`, `Religion`, `Gender`, `Photo`, `Current Balance`) VALUES
(9, 'TCR03001', 'Lonnie A. Chase', 'lonnie@tutor.edu', '301-858-3610', 3, 1, 15000, '1982-12-07', 8, 'Saint Margarets, MD 21401', 4, 'male', '../resource/image/teacher/wsaz_mug_LonnieMarcum.jpg', 0),
(10, 'TCR06002', 'Alan Walker', 'alan@tutor.edu', '01824119970', 6, 1, 12000, '1997-08-24', 7, 'Northampton, United Kingdom', 4, 'male', '../resource/image/teacher/f571b392ccb622ec5f3f865bbe55227b.jpg', 0),
(11, 'TCR02003', 'Adam Smith', 'adam@tutor.edu', '01798426421', 2, 3, 10000, '1991-08-15', 2, 'Washington, NYCity', 4, 'male', '../resource/image/teacher/Adam Smith.jpg', 0),
(12, 'TCR01004', 'Bob Marley', 'bob@tutor.edu', '019752846852', 1, 4, 5000, '1992-11-08', 3, 'Las Vegas, Neevada', 4, 'male', '../resource/image/teacher/A-41441-1444396064-7860.jpeg.jpg', 0),
(13, 'TCR04005', 'Samantha Burton', 'samantha@tutor.edu', '01975845441', 4, 1, 20000, '1994-11-08', 5, 'Nebraska, Ohio', 4, 'female', '../resource/image/teacher/samantha burton.jpg', 0),
(14, 'TCR05006', 'Alice Cooper', 'alice@tutor.com', '826565362782', 5, 2, 15000, '1988-04-08', 1, 'Florida, Miami', 4, 'male', '../resource/image/teacher/TCR05006.jpg', 0),
(15, 'TCR03007', 'Basic Ali', 'basic@tutor.edu', '16198461384', 3, 2, 15000, '1994-02-28', 6, 'Nurullahpur, Noakhali', 1, 'male', '../resource/image/teacher/basic-ali-jpg.jpeg', 0),
(16, 'TCR04008', 'Natalie Scott', 'scott@tutor.com', '16124158755', 4, 2, 15000, '1994-02-28', 6, 'Abdullahpur, Dhaka', 4, 'female', '../resource/image/teacher/female-math-teacher-clip-art-free.png', 0),
(17, 'TCR06009', 'Clasy Jensen', 'clay@tutor.edu', '01741478965', 6, 3, 15000, '1992-07-15', 7, 'Massachusetts, Boston', 4, 'male', '../resource/image/teacher/music.jpg', 0),
(18, 'TCR01010', 'Udash Vabuk', 'udash@tutor.edu', '198524679521', 1, 3, 10000, '1988-04-19', 4, 'Feni, Chittagong', 1, 'male', '../resource/image/teacher/FoFo.JPG', 0),
(19, 'TCR05011', 'Saifur Rahman', 'sifur@tutor.edu', '19884751214', 5, 4, 10000, '1988-04-19', 4, 'Kachpur, Dhaka', 1, 'male', '../resource/image/teacher/images.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applcation`
--
ALTER TABLE `applcation`
  ADD PRIMARY KEY (`Serial`),
  ADD UNIQUE KEY `Serial` (`Serial`),
  ADD UNIQUE KEY `Application Id` (`Application Id`);

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`Serial`),
  ADD UNIQUE KEY `Serial` (`Serial`),
  ADD UNIQUE KEY `Complain Id` (`Complain Id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Serial`),
  ADD UNIQUE KEY `Serial` (`Serial`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Serial`),
  ADD UNIQUE KEY `Serial` (`Serial`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `std_profile`
--
ALTER TABLE `std_profile`
  ADD PRIMARY KEY (`Serial`),
  ADD UNIQUE KEY `Std_id` (`Std_id`);

--
-- Indexes for table `tcr_profile`
--
ALTER TABLE `tcr_profile`
  ADD PRIMARY KEY (`Serial`),
  ADD UNIQUE KEY `Serial` (`Serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applcation`
--
ALTER TABLE `applcation`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `Serial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `Serial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `Serial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `Serial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Serial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `std_profile`
--
ALTER TABLE `std_profile`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tcr_profile`
--
ALTER TABLE `tcr_profile`
  MODIFY `Serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
