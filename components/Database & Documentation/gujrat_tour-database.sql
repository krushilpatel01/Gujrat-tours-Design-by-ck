-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 03:24 PM
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
-- Database: `gujrat_tour-database`
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
(159, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Gold-Coast-thum-C.jpg', 'demo', 2928, 'ck\r\n'),
(160, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Gold-Coast-thum-C.jpg', 'demo', 2928, 'ck'),
(161, 63, 'Laskha Dweep Trip', 'cruise', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/Kuranda.jpg', 'demo', 982727, 'ck'),
(162, 69, 'kurandra', 'cruise-01', 1000, 'C:/xampp/htdocs/Gujrat-tours/AdminLTE-3.2.0/pages/trips-setting/uploads/1-426x574-425x573.jpg', 'ranutsav', 2000, 'ck');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(100) NOT NULL,
  `blog_img` varchar(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_desc` varchar(255) NOT NULL,
  `blog_action` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `blog_img`, `blog_title`, `blog_desc`, `blog_action`) VALUES
(4, 'blog-img/author-1.jpg', 'blog', 'blog012', 'feature');

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
(2, 'Los Angles-2', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Mauritius', 'ck'),
(3, 'demo', '9080', 2147483647, 'LaskhaDweep-srp.jpg', 'Maldives', 'ck'),
(4, 'ranutsav', '7876', 2147483647, 'Best-Time-to-Visit-Gujarat.jpg', 'Sikkim', 'ck');

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
(4, 'hii', 'hii@gmail.com', 'ksdnakdnkjs');

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
(3, 'Special coupen', 'Ck-010101', '2149153260.jpg', 'ck');

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
(13, 70, 'Amarica', 'Andaman', 3, 'demo', 'demo-2', 'demo', '', '', '', '', '', '', '', '', '', '', '', '', 'ck'),
(14, 69, 'Amazing Australia 9N-10D International Customized Tour Package With Optional Flight', 'Austaliya', 10, 'Welcome to Melbourne! Australia&#039;s Mecca of all things trendy and tasty, Melbourne offers up exquisite dining, exhilarating sport and abundant opportunities to experience art. Upon your arrival into Melbourne Airport, you will have a shared transfer t', 'After Breakfast, you will proceed for Phillip Island day tour, you’ll visit Brighton Beach’s colourful huts &amp; meet local wildlife at a multi-award-winning conservation park before reaching Phillip Island &amp; the highlight of the tour – the extraordi', 'Today after breakfast, head on for one of the most spectacular coastal drives – Great Ocean Road tour. See the abundance of Australian wildlife, whilst checking out the magnificent surf beaches, and walk amongst the ancient rainforest, before arriving in ', 'Enjoy your breakfast, Check Out from the Hotel and avail a shared transfer to the Tullamarine airport your onward flight to Brisbane (flight cost not Included)  After arriving at Brisbane Airport you will have a shared transfer to CBD Hotel and complete c', 'After Breakfast gear up for an exciting day. With Single day admission to Movie World, Sea World, Wet&#039;n&#039;Wild and Paradise Country over 5 consecutive days from first use, you will make the best of this pass more so this ticket offers the flexibil', 'Post breakfast, you will have the opportunity to Save time and money with this convenient pass for admission of Australian Gold Coast&#039;s most popular theme parks: Sea World, Paradise Country. Movie World, and Wet&#039;n&#039;Wild. Zoom around on rolle', 'Enjoy your breakfast, Check Out from the Hotel and avail a shared transfer to the airport for the onward flight to Sydney (Flight cost not Included)  Welcome to Sydney! After arriving at Sydney Airport, you will have a shared transfer to Sydney CBD Hotel ', 'Post Breakfast, explore the best of Sydney with Big Bus Tours. Visit Sydney&#039;s famous landmarks and attractions on our City Tour. Hop on and hop off as much as you like, or stay on board for a full circuit to enjoy a relaxed sightseeing experience.  L', 'After Breakfast today you can explore the World- Heritage listed Blue Mountains, enjoy crisp, clean, fresh mountain top air with distant blue haze horizons overlooking deep ravines with rainforest carpeting the valley floor. Waterfalls, sleepy hamlets and', 'Enjoy your breakfast, check out from hotel and then you will be picked up from hotel at an appropriate time for Sydney airport to take your onward flight. Departure Airport transfer will be on shared basis.', '', '', '', '', '', 'ck');

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
(11, 'Andaman', 'About Andaman Holidays: Andaman and Nicobar Islands are one of India’s two island union territories in the Bay of Bengal. In\nlate 2018, the Government of India renamed Havelock Island as Swaraj Dweep, Neil Island as Shaheed Dweep, and Ross Island as Neta', 'Andaman-17.jpg', 'ck'),
(12, 'Austaliya', 'Australia is a land of dreams. From the Aboriginal culture, coral reefs, rainforests, and scorched, red deserts, it\r\nhas all, with some quirkiest wildlife on the planet. Australia is also a land of staggering contrast and spectacular beauty. Along the coa', 'SRP_brisbane-city.jpg', 'ck'),
(13, 'Bali', 'Bali is the crown jewel of tourism in Indonesia. It is also one of the most sought-after holiday destinations in all of Southeast Asia. It is a\r\nplace where culture meets nature and spirituality, making it a perfect choice for those seeking Bali tour pack', 'Bali-2.jpg', 'ck'),
(14, 'Kedarnath Yatra', 'Kedarnath is a town and Nagar Panchayat in Rudraprayag district of Uttarakhand, India, known primarily for the Kedarnath Temple. It is approximately 86 kilometres from Rudraprayag, the district headquarter. Kedarnath is the most remote of the four Chota C', 'Summer-Spiritual-Journey---Luxury.jpg', 'ck'),
(15, 'Dubai', 'Dubai is the most populous city in the United Arab Emirates (UAE). It used to be a small fishing village back in the 18th century but has now\r\nbecome one of the most developed and luxurious places in the world. Dubai ranks among the top lavish tourist des', 'Bhurj_Khalifa_Dubai.jpg', 'ck'),
(16, 'Egypt', 'There is more to Egypt than just pyramids. This country welcomes every tourist with its magnificent mountains, the\r\ndeserts, long and historical past and not to forget the mighty river Nile. You are bound to fall in love with this sandy country the time y', 'Egypt (2).jpg', 'ck'),
(17, 'Europe', '\r\nAsk anyone with wanderlust about the best continent to travel to in the world and the probability of Europe being the answer is quite high.\r\nBlessed with some of the most picturesque countries, Europe is a delight for tourists. Europe is the most visite', 'Salzburg-Austria-3.jpg', 'ck'),
(18, 'Goa', 'Planning a Goa Trip Has Never Been This Easy: Whether you are looking to kick back and relax by the beach, or are a\r\nparty-lover who wants to go club-hopping and dancing, Goa is your ultimate destination. Goa holidays are simply the best! This place has i', 'Goa-1.jpg', 'ck'),
(20, 'Himachal ', 'The picturesque state of Himachal Pradesh is nestled between the snow-topped Himalayan ranges in North India. Known for its panoramic\r\nlandscapes, this spectacular paradise is blessed with lofty snow peaks, deep gorges, verdant valleys, thundering rivers,', 'Shimla-Manali.jpg', 'ck'),
(23, 'Kerala', 'The Indian state of Kerala is located on the Malabar Coast and is bordered by Tamil Nadu, Karnataka and the Lakshadweep Sea. It has developed\r\ninto a major tourist destination in recent years, thanks to its beautiful collection of lakes, backwaters, beach', 'kerala (3).jpg', 'ck'),
(24, 'Laskha Dweep ', 'Exploring the serene archipelago of Lakshadweep is a dream for many, and SOTC unveils a myriad of captivating opportunities through its\r\nmeticulously crafted Lakshadweep tour packages. With a year of immersion in the travel content domain, delving into th', 'LaskhaDweep-srp.jpg', 'ck'),
(25, 'Maldives', 'The archipelagic state of Maldives is a part of South Asia and is among the most popular international holiday destinations in the world.\r\nOfficially called the Republic of Maldives, this island country is situated in the Indian Ocean, geographically sout', 'SRP_Cantara-ras.jpg', 'ck'),
(26, 'Mauritius', 'Mauritius, a heavenly island country located in the Indian Ocean is home to some of the most beautiful landscapes\r\nand reefs in the world. The beautiful coral reefs that surround the island give this tourist destination the perfect setting while the islan', 'SRP-Oceans-Creek.jpg', 'ck'),
(27, 'Rajash-than', 'the world go on a trip to Rajasthan every year to enjoy its diverse tourism experience. Apart from its rich history, Rajasthan is known for its colourful and vibrant culture and traditions, delicious cuisine, beautiful cities, jaw-dropping natural beauty,', 'Desert.jpg', 'ck'),
(28, 'Sikkim', 'The paradise located amongst the high soaring Eastern Himalayas, Sikkim is a magnificent destination and has become one of the most desired\r\nvacation spots in the country. It is known for its natural beauty, panoramic views, and vibrant meadows. It also s', 'tshangulake-north east.jpg', 'ck'),
(29, 'Singapore', 'Singapore, located in maritime southeast Asia, is a city-state and an island country. Its entire territory is made\r\nup of a main island, one outlying islets and about 63 satellite islands and islets. It is popularly described as a quintessential cosmopoli', 'SINGAPORE-2.jpg', 'ck'),
(30, 'South Africa', 'One of the dream destinations for many people across the world, South Africa has always been known for its\r\nunmatched natural beauty and wildlife. The southernmost part of Africa has a rich history and equally rich biodiversity making South Africa tourism', 'SA_Cape-Town-city-Thum-img.jpg', 'ck'),
(31, 'Thailand / Bangkok', 'The beautiful tropical country of Thailand is world-renowned for its natural and manmade tourist attractions. From pristine beaches to bustling\r\nmarkets, and majestic Buddhist temples to urban havens, the South-East Asian country has a sublime concoction ', 'Bangkok.jpg', 'ck'),
(33, 'Vietnam', 'Vietnam, officially called the Socialist Republic of Vietnam (SRV), is a country in the eastern region of Southeast Asia’s mainland. It is\r\npopularly referred to as a crown jewel of tourism in the continent for a wide number of reasons. The country has be', 'Da Nang-thum.jpg', 'ck'),
(39, ' Turkey', 'Those wanting to see all the amazing sights without having to worry about the logistics should look no further than the SOTC Turkey packages. Our Turkey tours are designed to help travellers make the most of their time in the country. We’ll take care of a', 'images (3).jpg', 'ck');

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
(8, 'Bella Vista Villa', '3345 street 1, Austaliya', 'Austaliya', 2147483647, 'hotel-imgaes (1).jpeg', 'ck'),
(12, 'La Casa Luminosa', 'vrundavan street-2 near crystal mall kalawad road ', 'Andaman', 2147483647, 'hotel-imgaes (5).jpg', 'ck'),
(14, 'Lago Luxe', 'street 209, Dobariya Wadi', 'Thailand / Bangkok', 2147483647, 'hotel-imgaes (8).jpg', 'ck'),
(16, 'Amalfi Aura', '3345 street 1,  Maldives', 'Maldives', 98849573, 'DhI1MrZ3Nh_1663823693.jpg', 'ck'),
(17, 'Giardino Giallo', 'street 10293, Dogling Bangkok', 'Dubai', 987497492, 'hotel-5936417_1280.jpg', 'ck'),
(18, 'Luna Lusso', '3345 street 1, Maldives', 'Mauritius', 2147483647, 'images.jpeg', 'ck'),
(19, 'Glitter Gateway', '25 street 1, Austaliya', 'Bali', 2147483647, 'DhI1MrZ3Nh_1663823693.jpg', 'ck'),
(20, 'Vegas Velvet', '090 Street, Mandir gam egypt', 'Egypt', 2147483647, 'hotel-5936417_1280.jpg', 'ck'),
(21, 'Citrus Cove', '78 street 1, mangol jdj Europe', 'Europe', 934847934, 'lovepik-the-outdoor-swimming-pool-of-the-luxury-resort-picture_500484656.jpg', 'ck'),
(22, 'Sandpiper Stay', '89 street 1, near Beach Goa', 'Goa', 2147483647, 'images.jpeg', 'ck'),
(23, 'Classy Castle', '24 street 1, Laskha Dweep', 'Laskha Dweep ', 2147483647, 'hotel-imgaes (1).jpeg', 'ck');

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
(69, 'Amazing Australia 9N-10D International Customized Tour Package With Optional Flight', 143000, 'Things to Do in Australia : -\\r\\nOnce you are clear to travel, there are tons of things to do in this unique, spectacular country.', 'Kuranda.jpg', 10, 9, 'Austaliya', 'Boating Trips,Camping Trips,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,Sea Bath,With Family', '', 'ck'),
(70, 'America -  (Foreign trip) –  – 4n and 5d', 123900, 'Best Time to visit USA\\r\\nIf you’re keen on experiencing the wonder of this amazing country, consider taking a US tour around the spring season, i.e., sometime between the end of March and late May. It is the best time to visit the USA since the climate i', 'SRp-lasvegas.jpg', 5, 4, 'Austaliya', 'Boating Trips,Camping Trips,Historical Place Trips,Jungle Safari Trips,With Family', '', 'ck'),
(71, ' Enchanting Egypt (Fixed Departures) 6N-7D International Customized Tour Package', 82000, 'Best Time to Visit Egypt\\\\r\\\\nEgypt is one country that can be visited at any time of the year. However, the best moments are captured while on your travel to Egypt is from February to April. These months are perfect to explore the top attractions like th', 'petra1_SRP.jpg', 7, 6, 'Egypt', 'Camping Trips,Historical Place Trips,In Mountail Trips,Best Lack VIew,With Family', 'Featured', 'ck'),
(72, 'Grand Tour Of South Africa 7N 8D', 142000, 'Best Places to Visit in South Africa South Africa is dotted with various places that are well worth visiting. Every place has attractions witnessing which will make your South Africa tours worth it. Here are some of the places to visit in South Africa tha', 'SA_Cape-Town-city-Thum-img.jpg', 8, 7, 'South Africa', 'Boating Trips,Dog Friendly,Historical Place Trips,In Mountail Trips,With Family', '', 'ck'),
(73, ' Turkey with luxury stay – 6N and 7D', 68000, 'Best Time to Visit Turkey Turkey is a land of incredible natural beauty and rich cultural heritage. Situated at the crossroads of Europe and Asia, Turkey has something to offer to everyone, making our Turkey tour packages from India immensely popular. Whe', 'images (2).jpg', 7, 6, ' Turkey', 'Camping Trips,In Mountail Trips,With Family', '', 'ck'),
(74, 'bali with water sport activites - 6N and 7D', 72000, 'Discover an array of itineraries and choose from Bali tour packages with or without flights. Theme-based Bali holiday packages are also available from SOTC such as Simply Bali, International Winter, International Cruise, customizable packages. To assist y', 'bali-imgs (2).jpg', 7, 6, 'Bali', 'Boating Trips,Camping Trips,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,Best Lack VIew,Sea Bath,With Family', 'Featured', 'ck'),
(75, 'Dubai With Abu Dhabi + Deser safar + Burj khalifa 6N-7D International Tour Package', 92000, 'Best Places to visit in Dubai The places that you can visit in Dubai are segregated into various sections. Each one of them is worth visiting. Although you can decide the attractions you want to cover while opting for the Dubai tourist packages, you can s', 'Dubai26734.jpg', 7, 6, 'Dubai', 'Boating Trips,Historical Place Trips,Best Lack VIew,Sea Bath,With Family', 'Featured', 'ck'),
(76, 'Thailand – pattaya & Bangkok 4N – 5D', 24600, 'Best time to visit Thailand You have to consider a lot of factors when scheduling your Thailand trip, such as the places you want to visit, the type of activities you want to experience, etc. Generally, the period between November and April is considered ', 'bangkokStreet.jpg', 5, 4, 'Thailand / Bangkok', 'Boating Trips,Dog Friendly,Historical Place Trips,Jungle Safari Trips,Sea Bath,With Family', 'Featured', 'ck'),
(77, 'North Goa 3N-4D Domestic Customized Tour Package', 8500, 'Overview :- Planning a Goa Trip Has Never Been This Easy: Whether you are looking to kick back and relax by the beach, or are a', 'Zuriwhitesands3.jpg', 4, 3, 'Goa', 'Boating Trips,Camping Trips,Dog Friendly,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,Best Lack VIew,Sea Bath,With Family', 'Featured', 'ck'),
(78, 'kedarnath – 6N 7D  ', 16500, 'Overview :- In the Rudraprayag area of the Uttarakhand state in northern India, there lies a sacred town called Kedarnath. Located above sea level it is one', 'Kedarnath_temple_C_THUM.jpg', 8, 7, 'Kedarnath Yatra', 'Camping Trips,Historical Place Trips,In Mountail Trips,Jungle Safari Trips,With Family', '', 'ck'),
(79, 'Rishikesh', 10000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\\\\\'s standard dummy text ever since the 1500s, ', 'RISHIKESH_C.jpg', 6, 5, 'Kedarnath Yatra', 'Boating Trips,Camping Trips,Historical Place Trips,In Mountail Trips,With Family', 'Featured', 'ck');

-- --------------------------------------------------------

--
-- Table structure for table `trip_bookings`
--

CREATE TABLE `trip_bookings` (
  `id` int(100) NOT NULL,
  `trip_id` int(100) NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `trip_price` int(100) NOT NULL,
  `booking_date` date NOT NULL,
  `adult_qty` int(100) NOT NULL,
  `child_qty` int(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `coupon_used` varchar(100) NOT NULL,
  `client_id` int(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_bookings`
--

INSERT INTO `trip_bookings` (`id`, `trip_id`, `trip_name`, `destination`, `trip_price`, `booking_date`, `adult_qty`, `child_qty`, `total_price`, `coupon_used`, `client_id`, `status`) VALUES
(82, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '2024-09-24', 1, 1, 49200, '', 40, 'pending'),
(83, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '2024-09-27', 1, 0, 24600, '', 40, 'pending'),
(84, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '0000-00-00', 1, 1, 49200, '', 40, 'complete'),
(85, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '0000-00-00', 1, 0, 24600, '', 40, 'pending'),
(86, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '0000-00-00', 1, 0, 24600, '', 40, 'pending'),
(87, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '0000-00-00', 0, 1, 24600, '', 40, 'pending'),
(88, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '0000-00-00', 1, 0, 24600, '', 40, 'pending'),
(89, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '0000-00-00', 1, 0, 24600, '', 40, 'pending'),
(90, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '2024-09-26', 1, 0, 24600, '', 40, 'pending'),
(91, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '2024-09-30', 1, 1, 49200, '', 40, 'pending'),
(92, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '2024-09-25', 1, 0, 24600, '', 40, 'Confirmed'),
(93, 74, 'bali with water sport activites - 6N and 7D', 'Bali', 72000, '2024-09-25', 1, 0, 72000, '', 40, 'Confirmed'),
(96, 76, 'Thailand – pattaya & Bangkok 4N – 5D', 'Thailand / Bangkok', 24600, '2024-09-26', 1, 1, 49200, '', 36, 'Confirmed'),
(97, 71, ' Enchanting Egypt (Fixed Departures) 6N-7D International Customized Tour Package', 'Egypt', 82000, '2024-10-01', 0, 1, 82000, '', 40, 'pending'),
(98, 71, ' Enchanting Egypt (Fixed Departures) 6N-7D International Customized Tour Package', 'Egypt', 82000, '2024-10-16', 1, 1, 164000, '', 40, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `trip_query`
--

CREATE TABLE `trip_query` (
  `id` int(255) NOT NULL,
  `trip_id` int(100) NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` int(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_query`
--

INSERT INTO `trip_query` (`id`, `trip_id`, `trip_name`, `name`, `email`, `number`, `subject`, `message`) VALUES
(1, 79, 'Rishikesh', 'demo', 'demo@gmail.com', 2147483647, 'demo check', '1234567'),
(2, 79, 'Rishikesh', 'demo', 'demo@gmail.com', 2147483647, 'demo check', '1234567'),
(4, 79, 'Rishikesh', 'demo', 'demo@gmail.com', 2147483647, '34333', 'jsudhuk'),
(5, 79, 'Rishikesh', 'demo', 'demo@gmail.com', 2147483647, '34333', 'jsudhuk'),
(6, 79, 'Rishikesh', 'demo', 'demo@gmail.com', 2147483647, '34333', 'jsudhuk'),
(7, 77, 'North Goa 3N-4D Domestic Customized Tour Package', 'ck', 'ck@gmail.com', 2147483647, 'demo', 'demo check'),
(8, 77, 'North Goa 3N-4D Domestic Customized Tour Package', 'ck', 'ck@gmail.com', 2147483647, 'demo', 'demo check'),
(9, 77, 'North Goa 3N-4D Domestic Customized Tour Package', 'demo', 'demo@gmail.com', 2147483647, '9876ioibbnsx', 'sndbvgdfd7y8us9ikal;m'),
(10, 77, 'North Goa 3N-4D Domestic Customized Tour Package', 'demo', 'demo@gmail.com', 2147483647, '9876ioibbnsx', 'sndbvgdfd7y8us9ikal;m'),
(11, 70, 'America -  (Foreign trip) –  – 4n and 5d', 'ck012', 'ck@gmail.com', 2147483647, 'demo for pagination', 'this is demo'),
(12, 74, 'bali with water sport activites - 6N and 7D', 'test', 'demo@gmail.com', 2147483647, 'demo check', 'nfsdhoinslkdns');

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
(3, 'Boating Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Boating.jpg', 'ck'),
(4, 'Camping Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Camping.jpg', 'ck'),
(5, 'Dog Friendly', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Dog Friendly.jpg', 'ck'),
(6, 'Historical Place Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Historycal place.jpg', 'ck'),
(7, 'In Mountail Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'In Mountain.jpg', 'ck'),
(8, 'Jungle Safari Trips', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'Jungle Safari.jpg', 'ck'),
(9, 'Best Lack VIew', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'lake view.jpg', 'ck'),
(10, 'Sea Bath', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sea bath.jpg', 'ck'),
(11, 'With Family', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'With Family.jpg', 'ck');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_pw` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(100) NOT NULL,
  `auther` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `image`, `name`, `email`, `password`, `confirm_pw`, `date`, `user_type`, `auther`) VALUES
(16, '', 'krushil', 'krushilchabhadiya600@gmail.com', '9e5bd77cdf6c58281d21fce42d8d48d1', '', '0000-00-00 00:00:00', 'User', ''),
(31, '', 'demo', 'demo@gmail.com', 'f702c1502be8e55f4208d69419f50d0a', '', '0000-00-00 00:00:00', 'Admin', ''),
(34, '', 'deep', 'deep@gmail.com', 'dd4936bf8f4c399b2bd95c07486172b5', 'dd4936bf8f4c399b2bd95c07486172b5', '0000-00-00 00:00:00', 'User', ''),
(35, '', 'abc', 'abc@gmail.com', '900150983cd24fb0d6963f7d28e17f72', '900150983cd24fb0d6963f7d28e17f72', '0000-00-00 00:00:00', 'User', ''),
(36, '', 'karan', 'karan@gmail.com', 'db068ce9f744fbb35eedc9a883f91085', 'karan', '0000-00-00 00:00:00', 'User', ''),
(38, '—Pngtree—india flag waving transparent background_6167661.png', 'ck', 'ck@gmail.com', 'ck@123', 'ck@123', '0000-00-00 00:00:00', 'Admin', ''),
(40, '', 'patel', 'patel@gmail.com', '64a43b6ca15d128ac6a0679b39bc9c07', 'patel', '0000-00-00 00:00:00', 'User', ''),
(42, '', 'demo10', 'demo10@gmail.com', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo', '2024-09-24 22:50:16', 'User', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_services`
--
ALTER TABLE `add_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
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
-- Indexes for table `trip_bookings`
--
ALTER TABLE `trip_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_query`
--
ALTER TABLE `trip_query`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupen`
--
ALTER TABLE `coupen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `day_wise_secudle`
--
ALTER TABLE `day_wise_secudle`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `trip_bookings`
--
ALTER TABLE `trip_bookings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `trip_query`
--
ALTER TABLE `trip_query`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
