-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2014 at 12:20 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `barterlabs`
--
CREATE DATABASE IF NOT EXISTS `barterlabs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `barterlabs`;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` text,
  `url_name` text,
  `page_content` text,
  `page_title` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page_name`, `url_name`, `page_content`, `page_title`, `created`, `modified`) VALUES
(4, 'test1', 'test2', '<p>test4</p>', 'test3', '2014-04-01 02:29:40', '2014-04-01 02:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE IF NOT EXISTS `labs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hot` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `projectname` varchar(80) DEFAULT NULL,
  `catalyst` smallint(1) DEFAULT NULL,
  `labdesc` text,
  `link` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;



-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=410 ;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `user_id`, `token`, `duration`, `used`, `created`, `expires`) VALUES
(344, 1, '01197a323ae4f8cacdd437c638768fd4', '2 weeks', 0, '2014-04-08 15:45:33', '2014-04-22 15:45:33'),
(358, 3, '821e75c1c0ed31e4839d2d72d4746a8f', '2 weeks', 0, '2014-04-14 14:14:38', '2014-04-28 14:14:38'),
(322, 16, '08429fa7d46d8937ee4d6d8ffae2c19e', '2 weeks', 0, '2014-04-01 00:24:10', '2014-04-15 00:24:10'),
(409, 2, '87c970dc6b4b2093444dd9d923f7d0e1', '2 weeks', 0, '2014-05-06 00:13:46', '2014-05-20 00:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE IF NOT EXISTS `pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text,
  `tag` varchar(255) DEFAULT NULL,
  `isdisp` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;



-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(55) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;



