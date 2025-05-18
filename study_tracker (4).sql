-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 05:11 PM
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
-- Database: `study_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `condition_type` varchar(50) NOT NULL,
  `condition_value` int(11) NOT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `name`, `description`, `condition_type`, `condition_value`, `icon`) VALUES
(1, 'Freshly Burnt', 'Complete your first ever study session', 'sessions', 1, '🔥'),
(2, 'Burning Week', 'Achieve a 7-day study streak', 'streak', 7, '🔥🗓️'),
(3, 'Consistent Ember', 'Complete 30 sessions in total', 'sessions', 30, '💪'),
(4, 'Time Keeper', 'Reach 500 minutes of total study time', 'studytime', 500, '🕒'),
(5, 'Focus Master', 'Complete 5 sessions in one day', 'sessions', 5, '🎯'),
(6, 'Flame of Habit', 'Maintain a 14-day streak', 'streak', 14, '🌟'),
(7, 'Marathon Mind', 'Complete a 90-minute single study session', 'studytime', 90, '⏳'),
(8, 'Comeback Spark', 'Break a streak and start a new streak of at least 3 days', 'streak', 3, '🔄'),
(9, 'Study Sprinter', 'Complete 10 sessions in 3 days', 'sessions', 10, '📚'),
(10, 'Inferno Achiever', 'Reach a 30-day streak', 'streak', 30, '🔥🏆'),
(11, 'Sloth Mode', 'Spend more time resting than studying.', 'break_vs_study', 1, '🦥'),
(12, 'Break Connoisseur', 'Complete a total of 10 breaks in a day.', 'break_count_daily', 10, '🍵'),
(13, 'Overrested', 'Reach a 60 minute single break.', 'break_duration', 60, '🛌'),
(14, 'Slow & Steady', 'Reach an average of 15 minutes of break time in a day.', 'average_break_time', 15, '🐢'),
(15, 'Pause Champion', 'Complete a total of 100 breaks.', 'total_breaks', 100, '⏸️'),
(16, 'Eyebrows on Fleek', 'Maintain a 50-day streak', 'streak', 50, '🤨'),
(17, 'Burning Eyebrow', 'Maintain a 100-day streak', 'streak', 100, '🔥🤨');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `date` date DEFAULT curdate(),
  `studyTime` int(11) DEFAULT 0,
  `breakTime` int(11) DEFAULT 0,
  `sessions` int(11) DEFAULT 1,
  `streak` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `username`, `date`, `studyTime`, `breakTime`, `sessions`, `streak`) VALUES
(1, 'hopeya', '2025-05-09', 45, 15, 3, 1),
(2, 'hopeya', '2025-05-10', 60, 20, 4, 1),
(3, 'hopeya', '2025-05-11', 30, 10, 2, 1),
(4, 'hopeya', '2025-05-12', 55, 15, 3, 1),
(5, 'hopeya', '2025-05-13', 40, 20, 2, 1),
(6, 'hopeya', '2025-05-14', 50, 10, 4, 1),
(7, 'hopeya', '2025-05-15', 60, 20, 15, 1),
(8, 'Ayah', '2025-05-09', 30, 25, 2, 1),
(9, 'Ayah', '2025-05-10', 25, 15, 1, 1),
(10, 'Ayah', '2025-05-12', 45, 30, 3, 1),
(11, 'Ayah', '2025-05-14', 35, 20, 2, 1),
(12, 'Ayah', '2025-05-15', 40, 20, 2, 1),
(13, 'Owy', '2025-05-11', 15, 5, 1, 1),
(14, 'Owy', '2025-05-13', 20, 10, 1, 1),
(15, 'Owy', '2025-05-15', 1, 1, 1, 1),
(16, 'Earl', '2025-05-10', 40, 25, 2, 1),
(17, 'Earl', '2025-05-12', 30, 15, 1, 1),
(18, 'Earl', '2025-05-14', 45, 30, 3, 1),
(19, 'Earl', '2025-05-15', 35, 20, 2, 1),
(20, 'StudyMaster', '2025-05-09', 120, 30, 6, 1),
(21, 'StudyMaster', '2025-05-10', 90, 20, 5, 1),
(22, 'StudyMaster', '2025-05-11', 105, 25, 6, 1),
(23, 'StudyMaster', '2025-05-12', 75, 15, 4, 1),
(24, 'StudyMaster', '2025-05-13', 60, 10, 3, 1),
(25, 'StudyMaster', '2025-05-14', 80, 20, 4, 1),
(26, 'StudyMaster', '2025-05-15', 95, 25, 5, 1),
(27, 'Bookworm', '2025-05-09', 30, 5, 1, 1),
(28, 'Bookworm', '2025-05-11', 45, 10, 2, 1),
(29, 'Bookworm', '2025-05-13', 50, 15, 3, 1),
(30, 'Bookworm', '2025-05-15', 40, 10, 2, 1),
(31, 'NightOwl', '2025-05-10', 180, 45, 8, 1),
(32, 'NightOwl', '2025-05-12', 150, 30, 7, 1),
(33, 'NightOwl', '2025-05-14', 120, 20, 5, 1),
(34, 'EarlyBird', '2025-05-09', 60, 10, 3, 1),
(35, 'EarlyBird', '2025-05-10', 45, 5, 2, 1),
(36, 'EarlyBird', '2025-05-11', 50, 10, 3, 1),
(37, 'EarlyBird', '2025-05-12', 55, 15, 3, 1),
(38, 'EarlyBird', '2025-05-13', 40, 5, 2, 1),
(39, 'EarlyBird', '2025-05-14', 60, 10, 3, 1),
(40, 'EarlyBird', '2025-05-15', 45, 5, 2, 1),
(41, 'CasualLearner', '2025-05-10', 20, 10, 1, 1),
(42, 'CasualLearner', '2025-05-12', 15, 5, 1, 1),
(43, 'CasualLearner', '2025-05-14', 25, 10, 1, 1),
(44, 'ExamCrammer', '2025-05-13', 240, 60, 10, 1),
(45, 'ExamCrammer', '2025-05-14', 210, 45, 8, 1),
(46, 'ExamCrammer', '2025-05-15', 180, 30, 6, 1),
(47, 'Test User', '2025-05-15', 1, 1, 1, 1),
(48, 'hopeya', '2025-05-16', 3, 3, 3, 1),
(49, 'Test User 1', '2025-05-16', 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `totals`
--

CREATE TABLE `totals` (
  `username` varchar(100) NOT NULL,
  `totalStudyTime` int(11) DEFAULT 0,
  `totalBreakTime` int(11) DEFAULT 0,
  `totalSessions` int(11) DEFAULT 0,
  `maxStreak` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `totals`
--

INSERT INTO `totals` (`username`, `totalStudyTime`, `totalBreakTime`, `totalSessions`, `maxStreak`) VALUES
('sweetenearl', 6, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'sweetenearl', '$2y$10$JU27May0GD7QxHTbNqW64uz4m9AmbjkVqUWjo8DSA.dr2V1iMNtQe'),
(2, 'owyowy', '$2y$10$BMBqDWxVwZE6G2myBtvE8eVPoL349dLWtyUG2cad2pEl8xJiaGvQ6'),
(3, 'hopeya', '$2y$10$PiaYRU9QAUrxb1lAY0tn8uE3akVFklPcf3xGNnN7dgAIs7ck55mh2'),
(4, 'Ayah', '$2y$10$XwGTJekTh30I8KBxVcO9SOcTtZclTlfcWycJ0Vd4hRHxfLFzvoTAW'),
(5, 'Test User', '$2y$10$Q3rtohYgXAqlJGBt1coH9eh.sb5QIYG50aUY01V6PjaJZ55eF945.'),
(6, 'Test User 1', '$2y$10$Ymztq7.lMfQos0shKnt2Su4wFIW/2fIoU3sisSgT4NZb7Uc2qiu46');

-- --------------------------------------------------------

--
-- Table structure for table `user_achievements`
--

CREATE TABLE `user_achievements` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `achievement_id` int(11) NOT NULL,
  `unlocked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_achievements`
--

INSERT INTO `user_achievements` (`id`, `username`, `achievement_id`, `unlocked_at`) VALUES
(1, 'hopeya', 1, '2025-05-15 16:23:42'),
(2, 'hopeya', 2, '2025-05-15 16:23:42'),
(3, 'hopeya', 5, '2025-05-15 16:23:42'),
(4, 'hopeya', 8, '2025-05-15 16:23:42'),
(5, 'hopeya', 9, '2025-05-15 16:23:42'),
(6, 'hopeya', 7, '2025-05-15 16:42:29'),
(7, 'Ayah', 1, '2025-05-15 17:46:37'),
(8, 'Ayah', 5, '2025-05-15 17:46:37'),
(9, 'Ayah', 7, '2025-05-15 17:46:37'),
(10, 'Ayah', 8, '2025-05-15 17:46:37'),
(11, 'Ayah', 9, '2025-05-15 17:46:37'),
(12, 'hopeya', 3, '2025-05-15 22:28:14'),
(13, 'Test User', 1, '2025-05-15 22:36:13'),
(14, 'Test User 1', 1, '2025-05-16 00:29:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `totals`
--
ALTER TABLE `totals`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achievement_id` (`achievement_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_achievements`
--
ALTER TABLE `user_achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_achievements`
--
ALTER TABLE `user_achievements`
  ADD CONSTRAINT `user_achievements_ibfk_1` FOREIGN KEY (`achievement_id`) REFERENCES `achievements` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
