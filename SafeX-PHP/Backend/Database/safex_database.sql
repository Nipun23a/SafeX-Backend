-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 07:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safex_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Company_ID` int(6) NOT NULL,
  `Company_Name` varchar(20) NOT NULL,
  `Join_Date` date NOT NULL DEFAULT current_timestamp(),
  `No_of_Helmet` int(5) NOT NULL,
  `Cloud_Storage_Renew_Date` date NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `Password_Hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Company_ID`, `Company_Name`, `Join_Date`, `No_of_Helmet`, `Cloud_Storage_Renew_Date`, `Email_Address`, `Password_Hash`) VALUES
(13, 'ndc', '2024-02-29', 10, '2024-02-29', 'nipunakaweya@gmail.com', '$2y$10$i3r64rO.rV63aM2Eb/GeSO4x4tR13VpHdSSXvgk/fQGDTjOjPlRSu'),
(35, 'qq', '2024-03-03', 1, '2024-03-03', 'nipuna609@gmail.com', '$2y$10$8aDEiCfFnQh6lvDGcA.0Q.O/klfNXmdq/tuOdeQIu/8/kNsLtaYNi'),
(36, 'qqw', '2024-03-03', 1, '2024-03-03', 'nipuna609@gmail.com', '$2y$10$8OluEJVKGKzByTD8tLsqs.LIRo2EYlfO8gS./rxnt.XlseTXVfoe6'),
(37, 'qqwq', '2024-03-03', 1, '2024-03-03', 'nipuna609@gmail.com', '$2y$10$h7lzbg2j.NWfgiiXKMCJy.sq4r4SnGDgG6.bmFP3mRYg/oEPt6mQy'),
(38, 'ASW', '2024-03-04', 1, '2024-03-05', 'nipunakaweya@gmail.com', '$2y$10$1lDniTyNNwO1/jyt270/TubleDKmWFIvwyMeaVLiAJ6K1ToIr7hpK'),
(39, 'Kulindu', '2024-03-06', 2, '2024-03-07', 'kulinduransika@gmail.com', '$2y$10$dPuaBEtLY4Q.6VFD/X7IguHqjpD.dQ8SloZdH1pY9nyRCEq6dEUSW'),
(40, 'qq', '2024-03-06', 2, '2024-03-07', 'nipunakaweya23@gmail.com', '$2y$10$dDxUmtigWhUdZVXopU2Ft.2BPw4jEjwnc5jEwsKqL7GIg/V8sKBeq'),
(41, 'WE', '2024-03-09', 4, '2024-03-13', 'nipunakaweya@gmail.com', '$2y$10$Ten5t/H.i78YyeoYQ5BpgO5NYtDi1MX0liUDzwEIciLxQA7iH3quK'),
(42, 'SD', '2024-03-12', 2, '2024-03-13', 'nipuna.20221148@iit.ac.lk', '$2y$10$UG4E/lAPtBxDv6bsge1TNuBo3y8RrsfOtb1HMezalNNi50orSUZcO'),
(43, 'ndg', '2024-03-12', 2, '2024-03-14', 'nipuna.20221148@iit.ac.lk', '$2y$10$GAmrK3qMtTC71eUjkMBAp.8XKnM4ymnvpFxk9fYanS6WAJtYOc.M6'),
(44, 'lkty', '2024-03-12', 2, '2024-03-13', 'nipuna.20221148@iit.ac.lk', '$2y$10$uUy47w4BAiQPIxkhhGGT1eO.F2eNqxjQr1Db0ZdMA3B/EP5DuqVFS'),
(45, 'rty', '2024-03-12', 2, '2024-03-13', 'nipuna.20221148@iit.ac.lk', '$2y$10$uQ7zKrvCJ7VlrE9GjBoEDOfFDWuUaacGWZ5it.JzOWW6I7FQFqXKi'),
(46, 'ght', '2024-03-13', 2, '2024-03-14', 'nipuna.20221148@iit.ac.lk', '$2y$10$KMFT4XDF5iGIdGNuo/4G3.8AQjh8r2j9tVFTpg6yZPX2xeQjP6./K'),
(47, 'tyr', '2024-03-13', 2, '2024-03-14', 'nipuna.20221148@iit.ac.lk', '$2y$10$91NW/Xqo/uVF8nHSXAYo8OUuSKULCq2Q4zqEKlUrzWWP66IP.Bihu'),
(48, 'tyr1', '2024-03-13', 4, '2024-03-14', 'nipuna.20221148@iit.ac.lk', '$2y$10$FvCmgGiN/JJKNdzAniO6.u0SLXIVwno.TrN0wUkAQecTlHMmBp0de'),
(49, 'new', '2024-03-15', 2, '2024-03-15', 'nipuna.20221148@iit.ac.lk', '$2y$10$bdkvmLVswJgCE.bYiVXS0epetXkw1C5L1QXB0lUL0XHDx7wDyQxce');

-- --------------------------------------------------------

--
-- Table structure for table `construction_site`
--

CREATE TABLE `construction_site` (
  `site_id` int(6) NOT NULL,
  `company_id` int(6) NOT NULL,
  `Site_Name` varchar(100) NOT NULL,
  `Number_of_workers` int(6) DEFAULT NULL,
  `Assigned_Helmets` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `construction_site`
--

INSERT INTO `construction_site` (`site_id`, `company_id`, `Site_Name`, `Number_of_workers`, `Assigned_Helmets`) VALUES
(1, 38, 'cc', NULL, NULL),
(2, 13, 'qq', NULL, NULL),
(4, 47, 'ff', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emergency alarm system`
--