-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illinois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(26, 'Montana'),
(27, 'Nebraska'),
(28, 'Nevada'),
(29, 'New Hampshire'),
(30, 'New Jersey'),
(31, 'New Mexico'),
(32, 'New York'),
(33, 'North Carolina'),
(34, 'North Dakota'),
(35, 'Ohio'),
(36, 'Oklahoma'),
(37, 'Oregon'),
(38, 'Pennsylvania'),
(39, 'Rhode Island'),
(40, 'South Carolina'),
(41, 'South Dakota'),
(42, 'Tennessee'),
(43, 'Texas'),
(44, 'Utah'),
(45, 'Vermont'),
(46, 'Virginia'),
(47, 'Washington'),
(48, 'West Virginia'),
(49, 'Wisconsin'),
(50, 'Wyoming'),
(51, 'District of Columbia');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_emails`
--

CREATE TABLE IF NOT EXISTS `tmp_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE IF NOT EXISTS `towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `stateab` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=463 ;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `name`, `state`, `stateab`) VALUES
(1, 'Auburn', 'Alabama', 'AL'),
(2, 'Birmingham', 'Alabama', 'AL'),
(3, 'Dothan', 'Alabama', 'AL'),
(4, 'Florence', 'Alabama', 'AL'),
(5, 'Muscle Shoals', 'Alabama', 'AL'),
(6, 'Gadsden-Anniston', 'Alabama', 'AL'),
(7, 'Huntsville', 'Alabama', 'AL'),
(8, 'Decatur', 'Alabama', 'AL'),
(9, 'Mobile', 'Alabama', 'AL'),
(10, 'Montgomery', 'Alabama', 'AL'),
(11, 'Tuscaloosa', 'Alabama', 'AL'),
(12, 'Anchorage', 'Alaska', 'AK'),
(13, 'Fairbanks', 'Alaska', 'AK'),
(14, 'Kenai Peninsula', 'Alaska', 'AK'),
(15, 'Southeast Alaska', 'Alaska', 'AK'),
(16, 'Flagstaff', 'Arizona', 'AZ'),
(17, 'Mohave County', 'Arizona', 'AZ'),
(18, 'Phoenix', 'Arizona', 'AZ'),
(19, 'Prescott', 'Arizona', 'AZ'),
(20, 'Show Low', 'Arizona', 'AZ'),
(21, 'Sierra Vista', 'Arizona', 'AZ'),
(22, 'Tucson', 'Arizona', 'AZ'),
(23, 'Yuma', 'Arizona', 'AZ'),
(24, 'Fayetteville', 'Arkansas', 'AR'),
(25, 'Fort Smith', 'Arkansas', 'AR'),
(26, 'Jonesboro', 'Arkansas', 'AR'),
(27, 'Little Rock', 'Arkansas', 'AR'),
(28, 'Texarkana', 'Arkansas', 'AR'),
(29, 'Bakersfield', 'California', 'CA'),
(30, 'Chico', 'California', 'CA'),
(31, 'Fresno', 'California', 'CA'),
(32, 'Madera', 'California', 'CA'),
(33, 'Gold Country', 'California', 'CA'),
(34, 'Hanford', 'California', 'CA'),
(35, 'Corcoran', 'California', 'CA'),
(36, 'Humboldt County', 'California', 'CA'),
(37, 'Imperial County', 'California', 'CA'),
(38, 'Inland Empire', 'California', 'CA'),
(39, 'Los Angeles', 'California', 'CA'),
(40, 'Mendocino County', 'California', 'CA'),
(41, 'Merced', 'California', 'CA'),
(42, 'Modesto', 'California', 'CA'),
(43, 'Moterey Bay', 'California', 'CA'),
(44, 'Orange County', 'California', 'CA'),
(45, 'Palm Springs', 'California', 'CA'),
(46, 'Redding', 'California', 'CA'),
(47, 'Sacramento', 'California', 'CA'),
(48, 'San Diego', 'California', 'CA'),
(49, 'San Francisco', 'California', 'CA'),
(50, 'Bay Area', 'California', 'CA'),
(51, 'San Luis Obispo', 'California', 'CA'),
(52, 'Santa Barbara', 'California', 'CA'),
(53, 'Santa Maria', 'California', 'CA'),
(54, 'Siskiyou County', 'California', 'CA'),
(55, 'Stockton', 'California', 'CA'),
(56, 'Susanville', 'California', 'CA'),
(57, 'Ventura County', 'California', 'CA'),
(58, 'Visalia', 'California', 'CA'),
(59, 'Tulare', 'California', 'CA'),
(60, 'Yuba', 'California', 'CA'),
(61, 'Sutter', 'California', 'CA'),
(62, 'Boulder', 'Colorado', 'CO'),
(63, 'Colorado Springs', 'Colorado', 'CO'),
(64, 'Denver', 'Colorado', 'CO'),
(65, 'Eastern CO', 'Colorado', 'CO'),
(66, 'Fort Collins', 'Colorado', 'CO'),
(67, 'North Colorado', 'Colorado', 'CO'),
(68, 'High Rockies', 'Colorado', 'CO'),
(69, 'Pueblo', 'Colorado', 'CO'),
(70, 'Western Slope', 'Colorado', 'CO'),
(71, 'Eastern CT', 'Connecticut', 'CT'),
(72, 'Hartford', 'Connecticut', 'CT'),
(73, 'New Haven', 'Connecticut', 'CT'),
(74, 'Northwest CT', 'Connecticut', 'CT'),
(75, 'Delaware', 'Delaware', 'DE'),
(76, 'Washington', 'District of Columbia', 'DC'),
(77, 'Daytona Beach', 'Florida', 'FL'),
(78, 'Florida Keys', 'Florida', 'FL'),
(79, 'Fort Lauderdale', 'Florida', 'FL'),
(80, 'Ft Myers', 'Florida', 'FL'),
(81, 'Gainsville', 'Florida', 'FL'),
(82, 'Heartland', 'Florida', 'FL'),
(83, 'Jacksonville', 'Florida', 'FL'),
(84, 'Lakeland', 'Florida', 'FL'),
(85, 'Ocala', 'Florida', 'FL'),
(86, 'Okaloosa', 'Florida', 'FL'),
(87, 'Walton', 'Florida', 'FL'),
(88, 'Orlando', 'Florida', 'FL'),
(89, 'Panama City', 'Florida', 'FL'),
(90, 'Tampa Bay', 'Florida', 'FL'),
(91, 'Sarasota', 'Florida', 'FL'),
(92, 'Space Coast', 'Florida', 'FL'),
(93, 'St Augustine', 'Florida', 'FL'),
(94, 'Tallahassee', 'Florida', 'FL'),
(95, 'Treasure Coast', 'Florida', 'FL'),
(96, 'West Palm Beach', 'Florida', 'FL'),
(97, 'Albany', 'Georgia', 'GA'),
(98, 'Athens', 'Georgia', 'GA'),
(99, 'Atlanta', 'Georgia', 'GA'),
(100, 'Augusta', 'Georgia', 'GA'),
(101, 'Brunswick', 'Georgia', 'GA'),
(102, 'Columbus', 'Georgia', 'GA'),
(103, 'Macon', 'Georgia', 'GA'),
(104, 'Savannah', 'Georgia', 'GA'),
(105, 'Statesboro', 'Georgia', 'GA'),
(106, 'Valdosta', 'Georgia', 'GA'),
(107, 'Hawaii', 'Hawaii', 'HI'),
(108, 'Boise', 'Idaho', 'ID'),
(109, 'Lewiston', 'Idaho', 'ID'),
(110, 'Clarkston', 'Idaho', 'ID'),
(111, 'Twin Falls', 'Idaho', 'ID'),
(112, 'Coeur d Alene', 'Idaho', 'ID'),
(113, 'Bloomington', 'Illinois', 'IL'),
(114, 'Normal', 'Illinois', 'IL'),
(115, 'Champaign Urbana', 'Illinois', 'IL'),
(116, 'Chicago', 'Illinois', 'IL'),
(117, 'Decatur', 'Illinois', 'IL'),
(118, 'La Salle Co', 'Illinois', 'IL'),
(119, 'Mattoon', 'Illinois', 'IL'),
(120, 'Charleston', 'Illinois', 'IL'),
(121, 'Peoria', 'Illinois', 'IL'),
(122, 'Rockford', 'Illinois', 'IL'),
(123, 'Springfield', 'Illinois', 'IL'),
(124, 'Bloomington', 'Indiana', 'IN'),
(125, 'Evansville', 'Indiana', 'IN'),
(126, 'Fort Wayne', 'Indiana', 'IN'),
(127, 'Indianapolis', 'Indiana', 'IN'),
(128, 'Kokomo', 'Indiana', 'IN'),
(129, 'Lafayette', 'Indiana', 'IN'),
(130, 'Muncie', 'Indiana', 'IN'),
(131, 'Richmond', 'Indiana', 'IN'),
(132, 'South Bend', 'Indiana', 'IN'),
(133, 'Terre Haute', 'Indiana', 'IN'),
(134, 'Ames', 'Iowa', 'IA'),
(135, 'Cedar Rapids', 'Iowa', 'IA'),
(136, 'Des Moines', 'Iowa', 'IA'),
(137, 'Dubuque', 'Iowa', 'IA'),
(138, 'Fort Dodge', 'Iowa', 'IA'),
(139, 'Iowa City', 'Iowa', 'IA'),
(140, 'Mason City', 'Iowa', 'IA'),
(141, 'Quad Cities', 'Iowa', 'IA'),
(142, 'Sioux City', 'Iowa', 'IA'),
(143, 'Waterloo', 'Iowa', 'IA'),
(144, 'Cedar Falls', 'Iowa', 'IA'),
(145, 'Lawrence', 'Kansas', 'KS'),
(146, 'Manhattan', 'Kansas', 'KS'),
(147, 'Salina', 'Kansas', 'KS'),
(148, 'Topeka', 'Kansas', 'KS'),
(149, 'Wichita', 'Kansas', 'KS'),
(150, 'Bowling Green', 'Kentucky', 'KY'),
(151, 'Lexington', 'Kentucky', 'KY'),
(152, 'Louisville', 'Kentucky', 'KY'),
(153, 'Owensboro', 'Kentucky', 'KY'),
(154, 'Baton Rouge', 'Louisiana', 'LA'),
(155, 'Houma', 'Louisiana', 'LA'),
(156, 'Lake Charles', 'Louisiana', 'LA'),
(157, 'Monroe', 'Louisiana', 'LA'),
(158, 'New Orleans', 'Louisiana', 'LA'),
(159, 'Shreveport', 'Louisiana', 'LA'),
(160, 'Augusta', 'Maine', 'ME'),
(161, 'Portland', 'Maine', 'ME'),
(162, 'Bangor', 'Maine', 'ME'),
(163, 'Lewiston', 'Maine', 'ME'),
(164, 'Presque Isle', 'Maine', 'ME'),
(165, 'Caribou', 'Maine', 'ME'),
(166, 'Annapolis', 'Maryland', 'MD'),
(167, 'Baltimore', 'Maryland', 'MD'),
(168, 'Eastern Shore', 'Maryland', 'MD'),
(169, 'Frederick', 'Maryland', 'MD'),
(170, 'Boston', 'Massachusettes', 'MA'),
(171, 'Cape Cod', 'Massachusettes', 'MA'),
(172, 'South Coast', 'Massachusettes', 'MA'),
(173, 'Worcester', 'Massachusettes', 'MA'),
(174, 'Ann Arbor', 'Michigan', 'MI'),
(175, 'Battle Creek', 'Michigan', 'MI'),
(176, 'Detroit', 'Michigan', 'MI'),
(177, 'Flint', 'Michigan', 'MI'),
(178, 'Grand Rapids', 'Michigan', 'MI'),
(179, 'Holland', 'Michigan', 'MI'),
(180, 'Jackson', 'Michigan', 'MI'),
(181, 'Kalamazoo', 'Michigan', 'MI'),
(182, 'Lansing', 'Michigan', 'MI'),
(183, 'Monroe', 'Michigan', 'MI'),
(184, 'Muskegon', 'Michigan', 'MI'),
(185, 'Port Huron', 'Michigan', 'MI'),
(186, 'Saginaw', 'Michigan', 'MI'),
(187, 'Midland', 'Michigan', 'MI'),
(188, 'Bay City', 'Michigan', 'MI'),
(189, 'The Thumb', 'Michigan', 'MI'),
(190, 'Bemidji', 'Minnesota', 'MN'),
(191, 'Brainerd', 'Minnesota', 'MN'),
(192, 'Duluth', 'Minnesota', 'MN'),
(193, 'Superior', 'Minnesota', 'MN'),
(194, 'Mankato', 'Minnesota', 'MN'),
(195, 'Minneapolis / St Paul', 'Minnesota', 'MN'),
(196, 'Rochester', 'Minnesota', 'MN'),
(197, 'St Doud', 'Minnesota', 'MN'),
(198, 'Gulfport', 'Mississippi', 'MS'),
(199, 'Biloxi', 'Mississippi', 'MS'),
(200, 'Hattiesburg', 'Mississippi', 'MS'),
(201, 'Jackson', 'Mississippi', 'MS'),
(202, 'Meridian', 'Mississippi', 'MS'),
(203, 'Columbia', 'Missouri', 'MO'),
(204, 'Jeff City', 'Missouri', 'MO'),
(205, 'Joplin', 'Missouri', 'MO'),
(206, 'Kansas City', 'Missouri', 'MO'),
(207, 'Kirksville', 'Missouri', 'MO'),
(208, 'lake of the Ozarks', 'Missouri', 'MO'),
(209, 'Springfield', 'Missouri', 'MO'),
(210, 'St Joseph', 'Missouri', 'MO'),
(211, 'St Louis', 'Missouri', 'MO'),
(212, 'Billings', 'Montana', 'MT'),
(213, 'Bozeman', 'Montana', 'MT'),
(214, 'Butte', 'Montana', 'MT'),
(215, 'Great Falls', 'Montana', 'MT'),
(216, 'Helena', 'Montana', 'MT'),
(217, 'Kalispell', 'Montana', 'MT'),
(218, 'Missoula', 'Montana', 'MT'),
(219, 'Eastern Montana', 'Montana', 'MT'),
(220, 'Grand Island', 'Nebraska', 'NE'),
(221, 'Lincoln', 'Nebraska', 'NE'),
(222, 'North Platte', 'Nebraska', 'NE'),
(223, 'Omaha', 'Nebraska', 'NE'),
(224, 'Council Bluffs', 'Nebraska', 'NE'),
(225, 'Scottsbluff', 'Nebraska', 'NE'),
(226, 'Panhandle', 'Nebraska', 'NE'),
(227, 'Elko', 'Nevada', 'NV'),
(228, 'Las Vegas', 'Nevada', 'NV'),
(229, 'Reno', 'Nevada', 'NV'),
(230, 'Tahoe', 'Nevada', 'NV'),
(231, 'Manchester', 'New Hampshire', 'NH'),
(232, 'Nashua', 'New Hampshire', 'NH'),
(233, 'Concord', 'New Hampshire', 'NH'),
(234, 'Rochester', 'New Hampshire', 'NH'),
(235, 'Salem', 'New Hampshire', 'NH'),
(236, 'Newark', 'New Jersey', 'NJ'),
(237, 'Jersey City', 'New Jersey', 'NJ'),
(238, 'Paterson', 'New Jersey', 'NJ'),
(239, 'Princeton', 'New Jersey', 'NJ'),
(240, 'Elizabeth', 'New Jersey', 'NJ'),
(241, 'Edison', 'New Jersey', 'NJ'),
(242, 'Toms River', 'New Jersey', 'NJ'),
(243, 'Trenton', 'New Jersey', 'NJ'),
(244, 'Albuquerque', 'New Mexico', 'NM'),
(245, 'Dovis / Portales', 'New Mexico', 'NM'),
(246, 'Farmington', 'New Mexico', 'NM'),
(247, 'Las Cruces', 'New Mexico', 'NM'),
(248, 'Roswell', 'New Mexico', 'NM'),
(249, 'Carlsbad', 'New Mexico', 'NM'),
(250, 'Santa Fe', 'New Mexico', 'NM'),
(251, 'Taos', 'New Mexico', 'NM'),
(252, 'Albany', 'New York', 'NY'),
(253, 'Binghamton', 'New York', 'NY'),
(254, 'Buffalo', 'New York', 'NY'),
(255, 'Catskills', 'New York', 'NY'),
(256, 'Chautauqua', 'New York', 'NY'),
(257, 'Elmira-Corning', 'New York', 'NY'),
(258, 'Glens Falls', 'New York', 'NY'),
(259, 'Hudson Valley', 'New York', 'NY'),
(260, 'Ithaca', 'New York', 'NY'),
(261, 'Long Island', 'New York', 'NY'),
(262, 'New York City', 'New York', 'NY'),
(263, 'Oneonta', 'New York', 'NY'),
(264, 'Plattsburgh-Adirondacks', 'New York', 'NY'),
(265, 'Potsdam-Canton-Messena', 'New York', 'NY'),
(266, 'Rochester', 'New York', 'NY'),
(267, 'Syracuse', 'New York', 'NY'),
(268, 'Twin Tiers', 'New York', 'NY'),
(269, 'Utica-Rome-Oneida', 'New York', 'NY'),
(270, 'Finger Lakes', 'New York', 'NY'),
(271, 'Watertown', 'New York', 'NY'),
(272, 'Asheville', 'North Carolina', 'NC'),
(273, 'Boone', 'North Carolina', 'NC'),
(274, 'Charlotte', 'North Carolina', 'NC'),
(275, 'Fayetteville', 'North Carolina', 'NC'),
(276, 'Greensboro', 'North Carolina', 'NC'),
(277, 'Hickory', 'North Carolina', 'NC'),
(278, 'Lenoir', 'North Carolina', 'NC'),
(279, 'Jacksonville', 'North Carolina', 'NC'),
(280, 'Outer Banks', 'North Carolina', 'NC'),
(281, 'Raleigh / Durham', 'North Carolina', 'NC'),
(282, 'Wilmington', 'North Carolina', 'NC'),
(283, 'Winston-Salem', 'North Carolina', 'NC'),
(284, 'Bismarck', 'North Dakota', 'ND'),
(285, 'Fargo / Moorehead', 'North Dakota', 'ND'),
(286, 'Grand Forks', 'North Dakota', 'ND'),
(287, 'Akron / Canton', 'Ohio', 'OH'),
(288, 'Ashtabula', 'Ohio', 'OH'),
(289, 'Athens', 'Ohio', 'OH'),
(290, 'Chillicothe', 'Ohio', 'OH'),
(291, 'Cincinnati', 'Ohio', 'OH'),
(292, 'Cleveland', 'Ohio', 'OH'),
(293, 'Columbus', 'Ohio', 'OH'),
(294, 'Dayton / Springfield', 'Ohio', 'OH'),
(295, 'Lima / Findlay', 'Ohio', 'OH'),
(296, 'Mansfield', 'Ohio', 'OH'),
(297, 'Sandusky', 'Ohio', 'OH'),
(298, 'Toledo', 'Ohio', 'OH'),
(299, 'Tuscarawas', 'Ohio', 'OH'),
(300, 'Youngstown', 'Ohio', 'OH'),
(301, 'Zanesville / Cambridge', 'Ohio', 'OH'),
(302, 'Lawton', 'Oklahoma', 'OK'),
(303, 'Oklahoma City', 'Oklahoma', 'OK'),
(304, 'Stillwater', 'Oklahoma', 'OK'),
(305, 'Tulsa', 'Oklahoma', 'OK'),
(306, 'Bend', 'Oregon', 'OR'),
(307, 'Corvallis / Albany', 'Oregon', 'OR'),
(308, 'Eugene', 'Oregon', 'OR'),
(309, 'Klamath Falls', 'Oregon', 'OR'),
(310, 'Medford', 'Oregon', 'OR'),
(311, 'Ashland', 'Oregon', 'OR'),
(312, 'Oregon Coast', 'Oregon', 'OR'),
(313, 'Portland', 'Oregon', 'OR'),
(314, 'Roseburg', 'Oregon', 'OR'),
(315, 'Salem', 'Oregon', 'OR'),
(316, 'Altoona-Johnstown', 'Pennsylvania', 'PA'),
(317, 'Cumberland Valley', 'Pennsylvania', 'PA'),
(318, 'Erie', 'Pennsylvania', 'PA'),
(319, 'Harrisburg', 'Pennsylvania', 'PA'),
(320, 'Lancaster', 'Pennsylvania', 'PA'),
(321, 'Lehigh Valley', 'Pennsylvania', 'PA'),
(322, 'Meadville', 'Pennsylvania', 'PA'),
(323, 'Philadelphia', 'Pennsylvania', 'PA'),
(324, 'Pittsburgh', 'Pennsylvania', 'PA'),
(325, 'Poconos', 'Pennsylvania', 'PA'),
(326, 'Reading', 'Pennsylvania', 'PA'),
(327, 'Scranton / Wilkes-Barre', 'Pennsylvania', 'PA'),
(328, 'State College', 'Pennsylvania', 'PA'),
(329, 'Williamsport', 'Pennsylvania', 'PA'),
(330, 'York', 'Pennsylvania', 'PA'),
(331, 'Providence', 'Rhode Island', 'RI'),
(332, 'Warwick', 'Rhode Island', 'RI'),
(333, 'Cranston', 'Rhode Island', 'RI'),
(334, 'Pawtucket', 'Rhode Island', 'RI'),
(335, 'Newport', 'Rhode Island', 'RI'),
(336, 'Bristol', 'Rhode Island', 'RI'),
(337, 'Portsmouth', 'Rhode Island', 'RI'),
(338, 'Barrington', 'Rhode Island', 'RI'),
(339, 'Glocester', 'Rhode Island', 'RI'),
(340, 'Charlestown', 'Rhode Island', 'RI'),
(341, 'Charleston', 'South Carolina', 'SC'),
(342, 'Columbia', 'South Carolina', 'SC'),
(343, 'Florence', 'South Carolina', 'SC'),
(344, 'Greenville / Upstate', 'South Carolina', 'SC'),
(345, 'Hilton Head', 'South Carolina', 'SC'),
(346, 'Myrtle Beach', 'South Carolina', 'SC'),
(347, 'Pierre / Central', 'South Dakota', 'SD'),
(348, 'Rapid City / West', 'South Dakota', 'SD'),
(349, 'Sioux Fals / SE', 'South Dakota', 'SD'),
(350, 'Chattanooga', 'Tennessee', 'TN'),
(351, 'Darksville', 'Tennessee', 'TN'),
(352, 'Cookeville', 'Tennessee', 'TN'),
(353, 'Jackson', 'Tennessee', 'TN'),
(354, 'Knoxville', 'Tennessee', 'TN'),
(355, 'Memphis', 'Tennessee', 'TN'),
(356, 'Nashville', 'Tennessee', 'TN'),
(357, 'Tri-Cities', 'Tennessee', 'TN'),
(358, 'Abilene', 'Texas', 'TX'),
(359, 'Amarillo', 'Texas', 'TX'),
(360, 'Austin', 'Texas', 'TX'),
(361, 'Beaumont / Port Arthur', 'Texas', 'TX'),
(362, 'Brownsville', 'Texas', 'TX'),
(363, 'College Station', 'Texas', 'TX'),
(364, 'Corpus Christi', 'Texas', 'TX'),
(365, 'Dallas / Fort Worth', 'Texas', 'TX'),
(366, 'Deep East Texas', 'Texas', 'TX'),
(367, 'East Texas', 'Texas', 'TX'),
(368, 'Delrio / Eagle Pass', 'Texas', 'TX'),
(369, 'El Paso', 'Texas', 'TX'),
(370, 'Galveston', 'Texas', 'TX'),
(372, 'Houston', 'Texas', 'TX'),
(373, 'Killeen / Temple / Ft Hood', 'Texas', 'TX'),
(374, 'Laredo', 'Texas', 'TX'),
(375, 'Lubbock', 'Texas', 'TX'),
(376, 'Mcallen / Edinburg', 'Texas', 'TX'),
(377, 'Odessa / Midland', 'Texas', 'TX'),
(378, 'San Angelo', 'Texas', 'TX'),
(379, 'San Antonio', 'Texas', 'TX'),
(380, 'San Marcos', 'Texas', 'TX'),
(381, 'Texoma', 'Texas', 'TX'),
(382, 'Tyler', 'Texas', 'TX'),
(383, 'Victoria', 'Texas', 'TX'),
(384, 'Waco', 'Texas', 'TX'),
(385, 'Wichita Falls', 'Texas', 'TX'),
(386, 'Logan', 'Utah', 'UT'),
(387, 'Ogden-Clearfield', 'Utah', 'UT'),
(388, 'Provo / Orem', 'Utah', 'UT'),
(389, 'Salt Lake City', 'Utah', 'UT'),
(390, 'St George', 'Utah', 'UT'),
(391, 'Burlington', 'Vermont', 'VT'),
(392, 'Essex', 'Vermont', 'VT'),
(393, 'South Burlington', 'Vermont', 'VT'),
(394, 'Colchester', 'Vermont', 'VT'),
(395, 'Hartford', 'Vermont', 'VT'),
(396, 'Charlottesville', 'Virginia', 'VA'),
(397, 'Danville', 'Virginia', 'VA'),
(398, 'Fredericksburg', 'Virginia', 'VA'),
(399, 'Hampton Roads', 'Virginia', 'VA'),
(400, 'Harrisonburg', 'Virginia', 'VA'),
(401, 'Lynchburg', 'Virginia', 'VA'),
(402, 'New River Valley', 'Virginia', 'VA'),
(403, 'Richmond', 'Virginia', 'VA'),
(404, 'Roanoke', 'Virginia', 'VA'),
(405, 'Winchester', 'Virginia', 'VA'),
(406, 'Bellingham', 'Washington', 'WA'),
(407, 'Kennewick', 'Washington', 'WA'),
(408, 'Pasco', 'Washington', 'WA'),
(409, 'Richland', 'Washington', 'WA'),
(410, 'Moses Lake', 'Washington', 'WA'),
(411, 'Olympic Peninsula', 'Washington', 'WA'),
(412, 'Anacortes', 'Washington', 'WA'),
(413, 'Ellensburg', 'Washington', 'WA'),
(414, 'Yakima', 'Washington', 'WA'),
(415, 'Olympia', 'Washington', 'WA'),
(416, 'Pullman / Moscow', 'Washington', 'WA'),
(417, 'Seattle', 'Washington', 'WA'),
(418, 'Tacoma', 'Washington', 'WA'),
(419, 'Skagit County', 'Washington', 'WA'),
(420, 'North Cascades', 'Washington', 'WA'),
(421, 'San Juan Island', 'Washington', 'WA'),
(422, 'Lopez Island', 'Washington', 'WA'),
(423, 'Orcas Island', 'Washington', 'WA'),
(424, 'Fidalgo Island', 'Washington', 'WA'),
(425, 'Whidbey Island', 'Washington', 'WA'),
(426, 'Bainbridge Island', 'Washington', 'WA'),
(427, 'Wenatchee', 'Washington', 'WA'),
(428, 'Spokane', 'Washington', 'WA'),
(429, 'Central Cascades', 'Washington', 'WA'),
(430, 'Long Beach / Oysterville / Ilwaco', 'Washington', 'WA'),
(431, 'Ocean Shores', 'Washington', 'WA'),
(432, 'Everett', 'Washington', 'WA'),
(433, 'Vashon Island', 'Washington', 'WA'),
(434, 'Bremerton', 'Washington', 'WA'),
(435, 'Port Angeles', 'Washington', 'WA'),
(436, 'Port Townsend', 'Washington', 'WA'),
(437, 'Charleston', 'West Virginia', 'WV'),
(438, 'Eastern Panhandle', 'West Virginia', 'WV'),
(439, 'Huntington-Ashland', 'West Virginia', 'WV'),
(440, 'Morgantown', 'West Virginia', 'WV'),
(441, 'Northern Panhandle', 'West Virginia', 'WV'),
(442, 'Parkersburg-Marietta', 'West Virginia', 'WV'),
(443, 'Appleton-Oshkosh-FDL', 'Wisconsin', 'WI'),
(444, 'Eau Claire', 'Wisconsin', 'WI'),
(445, 'Green Bay', 'Wisconsin', 'WI'),
(446, 'Janesville', 'Wisconsin', 'WI'),
(447, 'Kenosha-Radne', 'Wisconsin', 'WI'),
(448, 'La Crosse', 'Wisconsin', 'WI'),
(449, 'Madison', 'Wisconsin', 'WI'),
(450, 'Milwaukee', 'Wisconsin', 'WI'),
(451, 'Sheboygan', 'Wisconsin', 'WI'),
(452, 'Wausau', 'Wisconsin', 'WI'),
(453, 'Cheyenne', 'Wyoming', 'WY'),
(454, 'Casper', 'Wyoming', 'WY'),
(455, 'Laramie', 'Wyoming', 'WY'),
(456, 'Gillette', 'Wyoming', 'WY');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'able body crew'),
(2, 'administration'),
(3, 'automotive'),
(4, 'beauty'),
(5, 'bicycles'),
(6, 'computers'),
(7, 'crafts/creative'),
(8, 'engineering'),
(9, 'events'),
(10, 'art/media/design'),
(11, 'business'),
(12, 'crew'),
(13, 'education'),
(14, 'events'),
(15, 'farms & gardening'),
(16, 'finance'),
(17, 'food'),
(18, 'labor'),
(19, 'healthcare'),
(20, 'hospitality'),
(21, 'household services'),
(22, 'internet'),
(23, 'language'),
(24, 'legal'),
(25, 'lessons / tutoring'),
(26, 'manufacturing'),
(27, 'marine'),
(28, 'marketing'),
(29, 'nonprofit'),
(30, 'pets'),
(31, 'real estate'),
(32, 'retail/wholesale'),
(33, 'sales'),
(34, 'salon/spa/fitness'),
(35, 'science'),
(36, 'security'),
(37, 'skilled trade/artisan'),
(38, 'small business'),
(39, 'software'),
(40, 'systems/networking'),
(41, 'talent'),
(42, 'technical support'),
(43, 'transportation'),
(44, 'travel/vacation'),
(45, 'tv/film/video/radio/anima'),
(46, 'web/HTML/design'),
(47, 'writing/editing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(100) DEFAULT NULL,
  `fb_access_token` text,
  `twt_id` bigint(100) DEFAULT NULL,
  `twt_access_token` text,
  `twt_access_secret` text,
  `ldn_id` varchar(100) DEFAULT NULL,
  `user_group_id` varchar(256) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `active` varchar(3) DEFAULT '0',
  `email_verified` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `by_admin` int(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `betauser` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fb_id`, `fb_access_token`, `twt_id`, `twt_access_token`, `twt_access_secret`, `ldn_id`, `user_group_id`, `username`, `password`, `salt`, `email`, `active`, `email_verified`, `last_login`, `by_admin`, `ip_address`, `created`, `modified`, `betauser`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'admin', '8dcf7996a90640865c942521036076d60ed3fc3848727506198ef111f4708709', 'ziHjcC+S8VsBVo2G3SYOado5TfuQSKK0GIrjjQq4a/59CRD+CjYqBch2kgxPgp+K', 'admin@admin.com', '1', 1, '2014-05-10 15:24:41', 0, '::1', '2013-12-16 17:13:48', '2014-01-12 17:21:51', 1);


