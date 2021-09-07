-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2019 at 09:14 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instantordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `userid` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `contact` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`userid`, `username`, `password`, `name`, `contact`, `email`, `address`) VALUES
(2, 'sabin', 'sabin1', 'sabin bajgain', '9860627659', 'sabin8peace@gmail.cp,', 'jadibuti'),
(4, 'sandesh', 'sandesh', 'sandesh', '9860627659', 'sabin8peace@gmail.com', 'jadibuti');

-- --------------------------------------------------------

--
-- Table structure for table `countryspf`
--

CREATE TABLE `countryspf` (
  `cid` int(11) NOT NULL,
  `cname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countryspf`
--

INSERT INTO `countryspf` (`cid`, `cname`) VALUES
(1, 'Nepali'),
(2, 'Chinese'),
(3, 'Indian'),
(4, 'Korean'),
(5, 'coldDrink');

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

CREATE TABLE `fooditem` (
  `fid` int(11) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `fprice` int(11) NOT NULL,
  `fprob` decimal(4,0) NOT NULL,
  `countrySpf_cid` int(11) NOT NULL,
  `order_frequency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fooditem`
--

INSERT INTO `fooditem` (`fid`, `fname`, `fprice`, `fprob`, `countrySpf_cid`, `order_frequency`) VALUES
(2, 'masubhat', 200, '0', 1, 0),
(3, 'Chatamari', 80, '0', 1, 4),
(4, 'Yomari', 100, '0', 1, 2),
(6, 'Chiura-Khaja', 180, '0', 1, 5),
(9, 'coke', 30, '0', 5, 2),
(10, 'slice', 35, '0', 5, 4),
(11, 'chapati', 80, '0', 1, 3),
(12, 'fruti', 25, '0', 5, 1),
(13, 'sauses', 50, '0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderedfoods`
--

CREATE TABLE `orderedfoods` (
  `oid` int(11) NOT NULL,
  `food_qty` varchar(45) NOT NULL,
  `foodid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderedfoods`
--

INSERT INTO `orderedfoods` (`oid`, `food_qty`, `foodid`) VALUES
(1, '1', 4),
(1, '2', 6),
(1, '1', 9),
(1, '2', 10),
(1, '1', 11),
(2, '1', 3),
(2, '2', 12),
(3, '1', 4),
(3, '1', 6),
(3, '2', 10),
(4, '1', 6),
(4, '2', 10),
(4, '1', 11),
(5, '1', 3),
(5, '2', 6),
(5, '2', 9),
(5, '4', 10),
(5, '1', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `table_no` varchar(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `totalprice` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `ordered_date` datetime NOT NULL,
  `served_status` tinyint(1) NOT NULL,
  `paid_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `phoneno`, `pname`, `table_no`, `country`, `totalprice`, `message`, `ordered_date`, `served_status`, `paid_status`) VALUES
(1, '98', 'Name', 'T5', 'Nepali', 640, 'Thanks', '2017-07-30 08:30:44', 1, 0),
(2, '99', 'a', 'T3', 'Nepali', 130, 'Nothing to say', '2017-07-30 09:57:40', 0, 0),
(3, '9898989898', 'new', 'T3', 'Nepali', 350, '', '2017-07-31 08:32:07', 1, 1),
(4, '98', 'Name', 'T5', 'Nepali', 330, 'slice chiso hos', '2017-08-03 12:20:56', 0, 0),
(5, '9800000000', 'Prakash', 'T4', 'Nepali', 740, 'adsa', '2019-09-24 20:54:12', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE `summary` (
  `sid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `payment` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `countryspf`
--
ALTER TABLE `countryspf`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `fooditem`
--
ALTER TABLE `fooditem`
  ADD PRIMARY KEY (`fid`,`countrySpf_cid`),
  ADD KEY `fk_foodItem_countrySpf_idx` (`countrySpf_cid`);

--
-- Indexes for table `orderedfoods`
--
ALTER TABLE `orderedfoods`
  ADD PRIMARY KEY (`oid`,`foodid`),
  ADD KEY `fk_orderedTable_foodItem1_idx` (`foodid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countryspf`
--
ALTER TABLE `countryspf`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fooditem`
--
ALTER TABLE `fooditem`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `summary`
--
ALTER TABLE `summary`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
