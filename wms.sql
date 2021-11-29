-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 21, 2021 at 08:06 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wms`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `iAddressId` int(5) NOT NULL,
  `iUserId` int(5) NOT NULL,
  `vAddressTitle` varchar(128) NOT NULL,
  `vAddressLine1` varchar(128) NOT NULL,
  `vAddressLine2` varchar(128) NOT NULL,
  `iCityId` int(5) NOT NULL,
  `iStateId` int(5) NOT NULL,
  `iCountryId` int(5) NOT NULL,
  `vLatitude` varchar(16) NOT NULL,
  `vLongitude` varchar(16) NOT NULL,
  `iPincode` int(8) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `eDelete` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`iAddressId`, `iUserId`, `vAddressTitle`, `vAddressLine1`, `vAddressLine2`, `iCityId`, `iStateId`, `iCountryId`, `vLatitude`, `vLongitude`, `iPincode`, `eStatus`, `eDelete`) VALUES
(1, 1, '', '01 Madhav Park, opp- Panchavati Park,', 'Gopal chowk road, Nava Naroda, Ahmedabad', 1, 3, 2, '19.0760°', '72.8777°', 382350, 'Active', 'No'),
(4, 8, 'Home Address 01', '01 madhav park', 'new new naroda', 4, 1, 1, '19.0760°', '72.8777°', 223454, 'Active', 'No'),
(5, 8, 'House Address 02', '07 madhav park', 'opp-Shivaji chwok, new naroda', 2, 1, 1, '19.0760°', '72.8777°', 223454, 'Active', 'No'),
(6, 3, 'Home Address', '07 madhav park', 'opp-Shivaji chwok, new naroda', 2, 1, 1, '19.0760°', '72.8777°', 223454, 'Active', 'No'),
(7, 8, 'test adress', 'address', 'address', 1, 3, 2, '19.0760°', '72.8777°', 1, 'Active', 'No'),
(8, 16, 'Home Address', 'A-127, Panchavati Park,', 'opp- Yogi chwok, new surat', 4, 1, 1, '19.0760°', '72.8777°', 564312, 'Active', 'No'),
(9, 18, 'Home Address', '1 madhav park socity, newar raghuvir school', 'gopalchwok, new raroda', 2, 1, 1, '19.0760°', '72.8777°', 382350, 'Active', 'No'),
(10, 20, 'My offfice', 'A01 Patel Industry Park near GLS collage', 'tmp', 2, 1, 1, '19.0760°', '72.8777°', 223454, 'Active', 'No'),
(11, 21, 'My offfice', 'A01 Patel Industry Park near GLS collage', 'New Laldaravaja', 4, 1, 1, '19.0760°', '72.8777°', 223454, 'Active', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `iAgencyId` int(5) NOT NULL,
  `vAgencyCode` varchar(64) NOT NULL,
  `vAgencyName` varchar(64) NOT NULL,
  `vAgencyEmail` varchar(128) NOT NULL,
  `vAgencyRegistrationNo` varchar(128) NOT NULL,
  `iPhoneNo` bigint(10) NOT NULL,
  `vAgencyImage` varchar(512) NOT NULL,
  `vAddressLine1` varchar(128) NOT NULL,
  `vAddressLine2` varchar(128) NOT NULL,
  `iPincode` int(6) NOT NULL,
  `iCityId` int(5) NOT NULL,
  `iStateId` int(5) NOT NULL,
  `iCountryId` int(5) NOT NULL,
  `iOwnerId` int(5) NOT NULL,
  `vOwnerName` varchar(128) NOT NULL,
  `dAddedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eStatus` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`iAgencyId`, `vAgencyCode`, `vAgencyName`, `vAgencyEmail`, `vAgencyRegistrationNo`, `iPhoneNo`, `vAgencyImage`, `vAddressLine1`, `vAddressLine2`, `iPincode`, `iCityId`, `iStateId`, `iCountryId`, `iOwnerId`, `vOwnerName`, `dAddedDate`, `eStatus`) VALUES
(1, 'DH/Agency', 'Dhanani', 'dhanani@yopmail.com', 'AG/00120', 98563241, '21ec6bfcdf1fe32ab10f2121a0dcdb6d.jpg', '1, madhav park, near raghuvir school', 'Gopal chowk, Thakkar nagar', 382350, 2, 1, 1, 9, 'vimalKumar dhanani', '2021-03-16 02:37:55', 'Active'),
(2, 'GE/001', 'Gondalia Enterprise', 'gondaliya.enterprise@yopmail.com', 'GUJ-REG-78901', 88662231, 'efc9d948261edd06605d78f4bb50ceaa.jpg', 'A-20, Sayam sundar nagar', 'opp-Shivaji chwok, new naroda', 382350, 2, 1, 1, 11, 'Kevin Gondaliya', '2021-03-16 09:48:40', 'Active'),
(3, 'patel Agency', 'patel Agency', 'patel.agency@yopmail.com', 'REG/PAt/001/2021', 32456544, 'a1719ebf7794b502c28cafaa84d92386.jpg', 'A01 Patel Industry Park, near GLS collage', 'lal daravaja, surat', 223454, 4, 1, 1, 13, 'parin patel', '2021-03-22 00:30:32', 'Active'),
(4, 'Test/Agency/cod/001', 'test Agency', 'test.agency@yopmail.com', 'TEST/SURAT/001', 87456765, '117ed8c0901b5d538c653c343009c4b1.jpg', 'A01 Alpha Industry Park, near GLS collage', 'lal daravaja, surat', 223454, 4, 1, 1, -1, 'test agency', '2021-03-26 17:03:44', 'Inactive'),
(5, 'MA/GUJ/001', 'Maheta Agency', 'mahetaAgency@yopmail.com', 'maRegNo2021', 86904356, '4a54916469b2160e2b504cacfaf89ea1.jpg', 'A/01 Panchratan Industry Park', 'near- Jivan vadi, nikol', 382345, 2, 1, 1, 19, 'Vimal Maheta', '2021-04-04 00:04:50', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `iCategoryId` int(5) NOT NULL,
  `vCategoryCode` varchar(64) NOT NULL,
  `vCategoryName` varchar(64) NOT NULL,
  `vCategoryImage` varchar(512) NOT NULL,
  `iParentId` int(5) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `eDelete` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`iCategoryId`, `vCategoryCode`, `vCategoryName`, `vCategoryImage`, `iParentId`, `eStatus`, `eDelete`) VALUES
(1, 'Bio', 'Biodegradable', '47ad64649afb5446f783cca96e8ff5e9.png', 0, 'Active', 'No'),
(2, 'Non-Bio', 'Non BioDegradable', 'da81492d1b9470896e6d3c52657581aa.png', 0, 'Active', 'No'),
(5, 'Non-Bio-Plastic', 'Plastic', '8f83cf006269224f78bdbbfae30c39bc.jpg', 2, 'Active', 'No'),
(6, 'Non-Bio-Paper', 'Paper', '03d674bce03a265e0a10d5985e1f23aa.jpg', 2, 'Active', 'No'),
(7, 'Metal', 'Metal', '9f0a468b421bde4bae7ad4e200a787da.jpg', 2, 'Active', 'No'),
(8, 'Test', 'test', '3c9f369c2890d62f11dab1f97acb11bf.jpg', 0, 'Active', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `iCityId` int(5) NOT NULL,
  `vCityCode` varchar(64) NOT NULL,
  `vCityName` varchar(128) NOT NULL,
  `iStateId` int(5) NOT NULL,
  `iCountryId` int(5) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`iCityId`, `vCityCode`, `vCityName`, `iStateId`, `iCountryId`, `eStatus`) VALUES
(1, 'CA01', 'Los Angeles', 3, 2, 'Active'),
(2, 'AH', 'Ahmedabad', 1, 1, 'Active'),
(3, 'MB', 'Mumbai', 2, 1, 'Active'),
(4, 'SU', 'Surat', 1, 1, 'Active'),
(5, 'MN', 'Mehsana', 1, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `color_master`
--

CREATE TABLE `color_master` (
  `iColorId` int(5) NOT NULL,
  `vColorName` varchar(128) NOT NULL,
  `vColorHashCode` varchar(128) NOT NULL,
  `vColorRGB` varchar(128) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color_master`
