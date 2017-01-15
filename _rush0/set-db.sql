-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2017 at 09:02 PM
-- Server version: 5.7.11
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `768_42rush`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `TotalPrice` int(11) DEFAULT NULL,
  `ListItemID` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(150) NOT NULL,
  `CategoryAbstract` varchar(500) DEFAULT NULL,
  `CategoryURL` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `CategoryAbstract`, `CategoryURL`) VALUES
(1, 'Home', 'Find you new home-staging!', NULL),
(2, 'Computer', '"Pimp my Computer"', NULL),
(3, 'Fashion', 'Pink is the new Black', NULL),
(4, 'Food', 'Because Food Porn is simple life', NULL),
(5, 'Movies', 'SFX better than ever! Even for your Grandma!', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ItemText` varchar(150) NOT NULL,
  `ItemAbstract` varchar(500) DEFAULT NULL,
  `ItemPhotos` varchar(300) DEFAULT NULL,
  `ItemPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `CategoryID`, `ItemText`, `ItemAbstract`, `ItemPhotos`, `ItemPrice`) VALUES
(2, 4, 'Fajita-Badass', 'All this shit full of sugar and meat! Disclaimer: Eating salads doesn\'t save lives...', 'https%3A%2F%2Fak.picdn.net%2Foffset%2Fphotos%2F5876aea5ba6f6bfc1a49e209%2Fmedium%2Foffset_484693.jpg%3FDFghwDcb', 32),
(3, 5, 'Ted 2', 'wer a f*c$ing teddy lurn u 2 chill out a 2nd time &#039;cause ur 2 dump 2 get it 1ce', 'https%3A%2F%2Fak.picdn.net%2Foffset%2Fphotos%2F54c92e6d5a10fc50d2d0284d%2Fmedium%2Foffset_184203.jpg%3FDFghwDcb', 1),
(4, 4, 'Spicey', 'Caution the nose!', 'https%3A%2F%2Fak.picdn.net%2Foffset%2Fphotos%2F57d711d1ba6f6bfc1a48e31b%2Fmedium%2Foffset_419444.jpg%3FDFghwDcb', 12),
(5, 4, 'Bugz', 'It&#039;s not life being a bug! ... yeah really you can it that', 'https%3A%2F%2Fak.picdn.net%2Foffset%2Fphotos%2F56cd82642d1642c18962cabc%2Fmedium%2Foffset_327279.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `SuperUser` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `SuperUser`) VALUES
(1, 'admin', 'c5247fe4b0aee90369e86a698ed379ec16ac6c46f17e1f88e361f444c5b1a8cdcc6a814e37ff3aa3c6bda2ab308eb4ed99e64576806175a7f539e8b0b7bb65bf', 1),
(2, 'qfremeau', '989bac194dc428df07bd8f455326765ad001c7b3909c86b63400641fddc9bc4a205ca18458e112e978e6c9576a6a397fa2203cf458ca0412886b57c23b386f76', 0),
(3, 'chray', '989bac194dc428df07bd8f455326765ad001c7b3909c86b63400641fddc9bc4a205ca18458e112e978e6c9576a6a397fa2203cf458ca0412886b57c23b386f76', 0),
(4, 'coucou', '526f2e3671f1b096b2fbbf3ab5bf7847e7c15942fc4a7039e1d8c58cda61d249d6e2bce160ab280c98382246ede4f5cfe5109ff2bed1b76557ad9a4f1ce2d063', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
