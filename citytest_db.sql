-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2019 at 05:26 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citytest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `username`, `dob`, `created_at`, `updated_at`) VALUES
(1, 'Mark Henry', 'mark@xachievers.com', 'mark', '2000-06-18', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(2, 'John Cena', 'john@xachievers.com', 'john', '1988-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(3, 'Brock Lesnar', 'brock@xachievers.com', 'brock', '1988-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(4, 'Jeff Hardey', 'jeff@xachievers.com', 'jeff', '2000-06-18', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(5, 'Rey Mysterio', 'rey@xachievers.com', 'rey', '1989-10-21', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(6, 'The Undertaker', 'undertaker@xachievers.com', 'under', '1985-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(7, 'Goldeberg', 'gold@xachievers.com', 'gold', '1988-11-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(8, 'HHH', 'hhh@xachievers.com', 'hhh', '1988-02-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(9, 'Randy Orton', 'randy@xachievers.com', 'randy', '1988-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(10, 'The Rock', 'rock@xachievers.com', 'rock', '1988-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(11, 'Jinder Mahal', 'jinder@xachievers.com', 'jinder', '1988-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(12, 'Stone Cold', 'stone@xachievers.com', 'stone', '1982-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10'),
(13, 'The Khali', 'khali@xachievers.com', 'khali', '1988-10-23', '2019-10-05 10:34:10', '2019-10-05 10:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Sunny', 'Sharma', 'sunny91189@gmail.com', 'sunny91189', '827ccb0eea8a706c4c34a16891f84e7b', '2019-10-05 08:07:16', '2019-10-05 10:06:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `username` (`username`),
  ADD KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