-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `useragent` varchar(256) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `last_action` int(10) DEFAULT NULL,
  `last_url` text,
  `logout_time` int(10) DEFAULT NULL,
  `user_browser` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `logout` int(11) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=474 ;


-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE IF NOT EXISTS `user_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `body` text,
  `reply_message` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `photo` text,
  `bgphoto` text,
  `state_id` int(11) DEFAULT NULL,
  `tradename` varchar(100) DEFAULT NULL,
  `tradedesc` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;


-- --------------------------------------------------------

--
-- Table structure for table `user_emails`
--

CREATE TABLE IF NOT EXISTS `user_emails` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `to_id` int(11) DEFAULT NULL,
  `is_email_sent` int(1) NOT NULL DEFAULT '0',
  `is_email_read` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;


-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL,
  `description` text,
  `allowRegistration` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `parent_id`, `name`, `alias_name`, `description`, `allowRegistration`, `created`, `modified`) VALUES
(1, 0, 'Admin', 'Admin', NULL, 0, '2014-03-11 19:04:09', '2014-03-11 19:04:09'),
(2, 0, 'User', 'User', NULL, 1, '2014-03-11 19:04:09', '2014-03-11 19:04:09'),
(3, 0, 'Guest', 'Guest', NULL, 0, '2014-03-11 19:04:09', '2014-03-11 19:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_group_permissions`
--