CREATE TABLE `emergency alarm system` (
  `Alarm_ID` int(6) NOT NULL,
  `Helmet_ID` int(6) NOT NULL,
  `Employee_ID` int(6) NOT NULL,
  `Company_ID` int(6) NOT NULL,
  `Location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` int(6) NOT NULL,
  `Company_ID` int(6) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Employee_Pic` varchar(255) DEFAULT NULL,
  `Position` varchar(20) NOT NULL,
  `Telephone_No` varchar(11) NOT NULL,
  `Username` varchar(10) DEFAULT NULL,
  `Password_Hash` varchar(255) DEFAULT NULL,
  `Email_Address` varchar(224) DEFAULT NULL,
  `Assigned` bit(2) NOT NULL DEFAULT b'0',
  `Join_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Company_ID`, `Name`, `Employee_Pic`, `Position`, `Telephone_No`, `Username`, `Password_Hash`, `Email_Address`, `Assigned`, `Join_Date`) VALUES
(13, 13, 'cc', 'uploads/cc_images5.jpg', 'supervisor', '0123456789', 'YzUdTPVj', '$2y$10$7ylBLiCPTUdYl', 'nipuna.20221148@iit.ac.lk', b'00', '2024-03-12 17:37:10'),
(14, 38, 'DD', 'uploads/DD_images5.jpg', 'worker', '0123456789', '', '', 'nipunkaweya610@gmail.com', b'00', '2024-03-12 17:37:10'),
(15, 13, 'John Smith', 'uploads/John_Smith_University_of_Peradeniya_crest.png', 'worker', '0123456789', '', '', 'johnsillva734@gmail.com', b'00', '2024-03-12 17:37:10'),
(16, 13, 'Emily Davis', 'uploads/Emily_Davis_BOTany.png', 'management', '0123459876', '', '', 'nipunkaweya610@gmail.com', b'00', '2024-03-12 17:37:10'),
(17, 13, 'Michael Johnson', 'uploads/Michael_Johnson_WhatsApp Image 2024-02-13 at 11.52.41_21532c2e.jpg', 'worker', '0123456987', '', '', 'johnsillva734@gmail.com', b'00', '2024-03-12 17:37:10'),
(18, 13, 'Sarah Lee', 'uploads/Sarah_Lee_Untitled9.jpeg', 'worker', '0123456988', '', '', 'johnsillva734@gmail.com', b'00', '2024-03-12 17:37:10'),
(19, 13, 'jgdf', 'uploads/jgdf_Untitled2.jpeg', 'supervisor', '0123456789', 'tgscZUkV', '$2y$10$CQcxnI9RFaszD', 'nipuna609@gmail.com', b'00', '2024-03-12 17:37:10'),
(20, 13, 'ASD', 'uploads/ASD_Untitled5.jpeg', 'supervisor', '0123456789', 'wh6purh4', '$2y$10$mqAvxLGq2HKsL', 'nipuna.20221148@iit.ac.lk', b'00', '2024-03-12 17:37:10'),
(24, 13, 'qf', 'uploads/qf_Untitled9.jpeg', 'supervisor', '0123456789', 'H2aYirOi', '$2y$10$Xyad6zScMPjU0WbsJNqt8uPdgFMq9brL0L5rb6cFWJSi66WHcAXrG', 'nipuna.20221148@iit.ac.lk', b'00', '2024-03-12 17:37:10'),
(31, 47, 'ffgh', 'uploads/ffgh_Untitled.jpeg', 'worker', '0123456789', '', '', 'nipunkaweya610@gmail.com', b'00', '2024-03-15 00:59:19'),
(32, 47, 'GH', 'uploads/GH_Screenshot 2024-03-16 082615.png', 'worker', '0145678923', '', '', 'nipuna.20221148@iit.ac.lk', b'00', '2024-03-16 20:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `falldetection_event`
--

CREATE TABLE `falldetection_event` (
  `FallDetection_Event_ID` int(6) NOT NULL,
  `Helmet_ID` int(6) NOT NULL,
  `Emp_ID` int(6) NOT NULL,
  `Time_Stamp` datetime NOT NULL DEFAULT current_timestamp(),
  `Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gas_event`
--

CREATE TABLE `gas_event` (
  `Gas_Event_ID` int(6) NOT NULL,
  `Helmet_ID` int(6) NOT NULL,
  `Timestamp_Event` datetime NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `helmet`
--

CREATE TABLE `helmet` (
  `Helmet_ID` int(10) NOT NULL,
  `Helmet_Unique_Code` varchar(255) NOT NULL,
  `Helmet_Register_Date` date NOT NULL DEFAULT current_timestamp(),
  `Assigned` bit(2) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `helmet`
--

INSERT INTO `helmet` (`Helmet_ID`, `Helmet_Unique_Code`, `Helmet_Register_Date`, `Assigned`) VALUES
(75, 'Jx0V2Ga7QV', '2024-03-03', b'01'),
(76, 'EApsCYMt89', '2024-03-03', b'01'),
(77, 'znOzPcrNSX', '2024-03-03', b'01'),
(78, '3zzJ3AzFPE', '2024-03-03', b'01'),
(79, 'tnux9FoH7Q', '2024-03-03', b'01'),
(80, 'BSnX03uPcS', '2024-03-03', b'01'),
(81, 'BEpj4NJsxK', '2024-03-03', b'01'),
(82, '1JOy5SHj8C', '2024-03-03', b'01'),
(83, 'nQtT5XuW0w', '2024-03-03', b'01'),
(84, 'ayyZAvr9e5', '2024-03-03', b'01'),
(85, 'pIJ3RqvCmA', '2024-03-03', b'01'),
(86, 'XsmMjKQexw', '2024-03-03', b'01'),
(87, '9cmxy13VPz', '2024-03-03', b'01'),
(88, 'Il0l6g390c', '2024-03-03', b'01'),
(89, 'e5GA0PnEH4', '2024-03-03', b'01'),
(90, 'BbqgEEBEhl', '2024-03-03', b'01'),
(91, 'rKLX17sABb', '2024-03-03', b'01'),
(92, 'rvTWsvDhBh', '2024-03-03', b'01'),
(93, 'wiRG4T9qhg', '2024-03-03', b'01'),
(94, 'OgYKt6BF3U', '2024-03-03', b'00'),
(95, 'QQR6tHwLYf', '2024-03-09', b'00'),
(96, 'J4rQyZV1wz', '2024-03-09', b'00'),
(97, 'Del12xTvPD', '2024-03-09', b'00'),
(98, 'yRFPPu8LoD', '2024-03-09', b'00'),
(99, 'sx0lyEVMTf', '2024-03-09', b'00'),
(100, 'HareJ2w95A', '2024-03-09', b'00'),
(101, 'wLUIl23dLq', '2024-03-09', b'00'),
(102, 'mzwHAkS7oP', '2024-03-09', b'00'),
(103, 'G7NZX643zD', '2024-03-13', b'00'),
(104, 'z1FWlR5gVy', '2024-03-13', b'00'),
(105, 'sDkdOOBemV', '2024-03-13', b'00'),
(106, 'PU9frQqOMt', '2024-03-13', b'00'),
(107, '4StKEVAWlC', '2024-03-13', b'00'),
(108, 'q5Nyfj1q95', '2024-03-13', b'00'),
(109, 'lb75BmhOaN', '2024-03-13', b'00'),
(110, 'lYh81doPVO', '2024-03-13', b'00'),
(111, 'qRMoqA5XHl', '2024-03-13', b'00'),
(112, 'O7m6twu74y', '2024-03-13', b'00'),
(113, 'lieC3y7t1F', '2024-03-13', b'00'),
(114, 'fK3KeGtYUC', '2024-03-13', b'00'),
(115, 'frLD7K0cb3', '2024-03-13', b'00'),
(116, 'knTUjgPSYx', '2024-03-13', b'00'),
(117, 'iWt8qhCbPo', '2024-03-13', b'00'),
(118, 'rj1wtVx7Wq', '2024-03-13', b'00'),
(119, 'tTaUBzefjV', '2024-03-13', b'00'),
(120, 'c6Ssl3YGww', '2024-03-13', b'00'),
(121, 'WqgODCZRcy', '2024-03-13', b'00');

-- --------------------------------------------------------

--
-- Table structure for table `helmet_assignment`
--

CREATE TABLE `helmet_assignment` (
  `Helmet_AssigningID` int(6) NOT NULL,
  `Employee_ID` int(6) DEFAULT NULL,
  `Company_ID` int(6) NOT NULL,
  `Helmet_ID` int(6) NOT NULL,
  `Date_Of_Register` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `helmet_assignment`
--

INSERT INTO `helmet_assignment` (`Helmet_AssigningID`, `Employee_ID`, `Company_ID`, `Helmet_ID`, `Date_Of_Register`) VALUES
(22, 14, 38, 80, '2024-03-04 13:59:57'),
(23, NULL, 39, 81, '2024-03-06 15:18:28'),
(24, NULL, 40, 82, '2024-03-06 15:19:42'),
(25, NULL, 41, 83, '2024-03-09 16:42:27'),
(26, NULL, 41, 84, '2024-03-09 16:42:27'),
(27, NULL, 42, 85, '2024-03-12 23:02:20'),
(28, NULL, 43, 86, '2024-03-12 23:05:05'),
(29, NULL, 44, 87, '2024-03-12 23:15:25'),
(30, NULL, 45, 88, '2024-03-12 23:19:16'),
(31, NULL, 46, 89, '2024-03-13 00:04:12'),
(32, NULL, 47, 90, '2024-03-13 00:12:47'),
(33, NULL, 48, 91, '2024-03-13 00:40:50'),
(34, NULL, 48, 92, '2024-03-13 00:40:50'),
(35, NULL, 49, 93, '2024-03-15 00:52:32');

--
-- Triggers `helmet_assignment`
--
DELIMITER $$
CREATE TRIGGER `after_insert_helmet_assignment` AFTER INSERT ON `helmet_assignment` FOR EACH ROW BEGIN
    DECLARE company_id_var INT;
    
    -- Get the company ID associated with the new helmet assignment
    SELECT Company_ID INTO company_id_var FROM helmet_assignment WHERE Helmet_AssigningID = NEW.Helmet_AssigningID;
    
    -- Update the number of helmets in the company table
    UPDATE company SET No_of_Helmet = No_Of_Helmet + 1 WHERE Company_id = company_id_var;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Company_ID`);

