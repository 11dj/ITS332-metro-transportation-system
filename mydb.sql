-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2015 at 12:47 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `guestbuyticket` (IN `RouteID` INT, IN `StationTypeID` INT, IN `OStationID` INT, IN `DStationID` INT, IN `Cost` INT)  NO SQL
BEGIN
	DECLARE currentTripNO INT;
    DECLARE maxTripNO INT;
	SELECT max(TripNo) INTO maxTripNO FROM triprecordunregistereduser;
    IF maxTripNO IS NULL THEN
    	SET currentTripNO = 1;
    ELSE
    	SET currentTripNO=maxTripNO+1;
    END IF;
    INSERT INTO triprecordunregistereduser (TripNo, RouteID, StationTypeID, OStationID, DStationID, Cost) VALUES(currentTripNO, RouteID, StationTypeID, OStationID, DStationID, Cost);
   
    SELECT currentTripNO;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `memberbuyticket` (IN `RouteID` INT, IN `StationTypeID` INT, IN `OStationID` INT, IN `DStationID` INT, IN `Cost` INT, IN `PassengerID` INT)  NO SQL
BEGIN
	DECLARE currentTripNO INT;
    DECLARE maxTripNO INT;
	SELECT max(TripNo) INTO maxTripNO FROM triprecordregistereduser;
    IF maxTripNO IS NULL THEN
    	SET currentTripNO = 1;
    ELSE
    	SET currentTripNO=maxTripNO+1;
    END IF;
    INSERT INTO triprecordregistereduser (TripNo, PassengerID, RouteID, StationTypeID, OStationID, DStationID, Cost) VALUES(currentTripNO, PassengerID, RouteID, StationTypeID, OStationID, DStationID, Cost);
   
    SELECT currentTripNO;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `initialcost`
--

