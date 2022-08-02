-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 02:33 PM
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
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_request`
--

CREATE TABLE `contact_request` (
  `req_id` int(11) NOT NULL,
  `request_by` int(11) NOT NULL,
  `request_to` int(11) NOT NULL,
  `request_sent` int(1) NOT NULL,
  `request_approve` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_request`
--

INSERT INTO `contact_request` (`req_id`, `request_by`, `request_to`, `request_sent`, `request_approve`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 3, 2, 1, 0, '2019-04-17 12:56:03', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `group_contact`
--

CREATE TABLE `group_contact` (
  `gcid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_contact`
--

INSERT INTO `group_contact` (`gcid`, `gid`, `userid`) VALUES
(7, 2, 2),
(8, 2, 3),
(9, 3, 13),
(10, 2, 13),
(11, 4, 3),
(12, 4, 2),
(13, 4, 9),
(14, 4, 8),
(15, 5, 13),
(16, 6, 13),
(19, 1, 3),
(20, 1, 12),
(21, 1, 11),
(22, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `group_table`
--

CREATE TABLE `group_table` (
  `gid` int(11) NOT NULL,
  `gname` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_table`
--

INSERT INTO `group_table` (`gid`, `gname`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 'adminas', 1, '2019-04-15 11:47:17', 0, '0000-00-00 00:00:00'),
(2, 'IT', 1, '2019-01-03 08:59:56', 0, '0000-00-00 00:00:00'),
(3, 'demo', 3, '2019-01-11 13:00:53', 0, '0000-00-00 00:00:00'),
(4, 'IT', 13, '2019-01-14 10:01:35', 0, '0000-00-00 00:00:00'),
(6, 'dsv', 2, '2019-01-15 11:58:48', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(80) NOT NULL,
  `device_type` varchar(100) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `my_note`
--

CREATE TABLE `my_note` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `des` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `nid` int(11) NOT NULL,
  `rem_id` int(11) NOT NULL,
  `not_time` datetime NOT NULL,
  `action` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`nid`, `rem_id`, `not_time`, `action`) VALUES
(15, 1, '2019-04-30 05:15:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rid` int(11) NOT NULL,
  `rem_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `rem_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL,
  `rem_req` int(2) NOT NULL,
  `start_date` datetime NOT NULL,
  `period` int(5) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `Status` varchar(50) NOT NULL,
  `activity` varchar(5) NOT NULL,
  `created_by` int(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(2) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`rem_id`, `type`, `title`, `description`, `location`, `rem_req`, `start_date`, `period`, `priority`, `from_date`, `to_date`, `Status`, `activity`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(1, 'Public', 'demo1', 'demo1 super super super revised RRR', 'demo1', 1, '2019-04-29 05:15:00', 24, 'Low', '2019-04-30 05:15:00', '2019-04-30 05:15:00', 'Pending', 'A', 1, '0000-00-00 00:00:00', 1, '2019-04-17 02:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `reminder_participants`
--

CREATE TABLE `reminder_participants` (
  `id` int(11) NOT NULL,
  `rem_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder_participants`
--

INSERT INTO `reminder_participants` (`id`, `rem_id`, `userid`, `status`, `comment`, `created_at`) VALUES
(16, 1, 3, 0, '', '2019-04-17 12:36:02'),
(17, 1, 13, 0, '', '2019-04-17 12:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `reminder_task`
--

CREATE TABLE `reminder_task` (
  `id` int(11) NOT NULL,
  `rem_id` int(11) NOT NULL,
  `task` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder_task`
--

INSERT INTO `reminder_task` (`id`, `rem_id`, `task`) VALUES
(1, 1, 'csac');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(5) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  `user_varified` varchar(5) NOT NULL DEFAULT 'No',
  `otp` int(11) NOT NULL,
  `otp_varified` int(11) NOT NULL,
  `utype` char(1) NOT NULL COMMENT 'A-admin U-user',
  `usts` char(1) NOT NULL COMMENT 'A-active D-deactive',
  `ufname` varchar(50) NOT NULL,
  `ulname` varchar(50) NOT NULL,
  `ucontact` varchar(10) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `udob` date NOT NULL,
  `ugender` varchar(20) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `Anniversary` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `profile_pic` varchar(30) NOT NULL,
  `uexecute` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uadd` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `udelete` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uview` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `crby` int(5) NOT NULL COMMENT 'User',
  `crdate` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `upwd`, `user_varified`, `otp`, `otp_varified`, `utype`, `usts`, `ufname`, `ulname`, `ucontact`, `uemail`, `udob`, `ugender`, `marital_status`, `Anniversary`, `address`, `profile_pic`, `uexecute`, `uadd`, `udelete`, `uview`, `crby`, `crdate`, `modified_by`, `modified_at`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'Yes', 97203, 1, 'A', 'A', 'admin', '', '8839826466', 'admin@gmail.com', '0000-00-00', 'Male', 'Unmarried', '0000-00-00', '', 'profile_pics/1.png', 'Y', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'e10adc3949ba59abbe56e057f20f883e', 'Yes', 17980, 1, 'U', 'A', 'Ajay', 'Kumar', '9754808238', 'dewangan.ajay7@gmail.com', '1999-12-31', 'Male', 'Married', '2012-04-30', 'Kumhari', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, '0cb1eb413b8f7cee17701a37a1d74dc3', 'Yes', 74957, 1, 'U', 'A', 'amit', 'chandrakar', '8839826466', 'amitchandrakar028@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'a84d77adca68a28b243d80f5018291b7', 'Yes', 70619, 1, 'U', 'A', 'fagun', 'jaiswal', '7000390267', 'fagunjaiswal0802@gmail.com', '1994-02-08', 'Female', 'Unmarried', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'e47794428b2ad61c3a37b975c298377d', 'Yes', 26983, 1, 'U', 'A', 'Rohini', 'Narasaiya', '9525018823', 'd.rohini@vnrseeds.com', '1969-08-21', 'Female', 'Married', '1992-06-21', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, '5d560ea997068115892d2f0bd7cf91c3', 'Yes', 39310, 1, 'U', 'A', 'Aruna', 'Jaiswal', '9589809114', 'arunajaiswal515@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, '1bd1b83e2a1415fced60c56295583a06', 'Yes', 71202, 1, 'U', 'A', 'Randip', 'Ghosh', '8819090075', 'randip.ghosh@vnrnursery.in', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, '9b0c6802e2a453c0c5918ec6c270bc0c', 'Yes', 27966, 1, 'U', 'A', 'Harendra ', 'Kumar', '9329040330', 'gautam.sharma@vnrseeds.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'bdd6ce3ea03cf55c894cc02808c91f60', 'Yes', 12788, 1, 'U', 'A', 'Bala', 'krishna', '8109877958', 'balakrishna8524@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, '79e769f847b0771cb0537a2dbd71f007', 'Yes', 37114, 1, 'U', '', 'Rahul', 'Palotra', '7697711518', 'rahulpalotra.vspl@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, '9ce5bf51f40edd95f7f4dbfcce918ad7', 'No', 63408, 1, 'U', '', 'Parul', 'P', '9300125137', 'parul.parmar@vnrseeds.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_old`
--

CREATE TABLE `user_old` (
  `userid` int(5) NOT NULL,
  `upwd` varchar(20) NOT NULL,
  `user_varified` varchar(5) NOT NULL DEFAULT 'No',
  `otp` int(11) NOT NULL,
  `otp_varified` int(11) NOT NULL,
  `utype` char(1) NOT NULL COMMENT 'A-admin U-user',
  `usts` char(1) NOT NULL COMMENT 'A-active D-deactive',
  `ufname` varchar(50) NOT NULL,
  `ulname` varchar(50) NOT NULL,
  `ucontact` varchar(10) NOT NULL,
  `uemail` varchar(50) NOT NULL,
  `udob` date NOT NULL,
  `ugender` varchar(20) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `Anniversary` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `profile_pic` varchar(30) NOT NULL,
  `uexecute` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uadd` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `udelete` char(1) NOT NULL DEFAULT 'N' COMMENT 'Y-yes N-No',
  `uview` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y-yes N-No',
  `crby` int(5) NOT NULL COMMENT 'User',
  `crdate` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_old`
--

INSERT INTO `user_old` (`userid`, `upwd`, `user_varified`, `otp`, `otp_varified`, `utype`, `usts`, `ufname`, `ulname`, `ucontact`, `uemail`, `udob`, `ugender`, `marital_status`, `Anniversary`, `address`, `profile_pic`, `uexecute`, `uadd`, `udelete`, `uview`, `crby`, `crdate`, `modified_by`, `modified_at`) VALUES
(1, 'admin', 'Yes', 97203, 1, 'A', 'A', 'admin', '', '', 'admin@gmail.com', '0000-00-00', 'Male', 'Unmarried', '0000-00-00', '', 'profile_pics/1.png', 'Y', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, '123456', 'Yes', 17980, 1, 'U', 'A', 'Ajay', 'Kumar', '9754808238', 'dewangan.ajay7@gmail.com', '1999-12-31', 'Male', 'Married', '2012-04-30', 'Kumhari', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'password', 'Yes', 55028, 1, 'U', 'A', 'amit', 'chandrakar', '8839826466', 'amitchandrakar028@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'fagun1602', 'Yes', 70619, 1, 'U', 'A', 'fagun', 'jaiswal', '7000390267', 'fagunjaiswal0802@gmail.com', '1994-02-08', 'Female', 'Unmarried', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'diksha@95', 'Yes', 26983, 1, 'U', 'A', 'Rohini', 'Narasaiya', '9525018823', 'd.rohini@vnrseeds.com', '1969-08-21', 'Female', 'Married', '1992-06-21', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, '70593', 'Yes', 39310, 1, 'U', 'A', 'Aruna', 'Jaiswal', '9589809114', 'arunajaiswal515@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, 'KILLIKULAM', 'Yes', 71202, 1, 'U', 'A', 'Randip', 'Ghosh', '8819090075', 'randip.ghosh@vnrnursery.in', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'paddy#2355', 'Yes', 27966, 1, 'U', 'A', 'Harendra ', 'Kumar', '9329040330', 'gautam.sharma@vnrseeds.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, 'bala', 'Yes', 75081, 1, 'U', 'A', 'Bala', 'krishna', '8109877958', 'balakrishna8524@gmail.com', '0000-00-00', '', '', '0000-00-00', '', '', 'N', 'Y', 'N', 'Y', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_request`
--
ALTER TABLE `contact_request`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `group_contact`
--
ALTER TABLE `group_contact`
  ADD PRIMARY KEY (`gcid`);

--
-- Indexes for table `group_table`
--
ALTER TABLE `group_table`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `logbook`
--
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `my_note`
--
ALTER TABLE `my_note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`rem_id`);

--
-- Indexes for table `reminder_participants`
--
ALTER TABLE `reminder_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder_task`
--
ALTER TABLE `reminder_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user_old`
--
ALTER TABLE `user_old`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_request`
--
ALTER TABLE `contact_request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_contact`
--
ALTER TABLE `group_contact`
  MODIFY `gcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `group_table`
--
ALTER TABLE `group_table`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `my_note`
--
ALTER TABLE `my_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `rem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reminder_participants`
--
ALTER TABLE `reminder_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reminder_task`
--
ALTER TABLE `reminder_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_old`
--
ALTER TABLE `user_old`
  MODIFY `userid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
