-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2018 at 11:40 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpoll`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `IDpoll` int(11) NOT NULL,
  `qName` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  `ans5` text NOT NULL,
  `ans6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`IDpoll`, `qName`, `ans1`, `ans2`, `ans3`, `ans4`, `ans5`, `ans6`) VALUES
(30, 'Do you like polls?', 'Yes', 'No', '', '', '', ''),
(31, 'Dominated', 'yes', 'BigO', '2toTheK', 'LogN', 'Omegaaa', 'F(n) = O(g(n))'),
(32, 'Are Hotdogs a Sandwhich', 'Yes', 'Heck No', 'This aint it chief', 'We arent like that', 'Kanye Likes Hot Dogs', 'I am Hot Dog'),
(34, 'Starcraft Master Race?', 'Terran', 'Protoss', 'Zerg', '', '', ''),
(35, 'Why do we vote twice?', 'Cuz we can', 'It can not stopped', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `IDpoll` int(11) NOT NULL,
  `vote1` int(11) NOT NULL,
  `vote2` int(11) NOT NULL,
  `vote3` int(11) NOT NULL,
  `vote4` int(11) NOT NULL,
  `vote5` int(11) NOT NULL,
  `vote6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`IDpoll`, `vote1`, `vote2`, `vote3`, `vote4`, `vote5`, `vote6`) VALUES
(30, 128, 35, 0, 0, 0, 0),
(31, 5, 14, 10, 17, 36, 14),
(32, 17, 0, 92, 38, 100, 48),
(33, 0, 6, 0, 0, 0, 0),
(34, 60, 2, 34, 0, 0, 0),
(35, 8, 4, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`IDpoll`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `IDpoll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
