-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 07:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(1, 'Admin', 'User', 'admin@cse340.net', '$2y$10$RbCQU4J.KSxvt0AcjN6aGe0rPduNUTSIUGAFQIWwFX4dU9bItWG5i', '3', NULL),
(3, 'Apple', 'White', 'applewhite@snow.com', '$2y$10$zprq6L5MRm3OA.yFAC/v3u6KO5cdZIqFHLqh5rkyOCVjhvzhqIZ/a', '1', NULL),
(4, 'John', 'Smith', 'johnsmith@gmail.com', '$2y$10$3HLEFTgJpcQnKkHVN6e0zOEnlP39HXH2aMQ855TVYekg3OF2xzYzC', '1', NULL),
(5, 'Adrienne', 'Bunderson', 'planteddeep@gmail.com', '$2y$10$RX9pnjPWXwiy0/RjckpAseIu95a4VwZBk6zfobRW/VJd2kmaItvYm', '1', NULL),
(6, 'Someone', 'IsWatching', 'watching@gmail.com', '$2y$10$Pumd/LBXYe.L82bYmkw47.dvwr4U1hAu.9R5qYCoxvOCthlP4njdS', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(7, 2, 'ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt.jpg', '2022-11-24 22:44:57', 1),
(8, 2, 'ford-modelt-tn.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '2022-11-24 22:44:57', 1),
(9, 3, 'lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve.jpg', '2022-11-24 22:45:18', 1),
(10, 3, 'lambo-Adve-tn.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '2022-11-24 22:45:18', 1),
(11, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2022-11-24 22:45:33', 1),
(12, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2022-11-24 22:45:33', 1),
(13, 5, 'ms.jpg', '/phpmotors/images/vehicles/ms.jpg', '2022-11-24 22:45:54', 1),
(14, 5, 'ms-tn.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '2022-11-24 22:45:54', 1),
(15, 6, 'bat.jpg', '/phpmotors/images/vehicles/bat.jpg', '2022-11-24 22:46:12', 1),
(16, 6, 'bat-tn.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '2022-11-24 22:46:12', 1),
(17, 7, 'mm.jpg', '/phpmotors/images/vehicles/mm.jpg', '2022-11-24 22:46:29', 1),
(18, 7, 'mm-tn.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '2022-11-24 22:46:29', 1),
(19, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2022-11-24 22:46:47', 1),
(20, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2022-11-24 22:46:47', 1),
(21, 9, 'crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic.jpg', '2022-11-24 22:47:03', 1),
(22, 9, 'crown-vic-tn.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '2022-11-24 22:47:03', 1),
(23, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2022-11-24 22:47:25', 1),
(24, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2022-11-24 22:47:25', 1),
(25, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2022-11-24 22:47:41', 1),
(26, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2022-11-24 22:47:41', 1),
(27, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2022-11-24 22:47:56', 1),
(28, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2022-11-24 22:47:56', 1),
(29, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2022-11-24 22:48:11', 1),
(30, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2022-11-24 22:48:11', 1),
(31, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2022-11-24 22:48:30', 1),
(32, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2022-11-24 22:48:30', 1),
(33, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2022-11-24 22:48:44', 1),
(34, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2022-11-24 22:48:44', 1),
(37, 4, 'monstertruck1.jpg', '/phpmotors/images/vehicles/monstertruck1.jpg', '2022-11-24 22:56:01', 0),
(38, 4, 'monstertruck1-tn.jpg', '/phpmotors/images/vehicles/monstertruck1-tn.jpg', '2022-11-24 22:56:01', 0),
(39, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2022-11-24 22:59:34', 1),
(40, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2022-11-24 22:59:34', 1),
(41, 18, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2022-11-24 23:00:45', 1),
(42, 18, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2022-11-24 23:00:45', 1),
(43, 5, 'ms1.jpg', '/phpmotors/images/vehicles/ms1.jpg', '2022-11-24 23:05:26', 0),
(44, 5, 'ms1-tn.jpg', '/phpmotors/images/vehicles/ms1-tn.jpg', '2022-11-24 23:05:26', 0),
(47, 18, 'delorean1.jpg', '/phpmotors/images/vehicles/delorean1.jpg', '2022-11-24 23:07:01', 0),
(48, 18, 'delorean1-tn.jpg', '/phpmotors/images/vehicles/delorean1-tn.jpg', '2022-11-24 23:07:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,0) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. It is great for everyday driving as well as off-roading whether that be on the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want if it is black.', '/phpmotors/images/vehicles/ford-modelt.jpg', '/phpmotors/images/vehicles/ford-modelt-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/lambo-Adve.jpg', '/phpmotors/images/vehicles/lambo-Adve-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. This beast comes with 60 inch tires giving you the traction needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '150000', 3, 'Purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. However, with a little tender loving care it will run as good a new.', '/phpmotors/images/vehicles/ms.jpg', '/phpmotors/images/vehicles/ms-tn.jpg', '100', 1, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a superhero? Now you can with the bat mobile. This car allows you to switch to bike mode allowing for easy maneuvering through traffic during rush hour.', '/phpmotors/images/vehicles/bat.jpg', '/phpmotors/images/vehicles/bat-tn.jpg', '65000', 1, 'Black', 5),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of their 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mm.jpg', '/phpmotors/images/vehicles/mm-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000-gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 1, 'Black', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equipped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown-vic.jpg', '/phpmotors/images/vehicles/crown-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This styling car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rush hour traffic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get this one while it lasts!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 1, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You will feel right at home driving this van. Comes complete with surveillance equipment for an extra fee of $2,000 a month.', '/phpmotors/images/vehicles/fbi.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well, this car is for you straight from the 90s from Aspen, Colorado we have the original Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image.png', '35000', 1, 'Brown', 2),
(18, 'DMC', 'Delorean', 'Maybe able to travel through time while using.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image.png', '1000000', 1, 'Black', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(1, 'The Mystery Machine is a hoot and a holler. There always seems to be something new to discover. Is that Scooby I see? Or maybe even Scrapy?', '2022-11-29 23:28:27', 7, 1),
(3, 'Another review about monster trucks. This is the second review? maybe? I just had to delete one to check functionality so who know now. I am not sure they were all made on the same day and I am losing track as it gets later in the day.', '2022-11-29 23:41:54', 4, 1),
(4, 'This is the third review about monster trucks and because it is the last it is the most recent and should be at the very top of the list I think. Just keep typing, just keep typing, what do we do? We type!', '2022-11-30 00:25:55', 4, 1),
(5, 'This is a rad van! I can almost seen the ascot around Fred&#039;s neck just seeing an image of this car. I have a friend who has never seen ScoobyDoo because her mom was insane and emotionally manipulative.', '2022-11-30 00:58:39', 7, 5),
(8, 'DON&#039;T DO IT. IT ISN&#039;T WORTH IT. I bought this because of the price tag... but it doesn&#039;t even drive!', '2022-11-30 02:27:04', 5, 5),
(10, 'It&#039;s a new day and the Mystery Machine is a glorious thing to see in the morning. This van means that help is coming and the villain (cough.. old guy in a mask) will be defeated and peace and prosperity will reign.', '2022-11-30 17:21:40', 7, 1),
(12, 'This car may be able to travel through time if you get fast enough!', '2022-12-09 01:29:56', 18, 1),
(13, 'Fancy car with fancy tire breaks. Or maybe they are called something else. I do not know I know nothing about cars. Except I can tell what color they are. This one is white.', '2022-12-10 17:16:07', 3, 1),
(14, 'Black and yellow, black and yellow. Do you get it? It is a bee because it hums.', '2022-12-10 17:16:51', 12, 1),
(15, 'Wee woo Wee woo', '2022-12-10 17:17:15', 8, 1),
(16, 'Black as my soul!! and a third of my wardrobe because black goes with anything.', '2022-12-10 17:19:08', 10, 6),
(17, 'He sees you when you&#039;re sleeping. He knows when you&#039;re awake. He knows when you&#039;ve been bad or good so be good. . .', '2022-12-10 17:20:04', 5, 6),
(19, '...', '2022-12-10 18:18:32', 9, 6),
(20, 'I remember when. . . Said my great great grandmothers ghost in my ear. But why does this only happen on bright sunny days? It would be a better story if it happened on a dark rainy night.', '2022-12-10 18:20:03', 2, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `email_unique` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_images` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_inv_reviews` (`invId`),
  ADD KEY `FK_client_reviews` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_client_reviews` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_inv_reviews` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
