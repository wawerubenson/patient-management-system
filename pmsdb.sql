-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2023 at 09:02 PM
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
-- Database: `pmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `patient_phone` int(255) NOT NULL,
  `dob` date NOT NULL,
  `weight` int(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `reg_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `patient_name`, `patient_email`, `patient_phone`, `dob`, `weight`, `gender`, `blood_type`, `author_name`, `reg_time`) VALUES
(2, 'John Doe', 'anndoee@gmail.com', 35, '2023-03-26', 78, 'male', 'B+', 'Gello', '2023-03-20 19:28:18'),
(3, 'Kiongo', 'kiongo@gmail.com', 67, '2023-03-06', 78, 'male', 'B+', 'Gello', '2023-03-20 19:55:43'),
(4, 'kogi', 'kogi@gmail.com', 7965433, '2023-03-30', 78, 'male', 'B+', '', '2023-03-21 08:49:57'),
(5, 'hkj', 'anndoe@gmail.com', 6756, '2023-03-30', 77, 'male', 'B+', 'Gello', '2023-03-22 08:21:34'),
(6, 'Alice Ann', 'koi@gmail.com', 798363535, '2023-03-14', 87, 'male', 'B+', 'Gello', '2023-03-22 12:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `symptoms` varchar(255) NOT NULL,
  `drugs` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_name`, `patient_id`, `symptoms`, `drugs`, `doctor_name`, `post_time`) VALUES
(7, 'hkj', 5, 'hgh', 'uuu', 'Gello', '2023-03-22 05:21:50'),
(8, 'Alice Ann', 6, 'headache', 'panadol', 'Gello', '2023-03-22 09:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `served_patients`
--

CREATE TABLE `served_patients` (
  `id` int(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_id` int(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `patient_phone` int(255) NOT NULL,
  `patient_weight` int(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `adm_date` datetime NOT NULL,
  `reg_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `served_patients`
--

INSERT INTO `served_patients` (`id`, `patient_name`, `patient_id`, `patient_email`, `patient_phone`, `patient_weight`, `blood_type`, `gender`, `adm_date`, `reg_time`) VALUES
(1, 'John Doe', 0, 'anndoee@gmail.com', 35, 35, 'B+', 'male', '2023-03-20 19:28:18', '2023-03-20 19:28:50'),
(2, 'John Doe', 2, 'anndoee@gmail.com', 35, 35, 'B+', 'male', '2023-03-20 19:28:18', '2023-03-20 19:45:09'),
(3, 'Alice Ann', 1, 'johndoe@gmail.con', 5678, 5678, 'B+', 'female', '2023-03-20 19:27:58', '2023-03-20 19:54:38'),
(4, 'kogi', 4, 'kogi@gmail.com', 7965433, 7965433, 'B+', 'male', '2023-03-21 08:49:57', '2023-03-21 08:51:18'),
(5, 'Kiongo', 3, 'kiongo@gmail.com', 67, 67, 'B+', 'male', '2023-03-20 19:55:43', '2023-03-21 08:51:50'),
(6, 'hkj', 5, 'anndoe@gmail.com', 6756, 6756, 'B+', 'male', '2023-03-22 08:21:34', '2023-03-22 08:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `is_admin` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `role`, `password`, `profile_photo`, `is_admin`) VALUES
(1, 'samwel', 'muriuki', 'samwelwambo20@gmail.com', 'doctor', '$2y$10$FjM1W8Asc15iYw.p8mDXgexiiFdxLHNowbpFLPJK7a5llaG5/bGv6', '1679143737167845037616780384841676967579water-melon.jpg', 2),
(2, 'wambui', 'muriuki', 'wambuimuriuki@gmail.com', 'pharmacist', '$2y$10$lxRYw8Qq2m1MVW4k0J80IuEgQ5wjmrcYqCUaZWaHYHax2ibiocqU2', '167914382516780394761676956325peas.jpg', 2),
(3, 'Gello', 'Kogello', 'gello@gmail.com', 'doctor', '$2y$10$g.jkZIi9NK/S30stWy2Fwem.EJrbHCianFmuA3NWlE9a60ideKtfW', '167932187216780391281677871322IMG_20220501_133622_542.jpg', 1),
(4, 'Ben', 'Kogello', 'kogi@gmail.com', 'pharmacist', '$2y$10$OKeYwW.bNcDYQuTHjONDDOwcuuXxCGv.uRHbhPHYdhc98QyinseRW', '167947469816780384841676967579water-melon.jpg', 2),
(5, 'Ben', 'Kogello', 'kog@gmail.com', 'doctor', '$2y$10$NQHvnxjSV1lk8yYH8nODU.5FCzzQJXLa1FNHF20tysT398BHM70qW', '1679475625', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `served_patients`
--
ALTER TABLE `served_patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `served_patients`
--
ALTER TABLE `served_patients`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