--

INSERT INTO `color_master` (`iColorId`, `vColorName`, `vColorHashCode`, `vColorRGB`, `eStatus`) VALUES
(1, 'Red', '#ff0001', '255, 0, 1', 'Active'),
(2, 'Blue', '#36a2eb', '54, 162, 235', 'Active'),
(3, 'Yellow', '#ffce56', '255, 206, 86', 'Active'),
(4, 'Green', '#4bc0c0', '75, 192, 192', 'Active'),
(5, 'Purple', '#9966ff', '153, 102, 255', 'Active'),
(6, 'Orange', '#ff9f40', '255, 159, 64', 'Active'),
(31, 'dark green', '#006400', '0,100,0', 'Active'),
(32, 'green', '#008000', '0,128,0', 'Active'),
(33, 'forest green', '#228B22', '34,139,34', 'Active'),
(34, 'lime', '#00FF00', '0,255,0', 'Active'),
(35, 'lime green', '#32CD32', '50,205,50', 'Active'),
(36, 'light green', '#90EE90', '144,238,144', 'Active'),
(37, 'pale green', '#98FB98', '152,251,152', 'Active'),
(38, 'dark sea green', '#8FBC8F', '143,188,143', 'Active'),
(39, 'medium spring green', '#00FA9A', '0,250,154', 'Active'),
(40, 'spring green', '#00FF7F', '0,255,127', 'Active'),
(41, 'sea green', '#2E8B57', '46,139,87', 'Active'),
(42, 'medium aqua marine', '#66CDAA', '102,205,170', 'Active'),
(43, 'medium sea green', '#3CB371', '60,179,113', 'Active'),
(44, 'light sea green', '#20B2AA', '32,178,170', 'Active'),
(45, 'dark slate gray', '#2F4F4F', '47,79,79', 'Active'),
(46, 'teal', '#008080', '0,128,128', 'Active'),
(47, 'dark cyan', '#008B8B', '0,139,139', 'Active'),
(48, 'aqua', '#00FFFF', '0,255,255', 'Active'),
(49, 'cyan', '#00FFFF', '0,255,255', 'Active'),
(50, 'light cyan', '#E0FFFF', '224,255,255', 'Active'),
(51, 'dark turquoise', '#00CED1', '0,206,209', 'Active'),
(52, 'turquoise', '#40E0D0', '64,224,208', 'Active'),
(53, 'medium turquoise', '#48D1CC', '72,209,204', 'Active'),
(54, 'pale turquoise', '#AFEEEE', '175,238,238', 'Active'),
(55, 'aqua marine', '#7FFFD4', '127,255,212', 'Active'),
(56, 'powder blue', '#B0E0E6', '176,224,230', 'Active'),
(57, 'cadet blue', '#5F9EA0', '95,158,160', 'Active'),
(58, 'steel blue', '#4682B4', '70,130,180', 'Active'),
(59, 'corn flower blue', '#6495ED', '100,149,237', 'Active'),
(60, 'deep sky blue', '#00BFFF', '0,191,255', 'Active'),
(61, 'dodger blue', '#1E90FF', '30,144,255', 'Active'),
(62, 'light blue', '#ADD8E6', '173,216,230', 'Active'),
(63, 'sky blue', '#87CEEB', '135,206,235', 'Active'),
(64, 'light sky blue', '#87CEFA', '135,206,250', 'Active'),
(65, 'midnight blue', '#191970', '25,25,112', 'Active'),
(66, 'navy', '#000080', '0,0,128', 'Active'),
(67, 'dark blue', '#00008B', '0,0,139', 'Active'),
(68, 'medium blue', '#0000CD', '0,0,205', 'Active'),
(69, 'blue', '#0000FF', '0,0,255', 'Active'),
(70, 'royal blue', '#4169E1', '65,105,225', 'Active'),
(71, 'blue violet', '#8A2BE2', '138,43,226', 'Active'),
(72, 'indigo', '#4B0082', '75,0,130', 'Active'),
(73, 'dark slate blue', '#483D8B', '72,61,139', 'Active'),
(74, 'slate blue', '#6A5ACD', '106,90,205', 'Active'),
(75, 'medium slate blue', '#7B68EE', '123,104,238', 'Active'),
(76, 'medium purple', '#9370DB', '147,112,219', 'Active'),
(77, 'dark magenta', '#8B008B', '139,0,139', 'Active'),
(78, 'dark violet', '#9400D3', '148,0,211', 'Active'),
(79, 'dark orchid', '#9932CC', '153,50,204', 'Active'),
(80, 'medium orchid', '#BA55D3', '186,85,211', 'Active'),
(81, 'purple', '#800080', '128,0,128', 'Active'),
(82, 'thistle', '#D8BFD8', '216,191,216', 'Active'),
(83, 'plum', '#DDA0DD', '221,160,221', 'Active'),
(84, 'violet', '#EE82EE', '238,130,238', 'Active'),
(85, 'magenta / fuchsia', '#FF00FF', '255,0,255', 'Active'),
(86, 'orchid', '#DA70D6', '218,112,214', 'Active'),
(87, 'medium violet red', '#C71585', '199,21,133', 'Active'),
(88, 'pale violet red', '#DB7093', '219,112,147', 'Active'),
(89, 'deep pink', '#FF1493', '255,20,147', 'Active'),
(90, 'hot pink', '#FF69B4', '255,105,180', 'Active'),
(91, 'light pink', '#FFB6C1', '255,182,193', 'Active'),
(92, 'pink', '#FFC0CB', '255,192,203', 'Active'),
(93, 'antique white', '#FAEBD7', '250,235,215', 'Active'),
(94, 'beige', '#F5F5DC', '245,245,220', 'Active'),
(95, 'bisque', '#FFE4C4', '255,228,196', 'Active'),
(96, 'blanched almond', '#FFEBCD', '255,235,205', 'Active'),
(97, 'wheat', '#F5DEB3', '245,222,179', 'Active'),
(98, 'corn silk', '#FFF8DC', '255,248,220', 'Active'),
(99, 'lemon chiffon', '#FFFACD', '255,250,205', 'Active'),
(100, 'light golden rod yellow', '#FAFAD2', '250,250,210', 'Active'),
(101, 'light yellow', '#FFFFE0', '255,255,224', 'Active'),
(102, 'saddle brown', '#8B4513', '139,69,19', 'Active'),
(103, 'sienna', '#A0522D', '160,82,45', 'Active'),
(104, 'chocolate', '#D2691E', '210,105,30', 'Active'),
(105, 'peru', '#CD853F', '205,133,63', 'Active'),
(106, 'sandy brown', '#F4A460', '244,164,96', 'Active'),
(107, 'burly wood', '#DEB887', '222,184,135', 'Active'),
(108, 'tan', '#D2B48C', '210,180,140', 'Active'),
(109, 'rosy brown', '#BC8F8F', '188,143,143', 'Active'),
(110, 'moccasin', '#FFE4B5', '255,228,181', 'Active'),
(111, 'navajo white', '#FFDEAD', '255,222,173', 'Active'),
(112, 'peach puff', '#FFDAB9', '255,218,185', 'Active'),
(113, 'misty rose', '#FFE4E1', '255,228,225', 'Active'),
(114, 'lavender blush', '#FFF0F5', '255,240,245', 'Active'),
(115, 'linen', '#FAF0E6', '250,240,230', 'Active'),
(116, 'old lace', '#FDF5E6', '253,245,230', 'Active'),
(117, 'papaya whip', '#FFEFD5', '255,239,213', 'Active'),
(118, 'sea shell', '#FFF5EE', '255,245,238', 'Active'),
(119, 'mint cream', '#F5FFFA', '245,255,250', 'Active'),
(120, 'slate gray', '#708090', '112,128,144', 'Active'),
(121, 'light slate gray', '#778899', '119,136,153', 'Active'),
(122, 'light steel blue', '#B0C4DE', '176,196,222', 'Active'),
(123, 'lavender', '#E6E6FA', '230,230,250', 'Active'),
(124, 'floral white', '#FFFAF0', '255,250,240', 'Active'),
(125, 'alice blue', '#F0F8FF', '240,248,255', 'Active'),
(126, 'ghost white', '#F8F8FF', '248,248,255', 'Active'),
(127, 'honeydew', '#F0FFF0', '240,255,240', 'Active'),
(128, 'ivory', '#FFFFF0', '255,255,240', 'Active'),
(129, 'azure', '#F0FFFF', '240,255,255', 'Active'),
(130, 'snow', '#FFFAFA', '255,250,250', 'Active'),
(131, 'black', '#000000', '0,0,0', 'Active'),
(132, 'dim gray / dim grey', '#696969', '105,105,105', 'Active'),
(133, 'gray / grey', '#808080', '128,128,128', 'Active'),
(134, 'dark gray / dark grey', '#A9A9A9', '169,169,169', 'Active'),
(135, 'silver', '#C0C0C0', '192,192,192', 'Active'),
(136, 'light gray / light grey', '#D3D3D3', '211,211,211', 'Active'),
(137, 'gainsboro', '#DCDCDC', '220,220,220', 'Active'),
(138, 'white smoke', '#F5F5F5', '245,245,245', 'Active'),
(139, 'white', '#FFFFFF', '255,255,255', 'Active'),
(140, 'off white', '#FAFAFA', '250,250,250', 'Active'),
(141, 'maroon', '#800000', '128,0,0', 'Active'),
(142, 'dark red', '#8B0000', '139,0,0', 'Active'),
(143, 'brown', '#A52A2A', '165,42,42', 'Active'),
(144, 'firebrick', '#B22222', '178,34,34', 'Active'),
(145, 'crimson', '#DC143C', '220,20,60', 'Active'),
(146, 'red', '#FF0000', '255,0,0', 'Active'),
(147, 'tomato', '#FF6347', '255,99,71', 'Active'),
(148, 'coral', '#FF7F50', '255,127,80', 'Active'),
(149, 'indian red', '#CD5C5C', '205,92,92', 'Active'),
(150, 'light coral', '#F08080', '240,128,128', 'Active'),
(151, 'dark salmon', '#E9967A', '233,150,122', 'Active'),
(152, 'salmon', '#FA8072', '250,128,114', 'Active'),
(153, 'light salmon', '#FFA07A', '255,160,122', 'Active'),
(154, 'orange red', '#FF4500', '255,69,0', 'Active'),
(155, 'dark orange', '#FF8C00', '255,140,0', 'Active'),
(156, 'orange', '#FFA500', '255,165,0', 'Active'),
(157, 'gold', '#FFD700', '255,215,0', 'Active'),
(158, 'dark golden rod', '#B8860B', '184,134,11', 'Active'),
(159, 'golden rod', '#DAA520', '218,165,32', 'Active'),
(160, 'pale golden rod', '#EEE8AA', '238,232,170', 'Active'),
(161, 'dark khaki', '#BDB76B', '189,183,107', 'Active'),
(162, 'khaki', '#F0E68C', '240,230,140', 'Active'),
(163, 'olive', '#808000', '128,128,0', 'Active'),
(164, 'yellow', '#FFFF00', '255,255,0', 'Active'),
(165, 'yellow green', '#9ACD32', '154,205,50', 'Active'),
(166, 'dark olive green', '#556B2F', '85,107,47', 'Active'),
(167, 'olive drab', '#6B8E23', '107,142,35', 'Active'),
(168, 'lawn green', '#7CFC00', '124,252,0', 'Active'),
(169, 'chart reuse', '#7FFF00', '127,255,0', 'Active'),
(170, 'green yellow', '#ADFF2F', '173,255,47', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `configure`
--

CREATE TABLE `configure` (
  `iConfigId` int(3) NOT NULL,
  `vConfigCode` varchar(128) NOT NULL,
  `vConfigValue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configure`
--

INSERT INTO `configure` (`iConfigId`, `vConfigCode`, `vConfigValue`) VALUES
(1, 'min_point_value', '1000'),
(2, 'one_RS_value', '10');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `iCountryId` int(5) NOT NULL,
  `vCountryCode` varchar(64) NOT NULL,
  `vCountryName` varchar(64) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`iCountryId`, `vCountryCode`, `vCountryName`, `eStatus`) VALUES
(1, '91', 'India', 'Active'),
(2, '1', 'United States\r\n', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `iProductId` int(5) NOT NULL,
  `vProductCode` varchar(64) NOT NULL,
  `vProductName` varchar(64) NOT NULL,
  `iCategoryId` int(5) NOT NULL,
  `tDescription` text NOT NULL,
  `vImage` varchar(512) NOT NULL,
  `vProductUnit` varchar(32) NOT NULL,
  `iRewardPoints` int(5) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL,
  `eDelete` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`iProductId`, `vProductCode`, `vProductName`, `iCategoryId`, `tDescription`, `vImage`, `vProductUnit`, `iRewardPoints`, `eStatus`, `eDelete`) VALUES
(1, 'Bio-Wast-001', 'kitchen waste	', 1, 'Kitchen waste is defined as left-over organic matter from restaurants, hotels and households.\r\n', '4494db7f1e434cffbfb2c6861458a178.jpg', 'Kg', 10, 'Active', 'No'),
(2, 'BIO-WAST-002', 'Tree limbs waste', 1, 'Tree limbs waste', '798471d70f14d4a9d2e1dc0cc59ab9fb.jpg', 'Kg', 15, 'Active', 'No'),
(3, 'Milk Bag', 'Plastic Milk bag', 5, 'Plastic Milk bag.', '98076db4310d127cdeea01931bbb3686.jpg', 'Kg', 20, 'Active', 'No'),
(4, 'Oil Ken', 'Oil tin', 7, 'metal Oil tin', '62bdd4ee781b6e5a00d6648f08a0c48a.jpg', 'Piece', 15, 'Active', 'No'),
(5, 'plastic-m02', 'Plastic Cen', 5, 'All Type Of Plastic Cen ', 'e2f5dff2dcda0e42052ec4a9489e7895.jpg', 'Piece', 10, 'Active', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `iRequestId` int(5) NOT NULL,
  `vRequestCode` varchar(128) NOT NULL,
  `iAddedBy` int(5) NOT NULL,
  `iAddressId` int(5) NOT NULL,
  `dtAddedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dtReceivedDate` date NOT NULL,
  `iForeID` int(5) NOT NULL,
  `tRequestDescription` text NOT NULL,
  `eStatus` enum('Pending','Approved','Cancel','Collected','Accept') NOT NULL,
  `vServiceCollection` varchar(16) NOT NULL DEFAULT 'HB@wMS'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`iRequestId`, `vRequestCode`, `iAddedBy`, `iAddressId`, `dtAddedDate`, `dtReceivedDate`, `iForeID`, `tRequestDescription`, `eStatus`, `vServiceCollection`) VALUES
(1, 'REQ/2021/03/000001', 8, 4, '2021-03-28 11:02:18', '2021-03-28', 1, '', 'Collected', 'HB@wMS'),
(2, 'REQ/2021/03/000002', 8, 4, '2021-03-28 11:15:29', '2021-03-28', 1, '', 'Collected', 'HB@wMS'),
(3, 'REQ/2021/03/000003', 8, 4, '2021-03-28 11:16:34', '2021-03-28', 1, '', 'Collected', 'HB@wMS'),
(4, 'REQ/2021/03/000004', 8, 4, '2021-03-28 11:41:08', '2021-03-28', 1, '', 'Collected', 'HB@wMS'),
(5, 'REQ/2021/03/000005', 8, 4, '2021-03-28 17:13:08', '0000-00-00', -1, '', 'Cancel', 'HB@wMS'),
(6, 'REQ/2021/03/000006', 8, 5, '2021-03-29 01:08:01', '2021-03-28', 1, '', 'Collected', 'HB@wMS'),
(7, 'REQ/2021/03/000007', 8, 5, '2021-03-29 10:17:19', '2021-03-29', 1, '', 'Collected', 'HB@wMS'),
(8, 'REQ/2021/03/000008', 3, 6, '2021-03-30 13:28:42', '2021-03-30', 2, '', 'Collected', 'tX=1e.'),
(9, 'REQ/2021/03/000009', 3, 6, '2021-03-30 13:37:31', '2021-03-30', 2, '', 'Collected', '+NA65J'),
(10, 'REQ/2021/03/000010', 3, 6, '2021-03-30 13:33:46', '2021-03-30', 2, '', 'Collected', 'K5;rLo'),
(11, 'REQ/2021/03/000011', 3, 6, '2021-03-30 13:43:12', '2021-03-30', 1, '', 'Collected', '7`^g_@'),
(12, 'REQ/2021/03/000012', 8, 5, '2021-03-30 14:30:28', '0000-00-00', -1, '', 'Cancel', 'HB@wMS'),
(13, 'REQ/2021/03/000013', 8, 5, '2021-03-30 14:34:05', '2021-03-30', 2, '', 'Collected', 'HB@wMS'),
(14, 'REQ/2021/03/000014', 8, 5, '2021-03-30 15:17:41', '2021-03-30', 2, '', 'Collected', '066055'),
(15, 'REQ/2021/03/000015', 8, 5, '2021-03-31 16:43:50', '2021-03-31', 1, '', 'Collected', '818931'),
(16, 'REQ/2021/04/000016', 16, 8, '2021-04-02 23:56:31', '2021-04-02', 3, '', 'Collected', '361951'),
(17, 'REQ/2021/04/000017', 16, 8, '2021-04-03 00:00:01', '2021-04-02', 3, '', 'Collected', '309838'),
(18, 'REQ/2021/04/000018', 18, 9, '2021-04-18 16:27:25', '2021-04-03', 5, '', 'Pending', '595180'),
(19, 'REQ/2021/04/000019', 8, 4, '2021-04-04 12:22:59', '2021-04-04', 2, '', 'Collected', '204428'),
(20, 'REQ/2021/04/000020', 8, 4, '2021-04-04 12:24:22', '2021-04-04', 1, '', 'Collected', '675395'),
(21, 'REQ/2021/04/000021', 18, 9, '2021-04-04 16:27:06', '2021-04-04', 5, '', 'Approved', '720203'),
(22, 'REQ/2021/04/000022', 18, 9, '2021-04-04 21:30:03', '0000-00-00', -1, '', 'Cancel', '837800'),
(23, 'REQ/2021/04/000023', 18, 9, '2021-04-04 21:41:13', '2021-04-04', 1, '', 'Collected', '239158'),
(24, 'REQ/2021/04/000024', 3, 6, '2021-04-04 23:21:04', '2021-04-04', 2, '', 'Collected', '717894'),
(25, 'REQ/2021/04/000025', 20, 10, '2021-04-04 23:59:18', '2021-04-04', 1, '', 'Collected', '359972'),
(26, 'REQ/2021/04/000026', 8, 5, '2021-04-05 14:34:18', '2021-04-05', 1, '', 'Collected', '075005'),
(27, 'REQ/2021/04/000027', 8, 5, '2021-04-11 07:58:32', '0000-00-00', 0, '', 'Pending', '272107'),
(28, 'REQ/2021/04/000028', 3, 6, '2021-04-11 08:01:20', '0000-00-00', 0, '', 'Pending', '060575'),
(29, 'REQ/2021/04/000029', 8, 4, '2021-04-18 16:26:47', '0000-00-00', 0, '', 'Pending', '950273'),
(30, 'REQ/2021/04/000030', 21, 11, '2021-04-11 08:05:51', '0000-00-00', 0, '', 'Pending', '709248'),
(31, 'REQ/2021/04/000031', 21, 11, '2021-04-11 08:07:37', '0000-00-00', 0, '', 'Pending', '972486'),
(32, 'REQ/2021/04/000032', 18, 9, '2021-04-12 07:38:15', '0000-00-00', 0, '', 'Pending', '758713'),
(33, 'REQ/2021/04/000033', 8, 4, '2021-04-13 23:55:22', '0000-00-00', -1, '', 'Cancel', '443110'),
(34, 'REQ/2021/04/000034', 8, 4, '2021-04-19 01:19:32', '0000-00-00', -1, '', 'Cancel', '985462'),
(35, 'REQ/2021/04/000035', 8, 5, '2021-04-19 01:28:38', '0000-00-00', 5, '', 'Approved', '315272'),
(36, 'REQ/2021/04/000036', 18, 9, '2021-04-14 06:27:28', '0000-00-00', 0, '', 'Pending', '552070'),
(37, 'REQ/2021/04/000037', 18, 9, '2021-04-15 00:00:00', '0000-00-00', 0, '', 'Pending', '546118'),
(38, 'REQ/2021/04/000038', 3, 6, '2021-04-19 15:35:51', '0000-00-00', -1, '', 'Cancel', '237698');

-- --------------------------------------------------------

--
-- Table structure for table `request_item`
--

CREATE TABLE `request_item` (
  `iRequestItemId` int(5) NOT NULL,
  `vRequestItemCode` varchar(128) NOT NULL,
  `iRequestId` int(5) NOT NULL,
  `iProductId` int(5) NOT NULL,
  `dQuantity` decimal(10,2) NOT NULL,
  `dReceivedQuantity` decimal(10,2) NOT NULL,
  `dReceivedPoint` decimal(10,2) NOT NULL,
  `vImage` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_item`
--

INSERT INTO `request_item` (`iRequestItemId`, `vRequestItemCode`, `iRequestId`, `iProductId`, `dQuantity`, `dReceivedQuantity`, `dReceivedPoint`, `vImage`) VALUES
(1, 'REQ/2021/03/000001/I1', 1, 1, '1.00', '1.00', '10.00', ''),
(2, 'REQ/2021/03/000002/I1', 2, 1, '1.00', '1.00', '10.00', ''),
(3, 'REQ/2021/03/000003/I1', 3, 1, '1.00', '12.00', '120.00', ''),
(4, 'REQ/2021/03/000004/I1', 4, 2, '12.00', '12.00', '180.00', ''),
(5, 'REQ/2021/03/000004/I2', 4, 3, '2.00', '0.00', '0.00', ''),
(6, 'REQ/2021/03/000005/I1', 5, 1, '0.00', '0.00', '0.00', ''),
(7, 'REQ/2021/03/000006/I1', 6, 1, '17.00', '17.00', '170.00', ''),
(8, 'REQ/2021/03/000006/I2', 6, 4, '12.00', '12.00', '180.00', ''),
(9, 'REQ/2021/03/000007/I1', 7, 3, '120.00', '120.00', '2400.00', ''),
(10, 'REQ/2021/03/000007/I2', 7, 4, '134.00', '134.00', '2010.00', ''),
(11, 'REQ/2021/03/000008/I1', 8, 1, '3.00', '3.00', '30.00', ''),
(12, 'REQ/2021/03/000008/I2', 8, 3, '3.00', '2.00', '40.00', ''),
(13, 'REQ/2021/03/000009/I1', 9, 1, '3.00', '2.00', '20.00', ''),
(14, 'REQ/2021/03/000009/I2', 9, 3, '3.00', '1.00', '20.00', ''),
(15, 'REQ/2021/03/000010/I1', 10, 1, '2.00', '2.00', '20.00', ''),
(16, 'REQ/2021/03/000010/I2', 10, 2, '12.00', '11.00', '165.00', ''),
(17, 'REQ/2021/03/000011/I1', 11, 4, '20.00', '12.00', '180.00', ''),
(18, 'REQ/2021/03/000012/I1', 12, 1, '2.00', '0.00', '0.00', ''),
(19, 'REQ/2021/03/000012/I2', 12, 4, '1.00', '0.00', '0.00', ''),
(20, 'REQ/2021/03/000013/I1', 13, 1, '1.00', '1.00', '10.00', ''),
(21, 'REQ/2021/03/000013/I2', 13, 2, '2.00', '2.00', '30.00', ''),
(22, 'REQ/2021/03/000014/I1', 14, 1, '12.00', '12.00', '120.00', ''),
(23, 'REQ/2021/03/000014/I2', 14, 2, '3.00', '2.00', '30.00', ''),
(24, 'REQ/2021/03/000015/I1', 15, 1, '1.00', '1.00', '10.00', ''),
(25, 'REQ/2021/03/000015/I2', 15, 2, '3.00', '2.00', '30.00', ''),
(26, 'REQ/2021/03/000015/I3', 15, 3, '5.00', '3.00', '60.00', ''),
(27, 'REQ/2021/03/000015/I4', 15, 4, '5.00', '4.00', '60.00', ''),
(28, 'REQ/2021/04/000016/I1', 16, 1, '1.20', '1.20', '12.00', ''),
(29, 'REQ/2021/04/000016/I2', 16, 2, '2.30', '2.30', '34.50', ''),
(30, 'REQ/2021/04/000016/I3', 16, 3, '1.00', '0.50', '10.00', ''),
(31, 'REQ/2021/04/000016/I4', 16, 4, '5.00', '4.00', '60.00', ''),
(32, 'REQ/2021/04/000017/I1', 17, 1, '12.00', '12.00', '120.00', ''),
(33, 'REQ/2021/04/000017/I2', 17, 2, '3.50', '3.50', '52.50', ''),
(34, 'REQ/2021/04/000017/I3', 17, 3, '2.00', '2.00', '40.00', ''),
(35, 'REQ/2021/04/000017/I4', 17, 4, '12.00', '12.00', '180.00', ''),
(36, 'REQ/2021/04/000018/I1', 18, 1, '2.90', '2.90', '29.00', ''),
(37, 'REQ/2021/04/000018/I2', 18, 2, '3.00', '2.00', '30.00', ''),
(38, 'REQ/2021/04/000018/I3', 18, 3, '2.20', '2.40', '48.00', ''),
(39, 'REQ/2021/04/000018/I4', 18, 4, '12.00', '15.30', '229.50', ''),
(40, 'REQ/2021/04/000019/I1', 19, 1, '1.00', '1.20', '12.00', ''),
(41, 'REQ/2021/04/000019/I2', 19, 4, '5.00', '0.00', '0.00', ''),
(42, 'REQ/2021/04/000020/I1', 20, 2, '2.00', '2.00', '30.00', ''),
(43, 'REQ/2021/04/000020/I2', 20, 4, '12.00', '11.00', '165.00', ''),
(44, 'REQ/2021/04/000021/I1', 21, 1, '12.30', '12.00', '120.00', ''),
(45, 'REQ/2021/04/000021/I2', 21, 2, '2.10', '2.50', '37.50', ''),
(46, 'REQ/2021/04/000021/I3', 21, 3, '3.00', '2.00', '40.00', ''),
(47, 'REQ/2021/04/000021/I4', 21, 4, '2.00', '5.00', '75.00', ''),
(48, 'REQ/2021/04/000022/I1', 22, 1, '1.00', '0.00', '0.00', ''),
(49, 'REQ/2021/04/000022/I2', 22, 2, '3.33', '0.00', '0.00', ''),
(50, 'REQ/2021/04/000023/I1', 23, 1, '10.00', '12.00', '120.00', ''),
(51, 'REQ/2021/04/000023/I2', 23, 2, '12.00', '15.00', '225.00', ''),
(52, 'REQ/2021/04/000023/I3', 23, 3, '12.00', '11.00', '220.00', ''),
(53, 'REQ/2021/04/000023/I4', 23, 4, '15.00', '14.00', '210.00', ''),
(54, 'REQ/2021/04/000024/I1', 24, 1, '15.00', '15.00', '150.00', ''),
(55, 'REQ/2021/04/000024/I2', 24, 2, '33.00', '33.00', '495.00', ''),
(56, 'REQ/2021/04/000024/I3', 24, 3, '20.00', '20.00', '400.00', ''),
(57, 'REQ/2021/04/000024/I4', 24, 4, '36.00', '40.00', '600.00', ''),
(58, 'REQ/2021/04/000025/I1', 25, 1, '12.00', '12.00', '120.00', ''),
(59, 'REQ/2021/04/000025/I2', 25, 2, '22.00', '22.00', '330.00', ''),
(60, 'REQ/2021/04/000025/I3', 25, 3, '1.00', '1.00', '20.00', ''),
(61, 'REQ/2021/04/000025/I4', 25, 4, '22.00', '22.00', '330.00', ''),
(62, 'REQ/2021/04/000026/I1', 26, 1, '12.00', '12.00', '120.00', ''),
(63, 'REQ/2021/04/000026/I2', 26, 4, '12.00', '12.00', '180.00', ''),
(64, 'REQ/2021/04/000026/I3', 26, 5, '55.00', '44.00', '440.00', ''),
(65, 'REQ/2021/04/000027/I1', 27, 1, '1.00', '0.00', '0.00', ''),
(66, 'REQ/2021/04/000027/I2', 27, 2, '3.00', '0.00', '0.00', ''),
(67, 'REQ/2021/04/000028/I1', 28, 1, '2.00', '0.00', '0.00', ''),
(68, 'REQ/2021/04/000028/I2', 28, 2, '3.00', '0.00', '0.00', ''),
(69, 'REQ/2021/04/000029/I1', 29, 3, '2.00', '0.00', '0.00', ''),
(70, 'REQ/2021/04/000029/I2', 29, 4, '23.00', '0.00', '0.00', ''),
(71, 'REQ/2021/04/000029/I3', 29, 5, '3.00', '0.00', '0.00', ''),
(72, 'REQ/2021/04/000030/I1', 30, 1, '2.00', '0.00', '0.00', ''),
(73, 'REQ/2021/04/000030/I2', 30, 2, '33.03', '0.00', '0.00', ''),
(74, 'REQ/2021/04/000031/I1', 31, 3, '2.00', '0.00', '0.00', ''),
(75, 'REQ/2021/04/000031/I2', 31, 5, '3.00', '0.00', '0.00', ''),
(76, 'REQ/2021/04/000032/I1', 32, 1, '12.00', '0.00', '0.00', ''),
(77, 'REQ/2021/04/000032/I2', 32, 2, '2.00', '0.00', '0.00', ''),
(78, 'REQ/2021/04/000033/I1', 33, 1, '12.00', '0.00', '0.00', ''),
(79, 'REQ/2021/04/000033/I2', 33, 2, '2.00', '0.00', '0.00', ''),
(80, 'REQ/2021/04/000034/I1', 34, 1, '2.00', '0.00', '0.00', ''),
(81, 'REQ/2021/04/000034/I2', 34, 3, '1.00', '0.00', '0.00', ''),
(82, 'REQ/2021/04/000035/I1', 35, 3, '1.00', '0.00', '0.00', ''),
(83, 'REQ/2021/04/000035/I2', 35, 4, '33.00', '0.00', '0.00', ''),
(84, 'REQ/2021/04/000035/I3', 35, 5, '2.00', '0.00', '0.00', ''),
(85, 'REQ/2021/04/000036/I1', 36, 1, '12.00', '0.00', '0.00', ''),
(86, 'REQ/2021/04/000036/I2', 36, 3, '2.40', '0.00', '0.00', ''),
(87, 'REQ/2021/04/000036/I3', 36, 5, '3.00', '0.00', '0.00', ''),
(88, 'REQ/2021/04/000037/I1', 37, 1, '2.00', '0.00', '0.00', ''),
(89, 'REQ/2021/04/000037/I2', 37, 2, '2.90', '0.00', '0.00', ''),
(90, 'REQ/2021/04/000038/I1', 38, 1, '2.00', '0.00', '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `request_reward`
--

CREATE TABLE `request_reward` (
  `iRequestRewardId` int(5) NOT NULL,
  `vRequestRewardCode` varchar(128) NOT NULL,
  `iRequestId` int(5) NOT NULL,
  `dTotalPoint` decimal(10,2) NOT NULL,
  `iForeId` int(5) NOT NULL,
  `iAgencyId` int(5) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_reward`
--

INSERT INTO `request_reward` (`iRequestRewardId`, `vRequestRewardCode`, `iRequestId`, `dTotalPoint`, `iForeId`, `iAgencyId`, `eStatus`) VALUES
(1, 'REQ/REW/2021/03/000001', 1, '10.00', 8, 1, 'Active'),
(2, 'REQ/REW/2021/03/000002', 2, '10.00', 8, 1, 'Active'),
(3, 'REQ/REW/2021/03/000003', 3, '120.00', 8, 1, 'Active'),
(4, 'REQ/REW/2021/03/000004', 4, '180.00', 8, 1, 'Active'),
(5, 'REQ/REW/2021/03/000005', 6, '350.00', 8, 1, 'Active'),
(6, 'REQ/REW/2021/03/000006', 7, '4410.00', 8, 1, 'Active'),
(7, 'REQ/REW/2021/03/000007', 8, '70.00', 3, 2, 'Active'),
(8, 'REQ/REW/2021/03/000008', 10, '185.00', 3, 2, 'Active'),
(9, 'REQ/REW/2021/03/000009', 9, '40.00', 3, 2, 'Active'),
(10, 'REQ/REW/2021/03/000010', 11, '180.00', 3, 1, 'Active'),
(11, 'REQ/REW/2021/03/000011', 13, '40.00', 8, 2, 'Active'),
(12, 'REQ/REW/2021/03/000012', 14, '150.00', 8, 2, 'Active'),
(13, 'REQ/REW/2021/03/000013', 15, '160.00', 8, 1, 'Active'),
(14, 'REQ/REW/2021/04/000014', 16, '116.50', 16, 3, 'Active'),
(15, 'REQ/REW/2021/04/000015', 17, '392.50', 16, 3, 'Active'),
(16, 'REQ/REW/2021/04/000016', 18, '336.50', 18, 5, 'Active'),
(17, 'REQ/REW/2021/04/000017', 19, '12.00', 8, 2, 'Active'),
(18, 'REQ/REW/2021/04/000018', 20, '210.00', 8, 1, 'Active'),
(19, 'REQ/REW/2021/04/000019', 20, '0.00', 8, 1, 'Active'),
(20, 'REQ/REW/2021/04/000020', 20, '195.00', 8, 1, 'Active'),
(21, 'REQ/REW/2021/04/000021', 21, '272.50', 18, 5, 'Active'),
(22, 'REQ/REW/2021/04/000022', 23, '775.00', 18, 1, 'Active'),
(23, 'REQ/REW/2021/04/000023', 24, '1645.00', 3, 2, 'Active'),
(24, 'REQ/REW/2021/04/000024', 25, '800.00', 20, 1, 'Active'),
(25, 'REQ/REW/2021/04/000025', 26, '740.00', 8, 1, 'Active');

--
-- Triggers `request_reward`
--
DELIMITER $$
CREATE TRIGGER `add_wallet_amount` AFTER INSERT ON `request_reward` FOR EACH ROW UPDATE user SET user.dWalletAmount = user.dWalletAmount + NEW.dTotalPoint WHERE user.iUserId = NEW.iForeId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `iRoleId` int(5) NOT NULL,
  `vRoleName` varchar(128) NOT NULL,
  `vRoleCode` varchar(128) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`iRoleId`, `vRoleName`, `vRoleCode`, `eStatus`) VALUES
(1, 'Admin', 'ADMIN', 'Active'),
(2, 'Agency', 'AGENCY', 'Active'),
(3, 'User', 'USER', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `iStateId` int(5) NOT NULL,
  `vStateCode` varchar(64) NOT NULL,
  `vStateName` varchar(128) NOT NULL,
  `iCountryId` int(5) NOT NULL,
  `eStatus` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`iStateId`, `vStateCode`, `vStateName`, `iCountryId`, `eStatus`) VALUES
(1, 'GJ', 'Gujarat', 1, 'Active'),
(2, 'MH', 'Maharashtra', 1, 'Active'),
(3, 'US01', 'California', 2, 'Active'),
(4, 'US02', 'New Mexico\r\n', 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iUserId` int(5) NOT NULL,
  `vName` varchar(128) NOT NULL,
  `vFirstName` varchar(64) NOT NULL,
  `vLastName` varchar(64) NOT NULL,
  `vEmail` varchar(264) NOT NULL,
  `iMobileNo` bigint(10) NOT NULL,
  `vPassword` varchar(254) NOT NULL,
  `iRoleId` int(5) NOT NULL,
  `dAddedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vUserImage` varchar(256) NOT NULL DEFAULT 'WMS.png',
  `dWalletAmount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `eStatus` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iUserId`, `vName`, `vFirstName`, `vLastName`, `vEmail`, `iMobileNo`, `vPassword`, `iRoleId`, `dAddedDate`, `vUserImage`, `dWalletAmount`, `eStatus`) VALUES
(1, 'ganesh gajanana', 'ganesh', 'gajanana', 'gansesh@yopmail.com', 8460505095, 'e184a89225d57fff1b2502f8988c9637', 3, '2021-03-06 19:05:30', 'WMS.png', '0.00', 'Active'),
(3, 'nirmal dhanani', 'nirmal', 'dhanani', 'nirmal@yopmail.com', 8866331174, '57900ae9aaf4a76fe925dff993db1c0e', 3, '2021-03-06 19:05:30', 'WMS.png', '120.00', 'Active'),
(4, 'HB Hiddenbrains', 'HB', 'Hiddenbrains', 'hb.hiddenbrains@yopmail.com', 9979621968, 'dea75e62b14c2b4afe6d0360c36b96c5', 1, '2021-03-06 19:05:30', '2391fc5160be2b3d8f11f09f116fecc9.jpg', '0.00', 'Active'),
(8, 'ravi prajapati', 'ravi', 'prajapati', 'ravi@yopmail.com', 9879301963, '57900ae9aaf4a76fe925dff993db1c0e', 3, '2021-03-06 19:05:30', '35bc3e69d8a120a7b6a974d8e2e718c5.png', '747.00', 'Active'),
(9, 'vimalKumar dhanani', 'vimalKumar', 'dhanani', 'vimal.agency@yopmail.com', 8460505093, '57900ae9aaf4a76fe925dff993db1c0e', 2, '2021-03-09 23:50:36', '863a4cbff67ddbd3dd11356021f6b57e.png', '0.00', 'Active'),
(10, 'Nirmal dhanani', 'Nirmal', 'dhanani', 'nirmal.agency@yopmail.com', 8866331174, '6dc631a24a794e6bf25497dc5212d16a', 2, '2021-03-11 13:30:00', 'WMS.png', '0.00', 'Active'),
(11, 'Kevin Gondaliya', 'Kevin', 'Gondaliya', 'kevin.gondaliya@yopmail.com', 9879301962, '57900ae9aaf4a76fe925dff993db1c0e', 2, '2021-03-16 09:38:27', 'WMS.png', '0.00', 'Active'),
(12, 'test agency', 'test', 'agency', 'test.agency@yomail.com', 8460505085, '57900ae9aaf4a76fe925dff993db1c0e', 2, '2021-03-16 11:32:53', 'WMS.png', '0.00', 'Active'),
(13, 'parin patel', 'parin', 'patel', 'parin.patel@yopmail.com', 9879301968, '57900ae9aaf4a76fe925dff993db1c0e', 2, '2021-03-21 23:51:10', 'WMS.png', '0.00', 'Active'),
(15, 'Test Syatem', 'Test', 'Syatem', 'test.wms@yopmail.com', 9876566543, '57900ae9aaf4a76fe925dff993db1c0e', 3, '2021-04-01 17:35:13', 'WMS.png', '0.00', 'Active'),
(16, 'Jatin Thummar', 'Jatin', 'Thummar', 'jatin.jb@yopmail.com', 9979621961, '57900ae9aaf4a76fe925dff993db1c0e', 3, '2021-04-02 23:30:16', 'be7dd4e644bb74691f0600c48a1947d3.png', '509.00', 'Active'),
(18, 'Vimalkumar patel', 'Vimalkumar', 'patel', 'vimaldhanani3999@gmail.com', 9979621965, '57900ae9aaf4a76fe925dff993db1c0e', 3, '2021-04-03 23:44:46', '9d1752281881cec1288f72db23e85058.png', '384.00', 'Active'),
(19, 'Vimal Maheta', 'Vimal', 'Maheta', 'maheta.agency@yopmail.com', 8460897654, 'd8a8519a2065493022b86e694ceafc5e', 2, '2021-04-04 00:00:03', 'WMS.png', '0.00', 'Active'),
(20, 'nirmal patel', 'nirmal', 'patel', 'nirmaldhanani88@gmail.com', 8866331178, '57900ae9aaf4a76fe925dff993db1c0e', 3, '2021-04-04 23:55:39', 'WMS.png', '750.00', 'Active'),
(21, 'Jatin Thummar', 'Jatin', 'Thummar', 'jatin@yopmail.com', 8432546779, '', 3, '2021-04-11 23:34:23', 'WMS.png', '0.00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_tempalte_master`
--

CREATE TABLE `user_wallet_tempalte_master` (
  `iWalletTemplateMasterId` int(5) NOT NULL,
  `tTemplate` text NOT NULL,
  `vTempalteCode` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet_tempalte_master`
--

INSERT INTO `user_wallet_tempalte_master` (`iWalletTemplateMasterId`, `tTemplate`, `vTempalteCode`) VALUES
(1, '#AMOUNT# Point #TYPE# from the Request #REQUEST_CODE#', 'credit_by_request'),
(2, '#AMOUNT# Point #TYPE# from the voucher #VOUCHER_NAME# : #VOUCHER_CODE#.', 'debit_by_voucher');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet_transaction`
--

CREATE TABLE `user_wallet_transaction` (
  `iWalletTransactionId` int(5) NOT NULL,
  `vWalletTransactionCode` varchar(256) NOT NULL,
  `iWalletTemplateMasterId` int(5) NOT NULL,
  `iUserId` int(5) NOT NULL,
  `tParams` text NOT NULL,
  `fAmount` int(11) NOT NULL,
  `eStatus` enum('Credit','Debit') NOT NULL,
  `dAddedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet_transaction`
--

INSERT INTO `user_wallet_transaction` (`iWalletTransactionId`, `vWalletTransactionCode`, `iWalletTemplateMasterId`, `iUserId`, `tParams`, `fAmount`, `eStatus`, `dAddedDate`) VALUES
(1, 'WT/2021/03/000001', 1, 8, '{\"AMOUNT\":10,\"TYPE\":\"Credit\",\"REQ_ID\":\"2\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000002\"}', 10, 'Credit', '2021-03-28 08:00:00'),
(2, 'WT/2021/03/000002', 1, 8, '{\"AMOUNT\":120,\"TYPE\":\"Credit\",\"REQ_ID\":\"3\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000003\"}', 120, 'Credit', '2021-03-28 13:00:00'),
(3, 'WT/2021/03/000003', 1, 8, '{\"AMOUNT\":180,\"TYPE\":\"Credit\",\"REQ_ID\":\"4\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000004\"}', 180, 'Credit', '2021-03-28 14:00:00'),
(4, 'WT/2021/03/000004', 1, 8, '{\"AMOUNT\":350,\"TYPE\":\"Credit\",\"REQ_ID\":\"6\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000006\"}', 350, 'Credit', '2021-03-28 19:00:00'),
(5, 'WT/2021/03/000005', 1, 8, '{\"AMOUNT\":4410,\"TYPE\":\"Credit\",\"REQ_ID\":\"7\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000007\"}', 4410, 'Credit', '2021-03-29 03:00:00'),
(6, 'WT/2021/03/000006', 2, 8, '{\"AMOUNT\":1000,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"Ax3a1SXERTG\"}', 1000, 'Debit', '2021-03-29 01:44:48'),
(7, 'WT/2021/03/000007', 1, 3, '{\"AMOUNT\":70,\"TYPE\":\"Credit\",\"REQ_ID\":\"8\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000008\"}', 70, 'Credit', '2021-03-30 09:58:42'),
(8, 'WT/2021/03/000008', 1, 3, '{\"AMOUNT\":185,\"TYPE\":\"Credit\",\"REQ_ID\":\"10\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000010\"}', 185, 'Credit', '2021-03-30 10:03:46'),
(9, 'WT/2021/03/000009', 1, 3, '{\"AMOUNT\":40,\"TYPE\":\"Credit\",\"REQ_ID\":\"9\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000009\"}', 40, 'Credit', '2021-03-30 10:07:31'),
(10, 'WT/2021/03/000010', 1, 3, '{\"AMOUNT\":180,\"TYPE\":\"Credit\",\"REQ_ID\":\"11\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000011\"}', 180, 'Credit', '2021-03-30 10:13:12'),
(11, 'WT/2021/03/000011', 1, 8, '{\"AMOUNT\":40,\"TYPE\":\"Credit\",\"REQ_ID\":\"13\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000013\"}', 40, 'Credit', '2021-03-30 11:04:05'),
(12, 'WT/2021/03/000012', 1, 8, '{\"AMOUNT\":150,\"TYPE\":\"Credit\",\"REQ_ID\":\"14\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000014\"}', 150, 'Credit', '2021-03-30 11:47:41'),
(13, 'WT/2021/03/000013', 2, 8, '{\"AMOUNT\":2000,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"x1aAsERT3D\"}', 2000, 'Debit', '2021-03-30 12:35:16'),
(14, 'WT/2021/03/000014', 2, 8, '{\"AMOUNT\":1400,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"x1aSwERT31C\"}', 1400, 'Debit', '2021-03-30 01:03:08'),
(15, 'WT/2021/03/000015', 1, 8, '{\"AMOUNT\":160,\"TYPE\":\"Credit\",\"REQ_ID\":\"15\",\"REQUEST_CODE\":\"REQ\\/2021\\/03\\/000015\"}', 160, 'Credit', '2021-03-31 01:13:50'),
(16, 'WT/2021/04/000016', 1, 16, '{\"AMOUNT\":116.5,\"TYPE\":\"Credit\",\"REQ_ID\":\"16\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000016\"}', 117, 'Credit', '2021-04-02 08:26:31'),
(17, 'WT/2021/04/000017', 1, 16, '{\"AMOUNT\":392.5,\"TYPE\":\"Credit\",\"REQ_ID\":\"17\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000017\"}', 393, 'Credit', '2021-04-02 08:30:01'),
(18, 'WT/2021/04/000018', 1, 18, '{\"AMOUNT\":336.5,\"TYPE\":\"Credit\",\"REQ_ID\":\"18\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000018\"}', 337, 'Credit', '2021-04-03 09:01:08'),
(19, 'WT/2021/04/000019', 1, 8, '{\"AMOUNT\":12,\"TYPE\":\"Credit\",\"REQ_ID\":\"19\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000019\"}', 12, 'Credit', '2021-04-04 08:52:59'),
(20, 'WT/2021/04/000020', 1, 8, '{\"AMOUNT\":210,\"TYPE\":\"Credit\",\"REQ_ID\":\"20\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000020\"}', 210, 'Credit', '2021-04-04 08:54:22'),
(21, 'WT/2021/04/000021', 1, 8, '{\"AMOUNT\":0,\"TYPE\":\"Credit\",\"REQ_ID\":\"20\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000020\"}', 0, 'Credit', '2021-04-04 08:55:36'),
(22, 'WT/2021/04/000022', 1, 8, '{\"AMOUNT\":195,\"TYPE\":\"Credit\",\"REQ_ID\":\"20\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000020\"}', 195, 'Credit', '2021-04-04 08:56:04'),
(23, 'WT/2021/04/000023', 1, 18, '{\"AMOUNT\":272.5,\"TYPE\":\"Credit\",\"REQ_ID\":\"21\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000021\"}', 273, 'Credit', '2021-04-04 05:55:40'),
(24, 'WT/2021/04/000024', 1, 18, '{\"AMOUNT\":775,\"TYPE\":\"Credit\",\"REQ_ID\":\"23\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000023\"}', 775, 'Credit', '2021-04-04 06:11:13'),
(25, 'WT/2021/04/000025', 2, 8, '{\"AMOUNT\":1200,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Product Voucher\",\"VOUCHER_CODE\":\"Ax1aSwERTG\"}', 1200, 'Debit', '2021-04-04 07:33:16'),
(26, 'WT/2021/04/000026', 1, 3, '{\"AMOUNT\":1645,\"TYPE\":\"Credit\",\"REQ_ID\":\"24\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000024\"}', 1645, 'Credit', '2021-04-04 07:51:04'),
(27, 'WT/2021/04/000027', 2, 3, '{\"AMOUNT\":1000,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"OTDlgsEwVK\"}', 1000, 'Debit', '2021-04-04 07:53:06'),
(28, 'WT/2021/04/000028', 2, 3, '{\"AMOUNT\":1000,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"zLiDTe6Gcw\"}', 1000, 'Debit', '2021-04-04 08:15:14'),
(29, 'WT/2021/04/000029', 1, 20, '{\"AMOUNT\":800,\"TYPE\":\"Credit\",\"REQ_ID\":\"25\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000025\"}', 800, 'Credit', '2021-04-04 08:29:18'),
(30, 'WT/2021/04/000030', 2, 20, '{\"AMOUNT\":50,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"s4wDN4L6E8\"}', 50, 'Debit', '2021-04-04 08:30:01'),
(31, 'WT/2021/04/000031', 2, 8, '{\"AMOUNT\":40,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"CMYdpu0fSJ\"}', 40, 'Debit', '2021-04-04 08:43:39'),
(32, 'WT/2021/04/000032', 2, 8, '{\"AMOUNT\":80,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"WiCNtMz7Pd\"}', 80, 'Debit', '2021-04-04 08:59:10'),
(33, 'WT/2021/04/000033', 2, 8, '{\"AMOUNT\":120,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"qGEvZVYHvW\"}', 120, 'Debit', '2021-04-04 09:04:07'),
(34, 'WT/2021/04/000034', 2, 18, '{\"AMOUNT\":1000,\"TYPE\":\"Debit\",\"VOUCHER_NAME\":\"Gift Voucher\",\"VOUCHER_CODE\":\"PAjHjckhnF\"}', 1000, 'Debit', '2021-04-04 09:13:44'),
(35, 'WT/2021/04/000035', 1, 8, '{\"AMOUNT\":740,\"TYPE\":\"Credit\",\"REQ_ID\":\"26\",\"REQUEST_CODE\":\"REQ\\/2021\\/04\\/000026\"}', 740, 'Credit', '2021-04-05 11:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `iVoucherId` int(5) NOT NULL,
  `vVoucherCode` varchar(128) NOT NULL,
  `vVoucherName` varchar(128) NOT NULL,
  `dVoucherPrice` int(11) NOT NULL,
  `vVoucherImage` varchar(128) NOT NULL,
  `eStatus` enum('read','unread') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`iVoucherId`, `vVoucherCode`, `vVoucherName`, `dVoucherPrice`, `vVoucherImage`, `eStatus`) VALUES
(1, 'Ax1aSwERTG', 'Product Voucher', 120, 'product.png', 'read'),
(2, 'Ax1aSwERT3D', 'Price Voucher', 510, 'price.png', 'unread'),
(3, 'Ax3a1SXERTG', 'Gift Voucher', 100, 'gift.png', 'read'),
(4, 'x1aSwERT31C', 'Gift Voucher', 140, 'gift.jpg', 'read'),
(5, 'x1aAsERT3D', 'Gift Voucher', 200, 'discount.png', 'read'),
(6, 'Wg7eSBW7qf', 'Product Voucher', 230, 'product.png', 'unread'),
(7, 'qGEvZVYHvQ', 'Price Voucher', 999, 'price.png', 'unread'),
(8, 'PAjHjckhnF', 'Gift Voucher', 100, 'gift.png', 'read'),
(9, 'UCjJJ6HjMY', 'Discount Voucher', 155, 'discount.png', 'unread'),
(10, 'l0ELJ92w0W', 'Product Voucher', 154, 'product.png', 'unread'),
(11, '6bPU5YT9uk', 'Price Voucher', 1000, 'price.png', 'unread'),
(12, 'zLiDTe6Gcw', 'Gift Voucher', 100, 'gift.png', 'read'),
(13, 'OTDlgsEwVK', 'Gift Voucher', 100, 'gift.png', 'read'),
(14, 'WiCNtMz7Pd', 'Gift Voucher', 8, 'gift.png', 'read'),
(15, 'CMYdpu0fSJ', 'Gift Voucher', 4, 'gift.png', 'read'),
(16, 's4wDN4L6E8', 'Gift Voucher', 5, 'gift.png', 'read'),
(18, 'qGEvZVYHvW', 'Gift Voucher', 12, 'gift.png', 'read');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`iAddressId`);

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`iAgencyId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`iCategoryId`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`iCityId`);

--
-- Indexes for table `color_master`
--
ALTER TABLE `color_master`
  ADD PRIMARY KEY (`iColorId`);

--
-- Indexes for table `configure`
--
ALTER TABLE `configure`
  ADD PRIMARY KEY (`iConfigId`),
  ADD UNIQUE KEY `vConfigCode` (`vConfigCode`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`iCountryId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`iProductId`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`iRequestId`);

--
-- Indexes for table `request_item`
--
ALTER TABLE `request_item`
  ADD PRIMARY KEY (`iRequestItemId`);

--
-- Indexes for table `request_reward`
--
ALTER TABLE `request_reward`
  ADD PRIMARY KEY (`iRequestRewardId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`iRoleId`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`iStateId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iUserId`);

--
-- Indexes for table `user_wallet_tempalte_master`
--
ALTER TABLE `user_wallet_tempalte_master`
  ADD PRIMARY KEY (`iWalletTemplateMasterId`),
  ADD UNIQUE KEY `vTempalteCode` (`vTempalteCode`);

--
-- Indexes for table `user_wallet_transaction`
--
ALTER TABLE `user_wallet_transaction`
  ADD PRIMARY KEY (`iWalletTransactionId`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`iVoucherId`),
  ADD UNIQUE KEY `vVoucherCode` (`vVoucherCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `iAddressId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `iAgencyId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `iCategoryId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `iCityId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `color_master`
--
ALTER TABLE `color_master`
  MODIFY `iColorId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `configure`
--
ALTER TABLE `configure`
  MODIFY `iConfigId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `iCountryId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `iProductId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `iRequestId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `request_item`
--
ALTER TABLE `request_item`
  MODIFY `iRequestItemId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `request_reward`
--
ALTER TABLE `request_reward`
  MODIFY `iRequestRewardId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `iRoleId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `iStateId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iUserId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_wallet_tempalte_master`
--
ALTER TABLE `user_wallet_tempalte_master`
  MODIFY `iWalletTemplateMasterId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_wallet_transaction`
--
ALTER TABLE `user_wallet_transaction`
  MODIFY `iWalletTransactionId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `iVoucherId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
