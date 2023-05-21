-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2023 at 10:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook_od`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `ChatId` int(11) NOT NULL,
  `Message` text DEFAULT NULL,
  `SenderId` int(11) DEFAULT NULL,
  `ReceiverId` int(11) DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `UserId1` int(11) NOT NULL,
  `UserId2` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `Email` text DEFAULT NULL,
  `Password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `Email`, `Password`) VALUES
(7, 'f@aaa.com', '$2y$10$K5KRPPWeXVvzPSwaF2p/M.RLqaD2rDI1lfo/L4UJHgnFIhGtM7DHK'),
(8, 'a@a.com', '$2y$10$9lghM/sgKALlve1il9FRre/0GxPwkdLTVx7/CJbIrGhmc1x8jihrG'),
(9, 'b@a.com', '$2y$10$c//fT7JWgNQMrpkW/aIupuukCWqw7IIGEx2vpXmN2QlyBPFO0edQ6'),
(10, 'disha@disha.disha', '$2y$10$R/xplN527R3WqK7x1FtwuO5Fv91h62j1UsvURL4ZC1cHhZv/xAB7i');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `PageId` int(11) NOT NULL,
  `Name` text DEFAULT NULL,
  `Creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Created_By` int(11) DEFAULT NULL,
  `CompanyEmail` text DEFAULT NULL,
  `TotalLikes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostId` int(11) NOT NULL,
  `Title` text DEFAULT NULL,
  `Creation_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `Likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostId`, `Title`, `Creation_date`, `CreatedBy`, `Likes`) VALUES
(1, 'asdfg', '2023-05-21 08:06:10', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sharing_activity`
--

CREATE TABLE `sharing_activity` (
  `UserId` int(11) NOT NULL,
  `PostId` int(11) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IsCreated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_`
--

CREATE TABLE `user_` (
  `UserId` int(11) NOT NULL,
  `FName` text DEFAULT NULL,
  `LName` text DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `About` text DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_`
--

INSERT INTO `user_` (`UserId`, `FName`, `LName`, `DOB`, `About`, `Password`, `login_id`) VALUES
(3, 'a', 'aaa', '1990-01-01', NULL, '$2y$10$RmyJONwfywgwz8Efadjal.tFOcDY5TlbB3VaeuMtr.miG3DM1UxUS', 9),
(4, 'disha', 'ahmed', '1990-01-01', NULL, '$2y$10$5120etALHnymj16irdy.7.ihU/xmi/QCkJXvCBKAALJ7j7t.bKizm', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_phone`
--

CREATE TABLE `user_phone` (
  `Phone` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ChatId`),
  ADD KEY `SenderId` (`SenderId`),
  ADD KEY `ReceiverId` (`ReceiverId`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`UserId1`,`UserId2`),
  ADD KEY `UserId2` (`UserId2`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`PageId`),
  ADD KEY `Created_By` (`Created_By`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`PostId`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `sharing_activity`
--
ALTER TABLE `sharing_activity`
  ADD PRIMARY KEY (`UserId`,`PostId`),
  ADD KEY `PostId` (`PostId`);

--
-- Indexes for table `user_`
--
ALTER TABLE `user_`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `user_phone`
--
ALTER TABLE `user_phone`
  ADD PRIMARY KEY (`UserId`,`Phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_`
--
ALTER TABLE `user_`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_`
--
ALTER TABLE `user_`
  ADD CONSTRAINT `user__ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