CREATE TABLE IF NOT EXISTS `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=323 ;

--
-- Dumping data for table `user_group_permissions`
--

INSERT INTO `user_group_permissions` (`id`, `user_group_id`, `controller`, `action`, `allowed`) VALUES
(1, 1, 'Pages', 'display', 1),
(2, 2, 'Pages', 'display', 1),
(3, 3, 'Pages', 'display', 1),
(4, 1, 'UserGroupPermissions', 'index', 1),
(5, 2, 'UserGroupPermissions', 'index', 0),
(6, 3, 'UserGroupPermissions', 'index', 0),
(7, 1, 'UserGroups', 'index', 1),
(8, 2, 'UserGroups', 'index', 0),
(9, 3, 'UserGroups', 'index', 0),
(10, 1, 'UserGroups', 'addGroup', 1),
(11, 2, 'UserGroups', 'addGroup', 0),
(12, 3, 'UserGroups', 'addGroup', 0),
(13, 1, 'UserGroups', 'editGroup', 1),
(14, 2, 'UserGroups', 'editGroup', 0),
(15, 3, 'UserGroups', 'editGroup', 0),
(16, 1, 'UserGroups', 'deleteGroup', 1),
(17, 2, 'UserGroups', 'deleteGroup', 0),
(18, 3, 'UserGroups', 'deleteGroup', 0),
(19, 1, 'UserSettings', 'index', 1),
(20, 2, 'UserSettings', 'index', 0),
(21, 3, 'UserSettings', 'index', 0),
(22, 1, 'UserSettings', 'editSetting', 1),
(23, 2, 'UserSettings', 'editSetting', 0),
(24, 3, 'UserSettings', 'editSetting', 0),
(25, 1, 'Users', 'index', 1),
(26, 2, 'Users', 'index', 0),
(27, 3, 'Users', 'index', 0),
(28, 1, 'Users', 'online', 1),
(29, 2, 'Users', 'online', 0),
(30, 3, 'Users', 'online', 0),
(31, 1, 'Users', 'viewUser', 1),
(32, 2, 'Users', 'viewUser', 1),
(33, 3, 'Users', 'viewUser', 1),
(34, 1, 'Users', 'myprofile', 1),
(35, 2, 'Users', 'myprofile', 1),
(36, 3, 'Users', 'myprofile', 0),
(37, 1, 'Users', 'editProfile', 1),
(38, 2, 'Users', 'editProfile', 1),
(39, 3, 'Users', 'editProfile', 0),
(40, 1, 'Users', 'login', 1),
(41, 2, 'Users', 'login', 1),
(42, 3, 'Users', 'login', 1),
(43, 1, 'Users', 'logout', 1),
(44, 2, 'Users', 'logout', 1),
(45, 3, 'Users', 'logout', 1),
(46, 1, 'Users', 'register', 1),
(47, 2, 'Users', 'register', 1),
(48, 3, 'Users', 'register', 1),
(49, 1, 'Users', 'changePassword', 1),
(50, 2, 'Users', 'changePassword', 1),
(51, 3, 'Users', 'changePassword', 0),
(52, 1, 'Users', 'changeUserPassword', 1),
(53, 2, 'Users', 'changeUserPassword', 0),
(54, 3, 'Users', 'changeUserPassword', 0),
(55, 1, 'Users', 'addUser', 1),
(56, 2, 'Users', 'addUser', 0),
(57, 3, 'Users', 'addUser', 0),
(58, 1, 'Users', 'editUser', 1),
(59, 2, 'Users', 'editUser', 0),
(60, 3, 'Users', 'editUser', 0),
(61, 1, 'Users', 'deleteUser', 1),
(62, 2, 'Users', 'deleteUser', 0),
(63, 3, 'Users', 'deleteUser', 0),
(64, 1, 'Users', 'deleteAccount', 0),
(65, 2, 'Users', 'deleteAccount', 1),
(66, 3, 'Users', 'deleteAccount', 0),
(67, 1, 'Users', 'logoutUser', 1),
(68, 2, 'Users', 'logoutUser', 0),
(69, 3, 'Users', 'logoutUser', 0),
(70, 1, 'Users', 'makeInactive', 1),
(71, 2, 'Users', 'makeInactive', 0),
(72, 3, 'Users', 'makeInactive', 0),
(73, 1, 'Users', 'dashboard', 1),
(74, 2, 'Users', 'dashboard', 1),
(75, 3, 'Users', 'dashboard', 1),
(76, 1, 'Users', 'makeActiveInactive', 1),
(77, 2, 'Users', 'makeActiveInactive', 0),
(78, 3, 'Users', 'makeActiveInactive', 0),
(79, 1, 'Users', 'verifyEmail', 1),
(80, 2, 'Users', 'verifyEmail', 0),
(81, 3, 'Users', 'verifyEmail', 0),
(82, 1, 'Users', 'accessDenied', 1),
(83, 2, 'Users', 'accessDenied', 1),
(84, 3, 'Users', 'accessDenied', 0),
(85, 1, 'Users', 'userVerification', 1),
(86, 2, 'Users', 'userVerification', 1),
(87, 3, 'Users', 'userVerification', 1),
(88, 1, 'Users', 'forgotPassword', 1),
(89, 2, 'Users', 'forgotPassword', 1),
(90, 3, 'Users', 'forgotPassword', 1),
(91, 1, 'Users', 'emailVerification', 1),
(92, 2, 'Users', 'emailVerification', 1),
(93, 3, 'Users', 'emailVerification', 1),
(94, 1, 'Users', 'activatePassword', 1),
(95, 2, 'Users', 'activatePassword', 1),
(96, 3, 'Users', 'activatePassword', 1),
(97, 1, 'UserGroupPermissions', 'update', 1),
(98, 2, 'UserGroupPermissions', 'update', 0),
(99, 3, 'UserGroupPermissions', 'update', 0),
(100, 1, 'Users', 'deleteCache', 1),
(101, 2, 'Users', 'deleteCache', 0),
(102, 3, 'Users', 'deleteCache', 0),
(103, 1, 'Autocomplete', 'fetch', 1),
(104, 2, 'Autocomplete', 'fetch', 1),
(105, 3, 'Autocomplete', 'fetch', 1),
(106, 1, 'Users', 'viewUserPermissions', 1),
(107, 2, 'Users', 'viewUserPermissions', 0),
(108, 3, 'Users', 'viewUserPermissions', 0),
(109, 1, 'Contents', 'index', 1),
(110, 2, 'Contents', 'index', 0),
(111, 3, 'Contents', 'index', 0),
(112, 1, 'Contents', 'addPage', 1),
(113, 2, 'Contents', 'addPage', 0),
(114, 3, 'Contents', 'addPage', 0),
(115, 1, 'Contents', 'editPage', 1),
(116, 2, 'Contents', 'editPage', 0),
(117, 3, 'Contents', 'editPage', 0),
(118, 1, 'Contents', 'viewPage', 1),
(119, 2, 'Contents', 'viewPage', 0),
(120, 3, 'Contents', 'viewPage', 0),
(121, 1, 'Contents', 'deletePage', 1),
(122, 2, 'Contents', 'deletePage', 0),
(123, 3, 'Contents', 'deletePage', 0),
(124, 1, 'Contents', 'content', 1),
(125, 2, 'Contents', 'content', 1),
(126, 3, 'Contents', 'content', 1),
(127, 1, 'UserContacts', 'index', 1),
(128, 2, 'UserContacts', 'index', 0),
(129, 3, 'UserContacts', 'index', 0),
(130, 1, 'UserContacts', 'contactUs', 1),
(131, 2, 'UserContacts', 'contactUs', 1),
(132, 3, 'UserContacts', 'contactUs', 1),
(133, 1, 'Users', 'ajaxLoginRedirect', 1),
(134, 2, 'Users', 'ajaxLoginRedirect', 1),
(135, 3, 'Users', 'ajaxLoginRedirect', 1),
(136, 1, 'Users', 'viewProfile', 1),
(137, 2, 'Users', 'viewProfile', 1),
(138, 3, 'Users', 'viewProfile', 1),
(139, 1, 'Users', 'sendMails', 1),
(140, 2, 'Users', 'sendMails', 0),
(141, 3, 'Users', 'sendMails', 0),
(142, 1, 'Users', 'searchEmails', 1),
(143, 2, 'Users', 'searchEmails', 1),
(144, 3, 'Users', 'searchEmails', 0),
(145, 1, 'UserEmails', 'index', 1),
(146, 1, 'UserEmails', 'send', 1),
(147, 1, 'UserEmails', 'sendToUser', 1),
(148, 1, 'UserEmails', 'sendReply', 1),
(149, 1, 'UserEmails', 'view', 1),
(150, 1, 'UserGroupPermissions', 'subPermissions', 1),
(151, 1, 'UserGroupPermissions', 'getPermissions', 1),
(152, 1, 'UserGroupPermissions', 'permissionGroupMatrix', 1),
(153, 1, 'UserGroupPermissions', 'permissionSubGroupMatrix', 1),
(154, 1, 'UserGroupPermissions', 'changePermission', 1),
(155, 1, 'Users', 'indexSearch', 1),
(156, 1, 'UserEmailSignatures', 'index', 1),
(157, 1, 'UserEmailSignatures', 'add', 1),
(158, 1, 'UserEmailSignatures', 'edit', 1),
(159, 1, 'UserEmailSignatures', 'delete', 1),
(160, 1, 'UserEmailTemplates', 'index', 1),
(161, 1, 'UserEmailTemplates', 'add', 1),
(162, 1, 'UserEmailTemplates', 'edit', 1),
(163, 1, 'UserEmailTemplates', 'delete', 1),
(164, 1, 'UserSettings', 'cakelog', 1),
(165, 1, 'UserSettings', 'cakelogbackup', 1),
(166, 1, 'UserSettings', 'cakelogdelete', 1),
(167, 1, 'UserSettings', 'cakelogempty', 1),
(168, 1, 'Users', 'addMultipleUsers', 1),
(169, 1, 'Users', 'uploadCsv', 1),
(170, 1, 'Mains', 'index', 1),
(171, 2, 'Mains', 'index', 1),
(172, 3, 'Mains', 'index', 0),
(173, 1, 'Tradeicons', 'index', 1),
(174, 2, 'Tradeicons', 'index', 0),
(175, 3, 'Tradeicons', 'index', 0),
(176, 1, 'Tradeicons', 'view', 1),
(177, 2, 'Tradeicons', 'view', 0),
(178, 3, 'Tradeicons', 'view', 0),
(179, 1, 'Tradeicons', 'add', 1),
(180, 2, 'Tradeicons', 'add', 0),
(181, 3, 'Tradeicons', 'add', 0),
(182, 1, 'Tradeicons', 'edit', 1),
(183, 2, 'Tradeicons', 'edit', 0),
(184, 3, 'Tradeicons', 'edit', 0),
(185, 1, 'Tradeicons', 'delete', 1),
(186, 2, 'Tradeicons', 'delete', 0),
(187, 3, 'Tradeicons', 'delete', 0),
(188, 1, 'Mains', 'randomAdminAccess', 1),
(189, 2, 'Mains', 'randomAdminAccess', 0),
(190, 3, 'Mains', 'randomAdminAccess', 0),
(191, 1, 'Types', 'delete', 1),
(192, 2, 'Types', 'delete', 0),
(193, 3, 'Types', 'delete', 0),
(194, 1, 'Types', 'edit', 1),
(195, 2, 'Types', 'edit', 0),
(196, 3, 'Types', 'edit', 0),
(197, 1, 'Types', 'add', 1),
(198, 2, 'Types', 'add', 0),
(199, 3, 'Types', 'add', 0),
(200, 1, 'Types', 'view', 1),
(201, 2, 'Types', 'view', 0),
(202, 3, 'Types', 'view', 0),
(203, 1, 'Types', 'index', 1),
(204, 2, 'Types', 'index', 0),
(205, 3, 'Types', 'index', 0),
(206, 1, 'Labs', 'add', 1),
(207, 2, 'Labs', 'add', 1),
(208, 3, 'Labs', 'add', 0),
(209, 1, 'Mains', 'iconSearch', 1),
(210, 2, 'Mains', 'iconSearch', 1),
(211, 3, 'Mains', 'iconSearch', 0),
(212, 1, 'Mains', 'view', 1),
(213, 2, 'Mains', 'view', 1),
(214, 3, 'Mains', 'view', 0),
(215, 2, 'UserEmails', 'view', 1),
(216, 3, 'UserEmails', 'view', 0),
(217, 2, 'UserEmails', 'sendReply', 1),
(218, 3, 'UserEmails', 'sendReply', 0),
(219, 2, 'UserEmails', 'index', 1),
(220, 3, 'UserEmails', 'index', 0),
(221, 2, 'UserEmails', 'send', 1),
(222, 3, 'UserEmails', 'send', 0),
(223, 2, 'UserEmails', 'sendToUser', 1),
(224, 3, 'UserEmails', 'sendToUser', 0),
(266, 1, 'Labs', 'upVote', 1),
(225, 2, 'Users', 'indexSearch', 1),
(226, 3, 'Users', 'indexSearch', 0),
(227, 1, 'Labs', 'index', 1),
(228, 2, 'Labs', 'index', 1),
(229, 3, 'Labs', 'index', 1),
(230, 1, 'Labs', 'view', 1),
(231, 2, 'Labs', 'view', 1),
(232, 3, 'Labs', 'view', 1),
(233, 1, 'Labs', 'labSearch', 1),
(234, 2, 'Labs', 'labSearch', 1),
(235, 3, 'Labs', 'labSearch', 0),
(236, 1, 'Labs', 'randomAdminAccess', 1),
(237, 2, 'Labs', 'randomAdminAccess', 0),
(238, 3, 'Labs', 'randomAdminAccess', 0),
(239, 1, 'Labs', 'allLabs', 1),
(240, 2, 'Labs', 'allLabs', 1),
(241, 3, 'Labs', 'allLabs', 0),
(242, 1, 'Labs', 'editLab', 1),
(243, 2, 'Labs', 'editLab', 1),
(244, 3, 'Labs', 'editLab', 0),
(245, 1, 'Labs', 'deactivateLab', 1),
(246, 2, 'Labs', 'deactivateLab', 1),
(247, 3, 'Labs', 'deactivateLab', 0),
(248, 1, 'Labs', 'activateLab', 1),
(249, 2, 'Labs', 'activateLab', 1),
(250, 3, 'Labs', 'activateLab', 0),
(251, 1, 'Labs', 'deleteLab', 1),
(252, 2, 'Labs', 'deleteLab', 1),
(253, 3, 'Labs', 'deleteLab', 0),
(254, 1, 'Labs', 'viewPic', 1),
(255, 2, 'Labs', 'viewPic', 1),
(256, 3, 'Labs', 'viewPic', 1),
(257, 1, 'Labs', 'deletePic', 1),
(258, 2, 'Labs', 'deletePic', 1),
(259, 3, 'Labs', 'deletePic', 0),
(260, 1, 'Labs', 'addPic', 1),
(261, 2, 'Labs', 'addPic', 1),
(262, 3, 'Labs', 'addPic', 0),
(263, 1, 'Labs', 'editPic', 1),
(264, 2, 'Labs', 'editPic', 1),
(265, 3, 'Labs', 'editPic', 0),
(267, 2, 'Labs', 'upVote', 1),
(268, 3, 'Labs', 'upVote', 0),
(269, 1, 'Labs', 'downVote', 1),
(270, 2, 'Labs', 'downVote', 1),
(271, 3, 'Labs', 'downVote', 0),
(272, 1, 'UserEmails', 'deleteEmail', 1),
(273, 2, 'UserEmails', 'deleteEmail', 1),
(274, 3, 'UserEmails', 'deleteEmail', 0),
(275, 1, 'UserEmails', 'sent', 1),
(276, 2, 'UserEmails', 'sent', 1),
(277, 3, 'UserEmails', 'sent', 0),
(278, 1, 'Labs', 'search', 1),
(279, 2, 'Labs', 'search', 1),
(280, 3, 'Labs', 'search', 0),
(281, 1, 'Labs', 'find', 1),
(282, 2, 'Labs', 'find', 1),
(283, 3, 'Labs', 'find', 1),
(284, 1, 'Labs', 'passToEmail', 1),
(285, 2, 'Labs', 'passToEmail', 1),
(286, 3, 'Labs', 'passToEmail', 0),
(287, 1, 'Towns', 'delete', 1),
(288, 2, 'Towns', 'delete', 0),
(289, 3, 'Towns', 'delete', 0),
(290, 1, 'Towns', 'edit', 1),
(291, 2, 'Towns', 'edit', 0),
(292, 3, 'Towns', 'edit', 0),
(293, 1, 'Towns', 'add', 1),
(294, 2, 'Towns', 'add', 0),
(295, 3, 'Towns', 'add', 0),
(296, 1, 'Towns', 'view', 1),
(297, 2, 'Towns', 'view', 0),
(298, 3, 'Towns', 'view', 0),
(299, 1, 'Towns', 'index', 1),
(300, 2, 'Towns', 'index', 0),
(301, 3, 'Towns', 'index', 0),
(302, 1, 'UserContacts', 'bugReport', 1),
(303, 2, 'UserContacts', 'bugReport', 1),
(304, 3, 'UserContacts', 'bugReport', 1),
(305, 1, 'Users', 'signIn', 1),
(306, 2, 'Users', 'signIn', 1),
(307, 3, 'Users', 'signIn', 1),
(308, 1, 'Posts', 'index', 1),
(309, 2, 'Posts', 'index', 1),
(310, 3, 'Posts', 'index', 1),
(311, 1, 'Posts', 'view', 1),
(312, 2, 'Posts', 'view', 1),
(313, 3, 'Posts', 'view', 1),
(314, 1, 'Posts', 'edit', 1),
(315, 2, 'Posts', 'edit', 0),
(316, 3, 'Posts', 'edit', 0),
(317, 1, 'Posts', 'delete', 1),
(318, 2, 'Posts', 'delete', 0),
(319, 3, 'Posts', 'delete', 0),
(320, 1, 'Posts', 'add', 1),
(321, 2, 'Posts', 'add', 0),
(322, 3, 'Posts', 'add', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `name_public` text,
  `value` varchar(256) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `category` varchar(20) DEFAULT 'OTHER',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `name`, `name_public`, `value`, `type`, `category`) VALUES
(1, 'defaultTimeZone', 'Enter default time zone identifier', 'America/Los_Angeles', 'input', 'OTHER'),
(2, 'siteName', 'Enter Your Site Name', 'Barterlabs', 'input', 'OTHER'),
(3, 'siteRegistration', 'New Registration is allowed or not', '1', 'checkbox', 'USER'),
(4, 'allowDeleteAccount', 'Allow users to delete account', '1', 'checkbox', 'USER'),
(5, 'sendRegistrationMail', 'Send Registration Mail After User Registered', '1', 'checkbox', 'EMAIL'),
(6, 'sendPasswordChangeMail', 'Send Password Change Mail After User changed password', '1', 'checkbox', 'EMAIL'),
(7, 'emailVerification', 'Want to verify user''s email address?', '0', 'checkbox', 'EMAIL'),
(8, 'emailFromAddress', 'Enter email by which emails will be send.', 'example@example.com', 'input', 'EMAIL'),
(9, 'emailFromName', 'Enter Email From Name', 'A Barterlabs Message', 'input', 'EMAIL'),
(10, 'allowChangeUsername', 'Do you want to allow users to change their username?', '0', 'checkbox', 'USER'),
(11, 'bannedUsernames', 'Set banned usernames comma separated(no space, no quotes)', 'Administrator, SuperAdmin', 'input', 'USER'),
(12, 'useRecaptcha', 'Do you want to add captcha support on registration form, contact us form, login form in case bad logins, forgot password page, email verification page? Please note we have separate settings for all pages to Add or Remove captcha.', '0', 'checkbox', 'RECAPTCHA'),
(13, 'privateKeyFromRecaptcha', 'Enter private key for Recaptcha from google', '', 'input', 'RECAPTCHA'),
(14, 'publicKeyFromRecaptcha', 'Enter public key for recaptcha from google', '', 'input', 'RECAPTCHA'),
(15, 'loginRedirectUrl', 'Enter URL where user will be redirected after login ', '/labs/index', 'input', 'OTHER'),
(16, 'logoutRedirectUrl', 'Enter URL where user will be redirected after logout', '/login', 'input', 'OTHER'),
(17, 'permissions', 'Do you Want to enable permissions for users?', '1', 'checkbox', 'PERMISSION'),
(18, 'adminPermissions', 'Do you want to check permissions for Admin?', '1', 'checkbox', 'PERMISSION'),
(19, 'defaultGroupId', 'Enter default group id for user registration', '2', 'input', 'GROUP'),
(20, 'adminGroupId', 'Enter Admin Group Id', '1', 'input', 'GROUP'),
(21, 'guestGroupId', 'Enter Guest Group Id', '3', 'input', 'GROUP'),
(22, 'useFacebookLogin', 'Want to use Facebook Connect on your site?', '0', 'checkbox', 'FACEBOOK'),
(23, 'facebookAppId', 'Facebook Application Id', '', 'input', 'FACEBOOK'),
(24, 'facebookSecret', 'Facebook Application Secret Code', '', 'input', 'FACEBOOK'),
(25, 'facebookScope', 'Facebook Permissions', 'user_status, publish_stream, email', 'input', 'FACEBOOK'),
(26, 'useTwitterLogin', 'Want to use Twitter Connect on your site?', '0', 'checkbox', 'TWITTER'),
(27, 'twitterConsumerKey', 'Twitter Consumer Key', '', 'input', 'TWITTER'),
(28, 'twitterConsumerSecret', 'Twitter Consumer Secret', '', 'input', 'TWITTER'),
(29, 'useGmailLogin', 'Want to use Gmail Connect on your site?', '1', 'checkbox', 'GOOGLE'),
(30, 'useYahooLogin', 'Want to use Yahoo Connect on your site?', '0', 'checkbox', 'YAHOO'),
(31, 'useLinkedinLogin', 'Want to use Linkedin Connect on your site?', '0', 'checkbox', 'LINKEDIN'),
(32, 'linkedinApiKey', 'Linkedin Api Key', '', 'input', 'LINKEDIN'),
(33, 'linkedinSecretKey', 'Linkedin Secret Key', '', 'input', 'LINKEDIN'),
(34, 'useFoursquareLogin', 'Want to use Foursquare Connect on your site?', '0', 'checkbox', 'FOURSQUARE'),
(35, 'foursquareClientId', 'Foursquare Client Id', '', 'input', 'FOURSQUARE'),
(36, 'foursquareClientSecret', 'Foursquare Client Secret', '', 'input', 'FOURSQUARE'),
(37, 'viewOnlineUserTime', 'You can view online users and guest from last few minutes, set time in minutes ', '30', 'input', 'USER'),
(38, 'useHttps', 'Do you want to HTTPS for whole site?', '0', 'checkbox', 'OTHER'),
(39, 'httpsUrls', 'You can set selected urls for HTTPS (e.g. users/login, users/register)', NULL, 'input', 'OTHER'),
(40, 'imgDir', 'Enter Image directory name where users profile photos will be uploaded. This directory should be in webroot/img directory', 'umphotos', 'input', 'OTHER'),
(41, 'QRDN', 'Increase this number by 1 every time if you made any changes in CSS or JS file', '12345756', 'input', 'OTHER'),
(42, 'cookieName', 'Please enter cookie name for your site which is used to login user automatically for remember me functionality', 'BarterlabsCookie', 'input', 'OTHER'),
(43, 'adminEmailAddress', 'Admin Email address for emails', '', 'input', 'EMAIL'),
(44, 'useRecaptchaOnLogin', 'Do you want to add captcha support on login form in case bad logins? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(45, 'badLoginAllowCount', 'Set number of allowed bad logins. for e.g. 5 or 10. For this feature you must have Captcha setting ON with valid private and public keys.', '5', 'input', 'RECAPTCHA'),
(46, 'useRecaptchaOnRegistration', 'Do you want to add captcha support on registration form? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(47, 'useRecaptchaOnForgotPassword', 'Do you want to add captcha support on forgot password page? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(48, 'useRecaptchaOnEmailVerification', 'Do you want to add captcha support on email verification page? For this feature you must have Captcha setting ON with valid private and public keys.', '1', 'checkbox', 'RECAPTCHA'),
(49, 'useRememberMe', 'Set true/false if you want to add/remove remember me feature on login page', '1', 'checkbox', 'USER'),
(50, 'allowUserMultipleLogin', 'Do you want to allow multiple logins with same user account for users(not admin)?', '1', 'checkbox', 'USER'),
(51, 'allowAdminMultipleLogin', 'Do you want to allow multiple logins with same user account for admin(not users)?', '1', 'checkbox', 'USER'),
(52, 'loginIdleTime', 'Set max idle time in minutes for user. This idle time will be used when multiple logins are not allowed for same user account. If max idle time reached since user last activity on site then anyone can login with same account in other browser and idle user will be logged out.', '10', 'input', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) DEFAULT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `upvote` smallint(1) DEFAULT NULL,
  `downvote` smallint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
