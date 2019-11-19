-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2019 at 08:53 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lokie`
--

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `id` int(11) NOT NULL,
  `user1` text NOT NULL,
  `user2` text NOT NULL,
  `accept` varchar(20) NOT NULL DEFAULT 'false',
  `user2_long` int(11) NOT NULL,
  `user2_lat` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`id`, `user1`, `user2`, `accept`, `user2_long`, `user2_lat`, `date`, `hash`) VALUES
(1, 'asa@gmail.com', 'emmablasia@gmail.com', 'false', 0, 0, '2019-10-26 13:14:50', 'wow'),
(2, 'asa@gmail.com', 'emmablasia@gmail.com', 'true', 0, 0, '2019-10-26 16:13:57', '78e5c7c8eea10f0727a41605d464e88bb1701d10'),
(3, 'asa@gmail.com', 'emmablasia@gmail.com', 'true', 5, 6, '2019-10-26 16:16:44', '26ac6454c68d6e7fa197f6dad7c8439d80ffea70'),
(4, 'asa@gmail.com', 'asaoluelijah7@gmail.com', 'true', 5, 6, '2019-10-29 13:44:47', '451f1d9d442934ef94b57b280c65123febd4618d');

-- --------------------------------------------------------

--
-- Table structure for table `trustee`
--

CREATE TABLE `trustee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trustee_name` text NOT NULL,
  `trustee_email` text NOT NULL,
  `trustee_phone` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trustee`
--

INSERT INTO `trustee` (`id`, `user_id`, `trustee_name`, `trustee_email`, `trustee_phone`, `date_added`) VALUES
(1, 1, 'Asaolu E.', 'asaoluelijah7@gmail.com', '09036977226', '2019-10-30 14:36:43'),
(2, 1, 'Oyedele T.', 'Oyedeletemitope@gmail.com', '09036977344', '2019-11-05 14:18:38'),
(3, 1, 'Adeola O.', 'ade@g.co', '2318238746', '2019-11-05 14:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `longitude` text NOT NULL,
  `latitude` text NOT NULL,
  `trustee_count` int(11) NOT NULL,
  `last_active` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `longitude`, `latitude`, `trustee_count`, `last_active`) VALUES
(1, 'Topzy', 'asa@gmail.com', 'asa', '4.7654647', '6.4595609', 15, ''),
(2, 'Topzy', 'eagle@a.co', 'asa', '', '', 1, ''),
(3, 'Topzy', '1237734', 'Asaolu Elijah', '', '', 1, ''),
(4, 'Topzy', '1237734', 'Asaolu Elijah', '', '', 1, ''),
(5, 'Topzy', '1237734', 'Asaolu Elijah', '', '', 1, ''),
(6, 'Topzy', '1237734', 'Asaolu Elijah', '', '', 1, ''),
(7, 'Topzy', '1237734', 'asa', '', '', 1, ''),
(8, 'Asaolu Elijah', 'Asaoluelijah7@gmail.com', 'asa', '', '', 0, ''),
(9, 'Asaolu Elijah', 'Asaoluelijah723@gmail.com', 'aaaa', '', '', 0, ''),
(10, 'Asaolu Elijah', 'AsaoluelijaSh7@gmail.com', 'AAAA', '', '', 0, ''),
(11, 'Asaolu Elijah', 'Asaoluelijah7@gmail.comd', 'aaa', '', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trustee`
--
ALTER TABLE `trustee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trustee`
--
ALTER TABLE `trustee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
