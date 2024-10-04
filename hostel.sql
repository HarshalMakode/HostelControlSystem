-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2024 at 07:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `message` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `email`, `password`) VALUES
(1, 'Harshal', 'harshalmakode26@gmail.com', 'harshal123');

-- --------------------------------------------------------

--
-- Table structure for table `finalstudent`
--

CREATE TABLE `finalstudent` (
  `id` int(11) NOT NULL,
  `passport` varchar(400) DEFAULT NULL,
  `sign` varchar(400) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `disability` varchar(25) DEFAULT NULL,
  `caste` varchar(45) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `marksheet` varchar(400) DEFAULT NULL,
  `branch` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `mess` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `logindate` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finalstudent`
--

INSERT INTO `finalstudent` (`id`, `passport`, `sign`, `fullname`, `phone`, `dob`, `gender`, `disability`, `caste`, `percent`, `marksheet`, `branch`, `year`, `address`, `email`, `password`, `status`, `mess`, `amount`, `logindate`) VALUES
(23, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Tanmay Dafe', '9764172783', '2004-10-17', 'male', 'No', 'Other', 95, 'Marksheet/5result.pdf', 'CE', '1st', 'Gandhi Chowk, Arvi', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(24, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Samiksha Bansod', '9764172782', '2004-10-17', 'female', 'No', 'Other', 94, 'Marksheet/5result.pdf', 'CE', '1st', 'Gandhi Chowk, Dhamngaon', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(25, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Riddhi Darne', '9764172781', '2004-10-17', 'female', 'No', 'VJNT', 93, 'Marksheet/5result.pdf', 'CE', '1st', 'Sai Nagar, Wardha', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(26, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Ishawari Mahale', '9764172780', '2004-10-17', 'female', 'No', 'NT', 92, 'Marksheet/5result.pdf', 'CE', '1st', 'Sai Nagar, Wardha', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(27, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Munna Tople', '9764172779', '2004-10-17', 'male', 'No', 'ST', 91, 'Marksheet/5result.pdf', 'ET', '1st', 'Wari Nagar, Karanja', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(28, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Kushal Hajare', '9764172778', '2004-10-17', 'male', 'No', 'SC', 90, 'Marksheet/5result.pdf', 'ET', '1st', 'Wari Nagar, Karanja', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(29, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Harshal Makode', '9764172769', '2004-10-09', 'male', 'No', 'Genral', 89, 'Marksheet/5result.pdf', 'CO', '3rd', 'Panchali Nagar, Borda', 'harshalmakode26@gmail.com', 'harshal123', '0', 'yes', '4500', ''),
(30, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Suraj Pathade', '9764172777', '2004-10-17', 'male', 'No', 'EWS', 89, 'Marksheet/5result.pdf', 'ET', '1st', 'Wari Nagar, Karanja', 'harshalmakode34@gmail.com', 'harshal131', '0', 'yes', '4500', ''),
(31, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Sanket Nasare', '9764172776', '2004-10-16', 'male', 'No', 'EWS', 88, 'Marksheet/5result.pdf', 'CH', '2nd', 'Chopan, Walona', 'harshalmakode33@gmail.com', 'harshal130', '0', 'yes', '4500', ''),
(32, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Shivam Kurhadkar', '9764172775', '2004-10-15', 'male', 'No', 'OBC', 87, 'Marksheet/5result.pdf', 'CH', '2nd', 'Gandhi Chowk, Dhamngaon', 'harshalmakode32@gmail.com', 'harshal129', '0', 'yes', '4500', ''),
(33, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Harshada Kalkar', '9764172774', '2004-10-14', 'female', 'No', 'OBC', 86, 'Marksheet/5result.pdf', 'CH', '2nd', 'Ashok Nagar, Wardha', 'harshalmakode31@gmail.com', 'harshal128', '0', 'yes', '4500', ''),
(34, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Samir Mule', '9764172773', '2004-10-13', 'male', 'No', 'OBC', 85, 'Marksheet/5result.pdf', 'CH', '2nd', 'Sai Nagar, Wardha', 'harshalmakode30@gmail.com', 'harshal127', '0', 'yes', '4500', ''),
(35, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Rajat Dautkhani', '9764172772', '2004-10-12', 'male', 'No', 'Genral', 84, 'Marksheet/5result.pdf', 'CO', '3rd', 'Sai Nagar, Wardha', 'harshalmakode29@gmail.com', 'harshal126', '0', 'yes', '4500', ''),
(37, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Priyanshu Wagh', '9764172770', '2004-10-10', 'male', 'No', 'Genral', 82, 'Marksheet/5result.pdf', 'CO', '3rd', 'Ram Mandir, Satargaon', 'harshalmakode27@gmail.com', 'harshal124', 'yes', 'yes', '4500', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `filename` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `filename`) VALUES
(4, 'image6.jpg'),
(5, 'image7.jpg'),
(6, 'image5.jpg'),
(7, 'image4.jpg'),
(8, 'image2.jpg'),
(9, 'image3.jpg'),
(10, 'image1.jpg'),
(11, 'gparvilogo.jpg'),
(13, 'qr-code (2).png');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pdf_file` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `pdf_file`) VALUES
(17, 'News 1', 'If you register before and after the deadline will not be considered.\r\ndeadline :- 03/08/2024 to 10/08/2024', 'uploads/Android.pdf'),
(21, 'News 2', 'Helo', 'uploads/NIS Microproject sanket.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `passport` varchar(400) DEFAULT NULL,
  `sign` varchar(400) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `disability` varchar(25) DEFAULT NULL,
  `caste` varchar(45) DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `marksheet` varchar(400) DEFAULT NULL,
  `branch` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `mess` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `logindate` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `passport`, `sign`, `fullname`, `phone`, `dob`, `gender`, `disability`, `caste`, `percent`, `marksheet`, `branch`, `year`, `address`, `email`, `password`, `status`, `mess`, `amount`, `logindate`) VALUES
