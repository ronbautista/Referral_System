-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 03:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `referraldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `fclt_id` int(11) NOT NULL,
  `fclt_name` varchar(255) NOT NULL,
  `fclt_password` varchar(255) NOT NULL,
  `fclt_ref_id` varchar(255) NOT NULL,
  `fclt_type` varchar(255) NOT NULL,
  `fclt_address` varchar(255) NOT NULL,
  `img_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`fclt_id`, `fclt_name`, `fclt_password`, `fclt_ref_id`, `fclt_type`, `fclt_address`, `img_url`) VALUES
(1, 'Caraga Hospital', '$2y$10$e9OJl./loMHTgS5BJu5grOhWgjGak81GUi1LpK6W0q2.DK5usT6we', '003', 'Hospital', 'Surigao City', ''),
(2, 'Gigaquit RHU', '$2y$10$1NzWlXD0t/r7ya4u1MDrOOH3sbO/ZmUz9990FwRozoX.1fpdscklO', '008', 'Birthing Home', 'Gigaquit', ''),
(3, 'Surigao Del Norte Provincial Hospital', '$2y$10$YWFHX4SDkT3Bp803vcm1XO.RdvBsr8sgaRRiDPjLcfVU/l5WAZtM6', '009', 'Provincial Hospital', 'Surigao del Norte', ''),
(4, 'Miranda', '$2y$10$298VYvJ767szo0IanMnkCOc42ubpxLXcOvOpGDWduA/nrSaRifOHq', '005', 'Birthing Home', 'Surigao City', '');

-- --------------------------------------------------------

--
-- Table structure for table `first_trimester`
--

