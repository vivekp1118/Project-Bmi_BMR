-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2022 at 06:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmi`
--

CREATE TABLE `bmi` (
  `id` varchar(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `age` int(10) NOT NULL,
  `weight` int(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `gender` char(10) NOT NULL,
  `bmi` int(10) NOT NULL,
  `bmr` int(10) NOT NULL,
  `upper_weight` int(10) NOT NULL,
  `lower_weight` int(10) NOT NULL,
  `bmi_range` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bmi`
--

INSERT INTO `bmi` (`id`, `name`, `age`, `weight`, `height`, `gender`, `bmi`, `bmr`, `upper_weight`, `lower_weight`, `bmi_range`) VALUES
('6308f144543fb', 'vivek', 21, 64, '178', 'Male', 20, 1652, 79, 58, 'Normal (healthy weight)'),
('630a148cf09d1', 'vivek', 21, 200, '178', 'Male', 63, 3012, 79, 58, 'class III obese'),
('630a14d3a524e', 'vivek', 21, 200, '178', 'Male', 63, 3012, 79, 58, 'class III obese'),
('630a14f75fe7a', 'vivek', 21, 200, '178', 'Male', 63, 3012, 79, 58, 'class III obese'),
('630a16b6488cb', 'vivek', 18, 41, '178', 'Male', 13, 1437, 79, 58, 'Underweight'),
('630a2576e5911', 'vivek', 18, 200, '178', 'Male', 63, 3027, 79, 58, 'class III obese'),
('630a2e0e1b150', 'Nitesh', 19, 65, '175', 'Male', 21, 1653, 76, 56, 'Normal (healthy weight)'),
('630a3dc0b74e9', 'vivek prajapati', 18, 64, '178', 'Male', 20, 1667, 79, 58, 'Normal (healthy weight)'),
('630a451f3b76b', 'kailash', 21, 64, '178', 'Male', 20, 1652, 79, 58, 'Normal (healthy weight)'),
('630a48699338d', 'kailash', 21, 64, '178', 'Male', 20, 1652, 79, 58, 'Normal (healthy weight)'),
('630cdb2489023', 'vivek prajapati', 18, 64, '178', 'Male', 20, 1667, 79, 58, 'Normal (healthy weight)'),
('630cdb9a14254', 'kailash', 18, 200, '178', '', 63, 2861, 79, 58, 'class III obese'),
('630cdc14746d2', 'kailash', 18, 200, '178', 'Male', 63, 3027, 79, 58, 'class III obese'),
('6313467320939', 'Test1', 21, 200, '134', 'Male', 111, 2737, 44, 33, 'class III obese'),
('63134f636d30e', 'test2', 18, 70, '178', 'Male', 22, 1727, 79, 58, 'Normal (healthy weight)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmi`
--
ALTER TABLE `bmi`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
