-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 01:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookly_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_services`
--

CREATE TABLE `add_services` (
  `id` int(255) NOT NULL,
  `trip_id` int(255) NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `hotel_price` int(255) NOT NULL,
  `hotel_img` varchar(255) NOT NULL,
  `transpot_type` varchar(255) NOT NULL,
  `transpot_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_services`
--

INSERT INTO `add_services` (`id`, `trip_id`, `trip_name`, `hotel_name`, `hotel_price`, `hotel_img`, `transpot_type`, `transpot_price`) VALUES
(159, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Gold-Coast-thum-C.jpg', 'demo', 2928),
(160, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Gold-Coast-thum-C.jpg', 'demo', 2928),
(161, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Kuranda.jpg', 'demo', 982727);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bus_number` varchar(255) NOT NULL,
  `driver_number` int(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `destination` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `bus_number`, `driver_number`, `image`, `destination`) VALUES
(1, '', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Andaman'),
(2, '', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Andaman'),
(3, 'demo', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Andaman');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `detail`, `image`) VALUES
(1, 'safari', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '434640551_939914594451063_1420271604648352858_n.jpg'),
(2, 'beach category', 'SDSKSJNKJS', 'trip-types (5).jpg'),
(3, 'demo', 'SDSKSJNKJS', 'trip-types (4).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact-us-message`
--

CREATE TABLE `contact-us-message` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact-us-message`
--

INSERT INTO `contact-us-message` (`id`, `name`, `email`, `message`) VALUES
(1, 'krushil', 'ck@gmail.com', 'hello how are you'),
(2, 'krushil', 'ck@gmail.com', 'hello how are you');

-- --------------------------------------------------------

--
-- Table structure for table `coupen`
--

CREATE TABLE `coupen` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupen`
--

INSERT INTO `coupen` (`id`, `name`, `code`, `image`) VALUES
(2, 'demo123', 'demo0-1092', 'activites-img (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `name`, `detail`, `image`) VALUES
(11, 'Andaman', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Andaman-17.jpg'),
(12, 'Austaliya', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'SRP_brisbane-city.jpg'),
(13, 'Bali', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Bali-2.jpg'),
(14, 'Kedarnath Yatra', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Summer-Spiritual-Journey---Luxury.jpg'),
(15, 'Dubai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Bhurj_Khalifa_Dubai.jpg'),
(16, 'Egypt', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Egypt (2).jpg'),
(17, 'Europe', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Salzburg-Austria-3.jpg'),
(18, 'Goa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Goa-1.jpg'),
(19, 'Gujrat Tours', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Dwarka-Krishna-Temple.jpg'),
(20, 'Himachal ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Shimla-Manali.jpg'),
(21, 'India', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'imdia.jpg'),
(22, 'Kashmir', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'DallakeKashmir.jpg'),
(23, 'Kerala', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'kerala (3).jpg'),
(24, 'Laskha Dweep ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'LaskhaDweep-srp.jpg'),
(25, 'Maldives', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'SRP_Cantara-ras.jpg'),
(26, 'Mauritius', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'SRP-Oceans-Creek.jpg'),
(27, 'Rajash-than', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Desert.jpg'),
(28, 'Sikkim', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'tshangulake-north east.jpg'),
(29, 'Singapore', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'SINGAPORE-2.jpg'),
(30, 'South Africa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'SA_Cape-Town-city-Thum-img.jpg'),
(31, 'Thailand / Bangkok', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Bangkok.jpg'),
(32, 'Turkey', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'images.jpg'),
(33, 'Vietnam', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Da Nang-thum.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `addresss` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `person_contact` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `addresss`, `location`, `person_contact`, `image`) VALUES
(1, 'cruise', 'lonawala', 'Andaman', 2147483647, 'CordeliaCruises_SRP1.jpg'),
(2, 'burger Villa', 'in the near guhu beach', 'goa', 989898989, 'dsds.jpeg'),
(3, 'burger Villa', 'in the near guhu beach', 'goa', 989898989, 'dsds.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `trip_days` int(100) NOT NULL,
  `trip_nights` int(100) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL,
  `category_names` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `name`, `price`, `detail`, `image`, `trip_days`, `trip_nights`, `destination`, `types`, `category_names`, `auther`) VALUES
(69, 'kurandra', 900, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ', 'Kuranda.jpg', 6, 4, 'Andaman', 'With Family', '', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `detail`, `image`) VALUES
(3, 'Boating Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Boating.jpg'),
(4, 'Camping Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Camping.jpg'),
(5, 'Dog Friendly', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Dog Friendly.jpg'),
(6, 'Historical Place Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Historycal place.jpg'),
(7, 'In Mountail Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'In Mountain.jpg'),
(8, 'Jungle Safari Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Jungle Safari.jpg'),
(9, 'Best Lack VIew', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'lake view.jpg'),
(10, 'Sea Bath', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sea bath.jpg'),
(11, 'With Family', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'With Family.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(16, 'krushil', 'krushilchabhadiya600@gmail.com', 'dd0c928bed78ef49993ba96e4bacc1c7', 'User'),
(17, 'demo', 'demo@gmail.com', 'f702c1502be8e55f4208d69419f50d0a', 'Admin'),
(18, 'ck', 'ck@gmail.com', '1f737fb6f9bd06c9a153daf0d1ec0b89', 'User'),
(19, 'demo-4', 'demo4@gmail.com', '725d59206ff82f128ee61e8a3068a6b4', 'User'),
(20, 'demo10', 'demo10@gmail.com', '43514a20c7801ebd4b1e6769939dd95f', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_services`
--
ALTER TABLE `add_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact-us-message`
--
ALTER TABLE `contact-us-message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupen`
--
ALTER TABLE `coupen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_services`
--
ALTER TABLE `add_services`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact-us-message`
--
ALTER TABLE `contact-us-message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupen`
--
ALTER TABLE `coupen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
