-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 12:03 PM
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
(3, 'Caraga Hospital', '$2y$10$e9OJl./loMHTgS5BJu5grOhWgjGak81GUi1LpK6W0q2.DK5usT6we', '003', 'Hospital', 'Surigao City', ''),
(8, 'Gigaquit RHU', '$2y$10$1NzWlXD0t/r7ya4u1MDrOOH3sbO/ZmUz9990FwRozoX.1fpdscklO', '008', 'Birthing Home', 'Gigaquit', ''),
(10, 'Surigao Del Norte Provincial Hospital', '$2y$10$YWFHX4SDkT3Bp803vcm1XO.RdvBsr8sgaRRiDPjLcfVU/l5WAZtM6', '009', 'Provincial Hospital', 'Surigao del Norte', ''),
(12, 'Miranda', '$2y$10$298VYvJ767szo0IanMnkCOc42ubpxLXcOvOpGDWduA/nrSaRifOHq', '005', 'Birthing Home', 'Surigao City', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`fclt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `fclt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
