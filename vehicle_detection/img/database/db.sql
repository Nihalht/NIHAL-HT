-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 06:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_breakdown`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'User1', 'user1@gmail.com', 'The interface is easy to use. I had no trouble requesting help when my car broke down. Really user-friendly!❤️❤️', '2024-04-07 17:25:50'),
(9, 'user2', 'user2@gmail.com', 'Impressed with how quickly help arrived after I reported my breakdown. Excellent response time!❤️', '2024-04-15 18:53:02'),
(10, 'User3', 'user3@gmail.com', 'The mechanics knew exactly what they were doing. They diagnosed and fixed my car\'s issue on the spot. Great service!❤️❤️👌', '2024-04-19 20:06:59'),
(11, 'user4', 'user4@gmail.com', 'No surprises with the pricing, which I really appreciated. Everything was transparent, and I knew what to expect.❤️❤️❤️👌👌', '2024-04-23 03:06:26'),
(12, 'user5', 'user5@gmail.com', 'The customer support was top-notch! They kept me informed and made sure I was happy with the service. Overall, a great experience.❤️\r\n', '2024-04-23 03:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE `mechanics` (
  `mechanic_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`mechanic_id`, `username`, `password`, `email`) VALUES
(1, 'mechanic1', '1', 'mechanic1@example.com'),
(3, 'mechanic2', '1', 'mechanic2@gmail.com'),
(4, 'mechanic3', '1', 'mechanic3@gmail.com'),
(5, 'mechanic4', '1', 'mechanic4@gmail.com'),
(6, 'mechanic5', '1', 'mechanic5@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `request_details`
--

CREATE TABLE `request_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vehicle_number` varchar(20) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `mechanic_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_details`
--

INSERT INTO `request_details` (`id`, `name`, `location`, `phone`, `created_at`, `vehicle_number`, `vehicle_type`, `mechanic_name`, `status`) VALUES
(29, 'user1', 'Bangalore', '98451128839', '2024-04-16 12:48:41', 'KA  14 EW 7713', 'Engine failure', 'mechanic1', 'Approved'),
(30, 'user2', 'Bangalore', '8951107072', '2024-04-19 19:53:16', 'KA  14 EW 7713', 'Battery dead', 'mechanic2', 'Approved'),
(31, 'user3', 'Bangalore', '8951107072', '2024-04-19 19:55:28', 'KA  14 EW 7713', 'Battery dead', 'mechanic3', 'Approved'),
(32, 'user4', 'Mangalore', '98451128839', '2024-04-23 03:32:11', 'KA  13 EW 7713', 'Battery dead', 'mechanic4', 'Pending'),
(33, 'user5', 'Bangalore', '98451128839', '2024-04-23 03:32:44', 'KA  14 EW 7713', 'Towing', 'mechanic5', 'Pending'),
(34, 'user6', 'Mangalore', '98451128839', '2024-04-23 03:33:15', 'KA  13 EW 7711', 'Engine failure', 'mechanic5', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone_number`, `name`) VALUES
(1, 'user1', '1', 'user1@gmail.com', '1234567890', 'User1'),
(9, 'user2', '1', 'user2@gmail.com', '8951107072', 'User2'),
(10, 'user3', '1', 'user3@gmail.com', '1234567890', 'User3'),
(13, 'user5', '1', 'user5@gmail.com', '1234567890', 'user5'),
(14, 'user6', '1', 'user6@gmail.com', '1234567890', 'User6'),
(15, 'user7', '1', 'user7@gmail.com', '987654321', 'User7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`mechanic_id`);

--
-- Indexes for table `request_details`
--
ALTER TABLE `request_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request_details`
--
ALTER TABLE `request_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