--
-- Indexes for table `construction_site`
--
ALTER TABLE `construction_site`
  ADD PRIMARY KEY (`site_id`),
  ADD KEY `Foreign Key 7` (`company_id`);

--
-- Indexes for table `emergency alarm system`
--
ALTER TABLE `emergency alarm system`
  ADD PRIMARY KEY (`Alarm_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_ID`),
  ADD KEY `Fk5` (`Company_ID`);

--
-- Indexes for table `falldetection_event`
--
ALTER TABLE `falldetection_event`
  ADD PRIMARY KEY (`FallDetection_Event_ID`);

--
-- Indexes for table `gas_event`
--
ALTER TABLE `gas_event`
  ADD PRIMARY KEY (`Gas_Event_ID`);

--
-- Indexes for table `helmet`
--
ALTER TABLE `helmet`
  ADD PRIMARY KEY (`Helmet_ID`),
  ADD UNIQUE KEY `Uniques` (`Helmet_Unique_Code`);

--
-- Indexes for table `helmet_assignment`
--
ALTER TABLE `helmet_assignment`
  ADD PRIMARY KEY (`Helmet_AssigningID`),
  ADD KEY `Foreign Key 5` (`Employee_ID`),
  ADD KEY `Foreign Key 6` (`Company_ID`),
  ADD KEY `FK10` (`Helmet_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `Company_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `construction_site`
--
ALTER TABLE `construction_site`
  MODIFY `site_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emergency alarm system`
--
ALTER TABLE `emergency alarm system`
  MODIFY `Alarm_ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Employee_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `falldetection_event`
--
ALTER TABLE `falldetection_event`
  MODIFY `FallDetection_Event_ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gas_event`
--
ALTER TABLE `gas_event`
  MODIFY `Gas_Event_ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `helmet`
--
ALTER TABLE `helmet`
  MODIFY `Helmet_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `helmet_assignment`
--
ALTER TABLE `helmet_assignment`
  MODIFY `Helmet_AssigningID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `construction_site`
--
ALTER TABLE `construction_site`
  ADD CONSTRAINT `Foreign Key 7` FOREIGN KEY (`company_id`) REFERENCES `company` (`Company_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `Fk5` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `helmet_assignment`
--
ALTER TABLE `helmet_assignment`
  ADD CONSTRAINT `FK10` FOREIGN KEY (`Helmet_ID`) REFERENCES `helmet` (`Helmet_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Foreign Key 5` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Foreign Key 6` FOREIGN KEY (`Company_ID`) REFERENCES `company` (`Company_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TRIGGER `after_insert_helmet_assignment` AFTER INSERT ON `helmet_assignment`
 FOR EACH ROW BEGIN
    DECLARE company_id_var INT;
    
    -- Get the company ID associated with the new helmet assignment
    SELECT Company_ID INTO company_id_var FROM helmet_assignment WHERE Helmet_AssigningID = NEW.Helmet_AssigningID;
    
    -- Update the number of helmets in the company table
    UPDATE company SET No_of_Helmet = No_Of_Helmet + 1 WHERE Company_id = company_id_var;
END

CREATE TRIGGER `update_assigned_helmets` AFTER INSERT ON `site_assigend_wokers`
 FOR EACH ROW BEGIN
    UPDATE construction_site
    SET assigned_helmets = (
        SELECT COUNT(*)
        FROM site_assigend_wokers
        WHERE site_id = NEW.site_id
    )
    WHERE id = NEW.site_id;
END

CREATE TRIGGER `update_num_workers` AFTER INSERT ON `site_assigend_wokers`
 FOR EACH ROW BEGIN
    UPDATE construction_site
    SET number_of_workers = (
        SELECT COUNT(*)
        FROM site_assigend_wokers
        WHERE site_id = NEW.site_id
    )
    WHERE id = NEW.site_id;
END

CREATE TRIGGER `after_insert_employee` AFTER INSERT ON `site_assigend_wokers`
 FOR EACH ROW BEGIN
    UPDATE employee
    SET assigned = 1
    WHERE Employee_ID = NEW.employee_id;
END

CREATE TRIGGER `after_delete_employee` AFTER DELETE ON `site_assigend_wokers`
 FOR EACH ROW BEGIN
    UPDATE employee
    SET assigned = 0
    WHERE Employee_ID = OLD.employee_id;
END

CREATE TRIGGER clear_related_tables
AFTER DELETE ON company
FOR EACH ROW
BEGIN
    DELETE FROM employee WHERE Company_ID = OLD.Company_ID;
    DELETE FROM construction_site WHERE company_id = OLD.Company_ID; 
    DELETE FROM site_assigend_wokers WHERE Company_ID = OLD.Company_ID; 
    DELETE FROM leave_reporting WHERE Company_ID = OLD.Company_ID;
    DELETE FROM helmet_assignment WHERE Company_ID = OLD.Company_ID;
END;

CREATE TRIGGER `add_employee_to_user` AFTER INSERT ON `employee`
 FOR EACH ROW BEGIN
    DECLARE position_name VARCHAR(255);
    SELECT Position INTO position_name FROM employee WHERE Employee_ID = NEW.Employee_ID;
    IF position_name = 'management' OR position_name = 'supervisor' THEN
        INSERT INTO users (User_Name) VALUES (NEW.Name);
    END IF;
END