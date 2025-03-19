-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 07:10 AM
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
-- Database: `gt4speedteam`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(5) NOT NULL,
  `model` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `chassis` int(100) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `model`, `manufacturer`, `engine`, `chassis`, `year`, `team_id`) VALUES
(22001, 'Supra', 'Toyota', '2JZ-GTE', 123456, '2022', 1),
(24001, 'GT-R', 'Nissan', 'VR38DETT', 234567, '2024', 1),
(90001, 'AE86', 'Toyota', '4A-GE', 12343555, '1990', 2),
(92001, 'AE86', 'Toyota', '4A-GE101', 19986, '1992', 2);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `join_year` date NOT NULL,
  `experience_years` tinyint(3) UNSIGNED DEFAULT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `name`, `nationality`, `join_year`, `experience_years`, `team_id`) VALUES
(20001, 'Takumi Fujiwara', 'Japan', '2020-04-01', 8, 1),
(25001, 'Alex Thunder', 'Thailand', '2025-03-06', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `race_id` int(11) NOT NULL,
  `race_name` varchar(50) NOT NULL,
  `circuit` varchar(50) NOT NULL,
  `race_date` date NOT NULL,
  `lap_count` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`race_id`, `race_name`, `circuit`, `race_date`, `lap_count`) VALUES
(1001, 'Toge Racing', 'Akina', '2001-01-18', 3),
(23002, 'Thai GP1', 'Chang Arena1', '2023-01-21', 45),
(99001, 'Kmu', 'Kmutnb', '1999-12-30', 5);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `result_id` int(11) NOT NULL,
  `race_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `position` tinyint(3) UNSIGNED NOT NULL,
  `best_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`result_id`, `race_id`, `driver_id`, `car_id`, `position`, `best_time`) VALUES
(5, 1001, 20001, 92001, 4, '04:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(5) NOT NULL,
  `team_name` text NOT NULL,
  `country` varchar(50) NOT NULL,
  `founded_year` year(4) NOT NULL,
  `team_principal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `country`, `founded_year`, `team_principal`) VALUES
(1, 'Thunder Racing', 'Thailandda', '2020', 'John Speed'),
(2, 'Initial D', 'English', '2023', 'Lucky');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`race_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `race_id` (`race_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `races` (`race_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`driver_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
