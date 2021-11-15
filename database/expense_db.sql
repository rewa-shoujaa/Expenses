-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 07:48 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_tbl`
--

CREATE TABLE `categories_tbl` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(250) NOT NULL,
  `user_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories_tbl`
--

INSERT INTO `categories_tbl` (`cat_id`, `cat_name`, `user_id`) VALUES
(1, 'Supermarket', '61434d49264db'),
(2, 'Rent', '61434d49264db'),
(3, 'Gas', '61434d49264db');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_tbl`
--

CREATE TABLE `expenses_tbl` (
  `expense_id` int(11) NOT NULL,
  `expense_amount` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses_tbl`
--

INSERT INTO `expenses_tbl` (`expense_id`, `expense_amount`, `expense_date`, `user_id`, `category_id`) VALUES
(1, 100, '2021-09-09', '61434b9654b3f', 1),
(2, 250, '2021-09-03', '61434d49264db', 3),
(3, 30, '2021-09-10', '61434d49264db', 2),
(4, 33, '2021-09-03', '61434d49264db', 1),
(5, 33, '2021-09-03', '61434d49264db', 1),
(6, 33, '2021-09-03', '61434d49264db', 1),
(7, 123, '2021-09-15', '61434d49264db', 2),
(8, 123, '2021-09-15', '61434d49264db', 2),
(9, 444, '2021-09-09', '61434d49264db', 2),
(10, 444, '2021-09-09', '61434d49264db', 3),
(11, 444, '2021-09-09', '61434d49264db', 3),
(12, 111, '2021-09-01', '61434d49264db', 1),
(13, 190, '2021-09-11', '61434d49264db', 2),
(14, 1000, '2021-09-01', '61434d49264db', 1),
(15, 5555, '2021-09-08', '61434d49264db', 2),
(16, 198, '2021-09-16', '61434d49264db', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `user_id` varchar(100) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
('61434b9654b3f', 'Rewa Shoujaa', 'rewa.shoujaa@hotmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'),
('61434d49264db', 'Rewa Dichari', 'rewa.shoujaa@gmail.com', '119b564ebb7dd593c3e4f6ed1f4f9c2b7ff88f2af9f317d18aa3ebd57c7d2e13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `expenses_tbl`
--
ALTER TABLE `expenses_tbl`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses_tbl`
--
ALTER TABLE `expenses_tbl`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
