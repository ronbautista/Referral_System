-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 12:04 PM
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
-- Table structure for table `accepted_referrals`
--

CREATE TABLE `accepted_referrals` (
  `id` int(11) NOT NULL,
  `fclt_id` int(11) NOT NULL,
  `rfrrl_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accepted_referrals`
--

INSERT INTO `accepted_referrals` (`id`, `fclt_id`, `rfrrl_id`, `status`, `date`, `time`) VALUES
(300, 3, 147, 'accepted', '2023-09-12', '05:49 PM'),
(301, 8, 142, 'accepted', '2023-09-12', '06:29 PM'),
(316, 3, 148, 'accepted', '2023-09-21', '02:02 PM'),
(322, 3, 160, 'Accepted', '2023-09-22', '01:21 PM'),
(323, 3, 161, 'Accepted', '2023-09-22', '04:56 PM');

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
(3, 'Caraga Hospital', '$2y$10$e9OJl./loMHTgS5BJu5grOhWgjGak81GUi1LpK6W0q2.DK5usT6we', '003', 'Hospital', 'Surigao City', ''),
(8, 'Gigaquit RHU', '$2y$10$1NzWlXD0t/r7ya4u1MDrOOH3sbO/ZmUz9990FwRozoX.1fpdscklO', '008', 'Birthing Home', 'Gigaquit', ''),
(10, 'Surigao Del Norte Provincial Hospital', '$2y$10$YWFHX4SDkT3Bp803vcm1XO.RdvBsr8sgaRRiDPjLcfVU/l5WAZtM6', '009', 'Provincial Hospital', 'Surigao del Norte', ''),
(12, 'Miranda', '$2y$10$298VYvJ767szo0IanMnkCOc42ubpxLXcOvOpGDWduA/nrSaRifOHq', '005', 'Birthing Home', 'Surigao City', '');

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
(41, 'first_checkup', 19, 'asd', 'aasd', 'dasda', 'aasda', 'dsa', 'asda', 'asda', 'asd', 'dasda', 'asdd', 'dasd', 'asdsa', 'asd', 'asdad', 'asda');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user1` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `user2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user1`, `message`, `user2`) VALUES
(1, '3', 'hello', '8'),
(2, '3', 'hi', '8'),
(23, '3', 'asddd', '3');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fname`, `mname`, `lname`, `age`, `sex`) VALUES
(19, 'aw', 'aw', 'aw', '11', 'Female'),
(20, 'asd', 'asdad', 'asd', 'asd', 'Male'),
(21, 'aw', 'awaw', 'aw', 'aww', 'Female'),
(22, 'asd', 'asda', 'asdaad', '12', 'Male'),
(23, 'asd', 'asd', 'asd', 'asd', 'Female'),
(24, 'asd', 'asd', 'asd', 'asd', 'Female'),
(25, 'adsas', 'dadasd', 'asd', 'asda', 'Female'),
(26, 'asd', 'asd', 'asd', 'asd', 'Male'),
(27, 'asd', '', 'asd', 'asd', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal`
--

CREATE TABLE `prenatal` (
  `id` int(11) NOT NULL,
  `first_checkup` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `health_status` varchar(255) NOT NULL,
  `last_period` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `pregnancies_count` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_format`
--

CREATE TABLE `referral_format` (
  `id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `fclt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_format`
--

INSERT INTO `referral_format` (`id`, `field_name`, `fclt_id`) VALUES
(67, 'Name', 8),
(68, 'Age', 8),
(121, 'Sex', 3),
(175, 'Hobby', 3),
(178, 'Trip', 3);

-- --------------------------------------------------------

--
-- Table structure for table `referral_forms`
--

CREATE TABLE `referral_forms` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Age` varchar(255) DEFAULT NULL,
  `Sex` varchar(255) DEFAULT NULL,
  `Hobby` varchar(255) DEFAULT NULL,
  `Trip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_forms`
--

INSERT INTO `referral_forms` (`id`, `Name`, `Age`, `Sex`, `Hobby`, `Trip`) VALUES
(158, 'vvv', 'vv', 'vv', 'vv', NULL),
(159, 'Ronald', 'ads', 'adad', 'asda', NULL),
(160, 'asda', 'asda', 'asda', 'asd', NULL),
(161, 'qweqeq', 'qweq', 'qweqqw', 'qweq', NULL);

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
(411, 'New referral', 142, 3, '2023-09-08', '03:03 PM', 0),
(412, 'New referral', 143, 3, '2023-09-08', '03:04 PM', 0),
(413, 'New referral', 144, 3, '2023-09-08', '04:11 PM', 0),
(414, 'New referral', 145, 3, '2023-09-08', '07:56 PM', 0),
(415, 'Referral Accepted', 145, 3, '2023-09-08', '07:56 PM', 0),
(416, 'Referral Declined', 145, 3, '2023-09-08', '07:56 PM', 0),
(417, 'Referral Accepted', 142, 3, '2023-09-08', '09:42 PM', 0),
(418, 'Referral Declined', 142, 3, '2023-09-08', '09:42 PM', 0),
(419, 'Referral Accepted', 142, 3, '2023-09-08', '09:42 PM', 0),
(420, 'Referral Accepted', 143, 3, '2023-09-08', '09:42 PM', 0),
(421, 'Referral Declined', 143, 3, '2023-09-08', '09:42 PM', 0),
(422, 'Referral Declined', 142, 3, '2023-09-08', '09:42 PM', 0),
(423, 'Referral Accepted', 142, 3, '2023-09-08', '09:52 PM', 0),
(424, 'Referral Declined', 142, 3, '2023-09-08', '09:52 PM', 0),
(425, 'New referral', 146, 3, '2023-09-08', '11:01 PM', 0),
(426, 'New referral', 147, 3, '2023-09-08', '11:01 PM', 0),
(427, 'Referral Accepted', 142, 3, '2023-09-08', '11:10 PM', 0),
(428, 'Referral Declined', 142, 3, '2023-09-08', '11:10 PM', 0),
(429, 'Referral Accepted', 142, 3, '2023-09-12', '05:48 PM', 0),
(430, 'Referral Declined', 143, 3, '2023-09-12', '05:48 PM', 0),
(431, 'Referral Declined', 143, 3, '2023-09-12', '05:48 PM', 0),
(432, 'Referral Declined', 147, 3, '2023-09-12', '05:48 PM', 0),
(433, 'Referral Declined', 142, 3, '2023-09-12', '05:49 PM', 0),
(434, 'Referral Accepted', 147, 3, '2023-09-12', '05:49 PM', 0),
(435, 'New referral', 148, 8, '2023-09-12', '06:17 PM', 0),
(436, 'New referral', 149, 8, '2023-09-12', '06:19 PM', 0),
(437, 'New referral', 150, 12, '2023-09-12', '06:24 PM', 0),
(438, 'Referral Accepted', 142, 8, '2023-09-12', '06:29 PM', 0),
(439, 'Referral Declined', 143, 10, '2023-09-12', '07:26 PM', 0),
(440, 'Referral Accepted', 143, 3, '2023-09-12', '07:34 PM', 0),
(441, 'Referral Accepted', 148, 3, '2023-09-12', '07:38 PM', 0),
(442, 'Referral Accepted', 149, 3, '2023-09-12', '07:39 PM', 0),
(443, 'Referral Declined', 149, 3, '2023-09-12', '07:39 PM', 0),
(444, 'Referral Declined', 148, 3, '2023-09-12', '07:39 PM', 0),
(445, 'Referral Declined', 143, 3, '2023-09-12', '07:39 PM', 0),
(446, 'New referral', 151, 8, '2023-09-12', '09:43 PM', 0),
(447, 'Referral Accepted', 150, 3, '2023-09-12', '11:09 PM', 0),
(448, 'Referral Declined', 150, 3, '2023-09-12', '11:09 PM', 0),
(449, 'Referral Accepted', 143, 3, '2023-09-13', '08:38 AM', 0),
(450, 'Referral Accepted', 149, 3, '2023-09-13', '08:38 AM', 0),
(451, 'Referral Declined', 143, 3, '2023-09-13', '08:38 AM', 0),
(452, 'Referral Declined', 149, 3, '2023-09-13', '08:38 AM', 0),
(453, 'Referral Declined', 150, 3, '2023-09-13', '08:38 AM', 0),
(454, 'Referral Declined', 150, 3, '2023-09-17', '12:36 PM', 0),
(455, 'Referral Accepted', 148, 3, '2023-09-17', '01:05 PM', 0),
(456, 'Referral Declined', 148, 3, '2023-09-17', '01:05 PM', 0),
(457, 'Referral Accepted', 148, 3, '2023-09-18', '01:20 PM', 0),
(458, 'Referral Declined', 148, 3, '2023-09-18', '04:18 PM', 0),
(459, 'Referral Accepted', 150, 3, '2023-09-18', '04:19 PM', 0),
(460, 'Referral Declined', 150, 3, '2023-09-18', '04:20 PM', 0),
(461, 'Referral Accepted', 151, 3, '2023-09-18', '04:32 PM', 0),
(462, 'Referral Declined', 151, 3, '2023-09-18', '05:44 PM', 0),
(463, 'Referral Accepted', 150, 3, '2023-09-18', '05:44 PM', 0),
(464, 'Referral Accepted', 150, 3, '2023-09-18', '05:44 PM', 0),
(465, 'Referral Declined', 150, 3, '2023-09-18', '05:44 PM', 0),
(466, 'Referral Accepted', 150, 3, '2023-09-18', '05:44 PM', 0),
(467, 'Referral Declined', 150, 3, '2023-09-18', '05:44 PM', 0),
(468, 'Referral Accepted', 150, 3, '2023-09-18', '05:44 PM', 0),
(469, 'Referral Declined', 150, 3, '2023-09-18', '05:44 PM', 0),
(470, 'New referral', 152, 8, '2023-09-18', '06:00 PM', 0),
(471, 'New referral', 153, 8, '2023-09-18', '06:00 PM', 0),
(472, 'New referral', 154, 8, '2023-09-18', '06:01 PM', 0),
(473, 'New referral', 155, 8, '2023-09-18', '06:01 PM', 0),
(474, 'New referral', 156, 8, '2023-09-21', '01:59 PM', 0),
(475, 'Referral Accepted', 148, 3, '2023-09-21', '02:02 PM', 0),
(476, 'New referral', 157, 8, '2023-09-21', '02:22 PM', 0),
(477, 'New referral', 158, 8, '2023-09-21', '02:27 PM', 0),
(478, 'New referral', 159, 8, '2023-09-21', '02:43 PM', 0),
(479, 'Referral Accepted', 159, 3, '2023-09-21', '02:50 PM', 0),
(480, 'Referral Declined', 159, 3, '2023-09-21', '02:52 PM', 0),
(481, 'Referral Accepted', 158, 3, '2023-09-21', '02:52 PM', 0),
(482, 'Referral Declined', 158, 3, '2023-09-21', '02:52 PM', 0),
(483, 'Referral Accepted', 158, 3, '2023-09-21', '02:53 PM', 0),
(484, 'Referral Accepted', 159, 3, '2023-09-21', '02:53 PM', 0),
(485, 'Referral Declined', 159, 3, '2023-09-21', '02:53 PM', 0),
(486, 'New referral', 160, 8, '2023-09-21', '02:53 PM', 0),
(487, 'Referral Accepted', 159, 3, '2023-09-21', '11:33 PM', 0),
(488, 'Referral Declined', 159, 3, '2023-09-21', '11:33 PM', 0),
(489, 'Referral Declined', 158, 3, '2023-09-22', '01:20 PM', 0),
(490, 'Referral Accepted', 160, 3, '2023-09-22', '01:21 PM', 0),
(491, 'New referral', 161, 8, '2023-09-22', '01:42 PM', 0),
(492, 'Referral Accepted', 161, 3, '2023-09-22', '04:56 PM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `referral_records`
--

CREATE TABLE `referral_records` (
  `id` int(11) NOT NULL,
  `fclt_id` int(11) NOT NULL,
  `rfrrl_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referral_records`
--

INSERT INTO `referral_records` (`id`, `fclt_id`, `rfrrl_id`, `status`, `date`, `time`) VALUES
(152, 8, 158, 'Pending', '2023-09-21', '02:27 PM'),
(153, 8, 159, 'Pending', '2023-09-21', '02:43 PM'),
(154, 8, 160, 'Accepted', '2023-09-21', '02:53 PM'),
(155, 8, 161, 'Accepted', '2023-09-22', '01:42 PM');

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
(31, 'first_checkup', 26, 'asd', 'asd', 'asd');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `fclt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`, `fclt_id`) VALUES
(7, 'Jezrael Salino', 'jezraelsalino@gmail.com', 'admin', '$2y$10$zyga/EpPBf7Gw8iGIdELGOwxGVV5cKsMPcTG7G7DmDqhop6tdZpBK', 0),
(8, 'Jezmahboi', 'jezraelsalino@yahoo.com', 'Jezipoo', '$2y$10$KHzZQ20quKBf7qR/AGUSz.BTjnZjYpm5pHrVOinVYz3Rbo1Ab251i', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_referrals`
--
ALTER TABLE `accepted_referrals`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `prenatal`
--
ALTER TABLE `prenatal`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_referrals`
--
ALTER TABLE `accepted_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `fclt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `first_trimester`
--
ALTER TABLE `first_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `prenatal`
--
ALTER TABLE `prenatal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_format`
--
ALTER TABLE `referral_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `referral_forms`
--
ALTER TABLE `referral_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `referral_notification`
--
ALTER TABLE `referral_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;

--
-- AUTO_INCREMENT for table `referral_records`
--
ALTER TABLE `referral_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `second_trimester`
--
ALTER TABLE `second_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `third_trimester`
--
ALTER TABLE `third_trimester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