CREATE TABLE `first_trimester` (
  `id` int(11) NOT NULL,
  `check-up` varchar(255) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Weight` varchar(255) NOT NULL,
  `Height` varchar(255) NOT NULL,
  `Age_of_Gestation` varchar(255) NOT NULL,
  `Blood_Pressure` varchar(255) NOT NULL,
  `Nutritional_Status` varchar(255) NOT NULL,
  `Laboratory_Tests_Done` varchar(255) NOT NULL,
  `Hemoglobin_Count` varchar(255) NOT NULL,
  `Urinalysis` varchar(255) NOT NULL,
  `Complete_Blood_Count_(CBC)` varchar(255) NOT NULL,
  `STIs_using_a_syndromic_approach` varchar(255) NOT NULL,
  `Tetanus-containing_Vaccine` varchar(255) NOT NULL,
  `Date_of_Return` varchar(255) NOT NULL,
  `Health_Provider_Name` varchar(255) NOT NULL,
  `Hospital_Referral` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `first_trimester`
--

INSERT INTO `first_trimester` (`id`, `check-up`, `patients_id`, `Date`, `Weight`, `Height`, `Age_of_Gestation`, `Blood_Pressure`, `Nutritional_Status`, `Laboratory_Tests_Done`, `Hemoglobin_Count`, `Urinalysis`, `Complete_Blood_Count_(CBC)`, `STIs_using_a_syndromic_approach`, `Tetanus-containing_Vaccine`, `Date_of_Return`, `Health_Provider_Name`, `Hospital_Referral`) VALUES
(28, 'first_checkup', 1, 'first', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd'),
(31, 'third_checkup', 1, 'date', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd'),
(33, 'second_checkup', 4, 'second', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd'),
(35, 'first_checkup', 2, 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew', 'wew'),
(36, 'first_checkup', 11, 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx', 'xx'),
(37, 'first_checkup', 3, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd'),
(38, 'first_checkup', 6, 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw'),
(39, 'first_checkup', 9, 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw', 'aw'),
(40, 'first_checkup', 26, 'asdadad', 'adasdad', 'asdada', 'asda', 'dasdas', 'asda', 'asdad', 'asdasda', 'dasdd', 'sda', 'adasd', 'asda', 'asdas', 'asda', 'dasdasd'),
(41, 'first_checkup', 19, 'asd', 'aasd', 'dasda', 'aasda', 'dsa', 'asda', 'asda', 'asd', 'dasda', 'asdd', 'dasd', 'asdsa', 'asd', 'asdad', 'asda'),
(42, 'first_checkup', 30, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user1` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `user2` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user1`, `message`, `user2`, `date`, `time`) VALUES
(108, '1', 'hey', '2', '2023-11-02', '02:12:34 PM'),
(109, '2', 'yow', '1', '2023-11-02', '02:12:41 PM');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `fclt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fname`, `mname`, `lname`, `contact`, `address`, `fclt_id`) VALUES
(28, 'asd', 'asdad', 'asd', 'asdad', 'asd', 3),
(30, 'Sarah', '', 'Jane', '009090', 'Airport', 2),
(31, 'asda', 'asdad', 'asdasd', 'asdas', 'asdad', 3),
(34, 'asd', 'asd', 'asd', 'asdasa', 'asd', 3),
(35, 'uhuy', 'b', 'ubu', 'buyb', 'uyb', 2),
(36, 'asdad', 'asd', 'asdada', 'asd', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients_details`
--

CREATE TABLE `patients_details` (
  `patients_details_id` int(11) NOT NULL,
  `petsa_ng_unang_checkup` varchar(255) NOT NULL,
  `edad` varchar(255) NOT NULL,
  `timbang` varchar(255) NOT NULL,
  `taas` varchar(255) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `kalagayan_ng_kalusugan` varchar(255) DEFAULT NULL,
  `petsa_ng_huling_regla` varchar(255) DEFAULT NULL,
  `kailan_ako_manganganak` varchar(255) DEFAULT NULL,
  `pang_ilang_pagbubuntis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_details`
--

INSERT INTO `patients_details` (`patients_details_id`, `petsa_ng_unang_checkup`, `edad`, `timbang`, `taas`, `patients_id`, `kalagayan_ng_kalusugan`, `petsa_ng_huling_regla`, `kailan_ako_manganganak`, `pang_ilang_pagbubuntis`) VALUES
(65, '10/28/2023', 'adsada', 'asdd', 'asdad', 30, '', '', '', ''),
(66, '10/27/2023', 'adsada', 'aasds', 'asdad', 35, 'asd', 'dasd', 'asda', 'dasdsa'),
(67, '10/26/2023', '', '', '', 28, '', '', '', ''),
(68, '10/26/2023', '', '', 'asd', 36, '', '', '', ''),
(69, '', '', '', '', 0, NULL, NULL, NULL, NULL),
(70, '', '', '', '', 0, NULL, NULL, NULL, NULL),
(71, '', '', '', '', 0, NULL, NULL, NULL, NULL),
(72, '', '', '', '', 0, NULL, NULL, NULL, NULL),
(73, '', '', '', '', 0, NULL, NULL, NULL, NULL),
(74, '', '', '', '', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_image`
--

CREATE TABLE `profile_image` (
  `id` int(11) NOT NULL,
  `img_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_image`
--

INSERT INTO `profile_image` (`id`, `img_path`) VALUES
(31, 'C:\\xampp\\htdocs\\Referral_System/images/apple.jpg'),
(32, 'C:\\xampp\\htdocs\\Referral_System/images/Apple-Logo-black.png'),
(33, 'C:\\xampp\\htdocs\\Referral_System/images/Apple-Logo-black.png'),
(34, 'C:\\xampp\\htdocs\\Referral_System/images/Apple-Logo-black.png');

-- --------------------------------------------------------

--
-- Table structure for table `referral_format`
--

CREATE TABLE `referral_format` (
  `id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_format`
--

INSERT INTO `referral_format` (`id`, `field_name`) VALUES
(1, 'Name');

-- --------------------------------------------------------

--
-- Table structure for table `referral_forms`
--

CREATE TABLE `referral_forms` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `dadaad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_forms`
--

INSERT INTO `referral_forms` (`id`, `Name`, `dadaad`) VALUES
(239, 'asdadadasd', ''),
(240, 'asdadad', ''),
(241, 'asdada', ''),
(248, 'First', ''),
(249, 'Second', '');

-- --------------------------------------------------------

--
-- Table structure for table `referral_notification`
--

CREATE TABLE `referral_notification` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `rfrrl_id` int(11) NOT NULL,
  `fclt_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `is_displayed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_notification`
--

INSERT INTO `referral_notification` (`id`, `message`, `rfrrl_id`, `fclt_id`, `date`, `time`, `is_displayed`) VALUES
(511, 'Referral Declined', 163, 10, '2023-10-08', '11:33 AM', 0),
(512, 'Referral Declined', 163, 10, '2023-10-08', '12:04 PM', 0),
(513, 'Referral Declined', 163, 10, '2023-10-08', '12:05 PM', 0),
(514, 'Referral Declined', 163, 10, '2023-10-08', '12:05 PM', 0),
(515, 'Referral Declined', 163, 10, '2023-10-08', '12:06 PM', 0),
(516, 'Referral Accepted', 163, 3, '2023-10-08', '12:06 PM', 0),
(517, 'Referral Declined', 163, 10, '2023-10-08', '12:06 PM', 0),
(518, 'Referral Declined', 163, 10, '2023-10-08', '12:07 PM', 0),
(519, 'Referral Declined', 163, 10, '2023-10-08', '12:07 PM', 0),
(520, 'Referral Declined', 165, 10, '2023-10-08', '12:07 PM', 0),
(521, 'Referral Declined', 162, 3, '2023-10-08', '12:08 PM', 0),
(522, 'Referral Accepted', 162, 10, '2023-10-08', '12:37 PM', 0),
(523, 'Referral Declined', 162, 10, '2023-10-08', '12:37 PM', 0),
(524, 'Referral Declined', 162, 10, '2023-10-08', '12:45 PM', 0),
(525, 'Referral Declined', 165, 10, '2023-10-08', '01:02 PM', 0),
(526, 'Referral Accepted', 162, 10, '2023-10-08', '01:07 PM', 0),
(527, 'New referral', 166, 2, '2023-10-08', '02:20 PM', 0),
(528, 'New referral', 167, 2, '2023-10-08', '02:21 PM', 0),
(529, 'Referral Declined', 166, 3, '2023-10-08', '02:21 PM', 0),
(530, 'Referral Accepted', 167, 3, '2023-10-08', '02:30 PM', 0),
(531, 'Referral Accepted', 166, 1, '2023-10-08', '02:38 PM', 0),
(532, 'Referral Declined', 166, 3, '2023-10-08', '02:44 PM', 0),
(533, 'Referral Declined', 166, 3, '2023-10-08', '02:44 PM', 0),
(534, 'Referral Declined', 166, 3, '2023-10-08', '02:48 PM', 0),
(535, 'Referral Accepted', 166, 3, '2023-10-08', '02:49 PM', 0),
(536, 'Referral Declined', 166, 3, '2023-10-08', '02:49 PM', 0),
(537, 'Referral Accepted', 166, 3, '2023-10-08', '02:57 PM', 0),
(538, 'Referral Declined', 167, 3, '2023-10-08', '02:57 PM', 0),
(539, 'Referral Declined', 166, 3, '2023-10-08', '02:57 PM', 0),
(540, 'Referral Declined', 166, 3, '2023-10-08', '02:57 PM', 0),
(541, 'Referral Declined', 166, 3, '2023-10-08', '03:04 PM', 0),
(542, 'Referral Declined', 166, 3, '2023-10-08', '03:04 PM', 0),
(543, 'Referral Declined', 166, 3, '2023-10-08', '03:04 PM', 0),
(544, 'Referral Declined', 166, 3, '2023-10-08', '03:05 PM', 0),
(545, 'Referral Declined', 166, 3, '2023-10-08', '03:06 PM', 0),
(546, 'Referral Declined', 166, 3, '2023-10-08', '03:06 PM', 0),
(547, 'Referral Declined', 166, 3, '2023-10-08', '03:24 PM', 0),
(548, 'Referral Declined', 166, 3, '2023-10-08', '03:25 PM', 0),
(549, 'Referral Declined', 166, 3, '2023-10-08', '03:37 PM', 0),
(550, 'Referral Declined', 166, 3, '2023-10-08', '03:44 PM', 0),
(551, 'Referral Declined', 166, 3, '2023-10-08', '03:45 PM', 0),
(552, 'Referral Declined', 166, 3, '2023-10-08', '03:45 PM', 0),
(553, 'Referral Declined', 166, 3, '2023-10-08', '03:48 PM', 0),
(554, 'Referral Declined', 166, 3, '2023-10-08', '03:48 PM', 0),
(555, 'Referral Declined', 167, 3, '2023-10-08', '04:01 PM', 0),
(556, 'Referral Declined', 167, 3, '2023-10-08', '04:01 PM', 0),
(557, 'Referral Declined', 167, 3, '2023-10-08', '04:01 PM', 0),
(558, 'Referral Declined', 167, 3, '2023-10-08', '04:02 PM', 0),
(559, 'Referral Declined', 166, 3, '2023-10-08', '04:02 PM', 0),
(560, 'Referral Declined', 166, 3, '2023-10-08', '04:02 PM', 0),
(561, 'Referral Declined', 166, 3, '2023-10-08', '04:03 PM', 0),
(562, 'Referral Declined', 166, 3, '2023-10-08', '04:03 PM', 0),
(563, 'Referral Declined', 167, 3, '2023-10-08', '04:05 PM', 0),
(564, 'Referral Declined', 167, 3, '2023-10-08', '04:05 PM', 0),
(565, 'Referral Declined', 166, 3, '2023-10-08', '04:06 PM', 0),
(566, 'Referral Declined', 166, 3, '2023-10-08', '04:06 PM', 0),
(567, 'Referral Declined', 167, 3, '2023-10-08', '04:07 PM', 0),
(568, 'Referral Declined', 167, 3, '2023-10-08', '04:09 PM', 0),
(569, 'Referral Declined', 166, 3, '2023-10-08', '04:10 PM', 0),
(570, 'Referral Declined', 167, 3, '2023-10-08', '04:10 PM', 0),
(571, 'Referral Declined', 167, 3, '2023-10-08', '04:11 PM', 0),
(572, 'Referral Declined', 166, 3, '2023-10-08', '04:11 PM', 0),
(573, 'Referral Declined', 167, 3, '2023-10-08', '04:11 PM', 0),
(574, 'Referral Declined', 167, 3, '2023-10-08', '04:13 PM', 0),
(575, 'Referral Declined', 166, 3, '2023-10-08', '04:13 PM', 0),
(576, 'Referral Declined', 166, 3, '2023-10-08', '04:13 PM', 0),
(577, 'Referral Declined', 166, 3, '2023-10-08', '04:14 PM', 0),
(578, 'Referral Declined', 167, 3, '2023-10-08', '04:17 PM', 0),
(579, 'Referral Declined', 167, 3, '2023-10-08', '04:20 PM', 0),
(580, 'Referral Declined', 166, 3, '2023-10-08', '04:20 PM', 0),
(581, 'Referral Declined', 166, 3, '2023-10-08', '04:20 PM', 0),
(582, 'Referral Accepted', 167, 3, '2023-10-08', '04:20 PM', 0),
(583, 'Referral Declined', 167, 3, '2023-10-08', '04:20 PM', 0),
(584, 'Referral Declined', 166, 3, '2023-10-08', '04:21 PM', 0),
(585, 'Referral Accepted', 167, 3, '2023-10-08', '04:29 PM', 0),
(586, 'Referral Declined', 167, 3, '2023-10-08', '04:29 PM', 0),
(587, 'Referral Declined', 166, 3, '2023-10-08', '04:29 PM', 0),
(588, 'Referral Declined', 167, 3, '2023-10-08', '04:29 PM', 0),
(589, 'Referral Accepted', 167, 1, '2023-10-08', '10:53 PM', 0),
(590, 'Referral Declined', 167, 1, '2023-10-08', '10:53 PM', 0),
(591, 'Referral Declined', 167, 3, '2023-10-08', '11:01 PM', 0),
(592, 'Referral Accepted', 166, 3, '2023-10-08', '11:02 PM', 0),
(593, 'Referral Declined', 166, 3, '2023-10-08', '11:03 PM', 0),
(594, 'Referral Declined', 167, 3, '2023-10-08', '11:03 PM', 0),
(595, 'Referral Declined', 166, 3, '2023-10-08', '11:03 PM', 0),
(596, 'Referral Accepted', 166, 1, '2023-10-08', '11:07 PM', 0),
(597, 'Referral Accepted', 167, 3, '2023-10-09', '01:03 AM', 0),
(598, 'Referral Declined', 167, 3, '2023-10-09', '01:17 AM', 0),
(599, 'Referral Declined', 167, 3, '2023-10-09', '01:17 AM', 0),
(600, 'New referral', 168, 2, '2023-10-09', '01:29 AM', 0),
(601, 'Referral Accepted', 168, 3, '2023-10-09', '01:29 AM', 0),
(602, 'Referral Declined', 168, 3, '2023-10-09', '01:40 AM', 0),
(603, 'Referral Declined', 168, 3, '2023-10-09', '01:41 AM', 0),
(604, 'New referral', 169, 2, '2023-10-09', '01:55 AM', 0),
(605, 'Referral Declined', 169, 3, '2023-10-09', '02:00 AM', 0),
(606, 'Referral Declined', 169, 3, '2023-10-09', '02:28 AM', 0),
(607, 'Referral Accepted', 169, 3, '2023-10-09', '02:28 AM', 0),
(608, 'New referral', 170, 2, '2023-10-09', '02:35 AM', 0),
(609, 'New referral', 171, 2, '2023-10-09', '02:36 AM', 0),
(610, 'Referral Declined', 171, 3, '2023-10-09', '02:39 AM', 0),
(611, 'Referral Declined', 170, 3, '2023-10-09', '02:39 AM', 0),
(612, 'Referral Accepted', 171, 3, '2023-10-09', '03:01 AM', 0),
(613, 'Referral Accepted', 170, 3, '2023-10-09', '03:01 AM', 0),
(614, 'Referral Accepted', 168, 3, '2023-10-09', '03:03 AM', 0),
(615, 'Referral Declined', 169, 3, '2023-10-09', '03:04 AM', 0),
(616, 'Referral Declined', 170, 3, '2023-10-09', '03:04 AM', 0),
(617, 'Referral Accepted', 171, 3, '2023-10-09', '03:11 AM', 0),
(618, 'Referral Declined', 168, 3, '2023-10-09', '03:33 AM', 0),
(619, 'Referral Accepted', 168, 1, '2023-10-09', '03:33 AM', 0),
(620, 'Referral Declined', 168, 1, '2023-10-09', '03:37 AM', 0),
(621, 'Referral Declined', 171, 3, '2023-10-09', '03:38 AM', 0),
(622, 'Referral Accepted', 171, 3, '2023-10-09', '03:38 AM', 0),
(623, 'Referral Declined', 171, 3, '2023-10-09', '03:39 AM', 0),
(624, 'Referral Accepted', 171, 3, '2023-10-09', '03:39 AM', 0),
(625, 'Referral Declined', 171, 3, '2023-10-09', '03:39 AM', 0),
(626, 'Referral Accepted', 171, 3, '2023-10-09', '03:39 AM', 0),
(627, 'Referral Declined', 171, 3, '2023-10-09', '03:39 AM', 0),
(628, 'Referral Declined', 171, 3, '2023-10-09', '03:40 AM', 0),
(629, 'Referral Accepted', 168, 3, '2023-10-09', '03:41 AM', 0),
(630, 'Referral Accepted', 170, 3, '2023-10-09', '03:43 AM', 0),
(631, 'Referral Accepted', 169, 3, '2023-10-09', '03:43 AM', 0),
(632, 'Referral Accepted', 168, 3, '2023-10-09', '03:44 AM', 0),
(633, 'Referral Accepted', 169, 3, '2023-10-09', '03:45 AM', 0),
(634, 'Referral Accepted', 170, 3, '2023-10-09', '03:46 AM', 0),
(635, 'Referral Accepted', 168, 3, '2023-10-09', '03:47 AM', 0),
(636, 'Referral Accepted', 168, 3, '2023-10-09', '03:49 AM', 0),
(637, 'Referral Declined', 169, 3, '2023-10-09', '03:50 AM', 0),
(638, 'Referral Accepted', 169, 1, '2023-10-09', '03:51 AM', 0),
(639, 'New referral', 172, 2, '2023-10-09', '04:38 AM', 0),
(640, 'Referral Accepted', 172, 3, '2023-10-09', '04:38 AM', 0),
(641, 'Referral Declined', 172, 3, '2023-10-09', '04:38 AM', 0),
(642, 'Referral Declined', 172, 3, '2023-10-09', '04:39 AM', 0),
(643, 'Referral Accepted', 172, 1, '2023-10-09', '04:40 AM', 0),
(644, 'New referral', 173, 2, '2023-10-23', '09:11 PM', 0),
(645, 'Referral Accepted', 173, 1, '2023-10-23', '09:11 PM', 0),
(646, 'Referral Accepted', 171, 3, '2023-10-23', '09:12 PM', 0),
(647, 'Referral Accepted', 173, 1, '2023-10-23', '09:12 PM', 0),
(648, 'Referral Declined', 170, 3, '2023-10-23', '09:12 PM', 0),
(649, 'Referral Accepted', 170, 1, '2023-10-23', '09:12 PM', 0),
(650, 'Referral Declined', 170, 3, '2023-10-24', '12:54 AM', 0),
(651, 'Referral Declined', 170, 3, '2023-10-24', '12:54 AM', 0),
(652, 'New referral', 174, 2, '2023-10-25', '12:04 AM', 0),
(653, 'New referral', 175, 2, '2023-10-25', '12:18 AM', 0),
(654, 'New referral', 176, 2, '2023-10-25', '12:21 AM', 0),
(655, 'New referral', 177, 2, '2023-10-25', '12:23 AM', 0),
(656, 'New referral', 178, 2, '2023-10-25', '12:25 AM', 0),
(657, 'New referral', 181, 2, '2023-10-25', '12:29 AM', 0),
(658, 'New referral', 183, 2, '2023-10-25', '12:31 AM', 0),
(659, 'New referral', 185, 2, '2023-10-25', '12:31 AM', 0),
(660, 'New referral', 187, 2, '2023-10-25', '12:31 AM', 0),
(661, 'New referral', 189, 2, '2023-10-25', '12:32 AM', 0),
(662, 'New referral', 191, 2, '2023-10-25', '12:34 AM', 0),
(663, 'New referral', 193, 2, '2023-10-25', '12:36 AM', 0),
(664, 'New referral', 195, 2, '2023-10-25', '12:37 AM', 0),
(665, 'New referral', 197, 2, '2023-10-25', '12:38 AM', 0),
(666, 'New referral', 199, 2, '2023-10-25', '12:39 AM', 0),
(667, 'New referral', 201, 2, '2023-10-25', '12:44 AM', 0),
(668, 'New referral', 203, 2, '2023-10-25', '12:52 AM', 0),
(669, 'New referral', 205, 2, '2023-10-25', '12:57 AM', 0),
(670, 'New referral', 207, 2, '2023-10-25', '12:57 AM', 0),
(671, 'New referral', 208, 2, '2023-10-25', '01:00 AM', 0),
(672, 'New referral', 209, 2, '2023-10-25', '01:04 AM', 0),
(673, 'New referral', 210, 2, '2023-10-25', '01:05 AM', 0),
(674, 'New referral', 211, 2, '2023-10-25', '01:05 AM', 0),
(675, 'New referral', 212, 2, '2023-10-25', '01:08 AM', 0),
(676, 'New referral', 214, 2, '2023-10-25', '01:09 AM', 0),
(677, 'New referral', 216, 2, '2023-10-25', '01:11 AM', 0),
(678, 'New referral', 218, 2, '2023-10-25', '01:11 AM', 0),
(679, 'New referral', 219, 2, '2023-10-25', '01:13 AM', 0),
(680, 'New referral', 220, 2, '2023-10-25', '01:13 AM', 0),
(681, 'New referral', 221, 2, '2023-10-25', '01:14 AM', 0),
(682, 'New referral', 222, 2, '2023-10-25', '01:15 AM', 0),
(683, 'New referral', 223, 2, '2023-10-25', '01:18 AM', 0),
(684, 'New referral', 224, 2, '2023-10-25', '01:19 AM', 0),
(685, 'New referral', 225, 2, '2023-10-25', '01:19 AM', 0),
(686, 'New referral', 226, 2, '2023-10-25', '01:20 AM', 0),
(687, 'New referral', 227, 2, '2023-10-25', '01:21 AM', 0),
(688, 'New referral', 228, 2, '2023-10-25', '01:23 AM', 0),
(689, 'New referral', 229, 2, '2023-10-25', '01:26 AM', 0),
(690, 'New referral', 230, 2, '2023-10-25', '01:27 AM', 0),
(691, 'New referral', 231, 2, '2023-10-25', '01:28 AM', 0),
(692, 'New referral', 232, 2, '2023-10-25', '01:28 AM', 0),
(693, 'New referral', 233, 2, '2023-10-25', '01:31 AM', 0),
(694, 'Referral Accepted', 233, 1, '2023-10-25', '01:35 AM', 0),
(695, 'New referral', 234, 2, '2023-10-25', '01:48 AM', 0),
(696, 'Referral Accepted', 234, 1, '2023-10-25', '01:48 AM', 0),
(697, 'New referral', 235, 2, '2023-10-25', '01:49 AM', 0),
(698, 'Referral Declined', 235, 3, '2023-10-25', '01:50 AM', 0),
(699, 'Referral Accepted', 235, 1, '2023-10-25', '02:00 AM', 0),
(700, 'New referral', 236, 2, '2023-10-25', '02:01 AM', 0),
(701, 'New referral', 237, 2, '2023-10-25', '02:02 AM', 0),
(702, 'Referral Accepted', 237, 3, '2023-10-25', '02:02 AM', 0),
(703, 'Referral Declined', 237, 3, '2023-10-25', '02:02 AM', 0),
(704, 'Referral Declined', 237, 3, '2023-10-25', '02:02 AM', 0),
(705, 'New referral', 238, 2, '2023-10-25', '09:33 AM', 0),
(706, 'Referral Declined', 236, 1, '2023-10-26', '01:54 PM', 0),
(707, 'Referral Declined', 236, 1, '2023-10-26', '01:54 PM', 0),
(708, 'Referral Accepted', 237, 1, '2023-10-26', '04:36 PM', 0),
(709, 'Referral Declined', 236, 1, '2023-10-26', '04:37 PM', 0),
(710, 'Referral Declined', 236, 1, '2023-10-26', '04:37 PM', 0),
(711, 'Referral Declined', 237, 3, '2023-10-26', '04:46 PM', 0),
(712, 'Referral Declined', 235, 3, '2023-10-26', '04:46 PM', 0),
(713, 'New referral', 239, 2, '2023-10-26', '04:49 PM', 0),
(714, 'New referral', 240, 2, '2023-10-26', '04:50 PM', 0),
(715, 'New referral', 241, 2, '2023-10-26', '04:51 PM', 0),
(716, 'New referral', 242, 2, '2023-10-26', '04:51 PM', 0),
(717, 'New referral', 243, 2, '2023-10-26', '04:52 PM', 0),
(718, 'New referral', 244, 2, '2023-10-26', '04:53 PM', 0),
(719, 'New referral', 245, 2, '2023-10-26', '04:53 PM', 0),
(720, 'New referral', 246, 2, '2023-10-26', '04:53 PM', 0),
(721, 'New referral', 247, 2, '2023-10-26', '04:54 PM', 0),
(722, 'New referral', 248, 2, '2023-10-26', '05:17 PM', 0),
(723, 'Referral Accepted', 248, 1, '2023-10-26', '05:17 PM', 0),
(724, 'New referral', 249, 2, '2023-10-26', '06:10 PM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `referral_records`
--

CREATE TABLE `referral_records` (
  `id` int(11) NOT NULL,
  `fclt_id` int(11) NOT NULL,
  `rfrrl_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `referred_hospital` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_records`
--

INSERT INTO `referral_records` (`id`, `fclt_id`, `rfrrl_id`, `date`, `time`, `referred_hospital`, `status`) VALUES
(215, 2, 239, '2023-10-26', '04:49 PM', '3', 'Pending'),
(217, 2, 241, '2023-10-26', '04:51 PM', '3', 'Pending'),
(224, 2, 248, '2023-10-26', '05:17 PM', '1', 'Accepted'),
(225, 2, 249, '2023-10-26', '06:10 PM', '1', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `referral_transaction`
--

CREATE TABLE `referral_transaction` (
  `id` int(11) NOT NULL,
  `fclt_id` int(11) NOT NULL,
  `rfrrl_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_transaction`
--

INSERT INTO `referral_transaction` (`id`, `fclt_id`, `rfrrl_id`, `status`, `date`, `time`, `reason`) VALUES
(56, 1, 248, 'Accepted', '2023-10-26', '05:17 PM', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `second_trimester`
--

CREATE TABLE `second_trimester` (
  `id` int(11) NOT NULL,
  `check-up` varchar(255) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `asdada` varchar(255) NOT NULL,
  `asdaasd` varchar(255) NOT NULL,
  `asd_asd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `second_trimester`
--

INSERT INTO `second_trimester` (`id`, `check-up`, `patients_id`, `asdada`, `asdaasd`, `asd_asd`) VALUES
(11, 'first_checkup', 1, 'second', 'asda', 'asd'),
(12, 'second_checkup', 1, 'asd', 'asd', 'asd'),
(13, 'first_checkup', 9, 'wew', 'wew', 'wew'),
(14, 'first_checkup', 3, 'wew', 'wew', 'wew'),
(15, 'first_checkup', 8, 'aw', 'aw', 'aw'),
(16, 'first_checkup', 6, 'wew', 'wew', 'wew'),
(17, 'first_checkup', 12, 'wew', 'wew', 'wew'),
(18, 'third_checkup', 1, 'aw', 'aw', 'aw'),
(19, 'first_checkup', 2, 'wew', 'wewe', 'wew'),
(20, 'first_checkup', 4, 'aw', 'aw', 'aw'),
(21, 'second_checkup', 4, 'aw', 'aw', 'aw'),
(22, 'third_checkup', 4, 'wew', 'wew', 'wew'),
(23, 'second_checkup', 9, 'aw', 'aw', 'aw'),
(24, 'second_checkup', 6, 'wew', 'wew', 'wew'),
(25, 'first_checkup', 11, 'wew', 'wew', 'wew'),
(26, 'second_checkup', 11, 'wew', 'wew', 'wew'),
(27, 'third_checkup', 9, 'wew', 'wew', 'wew'),
(28, 'second_checkup', 8, 'wew', 'wew', 'wew'),
(29, 'first_checkup', 23, 'aw', 'aw', 'aw'),
(30, 'first_checkup', 19, 'aw', 'aw', 'aw'),
(31, 'first_checkup', 26, 'asd', 'asd', 'asd'),
(32, 'second_checkup', 27, '', '', ''),
(33, 'first_checkup', 28, 'asd', 'asd', 'asd'),
(34, 'second_checkup', 30, 'asda', 'asdad', 'asda'),
(35, 'first_checkup', 29, 'kak', 'kaka', 'kaka'),
(36, 'first_checkup', 34, 'kok', 'kok', 'kok'),
(37, 'first_checkup', 31, 'll', 'lll', 'll'),
(38, 'first_checkup', 33, 'asd', 'asd', 'asd'),
(39, 'first_checkup', 36, 'as', 'as', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `third_trimester`
--

CREATE TABLE `third_trimester` (
  `id` int(11) NOT NULL,
  `check-up` varchar(255) NOT NULL,
  `patients_id` int(11) NOT NULL,
  `asdaasd` varchar(255) NOT NULL,
  `asdad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `third_trimester`
--

INSERT INTO `third_trimester` (`id`, `check-up`, `patients_id`, `asdaasd`, `asdad`) VALUES
(1, 'first_checkup', 1, 'third', 'asd'),
(2, 'first_checkup', 3, 'as', 'asd'),
(3, 'first_checkup', 9, 'asd', 'asd'),
(4, 'first_checkup', 6, 'aw', 'aw'),
(5, 'first_checkup', 12, 'wew', 'wew'),
(6, 'first_checkup', 12, 'wew', 'wew'),
(7, 'first_checkup', 12, 'wew', 'wew'),
(8, 'third_checkup', 1, 'wew', 'wew'),
(9, 'first_checkup', 4, 'aws', 'aws'),
(10, 'second_checkup', 4, 'aw', 'aaw'),
(11, 'third_checkup', 4, 'aw', 'aw'),
(12, 'second_checkup', 9, 'wew', 'wew'),
(13, 'third_checkup', 11, 'wew', 'wew'),
(14, 'second_checkup', 11, 'ww', 'ww'),
(15, 'second_checkup', 8, 'wew', 'wew'),
(16, 'second_checkup', 1, 'safaf', 'asfasa'),
(17, 'first_checkup', 19, 'asda', 'asda'),
(18, 'second_checkup', 19, 'w', 'qvq'),
(19, 'third_checkup', 19, 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `file_path` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersrole` varchar(255) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `usersImg` text NOT NULL,
  `fclt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersrole`, `usersPwd`, `usersImg`, `fclt_id`) VALUES
(7, 'Jezrael Salino', 'jezraelsalino@gmail.com', 'admin', 'Admin', '$2y$10$zyga/EpPBf7Gw8iGIdELGOwxGVV5cKsMPcTG7G7DmDqhop6tdZpBK', 'images/65435628ea089_🤓.png', 0),
(8, 'Jezmahboi', 'jezraelsalino@yahoo.com', 'Jezipoo', 'Staff', '$2y$10$KHzZQ20quKBf7qR/AGUSz.BTjnZjYpm5pHrVOinVYz3Rbo1Ab251i', 'images/boy.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`fclt_id`);

--
-- Indexes for table `first_trimester`
--
ALTER TABLE `first_trimester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_details`
--
ALTER TABLE `patients_details`
  ADD PRIMARY KEY (`patients_details_id`);

--
-- Indexes for table `profile_image`
--
ALTER TABLE `profile_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_format`
--
ALTER TABLE `referral_format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_forms`
--
ALTER TABLE `referral_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_notification`
--
ALTER TABLE `referral_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_records`
--
ALTER TABLE `referral_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_transaction`
--
ALTER TABLE `referral_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `second_trimester`
--
ALTER TABLE `second_trimester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `third_trimester`
--
ALTER TABLE `third_trimester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `fclt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `first_trimester`
--
ALTER TABLE `first_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `patients_details`
--
ALTER TABLE `patients_details`
  MODIFY `patients_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `profile_image`
--
ALTER TABLE `profile_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `referral_format`
--
ALTER TABLE `referral_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `referral_forms`
--
ALTER TABLE `referral_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `referral_notification`
--
ALTER TABLE `referral_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=725;

--
-- AUTO_INCREMENT for table `referral_records`
--
ALTER TABLE `referral_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `referral_transaction`
--
ALTER TABLE `referral_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `second_trimester`
--
ALTER TABLE `second_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `third_trimester`
--
ALTER TABLE `third_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
