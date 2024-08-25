-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 08:47 PM
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
  `transpot_price` int(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_services`
--

INSERT INTO `add_services` (`id`, `trip_id`, `trip_name`, `hotel_name`, `hotel_price`, `hotel_img`, `transpot_type`, `transpot_price`, `auther`) VALUES
(159, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Gold-Coast-thum-C.jpg', 'demo', 2928, '0'),
(160, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Gold-Coast-thum-C.jpg', 'demo', 2928, '0'),
(161, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Kuranda.jpg', 'demo', 982727, '0'),
(162, 69, 'kurandra', 'cruise-01', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/1-426x574-425x573.jpg', 'ranutsav', 2000, 'demo');

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
  `destination` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `name`, `bus_number`, `driver_number`, `image`, `destination`, `auther`) VALUES
(2, 'Los Angles-2', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Mauritius', ''),
(3, 'demo', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Maldives', ''),
(4, 'ranutsav', '7876', 2147483647, 'Best-Time-to-Visit-Gujarat.jpg', 'Sikkim', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `detail`, `image`, `auther`) VALUES
(2, 'beach category', 'SDSKSJNKJS', 'trip-types (5).jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_message`
--

CREATE TABLE `contact_us_message` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us_message`
--

INSERT INTO `contact_us_message` (`id`, `name`, `email`, `message`) VALUES
(2, 'demo', 'demo@gmail.com', 'hi this is the demo line'),
(3, 'demo', 'demo@gmail.com', 'contact form');

-- --------------------------------------------------------

--
-- Table structure for table `coupen`
--

CREATE TABLE `coupen` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupen`
--

INSERT INTO `coupen` (`id`, `name`, `code`, `image`, `auther`) VALUES
(3, 'Special coupen', 'Ck-010101', '2149153260.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `day_wise_secudle`
--

CREATE TABLE `day_wise_secudle` (
  `id` int(255) NOT NULL,
  `trip_id` int(255) NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `days` int(255) NOT NULL,
  `day_1` varchar(255) NOT NULL,
  `day_2` varchar(255) NOT NULL,
  `day_3` varchar(255) NOT NULL,
  `day_4` varchar(255) NOT NULL,
  `day_5` varchar(255) NOT NULL,
  `day_6` varchar(255) NOT NULL,
  `day_7` varchar(255) NOT NULL,
  `day_8` varchar(255) NOT NULL,
  `day_9` varchar(255) NOT NULL,
  `day_10` varchar(255) NOT NULL,
  `day_11` varchar(255) NOT NULL,
  `day_12` varchar(255) NOT NULL,
  `day_13` varchar(255) NOT NULL,
  `day_14` varchar(255) NOT NULL,
  `day_15` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `day_wise_secudle`
--

INSERT INTO `day_wise_secudle` (`id`, `trip_id`, `trip_name`, `destination`, `days`, `day_1`, `day_2`, `day_3`, `day_4`, `day_5`, `day_6`, `day_7`, `day_8`, `day_9`, `day_10`, `day_11`, `day_12`, `day_13`, `day_14`, `day_15`, `auther`) VALUES
(13, 70, 'Amarica', 'Andaman', 3, 'demo', 'demo-2', 'demo', '', '', '', '', '', '', '', '', '', '', '', '', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `name`, `detail`, `image`, `auther`) VALUES
(11, 'Andaman', 'About Andaman Holidays: Andaman and Nicobar Islands are one of India’s two island union territories in the Bay of Bengal. In\nlate 2018, the Government of India renamed Havelock Island as Swaraj Dweep, Neil Island as Shaheed Dweep, and Ross Island as Neta', 'Andaman-17.jpg', ''),
(12, 'Austaliya', 'Australia is a land of dreams. From the Aboriginal culture, coral reefs, rainforests, and scorched, red deserts, it\r\nhas all, with some quirkiest wildlife on the planet. Australia is also a land of staggering contrast and spectacular beauty. Along the coa', 'SRP_brisbane-city.jpg', ''),
(13, 'Bali', 'Bali is the crown jewel of tourism in Indonesia. It is also one of the most sought-after holiday destinations in all of Southeast Asia. It is a\r\nplace where culture meets nature and spirituality, making it a perfect choice for those seeking Bali tour pack', 'Bali-2.jpg', ''),
(14, 'Kedarnath Yatra', 'Kedarnath is a town and Nagar Panchayat in Rudraprayag district of Uttarakhand, India, known primarily for the Kedarnath Temple. It is approximately 86 kilometres from Rudraprayag, the district headquarter. Kedarnath is the most remote of the four Chota C', 'Summer-Spiritual-Journey---Luxury.jpg', ''),
(15, 'Dubai', 'Dubai is the most populous city in the United Arab Emirates (UAE). It used to be a small fishing village back in the 18th century but has now\r\nbecome one of the most developed and luxurious places in the world. Dubai ranks among the top lavish tourist des', 'Bhurj_Khalifa_Dubai.jpg', ''),
(16, 'Egypt', 'There is more to Egypt than just pyramids. This country welcomes every tourist with its magnificent mountains, the\r\ndeserts, long and historical past and not to forget the mighty river Nile. You are bound to fall in love with this sandy country the time y', 'Egypt (2).jpg', ''),
(17, 'Europe', '\r\nAsk anyone with wanderlust about the best continent to travel to in the world and the probability of Europe being the answer is quite high.\r\nBlessed with some of the most picturesque countries, Europe is a delight for tourists. Europe is the most visite', 'Salzburg-Austria-3.jpg', ''),
(18, 'Goa', 'Planning a Goa Trip Has Never Been This Easy: Whether you are looking to kick back and relax by the beach, or are a\r\nparty-lover who wants to go club-hopping and dancing, Goa is your ultimate destination. Goa holidays are simply the best! This place has i', 'Goa-1.jpg', ''),
(20, 'Himachal ', 'The picturesque state of Himachal Pradesh is nestled between the snow-topped Himalayan ranges in North India. Known for its panoramic\r\nlandscapes, this spectacular paradise is blessed with lofty snow peaks, deep gorges, verdant valleys, thundering rivers,', 'Shimla-Manali.jpg', ''),
(23, 'Kerala', 'The Indian state of Kerala is located on the Malabar Coast and is bordered by Tamil Nadu, Karnataka and the Lakshadweep Sea. It has developed\r\ninto a major tourist destination in recent years, thanks to its beautiful collection of lakes, backwaters, beach', 'kerala (3).jpg', ''),
(24, 'Laskha Dweep ', 'Exploring the serene archipelago of Lakshadweep is a dream for many, and SOTC unveils a myriad of captivating opportunities through its\r\nmeticulously crafted Lakshadweep tour packages. With a year of immersion in the travel content domain, delving into th', 'LaskhaDweep-srp.jpg', ''),
(25, 'Maldives', 'The archipelagic state of Maldives is a part of South Asia and is among the most popular international holiday destinations in the world.\r\nOfficially called the Republic of Maldives, this island country is situated in the Indian Ocean, geographically sout', 'SRP_Cantara-ras.jpg', ''),
(26, 'Mauritius', 'Mauritius, a heavenly island country located in the Indian Ocean is home to some of the most beautiful landscapes\r\nand reefs in the world. The beautiful coral reefs that surround the island give this tourist destination the perfect setting while the islan', 'SRP-Oceans-Creek.jpg', ''),
(27, 'Rajash-than', 'the world go on a trip to Rajasthan every year to enjoy its diverse tourism experience. Apart from its rich history, Rajasthan is known for its colourful and vibrant culture and traditions, delicious cuisine, beautiful cities, jaw-dropping natural beauty,', 'Desert.jpg', ''),
(28, 'Sikkim', 'The paradise located amongst the high soaring Eastern Himalayas, Sikkim is a magnificent destination and has become one of the most desired\r\nvacation spots in the country. It is known for its natural beauty, panoramic views, and vibrant meadows. It also s', 'tshangulake-north east.jpg', ''),
(29, 'Singapore', 'Singapore, located in maritime southeast Asia, is a city-state and an island country. Its entire territory is made\r\nup of a main island, one outlying islets and about 63 satellite islands and islets. It is popularly described as a quintessential cosmopoli', 'SINGAPORE-2.jpg', ''),
(30, 'South Africa', 'One of the dream destinations for many people across the world, South Africa has always been known for its\r\nunmatched natural beauty and wildlife. The southernmost part of Africa has a rich history and equally rich biodiversity making South Africa tourism', 'SA_Cape-Town-city-Thum-img.jpg', ''),
(31, 'Thailand / Bangkok', 'The beautiful tropical country of Thailand is world-renowned for its natural and manmade tourist attractions. From pristine beaches to bustling\r\nmarkets, and majestic Buddhist temples to urban havens, the South-East Asian country has a sublime concoction ', 'Bangkok.jpg', ''),
(33, 'Vietnam', 'Vietnam, officially called the Socialist Republic of Vietnam (SRV), is a country in the eastern region of Southeast Asia’s mainland. It is\r\npopularly referred to as a crown jewel of tourism in the continent for a wide number of reasons. The country has be', 'Da Nang-thum.jpg', ''),
(39, ' Turkey', 'Those wanting to see all the amazing sights without having to worry about the logistics should look no further than the SOTC Turkey packages. Our Turkey tours are designed to help travellers make the most of their time in the country. We’ll take care of a', 'images (3).jpg', 'demo');

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
  `image` varchar(100) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `addresss`, `location`, `person_contact`, `image`, `auther`) VALUES
(1, 'cruise-01', 'lonawala', 'Sikkim', 2147483647, 'CordeliaCruises_SRP1.jpg', ''),
(4, 'demo-01', 'jetpur', 'Laskha Dweep ', 938348, 'GettyImages-1432005421-5c0bc8d84cedfd0001fa5acb.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `trip_days` int(100) NOT NULL,
  `trip_nights` int(100) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `types` varchar(255) NOT NULL,
  `featured` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `name`, `price`, `detail`, `image`, `trip_days`, `trip_nights`, `destination`, `types`, `featured`, `auther`) VALUES
(69, 'Amazing Australia 9N-10D International Customized Tour Package With Optional Flight', 143000, 'Things to Do in Australia : -\\r\\nOnce you are clear to travel, there are tons of things to do in this unique, spectacular country.', 'Kuranda.jpg', 10, 9, 'Austaliya', 'Boating Trips,Camping Trips,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,Sea Bath,With Family', '', 'demo'),
(70, 'America -  (Foreign trip) –  – 4n and 5d', 123900, 'Best Time to visit USA\\r\\nIf you’re keen on experiencing the wonder of this amazing country, consider taking a US tour around the spring season, i.e., sometime between the end of March and late May. It is the best time to visit the USA since the climate i', 'SRp-lasvegas.jpg', 5, 4, 'Austaliya', 'Boating Trips,Camping Trips,Historical Place Trips,Jungle Safari Trips,With Family', '', 'demo'),
(71, ' Enchanting Egypt (Fixed Departures) 6N-7D International Customized Tour Package', 82000, 'Best Time to Visit Egypt\\r\\nEgypt is one country that can be visited at any time of the year. However, the best moments are captured while on your travel to Egypt is from February to April. These months are perfect to explore the top attractions like the ', 'petra1_SRP.jpg', 7, 6, 'Andaman', 'Historical Place Trips,In Mountail Trips,With Family', '', 'demo'),
(72, 'Grand Tour Of South Africa 7N 8D', 142000, 'Best Places to Visit in South Africa South Africa is dotted with various places that are well worth visiting. Every place has attractions witnessing which will make your South Africa tours worth it. Here are some of the places to visit in South Africa tha', 'SA_Cape-Town-city-Thum-img.jpg', 8, 7, 'South Africa', 'Boating Trips,Dog Friendly,Historical Place Trips,In Mountail Trips,With Family', '', 'demo'),
(73, ' Turkey with luxury stay – 6N and 7D', 68000, 'Best Time to Visit Turkey Turkey is a land of incredible natural beauty and rich cultural heritage. Situated at the crossroads of Europe and Asia, Turkey has something to offer to everyone, making our Turkey tour packages from India immensely popular. Whe', 'images (2).jpg', 7, 6, ' Turkey', 'Camping Trips,In Mountail Trips,With Family', '', 'demo'),
(74, 'bali with water sport activites - 6N and 7D', 72000, 'Discover an array of itineraries and choose from Bali tour packages with or without flights. Theme-based Bali holiday packages are also available from SOTC such as Simply Bali, International Winter, International Cruise, customizable packages. To assist y', 'bali-imgs (2).jpg', 7, 6, 'Andaman', 'Boating Trips,Camping Trips,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,Best Lack VIew,With Family', 'Featured', 'demo'),
(75, 'Dubai With Abu Dhabi + Deser safar + Burj khalifa 6N-7D International Tour Package', 92000, 'Best Places to visit in Dubai The places that you can visit in Dubai are segregated into various sections. Each one of them is worth visiting. Although you can decide the attractions you want to cover while opting for the Dubai tourist packages, you can s', 'Dubai26734.jpg', 7, 6, 'Andaman', 'Boating Trips,Historical Place Trips,Jungle Safari Trips,Best Lack VIew,With Family', 'Featured', 'demo'),
(76, 'Thailand – pattaya & Bangkok 4N – 5D', 24600, 'Best time to visit Thailand You have to consider a lot of factors when scheduling your Thailand trip, such as the places you want to visit, the type of activities you want to experience, etc. Generally, the period between November and April is considered ', 'bangkokStreet.jpg', 5, 4, 'Andaman', 'Boating Trips,Camping Trips,Dog Friendly,Historical Place Trips,Best Lack VIew,With Family', 'Featured', 'demo'),
(77, 'North Goa 3N-4D Domestic Customized Tour Package', 8500, 'Overview :- Planning a Goa Trip Has Never Been This Easy: Whether you are looking to kick back and relax by the beach, or are a', 'Zuriwhitesands3.jpg', 4, 3, 'Andaman', 'Boating Trips,Dog Friendly,In Mountail Trips,Jungle Safari Trips,Best Lack VIew,With Family', 'Featured', 'demo'),
(78, 'kedarnath – 6N 7D  ', 16500, 'Overview :- In the Rudraprayag area of the Uttarakhand state in northern India, there lies a sacred town called Kedarnath. Located above sea level it is one', 'Kedarnath_temple_C_THUM.jpg', 8, 7, 'Kedarnath Yatra', 'Camping Trips,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,With Family', '', 'demo'),
(79, 'Rishikesh', 10000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, ', 'RISHIKESH_C.jpg', 6, 5, 'Andaman', '', 'Special', 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `detail`, `image`, `auther`) VALUES
(3, 'Boating Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Boating.jpg', ''),
(4, 'Camping Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Camping.jpg', ''),
(5, 'Dog Friendly', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Dog Friendly.jpg', ''),
(6, 'Historical Place Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Historycal place.jpg', ''),
(7, 'In Mountail Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'In Mountain.jpg', ''),
(8, 'Jungle Safari Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Jungle Safari.jpg', ''),
(9, 'Best Lack VIew', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'lake view.jpg', ''),
(10, 'Sea Bath', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sea bath.jpg', ''),
(11, 'With Family', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'With Family.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `user_type`, `auther`) VALUES
(16, 'krushil', 'krushilchabhadiya600@gmail.com', 'dd0c928bed78ef49993ba96e4bacc1c7', 'User', ''),
(17, 'demo', 'demo@gmail.com', 'f702c1502be8e55f4208d69419f50d0a', 'Admin', ''),
(18, 'ck', 'ck600@gmail.com', '1f737fb6f9bd06c9a153daf0d1ec0b89', 'User', '');

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
-- Indexes for table `contact_us_message`
--
ALTER TABLE `contact_us_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupen`
--
ALTER TABLE `coupen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_wise_secudle`
--
ALTER TABLE `day_wise_secudle`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us_message`
--
ALTER TABLE `contact_us_message`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupen`
--
ALTER TABLE `coupen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `day_wise_secudle`
--
ALTER TABLE `day_wise_secudle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
