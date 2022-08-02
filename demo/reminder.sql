-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2019 at 09:47 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reminder`
--

-- --------------------------------------------------------

--
-- Table structure for table `forward_rem`
--

CREATE TABLE `forward_rem` (
  `rm_id` int(11) NOT NULL,
  `rem_id` int(11) NOT NULL,
  `froward_by` int(11) NOT NULL,
  `forward_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forward_rem`
--

INSERT INTO `forward_rem` (`rm_id`, `rem_id`, `froward_by`, `forward_at`) VALUES
(1, 2, 3, '2019-04-24 03:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `forward_user`
--

CREATE TABLE `forward_user` (
  `rm_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forward_user`
--

INSERT INTO `forward_user` (`rm_id`, `userid`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forward_rem`
--
ALTER TABLE `forward_rem`
  ADD PRIMARY KEY (`rm_id`);

--
-- Indexes for table `forward_user`
--
ALTER TABLE `forward_user`
  ADD PRIMARY KEY (`rm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forward_rem`
--
ALTER TABLE `forward_rem`
  MODIFY `rm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forward_user`
--
ALTER TABLE `forward_user`
  MODIFY `rm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