CREATE TABLE `initialcost` (
  `InitialCostID` int(11) NOT NULL,
  `InitialCostValue` float DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `initialcost`
--

INSERT INTO `initialcost` (`InitialCostID`, `InitialCostValue`, `Description`) VALUES
(1, 20, 'BTS'),
(2, 10, 'MRT');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `PassengerID` int(8) NOT NULL,
  `PassengerTypeID` int(8) NOT NULL,
  `PassengerCitizenORPassportID` varchar(45) DEFAULT NULL,
  `PassengerFirstName` varchar(45) NOT NULL,
  `PassengerLastName` varchar(45) NOT NULL,
  `PassengerBirthday` date DEFAULT NULL,
  `PassengerEmail` varchar(45) DEFAULT NULL,
  `PassengerCardID` varchar(16) NOT NULL,
  `PassengerCardAuthen` varchar(45) NOT NULL,
  `PassengerBalance` float NOT NULL,
  `PassengerRegDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`PassengerID`, `PassengerTypeID`, `PassengerCitizenORPassportID`, `PassengerFirstName`, `PassengerLastName`, `PassengerBirthday`, `PassengerEmail`, `PassengerCardID`, `PassengerCardAuthen`, `PassengerBalance`, `PassengerRegDate`) VALUES
(4306851, 1, '', '   sss           ', 'sss', '1980-12-25', '', '4955812867936040', 'YB2qKeVX0RavljtH', 200, '2015-11-07'),
(18754237, 2, '2005', '2005   ', '2005', '2005-12-25', '', '6140868019973742', 'knEqfS7G8OorAwYj', 2497.5, '2015-11-07'),
(21021085, 1, '15', 'f', 'l', '1980-12-25', 'eieigum@fff.com', '7826403675209191', 'zpUv20u8C7xLY5Ro', 500635, '2015-11-07'),
(30184512, 3, '2123', '', '', '1980-12-25', '', '1047798036831249', 'bc19RpiyTMVQU6xo', 0, '2015-11-07'),
(34860930, 3, '2123', '', '', '1980-12-25', '', '5681471237482309', 'xfmiHORy1sNPFcdU', 0, '2015-11-07'),
(47340681, 3, '2123', '', '', '1980-12-25', '', '1760541872659324', 'GFtzU9Lwa6OPpHIl', 300, '2015-11-07'),
(54852361, 3, '22', 'disable+youth', '', '2005-12-25', '', '9430617214850293', 'NR0jo5WdsPewcLfb', 0, '2015-11-07'),
(55404662, 3, '2123', '', '', '1980-12-25', '', '0662297188150734', '5eogfQWSr8q1nv0h', 0, '2015-11-07'),
(58048617, 1, '11112015', 'a ', 'b', '1994-11-11', 'c', '4078769301516583', 'mbP2jkp8WFUDxVor', 5000, '2015-11-11'),
(58276994, 3, '2123', '', '', '1980-12-25', '', '4619307172985826', 'qMKr4RdgbQ13i9LJ', 0, '2015-11-07'),
(59134107, 0, '1234', 'kaw ', 'p', '1970-01-01', '', '6963943758251078', 'LvWhFB2NqwTIbtZD', 0, '2015-11-11'),
(59738936, 1, '', '', '', '1970-01-01', '', '7410425635989238', 'b5XdMYBF4CqcETht', 0, '2015-11-12'),
(61849572, 0, '', 'asd   ', 'asd', '1970-01-01', '', '5838326960012751', '0qgpc2AB5PluDafd', 0, '2015-11-07'),
(63619574, 2, '22', 'disable+youth ', '', '2005-12-25', '', '6818964931234507', 'UAp2RdBEvh40PV9K', 0, '2015-11-07'),
(64925264, 1, '0123456', 'P ', 'J', '1980-12-25', 'pj@pj.com', '0574618135099246', 'vh6QL5NdUP8zXtby', 50000, '2015-11-07'),
(67008865, 2, '4245', 'eiei77 ', 'gum', '1999-01-01', 'eieigum@fff.com66', '1254240961650378', 'uzDxH25RTNSEhboG', 1000, '2015-11-07'),
(85140462, 1, '', 'superold2', '', '1920-10-10', 'eieigum@fff.com', '8821065335249461', 'odAYIqyn39tlaQV2', 0, '2015-11-07'),
(92019738, 3, '22', 'superold', '', '1970-01-01', '', '7469123478096085', 'wZkghRmEIGyKsM48', 0, '2015-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `passengertype`
--

CREATE TABLE `passengertype` (
  `PassengerTypeID` int(11) NOT NULL,
  `PassengerTypeName` varchar(45) DEFAULT NULL,
  `DiscountRate` float DEFAULT NULL,
  `PassengerTypeDescription` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passengertype`
--

INSERT INTO `passengertype` (`PassengerTypeID`, `PassengerTypeName`, `DiscountRate`, `PassengerTypeDescription`) VALUES
(1, 'Adult', 1, 'Normal Adult, No discount'),
(2, 'Youth', 0.7, NULL),
(3, 'Disabled', 0.5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `RouteID` int(11) NOT NULL,
  `ScheduleID` int(11) NOT NULL,
  `Step` int(11) NOT NULL,
  `OStationID` int(11) NOT NULL,
  `DStationID` int(11) NOT NULL,
  `Cost` float NOT NULL,
  `DepartTime` time DEFAULT NULL,
  `ArrivalTime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`RouteID`, `ScheduleID`, `Step`, `OStationID`, `DStationID`, `Cost`, `DepartTime`, `ArrivalTime`) VALUES
(1, 1, 1, 1, 3, 10, '10:00:00', '10:01:00'),
(1, 2, 1, 1, 3, 10, '11:00:00', '11:01:00'),
(1, 3, 1, 1, 3, 10, '12:00:00', '12:01:00'),
(1, 1, 2, 3, 5, 20, '10:01:00', '10:03:00'),
(1, 2, 2, 3, 5, 20, '11:01:00', '11:03:00'),
(1, 3, 2, 3, 5, 20, '12:01:00', '12:03:00'),
(1, 1, 3, 5, 6, 30, '10:03:00', '10:06:00'),
(1, 2, 3, 5, 6, 30, '11:03:00', '11:06:00'),
(1, 3, 3, 5, 6, 30, '12:03:00', '12:06:00'),
(2, 1, 1, 2, 4, 10, '10:00:00', '10:01:00'),
(3, 1, 1, 1, 3, 10, '10:00:00', '10:01:00'),
(3, 2, 1, 1, 3, 10, '10:10:00', '10:11:00'),
(3, 3, 1, 1, 3, 10, '12:00:00', '12:01:00'),
(3, 1, 2, 3, 5, 10, '10:01:00', '10:03:00'),
(3, 2, 2, 3, 5, 10, '10:11:00', '10:13:00'),
(3, 3, 2, 3, 5, 10, '12:01:00', '12:03:00'),
(3, 1, 3, 5, 6, 10, '10:03:00', '10:06:00'),
(3, 2, 3, 5, 6, 10, '10:13:00', '10:16:00'),
(3, 3, 3, 5, 6, 10, '12:03:00', '12:06:00'),
(4, 1, 1, 2, 4, 5, '00:00:00', '00:01:00'),
(4, 1, 2, 4, 10, 10, '00:01:00', '00:02:00'),
(4, 1, 3, 10, 11, 15, '00:02:00', '00:03:00'),
(5, 1, 1, 2, 4, 5, '00:00:00', '00:01:00'),
(5, 1, 2, 4, 10, 10, '00:01:00', '00:02:00'),
(5, 1, 3, 10, 11, 15, '00:02:00', '00:03:00'),
(6, 1, 1, 1, 3, 10, '21:00:00', '21:01:00'),
(6, 2, 1, 1, 3, 10, '21:30:00', '21:31:00'),
(6, 3, 1, 1, 3, 10, '22:00:00', '22:01:00'),
(6, 4, 1, 1, 3, 10, '22:30:00', '22:31:00'),
(6, 5, 1, 1, 3, 10, '23:00:00', '23:01:00'),
(6, 1, 2, 3, 5, 10, '21:01:00', '21:02:00'),
(6, 2, 2, 3, 5, 10, '21:31:00', '21:32:00'),
(6, 3, 2, 3, 5, 10, '22:01:00', '22:02:00'),
(6, 4, 2, 3, 5, 10, '22:31:00', '22:32:00'),
(6, 5, 2, 3, 5, 10, '23:01:00', '23:02:00'),
(6, 1, 3, 5, 6, 10, '21:02:00', '21:03:00'),
(6, 2, 3, 5, 6, 10, '21:32:00', '21:33:00'),
(6, 3, 3, 5, 6, 10, '22:02:00', '22:03:00'),
(6, 4, 3, 5, 6, 10, '22:32:00', '22:33:00'),
(6, 5, 3, 5, 6, 10, '23:02:00', '23:03:00'),
(6, 1, 4, 6, 7, 10, '21:03:00', '21:04:00'),
(6, 2, 4, 6, 7, 10, '21:33:00', '21:34:00'),
(6, 3, 4, 6, 7, 10, '22:03:00', '22:04:00'),
(6, 4, 4, 6, 7, 10, '22:33:00', '22:34:00'),
(6, 5, 4, 6, 7, 10, '23:03:00', '23:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `routenaming`
--

CREATE TABLE `routenaming` (
  `RouteID` int(11) NOT NULL,
  `RouteName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routenaming`
--

INSERT INTO `routenaming` (`RouteID`, `RouteName`) VALUES
(1, 'route1'),
(2, 'route2'),
(3, 'eiei'),
(4, 'mrtR1'),
(5, 'mrtR1'),
(6, 'testneartime');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffFullName` varchar(45) DEFAULT NULL,
  `StaffUsername` varchar(45) DEFAULT NULL,
  `StaffPSW` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffFullName`, `StaffUsername`, `StaffPSW`) VALUES
(1, 'Pongwanit Jeaperapong', 'ninekaw9', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'abcdef', 'abc', '900150983cd24fb0d6963f7d28e17f72'),
(3, 'qqq', 'sss', '0cc175b9c0f1b6a831c399e269772661'),
(4, 'ax', 'xc', '0cc175b9c0f1b6a831c399e269772661'),
(5, 'aa', 'vv', '7694f4a66316e53c8cdd9d9954bd611d'),
(6, 'y', 'r', 'e4da3b7fbbce2345d7772b0674a318d5');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `StationID` int(11) NOT NULL,
  `StationTypeID` int(11) NOT NULL,
  `StationNameEN` varchar(45) NOT NULL,
  `InterchangeWithStationTypeID` int(11) DEFAULT NULL,
  `InterchangeWithStationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`StationID`, `StationTypeID`, `StationNameEN`, `InterchangeWithStationTypeID`, `InterchangeWithStationID`) VALUES
(1, 1, 'bts1', NULL, NULL),
(2, 2, 'mrt1', 1, 1),
(3, 1, 'bts2', 2, 2),
(4, 2, 'mrt2', 1, 3),
(5, 1, 'dsasd', NULL, NULL),
(6, 1, 'bts3', NULL, NULL),
(7, 1, 'Bts4', NULL, NULL),
(8, 1, 'sadasd', NULL, NULL),
(10, 2, 'mrt3', NULL, NULL),
(11, 2, 'nrt4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stationtype`
--

CREATE TABLE `stationtype` (
  `StationTypeID` int(11) NOT NULL,
  `StationTypeName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stationtype`
--

INSERT INTO `stationtype` (`StationTypeID`, `StationTypeName`) VALUES
(1, 'BTS'),
(2, 'MRT');

-- --------------------------------------------------------

--
-- Table structure for table `triprecordregistereduser`
--

CREATE TABLE `triprecordregistereduser` (
  `TripNo` int(11) NOT NULL,
  `PassengerID` int(11) DEFAULT NULL,
  `RouteID` int(11) DEFAULT NULL,
  `StationTypeID` int(11) NOT NULL,
  `OStationID` int(11) DEFAULT NULL,
  `DStationID` int(11) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `DepartTime` datetime DEFAULT NULL,
  `ArriveTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `triprecordregistereduser`
--

INSERT INTO `triprecordregistereduser` (`TripNo`, `PassengerID`, `RouteID`, `StationTypeID`, `OStationID`, `DStationID`, `Cost`, `DepartTime`, `ArriveTime`) VALUES
(1, 18754237, 1, 1, 1, 6, 56, NULL, NULL),
(2, 18754237, 1, 1, 1, 3, 21, NULL, NULL),
(3, 18754237, 6, 1, 6, 7, 21, NULL, NULL),
(4, 18754237, 4, 1, 2, 10, 25, NULL, NULL),
(5, 18754237, 5, 1, 10, 11, 25, NULL, NULL),
(6, 18754237, 4, 2, 2, 11, 28, '2015-11-15 00:00:00', NULL),
(7, 18754237, 1, 1, 5, 6, 35, NULL, NULL),
(8, 18754237, 1, 1, 3, 6, 49, '2015-11-15 12:01:15', NULL),
(9, 18754237, 6, 1, 1, 7, 42, '2015-11-15 23:00:00', '2015-11-15 23:03:55'),
(10, 18754237, 1, 1, 1, 3, 21, NULL, NULL),
(11, 18754237, 5, 2, 10, 11, 18, '2015-11-15 00:02:00', '2015-11-15 00:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `triprecordunregistereduser`
--

CREATE TABLE `triprecordunregistereduser` (
  `TripNo` int(11) NOT NULL,
  `RouteID` int(11) DEFAULT NULL,
  `StationTypeID` int(11) NOT NULL,
  `OStationID` int(11) DEFAULT NULL,
  `DStationID` int(11) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `DepartTime` datetime DEFAULT NULL,
  `ArrivalTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `triprecordunregistereduser`
--

INSERT INTO `triprecordunregistereduser` (`TripNo`, `RouteID`, `StationTypeID`, `OStationID`, `DStationID`, `Cost`, `DepartTime`, `ArrivalTime`) VALUES
(1, 4, 2, 10, 11, 25, NULL, NULL),
(2, 4, 2, 10, 11, 25, NULL, NULL),
(3, 4, 2, 10, 11, 25, NULL, NULL),
(4, 4, 2, 10, 11, 25, NULL, NULL),
(5, 1, 2, 1, 6, 70, NULL, NULL),
(6, 3, 2, 5, 6, 20, NULL, NULL),
(7, 6, 1, 1, 7, 60, NULL, NULL),
(8, 6, 1, 5, 7, 40, NULL, NULL),
(9, 1, 1, 1, 6, 80, NULL, NULL),
(10, 5, 1, 2, 11, 50, '2015-11-26 08:30:36', NULL),
(11, 6, 1, 1, 7, 60, NULL, NULL),
(12, 1, 1, 1, 6, 80, NULL, NULL),
(13, 1, 1, 1, 6, 80, '2015-11-14 11:00:00', '2015-11-14 11:05:45'),
(14, 1, 1, 1, 6, 80, '2015-11-14 11:00:06', '2015-11-14 11:05:55'),
(15, 6, 1, 3, 7, 50, '2015-11-14 22:31:50', '2015-11-14 22:33:38'),
(16, 5, 1, 4, 11, 45, '2015-11-15 00:01:05', '2015-11-15 00:02:55'),
(17, 1, 2, 3, 4, 5, NULL, NULL),
(18, 5, 1, 2, 4, 25, NULL, NULL),
(19, 6, 1, 1, 7, 60, NULL, NULL),
(20, 5, 2, 2, 4, 15, '2015-11-15 00:00:00', '2015-11-15 00:01:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `initialcost`
--
ALTER TABLE `initialcost`
  ADD PRIMARY KEY (`InitialCostID`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`PassengerID`,`PassengerTypeID`);

--
-- Indexes for table `passengertype`
--
ALTER TABLE `passengertype`
  ADD PRIMARY KEY (`PassengerTypeID`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`RouteID`,`Step`,`ScheduleID`,`OStationID`,`DStationID`);

--
-- Indexes for table `routenaming`
--
ALTER TABLE `routenaming`
  ADD PRIMARY KEY (`RouteID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`StationID`,`StationTypeID`);

--
-- Indexes for table `stationtype`
--
ALTER TABLE `stationtype`
  ADD PRIMARY KEY (`StationTypeID`);

--
-- Indexes for table `triprecordregistereduser`
--
ALTER TABLE `triprecordregistereduser`
  ADD PRIMARY KEY (`TripNo`);

--
-- Indexes for table `triprecordunregistereduser`
--
ALTER TABLE `triprecordunregistereduser`
  ADD PRIMARY KEY (`TripNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `passengertype`
--
ALTER TABLE `passengertype`
  MODIFY `PassengerTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `StationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `stationtype`
--
ALTER TABLE `stationtype`
  MODIFY `StationTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `triprecordregistereduser`
--
ALTER TABLE `triprecordregistereduser`
  MODIFY `TripNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `triprecordunregistereduser`
--
ALTER TABLE `triprecordunregistereduser`
  MODIFY `TripNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
