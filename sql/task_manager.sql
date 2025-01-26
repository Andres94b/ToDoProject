-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 07:52 PM
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
-- Database: `task_manager`
--
CREATE DATABASE IF NOT EXISTS `task_manager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `task_manager`;

-- --------------------------------------------------------

--
-- Table structure for table `calendar_notes`
--

CREATE TABLE `calendar_notes` (
  `id` int(11) NOT NULL,
  `note_date` date NOT NULL DEFAULT current_timestamp(),
  `note_text` text NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` varchar(200) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `completed_at` timestamp NULL DEFAULT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `task_description`, `due_date`, `status`, `created_at`, `completed_at`, `username`) VALUES
(2, 'Walk the dog', 'Mornings 8am', NULL, 'completed', '2024-10-30 18:47:20', '2024-10-30 18:50:42', 'admin'),
(4, 'Water the plants', 'Before leaving', NULL, 'completed', '2024-10-30 18:57:04', '2024-10-30 18:57:30', 'admin'),
(5, 'Call mom', 'Wish her HBD', NULL, 'completed', '2024-10-30 18:57:27', '2024-10-30 19:07:07', '0'),
(9, 'Present project', 'dont talk', NULL, 'completed', '2024-10-31 12:33:26', '2024-10-31 12:33:42', '0'),
(16, 'Project', 'finish', '2025-01-24', 'completed', '2025-01-23 18:43:36', NULL, 'admin'),
(17, 'Homework', 'Do not forget', '2025-01-24', 'completed', '2025-01-23 18:45:17', '2025-01-23 18:45:20', 'admin'),
(18, 'Prepare dinner', 'make pasta', '2025-01-28', 'pending', '2025-01-23 18:50:23', NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `task_time`
--

CREATE TABLE `task_time` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL,
  `total_time` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `email`, `password`) VALUES
('admin', 'Andres Bonilla', 'andres@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar_notes`
--
ALTER TABLE `calendar_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notes_tasks` (`task_id`),
  ADD KEY `fk_user` (`username`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_time`
--
ALTER TABLE `task_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar_notes`
--
ALTER TABLE `calendar_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_time`
--
ALTER TABLE `task_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendar_notes`
--
ALTER TABLE `calendar_notes`
  ADD CONSTRAINT `fk_notes_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `task_time`
--
ALTER TABLE `task_time`
  ADD CONSTRAINT `task_time_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