(144, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Harshal Makode', '9764172769', '2004-10-09', 'male', 'No', 'Genral', 89, 'Marksheet/5result.pdf', 'CO', '3rd', 'Panchali Nagar, Borda', 'harshalmakode26@gmail.com', 'harshal123', 0, 'yes', '4500', NULL),
(145, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Priyanshu Wagh', '9764172770', '2004-10-10', 'male', 'No', 'Genral', 82, 'Marksheet/5result.pdf', 'CO', '3rd', 'Ram Mandir, Satargaon', 'harshalmakode27@gmail.com', 'harshal124', 0, 'yes', '18000', '2024-04-05 12:10:25'),
(146, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Hiamsnhu Wagh', '9764172771', '2004-10-11', 'male', 'No', 'Genral', 83, 'Marksheet/5result.pdf', 'CO', '3rd', 'Ram Mandir, Satargaon', 'harshalmakode28@gmail.com', 'harshal125', 0, 'yes', '4500', NULL),
(147, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Rajat Dautkhani', '9764172772', '2004-10-12', 'male', 'No', 'Genral', 84, 'Marksheet/5result.pdf', 'CO', '3rd', 'Sai Nagar, Wardha', 'harshalmakode29@gmail.com', 'harshal126', 0, 'yes', '4500', NULL),
(148, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Samir Mule', '9764172773', '2004-10-13', 'male', 'No', 'OBC', 85, 'Marksheet/5result.pdf', 'CH', '2nd', 'Sai Nagar, Wardha', 'harshalmakode30@gmail.com', 'harshal127', 0, 'yes', '4500', NULL),
(149, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Harshada Kalkar', '9764172774', '2004-10-14', 'female', 'No', 'OBC', 86, 'Marksheet/5result.pdf', 'CH', '2nd', 'Ashok Nagar, Wardha', 'harshalmakode31@gmail.com', 'harshal128', 0, 'yes', '4500', NULL),
(150, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Shivam Kurhadkar', '9764172775', '2004-10-15', 'male', 'No', 'OBC', 87, 'Marksheet/5result.pdf', 'CH', '2nd', 'Gandhi Chowk, Dhamngaon', 'harshalmakode32@gmail.com', 'harshal129', 0, 'yes', '4500', NULL),
(151, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Sanket Nasare', '9764172776', '2004-10-16', 'male', 'No', 'EWS', 88, 'Marksheet/5result.pdf', 'CH', '2nd', 'Chopan, Walona', 'harshalmakode33@gmail.com', 'harshal130', 0, 'yes', '4500', NULL),
(152, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Suraj Pathade', '9764172777', '2004-10-17', 'male', 'No', 'EWS', 89, 'Marksheet/5result.pdf', 'ET', '1st', 'Wari Nagar, Karanja', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL),
(153, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Kushal Hajare', '9764172778', '2004-10-17', 'male', 'No', 'SC', 90, 'Marksheet/5result.pdf', 'ET', '1st', 'Wari Nagar, Karanja', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL),
(154, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Munna Tople', '9764172779', '2004-10-17', 'male', 'No', 'ST', 91, 'Marksheet/5result.pdf', 'ET', '1st', 'Wari Nagar, Karanja', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL),
(155, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Ishawari Mahale', '9764172780', '2004-10-17', 'female', 'No', 'NT', 92, 'Marksheet/5result.pdf', 'CE', '1st', 'Sai Nagar, Wardha', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL),
(156, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Riddhi Darne', '9764172781', '2004-10-17', 'female', 'No', 'VJNT', 93, 'Marksheet/5result.pdf', 'CE', '1st', 'Sai Nagar, Wardha', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL),
(157, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Samiksha Bansod', '9764172782', '2004-10-17', 'female', 'No', 'Other', 94, 'Marksheet/5result.pdf', 'CE', '1st', 'Gandhi Chowk, Dhamngaon', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL),
(158, 'Image/gparvilogo.jpg', 'Signature/gparvilogo.jpg', 'Tanmay Dafe', '9764172783', '2004-10-17', 'male', 'No', 'Other', 95, 'Marksheet/5result.pdf', 'CE', '1st', 'Gandhi Chowk, Arvi', 'harshalmakode34@gmail.com', 'harshal131', 0, 'yes', '4500', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `reply` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `student_id`, `message`, `reply`) VALUES
(23, 145, 'hello help me', 'ok beta'),
(24, 145, 'hi', 'hi'),
(25, 145, 'heoll', 'hi'),
(26, 145, 'ho', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `finalstudent`
--
ALTER TABLE `finalstudent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `finalstudent`
--
ALTER TABLE `finalstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
