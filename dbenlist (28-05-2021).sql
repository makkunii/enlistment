-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2021 at 01:26 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbenlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `Username`, `password`, `role`, `avatar`) VALUES
(1, 'Manuel, Mark Eugene G.', 'makkunii', '$2y$10$OZMmddGYNVym2jTg5BH/dePLpCDLgP0U9uOsOaMuFtYLRLlUVhVZi', 'admin', 'me.jpg'),
(2, 'Angel Rivera', 'rivera', '$2y$10$gSHe9jqPXeA1DRPbE0.3PeCpCVjtnDifxzx9O0EzPHmzf6JJkykXS', 'admin', 'images.png'),
(3, 'Esporna, Reymart', 'esporna21', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'admin', 'images.png');

-- --------------------------------------------------------

--
-- Table structure for table `approvedforms`
--

CREATE TABLE `approvedforms` (
  `id` int(11) NOT NULL,
  `formID` int(11) DEFAULT NULL,
  `ApprovedBy` varchar(50) DEFAULT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `CourseID` varchar(10) NOT NULL,
  `CourseName` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `CourseID`, `CourseName`) VALUES
(6, 'BSCE', 'Bachelors of Science in Civil Engineering'),
(7, 'BSIT', 'Bachelors of Science in Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `DateofBirth` varchar(50) NOT NULL,
  `ContactNo` bigint(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `Department` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `Name`, `DateofBirth`, `ContactNo`, `Address`, `Email`, `Username`, `password`, `role`, `avatar`, `Department`) VALUES
(73, 'makkunii', '2000-01-08', 9751932808, '886 Masagana Stree, Brgy. Daan Sarile, Cabanatuan ', 'mace21218@gmail.com', 'makkunii', '$2y$10$3Vq11B.naeDC1wXDj26kyeiMfUg9nF3XoavBnuo/OWDWTibl4kWWu', 'employee', '0626994ef7a02a13ab0f7912889ece0e-lol-meme-face-by-vexels.png', 'CE'),
(74, 'Angel Summer Rain Rivera', '2000-12-27', 9674567332, 'Cabanatuan City', 'anma.rivera@au.phinma.edu.ph', 'rivera', '$2y$10$14U4e.Hhz2idxHNpAuIiVelkmaWV/hCjGyXPS.jg2LGsVnfiqwXpq', 'employee', 'mikasa.jpg', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `formrequest`
--

CREATE TABLE `formrequest` (
  `formID` int(11) NOT NULL,
  `Class` varchar(20) NOT NULL,
  `Course` varchar(20) NOT NULL,
  `YearLevel` varchar(20) NOT NULL,
  `ContactNumber` varchar(12) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Birthday` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `StudentNumber` varchar(50) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Parent` varchar(50) NOT NULL,
  `ParentContact` varchar(11) NOT NULL,
  `Section` varchar(20) NOT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `EnrollmentStatus` varchar(20) DEFAULT NULL,
  `Sem` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sectionID` int(11) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Room` varchar(50) NOT NULL,
  `YearLevel` varchar(50) NOT NULL,
  `SchoolYear` varchar(50) NOT NULL,
  `NoOfStudent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sectionID`, `Section`, `Room`, `YearLevel`, `SchoolYear`, `NoOfStudent`) VALUES
(4178, '1CE-C1-1', 'ONLINE-C', '1st Year', '21-22', NULL),
(4179, '1CE-C1-1', 'ONLINE-C', '1st Year', '21-22', NULL),
(4180, '1CE-C1-3', 'ONLINE-C', '1st Year', '21-22', NULL),
(4181, '1CE-C1-3', 'ONLINE-C', '1st Year', '21-22', NULL),
(4182, '1CE-C1-5', 'ONLINE-C', '1st Year', '21-22', NULL),
(4183, '1CE-C1-5', 'ONLINE-C', '1st Year', '21-22', NULL),
(4184, '1CE-C1-7', 'ONLINE-C', '1st Year', '21-22', NULL),
(4185, '1CE-C1-7', 'ONLINE-C', '1st Year', '21-22', NULL),
(4186, '1CE-C1-9', 'ONLINE-C', '1st Year', '21-22', NULL),
(4187, '1CE-C1-9', 'ONLINE-C', '1st Year', '21-22', NULL),
(4188, '1CE-C1-10', 'ONLINE-C', '1st Year', '21-22', NULL),
(4189, '1CE-C1-10', 'ONLINE-C', '1st Year', '21-22', NULL),
(4190, '1CE-C2-2', 'ONLINE-C', '1st Year', '21-22', NULL),
(4191, '1CE-C2-2', 'ONLINE-C', '1st Year', '21-22', NULL),
(4192, '1CE-C2-4', 'ONLINE-C', '1st Year', '21-22', NULL),
(4193, '1CE-C2-4', 'ONLINE-C', '1st Year', '21-22', NULL),
(4194, '1CE-C2-6', 'ONLINE-C', '1st Year', '21-22', NULL),
(4195, '1CE-C2-6', 'ONLINE-C', '1st Year', '21-22', NULL),
(4196, '1CE-C2-8', 'ONLINE-C', '1st Year', '21-22', NULL),
(4197, '1CE-C2-8', 'ONLINE-C', '1st Year', '21-22', NULL),
(4198, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4199, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4200, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4201, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4202, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4203, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4204, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4205, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4206, '2CE-C1-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4207, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4208, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4209, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4210, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4211, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4212, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4213, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4214, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4215, '2CE-C1-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4216, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4217, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4218, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4219, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4220, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4221, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4222, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4223, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4224, '2CE-C1-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4225, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4226, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4227, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4228, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4229, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4230, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4231, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4232, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4233, '2CE-C2-1', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4234, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4235, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4236, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4237, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4238, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4239, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4240, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4241, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4242, '2CE-C2-2', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4243, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4244, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4245, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4246, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4247, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4248, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4249, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4250, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4251, '2CE-C2-3', 'ONLINE-C', '2nd Year', '21-22', NULL),
(4252, '2BSIT-C1-1S', 'TBA', '2nd Year', '20-21', 5),
(4253, '2BSIT-C1-1S', 'TBA', '2nd Year', '20-21', 5),
(4254, '2BSIT-C1-1S', 'TBA', '2nd Year', '20-21', 5),
(4255, '2BSIT-C1-1S', 'TBA', '2nd Year', '20-21', 5),
(4256, '2BSIT-C1-1S', 'CL1', '2nd Year', '20-21', 5),
(4257, '2BSIT-C1-1S', 'CL1', '2nd Year', '20-21', 5),
(4258, '2BSIT-C1-1S', 'CL1', '2nd Year', '20-21', 5),
(4259, '2BSIT-C1-1S', 'HOME', '2nd Year', '20-21', 5),
(4260, '2BSIT-C1-1S', 'TBA', '2nd Year', '20-21', 5),
(4261, '2BSIT-C1-2S', 'TBA', '2nd Year', '20-21', NULL),
(4262, '2BSIT-C1-2S', 'TBA', '2nd Year', '20-21', NULL),
(4263, '2BSIT-C1-2S', 'TBA', '2nd Year', '20-21', NULL),
(4264, '2BSIT-C1-2S', 'TBA', '2nd Year', '20-21', NULL),
(4265, '2BSIT-C1-2S', 'CL1', '2nd Year', '20-21', NULL),
(4266, '2BSIT-C1-2S', 'CL1', '2nd Year', '20-21', NULL),
(4267, '2BSIT-C1-2S', 'CL1', '2nd Year', '20-21', NULL),
(4268, '2BSIT-C1-2S', 'HOME', '2nd Year', '20-21', NULL),
(4269, '2BSIT-C1-2S', 'TBA', '2nd Year', '20-21', NULL),
(4270, '2BSIT-C1-3S', 'TBA', '2nd Year', '20-21', NULL),
(4271, '2BSIT-C1-3S', 'TBA', '2nd Year', '20-21', NULL),
(4272, '2BSIT-C1-3S', 'TBA', '2nd Year', '20-21', NULL),
(4273, '2BSIT-C1-3S', 'TBA', '2nd Year', '20-21', NULL),
(4274, '2BSIT-C1-3S', 'CL1', '2nd Year', '20-21', NULL),
(4275, '2BSIT-C1-3S', 'CL1', '2nd Year', '20-21', NULL),
(4276, '2BSIT-C1-3S', 'CL1', '2nd Year', '20-21', NULL),
(4277, '2BSIT-C1-3S', 'HOME', '2nd Year', '20-21', NULL),
(4278, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4279, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4280, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4281, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4282, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4283, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4284, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4285, '3BSIT-C2-1S', 'CL1', '3rd Year', '20-21', NULL),
(4286, '3BSIT-C2-2S', 'CL1', '3rd Year', '20-21', NULL),
(4287, '3BSIT-C2-2S', 'CL1', '3rd Year', '20-22', NULL),
(4288, '3BSIT-C2-2S', 'TBA', '3rd Year', '20-21', NULL),
(4289, '3BSIT-C2-2S', 'CL1', '3rd Year', '20-21', NULL),
(4290, '3BSIT-C2-2S', 'TBA', '3rd Year', '20-21', NULL),
(4291, '3BSIT-C2-2S', 'CL1', '3rd Year', '20-21', NULL),
(4292, '3BSIT-C2-2S\n', 'CL1', '3rd Year', '20-21', NULL),
(4293, '3BSIT-C2-2S\n', 'TBA', '3rd Year', '20-21', NULL),
(4294, '4BSIT-C1-1', '107 AC', '4th Year', '20-21', NULL),
(4295, '4BSIT-C1-1', '107 AC', '4th Year', '20-21', NULL),
(4296, '4BSIT-C1-1', '107 AC', '4th Year', '20-21', NULL),
(4297, '4BSIT-C1-1', 'CL4', '4th Year', '20-21', NULL),
(4298, '4BSIT-C1-2', '107 AC', '4th Year', '20-21', NULL),
(4299, '4BSIT-C1-2', '107 AC', '4th Year', '20-21', NULL),
(4300, '4BSIT-C1-2', '107 AC', '4th Year', '20-21', NULL),
(4301, '4BSIT-C1-2', 'CL4', '4th Year', '20-21', NULL),
(4302, 'Irregular', 'TBA', '1st Year', '21-22', NULL),
(4303, 'Irregular', 'TBA', '2nd Year', '21-22', NULL),
(4304, 'Irregular', 'TBA', '3rd Year', '21-22', NULL),
(4305, 'Irregular', 'TBA', '4th Year', '21-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentsubject`
--

CREATE TABLE `studentsubject` (
  `SSID` int(11) NOT NULL,
  `StudentNumber` varchar(50) NOT NULL,
  `SubjectCode` varchar(20) NOT NULL,
  `Section` varchar(20) NOT NULL,
  `Semester` varchar(20) NOT NULL,
  `SchoolYear` varchar(20) NOT NULL,
  `YearLevel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectID` int(11) NOT NULL,
  `SubjectCode` varchar(20) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `LecUnits` int(11) NOT NULL,
  `LabUnits` int(11) NOT NULL,
  `lecHours` double NOT NULL,
  `labHours` double NOT NULL,
  `NoOfSection` int(11) NOT NULL,
  `lecFaculty` varchar(50) NOT NULL,
  `labFaculty` varchar(50) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Days` varchar(31) DEFAULT NULL,
  `Time` varchar(100) DEFAULT NULL,
  `Semester` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectID`, `SubjectCode`, `SubjectName`, `Course`, `LecUnits`, `LabUnits`, `lecHours`, `labHours`, `NoOfSection`, `lecFaculty`, `labFaculty`, `Section`, `Days`, `Time`, `Semester`) VALUES
(4166, 'MAT 171', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Maniego, Neal', '', '1CE-C1-1', 'Fri', '9:00-12:00', '1st Sem'),
(4167, 'CIE 110', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Maniego, Neal', '', '1CE-C1-1', 'Fri', '8:00-9:00', '1st Sem'),
(4168, 'MAT 172', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Faculty 1', '', '1CE-C1-3', 'Fri', '9:00-12:00', '1st Sem'),
(4169, 'CIE 111', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Ventosa, Howell', '', '1CE-C1-3', 'Fri', '8:00-9:00', '1st Sem'),
(4170, 'MAT 173', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Maniego, Neal', '', '1CE-C1-5', 'Thu', '9:00-12:00', '1st Sem'),
(4171, 'CIE 112', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Maniego, Neal', '', '1CE-C1-5', 'Thu', '8:00-9:00', '1st Sem'),
(4172, 'MAT 174', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Gacuya, Cristalyn', '', '1CE-C1-7', 'Thu', '9:00-12:00', '1st Sem'),
(4173, 'CIE 113', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Ventosa, Howell', '', '1CE-C1-7', 'Thu', '8:00-9:00', '1st Sem'),
(4174, 'MAT 175', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Maniego, Neal', '', '1CE-C1-9', 'Tue', '9:00-12:00', '1st Sem'),
(4175, 'CIE 114', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Faculty 2', '', '1CE-C1-9', 'Fri', '8:00-9:00', '1st Sem'),
(4176, 'MAT 176', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Faculty 1', '', '1CE-C1-10', 'Tue', '9:00-12:00', '1st Sem'),
(4177, 'CIE 115', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Faculty 1', '', '1CE-C1-10', 'Fri', '8:00-9:00', '1st Sem'),
(4178, 'MAT 177', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Maniego, Neal', '', '1CE-C2-2', 'Fri', '2:30-5:30', '1st Sem'),
(4179, 'CIE 116', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Maniego, Neal', '', '1CE-C2-2', 'Fri', '1:30-2:30', '1st Sem'),
(4180, 'MAT 178', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Faculty 1', '', '1CE-C2-4', 'Fri', '2:30-5:30', '1st Sem'),
(4181, 'CIE 117', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Ventosa, Howell', '', '1CE-C2-4', 'Fri', '1:30-2:30', '1st Sem'),
(4182, 'MAT 179', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Maniego, Neal', '', '1CE-C2-6', 'Thu', '2:30-5:30', '1st Sem'),
(4183, 'CIE 118', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Maniego, Neal', '', '1CE-C2-6', 'Thu', '1:30-2:30', '1st Sem'),
(4184, 'MAT 180', 'Calculus 1 for Engineers', 'BSCE', 4, 0, 4, 0, 0, 'Faculty 1', '', '1CE-C2-8', 'Thu', '2:30-5:30', '1st Sem'),
(4185, 'CIE 119', 'Civil Engineering Orientation', 'BSCE', 2, 0, 2, 0, 0, 'Faculty 1', '', '1CE-C2-8', 'Thu', '1:30-2:30', '1st Sem'),
(4186, 'GEN 006', 'Ethics', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C1-1', 'Tue', '10:00-12:00', '1st Sem'),
(4187, 'CIE 111', 'Engineering Drawings and Plans', 'BSCE', 1, 0, 2, 0, 0, 'Aguila, Gerald', '', '2CE-C1-1', 'Tue', '8:00-10:00', '1st Sem'),
(4188, 'BES 043', 'Computer Fundamentals and Programming', 'BSCE', 0, 2, 0, 4, 0, 'IT', '', '2CE-C1-1', 'Tue/Thu', '1:30-3:30/1:30-3:30', '1st Sem'),
(4189, 'MAT 052', 'Differential Equations', 'BSCE', 3, 0, 2, 0, 0, 'Maniego, Neal', '', '2CE-C1-1', 'Wed', '1:30-3:30', '1st Sem'),
(4190, 'BES 025', 'Statics of Rigid Bodies', 'BSCE', 3, 0, 2, 0, 0, 'Dayson, Angelo', '', '2CE-C1-1', 'Fri', '1:30-3:30', '1st Sem'),
(4191, 'PHI 002', 'Logic', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C1-1', 'Fri', '8:00-10:00', '1st Sem'),
(4192, 'PED 027', 'Physical Activities Towards Health & Fitness', 'BSCE', 2, 0, 1, 0, 0, 'CAS', '', '2CE-C1-1', 'Tue', '3:30-4:30', '1st Sem'),
(4193, 'SSP 005', 'Student Success Program 1', 'BSCE', 1, 0, 1, 0, 0, 'Marcos, Ericka', '', '2CE-C1-1', 'Thu', '11:00-12:00', '1st Sem'),
(4194, 'CHE 025', 'Chemistry for Engineers', 'BSCE', 4, 0, 3, 0, 0, 'CAS', '', '2CE-C1-1', 'Wed/Thu', '10:00-12:00/8:00-10:00', '1st Sem'),
(4195, 'GEN 006', 'Ethics', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C1-2', 'Tue', '10:00-12:00', '1st Sem'),
(4196, 'CIE 111', 'Engineering Drawings and Plans', 'BSCE', 1, 0, 2, 0, 0, 'Aguila, Gerald', '', '2CE-C1-2', 'Wed', '10:00-12:00', '1st Sem'),
(4197, 'BES 043', 'Computer Fundamentals and Programming', 'BSCE', 0, 2, 0, 4, 0, 'IT', '', '2CE-C1-2', 'Tue/Thu', '8:00-10:00/8:00-10:00', '1st Sem'),
(4198, 'MAT 052', 'Differential Equations', 'BSCE', 3, 0, 2, 0, 0, 'Maniego, Neal', '', '2CE-C1-2', 'Tue', '1:30-3:30', '1st Sem'),
(4199, 'BES 025', 'Statics of Rigid Bodies', 'BSCE', 3, 0, 2, 0, 0, 'Dayson, Angelo', '', '2CE-C1-2', 'Thu', '1:30-3:30', '1st Sem'),
(4200, 'PHI 002', 'Logic', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C1-2', 'Fri', '8:00-10:00', '1st Sem'),
(4201, 'PED 027', 'Physical Activities Towards Health & Fitness', 'BSCE', 2, 0, 1, 0, 0, 'CAS', '', '2CE-C1-2', 'Tue', '3:30-4:30', '1st Sem'),
(4202, 'SSP 005', 'Student Success Program 1', 'BSCE', 1, 0, 1, 0, 0, 'Dayson, Angelo', '', '2CE-C1-2', 'Fri', '11:00-12:00', '1st Sem'),
(4203, 'CHE 025', 'Chemistry for Engineers', 'BSCE', 4, 0, 3, 0, 0, 'CAS', '', '2CE-C1-2', 'Wed/Thu', '8:00-10:00/10:00-12:00', '1st Sem'),
(4204, 'GEN 006', 'Ethics', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C1-3', 'Tue', '10:00-12:00', '1st Sem'),
(4205, 'CIE 111', 'Engineering Drawings and Plans', 'BSCE', 1, 0, 2, 0, 0, 'Aguila, Gerald', '', '2CE-C1-3', 'Thu', '8:00-10:00', '1st Sem'),
(4206, 'BES 043', 'Computer Fundamentals and Programming', 'BSCE', 0, 2, 0, 4, 0, 'IT', '', '2CE-C1-3', 'Wed/Fri', '1:30-3:30/1:30-3:30', '1st Sem'),
(4207, 'MAT 052', 'Differential Equations', 'BSCE', 3, 0, 2, 0, 0, 'Faculty 1', '', '2CE-C1-3', 'Thu', '10:00-12:00', '1st Sem'),
(4208, 'BES 025', 'Statics of Rigid Bodies', 'BSCE', 3, 0, 2, 0, 0, 'Dayson, Angelo', '', '2CE-C1-3', 'Tue', '1:30-3:30', '1st Sem'),
(4209, 'PHI 002', 'Logic', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C1-3', 'Fri', '8:00-10:00', '1st Sem'),
(4210, 'PED 027', 'Physical Activities Towards Health & Fitness', 'BSCE', 2, 0, 1, 0, 0, 'CAS', '', '2CE-C1-3', 'Tue', '3:30-4:30', '1st Sem'),
(4211, 'SSP 005', 'Student Success Program 1', 'BSCE', 1, 0, 1, 0, 0, 'Faculty 1', '', '2CE-C1-3', 'Wed', '7:00-8:00', '1st Sem'),
(4212, 'CHE 025', 'Chemistry for Engineers', 'BSCE', 4, 0, 3, 0, 0, 'CAS', '', '2CE-C1-3', 'Tue/Fri', '8:00-10:00/10:00-12:00', '1st Sem'),
(4213, 'GEN 006', 'Ethics', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C2-1', 'Fri', '3:30-5:30', '1st Sem'),
(4214, 'CIE 111', 'Engineering Drawings and Plans', 'BSCE', 1, 0, 2, 0, 0, 'Aguila, Gerald', '', '2CE-C2-1', 'Tue', '1:30-3:30', '1st Sem'),
(4215, 'BES 043', 'Computer Fundamentals and Programming', 'BSCE', 0, 2, 0, 4, 0, 'IT', '', '2CE-C2-1', 'Wed/Fri', '8:00-10:00/8:00-10:00', '1st Sem'),
(4216, 'MAT 052', 'Differential Equations', 'BSCE', 3, 0, 2, 0, 0, 'Maniego, Neal', '', '2CE-C2-1', 'Wed', '10:00-12:00', '1st Sem'),
(4217, 'BES 025', 'Statics of Rigid Bodies', 'BSCE', 3, 0, 2, 0, 0, 'Dayson, Angelo', '', '2CE-C2-1', 'Thu', '10:00-12:00', '1st Sem'),
(4218, 'PHI 002', 'Logic', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C2-1', 'Fri', '1:30-3:30', '1st Sem'),
(4219, 'PED 027', 'Physical Activities Towards Health & Fitness', 'BSCE', 2, 0, 1, 0, 0, 'CAS', '', '2CE-C2-1', 'Tue', '11:00-12:00', '1st Sem'),
(4220, 'SSP 005', 'Student Success Program 1', 'BSCE', 1, 0, 1, 0, 0, 'Marcos, Ericka', '', '2CE-C2-1', 'Tue', '10:00-11:00', '1st Sem'),
(4221, 'CHE 025', 'Chemistry for Engineers', 'BSCE', 4, 0, 3, 0, 0, 'CAS', '', '2CE-C2-1', 'Tue/Fri', '10:00-12:00/8:00-10:00', '1st Sem'),
(4222, 'GEN 006', 'Ethics', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C2-2', 'Fri', '3:30-5:30', '1st Sem'),
(4223, 'CIE 111', 'Engineering Drawings and Plans', 'BSCE', 1, 0, 2, 0, 0, 'Aguila, Gerald', '', '2CE-C2-2', 'Thu', '1:30-3:30', '1st Sem'),
(4224, 'BES 043', 'Computer Fundamentals and Programming', 'BSCE', 0, 2, 0, 4, 0, 'IT', '', '2CE-C2-2', 'Wed/Fri', '10:00-12:00/10:00-12:00', '1st Sem'),
(4225, 'MAT 052', 'Differential Equations', 'BSCE', 3, 0, 2, 0, 0, 'Faculty 1', '', '2CE-C2-2', 'Thu', '8:00-10:00', '1st Sem'),
(4226, 'BES 025', 'Statics of Rigid Bodies', 'BSCE', 3, 0, 2, 0, 0, 'Dayson, Angelo', '', '2CE-C2-2', 'Tue', '8:00-10:00', '1st Sem'),
(4227, 'PHI 002', 'Logic', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C2-2', 'Fri', '1:30-3:30', '1st Sem'),
(4228, 'PED 027', 'Physical Activities Towards Health & Fitness', 'BSCE', 2, 0, 1, 0, 0, 'CAS', '', '2CE-C2-2', 'Tue', '11:00-12:00', '1st Sem'),
(4229, 'SSP 005', 'Student Success Program 1', 'BSCE', 1, 0, 1, 0, 0, 'Faculty 2', '', '2CE-C2-2', 'Thu', '7:00-8:00', '1st Sem'),
(4230, 'CHE 025', 'Chemistry for Engineers', 'BSCE', 4, 0, 3, 0, 0, 'CAS', '', '2CE-C2-2', 'Tue/Wed', '1:30-3:30/1:30-3:30', '1st Sem'),
(4231, 'GEN 006', 'Ethics', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C2-3', 'Fri', '3:30-5:30', '1st Sem'),
(4232, 'CIE 111', 'Engineering Drawings and Plans', 'BSCE', 1, 0, 2, 0, 0, 'Aguila, Gerald', '', '2CE-C2-3', 'Wed', '1:30-3:30', '1st Sem'),
(4233, 'BES 043', 'Computer Fundamentals and Programming', 'BSCE', 0, 2, 0, 4, 0, 'IT', '', '2CE-C2-3', 'Tue/Thu', '8:00-10:00/8:00-10:00', '1st Sem'),
(4234, 'MAT 052', 'Differential Equations', 'BSCE', 3, 0, 2, 0, 0, 'Faculty 1', '', '2CE-C2-3', 'Tue', '1:30-3:30', '1st Sem'),
(4235, 'BES 025', 'Statics of Rigid Bodies', 'BSCE', 3, 0, 2, 0, 0, 'Dayson, Angelo', '', '2CE-C2-3', 'Wed', '8:00-10:00', '1st Sem'),
(4236, 'PHI 002', 'Logic', 'BSCE', 3, 0, 2, 0, 0, 'CAS', '', '2CE-C2-3', 'Fri', '1:30-3:30', '1st Sem'),
(4237, 'PED 027', 'Physical Activities Towards Health & Fitness', 'BSCE', 2, 0, 1, 0, 0, 'CAS', '', '2CE-C2-3', 'Tue', '11:00-12:00', '1st Sem'),
(4238, 'SSP 005', 'Student Success Program 1', 'BSCE', 1, 0, 1, 0, 0, 'Dayson, Angelo', '', '2CE-C2-3', 'Fri', '10:00-11:00', '1st Sem'),
(4239, 'CHE 025', 'Chemistry for Engineers', 'BSCE', 4, 0, 3, 0, 0, 'CAS', '', '2CE-C2-3', 'Tue/Wed', '3:30-5:30/3:30-5:30', '1st Sem'),
(4240, 'ITE 299', 'Ethics (including Social and professional Issue)', 'BSIT', 3, 0, 2, 0, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-1S', 'TH', '1:30-3:30', '1st Sem'),
(4241, 'SCX010', 'Environmental Science', 'BSIT', 3, 0, 2, 0, 0, 'CAS', '', '2BSIT-C1-1S', 'F', '8:00-10:00', '1st Sem'),
(4242, 'PHI002', 'Logic', 'BSIT', 3, 0, 2, 0, 0, 'CAS', '', '2BSIT-C1-1S', 'W', '10:00-12:00', '1st Sem'),
(4243, 'ITE 048', 'Discrete Structures', 'BSIT', 3, 0, 2, 0, 0, 'PANGILINAN ODEZZA A', '', '2BSIT-C1-1S', 'T', '2:3O-4:30', '1st Sem'),
(4244, 'ITE 031', 'Data Structures and  Algorithms', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN ODEZZA A', '', '2BSIT-C1-1S', 'T', '10:30-12:30/1:30-2:30', '1st Sem'),
(4245, 'ITE 300', 'Object Oriented Programming', 'BSIT', 2, 1, 1, 1, 0, 'COLLADO, SALVADOR P', '', '2BSIT-C1-1S', 'TH', '1:30:3:30/3:30-4:30', '1st Sem'),
(4246, 'ITE 292', 'Networking 1 ', 'BSIT', 2, 1, 1, 2, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-1S', 'T', '7:30-9:30/9:30-10:30', '1st Sem'),
(4247, 'PED 027', 'Physical Activities Towards Health and Fitness', 'BSIT', 2, 0, 1, 0, 0, 'CAS', '', '2BSIT-C1-1S', 'TH', '10:00-11:00', '1st Sem'),
(4248, 'SSP 05', 'Student Success program 1', 'BSIT', 1, 0, 1, 0, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-1S', 'TH', '3:30-4:30', '1st Sem'),
(4249, 'ITE 299', 'Ethics (including Social and professional Issue)', 'BSIT', 3, 0, 2, 0, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-2S', 'W', '1:30-3:30', '1st Sem'),
(4250, 'SCX010', 'Environmental Science', 'BSIT', 3, 0, 2, 0, 0, 'CAS', '', '2BSIT-C1-2S', 'F', '8:00-10:00', '1st Sem'),
(4251, 'PHI002', 'Logic', 'BSIT', 3, 0, 2, 0, 0, 'CAS', '', '2BSIT-C1-2S', 'W', '10:00-12:00', '1st Sem'),
(4252, 'ITE 048', 'Discrete Structures', 'BSIT', 3, 0, 2, 0, 0, 'PANGILINAN ODEZZA A', '', '2BSIT-C1-2S', 'F', '1:30-3:30', '1st Sem'),
(4253, 'ITE 031', 'Data Structures and  Algorithms', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN ODEZZA A', '', '2BSIT-C1-2S', 'T', '7:30-9:30/9:30-10:30', '1st Sem'),
(4254, 'ITE 300', 'Object Oriented Programming', 'BSIT', 2, 1, 1, 1, 0, 'COLLADO, SALVADOR P', '', '2BSIT-C1-2S', 'F', '8:00-10:00/4:30-5:30', '1st Sem'),
(4255, 'ITE 292', 'Networking 1 ', 'BSIT', 2, 1, 1, 2, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-2S', 'T', '1:30:3:30/3:30-4:30', '1st Sem'),
(4256, 'PED 027', 'Physical Activities Towards Health and Fitness', 'BSIT', 2, 0, 1, 0, 0, 'CAS', '', '2BSIT-C1-2S', 'TH', '10:00-11:00', '1st Sem'),
(4257, 'SSP 05', 'Student Success program 1', 'BSIT', 1, 0, 1, 0, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-2S', 'W', '3:30-4:30', '1st Sem'),
(4258, 'ITE 299', 'Ethics (including Social and professional Issue)', 'BSIT', 3, 0, 2, 0, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-3S', 'TH', '10:00-12:00', '1st Sem'),
(4259, 'SCX010', 'Environmental Science', 'BSIT', 3, 0, 2, 0, 0, 'CAS', '', '2BSIT-C1-3S', 'F', '8:00-10:00', '1st Sem'),
(4260, 'PHI002', 'Logic', 'BSIT', 3, 0, 2, 0, 0, 'CAS', '', '2BSIT-C1-3S', 'W', '10:00-12:00', '1st Sem'),
(4261, 'ITE 048', 'Discrete Structures', 'BSIT', 3, 0, 2, 0, 0, 'PANGILINAN, ODEZZA A', '', '2BSIT-C1-3S', 'F', '1:30-3:30', '1st Sem'),
(4262, 'ITE 031', 'Data Structures and  Algorithms', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN, ODEZZA A', '', '2BSIT-C1-3S', 'W', '1:30-3:30/3:30-4:30', '1st Sem'),
(4263, 'ITE 300', 'Object Oriented Programming', 'BSIT', 2, 1, 1, 1, 0, 'COLLADO, SALVADOR  P', '', '2BSIT-C1-3S', 'TH', '8:00-10:00/4:30-5:30', '1st Sem'),
(4264, 'ITE 292', 'Networking 1 ', 'BSIT', 2, 1, 1, 2, 0, 'LEGASPI, JOHN MICHAEL V', '', '2BSIT-C1-3S', 'TH', '1:30-3:30/3:30-4:30', '1st Sem'),
(4265, 'PED 027', 'Physical Activities Towards Health and Fitness', 'BSIT', 2, 0, 1, 0, 0, 'CAS', '', '2BSIT-C1-3S', 'F', '10:00-11:00', '1st Sem'),
(4266, 'ITE 301', 'Application Development and Emerging Technologies', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN, ODEZZA A', '', '3BSIT-C2-1S', 'T', '2:30-4:30/4:30-5:30', '1st Sem'),
(4267, 'ITE 306', 'Integrative Programming and Technologies', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN, ODEZZA A', '', '3BSIT-C2-1S', 'TH', '11:00-12:00/1:30-3:30', '1st Sem'),
(4268, 'ITE 307', 'Quantitative Methods Including Modeling and Simulation', 'BSIT', 2, 1, 2, 0, 0, 'COLLADO, SALVADOR  P', '', '3BSIT-C2-1S', 'F', '8:00-10:00', '1st Sem'),
(4269, 'ITE 308', 'Web System and Technologies', 'BSIT', 2, 1, 1, 2, 0, 'COLLADO, SALVADOR  P', '', '3BSIT-C2-1S', 'T', '10:00-12:00/1:30-2:30', '1st Sem'),
(4270, 'ITE 309', 'Capstone Project and Research 1', 'BSIT', 2, 1, 2, 0, 0, 'JULIANO, EVELYN S', '', '3BSIT-C2-1S', 'F', '10:00-12:00', '1st Sem'),
(4271, 'ITE 314', 'Advance Database Systems', 'BSIT', 2, 1, 2, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '3BSIT-C2-1S', 'TH', '8:00-10:00/10:00-11:00', '1st Sem'),
(4272, 'ITE 233', 'IT Elective 2 (Adv. Web 2)', 'BSIT', 2, 1, 1, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '3BSIT-C2-1S', 'F', '2:30-4:30', '1st Sem'),
(4273, 'SSP 007', 'Student Success Program 3', 'BSIT', 1, 0, 1, 0, 0, 'PANGILINAN, ODEZZA A', '', '3BSIT-C2-1S', 'F', '1:30-2:30', '1st Sem'),
(4274, 'ITE 301', 'Application Development and Emerging Technologies (LEC & LAB)', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN, ODEZZA A', '', '3BSIT-C2-2S', '', '2:30-4:30/4:30-5:30', '1st Sem'),
(4275, 'ITE 306', 'Integrative Programming and Technologies (LEC & LAB)', 'BSIT', 2, 1, 1, 2, 0, 'PANGILINAN, ODEZZA A', '', '3BSIT-C2-2S', 'TH', '11:00-12:00/1:30-3:30', '1st Sem'),
(4276, 'ITE 307', 'Quantitative Methods Including Modeling and Simulation', 'BSIT', 2, 1, 2, 0, 0, 'COLLADO, SALVADOR  P', '', '3BSIT-C2-2S', 'TH', '8:00-10:00', '1st Sem'),
(4277, 'ITE 308', 'Web System and Technologies (LEC & LAB)', 'BSIT', 2, 1, 1, 2, 0, 'COLLADO, SALVADOR  P', '', '3BSIT-C2-2S', 'TH', '10:00-12:00/1:30-2:30', '1st Sem'),
(4278, 'ITE 309', 'Capstone Project and Research 1', 'BSIT', 2, 1, 2, 0, 0, 'JULIANO, EVELYN S', '', '3BSIT-C2-2S', 'TH', '10:00-12:00', '1st Sem'),
(4279, 'ITE 314', 'Advance Database Systems (LEC & LAB)', 'BSIT', 2, 1, 2, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '3BSIT-C2-2S', 'TH', '8:00-10:00/10:00-11:00', '1st Sem'),
(4280, 'ITE 233', 'IT Elective 2 (Adv. Web 2)', 'BSIT', 2, 1, 1, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '3BSIT-C2-2S\n', 'TH', '2:30-3:30/3:30-5:30', '1st Sem'),
(4281, 'SSP 007', 'Student Success Program 3', 'BSIT', 1, 0, 1, 0, 0, 'PANGILINAN, ODEZZA A', '', '3BSIT-C2-2S\n', 'TH', '1:30-2:30', '1st Sem'),
(4282, 'ITE 317', 'Systems Integration and Architecture 2', 'BSIT', 2, 1, 1, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '4BSIT-C1-1', 'T', '8:00-10:00', '1st Sem'),
(4283, 'ITE 322', 'Managing IT Resources', 'BSIT', 2, 1, 1, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '4BSIT-C1-1', 'T', '10:00-12:00', '1st Sem'),
(4284, 'ITE 351', 'New Venture Creation (4 units)', 'BSIT', 2, 2, 2, 1, 0, 'PANGILINAN, ODEZZA A', '', '4BSIT-C1-1', 'T', '3:30-5:30/5:30-6:30', '1st Sem'),
(4285, 'SSP 009', 'Student Success Program 5', 'BSIT', 1, 0, 1, 1, 0, 'JULIANO, EVELYN S', '', '4BSIT-C1-1', 'T', '1:30-3:30', '1st Sem'),
(4286, 'ITE 317', 'Systems Integration and Architecture 2', 'BSIT', 2, 1, 1, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '4BSIT-C1-2', 'T', '3:30-4:50', '1st Sem'),
(4287, 'ITE 322', 'Managing IT Resources', 'BSIT', 2, 1, 1, 1, 0, 'PANGILINAN, ODEZZA A', '', '4BSIT-C1-2', 'T', '3:30-4:51', '1st Sem'),
(4288, 'ITE 351', 'New Venture Creation (4 units)', 'BSIT', 2, 2, 2, 1, 0, 'LEGASPI, JOHN MICHAEL V', '', '4BSIT-C1-2', 'T', '3:30-4:52', '1st Sem'),
(4289, 'SSP 009', 'Student Success Program 5', 'BSIT', 1, 0, 1, 1, 0, 'JULIANO, EVELYN S', '', '4BSIT-C1-2', 'T', '3:30-4:53', '1st Sem');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvedforms`
--
ALTER TABLE `approvedforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `formrequest`
--
ALTER TABLE `formrequest`
  ADD PRIMARY KEY (`formID`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sectionID`);

--
-- Indexes for table `studentsubject`
--
ALTER TABLE `studentsubject`
  ADD PRIMARY KEY (`SSID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvedforms`
--
ALTER TABLE `approvedforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `formrequest`
--
ALTER TABLE `formrequest`
  MODIFY `formID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4306;

--
-- AUTO_INCREMENT for table `studentsubject`
--
ALTER TABLE `studentsubject`
  MODIFY `SSID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=627;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4290;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
